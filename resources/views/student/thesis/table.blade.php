<div class="thesis-partial-card-results">

    @forelse ($theses as $thesis)

        @php
            $publishedBy = $thesis->publishedBy;

            $isApprovedByAdminOrHod =
                $thesis->published_at &&
                $publishedBy &&
                in_array($publishedBy->role, ['admin', 'hod'], true);

            $publishedByName =
                optional($publishedBy)->username ??
                optional($publishedBy)->full_name ??
                '—';

            $savedThesisIds = $savedThesisIds ?? [];

            $isSaved = in_array(
                $thesis->id,
                $savedThesisIds
            );
        @endphp

        @if ($isApprovedByAdminOrHod)

            <div class="admin-thesis-card">

                <div class="admin-thesis-card-top">

                    <div class="admin-thesis-card-heading">

                        <div class="admin-thesis-icon">
                            <i class="bi bi-journal-text"></i>
                        </div>

                        <h3 class="admin-thesis-card-title">
                            {{ $thesis->title }}
                        </h3>

                    </div>


                    <button
                        type="button"
                        class="thesis-save-button {{ $isSaved ? 'saved' : '' }}"
                        data-thesis-id="{{ $thesis->id }}"
                        data-save-url="{{ route('student.saved_thesis.store', $thesis) }}"
                        data-remove-url="{{ route('student.saved_thesis.destroy', $thesis) }}"
                        title="{{ $isSaved ? 'Remove from Saved' : 'Save Thesis' }}"
                        aria-label="{{ $isSaved ? 'Remove from Saved' : 'Save Thesis' }}"
                    >
                        <i class="bi {{ $isSaved ? 'bi-bookmark-fill' : 'bi-bookmark' }}"></i>
                    </button>

                </div>


                <div class="admin-thesis-published">

                    <div class="admin-thesis-published-item">

                        <div class="admin-thesis-published-icon">
                            <i class="bi bi-person-check"></i>
                        </div>

                        <div class="admin-thesis-published-content">

                            <span class="admin-thesis-published-label">
                                Approved By
                            </span>

                            <span class="admin-thesis-published-value">
                                {{ $publishedByName }}
                            </span>

                        </div>

                    </div>


                    <div class="admin-thesis-published-item">

                        <div class="admin-thesis-published-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>

                        <div class="admin-thesis-published-content">

                            <span class="admin-thesis-published-label">
                                Approved At
                            </span>

                            <span class="admin-thesis-published-value">
                                {{ $thesis->published_at
                                    ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y')
                                    : '—' }}
                            </span>

                        </div>

                    </div>

                </div>


                <div class="admin-thesis-card-body">

                    <div class="admin-thesis-detail">

                        <div class="admin-thesis-detail-icon">
                            <i class="bi bi-person"></i>
                        </div>

                        <div class="admin-thesis-detail-content">

                            <span class="admin-thesis-detail-label">
                                Author
                            </span>

                            <span class="admin-thesis-detail-value">
                                {{ $thesis->author_name ?? '—' }}
                            </span>

                        </div>

                    </div>


                    <div class="admin-thesis-detail">

                        <div class="admin-thesis-detail-icon">
                            <i class="bi bi-building"></i>
                        </div>

                        <div class="admin-thesis-detail-content">

                            <span class="admin-thesis-detail-label">
                                Department
                            </span>

                            <span class="admin-thesis-detail-value">
                                {{ optional($thesis->department)->name ?? '—' }}
                            </span>

                        </div>

                    </div>


                    <div class="admin-thesis-detail">

                        <div class="admin-thesis-detail-icon">
                            <i class="bi bi-calendar3"></i>
                        </div>

                        <div class="admin-thesis-detail-content">

                            <span class="admin-thesis-detail-label">
                                Academic Year
                            </span>

                            <span class="admin-thesis-detail-value">
                                {{ $thesis->academic_year ?? '—' }}
                            </span>

                        </div>

                    </div>


                    <div class="admin-thesis-submitted">

                        <span class="admin-thesis-submitted-label">
                            Submitted By
                        </span>

                        <span class="admin-thesis-submitted-value">
                            {{ optional($thesis->submittedBy)->username
                                ?? optional($thesis->submittedBy)->full_name
                                ?? '—' }}
                        </span>

                    </div>

                </div>


                <div class="admin-thesis-card-footer">

                    <a
                        href="{{ route('student.thesis.show', $thesis->id) }}"
                        class="admin-thesis-action admin-thesis-view"
                    >
                        <i class="bi bi-file-text"></i>

                        <span>
                            View Detail
                        </span>
                    </a>


                    @if ($thesis->files && $thesis->files->count())

                        @php
                            $file = $thesis->files->first();
                        @endphp

                        <a
                            href="{{ route('student.thesis.view-pdf', $file->id) }}"
                            target="_blank"
                            class="admin-thesis-action admin-thesis-download"
                        >
                            <i class="bi bi-file-earmark-pdf"></i>

                            <span>
                                PDF
                            </span>
                        </a>

                    @else

                        <span class="admin-thesis-action admin-thesis-download disabled">

                            <i class="bi bi-file-earmark-pdf"></i>

                            <span>
                                No File
                            </span>

                        </span>

                    @endif

                </div>

            </div>

        @endif

    @empty

        <div class="admin-thesis-empty">

            <div class="admin-thesis-empty-icon">
                <i class="bi bi-journal-x"></i>
            </div>

            <h3>
                No Thesis Found
            </h3>

            <p>
                There are no approved thesis records matching your search or filters.
            </p>

        </div>

    @endforelse

