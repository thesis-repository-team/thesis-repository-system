<x-app-layout>

    @foreach ($departments as $department)
        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
            {{ $department->name }}
        </option>
    @endforeach
    {{-- <button type="button" class="btn btn-primary" ><a href="route{{ 'admin.departments.create'}}"></a>Create Department</button> --}}
    <a href="{{ route('admin.departments.create') }}" class="btn btn-sm btn-primary ms-2">
                + Create Department
            </a>
</x-app-layout>
