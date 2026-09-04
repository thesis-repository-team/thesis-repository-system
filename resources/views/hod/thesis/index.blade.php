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


            {{-- =====================================================
                HEADER ACTIONS
            ====================================================== --}}

            <div class="thesis-header-actions">

                {{-- MOBILE SEARCH --}}

                <button type="button" id="mobileThesisSearchToggle" class="thesis-mobile-search-button"
                    aria-label="Open Search" aria-expanded="false">

                    <i class="bi bi-search"></i>

                </button>


                {{-- ADD THESIS --}}

                <a href="{{ route('hod.thesis.create') }}" class="thesis-add-button">

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


                <button type="button" id="mobileThesisResetFilter" class="thesis-mobile-reset-button">

                    <i class="bi bi-arrow-counterclockwise"></i>

                </button>

            </div>

        </div>


        {{-- =========================================================
            ALERTS
        ========================================================== --}}

        @if (session('success'))
            <div class="alert alert-success mx-3">
                {{ session('success') }}
            </div>
        @endif


        @if (session('error'))
            <div class="alert alert-danger mx-3">
                {{ session('error') }}
            </div>
        @endif


        {{-- =========================================================
            FILTERS
        ========================================================== --}}

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

                    <select class="thesis-filter-select" id="yearFilter">

                        <option value="">
                            All Years
                        </option>

                        @foreach ($published_at as $published)
                            <option value="{{ $published }}">
                                {{ $published }}
                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- RESET --}}

                <div class="col-12 col-lg-2">

                    <button type="button" id="resetFilter" class="thesis-reset-button">

                        <i class="bi bi-arrow-counterclockwise"></i>

                        <span class="thesis-button-text">
                            Reset Filters
                        </span>

                    </button>

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


            {{-- THESIS CARDS --}}

            <div id="hodThesisCards" class="thesis-card-grid">

                @include('hod.thesis.table')

            </div>

        </div>

    </div>


    {{-- =============================================================
        JAVASCRIPT
    ============================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let searchTimeout = null;

            let currentController = null;


            const searchInput =
                document.getElementById('search');

            const mobileSearchInput =
                document.getElementById(
                    'mobileThesisSearchInput'
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
                    'mobileThesisResetFilter'
                );

            const mobileSearchToggle =
                document.getElementById(
                    'mobileThesisSearchToggle'
                );

            const mobileSearchPanel =
                document.getElementById(
                    'mobileThesisSearchPanel'
                );

            const spinner =
                document.getElementById(
                    'thesisSearchSpinner'
                );

            const thesisGrid =
                document.getElementById(
                    'hodThesisCards'
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


                if (thesisGrid) {

                    thesisGrid.classList.add(
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

                        if (thesisGrid) {

                            thesisGrid.innerHTML =
                                html;

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


                        if (thesisGrid) {

                            thesisGrid.classList.remove(
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
                                function() {

                                    if (
                                        mobileSearchInput
                                    ) {

                                        mobileSearchInput
                                            .focus();

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
                        mobileSearchPanel
                        .classList
                        .contains('is-open')
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


            /* =====================================================
               RESIZE
            ====================================================== */

            window.addEventListener(
                'resize',
                function() {

                    if (
                        window.innerWidth >
                        767.98
                    ) {

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

        });
    </script>


    {{-- =============================================================
        CSS
    ============================================================== --}}

    <style>
        :root {

            --thesis-black: #000000;
            --thesis-white: #ffffff;

            --thesis-text: #111111;
            --thesis-muted: #777777;

            --thesis-border: #e5e5e5;
            --thesis-soft: #f7f7f7;

        }


        /* =========================================================
           PAGE
        ========================================================== */

        .thesis-page {

            color:
                var(--thesis-text);

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

            background: #ffffff;

            box-sizing: border-box;
            /* border-radius: 12px; */

        }


        .thesis-header-content {

            flex: 1;

            min-width: 0;

        }


        .thesis-overline {

            display: block;

            margin-bottom: .2rem;

            color: #777777;

            font-size: .7rem;

            font-weight: 800;

            letter-spacing: .13em;

            text-transform: uppercase;

        }


        .thesis-title {

            margin: 0;

            color: #111111;

            font-size: 1.8rem;

            font-weight: 800;

            line-height: 1.2;

            letter-spacing: -.035em;

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

            color: #ffffff;

            background: #000000;

            border: 1px solid #000000;

            border-radius: 8px;

            text-decoration: none;

            font-size: .68rem;

            font-weight: 800;

            letter-spacing: .03em;

            text-transform: uppercase;

            transition: .2s ease;

        }


        .thesis-add-button:hover {

            color: #ffffff;

            background: #252525;

            border-color: #252525;

            transform: translateY(-2px);

        }


        /* =========================================================
           FILTER
        ========================================================== */

        .thesis-filter-body {

            /* border-radius: 12px; */
            padding: 1.2rem 1.25rem;

            background: #ffffff;

        }


        .thesis-input-label {

            display: block;

            margin-bottom: .45rem;

            color: #333333;

            font-size: .67rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;

        }


        .thesis-search {

            position: relative;

        }


        .thesis-search i {

            position: absolute;

            top: 50%;

            left: 1rem;

            color: #777777;

            transform: translateY(-50%);

            pointer-events: none;

        }


        .thesis-search input {

            width: 100%;

            height: 45px;

            padding:
                .6rem 1rem .6rem 2.75rem;

            color: #111111;

            background: #fafafa;

            border: 1px solid #dddddd;

            border-radius: 8px;

            outline: none;

            font-size: .82rem;

            box-sizing: border-box;

            transition: .2s ease;

        }


        .thesis-search input:focus {

            border-color: #000000;

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, .07);

        }


        .thesis-filter-select {

            width: 100%;

            height: 45px;

            padding: .5rem .85rem;

            color: #111111;

            background: #fafafa;

            border: 1px solid #dddddd;

            border-radius: 8px;

            outline: none;

            font-size: .8rem;

            cursor: pointer;

        }


        .thesis-filter-select:focus {

            border-color: #000000;

        }


        .thesis-reset-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .45rem;

            width: 100%;

            height: 45px;

            color: #111111;

            background: #ffffff;

            border: 1px solid #dddddd;

            border-radius: 8px;

            font-size: .68rem;

            font-weight: 800;

            text-transform: uppercase;

            cursor: pointer;

            transition: .2s ease;

        }


        .thesis-reset-button:hover {

            color: #ffffff;

            background: #000000;

            border-color: #000000;

        }


        /* =========================================================
           CARD GRID
        ========================================================== */

        .thesis-card-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 1.25rem;

            width: 100%;

            margin-top: 1rem;


            box-sizing: border-box;

            transition: opacity .2s ease;

        }


        .thesis-card-grid.is-loading {

            opacity: .45;

            pointer-events: none;

        }


        /* =========================================================
           CARD
        ========================================================== */

        .admin-thesis-card {

            display: flex;

            flex-direction: column;

            min-width: 0;

            overflow: hidden;

            background: #ffffff;

            border: 1px solid #e7e7e7;

            border-radius: 16px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, .04);

            transition:
                transform .25s ease,
                box-shadow .25s ease;

        }


        .admin-thesis-card:hover {

            transform: translateY(-5px);

            box-shadow:
                0 12px 30px rgba(0, 0, 0, .10);

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

            color: #ffffff;

            background: #000000;

            border-radius: 9px;

            font-size: .8rem;

        }


        /* =========================================================
           TITLE
        ========================================================== */

        .admin-thesis-card-title {

            display: -webkit-box;

            margin: 0;

            overflow: hidden;

            color: #111111;

            font-size: 1rem;

            font-weight: 800;

            line-height: 1.4;

            letter-spacing: -.02em;

            -webkit-line-clamp: 3;

            -webkit-box-orient: vertical;

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

            padding: .4rem .6rem;

            color: #146c43;

            background: #d1e7dd;

            border-radius: 20px;

            font-size: .57rem;

            font-weight: 800;

            text-transform: uppercase;

            white-space: nowrap;

        }


        /* =========================================================
           PUBLISHED INFORMATION
        ========================================================== */

        .admin-thesis-published {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: .65rem;

            margin:
                0 1rem 1rem;

            padding: .75rem;

            background: #f7f7f7;

            border-radius: 10px;

        }


        .admin-thesis-published-item {

            display: flex;

            align-items: center;

            gap: .5rem;

            min-width: 0;

        }


        .admin-thesis-published-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 29px;

            height: 29px;

            flex-shrink: 0;

            color: #555555;

            background: #ffffff;

            border-radius: 7px;

            font-size: .68rem;

        }


        .admin-thesis-published-content {

            display: flex;

            flex-direction: column;

            min-width: 0;

        }


        .admin-thesis-published-label {

            margin-bottom: .12rem;

            color: #999999;

            font-size: .5rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;

        }


        .admin-thesis-published-value {

            overflow: hidden;

            color: #333333;

            font-size: .62rem;

            font-weight: 700;

            text-overflow: ellipsis;

            white-space: nowrap;

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


        /* =========================================================
           DETAILS
        ========================================================== */

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

            color: #555555;

            background: #f5f5f5;

            border-radius: 8px;

            font-size: .72rem;

        }


        .admin-thesis-detail-content {

            display: flex;

            flex-direction: column;

            min-width: 0;

        }


        .admin-thesis-detail-label {

            margin-bottom: .1rem;

            color: #999999;

            font-size: .55rem;

            font-weight: 800;

            letter-spacing: .06em;

            text-transform: uppercase;

        }


        .admin-thesis-detail-value {

            overflow: hidden;

            color: #222222;

            font-size: .7rem;

            font-weight: 600;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =========================================================
           REQUEST INFORMATION
        ========================================================== */

        .admin-thesis-submitted {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 1rem;

            margin-top: .3rem;

            padding-top: .8rem;

            border-top: 1px solid #eeeeee;

        }


        .admin-thesis-submitted-label {

            color: #999999;

            font-size: .53rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;

        }


        .admin-thesis-submitted-value {

            overflow: hidden;

            color: #333333;

            font-size: .62rem;

            font-weight: 700;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =========================================================
           FOOTER
        ========================================================== */

        .admin-thesis-card-footer {

            display: flex;

            align-items: center;

            gap: .5rem;

            padding: .75rem;

            background: #fafafa;

            border-top: 1px solid #eeeeee;

        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .admin-thesis-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            flex: 1;

            min-height: 36px;

            padding: .4rem .7rem;

            border-radius: 8px;

            text-decoration: none;

            font-size: .62rem;

            font-weight: 800;

            transition: .2s ease;

        }


        .admin-thesis-view {

            color: #ffffff;

            background: #000000;

            border: 1px solid #000000;

        }


        .admin-thesis-view:hover {

            color: #ffffff;

            background: #292929;

            border-color: #292929;

        }


        .admin-thesis-download {

            color: #111111;

            background: #ffffff;

            border: 1px solid #dddddd;

        }


        .admin-thesis-download:hover {

            color: #ffffff;

            background: #000000;

            border-color: #000000;

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

            background: #ffffff;

            border: 1px solid #e5e5e5;

            border-radius: 16px;

        }


        .admin-thesis-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 55px;

            height: 55px;

            margin-bottom: 1rem;

            color: #ffffff;

            background: #000000;

            border-radius: 13px;

        }


        .admin-thesis-empty h3 {

            margin: 0 0 .35rem;

            color: #111111;

            font-size: 1rem;

            font-weight: 800;

        }


        .admin-thesis-empty p {

            margin: 0;

            color: #888888;

            font-size: .7rem;

        }


        /* =========================================================
           MOBILE SEARCH
        ========================================================== */

        .thesis-mobile-search-button {

            display: none;

            align-items: center;

            justify-content: center;

            width: 44px;

            height: 44px;

            color: #111111;

            background: #ffffff;

            border: 1px solid #dddddd;

            border-radius: 8px;

            cursor: pointer;

        }


        .thesis-mobile-search-button.is-active {

            color: #ffffff;

            background: #000000;

            border-color: #000000;

        }


        .thesis-mobile-search-panel {

            display: none;

            margin: 0 .75rem 1rem;

            overflow: hidden;

            background: #ffffff;

            border: 1px solid #dddddd;

            border-radius: 10px;

            opacity: 0;

            transform: translateY(-5px);

            transition: .2s ease;

        }


        .thesis-mobile-search-panel.is-open {

            opacity: 1;

            transform: translateY(0);

        }


        .thesis-mobile-search-content {

            display: flex;

            gap: .5rem;

            padding: .7rem;

        }


        .thesis-mobile-search-input {

            position: relative;

            flex: 1;

        }


        .thesis-mobile-search-input i {

            position: absolute;

            top: 50%;

            left: .8rem;

            color: #777777;

            transform: translateY(-50%);

        }


        .thesis-mobile-search-input input {

            width: 100%;

            height: 44px;

            padding:
                .5rem .75rem .5rem 2.4rem;

            background: #fafafa;

            border: 1px solid #dddddd;

            border-radius: 8px;

            outline: none;

            box-sizing: border-box;

        }


        .thesis-mobile-reset-button {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 44px;

            height: 44px;

            flex-shrink: 0;

            color: #111111;

            background: #ffffff;

            border: 1px solid #dddddd;

            border-radius: 8px;

            cursor: pointer;

        }


        /* =========================================================
           LOADING
        ========================================================== */

        .thesis-results-wrapper {

            position: relative;

            min-height: 100px;

        }


        .thesis-loading {

            position: absolute;

            top: 1rem;

            left: 50%;

            z-index: 50;

            display: flex;

            align-items: center;

            gap: .6rem;

            padding: .65rem .9rem;

            color: #111111;

            background: #ffffff;

            border: 1px solid #dddddd;

            border-radius: 8px;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .07);

            font-size: .7rem;

            font-weight: 700;

            transform: translateX(-50%);

        }


        .thesis-spinner {

            width: 17px;

            height: 17px;

            border: 2px solid #dddddd;

            border-top-color: #000000;

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

            .thesis-page-header {

                padding: 1rem;

            }


            .thesis-title {

                font-size: 1.35rem;

            }


            .thesis-mobile-search-button {

                display: flex;

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


            .thesis-filter-body {

                display: none;

            }


            .thesis-mobile-search-panel {

                display: block;

            }


            .thesis-card-grid {

                grid-template-columns: 1fr;

                gap: 1rem;

                padding:
                    0 .75rem 1rem;

            }


            .admin-thesis-card-top {

                gap: .6rem;

            }


            .admin-thesis-card-title {

                font-size: .9rem;

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

                font-size: 1.15rem;

            }


            .admin-thesis-card-body {

                padding:
                    .15rem .9rem .9rem;

            }


            .admin-thesis-card-footer {

                padding: .65rem;

            }


            .admin-thesis-action {

                min-height: 34px;

            }


            .admin-thesis-published {

                grid-template-columns: 1fr;

            }


            .admin-thesis-status-badge {

                padding:
                    .35rem .5rem;

                font-size: .5rem;

            }

        }
    </style>

</x-app-layout>
