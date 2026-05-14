<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paperwork extends Model
{
    protected $fillable = [
        'kepada', 'sk', 'daripada', 'tarikh', 'perkara',
        'program_title', 'program_date', 'program_day', 'program_time', 'program_location',
        'syarat_penyertaan', 'cadangan_syarat', 'status', 'current_level', 'comments'
    ];

    public function budgetItems()
    {
        return $this->hasMany(PaperworkBudgetItem::class);
    }

    public function itineraryItems()
    {
        return $this->hasMany(PaperworkItineraryItem::class);
    }
}
