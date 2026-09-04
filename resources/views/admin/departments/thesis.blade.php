<x-app-layout>

    <div class="dashboard-content">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="department-thesis-header">

            <div class="department-thesis-header-content">

                {{-- BACK ICON --}}

                <a
                    href="{{ route('admin.departments.index') }}"
                    class="department-thesis-back"
                    title="Back to Departments"
                    aria-label="Back to Departments"
                >
                    <i class="bi bi-chevron-left"></i>
                </a>


                {{-- CENTERED TITLE --}}

                {{-- <div class="department-thesis-title-content">

                    <span class="department-thesis-overline">
                        THESIS REPOSITORY
                    </span>

                    <h1 class="department-thesis-title">
                        {{ $department->name }}
                    </h1>

                    <p class="department-thesis-subtitle">
                        Theses submitted under this department
                    </p>

                </div> --}}

            </div>

        </div>


        {{-- =========================================================
            THESIS LIST
        ========================================================== --}}

        @if ($theses->count())

            <div class="department-thesis-grid">

                @foreach ($theses as $thesis)

                    <div class="department-thesis-card admin-thesis-card">

                        {{-- =====================================================
                            CARD TOP
                        ====================================================== --}}

                        <div class="admin-thesis-card-top">

                            <div class="admin-thesis-card-heading">

                                <div class="admin-thesis-icon">
                                    <i class="bi bi-journal-text"></i>
                                </div>

                                <h3
                                    class="admin-thesis-card-title"
                                    title="{{ $thesis->title }}"
                                >
                                    {{ $thesis->title }}
                                </h3>

                            </div>

                        </div>


                        {{-- =====================================================
                            PUBLISHED INFORMATION
                        ====================================================== --}}

                        <div class="admin-thesis-published">

                            {{-- PUBLISHED BY --}}

                            <div class="admin-thesis-published-item">

                                <div class="admin-thesis-published-icon">
                                    <i class="bi bi-person-check"></i>
                                </div>

                                <div class="admin-thesis-published-content">

                                    <span class="admin-thesis-published-label">
                                        Published By
                                    </span>

                                    <span class="admin-thesis-published-value">
                                        {{ optional($thesis->publishedBy)->username
                                            ?? optional($thesis->publishedBy)->full_name
                                            ?? '—' }}
                                    </span>

                                </div>

                            </div>


                            {{-- PUBLISHED AT --}}

                            <div class="admin-thesis-published-item">

                                <div class="admin-thesis-published-icon">
                                    <i class="bi bi-calendar-check"></i>
                                </div>

                                <div class="admin-thesis-published-content">

                                    <span class="admin-thesis-published-label">
                                        Published At
                                    </span>

                                    <span class="admin-thesis-published-value">
                                        {{ $thesis->published_at
                                            ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y')
                                            : '—' }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- =====================================================
                            CARD BODY
                        ====================================================== --}}

                        <div class="admin-thesis-card-body">

                            {{-- AUTHOR --}}

                            <div class="admin-thesis-detail">

                                <div class="admin-thesis-detail-icon">
                                    <i class="bi bi-person"></i>
                                </div>

                                <div class="admin-thesis-detail-content">

                                    <span class="admin-thesis-detail-label">
                                        Author
                                    </span>

                                    <span class="admin-thesis-detail-value">
                                        {{ $thesis->author_name ?? '—' }}
                                    </span>

                                </div>

                            </div>


                            {{-- DEPARTMENT --}}

                            <div class="admin-thesis-detail">

                                <div class="admin-thesis-detail-icon">
                                    <i class="bi bi-building"></i>
                                </div>

                                <div class="admin-thesis-detail-content">

                                    <span class="admin-thesis-detail-label">
                                        Department
                                    </span>

                                    <span class="admin-thesis-detail-value">
                                        {{ optional($thesis->department)->name ?? '—' }}
                                    </span>

                                </div>

                            </div>


                            {{-- ACADEMIC YEAR --}}

                            <div class="admin-thesis-detail">

                                <div class="admin-thesis-detail-icon">
                                    <i class="bi bi-calendar3"></i>
                                </div>

                                <div class="admin-thesis-detail-content">

                                    <span class="admin-thesis-detail-label">
                                        Academic Year
                                    </span>

                                    <span class="admin-thesis-detail-value">
                                        {{ $thesis->academic_year ?? '—' }}
                                    </span>

                                </div>

                            </div>


                            {{-- SUBMITTED BY --}}

                            <div class="admin-thesis-submitted">

                                <span class="admin-thesis-submitted-label">
                                    Submitted By
                                </span>

                                <span class="admin-thesis-submitted-value">
                                    {{ optional($thesis->submittedBy)->username
                                        ?? optional($thesis->submittedBy)->full_name
                                        ?? '—' }}
                                </span>

                            </div>

                        </div>


                        {{-- =====================================================
                            FOOTER
                        ====================================================== --}}

                        <div class="admin-thesis-card-footer">

                            {{-- VIEW PDF --}}

                            <a
                                href="{{ route('admin.thesis.view-pdf', $thesis->id) }}"
                                target="_blank"
                                class="admin-thesis-action admin-thesis-view"
                            >
                                <i class="bi bi-file-earmark-pdf"></i>
                                View PDF
                            </a>


                            {{-- DOWNLOAD --}}

                            @if ($thesis->files && $thesis->files->count())

                                @php
                                    $file = $thesis->files->first();
                                @endphp

                                <a
                                    href="{{ route('admin.thesis.download', $file->id) }}"
                                    class="admin-thesis-action admin-thesis-download"
                                >
                                    <i class="bi bi-download"></i>
                                    Download
                                </a>

                            @else

                                <span
                                    class="admin-thesis-action admin-thesis-download disabled"
                                >
                                    <i class="bi bi-download"></i>
                                    No File
                                </span>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- =========================================================
                EMPTY STATE
            ========================================================== --}}

            <div class="department-thesis-empty">

                <div class="department-thesis-empty-icon">
                    <i class="bi bi-journal-x"></i>
                </div>

                <h2>
                    No Theses Found
                </h2>

                <p>
                    There are currently no theses available
                    under {{ $department->name }}.
                </p>

                <a
                    href="{{ route('admin.departments.index') }}"
                    class="department-thesis-back-btn"
                >
                    <i class="bi bi-chevron-left"></i>
                    <span>Back to Departments</span>
                </a>

            </div>

        @endif

    </div>


    <style>

        /* =========================================================
           VARIABLES
        ========================================================== */

        :root {

            --department-thesis-black: #000000;
            --department-thesis-white: #ffffff;

            --department-thesis-page-bg: #ffffff;
            --department-thesis-card-bg: #ffffff;
            --department-thesis-input-bg: #fafafa;

            --department-thesis-text: #000000;
            --department-thesis-text-secondary: #333333;
            --department-thesis-text-muted: #777777;

            --department-thesis-border: #000000;
            --department-thesis-border-soft: #dddddd;

            --department-thesis-blue: #2563eb;

            --department-thesis-shadow:
                0 4px 18px rgba(0, 0, 0, .07);

            --department-thesis-card-shadow:
                0 2px 10px rgba(0, 0, 0, .05);
        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] {

            --department-thesis-black: #000000;
            --department-thesis-white: #ffffff;

            --department-thesis-page-bg: #000000;
            --department-thesis-card-bg: #000000;
            --department-thesis-input-bg: #0d0d0d;

            --department-thesis-text: #ffffff;
            --department-thesis-text-secondary: #dddddd;
            --department-thesis-text-muted: #999999;

            --department-thesis-border: #ffffff;
            --department-thesis-border-soft: #333333;

            --department-thesis-blue: #60a5fa;

            --department-thesis-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

            --department-thesis-card-shadow:
                0 2px 10px rgba(0, 0, 0, .35);
        }


        /* =========================================================
           MAIN
        ========================================================== */

        .dashboard-content {

            color:
                var(--department-thesis-text);

            transition:
                color .25s ease,
                background-color .25s ease;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .department-thesis-header {

            position: relative;

            margin-bottom: 20px;

            padding: 24px 50px;

            border:
                1px solid var(--department-thesis-border-soft);

            border-radius: 12px;

            background:
                var(--department-thesis-card-bg);

            box-shadow:
                var(--department-thesis-card-shadow);

            transition:
                background-color .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }


        /* =========================================================
           HEADER CONTENT
        ========================================================== */

        .department-thesis-header-content {

            position: relative;

            display: flex;

            align-items: center;

            justify-content: center;

            min-width: 0;
        }


        /* =========================================================
           BACK ICON
        ========================================================== */

        .department-thesis-back {

            position: absolute;

            left: 0;

            top: 50%;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            width: 34px;

            height: 34px;

            border-radius: 7px;

            color:
                var(--department-thesis-text-muted);

            text-decoration: none;

            transform: translateY(-50%);

            transition:
                background-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }


        .department-thesis-back:hover {

            background:
                var(--department-thesis-input-bg);

            color:
                var(--department-thesis-text);

            transform:
                translate(-2px, -50%);
        }


        .department-thesis-back i {

            font-size: 1rem;

            line-height: 1;
        }


        /* =========================================================
           CENTER TITLE CONTENT
        ========================================================== */

        .department-thesis-title-content {

            width: 100%;

            min-width: 0;

            text-align: center;
        }


        /* =========================================================
           OVERLINE
        ========================================================== */

        .department-thesis-overline {

            display: block;

            margin-bottom: .4rem;

            color:
                var(--department-thesis-text-muted);

            font-size: .68rem;

            font-weight: 700;

            letter-spacing: .14em;

            text-transform: uppercase;
        }


        /* =========================================================
           TITLE
        ========================================================== */

        .department-thesis-title {

            margin: 0;

            color:
                var(--department-thesis-text);

            font-size: 1.8rem;

            font-weight: 800;

            letter-spacing: -.035em;

            line-height: 1.2;
        }


        /* =========================================================
           SUBTITLE
        ========================================================== */

        .department-thesis-subtitle {

            margin: .35rem 0 0;

            color:
                var(--department-thesis-text-muted);

            font-size: .78rem;
        }


        /* =========================================================
           GRID
        ========================================================== */

        .department-thesis-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 16px;
        }


        /* =========================================================
           ADMIN THESIS CARD
        ========================================================== */

        .admin-thesis-card {

            display: flex;

            flex-direction: column;

            min-width: 0;

            padding: 1rem;

            border:
                1px solid var(--department-thesis-border-soft);

            border-radius: 10px;

            background:
                var(--department-thesis-card-bg);

            color:
                var(--department-thesis-text);

            box-shadow:
                var(--department-thesis-card-shadow);

            transition:
                transform .2s ease,
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;
        }


        .admin-thesis-card:hover {

            transform: translateY(-2px);

            border-color:
                var(--department-thesis-text);

            box-shadow:
                var(--department-thesis-shadow);
        }


        /* =========================================================
           CARD TOP
        ========================================================== */

        .admin-thesis-card-top {

            display: flex;

            align-items: center;

            gap: .75rem;

            margin-bottom: .85rem;
        }


        .admin-thesis-card-heading {

            display: flex;

            align-items: center;

            gap: .7rem;

            min-width: 0;

            width: 100%;
        }


        .admin-thesis-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 38px;

            height: 38px;

            border:
                1px solid var(--department-thesis-border-soft);

            border-radius: 7px;

            background:
                var(--department-thesis-input-bg);

            color:
                var(--department-thesis-text);

            font-size: .95rem;

            flex-shrink: 0;
        }


        .admin-thesis-card-title {

            display: -webkit-box;

            margin: 0;

            color:
                var(--department-thesis-text);

            font-size: .95rem;

            font-weight: 750;

            line-height: 1.4;

            overflow: hidden;

            -webkit-line-clamp: 2;

            -webkit-box-orient: vertical;

            word-break: break-word;
        }


        /* =========================================================
           PUBLISHED INFORMATION
        ========================================================== */

        .admin-thesis-published {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: .6rem;

            margin-bottom: .9rem;

            padding-bottom: .85rem;

            border-bottom:
                1px solid var(--department-thesis-border-soft);
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

            width: 28px;

            height: 28px;

            border:
                1px solid var(--department-thesis-border-soft);

            border-radius: 6px;

            background:
                var(--department-thesis-input-bg);

            color:
                var(--department-thesis-text);

            font-size: .7rem;

            flex-shrink: 0;
        }


        .admin-thesis-published-content {

            display: flex;

            flex-direction: column;

            min-width: 0;
        }


        .admin-thesis-published-label {

            color:
                var(--department-thesis-text-muted);

            font-size: .55rem;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .05em;
        }


        .admin-thesis-published-value {

            margin-top: .12rem;

            color:
                var(--department-thesis-text);

            font-size: .67rem;

            font-weight: 600;

            overflow: hidden;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        /* =========================================================
           CARD BODY
        ========================================================== */

        .admin-thesis-card-body {

            display: flex;

            flex-direction: column;

            gap: .7rem;

            flex: 1;
        }


        .admin-thesis-detail {

            display: flex;

            align-items: center;

            gap: .55rem;

            min-width: 0;
        }


        .admin-thesis-detail-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 28px;

            height: 28px;

            border:
                1px solid var(--department-thesis-border-soft);

            border-radius: 6px;

            background:
                var(--department-thesis-input-bg);

            color:
                var(--department-thesis-text);

            font-size: .7rem;

            flex-shrink: 0;
        }


        .admin-thesis-detail-content {

            display: flex;

            flex-direction: column;

            min-width: 0;
        }


        .admin-thesis-detail-label {

            color:
                var(--department-thesis-text-muted);

            font-size: .55rem;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .05em;
        }


        .admin-thesis-detail-value {

            margin-top: .12rem;

            color:
                var(--department-thesis-text);

            font-size: .68rem;

            font-weight: 600;

            overflow: hidden;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        /* =========================================================
           SUBMITTED BY
        ========================================================== */

        .admin-thesis-submitted {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: .75rem;

            margin-top: .2rem;

            padding-top: .7rem;

            border-top:
                1px solid var(--department-thesis-border-soft);
        }


        .admin-thesis-submitted-label {

            color:
                var(--department-thesis-text-muted);

            font-size: .58rem;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .05em;
        }


        .admin-thesis-submitted-value {

            min-width: 0;

            color:
                var(--department-thesis-text);

            font-size: .68rem;

            font-weight: 600;

            overflow: hidden;

            white-space: nowrap;

            text-overflow: ellipsis;

            text-align: right;
        }


        /* =========================================================
           FOOTER
        ========================================================== */

        .admin-thesis-card-footer {

            display: flex;

            align-items: center;

            gap: .5rem;

            margin-top: 1rem;

            padding-top: .8rem;

            border-top:
                1px solid var(--department-thesis-border-soft);
        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .admin-thesis-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .35rem;

            min-height: 31px;

            padding: .35rem .7rem;

            border-radius: 6px;

            font-size: .68rem;

            font-weight: 600;

            text-decoration: none;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }


        /* =========================================================
           VIEW PDF
        ========================================================== */

        .admin-thesis-view {

            flex: 1;

            border:
                1px solid var(--department-thesis-text);

            background:
                var(--department-thesis-card-bg);

            color:
                var(--department-thesis-text);
        }


        .admin-thesis-view:hover {

            transform: translateY(-1px);

            background:
                var(--department-thesis-text);

            color:
                var(--department-thesis-card-bg);
        }


        /* =========================================================
           DOWNLOAD
        ========================================================== */

        .admin-thesis-download {

            flex: 1;

            border:
                1px solid var(--department-thesis-border-soft);

            background:
                var(--department-thesis-card-bg);

            color:
                var(--department-thesis-text);
        }


        .admin-thesis-download:hover {

            transform: translateY(-1px);

            border-color:
                var(--department-thesis-text);

            background:
                var(--department-thesis-input-bg);

            color:
                var(--department-thesis-text);
        }


        .admin-thesis-download.disabled {

            opacity: .5;

            cursor: not-allowed;

            pointer-events: none;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .department-thesis-empty {

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            min-height: 300px;

            padding: 3rem 1.5rem;

            border:
                1px solid var(--department-thesis-border-soft);

            border-radius: 10px;

            background:
                var(--department-thesis-card-bg);

            text-align: center;

            box-shadow:
                var(--department-thesis-card-shadow);
        }


        .department-thesis-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 64px;

            height: 64px;

            margin-bottom: 1rem;

            border:
                1px solid var(--department-thesis-border-soft);

            border-radius: 50%;

            background:
                var(--department-thesis-input-bg);

            color:
                var(--department-thesis-text);

            font-size: 1.4rem;
        }


        .department-thesis-empty h2 {

            margin: 0 0 .4rem;

            color:
                var(--department-thesis-text);

            font-size: 1.05rem;

            font-weight: 700;
        }


        .department-thesis-empty p {

            max-width: 420px;

            margin: 0 0 1.25rem;

            color:
                var(--department-thesis-text-muted);

            font-size: .78rem;

            line-height: 1.5;
        }


        /* =========================================================
           BACK BUTTON
        ========================================================== */

        .department-thesis-back-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .45rem;

            min-height: 36px;

            padding: .45rem .8rem;

            border:
                1px solid var(--department-thesis-text);

            border-radius: 7px;

            background:
                var(--department-thesis-card-bg);

            color:
                var(--department-thesis-text);

            font-size: .72rem;

            font-weight: 600;

            text-decoration: none;

            transition:
                background-color .2s ease,
                color .2s ease;
        }


        .department-thesis-back-btn:hover {

            background:
                var(--department-thesis-text);

            color:
                var(--department-thesis-card-bg);
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1100px) {

            .department-thesis-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 768px) {

            .department-thesis-header {

                padding: 20px 45px;
            }


            .department-thesis-title {

                font-size: 1.6rem;
            }


            .department-thesis-grid {

                grid-template-columns: 1fr;
            }


            .admin-thesis-published {

                grid-template-columns: 1fr;
            }

        }


        @media (max-width: 480px) {

            .department-thesis-header {

                padding: 18px 40px;
            }


            .department-thesis-back {

                width: 30px;

                height: 30px;
            }


            .department-thesis-title {

                font-size: 1.4rem;
            }


            .department-thesis-subtitle {

                font-size: .7rem;
            }


            .department-thesis-overline {

                font-size: .6rem;
            }


            .admin-thesis-card {

                padding: .9rem;
            }


            .admin-thesis-card-footer {

                flex-direction: column;
            }


            .admin-thesis-action {

                width: 100%;
            }

        }

    </style>

</x-app-layout>