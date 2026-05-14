<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'staff_id', 'workplace', 'password', 'role', 'is_new_member'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function attendance(): HasOne
    {
        return $this->hasOne(Attendance::class);
    }

    public function nominations(): HasMany
    {
        return $this->hasMany(Nomination::class, 'nominee_id');
    }

    public function votesCast(): HasMany
    {
        return $this->hasMany(Vote::class, 'voter_id');
    }
    
    public function isPresent(): bool
    {
        return $this->attendance()
            ->whereDate('scanned_at', now())
            ->where('status', 'present')
            ->exists();
    }
}
