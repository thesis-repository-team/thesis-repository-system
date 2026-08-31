
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
                            THESIS MANAGEMENT
                        </span>

                        <h1 class="thesis-title">
                            My Theses
                        </h1>

                        <p class="thesis-description">
                            Manage the theses uploaded to your department repository.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            MOBILE SEARCH
        ========================================================== --}}

        <div
            id="mobileThesisSearchPanel"
            class="thesis-mobile-search-panel">

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
                    class="thesis-mobile-reset-button">

                    <i class="bi bi-arrow-counterclockwise"></i>

                </button>

            </div>

        </div>


        {{-- =========================================================
            THESIS CARDS
        ========================================================== --}}

        <div
            id="hodThesisCards"
            class="row g-4">

            @forelse($theses as $thesis)

                <div class="col-12 col-md-6 col-xl-4">

                    <div class="card thesis-card h-100">

                        {{-- =================================================
                            CARD HEADER
                        ================================================== --}}

                        <div class="card-header thesis-card-header">

                            <span class="thesis-badge thesis-badge-number">
                                #{{ $loop->iteration }}
                            </span>


                            @if ($thesis->published_at)

                                <span class="thesis-badge thesis-badge-published">

                                    <i class="bi bi-check-circle-fill me-1"></i>

                                    Published

                                </span>

                            @else

                                <span class="thesis-badge thesis-badge-unpublished">

                                    <i class="bi bi-clock-history me-1"></i>

                                    Not Published

                                </span>

                            @endif

                        </div>


                        {{-- =================================================
                            CARD BODY
                        ================================================== --}}

                        <div class="card-body thesis-card-body">


                            {{-- =================================================
                                TITLE
                            ================================================== --}}

                            <h5
                                class="thesis-card-title"
                                title="{{ $thesis->title }}">

                                {{ $thesis->title }}

                            </h5>


                            {{-- =================================================
                                AUTHOR + DEPARTMENT
                            ================================================== --}}

                            <div class="thesis-author-box">

                                <div class="thesis-author-icon">

                                    <i class="bi bi-person-fill"></i>

                                </div>


                                <div class="thesis-author-info">

                                    <div class="thesis-author-name text-truncate">

                                        {{ $thesis->author_name }}

                                    </div>


                                    <div class="thesis-department text-truncate">

                                        <i class="bi bi-building me-1"></i>

                                        {{ $thesis->department->name ?? 'N/A' }}

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                META INFORMATION
                            ================================================== --}}

                            <div class="thesis-meta">


                                {{-- SUBMITTED BY --}}

                                <div class="thesis-meta-row">

                                    <span class="thesis-meta-label">

                                        <i class="bi bi-person-up thesis-icon-blue me-1"></i>

                                        Submitted By

                                    </span>


                                    <span
                                        class="thesis-meta-value"
                                        title="{{ $thesis->submittedBy->name ?? 'N/A' }}">

                                        {{ $thesis->submittedBy->name ?? 'N/A' }}

                                    </span>

                                </div>


                                {{-- PUBLISHED BY --}}

                                <div class="thesis-meta-row">

                                    <span class="thesis-meta-label">

                                        <i class="bi bi-person-check-fill thesis-icon-green me-1"></i>

                                        Published By

                                    </span>


                                    <span
                                        class="thesis-meta-value"
                                        title="{{ $thesis->publishedBy?->name ?? '—' }}">

                                        {{ $thesis->publishedBy?->name ?? '—' }}

                                    </span>

                                </div>


                                {{-- PUBLISHED AT --}}

                                <div class="thesis-meta-row">

                                    <span class="thesis-meta-label">

                                        <i class="bi bi-calendar3 thesis-icon-orange me-1"></i>

                                        Published At

                                    </span>


                                    <span class="thesis-meta-value">

                                        {{ $thesis->published_at
                                            ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y')
                                            : '—'
                                        }}

                                    </span>

                                </div>

                            </div>


                            {{-- =================================================
                                ACTIONS
                            ================================================== --}}

                            <div class="thesis-attachments">


                                {{-- ACTION HEADER --}}

                                <div class="thesis-attachments-header">

                                    <span class="thesis-attachments-title">

                                        <i class="bi bi-gear-fill thesis-icon-red me-1"></i>

                                        Actions

                                    </span>

                                </div>


                                {{-- =================================================
                                    EDIT + DELETE
                                ================================================== --}}

                                <div class="thesis-file-buttons">


                                    {{-- EDIT --}}

                                    <a
                                        href="{{ route('hod.thesis.edit', $thesis) }}"
                                        class="thesis-btn thesis-btn-edit">

                                        <i class="bi bi-pencil-square"></i>

                                        <span>
                                            Edit
                                        </span>

                                    </a>


                                    {{-- DELETE --}}

                                    <form
                                        action="{{ route('hod.thesis.destroy', $thesis) }}"
                                        method="POST"
                                        class="thesis-delete-form"
                                        onsubmit="return confirm('Are you sure you want to delete this thesis?')">

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="thesis-btn thesis-btn-delete">

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

                <div class="col-12">

                    <div class="card thesis-empty-card">

                        <div class="card-body thesis-empty-body">

                            <div class="thesis-empty-icon">

                                <i class="bi bi-journal-x"></i>

                            </div>


                            <h5 class="thesis-empty-title">

                                No Thesis Found

                            </h5>


                            <p class="thesis-empty-text">

                                No theses have been uploaded to your
                                department repository yet.

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

        document.addEventListener('DOMContentLoaded', function () {


            /* =====================================================
               VARIABLES
            ===================================================== */

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
                    'hodThesisCards'
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


                .then(response => {


                    if (!response.ok) {

                        throw new Error(
                            'Network response failed'
                        );

                    }


                    return response.text();

                })


                .then(html => {


                    if (thesisCards) {

                        thesisCards.innerHTML =
                            html;

                    }

                })


                .catch(error => {


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


                .finally(() => {


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
            ===================================================== */

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
            ===================================================== */

            if (departmentFilter) {

                departmentFilter.addEventListener(
                    'change',
                    loadData
                );

            }



            /* =====================================================
               YEAR FILTER
            ===================================================== */

            if (yearFilter) {

                yearFilter.addEventListener(
                    'change',
                    loadData
                );

            }



            /* =====================================================
               RESET FILTERS
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
            ===================================================== */

            document.addEventListener(
                'keydown',
                function (event) {


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

                        }

                    }

                }
            );



            /* =====================================================
               RESIZE
            ===================================================== */

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

                        }

                    }

                }
            );

        });

    </script>



    <style>

        /* =========================================================
           ROOT VARIABLES
        ========================================================== */

        :root {

            --thesis-black: #000000;

            --thesis-white: #ffffff;

            --thesis-bg: #ffffff;

            --thesis-surface: #f7f7f7;

            --thesis-surface-hover: #eeeeee;

            --thesis-border: #d6d6d6;

            --thesis-border-strong: #b5b5b5;

            --thesis-text: #111111;

            --thesis-muted: #666666;


            --color-blue: #0d6efd;

            --color-blue-dark: #0a58ca;

            --color-green: #198754;

            --color-green-dark: #146c43;

            --color-red: #dc3545;

            --color-red-dark: #bb2d3b;

            --color-orange: #fd7e14;

            --color-gray: #6c757d;


            --thesis-shadow:
                0 4px 16px rgba(0, 0, 0, .06);

        }



        /* =========================================================
           PAGE HEADER
        ========================================================== */

        .thesis-page-header {

            padding: 15px;

            background: #fff;

            border-radius: 12px;

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            box-sizing: border-box;

            margin-bottom: 20px;

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

            margin-bottom: .25rem;

            color: var(--thesis-muted);

            font-size: .95rem;

            font-weight: 800;

            letter-spacing: .12em;

            text-transform: uppercase;

        }


        .thesis-title {

            margin: 0;

            color: var(--thesis-text);

            font-size: 1.8rem;

            font-weight: 700;

            letter-spacing: -.035em;

            line-height: 1.3;

        }


        .thesis-description {

            margin: .35rem 0 0;

            color: var(--thesis-muted);

            font-size: .8rem;

        }



        /* =========================================================
           THESIS CARD
        ========================================================== */

        .thesis-card {

            --card-bg: #ffffff;

            --card-surface: #f7f7f7;

            --card-border: #d6d6d6;

            --card-border-strong: #b5b5b5;

            --card-text: #111111;

            --card-muted: #666666;


            width: 100%;

            height: 100%;

            background: var(--card-bg);

            color: var(--card-text);

            border: 1px solid var(--card-border);

            border-radius: 18px;

            box-shadow:
                0 4px 16px rgba(0, 0, 0, .06);

            overflow: hidden;


            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;

        }


        .thesis-card:hover {

            border-color:
                var(--card-border-strong);

            box-shadow:
                0 8px 24px rgba(0, 0, 0, .10);

            transform:
                translateY(-2px);

        }



        /* =========================================================
           CARD HEADER
        ========================================================== */

        .thesis-card-header {

            background: transparent;

            border: 0;

            padding: 20px 20px 0;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

        }



        /* =========================================================
           BADGES
        ========================================================== */

        .thesis-badge {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 32px;

            padding: 6px 12px;

            border-radius: 999px;

            font-size: .78rem;

            font-weight: 600;

            line-height: 1;

            white-space: nowrap;

        }


        .thesis-badge-number {

            background:
                var(--card-surface);

            color:
                var(--card-text);

            border:
                1px solid var(--card-border);

        }


        .thesis-badge-published {

            background:
                rgba(25, 135, 84, .12);

            color:
                var(--color-green);

            border:
                1px solid rgba(25, 135, 84, .30);

        }


        .thesis-badge-unpublished {

            background:
                rgba(108, 117, 125, .12);

            color:
                var(--color-gray);

            border:
                1px solid rgba(108, 117, 125, .30);

        }



        /* =========================================================
           CARD BODY
        ========================================================== */

        .thesis-card-body {

            padding: 20px;

            display: flex;

            flex-direction: column;

            min-width: 0;

            height:
                calc(100% - 52px);

            box-sizing: border-box;

        }



        /* =========================================================
           TITLE
        ========================================================== */

        .thesis-card-title {

            margin:
                0 0 18px;

            color:
                var(--card-text);

            font-size:
                1.05rem;

            font-weight:
                700;

            line-height:
                1.45;


            display:
                -webkit-box;

            -webkit-box-orient:
                vertical;

            -webkit-line-clamp:
                2;

            overflow:
                hidden;


            min-height:
                calc(
                    1.05rem * 1.45 * 2
                );

        }



        /* =========================================================
           AUTHOR
        ========================================================== */

        .thesis-author-box {

            display: flex;

            align-items: center;

            padding: 12px;

            margin-bottom: 18px;

            background:
                var(--card-surface);

            border:
                1px solid var(--card-border);

            border-radius:
                12px;

            min-width: 0;

        }


        .thesis-author-icon {

            width: 42px;

            height: 42px;

            flex:
                0 0 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background:
                rgba(13, 110, 253, .12);

            color:
                var(--color-blue);

            border:
                1px solid rgba(13, 110, 253, .25);

            font-size:
                1.05rem;

        }


        .thesis-author-info {

            min-width: 0;

            margin-left: 12px;

        }


        .thesis-author-name {

            color:
                var(--card-text);

            font-weight:
                600;

            font-size:
                .92rem;

        }


        .thesis-department {

            color:
                var(--card-muted);

            font-size:
                .78rem;

            margin-top:
                2px;

        }



        /* =========================================================
           META INFORMATION
        ========================================================== */

        .thesis-meta {

            display: flex;

            flex-direction: column;

            gap: 10px;

            margin-bottom: 18px;

        }


        .thesis-meta-row {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 12px;

            color:
                var(--card-muted);

            font-size:
                .80rem;

            line-height:
                1.4;

        }


        .thesis-meta-label {

            display: inline-flex;

            align-items: center;

            min-width: 0;

        }


        .thesis-meta-value {

            color:
                var(--card-text);

            font-weight:
                600;

            text-align:
                right;

            max-width:
                55%;

            overflow:
                hidden;

            text-overflow:
                ellipsis;

            white-space:
                nowrap;

        }



        /* =========================================================
           ICON COLORS
        ========================================================== */

        .thesis-icon-blue {

            color:
                var(--color-blue);

        }


        .thesis-icon-green {

            color:
                var(--color-green);

        }


        .thesis-icon-orange {

            color:
                var(--color-orange);

        }


        .thesis-icon-red {

            color:
                var(--color-red);

        }



        /* =========================================================
           ACTIONS
        ========================================================== */

        .thesis-attachments {

            margin-top:
                auto;

            padding-top:
                16px;

            border-top:
                1px solid var(--card-border);

        }


        .thesis-attachments-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

            margin-bottom:
                10px;

        }


        .thesis-attachments-title {

            color:
                var(--card-text);

            font-size:
                .82rem;

            font-weight:
                600;

        }


        .thesis-file-buttons {

            width:
                100%;

            display:
                flex;

            gap:
                8px;

        }



        /* =========================================================
           BUTTON BASE
        ========================================================== */

        .thesis-btn {

            flex:
                1;

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                6px;

            min-height:
                36px;

            padding:
                8px 12px;

            border-radius:
                6px;

            text-decoration:
                none;

            font-size:
                .78rem;

            font-weight:
                600;

            cursor:
                pointer;


            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease;

        }



        /* =========================================================
           EDIT BUTTON
        ========================================================== */

        .thesis-btn-edit {

            background:
                #000;

            color:
                #fff;

            border:
                1px solid #000;

        }


        .thesis-btn-edit:hover {

            background:
                #333;

            color:
                #fff;

            border-color:
                #333;

            transform:
                translateY(-1px);

        }



        /* =========================================================
           DELETE BUTTON
        ========================================================== */

        .thesis-btn-delete {

            background:
                #fff;

            color:
                #000;

            border:
                1px solid #000;

        }


        .thesis-btn-delete:hover {

            background:
                #000;

            color:
                #fff;

            border-color:
                #000;

            transform:
                translateY(-1px);

        }



        /* =========================================================
           DELETE FORM
        ========================================================== */

        .thesis-delete-form {

            flex:
                1;

            margin:
                0;

            padding:
                0;

            display:
                flex;

        }


        .thesis-delete-form .thesis-btn {

            width:
                100%;

        }



        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .thesis-empty-card {

            background:
                #fff;

            border:
                1px solid #d6d6d6;

            border-radius:
                18px;

            box-shadow:
                0 4px 16px rgba(0, 0, 0, .06);

        }


        .thesis-empty-body {

            padding:
                55px 20px;

            text-align:
                center;

        }


        .thesis-empty-icon {

            margin-bottom:
                15px;

            color:
                #777;

            font-size:
                3.5rem;

            line-height:
                1;

        }


        .thesis-empty-title {

            margin-bottom:
                5px;

            color:
                #111;

            font-weight:
                700;

        }


        .thesis-empty-text {

            margin:
                0;

            color:
                #777;

            font-size:
                .82rem;

        }



        /* =========================================================
           LOADING
        ========================================================== */

        #hodThesisCards.is-loading {

            opacity:
                .45;

            pointer-events:
                none;

            transition:
                opacity .2s ease;

        }



        /* =========================================================
           MOBILE SEARCH PANEL
        ========================================================== */

        .thesis-mobile-search-panel {

            display:
                none;

            margin:
                0 15px 1rem;

            overflow:
                hidden;

            background:
                #fff;

            border:
                1px solid #ddd;

            border-radius:
                8px;

            opacity:
                0;

            transform:
                translateY(-6px);

            transition:
                .2s ease;

        }


        .thesis-mobile-search-panel.is-open {

            opacity:
                1;

            transform:
                translateY(0);

        }


        .thesis-mobile-search-content {

            display:
                flex;

            align-items:
                center;

            gap:
                .5rem;

            padding:
                .65rem;

        }


        .thesis-mobile-search-input {

            position:
                relative;

            flex:
                1;

        }


        .thesis-mobile-search-input i {

            position:
                absolute;

            left:
                .85rem;

            top:
                50%;

            transform:
                translateY(-50%);

            color:
                #777;

            pointer-events:
                none;

        }


        .thesis-mobile-search-input input {

            width:
                100%;

            height:
                44px;

            padding:
                .5rem .75rem .5rem 2.5rem;

            color:
                #000;

            background:
                #fafafa;

            border:
                1px solid #ddd;

            border-radius:
                8px;

            outline:
                none;

            font-size:
                .8rem;

            box-sizing:
                border-box;

        }


        .thesis-mobile-reset-button {

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            width:
                44px;

            height:
                44px;

            flex-shrink:
                0;

            color:
                #000;

            background:
                #fff;

            border:
                1px solid #ddd;

            border-radius:
                8px;

            cursor:
                pointer;

        }



        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1199.98px) {

            .thesis-card-body {

                padding:
                    18px;

            }


            .thesis-card-header {

                padding:
                    18px 18px 0;

            }

        }



        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .thesis-page-header {

                padding:
                    1rem;

            }


            .thesis-title {

                font-size:
                    1.25rem;

            }


            .thesis-overline {

                font-size:
                    .8rem;

            }


            .thesis-description {

                font-size:
                    .75rem;

            }


            .thesis-mobile-search-panel {

                display:
                    block;

            }


            .thesis-card {

                border-radius:
                    14px;

            }


            .thesis-card-header {

                padding:
                    16px 16px 0;

            }


            .thesis-card-body {

                padding:
                    16px;

            }

        }



        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .thesis-page-header {

                padding:
                    .85rem;

            }


            .thesis-title {

                font-size:
                    1.05rem;

            }


            .thesis-overline {

                font-size:
                    .75rem;

            }


            .thesis-description {

                font-size:
                    .7rem;

            }


            .thesis-card-title {

                font-size:
                    .98rem;

                margin-bottom:
                    15px;

            }


            .thesis-author-box {

                padding:
                    10px;

                margin-bottom:
                    15px;

            }


            .thesis-author-icon {

                width:
                    38px;

                height:
                    38px;

                flex-basis:
                    38px;

            }


            .thesis-author-info {

                margin-left:
                    10px;

            }


            .thesis-meta-row {

                font-size:
                    .75rem;

            }


            .thesis-meta-value {

                max-width:
                    48%;

            }


            .thesis-btn {

                min-height:
                    34px;

                font-size:
                    .74rem;

            }

        }



        /* =========================================================
           VERY SMALL MOBILE
        ========================================================== */

        @media (max-width: 380px) {

            .thesis-badge {

                padding:
                    5px 8px;

                font-size:
                    .68rem;

            }


            .thesis-meta-row {

                align-items:
                    flex-start;

            }


            .thesis-meta-value {

                max-width:
                    45%;

            }


            .thesis-btn span {

                display:
                    none;

            }


            .thesis-btn {

                font-size:
                    .95rem;

            }

        }

    </style>

</x-app-layout>

