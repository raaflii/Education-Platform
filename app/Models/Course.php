<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'price',
        'teacher_id',
        'course_category_id',
        'level',
        'duration_minutes',
        'is_published',
        'is_active',
        'is_free',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'duration_minutes' => 'integer',
            'is_published' => 'boolean',
            'is_active' => 'boolean',
            'is_free' => 'boolean',
        ];
    }

    // Level constants
    const LEVEL_BEGINNER = 'beginner';
    const LEVEL_INTERMEDIATE = 'intermediate';
    const LEVEL_ADVANCED = 'advanced';

    // Relationships
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'student_id')
                    ->withPivot('enrolled_at', 'progress', 'status')
                    ->withTimestamps();
    }

    public function videos()
    {
        return $this->hasMany(Video::class)->orderBy('order');
    }

    public function materials()
    {
        return $this->hasMany(Material::class)->orderBy('order');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class)->orderBy('order');
    }

    // Scope for active courses
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Get total enrolled students
    public function getEnrolledStudentsCountAttribute()
    {
        return $this->enrollments()->where('status', 'active')->count();
    }
}