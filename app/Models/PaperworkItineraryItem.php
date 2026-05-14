<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaperworkItineraryItem extends Model
{
    protected $fillable = [
        'paperwork_id', 'time', 'activity'
    ];

    public function paperwork()
    {
        return $this->belongsTo(Paperwork::class);
    }
}
