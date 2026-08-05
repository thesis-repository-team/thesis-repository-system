<x-app-layout> 
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="fw-bold text-dark m-0"> Thesis Upload Requests from Students </h2>
        </div>
    </x-slot>
    <div class="container mt-5">
        @if (session('error'))
            <div class="alert alert-danger"> {{ session('error') }} </div>
        @endif
        @if ($thesisRequest)
            <div class="card shadow" style="margin-bottom: 40px;">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body d-flex flex-column h-100">
                            <h3 class="card-title fw-bold" style="font-size: 32px">{{ $thesisRequest->title }}</h3>
                            <p class="mb-1"><strong>Author(s) Name:</strong> {{ $thesisRequest->author_name }}</p>
                            <p class="mb-1"><strong>Department:</strong> {{ $thesisRequest->department->name }}
                            </p>
                            <p class="mb-1"><strong>Submitted By:</strong> {{ $thesisRequest->user->username }}</p>
                            <p class="mb-1"><strong>Verified By (HoD):</strong>
                                {{ $thesisRequest->submittedBy->full_name ?? 'N/A' }}</p>
                            </p>
                            <p class="mb-1"><strong>Submission Date:</strong> {{ $thesisRequest->submitted_at }}
                            </p> <br>
                            <p class="mb-1"><strong>Abstract:</strong></p>
                            <p style="font-size: 16px;">{{ $thesisRequest->abstract }}</p> <br>
                            <p class="mb-1"><strong>Description:</strong></p>
                            <p style="font-size: 16px;">{{ $thesisRequest->description }}</p>
                            <div class="mt-auto pt-3"> <a
                                    href="{{ route('admin.thesis_requests.view-request-pdf', $thesisRequest->id) }}"
                                    target="_blank" class="btn btn-sm mb-2 btn-outline-secondary me-2"> View PDF
                                </a>
                                <div class="d-flex gap-2"> {{-- <form action="{{ route('hod.requestsApprove', $thesisRequest->id) }}" method="POST" class="w-100"> @csrf <button class="btn btn-success w-100 btn-sm">Approve</button> </form> --}} {{-- <form action="{{ route('hod.requestsReject', $thesisRequest->id) }}" method="POST" class="w-100"> @csrf <button class="btn btn-danger w-100 btn-sm">Reject</button> </form> --}} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <h5 class="text-muted">No requests found</h5>
                <p class="text-muted small">There are currently no thesis upload requests.</p>
            </div>
        @endif

        @if ($thesisRequest && $thesisRequest->status === 'pending')
        <div class="d-flex gap-2">
            <form action="{{ route('admin.thesis_requests.approve', $thesisRequest->id) }}" method="POST" class="w-100">
                @csrf
                <button class="btn btn-success w-100 btn-sm">Approve</button>
            </form>

            <form action="{{ route('admin.thesis_requests.reject', $thesisRequest->id) }}" method="POST" class="w-100">
                @csrf
                <button class="btn btn-danger w-100 btn-sm">Reject</button>
            </form>
        </div>

        @endif
    </div>
    <style>
        .request-card {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        .request-img {
            height: 100%;
            object-fit: cover;
            border-radius: 12px 0 0 12px;
        }

        .title {
            font-size: 24px;
            color: #111827;
            margin-bottom: 10px;
        }

        .meta {
            font-size: 13px;
            color: #4b5563;
            margin-bottom: 4px;
        }

        .section-label {
            font-size: 14px;
            margin-bottom: 4px;
            color: #111827;
        }

        .text-content {
            font-size: 14px;
            color: #374151;
            margin-bottom: 8px;
        }
    </style>
</x-app-layout>
