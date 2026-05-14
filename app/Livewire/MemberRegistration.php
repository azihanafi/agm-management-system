<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MemberRegistration extends Component
{
    public $name;
    public $staff_id;
    public $workplace;
    public $password;
    public $registrationMessage;

    public function mount()
    {
        $this->staff_id = request()->query('staff_id');
        $this->registrationMessage = session('registration_message');
    }

    public function updatedName($value)
    {
        $this->name = strtoupper($value);
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'staff_id' => 'required|unique:users,staff_id',
            'workplace' => ['required', Rule::in(['FJB - T1, T2, T3', 'FGVGT', 'FGV Terminal 4', 'LBSB'])],
            'password' => 'required|min:8',
        ];
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'staff_id' => $this->staff_id,
            'workplace' => $this->workplace,
            'password' => Hash::make($this->password),
            'is_new_member' => true,
        ]);

        Auth::login($user);

        return redirect()->route('attendance.scan');
    }

    public function render()
    {
        return view('livewire.member-registration');
    }
}
