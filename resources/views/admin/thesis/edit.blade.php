<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Edit Thesis</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.thesis.update', $thesis) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">
                            Title <span class="text-danger">*</span>
                        </label>

                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $thesis->title) }}" required>
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
                            value="{{ old('author_name', $thesis->author_name) }}" required>
                        @error('author_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Abstract</label>

                        <textarea name="abstract" rows="5" class="form-control @error('abstract') is-invalid @enderror">{{ old('abstract', $thesis->abstract) }}</textarea>

                        @error('abstract')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="6" class="form-control @error('description') is-invalid @enderror">{{ old('description', $thesis->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Current Thesis File(s)
                        </label>
                        @if ($thesis->files->count())
                            <ul class="list-group">
                                @foreach ($thesis->files as $file)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>
                                            📄 {{ $file->file_name }}
                                        </span>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            View
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-muted">
                                No file uploaded.
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Replace Thesis File(s)
                        </label>
                        <input type="file" name="files[]" class="form-control @error('files') is-invalid @enderror"
                            accept=".pdf" multiple>
                        <small class="text-muted">
                            Leave empty to keep the current file(s). <br>
                            Currently only <strong>PDF</strong> files are supported. Additional formats (e.g. DOCX...)
                            may be supported in future updates.
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
                            Update Thesis
                        </button>
                        <a href="{{ route('admin.thesis.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>