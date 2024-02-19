<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id', 'title', 'date', 'address', 'gmaps_link', 'capacity', 'capacity_start'
    ];
}
