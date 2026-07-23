<x-app-layout>
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>My Theses</h2>

            <a href="{{ route('hod.thesis.create') }}" class="btn btn-primary">
                Upload Thesis
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($theses->count())
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Files</th>
                            <th>Published</th>
                            <th width="220">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($theses as $thesis)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $thesis->title }}</strong>

                                    @if($thesis->description)
                                        <br>
                                        <small class="text-muted">
                                            {{ Str::limit($thesis->description, 80) }}
                                        </small>
                                    @endif
                                </td>

                                <td>{{ $thesis->author_name }}</td>

                                <td>
                                    @forelse($thesis->files as $file)
                                        <a href="{{ route('hod.thesis.view-pdf', $file) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-outline-primary mb-1">
                                            {{ $file->file_name }}
                                        </a>
                                        <br>
                                    @empty
                                        <span class="text-danger">
                                            No file
                                        </span>
                                    @endforelse
                                </td>

                                <td>
                                    {{ optional($thesis->published_at)->format('d M Y') }}
                                </td>

                                <td>
                                    <a href="{{ route('hod.thesis.edit', $thesis) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('hod.thesis.destroy', $thesis) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this thesis?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        @else
            <div class="alert alert-info">
                No theses found for your department.
            </div>
        @endif

    </div>
</x-app-layout>