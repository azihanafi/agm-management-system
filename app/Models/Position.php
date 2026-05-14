<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    protected $fillable = ['title'];

    public function nominations(): HasMany
    {
        return $this->hasMany(Nomination::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }
}
