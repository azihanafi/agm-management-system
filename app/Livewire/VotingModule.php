<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Position;
use App\Models\Nomination;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VotingModule extends Component
{
    public $positions;
    public $selectedNominees = []; // position_id => nominee_id

    public function mount()
    {
        // Data is now fetched in render for live updates
    }

    public function castVote($positionId, $nomineeId)
    {
        $user = Auth::user();
        $settings = \App\Models\MeetingControl::first();

        // Safety: Check if this position is actually open for voting
        if (!$settings->is_voting_open || $settings->active_position_id != $positionId) {
            session()->flash('error', 'Voting for this position is no longer open.');
            return;
        }
        
        // Validation: Must be present
        if (!$user->isPresent()) {
            session()->flash('error', 'Attendance verification required.');
            return;
        }

        // Check if already voted for this position
        if (Vote::where('voter_id', $user->id)->where('position_id', $positionId)->exists()) {
            session()->flash('error', 'You have already cast your vote for this position.');
            return;
        }

        $nomination = Nomination::where('position_id', $positionId)
            ->where('nominee_id', $nomineeId)
            ->first();

        // Eligibility Check
        if (!$nomination || !$nomination->isEligible()) {
            session()->flash('error', 'This nominee is currently disqualified (Not Present).');
            return;
        }

        DB::transaction(function () use ($user, $nomineeId, $positionId) {
            Vote::create([
                'voter_id' => $user->id,
                'nominee_id' => $nomineeId,
                'position_id' => $positionId,
            ]);
        });

        session()->flash('message', 'Vote cast successfully!');
        $this->mount(); // Refresh
    }

    public function render()
    {
        $settings = \App\Models\MeetingControl::first();
        
        $activePosition = null;
        if ($settings->is_voting_open && $settings->active_position_id) {
            $activePosition = Position::find($settings->active_position_id);
            if ($activePosition) {
                // Get unique nominees for this position
                $activePosition->setRelation('nominations', 
                    Nomination::where('position_id', $activePosition->id)
                        ->with(['nominee.attendance'])
                        ->get()
                        ->unique('nominee_id')
                );
            }
        }

        return view('livewire.voting-module', [
            'activePosition' => $activePosition,
            'isVotingOpen' => $settings->is_voting_open,
            'hasVoted' => Vote::where('voter_id', Auth::id())
                ->where('position_id', $settings->active_position_id)
                ->exists(),
        ]);
    }
}
