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
                    <a href="{{ route('student.thesis.view-pdf', ['file' => $file->id]) }}" target="_blank"
                        class="btn btn-success btn-sm mb-1">
                        View PDF
                    </a>

                    <a href="{{ route('student.thesis.download', $file) }}" class="btn btn-primary btn-sm mb-1">
                        Download PDF
                    </a>

                    @if (in_array($thesis->id, $savedThesisIds ))
                        {{-- Already saved --}}
                        <form action="{{ route('student.saved_thesis.destroy', $thesis->id) }}" method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-primary" title="Remove saved thesis">

                                <i class="fas fa-bookmark"></i>

                            </button>

                        </form>
                    @else
                        {{-- Not saved --}}
                        <form action="{{ route('student.saved_thesis.store', $thesis->id) }}" method="POST"
                            class="d-inline">

                            @csrf

                            <button type="submit" class="btn btn-outline-primary" title="Save thesis">

                                <i class="far fa-bookmark"></i>

                            </button>

                        </form>
                    @endif
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
