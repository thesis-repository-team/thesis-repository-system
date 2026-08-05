<x-app-layout>
    <div class="container mt-4">
        <form action="{{ route('student.thesis.index') }}" method="GET" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2"
                placeholder="Search by student name or department" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Thesis List</h2>
            @if (auth()->user()->student && auth()->user()->student->upload_permission)
                <a href="{{ route('student.thesis.create') }}" class="btn btn-primary"> + Request Upload Thesis </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Department</th>
                            <th>Submitted By</th>
                            <th>Published By</th>
                            <th>Published At</th>
                            <th width="170">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($theses as $thesis)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $thesis->title }}</td>
                                <td>{{ $thesis->author_name }}</td>
                                <td>{{ $thesis->department->name }}</td>
                                <td>{{ $thesis->submittedBy->name }}</td>
                                <td>
                                    {{ $thesis->publishedBy?->name }}
                                </td>
                                <td>
                                    {{ $thesis->published_at?->format('M d, Y h:i A') ?? 'Not Published' }}
                                </td>

                                {{-- Update --}}
                                <td>
                                    @if ($thesis->files->count())
                                        @foreach ($thesis->files as $file)
                                            <a href="{{ route('student.thesis.view-pdf', $file) }}" target="_blank"
                                                class="btn btn-success btn-sm mb-1">
                                                View PDF
                                            </a>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No PDF</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    No Thesis Found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
