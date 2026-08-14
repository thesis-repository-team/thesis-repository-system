<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="fw-bold text-dark m-0"> Thesis Upload Requests from Students </h2>
        </div>
    </x-slot>
    <div class="container mt-5">

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
        @if ($thesisRequest)
            <div class="card shadow-sm border-0 request-detail-card mb-4">

                <div class="card-body p-4 p-md-5">

                    {{-- Header with status --}}
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">

                        <div>
                            <h2 class="fw-bold text-dark mb-2 request-title">
                                {{ $thesisRequest->title }}
                            </h2>

                            <div class="text-muted small">
                                Request ID: #{{ $thesisRequest->id }}
                            </div>
                        </div>

                        <div>

                            @if ($thesisRequest->status === 'approved')
                                <span class="badge bg-success px-3 py-2 fs-6 rounded-pill">
                                    Approved
                                </span>
                            @elseif($thesisRequest->status === 'pending')
                                <span class="badge bg-warning text-dark px-3 py-2 fs-6 rounded-pill">
                                    Pending
                                </span>
                            @else
                                <span class="badge bg-danger px-3 py-2 fs-6 rounded-pill">
                                    Rejected
                                </span>
                            @endif

                        </div>
                    </div>

                    {{-- Information --}}
                    <div class="row g-4 mb-4">

                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Author(s) Name</div>
                                <div class="info-value">{{ $thesisRequest->author_name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Department</div>
                                <div class="info-value">{{ $thesisRequest->department->name }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Submitted By</div>
                                <div class="info-value">{{ $thesisRequest->user->username }}</div>
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Verified By</div>
                                <div class="info-value">
                                    {{ $thesis?->publishedBy?->name ?? 'Not yet verified' }}
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Reviewed By</div>
                                <div class="info-value">
                                    {{ $thesisRequest->reviewer?->name ?? 'Not yet reviewed' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Submitted At</div>
                                <div class="info-value">
                                    {{ $thesisRequest->submitted_at?->format('F d, Y h:i A') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Reviewed At</div>
                                <div class="info-value">
                                    {{ $thesisRequest->reviewed_at?->format('F d, Y h:i A') ?? 'Not yet reviewed' }}
                                </div>
                            </div>
                        </div>


                    </div>

                    <hr class="my-4">

                    {{-- Abstract --}}
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3">Abstract</h5>

                        <div class="text-content">
                            {{ $thesisRequest->abstract }}
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3">Description</h5>

                        <div class="text-content">
                            {{ $thesisRequest->description }}
                        </div>
                    </div>

                    {{-- PDF --}}
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <a href="{{ route('student.thesis_requests.view-request-pdf', $thesisRequest) }}"
                            target="_blank" class="btn btn-outline-primary">
                            View PDF
                        </a>
                    </div>

                    {{-- Rejection reason --}}
                    @if ($thesisRequest->status === 'rejected')
                        <div class="alert alert-danger border-0 rejection-box mt-4 mb-0">
                            <div class="d-flex align-items-start gap-3">
                                <div class="fs-3">⚠️</div>
                                <div>
                                    <h5 class="fw-bold mb-2 text-danger">
                                        Thesis Request Rejected
                                    </h5>

                                    <p class="mb-1">
                                        <strong>Rejected By:</strong>
                                        {{ $thesisRequest->reviewer?->name ?? 'Unknown' }}
                                    </p>

                                    <p class="mb-2">
                                        <strong>Rejection Reason:</strong>
                                    </p>

                                    <p class="mb-0">
                                        {{ $thesisRequest->remarks ?? 'No rejection reason provided.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <h5 class="text-muted">No requests found</h5>
                <p class="text-muted small">
                    There are currently no thesis upload requests.
                </p>
            </div>
        @endif
    </div>
    <style>
        .request-detail-card {
            border-radius: 18px;
        }

        .request-title {
            font-size: 2rem;
            line-height: 1.25;
        }

        .info-item {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 16px;
            height: 100%;
        }

        .info-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .03em;
        }

        .info-value {
            font-size: 1rem;
            color: #111827;
            font-weight: 500;
        }

        .text-content {
            font-size: 1rem;
            line-height: 1.8;
            color: #374151;
            text-align: justify;
            white-space: pre-line;
        }

        .rejection-box {
            border-radius: 14px;
            background: #fef2f2;
            border-left: 5px solid #dc2626 !important;
        }
    </style>
</x-app-layout>
