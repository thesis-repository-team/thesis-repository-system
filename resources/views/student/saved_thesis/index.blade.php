<x-app-layout>

    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-bookmark"></i>
                Saved Theses
            </h2>

            <a href="{{ route('student.thesis.index') }}"
               class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Back to Theses
            </a>
        </div>

        {{-- Success message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Info message --}}
        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    My Saved Theses
                </h5>
            </div>

            <div class="card-body">

                @forelse($savedTheses as $saved)

                    @if($saved->thesis)

                        <div class="border-bottom py-3">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    {{-- Thesis title --}}
                                    <h5 class="mb-2">
                                        {{ $saved->thesis->title }}
                                    </h5>

                                    {{-- Author --}}
                                    @if($saved->thesis->author_name)
                                        <p class="mb-1">
                                            <strong>Author:</strong>
                                            {{ $saved->thesis->author_name }}
                                        </p>
                                    @endif

                                    {{-- Department --}}
                                    @if($saved->thesis->department)
                                        <p class="mb-1">
                                            <strong>Department:</strong>
                                            {{ $saved->thesis->department->dept_name }}
                                        </p>
                                    @endif

                                    {{-- Saved date --}}
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-clock"></i>
                                        Saved:
                                        {{ $saved->saved_at
                                            ? $saved->saved_at->format('d M Y, h:i A')
                                            : $saved->created_at->format('d M Y, h:i A') }}
                                    </p>

                                </div>

                                <div class="d-flex gap-2">

                                    {{-- View thesis --}}
                                    <a href="{{ route('student.thesis.show', $saved->thesis->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>

                                    {{-- Remove saved thesis --}}
                                    <form action="{{ route('student.saved_thesis.destroy', $saved->thesis->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to remove this thesis from your saved theses?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                            Remove
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endif

                @empty

                    <div class="text-center py-5">

                        <i class="fas fa-bookmark fa-3x text-muted mb-3"></i>

                        <h5>No Saved Theses</h5>

                        <p class="text-muted">
                            You have not saved any theses yet.
                        </p>

                        

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>

