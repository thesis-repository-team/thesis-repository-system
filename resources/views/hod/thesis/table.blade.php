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
                    <a href="{{ route('hod.thesis.view-pdf', $file) }}" target="_blank"
                        class="btn btn-success btn-sm mb-1">
                        View PDF
                    </a>
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
