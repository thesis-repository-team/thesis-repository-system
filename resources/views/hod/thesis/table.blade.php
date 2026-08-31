
@forelse($theses as $thesis)

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


            {{-- STATUS --}}

            <div class="admin-thesis-status">

                <span class="admin-thesis-status-badge approved">

                    <i class="bi bi-check-circle-fill"></i>

                    Published

                </span>

            </div>

        </div>


        {{-- =====================================================
            PUBLISHED INFORMATION
        ====================================================== --}}

        <div class="admin-thesis-published">


            {{-- AUTHOR --}}

            <div class="admin-thesis-published-item">

                <div class="admin-thesis-published-icon">

                    <i class="bi bi-person"></i>

                </div>

                <div class="admin-thesis-published-content">

                    <span class="admin-thesis-published-label">
                        Author
                    </span>

                    <span class="admin-thesis-published-value">

                        {{ $thesis->author_name }}

                    </span>

                </div>

            </div>


            {{-- DEPARTMENT --}}

            <div class="admin-thesis-published-item">

                <div class="admin-thesis-published-icon">

                    <i class="bi bi-building"></i>

                </div>

                <div class="admin-thesis-published-content">

                    <span class="admin-thesis-published-label">
                        Department
                    </span>

                    <span class="admin-thesis-published-value">

                        {{ $thesis->department?->name ?? 'N/A' }}

                    </span>

                </div>

            </div>

        </div>


        {{-- =====================================================
            CARD BODY
        ====================================================== --}}

        <div class="admin-thesis-card-body">


            {{-- =================================================
                SUBMITTED BY
            ================================================== --}}

            <div class="admin-thesis-detail">

                <div class="admin-thesis-detail-icon">

                    <i class="bi bi-person-check"></i>

                </div>

                <div class="admin-thesis-detail-content">

                    <span class="admin-thesis-detail-label">
                        Submitted By
                    </span>

                    <span class="admin-thesis-detail-value">

                        {{ $thesis->submittedBy?->name ?? 'N/A' }}

                    </span>

                </div>

            </div>


            {{-- =================================================
                PUBLISHED BY
            ================================================== --}}

            <div class="admin-thesis-detail">

                <div class="admin-thesis-detail-icon">

                    <i class="bi bi-person-badge"></i>

                </div>

                <div class="admin-thesis-detail-content">

                    <span class="admin-thesis-detail-label">
                        Published By
                    </span>

                    <span class="admin-thesis-detail-value">

                        {{ $thesis->publishedBy?->name ?? 'N/A' }}

                    </span>

                </div>

            </div>


            {{-- =================================================
                PUBLISHED AT
            ================================================== --}}

            <div class="admin-thesis-detail">

                <div class="admin-thesis-detail-icon">

                    <i class="bi bi-calendar3"></i>

                </div>

                <div class="admin-thesis-detail-content">

                    <span class="admin-thesis-detail-label">
                        Published At
                    </span>

                    <span class="admin-thesis-detail-value">

                        {{ $thesis->published_at?->format('M d, Y h:i A') ?? 'Not Published' }}

                    </span>

                </div>

            </div>


            {{-- =================================================
                REQUEST INFORMATION
            ================================================== --}}

            <div class="admin-thesis-submitted">

                <span class="admin-thesis-submitted-label">

                    Thesis No.

                </span>

                <span class="admin-thesis-submitted-value">

                    #{{ $loop->iteration }}

                </span>

            </div>

        </div>


        {{-- =====================================================
            FOOTER / PDF ACTIONS
        ====================================================== --}}

        <div class="admin-thesis-card-footer">

            @if ($thesis->files->count())

                @foreach ($thesis->files as $file)

                    {{-- VIEW PDF --}}

                    <a
                        href="{{ route('hod.thesis.view-pdf', $file) }}"
                        target="_blank"
                        class="admin-thesis-action admin-thesis-view">

                        <i class="bi bi-eye"></i>

                        <span>
                            View PDF
                        </span>

                    </a>


                    {{-- DOWNLOAD PDF --}}

                    <a
                        href="{{ route('hod.thesis.download', $file) }}"
                        class="admin-thesis-action admin-thesis-download">

                        <i class="bi bi-download"></i>

                        <span>
                            Download
                        </span>

                    </a>

                @endforeach

            @else

                <span
                    class="admin-thesis-action admin-thesis-download disabled">

                    <i class="bi bi-file-earmark-x"></i>

                    <span>
                        No PDF
                    </span>

                </span>

            @endif

        </div>

    </div>

@empty

    {{-- =========================================================
        EMPTY STATE
    ========================================================== --}}

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

