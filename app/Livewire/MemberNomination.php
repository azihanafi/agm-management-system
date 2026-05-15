<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Position;
use App\Models\User;
use App\Models\Nomination;
use Illuminate\Support\Facades\Auth;
use App\Models\MeetingControl;
use Carbon\Carbon;

class MemberNomination extends Component
{
    public $selectedMember;
    public $searchInputs = []; // Independent search text for each category
    public $activePositionId = null; 
    public $isIdentified = false; // Gatekeeper for nomination
    public $verificationId = '';
    public $message;
    public $myNominations = [];

    public function mount()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            $this->verificationId = Auth::user()->staff_id;
        }
    }

    public function updatedSearchInputs($value, $key)
    {
        // $key will be the position_id
        $this->activePositionId = $key;
        $this->selectedMember = null;
        $this->message = '';
    }

    private function nominationStatus(): string
    {
        $settings = MeetingControl::first();
        $today = Carbon::today();
        $start = $settings?->nomination_opens_at;
        $end   = $settings?->nomination_open_until;

        if (!$start && !$end) return 'open';
        if ($start && $today->lt($start)) return 'upcoming';
        if ($end && $today->gt($end)) return 'closed';
        return 'open';
    }

    public function submitNomination($positionId)
    {
        $status = $this->nominationStatus();
        if ($status === 'closed') {
            $this->message = 'Nominations are now closed.';
            return;
        }
        if ($status === 'upcoming') {
            $this->message = 'Nominations have not opened yet.';
            return;
        }

        // Check if user has already nominated for this category
        $existing = Nomination::where('position_id', $positionId)
            ->where('nominator_id', Auth::id())
            ->exists();

        if ($existing) {
            $this->message = 'error: You have already submitted a nomination for this category.';
            return;
        }

        if (!$this->selectedMember || $this->activePositionId != $positionId) {
            $this->message = 'Please select a nominee from the search results first.';
            return;
        }

        Nomination::create([
            'position_id' => $positionId, 
            'nominator_id' => Auth::id(),
            'nominee_id' => $this->selectedMember,
            'is_disqualified' => false,
            'ceo_override' => false,
        ]);

        $this->searchInputs[$positionId] = '';
        $this->activePositionId = null;
        $this->selectedMember = null;
        $this->message = 'Nomination submitted successfully! This category is now closed.';
    }

    public function selectMember($id, $name, $positionId)
    {
        $this->selectedMember = $id;
        $this->searchInputs[$positionId] = $name;
    }

    public function verifyId()
    {
        $this->validate(['verificationId' => 'required']);

        $user = User::where('staff_id', trim($this->verificationId))->first();

        if ($user) {
            Auth::login($user);
            $this->isIdentified = true;
            $this->message = '';
        } else {
            $this->addError('verificationId', 'Staff ID not found in the member database.');
        }
    }

    public function clearSearch($positionId)
    {
        $this->searchInputs[$positionId] = '';
        if ($this->activePositionId == $positionId) {
            $this->activePositionId = null;
            $this->selectedMember = null;
        }
    }

    public function render()
    {
        $settings = MeetingControl::first();
        $status = $this->nominationStatus();

        $nominations = Nomination::where('nominator_id', Auth::id())->get();
        $nomineeIds = $nominations->pluck('nominee_id')->toArray();
        $nomineeNames = User::whereIn('id', $nomineeIds)->pluck('name', 'id')->toArray();

        $myNominations = [];
        foreach ($nominations as $nom) {
            $myNominations[(int)$nom->position_id] = $nomineeNames[$nom->nominee_id] ?? 'Selected Candidate';
        }

        $activeSearch = ($this->activePositionId && isset($this->searchInputs[$this->activePositionId])) 
            ? $this->searchInputs[$this->activePositionId] 
            : '';

        $allPositions = Position::all();
        $openPositions = $allPositions->filter(fn($pos) => !isset($myNominations[(int)$pos->id]));
        $completedPositions = $allPositions->filter(fn($pos) => isset($myNominations[(int)$pos->id]));

        return view('livewire.member-nomination', [
            'openPositions' => $openPositions,
            'completedPositions' => $completedPositions,
            'nominatedIds' => array_keys($myNominations),
            'nominationStatus'   => $status,
            'nominationOpensAt'  => $settings?->nomination_opens_at,
            'nominationDeadline' => $settings?->nomination_open_until,
            'myNominations' => $myNominations,
            'members' => ($status === 'open' && strlen($activeSearch) >= 2)
                ? User::where(function($q) use ($activeSearch) {
                        $q->where('name', 'like', '%' . $activeSearch . '%')
                          ->orWhere('staff_id', 'like', '%' . $activeSearch . '%');
                    })
                    ->limit(10)
                    ->get()
                : [],
        ]);
    }
}
