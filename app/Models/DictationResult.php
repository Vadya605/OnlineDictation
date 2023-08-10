<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class DictationResult extends Model
{
    use HasFactory, HasSlug;


    protected $fillable = [
        'user_id',
        'dictation_id',
        'text_result',
        'date_time_result',
        'is_checked',
        'mark',
        'slug'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dictation()
    {
        return $this->belongsTo(Dictation::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['dictation.title', 'user.name'])
            ->saveSlugsTo('slug');
    }
}
