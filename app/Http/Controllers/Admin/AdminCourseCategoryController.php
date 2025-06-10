<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminCourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CourseCategory::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Sort by latest first
        $query->orderBy('created_at', 'desc');

        $categories = $query->paginate(15)->withQueryString();

        return view('admin.course_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:course_categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean'
        ]);

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure slug is unique
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (CourseCategory::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('course-categories', 'public');
            $validated['image'] = $imagePath;
        }

        // Convert is_active to boolean
        $validated['is_active'] = (bool)$validated['is_active'];

        $category = CourseCategory::create($validated);

        return redirect()->route('admin.course-categories.index')
            ->with('success', 'Kategori kursus berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = CourseCategory::with(['courses' => function($query) {
            $query->latest()->take(10);
        }])->findOrFail($id);

        // Get statistics
        $stats = [
            'total_courses' => $category->courses()->count(),
            'published_courses' => $category->courses()->where('is_published', true)->count(),
            'draft_courses' => $category->courses()->where('is_published', false)->count(),
            'total_students' => $category->courses()->withCount('enrollments')->get()->sum('enrollments_count'),
        ];

        return view('admin.course_categories.show', compact('category', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = CourseCategory::findOrFail($id);

        return view('admin.course_categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = CourseCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:course_categories,name,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean'
        ]);

        // Update slug if name changed
        if ($validated['name'] !== $category->name) {
            $validated['slug'] = Str::slug($validated['name']);
            
            // Ensure slug is unique
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (CourseCategory::where('slug', $validated['slug'])->where('id', '!=', $category->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            
            $imagePath = $request->file('image')->store('course-categories', 'public');
            $validated['image'] = $imagePath;
        }

        // Convert is_active to boolean
        $validated['is_active'] = (bool)$validated['is_active'];

        $category->update($validated);

        return redirect()->route('admin.course-categories.index')
            ->with('success', 'Kategori kursus berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CourseCategory::findOrFail($id);

        // Check if category has courses
        if ($category->courses()->count() > 0) {
            return redirect()->route('admin.course-categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki kursus!');
        }

        // Delete image if exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $categoryName = $category->name;
        $category->delete();

        return redirect()->route('admin.course-categories.index')
            ->with('success', "Kategori {$categoryName} berhasil dihapus!");
    }

    /**
     * Toggle category active status
     */
    public function toggleStatus(string $id)
    {
        $category = CourseCategory::findOrFail($id);
        $category->update(['is_active' => !$category->is_active]);

        $status = $category->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return response()->json([
            'success' => true,
            'message' => "Kategori {$category->name} berhasil {$status}!",
            'is_active' => $category->is_active
        ]);
    }

    /**
     * Bulk actions for categories
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:course_categories,id'
        ]);

        $categoryIds = $request->category_ids;
        $action = $request->action;
        $count = 0;
        $message = '';

        switch ($action) {
            case 'activate':
                $count = CourseCategory::whereIn('id', $categoryIds)->update(['is_active' => true]);
                $message = "{$count} kategori berhasil diaktifkan!";
                break;
                
            case 'deactivate':
                $count = CourseCategory::whereIn('id', $categoryIds)->update(['is_active' => false]);
                $message = "{$count} kategori berhasil dinonaktifkan!";
                break;
                
            case 'delete':
                // Check if any category has courses
                $categoriesWithCourses = CourseCategory::whereIn('id', $categoryIds)
                    ->withCount('courses')
                    ->having('courses_count', '>', 0)
                    ->count();
                
                if ($categoriesWithCourses > 0) {
                    return redirect()->route('admin.course-categories.index')
                        ->with('error', 'Beberapa kategori tidak dapat dihapus karena masih memiliki kursus!');
                }

                // Delete images before deleting categories
                $categories = CourseCategory::whereIn('id', $categoryIds)->get();
                foreach ($categories as $category) {
                    if ($category->image) {
                        Storage::disk('public')->delete($category->image);
                    }
                }
                $count = CourseCategory::whereIn('id', $categoryIds)->delete();
                $message = "{$count} kategori berhasil dihapus!";
                break;
        }

        return redirect()->route('admin.course-categories.index')
            ->with('success', $message);
    }

    /**
     * Export categories data
     */
    public function export(Request $request)
    {
        $query = CourseCategory::query();

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $categories = $query->withCount('courses')->orderBy('created_at', 'desc')->get();

        $filename = 'course_categories_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function() use ($categories) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, ['ID', 'Nama Kategori', 'Slug', 'Total Kursus', 'Status', 'Tanggal Dibuat']);

            // Add data rows
            foreach ($categories as $category) {
                fputcsv($file, [
                    $category->id,
                    $category->name,
                    $category->slug,
                    $category->courses_count,
                    $category->is_active ? 'Aktif' : 'Nonaktif',
                    $category->created_at->format('d/m/Y H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}