<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictation extends Model
{
    protected $fillable = [
        'title',
        'video_link',
        'is_active',
        'description',
        'from_date_time',
        'to_date_time'
    ];
    use HasFactory;
}
