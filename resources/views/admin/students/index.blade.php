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


            {{-- =====================================================
                HEADER ACTIONS
            ====================================================== --}}

            <div class="student-header-actions">

                {{-- MOBILE SEARCH TOGGLE --}}

                <button
                    type="button"
                    id="mobileSearchToggle"
                    class="student-mobile-search-button"
                    aria-label="Open Search"
                    aria-expanded="false"
                    data-tooltip="Search"
                >

                    <i class="bi bi-search"></i>

                </button>

            </div>

        </div>


        {{-- =========================================================
            MOBILE SEARCH PANEL
        ========================================================== --}}

        <div
            id="mobileSearchPanel"
            class="student-mobile-search-panel"
        >

            <div class="student-mobile-search-content">

                <div class="student-mobile-search-input">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="mobileSearchInput"
                        placeholder="Search name, department, email..."
                        autocomplete="off"
                    >

                </div>


                <button
                    type="button"
                    id="mobileResetFilter"
                    class="student-mobile-reset-button"
                    aria-label="Reset Search"
                    data-tooltip="Reset"
                >

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
                            class="student-input-label"
                        >
                            Search
                        </label>

                        <div class="student-search">

                            <i class="bi bi-search"></i>

                            <input
                                type="text"
                                id="search"
                                placeholder="Search name, department, email..."
                                autocomplete="off"
                            >

                        </div>

                    </div>


                    {{-- DEPARTMENT --}}

                    <div class="col-12 col-md-4 col-lg-2">

                        <label
                            for="departmentFilter"
                            class="student-input-label"
                        >
                            Department
                        </label>

                        <select
                            class="student-filter-select"
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


                    {{-- YEAR --}}

                    <div class="col-12 col-md-4 col-lg-2">

                        <label
                            for="yearFilter"
                            class="student-input-label"
                        >
                            Started Year
                        </label>

                        <select
                            class="student-filter-select student-year-select"
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


                    {{-- RESET --}}

                    <div class="col-12 col-md-4 col-lg-3">

                        <button
                            type="button"
                            id="resetFilter"
                            class="student-reset-button"
                            data-tooltip="Reset Filters"
                            aria-label="Reset Filters"
                        >

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
                role="alert"
            >

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
                    aria-label="Close"
                >

                    <i class="bi bi-x-lg"></i>

                </button>

            </div>

        @endif


        {{-- =========================================================
            STUDENT RESULTS
        ========================================================== --}}

        <div class="student-results-wrapper">


            {{-- =====================================================
                CARD / TABLE TOGGLE
            ====================================================== --}}

            <div class="student-results-toolbar">

                <div class="student-view-toggle">

                    {{-- CARDS --}}

                    <button
                        type="button"
                        id="studentCardViewButton"
                        class="student-view-button is-active"
                        aria-label="Card View"
                        title="Card View"
                    >

                        <i class="bi bi-grid-3x3-gap"></i>

                        <span>
                            Cards
                        </span>

                    </button>


                    {{-- TABLE --}}

                    <button
                        type="button"
                        id="studentTableViewButton"
                        class="student-view-button"
                        aria-label="Table View"
                        title="Table View"
                    >

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

            <div
                id="studentSearchSpinner"
                class="student-loading d-none"
            >

                <div class="student-spinner"></div>

                <span>
                    Loading students...
                </span>

            </div>


            {{-- =====================================================
                CARD / TABLE RESULTS
            ====================================================== --}}

            <div
                id="adminStudentTable"
                class="student-results-container"
            >

                @include('admin.students.table')

            </div>

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

                const studentResultsContainer =
                    document.getElementById('adminStudentTable');

                const spinner =
                    document.getElementById('studentSearchSpinner');

                const studentCardViewButton =
                    document.getElementById('studentCardViewButton');

                const studentTableViewButton =
                    document.getElementById('studentTableViewButton');


                /* =====================================================
                   CARD / TABLE VIEW
                ====================================================== */

                function setStudentView(view) {

                    if (!studentResultsContainer) {
                        return;
                    }


                    if (view === 'table') {

                        studentResultsContainer
                            .classList
                            .add('table-mode');


                        if (studentTableViewButton) {

                            studentTableViewButton
                                .classList
                                .add('is-active');

                        }


                        if (studentCardViewButton) {

                            studentCardViewButton
                                .classList
                                .remove('is-active');

                        }


                        localStorage.setItem(
                            'adminStudentView',
                            'table'
                        );

                    } else {

                        studentResultsContainer
                            .classList
                            .remove('table-mode');


                        if (studentCardViewButton) {

                            studentCardViewButton
                                .classList
                                .add('is-active');

                        }


                        if (studentTableViewButton) {

                            studentTableViewButton
                                .classList
                                .remove('is-active');

                        }


                        localStorage.setItem(
                            'adminStudentView',
                            'cards'
                        );

                    }

                }


                /* =====================================================
                   CARD BUTTON
                ====================================================== */

                if (studentCardViewButton) {

                    studentCardViewButton.addEventListener(
                        'click',
                        function () {

                            setStudentView('cards');

                        }
                    );

                }


                /* =====================================================
                   TABLE BUTTON
                ====================================================== */

                if (studentTableViewButton) {

                    studentTableViewButton.addEventListener(
                        'click',
                        function () {

                            setStudentView('table');

                        }
                    );

                }


                /* =====================================================
                   LOAD SAVED VIEW
                ====================================================== */

                const savedStudentView =
                    localStorage.getItem(
                        'adminStudentView'
                    );


                if (savedStudentView === 'table') {

                    setStudentView('table');

                } else {

                    setStudentView('cards');

                }


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


                    if (studentResultsContainer) {

                        studentResultsContainer
                            .classList
                            .add('is-loading');

                    }


                    /* =================================================
                       SEARCH VALUE
                    ================================================== */

                    let search = '';


                    if (window.innerWidth <= 767.98) {

                        search =
                            mobileSearchInput
                                ? mobileSearchInput.value.trim()
                                : '';

                    } else {

                        search =
                            searchInput
                                ? searchInput.value.trim()
                                : '';

                    }


                    /* =================================================
                       DEPARTMENT
                    ================================================== */

                    const department =
                        departmentFilter
                            ? departmentFilter.value
                            : '';


                    /* =================================================
                       YEAR
                    ================================================== */

                    const year =
                        yearFilter
                            ? yearFilter.value
                            : '';


                    /* =================================================
                       QUERY
                    ================================================== */

                    const query =
                        new URLSearchParams({

                            search: search,

                            department: department,

                            year: year

                        });


                    /* =================================================
                       AJAX
                    ================================================== */

                    fetch(
                        "{{ route('admin.students.search') }}?" +
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

                    .then(function (data) {

                        if (studentResultsContainer) {

                            studentResultsContainer.innerHTML =
                                data;

                        }


                        /*
                         * Re-apply current view after AJAX.
                         */

                        const currentView =
                            localStorage.getItem(
                                'adminStudentView'
                            );


                        if (currentView === 'table') {

                            setStudentView('table');

                        } else {

                            setStudentView('cards');

                        }

                    })

                    .catch(function (error) {

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

                    .finally(function () {

                        if (spinner) {

                            spinner.classList.add(
                                'd-none'
                            );

                        }


                        if (studentResultsContainer) {

                            studentResultsContainer
                                .classList
                                .remove('is-loading');

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
           COLOR VARIABLES
        ========================================================== */

        :root {

            /*
             * Main purple theme
             */
            --student-primary: #6538D9;
            --student-primary-hover: #5630BD;

            --student-primary-soft: #F0EBFF;
            --student-primary-soft-hover: #E8E0FF;

            /*
             * Light theme
             */
            --student-black: #111111;
            --student-white: #FFFFFF;

            --student-page-bg: #F0F2F5;
            --student-card-bg: #FFFFFF;
            --student-card-bg-soft: #FAF9FF;

            --student-input-bg: #F8F7FC;

            --student-text: #16121F;
            --student-text-secondary: #514D5A;
            --student-text-muted: #8A8792;

            --student-border: #E4E1EB;
            --student-border-soft: #E5E1EE;

            --student-hover: #F5F3FA;

            --student-shadow:
                0 4px 18px rgba(35, 20, 65, .08);

            --student-card-shadow:
                0 2px 10px rgba(35, 20, 65, .05);

        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] {

            --student-black: #000000;
            --student-white: #FFFFFF;

            --student-page-bg: #101426;
            --student-card-bg: #181D33;
            --student-card-bg-soft: #1C2138;

            --student-input-bg: #20253A;

            --student-text: #FFFFFF;
            --student-text-secondary: #D5D8E8;
            --student-text-muted: #999FB9;

            --student-border: #292E45;
            --student-border-soft: #292E45;

            --student-hover: #20253A;

            --student-primary: #7C5CE3;
            --student-primary-hover: #9278EA;

            --student-primary-soft: #292342;
            --student-primary-soft-hover: #342C52;

            --student-shadow:
                0 8px 24px rgba(0, 0, 0, .35);

            --student-card-shadow:
                0 2px 10px rgba(0, 0, 0, .30);

        }


        /* =========================================================
           BODY
        ========================================================== */

        body {

            background:
                var(--student-page-bg);

        }


        [data-bs-theme="dark"] body {

            background:
                #101426;

            color:
                #FFFFFF;

        }


        /* =========================================================
           PAGE
        ========================================================== */

        .student-page {

            min-height: 100vh;

            padding: 20px;

            color:
                var(--student-text);

            background:
                var(--student-page-bg);

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

            margin: 100px 0 20px;

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 12px;

            box-shadow:
                var(--student-card-shadow);

            box-sizing: border-box;

        }


        .student-header-content {

            min-width: 0;

            flex: 1;

        }


        .student-title-row {

            display: flex;

            align-items: center;

        }


        /* =========================================================
           PAGE TITLE
        ========================================================== */

        .student-overline {

            display: block;

            margin-bottom: .25rem;

            color:
                var(--student-primary);

            font-size: .72rem;

            font-weight: 800;

            letter-spacing: .13em;

            line-height: 1.2;

            text-transform: uppercase;

        }


        .student-title {

            margin: 0;

            color:
                var(--student-text);

            font-size: 1.9rem;

            font-weight: 700;

            line-height: 1.2;

            letter-spacing: -.035em;

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
           CARD / TABLE TOOLBAR
        ========================================================== */

        .student-results-toolbar {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            width: 100%;

            margin-top: 1rem;

            margin-bottom: .75rem;

        }


        .student-view-toggle {

            display: inline-flex;

            align-items: center;

            gap: 3px;

            padding: 3px;

            background:
                var(--student-input-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 9px;

            box-shadow:
                0 2px 7px rgba(35, 20, 65, .04);

        }


        .student-view-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            min-width: 82px;

            height: 38px;

            padding:
                .45rem .75rem;

            color:
                var(--student-text-muted);

            background:
                transparent;

            border: 0;

            border-radius: 7px;

            font-size: .75rem;

            font-weight: 800;

            text-transform: uppercase;

            cursor: pointer;

            transition:
                color .2s ease,
                background-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;

        }


        .student-view-button i {

            font-size: .9rem;

        }


        .student-view-button:hover {

            color:
                var(--student-primary);

            background:
                var(--student-primary-soft);

        }


        .student-view-button.is-active {

            color:
                #FFFFFF;

            background:
                var(--student-primary);

            box-shadow:
                0 3px 8px rgba(101, 56, 217, .25);

        }


        .student-view-button.is-active:hover {

            color:
                #FFFFFF;

            background:
                var(--student-primary-hover);

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

            border-radius: 9px;

            cursor: pointer;

            box-shadow:
                0 2px 7px rgba(35, 20, 65, .04);

            transition:
                color .2s ease,
                background-color .2s ease,
                border-color .2s ease;

        }


        .student-mobile-search-button:hover,
        .student-mobile-search-button.is-active {

            color:
                #FFFFFF;

            background:
                var(--student-primary);

            border-color:
                var(--student-primary);

        }


        [data-bs-theme="dark"]
        .student-mobile-search-button {

            color:
                #FFFFFF;

            background:
                #181D33;

            border-color:
                #292E45;

        }


        [data-bs-theme="dark"]
        .student-mobile-search-button:hover,

        [data-bs-theme="dark"]
        .student-mobile-search-button.is-active {

            color:
                #FFFFFF;

            background:
                #7C5CE3;

            border-color:
                #7C5CE3;

        }


        /* =========================================================
           FILTER CARD
        ========================================================== */

        .student-filter-card {

            width: 100%;

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 12px;

            box-shadow:
                var(--student-card-shadow);

            box-sizing: border-box;

        }


        .student-filter-body {

            overflow: hidden;

            padding:
                1.2rem 1.25rem;

            background:
                var(--student-card-bg);

            border-radius: 12px;

        }


        /* =========================================================
           FILTER LABEL
        ========================================================== */

        .student-input-label {

            display: block;

            margin-bottom: .45rem;

            color:
                var(--student-text-secondary);

            font-size: .75rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;

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
                var(--student-primary);

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

            font-size: .9rem;

            box-sizing: border-box;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;

        }


        .student-search input::placeholder {

            color:
                var(--student-text-muted);

        }


        .student-search input:hover {

            border-color:
                #CFC8E0;

        }


        .student-search input:focus,
        .student-filter-select:focus {

            border-color:
                var(--student-primary);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .12);

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

            font-size: .9rem;

            cursor: pointer;

            box-sizing: border-box;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;

        }


        .student-filter-select:hover {

            border-color:
                #CFC8E0;

        }


        .student-filter-select option {

            color:
                #16121F;

            background:
                #FFFFFF;

        }


        [data-bs-theme="dark"]
        .student-filter-select option {

            color:
                #FFFFFF;

            background:
                #20253A;

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
                var(--student-text-secondary);

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 8px;

            font-size: .75rem;

            font-weight: 800;

            text-transform: uppercase;

            cursor: pointer;

            transition:
                color .2s ease,
                background-color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease;

        }


        .student-reset-button:hover {

            color:
                var(--student-primary);

            background:
                var(--student-primary-soft);

            border-color:
                var(--student-primary);

            box-shadow:
                0 3px 8px rgba(101, 56, 217, .10);

        }


        .student-reset-button:focus-visible {

            outline: none;

            border-color:
                var(--student-primary);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .12);

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
                1rem 0;

            padding:
                .9rem 1rem;

            color:
                var(--student-text);

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-left:
                4px solid var(--student-primary);

            border-radius: 9px;

            box-shadow:
                var(--student-card-shadow);

            box-sizing: border-box;

        }


        .student-alert-content {

            display: flex;

            align-items: center;

            gap: .6rem;

            color:
                var(--student-text);

            font-size: .82rem;

            font-weight: 600;

        }


        .student-alert-content i {

            color:
                var(--student-primary);

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
                var(--student-text-muted);

            background: transparent;

            border: 0;

            border-radius: 6px;

            cursor: pointer;

            opacity: .75;

            transition:
                color .2s ease,
                background-color .2s ease,
                opacity .2s ease;

        }


        .student-alert-close:hover {

            color:
                var(--student-primary);

            background:
                var(--student-primary-soft);

            opacity: 1;

        }


        /* =========================================================
           RESULTS
        ========================================================== */

        .student-results-wrapper {

            position: relative;

            width: 100%;

            box-sizing: border-box;

        }


        .student-results-container {

            width: 100%;

            box-sizing: border-box;

            transition:
                opacity .2s ease;

        }


        .student-results-container.is-loading {

            opacity: .45;

            pointer-events: none;

        }


        /* =========================================================
           CARD VIEW
        ========================================================== */

        .student-partial-card-results {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 1.25rem;

            width: 100%;

            box-sizing: border-box;

        }


        /* =========================================================
           TABLE VIEW
        ========================================================== */

        .student-partial-table-results {

            display: none;

            width: 100%;

            box-sizing: border-box;

        }


        .student-results-container.table-mode
        .student-partial-card-results {

            display: none;

        }


        .student-results-container.table-mode
        .student-partial-table-results {

            display: block;

        }


        /* =========================================================
           TABLE WRAPPER
        ========================================================== */

        .student-table-wrapper {

            width: 100%;

            overflow-x: auto;

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 10px;

            box-shadow:
                var(--student-card-shadow);

            box-sizing: border-box;

        }


        .student-table {

            width: 100%;

            min-width: 950px;

            margin: 0;

            border-collapse: collapse;

            color:
                var(--student-text);

            background:
                var(--student-card-bg);

        }


        /* =========================================================
           TABLE HEADER
        ========================================================== */

        .student-table thead th {

            padding:
                .9rem .85rem;

            color:
                var(--student-text-secondary);

            background:
                var(--student-input-bg);

            border-bottom:
                1px solid var(--student-border-soft);

            font-size: .72rem;

            font-weight: 800;

            line-height: 1.35;

            text-align: left;

            text-transform: uppercase;

            white-space: nowrap;

        }


        /* =========================================================
           TABLE BODY
        ========================================================== */

        .student-table tbody td {

            padding:
                .85rem;

            color:
                var(--student-text);

            background:
                var(--student-card-bg);

            border-bottom:
                1px solid var(--student-border-soft);

            font-size: .80rem;

            font-weight: 600;

            line-height: 1.45;

            vertical-align: middle;

        }


        .student-table tbody tr:last-child td {

            border-bottom: 0;

        }


        .student-table tbody tr {

            transition:
                background-color .2s ease;

        }


        .student-table tbody tr:hover td {

            background:
                var(--student-input-bg);

        }


        /* =========================================================
           TABLE PROFILE
        ========================================================== */

        .student-table-profile {

            display: flex;

            align-items: center;

            gap: .65rem;

            min-width: 190px;

        }


        .student-table-avatar {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 36px;

            height: 36px;

            flex-shrink: 0;

            color:
                #FFFFFF;

            background:
                var(--student-primary);

            border-radius: 50%;

            box-shadow:
                0 3px 8px rgba(101, 56, 217, .20);

        }


        .student-table-name {

            display: block;

            max-width: 220px;

            overflow: hidden;

            color:
                var(--student-text);

            font-size: .82rem;

            font-weight: 800;

            line-height: 1.4;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        .student-table-number {

            display: block;

            margin-top: .15rem;

            color:
                var(--student-text-muted);

            font-size: .68rem;

            line-height: 1.35;

        }


        .student-table-email {

            max-width: 220px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =========================================================
           PERMISSION BADGES
        ========================================================== */

        .student-table-permission {

            display: inline-flex;

            align-items: center;

            gap: .35rem;

            padding:
                .35rem .55rem;

            border-radius: 6px;

            font-size: .68rem;

            font-weight: 800;

            line-height: 1.3;

            white-space: nowrap;

        }


        .student-table-permission.allowed {

            color:
                #15803D;

            background:
                #F0FDF4;

            border:
                1px solid #22C55E;

        }


        .student-table-permission.denied {

            color:
                #DC2626;

            background:
                #FEF2F2;

            border:
                1px solid #EF4444;

        }


        [data-bs-theme="dark"]
        .student-table-permission.allowed {

            color:
                #4ADE80;

            background:
                #07140B;

            border-color:
                #22C55E;

        }


        [data-bs-theme="dark"]
        .student-table-permission.denied {

            color:
                #F87171;

            background:
                #1A0808;

            border-color:
                #EF4444;

        }


        /* =========================================================
           YEAR
        ========================================================== */

        .student-table-year {

            display: inline-flex;

            align-items: center;

            padding:
                .3rem .5rem;

            color:
                var(--student-primary);

            background:
                var(--student-primary-soft);

            border:
                1px solid rgba(101, 56, 217, .18);

            border-radius: 5px;

            font-family:
                monospace;

            font-size: .70rem;

            font-weight: 700;

        }


        [data-bs-theme="dark"]
        .student-table-year {

            color:
                #B8A7F2;

            background:
                #292342;

            border-color:
                #463B67;

        }


        /* =========================================================
           TABLE EDIT BUTTON
        ========================================================== */

        .student-table-edit-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            min-width: 76px;

            height: 34px;

            padding:
                .35rem .65rem;

            color:
                var(--student-primary);

            background:
                transparent;

            border:
                1px solid var(--student-primary);

            border-radius: 6px;

            font-size: .72rem;

            font-weight: 800;

            text-decoration: none;

            text-transform: uppercase;

            transition:
                color .2s ease,
                background-color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease;

        }


        .student-table-edit-button:hover {

            color:
                #FFFFFF;

            background:
                var(--student-primary);

            border-color:
                var(--student-primary);

            box-shadow:
                0 3px 8px rgba(101, 56, 217, .20);

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

            font-size: .78rem;

            font-weight: 700;

            white-space: nowrap;

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

            box-shadow:
                var(--student-card-shadow);

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
                var(--student-primary);

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

            font-size: .88rem;

            box-sizing: border-box;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;

        }


        .student-mobile-search-input input::placeholder {

            color:
                var(--student-text-muted);

        }


        .student-mobile-search-input input:focus {

            border-color:
                var(--student-primary);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .12);

        }


        .student-mobile-reset-button {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 44px;

            height: 44px;

            flex-shrink: 0;

            color:
                var(--student-text-secondary);

            background:
                var(--student-card-bg);

            border:
                1px solid var(--student-border-soft);

            border-radius: 8px;

            cursor: pointer;

            transition:
                color .2s ease,
                background-color .2s ease,
                border-color .2s ease;

        }


        .student-mobile-reset-button:hover {

            color:
                #FFFFFF;

            background:
                var(--student-primary);

            border-color:
                var(--student-primary);

        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1399.98px) {

            .student-partial-card-results {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

            }

        }


        @media (max-width: 1199.98px) {

            .student-partial-card-results {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

            }

        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 991.98px) {

            .student-page {

                padding:
                    16px;

            }


            .student-page-header {

                margin-top:
                    80px;

            }


            .student-filter-body {

                padding:
                    1rem;

            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .student-page {

                padding:
                    12px;

            }


            .student-page-header {

                align-items: center;

                padding:
                    .9rem 1rem;

                margin:
                    75px 0 12px;

                border-radius:
                    10px;

            }


            .student-title {

                font-size:
                    1.35rem;

            }


            .student-overline {

                font-size:
                    .65rem;

            }


            .student-mobile-search-button {

                display:
                    flex;

            }


            .student-filter-card {

                display:
                    none;

            }


            .student-mobile-search-panel {

                display:
                    block;

            }


            /* =====================================================
               TOGGLE
            ====================================================== */

            .student-results-toolbar {

                justify-content:
                    flex-end;

                margin-top:
                    .75rem;

                margin-bottom:
                    .75rem;

                padding:
                    0 .25rem;

                box-sizing:
                    border-box;

            }


            .student-view-button {

                width:
                    38px;

                min-width:
                    38px;

                height:
                    38px;

                padding:
                    0;

            }


            .student-view-button span {

                display:
                    none;

            }


            /* =====================================================
               CARDS
            ====================================================== */

            .student-partial-card-results {

                grid-template-columns:
                    1fr;

                gap:
                    1rem;

                padding:
                    0 .25rem 1rem;

            }


            /* =====================================================
               TABLE
            ====================================================== */

            .student-partial-table-results {

                padding:
                    0 .25rem 1rem;

            }


            .student-table thead th {

                font-size:
                    .62rem;

            }


            .student-table tbody td {

                font-size:
                    .68rem;

            }


            .student-table-name {

                font-size:
                    .70rem;

            }


            .student-table-number {

                font-size:
                    .62rem;

            }


            .student-table-permission {

                font-size:
                    .62rem;

            }


            .student-table-year {

                font-size:
                    .64rem;

            }


            .student-table-edit-button {

                font-size:
                    .66rem;

            }


            .student-success-alert {

                margin:
                    0 0 1rem;

            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .student-page {

                padding:
                    10px;

            }


            .student-page-header {

                padding:
                    .8rem .85rem;

                margin-top:
                    70px;

            }


            .student-title {

                font-size:
                    1.15rem;

            }


            .student-results-toolbar {

                padding:
                    0 .15rem;

            }


            .student-view-button {

                width:
                    36px;

                min-width:
                    36px;

                height:
                    36px;

            }


            .student-mobile-search-button {

                width:
                    42px;

                height:
                    42px;

            }


            .student-mobile-search-content {

                padding:
                    .6rem;

            }


            .student-mobile-search-input input {

                font-size:
                    .84rem;

            }


            .student-partial-card-results {

                padding:
                    0 .15rem 1rem;

            }


            .student-partial-table-results {

                padding:
                    0 .15rem 1rem;

            }


            /* =====================================================
               SMALL MOBILE TABLE
            ====================================================== */

            .student-table thead th {

                padding:
                    .6rem .35rem;

                font-size:
                    .56rem;

                line-height:
                    1.3;

                white-space:
                    normal;

            }


            .student-table tbody td {

                padding:
                    .65rem .35rem;

                font-size:
                    .62rem;

                line-height:
                    1.4;

            }


            .student-table-name {

                font-size:
                    .64rem;

            }


            .student-table-number {

                font-size:
                    .56rem;

            }


            .student-table-permission {

                font-size:
                    .56rem;

            }


            .student-table-year {

                font-size:
                    .58rem;

            }


            .student-table-edit-button {

                min-width:
                    60px;

                height:
                    30px;

                padding:
                    .25rem .45rem;

                font-size:
                    .58rem;

            }

        }


        /* =========================================================
           DARK MODE MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            [data-bs-theme="dark"]
            .student-page-header {

                background:
                    #181D33;

                border-color:
                    #292E45;

            }


            [data-bs-theme="dark"]
            .student-mobile-search-panel {

                background:
                    #181D33;

                border-color:
                    #292E45;

            }


            [data-bs-theme="dark"]
            .student-mobile-reset-button {

                color:
                    #D5D8E8;

                background:
                    #20253A;

                border-color:
                    #343A52;

            }


            [data-bs-theme="dark"]
            .student-mobile-reset-button:hover {

                color:
                    #FFFFFF;

                background:
                    #7C5CE3;

                border-color:
                    #7C5CE3;

            }

        }


        /* =========================================================
           ACCESSIBILITY
        ========================================================== */

        .student-view-button:focus-visible,
        .student-mobile-search-button:focus-visible,
        .student-mobile-reset-button:focus-visible {

            outline:
                none;

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .20);

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