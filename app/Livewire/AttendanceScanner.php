<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AttendanceScanner extends Component
{
    public $staff_id;
    public $memberInfo = null;
    public $step = 1; // 1: Staff ID, 2: Selection Menu, 3: Success Menu, 4: TAC Entry
    public $input_tac;

    public function mount()
    {
        if (Auth::check()) {
            $this->memberInfo = Auth::user();
            if (Auth::user()->isPresent()) {
                $this->step = 3; // Show success menu if already present
            } else {
                $this->step = 2; // Show selection menu if logged in but not present
                $this->staff_id = Auth::user()->staff_id;
            }
        }
    }

    public function verifyStaff()
    {
        $this->validate([
            'staff_id' => 'required',
        ]);

        $this->memberInfo = User::where('staff_id', $this->staff_id)->first();

        if (!$this->memberInfo) {
            session()->flash('registration_message', 'Staff ID not found. Please register your details first.');
            return redirect()->route('register', ['staff_id' => $this->staff_id]);
        }

        // Auto-login to allow access to nomination without TAC
        if (!Auth::check()) {
            Auth::login($this->memberInfo);
        }

        $this->step = 2; // Go to selection menu
    }

    public function confirmAttendance()
    {
        $settings = \App\Models\MeetingControl::first();
        
        // Schedule Check
        $now = now();
        $startTime = \Carbon\Carbon::parse($settings->meeting_date . ' ' . $settings->start_time);
        $endTime = \Carbon\Carbon::parse($settings->meeting_date . ' ' . $settings->end_time);

        if ($now->lt($startTime)) {
            $this->addError('input_tac', 'Attendance session has not started yet. Please wait until ' . $startTime->format('H:i'));
            return;
        }

        if ($now->gt($endTime)) {
            $this->addError('input_tac', 'Attendance session has already ended.');
            return;
        }

        if ($this->input_tac !== $settings->meeting_tac) {
            $this->addError('input_tac', 'Incorrect Meeting TAC. Please refer to the organizer.');
            return;
        }

        $user = $this->memberInfo;
        
        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('scanned_at', now())
            ->first();

        if ($attendance) {
            $attendance->update([
                'status' => 'present',
                'tac_code' => $this->input_tac,
                'scanned_at' => now(),
            ]);
        } else {
            Attendance::create([
                'user_id' => $user->id,
                'status' => 'present',
                'tac_code' => $this->input_tac,
                'scanned_at' => now(),
            ]);
        }

        // Auto-login for the session if not already
        if (!Auth::check()) {
            Auth::login($user);
        }

        // Show success menu
        $this->step = 3;
    }

    public function render()
    {
        return view('livewire.attendance-scanner');
    }
}
