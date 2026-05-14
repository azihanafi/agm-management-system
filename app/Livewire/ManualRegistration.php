<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManualRegistration extends Component
{
    public $name;
    public $staff_id;
    public $workplace;
    public $successMessage = '';

    public function updatedName($value)
    {
        $this->name = strtoupper($value);
    }

    protected $rules = [
        'name' => 'required|min:3',
        'staff_id' => 'required|unique:users,staff_id',
        'workplace' => 'required',
    ];

    public function registerMember()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'staff_id' => $this->staff_id,
            'workplace' => $this->workplace,
            'password' => Hash::make($this->staff_id), // Default password is staff_id
            'role' => 'member',
        ]);

        $this->successMessage = "Member '{$this->name}' registered successfully!";
        
        // Reset form for next entry
        $this->reset(['name', 'staff_id', 'workplace']);
    }

    public function render()
    {
        return view('livewire.manual-registration');
    }
}
