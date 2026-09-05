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

                <button
                    type="button"
                    id="mobileThesisSearchToggle"
                    class="thesis-mobile-search-button"
                    data-tooltip="Search"
                    aria-label="Open Search"
                    aria-expanded="false"
                >
                    <i class="bi bi-search"></i>
                </button>


                {{-- MY UPLOAD --}}

                <a
                    href="{{ route('admin.thesis.my-upload') }}"
                    class="thesis-add-button thesis-my-upload-button"
                >

                    <i class="bi bi-cloud-arrow-up"></i>

                    <span class="thesis-button-text">
                        My Upload
                    </span>

                </a>


                {{-- ADD THESIS --}}

                <a
                    href="{{ route('admin.thesis.create') }}"
                    class="thesis-add-button"
                >

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

        <div
            id="mobileThesisSearchPanel"
            class="thesis-mobile-search-panel"
        >

            <div class="thesis-mobile-search-content">

                <div class="thesis-mobile-search-input">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="mobileThesisSearchInput"
                        placeholder="Search title, author, or department..."
                        autocomplete="off"
                    >

                </div>


                <button
                    type="button"
                    id="mobileThesisResetFilter"
                    class="thesis-mobile-reset-button"
                    data-tooltip="Reset Search"
                    aria-label="Reset Search"
                >

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

                        <label
                            for="search"
                            class="thesis-input-label"
                        >
                            Search
                        </label>

                        <div class="thesis-search">

                            <i class="bi bi-search"></i>

                            <input
                                type="text"
                                id="search"
                                placeholder="Search title, author, or department..."
                                autocomplete="off"
                            >

                        </div>

                    </div>


                    {{-- DEPARTMENT --}}

                    <div class="col-12 col-md-6 col-lg-3">

                        <label
                            for="departmentFilter"
                            class="thesis-input-label"
                        >
                            Department
                        </label>

                        <select
                            class="thesis-filter-select"
                            id="departmentFilter"
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

                    <div class="col-12 col-md-6 col-lg-2">

                        <label
                            for="yearFilter"
                            class="thesis-input-label"
                        >
                            Academic Year
                        </label>

                        <select
                            class="thesis-filter-select thesis-year-select"
                            id="yearFilter"
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

                            <option value="2023">
                                2023
                            </option>

                        </select>

                    </div>


                    {{-- RESET --}}

                    <div class="col-12 col-lg-2">

                        <button
                            type="button"
                            id="resetFilter"
                            class="thesis-reset-button"
                            data-tooltip="Reset Filters"
                        >

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

            <div
                id="thesisSearchSpinner"
                class="thesis-loading d-none"
            >

                <div class="thesis-spinner"></div>

                <span>
                    Loading records...
                </span>

            </div>


            {{-- THESIS CARDS --}}

            <div
                id="adminThesisCards"
                class="thesis-card-grid"
            >

                @include('admin.thesis.table')

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
                    'adminThesisCards'
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

                .then(function (response) {

                    if (!response.ok) {

                        throw new Error(
                            'Network response failed'
                        );

                    }

                    return response.text();

                })

                .then(function (html) {

                    if (thesisGrid) {

                        thesisGrid.innerHTML =
                            html;

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
                                function () {

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
                function () {

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
    ============================================================= --}}

    <style>

    /* =========================================================
       VARIABLES
    ========================================================== */

    :root {

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

        --thesis-shadow:
            0 4px 18px rgba(0, 0, 0, .07);

        --thesis-card-shadow:
            0 2px 10px rgba(0, 0, 0, .05);

        --thesis-primary: #000000;

    }


    /* =========================================================
       DARK MODE
       SAME PALETTE AS ADMIN DASHBOARD
    ========================================================== */

    [data-bs-theme="dark"] {

        --thesis-black: #000000;
        --thesis-white: #ffffff;

        /* Admin Dashboard background */
        --thesis-page-bg: #101426;

        /* Admin Dashboard cards */
        --thesis-card-bg: #181d33;

        /* Admin Dashboard inputs */
        --thesis-input-bg: #20253a;

        /* Text */
        --thesis-text: #ffffff;
        --thesis-text-secondary: #d5d8e8;
        --thesis-text-muted: #999fb9;

        /* Borders */
        --thesis-border: #ffffff;
        --thesis-border-soft: #292e45;

        /* Primary */
        --thesis-primary: #ffffff;

        /* Shadows */
        --thesis-shadow:
            0 4px 18px rgba(0, 0, 0, .35);

        --thesis-card-shadow:
            0 2px 10px rgba(0, 0, 0, .30);

    }


    /* =========================================================
       GLOBAL DARK MODE
    ========================================================== */

    [data-bs-theme="dark"] body {

        background: #101426;
        color: #eeeef8;

    }


    [data-bs-theme="dark"] .dashboard-content {

        background: #101426;
        color: #eeeef8;

    }


    /* =========================================================
       PAGE
    ========================================================== */

    .thesis-page {

        color:
            var(--thesis-text);

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

        background:
            var(--thesis-page-bg);

        box-sizing: border-box;

    }


    [data-bs-theme="dark"]
    .thesis-page-header {

        background: #171b30;

    }


    .thesis-header-content {

        min-width: 0;

        flex: 1;

    }


    .thesis-title-row {

        display: flex;

        align-items: center;

    }


    .thesis-overline {

        display: block;

        margin-bottom: .2rem;

        color:
            var(--thesis-text-muted);

        font-size: .7rem;

        font-weight: 800;

        letter-spacing: .13em;

        line-height: 1.2;

        text-transform: uppercase;

    }


    .thesis-title {

        margin: 0;

        color:
            var(--thesis-text);

        font-size: 1.8rem;

        font-weight: 600;

        line-height: 1.2;

        letter-spacing: -.035em;

    }


    [data-bs-theme="dark"]
    .thesis-title {

        color: #ffffff;

    }


    [data-bs-theme="dark"]
    .thesis-overline {

        color: #999fb9;

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
       HEADER BUTTON
    ========================================================== */

    .thesis-add-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: .5rem;

        min-height: 44px;

        padding: .65rem 1rem;

        color:
            var(--thesis-white);

        background:
            var(--thesis-black);

        border:
            1px solid var(--thesis-black);

        border-radius: 8px;

        text-decoration: none;

        font-size: .68rem;

        font-weight: 800;

        letter-spacing: .03em;

        text-transform: uppercase;

        transition:
            .2s ease;

    }


    .thesis-add-button:hover {

        color:
            var(--thesis-white);

        background:
            #252525;

        border-color:
            #252525;

        transform:
            translateY(-2px);

    }


    /* =========================================================
       DARK HEADER BUTTON
    ========================================================== */

    [data-bs-theme="dark"]
    .thesis-add-button {

        color: #000000;

        background: #ffffff;

        border-color: #ffffff;

    }


    [data-bs-theme="dark"]
    .thesis-add-button:hover {

        color: #000000;

        background: #dddddd;

        border-color: #dddddd;

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


    [data-bs-theme="dark"]
    .thesis-mobile-search-button {

        color: #ffffff;

        background: #181d33;

        border-color: #292e45;

    }


    [data-bs-theme="dark"]
    .thesis-mobile-search-button:hover,
    [data-bs-theme="dark"]
    .thesis-mobile-search-button.is-active {

        color: #000000;

        background: #ffffff;

        border-color: #ffffff;

    }


    /* =========================================================
       FILTER CARD
    ========================================================== */

    .thesis-filter-card {

        width: 100%;

        background:
            var(--thesis-card-bg);

        box-sizing: border-box;

    }


    .thesis-filter-body {

        overflow: hidden;

        padding:
            1.2rem 1.25rem;

        background:
            var(--thesis-card-bg);

    }


    [data-bs-theme="dark"]
    .thesis-filter-card,
    [data-bs-theme="dark"]
    .thesis-filter-body {

        background: #181d33;

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

        letter-spacing: .05em;

        text-transform: uppercase;

    }


    [data-bs-theme="dark"]
    .thesis-input-label {

        color: #d5d8e8;

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

        transform:
            translateY(-50%);

        color:
            var(--thesis-text-muted);

        pointer-events: none;

    }


    [data-bs-theme="dark"]
    .thesis-search i {

        color: #999fb9;

    }


    .thesis-search input {

        width: 100%;

        height: 45px;

        padding:
            .6rem 1rem .6rem 2.75rem;

        color:
            var(--thesis-text);

        background:
            var(--thesis-input-bg);

        border:
            1px solid var(--thesis-border-soft);

        border-radius: 8px;

        outline: none;

        font-size: .82rem;

        box-sizing: border-box;

        transition:
            .2s ease;

    }


    [data-bs-theme="dark"]
    .thesis-search input {

        color: #ffffff;

        background: #20253a;

        border-color: #343a52;

    }


    .thesis-search input::placeholder {

        color:
            var(--thesis-text-muted);

    }


    [data-bs-theme="dark"]
    .thesis-search input::placeholder {

        color: #777f9c;

    }


    .thesis-search input:focus,
    .thesis-filter-select:focus {

        border-color:
            var(--thesis-primary);

        box-shadow:
            0 0 0 3px rgba(0, 0, 0, .08);

    }


    [data-bs-theme="dark"]
    .thesis-search input:focus,
    [data-bs-theme="dark"]
    .thesis-filter-select:focus {

        border-color: #ffffff;

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

        color:
            var(--thesis-text);

        background:
            var(--thesis-input-bg);

        border:
            1px solid var(--thesis-border-soft);

        border-radius: 8px;

        outline: none;

        font-size: .8rem;

        cursor: pointer;

        box-sizing: border-box;

        transition:
            .2s ease;

    }


    [data-bs-theme="dark"]
    .thesis-filter-select {

        color: #ffffff;

        background: #20253a;

        border-color: #343a52;

    }


    .thesis-filter-select option {

        color: #000000;

        background: #ffffff;

    }


    [data-bs-theme="dark"]
    .thesis-filter-select option {

        color: #ffffff;

        background: #20253a;

    }


    .thesis-year-select {

        font-family:
            monospace;

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

        color:
            var(--thesis-text);

        background:
            var(--thesis-card-bg);

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


    [data-bs-theme="dark"]
    .thesis-reset-button {

        color: #ffffff;

        background: #20253a;

        border-color: #343a52;

    }


    .thesis-reset-button:hover {

        color:
            var(--thesis-white);

        background:
            var(--thesis-black);

        border-color:
            var(--thesis-black);

    }


    [data-bs-theme="dark"]
    .thesis-reset-button:hover {

        color: #000000;

        background: #ffffff;

        border-color: #ffffff;

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


    /* =========================================================
       GRID
    ========================================================== */

    .thesis-card-grid {

        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

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
            border-color .25s ease,
            background-color .25s ease;

    }


    [data-bs-theme="dark"]
    .admin-thesis-card {

        background: #181d33;

        border-color: #292e45;

        color: #eeeef8;

        box-shadow:
            0 2px 10px rgba(0, 0, 0, .30);

    }


    .admin-thesis-card:hover {

        transform:
            translateY(-5px);

        box-shadow:
            var(--thesis-shadow);

    }


    [data-bs-theme="dark"]
    .admin-thesis-card:hover {

        background: #1b2038;

        border-color: #343a52;

        box-shadow:
            0 4px 18px rgba(0, 0, 0, .35);

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


    /* =========================================================
       ICON
    ========================================================== */

    .admin-thesis-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 34px;

        height: 34px;

        flex-shrink: 0;

        color:
            var(--thesis-white);

        background:
            var(--thesis-black);

        border-radius: 9px;

        font-size: .8rem;

    }


    [data-bs-theme="dark"]
    .admin-thesis-icon {

        color: #000000;

        background: #ffffff;

    }


    /* =========================================================
       TITLE
    ========================================================== */

    .admin-thesis-card-title {

        display: -webkit-box;

        margin: 0;

        overflow: hidden;

        color:
            var(--thesis-text);

        font-size: 1rem;

        font-weight: 800;

        line-height: 1.4;

        letter-spacing: -.02em;

        -webkit-line-clamp: 3;

        -webkit-box-orient: vertical;

        word-break: break-word;

    }


    [data-bs-theme="dark"]
    .admin-thesis-card-title {

        color: #ffffff;

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

        padding:
            .4rem .6rem;

        border-radius: 20px;

        font-size: .57rem;

        font-weight: 800;

        text-transform: uppercase;

        white-space: nowrap;

    }


    .admin-thesis-status-badge.pending {

        color: #856404;

        background: #fff3cd;

    }


    .admin-thesis-status-badge.refused {

        color: #842029;

        background: #f8d7da;

    }


    .admin-thesis-status-badge.approved {

        color: #146c43;

        background: #d1e7dd;

    }


    /* =========================================================
       PUBLISHED
    ========================================================== */

    .admin-thesis-published {

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: .65rem;

        margin:
            0 1rem 1rem;

        padding: .75rem;

        color:
            var(--thesis-text);

        background:
            var(--thesis-input-bg);

        border-radius: 10px;

        box-sizing: border-box;

    }


    [data-bs-theme="dark"]
    .admin-thesis-published {

        color: #eeeef8;

        background: #20253a;

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

        color:
            var(--thesis-text-secondary);

        background:
            var(--thesis-card-bg);

        border:
            1px solid var(--thesis-border-soft);

        border-radius: 7px;

        font-size: .68rem;

    }


    [data-bs-theme="dark"]
    .admin-thesis-published-icon {

        color: #d5d8e8;

        background: #181d33;

        border-color: #343a52;

    }


    .admin-thesis-published-content {

        display: flex;

        flex-direction: column;

        min-width: 0;

    }


    .admin-thesis-published-label {

        margin-bottom: .12rem;

        color:
            var(--thesis-text-muted);

        font-size: .5rem;

        font-weight: 800;

        letter-spacing: .05em;

        text-transform: uppercase;

    }


    [data-bs-theme="dark"]
    .admin-thesis-published-label {

        color: #999fb9;

    }


    .admin-thesis-published-value {

        overflow: hidden;

        color:
            var(--thesis-text-secondary);

        font-size: .62rem;

        font-weight: 700;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    [data-bs-theme="dark"]
    .admin-thesis-published-value {

        color: #d5d8e8;

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

        color:
            var(--thesis-text-secondary);

        background:
            var(--thesis-input-bg);

        border:
            1px solid var(--thesis-border-soft);

        border-radius: 8px;

        font-size: .72rem;

    }


    [data-bs-theme="dark"]
    .admin-thesis-detail-icon {

        color: #d5d8e8;

        background: #20253a;

        border-color: #343a52;

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

        font-size: .55rem;

        font-weight: 800;

        letter-spacing: .06em;

        text-transform: uppercase;

    }


    [data-bs-theme="dark"]
    .admin-thesis-detail-label {

        color: #999fb9;

    }


    .admin-thesis-detail-value {

        overflow: hidden;

        color:
            var(--thesis-text-secondary);

        font-size: .7rem;

        font-weight: 600;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    [data-bs-theme="dark"]
    .admin-thesis-detail-value {

        color: #d5d8e8;

    }


    /* =========================================================
       SUBMITTED
    ========================================================== */

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

        font-size: .53rem;

        font-weight: 800;

        letter-spacing: .05em;

        text-transform: uppercase;

    }


    .admin-thesis-submitted-value {

        min-width: 0;

        overflow: hidden;

        color:
            var(--thesis-text-secondary);

        font-size: .62rem;

        font-weight: 700;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    [data-bs-theme="dark"]
    .admin-thesis-submitted-value {

        color: #d5d8e8;

    }


    /* =========================================================
       FOOTER
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


    [data-bs-theme="dark"]
    .admin-thesis-card-footer {

        background: #20253a;

        border-top-color: #292e45;

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

        padding:
            .4rem .7rem;

        border-radius: 8px;

        text-decoration: none;

        font-size: .62rem;

        font-weight: 800;

        transition:
            .2s ease;

    }


    /* =========================================================
       VIEW PDF — RED
    ========================================================== */

    .admin-thesis-view {

        color: #ffffff;

        background: #dc2626;

        border:
            1px solid #dc2626;

    }


    .admin-thesis-view:hover {

        color: #ffffff;

        background: #b91c1c;

        border-color: #b91c1c;

        transform:
            translateY(-1px);

    }


    /* =========================================================
       DOWNLOAD — BLUE
    ========================================================== */

    .admin-thesis-download {

        color: #ffffff;

        background: #2563eb;

        border:
            1px solid #2563eb;

    }


    .admin-thesis-download:hover {

        color: #ffffff;

        background: #1d4ed8;

        border-color: #1d4ed8;

        transform:
            translateY(-1px);

    }


    .admin-thesis-download.disabled {

        opacity: .5;

        cursor: not-allowed;

        pointer-events: none;

    }


    /* =========================================================
       EMPTY STATE
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


    [data-bs-theme="dark"]
    .admin-thesis-empty {

        background: #181d33;

        border-color: #292e45;

        color: #ffffff;

    }


    .admin-thesis-empty-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 55px;

        height: 55px;

        margin-bottom: 1rem;

        color:
            var(--thesis-white);

        background:
            var(--thesis-black);

        border-radius: 13px;

    }


    [data-bs-theme="dark"]
    .admin-thesis-empty-icon {

        color: #000000;

        background: #ffffff;

    }


    .admin-thesis-empty h3 {

        margin:
            0 0 .35rem;

        color:
            var(--thesis-text);

        font-size: 1rem;

        font-weight: 800;

    }


    [data-bs-theme="dark"]
    .admin-thesis-empty h3 {

        color: #ffffff;

    }


    .admin-thesis-empty p {

        margin: 0;

        color:
            var(--thesis-text-muted);

        font-size: .7rem;

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


    [data-bs-theme="dark"]
    .thesis-mobile-search-panel {

        background: #181d33;

        border-color: #292e45;

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

        top: 50%;

        left: .85rem;

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

        box-sizing: border-box;

    }


    [data-bs-theme="dark"]
    .thesis-mobile-search-input input {

        color: #ffffff;

        background: #20253a;

        border-color: #343a52;

    }


    .thesis-mobile-search-input input::placeholder {

        color:
            var(--thesis-text-muted);

    }


    [data-bs-theme="dark"]
    .thesis-mobile-search-input input::placeholder {

        color: #777f9c;

    }


    .thesis-mobile-search-input input:focus {

        border-color:
            var(--thesis-primary);

        box-shadow:
            0 0 0 3px rgba(0, 0, 0, .08);

    }


    [data-bs-theme="dark"]
    .thesis-mobile-search-input input:focus {

        border-color: #ffffff;

        box-shadow:
            0 0 0 3px rgba(255, 255, 255, .10);

    }


    /* =========================================================
       MOBILE RESET
    ========================================================== */

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


    [data-bs-theme="dark"]
    .thesis-mobile-reset-button {

        color: #ffffff;

        background: #20253a;

        border-color: #343a52;

    }


    .thesis-mobile-reset-button:hover {

        color:
            var(--thesis-white);

        background:
            var(--thesis-black);

        border-color:
            var(--thesis-black);

    }


    [data-bs-theme="dark"]
    .thesis-mobile-reset-button:hover {

        color: #000000;

        background: #ffffff;

        border-color: #ffffff;

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

        color:
            var(--thesis-text);

        background:
            var(--thesis-card-bg);

        border:
            1px solid var(--thesis-border-soft);

        border-radius: 8px;

        box-shadow:
            var(--thesis-shadow);

        font-size: .7rem;

        font-weight: 700;

        white-space: nowrap;

    }


    [data-bs-theme="dark"]
    .thesis-loading {

        color: #ffffff;

        background: #181d33;

        border-color: #292e45;

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

            transform:
                rotate(360deg);

        }

    }


    /* =========================================================
       TOOLTIPS
    ========================================================== */

    .thesis-mobile-search-button[data-tooltip]::after,
    .thesis-mobile-reset-button[data-tooltip]::after,
    .thesis-reset-button[data-tooltip]::after {

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
            var(--thesis-white);

        background:
            var(--thesis-black);

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


    [data-bs-theme="dark"]
    .thesis-mobile-search-button[data-tooltip]::after,
    [data-bs-theme="dark"]
    .thesis-mobile-reset-button[data-tooltip]::after,
    [data-bs-theme="dark"]
    .thesis-reset-button[data-tooltip]::after {

        color: #ffffff;

        background: #171b30;

        border: 1px solid #292e45;

    }


    .thesis-mobile-search-button[data-tooltip]:hover::after,
    .thesis-mobile-reset-button[data-tooltip]:hover::after,
    .thesis-reset-button[data-tooltip]:hover::after {

        opacity: 1;

        transform:
            translateX(-50%) translateY(0);

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

            margin-bottom: 1rem;

            padding: 1rem;

            gap: 1rem;

        }


        .thesis-title {

            font-size: 1.35rem;

        }


        .thesis-overline {

            font-size: .65rem;

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


        .thesis-card-grid {

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


        .thesis-mobile-search-button[data-tooltip]::after,
        .thesis-mobile-reset-button[data-tooltip]::after,
        .thesis-reset-button[data-tooltip]::after {

            display: none;

        }


        .admin-thesis-card-title {

            font-size: .9rem;

        }


        .admin-thesis-published {

            grid-template-columns:
                1fr;

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


        .thesis-mobile-search-content {

            padding: .6rem;

        }


        .thesis-mobile-search-input input {

            height: 42px;

            font-size: .76rem;

        }


        .thesis-mobile-reset-button,
        .thesis-mobile-search-button {

            width: 42px;

            height: 42px;

        }


        .thesis-card-grid {

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

            min-height: 34px;

            font-size: .58rem;

        }


        .admin-thesis-published {

            grid-template-columns:
                1fr;

        }


        .admin-thesis-status-badge {

            padding:
                .35rem .5rem;

            font-size: .5rem;

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