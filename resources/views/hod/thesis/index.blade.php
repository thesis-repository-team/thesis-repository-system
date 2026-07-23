<x-app-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Thesis List</h2>
            <a href="{{ route('hod.thesis.create') }}" class="btn btn-primary">
                + Add Thesis
            </a>
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
                                <td>

                                    @if (auth()->user()->hod->department_id == $thesis->published_by)
                                        <a href="{{ route('hod.thesis.view-pdf', $thesis->id) }}" target="_blank"
                                            class="btn btn-success me-4">
                                            View PDF
                                        </a>
                                    @else
                                        <a href="{{ route('hod.thesis.view-pdf', $thesis->id) }}" target="_blank"
                                            class="btn btn-success me-4">
                                            View PDF
                                        </a>
                                    @endif

                                    {{-- <form action="{{ route('hod.thesis.destroy',$thesis) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this thesis?')">

                                        Delete

                                    </button>

                                </form> --}}

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
