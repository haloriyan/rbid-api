<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id', 'guest_id', 'schedule_id', 'has_checked_in', 'has_viewed_on_screen'
    ];

    public function guest() {
        return $this->belongsTo(Guest::class, 'guest_id');
    }
}
