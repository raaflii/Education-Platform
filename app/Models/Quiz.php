<?php

// Category Model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'time_limit_minutes',
        'max_attempts',
        'passing_score',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'time_limit_minutes' => 'integer',
            'max_attempts' => 'integer',
            'passing_score' => 'decimal:2',
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}