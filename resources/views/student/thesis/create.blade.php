<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Add Thesis</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('student.thesis.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">
                            Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Author Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="author_name"
                            class="form-control @error('author_name') is-invalid @enderror"
                            value="{{ old('author_name') }}" required>
                        @error('author_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Abstract</label>
                        <textarea name="abstract" rows="5" class="form-control @error('abstract') is-invalid @enderror">{{ old('abstract') }}</textarea>
                        @error('abstract')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="6" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Thesis File(s)
                            <span class="text-danger">*</span>
                        </label>
                        <input type="file" name="files[]" class="form-control @error('files') is-invalid @enderror"
                            accept=".pdf" multiple required>
                        <small class="text-muted">
                            Supported format: <strong>PDF</strong> only.
                            You may upload one or more PDF files.
                        </small>
                        @error('files')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror

                        @error('files.*')
                            <div class="text-danger small">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            Save Thesis
                        </button>
                        <a href="{{ route('student.thesis.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>



