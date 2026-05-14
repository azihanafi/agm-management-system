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

    private function nominationIsOpen(): bool
    {
        $settings = MeetingControl::first();
        if (!$settings || !$settings->nomination_open_until) return true;
        return Carbon::today()->lte($settings->nomination_open_until);
    }

    public function submitNomination()
    {
        if (!$this->nominationIsOpen()) {
            $this->message = 'Nominations are now closed.';
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
        $nominationDeadline = $settings?->nomination_open_until;
        $isOpen = $this->nominationIsOpen();

        return view('livewire.member-nomination', [
            'positions' => Position::all(),
            'nominationIsOpen' => $isOpen,
            'nominationDeadline' => $nominationDeadline,
            'members' => ($isOpen && strlen($this->search) >= 2)
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
