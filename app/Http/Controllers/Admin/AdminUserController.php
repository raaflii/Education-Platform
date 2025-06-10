<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role') && $request->role !== 'all') {
            $query->byRole($request->role);
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

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_TEACHER, User::ROLE_STUDENT])],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean'
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Convert is_active to boolean
        $validated['is_active'] = (bool)$validated['is_active'];

        $user = User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(['createdCourses', 'enrollments', 'quizAttempts'])->findOrFail($id);

        // Get some statistics
        $stats = [
            'total_courses_created' => $user->createdCourses()->count(),
            'total_enrollments' => $user->enrollments()->count(),
            'total_quiz_attempts' => $user->quizAttempts()->count(),
            'active_enrollments' => $user->enrollments()->where('status', 'active')->count(),
        ];

        return view('admin.users.show', compact('user', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
            'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_TEACHER, User::ROLE_STUDENT])],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean'
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // Only update password if provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Convert is_active to boolean
        $validated['is_active'] = (bool)$validated['is_active'];

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting current admin user
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        // Delete avatar if exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "User {$userName} berhasil dihapus!");
    }

    /**
     * Toggle user active status
     */
    public function toggleStatus(string $id)
    {
        $user = User::findOrFail($id);

        // Prevent deactivating current admin user
        if (Auth::id() === $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menonaktifkan akun Anda sendiri!'
            ], 400);
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return response()->json([
            'success' => true,
            'message' => "User {$user->name} berhasil {$status}!",
            'is_active' => $user->is_active
        ]);
    }

    /**
     * Bulk actions for users
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        $userIds = $request->user_ids;
        $action = $request->action;

        // Remove current user from bulk actions
        $userIds = array_filter($userIds, function($id) {
            return $id != Auth::id();
        });

        if (empty($userIds)) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Tidak ada user yang valid untuk diproses!');
        }

        $count = 0;
        $message = '';

        switch ($action) {
            case 'activate':
                $count = User::whereIn('id', $userIds)->update(['is_active' => true]);
                $message = "{$count} user berhasil diaktifkan!";
                break;
                
            case 'deactivate':
                $count = User::whereIn('id', $userIds)->update(['is_active' => false]);
                $message = "{$count} user berhasil dinonaktifkan!";
                break;
                
            case 'delete':
                // Delete avatars before deleting users
                $users = User::whereIn('id', $userIds)->get();
                foreach ($users as $user) {
                    if ($user->avatar) {
                        Storage::disk('public')->delete($user->avatar);
                    }
                }
                $count = User::whereIn('id', $userIds)->delete();
                $message = "{$count} user berhasil dihapus!";
                break;
        }

        return redirect()->route('admin.users.index')
            ->with('success', $message);
    }

    /**
     * Export users data
     */
    public function export(Request $request)
    {
        $query = User::query();

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role') && $request->role !== 'all') {
            $query->byRole($request->role);
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        $filename = 'users_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, ['ID', 'Nama', 'Email', 'Role', 'Status', 'Tanggal Dibuat']);

            // Add data rows
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->getRoleDisplayName(),
                    $user->is_active ? 'Aktif' : 'Nonaktif',
                    $user->created_at->format('d/m/Y H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
