<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaperworkBudgetItem extends Model
{
    protected $fillable = [
        'paperwork_id', 'description', 'price', 'quantity', 'unit', 'total_price'
    ];

    public function paperwork()
    {
        return $this->belongsTo(Paperwork::class);
    }
}
