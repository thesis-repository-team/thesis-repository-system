@forelse ($students as $student)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $student->full_name }}</td>
        <td>{{ $student->user->email }}</td>
        <td>
            {{ $student->department->name ?? 'N/A' }}
        </td>
        <td>{{ $student->started_year }}</td>
        <td>
            @if ($student->upload_permission)
                <span class="badge bg-success">
                    Allowed
                </span>
            @else
                <span class="badge bg-secondary">
                    not allowed
                </span>
            @endif
        </td>
        <td>
            <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-warning btn-sm">
                Edit
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center">
            No students found.
        </td>
    </tr>
@endforelse
