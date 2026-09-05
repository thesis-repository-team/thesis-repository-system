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
                <button type="button"
                    id="mobileThesisSearchToggle"
                    class="thesis-mobile-search-button"
                    aria-label="Open Search"
                    aria-expanded="false">

                    <i class="bi bi-search"></i>

                </button>

                {{-- ADD THESIS --}}
                <a href="{{ route('hod.thesis.create') }}"
                    class="thesis-add-button">

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

        <div id="mobileThesisSearchPanel"
            class="thesis-mobile-search-panel">

            <div class="thesis-mobile-search-content">

                <div class="thesis-mobile-search-input">

                    <i class="bi bi-search"></i>

                    <input type="text"
                        id="mobileThesisSearchInput"
                        placeholder="Search title, author, or department..."
                        autocomplete="off">

                </div>

                <button type="button"
                    id="mobileThesisResetFilter"
                    class="thesis-mobile-reset-button">

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

                    <label for="search"
                        class="thesis-input-label">

                        Search

                    </label>

                    <div class="thesis-search">

                        <i class="bi bi-search"></i>

                        <input type="text"
                            id="search"
                            placeholder="Search title, author, or department..."
                            autocomplete="off">

                    </div>

                </div>


                {{-- DEPARTMENT --}}
                <div class="col-12 col-md-6 col-lg-3">

                    <label for="departmentFilter"
                        class="thesis-input-label">

                        Department

                    </label>

                    <select class="thesis-filter-select"
                        id="departmentFilter">

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

                    <label for="yearFilter"
                        class="thesis-input-label">

                        Academic Year

                    </label>

                    <select class="thesis-filter-select"
                        id="yearFilter">

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

                    <button type="button"
                        id="resetFilter"
                        class="thesis-reset-button">

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
            <div id="thesisSearchSpinner"
                class="thesis-loading d-none">

                <div class="thesis-spinner"></div>

                <span>
                    Loading records...
                </span>

            </div>


            {{-- THESIS CARDS --}}
            <div id="hodThesisCards"
                class="thesis-card-grid">

                @include('hod.thesis.table')

            </div>

        </div>

    </div>


    {{-- =============================================================
        JAVASCRIPT
    ============================================================== --}}

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


    <style>
    /* =========================================================
       THESIS PAGE THEME
    ========================================================== */

    :root {
        --thesis-black: #000000;
        --thesis-white: #ffffff;

        --thesis-page-bg: #ffffff;
        --thesis-card-bg: #ffffff;
        --thesis-input-bg: #fafafa;
        --thesis-soft: #f7f7f7;

        --thesis-text: #000000;
        --thesis-text-secondary: #333333;
        --thesis-text-muted: #777777;

        --thesis-border: #000000;
        --thesis-border-soft: #dddddd;

        --thesis-primary: #000000;

        --thesis-shadow:
            0 4px 18px rgba(0, 0, 0, .07);

        --thesis-card-shadow:
            0 2px 10px rgba(0, 0, 0, .05);
    }


    /* =========================================================
       DARK MODE
    ========================================================== */

    [data-bs-theme="dark"] {

        --thesis-black: #000000;
        --thesis-white: #ffffff;

        --thesis-page-bg: #101426;
        --thesis-card-bg: #181d33;
        --thesis-input-bg: #20253a;
        --thesis-soft: #20253a;

        --thesis-text: #eeeef8;
        --thesis-text-secondary: #d5d8e8;
        --thesis-text-muted: #999fb9;

        --thesis-border: #ffffff;
        --thesis-border-soft: #292e45;

        --thesis-primary: #ffffff;

        --thesis-shadow:
            0 4px 18px rgba(0, 0, 0, .35);

        --thesis-card-shadow:
            0 2px 10px rgba(0, 0, 0, .30);
    }


    /* =========================================================
       PAGE
    ========================================================== */

    .thesis-page {
        color: var(--thesis-text);
        /* background: var(--thesis-page-bg); */
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

        color: var(--thesis-text);
        background: var(--thesis-page-bg);

        box-sizing: border-box;
    }

    .thesis-header-content {
        flex: 1;
        min-width: 0;
    }

    .thesis-title-row {
        display: flex;
        align-items: flex-start;
    }

    .thesis-overline {
        display: block;

        margin-bottom: .2rem;

        color: var(--thesis-text-muted);

        font-size: .7rem;
        font-weight: 800;

        letter-spacing: .13em;
        text-transform: uppercase;
    }

    .thesis-title {
        margin: 0;

        color: var(--thesis-text);

        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1.2;

        letter-spacing: -.035em;
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
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: .5rem;

        min-height: 44px;

        padding: .65rem 1rem;

        color: var(--thesis-white);

        background: var(--thesis-black);

        border: 1px solid var(--thesis-black);
        border-radius: 8px;

        text-decoration: none;

        font-size: .68rem;
        font-weight: 800;

        letter-spacing: .03em;
        text-transform: uppercase;

        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease,
            transform .2s ease;
    }

    .thesis-add-button:hover {
        color: var(--thesis-white);

        background: #252525;

        border-color: #252525;

        transform: translateY(-2px);
    }

    [data-bs-theme="dark"] .thesis-add-button {
        color: #000000;

        background: #ffffff;

        border-color: #ffffff;
    }

    [data-bs-theme="dark"] .thesis-add-button:hover {
        color: #ffffff;

        background: #000000;

        border-color: #ffffff;
    }


    /* =========================================================
       FILTER BODY
    ========================================================== */

    .thesis-filter-body {
        padding: 1.2rem 1.25rem;

        color: var(--thesis-text);

        background: var(--thesis-card-bg);
    }


    /* =========================================================
       INPUT LABEL
    ========================================================== */

    .thesis-input-label {
        display: block;

        margin-bottom: .45rem;

        color: var(--thesis-text-secondary);

        font-size: .67rem;
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

        color: var(--thesis-text-muted);

        transform: translateY(-50%);

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
            1px solid
            var(--thesis-border-soft);

        border-radius: 8px;

        outline: none;

        font-size: .82rem;

        box-sizing: border-box;

        transition:
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .thesis-search input::placeholder {
        color: var(--thesis-text-muted);
        opacity: 1;
    }

    .thesis-search input:focus {
        border-color: var(--thesis-primary);

        box-shadow:
            0 0 0 3px
            rgba(127, 127, 127, .12);
    }


    /* =========================================================
       SELECT
    ========================================================== */

    .thesis-filter-select {
        width: 100%;
        height: 45px;

        padding: .5rem .85rem;

        color: var(--thesis-text);

        background-color: var(--thesis-input-bg);

        border:
            1px solid
            var(--thesis-border-soft);

        border-radius: 8px;

        outline: none;

        font-size: .8rem;

        cursor: pointer;

        transition:
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .thesis-filter-select:focus {
        border-color: var(--thesis-primary);

        box-shadow:
            0 0 0 3px
            rgba(127, 127, 127, .12);
    }


    /* =========================================================
       SELECT OPTIONS
    ========================================================== */

    .thesis-filter-select option {
        color: #000000;
        background: #ffffff;
    }

    [data-bs-theme="dark"] .thesis-filter-select option {
        color: #eeeef8;
        background: #181d33;
    }


    /* =========================================================
       RESET BUTTON
    ========================================================== */

    .thesis-reset-button {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: .45rem;

        width: 100%;
        height: 45px;

        color: var(--thesis-text);

        background: var(--thesis-card-bg);

        border:
            1px solid
            var(--thesis-border-soft);

        border-radius: 8px;

        font-size: .68rem;
        font-weight: 800;

        text-transform: uppercase;

        cursor: pointer;

        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease;
    }

    .thesis-reset-button:hover {
        color: var(--thesis-white);

        background: var(--thesis-black);

        border-color: var(--thesis-black);
    }

    [data-bs-theme="dark"] .thesis-reset-button:hover {
        color: #000000;

        background: #ffffff;

        border-color: #ffffff;
    }


    /* =========================================================
       RESULTS WRAPPER
    ========================================================== */

    .thesis-results-wrapper {
        position: relative;

        min-height: 100px;

        color: var(--thesis-text);

        background: var(--thesis-page-bg);
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

        transition:
            opacity .2s ease;
    }

    .thesis-card-grid.is-loading {
        opacity: .45;

        pointer-events: none;
    }


    /* =========================================================
       THESIS CARD
    ========================================================== */

    .admin-thesis-card {
        display: flex;

        flex-direction: column;

        min-width: 0;

        overflow: hidden;

        color: var(--thesis-text);

        background: var(--thesis-card-bg);

        border:
            1px solid
            var(--thesis-border-soft);

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

        box-shadow:
            0 12px 30px
            rgba(0, 0, 0, .10);
    }

    [data-bs-theme="dark"] .admin-thesis-card:hover {
        border-color: #3b4260;

        box-shadow:
            0 12px 30px
            rgba(0, 0, 0, .50);
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
       THESIS ICON
    ========================================================== */

    .admin-thesis-icon {
        display: flex;

        align-items: center;
        justify-content: center;

        width: 34px;
        height: 34px;

        flex-shrink: 0;

        color: var(--thesis-white);

        background: var(--thesis-black);

        border-radius: 9px;

        font-size: .8rem;
    }

    [data-bs-theme="dark"] .admin-thesis-icon {
        color: #000000;

        background: #ffffff;
    }


    /* =========================================================
       CARD TITLE
    ========================================================== */

    .admin-thesis-card-title {
        display: -webkit-box;

        margin: 0;

        overflow: hidden;

        color: var(--thesis-text);

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

    [data-bs-theme="dark"] .admin-thesis-status-badge {
        color: #4ade80;

        background: #07140b;

        border: 1px solid #166534;
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

        background:
            var(--thesis-soft);

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

        color:
            var(--thesis-text-secondary);

        background:
            var(--thesis-card-bg);

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

        color:
            var(--thesis-text-muted);

        font-size: .5rem;
        font-weight: 800;

        letter-spacing: .05em;

        text-transform: uppercase;
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
            var(--thesis-soft);

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

        color:
            var(--thesis-text-muted);

        font-size: .55rem;
        font-weight: 800;

        letter-spacing: .06em;

        text-transform: uppercase;
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


    /* =========================================================
       SUBMITTED INFORMATION
    ========================================================== */

    .admin-thesis-submitted {
        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 1rem;

        margin-top: .3rem;

        padding-top: .8rem;

        border-top:
            1px solid
            var(--thesis-border-soft);
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
        overflow: hidden;

        color:
            var(--thesis-text-secondary);

        font-size: .62rem;
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
            var(--thesis-soft);

        border-top:
            1px solid
            var(--thesis-border-soft);
    }


    /* =========================================================
       ACTION BUTTONS
    ========================================================== */

    .admin-thesis-action {
        display: inline-flex !important;

        align-items: center;
        justify-content: center;

        gap: .4rem;

        flex: 1;

        min-height: 36px;

        padding: .4rem .7rem;

        border-radius: 8px;

        text-decoration: none !important;

        font-size: .62rem;
        font-weight: 800;

        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease;

        box-shadow: none !important;
    }

    .admin-thesis-action i {
        color: inherit !important;
    }


    /* =========================================================
       VIEW PDF - RED
    ========================================================== */

    .admin-thesis-view,
    .admin-thesis-view:visited {
        color: #ffffff !important;

        background: #dc3545 !important;

        border:
            1px solid #dc3545 !important;
    }

    .admin-thesis-view:hover,
    .admin-thesis-view:focus,
    .admin-thesis-view:active {
        color: #ffffff !important;

        background: #bb2d3b !important;

        border-color: #bb2d3b !important;

        text-decoration: none !important;

        box-shadow: none !important;
    }


    /* =========================================================
       DOWNLOAD - BLUE
    ========================================================== */

    .admin-thesis-download,
    .admin-thesis-download:visited {
        color: #ffffff !important;

        background: #0d6efd !important;

        border:
            1px solid #0d6efd !important;
    }

    .admin-thesis-download:hover,
    .admin-thesis-download:focus,
    .admin-thesis-download:active {
        color: #ffffff !important;

        background: #0b5ed7 !important;

        border-color: #0b5ed7 !important;

        text-decoration: none !important;

        box-shadow: none !important;
    }


    /* =========================================================
       EMPTY STATE
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

        color:
            var(--thesis-text);

        background:
            var(--thesis-card-bg);

        border:
            1px solid
            var(--thesis-border-soft);

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

        color:
            var(--thesis-white);

        background:
            var(--thesis-black);

        border-radius: 13px;
    }

    [data-bs-theme="dark"] .admin-thesis-empty-icon {
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

    .admin-thesis-empty p {
        margin: 0;

        color:
            var(--thesis-text-muted);

        font-size: .7rem;
    }


    /* =========================================================
       MOBILE SEARCH BUTTON
    ========================================================== */

    .thesis-mobile-search-button {
        display: none;

        align-items: center;
        justify-content: center;

        width: 44px;
        height: 44px;

        color:
            var(--thesis-text);

        background:
            var(--thesis-card-bg);

        border:
            1px solid
            var(--thesis-border-soft);

        border-radius: 8px;

        cursor: pointer;

        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease;
    }

    .thesis-mobile-search-button:hover {
        color:
            var(--thesis-white);

        background:
            var(--thesis-black);

        border-color:
            var(--thesis-black);
    }

    .thesis-mobile-search-button.is-active {
        color:
            var(--thesis-white);

        background:
            var(--thesis-black);

        border-color:
            var(--thesis-black);
    }

    [data-bs-theme="dark"]
    .thesis-mobile-search-button:hover,

    [data-bs-theme="dark"]
    .thesis-mobile-search-button.is-active {
        color:
            #000000;

        background:
            #ffffff;

        border-color:
            #ffffff;
    }


    /* =========================================================
       MOBILE SEARCH PANEL
    ========================================================== */

    .thesis-mobile-search-panel {
        display: none;

        margin:
            0 .75rem 1rem;

        overflow: hidden;

        color:
            var(--thesis-text);

        background:
            var(--thesis-card-bg);

        border:
            1px solid
            var(--thesis-border-soft);

        border-radius: 10px;

        opacity: 0;

        transform:
            translateY(-5px);

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

        color:
            var(--thesis-text-muted);

        transform:
            translateY(-50%);
    }

    .thesis-mobile-search-input input {
        width: 100%;
        height: 44px;

        padding:
            .5rem .75rem .5rem 2.4rem;

        color:
            var(--thesis-text);

        background:
            var(--thesis-input-bg);

        border:
            1px solid
            var(--thesis-border-soft);

        border-radius: 8px;

        outline: none;

        box-sizing: border-box;

        transition:
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .thesis-mobile-search-input input::placeholder {
        color:
            var(--thesis-text-muted);

        opacity: 1;
    }

    .thesis-mobile-search-input input:focus {
        border-color:
            var(--thesis-primary);

        box-shadow:
            0 0 0 3px
            rgba(127, 127, 127, .12);
    }


    /* =========================================================
       MOBILE RESET BUTTON
    ========================================================== */

    .thesis-mobile-reset-button {
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
            1px solid
            var(--thesis-border-soft);

        border-radius: 8px;

        cursor: pointer;

        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease;
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
        color:
            #000000;

        background:
            #ffffff;

        border-color:
            #ffffff;
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

        color:
            var(--thesis-text);

        background:
            var(--thesis-card-bg);

        border:
            1px solid
            var(--thesis-border-soft);

        border-radius: 8px;

        box-shadow:
            var(--thesis-shadow);

        font-size: .7rem;
        font-weight: 700;

        transform:
            translateX(-50%);
    }

    .thesis-spinner {
        width: 17px;
        height: 17px;

        border:
            2px solid
            var(--thesis-border-soft);

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
       BOOTSTRAP ALERTS
    ========================================================== */

    .thesis-page .alert {
        margin-left:
            1rem !important;

        margin-right:
            1rem !important;

        border-radius: 8px;
    }

    [data-bs-theme="dark"] .thesis-page .alert-success {
        color: #86efac;

        background: #07140b;

        border-color: #166534;
    }

    [data-bs-theme="dark"] .thesis-page .alert-danger {
        color: #fca5a5;

        background: #1a0808;

        border-color: #7f1d1d;
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

        .thesis-page .alert {
            margin-left:
                .75rem !important;

            margin-right:
                .75rem !important;
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


    /* =========================================================
       REDUCED MOTION
    ========================================================== */

    @media (prefers-reduced-motion: reduce) {

        .thesis-add-button,
        .thesis-reset-button,
        .thesis-mobile-search-button,
        .thesis-mobile-reset-button,
        .admin-thesis-card,
        .admin-thesis-action,
        .thesis-mobile-search-panel {
            transition: none;
        }

        .thesis-spinner {
            animation: none;
        }
    }


    /* =========================================================
       DARK MODE - FORCE CARD COLORS
       Prevent Bootstrap/global styles from overriding the theme.
    ========================================================== */

    [data-bs-theme="dark"] .thesis-page {
        color: #eeeef8;
        background: #101426;
    }

    [data-bs-theme="dark"] .thesis-page-header,
    [data-bs-theme="dark"] .thesis-results-wrapper {
        color: #eeeef8;
        background: #181d33;
    }

    [data-bs-theme="dark"] .thesis-filter-body {
        color: #eeeef8;
        background: #181d33;
    }

    [data-bs-theme="dark"] .admin-thesis-card,
    [data-bs-theme="dark"] .admin-thesis-empty {
        color: #eeeef8;

        background: #181d33;

        border-color: #292e45;
    }

    [data-bs-theme="dark"] .admin-thesis-card-body {
        background: #181d33;
    }

    [data-bs-theme="dark"] .admin-thesis-card-footer {
        background: #20253a;

        border-top-color: #292e45;
    }

    [data-bs-theme="dark"] .admin-thesis-published {
        background: #20253a;
    }

    [data-bs-theme="dark"] .admin-thesis-detail-icon,
    [data-bs-theme="dark"] .admin-thesis-published-icon {
        color: #d5d8e8;

        background: #181d33;
    }

    [data-bs-theme="dark"] .admin-thesis-card-title,
    [data-bs-theme="dark"] .admin-thesis-published-value,
    [data-bs-theme="dark"] .admin-thesis-detail-value,
    [data-bs-theme="dark"] .admin-thesis-submitted-value,
    [data-bs-theme="dark"] .thesis-title {
        color: #eeeef8;
    }

    [data-bs-theme="dark"] .admin-thesis-published-label,
    [data-bs-theme="dark"] .admin-thesis-detail-label,
    [data-bs-theme="dark"] .admin-thesis-submitted-label,
    [data-bs-theme="dark"] .thesis-overline,
    [data-bs-theme="dark"] .thesis-input-label {
        color: #999fb9;
    }

    [data-bs-theme="dark"] .admin-thesis-submitted {
        border-top-color: #292e45;
    }

    [data-bs-theme="dark"] .thesis-search input,
    [data-bs-theme="dark"] .thesis-filter-select,
    [data-bs-theme="dark"] .thesis-mobile-search-input input {
        color: #eeeef8;

        background: #20253a;

        border-color: #292e45;
    }

    [data-bs-theme="dark"] .thesis-search input::placeholder,
    [data-bs-theme="dark"] .thesis-mobile-search-input input::placeholder {
        color: #999fb9;
    }

    [data-bs-theme="dark"] .thesis-search i,
    [data-bs-theme="dark"] .thesis-mobile-search-input i {
        color: #999fb9;
    }

    [data-bs-theme="dark"] .thesis-mobile-search-panel {
        color: #eeeef8;

        background: #181d33;

        border-color: #292e45;
    }

    [data-bs-theme="dark"] .thesis-mobile-search-button,
    [data-bs-theme="dark"] .thesis-mobile-reset-button {
        color: #eeeef8;

        background: #181d33;

        border-color: #292e45;
    }

    [data-bs-theme="dark"] .thesis-reset-button {
        color: #eeeef8;

        background: #181d33;

        border-color: #292e45;
    }

    [data-bs-theme="dark"] .thesis-loading {
        color: #eeeef8;

        background: #181d33;

        border-color: #292e45;
    }

    [data-bs-theme="dark"] .admin-thesis-empty-icon {
        color: #000000;

        background: #ffffff;
    }
</style>

</x-app-layout>