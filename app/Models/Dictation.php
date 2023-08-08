<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Dictation extends Model
{
    protected $fillable = [
        'title',
        'video_link',
        'is_active',
        'description',
        'from_date_time',
        'to_date_time',
        'slug',
        'answer'
    ];
    use HasFactory;
    use SoftDeletes;

    public function users()
    {
        return $this->belongsToMany(User::class, 'dictation_results');
    }

    public function results()
    {
        return $this->hasMany(DictationResult::class);
    }
}
