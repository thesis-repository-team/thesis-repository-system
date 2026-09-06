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

        {{-- ================= ACTION ================= --}}
        <td class="thesis-action-cell">
            @if ($thesis->files->count())
                <div class="thesis-action-buttons">

                    @foreach ($thesis->files as $file)
                        {{-- View PDF --}}
                        <a href="{{ route('student.thesis.view-pdf', ['file' => $file->id]) }}" target="_blank"
                            class="thesis-action-btn thesis-view-btn" title="View PDF">
                            <i class="fas fa-eye"></i>
                            <span>View</span>
                        </a>

                        {{-- Download PDF --}}
                        <a href="{{ route('student.thesis.download', $file) }}"
                            class="thesis-action-btn thesis-download-btn" title="Download PDF">
                            <i class="fas fa-download"></i>
                            <span>Download</span>
                        </a>

                        {{-- Save / Remove --}}
                        @if (in_array($thesis->id, $savedThesisIds))
                            {{-- Already saved --}}
                            <form action="{{ route('student.saved_thesis.destroy', $thesis->id) }}" method="POST"
                                class="thesis-save-form">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="thesis-action-btn thesis-saved-btn"
                                    title="Remove saved thesis">
                                    <i class="fas fa-bookmark"></i>
                                    <span>Saved</span>
                                </button>

                            </form>
                        @else
                            {{-- Not saved --}}
                            <form action="{{ route('student.saved_thesis.store', $thesis->id) }}" method="POST"
                                class="thesis-save-form">

                                @csrf

                                <button type="submit" class="thesis-action-btn thesis-save-btn" title="Save thesis">
                                    <i class="far fa-bookmark"></i>
                                    <span>Save</span>
                                </button>

                            </form>
                        @endif
                    @endforeach

                </div>
            @else
                <span class="thesis-no-pdf">
                    <i class="fas fa-file-circle-xmark"></i>
                    No PDF
                </span>
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


