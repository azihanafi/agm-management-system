<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginForm extends Component
{
    public $staff_id;
    public $password;

    public function login()
    {
        $this->validate([
            'staff_id' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['staff_id' => $this->staff_id, 'password' => $this->password])) {
            session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('attendance.scan');
        }

        $this->addError('staff_id', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
