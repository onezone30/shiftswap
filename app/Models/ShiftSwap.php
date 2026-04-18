<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[Fillable(['shift_id', 'requested_by', 'requested_to', 'reviewed_by', 'status', 'request_message', 'review_notes', 'recipient_responded_at', 'reviewed_at'])]
class ShiftSwap extends Model
{
    use HasFactory;

    protected $casts = [
        'recipient_responded_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'requested_to');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
