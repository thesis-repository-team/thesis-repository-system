<x-app-layout>
    <div class="container py-4">
        @if (!auth()->user()->student->upload_permission)
            <div class="card border-0 shadow-sm mx-auto" style="max-width: 850px;">
                <div class="card-body p-4 p-md-5">

                    {{-- Header --}}
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <span
                                class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-25"
                                style="width: 65px; height: 65px;">
                                <span style="font-size: 30px;">🔒</span>
                            </span>
                        </div>

                        <h4 class="fw-bold text-dark mb-2">
                            Thesis Upload Permission Required
                        </h4>

                        <p class="text-muted mb-0">
                            Your account does not currently have permission to submit a thesis.
                        </p>
                    </div>

                    <hr>
                    <br>

                    {{-- Permission information --}}
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-2">
                            Why can't I submit a thesis?
                        </h3>

                        <p class="text-muted mb-0">
                            Students can only submit a thesis after receiving upload permission
                            from their Head of Department. This process helps the school maintain
                            control over thesis submissions and prevents unauthorized uploads.
                        </p>
                    </div>

                    {{-- How to get permission --}}
                    <div class="bg-light rounded-3 p-4 mb-4">
                        <h3 class="fw-bold text-dark mb-3">
                            How to get upload permission
                        </h3>

                        <p class="text-muted">
                            If you are the <strong>team leader of a fourth-year academic group thesis</strong>,
                            please go to your school and provide the following information:
                        </p>

                        <br>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="border rounded-3 bg-white p-3 h-100">
                                    <div class="fw-semibold">
                                        Account Name
                                    </div>

                                    <small class="text-muted">
                                        Your student account full name and username
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="border rounded-3 bg-white p-3 h-100">
                                    <div class="fw-semibold">
                                        Email Address
                                    </div>

                                    <small class="text-muted">
                                        The email registered in your account
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="border rounded-3 bg-white p-3 h-100">
                                    <div class="fw-semibold">
                                        Department
                                    </div>

                                    <small class="text-muted">
                                        Your current academic department
                                    </small>
                                </div>
                            </div>
                        </div>

                        <p class="text-muted mt-3 mb-0">
                            The Admin or Head of Department will review your information
                            and grant upload permission when appropriate.
                        </p>
                    </div>

                    {{-- When to submit --}}
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-2">
                            When should the thesis be submitted?
                        </h3>

                        <p class="text-muted mb-2">
                            The thesis should be submitted to the repository only after the group
                            has successfully completed the <strong>final thesis defense</strong>
                            and finished all required corrections and final printing.
                        </p>

                        <p class="text-muted mb-0">
                            At this stage, the final approved version of the thesis can be uploaded
                            by the student team leader (with upload permission), the Head of Department,
                            or the Admin.
                        </p>
                    </div>

                    {{-- Thesis submission process --}}
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-3">
                            Thesis submission process
                        </h3>

                        {{-- Step 1 --}}
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <span class="badge bg-primary rounded-circle"
                                    style="width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center;">
                                    1
                                </span>
                            </div>

                            <div>
                                <strong>
                                    Complete and pass the final defense
                                </strong>

                                <p class="text-muted mb-0 small">
                                    Complete your thesis defense and make all corrections
                                    required by your supervisor or examination committee.
                                </p>
                            </div>
                        </div>

                        {{-- Step 2 --}}
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <span class="badge bg-primary rounded-circle"
                                    style="width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center;">
                                    2
                                </span>
                            </div>

                            <div>
                                <strong>
                                    Prepare the final version
                                </strong>

                                <p class="text-muted mb-0 small">
                                    Prepare and print the final approved version of your thesis
                                    before submitting it to the repository.
                                </p>
                            </div>
                        </div>

                        {{-- Step 3 --}}
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <span class="badge bg-primary rounded-circle"
                                    style="width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center;">
                                    3
                                </span>
                            </div>

                            <div>
                                <strong>
                                    Upload the final thesis
                                </strong>

                                <p class="text-muted mb-0 small">
                                    The student team leader with upload permission, Head of Department,
                                    or Admin can upload the final thesis to the repository.
                                </p>
                            </div>
                        </div>

                        {{-- Step 4 --}}
                        <div class="d-flex">
                            <div class="me-3">
                                <span class="badge bg-primary rounded-circle"
                                    style="width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center;">
                                    4
                                </span>
                            </div>

                            <div>
                                <strong>
                                    Review and publish
                                </strong>

                                <p class="text-muted mb-0 small">
                                    The submission is reviewed by the Head of Department or Admin.
                                    Once approved, the final thesis is published in the repository.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Rejection notice --}}
                    <div class="alert alert-danger border-0 mb-0">
                        <div class="d-flex">
                            <div class="me-3 fs-4">
                                ⚠️
                            </div>

                            <div>
                                <strong>
                                    If your thesis request is rejected
                                </strong>

                                <p class="mb-0 mt-1 small">
                                    Please check the rejection comment from the Admin or Head of Department
                                    to understand what is wrong with your submission and make the necessary
                                    corrections before submitting again.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @else
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
                                            git status
                                            
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
        @endif
    </div>
</x-app-layout>
