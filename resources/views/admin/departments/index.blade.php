<x-app-layout>

    @foreach ($departments as $department)
        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
            {{ $department->name }}
        </option>
        <a href="{{ route('admin.departments.edit', $department->id) }}" class="btn btn-sm btn-primary ms-2">
            Edit
        </a>
        <form action="{{ route('admin.departments.destroy', $department) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this department?');">
            @csrf
            @method('DELETE')

            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                Delete
            </button>
        </form>
    @endforeach

    <a href="{{ route('admin.departments.create') }}" class="btn btn-sm btn-primary ms-2">
        + Create Department
    </a>
</x-app-layout>
