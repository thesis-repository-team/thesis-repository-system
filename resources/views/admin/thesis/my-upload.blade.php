<x-app-layout>

    <div class="dashboard-content">

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
                            My Upload
                        </h1>

                    </div>

                </div>

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
                    title="Reset filters">

                    <i class="bi bi-arrow-counterclockwise"></i>

                </button>

            </div>

        </div>


        {{-- =========================================================
            THESIS CARDS
            4 CARDS PER ROW ON LARGE DESKTOP
        ========================================================== --}}

        <div id="adminThesisCards" class="thesis-upload-grid">

            @forelse($theses as $thesis)
                <div class="thesis-upload-item">

                    <div class="card thesis-card h-100">

                        {{-- =================================================
                            CARD HEADER
                        ================================================== --}}

                        <div class="card-header thesis-card-header">

                            <div class="thesis-heading">

                                {{-- TITLE --}}

                                <h5 class="thesis-card-title" title="{{ $thesis->title }}">
                                    {{ $thesis->title }}
                                </h5>


                                {{-- DEPARTMENT --}}

                                <div class="thesis-department" title="{{ $thesis->department->name ?? 'N/A' }}">
                                    {{ $thesis->department->name ?? 'N/A' }}
                                </div>

                            </div>


                            {{-- STATUS --}}

                            @if ($thesis->published_at)
                                <span class="thesis-badge thesis-badge-published">
                                    Published
                                </span>
                            @else
                                <span class="thesis-badge thesis-badge-unpublished">
                                    Not Published
                                </span>
                            @endif

                        </div>


                        {{-- =================================================
                            CARD BODY
                        ================================================== --}}

                        <div class="card-body thesis-card-body">


                            {{-- =================================================
                                META INFORMATION
                            ================================================== --}}

                            <div class="thesis-meta">

                                {{-- AUTHOR --}}

                                <div class="thesis-meta-row">

                                    <span class="thesis-meta-label">

                                        <i class="bi bi-person-fill thesis-icon-blue"></i>

                                        <span>
                                            Author
                                        </span>

                                    </span>

                                    <span class="thesis-meta-value" title="{{ $thesis->author_name }}">
                                        {{ $thesis->author_name }}
                                    </span>

                                </div>


                                {{-- SUBMITTED BY --}}

                                <div class="thesis-meta-row">

                                    <span class="thesis-meta-label">

                                        <i class="bi bi-person-up thesis-icon-blue"></i>

                                        <span>
                                            Submitted By
                                        </span>

                                    </span>

                                    <span class="thesis-meta-value" title="{{ $thesis->submittedBy->name ?? 'N/A' }}">
                                        {{ $thesis->submittedBy->name ?? 'N/A' }}
                                    </span>

                                </div>


                                {{-- PUBLISHED BY --}}

                                <div class="thesis-meta-row">

                                    <span class="thesis-meta-label">

                                        <i class="bi bi-person-check-fill thesis-icon-green"></i>

                                        <span>
                                            Published By
                                        </span>

                                    </span>

                                    <span class="thesis-meta-value" title="{{ $thesis->publishedBy?->name ?? '—' }}">
                                        {{ $thesis->publishedBy?->name ?? '—' }}
                                    </span>

                                </div>


                                {{-- PUBLISHED AT --}}

                                <div class="thesis-meta-row">

                                    <span class="thesis-meta-label">

                                        <i class="bi bi-calendar3 thesis-icon-orange"></i>

                                        <span>
                                            Published At
                                        </span>

                                    </span>

                                    <span class="thesis-meta-value">

                                        {{ $thesis->published_at ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y') : '—' }}

                                    </span>

                                </div>

                            </div>


                            {{-- =================================================
                                EDIT + DELETE
                            ================================================== --}}

                            <div class="thesis-attachments">

                                <div class="thesis-file-buttons">

                                    {{-- EDIT --}}

                                    <a href="{{ route('admin.thesis.edit', $thesis) }}"
                                        class="thesis-btn thesis-btn-edit">

                                        <i class="bi bi-pencil-square"></i>

                                        <span>
                                            Edit
                                        </span>

                                    </a>


                                    {{-- DELETE --}}

                                    <form action="{{ route('admin.thesis.destroy', $thesis) }}" method="POST"
                                        class="thesis-delete-form"
                                        onsubmit="return confirm('Are you sure you want to delete this thesis?')">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" class="thesis-btn thesis-btn-delete">

                                            <i class="bi bi-trash"></i>

                                            <span>
                                                Delete
                                            </span>

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


            @empty

                {{-- =================================================
                    EMPTY STATE
                ================================================== --}}

                <div class="thesis-upload-empty">

                    <div class="card thesis-empty-card">

                        <div class="card-body thesis-empty-body">

                            <div class="thesis-empty-icon">

                                <i class="bi bi-journal-x"></i>

                            </div>

                            <h5 class="thesis-empty-title">
                                No Thesis Found
                            </h5>

                            <p class="thesis-empty-text">
                                No theses match your current search
                                or filter criteria.
                            </p>

                        </div>

                    </div>

                </div>
            @endforelse

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


            const thesisCards =
                document.getElementById(
                    'adminThesisCards'
                );


            /* =====================================================
               LOAD DATA
            ===================================================== */

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


                if (thesisCards) {

                    thesisCards.classList.add(
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
                        "{{ route('admin.thesis.search') }}?" +
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

                        if (thesisCards) {

                            thesisCards.innerHTML =
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


                        if (thesisCards) {

                            thesisCards.classList.remove(
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
               RESET
            ===================================================== */

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


                            setTimeout(
                                function() {

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
               ESCAPE
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
                            .remove(
                                'is-open'
                            );


                        if (mobileSearchToggle) {

                            mobileSearchToggle
                                .setAttribute(
                                    'aria-expanded',
                                    'false'
                                );

                        }

                    }

                }
            );


            /* =====================================================
               RESIZE
            ===================================================== */

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

                        }

                    }

                }
            );

        });
    </script>


    <style>
        /* =========================================================
       VARIABLES
    ========================================================== */

        :root {

            --thesis-bg: #ffffff;

            --thesis-surface: #f7f7f7;

            --thesis-surface-hover: #eeeeee;

            --thesis-border: #dddddd;

            --thesis-border-strong: #c4c4c4;

            --thesis-text: #111111;

            --thesis-muted: #6b6b6b;

            --thesis-placeholder: #999999;

            --thesis-blue: #0d6efd;

            --thesis-blue-hover: #0a58ca;

            --thesis-green: #198754;

            --thesis-orange: #fd7e14;

            --thesis-red: #dc3545;

            --thesis-red-hover: #bb2d3b;

            --thesis-shadow:
                0 4px 18px rgba(0, 0, 0, .055);

            --thesis-shadow-hover:
                0 10px 28px rgba(0, 0, 0, .10);

        }


        /* =========================================================
       DARK MODE
    ========================================================== */

        [data-bs-theme="dark"] {

            --thesis-bg: #181d33;

            --thesis-surface: #20253a;

            --thesis-surface-hover: #252b42;

            --thesis-border: #292e45;

            --thesis-border-strong: #343a52;

            --thesis-text: #ffffff;

            --thesis-muted: #999fb9;

            --thesis-placeholder: #777f9c;

            --thesis-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

            --thesis-shadow-hover:
                0 10px 30px rgba(0, 0, 0, .45);

        }


        /* =========================================================
       PAGE
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
       PAGE HEADER
    ========================================================== */

        .thesis-page-header {

            margin-bottom: 22px;

            padding: 18px 20px;

            background:
                var(--thesis-bg);

            border:
                1px solid var(--thesis-border);

            border-radius: 14px;

            box-sizing: border-box;

            transition:
                background-color .2s ease,
                border-color .2s ease;

        }


        [data-bs-theme="dark"] .thesis-page-header {

            background: #171b30;

            border-color: #292e45;

        }


        .thesis-header-content {

            width: 100%;

            min-width: 0;

        }


        .thesis-title-row {

            display: flex;

            align-items: center;

        }


        .thesis-overline {

            display: block;

            margin-bottom: 5px;

            color:
                var(--thesis-muted);

            font-size: .72rem;

            font-weight: 800;

            letter-spacing: .14em;

            line-height: 1.2;

            text-transform: uppercase;

        }


        [data-bs-theme="dark"] .thesis-overline {

            color: #999fb9;

        }


        .thesis-title {

            margin: 0;

            color:
                var(--thesis-text);

            font-size: 1.7rem;

            font-weight: 700;

            letter-spacing: -.035em;

            line-height: 1.25;

        }


        [data-bs-theme="dark"] .thesis-title {

            color: #ffffff;

        }


        /* =========================================================
       MY UPLOAD GRID
       4 CARDS PER ROW
    ========================================================== */

        .thesis-upload-grid {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 1.25rem;

            width: 100%;

            margin: 0;

            box-sizing: border-box;

        }


        /* =========================================================
       GRID ITEM
    ========================================================== */

        .thesis-upload-item {

            width: 100%;

            min-width: 0;

        }


        .thesis-upload-item .thesis-card {

            width: 100%;

            height: 100%;

        }


        /* =========================================================
       THESIS CARD
    ========================================================== */

        .thesis-card {

            width: 100%;

            height: 100%;

            background:
                var(--thesis-bg);

            color:
                var(--thesis-text);

            border:
                1px solid var(--thesis-border);

            border-radius: 16px;

            box-shadow:
                var(--thesis-shadow);

            overflow: hidden;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;

        }


        [data-bs-theme="dark"] .thesis-card {

            background: #181d33;

            color: #eeeef8;

            border-color: #292e45;

            box-shadow:
                0 2px 10px rgba(0, 0, 0, .30);

        }


        .thesis-card:hover {

            border-color:
                var(--thesis-border-strong);

            box-shadow:
                var(--thesis-shadow-hover);

            transform:
                translateY(-3px);

        }


        [data-bs-theme="dark"] .thesis-card:hover {

            background: #1b2038;

            border-color: #343a52;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

        }


        /* =========================================================
       CARD HEADER
    ========================================================== */

        .thesis-card-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 16px;

            padding: 20px 20px 16px;

            background: transparent;

            border: 0;

        }


        .thesis-heading {

            flex: 1;

            min-width: 0;

        }


        /* =========================================================
       CARD TITLE
    ========================================================== */

        .thesis-card-title {

            margin: 0;

            color:
                var(--thesis-text);

            font-size: 1rem;

            font-weight: 700;

            line-height: 1.45;

            display: -webkit-box;

            -webkit-box-orient: vertical;

            -webkit-line-clamp: 2;

            overflow: hidden;

        }


        [data-bs-theme="dark"] .thesis-card-title {

            color: #ffffff;

        }


        /* =========================================================
       DEPARTMENT
    ========================================================== */

        .thesis-department {

            margin-top: 6px;

            color:
                var(--thesis-muted);

            font-size: .74rem;

            font-weight: 500;

            line-height: 1.4;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        [data-bs-theme="dark"] .thesis-department {

            color: #999fb9;

        }


        /* =========================================================
       STATUS BADGES
    ========================================================== */

        .thesis-badge {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            flex: 0 0 auto;

            min-height: 30px;

            padding: 6px 11px;

            border-radius: 999px;

            font-size: .72rem;

            font-weight: 700;

            line-height: 1;

            white-space: nowrap;

        }


        .thesis-badge-published {

            color: #15803d;

            background: #f0fdf4;

            border: 1px solid #22c55e;

            box-shadow:
                inset 0 0 0 1px rgba(34, 197, 94, .05);

        }


        .thesis-badge-unpublished {

            color: #dc2626;

            background: #fef2f2;

            border: 1px solid #ef4444;

            box-shadow:
                inset 0 0 0 1px rgba(239, 68, 68, .05);

        }


        /* =========================================================
       CARD BODY
    ========================================================== */

        .thesis-card-body {

            display: flex;

            flex-direction: column;

            min-width: 0;

            height: calc(100% - 48px);

            padding: 14px 20px 20px;

            box-sizing: border-box;

        }


        /* =========================================================
       META
    ========================================================== */

        .thesis-meta {

            display: flex;

            flex-direction: column;

            gap: 13px;

            margin-bottom: 22px;

            padding-top: 0;

        }


        .thesis-meta-row {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 14px;

            min-width: 0;

            color:
                var(--thesis-muted);

            font-size: .76rem;

            line-height: 1.4;

        }


        .thesis-meta-label {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            min-width: 0;

            color:
                var(--thesis-muted);

            white-space: nowrap;

        }


        .thesis-meta-value {

            max-width: 55%;

            overflow: hidden;

            color:
                var(--thesis-text);

            font-weight: 600;

            text-align: right;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        [data-bs-theme="dark"] .thesis-meta-row {

            color: #999fb9;

        }


        [data-bs-theme="dark"] .thesis-meta-label {

            color: #999fb9;

        }


        [data-bs-theme="dark"] .thesis-meta-value {

            color: #d5d8e8;

        }


        /* =========================================================
       ICONS
    ========================================================== */

        .thesis-icon-blue {

            color: #0d6efd;

        }


        .thesis-icon-green {

            color: #198754;

        }


        .thesis-icon-orange {

            color: #fd7e14;

        }


        .thesis-icon-red {

            color: #dc3545;

        }


        [data-bs-theme="dark"] .thesis-icon-blue,
        [data-bs-theme="dark"] .thesis-icon-green,
        [data-bs-theme="dark"] .thesis-icon-orange,
        [data-bs-theme="dark"] .thesis-icon-red {

            color: #ffffff;

        }


        /* =========================================================
       EDIT + DELETE AREA
    ========================================================== */

        .thesis-attachments {

            margin-top: auto;

            padding-top: 4px;

        }


        .thesis-file-buttons {

            display: flex;

            width: 100%;

            gap: 10px;

        }


        /* =========================================================
       BUTTON BASE
    ========================================================== */

        .thesis-btn {

            flex: 1;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            min-height: 38px;

            padding: 9px 13px;

            border-radius: 8px;

            font-size: .76rem;

            font-weight: 700;

            line-height: 1;

            text-decoration: none;

            cursor: pointer;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;

        }


        .thesis-btn:focus-visible {

            outline:
                2px solid var(--thesis-blue);

            outline-offset: 2px;

        }


        /* =========================================================
       BUTTON ICONS
    ========================================================== */

        .thesis-btn-edit i,
        .thesis-btn-delete i {

            color: #ffffff !important;

        }


        /* =========================================================
       EDIT
    ========================================================== */

        .thesis-btn-edit {

            background: #0d6efd;

            color: #ffffff;

            border:
                1px solid #0d6efd;

        }


        .thesis-btn-edit:hover {

            background: #0a58ca;

            color: #ffffff;

            border-color: #0a58ca;

            transform:
                translateY(-1px);

            box-shadow:
                0 4px 10px rgba(13, 110, 253, .20);

        }


        /* =========================================================
       DELETE
    ========================================================== */

        .thesis-btn-delete {

            background: #dc3545;

            color: #ffffff;

            border:
                1px solid #dc3545;

        }


        .thesis-btn-delete:hover {

            background: #bb2d3b;

            color: #ffffff;

            border-color: #bb2d3b;

            transform:
                translateY(-1px);

            box-shadow:
                0 4px 10px rgba(220, 53, 69, .20);

        }


        .thesis-delete-form {

            flex: 1;

            display: flex;

            margin: 0;

            padding: 0;

        }


        .thesis-delete-form .thesis-btn {

            width: 100%;

        }


        /* =========================================================
       EMPTY STATE
    ========================================================== */

        .thesis-upload-empty {

            grid-column:
                1 / -1;

            width: 100%;

        }


        .thesis-empty-card {

            background:
                var(--thesis-bg);

            color:
                var(--thesis-text);

            border:
                1px solid var(--thesis-border);

            border-radius: 16px;

            box-shadow:
                var(--thesis-shadow);

        }


        [data-bs-theme="dark"] .thesis-empty-card {

            background: #181d33;

            color: #ffffff;

            border-color: #292e45;

        }


        .thesis-empty-body {

            padding: 65px 20px;

            text-align: center;

        }


        .thesis-empty-icon {

            margin-bottom: 16px;

            color:
                var(--thesis-text);

            font-size: 3.2rem;

            line-height: 1;

        }


        [data-bs-theme="dark"] .thesis-empty-icon {

            color: #ffffff;

        }


        .thesis-empty-title {

            margin-bottom: 7px;

            color:
                var(--thesis-text);

            font-size: 1rem;

            font-weight: 700;

        }


        [data-bs-theme="dark"] .thesis-empty-title {

            color: #ffffff;

        }


        .thesis-empty-text {

            max-width: 420px;

            margin: 0 auto;

            color:
                var(--thesis-muted);

            font-size: .8rem;

            line-height: 1.6;

        }


        [data-bs-theme="dark"] .thesis-empty-text {

            color: #999fb9;

        }


        /* =========================================================
       MOBILE SEARCH PANEL
    ========================================================== */

        .thesis-mobile-search-panel {

            display: none;

            margin: 0 0 18px;

            background:
                var(--thesis-bg);

            border:
                1px solid var(--thesis-border);

            border-radius: 12px;

            box-shadow:
                var(--thesis-shadow);

            overflow: hidden;

            opacity: 0;

            transform:
                translateY(-5px);

            transition:
                opacity .2s ease,
                transform .2s ease;

        }


        [data-bs-theme="dark"] .thesis-mobile-search-panel {

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

            gap: 8px;

            padding: 9px;

        }


        .thesis-mobile-search-input {

            position: relative;

            flex: 1;

            min-width: 0;

        }


        .thesis-mobile-search-input i {

            position: absolute;

            top: 50%;

            left: 13px;

            color: #111111;

            transform:
                translateY(-50%);

            pointer-events: none;

        }


        [data-bs-theme="dark"] .thesis-mobile-search-input i {

            color: #999fb9;

        }


        .thesis-mobile-search-input input {

            width: 100%;

            height: 42px;

            padding:
                8px 12px 8px 38px;

            color:
                var(--thesis-text);

            background:
                var(--thesis-surface);

            border:
                1px solid var(--thesis-border);

            border-radius: 8px;

            outline: none;

            font-size: .78rem;

            box-sizing: border-box;

            transition:
                border-color .2s ease,
                background-color .2s ease;

        }


        [data-bs-theme="dark"] .thesis-mobile-search-input input {

            color: #ffffff;

            background: #20253a;

            border-color: #343a52;

        }


        .thesis-mobile-search-input input::placeholder {

            color:
                var(--thesis-placeholder);

        }


        [data-bs-theme="dark"] .thesis-mobile-search-input input::placeholder {

            color: #777f9c;

        }


        .thesis-mobile-search-input input:focus {

            background:
                var(--thesis-bg);

            border-color:
                var(--thesis-blue);

        }


        [data-bs-theme="dark"] .thesis-mobile-search-input input:focus {

            background: #20253a;

            border-color: #ffffff;

            box-shadow:
                0 0 0 3px rgba(255, 255, 255, .10);

        }


        /* =========================================================
       MOBILE RESET
    ========================================================== */

        .thesis-mobile-reset-button {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 42px;

            height: 42px;

            flex: 0 0 42px;

            padding: 0;

            color:
                var(--thesis-text);

            background:
                var(--thesis-bg);

            border:
                1px solid var(--thesis-border);

            border-radius: 8px;

            cursor: pointer;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease;

        }


        [data-bs-theme="dark"] .thesis-mobile-reset-button {

            color: #ffffff;

            background: #20253a;

            border-color: #343a52;

        }


        .thesis-mobile-reset-button:hover {

            background:
                var(--thesis-surface);

            border-color:
                var(--thesis-border-strong);

        }


        [data-bs-theme="dark"] .thesis-mobile-reset-button:hover {

            color: #000000;

            background: #ffffff;

            border-color: #ffffff;

        }


        /* =========================================================
       LOADING
    ========================================================== */

        #adminThesisCards.is-loading {

            opacity: .45;

            pointer-events: none;

            transition:
                opacity .2s ease;

        }


        /* =========================================================
       LARGE DESKTOP
       4 CARDS
    ========================================================== */

        @media (min-width: 1400px) {

            .thesis-upload-grid {

                grid-template-columns:
                    repeat(4, minmax(0, 1fr));

            }

        }


        /* =========================================================
       SMALL DESKTOP
       3 CARDS
    ========================================================== */

        @media (max-width: 1399.98px) {

            .thesis-upload-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

            }

        }


        /* =========================================================
       TABLET
       2 CARDS
    ========================================================== */

        @media (max-width: 1199.98px) {

            .thesis-upload-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 1.15rem;

            }


            .thesis-card-header {

                padding:
                    18px 18px 15px;

            }


            .thesis-card-body {

                padding:
                    13px 18px 18px;

            }

        }


        /* =========================================================
       MOBILE
       1 CARD
    ========================================================== */

        @media (max-width: 767.98px) {

            .thesis-page-header {

                margin-bottom: 16px;

                padding: 15px;

                border-radius: 12px;

            }


            .thesis-title {

                font-size: 1.3rem;

            }


            .thesis-overline {

                font-size: .68rem;

            }


            .thesis-mobile-search-panel {

                display: block;

            }


            .thesis-upload-grid {

                grid-template-columns:
                    1fr;

                gap: 1rem;

            }


            .thesis-card {

                border-radius: 14px;

            }


            .thesis-card-header {

                padding:
                    17px 16px 14px;

                gap: 10px;

            }


            .thesis-card-body {

                padding:
                    12px 16px 16px;

            }


            .thesis-card-title {

                font-size: .94rem;

            }


            .thesis-department {

                margin-top: 5px;

                font-size: .72rem;

            }


            .thesis-meta {

                gap: 11px;

                margin-bottom: 19px;

            }

        }


        /* =========================================================
       SMALL MOBILE
    ========================================================== */

        @media (max-width: 575.98px) {

            .thesis-page-header {

                padding: 13px;

            }


            .thesis-title {

                font-size: 1.15rem;

            }


            .thesis-overline {

                font-size: .64rem;

            }


            .thesis-card-header {

                padding:
                    15px 14px 13px;

                gap: 8px;

            }


            .thesis-card-body {

                padding:
                    11px 14px 14px;

            }


            .thesis-card-title {

                font-size: .9rem;

            }


            .thesis-department {

                font-size: .7rem;

            }


            .thesis-badge {

                min-height: 28px;

                padding:
                    5px 8px;

                font-size: .65rem;

            }


            .thesis-meta {

                gap: 10px;

                margin-bottom: 17px;

            }


            .thesis-meta-row {

                font-size: .73rem;

            }


            .thesis-meta-value {

                max-width: 50%;

            }


            .thesis-file-buttons {

                gap: 8px;

            }


            .thesis-btn {

                min-height: 35px;

                font-size: .73rem;

            }


            .thesis-empty-body {

                padding:
                    50px 16px;

            }

        }


        /* =========================================================
       VERY SMALL MOBILE
    ========================================================== */

        @media (max-width: 380px) {

            .thesis-card-header {

                align-items: flex-start;

                gap: 7px;

            }


            .thesis-card-title {

                font-size: .86rem;

            }


            .thesis-department {

                font-size: .68rem;

            }


            .thesis-card-body {

                padding-top: 10px;

            }


            .thesis-badge {

                min-height: 28px;

                padding:
                    5px 7px;

                font-size: .62rem;

            }


            .thesis-meta-row {

                align-items: flex-start;

            }


            .thesis-meta-value {

                max-width: 46%;

            }


            .thesis-btn span {

                display: none;

            }


            .thesis-btn {

                font-size: .9rem;

            }

        }
    </style>

</x-app-layout>
