<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'slug', 'title',
        'groom_name', 'groom_photo', 'groom_father', 'groom_mother',
        'bride_name', 'bride_photo', 'bride_father', 'bride_mother',
        'stream_url', 'background_music', 'template', 'timezone', 'whatsapp_invitation_body', 'fees_paid_by',
        'status'
    ];

    public function galleries() {
        return $this->hasMany(Gallery::class, 'wedding_id');
    }
}
