<x-app-layout>

    <div class="dashboard-content thesis-page">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="thesis-page-header">

            {{-- =====================================================
                LEFT: BACK TO DEPARTMENTS
            ====================================================== --}}

            <div class="thesis-header-left">

                <a href="{{ route('admin.departments.index') }}"
                    class="thesis-back-link">

                    <span class="thesis-back-icon">
                        &lt;
                    </span>

                    <span>
                        Back to Departments
                    </span>

                </a>

            </div>


            {{-- =====================================================
                RIGHT: DEPARTMENT NAME
            ====================================================== --}}

            <div class="thesis-header-right">

                <span class="thesis-header-department-label">
                    DEPARTMENT
                </span>

                <h1 class="thesis-header-department-name">
                    {{ $department->name ?? 'Department' }}
                </h1>

            </div>

        </div>



        {{-- =========================================================
            RESULTS
        ========================================================== --}}

        <div class="thesis-results-wrapper">

            {{-- =====================================================
                LOADING
            ====================================================== --}}

            <div id="thesisSearchSpinner" class="thesis-loading d-none">

                <div class="thesis-spinner"></div>

                <span>
                    Loading records...
                </span>

            </div>



            {{-- =====================================================
                VIEW TOGGLE
            ====================================================== --}}

            <div class="thesis-results-toolbar">

                <div class="thesis-view-toggle">

                    <button type="button"
                        id="thesisCardViewButton"
                        class="thesis-view-button is-active"
                        aria-label="Card View">

                        <i class="bi bi-grid-3x3-gap"></i>

                        <span>
                            Cards
                        </span>

                    </button>


                    <button type="button"
                        id="thesisTableViewButton"
                        class="thesis-view-button"
                        aria-label="Table View">

                        <i class="bi bi-table"></i>

                        <span>
                            Table
                        </span>

                    </button>

                </div>

            </div>



            {{-- =====================================================
                RESULTS CONTAINER
            ====================================================== --}}

            <div id="adminThesisCards"
                class="thesis-results-container">

                @php

                    $thesisCollection = method_exists($theses, 'getCollection')
                        ? $theses->getCollection()
                        : collect($theses);

                    $groupedTheses = $thesisCollection->groupBy(function ($thesis) {
                        return optional($thesis->department)->name ?? 'No Department';
                    });

                @endphp



                {{-- =================================================
                    CARD VIEW
                ================================================== --}}

                <div class="thesis-partial-card-results">

                    @forelse ($groupedTheses as $departmentName => $departmentTheses)

                        <section class="thesis-department-section">

                            <div class="thesis-department-grid">

                                @foreach ($departmentTheses as $thesis)

                                    <div class="admin-thesis-card">

                                        {{-- CARD TOP --}}

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



                                        {{-- PUBLISHED INFORMATION --}}

                                        <div class="admin-thesis-published">

                                            {{-- PUBLISHED BY --}}

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
                                                            ?? (optional($thesis->publishedBy)->full_name ?? '—') }}

                                                    </span>

                                                </div>

                                            </div>



                                            {{-- PUBLISHED AT --}}

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



                                        {{-- CARD BODY --}}

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
                                                        ?? (optional($thesis->submittedBy)->full_name ?? '—') }}

                                                </span>

                                            </div>

                                        </div>



                                        {{-- CARD FOOTER --}}

                                        <div class="admin-thesis-card-footer">

                                            {{-- VIEW PDF --}}

                                            <a href="{{ route('admin.thesis.view-pdf', $thesis->id) }}"
                                                target="_blank"
                                                class="admin-thesis-action admin-thesis-view">

                                                <i class="bi bi-file-earmark-pdf"></i>

                                                <span>
                                                    View PDF
                                                </span>

                                            </a>



                                            {{-- DOWNLOAD --}}

                                            @if ($thesis->files && $thesis->files->count())

                                                @php
                                                    $file = $thesis->files->first();
                                                @endphp

                                                <a href="{{ route('admin.thesis.download', $file->id) }}"
                                                    class="admin-thesis-action admin-thesis-download">

                                                    <i class="bi bi-download"></i>

                                                    <span>
                                                        Download
                                                    </span>

                                                </a>

                                            @else

                                                <span class="admin-thesis-action admin-thesis-download disabled">

                                                    <i class="bi bi-download"></i>

                                                    <span>
                                                        No File
                                                    </span>

                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </section>

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



                {{-- =================================================
                    TABLE VIEW
                ================================================== --}}

                <div class="thesis-partial-table-results">

                    @forelse ($groupedTheses as $departmentName => $departmentTheses)

                        <section class="thesis-department-table-section">

                            <div class="thesis-table-wrapper">

                                <table class="thesis-table">

                                    <thead>

                                        <tr>

                                            <th>#</th>
                                            <th>Thesis</th>
                                            <th>Author</th>
                                            <th>Department</th>
                                            <th>Academic Year</th>
                                            <th>Submitted By</th>
                                            <th>Published By</th>
                                            <th>Published At</th>
                                            <th>Actions</th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @foreach ($departmentTheses as $thesis)

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
                                                        ?? (optional($thesis->submittedBy)->full_name ?? '—') }}

                                                </td>


                                                <td>

                                                    {{ optional($thesis->publishedBy)->username
                                                        ?? (optional($thesis->publishedBy)->full_name ?? '—') }}

                                                </td>


                                                <td>

                                                    {{ $thesis->published_at
                                                        ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y')
                                                        : '—' }}

                                                </td>


                                                <td>

                                                    <div class="thesis-table-actions">

                                                        <a href="{{ route('admin.thesis.view-pdf', $thesis->id) }}"
                                                            target="_blank"
                                                            class="thesis-table-action thesis-table-view"
                                                            title="View PDF"
                                                            aria-label="View PDF">

                                                            <i class="bi bi-file-earmark-pdf"></i>

                                                        </a>


                                                        @if ($thesis->files && $thesis->files->count())

                                                            @php
                                                                $file = $thesis->files->first();
                                                            @endphp

                                                            <a href="{{ route('admin.thesis.download', $file->id) }}"
                                                                class="thesis-table-action thesis-table-download"
                                                                title="Download"
                                                                aria-label="Download">

                                                                <i class="bi bi-download"></i>

                                                            </a>

                                                        @else

                                                            <span class="thesis-table-action thesis-table-download disabled"
                                                                title="No File"
                                                                aria-label="No File">

                                                                <i class="bi bi-download"></i>

                                                            </span>

                                                        @endif

                                                    </div>

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </section>

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

            </div>

        </div>

    </div>



    {{-- =============================================================
        JAVASCRIPT
    ============================================================= --}}

    <script>

        document.addEventListener('DOMContentLoaded', function() {

            let searchTimeout = null;
            let currentController = null;


            const searchInput =
                document.getElementById('search');

            const mobileSearchInput =
                document.getElementById('mobileThesisSearchInput');

            const departmentFilter =
                document.getElementById('departmentFilter');

            const yearFilter =
                document.getElementById('yearFilter');

            const resetButton =
                document.getElementById('resetFilter');

            const mobileResetButton =
                document.getElementById('mobileThesisResetFilter');

            const mobileSearchToggle =
                document.getElementById('mobileThesisSearchToggle');

            const mobileSearchPanel =
                document.getElementById('mobileThesisSearchPanel');

            const spinner =
                document.getElementById('thesisSearchSpinner');

            const thesisResultsContainer =
                document.getElementById('adminThesisCards');

            const thesisCardViewButton =
                document.getElementById('thesisCardViewButton');

            const thesisTableViewButton =
                document.getElementById('thesisTableViewButton');



            /* =====================================================
               CARD / TABLE VIEW
            ====================================================== */

            function setThesisView(view) {

                if (!thesisResultsContainer) {
                    return;
                }


                if (view === 'table') {

                    thesisResultsContainer.classList.add(
                        'table-mode'
                    );


                    if (thesisTableViewButton) {

                        thesisTableViewButton.classList.add(
                            'is-active'
                        );

                    }


                    if (thesisCardViewButton) {

                        thesisCardViewButton.classList.remove(
                            'is-active'
                        );

                    }


                    localStorage.setItem(
                        'adminThesisView',
                        'table'
                    );

                } else {

                    thesisResultsContainer.classList.remove(
                        'table-mode'
                    );


                    if (thesisCardViewButton) {

                        thesisCardViewButton.classList.add(
                            'is-active'
                        );

                    }


                    if (thesisTableViewButton) {

                        thesisTableViewButton.classList.remove(
                            'is-active'
                        );

                    }


                    localStorage.setItem(
                        'adminThesisView',
                        'cards'
                    );

                }

            }



            if (thesisCardViewButton) {

                thesisCardViewButton.addEventListener(
                    'click',
                    function() {

                        setThesisView('cards');

                    }
                );

            }


            if (thesisTableViewButton) {

                thesisTableViewButton.addEventListener(
                    'click',
                    function() {

                        setThesisView('table');

                    }
                );

            }



            const savedThesisView =
                localStorage.getItem(
                    'adminThesisView'
                );


            setThesisView(
                savedThesisView === 'table'
                    ? 'table'
                    : 'cards'
            );



            /* =====================================================
               LOAD DATA
            ====================================================== */

            function loadData() {

                if (currentController) {

                    currentController.abort();

                }


                currentController =
                    new AbortController();


                if (spinner) {

                    spinner.classList.remove(
                        'd-none'
                    );

                }


                if (thesisResultsContainer) {

                    thesisResultsContainer.classList.add(
                        'is-loading'
                    );

                }


                let currentSearch = '';


                if (window.innerWidth <= 767.98) {

                    currentSearch =
                        mobileSearchInput
                            ? mobileSearchInput.value.trim()
                            : '';

                } else {

                    currentSearch =
                        searchInput
                            ? searchInput.value.trim()
                            : '';

                }


                const query =
                    new URLSearchParams({

                        search: currentSearch,

                        department:
                            departmentFilter
                                ? departmentFilter.value
                                : '',

                        year:
                            yearFilter
                                ? yearFilter.value
                                : ''

                    });


                fetch(
                    "{{ route('admin.thesis.search') }}?" +
                    query.toString(),
                    {

                        signal:
                            currentController.signal,

                        headers: {

                            'X-Requested-With':
                                'XMLHttpRequest',

                            'Accept':
                                'text/html'

                        }

                    }
                )

                .then(function(response) {

                    if (!response.ok) {

                        throw new Error(
                            'Network response failed'
                        );

                    }


                    return response.text();

                })

                .then(function(html) {

                    if (thesisResultsContainer) {

                        thesisResultsContainer.innerHTML =
                            html;


                        const currentView =
                            localStorage.getItem(
                                'adminThesisView'
                            );


                        setThesisView(
                            currentView === 'table'
                                ? 'table'
                                : 'cards'
                        );

                    }

                })

                .catch(function(error) {

                    if (
                        error.name !==
                        'AbortError'
                    ) {

                        console.error(
                            'Error loading thesis records:',
                            error
                        );

                    }

                })

                .finally(function() {

                    if (spinner) {

                        spinner.classList.add(
                            'd-none'
                        );

                    }


                    if (thesisResultsContainer) {

                        thesisResultsContainer.classList.remove(
                            'is-loading'
                        );

                    }

                });

            }



            /* =====================================================
               DESKTOP SEARCH
            ====================================================== */

            if (searchInput) {

                searchInput.addEventListener(
                    'input',
                    function() {

                        clearTimeout(
                            searchTimeout
                        );


                        searchTimeout =
                            setTimeout(
                                loadData,
                                300
                            );

                    }
                );

            }



            /* =====================================================
               MOBILE SEARCH
            ====================================================== */

            if (mobileSearchInput) {

                mobileSearchInput.addEventListener(
                    'input',
                    function() {

                        clearTimeout(
                            searchTimeout
                        );


                        searchTimeout =
                            setTimeout(
                                loadData,
                                300
                            );

                    }
                );

            }



            /* =====================================================
               FILTERS
            ====================================================== */

            if (departmentFilter) {

                departmentFilter.addEventListener(
                    'change',
                    loadData
                );

            }


            if (yearFilter) {

                yearFilter.addEventListener(
                    'change',
                    loadData
                );

            }



            /* =====================================================
               RESET
            ====================================================== */

            function resetFilters() {

                if (searchInput) {

                    searchInput.value = '';

                }


                if (mobileSearchInput) {

                    mobileSearchInput.value = '';

                }


                if (departmentFilter) {

                    departmentFilter.value = '';

                }


                if (yearFilter) {

                    yearFilter.value = '';

                }


                loadData();

            }


            if (resetButton) {

                resetButton.addEventListener(
                    'click',
                    resetFilters
                );

            }


            if (mobileResetButton) {

                mobileResetButton.addEventListener(
                    'click',
                    resetFilters
                );

            }



            /* =====================================================
               MOBILE SEARCH TOGGLE
            ====================================================== */

            if (mobileSearchToggle) {

                mobileSearchToggle.addEventListener(
                    'click',
                    function() {

                        if (!mobileSearchPanel) {
                            return;
                        }


                        const isOpen =
                            mobileSearchPanel.classList.contains(
                                'is-open'
                            );


                        if (isOpen) {

                            mobileSearchPanel.classList.remove(
                                'is-open'
                            );


                            mobileSearchToggle.setAttribute(
                                'aria-expanded',
                                'false'
                            );


                            mobileSearchToggle.classList.remove(
                                'is-active'
                            );

                        } else {

                            mobileSearchPanel.classList.add(
                                'is-open'
                            );


                            mobileSearchToggle.setAttribute(
                                'aria-expanded',
                                'true'
                            );


                            mobileSearchToggle.classList.add(
                                'is-active'
                            );


                            setTimeout(
                                function() {

                                    if (mobileSearchInput) {

                                        mobileSearchInput.focus();

                                    }

                                },
                                150
                            );

                        }

                    }
                );

            }



            /* =====================================================
               ESCAPE
            ====================================================== */

            document.addEventListener(
                'keydown',
                function(event) {

                    if (
                        event.key === 'Escape' &&
                        mobileSearchPanel &&
                        mobileSearchPanel.classList.contains(
                            'is-open'
                        )
                    ) {

                        mobileSearchPanel.classList.remove(
                            'is-open'
                        );


                        if (mobileSearchToggle) {

                            mobileSearchToggle.setAttribute(
                                'aria-expanded',
                                'false'
                            );


                            mobileSearchToggle.classList.remove(
                                'is-active'
                            );

                        }

                    }

                }
            );



            /* =====================================================
               RESIZE
            ====================================================== */

            window.addEventListener(
                'resize',
                function() {

                    if (window.innerWidth > 767.98) {

                        if (mobileSearchPanel) {

                            mobileSearchPanel.classList.remove(
                                'is-open'
                            );

                        }


                        if (mobileSearchToggle) {

                            mobileSearchToggle.setAttribute(
                                'aria-expanded',
                                'false'
                            );


                            mobileSearchToggle.classList.remove(
                                'is-active'
                            );

                        }

                    }

                }
            );

        });

    </script>



    {{-- =============================================================
        CSS
    ============================================================= --}}

    <style>

        /* =========================================================
           COLOR SYSTEM
        ========================================================== */

        :root {

            --thesis-black: #111111;
            --thesis-white: #ffffff;

            --thesis-purple: #6538D9;
            --thesis-purple-hover: #5428C7;

            --thesis-purple-light: #F5F3FF;
            --thesis-purple-soft: #EDE9FE;

            --thesis-page-bg: #FAFAFA;
            --thesis-card-bg: #FFFFFF;
            --thesis-input-bg: #F9FAFB;

            --thesis-text: #111111;
            --thesis-text-secondary: #4B5563;
            --thesis-text-muted: #6B7280;

            --thesis-border: #111111;
            --thesis-border-soft: #E5E7EB;

            --thesis-view: #16A34A;
            --thesis-download: #2563EB;

            --thesis-shadow:
                0 8px 24px rgba(17, 17, 17, .08);

            --thesis-card-shadow:
                0 2px 10px rgba(17, 17, 17, .05);

            /* HEADER */
            --thesis-header-bg:
                linear-gradient(
                    135deg,
                    #FFFFFF 0%,
                    #FAF9FF 100%
                );

            --thesis-header-border:
                #E5E7EB;

            --thesis-header-shadow:
                0 4px 18px rgba(17, 17, 17, .06);

        }



        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] {

            --thesis-page-bg: #101426;
            --thesis-card-bg: #181D33;
            --thesis-input-bg: #20253A;

            --thesis-text: #FFFFFF;
            --thesis-text-secondary: #D5D8E8;
            --thesis-text-muted: #999FB9;

            --thesis-border-soft: #292E45;

            --thesis-purple: #7C5CE3;
            --thesis-purple-hover: #9278EA;

            --thesis-purple-light: #292342;
            --thesis-purple-soft: #342C52;

            --thesis-view: #4ADE80;
            --thesis-download: #60A5FA;

            --thesis-shadow:
                0 8px 24px rgba(0, 0, 0, .35);

            --thesis-card-shadow:
                0 2px 10px rgba(0, 0, 0, .30);

            /* HEADER */
            --thesis-header-bg:
                linear-gradient(
                    135deg,
                    #181D33 0%,
                    #1E1A35 100%
                );

            --thesis-header-border:
                #2F3550;

            --thesis-header-shadow:
                0 5px 20px rgba(0, 0, 0, .25);

        }



        [data-bs-theme="dark"] body,
        [data-bs-theme="dark"] .dashboard-content {

            background:
                var(--thesis-page-bg);

            color:
                var(--thesis-text);

        }



        /* =========================================================
           PAGE
        ========================================================== */

        .thesis-page {

            padding:
                20px;

            color:
                var(--thesis-text);

            background:
                var(--thesis-page-bg);

            transition:
                color .25s ease,
                background-color .25s ease;

        }



        /* =========================================================
           CLEAN PAGE HEADER
        ========================================================== */

        .thesis-page-header {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                2rem;

            width:
                100%;

            min-height:
                78px;

            margin:
                100px 0 24px;

            padding:
                16px 22px;

            background:
                var(--thesis-header-bg);

            border:
                1px solid var(--thesis-header-border);

            border-radius:
                14px;

            box-shadow:
                var(--thesis-header-shadow);

            box-sizing:
                border-box;

            position:
                relative;

            overflow:
                hidden;

        }



        /* subtle purple accent on the left */

        .thesis-page-header::before {

            content:
                "";

            position:
                absolute;

            top:
                0;

            left:
                0;

            width:
                4px;

            height:
                100%;

            background:
                var(--thesis-purple);

        }



        /* subtle light glow */

        .thesis-page-header::after {

            content:
                "";

            position:
                absolute;

            top:
                -80px;

            right:
                12%;

            width:
                180px;

            height:
                180px;

            background:
                rgba(101, 56, 217, .06);

            border-radius:
                50%;

            pointer-events:
                none;

        }



        /* =========================================================
           HEADER LEFT
        ========================================================== */

        .thesis-header-left {

            display:
                flex;

            align-items:
                center;

            min-width:
                0;

            position:
                relative;

            z-index:
                2;

        }



        /* =========================================================
           BACK TO DEPARTMENTS
        ========================================================== */

        .thesis-back-link {

            display:
                inline-flex;

            align-items:
                center;

            gap:
                .55rem;

            color:
                var(--thesis-text-secondary);

            text-decoration:
                none;

            font-size:
                .78rem;

            font-weight:
                800;

            transition:
                color .2s ease;

        }



        .thesis-back-icon {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            width:
                28px;

            height:
                28px;

            flex-shrink:
                0;

            color:
                var(--thesis-purple);

            background:
                var(--thesis-purple-light);

            border:
                1px solid #DDD6FE;

            border-radius:
                7px;

            font-size:
                1.2rem;

            font-weight:
                500;

            line-height:
                1;

            transition:
                color .2s ease,
                background-color .2s ease,
                transform .2s ease;

        }



        .thesis-back-link:hover {

            color:
                var(--thesis-purple);

        }



        .thesis-back-link:hover .thesis-back-icon {

            color:
                #FFFFFF;

            background:
                var(--thesis-purple);

            border-color:
                var(--thesis-purple);

            transform:
                translateX(-3px);

        }



        /* =========================================================
           HEADER RIGHT
        ========================================================== */

        .thesis-header-right {

            display:
                flex;

            flex-direction:
                column;

            align-items:
                flex-end;

            justify-content:
                center;

            min-width:
                0;

            max-width:
                55%;

            text-align:
                right;

            position:
                relative;

            z-index:
                2;

        }



        /* =========================================================
           DEPARTMENT LABEL
        ========================================================== */

        .thesis-header-department-label {

            display:
                block;

            margin-bottom:
                .2rem;

            color:
                var(--thesis-purple);

            font-size:
                .58rem;

            font-weight:
                900;

            letter-spacing:
                .14em;

            text-transform:
                uppercase;

        }



        /* =========================================================
           DEPARTMENT NAME
        ========================================================== */

        .thesis-header-department-name {

            margin:
                0;

            max-width:
                500px;

            overflow:
                hidden;

            color:
                var(--thesis-text);

            font-size:
                1.3rem;

            font-weight:
                900;

            line-height:
                1.25;

            letter-spacing:
                -.025em;

            text-align:
                right;

            text-overflow:
                ellipsis;

            white-space:
                nowrap;

        }



        /* =========================================================
           DARK HEADER
        ========================================================== */

        [data-bs-theme="dark"] .thesis-header-department-label {

            color:
                #A78BFA;

        }



        [data-bs-theme="dark"] .thesis-header-department-name {

            color:
                #FFFFFF;

        }



        [data-bs-theme="dark"] .thesis-back-icon {

            color:
                #B9A8F5;

            background:
                #292342;

            border-color:
                #403760;

        }



        [data-bs-theme="dark"] .thesis-back-link:hover .thesis-back-icon {

            color:
                #FFFFFF;

            background:
                #7C5CE3;

            border-color:
                #7C5CE3;

        }



        /* =========================================================
           FILTER
        ========================================================== */

        .thesis-filter-card {

            width:
                100%;

            margin-bottom:
                1rem;

            background:
                var(--thesis-card-bg);

            box-sizing:
                border-box;

        }



        .thesis-filter-body {

            width:
                100%;

            padding:
                1.2rem 1.25rem;

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius:
                12px;

            box-shadow:
                var(--thesis-card-shadow);

            box-sizing:
                border-box;

        }



        .thesis-filter-grid {

            display:
                grid;

            grid-template-columns:
                minmax(0, 2fr)
                minmax(180px, 1fr)
                minmax(150px, .8fr)
                120px;

            gap:
                1rem;

            align-items:
                end;

        }



        .thesis-filter-field {

            min-width:
                0;

        }



        .thesis-input-label {

            display:
                block;

            margin-bottom:
                .45rem;

            color:
                var(--thesis-text-secondary);

            font-size:
                .75rem;

            font-weight:
                800;

            letter-spacing:
                .05em;

            text-transform:
                uppercase;

        }



        .thesis-search {

            position:
                relative;

        }



        .thesis-search i {

            position:
                absolute;

            top:
                50%;

            left:
                1rem;

            z-index:
                2;

            transform:
                translateY(-50%);

            color:
                var(--thesis-purple);

            pointer-events:
                none;

        }



        .thesis-search input {

            width:
                100%;

            height:
                45px;

            padding:
                .6rem 1rem .6rem 2.75rem;

            color:
                var(--thesis-text);

            background:
                var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius:
                8px;

            outline:
                none;

            font-size:
                .9rem;

            box-sizing:
                border-box;

        }



        .thesis-search input:focus {

            border-color:
                var(--thesis-purple);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .12);

        }



        .thesis-filter-select {

            width:
                100%;

            height:
                45px;

            padding:
                .5rem 2rem .5rem .85rem;

            color:
                var(--thesis-text);

            background:
                var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius:
                8px;

            outline:
                none;

            font-size:
                .9rem;

            cursor:
                pointer;

            box-sizing:
                border-box;

        }



        .thesis-filter-select:focus {

            border-color:
                var(--thesis-purple);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .12);

        }



        .thesis-filter-select option {

            color:
                #111111;

            background:
                #FFFFFF;

        }



        [data-bs-theme="dark"] .thesis-filter-select option {

            color:
                #FFFFFF;

            background:
                #20253A;

        }



        .thesis-reset-button {

            width:
                100%;

            height:
                45px;

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                .45rem;

            color:
                var(--thesis-text-secondary);

            background:
                var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius:
                8px;

            font-size:
                .75rem;

            font-weight:
                800;

            text-transform:
                uppercase;

            cursor:
                pointer;

        }



        .thesis-reset-button:hover {

            color:
                #FFFFFF;

            background:
                var(--thesis-purple);

            border-color:
                var(--thesis-purple);

        }



        /* =========================================================
           RESULTS
        ========================================================== */

        .thesis-results-wrapper {

            position:
                relative;

            width:
                100%;

            min-height:
                100px;

        }



        .thesis-results-toolbar {

            width:
                100%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                flex-end;

            margin-bottom:
                .85rem;

        }



        /* =========================================================
           VIEW TOGGLE
        ========================================================== */

        .thesis-view-toggle {

            display:
                inline-flex;

            align-items:
                center;

            gap:
                3px;

            padding:
                3px;

            background:
                var(--thesis-purple-light);

            border:
                1px solid #DDD6FE;

            border-radius:
                8px;

        }



        .thesis-view-button {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                .4rem;

            min-width:
                82px;

            height:
                38px;

            padding:
                .4rem .75rem;

            color:
                var(--thesis-text-muted);

            background:
                transparent;

            border:
                0;

            border-radius:
                6px;

            font-size:
                .75rem;

            font-weight:
                800;

            cursor:
                pointer;

            transition:
                .2s ease;

        }



        .thesis-view-button:hover {

            color:
                var(--thesis-purple);

            background:
                var(--thesis-purple-soft);

        }



        .thesis-view-button.is-active {

            color:
                #FFFFFF;

            background:
                var(--thesis-purple);

            box-shadow:
                0 3px 8px rgba(101, 56, 217, .25);

        }



        /* =========================================================
           RESULTS CONTAINER
        ========================================================== */

        .thesis-results-container {

            position:
                relative;

            width:
                100%;

            box-sizing:
                border-box;

        }



        .thesis-results-container.is-loading {

            opacity:
                .45;

            pointer-events:
                none;

        }



        /* =========================================================
           CARD RESULTS
        ========================================================== */

        .thesis-partial-card-results {

            display:
                block;

            width:
                100%;

        }



        .thesis-department-section {

            width:
                100%;

            margin-bottom:
                2rem;

        }



        .thesis-department-section:last-child {

            margin-bottom:
                0;

        }



        /* =========================================================
           CARD GRID
        ========================================================== */

        .thesis-department-grid {

            display:
                grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap:
                1.25rem;

            width:
                100%;

        }



        /* =========================================================
           CARD
        ========================================================== */

        .admin-thesis-card {

            display:
                flex;

            flex-direction:
                column;

            min-width:
                0;

            overflow:
                hidden;

            color:
                var(--thesis-text);

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius:
                16px;

            box-shadow:
                var(--thesis-card-shadow);

            transition:
                transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease;

        }



        .admin-thesis-card:hover {

            transform:
                translateY(-5px);

            border-color:
                #D8CCFF;

            box-shadow:
                var(--thesis-shadow);

        }



        .admin-thesis-card-top {

            display:
                flex;

            align-items:
                flex-start;

            gap:
                1rem;

            padding:
                1rem;

        }



        .admin-thesis-card-heading {

            display:
                flex;

            align-items:
                center;

            gap:
                .7rem;

            min-width:
                0;

            flex:
                1;

        }



        .admin-thesis-icon {

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            width:
                34px;

            height:
                34px;

            flex-shrink:
                0;

            color:
                #FFFFFF;

            background:
                var(--thesis-purple);

            border-radius:
                9px;

            font-size:
                .85rem;

        }



        .admin-thesis-card-title {

            display:
                -webkit-box;

            margin:
                0;

            overflow:
                hidden;

            color:
                var(--thesis-text);

            font-size:
                1.05rem;

            font-weight:
                800;

            line-height:
                1.4;

            letter-spacing:
                -.02em;

            -webkit-line-clamp:
                3;

            -webkit-box-orient:
                vertical;

            word-break:
                break-word;

        }



        /* =========================================================
           PUBLISHED
        ========================================================== */

        .admin-thesis-published {

            display:
                grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap:
                .45rem;

            margin:
                0 .85rem .75rem;

            padding:
                .55rem .65rem;

            background:
                var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius:
                8px;

        }



        .admin-thesis-published-item {

            display:
                flex;

            align-items:
                center;

            gap:
                .4rem;

            min-width:
                0;

        }



        .admin-thesis-published-icon {

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            width:
                24px;

            height:
                24px;

            flex-shrink:
                0;

            color:
                var(--thesis-purple);

            background:
                var(--thesis-purple-light);

            border:
                1px solid #DDD6FE;

            border-radius:
                6px;

            font-size:
                .58rem;

        }



        .admin-thesis-published-content {

            display:
                flex;

            flex-direction:
                column;

            min-width:
                0;

            line-height:
                1.2;

        }



        .admin-thesis-published-label {

            margin-bottom:
                .08rem;

            color:
                var(--thesis-text-muted);

            font-size:
                .55rem;

            font-weight:
                800;

            text-transform:
                uppercase;

        }



        .admin-thesis-published-value {

            display:
                block;

            min-width:
                0;

            overflow:
                hidden;

            color:
                var(--thesis-text-secondary);

            font-size:
                .66rem;

            font-weight:
                700;

            text-overflow:
                ellipsis;

            white-space:
                nowrap;

        }



        /* =========================================================
           CARD BODY
        ========================================================== */

        .admin-thesis-card-body {

            display:
                flex;

            flex-direction:
                column;

            flex:
                1;

            padding:
                .15rem 1rem 1rem;

        }



        .admin-thesis-detail {

            display:
                flex;

            align-items:
                center;

            gap:
                .65rem;

            min-width:
                0;

            margin-bottom:
                .7rem;

        }



        .admin-thesis-detail-icon {

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            width:
                32px;

            height:
                32px;

            flex-shrink:
                0;

            color:
                var(--thesis-purple);

            background:
                var(--thesis-purple-light);

            border:
                1px solid #DDD6FE;

            border-radius:
                8px;

            font-size:
                .75rem;

        }



        .admin-thesis-detail-content {

            display:
                flex;

            flex-direction:
                column;

            min-width:
                0;

        }



        .admin-thesis-detail-label {

            margin-bottom:
                .1rem;

            color:
                var(--thesis-text-muted);

            font-size:
                .65rem;

            font-weight:
                800;

            letter-spacing:
                .06em;

            text-transform:
                uppercase;

        }



        .admin-thesis-detail-value {

            overflow:
                hidden;

            color:
                var(--thesis-text-secondary);

            font-size:
                .78rem;

            font-weight:
                600;

            text-overflow:
                ellipsis;

            white-space:
                nowrap;

        }



        .admin-thesis-submitted {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                1rem;

            margin-top:
                .3rem;

            padding-top:
                .8rem;

            border-top:
                1px solid var(--thesis-border-soft);

        }



        .admin-thesis-submitted-label {

            color:
                var(--thesis-text-muted);

            font-size:
                .65rem;

            font-weight:
                800;

            text-transform:
                uppercase;

        }



        .admin-thesis-submitted-value {

            min-width:
                0;

            overflow:
                hidden;

            color:
                var(--thesis-text-secondary);

            font-size:
                .78rem;

            font-weight:
                700;

            text-overflow:
                ellipsis;

            white-space:
                nowrap;

        }



        /* =========================================================
           CARD FOOTER
        ========================================================== */

        .admin-thesis-card-footer {

            display:
                flex;

            align-items:
                center;

            gap:
                .5rem;

            padding:
                .75rem;

            background:
                var(--thesis-input-bg);

            border-top:
                1px solid var(--thesis-border-soft);

        }



        .admin-thesis-action {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                .4rem;

            flex:
                1;

            min-height:
                38px;

            padding:
                .4rem .7rem;

            border-radius:
                8px;

            text-decoration:
                none;

            font-size:
                .72rem;

            font-weight:
                800;

            transition:
                .2s ease;

        }



        .admin-thesis-view {

            color:
                var(--thesis-view);

            border:
                1px solid var(--thesis-view);

        }



        .admin-thesis-view:hover {

            color:
                #FFFFFF;

            background:
                var(--thesis-view);

        }



        .admin-thesis-download {

            color:
                var(--thesis-download);

            border:
                1px solid var(--thesis-download);

        }



        .admin-thesis-download:hover {

            color:
                #FFFFFF;

            background:
                var(--thesis-download);

        }



        .admin-thesis-download.disabled {

            color:
                var(--thesis-text-muted);

            border-color:
                var(--thesis-border-soft);

            opacity:
                .5;

            pointer-events:
                none;

        }



        /* =========================================================
           EMPTY
        ========================================================== */

        .admin-thesis-empty {

            display:
                flex;

            flex-direction:
                column;

            align-items:
                center;

            justify-content:
                center;

            width:
                100%;

            min-height:
                260px;

            padding:
                2rem;

            text-align:
                center;

            color:
                var(--thesis-text);

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius:
                16px;

            box-shadow:
                var(--thesis-card-shadow);

            box-sizing:
                border-box;

        }



        .admin-thesis-empty-icon {

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            width:
                55px;

            height:
                55px;

            margin-bottom:
                1rem;

            color:
                #FFFFFF;

            background:
                var(--thesis-purple);

            border-radius:
                13px;

            font-size:
                1.25rem;

        }



        .admin-thesis-empty h3 {

            margin:
                0 0 .35rem;

            font-size:
                1rem;

            font-weight:
                800;

        }



        .admin-thesis-empty p {

            margin:
                0;

            color:
                var(--thesis-text-muted);

            font-size:
                .78rem;

        }



        /* =========================================================
           TABLE VISIBILITY
        ========================================================== */

        .thesis-partial-table-results {

            display:
                none;

            width:
                100%;

        }



        .thesis-results-container.table-mode
        .thesis-partial-card-results {

            display:
                none;

        }



        .thesis-results-container.table-mode
        .thesis-partial-table-results {

            display:
                block;

        }



        /* =========================================================
           TABLE SECTION
        ========================================================== */

        .thesis-department-table-section {

            width:
                100%;

            margin-bottom:
                1.5rem;

        }



        .thesis-department-table-section:last-child {

            margin-bottom:
                0;

        }



        /* =========================================================
           TABLE
        ========================================================== */

        .thesis-table-wrapper {

            width:
                100%;

            overflow:
                hidden;

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius:
                14px;

            box-shadow:
                var(--thesis-card-shadow);

        }



        .thesis-table {

            width:
                100%;

            table-layout:
                fixed;

            border-collapse:
                collapse;

            color:
                var(--thesis-text);

            background:
                var(--thesis-card-bg);

        }



        .thesis-table th:nth-child(1),
        .thesis-table td:nth-child(1) {
            width: 4%;
        }

        .thesis-table th:nth-child(2),
        .thesis-table td:nth-child(2) {
            width: 22%;
        }

        .thesis-table th:nth-child(3),
        .thesis-table td:nth-child(3) {
            width: 12%;
        }

        .thesis-table th:nth-child(4),
        .thesis-table td:nth-child(4) {
            width: 12%;
        }

        .thesis-table th:nth-child(5),
        .thesis-table td:nth-child(5) {
            width: 9%;
        }

        .thesis-table th:nth-child(6),
        .thesis-table td:nth-child(6) {
            width: 11%;
        }

        .thesis-table th:nth-child(7),
        .thesis-table td:nth-child(7) {
            width: 11%;
        }

        .thesis-table th:nth-child(8),
        .thesis-table td:nth-child(8) {
            width: 10%;
        }

        .thesis-table th:nth-child(9),
        .thesis-table td:nth-child(9) {
            width: 9%;
        }



        .thesis-table thead th {

            padding:
                .85rem .65rem;

            color:
                var(--thesis-text-muted);

            background:
                var(--thesis-purple-light);

            border-bottom:
                1px solid #DDD6FE;

            font-size:
                .72rem;

            font-weight:
                800;

            text-transform:
                uppercase;

            overflow-wrap:
                break-word;

        }



        .thesis-table tbody td {

            padding:
                .85rem .65rem;

            color:
                var(--thesis-text-secondary);

            background:
                var(--thesis-card-bg);

            border-bottom:
                1px solid var(--thesis-border-soft);

            font-size:
                .80rem;

            font-weight:
                600;

            line-height:
                1.45;

            vertical-align:
                middle;

            overflow-wrap:
                anywhere;

            word-break:
                break-word;

        }



        .thesis-table tbody tr:last-child td {

            border-bottom:
                0;

        }



        .thesis-table tbody tr:hover td {

            background:
                var(--thesis-purple-light);

        }



        .thesis-table-number {

            color:
                var(--thesis-purple) !important;

            font-weight:
                800 !important;

            text-align:
                center !important;

        }



        .thesis-table-title-text {

            display:
                block;

            width:
                100%;

            color:
                var(--thesis-text);

            font-size:
                .82rem;

            font-weight:
                800;

            line-height:
                1.45;

            overflow-wrap:
                anywhere;

            word-break:
                break-word;

        }



        /* =========================================================
           TABLE ACTIONS
        ========================================================== */

        .thesis-table-actions {

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                .35rem;

        }



        .thesis-table-action {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            width:
                34px;

            height:
                34px;

            min-width:
                34px;

            border-radius:
                6px;

            text-decoration:
                none;

            transition:
                .2s ease;

        }



        .thesis-table-view {

            color:
                var(--thesis-view);

            border:
                1px solid var(--thesis-view);

        }



        .thesis-table-view:hover {

            color:
                #FFFFFF;

            background:
                var(--thesis-view);

        }



        .thesis-table-download {

            color:
                var(--thesis-download);

            border:
                1px solid var(--thesis-download);

        }



        .thesis-table-download:hover {

            color:
                #FFFFFF;

            background:
                var(--thesis-download);

        }



        .thesis-table-action.disabled {

            color:
                var(--thesis-text-muted);

            border-color:
                var(--thesis-border-soft);

            opacity:
                .45;

            pointer-events:
                none;

        }



        /* =========================================================
           MOBILE SEARCH
        ========================================================== */

        .thesis-mobile-search-panel {

            display:
                none;

            margin-bottom:
                1rem;

            overflow:
                hidden;

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius:
                10px;

        }



        .thesis-mobile-search-content {

            display:
                flex;

            align-items:
                center;

            gap:
                .5rem;

            padding:
                .75rem;

        }



        .thesis-mobile-search-input {

            position:
                relative;

            flex:
                1;

        }



        .thesis-mobile-search-input i {

            position:
                absolute;

            top:
                50%;

            left:
                .85rem;

            transform:
                translateY(-50%);

            color:
                var(--thesis-purple);

        }



        .thesis-mobile-search-input input {

            width:
                100%;

            height:
                44px;

            padding:
                .5rem .75rem .5rem 2.5rem;

            color:
                var(--thesis-text);

            background:
                var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius:
                8px;

            outline:
                none;

            box-sizing:
                border-box;

        }



        .thesis-mobile-reset-button {

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            width:
                44px;

            height:
                44px;

            flex-shrink:
                0;

            color:
                var(--thesis-purple);

            background:
                var(--thesis-purple-light);

            border:
                1px solid #DDD6FE;

            border-radius:
                8px;

            cursor:
                pointer;

        }



        /* =========================================================
           LOADING
        ========================================================== */

        .thesis-loading {

            position:
                absolute;

            top:
                1rem;

            left:
                50%;

            z-index:
                50;

            display:
                flex;

            align-items:
                center;

            gap:
                .6rem;

            padding:
                .65rem .9rem;

            transform:
                translateX(-50%);

            color:
                var(--thesis-text);

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius:
                8px;

            box-shadow:
                var(--thesis-shadow);

            font-size:
                .78rem;

            font-weight:
                700;

            white-space:
                nowrap;

        }



        .thesis-spinner {

            width:
                17px;

            height:
                17px;

            border:
                2px solid var(--thesis-border-soft);

            border-top-color:
                var(--thesis-purple);

            border-radius:
                50%;

            animation:
                thesisSpin .7s linear infinite;

        }



        @keyframes thesisSpin {

            to {

                transform:
                    rotate(360deg);

            }

        }



        /* =========================================================
           1400px
        ========================================================== */

        @media (max-width: 1399.98px) {

            .thesis-department-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

            }

        }



        /* =========================================================
           1200px
        ========================================================== */

        @media (max-width: 1199.98px) {

            .thesis-filter-grid {

                grid-template-columns:
                    minmax(0, 1.5fr)
                    minmax(160px, 1fr)
                    minmax(140px, .8fr)
                    110px;

            }


            .thesis-department-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

            }


            .thesis-table thead th {

                padding:
                    .75rem .5rem;

                font-size:
                    .68rem;

            }


            .thesis-table tbody td {

                padding:
                    .75rem .5rem;

                font-size:
                    .74rem;

            }

        }



        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .thesis-page {

                padding:
                    12px;

            }


            /* HEADER */

            .thesis-page-header {

                min-height:
                    62px;

                margin:
                    70px 0 1rem;

                padding:
                    12px 14px;

                gap:
                    1rem;

                border-radius:
                    11px;

            }


            .thesis-page-header::before {

                width:
                    3px;

            }


            .thesis-header-left {

                min-width:
                    0;

            }


            .thesis-back-link {

                gap:
                    .35rem;

                font-size:
                    .68rem;

            }


            .thesis-back-icon {

                width:
                    23px;

                height:
                    23px;

                font-size:
                    1.1rem;

            }


            .thesis-header-right {

                max-width:
                    55%;

            }


            .thesis-header-department-label {

                font-size:
                    .48rem;

            }


            .thesis-header-department-name {

                max-width:
                    100%;

                font-size:
                    .85rem;

            }



            /* DEPARTMENT CARDS */

            .thesis-department-grid {

                grid-template-columns:
                    1fr;

                gap:
                    .85rem;

            }



            /* TABLE */

            .thesis-results-container.table-mode {

                width:
                    100%;

                padding:
                    0 .65rem 1rem;

                overflow:
                    hidden;

            }


            .thesis-table-wrapper {

                width:
                    100%;

                overflow:
                    hidden;

                border-radius:
                    10px;

            }


            .thesis-table {

                width:
                    100%;

                table-layout:
                    fixed;

            }


            .thesis-table th:nth-child(6),
            .thesis-table td:nth-child(6),

            .thesis-table th:nth-child(7),
            .thesis-table td:nth-child(7),

            .thesis-table th:nth-child(8),
            .thesis-table td:nth-child(8) {

                display:
                    none;

            }


            .thesis-table th:nth-child(1),
            .thesis-table td:nth-child(1) {

                width:
                    8%;

            }


            .thesis-table th:nth-child(2),
            .thesis-table td:nth-child(2) {

                width:
                    43%;

            }


            .thesis-table th:nth-child(3),
            .thesis-table td:nth-child(3) {

                width:
                    20%;

            }


            .thesis-table th:nth-child(4),
            .thesis-table td:nth-child(4) {

                width:
                    17%;

            }


            .thesis-table th:nth-child(5),
            .thesis-table td:nth-child(5) {

                width:
                    12%;

            }


            .thesis-table th:nth-child(9),
            .thesis-table td:nth-child(9) {

                display:
                    table-cell;

                width:
                    14%;

            }


            .thesis-table thead th {

                padding:
                    .65rem .3rem;

                font-size:
                    .62rem;

            }


            .thesis-table tbody td {

                padding:
                    .7rem .3rem;

                font-size:
                    .68rem;

            }


            .thesis-table-title-text {

                font-size:
                    .70rem;

            }


            .thesis-table-action {

                width:
                    28px;

                height:
                    28px;

                min-width:
                    28px;

            }

        }



        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .thesis-page-header {

                padding:
                    10px 12px;

                border-radius:
                    10px;

            }


            .thesis-back-link {

                font-size:
                    .62rem;

            }


            .thesis-back-icon {

                width:
                    20px;

                height:
                    20px;

                font-size:
                    1rem;

            }


            .thesis-header-right {

                max-width:
                    50%;

            }


            .thesis-header-department-name {

                font-size:
                    .75rem;

            }


            .admin-thesis-card-body {

                padding:
                    .15rem .9rem .9rem;

            }


            .admin-thesis-card-footer {

                padding:
                    .65rem;

            }


            .admin-thesis-action {

                min-height:
                    36px;

                font-size:
                    .66rem;

            }


            .thesis-table thead th {

                padding:
                    .6rem .25rem;

                font-size:
                    .56rem;

            }


            .thesis-table tbody td {

                padding:
                    .6rem .25rem;

                font-size:
                    .62rem;

            }


            .thesis-table-title-text {

                font-size:
                    .64rem;

            }


            .thesis-table-action {

                width:
                    25px;

                height:
                    25px;

                min-width:
                    25px;

                font-size:
                    .55rem;

            }

        }



        /* =========================================================
           REDUCED MOTION
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            .thesis-page *,
            .thesis-page *::before,
            .thesis-page *::after {

                animation-duration:
                    .01ms !important;

                animation-iteration-count:
                    1 !important;

                transition-duration:
                    .01ms !important;

            }

        }

    </style>

</x-app-layout>