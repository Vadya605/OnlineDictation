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
        'start_date_time',
        'end_date_time'
    ];
    use HasFactory;
}
