<x-app-layout>

    <div class="dashboard-page thesis-page">

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

                {{-- MOBILE SEARCH TOGGLE --}}
                <button type="button" id="mobileThesisSearchToggle" class="thesis-mobile-search-button"
                    aria-label="Open Search" aria-expanded="false" data-tooltip="Search">
                    <i class="bi bi-search"></i>
                </button>


                {{-- ADD THESIS --}}
                <div class="thesis-header-action">

                    <a href="{{ route('admin.thesis.create') }}" class="thesis-add-button" data-tooltip="Add New Thesis"
                        aria-label="Add New Thesis">

                        <i class="bi bi-plus-lg"></i>

                        <span class="thesis-button-text">
                            Add New Thesis
                        </span>

                    </a>

                </div>

            </div>

        </div>


        {{-- =========================================================
            MOBILE SEARCH PANEL
        ========================================================== --}}

        <div id="mobileThesisSearchPanel" class="thesis-mobile-search-panel">

            <div class="thesis-mobile-search-content">

                <div class="thesis-mobile-search-input">

                    <i class="bi bi-search"></i>

                    <input type="text" id="mobileThesisSearchInput"
                        placeholder="Search title, author, or department..." autocomplete="off">

                </div>


                <button type="button" id="mobileThesisResetFilter" class="thesis-mobile-reset-button"
                    aria-label="Reset Search" data-tooltip="Reset">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>

            </div>

        </div>


        {{-- =========================================================
            DESKTOP FILTER CARD
        ========================================================== --}}

        <div class="thesis-filter-card">

            {{-- FILTER BODY --}}

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

                        <select class="thesis-filter-select" id="departmentFilter" name="department">

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

                        <select class="thesis-filter-select" id="yearFilter" name="started_year">

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

                            <option value="2023">
                                2023
                            </option>

                        </select>

                    </div>


                    {{-- RESET --}}

                    <div class="col-12 col-lg-2">

                        <button type="button" id="resetFilter" class="thesis-reset-button" data-tooltip="Reset Filters"
                            aria-label="Reset Filters">

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


            {{-- THESIS CARDS --}}

            <div id="adminThesisCards" class="row g-4">

                @include('admin.thesis.table')

            </div>

        </div>

    </div>


    {{-- =========================================================
        JAVASCRIPT
    ========================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let searchTimeout = null;
            let currentController = null;


            /* =====================================================
               ELEMENTS
            ===================================================== */

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

            const thesisGrid =
                document.getElementById('adminThesisCards');


            /* =====================================================
               LOAD DATA
            ===================================================== */

            function loadData() {

                /*
                 * Cancel previous request.
                 * This prevents an older search request from
                 * replacing newer search results.
                 */
                if (currentController) {
                    currentController.abort();
                }

                currentController =
                    new AbortController();


                /* SHOW LOADING */

                if (spinner) {
                    spinner.classList.remove('d-none');
                }

                if (thesisGrid) {
                    thesisGrid.classList.add('is-loading');
                }


                /* GET SEARCH VALUE */

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


                /* QUERY */

                const query = new URLSearchParams({

                    search: currentSearch,

                    department: departmentFilter ?
                        departmentFilter.value : '',

                    year: yearFilter ?
                        yearFilter.value : ''

                });


                /* AJAX REQUEST */

                fetch(
                        "{{ route('admin.thesis.search') }}?" +
                        query.toString(), {
                            signal: currentController.signal,

                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'text/html'
                            }
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

                        if (thesisGrid) {

                            thesisGrid.innerHTML = html;

                        }

                    })

                    .catch(error => {

                        if (error.name !== 'AbortError') {

                            console.error(
                                'Error loading thesis records:',
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

                        if (thesisGrid) {

                            thesisGrid.classList.remove(
                                'is-loading'
                            );

                        }

                    });

            }


            /* =====================================================
               DESKTOP SEARCH
            ===================================================== */

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
            ===================================================== */

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
            ===================================================== */

            if (departmentFilter) {

                departmentFilter.addEventListener(
                    'change',
                    loadData
                );

            }


            /* =====================================================
               YEAR
            ===================================================== */

            if (yearFilter) {

                yearFilter.addEventListener(
                    'change',
                    loadData
                );

            }


            /* =====================================================
               DESKTOP RESET
            ===================================================== */

            if (resetButton) {

                resetButton.addEventListener(
                    'click',
                    function() {

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
            ===================================================== */

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


                            setTimeout(function() {

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
            ===================================================== */

            if (mobileResetButton) {

                mobileResetButton.addEventListener(
                    'click',
                    function() {

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
            ===================================================== */

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
            ===================================================== */

            window.addEventListener(
                'resize',
                function() {

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
        BLACK + WHITE ONLY
    ========================================================== --}}

    <style>
        /* =========================================================
           VARIABLES
        ========================================================== */

        .thesis-page {

            --thesis-black: #000000;
            --thesis-white: #ffffff;

            --thesis-page-bg: #ffffff;
            --thesis-card-bg: #ffffff;
            --thesis-input-bg: #fafafa;

            --thesis-text: #000000;
            --thesis-text-secondary: #333333;
            --thesis-text-muted: #777777;

            --thesis-border: #000000;
            --thesis-border-soft: #dddddd;

            --thesis-primary: #000000;
            --thesis-primary-hover: #222222;

            --thesis-shadow:
                0 4px 18px rgba(0, 0, 0, .07);

            --thesis-card-shadow:
                0 2px 10px rgba(0, 0, 0, .05);

        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] .thesis-page,
        .dark .thesis-page {

            --thesis-black: #000000;
            --thesis-white: #ffffff;

            --thesis-page-bg: #000000;
            --thesis-card-bg: #000000;
            --thesis-input-bg: #0d0d0d;

            --thesis-text: #ffffff;
            --thesis-text-secondary: #dddddd;
            --thesis-text-muted: #999999;

            --thesis-border: #ffffff;
            --thesis-border-soft: #000000;

            --thesis-primary: #ffffff;
            --thesis-primary-hover: #dddddd;

            --thesis-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

            --thesis-card-shadow:
                0 2px 10px rgba(0, 0, 0, .35);

        }


        /* =========================================================
           PAGE
        ========================================================== */

        .thesis-page {

            color: var(--thesis-text);

            transition:
                color .25s ease,
                background-color .25s ease;

        }


        /* =========================================================
           HEADER
        ========================================================== */

        .thesis-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            min-height: 80px;
            padding-bottom: 1.25rem;
        }

        .thesis-header-content {
            min-width: 0;
            flex: 1;
        }

        .thesis-title-row {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .thesis-title-wrapper {
            text-align: left;
        }

        .thesis-title {
            margin: 0;
            color: var(--thesis-text-main);
            font-size: 1.8rem;
            letter-spacing: -0.035em;
            line-height: 1.4;
        }

        .thesis-overline {
            display: block;
            margin-bottom: 0.25rem;
            color: var(--thesis-text-sub);
            font-size: 0.95rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        /* =========================================================
           HEADER ACTIONS
        ========================================================== */

        .thesis-header-actions {

            display: flex;

            align-items: center;

            gap: .5rem;

            flex-shrink: 0;

        }


        /* =========================================================
           ADD THESIS BUTTON
        ========================================================== */

        .thesis-add-button {

            position: relative;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .55rem;

            min-height: 44px;

            padding: .7rem 1rem;

            color:
                var(--thesis-white);

            background:
                var(--thesis-black);

            border:
                1px solid var(--thesis-black);

            border-radius: 8px;

            text-decoration: none;

            font-size: .72rem;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .03em;

            transition:
                .2s ease;

        }


        [data-bs-theme="dark"] .thesis-add-button,
        .dark .thesis-add-button {

            color:
                var(--thesis-black);

            background:
                var(--thesis-white);

            border-color:
                var(--thesis-white);

        }


        .thesis-add-button:hover {

            color:
                var(--thesis-white);

            background:
                #222222;

            border-color:
                #222222;

            transform:
                translateY(-2px);

        }


        [data-bs-theme="dark"] .thesis-add-button:hover,
        .dark .thesis-add-button:hover {

            color:
                var(--thesis-black);

            background:
                #dddddd;

            border-color:
                #dddddd;

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

            color:
                var(--thesis-text);

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            cursor: pointer;

            transition:
                .2s ease;

        }


        .thesis-mobile-search-button:hover,
        .thesis-mobile-search-button.is-active {

            color:
                var(--thesis-white);

            background:
                var(--thesis-black);

            border-color:
                var(--thesis-black);

        }


        [data-bs-theme="dark"] .thesis-mobile-search-button:hover,
        [data-bs-theme="dark"] .thesis-mobile-search-button.is-active,
        .dark .thesis-mobile-search-button:hover,
        .dark .thesis-mobile-search-button.is-active {

            color:
                var(--thesis-black);

            background:
                var(--thesis-white);

            border-color:
                var(--thesis-white);

        }


        /* =========================================================
           FILTER CARD
        ========================================================== */

        .thesis-filter-card {

            margin-bottom: 1.5rem;

            overflow: hidden;

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 12px;

            box-shadow:
                var(--thesis-shadow);

        }


        .thesis-filter-header {

            padding:
                1rem 1.25rem;

            background:
                var(--thesis-card-bg);

            border-bottom:
                1px solid var(--thesis-border-soft);

        }


        .thesis-filter-title {

            display: flex;

            align-items: center;

            gap: .75rem;

        }


        .thesis-filter-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 38px;

            height: 38px;

            flex-shrink: 0;

            color:
                var(--thesis-white);

            background:
                var(--thesis-black);

            border:
                1px solid var(--thesis-black);

            border-radius: 8px;

        }


        [data-bs-theme="dark"] .thesis-filter-icon,
        .dark .thesis-filter-icon {

            color:
                var(--thesis-black);

            background:
                var(--thesis-white);

            border-color:
                var(--thesis-white);

        }


        .thesis-filter-title h6 {

            margin: 0 0 .15rem;

            color:
                var(--thesis-text);

            font-size: .8rem;

            font-weight: 800;

        }


        .thesis-filter-title span {

            color:
                var(--thesis-text-muted);

            font-size: .7rem;

        }


        .thesis-filter-body {

            padding:
                1.2rem 1.25rem;

            background:
                var(--thesis-card-bg);

        }


        /* =========================================================
           LABEL
        ========================================================== */

        .thesis-input-label {

            display: block;

            margin-bottom: .45rem;

            color:
                var(--thesis-text-secondary);

            font-size: .67rem;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .05em;

        }


        /* =========================================================
           SEARCH
        ========================================================== */

        .thesis-search {

            position: relative;

        }


        .thesis-search i {

            position: absolute;

            left: 1rem;

            top: 50%;

            z-index: 2;

            transform:
                translateY(-50%);

            color:
                var(--thesis-text-muted);

            pointer-events: none;

        }


        .thesis-search input {

            width: 100%;

            height: 45px;

            padding:
                .6rem 1rem .6rem 2.75rem;

            background:
                var(--thesis-input-bg);

            color:
                var(--thesis-text);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            outline: none;

            font-size: .82rem;

        }


        .thesis-search input::placeholder {

            color:
                var(--thesis-text-muted);

        }


        .thesis-search input:focus,
        .thesis-filter-select:focus {

            border-color:
                var(--thesis-primary);

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, .08);

        }


        [data-bs-theme="dark"] .thesis-search input:focus,
        [data-bs-theme="dark"] .thesis-filter-select:focus,
        .dark .thesis-search input:focus,
        .dark .thesis-filter-select:focus {

            box-shadow:
                0 0 0 3px rgba(255, 255, 255, .10);

        }


        /* =========================================================
           SELECT
        ========================================================== */

        .thesis-filter-select {

            width: 100%;

            height: 45px;

            padding:
                .5rem 2rem .5rem .85rem;

            background:
                var(--thesis-input-bg);

            color:
                var(--thesis-text);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            outline: none;

            font-size: .8rem;

            cursor: pointer;

        }


        .thesis-filter-select option {

            color: #000000;

            background: #ffffff;

        }


        [data-bs-theme="dark"] .thesis-filter-select option,
        .dark .thesis-filter-select option {

            color: #ffffff;

            background: #000000;

        }


        /* =========================================================
           RESET BUTTON
        ========================================================== */

        .thesis-reset-button {

            position: relative;

            width: 100%;

            height: 45px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .45rem;

            background:
                var(--thesis-card-bg);

            color:
                var(--thesis-text);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            font-size: .7rem;

            font-weight: 800;

            text-transform: uppercase;

            cursor: pointer;

            transition:
                .2s ease;

        }


        .thesis-reset-button:hover {

            color:
                var(--thesis-white);

            background:
                var(--thesis-black);

            border-color:
                var(--thesis-black);

        }


        [data-bs-theme="dark"] .thesis-reset-button:hover,
        .dark .thesis-reset-button:hover {

            color:
                var(--thesis-black);

            background:
                var(--thesis-white);

            border-color:
                var(--thesis-white);

        }


        /* =========================================================
           MOBILE SEARCH PANEL
        ========================================================== */

        .thesis-mobile-search-panel {

            display: none;

            margin-bottom: 1rem;

            overflow: hidden;

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 10px;

            opacity: 0;

            transform:
                translateY(-6px);

            transition:
                opacity .2s ease,
                transform .2s ease;

        }


        .thesis-mobile-search-panel.is-open {

            opacity: 1;

            transform:
                translateY(0);

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

            left: .85rem;

            top: 50%;

            transform:
                translateY(-50%);

            color:
                var(--thesis-text-muted);

            pointer-events: none;

        }


        .thesis-mobile-search-input input {

            width: 100%;

            height: 44px;

            padding:
                .5rem .75rem .5rem 2.5rem;

            color:
                var(--thesis-text);

            background:
                var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            outline: none;

            font-size: .8rem;

        }


        .thesis-mobile-search-input input::placeholder {

            color:
                var(--thesis-text-muted);

        }


        .thesis-mobile-search-input input:focus {

            border-color:
                var(--thesis-primary);

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, .08);

        }


        [data-bs-theme="dark"] .thesis-mobile-search-input input:focus,
        .dark .thesis-mobile-search-input input:focus {

            box-shadow:
                0 0 0 3px rgba(255, 255, 255, .10);

        }


        .thesis-mobile-reset-button {

            position: relative;

            display: flex;

            align-items: center;

            justify-content: center;

            width: 44px;

            height: 44px;

            flex-shrink: 0;

            color:
                var(--thesis-text);

            background:
                var(--thesis-card-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            cursor: pointer;

            transition:
                .2s ease;

        }


        .thesis-mobile-reset-button:hover {

            color:
                var(--thesis-white);

            background:
                var(--thesis-black);

            border-color:
                var(--thesis-black);

        }


        [data-bs-theme="dark"] .thesis-mobile-reset-button:hover,
        .dark .thesis-mobile-reset-button:hover {

            color:
                var(--thesis-black);

            background:
                var(--thesis-white);

            border-color:
                var(--thesis-white);

        }


        /* =========================================================
           RESULTS
        ========================================================== */

        .thesis-results-wrapper {

            position: relative;

            min-height: 100px;

        }


        #adminThesisCards {

            transition:
                opacity .2s ease;

        }


        #adminThesisCards.is-loading {

            opacity: .45;

            pointer-events: none;

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

            padding:
                .65rem .9rem;

            transform:
                translateX(-50%);

            background:
                var(--thesis-card-bg);

            color:
                var(--thesis-text);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            box-shadow:
                var(--thesis-shadow);

            font-size: .7rem;

            font-weight: 700;

        }


        .thesis-spinner {

            width: 17px;

            height: 17px;

            border:
                2px solid var(--thesis-border-soft);

            border-top-color:
                var(--thesis-primary);

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
           TOOLTIPS
        ========================================================== */

        .thesis-mobile-search-button[data-tooltip]::after,
        .thesis-add-button[data-tooltip]::after,
        .thesis-reset-button[data-tooltip]::after,
        .thesis-mobile-reset-button[data-tooltip]::after {

            content:
                attr(data-tooltip);

            position: absolute;

            left: 50%;

            top:
                calc(100% + 8px);

            z-index: 100;

            padding:
                .4rem .6rem;

            transform:
                translateX(-50%) translateY(-3px);

            background:
                var(--thesis-black);

            color:
                var(--thesis-white);

            border-radius: 5px;

            font-size: .62rem;

            font-weight: 700;

            white-space: nowrap;

            opacity: 0;

            pointer-events: none;

            transition:
                opacity .15s ease,
                transform .15s ease;

        }


        .thesis-mobile-search-button[data-tooltip]:hover::after,
        .thesis-add-button[data-tooltip]:hover::after,
        .thesis-reset-button[data-tooltip]:hover::after,
        .thesis-mobile-reset-button[data-tooltip]:hover::after {

            opacity: 1;

            transform:
                translateX(-50%) translateY(0);

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .thesis-page-header {

                gap: 1rem;

                margin-bottom: 1rem;

                padding: 1rem;

            }


            .thesis-page-title {

                font-size: 1.25rem;

            }


            .thesis-page-description {

                font-size: .76rem;

            }


            /* HEADER ACTIONS */

            .thesis-header-actions {

                gap: .4rem;

            }


            /* SHOW MOBILE SEARCH ICON */

            .thesis-mobile-search-button {

                display: flex;

            }


            /* ADD THESIS ICON ONLY */

            .thesis-add-button {

                width: 44px;

                height: 44px;

                min-width: 44px;

                min-height: 44px;

                padding: 0;

            }


            .thesis-add-button .thesis-button-text {

                display: none;

            }


            .thesis-add-button i {

                font-size: 1rem;

            }


            /* HIDE DESKTOP FILTER */

            .thesis-filter-card {

                display: none;

            }


            /* SHOW MOBILE SEARCH */

            .thesis-mobile-search-panel {

                display: block;

            }


            /* HIDE TOOLTIP MOBILE */

            .thesis-mobile-search-button[data-tooltip]::after,
            .thesis-add-button[data-tooltip]::after,
            .thesis-reset-button[data-tooltip]::after,
            .thesis-mobile-reset-button[data-tooltip]::after {

                display: none;

            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .thesis-page-header {

                padding: .85rem;

                border-radius: 9px;

            }


            .thesis-page-title {

                font-size: 1.05rem;

            }


            .thesis-page-description {

                display: none;

            }


            .thesis-mobile-search-content {

                padding: .6rem;

            }


            .thesis-mobile-search-input input {

                height: 42px;

                font-size: .76rem;

            }


            .thesis-mobile-reset-button {

                width: 42px;

                height: 42px;

            }


            .thesis-mobile-search-button {

                width: 42px;

                height: 42px;

            }


            .thesis-add-button {

                width: 42px;

                height: 42px;

                min-width: 42px;

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
