<?php

// Category Model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'video_id',
        'watched_seconds',
        'completed_at',
        'is_completed',
    ];

    protected function casts(): array
    {
        return [
            'watched_seconds' => 'integer',
            'completed_at' => 'datetime',
            'is_completed' => 'boolean',
        ];
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}