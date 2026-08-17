
<x-app-layout>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Page Header -->
                {{-- <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">📜 Thesis View History</h2>
                        <p class="text-muted mb-0">Track all the thesis documents you have opened and read.</p>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                        ← Back
                    </a>
                </div> --}}

                <!-- History List Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">

                        @if ($history->isEmpty())
                            <!-- Empty State -->
                            <div class="text-center py-5">
                                <div class="text-muted fs-1 mb-3">📂</div>
                                <h5 class="text-secondary fw-semibold">No History Found</h5>
                                <p class="text-muted small px-3">You haven't viewed any thesis documents yet. Start
                                    searching and reading!</p>
                            </div>
                        @else
                            <!-- History List Table/Group -->
                            <div class="list-group list-group-flush">
                                @foreach ($history as $item)
                                    @if ($item->thesis)
                                        <div
                                            class="list-group-item list-group-item-action p-3 d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <!-- Thesis Title Link -->
                                                <h6 class="mb-1 fw-bold text-primary">
                                                    <a href="{{ route('student.thesis.history', $item->thesis->id) }}"
                                                        class="text-decoration-none text-primary hover-underline">
                                                        {{ $item->thesis->title }}
                                                    </a>
                                                </h6>
                                                <!-- Abstract snippet or Author info -->
                                                <p class="mb-1 text-muted small text-truncate"
                                                    style="max-width: 600px;">
                                                    {{ Str::limit($item->thesis->abstract ?? 'No abstract available.', 120) }}
                                                </p>
                                            </div>

                                            <!-- Time Badge -->
                                            <div class="text-end flex-shrink-0">
                                                <span class="badge bg-light text-dark border p-2">
                                                    ⏱️
                                                    {{ $item->viewed_at ? \Carbon\Carbon::parse($item->viewed_at)->diffForHumans() : $item->created_at->diffForHumans() }}
                                                </span>
                                                <div class="text-muted extra-small mt-1" style="font-size: 0.75rem;">
                                                    {{ $item->viewed_at ? \Carbon\Carbon::parse($item->viewed_at)->format('M d, Y h:i A') : $item->created_at->format('M d, Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- @endsection --}}
</x-app-layout>
