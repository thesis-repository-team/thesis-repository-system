<x-app-layout>
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Submit Thesis Request</h3>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('student.thesis_requests.store') }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Author(s) Name -->
                    <div class="mb-3">
                        <label class="form-label">Author(s) Name</label>
                        <input type="text"
                               name="author_name"
                               class="form-control"
                               value="{{ old('author_name') }}"
                               required>
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label">Thesis Title</label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               value="{{ old('title') }}"
                               required>
                    </div>

                    <!-- Abstract -->
                    <div class="mb-3">
                        <label class="form-label">Abstract</label>
                        <textarea name="abstract"
                                  rows="5"
                                  class="form-control"
                                  required>{{ old('abstract') }}</textarea>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description"
                                  rows="4"
                                  class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <!-- PDF File -->
                    <div class="mb-3">
                        <label class="form-label">Upload Thesis (PDF)</label>
                        <input type="file"
                               name="pdf_file"
                               class="form-control"
                               accept=".pdf"
                               required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('student.thesis_requests.index') }}"
                           class="btn btn-secondary me-2">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Submit Request
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>