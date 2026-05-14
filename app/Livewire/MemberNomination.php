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
    public $selectedPosition;
    public $selectedMember;
    public $search = '';
    public $message;

    public function updatedSearch()
    {
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

    public function submitNomination()
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

        $this->validate([
            'selectedPosition' => 'required',
            'selectedMember' => 'required',
        ]);

        // Prevent the SAME user from nominating the SAME person for the SAME position twice
        $exists = Nomination::where('position_id', $this->selectedPosition)
            ->where('nominee_id', $this->selectedMember)
            ->where('nominator_id', Auth::id())
            ->exists();

        if ($exists) {
            $this->message = 'You have already nominated this person for this position.';
            return;
        }

        Nomination::create([
            'position_id' => $this->selectedPosition,
            'nominee_id' => $this->selectedMember,
            'nominator_id' => Auth::id(),
            'is_disqualified' => false,
            'ceo_override' => false,
        ]);

        $this->reset(['selectedPosition', 'selectedMember']);
        $this->message = 'Your nomination has been submitted successfully!';
    }

    public function selectMember($id, $name)
    {
        $this->selectedMember = $id;
        $this->search = $name;
    }

    public function render()
    {
        $settings = MeetingControl::first();
        $status = $this->nominationStatus();

        return view('livewire.member-nomination', [
            'positions' => Position::all(),
            'nominationStatus'   => $status,
            'nominationOpensAt'  => $settings?->nomination_opens_at,
            'nominationDeadline' => $settings?->nomination_open_until,
            'members' => ($status === 'open' && strlen($this->search) >= 2)
                ? User::where(function($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('staff_id', 'like', '%' . $this->search . '%');
                    })
                    ->limit(10)
                    ->get()
                : [],
        ]);
    }
}
