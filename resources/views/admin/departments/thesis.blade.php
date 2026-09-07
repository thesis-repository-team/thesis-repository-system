
<x-app-layout>

    <div class="dashboard-content">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="department-thesis-header">

            <div class="department-thesis-header-content">

                {{-- BACK TO DEPARTMENTS --}}

                <a
                    href="{{ route('admin.departments.index') }}"
                    class="department-thesis-back"
                    title="Back to Departments"
                    aria-label="Back to Departments"
                >
                    <i class="bi bi-chevron-left"></i>

                    <span>
                        Back to Departments
                    </span>
                </a>

            </div>

        </div>


        {{-- =========================================================
            THESIS LIST
        ========================================================== --}}

        @if ($theses->count())

            <div class="department-thesis-grid">

                @foreach ($theses as $thesis)

                    <div class="department-thesis-card admin-thesis-card">

                        {{-- =================================================
                            CARD TOP
                        ================================================== --}}

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


                        {{-- =================================================
                            PUBLISHED INFORMATION
                        ================================================== --}}

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
                                            ? \Carbon\Carbon::parse(
                                                $thesis->published_at
                                            )->format('M d, Y')
                                            : '—' }}

                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            CARD BODY
                        ================================================== --}}

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


                        {{-- =================================================
                            CARD FOOTER
                        ================================================== --}}

                        <div class="admin-thesis-card-footer">

                            {{-- VIEW PDF --}}

                            <a
                                href="{{ route(
                                    'admin.thesis.view-pdf',
                                    $thesis->id
                                ) }}"
                                target="_blank"
                                class="admin-thesis-action admin-thesis-view"
                            >
                                <i class="bi bi-file-earmark-pdf"></i>

                                <span>
                                    View PDF
                                </span>
                            </a>


                            {{-- DOWNLOAD --}}

                            @if ($thesis->files && $thesis->files->count())

                                @php
                                    $file = $thesis->files->first();
                                @endphp

                                <a
                                    href="{{ route(
                                        'admin.thesis.download',
                                        $file->id
                                    ) }}"
                                    class="admin-thesis-action admin-thesis-download"
                                >
                                    <i class="bi bi-download"></i>

                                    <span>
                                        Download
                                    </span>
                                </a>

                            @else

                                <span
                                    class="admin-thesis-action
                                           admin-thesis-download
                                           disabled"
                                >
                                    <i class="bi bi-download"></i>

                                    <span>
                                        No File
                                    </span>
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

                    <span>
                        Back to Departments
                    </span>
                </a>

            </div>

        @endif

    </div>


    <style>

        /* =========================================================
           ROOT VARIABLES
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

            --department-thesis-card-shadow:
                0 3px 12px rgba(0, 0, 0, .06);

            --department-thesis-card-shadow-hover:
                0 7px 20px rgba(0, 0, 0, .10);
        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] {

            --department-thesis-page-bg: #000000;
            --department-thesis-card-bg: #000000;
            --department-thesis-input-bg: #0d0d0d;

            --department-thesis-text: #ffffff;
            --department-thesis-text-secondary: #dddddd;
            --department-thesis-text-muted: #999999;

            --department-thesis-border: #ffffff;
            --department-thesis-border-soft: #333333;

            --department-thesis-blue: #60a5fa;

            --department-thesis-card-shadow:
                0 3px 14px rgba(255, 255, 255, .03);

            --department-thesis-card-shadow-hover:
                0 7px 22px rgba(255, 255, 255, .06);
        }


        /* =========================================================
           PAGE
        ========================================================== */

        .dashboard-content {
            color: var(--department-thesis-text);
        }


        /* =========================================================
           PAGE HEADER
        ========================================================== */

        .department-thesis-header {

            position: relative;

            margin-bottom: 20px;

            padding: 8px 0;

            background: transparent;

            border: none;

            box-shadow: none;
        }


        .department-thesis-header-content {

            display: flex;

            align-items: center;

            min-width: 0;
        }


        /* =========================================================
           BACK TO DEPARTMENTS
        ========================================================== */

        .department-thesis-back {

            display: inline-flex;

            align-items: center;

            gap: .35rem;

            padding: 0;

            margin: 0;

            background: transparent;

            border: none;

            color:
                var(--department-thesis-text-secondary);

            font-size: .72rem;

            font-weight: 600;

            line-height: 1;

            text-decoration: none;

            cursor: pointer;

            transition:
                color .2s ease,
                transform .2s ease;
        }


        .department-thesis-back i {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            font-size: .8rem;

            line-height: 1;

            transition:
                transform .2s ease;
        }


        .department-thesis-back span {
            line-height: 1;
        }


        /* =========================================================
           BACK LINK HOVER
        ========================================================== */

        .department-thesis-back:hover {

            background: transparent;

            border: none;

            color:
                var(--department-thesis-text);

            text-decoration: none;

            transform:
                translateX(-2px);
        }


        .department-thesis-back:hover i {

            transform:
                translateX(-2px);
        }


        /* =========================================================
           THESIS GRID
        ========================================================== */

        .department-thesis-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 16px;
        }


        /* =========================================================
           THESIS CARD
        ========================================================== */

        .department-thesis-card {

            display: flex;

            flex-direction: column;

            min-width: 0;

            padding: 1rem;

            border:
                1px solid
                var(--department-thesis-border-soft);

            border-radius: 10px;

            background:
                var(--department-thesis-card-bg);

            color:
                var(--department-thesis-text);

            box-shadow:
                var(--department-thesis-card-shadow);

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease,
                background-color .25s ease;
        }


        .department-thesis-card:hover {

            transform:
                translateY(-2px);

            box-shadow:
                var(--department-thesis-card-shadow-hover);
        }


        /* =========================================================
           CARD TOP
        ========================================================== */

        .admin-thesis-card-top {

            min-width: 0;

            margin-bottom: .75rem;
        }


        .admin-thesis-card-heading {

            display: flex;

            align-items: center;

            gap: .7rem;

            min-width: 0;
        }


        .admin-thesis-icon {

            flex: 0 0 auto;

            display: flex;

            align-items: center;

            justify-content: center;

            width: 34px;

            height: 34px;

            border:
                1px solid
                var(--department-thesis-border-soft);

            border-radius: 7px;

            background:
                var(--department-thesis-input-bg);

            color:
                var(--department-thesis-text);
        }


        .admin-thesis-icon i {
            font-size: .95rem;
        }


        .admin-thesis-card-title {

            min-width: 0;

            margin: 0;

            overflow: hidden;

            color:
                var(--department-thesis-text);

            font-size: .88rem;

            font-weight: 700;

            line-height: 1.35;

            display: -webkit-box;

            -webkit-line-clamp: 2;

            -webkit-box-orient: vertical;
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

            padding: .2rem;

            border-radius: 8px;

            background: #f3f4f6;
        }


        .admin-thesis-published-item {

            display: flex;

            align-items: center;

            gap: .45rem;

            min-width: 0;

            padding: .4rem .45rem;
        }


        .admin-thesis-published-icon {

            flex: 0 0 auto;

            display: flex;

            align-items: center;

            justify-content: center;

            width: 28px;

            height: 28px;

            border:
                1px solid #d1d5db;

            border-radius: 6px;

            background: #ffffff;

            color: #555555;
        }


        .admin-thesis-published-icon i {
            font-size: .75rem;
        }


        .admin-thesis-published-content {

            display: flex;

            flex-direction: column;

            min-width: 0;

            gap: 2px;
        }


        .admin-thesis-published-label {

            color: #777777;

            font-size: .58rem;

            font-weight: 600;

            line-height: 1.2;
        }


        .admin-thesis-published-value {

            overflow: hidden;

            color: #222222;

            font-size: .67rem;

            font-weight: 600;

            line-height: 1.25;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================================================
           DARK MODE - PUBLISHED
        ========================================================== */

        [data-bs-theme="dark"]
        .admin-thesis-published {

            background: #1a1a1a;
        }


        [data-bs-theme="dark"]
        .admin-thesis-published-icon {

            background: #0d0d0d;

            border-color: #333333;

            color: #dddddd;
        }


        [data-bs-theme="dark"]
        .admin-thesis-published-label {

            color: #999999;
        }


        [data-bs-theme="dark"]
        .admin-thesis-published-value {

            color: #ffffff;
        }


        /* =========================================================
           CARD BODY
        ========================================================== */

        .admin-thesis-card-body {

            display: flex;

            flex-direction: column;

            gap: .65rem;

            flex: 1;
        }


        .admin-thesis-detail {

            display: flex;

            align-items: center;

            gap: .55rem;

            min-width: 0;
        }


        .admin-thesis-detail-icon {

            flex: 0 0 auto;

            display: flex;

            align-items: center;

            justify-content: center;

            width: 29px;

            height: 29px;

            border:
                1px solid
                var(--department-thesis-border-soft);

            border-radius: 6px;

            background:
                var(--department-thesis-input-bg);

            color:
                var(--department-thesis-text-secondary);
        }


        .admin-thesis-detail-icon i {
            font-size: .75rem;
        }


        .admin-thesis-detail-content {

            display: flex;

            flex-direction: column;

            min-width: 0;

            gap: 2px;
        }


        .admin-thesis-detail-label {

            color:
                var(--department-thesis-text-muted);

            font-size: .58rem;

            font-weight: 600;

            line-height: 1.2;
        }


        .admin-thesis-detail-value {

            overflow: hidden;

            color:
                var(--department-thesis-text);

            font-size: .7rem;

            font-weight: 600;

            line-height: 1.3;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================================================
           SUBMITTED BY
        ========================================================== */

        .admin-thesis-submitted {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: .5rem;

            margin-top: .2rem;

            padding-top: .65rem;

            border-top:
                1px solid
                var(--department-thesis-border-soft);
        }


        .admin-thesis-submitted-label {

            flex: 0 0 auto;

            color:
                var(--department-thesis-text-muted);

            font-size: .58rem;

            font-weight: 600;
        }


        .admin-thesis-submitted-value {

            overflow: hidden;

            color:
                var(--department-thesis-text-secondary);

            font-size: .66rem;

            font-weight: 600;

            text-align: right;

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

            margin-top: 1rem;

            padding-top: .8rem;

            border-top:
                1px solid
                var(--department-thesis-border-soft);
        }


        /* =========================================================
           ACTION BUTTONS
        ========================================================== */

        .admin-thesis-action {

            flex: 1;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .35rem;

            min-height: 31px;

            padding: .35rem .7rem;

            border-radius: 6px;

            font-size: .68rem;

            font-weight: 600;

            line-height: 1;

            text-decoration: none;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;
        }


        .admin-thesis-action i {
            font-size: .75rem;
        }


        /* =========================================================
           VIEW PDF - RED
        ========================================================== */

        .admin-thesis-view {

            border:
                1px solid #dc2626;

            background:
                #dc2626;

            color:
                #ffffff;
        }


        .admin-thesis-view:hover {

            border-color:
                #b91c1c;

            background:
                #b91c1c;

            color:
                #ffffff;

            text-decoration: none;

            box-shadow:
                0 3px 8px
                rgba(220, 38, 38, .20);
        }


        /* =========================================================
           DOWNLOAD - BLUE
        ========================================================== */

        .admin-thesis-download {

            border:
                1px solid #2563eb;

            background:
                #2563eb;

            color:
                #ffffff;
        }


        .admin-thesis-download:hover {

            border-color:
                #1d4ed8;

            background:
                #1d4ed8;

            color:
                #ffffff;

            text-decoration: none;

            box-shadow:
                0 3px 8px
                rgba(37, 99, 235, .20);
        }


        .admin-thesis-download.disabled {

            cursor: not-allowed;

            opacity: .5;

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

            padding: 40px 25px;

            border:
                1px solid
                var(--department-thesis-border-soft);

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

            width: 55px;

            height: 55px;

            margin-bottom: 15px;

            border:
                1px solid
                var(--department-thesis-border-soft);

            border-radius: 10px;

            background:
                var(--department-thesis-input-bg);

            color:
                var(--department-thesis-text);
        }


        .department-thesis-empty-icon i {
            font-size: 1.4rem;
        }


        .department-thesis-empty h2 {

            margin: 0 0 7px;

            color:
                var(--department-thesis-text);

            font-size: 1rem;

            font-weight: 700;
        }


        .department-thesis-empty p {

            max-width: 450px;

            margin: 0 0 20px;

            color:
                var(--department-thesis-text-muted);

            font-size: .75rem;

            line-height: 1.5;
        }


        /* =========================================================
           EMPTY STATE BACK LINK
        ========================================================== */

        .department-thesis-back-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            padding: 0;

            background: transparent;

            border: none;

            color:
                var(--department-thesis-text-secondary);

            font-size: .7rem;

            font-weight: 600;

            text-decoration: none;

            transition:
                color .2s ease,
                transform .2s ease;
        }


        .department-thesis-back-btn i {

            font-size: .8rem;

            transition:
                transform .2s ease;
        }


        .department-thesis-back-btn:hover {

            background: transparent;

            border: none;

            color:
                var(--department-thesis-text);

            text-decoration: none;

            transform:
                translateX(-2px);
        }


        .department-thesis-back-btn:hover i {

            transform:
                translateX(-2px);
        }


        /* =========================================================
           RESPONSIVE - TABLET
        ========================================================== */

        @media (max-width: 1100px) {

            .department-thesis-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }
        }


        /* =========================================================
           RESPONSIVE - MOBILE
        ========================================================== */

        @media (max-width: 768px) {

            .department-thesis-grid {

                grid-template-columns:
                    1fr;
            }


            .department-thesis-header {

                padding: 7px 0;

                margin-bottom: 16px;
            }


            .department-thesis-card {

                padding: .9rem;
            }
        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 480px) {

            .department-thesis-header {

                padding: 6px 0;

                margin-bottom: 15px;
            }


            .department-thesis-back {

                gap: .3rem;

                font-size: .68rem;
            }


            .department-thesis-back i {

                font-size: .75rem;
            }


            .admin-thesis-published {

                grid-template-columns:
                    1fr;

                gap: .25rem;
            }


            .admin-thesis-card-footer {

                gap: .4rem;
            }


            .admin-thesis-action {

                padding: .35rem .5rem;

                font-size: .63rem;
            }

        }

    </style>

</x-app-layout>

