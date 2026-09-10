<div class="thesis-partial-card-results">

    @forelse ($theses as $thesis)

        <div class="admin-thesis-card">

            {{-- =================================================
                CARD TOP
            ================================================== --}}

            <div class="admin-thesis-card-top">

                <div class="admin-thesis-card-heading">

                    <div class="admin-thesis-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>

                    <h3 class="admin-thesis-card-title">
                        {{ $thesis->title }}
                    </h3>

                </div>

            </div>


            {{-- =================================================
                PUBLISHED
            ================================================== --}}

            <div class="admin-thesis-published">

                <div class="admin-thesis-published-item">

                    <div class="admin-thesis-published-icon">
                        <i class="bi bi-person"></i>
                    </div>

                    <div class="admin-thesis-published-content">

                        <span class="admin-thesis-published-label">
                            Published By
                        </span>

                        <span class="admin-thesis-published-value">

                            {{ optional($thesis->publishedBy)->username
                                ?? optional($thesis->publishedBy)->full_name
                                ?? '—' }}

                        </span>

                    </div>

                </div>


                <div class="admin-thesis-published-item">

                    <div class="admin-thesis-published-icon">
                        <i class="bi bi-calendar3"></i>
                    </div>

                    <div class="admin-thesis-published-content">

                        <span class="admin-thesis-published-label">
                            Published At
                        </span>

                        <span class="admin-thesis-published-value">

                            {{ $thesis->published_at
                                ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y')
                                : '—' }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================================
                CARD BODY
            ================================================== --}}

            <div class="admin-thesis-card-body">

                {{-- AUTHOR --}}

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


                {{-- DEPARTMENT --}}

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


                {{-- ACADEMIC YEAR --}}

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


                {{-- SUBMITTED BY --}}

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


            {{-- =================================================
                CARD FOOTER
            ================================================== --}}

            <div class="admin-thesis-card-footer">

                <a
                    href="{{ route('admin.thesis.view-pdf', $thesis->id) }}"
                    target="_blank"
                    class="admin-thesis-action admin-thesis-view"
                >

                    <i class="bi bi-file-earmark-pdf"></i>

                    <span>
                        View PDF
                    </span>

                </a>


                @if ($thesis->files && $thesis->files->count())

                    @php
                        $file = $thesis->files->first();
                    @endphp

                    <a
                        href="{{ route('hod.thesis.download', $file->id) }}"
                        class="admin-thesis-action admin-thesis-download"
                    >

                        <i class="bi bi-download"></i>

                        <span>
                            Download
                        </span>

                    </a>

                @else

                    <span
                        class="admin-thesis-action admin-thesis-download disabled"
                    >

                        <i class="bi bi-download"></i>

                        <span>
                            No File
                        </span>

                    </span>

                @endif

            </div>

        </div>

    @empty

        <div class="admin-thesis-empty">

            <div class="admin-thesis-empty-icon">

                <i class="bi bi-journal-x"></i>

            </div>

            <h3>
                No Thesis Found
            </h3>

            <p>
                There are no thesis records matching your search or filters.
            </p>

        </div>

    @endforelse

</div>



{{-- =========================================================
    TABLE VIEW
    NO DECORATIVE ICONS
    NO HORIZONTAL SCROLL
========================================================= --}}

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
                        Published By
                    </th>

                    <th>
                        Published At
                    </th>

                    <th>
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($theses as $thesis)

                    <tr>

                        {{-- NUMBER --}}

                        <td class="thesis-table-number">
                            {{ $loop->iteration }}
                        </td>


                        {{-- TITLE --}}

                        <td class="thesis-table-title-cell">

                            <span class="thesis-table-title-text">
                                {{ $thesis->title }}
                            </span>

                        </td>


                        {{-- AUTHOR --}}

                        <td>

                            {{ $thesis->author_name ?? '—' }}

                        </td>


                        {{-- DEPARTMENT --}}

                        <td>

                            {{ optional($thesis->department)->name ?? '—' }}

                        </td>


                        {{-- ACADEMIC YEAR --}}

                        <td>

                            {{ $thesis->academic_year ?? '—' }}

                        </td>


                        {{-- SUBMITTED BY --}}

                        <td>

                            {{ optional($thesis->submittedBy)->username
                                ?? optional($thesis->submittedBy)->full_name
                                ?? '—' }}

                        </td>


                        {{-- PUBLISHED BY --}}

                        <td>

                            {{ optional($thesis->publishedBy)->username
                                ?? optional($thesis->publishedBy)->full_name
                                ?? '—' }}

                        </td>


                        {{-- PUBLISHED AT --}}

                        <td>

                            {{ $thesis->published_at
                                ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y')
                                : '—' }}

                        </td>


                        {{-- ACTIONS --}}

                        <td>

                            <div class="thesis-table-actions">

                                {{-- VIEW PDF --}}

                                <a
                                    href="{{ route('hod.thesis.view-pdf', $thesis->id) }}"
                                    target="_blank"
                                    class="thesis-table-action thesis-table-view"
                                    title="View PDF"
                                    aria-label="View PDF"
                                >

                                    <i class="bi bi-file-earmark-pdf"></i>

                                </a>


                                {{-- DOWNLOAD --}}

                                @if ($thesis->files && $thesis->files->count())

                                    @php
                                        $file = $thesis->files->first();
                                    @endphp

                                    <a
                                        href="{{ route('hod.thesis.download', $file->id) }}"
                                        class="thesis-table-action thesis-table-download"
                                        title="Download"
                                        aria-label="Download"
                                    >

                                        <i class="bi bi-download"></i>

                                    </a>

                                @else

                                    <span
                                        class="thesis-table-action thesis-table-download disabled"
                                        title="No File"
                                        aria-label="No File"
                                    >

                                        <i class="bi bi-download"></i>

                                    </span>

                                @endif

                            </div>

                        </td>

                    </tr>

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
                                There are no thesis records matching your search or filters.
                            </span>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>