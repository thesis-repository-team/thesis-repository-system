<x-app-layout>

    <div class="dashboard-content student-page">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="student-page-header">

            <div class="student-header-content">

                <div class="student-title-row">

                    <div>

                        <span class="student-overline">
                            MANAGEMENT
                        </span>

                        <h1 class="student-title">
                            Student
                        </h1>

                    </div>

                </div>

            </div>

            {{-- HEADER ACTIONS --}}

            <div class="student-header-actions">

                {{-- MOBILE SEARCH TOGGLE --}}
                <button
                    type="button"
                    id="mobileSearchToggle"
                    class="student-mobile-search-button"
                    aria-label="Open Search"
                    aria-expanded="false"
                    data-tooltip="Search">

                    <i class="bi bi-search"></i>

                </button>

            </div>

        </div>


        {{-- =========================================================
            MOBILE SEARCH PANEL
        ========================================================== --}}

        <div
            id="mobileSearchPanel"
            class="student-mobile-search-panel">

            <div class="student-mobile-search-content">

                <div class="student-mobile-search-input">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="mobileSearchInput"
                        placeholder="Search name, department, email..."
                        autocomplete="off">

                </div>

                <button
                    type="button"
                    id="mobileResetFilter"
                    class="student-mobile-reset-button"
                    aria-label="Reset Search"
                    data-tooltip="Reset">

                    <i class="bi bi-arrow-counterclockwise"></i>

                </button>

            </div>

        </div>


        {{-- =========================================================
            DESKTOP FILTER BAR
        ========================================================== --}}

        <div class="student-filter-card">

            <div class="student-filter-body">

                <div class="row g-3 align-items-end">

                    {{-- SEARCH --}}

                    <div class="col-12 col-lg-5">

                        <label
                            for="search"
                            class="student-input-label">

                            Search

                        </label>

                        <div class="student-search">

                            <i class="bi bi-search"></i>

                            <input
                                type="text"
                                id="search"
                                placeholder="Search name, department, email..."
                                autocomplete="off">

                        </div>

                    </div>


                    {{-- DEPARTMENT --}}

                    <div class="col-12 col-md-4 col-lg-2">

                        <label
                            for="departmentFilter"
                            class="student-input-label">

                            Department

                        </label>

                        <select
                            class="student-filter-select"
                            id="departmentFilter"
                            name="department">

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

                    <div class="col-12 col-md-4 col-lg-2">

                        <label
                            for="yearFilter"
                            class="student-input-label">

                            Started Year

                        </label>

                        <select
                            class="student-filter-select student-year-select"
                            id="yearFilter"
                            name="started_year">

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


                    {{-- RESET --}}

                    <div class="col-12 col-md-4 col-lg-3">

                        <button
                            type="button"
                            id="resetFilter"
                            class="student-reset-button"
                            data-tooltip="Reset Filters"
                            aria-label="Reset Filters">

                            <i class="bi bi-arrow-counterclockwise"></i>

                            <span class="student-button-text">
                                Reset
                            </span>

                        </button>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            SUCCESS MESSAGE
        ========================================================== --}}

        @if (session('success'))

            <div
                class="student-success-alert"
                role="alert">

                <div class="student-alert-content">

                    <i class="bi bi-check-circle"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

                <button
                    type="button"
                    class="student-alert-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">

                    <i class="bi bi-x-lg"></i>

                </button>

            </div>

        @endif


        {{-- =========================================================
            STUDENT RESULTS
        ========================================================== --}}

        <div class="student-results-wrapper">

            @if ($students->count())

                {{-- LOADING --}}

                <div
                    id="studentSearchSpinner"
                    class="student-loading d-none">

                    <div class="student-spinner"></div>

                    <span>
                        Loading students...
                    </span>

                </div>


                {{-- =================================================
                    STUDENT GRID
                    4 CARDS PER ROW
                ================================================== --}}

                <div
                    id="adminStudentTable"
                    class="thesis-card-grid">

                    @include('admin.students.table')

                </div>

            @else

                {{-- EMPTY STATE --}}

                <div class="student-empty-state">

                    <div class="student-empty-icon">

                        <i class="bi bi-people"></i>

                    </div>

                    <h5>
                        No Students Found
                    </h5>

                    <p>
                        There are currently no students available.
                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- =============================================================
        JAVASCRIPT
    ============================================================== --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

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

                const studentGrid =
                    document.getElementById('adminStudentTable');

                const spinner =
                    document.getElementById('studentSearchSpinner');


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

                        spinner.classList.remove(
                            'd-none'
                        );

                    }

                    if (studentGrid) {

                        studentGrid.classList.add(
                            'is-loading'
                        );

                    }


                    /* GET SEARCH VALUE */

                    let search = '';

                    if (window.innerWidth <= 767.98) {

                        search =
                            mobileSearchInput
                                ? mobileSearchInput.value
                                : '';

                    } else {

                        search =
                            searchInput
                                ? searchInput.value
                                : '';

                    }


                    /* DEPARTMENT */

                    const department =
                        departmentFilter
                            ? departmentFilter.value
                            : '';


                    /* YEAR */

                    const year =
                        yearFilter
                            ? yearFilter.value
                            : '';


                    /* BUILD QUERY */

                    const query =
                        new URLSearchParams({

                            search: search,
                            department: department,
                            year: year

                        });


                    /* AJAX REQUEST */

                    fetch(
                        "{{ route('admin.students.search') }}?" +
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

                    .then(data => {

                        if (studentGrid) {

                            studentGrid.innerHTML =
                                data;

                        }

                    })

                    .catch(error => {

                        if (
                            error.name !==
                            'AbortError'
                        ) {

                            console.error(
                                'Error loading students:',
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

                        if (studentGrid) {

                            studentGrid.classList.remove(
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
                   DEPARTMENT FILTER
                ====================================================== */

                if (departmentFilter) {

                    departmentFilter.addEventListener(
                        'change',
                        loadData
                    );

                }


                /* =====================================================
                   YEAR FILTER
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
                    );

                }


                /* =====================================================
                   MOBILE SEARCH TOGGLE
                ====================================================== */

                if (
                    mobileSearchToggle &&
                    mobileSearchPanel
                ) {

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


                                setTimeout(
                                    function () {

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
                   ESCAPE KEY
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
                   RESIZE
                ====================================================== */

                window.addEventListener(
                    'resize',
                    function () {

                        if (
                            window.innerWidth >
                            767.98
                        ) {

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

            }
        );

    </script>


    {{-- =============================================================
        CSS
    ============================================================== --}}

    <style>

        /* =========================================================
           VARIABLES
        ========================================================== */

        :root {

            --student-black: #000000;
            --student-white: #ffffff;

            --student-page-bg: #ffffff;
            --student-card-bg: #ffffff;
            --student-input-bg: #fafafa;

            --student-text: #000000;
            --student-text-secondary: #333333;
            --student-text-muted: #777777;

            --student-border: #000000;
            --student-border-soft: #dddddd;

            --student-shadow:
                0 4px 18px rgba(0, 0, 0, .07);

            --student-card-shadow:
                0 2px 10px rgba(0, 0, 0, .05);

            --student-primary: #000000;

        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] {

            --student-black: #000000;
            --student-white: #ffffff;

            --student-page-bg: #101426;
            --student-card-bg: #181d33;
            --student-input-bg: #20253a;

            --student-text: #eeeef8;
            --student-text-secondary: #d5d8e8;
            --student-text-muted: #999fb9;

            --student-border: #ffffff;
            --student-border-soft: #292e45;

            --student-primary: #ffffff;

            --student-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

            --student-card-shadow:
                0 2px 10px rgba(0, 0, 0, .30);

        }


        /* =========================================================
           DARK MODE - BODY
        ========================================================== */

        [data-bs-theme="dark"] body {

            background: #101426;

            color: #eeeef8;

        }


        /* =========================================================
           DARK MODE - PAGE
        ========================================================== */

        [data-bs-theme="dark"] .student-page {

            background: #101426;

            color: #eeeef8;

        }


        /* =========================================================
           PAGE
        ========================================================== */

        .student-page {

            color:
                var(--student-text);

            transition:
                color .25s ease,
                background-color .25s ease;

        }


        /* =========================================================
           HEADER
        ========================================================== */

        .student-page-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 1rem;

            padding: 15px;

            background:
                var(--student-page-bg);

            box-sizing: border-box;

        }


        [data-bs-theme="dark"]
        .student-page-header {

            background: #171b30;

            border-color: #282d43;

        }


        .student-header-content {

            min-width: 0;

            flex: 1;

        }


        .student-title-row {

            display: flex;

            align-items: center;

        }


        .student-overline {

            display: block;

            margin-bottom: .2rem;

            color:
                var(--student-text-muted);

            font-size: .7rem;

            font-weight: 800;

            letter-spacing: .13em;

            line-height: 1.2;

            text-transform: uppercase;

        }


        .student-title {

            margin: 0;

            color:
                var(--student-text);

            font-size: 1.8rem;

            font-weight: 600;

            line-height: 1.2;

            letter-spacing: -.035em;

        }


        [data-bs-theme="dark"]
        .student-title {

            color: #ffffff;

        }


        [data-bs-theme="dark"]
        .student-overline {

            color: #999fb9;

        }


        /* =========================================================
           HEADER ACTIONS
        ========================================================== */

        .student-header-actions {

            display: flex;

            align-items: center;

            gap: .5rem;

            flex-shrink: 0;

        }


        /* =========================================================
           MOBILE SEARCH BUTTON
        ========================================================== */

        .student-mobile-search-button {

            position: relative;

            display: none;

            align-items: center;

            justify-content: center;

            width: 44px;

            height: 44px;

            padding: 0;

            color:
                var(--student-text);

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 8px;

            cursor: pointer;

            transition:
                .2s ease;

        }


        .student-mobile-search-button:hover,
        .student-mobile-search-button.is-active {

            color:
                var(--student-white);

            background:
                var(--student-black);

            border-color:
                var(--student-black);

        }


        [data-bs-theme="dark"]
        .student-mobile-search-button {

            color: #ffffff;

            background: #181d33;

            border-color: #292e45;

        }


        [data-bs-theme="dark"]
        .student-mobile-search-button:hover,

        [data-bs-theme="dark"]
        .student-mobile-search-button.is-active {

            color: #000000;

            background: #ffffff;

            border-color: #ffffff;

        }


        /* =========================================================
           FILTER CARD
        ========================================================== */

        .student-filter-card {

            width: 100%;

            background:
                var(--student-card-bg);

            box-sizing: border-box;

        }


        .student-filter-body {

            overflow: hidden;

            padding:
                1.2rem 1.25rem;

            background:
                var(--student-card-bg);

        }


        [data-bs-theme="dark"]
        .student-filter-card,

        [data-bs-theme="dark"]
        .student-filter-body {

            background: #181d33;

            border-color: #292e45;

        }


        /* =========================================================
           FILTER LABEL
        ========================================================== */

        .student-input-label {

            display: block;

            margin-bottom: .45rem;

            color:
                var(--student-text-secondary);

            font-size: .67rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;

        }


        [data-bs-theme="dark"]
        .student-input-label {

            color: #d5d8e8;

        }


        /* =========================================================
           SEARCH
        ========================================================== */

        .student-search {

            position: relative;

        }


        .student-search i {

            position: absolute;

            top: 50%;

            left: 1rem;

            z-index: 2;

            transform:
                translateY(-50%);

            color:
                var(--student-text-muted);

            pointer-events: none;

        }


        .student-search input {

            width: 100%;

            height: 45px;

            padding:
                .6rem 1rem .6rem 2.75rem;

            color:
                var(--student-text);

            background:
                var(--student-input-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 8px;

            outline: none;

            font-size: .82rem;

            box-sizing: border-box;

            transition:
                .2s ease;

        }


        .student-search input::placeholder {

            color:
                var(--student-text-muted);

        }


        .student-search input:focus,
        .student-filter-select:focus {

            border-color:
                var(--student-primary);

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, .08);

        }


        [data-bs-theme="dark"]
        .student-search input {

            color: #ffffff;

            background: #20253a;

            border-color: #343a52;

        }


        [data-bs-theme="dark"]
        .student-search input::placeholder {

            color: #777f9c;

        }


        [data-bs-theme="dark"]
        .student-search i {

            color: #999fb9;

        }


        [data-bs-theme="dark"]
        .student-search input:focus {

            border-color: #ffffff;

            box-shadow:
                0 0 0 3px rgba(255, 255, 255, .10);

        }


        /* =========================================================
           SELECT
        ========================================================== */

        .student-filter-select {

            width: 100%;

            height: 45px;

            padding:
                .5rem 2rem .5rem .85rem;

            color:
                var(--student-text);

            background:
                var(--student-input-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 8px;

            outline: none;

            font-size: .8rem;

            cursor: pointer;

            box-sizing: border-box;

            transition:
                .2s ease;

        }


        .student-filter-select option {

            color: #000000;

            background: #ffffff;

        }


        [data-bs-theme="dark"]
        .student-filter-select {

            color: #ffffff;

            background: #20253a;

            border-color: #343a52;

        }


        [data-bs-theme="dark"]
        .student-filter-select option {

            color: #ffffff;

            background: #20253a;

        }


        [data-bs-theme="dark"]
        .student-filter-select:focus {

            border-color: #ffffff;

            box-shadow:
                0 0 0 3px rgba(255, 255, 255, .10);

        }


        .student-year-select {

            font-family:
                monospace;

        }


        /* =========================================================
           RESET BUTTON
        ========================================================== */

        .student-reset-button {

            position: relative;

            width: 100%;

            height: 45px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .45rem;

            color:
                var(--student-text);

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 8px;

            font-size: .7rem;

            font-weight: 800;

            text-transform: uppercase;

            cursor: pointer;

            transition:
                .2s ease;

        }


        .student-reset-button:hover {

            color:
                var(--student-white);

            background:
                var(--student-black);

            border-color:
                var(--student-black);

        }


        [data-bs-theme="dark"]
        .student-reset-button {

            color: #ffffff;

            background: #20253a;

            border-color: #343a52;

        }


        [data-bs-theme="dark"]
        .student-reset-button:hover {

            color: #000000;

            background: #ffffff;

            border-color: #ffffff;

        }


        /* =========================================================
           SUCCESS ALERT
        ========================================================== */

        .student-success-alert {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 1rem;

            margin:
                0 1.25rem 1rem;

            padding:
                .9rem 1rem;

            color:
                var(--student-text);

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-left:
                4px solid var(--student-text);

            border-radius: 8px;

            box-shadow:
                var(--student-card-shadow);

            box-sizing: border-box;

        }


        [data-bs-theme="dark"]
        .student-success-alert {

            color: #eeeef8;

            background: #181d33;

            border-color: #292e45;

            border-left-color: #ffffff;

            box-shadow:
                0 2px 10px rgba(0, 0, 0, .30);

        }


        .student-alert-content {

            display: flex;

            align-items: center;

            gap: .6rem;

            font-size: .8rem;

            font-weight: 600;

        }


        .student-alert-content i {

            font-size: 1rem;

        }


        .student-alert-close {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 30px;

            height: 30px;

            padding: 0;

            color:
                var(--student-text);

            background:
                transparent;

            border: 0;

            cursor: pointer;

            opacity: .65;

            transition:
                .2s ease;

        }


        .student-alert-close:hover {

            opacity: 1;

        }


        [data-bs-theme="dark"]
        .student-alert-close {

            color: #ffffff;

        }


        /* =========================================================
           RESULTS
        ========================================================== */

        .student-results-wrapper {

            position: relative;

            width: 100%;

            box-sizing: border-box;

        }


        /* =========================================================
           STUDENT GRID
           4 CARDS PER ROW
        ========================================================== */

        .thesis-card-grid {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 1.25rem;

            width: 100%;

            margin-top: 1rem;

            box-sizing: border-box;

            transition:
                opacity .2s ease;

        }


        .thesis-card-grid.is-loading {

            opacity: .45;

            pointer-events: none;

        }


        /* =========================================================
           DARK STUDENT CARD SUPPORT
        ========================================================== */

        [data-bs-theme="dark"]
        .thesis-card-grid > * {

            color: #eeeef8;

        }


        [data-bs-theme="dark"]
        .student-card,

        [data-bs-theme="dark"]
        .student-item,

        [data-bs-theme="dark"]
        .student-list-item,

        [data-bs-theme="dark"]
        .student-result-card,

        [data-bs-theme="dark"]
        .admin-student-card,

        [data-bs-theme="dark"]
        .admin-student-item {

            background: #181d33;

            color: #eeeef8;

            border-color: #292e45;

            box-shadow:
                0 2px 10px rgba(0, 0, 0, .30);

        }


        [data-bs-theme="dark"]
        .student-card:hover,

        [data-bs-theme="dark"]
        .student-item:hover,

        [data-bs-theme="dark"]
        .student-list-item:hover,

        [data-bs-theme="dark"]
        .student-result-card:hover,

        [data-bs-theme="dark"]
        .admin-student-card:hover,

        [data-bs-theme="dark"]
        .admin-student-item:hover {

            background: #1b2038;

            border-color: #343a52;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

        }


        [data-bs-theme="dark"]
        .student-card h1,

        [data-bs-theme="dark"]
        .student-card h2,

        [data-bs-theme="dark"]
        .student-card h3,

        [data-bs-theme="dark"]
        .student-card h4,

        [data-bs-theme="dark"]
        .student-card h5,

        [data-bs-theme="dark"]
        .student-card h6,

        [data-bs-theme="dark"]
        .student-item h1,

        [data-bs-theme="dark"]
        .student-item h2,

        [data-bs-theme="dark"]
        .student-item h3,

        [data-bs-theme="dark"]
        .student-item h4,

        [data-bs-theme="dark"]
        .student-item h5,

        [data-bs-theme="dark"]
        .student-item h6,

        [data-bs-theme="dark"]
        .student-card-title,

        [data-bs-theme="dark"]
        .student-name {

            color: #ffffff;

        }


        [data-bs-theme="dark"]
        .student-card p,

        [data-bs-theme="dark"]
        .student-card span,

        [data-bs-theme="dark"]
        .student-item p,

        [data-bs-theme="dark"]
        .student-item span,

        [data-bs-theme="dark"]
        .student-email,

        [data-bs-theme="dark"]
        .student-department,

        [data-bs-theme="dark"]
        .student-year,

        [data-bs-theme="dark"]
        .student-info,

        [data-bs-theme="dark"]
        .student-info span {

            color: #999fb9;

        }


        /* =========================================================
           LOADING
        ========================================================== */

        .student-loading {

            position: absolute;

            top: 1rem;

            left: 50%;

            z-index: 50;

            display: flex;

            align-items: center;

            gap: .6rem;

            padding:
                .65rem .9rem;

            transform:
                translateX(-50%);

            color:
                var(--student-text);

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 8px;

            box-shadow:
                var(--student-shadow);

            font-size: .7rem;

            font-weight: 700;

            white-space: nowrap;

        }


        [data-bs-theme="dark"]
        .student-loading {

            color: #ffffff;

            background: #181d33;

            border-color: #292e45;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

        }


        .student-spinner {

            width: 17px;

            height: 17px;

            border:
                2px solid var(--student-border-soft);

            border-top-color:
                var(--student-primary);

            border-radius: 50%;

            animation:
                studentSpin .7s linear infinite;

        }


        [data-bs-theme="dark"]
        .student-spinner {

            border-color: #343a52;

            border-top-color: #ffffff;

        }


        @keyframes studentSpin {

            to {

                transform:
                    rotate(360deg);

            }

        }


        /* =========================================================
           MOBILE SEARCH PANEL
        ========================================================== */

        .student-mobile-search-panel {

            display: none;

            margin-bottom: 1rem;

            overflow: hidden;

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 10px;

            opacity: 0;

            transform:
                translateY(-6px);

            transition:
                opacity .2s ease,
                transform .2s ease;

        }


        .student-mobile-search-panel.is-open {

            opacity: 1;

            transform:
                translateY(0);

        }


        [data-bs-theme="dark"]
        .student-mobile-search-panel {

            background: #181d33;

            border-color: #292e45;

        }


        .student-mobile-search-content {

            display: flex;

            align-items: center;

            gap: .5rem;

            padding: .75rem;

        }


        .student-mobile-search-input {

            position: relative;

            flex: 1;

        }


        .student-mobile-search-input i {

            position: absolute;

            top: 50%;

            left: .85rem;

            transform:
                translateY(-50%);

            color:
                var(--student-text-muted);

            pointer-events: none;

        }


        .student-mobile-search-input input {

            width: 100%;

            height: 44px;

            padding:
                .5rem .75rem .5rem 2.5rem;

            color:
                var(--student-text);

            background:
                var(--student-input-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 8px;

            outline: none;

            font-size: .8rem;

            box-sizing: border-box;

        }


        [data-bs-theme="dark"]
        .student-mobile-search-input input {

            color: #ffffff;

            background: #20253a;

            border-color: #343a52;

        }


        [data-bs-theme="dark"]
        .student-mobile-search-input input::placeholder {

            color: #777f9c;

        }


        [data-bs-theme="dark"]
        .student-mobile-search-input i {

            color: #999fb9;

        }


        .student-mobile-search-input input:focus {

            border-color:
                var(--student-primary);

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, .08);

        }


        [data-bs-theme="dark"]
        .student-mobile-search-input input:focus {

            border-color: #ffffff;

            box-shadow:
                0 0 0 3px rgba(255, 255, 255, .10);

        }


        /* =========================================================
           MOBILE RESET
        ========================================================== */

        .student-mobile-reset-button {

            position: relative;

            display: flex;

            align-items: center;

            justify-content: center;

            width: 44px;

            height: 44px;

            flex-shrink: 0;

            color:
                var(--student-text);

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 8px;

            cursor: pointer;

            transition:
                .2s ease;

        }


        .student-mobile-reset-button:hover {

            color:
                var(--student-white);

            background:
                var(--student-black);

            border-color:
                var(--student-black);

        }


        [data-bs-theme="dark"]
        .student-mobile-reset-button {

            color: #ffffff;

            background: #20253a;

            border-color: #343a52;

        }


        [data-bs-theme="dark"]
        .student-mobile-reset-button:hover {

            color: #000000;

            background: #ffffff;

            border-color: #ffffff;

        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .student-empty-state {

            padding:
                4rem 1rem;

            text-align: center;

            color:
                var(--student-text);

        }


        [data-bs-theme="dark"]
        .student-empty-state {

            color: #eeeef8;

        }


        .student-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 70px;

            height: 70px;

            margin:
                0 auto 1rem;

            color:
                var(--student-text);

            background:
                var(--student-input-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 50%;

        }


        [data-bs-theme="dark"]
        .student-empty-icon {

            color: #ffffff;

            background: #20253a;

            border-color: #292e45;

        }


        .student-empty-icon i {

            font-size: 1.8rem;

        }


        .student-empty-state h5 {

            margin:
                0 0 .4rem;

            color:
                var(--student-text);

            font-size: .9rem;

            font-weight: 800;

            text-transform: uppercase;

        }


        [data-bs-theme="dark"]
        .student-empty-state h5 {

            color: #ffffff;

        }


        .student-empty-state p {

            margin: 0;

            color:
                var(--student-text-muted);

            font-size: .78rem;

        }


        [data-bs-theme="dark"]
        .student-empty-state p {

            color: #999fb9;

        }


        /* =========================================================
           TOOLTIP
        ========================================================== */

        .student-mobile-search-button[data-tooltip]::after,
        .student-mobile-reset-button[data-tooltip]::after,
        .student-reset-button[data-tooltip]::after {

            content:
                attr(data-tooltip);

            position: absolute;

            top:
                calc(100% + 8px);

            left: 50%;

            z-index: 100;

            padding:
                .4rem .6rem;

            color:
                var(--student-white);

            background:
                var(--student-black);

            border-radius: 5px;

            font-size: .62rem;

            font-weight: 700;

            white-space: nowrap;

            opacity: 0;

            pointer-events: none;

            transform:
                translateX(-50%) translateY(-3px);

            transition:
                opacity .15s ease,
                transform .15s ease;

        }


        .student-mobile-search-button[data-tooltip]:hover::after,
        .student-mobile-reset-button[data-tooltip]:hover::after,
        .student-reset-button[data-tooltip]:hover::after {

            opacity: 1;

            transform:
                translateX(-50%) translateY(0);

        }


        [data-bs-theme="dark"]
        .student-mobile-search-button[data-tooltip]::after,

        [data-bs-theme="dark"]
        .student-mobile-reset-button[data-tooltip]::after,

        [data-bs-theme="dark"]
        .student-reset-button[data-tooltip]::after {

            color: #000000;

            background: #ffffff;

        }


        /* =========================================================
           LARGE DESKTOP
           4 CARDS PER ROW
        ========================================================== */

        @media (min-width: 1400px) {

            .thesis-card-grid {

                grid-template-columns:
                    repeat(4, minmax(0, 1fr));

            }

        }


        /* =========================================================
           DESKTOP / SMALLER DESKTOP
           3 CARDS PER ROW
        ========================================================== */

        @media (min-width: 1200px) and (max-width: 1399.98px) {

            .thesis-card-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

            }

        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1199.98px) {

            .thesis-card-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .student-page-header {

                margin-bottom: 1rem;

                padding: 1rem;

                gap: 1rem;

            }


            .student-title {

                font-size: 1.35rem;

            }


            .student-overline {

                font-size: .65rem;

            }


            /* SHOW SEARCH BUTTON */

            .student-mobile-search-button {

                display: flex;

            }


            /* HIDE DESKTOP FILTER */

            .student-filter-card {

                display: none;

            }


            /* SHOW MOBILE SEARCH */

            .student-mobile-search-panel {

                display: block;

            }


            /* ONE CARD PER ROW */

            .thesis-card-grid {

                grid-template-columns:
                    1fr;

                gap: 1rem;

                padding:
                    0 .75rem 1rem;

            }


            /* ALERT */

            .student-success-alert {

                margin:
                    0 .75rem 1rem;

            }


            /* HIDE TOOLTIP */

            .student-mobile-search-button[data-tooltip]::after,
            .student-mobile-reset-button[data-tooltip]::after,
            .student-reset-button[data-tooltip]::after {

                display: none;

            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .student-page-header {

                padding: .85rem;

            }


            .student-title {

                font-size: 1.15rem;

            }


            .student-mobile-search-content {

                padding: .6rem;

            }


            .student-mobile-search-input input {

                height: 42px;

                font-size: .76rem;

            }


            .student-mobile-reset-button,
            .student-mobile-search-button {

                width: 42px;

                height: 42px;

            }


            .thesis-card-grid {

                gap: .85rem;

                padding:
                    0 .65rem 1rem;

            }


            .student-success-alert {

                margin:
                    0 .65rem .85rem;

            }


            .student-empty-state {

                padding:
                    3rem 1rem;

            }

        }


        /* =========================================================
           REDUCED MOTION
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            .student-page *,
            .student-page *::before,
            .student-page *::after {

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