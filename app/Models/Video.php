<?php

// Category Model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'video_url',
        'duration_seconds',
        'order',
        'is_free_preview',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'duration_seconds' => 'integer',
            'order' => 'integer',
            'is_free_preview' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function progress()
    {
        return $this->hasMany(VideoProgress::class);
    }
}