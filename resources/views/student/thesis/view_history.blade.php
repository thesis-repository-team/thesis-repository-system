<x-app-layout>

    <div class="container mt-4">

        <h2 class="mb-4">
            <i class="fas fa-history"></i>
            View History
        </h2>

        <div class="card shadow">
            <div class="card-body">

                @if ($histories->count())

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Thesis Title</th>
                                    <th>Author</th>
                                    <th>Viewed At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($histories as $history)
                                    @if ($history->thesis)
                                        <tr>

                                            {{-- Number --}}
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>

                                            {{-- Thesis --}}
                                            <td>
                                                <strong>
                                                    {{ $history->thesis->title }}
                                                </strong>
                                            </td>

                                            {{-- Author --}}
                                            <td>
                                                {{ $history->thesis->author_name }}
                                            </td>

                                            {{-- Viewed At --}}
                                            <td>
                                                <small class="text-muted">
                                                    {{ $history->viewed_at->format('M d, Y h:i A') }}
                                                </small>
                                            </td>

                                            {{-- Action --}}
                                            <td>
                                                @if ($history->thesis->files->count())
                                                    @foreach ($history->thesis->files as $file)
                                                        <a href="{{ route('student.thesis.view-pdf', ['file' => $file->id]) }}"
                                                            target="_blank" class="btn btn-success btn-sm">
                                                            <i class="fas fa-file-pdf"></i>
                                                            View PDF
                                                        </a>

                                                        <a href="{{ route('student.thesis.download', $file) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fas fa-download"></i>
                                                            Download
                                                        </a>

                                                        {{-- Saved Thesis --}}
                                                        @if (in_array($thesis->id, $savedThesisIds))
                                                            {{-- Already saved --}}
                                                            <form
                                                                action="{{ route('student.saved_thesis.destroy', $thesis->id) }}"
                                                                method="POST" class="d-inline">

                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-primary"
                                                                    title="Remove saved thesis">

                                                                    <i class="fas fa-bookmark"></i>

                                                                </button>

                                                            </form>
                                                        @else
                                                            {{-- Not saved --}}
                                                            <form
                                                                action="{{ route('student.saved_thesis.store', $thesis->id) }}"
                                                                method="POST" class="d-inline">

                                                                @csrf

                                                                <button type="submit" class="btn btn-outline-primary"
                                                                    title="Save thesis">

                                                                    <i class="far fa-bookmark"></i>

                                                                </button>

                                                            </form>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">
                                                        No PDF
                                                    </span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                @else
                    <div class="text-center py-5">

                        <i class="fas fa-history fa-3x text-muted mb-3"></i>

                        <h5>No View History</h5>

                        <p class="text-muted">
                            You have not viewed any thesis yet.
                        </p>

                        <a href="{{ route('student.thesis.index') }}" class="btn btn-dark">
                            Browse Theses
                        </a>

                    </div>

                @endif

            </div>
        </div>

    </div>

</x-app-layout>
