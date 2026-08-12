<x-app-layout>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Thesis Requests</h2>
            <a href="{{ route('student.thesis_requests.create') }}" class="btn btn-primary">
                + New Request
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

        <div class="card shadow-sm">
            <div class="card-body">

                @if ($thesisRequests->count())
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Author(s) Name</th>
                                    <th>Submitted By</th>
                                    <th>Department</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Submitted at</th>
                                    <th width="180">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($thesisRequests as $thesisRequest)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            {{ $thesisRequest->author_name }}
                                        </td>
                                        <td>
                                            {{ $thesisRequest->user->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $thesisRequest->department->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $thesisRequest->title }}
                                        </td>

                                        <td>
                                            @if ($thesisRequest->status == 'pending')
                                                <span class="badge bg-warning text-dark">
                                                    Pending
                                                </span>
                                            @elseif($thesisRequest->status == 'approved')
                                                <span class="badge bg-success">
                                                    Approved
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    Rejected
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $thesisRequest->submitted_at }}
                                        </td>
                                        <td>

                                            <a href="{{ route('student.thesis_requests.show', $thesisRequest) }}"
                                                target="_blank" class="btn btn-success btn-sm mb-1">
                                                View Details
                                            </a>

                                            @if ($thesisRequest->pdf_file)
                                                <a href="{{ route('student.thesis_requests.view-request-pdf', $thesisRequest) }}"
                                                    target="_blank" class="btn btn-success btn-sm mb-1">
                                                    View PDF
                                                </a>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('thesis-requests.show', $thesisRequest->id) }}"
                                class="btn btn-info btn-sm">
                                View
                                </a>

                                <a href="{{ route('thesis-requests.edit', $thesisRequest->id) }}"
                                    class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <h5>No thesis requests found.</h5>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
