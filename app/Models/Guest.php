<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id', 'user_id', 'code', 'name', 'phone', 'address', 'photo'
    ];
}
