<x-app-layout>

    <div class="dashboard-page">

        <div class="dashboard-content">

            {{-- =========================================================
                STATISTICS
            ========================================================== --}}

            <section class="dashboard-grid">

                {{-- MY THESIS --}}

                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon purple">
                            <i class="bi bi-journal-bookmark"></i>
                        </div>

                        <div>

                            <div class="stat-card-title">
                                My Thesis
                            </div>

                            <div class="stat-number">
                                {{ $totalTheses ?? 0 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Total My Theses
                    </div>

                </div>


                {{-- PUBLISHED THESIS --}}

                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon blue">
                            <i class="bi bi-check-circle"></i>
                        </div>

                        <div>

                            <div class="stat-card-title">
                                Published
                            </div>

                            <div class="stat-number">
                                {{ $publishedTheses ?? 0 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Published Theses
                    </div>

                </div>


                {{-- PENDING REQUESTS --}}

                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon orange">
                            <i class="bi bi-hourglass-split"></i>
                        </div>

                        <div>

                            <div class="stat-card-title">
                                Pending Requests
                            </div>

                            <div class="stat-number">
                                {{ $pendingRequests ?? 0 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Waiting for approval
                    </div>

                </div>


                {{-- SAVED THESIS --}}

                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon green">
                            <i class="bi bi-bookmark-heart"></i>
                        </div>

                        <div>

                            <div class="stat-card-title">
                                Saved Thesis
                            </div>

                            <div class="stat-number">
                                {{ $savedTheses ?? 0 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Your saved theses
                    </div>

                </div>

            </section>


            {{-- =========================================================
                LOWER GRID
            ========================================================== --}}

            <section class="dashboard-lower-grid">


                {{-- =====================================================
                    LEFT SIDE
                ====================================================== --}}

                <div class="dashboard-lower-main">


                    {{-- =================================================
                        MY RECENT THESIS
                    ================================================== --}}

                    <div class="dashboard-card dashboard-large-card">

                        <div class="dashboard-card-header">

                            <div>

                                <span class="dashboard-section-label">
                                    THESIS REPOSITORY
                                </span>

                                <h3>
                                    My Recent Theses
                                </h3>

                            </div>

                            <a href="{{ route('student.thesis.index') }}" class="view-all">

                                <span>
                                    View all
                                </span>

                                <i class="bi bi-chevron-right"></i>

                            </a>

                        </div>


                        <div class="thesis-list">

                            @forelse($recentTheses ?? [] as $thesis)
                                <div class="thesis-item">

                                    <div class="thesis-avatar">

                                        <i class="bi bi-journal-text"></i>

                                    </div>


                                    <div class="thesis-info">

                                        <strong>
                                            {{ $thesis->title ?? 'Untitled Thesis' }}
                                        </strong>

                                        <span>

                                            {{ $thesis->created_at?->format('M d, Y') ?? 'No date' }}

                                        </span>

                                    </div>


                                    @if ($thesis->is_published ?? false)
                                        <span class="status-badge status-published">
                                            Published
                                        </span>
                                    @else
                                        <span class="status-badge status-pending">
                                            Unpublished
                                        </span>
                                    @endif

                                </div>

                            @empty

                                <div class="dashboard-empty">

                                    <i class="bi bi-journal-x"></i>

                                    <span>
                                        No recent theses.
                                    </span>

                                </div>
                            @endforelse

                        </div>

                    </div>


                    {{-- =================================================
                        RECENT THESIS REQUESTS
                    ================================================== --}}

                    <div class="dashboard-card dashboard-large-card">

                        <div class="dashboard-card-header">

                            <div>

                                <span class="dashboard-section-label">
                                    MANAGEMENT
                                </span>

                                <h3>
                                    Recent Thesis Requests
                                </h3>

                            </div>

                            <a href="{{ route('student.thesis_requests.index') }}" class="view-all">

                                <span>
                                    View all
                                </span>

                                <i class="bi bi-chevron-right"></i>

                            </a>

                        </div>


                        <div class="request-list">

                            @forelse($recentRequests ?? [] as $request)
                                <div class="request-item">


                                    {{-- REQUEST ICON --}}

                                    <div class="request-avatar">

                                        <i class="bi bi-file-earmark-text"></i>

                                    </div>


                                    {{-- REQUEST INFORMATION --}}

                                    <div class="request-info">

                                        <strong class="request-title">

                                            {{ $request->thesis?->title ?? 'Thesis Request' }}

                                        </strong>

                                        <span class="request-name">

                                            {{ $request->created_at?->format('M d, Y') ?? 'No date' }}

                                        </span>

                                    </div>


                                    {{-- STATUS --}}

                                    @if ($request->is_approved === 1)
                                        <span class="status-badge status-approved">
                                            Approved
                                        </span>
                                    @elseif ($request->is_approved === 0)
                                        <span class="status-badge status-rejected">
                                            Rejected
                                        </span>
                                    @else
                                        <span class="status-badge status-pending">
                                            Pending
                                        </span>
                                    @endif

                                </div>

                            @empty

                                <div class="dashboard-empty">

                                    <i class="bi bi-inbox"></i>

                                    <span>
                                        No recent thesis requests.
                                    </span>

                                </div>
                            @endforelse

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    RIGHT SIDE
                ====================================================== --}}

                <div class="dashboard-lower-side">


                    {{-- =================================================
                        STUDENT OVERVIEW
                    ================================================== --}}

                    <div class="dashboard-card dashboard-small-card">

                        <div class="dashboard-card-header">

                            <div>

                                <span class="dashboard-section-label">
                                    STUDENT
                                </span>

                                <h3>
                                    Student Overview
                                </h3>

                            </div>

                        </div>


                        {{-- NAME --}}

                        <div class="student-item">

                            <div class="student-avatar">

                                <i class="bi bi-person"></i>

                            </div>

                            <div class="student-info">

                                <strong>

                                    {{ auth()->user()->student?->full_name ?? (auth()->user()->username ?? 'Student') }}

                                </strong>

                                <span>
                                    Student
                                </span>

                            </div>

                        </div>


                        {{-- DEPARTMENT --}}

                        <div class="student-item">

                            <div class="student-avatar">

                                <i class="bi bi-building"></i>

                            </div>

                            <div class="student-info">

                                <strong>

                                    {{ auth()->user()->student?->department?->name ?? 'No Department' }}

                                </strong>

                                <span>
                                    Department
                                </span>

                            </div>

                        </div>


                        {{-- EMAIL --}}

                        <div class="student-item">

                            <div class="student-avatar">

                                <i class="bi bi-envelope"></i>

                            </div>

                            <div class="student-info">

                                <strong>

                                    {{ auth()->user()->email }}

                                </strong>

                                <span>
                                    Email Address
                                </span>

                            </div>

                        </div>


                        {{-- THESIS COUNT --}}

                        <div class="student-item">

                            <div class="student-avatar">

                                <i class="bi bi-journal-bookmark"></i>

                            </div>

                            <div class="student-info">

                                <strong>

                                    {{ $totalTheses ?? 0 }}

                                </strong>

                                <span>
                                    My Theses
                                </span>

                            </div>

                        </div>


                        {{-- VIEW THESIS --}}

                        <a href="{{ route('student.thesis.index') }}" class="view-all">

                            <span>
                                View My Thesis
                            </span>

                            <i class="bi bi-chevron-right"></i>

                        </a>

                    </div>


                    {{-- =================================================
                        QUICK ACTIONS
                    ================================================== --}}

                    <div class="dashboard-card dashboard-small-card">

                        <div class="dashboard-card-header">

                            <div>

                                <span class="dashboard-section-label">
                                    ACTIONS
                                </span>

                                <h3>
                                    Quick Actions
                                </h3>

                            </div>

                        </div>


                        {{-- MY THESIS --}}

                        <a href="{{ route('student.thesis.index') }}" class="quick-action">

                            <div class="quick-action-icon">

                                <i class="bi bi-journal-text"></i>

                            </div>

                            <div class="quick-action-info">

                                <strong>
                                    My Thesis
                                </strong>

                                <span>
                                    View your thesis
                                </span>

                            </div>

                            <i class="bi bi-chevron-right quick-action-arrow"></i>

                        </a>


                        {{-- THESIS REQUESTS --}}

                        <a href="{{ route('student.thesis_requests.index') }}" class="quick-action">

                            <div class="quick-action-icon">

                                <i class="bi bi-file-earmark-text"></i>

                            </div>

                            <div class="quick-action-info">

                                <strong>
                                    Thesis Requests
                                </strong>

                                <span>
                                    Track your requests
                                </span>

                            </div>

                            <i class="bi bi-chevron-right quick-action-arrow"></i>

                        </a>


                        {{-- NOTIFICATIONS --}}

                        <a href="{{ route('notifications.index') }}" class="quick-action">

                            <div class="quick-action-icon">

                                <i class="bi bi-bell"></i>

                            </div>

                            <div class="quick-action-info">

                                <strong>
                                    Notifications
                                </strong>

                                <span>
                                    View notifications
                                </span>

                            </div>

                            <i class="bi bi-chevron-right quick-action-arrow"></i>

                        </a>

                    </div>

                </div>

            </section>

        </div>

    </div>


    {{-- =============================================================
        CSS
    ============================================================== --}}

    <style>
        :root {

            --dashboard-black: #000000;
            --dashboard-white: #ffffff;

            --dashboard-page-bg: #ffffff;
            --dashboard-card-bg: #ffffff;
            --dashboard-input-bg: #fafafa;

            --dashboard-text: #000000;
            --dashboard-text-secondary: #333333;
            --dashboard-text-muted: #777777;

            --dashboard-border: #000000;
            --dashboard-border-soft: #dddddd;

            --dashboard-shadow:
                0 4px 18px rgba(0, 0, 0, .07);

            --dashboard-card-shadow:
                0 2px 10px rgba(0, 0, 0, .05);

            --dashboard-primary: #000000;

            --dashboard-soft: #f7f7f7;

            --dashboard-hover: #252525;

            --dashboard-divider: #eeeeee;
        }


        [data-bs-theme="dark"] {

            --dashboard-black: #000000;
            --dashboard-white: #ffffff;

            --dashboard-page-bg: #000000;
            --dashboard-card-bg: #000000;
            --dashboard-input-bg: #0d0d0d;

            --dashboard-text: #ffffff;
            --dashboard-text-secondary: #dddddd;
            --dashboard-text-muted: #999999;

            --dashboard-border: #ffffff;
            --dashboard-border-soft: #333333;

            --dashboard-primary: #ffffff;

            --dashboard-soft: #111111;

            --dashboard-hover: #dddddd;

            --dashboard-divider: #333333;

            --dashboard-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

            --dashboard-card-shadow:
                0 2px 10px rgba(0, 0, 0, .35);
        }


        /* =========================================================
           PAGE
        ========================================================== */

        .dashboard-page {

            width: 100%;

            color: var(--dashboard-text);

            transition:
                color .25s ease,
                background-color .25s ease;
        }


        .dashboard-content {

            width: 100%;

            color: var(--dashboard-text);
        }


        /* =========================================================
           STAT CARDS
        ========================================================== */

        .dashboard-grid {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 20px;

            width: 100%;

            margin-bottom: 20px;
        }


        .stat-card {

            min-width: 0;

            padding: 20px;

            background: var(--dashboard-card-bg);

            color: var(--dashboard-text);

            border: 1px solid var(--dashboard-border-soft);

            border-radius: 12px;

            box-shadow:
                var(--dashboard-card-shadow);

            transition:
                background-color .25s ease,
                color .25s ease,
                box-shadow .25s ease,
                transform .2s ease;
        }


        .stat-card:hover {

            transform: translateY(-2px);

            box-shadow:
                var(--dashboard-shadow);
        }


        .stat-card-top {

            display: flex;

            align-items: center;

            gap: 13px;
        }


        .stat-icon {

            width: 44px;

            height: 44px;

            min-width: 44px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 10px;

            font-size: 18px;
        }


        .stat-icon.purple {

            background: #f1edff;

            color: #6538d9;
        }


        .stat-icon.blue {

            background: #eaf2ff;

            color: #2563eb;
        }


        .stat-icon.green {

            background: #eaf8f0;

            color: #16834b;
        }


        .stat-icon.orange {

            background: #fff4e5;

            color: #d97706;
        }


        .stat-card-title {

            color: var(--dashboard-text-secondary);

            font-size: 13px;

            line-height: 1.35;

            font-weight: 600;
        }


        .stat-number {

            margin-top: 2px;

            color: var(--dashboard-text);

            font-size: 28px;

            line-height: 1.2;

            font-weight: 700;
        }


        .stat-footer {

            margin-top: 17px;

            padding-top: 13px;

            border-top:
                1px solid var(--dashboard-divider);

            color: var(--dashboard-text-muted);

            font-size: 11px;

            line-height: 1.4;

            font-weight: 500;
        }


        /* =========================================================
           LOWER GRID
        ========================================================== */

        .dashboard-lower-grid {

            display: grid;

            grid-template-columns:
                minmax(0, 1.65fr) minmax(280px, .75fr);

            gap: 20px;

            width: 100%;

            align-items: stretch;
        }


        .dashboard-lower-main,
        .dashboard-lower-side {

            min-width: 0;

            display: flex;

            flex-direction: column;

            gap: 20px;
        }


        /* =========================================================
           DASHBOARD CARDS
        ========================================================== */

        .dashboard-card {

            width: 100%;

            box-sizing: border-box;

            padding: 22px;

            background: var(--dashboard-card-bg);

            color: var(--dashboard-text);

            border: 1px solid var(--dashboard-border-soft);

            border-radius: 12px;

            box-shadow:
                var(--dashboard-card-shadow);

            transition:
                background-color .25s ease,
                color .25s ease,
                box-shadow .25s ease;
        }


        .dashboard-large-card,
        .dashboard-small-card {

            min-height: 270px;
        }


        /* =========================================================
           CARD HEADER
        ========================================================== */

        .dashboard-card-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 14px;

            min-height: 44px;

            margin-bottom: 16px;
        }


        .dashboard-section-label {

            display: block;

            margin-bottom: 5px;

            color: var(--dashboard-text-muted);

            font-size: 10px;

            line-height: 1.2;

            font-weight: 700;

            letter-spacing: 1px;

            text-transform: uppercase;
        }


        .dashboard-card-header h3 {

            margin: 0;

            color: var(--dashboard-text);

            font-size: 18px;

            line-height: 1.35;

            font-weight: 700;
        }


        .view-all {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            flex-shrink: 0;

            color: var(--dashboard-text-muted);

            font-size: 12px;

            line-height: 1.3;

            font-weight: 500;

            text-decoration: none;

            transition: color .2s ease;
        }


        .view-all:hover {

            color: var(--dashboard-text);
        }


        .view-all i {

            font-size: 12px;
        }


        /* =========================================================
           THESIS LIST
        ========================================================== */

        .thesis-list {

            width: 100%;
        }


        .thesis-item {

            display: flex;

            align-items: center;

            gap: 13px;

            min-height: 58px;

            padding: 9px 0;
        }


        .thesis-item+.thesis-item {

            border-top:
                1px solid var(--dashboard-divider);
        }


        .thesis-avatar {

            width: 38px;

            height: 38px;

            min-width: 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 9px;

            background: #f1edff;

            color: #6538d9;

            font-size: 15px;
        }


        .thesis-info {

            min-width: 0;

            flex: 1;
        }


        .thesis-info strong {

            display: block;

            overflow: hidden;

            margin-bottom: 4px;

            color: var(--dashboard-text);

            font-size: 14px;

            line-height: 1.4;

            font-weight: 600;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        .thesis-info span {

            display: block;

            overflow: hidden;

            color: var(--dashboard-text-muted);

            font-size: 12px;

            line-height: 1.4;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        /* =========================================================
           REQUESTS
        ========================================================== */

        .request-list {

            width: 100%;
        }


        .request-item {

            display: flex;

            align-items: center;

            gap: 13px;

            min-height: 58px;

            padding: 9px 0;
        }


        .request-item+.request-item {

            border-top:
                1px solid var(--dashboard-divider);
        }


        .request-avatar {

            width: 38px;

            height: 38px;

            min-width: 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #6538d9;

            color: #ffffff;

            font-size: 14px;
        }


        .request-info {

            min-width: 0;

            flex: 1;
        }


        .request-title {

            display: block;

            overflow: hidden;

            margin-bottom: 4px;

            color: var(--dashboard-text);

            font-size: 14px;

            line-height: 1.4;

            font-weight: 600;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        .request-name {

            display: block;

            overflow: hidden;

            color: var(--dashboard-text-muted);

            font-size: 12px;

            line-height: 1.4;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        /* =========================================================
           STATUS
        ========================================================== */

        .status-badge {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            min-width: 68px;

            padding: 7px 10px;

            border-radius: 6px;

            font-size: 10px;

            line-height: 1;

            font-weight: 600;

            white-space: nowrap;
        }


        .status-published,
        .status-approved {

            background: #ecfdf3;

            color: #15803d;
        }


        .status-pending {

            background: #eff6ff;

            color: #2563eb;
        }


        .status-rejected {

            background: #fef2f2;

            color: #dc2626;
        }


        /* =========================================================
           STUDENT OVERVIEW
        ========================================================== */

        .student-item {

            display: flex;

            align-items: center;

            gap: 11px;

            min-height: 53px;

            padding: 9px 0;
        }


        .student-item+.student-item {

            border-top:
                1px solid var(--dashboard-divider);
        }


        .student-avatar {

            width: 36px;

            height: 36px;

            min-width: 36px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #f1edff;

            color: #6538d9;

            font-size: 14px;
        }


        .student-info {

            min-width: 0;

            flex: 1;
        }


        .student-info strong {

            display: block;

            overflow: hidden;

            margin-bottom: 3px;

            color: var(--dashboard-text);

            font-size: 13px;

            line-height: 1.4;

            font-weight: 600;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        .student-info span {

            display: block;

            overflow: hidden;

            color: var(--dashboard-text-muted);

            font-size: 11px;

            line-height: 1.4;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        /* =========================================================
           QUICK ACTIONS
        ========================================================== */

        .quick-action {

            display: flex;

            align-items: center;

            gap: 11px;

            width: 100%;

            min-height: 53px;

            padding: 9px 0;

            border-bottom:
                1px solid var(--dashboard-divider);

            text-decoration: none;

            transition:
                padding-left .2s ease;
        }


        .quick-action:last-child {

            border-bottom: none;
        }


        .quick-action:hover {

            padding-left: 5px;
        }


        .quick-action-icon {

            width: 36px;

            height: 36px;

            min-width: 36px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 9px;

            background: #f1edff;

            color: #6538d9;

            font-size: 14px;
        }


        .quick-action-info {

            min-width: 0;

            flex: 1;
        }


        .quick-action-info strong {

            display: block;

            margin-bottom: 3px;

            color: var(--dashboard-text);

            font-size: 13px;

            line-height: 1.4;

            font-weight: 600;
        }


        .quick-action-info span {

            display: block;

            color: var(--dashboard-text-muted);

            font-size: 11px;

            line-height: 1.4;
        }


        .quick-action-arrow {

            flex-shrink: 0;

            color: var(--dashboard-text-muted);

            font-size: 11px;

            transition:
                color .2s ease;
        }


        .quick-action:hover .quick-action-arrow {

            color: var(--dashboard-text);
        }


        /* =========================================================
           EMPTY
        ========================================================== */

        .dashboard-empty {

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            gap: 8px;

            min-height: 140px;

            padding: 20px;

            color: var(--dashboard-text-muted);

            font-size: 12px;

            text-align: center;
        }


        .dashboard-empty i {

            font-size: 22px;

            opacity: .65;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1100px) {

            .dashboard-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }


            .dashboard-lower-grid {

                grid-template-columns:
                    minmax(0, 1.5fr) minmax(260px, .8fr);
            }

        }


        @media (max-width: 850px) {

            .dashboard-lower-grid {

                grid-template-columns: 1fr;
            }


            .dashboard-lower-side {

                display: grid;

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 20px;
            }

        }


        @media (max-width: 650px) {

            .dashboard-grid {

                grid-template-columns: 1fr;
            }


            .dashboard-lower-side {

                display: flex;

                flex-direction: column;

                gap: 20px;
            }


            .dashboard-card {

                padding: 18px;
            }


            .dashboard-card-header h3 {

                font-size: 16px;
            }


            .view-all span {

                display: none;
            }


            .status-badge {

                min-width: 58px;

                padding: 6px 7px;

                font-size: 9px;
            }

        }


        @media (max-width: 450px) {

            .dashboard-grid {

                gap: 14px;
            }


            .dashboard-lower-grid {

                gap: 14px;
            }


            .dashboard-lower-main,
            .dashboard-lower-side {

                gap: 14px;
            }


            .dashboard-card {

                padding: 16px;

                border-radius: 10px;
            }


            .thesis-item,
            .request-item {

                gap: 9px;
            }


            .thesis-avatar,
            .request-avatar {

                width: 34px;

                height: 34px;

                min-width: 34px;
            }


            .thesis-info strong,
            .request-title {

                font-size: 12px;
            }


            .thesis-info span,
            .request-name {

                font-size: 10px;
            }

        }
    </style>

</x-app-layout>
