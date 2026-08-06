@forelse($hods as $hod)
    <tr>
        <td>
            {{ $loop->iteration }}
        </td>

        <td>
            {{ $hod->full_name }}
        </td>

        <td>
            {{ $hod->user->email }}
        </td>

        <td>
            {{ $hod->department->name ?? 'N/A' }}
        </td>

        <td>
            {{ $hod->started_year }}
        </td>

        <td>
            @if ($hod->is_active)
                <span class="badge bg-success">
                    Active
                </span>
            @else
                <span class="badge bg-secondary">
                    Inactive
                </span>
            @endif
        </td>
        
        <td>
            <a href="{{ route('admin.hods.edit', $hod->id) }}" class="btn btn-warning btn-sm">
                Edit
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center">
            No HoD of department found.
        </td>
    </tr>
@endforelse
