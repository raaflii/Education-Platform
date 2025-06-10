<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\User;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the courses.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $teachers = User::all();
        $categories = CourseCategory::all();
        return view('admin.courses.create', compact('teachers', 'categories'));
    }

    /**
     * Store a newly created course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'price' => 'required|numeric',
            'teacher_id' => 'required|exists:users,id',
            'course_category_id' => 'required|exists:course_categories,id',
            'level' => 'required|in:beginner,intermediate,advanced',
            'duration_minutes' => 'required|integer',
            'is_published' => 'boolean',
            'is_active' => 'boolean',
            'is_free' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['is_active'] = $request->has('is_active');
        $validated['is_free'] = $request->has('is_free');

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified course.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified course.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function edit(Course $course)
    {
        $teachers = User::all();
        $categories = CourseCategory::all();
        return view('admin.courses.edit', compact('course', 'teachers', 'categories'));
    }

    /**
     * Update the specified course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'price' => 'required|numeric',
            'teacher_id' => 'required|exists:users,id',
            'course_category_id' => 'required|exists:course_categories,id',
            'level' => 'required|in:beginner,intermediate,advanced',
            'duration_minutes' => 'required|integer',
            'is_published' => 'boolean',
            'is_active' => 'boolean',
            'is_free' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['is_active'] = $request->has('is_active');
        $validated['is_free'] = $request->has('is_free');

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
{
    $course->delete();

    return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
}
}