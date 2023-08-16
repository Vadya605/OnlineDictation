<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Carbon\Carbon;

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
    use HasFactory, SoftDeletes, HasSlug;

    public function users()
    {
        return $this->belongsToMany(User::class, 'dictation_results');
    }

    public function results()
    {
        return $this->hasMany(DictationResult::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getFromDateTimeAttribute($value)
    {
       return Carbon::parse($value)->format('d.m.Y H:i');

    }

    public function getToDateTimeAttribute($value)
    {
       return Carbon::parse($value)->format('d.m.Y H:i');

    }

    public function getCreatedAtAttribute($value)
    {
       return Carbon::parse($value)->format('d.m.Y H:i');
    }
}
