
<x-app-layout>

    <div class="dashboard-content thesis-page">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="thesis-page-header">

            <div class="thesis-header-content">

                <div class="thesis-title-row">

                    <div>

                        <span class="thesis-overline">
                            MANAGEMENT
                        </span>

                        <h1 class="thesis-title">
                            My Theses
                        </h1>

                    </div>

                </div>

            </div>

        </div>

        {{-- =========================================================
            RESULTS
        ========================================================== --}}

        <div class="thesis-results-wrapper">

            {{-- LOADING --}}

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

                    <button
                        type="button"
                        id="thesisCardViewButton"
                        class="thesis-view-button is-active"
                        aria-label="Card View">

                        <i class="bi bi-grid-3x3-gap"></i>

                        <span>
                            Cards
                        </span>

                    </button>


                    <button
                        type="button"
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
                RESULTS
            ====================================================== --}}

            <div id="adminThesisCards" class="thesis-results-container">


                {{-- =================================================
                    CARD RESULTS
                ================================================== --}}

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
                                                ?? (optional($thesis->publishedBy)->full_name ?? '—') }}

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
                                            ?? (optional($thesis->submittedBy)->full_name ?? '—') }}

                                    </span>

                                </div>

                            </div>


                            {{-- =================================================
                                CARD FOOTER
                            ================================================== --}}

                            <div class="admin-thesis-card-footer">


                                {{-- =================================================
                                    EDIT
                                ================================================== --}}

                                <a
                                    href="{{ route('hod.thesis.edit', $thesis->id) }}"
                                    class="admin-thesis-action admin-thesis-edit">

                                    <i class="bi bi-pencil-square"></i>

                                    <span>
                                        Edit
                                    </span>

                                </a>


                                {{-- =================================================
                                    DELETE
                                ================================================== --}}

                                <form
                                    action="{{ route('hod.thesis.destroy', $thesis->id) }}"
                                    method="POST"
                                    class="admin-thesis-delete-form"
                                    onsubmit="return confirm('Are you sure you want to delete this thesis?');">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="admin-thesis-action admin-thesis-delete">

                                        <i class="bi bi-trash3"></i>

                                        <span>
                                            Delete
                                        </span>

                                    </button>

                                </form>

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


                {{-- =================================================
                    TABLE RESULTS
                ================================================== --}}

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
                                                ?? (optional($thesis->submittedBy)->full_name ?? '—') }}

                                        </td>


                                        {{-- PUBLISHED BY --}}

                                        <td>

                                            {{ optional($thesis->publishedBy)->username
                                                ?? (optional($thesis->publishedBy)->full_name ?? '—') }}

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


                                                {{-- EDIT --}}

                                                <a
                                                    href="{{ route('hod.thesis.edit', $thesis->id) }}"
                                                    class="thesis-table-action thesis-table-edit"
                                                    title="Edit"
                                                    aria-label="Edit">

                                                    <i class="bi bi-pencil-square"></i>

                                                </a>


                                                {{-- DELETE --}}

                                                <form
                                                    action="{{ route('hod.thesis.destroy', $thesis->id) }}"
                                                    method="POST"
                                                    class="thesis-table-delete-form"
                                                    onsubmit="return confirm('Are you sure you want to delete this thesis?');">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="thesis-table-action thesis-table-delete"
                                                        title="Delete"
                                                        aria-label="Delete">

                                                        <i class="bi bi-trash3"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="9"
                                            class="thesis-table-empty">

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

            </div>

        </div>

    </div>


    {{-- =============================================================
        JAVASCRIPT
    ============================================================= --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

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


            /* =====================================================
               VIEW BUTTONS
            ====================================================== */

            if (thesisCardViewButton) {

                thesisCardViewButton.addEventListener(
                    'click',
                    function () {

                        setThesisView('cards');

                    }
                );

            }


            if (thesisTableViewButton) {

                thesisTableViewButton.addEventListener(
                    'click',
                    function () {

                        setThesisView('table');

                    }
                );

            }


            /* =====================================================
               RESTORE SAVED VIEW
            ====================================================== */

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
                    "{{ route('hod.thesis.search') }}?" +
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

                .then(function (response) {

                    if (!response.ok) {

                        throw new Error(
                            'Network response failed'
                        );

                    }


                    return response.text();

                })

                .then(function (html) {

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

                .catch(function (error) {

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

                .finally(function () {

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
                    function () {

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
                    function () {

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
                    function () {

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
                                function () {

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
                function (event) {

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
                function () {

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


            /* EDIT BLUE */

            --thesis-edit: #2563EB;

            --thesis-edit-hover: #1D4ED8;


            /* DELETE RED */

            --thesis-delete: #DC2626;

            --thesis-delete-hover: #B91C1C;


            --thesis-pending-text: #92400E;

            --thesis-pending-bg: #FEF3C7;

            --thesis-approved-text: #166534;

            --thesis-approved-bg: #DCFCE7;

            --thesis-refused-text: #991B1B;

            --thesis-refused-bg: #FEE2E2;


            --thesis-shadow:
                0 8px 24px rgba(17, 17, 17, .08);

            --thesis-card-shadow:
                0 2px 10px rgba(17, 17, 17, .05);

            --thesis-primary: #6538D9;

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

            --thesis-primary: #6538D9;


            --thesis-purple: #7C5CE3;

            --thesis-purple-hover: #9278EA;

            --thesis-purple-light: #292342;

            --thesis-purple-soft: #342C52;


            /* DARK EDIT BLUE */

            --thesis-edit: #60A5FA;

            --thesis-edit-hover: #3B82F6;


            /* DARK DELETE RED */

            --thesis-delete: #F87171;

            --thesis-delete-hover: #EF4444;


            --thesis-pending-text: #FCD34D;

            --thesis-pending-bg: #422006;

            --thesis-approved-text: #86EFAC;

            --thesis-approved-bg: #14532D;

            --thesis-refused-text: #FCA5A5;

            --thesis-refused-bg: #450A0A;


            --thesis-shadow:
                0 8px 24px rgba(0, 0, 0, .35);

            --thesis-card-shadow:
                0 2px 10px rgba(0, 0, 0, .30);

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

            padding: 20px;

            color:
                var(--thesis-text);

            background:
                var(--thesis-page-bg);

            transition:
                color .25s ease,
                background-color .25s ease;

        }


        /* =========================================================
           HEADER
        ========================================================== */

        .thesis-page-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 1rem;

            padding: 15px;

            margin: 100px 0 20px;

            background:
                var(--thesis-page-bg);

            box-sizing: border-box;

        }


        [data-bs-theme="dark"] .thesis-page-header {

            background: #171B30;

        }


        .thesis-header-content {

            min-width: 0;

            flex: 1;

        }


        .thesis-title-row {

            display: flex;

            align-items: center;

        }


        /* =========================================================
           TITLE
        ========================================================== */

        .thesis-overline {

            display: block;

            margin-bottom: .2rem;

            color:
                var(--thesis-purple);

            font-size: .72rem;

            font-weight: 800;

            letter-spacing: .13em;

            line-height: 1.2;

            text-transform: uppercase;

        }


        .thesis-title {

            margin: 0;

            color:
                var(--thesis-text);

            font-size: 1.9rem;

            font-weight: 700;

            line-height: 1.2;

            letter-spacing: -.035em;

        }


        [data-bs-theme="dark"] .thesis-title {

            color: #FFFFFF;

        }


        /* =========================================================
           RESULTS
        ========================================================== */

        .thesis-results-wrapper {

            position: relative;

            width: 100%;

            min-height: 100px;

            box-sizing: border-box;

        }


        .thesis-results-toolbar {

            width: 100%;

            display: flex;

            align-items: center;

            justify-content: flex-end;

            margin-top: 1rem;

            margin-bottom: .85rem;

            padding: 0;

            box-sizing: border-box;

        }


        /* =========================================================
           CARD / TABLE TOGGLE
        ========================================================== */

        .thesis-view-toggle {

            display: inline-flex;

            align-items: center;

            gap: 3px;

            padding: 3px;

            background:
                var(--thesis-purple-light);

            border:
                1px solid #DDD6FE;

            border-radius: 8px;

        }


        .thesis-view-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            min-width: 82px;

            height: 38px;

            padding: .4rem .75rem;

            color:
                var(--thesis-text-muted);

            background:
                transparent;

            border: 0;

            border-radius: 6px;

            font-size: .75rem;

            font-weight: 800;

            letter-spacing: .03em;

            text-transform: uppercase;

            cursor: pointer;

            transition: .2s ease;

        }


        .thesis-view-button:hover {

            color:
                var(--thesis-purple);

            background:
                var(--thesis-purple-soft);

        }


        .thesis-view-button.is-active {

            color: #FFFFFF;

            background:
                var(--thesis-purple);

            box-shadow:
                0 3px 8px rgba(101, 56, 217, .25);

        }


        [data-bs-theme="dark"] .thesis-view-toggle {

            background: #292342;

            border-color: #403765;

        }


        [data-bs-theme="dark"] .thesis-view-button {

            color: #999FB9;

        }


        [data-bs-theme="dark"] .thesis-view-button:hover {

            color: #C4B5FD;

            background: #342C52;

        }


        [data-bs-theme="dark"] .thesis-view-button.is-active {

            color: #FFFFFF;

            background:
                var(--thesis-purple);

        }


        /* =========================================================
           RESULTS CONTAINER
        ========================================================== */

        .thesis-results-container {

            position: relative;

            width: 100%;

            box-sizing: border-box;

            transition:
                opacity .2s ease;

        }


        .thesis-results-container.is-loading {

            opacity: .45;

            pointer-events: none;

        }


        /* =========================================================
           CARD GRID
        ========================================================== */

        .thesis-partial-card-results {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 1.25rem;

            width: 100%;

            box-sizing: border-box;

        }


        /* =========================================================
           TABLE VISIBILITY
        ========================================================== */

        .thesis-partial-table-results {

            display: none;

            width: 100%;

            max-width: 100%;

            overflow: hidden;

            box-sizing: border-box;

        }


        .thesis-results-container.table-mode
        .thesis-partial-card-results {

            display: none;

        }


        .thesis-results-container.table-mode
        .thesis-partial-table-results {

            display: block;

        }


        /* =========================================================
           CARD
        ========================================================== */

        .admin-thesis-card {

            display: flex;

            flex-direction: column;

            min-width: 0;

            overflow: hidden;

            color:
                var(--thesis-text);

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 16px;

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


        [data-bs-theme="dark"]
        .admin-thesis-card:hover {

            border-color:
                #51447A;

        }


        /* =========================================================
           CARD TOP
        ========================================================== */

        .admin-thesis-card-top {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 1rem;

            padding: 1rem;

        }


        .admin-thesis-card-heading {

            display: flex;

            align-items: center;

            gap: .7rem;

            min-width: 0;

            flex: 1;

        }


        .admin-thesis-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 34px;

            height: 34px;

            flex-shrink: 0;

            color: #FFFFFF;

            background:
                var(--thesis-purple);

            border-radius: 9px;

            font-size: .85rem;

            box-shadow:
                0 3px 8px rgba(101, 56, 217, .18);

        }


        .admin-thesis-card-title {

            display: -webkit-box;

            margin: 0;

            overflow: hidden;

            color:
                var(--thesis-text);

            font-size: 1.05rem;

            font-weight: 800;

            line-height: 1.4;

            letter-spacing: -.02em;

            -webkit-line-clamp: 3;

            -webkit-box-orient: vertical;

            word-break: break-word;

        }


        [data-bs-theme="dark"]
        .admin-thesis-card-title {

            color: #FFFFFF;

        }


        /* =========================================================
           PUBLISHED
        ========================================================== */

        .admin-thesis-published {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: .45rem;

            margin:
                0 .85rem .75rem;

            padding:
                .55rem .65rem;

            color:
                var(--thesis-text);

            background:
                var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            box-sizing: border-box;

        }


        .admin-thesis-published-item {

            display: flex;

            align-items: center;

            gap: .4rem;

            min-width: 0;

        }


        .admin-thesis-published-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 24px;

            height: 24px;

            flex-shrink: 0;

            color:
                var(--thesis-purple);

            background:
                var(--thesis-purple-light);

            border:
                1px solid #DDD6FE;

            border-radius: 6px;

            font-size: .58rem;

        }


        .admin-thesis-published-content {

            display: flex;

            flex-direction: column;

            min-width: 0;

            line-height: 1.2;

        }


        .admin-thesis-published-label {

            margin-bottom: .08rem;

            color:
                var(--thesis-text-muted);

            font-size: .55rem;

            font-weight: 800;

            letter-spacing: .04em;

            text-transform: uppercase;

        }


        .admin-thesis-published-value {

            display: block;

            min-width: 0;

            overflow: hidden;

            color:
                var(--thesis-text-secondary);

            font-size: .66rem;

            font-weight: 700;

            line-height: 1.3;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        [data-bs-theme="dark"]
        .admin-thesis-published {

            background: #20253A;

            border-color: #343A52;

        }


        [data-bs-theme="dark"]
        .admin-thesis-published-icon {

            color: #C4B5FD;

            background: #292342;

            border-color: #403765;

        }


        /* =========================================================
           CARD BODY
        ========================================================== */

        .admin-thesis-card-body {

            display: flex;

            flex-direction: column;

            flex: 1;

            padding:
                .15rem 1rem 1rem;

        }


        .admin-thesis-detail {

            display: flex;

            align-items: center;

            gap: .65rem;

            min-width: 0;

            margin-bottom: .7rem;

        }


        .admin-thesis-detail-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 32px;

            height: 32px;

            flex-shrink: 0;

            color:
                var(--thesis-purple);

            background:
                var(--thesis-purple-light);

            border:
                1px solid #DDD6FE;

            border-radius: 8px;

            font-size: .75rem;

        }


        [data-bs-theme="dark"]
        .admin-thesis-detail-icon {

            color: #C4B5FD;

            background: #292342;

            border-color: #403765;

        }


        .admin-thesis-detail-content {

            display: flex;

            flex-direction: column;

            min-width: 0;

        }


        .admin-thesis-detail-label {

            margin-bottom: .1rem;

            color:
                var(--thesis-text-muted);

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .06em;

            text-transform: uppercase;

        }


        .admin-thesis-detail-value {

            overflow: hidden;

            color:
                var(--thesis-text-secondary);

            font-size: .78rem;

            font-weight: 600;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        .admin-thesis-submitted {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 1rem;

            margin-top: .3rem;

            padding-top: .8rem;

            border-top:
                1px solid var(--thesis-border-soft);

        }


        .admin-thesis-submitted-label {

            color:
                var(--thesis-text-muted);

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;

        }


        .admin-thesis-submitted-value {

            min-width: 0;

            overflow: hidden;

            color:
                var(--thesis-text-secondary);

            font-size: .78rem;

            font-weight: 700;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =========================================================
           CARD FOOTER
        ========================================================== */

        .admin-thesis-card-footer {

            display: flex;

            align-items: center;

            gap: .5rem;

            padding: .75rem;

            background:
                var(--thesis-input-bg);

            border-top:
                1px solid var(--thesis-border-soft);

        }


        .admin-thesis-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            flex: 1;

            min-height: 38px;

            padding: .4rem .7rem;

            border-radius: 8px;

            text-decoration: none;

            font-size: .72rem;

            font-weight: 800;

            cursor: pointer;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;

        }


        /* =========================================================
           EDIT BUTTON - BLUE BORDER
        ========================================================== */

        .admin-thesis-edit {

            color:
                var(--thesis-edit);

            background:
                transparent;

            border:
                1px solid var(--thesis-edit);

        }


        .admin-thesis-edit:hover {

            color: #FFFFFF;

            background:
                var(--thesis-edit);

            border-color:
                var(--thesis-edit);

            transform:
                translateY(-1px);

            box-shadow:
                0 4px 10px rgba(37, 99, 235, .18);

        }


        /* =========================================================
           DELETE BUTTON - RED BORDER
        ========================================================== */

        .admin-thesis-delete {

            width: 100%;

            color:
                var(--thesis-delete);

            background:
                transparent;

            border:
                1px solid var(--thesis-delete);

        }


        .admin-thesis-delete:hover {

            color: #FFFFFF;

            background:
                var(--thesis-delete);

            border-color:
                var(--thesis-delete);

            transform:
                translateY(-1px);

            box-shadow:
                0 4px 10px rgba(220, 38, 38, .18);

        }


        .admin-thesis-delete-form {

            display: flex;

            flex: 1;

            width: 100%;

            margin: 0;

            padding: 0;

        }


        /* =========================================================
           EMPTY
        ========================================================== */

        .admin-thesis-empty {

            grid-column:
                1 / -1;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            min-height: 260px;

            padding: 2rem;

            text-align: center;

            color:
                var(--thesis-text);

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 16px;

            box-shadow:
                var(--thesis-card-shadow);

        }


        .admin-thesis-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 55px;

            height: 55px;

            margin-bottom: 1rem;

            color: #FFFFFF;

            background:
                var(--thesis-purple);

            border-radius: 13px;

            font-size: 1.25rem;

        }


        .admin-thesis-empty h3 {

            margin:
                0 0 .35rem;

            color:
                var(--thesis-text);

            font-size: 1rem;

            font-weight: 800;

        }


        .admin-thesis-empty p {

            margin: 0;

            color:
                var(--thesis-text-muted);

            font-size: .78rem;

        }


        /* =========================================================
           TABLE
        ========================================================== */

        .thesis-table-wrapper {

            width: 100%;

            max-width: 100%;

            overflow: hidden;

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 14px;

            box-shadow:
                var(--thesis-card-shadow);

            box-sizing: border-box;

        }


        .thesis-table {

            width: 100%;

            max-width: 100%;

            min-width: 0;

            margin: 0;

            table-layout: fixed;

            border-collapse: collapse;

            color:
                var(--thesis-text);

            background:
                var(--thesis-card-bg);

        }


        /* COLUMN WIDTHS */

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


        /* =========================================================
           TABLE HEADER
        ========================================================== */

        .thesis-table thead th {

            padding:
                .85rem .65rem;

            color:
                #4C3A8A;

            background:
                #E9E2FF;

            border-bottom:
                1px solid #D8CCFF;

            font-size: .72rem;

            font-weight: 800;

            letter-spacing: .04em;

            line-height: 1.35;

            text-align: left;

            text-transform: uppercase;

            white-space: normal;

            overflow-wrap: break-word;

        }


        [data-bs-theme="dark"]
        .thesis-table thead th {

            color:
                #D8CCFF;

            background:
                #292342;

            border-bottom-color:
                #403765;

        }


        /* =========================================================
           TABLE BODY
        ========================================================== */

        .thesis-table tbody td {

            padding:
                .85rem .65rem;

            color:
                var(--thesis-text-secondary);

            background:
                var(--thesis-card-bg);

            border-bottom:
                1px solid var(--thesis-border-soft);

            font-size: .80rem;

            font-weight: 600;

            line-height: 1.45;

            vertical-align: middle;

            white-space: normal;

            overflow-wrap: anywhere;

            word-break: break-word;

        }


        .thesis-table tbody tr:last-child td {

            border-bottom: 0;

        }


        .thesis-table tbody tr {

            transition:
                background-color .2s ease;

        }


        .thesis-table tbody tr:hover td {

            background: #fafafa;

        }


        [data-bs-theme="dark"]
        .thesis-table tbody tr:hover td {

            background:
                #20253A;

        }


        .thesis-table-number {

            color:
                var(--thesis-purple) !important;

            font-size:
                .78rem !important;

            font-weight:
                800 !important;

            text-align:
                center !important;

        }


        .thesis-table-title-cell {

            min-width: 0;

        }


        .thesis-table-title-text {

            display: block;

            width: 100%;

            color:
                var(--thesis-text);

            font-size: .82rem;

            font-weight: 800;

            line-height: 1.45;

            white-space: normal;

            overflow-wrap: anywhere;

            word-break: break-word;

        }


        [data-bs-theme="dark"]
        .thesis-table-title-text {

            color: #FFFFFF;

        }


        /* =========================================================
           TABLE ACTIONS
        ========================================================== */

        .thesis-table-actions {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: .35rem;

            width: 100%;

        }


        .thesis-table-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            width: 34px;

            height: 34px;

            min-width: 34px;

            padding: 0;

            flex-shrink: 0;

            border-radius: 6px;

            text-decoration: none;

            font-size: .75rem;

            font-weight: 700;

            cursor: pointer;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease;

        }


        /* =========================================================
           TABLE EDIT - BLUE
        ========================================================== */

        .thesis-table-edit {

            color:
                var(--thesis-edit);

            background:
                transparent;

            border:
                1px solid var(--thesis-edit);

        }


        .thesis-table-edit:hover {

            color: #FFFFFF;

            background:
                var(--thesis-edit);

            border-color:
                var(--thesis-edit);

            transform:
                translateY(-1px);

        }


        /* =========================================================
           TABLE DELETE - RED
        ========================================================== */

        .thesis-table-delete {

            color:
                var(--thesis-delete);

            background:
                transparent;

            border:
                1px solid var(--thesis-delete);

        }


        .thesis-table-delete:hover {

            color: #FFFFFF;

            background:
                var(--thesis-delete);

            border-color:
                var(--thesis-delete);

            transform:
                translateY(-1px);

        }


        .thesis-table-delete-form {

            display: inline-flex;

            margin: 0;

            padding: 0;

        }


        /* =========================================================
           TABLE EMPTY
        ========================================================== */

        .thesis-table-empty {

            padding:
                3rem 1rem !important;

            text-align:
                center !important;

        }


        .thesis-table-empty strong {

            display: block;

            margin-bottom: .3rem;

            color:
                var(--thesis-text);

            font-size: .9rem;

        }


        .thesis-table-empty span {

            display: block;

            color:
                var(--thesis-text-muted);

            font-size: .78rem;

        }


        /* =========================================================
           DARK MODE - ACTIONS
        ========================================================== */

        [data-bs-theme="dark"]
        .admin-thesis-edit {

            color:
                #60A5FA;

            border-color:
                #60A5FA;

        }


        [data-bs-theme="dark"]
        .admin-thesis-edit:hover {

            color: #FFFFFF;

            background:
                #3B82F6;

            border-color:
                #3B82F6;

        }


        [data-bs-theme="dark"]
        .admin-thesis-delete {

            color:
                #F87171;

            border-color:
                #F87171;

        }


        [data-bs-theme="dark"]
        .admin-thesis-delete:hover {

            color: #FFFFFF;

            background:
                #EF4444;

            border-color:
                #EF4444;

        }


        [data-bs-theme="dark"]
        .thesis-table-edit {

            color:
                #60A5FA;

            border-color:
                #60A5FA;

        }


        [data-bs-theme="dark"]
        .thesis-table-edit:hover {

            color: #FFFFFF;

            background:
                #3B82F6;

            border-color:
                #3B82F6;

        }


        [data-bs-theme="dark"]
        .thesis-table-delete {

            color:
                #F87171;

            border-color:
                #F87171;

        }


        [data-bs-theme="dark"]
        .thesis-table-delete:hover {

            color: #FFFFFF;

            background:
                #EF4444;

            border-color:
                #EF4444;

        }


        /* =========================================================
           LOADING
        ========================================================== */

        .thesis-loading {

            position: absolute;

            top: 1rem;

            left: 50%;

            z-index: 50;

            display: flex;

            align-items: center;

            gap: .6rem;

            padding: .65rem .9rem;

            transform:
                translateX(-50%);

            color:
                var(--thesis-text);

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            box-shadow:
                var(--thesis-shadow);

            font-size: .78rem;

            font-weight: 700;

            white-space: nowrap;

        }


        .thesis-spinner {

            width: 17px;

            height: 17px;

            border:
                2px solid var(--thesis-border-soft);

            border-top-color:
                var(--thesis-purple);

            border-radius: 50%;

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
           DESKTOP
        ========================================================== */

        @media (max-width: 1399.98px) {

            .thesis-partial-card-results {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

            }

        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1199.98px) {

            .thesis-partial-card-results {

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


            .thesis-table-title-text {

                font-size:
                    .76rem;

            }


            .thesis-table-action {

                width: 31px;

                height: 31px;

                min-width: 31px;

            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .thesis-page {

                padding: 12px;

            }


            .thesis-page-header {

                margin:
                    70px 0 1rem;

                padding: 1rem;

                gap: 1rem;

            }


            .thesis-title {

                font-size:
                    1.4rem;

            }


            .thesis-overline {

                font-size:
                    .68rem;

            }


            .thesis-results-toolbar {

                margin-top:
                    .85rem;

                margin-bottom:
                    .75rem;

                padding:
                    0 .75rem;

            }


            .thesis-view-button {

                width:
                    38px;

                min-width:
                    38px;

                height:
                    36px;

                padding:
                    0;

            }


            .thesis-view-button span {

                display:
                    none;

            }


            .thesis-partial-card-results {

                grid-template-columns:
                    1fr;

                gap:
                    1rem;

                padding:
                    0 .75rem 1rem;

            }


            .admin-thesis-card-title {

                font-size:
                    1rem;

            }


            .admin-thesis-detail-value {

                font-size:
                    .76rem;

            }


            .admin-thesis-published {

                grid-template-columns:
                    1fr;

                gap:
                    .4rem;

                margin:
                    0 .85rem .7rem;

                padding:
                    .5rem .6rem;

            }


            .admin-thesis-published-icon {

                width:
                    23px;

                height:
                    23px;

                font-size:
                    .55rem;

            }


            .admin-thesis-published-label {

                font-size:
                    .52rem;

            }


            .admin-thesis-published-value {

                font-size:
                    .63rem;

            }


            /* MOBILE TABLE */

            .thesis-results-container.table-mode {

                width:
                    100%;

                max-width:
                    100%;

                padding:
                    0 .65rem 1rem;

                box-sizing:
                    border-box;

                overflow:
                    hidden;

            }


            .thesis-table-wrapper {

                width:
                    100%;

                max-width:
                    100%;

                overflow:
                    hidden;

                border-radius:
                    10px;

            }


            .thesis-table {

                width:
                    100%;

                max-width:
                    100%;

                min-width:
                    0;

                table-layout:
                    fixed;

            }


            /* HIDE EXTRA COLUMNS ON MOBILE */

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

                letter-spacing:
                    .02em;

                line-height:
                    1.3;

            }


            .thesis-table tbody td {

                padding:
                    .7rem .3rem;

                font-size:
                    .68rem;

                line-height:
                    1.4;

            }


            .thesis-table-title-text {

                font-size:
                    .70rem;

                line-height:
                    1.4;

            }


            .thesis-table-number {

                font-size:
                    .65rem !important;

            }


            .thesis-table-actions {

                gap:
                    .2rem;

            }


            .thesis-table-action {

                width:
                    28px;

                height:
                    28px;

                min-width:
                    28px;

                border-radius:
                    5px;

                font-size:
                    .65rem;

            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .thesis-page-header {

                padding:
                    .85rem;

            }


            .thesis-title {

                font-size:
                    1.25rem;

            }


            .thesis-partial-card-results {

                gap:
                    .85rem;

                padding:
                    0 .65rem 1rem;

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


            .admin-thesis-published {

                padding:
                    .45rem .55rem;

                gap:
                    .35rem;

            }


            .admin-thesis-published-icon {

                width:
                    21px;

                height:
                    21px;

                font-size:
                    .5rem;

            }


            .admin-thesis-published-label {

                font-size:
                    .48rem;

            }


            .admin-thesis-published-value {

                font-size:
                    .60rem;

            }


            .thesis-table thead th {

                padding:
                    .6rem .25rem;

                font-size:
                    .56rem;

                line-height:
                    1.25;

            }


            .thesis-table tbody td {

                padding:
                    .6rem .25rem;

                font-size:
                    .62rem;

                line-height:
                    1.4;

            }


            .thesis-table-title-text {

                font-size:
                    .64rem;

                line-height:
                    1.4;

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

