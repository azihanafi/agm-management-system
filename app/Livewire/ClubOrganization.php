<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\ClubOfficial;

class ClubOrganization extends Component
{
    public $selectedMemberId;
    public $selectedDesignation;
    public $officials;
    public $members;

    public $designations = [];

    public function mount()
    {
        $this->loadDesignations();
        $this->loadData();
    }

    public function loadDesignations()
    {
        $core = [
            'PENGERUSI',
            'TIMBALAN PENGERUSI',
            'SETIAUSAHA',
            'PENOLONG SETIAUSAHA',
            'BENDAHARI',
            'PEMEGANG AMANAH',
            'JURUAUDIT'
        ];
        
        $custom = \App\Models\Position::pluck('title')->toArray();
        
        $this->designations = array_unique(array_merge($core, $custom));
    }

    public function loadData()
    {
        $this->officials = ClubOfficial::with('user')->orderBy('sort_order')->get();
        $this->members = User::where('role', 'member')->get();
    }

    public function addOfficial()
    {
        $this->validate([
            'selectedMemberId' => 'required|exists:users,id',
            'selectedDesignation' => 'required',
        ]);

        ClubOfficial::create([
            'user_id' => $this->selectedMemberId,
            'designation' => $this->selectedDesignation,
            'sort_order' => ClubOfficial::count() + 1
        ]);

        $this->reset(['selectedMemberId', 'selectedDesignation']);
        $this->loadData();
        session()->flash('message', 'Official added successfully!');
    }

    public function removeOfficial($id)
    {
        ClubOfficial::destroy($id);
        $this->loadData();
    }

    public function moveUp($id)
    {
        $official = ClubOfficial::find($id);
        $previous = ClubOfficial::where('sort_order', '<', $official->sort_order)->orderBy('sort_order', 'desc')->first();
        
        if ($previous) {
            $oldOrder = $official->sort_order;
            $official->update(['sort_order' => $previous->sort_order]);
            $previous->update(['sort_order' => $oldOrder]);
        }
        $this->loadData();
    }

    public function moveDown($id)
    {
        $official = ClubOfficial::find($id);
        $next = ClubOfficial::where('sort_order', '>', $official->sort_order)->orderBy('sort_order', 'asc')->first();
        
        if ($next) {
            $oldOrder = $official->sort_order;
            $official->update(['sort_order' => $next->sort_order]);
            $next->update(['sort_order' => $oldOrder]);
        }
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.club-organization');
    }
}
