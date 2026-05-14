<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nomination extends Model
{
    protected $fillable = [
        'nominee_id', 'nominator_id', 'position_id', 'is_disqualified', 'ceo_override'
    ];

    public function nominee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'nominee_id');
    }

    public function nominator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'nominator_id');
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
    
    public function isEligible(): bool
    {
        // Nominee must be present OR have a CEO override
        return $this->nominee->isPresent() || $this->ceo_override;
    }
}
