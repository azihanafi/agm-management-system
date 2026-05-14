<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Position;
use App\Models\Nomination;
use App\Models\Vote;
use App\Models\Attendance;
use Livewire\Attributes\On;

class CeoDashboard extends Component
{
    public $activeTab = 'overview';
    public $selectedLogDate;
    public $searchTerm = '';
    public $showQrModal = false;
    public $attendanceUrl;
    
    // Position Management
    public $newPositionName;
    public $editingPositionId;
    public $editingPositionTitle;
    
    // Candidate Management
    public $selectedPosition;
    public $selectedMember;

    // Member Management (Edit)
    public $editingMemberId;
    public $editingName;
    public $editingStaffId;
    public $editingWorkplace;

    // Meeting Settings
    public $meetingTac;
    public $isVotingOpen;
    public $activePositionId;
    public $tacExpiresAt;

    // Meeting Schedule
    public $meetingDate;
    public $startTime;
    public $endTime;

    public function mount()
    {
        $settings = \App\Models\MeetingControl::first();
        
        // Self-Healing: Create default settings if database is empty
        if (!$settings) {
            $settings = \App\Models\MeetingControl::create([
                'meeting_tac' => sprintf("%06d", mt_rand(100000, 999999)),
                'tac_expires_at' => now()->addMinutes(5),
                'meeting_date' => now()->format('Y-m-d'),
                'start_time' => '08:00',
                'end_time' => '23:59',
                'is_voting_open' => false
            ]);
        }

        $this->meetingTac = $settings->meeting_tac;
        $this->isVotingOpen = $settings->is_voting_open;
        $this->activePositionId = $settings->active_position_id;
        $this->tacExpiresAt = $settings->tac_expires_at;
        
        // Always default to Today's date for better UX
        $this->meetingDate = now()->format('Y-m-d');
        
        $this->startTime = $settings->start_time;
        $this->endTime = $settings->end_time;
        
        $this->attendanceUrl = route('attendance.scan');
    }

    public function toggleQrModal()
    {
        $this->showQrModal = !$this->showQrModal;
    }

    public function refreshSettings()
    {
        $settings = \App\Models\MeetingControl::first();
        if (!$settings) return; // Wait for mount() to handle it
        
        // Auto-Rotate TAC if expired
        if ($settings->tac_expires_at && now()->greaterThan($settings->tac_expires_at)) {
            $newTac = sprintf("%06d", mt_rand(100000, 999999));
            $settings->update([
                'meeting_tac' => $newTac,
                'tac_expires_at' => now()->addMinutes(5)
            ]);
            $this->meetingTac = $newTac;
            $this->tacExpiresAt = $settings->tac_expires_at;
        }

        $this->activePositionId = $settings->active_position_id;
        $this->tacExpiresAt = $settings->tac_expires_at;
        $this->isVotingOpen = $settings->is_voting_open;
        
        // Note: We don't overwrite meetingDate/startTime/endTime here 
        // to avoid interrupting the admin while they are typing.
    }

