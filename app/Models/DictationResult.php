<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictationResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dictation_id',
        'text_result',
        'date_time_result',
        'is_checked',
        'mark',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dictation()
    {
        return $this->belongsTo(Dictation::class);
    }
}
