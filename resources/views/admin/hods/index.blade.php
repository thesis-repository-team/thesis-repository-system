<x-app-layout>

    <div class="dashboard-content hod-management-page">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="hod-page-header">

            <div class="hod-header-content">

                <div class="hod-title-row">

                    <div>

                        <span class="hod-overline">
                            MANAGEMENT
                        </span>

                        <h1 class="hod-title">
                            Head of Department (HoD)
                        </h1>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                HEADER ACTIONS
            ====================================================== --}}

            <div class="hod-header-actions">

                {{-- MOBILE SEARCH TOGGLE --}}

                <button type="button" id="mobileSearchToggle" class="hod-mobile-search-button" aria-label="Open Search"
                    aria-expanded="false" data-tooltip="Search">

                    <i class="bi bi-search"></i>

                </button>


                {{-- ADD HOD --}}

                <div class="hod-header-action">

                    <a href="{{ route('admin.hods.create') }}" class="hod-add-button" data-tooltip="Add New HoD"
                        aria-label="Add New HoD">

                        <i class="bi bi-plus-lg"></i>

                        <span class="hod-button-text">
                            Add New HoD
                        </span>

                    </a>

                </div>

            </div>

        </div>


        {{-- =========================================================
            MOBILE SEARCH PANEL
        ========================================================== --}}

        <div id="mobileSearchPanel" class="hod-mobile-search-panel">

            <div class="hod-mobile-search-content">

                <div class="hod-mobile-search-input">

                    <i class="bi bi-search"></i>

                    <input type="text" id="mobileSearchInput" placeholder="Search name, email, or department..."
                        autocomplete="off">

                </div>


                <button type="button" id="mobileResetFilter" class="hod-mobile-reset-button" aria-label="Reset Search"
                    data-tooltip="Reset">

                    <i class="bi bi-arrow-counterclockwise"></i>

                </button>

            </div>

        </div>


        {{-- =========================================================
            DESKTOP FILTER
        ========================================================== --}}

        <div class="hod-filter-body">

            <div class="row g-3 align-items-end">

                {{-- SEARCH --}}

                <div class="col-12 col-lg-5">

                    <label for="search" class="hod-input-label">
                        Search
                    </label>


                    <div class="hod-search">

                        <i class="bi bi-search"></i>

                        <input type="text" id="search" placeholder="Search name, email, or department..."
                            autocomplete="off">

                    </div>

                </div>


                {{-- DEPARTMENT --}}

                <div class="col-12 col-md-6 col-lg-3">

                    <label for="departmentFilter" class="hod-input-label">
                        Department
                    </label>


                    <select class="hod-filter-select" id="departmentFilter" name="department">

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

                    <label for="yearFilter" class="hod-input-label">
                        Started Year
                    </label>

                    <select class="hod-filter-select" id="yearFilter" name="started_year">

                        <option value="">
                            All Years
                        </option>

                        @forelse ($hods->pluck('started_year')->filter()->unique()->sortDesc() as $year)
                            <option value="{{ $year }}"
                                {{ request('started_year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>

                        @empty

                            {{-- No started years found --}}
                        @endforelse

                    </select>

                </div>


                {{-- RESET --}}

                <div class="col-12 col-lg-2">

                    <button type="button" id="resetFilter" class="hod-reset-button" data-tooltip="Reset Filters"
                        aria-label="Reset Filters">

                        <i class="bi bi-arrow-counterclockwise"></i>

                        <span class="hod-button-text">
                            Reset Filters
                        </span>

                    </button>

                </div>

            </div>

        </div>


        {{-- =========================================================
            RESULTS
        ========================================================== --}}

        <div class="hod-results-wrapper">


            {{-- RESULTS HEADER --}}

            <div class="hod-results-header">

                <div class="hod-results-title">


                </div>


                {{-- CARD / TABLE TOGGLE --}}

                <div class="hod-view-toggle">

                    {{-- CARD VIEW --}}

                    <button type="button" id="cardViewButton" class="hod-view-button is-active"
                        data-tooltip="Card View" aria-label="Card View">

                        <i class="bi bi-grid-3x3-gap"></i>

                        <span>
                            Cards
                        </span>

                    </button>


                    {{-- TABLE VIEW --}}

                    <button type="button" id="tableViewButton" class="hod-view-button" data-tooltip="Table View"
                        aria-label="Table View">

                        <i class="bi bi-table"></i>

                        <span>
                            Table
                        </span>

                    </button>

                </div>

            </div>


            {{-- =====================================================
                LOADING
            ====================================================== --}}

            <div id="searchSpinner" class="hod-loading d-none">

                <div class="hod-spinner"></div>

                <span>
                    Loading records...
                </span>

            </div>


            {{-- =====================================================
                HOD RESULTS
            ====================================================== --}}

            <div id="adminHodTable" class="hod-results-container">

                @include('admin.hods.table')

            </div>

        </div>

    </div>



    {{-- =========================================================
        JAVASCRIPT
    ========================================================== --}}

    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function() {

                let searchTimeout = null;

                let currentController = null;


                /* =================================================
                   ELEMENTS
                ================================================== */

                const searchInput =
                    document.getElementById('search');

                const mobileSearchInput =
                    document.getElementById(
                        'mobileSearchInput'
                    );

                const departmentFilter =
                    document.getElementById(
                        'departmentFilter'
                    );

                const yearFilter =
                    document.getElementById(
                        'yearFilter'
                    );

                const resetButton =
                    document.getElementById(
                        'resetFilter'
                    );

                const mobileResetButton =
                    document.getElementById(
                        'mobileResetFilter'
                    );

                const mobileSearchToggle =
                    document.getElementById(
                        'mobileSearchToggle'
                    );

                const mobileSearchPanel =
                    document.getElementById(
                        'mobileSearchPanel'
                    );

                const spinner =
                    document.getElementById(
                        'searchSpinner'
                    );

                const hodResultsContainer =
                    document.getElementById(
                        'adminHodTable'
                    );

                const cardViewButton =
                    document.getElementById(
                        'cardViewButton'
                    );

                const tableViewButton =
                    document.getElementById(
                        'tableViewButton'
                    );



                /* =================================================
                   CARD / TABLE VIEW
                ================================================== */

                function setHodView(view) {

                    if (!hodResultsContainer) {
                        return;
                    }


                    if (view === 'table') {

                        hodResultsContainer.classList.add(
                            'table-mode'
                        );


                        if (tableViewButton) {

                            tableViewButton.classList.add(
                                'is-active'
                            );

                        }


                        if (cardViewButton) {

                            cardViewButton.classList.remove(
                                'is-active'
                            );

                        }


                        localStorage.setItem(
                            'adminHodView',
                            'table'
                        );

                    } else {

                        hodResultsContainer.classList.remove(
                            'table-mode'
                        );


                        if (cardViewButton) {

                            cardViewButton.classList.add(
                                'is-active'
                            );

                        }


                        if (tableViewButton) {

                            tableViewButton.classList.remove(
                                'is-active'
                            );

                        }


                        localStorage.setItem(
                            'adminHodView',
                            'cards'
                        );

                    }

                }



                /* =================================================
                   CARD VIEW
                ================================================== */

                if (cardViewButton) {

                    cardViewButton.addEventListener(
                        'click',
                        function() {

                            setHodView('cards');

                        }
                    );

                }



                /* =================================================
                   TABLE VIEW
                ================================================== */

                if (tableViewButton) {

                    tableViewButton.addEventListener(
                        'click',
                        function() {

                            setHodView('table');

                        }
                    );

                }



                /* =================================================
                   RESTORE SAVED VIEW
                ================================================== */

                const savedHodView =
                    localStorage.getItem(
                        'adminHodView'
                    );


                if (savedHodView === 'table') {

                    setHodView('table');

                } else {

                    setHodView('cards');

                }



                /* =================================================
                   LOAD DATA
                ================================================== */

                function loadData() {

                    if (currentController) {

                        currentController.abort();

                    }


                    currentController =
                        new AbortController();


                    /* SHOW LOADING */

                    if (spinner) {

                        spinner.classList.remove(
                            'd-none'
                        );

                    }


                    if (hodResultsContainer) {

                        hodResultsContainer.classList.add(
                            'is-loading'
                        );

                    }


                    /* SEARCH VALUE */

                    let currentSearch = '';


                    if (window.innerWidth <= 767.98) {

                        currentSearch =
                            mobileSearchInput ?
                            mobileSearchInput.value :
                            '';

                    } else {

                        currentSearch =
                            searchInput ?
                            searchInput.value :
                            '';

                    }


                    /* QUERY */

                    const query =
                        new URLSearchParams({

                            search: currentSearch,

                            department: departmentFilter ?
                                departmentFilter.value :
                                '',

                            year: yearFilter ?
                                yearFilter.value :
                                ''

                        });


                    /* AJAX */

                    fetch(
                            "{{ route('admin.hods.search') }}?" +
                            query.toString(), {
                                signal: currentController.signal
                            }
                        )

                        .then(
                            response => {

                                if (!response.ok) {

                                    throw new Error(
                                        'Network response failed'
                                    );

                                }


                                return response.text();

                            }
                        )

                        .then(
                            html => {

                                if (hodResultsContainer) {

                                    hodResultsContainer.innerHTML =
                                        html;

                                }

                            }
                        )

                        .catch(
                            error => {

                                if (
                                    error.name !==
                                    'AbortError'
                                ) {

                                    console.error(
                                        'Error loading HoD records:',
                                        error
                                    );

                                }

                            }
                        )

                        .finally(
                            () => {

                                if (spinner) {

                                    spinner.classList.add(
                                        'd-none'
                                    );

                                }


                                if (hodResultsContainer) {

                                    hodResultsContainer.classList.remove(
                                        'is-loading'
                                    );

                                }

                            }
                        );

                }



                /* =================================================
                   DESKTOP SEARCH
                ================================================== */

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



                /* =================================================
                   MOBILE SEARCH
                ================================================== */

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



                /* =================================================
                   DEPARTMENT
                ================================================== */

                if (departmentFilter) {

                    departmentFilter.addEventListener(
                        'change',
                        loadData
                    );

                }



                /* =================================================
                   YEAR
                ================================================== */

                if (yearFilter) {

                    yearFilter.addEventListener(
                        'change',
                        loadData
                    );

                }



                /* =================================================
                   RESET
                ================================================== */

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



                /* =================================================
                   MOBILE SEARCH TOGGLE
                ================================================== */

                if (mobileSearchToggle) {

                    mobileSearchToggle.addEventListener(
                        'click',
                        function() {

                            if (!mobileSearchPanel) {
                                return;
                            }


                            const isOpen =
                                mobileSearchPanel
                                .classList
                                .contains(
                                    'is-open'
                                );


                            if (isOpen) {

                                mobileSearchPanel
                                    .classList
                                    .remove(
                                        'is-open'
                                    );


                                mobileSearchToggle
                                    .setAttribute(
                                        'aria-expanded',
                                        'false'
                                    );


                                mobileSearchToggle
                                    .classList
                                    .remove(
                                        'is-active'
                                    );

                            } else {

                                mobileSearchPanel
                                    .classList
                                    .add(
                                        'is-open'
                                    );


                                mobileSearchToggle
                                    .setAttribute(
                                        'aria-expanded',
                                        'true'
                                    );


                                mobileSearchToggle
                                    .classList
                                    .add(
                                        'is-active'
                                    );


                                setTimeout(
                                    () => {

                                        if (
                                            mobileSearchInput
                                        ) {

                                            mobileSearchInput.focus();

                                        }

                                    },
                                    150
                                );

                            }

                        }
                    );

                }



                /* =================================================
                   ESCAPE
                ================================================== */

                document.addEventListener(
                    'keydown',
                    function(event) {

                        if (
                            event.key === 'Escape' &&
                            mobileSearchPanel &&
                            mobileSearchPanel
                            .classList
                            .contains(
                                'is-open'
                            )
                        ) {

                            mobileSearchPanel
                                .classList
                                .remove(
                                    'is-open'
                                );


                            if (mobileSearchToggle) {

                                mobileSearchToggle
                                    .setAttribute(
                                        'aria-expanded',
                                        'false'
                                    );


                                mobileSearchToggle
                                    .classList
                                    .remove(
                                        'is-active'
                                    );

                            }

                        }

                    }
                );



                /* =================================================
                   WINDOW RESIZE
                ================================================== */

                window.addEventListener(
                    'resize',
                    function() {

                        if (window.innerWidth > 767.98) {

                            if (mobileSearchPanel) {

                                mobileSearchPanel
                                    .classList
                                    .remove(
                                        'is-open'
                                    );

                            }


                            if (mobileSearchToggle) {

                                mobileSearchToggle
                                    .setAttribute(
                                        'aria-expanded',
                                        'false'
                                    );


                                mobileSearchToggle
                                    .classList
                                    .remove(
                                        'is-active'
                                    );

                            }

                        }

                    }
                );

            }

        );
    </script>



    {{-- =========================================================
        CSS
    ========================================================== --}}

    <style>
        /* =========================================================
           COLOR VARIABLES
           MATCHES NOTIFICATIONS THEME
        ========================================================== */

        :root {

            --hod-page-bg: #f5f5f7;

            --hod-card-bg: #ffffff;

            --hod-input-bg: #fafafa;

            --hod-text: #111111;

            --hod-text-secondary: #666666;

            --hod-text-muted: #999999;

            --hod-border: #e5e5e5;

            --hod-border-soft: #dddddf;

            --hod-primary: #6538D9;

            --hod-primary-hover: #542cc2;

            --hod-primary-light: #f3efff;

            --hod-primary-light-hover: #ebe4ff;

            --hod-hover: #f7f7f8;

            --hod-white: #ffffff;

            --hod-black: #111111;

            --hod-shadow:
                0 2px 12px rgba(0, 0, 0, .06);

            --hod-card-shadow:
                0 2px 8px rgba(0, 0, 0, .04);
        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] {

            --hod-page-bg: #11182f;

            --hod-card-bg: #181d33;

            --hod-input-bg: #20253a;

            --hod-text: #ffffff;

            --hod-text-secondary: #c8ccdc;

            --hod-text-muted: #9298b0;

            --hod-border: #292e45;

            --hod-border-soft: #292e45;

            --hod-primary: #7c5ce3;

            --hod-primary-hover: #9278ea;

            --hod-primary-light: #27203d;

            --hod-primary-light-hover: #30274b;

            --hod-hover: #20253a;

            --hod-white: #ffffff;

            --hod-black: #000000;

            --hod-shadow:
                0 8px 24px rgba(0, 0, 0, .35);

            --hod-card-shadow:
                0 3px 12px rgba(0, 0, 0, .25);
        }


        /* =========================================================
           PAGE
        ========================================================== */

        .hod-management-page {

            min-height: 100vh;

            padding: 20px;

            background:
                var(--hod-page-bg);

            color:
                var(--hod-text);

            transition:
                background-color .2s ease,
                color .2s ease;
        }


        [data-bs-theme="dark"] body {

            background:
                var(--hod-page-bg);

            color:
                var(--hod-text);
        }



        /* =========================================================
           PAGE HEADER
        ========================================================== */

        .hod-page-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 1rem;

            width: 100%;

            margin:
                80px 0 18px;

            padding:
                20px 22px;

            background:
                var(--hod-card-bg);

            border:
                1px solid var(--hod-border);

            border-radius:
                10px;

            box-shadow:
                var(--hod-card-shadow);

            box-sizing:
                border-box;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease;
        }


        .hod-header-content {

            min-width: 0;

            flex: 1;
        }


        .hod-title-row {

            min-width: 0;
        }



        /* =========================================================
           OVERLINE
        ========================================================== */

        .hod-overline {

            display: block;

            margin-bottom: .35rem;

            color:
                var(--hod-primary);

            font-size:
                .68rem;

            font-weight:
                800;

            letter-spacing:
                .12em;

            line-height:
                1.2;

            text-transform:
                uppercase;
        }



        /* =========================================================
           TITLE
        ========================================================== */

        .hod-title {

            margin: 0;

            color:
                var(--hod-text);

            font-size:
                1.8rem;

            font-weight:
                700;

            letter-spacing:
                -.035em;

            line-height:
                1.2;
        }



        /* =========================================================
           HEADER ACTIONS
        ========================================================== */

        .hod-header-actions {

            display: flex;

            align-items: center;

            gap: .55rem;

            flex-shrink: 0;
        }



        /* =========================================================
           ADD HOD BUTTON
        ========================================================== */

        .hod-add-button {

            position: relative;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .55rem;

            min-height: 44px;

            padding:
                .7rem 1rem;

            color:
                var(--hod-white);

            background:
                var(--hod-primary);

            border:
                1px solid var(--hod-primary);

            border-radius:
                8px;

            text-decoration:
                none;

            font-size:
                .72rem;

            font-weight:
                800;

            letter-spacing:
                .03em;

            text-transform:
                uppercase;

            box-shadow:
                0 3px 10px rgba(101, 56, 217, .16);

            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }


        .hod-add-button:hover {

            color:
                var(--hod-white);

            background:
                var(--hod-primary-hover);

            border-color:
                var(--hod-primary-hover);

            text-decoration:
                none;

            transform:
                translateY(-1px);

            box-shadow:
                0 6px 16px rgba(101, 56, 217, .24);
        }


        .hod-add-button i {

            font-size:
                .9rem;
        }



        /* =========================================================
           MOBILE SEARCH BUTTON
        ========================================================== */

        .hod-mobile-search-button {

            position: relative;

            display: none;

            align-items: center;

            justify-content: center;

            width: 44px;

            height: 44px;

            padding: 0;

            color:
                var(--hod-text-secondary);

            background:
                var(--hod-input-bg);

            border:
                1px solid var(--hod-border-soft);

            border-radius:
                8px;

            cursor:
                pointer;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease;
        }


        .hod-mobile-search-button:hover,
        .hod-mobile-search-button.is-active {

            color:
                var(--hod-primary);

            background:
                var(--hod-primary-light);

            border-color:
                rgba(101, 56, 217, .35);
        }


        [data-bs-theme="dark"] .hod-mobile-search-button:hover,

        [data-bs-theme="dark"] .hod-mobile-search-button.is-active {

            color:
                var(--hod-primary);

            background:
                var(--hod-primary-light);

            border-color:
                var(--hod-primary);
        }



        /* =========================================================
           FILTER BODY
        ========================================================== */

        .hod-filter-body {

            width: 100%;

            padding:
                20px;

            background:
                var(--hod-card-bg);

            border:
                1px solid var(--hod-border);

            border-radius:
                10px;

            box-shadow:
                var(--hod-card-shadow);

            box-sizing:
                border-box;

            transition:
                background-color .2s ease,
                border-color .2s ease;
        }



        /* =========================================================
           LABEL
        ========================================================== */

        .hod-input-label {

            display: block;

            margin-bottom:
                .45rem;

            color:
                var(--hod-text-secondary);

            font-size:
                .67rem;

            font-weight:
                800;

            letter-spacing:
                .05em;

            text-transform:
                uppercase;
        }



        /* =========================================================
           SEARCH
        ========================================================== */

        .hod-search {

            position: relative;

            width: 100%;
        }


        .hod-search i {

            position: absolute;

            left:
                1rem;

            top:
                50%;

            z-index: 2;

            color:
                var(--hod-text-muted);

            transform:
                translateY(-50%);

            pointer-events:
                none;

            transition:
                color .2s ease;
        }


        .hod-search:focus-within i {

            color:
                var(--hod-primary);
        }


        .hod-search input {

            width: 100%;

            height: 45px;

            padding:
                .6rem 1rem .6rem 2.75rem;

            color:
                var(--hod-text);

            background:
                var(--hod-input-bg);

            border:
                1px solid var(--hod-border-soft);

            border-radius:
                8px;

            outline:
                none;

            font-size:
                .82rem;

            box-sizing:
                border-box;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;
        }


        .hod-search input::placeholder {

            color:
                var(--hod-text-muted);
        }


        .hod-search input:focus {

            border-color:
                var(--hod-primary);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .10);
        }



        /* =========================================================
           SELECT
        ========================================================== */

        .hod-filter-select {

            width: 100%;

            height: 45px;

            padding:
                .5rem 2rem .5rem .85rem;

            color:
                var(--hod-text);

            background:
                var(--hod-input-bg);

            border:
                1px solid var(--hod-border-soft);

            border-radius:
                8px;

            outline:
                none;

            font-size:
                .8rem;

            cursor:
                pointer;

            box-sizing:
                border-box;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;
        }


        .hod-filter-select:focus {

            border-color:
                var(--hod-primary);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .10);
        }


        .hod-filter-select option {

            color:
                #111111;

            background:
                #ffffff;
        }


        [data-bs-theme="dark"] .hod-filter-select option {

            color:
                #ffffff;

            background:
                #181d33;
        }



        /* =========================================================
           RESET BUTTON
        ========================================================== */

        .hod-reset-button {

            position: relative;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .45rem;

            width: 100%;

            height: 45px;

            padding:
                .5rem .8rem;

            color:
                var(--hod-primary);

            background:
                var(--hod-primary-light);

            border:
                1px solid rgba(101, 56, 217, .18);

            border-radius:
                8px;

            font-size:
                .7rem;

            font-weight:
                800;

            letter-spacing:
                .03em;

            text-transform:
                uppercase;

            cursor:
                pointer;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }


        .hod-reset-button:hover {

            color:
                var(--hod-white);

            background:
                var(--hod-primary);

            border-color:
                var(--hod-primary);

            transform:
                translateY(-1px);
        }



        /* =========================================================
           MOBILE SEARCH PANEL
        ========================================================== */

        .hod-mobile-search-panel {

            display: none;

            width: 100%;

            margin-top:
                1rem;

            overflow:
                hidden;

            background:
                var(--hod-card-bg);

            border:
                1px solid var(--hod-border);

            border-radius:
                10px;

            opacity:
                0;

            transform:
                translateY(-6px);

            transition:
                opacity .2s ease,
                transform .2s ease;
        }


        .hod-mobile-search-panel.is-open {

            opacity:
                1;

            transform:
                translateY(0);
        }


        .hod-mobile-search-content {

            display: flex;

            align-items: center;

            gap: .5rem;

            padding:
                .75rem;
        }


        .hod-mobile-search-input {

            position: relative;

            flex: 1;

            min-width: 0;
        }


        .hod-mobile-search-input i {

            position: absolute;

            left:
                .85rem;

            top:
                50%;

            color:
                var(--hod-text-muted);

            transform:
                translateY(-50%);

            pointer-events:
                none;
        }


        .hod-mobile-search-input input {

            width: 100%;

            height: 44px;

            padding:
                .5rem .75rem .5rem 2.5rem;

            color:
                var(--hod-text);

            background:
                var(--hod-input-bg);

            border:
                1px solid var(--hod-border-soft);

            border-radius:
                8px;

            outline:
                none;

            font-size:
                .8rem;

            box-sizing:
                border-box;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }


        .hod-mobile-search-input input::placeholder {

            color:
                var(--hod-text-muted);
        }


        .hod-mobile-search-input input:focus {

            border-color:
                var(--hod-primary);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .10);
        }


        .hod-mobile-reset-button {

            position: relative;

            display: flex;

            align-items: center;

            justify-content: center;

            width: 44px;

            height: 44px;

            flex:
                0 0 44px;

            color:
                var(--hod-primary);

            background:
                var(--hod-primary-light);

            border:
                1px solid rgba(101, 56, 217, .18);

            border-radius:
                8px;

            cursor:
                pointer;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease;
        }


        .hod-mobile-reset-button:hover {

            color:
                var(--hod-white);

            background:
                var(--hod-primary);

            border-color:
                var(--hod-primary);
        }



        /* =========================================================
           RESULTS WRAPPER
        ========================================================== */

        .hod-results-wrapper {

            position: relative;

            width: 100%;

            min-height:
                100px;

            margin-top:
                18px;
        }



        /* =========================================================
           RESULTS HEADER
        ========================================================== */

        .hod-results-header {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            width: 100%;

            margin-top: 1rem;

            margin-bottom: .75rem;
        }


        .hod-results-title {

            color:
                var(--hod-text-muted);

            font-size:
                .68rem;

            font-weight:
                800;

            letter-spacing:
                .1em;

            text-transform:
                uppercase;
        }



        /* =========================================================
           CARD / TABLE TOGGLE
        ========================================================== */

        .hod-view-toggle {

            display: inline-flex;

            align-items: center;

            gap:
                .25rem;

            padding:
                .25rem;

            background:
                var(--hod-card-bg);

            border:
                1px solid var(--hod-border);

            border-radius:
                8px;

            box-shadow:
                var(--hod-card-shadow);
        }


        .hod-view-button {

            position: relative;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap:
                .4rem;

            min-height:
                36px;

            padding:
                .45rem .75rem;

            color:
                var(--hod-text-muted);

            background:
                transparent;

            border:
                1px solid transparent;

            border-radius:
                6px;

            font-family:
                inherit;

            font-size:
                .65rem;

            font-weight:
                800;

            cursor:
                pointer;

            text-transform:
                uppercase;

            transition:
                color .2s ease,
                background-color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease;
        }


        .hod-view-button:hover {

            color:
                var(--hod-primary);

            background:
                var(--hod-primary-light);
        }


        .hod-view-button.is-active {

            color:
                #ffffff;

            background:
                var(--hod-primary);

            border-color:
                var(--hod-primary);

            box-shadow:
                0 3px 10px rgba(101, 56, 217, .20);
        }


        .hod-view-button i {

            font-size:
                .75rem;
        }



        /* =========================================================
           RESULTS CONTAINER
        ========================================================== */

        .hod-results-container {

            width: 100%;

            transition:
                opacity .2s ease;
        }


        .hod-results-container.is-loading {

            opacity:
                .45;

            pointer-events:
                none;
        }



        /* =========================================================
           CARD RESULTS
        ========================================================== */

        .hod-partial-card-results {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap:
                1.25rem;

            width:
                100%;
        }


        .hod-partial-card-results>* {

            min-width:
                0;

            width:
                100%;

            margin:
                0 !important;

            padding:
                0 !important;
        }



        /* =========================================================
           TABLE RESULTS
        ========================================================== */

        .hod-partial-table-results {

            display:
                none;

            width:
                100%;
        }


        .hod-results-container.table-mode .hod-partial-card-results {

            display:
                none;
        }


        .hod-results-container.table-mode .hod-partial-table-results {

            display:
                block;
        }



        /* =========================================================
           LOADING
        ========================================================== */

        .hod-loading {

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

            color:
                var(--hod-text);

            background:
                var(--hod-card-bg);

            border:
                1px solid var(--hod-border);

            border-radius:
                8px;

            box-shadow:
                var(--hod-shadow);

            font-size:
                .7rem;

            font-weight:
                700;

            transform:
                translateX(-50%);
        }


        .hod-spinner {

            width:
                17px;

            height:
                17px;

            flex-shrink:
                0;

            border:
                2px solid var(--hod-border);

            border-top-color:
                var(--hod-primary);

            border-radius:
                50%;

            animation:
                hodSpin .7s linear infinite;
        }


        @keyframes hodSpin {

            to {

                transform:
                    rotate(360deg);

            }

        }



        /* =========================================================
           TOOLTIP
        ========================================================== */

        .hod-mobile-search-button[data-tooltip]::after,
        .hod-add-button[data-tooltip]::after,
        .hod-reset-button[data-tooltip]::after,
        .hod-mobile-reset-button[data-tooltip]::after {

            content:
                attr(data-tooltip);

            position:
                absolute;

            left:
                50%;

            top:
                calc(100% + 8px);

            z-index:
                100;

            padding:
                .4rem .6rem;

            color:
                #ffffff;

            background:
                #111111;

            border-radius:
                5px;

            font-size:
                .62rem;

            font-weight:
                700;

            white-space:
                nowrap;

            opacity:
                0;

            pointer-events:
                none;

            transform:
                translateX(-50%) translateY(-3px);

            transition:
                opacity .15s ease,
                transform .15s ease;
        }


        .hod-mobile-search-button[data-tooltip]:hover::after,
        .hod-add-button[data-tooltip]:hover::after,
        .hod-reset-button[data-tooltip]:hover::after,
        .hod-mobile-reset-button[data-tooltip]:hover::after {

            opacity:
                1;

            transform:
                translateX(-50%) translateY(0);
        }



        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1250px) {

            .hod-partial-card-results {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

                gap:
                    1.15rem;
            }

        }


        @media (max-width: 950px) {

            .hod-partial-card-results {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap:
                    1rem;
            }

        }



        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .hod-management-page {

                padding:
                    10px;
            }


            .hod-page-header {

                margin:
                    75px 0 12px;

                padding:
                    16px;

                border-radius:
                    9px;
            }


            .hod-title {

                font-size:
                    1.45rem;
            }


            .hod-overline {

                font-size:
                    .63rem;
            }


            .hod-header-actions {

                gap:
                    .4rem;
            }


            .hod-mobile-search-button {

                display:
                    flex;
            }


            .hod-add-button {

                width:
                    44px;

                height:
                    44px;

                min-width:
                    44px;

                min-height:
                    44px;

                padding:
                    0;
            }


            .hod-add-button .hod-button-text {

                display:
                    none;
            }


            .hod-add-button i {

                font-size:
                    1rem;
            }


            .hod-filter-body {

                display:
                    none;
            }


            .hod-mobile-search-panel {

                display:
                    block;
            }


            .hod-results-wrapper {

                margin-top:
                    14px;
            }


            .hod-results-header {

                padding:
                    0 .25rem;

                margin-bottom:
                    .75rem;
            }


            .hod-partial-card-results {

                grid-template-columns:
                    1fr;

                gap:
                    1rem;

                padding:
                    0 .25rem 1rem;

                box-sizing:
                    border-box;
            }


            .hod-mobile-search-button[data-tooltip]::after,
            .hod-add-button[data-tooltip]::after,
            .hod-reset-button[data-tooltip]::after,
            .hod-mobile-reset-button[data-tooltip]::after {

                display:
                    none;
            }

        }



        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .hod-page-header {

                padding:
                    .85rem;

                margin-top:
                    70px;
            }


            .hod-title {

                font-size:
                    1.15rem;
            }


            .hod-overline {

                font-size:
                    .58rem;
            }


            .hod-mobile-search-content {

                padding:
                    .6rem;
            }


            .hod-mobile-search-input input {

                height:
                    42px;

                font-size:
                    .76rem;
            }


            .hod-mobile-reset-button {

                width:
                    42px;

                height:
                    42px;

                flex-basis:
                    42px;
            }


            .hod-mobile-search-button {

                width:
                    42px;

                height:
                    42px;
            }


            .hod-add-button {

                width:
                    42px;

                height:
                    42px;

                min-width:
                    42px;
            }


            .hod-results-title {

                font-size:
                    .58rem;
            }


            .hod-view-button {

                width:
                    36px;

                min-width:
                    36px;

                height:
                    34px;

                padding:
                    0;
            }


            .hod-view-button span {

                display:
                    none;
            }


            .hod-partial-card-results {

                gap:
                    .85rem;

                padding:
                    0 .15rem 1rem;
            }

        }



        /* =========================================================
           VERY SMALL MOBILE
        ========================================================== */

        @media (max-width: 380px) {

            .hod-title {

                font-size:
                    1.05rem;
            }


            .hod-page-header {

                gap:
                    .5rem;
            }


            .hod-header-actions {

                gap:
                    .3rem;
            }


            .hod-mobile-search-button,
            .hod-add-button {

                width:
                    40px;

                height:
                    40px;

                min-width:
                    40px;
            }

        }



        /* =========================================================
           REDUCED MOTION
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            .hod-management-page *,
            .hod-management-page *::before,
            .hod-management-page *::after {

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
