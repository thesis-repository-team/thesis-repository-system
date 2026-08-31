
@forelse ($theses as $thesis)

    <div class="admin-thesis-card">

        {{-- =====================================================
            CARD TOP
        ====================================================== --}}

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


        {{-- =====================================================
            PUBLISHED INFORMATION
        ====================================================== --}}

        <div class="admin-thesis-published">

            {{-- PUBLISHED BY --}}

            <div class="admin-thesis-published-item">

                <div class="admin-thesis-published-icon">
                    <i class="bi bi-person-check"></i>
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


            {{-- PUBLISHED AT --}}

            <div class="admin-thesis-published-item">

                <div class="admin-thesis-published-icon">
                    <i class="bi bi-calendar-check"></i>
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


        {{-- =====================================================
            CARD BODY
        ====================================================== --}}

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


        {{-- =====================================================
            FOOTER
        ====================================================== --}}

        <div class="admin-thesis-card-footer">

            {{-- VIEW PDF --}}

            <a
                href="{{ route('admin.thesis.view-pdf', $thesis->id) }}"
                target="_blank"
                class="admin-thesis-action admin-thesis-view">

                <i class="bi bi-file-earmark-pdf"></i>

                View PDF

            </a>


            {{-- DOWNLOAD --}}

            @if ($thesis->files && $thesis->files->count())

                @php
                    $file = $thesis->files->first();
                @endphp

                <a
                    href="{{ route('admin.thesis.download', $file->id) }}"
                    class="admin-thesis-action admin-thesis-download">

                    <i class="bi bi-download"></i>

                    Download

                </a>

            @else

                <span
                    class="admin-thesis-action admin-thesis-download disabled">

                    <i class="bi bi-download"></i>

                    No File

                </span>

            @endif

        </div>

    </div>

@empty

    {{-- =====================================================
        EMPTY STATE
    ====================================================== --}}

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
