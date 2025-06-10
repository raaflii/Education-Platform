@extends('layouts.admin')

@section('title', 'Kelola Kategori Kursus')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Kategori Kursus</h1>
        <div>
            <a href="{{ route('admin.course-categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                + Tambah Kategori
            </a>
            <a href="{{ route('admin.course-categories.export', request()->query()) }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition ml-2">
                Ekspor Data
            </a>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form action="{{ route('admin.course-categories.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Kategori</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama kategori..." 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition mr-2">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('admin.course-categories.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Form Bulk Actions -->
    <form method="POST" action="{{ route('admin.course-categories.bulk-action') }}" id="bulkForm">
        @csrf
        <div class="flex items-center mb-4">
            <select name="action" class="mr-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Aksi Masal</option>
                <option value="activate">Aktifkan</option>
                <option value="deactivate">Nonaktifkan</option>
                <option value="delete">Hapus</option>
            </select>
            <button type="button" onclick="confirmBulkAction()" class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-800 transition">
                Terapkan
            </button>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-10">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Kursus</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" class="categoryCheckbox">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($category->image)
                                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-10 h-10 rounded-md object-cover mr-3">
                                    @endif
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $category->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $category->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->courses_count }} Kursus
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.course-categories.show', $category->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Detail</a>
                                <a href="{{ route('admin.course-categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <button type="button" onclick="toggleStatus({{ $category->id }})" class="text-gray-600 hover:text-gray-900">
                                    {{ $category->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data kategori ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </form>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>

<script>
    // Toggle select all checkbox
    document.getElementById('selectAll').addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('.categoryCheckbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = e.target.checked;
        });
    });

    // Toggle status
    function toggleStatus(id) {
        fetch(`{{ url('admin/course-categories') }}/${id}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }

    // Confirm bulk action
    function confirmBulkAction() {
        const form = document.getElementById('bulkForm');
        const action = form.action.value;
        const checked = document.querySelectorAll('.categoryCheckbox:checked').length > 0;
        
        if (!action) {
            alert('Silakan pilih aksi');
            return;
        }
        
        if (!checked) {
            alert('Silakan pilih minimal satu kategori');
            return;
        }
        
        if (action === 'delete' && !confirm('Apakah Anda yakin ingin menghapus kategori terpilih? Data tidak dapat dikembalikan.')) {
            return;
        }
        
        form.submit();
    }
</script>
@endsection