<x-app-layout>

    <div class="dashboard-content">

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
                            Head Of Department
                        </h1>

                    </div>

                </div>

            </div>


            {{-- =====================================================
            HEADER ACTIONS
            ====================================================== --}}

            <div class="hod-header-actions">

                {{-- MOBILE SEARCH TOGGLE --}}

                <button
                    type="button"
                    id="mobileSearchToggle"
                    class="hod-mobile-search-button"
                    aria-label="Open Search"
                    aria-expanded="false"
                    data-tooltip="Search"
                >
                    <i class="bi bi-search"></i>
                </button>


                {{-- ADD HOD --}}

                <div class="hod-header-action">

                    <a
                        href="{{ route('admin.hods.create') }}"
                        class="hod-add-button"
                        data-tooltip="Add New HoD"
                        aria-label="Add New HoD"
                    >

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

        <div
            id="mobileSearchPanel"
            class="hod-mobile-search-panel"
        >

            <div class="hod-mobile-search-content">

                <div class="hod-mobile-search-input">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="mobileSearchInput"
                        placeholder="Search name, email, or department..."
                        autocomplete="off"
                    >

                </div>


                <button
                    type="button"
                    id="mobileResetFilter"
                    class="hod-mobile-reset-button"
                    aria-label="Reset Search"
                    data-tooltip="Reset"
                >
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>

            </div>

        </div>


        {{-- =========================================================
        DESKTOP FILTER
        ========================================================== --}}

        <div class="hod-filter-body">

            <div class="row g-3 align-items-end">

                {{-- =================================================
                SEARCH
                ================================================== --}}

                <div class="col-12 col-lg-5">

                    <label
                        for="search"
                        class="hod-input-label"
                    >
                        Search
                    </label>

                    <div class="hod-search">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            id="search"
                            placeholder="Search name, email, or department..."
                            autocomplete="off"
                        >

                    </div>

                </div>


                {{-- =================================================
                DEPARTMENT
                ================================================== --}}

                <div class="col-12 col-md-6 col-lg-3">

                    <label
                        for="departmentFilter"
                        class="hod-input-label"
                    >
                        Department
                    </label>

                    <select
                        class="hod-filter-select"
                        id="departmentFilter"
                        name="department"
                    >

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


                {{-- =================================================
                YEAR
                ================================================== --}}

                <div class="col-12 col-md-6 col-lg-2">

                    <label
                        for="yearFilter"
                        class="hod-input-label"
                    >
                        Started Year
                    </label>

                    <select
                        class="hod-filter-select"
                        id="yearFilter"
                        name="started_year"
                    >

                        <option value="">
                            All Years
                        </option>

                        <option value="2026">
                            2026
                        </option>

                        <option value="2025">
                            2025
                        </option>

                        <option value="2024">
                            2024
                        </option>

                    </select>

                </div>


                {{-- =================================================
                RESET
                ================================================== --}}

                <div class="col-12 col-lg-2">

                    <button
                        type="button"
                        id="resetFilter"
                        class="hod-reset-button"
                        data-tooltip="Reset Filters"
                        aria-label="Reset Filters"
                    >

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

            {{-- LOADING --}}

            <div
                id="searchSpinner"
                class="hod-loading d-none"
            >

                <div class="hod-spinner"></div>

                <span>
                    Loading records...
                </span>

            </div>


            {{-- HOD CARDS --}}

            <div
                id="adminHodTable"
                class="thesis-card-grid"
            >

                @include('admin.hods.table')

            </div>

        </div>

    </div>


    {{-- =========================================================
    JAVASCRIPT
    ========================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            let searchTimeout = null;
            let currentController = null;


            /* =====================================================
               ELEMENTS
            ====================================================== */

            const searchInput =
                document.getElementById('search');

            const mobileSearchInput =
                document.getElementById('mobileSearchInput');

            const departmentFilter =
                document.getElementById('departmentFilter');

            const yearFilter =
                document.getElementById('yearFilter');

            const resetButton =
                document.getElementById('resetFilter');

            const mobileResetButton =
                document.getElementById('mobileResetFilter');

            const mobileSearchToggle =
                document.getElementById('mobileSearchToggle');

            const mobileSearchPanel =
                document.getElementById('mobileSearchPanel');

            const spinner =
                document.getElementById('searchSpinner');

            const hodGrid =
                document.getElementById('adminHodTable');


            /* =====================================================
               LOAD DATA
            ====================================================== */

            function loadData() {

                if (currentController) {

                    currentController.abort();

                }


                currentController =
                    new AbortController();


                /* SHOW LOADING */

                if (spinner) {

                    spinner.classList.remove('d-none');

                }


                if (hodGrid) {

                    hodGrid.classList.add('is-loading');

                }


                /* GET SEARCH VALUE */

                let currentSearch = '';


                if (window.innerWidth <= 767.98) {

                    currentSearch =
                        mobileSearchInput
                            ? mobileSearchInput.value
                            : '';

                } else {

                    currentSearch =
                        searchInput
                            ? searchInput.value
                            : '';

                }


                /* QUERY */

                const query = new URLSearchParams({

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


                /* AJAX REQUEST */

                fetch(
                    "{{ route('admin.hods.search') }}?" +
                    query.toString(),
                    {
                        signal:
                            currentController.signal
                    }
                )

                .then(response => {

                    if (!response.ok) {

                        throw new Error(
                            'Network response failed'
                        );

                    }

                    return response.text();

                })

                .then(html => {

                    if (hodGrid) {

                        hodGrid.innerHTML = html;

                    }

                })

                .catch(error => {

                    if (
                        error.name !==
                        'AbortError'
                    ) {

                        console.error(
                            'Error loading HoD records:',
                            error
                        );

                    }

                })

                .finally(() => {

                    if (spinner) {

                        spinner.classList.add(
                            'd-none'
                        );

                    }


                    if (hodGrid) {

                        hodGrid.classList.remove(
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
               DEPARTMENT
            ====================================================== */

            if (departmentFilter) {

                departmentFilter.addEventListener(
                    'change',
                    loadData
                );

            }


            /* =====================================================
               YEAR
            ====================================================== */

            if (yearFilter) {

                yearFilter.addEventListener(
                    'change',
                    loadData
                );

            }


            /* =====================================================
               DESKTOP RESET
            ====================================================== */

            if (resetButton) {

                resetButton.addEventListener(
                    'click',
                    function () {

                        if (searchInput) {

                            searchInput.value = '';

                        }


                        if (departmentFilter) {

                            departmentFilter.value = '';

                        }


                        if (yearFilter) {

                            yearFilter.value = '';

                        }


                        loadData();

                    }
                );

            }


            /* =====================================================
               MOBILE SEARCH TOGGLE
            ====================================================== */

            if (mobileSearchToggle) {

                mobileSearchToggle.addEventListener(
                    'click',
                    function () {

                        const isOpen =
                            mobileSearchPanel
                                .classList
                                .contains('is-open');


                        if (isOpen) {

                            mobileSearchPanel
                                .classList
                                .remove('is-open');


                            mobileSearchToggle
                                .setAttribute(
                                    'aria-expanded',
                                    'false'
                                );


                            mobileSearchToggle
                                .classList
                                .remove('is-active');

                        } else {

                            mobileSearchPanel
                                .classList
                                .add('is-open');


                            mobileSearchToggle
                                .setAttribute(
                                    'aria-expanded',
                                    'true'
                                );


                            mobileSearchToggle
                                .classList
                                .add('is-active');


                            setTimeout(() => {

                                if (mobileSearchInput) {

                                    mobileSearchInput.focus();

                                }

                            }, 150);

                        }

                    }
                );

            }


            /* =====================================================
               MOBILE RESET
            ====================================================== */

            if (mobileResetButton) {

                mobileResetButton.addEventListener(
                    'click',
                    function () {

                        if (mobileSearchInput) {

                            mobileSearchInput.value = '';

                        }


                        if (searchInput) {

                            searchInput.value = '';

                        }


                        if (departmentFilter) {

                            departmentFilter.value = '';

                        }


                        if (yearFilter) {

                            yearFilter.value = '';

                        }


                        loadData();

                    }
                );

            }


            /* =====================================================
               ESCAPE CLOSE MOBILE SEARCH
            ====================================================== */

            document.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Escape' &&
                        mobileSearchPanel &&
                        mobileSearchPanel
                            .classList
                            .contains('is-open')
                    ) {

                        mobileSearchPanel
                            .classList
                            .remove('is-open');


                        if (mobileSearchToggle) {

                            mobileSearchToggle
                                .setAttribute(
                                    'aria-expanded',
                                    'false'
                                );


                            mobileSearchToggle
                                .classList
                                .remove('is-active');

                        }

                    }

                }
            );


            /* =====================================================
               WINDOW RESIZE
            ====================================================== */

            window.addEventListener(
                'resize',
                function () {

                    if (window.innerWidth > 767.98) {

                        if (mobileSearchPanel) {

                            mobileSearchPanel
                                .classList
                                .remove('is-open');

                        }


                        if (mobileSearchToggle) {

                            mobileSearchToggle
                                .setAttribute(
                                    'aria-expanded',
                                    'false'
                                );


                            mobileSearchToggle
                                .classList
                                .remove('is-active');

                        }

                    }

                }
            );

        });

    </script>


    {{-- =========================================================
        CSS
        BLACK + WHITE
    ========================================================== --}}

    <style>

        /* =========================================================
           HOD PAGE VARIABLES
        ========================================================== */

        :root {

            --hod-black: #000000;
            --hod-white: #ffffff;

            --hod-page-bg: #ffffff;
            --hod-card-bg: #ffffff;
            --hod-input-bg: #fafafa;

            --hod-text: #000000;
            --hod-text-secondary: #333333;
            --hod-text-muted: #777777;

            --hod-border: #000000;
            --hod-border-soft: #dddddd;

            --hod-primary: #000000;

            --hod-shadow:
                0 4px 18px rgba(0, 0, 0, .07);

            --hod-card-shadow:
                0 2px 10px rgba(0, 0, 0, .05);
        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] {

            --hod-black: #000000;
            --hod-white: #ffffff;

            --hod-page-bg: #101426;
            --hod-card-bg: #181d33;
            --hod-input-bg: #20253a;

            --hod-text: #eeeef8;
            --hod-text-secondary: #d5d8e8;
            --hod-text-muted: #999fb9;

            --hod-border: #ffffff;
            --hod-border-soft: #292e45;

            --hod-primary: #ffffff;

            --hod-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

            --hod-card-shadow:
                0 2px 10px rgba(0, 0, 0, .30);
        }


        /* =========================================================
           PAGE
        ========================================================== */

        .dashboard-content {

            color:
                var(--hod-text);

            transition:
                color .25s ease,
                background-color .25s ease;
        }


        [data-bs-theme="dark"] body {

            background: #101426;

            color: #eeeef8;
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

            padding: 15px;

            background:
                var(--hod-card-bg);

            box-sizing: border-box;
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

            margin-bottom: .25rem;

            color:
                var(--hod-text-muted);

            font-size: .7rem;

            font-weight: 800;

            letter-spacing: .12em;

            line-height: 1.2;

            text-transform: uppercase;
        }


        /* =========================================================
           TITLE
        ========================================================== */

        .hod-title {

            margin: 0;

            color:
                var(--hod-text);

            font-size: 1.8rem;

            font-weight: 600;

            letter-spacing: -.035em;

            line-height: 1.2;
        }


        /* =========================================================
           HEADER ACTIONS
        ========================================================== */

        .hod-header-actions {

            display: flex;

            align-items: center;

            gap: .5rem;

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

            padding: .7rem 1rem;

            color:
                var(--hod-white);

            background:
                var(--hod-black);

            border:
                1px solid var(--hod-black);

            border-radius: 8px;

            text-decoration: none;

            font-size: .72rem;

            font-weight: 800;

            letter-spacing: .03em;

            text-transform: uppercase;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }


        [data-bs-theme="dark"] .hod-add-button {

            color:
                var(--hod-black);

            background:
                var(--hod-white);

            border-color:
                var(--hod-white);
        }


        .hod-add-button:hover {

            color:
                var(--hod-black);

            background:
                var(--hod-white);

            border-color:
                var(--hod-black);

            transform:
                translateY(-1px);

            box-shadow:
                0 5px 14px rgba(0, 0, 0, .12);
        }


        [data-bs-theme="dark"] .hod-add-button:hover {

            color:
                var(--hod-white);

            background:
                var(--hod-black);

            border-color:
                var(--hod-white);

            box-shadow:
                0 5px 14px rgba(255, 255, 255, .08);
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
                var(--hod-text);

            background:
                var(--hod-card-bg);

            border:
                1px solid var(--hod-border-soft);

            border-radius: 8px;

            cursor: pointer;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }


        .hod-mobile-search-button:hover,
        .hod-mobile-search-button.is-active {

            color:
                var(--hod-white);

            background:
                var(--hod-black);

            border-color:
                var(--hod-black);
        }


        [data-bs-theme="dark"]
        .hod-mobile-search-button:hover,

        [data-bs-theme="dark"]
        .hod-mobile-search-button.is-active {

            color:
                var(--hod-black);

            background:
                var(--hod-white);

            border-color:
                var(--hod-white);
        }


        /* =========================================================
           FILTER BODY
        ========================================================== */

        .hod-filter-body {

            width: 100%;

            padding: 1.2rem 1.25rem;

            background:
                var(--hod-card-bg);

            box-sizing: border-box;
        }


        /* =========================================================
           FILTER LABEL
        ========================================================== */

        .hod-input-label {

            display: block;

            margin-bottom: .45rem;

            color:
                var(--hod-text-secondary);

            font-size: .67rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;
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

            left: 1rem;

            top: 50%;

            z-index: 2;

            color:
                var(--hod-text-muted);

            transform:
                translateY(-50%);

            pointer-events: none;
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

            border-radius: 8px;

            outline: none;

            font-size: .82rem;

            box-sizing: border-box;

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
                0 0 0 3px rgba(0, 0, 0, .08);
        }


        [data-bs-theme="dark"]
        .hod-search input:focus {

            box-shadow:
                0 0 0 3px rgba(255, 255, 255, .10);
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

            border-radius: 8px;

            outline: none;

            font-size: .8rem;

            cursor: pointer;

            box-sizing: border-box;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;
        }


        .hod-filter-select:focus {

            border-color:
                var(--hod-primary);

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, .08);
        }


        [data-bs-theme="dark"]
        .hod-filter-select:focus {

            box-shadow:
                0 0 0 3px rgba(255, 255, 255, .10);
        }


        .hod-filter-select option {

            color: #000000;

            background: #ffffff;
        }


        [data-bs-theme="dark"]
        .hod-filter-select option {

            color: #ffffff;

            background: #181d33;
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

            padding: .5rem .8rem;

            color:
                var(--hod-text);

            background:
                var(--hod-input-bg);

            border:
                1px solid var(--hod-border-soft);

            border-radius: 8px;

            font-size: .7rem;

            font-weight: 800;

            letter-spacing: .03em;

            text-transform: uppercase;

            cursor: pointer;

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
                var(--hod-black);

            border-color:
                var(--hod-black);

            transform:
                translateY(-1px);
        }


        [data-bs-theme="dark"]
        .hod-reset-button:hover {

            color:
                var(--hod-black);

            background:
                var(--hod-white);

            border-color:
                var(--hod-white);
        }


        /* =========================================================
           MOBILE SEARCH PANEL
        ========================================================== */

        .hod-mobile-search-panel {

            display: none;

            width: 100%;

            margin-top: 1rem;

            overflow: hidden;

            background:
                var(--hod-card-bg);

            border:
                1px solid var(--hod-border-soft);

            border-radius: 10px;

            opacity: 0;

            transform:
                translateY(-6px);

            transition:
                opacity .2s ease,
                transform .2s ease;
        }


        .hod-mobile-search-panel.is-open {

            opacity: 1;

            transform:
                translateY(0);
        }


        .hod-mobile-search-content {

            display: flex;

            align-items: center;

            gap: .5rem;

            padding: .75rem;
        }


        .hod-mobile-search-input {

            position: relative;

            flex: 1;

            min-width: 0;
        }


        .hod-mobile-search-input i {

            position: absolute;

            left: .85rem;

            top: 50%;

            color:
                var(--hod-text-muted);

            transform:
                translateY(-50%);

            pointer-events: none;
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

            border-radius: 8px;

            outline: none;

            font-size: .8rem;

            box-sizing: border-box;
        }


        .hod-mobile-search-input input::placeholder {

            color:
                var(--hod-text-muted);
        }


        .hod-mobile-search-input input:focus {

            border-color:
                var(--hod-primary);

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, .08);
        }


        [data-bs-theme="dark"]
        .hod-mobile-search-input input:focus {

            box-shadow:
                0 0 0 3px rgba(255, 255, 255, .10);
        }


        /* =========================================================
           MOBILE RESET
        ========================================================== */

        .hod-mobile-reset-button {

            position: relative;

            display: flex;

            align-items: center;

            justify-content: center;

            width: 44px;

            height: 44px;

            flex: 0 0 44px;

            color:
                var(--hod-text);

            background:
                var(--hod-card-bg);

            border:
                1px solid var(--hod-border-soft);

            border-radius: 8px;

            cursor: pointer;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease;
        }


        .hod-mobile-reset-button:hover {

            color:
                var(--hod-white);

            background:
                var(--hod-black);

            border-color:
                var(--hod-black);
        }


        [data-bs-theme="dark"]
        .hod-mobile-reset-button:hover {

            color:
                var(--hod-black);

            background:
                var(--hod-white);

            border-color:
                var(--hod-white);
        }


        /* =========================================================
           RESULTS WRAPPER
        ========================================================== */

        .hod-results-wrapper {

            position: relative;

            width: 100%;

            min-height: 100px;

            margin-top: 1rem;
        }


        /* =========================================================
           HOD CARD GRID
           4 CARDS PER ROW
        ========================================================== */

        #adminHodTable {

            --bs-gutter-x: 0;
            --bs-gutter-y: 0;

            display: grid !important;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 1.25rem;

            width: 100%;

            margin: 0;

            padding: 0;

            box-sizing: border-box;

            transition:
                opacity .2s ease;
        }


        /* =========================================================
           REMOVE BOOTSTRAP ROW PSEUDO ELEMENTS
        ========================================================== */

        #adminHodTable::before,
        #adminHodTable::after {

            display: none !important;
        }


        /* =========================================================
           GRID CHILDREN
        ========================================================== */

        #adminHodTable > * {

            min-width: 0;

            width: 100%;

            margin: 0 !important;

            padding: 0 !important;
        }


        /* =========================================================
           LOADING STATE
        ========================================================== */

        #adminHodTable.is-loading {

            opacity: .45;

            pointer-events: none;
        }


        /* =========================================================
           LOADING
        ========================================================== */

        .hod-loading {

            position: absolute;

            top: 1rem;

            left: 50%;

            z-index: 50;

            display: flex;

            align-items: center;

            gap: .6rem;

            padding: .65rem .9rem;

            color:
                var(--hod-text);

            background:
                var(--hod-card-bg);

            border:
                1px solid var(--hod-border-soft);

            border-radius: 8px;

            box-shadow:
                var(--hod-shadow);

            font-size: .7rem;

            font-weight: 700;

            transform:
                translateX(-50%);
        }


        .hod-spinner {

            width: 17px;

            height: 17px;

            flex-shrink: 0;

            border:
                2px solid var(--hod-border-soft);

            border-top-color:
                var(--hod-primary);

            border-radius: 50%;

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

            position: absolute;

            left: 50%;

            top: calc(100% + 8px);

            z-index: 100;

            padding: .4rem .6rem;

            color:
                var(--hod-white);

            background:
                var(--hod-black);

            border-radius: 5px;

            font-size: .62rem;

            font-weight: 700;

            white-space: nowrap;

            opacity: 0;

            pointer-events: none;

            transform:
                translateX(-50%)
                translateY(-3px);

            transition:
                opacity .15s ease,
                transform .15s ease;
        }


        .hod-mobile-search-button[data-tooltip]:hover::after,
        .hod-add-button[data-tooltip]:hover::after,
        .hod-reset-button[data-tooltip]:hover::after,
        .hod-mobile-reset-button[data-tooltip]:hover::after {

            opacity: 1;

            transform:
                translateX(-50%)
                translateY(0);
        }


        /* =========================================================
           3 CARDS
        ========================================================== */

        @media (max-width: 1250px) {

            #adminHodTable {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

                gap: 1.15rem;
            }

        }


        /* =========================================================
           2 CARDS
        ========================================================== */

        @media (max-width: 950px) {

            #adminHodTable {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 1rem;
            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            /* =====================================================
               HEADER
            ====================================================== */

            .hod-page-header {

                gap: 1rem;

                padding: 1rem;
            }


            .hod-title {

                font-size: 1.45rem;
            }


            .hod-overline {

                font-size: .65rem;
            }


            /* =====================================================
               HEADER ACTIONS
            ====================================================== */

            .hod-header-actions {

                gap: .4rem;
            }


            .hod-mobile-search-button {

                display: flex;
            }


            .hod-add-button {

                width: 44px;

                height: 44px;

                min-width: 44px;

                min-height: 44px;

                padding: 0;
            }


            .hod-add-button .hod-button-text {

                display: none;
            }


            .hod-add-button i {

                font-size: 1rem;
            }


            /* =====================================================
               HIDE DESKTOP FILTER
            ====================================================== */

            .hod-filter-body {

                display: none;
            }


            /* =====================================================
               SHOW MOBILE SEARCH
            ====================================================== */

            .hod-mobile-search-panel {

                display: block;
            }


            /* =====================================================
               RESULTS
            ====================================================== */

            .hod-results-wrapper {

                margin-top: 1rem;
            }


            /* =====================================================
               ONE CARD PER ROW
            ====================================================== */

            #adminHodTable {

                grid-template-columns: 1fr;

                gap: 1rem;

                padding:
                    0 .75rem 1rem;
            }


            #adminHodTable > * {

                width: 100%;
            }


            /* =====================================================
               HIDE TOOLTIP
            ====================================================== */

            .hod-mobile-search-button[data-tooltip]::after,
            .hod-add-button[data-tooltip]::after,
            .hod-reset-button[data-tooltip]::after,
            .hod-mobile-reset-button[data-tooltip]::after {

                display: none;
            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .hod-page-header {

                padding: .85rem;
            }


            .hod-title {

                font-size: 1.15rem;
            }


            .hod-overline {

                font-size: .6rem;
            }


            .hod-mobile-search-content {

                padding: .6rem;
            }


            .hod-mobile-search-input input {

                height: 42px;

                font-size: .76rem;
            }


            .hod-mobile-reset-button {

                width: 42px;

                height: 42px;

                flex-basis: 42px;
            }


            .hod-mobile-search-button {

                width: 42px;

                height: 42px;
            }


            .hod-add-button {

                width: 42px;

                height: 42px;

                min-width: 42px;
            }


            #adminHodTable {

                gap: .85rem;

                padding:
                    0 .65rem 1rem;
            }

        }


        /* =========================================================
           VERY SMALL MOBILE
        ========================================================== */

        @media (max-width: 380px) {

            .hod-title {

                font-size: 1.05rem;
            }


            .hod-page-header {

                gap: .5rem;
            }


            .hod-header-actions {

                gap: .3rem;
            }


            .hod-mobile-search-button,
            .hod-add-button {

                width: 40px;

                height: 40px;

                min-width: 40px;
            }

        }


        /* =========================================================
           REDUCED MOTION
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            .dashboard-content *,
            .dashboard-content *::before,
            .dashboard-content *::after {

                animation-duration: .01ms !important;

                animation-iteration-count: 1 !important;

                transition-duration: .01ms !important;
            }

        }

    </style>

</x-app-layout>