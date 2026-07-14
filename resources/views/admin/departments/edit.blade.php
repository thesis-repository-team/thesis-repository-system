<x-app-layout>
    <form method="POST" action="{{ route('admin.departments.update', $department->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Department Name</label>
            <input type="text" name="name" id="name" class="form-control" aria-describedby="emailHelp" value="{{ $department->name}}">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</x-app-layout>