    public function updateSettings()
    {
        // Auto-enable voting if a position is selected
        if ($this->activePositionId) {
            $this->isVotingOpen = true;
        }

        $settings = \App\Models\MeetingControl::first();
        
        // Final Safety Checks: Fallback to DB values if state is lost
        $this->meetingTac = $this->meetingTac ?: $settings->meeting_tac;
        $this->isVotingOpen = $this->isVotingOpen ?? $settings->is_voting_open;
        $this->meetingDate = $this->meetingDate ?: $settings->meeting_date;
        $this->startTime = $this->startTime ?: $settings->start_time;
        $this->endTime = $this->endTime ?: $settings->end_time;

        $settings->update([
            'meeting_tac' => $this->meetingTac,
            'is_voting_open' => (bool)$this->isVotingOpen,
            'active_position_id' => $this->activePositionId ?: null,
            'meeting_date' => $this->meetingDate,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
        ]);
        session()->flash('settings_message', 'Meeting settings and schedule updated successfully!');
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    #[On('members-updated')]
    public function refreshMembers()
    {
        // This will trigger a re-render
    }

    public function addPosition()
    {
        $this->validate(['newPositionName' => 'required|min:3']);
        Position::create(['title' => $this->newPositionName]);
        $this->newPositionName = '';
        session()->flash('message', 'Position added successfully!');
    }

    public function editPosition($id)
    {
        $position = Position::find($id);
        $this->editingPositionId = $position->id;
        $this->editingPositionTitle = $position->title;
    }

    public function cancelPositionEdit()
    {
        $this->reset(['editingPositionId', 'editingPositionTitle']);
    }

    public function updatePosition()
    {
        $this->validate([
            'editingPositionTitle' => 'required|min:3',
        ]);

        $position = Position::find($this->editingPositionId);
        $position->update([
            'title' => $this->editingPositionTitle,
        ]);

        $this->cancelPositionEdit();
        session()->flash('message', 'Position updated successfully!');
    }

    public function addCandidate()
    {
        $this->validate([
            'selectedPosition' => 'required',
            'selectedMember' => 'required',
        ]);

        Nomination::create([
            'position_id' => $this->selectedPosition,
            'nominee_id' => $this->selectedMember,
            'nominator_id' => auth()->id(),
            'is_disqualified' => false,
            'ceo_override' => false,
        ]);

        session()->flash('message', 'Candidate nominated successfully!');
    }

    public function toggleOverride($nominationId)
    {
        $nomination = Nomination::find($nominationId);
        $nomination->ceo_override = !$nomination->ceo_override;
        $nomination->save();
    }
    public function editMember($id)
    {
        $member = User::find($id);
        $this->editingMemberId = $member->id;
        $this->editingName = $member->name;
        $this->editingStaffId = $member->staff_id;
        $this->editingWorkplace = $member->workplace;
    }

    public function cancelEdit()
    {
        $this->reset(['editingMemberId', 'editingName', 'editingStaffId', 'editingWorkplace']);
    }

    public function updateMember()
    {
        $this->validate([
            'editingName' => 'required|min:3',
            'editingStaffId' => 'required|unique:users,staff_id,' . $this->editingMemberId,
            'editingWorkplace' => 'required',
        ]);

        $member = User::find($this->editingMemberId);
        $member->update([
            'name' => $this->editingName,
            'staff_id' => $this->editingStaffId,
            'workplace' => $this->editingWorkplace,
        ]);

        $this->cancelEdit();
        session()->flash('member_message', 'Member updated successfully!');
    }

    public function deleteMember($id)
    {
        User::destroy($id);
        session()->flash('member_message', 'Member deleted successfully!');
    }

    public function deletePosition($id)
    {
        Position::destroy($id);
        session()->flash('message', 'Position removed successfully!');
    }
    public function exportAttendance()
    {
        $date = $this->selectedLogDate ?: now()->format('Y-m-d');
        $logs = Attendance::with('user')
            ->whereDate('scanned_at', $date)
            ->where('status', 'present')
            ->get();

        $filename = "attendance_log_{$date}.csv";
        $handle = fopen('php://output', 'w');
        
        // CSV Headers
        fputcsv($handle, ['Time', 'Name', 'Staff ID', 'Workplace', 'Status']);

        foreach ($logs as $log) {
            fputcsv($handle, [
                $log->scanned_at->format('H:i:s'),
                $log->user->name,
                $log->user->staff_id,
                $log->user->workplace,
                'PRESENT'
            ]);
        }

        return response()->streamDownload(function() use ($handle) {
            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function render()
    {
        $this->refreshSettings();

        return view('livewire.ceo-dashboard', [
            'stats' => [
                'total_members' => User::count(),
                'present_members' => Attendance::where('status', 'present')->whereDate('scanned_at', now())->count(),
                'total_votes' => Vote::count(),
                'total_positions' => Position::count(),
            ],
            'positions' => Position::all(),
            'nominations' => Nomination::with(['nominee', 'position'])->get(),
            'members' => User::where('role', 'member')
                ->when($this->searchTerm, function($query) {
                    $query->where(function($q) {
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('staff_id', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('workplace', 'like', '%' . $this->searchTerm . '%');
                    });
                })->get(),
            'attendance_log' => Attendance::with('user')
                ->where('status', 'present')
                ->whereDate('scanned_at', $this->selectedLogDate ?: now())
                ->orderBy('scanned_at', 'desc')
                ->get(),
            'results' => Vote::selectRaw('position_id, nominee_id, count(*) as count')
                ->groupBy('position_id', 'nominee_id')
                ->with(['nominee', 'position'])
                ->get(),
            'all_paperworks' => \App\Models\Paperwork::orderBy('created_at', 'desc')->get(),
            'top_nominations' => Nomination::selectRaw('position_id, nominee_id, count(*) as nomination_count')
                ->groupBy('position_id', 'nominee_id')
                ->with(['nominee', 'position'])
                ->orderBy('nomination_count', 'desc')
                ->get()
                ->groupBy('position_id')
                ->map(function($items) {
                    return $items->take(30);
                }),
        ]);
    }
}
