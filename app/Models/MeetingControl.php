<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingControl extends Model
{
    protected $fillable = [
        'meeting_tac',
        'is_attendance_open',
        'is_voting_open',
        'active_position_id',
        'tac_expires_at',
        'meeting_date',
        'start_time',
        'end_time',
        'nomination_opens_at',
        'nomination_open_until',
    ];

    protected $casts = [
        'tac_expires_at'        => 'datetime',
        'nomination_opens_at'   => 'date',
        'nomination_open_until' => 'date',
    ];
}