</div>


<div class="thesis-partial-table-results">

    <div class="thesis-table-wrapper">

        <table class="thesis-table">

            <thead>

                <tr>

                    <th>
                        #
                    </th>

                    <th>
                        Thesis
                    </th>

                    <th>
                        Author
                    </th>

                    <th>
                        Department
                    </th>

                    <th>
                        Academic Year
                    </th>

                    <th>
                        Submitted By
                    </th>

                    <th>
                        Approved By
                    </th>

                    <th>
                        Approved At
                    </th>

                    <th>
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($theses as $thesis)

                    @php
                        $publishedBy = $thesis->publishedBy;

                        $isApprovedByAdminOrHod =
                            $thesis->published_at &&
                            $publishedBy &&
                            in_array($publishedBy->role, ['admin', 'hod'], true);

                        $publishedByName =
                            optional($publishedBy)->username ??
                            optional($publishedBy)->full_name ??
                            '—';

                        $savedThesisIds = $savedThesisIds ?? [];

                        $isSaved = in_array(
                            $thesis->id,
                            $savedThesisIds
                        );
                    @endphp

                    @if ($isApprovedByAdminOrHod)

                        <tr>

                            <td class="thesis-table-number">
                                {{ $loop->iteration }}
                            </td>


                            <td class="thesis-table-title-cell">

                                <span class="thesis-table-title-text">
                                    {{ $thesis->title }}
                                </span>

                            </td>


                            <td>
                                {{ $thesis->author_name ?? '—' }}
                            </td>


                            <td>
                                {{ optional($thesis->department)->name ?? '—' }}
                            </td>


                            <td>
                                {{ $thesis->academic_year ?? '—' }}
                            </td>


                            <td>
                                {{ optional($thesis->submittedBy)->username
                                    ?? optional($thesis->submittedBy)->full_name
                                    ?? '—' }}
                            </td>


                            <td>
                                {{ $publishedByName }}
                            </td>


                            <td>
                                {{ $thesis->published_at
                                    ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y')
                                    : '—' }}
                            </td>


                            <td>

                                <div class="thesis-table-actions">

                                    <button
                                        type="button"
                                        class="thesis-save-button {{ $isSaved ? 'saved' : '' }}"
                                        data-thesis-id="{{ $thesis->id }}"
                                        data-save-url="{{ route('student.saved_thesis.store', $thesis) }}"
                                        data-remove-url="{{ route('student.saved_thesis.destroy', $thesis) }}"
                                        title="{{ $isSaved ? 'Remove from Saved' : 'Save Thesis' }}"
                                        aria-label="{{ $isSaved ? 'Remove from Saved' : 'Save Thesis' }}"
                                    >
                                        <i class="bi {{ $isSaved ? 'bi-bookmark-fill' : 'bi-bookmark' }}"></i>
                                    </button>


                                    <a
                                        href="{{ route('student.thesis.show', $thesis->id) }}"
                                        class="thesis-table-action thesis-table-view"
                                        title="View Thesis"
                                        aria-label="View Thesis"
                                    >
                                        <i class="bi bi-file-text"></i>
                                    </a>


                                    @if ($thesis->files && $thesis->files->count())

                                        @php
                                            $file = $thesis->files->first();
                                        @endphp

                                        <a
                                            href="{{ route('student.thesis.view-pdf', $file->id) }}"
                                            target="_blank"
                                            class="thesis-table-action thesis-table-download"
                                            title="View PDF"
                                            aria-label="View PDF"
                                        >
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </a>

                                    @else

                                        <span
                                            class="thesis-table-action thesis-table-download disabled"
                                            title="No File"
                                            aria-label="No File"
                                        >
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </span>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @endif

                @empty

                    <tr>

                        <td
                            colspan="9"
                            class="thesis-table-empty"
                        >
                            <strong>
                                No Thesis Found
                            </strong>

                            <span>
                                There are no approved thesis records matching your search or filters.
                            </span>
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<style>

    .admin-thesis-card-top {
        position: relative;
    }


    .thesis-save-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        min-width: 36px;
        padding: 0;
        flex-shrink: 0;
        color: var(--thesis-purple);
        background: transparent;
        border: 1px solid var(--thesis-purple);
        border-radius: 8px;
        cursor: pointer;
        font-size: .85rem;
        transition:
            color .2s ease,
            background-color .2s ease,
            border-color .2s ease,
            transform .2s ease,
            box-shadow .2s ease;
    }


    .thesis-save-button:hover {
        color: #FFFFFF;
        background: var(--thesis-purple);
        border-color: var(--thesis-purple);
        transform: translateY(-1px);
        box-shadow:
            0 4px 10px rgba(101, 56, 217, .20);
    }


    .thesis-save-button.saved {
        color: #FFFFFF;
        background: var(--thesis-purple);
        border-color: var(--thesis-purple);
        box-shadow:
            0 3px 8px rgba(101, 56, 217, .18);
    }


    .thesis-save-button.saved:hover {
        color: #FFFFFF;
        background: var(--thesis-purple-hover);
        border-color: var(--thesis-purple-hover);
    }


    .thesis-save-button.is-saving {
        opacity: .6;
        pointer-events: none;
        transform: none;
    }


    [data-bs-theme="dark"] .thesis-save-button {
        color: #C4B5FD;
        background: transparent;
        border-color: #7C5CE3;
    }


    [data-bs-theme="dark"] .thesis-save-button:hover {
        color: #FFFFFF;
        background: var(--thesis-purple);
        border-color: var(--thesis-purple);
    }


    [data-bs-theme="dark"] .thesis-save-button.saved {
        color: #FFFFFF;
        background: var(--thesis-purple);
        border-color: var(--thesis-purple);
    }


    [data-bs-theme="dark"] .thesis-save-button.saved:hover {
        background: var(--thesis-purple-hover);
        border-color: var(--thesis-purple-hover);
    }


    @media (max-width: 767.98px) {

        .thesis-save-button {
            width: 34px;
            height: 34px;
            min-width: 34px;
            border-radius: 7px;
            font-size: .78rem;
        }

    }


    @media (max-width: 575.98px) {

        .thesis-save-button {
            width: 32px;
            height: 32px;
            min-width: 32px;
            font-size: .72rem;
        }

    }

</style>