{{-- =========================================================
     ACTION BUTTON STYLE
     ONLY FOR THE ACTION COLUMN
========================================================= --}}
<style>
    .thesis-action-cell {
        min-width: 210px;
        vertical-align: middle;
    }

    .thesis-action-buttons {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
        gap: 6px;
    }

    .thesis-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;

        min-height: 34px;
        padding: 6px 10px;

        border-radius: 7px;
        border: 1px solid transparent;

        font-size: 12px;
        font-weight: 600;
        line-height: 1;
        text-decoration: none;

        cursor: pointer;
        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            transform 0.15s ease,
            box-shadow 0.2s ease;
    }

    .thesis-action-btn i {
        font-size: 13px;
        line-height: 1;
    }

    .thesis-action-btn:hover {
        transform: translateY(-1px);
        text-decoration: none;
    }

    .thesis-action-btn:active {
        transform: translateY(0);
    }

    /* ================= VIEW ================= */

    .thesis-view-btn {
        background: #198754;
        border-color: #198754;
        color: #fff;
    }

    .thesis-view-btn:hover {
        background: #157347;
        border-color: #157347;
        color: #fff;
        box-shadow: 0 3px 8px rgba(25, 135, 84, 0.22);
    }

    /* ================= DOWNLOAD ================= */

    .thesis-download-btn {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .thesis-download-btn:hover {
        background: #0b5ed7;
        border-color: #0b5ed7;
        color: #fff;
        box-shadow: 0 3px 8px rgba(13, 110, 253, 0.22);
    }

    /* ================= SAVE ================= */

    .thesis-save-btn {
        background: transparent;
        border-color: #0d6efd;
        color: #0d6efd;
    }

    .thesis-save-btn:hover {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
        box-shadow: 0 3px 8px rgba(13, 110, 253, 0.18);
    }

    /* ================= SAVED ================= */

    .thesis-saved-btn {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .thesis-saved-btn:hover {
        background: #0b5ed7;
        border-color: #0b5ed7;
        color: #fff;
        box-shadow: 0 3px 8px rgba(13, 110, 253, 0.22);
    }

    /* ================= FORM ================= */

    .thesis-save-form {
        display: inline-flex;
        margin: 0;
        padding: 0;
    }

    /* ================= NO PDF ================= */

    .thesis-no-pdf {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        color: #6c757d;
        font-size: 13px;
        font-weight: 500;
    }

    .thesis-no-pdf i {
        font-size: 13px;
    }

    /* =====================================================
       MOBILE
    ===================================================== */

    @media (max-width: 768px) {

        .thesis-action-cell {
            min-width: 170px;
        }

        .thesis-action-buttons {
            gap: 5px;
        }

        .thesis-action-btn {
            min-height: 32px;
            padding: 6px 8px;
            font-size: 11px;
            border-radius: 6px;
        }

        .thesis-action-btn i {
            font-size: 12px;
        }
    }

    /* =====================================================
       SMALL MOBILE
    ===================================================== */

    @media (max-width: 480px) {

        .thesis-action-cell {
            min-width: 150px;
        }

        .thesis-action-buttons {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            width: 100%;
            gap: 5px;
        }

        .thesis-action-btn {
            width: 100%;
            min-height: 32px;
            padding: 6px 7px;
        }

        .thesis-save-form {
            width: 100%;
        }

        .thesis-save-form .thesis-action-btn {
            width: 100%;
        }
    }
</style>



{{-- Method 2 --}}
 
{{--
@forelse($theses as $thesis)
    <tr>
        <td>{{ $loop->iteration }}</td>

        <td>{{ $thesis->title }}</td>

        <td>{{ $thesis->author_name }}</td>

        <td>{{ $thesis->department->name }}</td>

        <td>{{ $thesis->submittedBy->name }}</td>

        <td>{{ $thesis->publishedBy?->name ?? 'Not Published' }}</td>

        <td>
            {{ $thesis->published_at?->format('M d, Y h:i A') ?? 'Not Published' }}
        </td>

        <td class="thesis-action-cell">
            @if ($thesis->files->count())
                <div class="thesis-action-buttons">

                    @foreach ($thesis->files as $file)
                        <a href="{{ route('student.thesis.view-pdf', ['file' => $file->id]) }}"
                            target="_blank"
                            class="thesis-action-btn thesis-view-btn"
                            title="View PDF">
                            <i class="fas fa-eye"></i>
                            <span>View</span>
                        </a>

                        <a href="{{ route('student.thesis.download', $file) }}"
                            class="thesis-action-btn thesis-download-btn"
                            title="Download PDF">
                            <i class="fas fa-download"></i>
                            <span>Download</span>
                        </a>

                        @if (in_array($thesis->id, $savedThesisIds))
                            <form action="{{ route('student.saved_thesis.destroy', $thesis->id) }}"
                                method="POST"
                                class="thesis-save-form">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="thesis-action-btn thesis-saved-btn"
                                    title="Remove saved thesis">
                                    <i class="fas fa-bookmark"></i>
                                    <span>Saved</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('student.saved_thesis.store', $thesis->id) }}"
                                method="POST"
                                class="thesis-save-form">

                                @csrf

                                <button type="submit"
                                    class="thesis-action-btn thesis-save-btn"
                                    title="Save thesis">
                                    <i class="far fa-bookmark"></i>
                                    <span>Save</span>
                                </button>
                            </form>
                        @endif
                    @endforeach

                </div>
            @else
                <span class="thesis-no-pdf">
                    <i class="fas fa-file-circle-xmark"></i>
                    No PDF
                </span>
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

<style>
    .thesis-action-cell {
        min-width: 250px;
        width: 250px;
        vertical-align: middle;
        white-space: nowrap;
    }

    .thesis-action-buttons {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: nowrap;
        gap: 6px;
        width: max-content;
    }

    .thesis-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        min-height: 34px;
        padding: 6px 9px;
        border-radius: 7px;
        border: 1px solid transparent;
        font-size: 12px;
        font-weight: 600;
        line-height: 1;
        text-decoration: none;
        white-space: nowrap;
        cursor: pointer;
        flex-shrink: 0;
        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            transform 0.15s ease,
            box-shadow 0.2s ease;
    }

    .thesis-action-btn i {
        font-size: 13px;
        line-height: 1;
        flex-shrink: 0;
    }

    .thesis-action-btn:hover {
        transform: translateY(-1px);
        text-decoration: none;
    }

    .thesis-action-btn:active {
        transform: translateY(0);
    }

    .thesis-view-btn {
        background: #198754;
        border-color: #198754;
        color: #fff;
    }

    .thesis-view-btn:hover {
        background: #157347;
        border-color: #157347;
        color: #fff;
        box-shadow: 0 3px 8px rgba(25, 135, 84, 0.22);
    }

    .thesis-download-btn {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .thesis-download-btn:hover {
        background: #0b5ed7;
        border-color: #0b5ed7;
        color: #fff;
        box-shadow: 0 3px 8px rgba(13, 110, 253, 0.22);
    }

    .thesis-save-btn {
        background: transparent;
        border-color: #0d6efd;
        color: #0d6efd;
    }

    .thesis-save-btn:hover {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
        box-shadow: 0 3px 8px rgba(13, 110, 253, 0.18);
    }

    .thesis-saved-btn {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .thesis-saved-btn:hover {
        background: #0b5ed7;
        border-color: #0b5ed7;
        color: #fff;
        box-shadow: 0 3px 8px rgba(13, 110, 253, 0.22);
    }

    .thesis-save-form {
        display: inline-flex;
        align-items: center;
        margin: 0;
        padding: 0;
        flex-shrink: 0;
    }

    .thesis-save-form .thesis-action-btn {
        margin: 0;
    }

    .thesis-no-pdf {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #6c757d;
        font-size: 13px;
        font-weight: 500;
        white-space: nowrap;
    }

    .thesis-no-pdf i {
        font-size: 13px;
    }

    @media (max-width: 768px) {
        .thesis-action-cell {
            min-width: 230px;
            width: 230px;
            white-space: nowrap;
        }

        .thesis-action-buttons {
            display: flex;
            flex-wrap: nowrap;
            align-items: center;
            gap: 4px;
            width: max-content;
        }

        .thesis-action-btn {
            min-height: 32px;
            padding: 6px 7px;
            font-size: 11px;
            border-radius: 6px;
        }

        .thesis-action-btn i {
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .thesis-action-cell {
            min-width: 220px;
            width: 220px;
            white-space: nowrap;
        }

        .thesis-action-buttons {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            gap: 4px;
            width: max-content;
        }

        .thesis-action-btn {
            min-height: 30px;
            padding: 5px 6px;
            font-size: 10px;
            border-radius: 6px;
        }

        .thesis-action-btn i {
            font-size: 11px;
        }

        .thesis-save-form {
            display: inline-flex;
            width: auto;
            flex-shrink: 0;
        }

        .thesis-save-form .thesis-action-btn {
            width: auto;
        }
    }
</style> 
--}}


