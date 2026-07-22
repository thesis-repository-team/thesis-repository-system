<x-app-layout>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name"
                            class="form-control @error('full_name') is-invalid @enderror"
                            value="{{ $student->full_name }}" required>
                        @error('full_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ $student->user->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username', $student->user->username) }}" required>
                        @error('username ')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Status</label>
                        <select name="is_active" class="form-select">
                            <option value="1"
                                {{ old('upload_permission', $student->upload_permission) == 1 ? 'selected' : '' }}>
                                Allowed
                            </option>
                            <option value="0"
                                {{ old('upload_permission', $student->upload_permission) == 0 ? 'selected' : '' }}>
                                Not Allowed
                            </option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary me-2">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Save Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
