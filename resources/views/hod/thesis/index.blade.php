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
                            Thesis
                        </h1>

                    </div>

                </div>

            </div>

            <div class="thesis-header-actions">

                {{-- MOBILE SEARCH --}}

                <button type="button" id="mobileThesisSearchToggle" class="thesis-mobile-search-button"
                    data-tooltip="Search" aria-label="Open Search" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </button>



                {{-- ADD NEW THESIS --}}

                <a href="{{ route('hod.thesis.create') }}" class="thesis-add-button thesis-new-thesis-button">
                    <i class="bi bi-plus-lg"></i>

                    <span class="thesis-button-text">
                        Add New Thesis
                    </span>
                </a>

            </div>

        </div>


        {{-- =========================================================
            MOBILE SEARCH
        ========================================================== --}}

        <div id="mobileThesisSearchPanel" class="thesis-mobile-search-panel">

            <div class="thesis-mobile-search-content">

                <div class="thesis-mobile-search-input">

                    <i class="bi bi-search"></i>

                    <input type="text" id="mobileThesisSearchInput"
                        placeholder="Search title, author, or department..." autocomplete="off">

                </div>

                <button type="button" id="mobileThesisResetFilter" class="thesis-mobile-reset-button"
                    data-tooltip="Reset Search" aria-label="Reset Search">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>

            </div>

        </div>


        {{-- =========================================================
            FILTERS
        ========================================================== --}}

        <div class="thesis-filter-card">

            <div class="thesis-filter-body">

                <div class="row g-3 align-items-end">

                    {{-- SEARCH --}}

                    <div class="col-12 col-lg-5">

                        <label for="search" class="thesis-input-label">
                            Search
                        </label>

                        <div class="thesis-search">

                            <i class="bi bi-search"></i>

                            <input type="text" id="search" placeholder="Search title, author, or department..."
                                autocomplete="off">

                        </div>

                    </div>


                    {{-- DEPARTMENT --}}

                    <div class="col-12 col-md-6 col-lg-3">

                        <label for="departmentFilter" class="thesis-input-label">
                            Department
                        </label>

                        <select class="thesis-filter-select" id="departmentFilter">

                            <option value="">
                                All Departments
                            </option>

                            @foreach ($departments as $department)
                                <option value="{{ $department->name }}">
                                    {{ $department->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- YEAR --}}

                   <div class="col-12 col-md-6 col-lg-2">

                        <label for="yearFilter" class="thesis-input-label">
                            Academic Year
                        </label>

                        <select class="thesis-filter-select thesis-year-select" id="yearFilter">

                            <option value="">
                                All Years
                            </option>

                            @foreach ($academicYears as $year)
                                <option value="{{ $year }}">
                                    {{ $year }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- RESET --}}

                    <div class="col-12 col-lg-2">

                        <button type="button" id="resetFilter" class="thesis-reset-button"
                            data-tooltip="Reset Filters">

                            <i class="bi bi-arrow-counterclockwise"></i>

                            <span class="thesis-button-text">
                                Reset Filters
                            </span>

                        </button>

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


            {{-- VIEW TOGGLE --}}

            <div class="thesis-results-toolbar">

                <div class="thesis-view-toggle">

                    <button type="button" id="thesisCardViewButton" class="thesis-view-button is-active"
                        aria-label="Card View">

                        <i class="bi bi-grid-3x3-gap"></i>

                        <span>
                            Cards
                        </span>

                    </button>


                    <button type="button" id="thesisTableViewButton" class="thesis-view-button"
                        aria-label="Table View">

                        <i class="bi bi-table"></i>

                        <span>
                            Table
                        </span>

                    </button>

                </div>

            </div>


            {{-- RESULTS --}}

            <div id="adminThesisCards" class="thesis-results-container">

                @include('hod.thesis.table')

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


            /* =====================================================
               VIEW BUTTONS
            ====================================================== */

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


            /* =====================================================
               RESTORE SAVED VIEW
            ====================================================== */

            const savedThesisView =
                localStorage.getItem(
                    'adminThesisView'
                );

            setThesisView(
                savedThesisView === 'table' ?
                'table' :
                'cards'
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
                        mobileSearchInput ?
                        mobileSearchInput.value.trim() :
                        '';

                } else {

                    currentSearch =
                        searchInput ?
                        searchInput.value.trim() :
                        '';

                }

                const query = new URLSearchParams({

                    search: currentSearch,

                    department: departmentFilter ?
                        departmentFilter.value : '',

                    year: yearFilter ?
                        yearFilter.value : ''

                });

                fetch(
                        "{{ route('hod.thesis.search') }}?" +
                        query.toString(), {
                            signal: currentController.signal,

                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',

                                'Accept': 'text/html'
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
                                currentView === 'table' ?
                                'table' :
                                'cards'
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
            --thesis-view-hover: #15803D;

            --thesis-download: #2563EB;
            --thesis-download-hover: #1D4ED8;

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

            --thesis-view: #4ADE80;
            --thesis-view-hover: #22C55E;

            --thesis-download: #60A5FA;
            --thesis-download-hover: #3B82F6;

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

            background: var(--thesis-page-bg);

            color: var(--thesis-text);
        }


        /* =========================================================
           PAGE
        ========================================================== */

        .thesis-page {

            padding: 20px;

            color: var(--thesis-text);

            background: var(--thesis-page-bg);

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

            background: var(--thesis-page-bg);

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

            color: var(--thesis-purple);

            font-size: .72rem;

            font-weight: 800;

            letter-spacing: .13em;

            line-height: 1.2;

            text-transform: uppercase;
        }


        .thesis-title {

            margin: 0;

            color: var(--thesis-text);

            font-size: 1.9rem;

            font-weight: 700;

            line-height: 1.2;

            letter-spacing: -.035em;
        }


        [data-bs-theme="dark"] .thesis-title {

            color: #FFFFFF;
        }


        /* =========================================================
           HEADER BUTTONS
        ========================================================== */

        .thesis-header-actions {

            display: flex;

            align-items: center;

            gap: .5rem;

            flex-shrink: 0;
        }


        .thesis-add-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .5rem;

            min-height: 44px;

            padding: .65rem 1rem;

            color: #FFFFFF;

            background: var(--thesis-black);

            border: 1px solid var(--thesis-black);

            border-radius: 8px;

            text-decoration: none;

            font-size: .75rem;

            font-weight: 800;

            letter-spacing: .03em;

            text-transform: uppercase;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }


        .thesis-add-button:hover {

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);

            transform: translateY(-2px);

            box-shadow:
                0 5px 14px rgba(101, 56, 217, .20);
        }


        /* =========================================================
           MY UPLOAD
        ========================================================== */

        .thesis-my-upload-button {

            color: var(--thesis-purple);

            background: var(--thesis-purple-light);

            border-color: #DDD6FE;
        }


        .thesis-my-upload-button:hover {

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);
        }


        /* =========================================================
           ADD NEW THESIS
           SAME COLOR AS MY UPLOAD
        ========================================================== */

        .thesis-new-thesis-button {

            color: var(--thesis-purple);

            background: var(--thesis-purple-light);

            border-color: #DDD6FE;
        }


        .thesis-new-thesis-button:hover {

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);

            transform: translateY(-2px);

            box-shadow:
                0 5px 14px rgba(101, 56, 217, .20);
        }


        /* =========================================================
           DARK HEADER BUTTONS
        ========================================================== */

        [data-bs-theme="dark"] .thesis-add-button {

            color: #FFFFFF;

            background: #20253A;

            border-color: #343A52;
        }


        [data-bs-theme="dark"] .thesis-add-button:hover {

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);
        }


        [data-bs-theme="dark"] .thesis-my-upload-button,
        [data-bs-theme="dark"] .thesis-new-thesis-button {

            color: #C4B5FD;

            background: #292342;

            border-color: #403765;
        }


        [data-bs-theme="dark"] .thesis-my-upload-button:hover,
        [data-bs-theme="dark"] .thesis-new-thesis-button:hover {

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);
        }


        /* =========================================================
           MOBILE SEARCH BUTTON
        ========================================================== */

        .thesis-mobile-search-button {

            position: relative;

            display: none;

            align-items: center;

            justify-content: center;

            width: 44px;

            height: 44px;

            padding: 0;

            color: var(--thesis-purple);

            background: var(--thesis-purple-light);

            border: 1px solid #DDD6FE;

            border-radius: 8px;

            cursor: pointer;

            transition: .2s ease;
        }


        .thesis-mobile-search-button:hover,
        .thesis-mobile-search-button.is-active {

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);
        }


        [data-bs-theme="dark"] .thesis-mobile-search-button {

            color: #C4B5FD;

            background: #292342;

            border-color: #403765;
        }


        [data-bs-theme="dark"] .thesis-mobile-search-button:hover,
        [data-bs-theme="dark"] .thesis-mobile-search-button.is-active {

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);
        }


        /* =========================================================
           FILTER CARD
        ========================================================== */

        .thesis-filter-card,
        .thesis-filter-body {

            width: 100%;

            background: var(--thesis-card-bg);

            box-sizing: border-box;
        }


        .thesis-filter-body {

            overflow: hidden;

            padding: 1.2rem 1.25rem;

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 12px;

            box-shadow:
                var(--thesis-card-shadow);
        }


        .thesis-input-label {

            display: block;

            margin-bottom: .45rem;

            color: var(--thesis-text-secondary);

            font-size: .75rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;
        }


        /* =========================================================
           SEARCH
        ========================================================== */

        .thesis-search {

            position: relative;
        }


        .thesis-search i {

            position: absolute;

            top: 50%;

            left: 1rem;

            z-index: 2;

            transform: translateY(-50%);

            color: var(--thesis-purple);

            pointer-events: none;
        }


        .thesis-search input {

            width: 100%;

            height: 45px;

            padding:
                .6rem 1rem .6rem 2.75rem;

            color: var(--thesis-text);

            background: var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            outline: none;

            font-size: .9rem;

            box-sizing: border-box;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;
        }


        .thesis-search input:focus {

            border-color: var(--thesis-purple);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .12);
        }


        .thesis-search input::placeholder {

            color: var(--thesis-text-muted);
        }


        /* =========================================================
           SELECT
        ========================================================== */

        .thesis-filter-select {

            width: 100%;

            height: 45px;

            padding:
                .5rem 2rem .5rem .85rem;

            color: var(--thesis-text);

            background: var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            outline: none;

            font-size: .9rem;

            cursor: pointer;

            box-sizing: border-box;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }


        .thesis-filter-select:focus {

            border-color: var(--thesis-purple);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .12);
        }


        .thesis-filter-select option {

            color: #111111;

            background: #FFFFFF;
        }


        [data-bs-theme="dark"] .thesis-filter-select option {

            color: #FFFFFF;

            background: #20253A;
        }


        .thesis-year-select {

            font-family: monospace;
        }


        /* =========================================================
           RESET
        ========================================================== */

        .thesis-reset-button {

            position: relative;

            width: 100%;

            height: 45px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .45rem;

            color: var(--thesis-text-secondary);

            background: var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            font-size: .75rem;

            font-weight: 800;

            text-transform: uppercase;

            cursor: pointer;

            transition: .2s ease;
        }


        .thesis-reset-button:hover {

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);
        }


        [data-bs-theme="dark"] .thesis-reset-button {

            color: var(--thesis-text-secondary);

            background: #20253A;

            border-color: #343A52;
        }


        [data-bs-theme="dark"] .thesis-reset-button:hover {

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);
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

            background: var(--thesis-purple-light);

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

            color: var(--thesis-text-muted);

            background: transparent;

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

            color: var(--thesis-purple);

            background: var(--thesis-purple-soft);
        }


        .thesis-view-button.is-active {

            color: #FFFFFF;

            background: var(--thesis-purple);

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

            background: var(--thesis-purple);

            box-shadow:
                0 3px 9px rgba(101, 56, 217, .35);
        }


        .thesis-results-container {

            position: relative;

            width: 100%;

            box-sizing: border-box;

            transition: opacity .2s ease;
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


        .thesis-results-container.table-mode .thesis-partial-card-results {

            display: none;
        }


        .thesis-results-container.table-mode .thesis-partial-table-results {

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

            color: var(--thesis-text);

            background: var(--thesis-card-bg);

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

            transform: translateY(-5px);

            border-color: #D8CCFF;

            box-shadow:
                var(--thesis-shadow);
        }


        [data-bs-theme="dark"] .admin-thesis-card:hover {

            border-color: #51447A;
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

            background: var(--thesis-purple);

            border-radius: 9px;

            font-size: .85rem;

            box-shadow:
                0 3px 8px rgba(101, 56, 217, .18);
        }


        .admin-thesis-card-title {

            display: -webkit-box;

            margin: 0;

            overflow: hidden;

            color: var(--thesis-text);

            font-size: 1.05rem;

            font-weight: 800;

            line-height: 1.4;

            letter-spacing: -.02em;

            -webkit-line-clamp: 3;

            -webkit-box-orient: vertical;

            word-break: break-word;
        }


        [data-bs-theme="dark"] .admin-thesis-card-title {

            color: #FFFFFF;
        }


        /* =========================================================
           STATUS
        ========================================================== */

        .admin-thesis-status {

            flex-shrink: 0;
        }


        .admin-thesis-status-badge {

            display: inline-flex;

            align-items: center;

            gap: .35rem;

            padding: .4rem .65rem;

            border-radius: 20px;

            font-size: .68rem;

            font-weight: 800;

            text-transform: uppercase;

            white-space: nowrap;
        }


        .admin-thesis-status-badge.pending {

            color: var(--thesis-pending-text);

            background: var(--thesis-pending-bg);

            border: 1px solid #FDE68A;
        }


        .admin-thesis-status-badge.refused {

            color: var(--thesis-refused-text);

            background: var(--thesis-refused-bg);

            border: 1px solid #FECACA;
        }


        .admin-thesis-status-badge.approved {

            color: var(--thesis-approved-text);

            background: var(--thesis-approved-bg);

            border: 1px solid #BBF7D0;
        }


        /* =========================================================
           PUBLISHED BY / PUBLISHED AT
        ========================================================== */

        .admin-thesis-published {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: .45rem;

            margin: 0 .85rem .75rem;

            padding: .55rem .65rem;

            color: var(--thesis-text);

            background: var(--thesis-input-bg);

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

            color: var(--thesis-purple);

            background: var(--thesis-purple-light);

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

            color: var(--thesis-text-muted);

            font-size: .55rem;

            font-weight: 800;

            letter-spacing: .04em;

            line-height: 1.2;

            text-transform: uppercase;
        }


        .admin-thesis-published-value {

            display: block;

            min-width: 0;

            overflow: hidden;

            color: var(--thesis-text-secondary);

            font-size: .66rem;

            font-weight: 700;

            line-height: 1.3;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        [data-bs-theme="dark"] .admin-thesis-published {

            background: #20253A;

            border-color: #343A52;
        }


        [data-bs-theme="dark"] .admin-thesis-published-icon {

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

            color: var(--thesis-purple);

            background: var(--thesis-purple-light);

            border:
                1px solid #DDD6FE;

            border-radius: 8px;

            font-size: .75rem;
        }


        [data-bs-theme="dark"] .admin-thesis-detail-icon {

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

            color: var(--thesis-text-muted);

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .06em;

            text-transform: uppercase;
        }


        .admin-thesis-detail-value {

            overflow: hidden;

            color: var(--thesis-text-secondary);

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

            color: var(--thesis-text-muted);

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;
        }


        .admin-thesis-submitted-value {

            min-width: 0;

            overflow: hidden;

            color: var(--thesis-text-secondary);

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

            background: var(--thesis-input-bg);

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

            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }


        .admin-thesis-view {

            color: var(--thesis-view);

            background: transparent;

            border:
                1px solid var(--thesis-view);
        }


        .admin-thesis-view:hover {

            color: #FFFFFF;

            background: var(--thesis-view);

            border-color: var(--thesis-view);

            transform: translateY(-1px);
        }


        .admin-thesis-download {

            color: var(--thesis-download);

            background: transparent;

            border:
                1px solid var(--thesis-download);
        }


        .admin-thesis-download:hover {

            color: #FFFFFF;

            background: var(--thesis-download);

            border-color: var(--thesis-download);

            transform: translateY(-1px);
        }


        .admin-thesis-download.disabled {

            color: var(--thesis-text-muted);

            background: transparent;

            border-color: var(--thesis-border-soft);

            opacity: .5;

            cursor: not-allowed;

            pointer-events: none;
        }


        /* =========================================================
           EMPTY
        ========================================================== */

        .admin-thesis-empty {

            grid-column: 1 / -1;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            min-height: 260px;

            padding: 2rem;

            text-align: center;

            color: var(--thesis-text);

            background: var(--thesis-card-bg);

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

            background: var(--thesis-purple);

            border-radius: 13px;

            font-size: 1.25rem;
        }


        .admin-thesis-empty h3 {

            margin: 0 0 .35rem;

            color: var(--thesis-text);

            font-size: 1rem;

            font-weight: 800;
        }


        .admin-thesis-empty p {

            margin: 0;

            color: var(--thesis-text-muted);

            font-size: .78rem;
        }


        /* =========================================================
           TABLE
        ========================================================== */

        .thesis-partial-table-results {

            display: none;

            width: 100%;

            max-width: 100%;

            overflow: hidden;

            box-sizing: border-box;
        }


        .thesis-table-wrapper {

            width: 100%;

            max-width: 100%;

            overflow: hidden;

            background: var(--thesis-card-bg);

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

            color: var(--thesis-text);

            background: var(--thesis-card-bg);
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
            padding: .85rem .65rem;

            color: #4C3A8A;

            background: #E9E2FF;

            border-bottom: 1px solid #D8CCFF;

            font-size: .72rem;

            font-weight: 800;

            letter-spacing: .04em;

            line-height: 1.35;

            text-align: left;

            text-transform: uppercase;

            white-space: normal;

            overflow-wrap: break-word;
        }


        [data-bs-theme="dark"] .thesis-table thead th {
            color: #D8CCFF;

            background: #292342;

            border-bottom-color: #403765;
        }

        .thesis-table tbody td {

            padding: .85rem .65rem;

            color: var(--thesis-text-secondary);

            background: var(--thesis-card-bg);

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


        [data-bs-theme="dark"] .thesis-table tbody tr:hover td {

            background: #20253A;
        }


        .thesis-table-number {

            color: var(--thesis-purple) !important;

            font-size: .78rem !important;

            font-weight: 800 !important;

            text-align: center !important;
        }


        .thesis-table-title-cell {

            min-width: 0;

            max-width: none;
        }


        .thesis-table-title-text {

            display: block;

            width: 100%;

            color: var(--thesis-text);

            font-size: .82rem;

            font-weight: 800;

            line-height: 1.45;

            white-space: normal;

            overflow-wrap: anywhere;

            word-break: break-word;
        }


        [data-bs-theme="dark"] .thesis-table-title-text {

            color: #FFFFFF;
        }


        .thesis-table .published-by,
        .thesis-table .published-at,
        .thesis-table .published-by-value,
        .thesis-table .published-at-value {

            font-size: .68rem !important;

            line-height: 1.3;
        }


        .thesis-table .published-by-label,
        .thesis-table .published-at-label {

            font-size: .55rem !important;

            line-height: 1.2;

            color: var(--thesis-text-muted);
        }


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

            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }


        .thesis-table-view {

            color: var(--thesis-view);

            background: transparent;

            border:
                1px solid var(--thesis-view);
        }


        .thesis-table-view:hover {

            color: #FFFFFF;

            background: var(--thesis-view);

            border-color: var(--thesis-view);

            transform: translateY(-1px);
        }


        .thesis-table-download {

            color: var(--thesis-download);

            background: transparent;

            border:
                1px solid var(--thesis-download);
        }


        .thesis-table-download:hover {

            color: #FFFFFF;

            background: var(--thesis-download);

            border-color: var(--thesis-download);

            transform: translateY(-1px);
        }


        .thesis-table-action.disabled {

            color: var(--thesis-text-muted);

            background: transparent;

            border-color: var(--thesis-border-soft);

            opacity: .45;

            cursor: not-allowed;

            pointer-events: none;
        }


        [data-bs-theme="dark"] .thesis-table-wrapper {

            background: #181D33;

            border-color: #292E45;
        }


        [data-bs-theme="dark"] .thesis-table {

            color: #FFFFFF;

            background: #181D33;
        }


        [data-bs-theme="dark"] .thesis-table tbody td {

            color: #D5D8E8;

            background: #181D33;

            border-bottom-color: #292E45;
        }


        [data-bs-theme="dark"] .thesis-table-view {

            color: #4ADE80;

            border-color: #4ADE80;
        }


        [data-bs-theme="dark"] .thesis-table-view:hover {

            color: #071B0D;

            background: #4ADE80;

            border-color: #4ADE80;
        }


        [data-bs-theme="dark"] .thesis-table-download {

            color: #60A5FA;

            border-color: #60A5FA;
        }


        [data-bs-theme="dark"] .thesis-table-download:hover {

            color: #071225;

            background: #60A5FA;

            border-color: #60A5FA;
        }


        .thesis-table-empty {

            padding: 3rem 1rem !important;

            text-align: center !important;
        }


        .thesis-table-empty strong {

            display: block;

            margin-bottom: .3rem;

            color: var(--thesis-text);

            font-size: .9rem;
        }


        .thesis-table-empty span {

            display: block;

            color: var(--thesis-text-muted);

            font-size: .78rem;
        }


        /* =========================================================
           MOBILE SEARCH PANEL
        ========================================================== */

        .thesis-mobile-search-panel {

            display: none;

            margin-bottom: 1rem;

            overflow: hidden;

            background: var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 10px;

            opacity: 0;

            transform: translateY(-6px);

            transition:
                opacity .2s ease,
                transform .2s ease;
        }


        .thesis-mobile-search-panel.is-open {

            opacity: 1;

            transform: translateY(0);
        }


        .thesis-mobile-search-content {

            display: flex;

            align-items: center;

            gap: .5rem;

            padding: .75rem;
        }


        .thesis-mobile-search-input {

            position: relative;

            flex: 1;
        }


        .thesis-mobile-search-input i {

            position: absolute;

            top: 50%;

            left: .85rem;

            transform: translateY(-50%);

            color: var(--thesis-purple);

            pointer-events: none;
        }


        .thesis-mobile-search-input input {

            width: 100%;

            height: 44px;

            padding:
                .5rem .75rem .5rem 2.5rem;

            color: var(--thesis-text);

            background: var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            outline: none;

            font-size: .88rem;

            box-sizing: border-box;

            transition: .2s ease;
        }


        .thesis-mobile-search-input input:focus {

            border-color: var(--thesis-purple);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .12);
        }


        .thesis-mobile-reset-button {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 44px;

            height: 44px;

            flex-shrink: 0;

            color: var(--thesis-purple);

            background: var(--thesis-purple-light);

            border:
                1px solid #DDD6FE;

            border-radius: 8px;

            cursor: pointer;

            transition: .2s ease;
        }


        .thesis-mobile-reset-button:hover {

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);
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

            transform: translateX(-50%);

            color: var(--thesis-text);

            background: var(--thesis-card-bg);

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
                transform: rotate(360deg);
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

                padding: .75rem .5rem;

                font-size: .68rem;
            }


            .thesis-table tbody td {

                padding: .75rem .5rem;

                font-size: .74rem;
            }


            .thesis-table-title-text {

                font-size: .76rem;
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

                font-size: 1.4rem;
            }


            .thesis-overline {

                font-size: .68rem;
            }


            .thesis-mobile-search-button {

                display: flex;
            }


            .thesis-filter-card {

                display: none;
            }


            .thesis-mobile-search-panel {

                display: block;
            }


            .thesis-results-toolbar {

                margin-top: .85rem;

                margin-bottom: .75rem;

                padding: 0 .75rem;
            }


            .thesis-view-button {

                width: 38px;

                min-width: 38px;

                height: 36px;

                padding: 0;
            }


            .thesis-view-button span {

                display: none;
            }


            .thesis-partial-card-results {

                grid-template-columns: 1fr;

                gap: 1rem;

                padding:
                    0 .75rem 1rem;
            }


            .thesis-add-button {

                width: 44px;

                height: 44px;

                min-width: 44px;

                padding: 0;
            }


            .thesis-add-button .thesis-button-text {

                display: none;
            }


            .admin-thesis-card-title {

                font-size: 1rem;
            }


            .admin-thesis-detail-value {

                font-size: .76rem;
            }


            .admin-thesis-published {

                grid-template-columns: 1fr;

                gap: .4rem;

                margin:
                    0 .85rem .7rem;

                padding:
                    .5rem .6rem;
            }


            .admin-thesis-published-icon {

                width: 23px;

                height: 23px;

                font-size: .55rem;
            }


            .admin-thesis-published-label {

                font-size: .52rem;
            }


            .admin-thesis-published-value {

                font-size: .63rem;
            }


            .thesis-results-container.table-mode {

                width: 100%;

                max-width: 100%;

                padding:
                    0 .65rem 1rem;

                box-sizing: border-box;

                overflow: hidden;
            }


            .thesis-partial-table-results {

                width: 100%;

                max-width: 100%;

                overflow: hidden;
            }


            .thesis-table-wrapper {

                width: 100%;

                max-width: 100%;

                overflow: hidden;

                border-radius: 10px;
            }


            .thesis-table {

                width: 100%;

                max-width: 100%;

                min-width: 0;

                table-layout: fixed;
            }


            .thesis-table th:nth-child(6),
            .thesis-table td:nth-child(6),

            .thesis-table th:nth-child(7),
            .thesis-table td:nth-child(7),

            .thesis-table th:nth-child(8),
            .thesis-table td:nth-child(8) {

                display: none;
            }


            .thesis-table th:nth-child(1),
            .thesis-table td:nth-child(1) {

                width: 8%;
            }


            .thesis-table th:nth-child(2),
            .thesis-table td:nth-child(2) {

                width: 43%;
            }


            .thesis-table th:nth-child(3),
            .thesis-table td:nth-child(3) {

                width: 20%;
            }


            .thesis-table th:nth-child(4),
            .thesis-table td:nth-child(4) {

                width: 17%;
            }


            .thesis-table th:nth-child(5),
            .thesis-table td:nth-child(5) {

                width: 12%;
            }


            .thesis-table th:nth-child(9),
            .thesis-table td:nth-child(9) {

                display: table-cell;

                width: 14%;
            }


            .thesis-table thead th {

                padding:
                    .65rem .3rem;

                font-size: .62rem;

                letter-spacing: .02em;

                line-height: 1.3;
            }


            .thesis-table tbody td {

                padding:
                    .7rem .3rem;

                font-size: .68rem;

                line-height: 1.4;
            }


            .thesis-table-title-text {

                font-size: .70rem;

                line-height: 1.4;
            }


            .thesis-table-number {

                font-size: .65rem !important;
            }


            .thesis-table-actions {

                gap: .2rem;
            }


            .thesis-table-action {

                width: 28px;

                height: 28px;

                min-width: 28px;

                border-radius: 5px;

                font-size: .65rem;
            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .thesis-page-header {

                padding: .85rem;
            }


            .thesis-title {

                font-size: 1.25rem;
            }


            .thesis-mobile-search-content {

                padding: .6rem;
            }


            .thesis-mobile-search-input input {

                height: 42px;

                font-size: .84rem;
            }


            .thesis-mobile-reset-button,
            .thesis-mobile-search-button {

                width: 42px;

                height: 42px;
            }


            .thesis-partial-card-results {

                gap: .85rem;

                padding:
                    0 .65rem 1rem;
            }


            .admin-thesis-card-body {

                padding:
                    .15rem .9rem .9rem;
            }


            .admin-thesis-card-footer {

                padding: .65rem;
            }


            .admin-thesis-action {

                min-height: 36px;

                font-size: .66rem;
            }


            .admin-thesis-status-badge {

                padding:
                    .35rem .5rem;

                font-size: .58rem;
            }


            .admin-thesis-published {

                padding:
                    .45rem .55rem;

                gap: .35rem;
            }


            .admin-thesis-published-icon {

                width: 21px;

                height: 21px;

                font-size: .5rem;
            }


            .admin-thesis-published-label {

                font-size: .48rem;
            }


            .admin-thesis-published-value {

                font-size: .60rem;
            }


            .thesis-table thead th {

                padding:
                    .6rem .25rem;

                font-size: .56rem;

                line-height: 1.25;
            }


            .thesis-table tbody td {

                padding:
                    .6rem .25rem;

                font-size: .62rem;

                line-height: 1.4;
            }


            .thesis-table-title-text {

                font-size: .64rem;

                line-height: 1.4;
            }


            .thesis-table-action {

                width: 25px;

                height: 25px;

                min-width: 25px;

                font-size: .55rem;
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
