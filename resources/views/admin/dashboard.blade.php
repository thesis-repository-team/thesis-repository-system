
<x-app-layout>

    <div class="dashboard-page">

        <div class="dashboard-content">

            {{-- =========================================================
                STATISTICS
            ========================================================== --}}

            <section class="dashboard-grid">

                {{-- Departments --}}
                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon purple">
                            <i class="bi bi-building"></i>
                        </div>

                        <div>

                            <div class="stat-card-title">
                                Departments
                            </div>

                            <div class="stat-number">
                                {{ $departmentsCount ?? 0 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Total Departments
                    </div>

                </div>


                {{-- HoDs --}}
                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon blue">
                            <i class="bi bi-person"></i>
                        </div>

                        <div>

                            <div class="stat-card-title">
                                HoDs
                            </div>

                            <div class="stat-number">
                                {{ $hodsCount ?? 0 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Active HoDs
                    </div>

                </div>


                {{-- Students --}}
                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon green">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <div>

                            <div class="stat-card-title">
                                Students
                            </div>

                            <div class="stat-number">
                                {{ $studentsCount ?? 0 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Total Students
                    </div>

                </div>


                {{-- Theses --}}
                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon orange">
                            <i class="bi bi-journal-bookmark"></i>
                        </div>

                        <div>

                            <div class="stat-card-title">
                                Theses
                            </div>

                            <div class="stat-number">
                                {{ $thesesCount ?? 0 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Total Theses
                    </div>

                </div>

            </section>


            {{-- =========================================================
                LOWER DASHBOARD
            ========================================================== --}}

            <section class="dashboard-lower-grid">


                {{-- =====================================================
                    LEFT / MAIN COLUMN
                ====================================================== --}}

                <div class="dashboard-lower-main">


                    {{-- =================================================
                        RECENT THESES
                    ================================================== --}}

                    <div class="dashboard-card dashboard-large-card">

                        <div class="dashboard-card-header">

                            <div>

                                <span class="dashboard-section-label">
                                    THESIS REPOSITORY
                                </span>

                                <h3>
                                    Recent Theses
                                </h3>

                            </div>

                            <a
                                href="{{ route('admin.thesis.index') }}"
                                class="view-all"
                            >
                                <span>View all</span>
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
                                            {{ $thesis->publishedBy?->username
                                                ?? $thesis->publishedBy?->full_name
                                                ?? 'Unknown Publisher' }}
                                        </span>

                                    </div>


                                    <span class="status-badge status-published">
                                        Published
                                    </span>

                                </div>

                            @empty

                                <div class="dashboard-empty">
                                    No recent theses.
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

                            <a
                                href="{{ route('admin.thesis_requests.index') }}"
                                class="view-all"
                            >
                                <span>View all</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>

                        </div>


                        <div class="request-list">

                            @forelse($recentThesisRequests ?? [] as $request)

                                <div class="request-item">


                                    <div class="request-avatar">

                                        @if ($request->user)

                                            {{ strtoupper(
                                                substr(
                                                    $request->user->username ?? 'U',
                                                    0,
                                                    2
                                                )
                                            ) }}

                                        @else

                                            TR

                                        @endif

                                    </div>


                                    <div class="request-info">

                                        <strong class="request-title">
                                            {{ $request->thesis?->title ?? 'Thesis Request' }}
                                        </strong>

                                        <span class="request-name">
                                            {{ $request->user?->username ?? 'Unknown User' }}
                                        </span>

                                    </div>


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
                                    No recent thesis requests.
                                </div>

                            @endforelse

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    RIGHT / SIDE COLUMN
                ====================================================== --}}

                <div class="dashboard-lower-side">


                    {{-- =================================================
                        RECENT STUDENTS
                    ================================================== --}}

                    <div class="dashboard-card dashboard-small-card">

                        <div class="dashboard-card-header">

                            <div>

                                <span class="dashboard-section-label">
                                    STUDENTS
                                </span>

                                <h3>
                                    Recent Students
                                </h3>

                            </div>

                            <a
                                href="{{ route('admin.students.index') }}"
                                class="view-all"
                            >
                                <span>View all</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>

                        </div>


                        <div class="student-list">

                            @forelse($recentStudents ?? [] as $student)

                                <div class="student-item">

                                    <div class="student-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $student->full_name ?? 'S',
                                                0,
                                                2
                                            )
                                        ) }}

                                    </div>


                                    <div class="student-info">

                                        <strong>
                                            {{ $student->full_name ?? 'Unknown Student' }}
                                        </strong>

                                        <span>
                                            {{ $student->user?->email ?? 'Student' }}
                                        </span>

                                    </div>

                                </div>

                            @empty

                                <div class="dashboard-empty">
                                    No recent students.
                                </div>

                            @endforelse

                        </div>

                    </div>


                    {{-- =================================================
                        RECENT HODS
                    ================================================== --}}

                    <div class="dashboard-card dashboard-small-card">

                        <div class="dashboard-card-header">

                            <div>

                                <span class="dashboard-section-label">
                                    HEADS OF DEPARTMENT
                                </span>

                                <h3>
                                    Recent HoDs
                                </h3>

                            </div>

                            <a
                                href="{{ route('admin.hods.index') }}"
                                class="view-all"
                            >
                                <span>View all</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>

                        </div>


                        <div class="hod-list">

                            @forelse($recentHods ?? [] as $hod)

                                <div class="hod-item">

                                    <div class="hod-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $hod->full_name ?? 'H',
                                                0,
                                                2
                                            )
                                        ) }}

                                    </div>


                                    <div class="hod-info">

                                        <strong>
                                            {{ $hod->full_name ?? 'Unknown HoD' }}
                                        </strong>

                                        <span>
                                            {{ $hod->department?->department_name ?? 'No Department' }}
                                        </span>

                                    </div>

                                </div>

                            @empty

                                <div class="dashboard-empty">
                                    No recent HoDs.
                                </div>

                            @endforelse

                        </div>

                    </div>


                    {{-- =================================================
                        CALENDAR
                    ================================================== --}}

                    <div class="dashboard-card dashboard-small-card calendar-card">

                        <div class="dashboard-card-header">

                            <div>

                                <span class="dashboard-section-label">
                                    SCHEDULE
                                </span>

                                <h3>
                                    Calendar
                                </h3>

                            </div>

                        </div>


                        <div class="calendar-wrapper">


                            {{-- Calendar navigation --}}

                            <div class="calendar-header">

                                <button
                                    type="button"
                                    class="calendar-nav"
                                    id="calendarPrev"
                                    aria-label="Previous month"
                                >
                                    <i class="bi bi-chevron-left"></i>
                                </button>


                                <div
                                    class="calendar-month"
                                    id="calendarMonth"
                                >
                                    September 2026
                                </div>


                                <button
                                    type="button"
                                    class="calendar-nav"
                                    id="calendarNext"
                                    aria-label="Next month"
                                >
                                    <i class="bi bi-chevron-right"></i>
                                </button>

                            </div>


                            {{-- Weekdays --}}

                            <div class="calendar-weekdays">

                                <span>Sun</span>
                                <span>Mon</span>
                                <span>Tue</span>
                                <span>Wed</span>
                                <span>Thu</span>
                                <span>Fri</span>
                                <span>Sat</span>

                            </div>


                            {{-- Days --}}

                            <div
                                class="calendar-days"
                                id="calendarDays"
                            ></div>

                        </div>

                    </div>


                </div>

            </section>

        </div>

    </div>


    <style>

        /* =========================================================
           THEME VARIABLES
        ========================================================== */

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

            color: var(--dashboard-text);

            transition:
                color .25s ease,
                background-color .25s ease;
        }


        .dashboard-content {
            padding: 20px;
            color: var(--dashboard-text);
        }


        /* =========================================================
           STAT CARDS
        ========================================================== */

        .stat-card {

            background: var(--dashboard-card-bg);

            margin: 100px 0 20px;

            color: var(--dashboard-text);

            border-radius: 12px;

            box-shadow:
                var(--dashboard-card-shadow);

            transition:
                background-color .25s ease,
                color .25s ease,
                box-shadow .25s ease;
        }


        .stat-card-title {

            color: var(--dashboard-text-secondary);

            font-size: 14px;

            line-height: 1.35;

            font-weight: 600;
        }


        .stat-number {

            color: var(--dashboard-text);

            font-size: 28px;

            line-height: 1.2;

            font-weight: 700;
        }


        .stat-footer {

            color: var(--dashboard-text-muted);

            font-size: 12px;

            line-height: 1.4;

            font-weight: 500;
        }


        /* =========================================================
           LOWER GRID
        ========================================================== */

        .dashboard-lower-grid {

            display: grid;

            grid-template-columns:
                minmax(0, 1.65fr)
                minmax(280px, 0.75fr);

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

            background: var(--dashboard-card-bg);

            color: var(--dashboard-text);

            border-radius: 12px;

            padding: 22px;

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


        /* Calendar should fit its content */

        .calendar-card {

            min-height: auto;
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
           THESIS
        ========================================================== */

        .thesis-list {

            width: 100%;
        }


        .thesis-item {

            display: flex;

            align-items: center;

            gap: 13px;

            min-height: 58px;

            padding-left: 9px;
        }


        .thesis-item + .thesis-item {

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
           THESIS REQUESTS
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


        .request-item + .request-item {

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

            background: #2563eb;

            color: #ffffff;

            font-size: 11px;

            font-weight: 700;
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

            min-width: 64px;

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
           STUDENTS
        ========================================================== */

        .student-list {

            width: 100%;
        }


        .student-item {

            display: flex;

            align-items: center;

            gap: 11px;

            min-height: 53px;

            padding-left: 9px;
        }


        .student-item + .student-item {

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

            background: #2563eb;

            color: #ffffff;

            font-size: 10px;

            font-weight: 700;
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
           HODS
        ========================================================== */

        .hod-list {

            width: 100%;
        }


        .hod-item {

            display: flex;

            align-items: center;

            gap: 11px;

            min-height: 53px;

            padding: 10px;
        }


        .hod-item + .hod-item {

            border-top:
                1px solid var(--dashboard-divider);
        }


        .hod-avatar {

            width: 36px;

            height: 36px;

            min-width: 36px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #dc2626;

            color: #ffffff;

            font-size: 10px;

            font-weight: 700;
        }


        .hod-info {

            min-width: 0;

            flex: 1;
        }


        .hod-info strong {

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


        .hod-info span {

            display: block;

            overflow: hidden;

            color: var(--dashboard-text-muted);

            font-size: 11px;

            line-height: 1.4;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        /* =========================================================
           CALENDAR
        ========================================================== */

        .calendar-wrapper {

            width: 100%;
        }


        .calendar-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

            margin-bottom: 18px;
        }


        .calendar-month {

            flex: 1;

            color: var(--dashboard-text);

            font-size: 14px;

            line-height: 1.3;

            font-weight: 700;

            text-align: center;
        }


        .calendar-nav {

            width: 30px;

            height: 30px;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 0;

            border: 1px solid var(--dashboard-border-soft);

            border-radius: 7px;

            background: var(--dashboard-card-bg);

            color: var(--dashboard-text);

            cursor: pointer;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease;
        }


        .calendar-nav:hover {

            background: var(--dashboard-text);

            color: var(--dashboard-card-bg);

            border-color: var(--dashboard-text);
        }


        .calendar-nav i {

            font-size: 10px;
        }


        /* =========================================================
           CALENDAR WEEKDAYS
        ========================================================== */

        .calendar-weekdays {

            display: grid;

            grid-template-columns:
                repeat(7, 1fr);

            margin-bottom: 7px;
        }


        .calendar-weekdays span {

            color: var(--dashboard-text-muted);

            font-size: 9px;

            line-height: 1.2;

            font-weight: 700;

            text-align: center;
        }


        /* =========================================================
           CALENDAR DAYS
        ========================================================== */

        .calendar-days {

            display: grid;

            grid-template-columns:
                repeat(7, 1fr);

            gap: 4px;
        }


        .calendar-day {

            aspect-ratio: 1 / 1;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 7px;

            color: var(--dashboard-text-secondary);

            font-size: 11px;

            line-height: 1;

            font-weight: 500;

            transition:
                background-color .2s ease,
                color .2s ease;
        }


        .calendar-day.empty {

            visibility: hidden;
        }


        .calendar-day.today {

            background: var(--dashboard-text);

            color: var(--dashboard-card-bg);

            font-weight: 700;
        }


        .calendar-day:not(.empty):not(.today):hover {

            background: var(--dashboard-soft);

        }


        /* =========================================================
           EMPTY
        ========================================================== */

        .dashboard-empty {

            display: flex;

            align-items: center;

            justify-content: center;

            min-height: 140px;

            padding: 15px;

            text-align: center;

            color: var(--dashboard-text-muted);

            font-size: 12px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1000px) {

            .dashboard-lower-grid {

                grid-template-columns:
                    minmax(0, 1.5fr)
                    minmax(260px, 0.8fr);

                gap: 16px;
            }


            .dashboard-lower-main,
            .dashboard-lower-side {

                gap: 16px;
            }


            .dashboard-card {

                padding: 20px;
            }

        }


        @media (max-width: 800px) {

            .dashboard-lower-grid {

                grid-template-columns: 1fr;
            }


            .dashboard-lower-side {

                display: grid;

                grid-template-columns: 1fr 1fr;

                gap: 16px;
            }

        }


        @media (max-width: 600px) {

            .dashboard-lower-side {

                display: flex;

                flex-direction: column;
            }


            .dashboard-card {

                padding: 17px;

                min-height: auto;
            }


            .dashboard-card-header {

                margin-bottom: 14px;
            }


            .dashboard-card-header h3 {

                font-size: 16px;
            }


            .dashboard-section-label {

                font-size: 9px;
            }


            .view-all span {

                display: none;
            }


            .status-badge {

                display: none;
            }


            .thesis-item,
            .request-item {

                min-height: 52px;
            }


            .thesis-info strong,
            .request-title {

                font-size: 12px;
            }


            .thesis-info span,
            .request-name {

                font-size: 10px;
            }


            .student-info strong,
            .hod-info strong {

                font-size: 11px;
            }


            .student-info span,
            .hod-info span {

                font-size: 10px;
            }


            .calendar-month {

                font-size: 13px;
            }


            .calendar-day {

                font-size: 10px;
            }


            .calendar-weekdays span {

                font-size: 8px;
            }

        }

    </style>


    {{-- =============================================================
        CALENDAR JAVASCRIPT
    ============================================================= --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const calendarMonth =
                document.getElementById('calendarMonth');

            const calendarDays =
                document.getElementById('calendarDays');

            const calendarPrev =
                document.getElementById('calendarPrev');

            const calendarNext =
                document.getElementById('calendarNext');


            if (
                !calendarMonth ||
                !calendarDays ||
                !calendarPrev ||
                !calendarNext
            ) {
                return;
            }


            /*
             * Start with the current month.
             */
            let currentDate = new Date();


            /*
             * Render calendar.
             */
            function renderCalendar() {

                const year =
                    currentDate.getFullYear();

                const month =
                    currentDate.getMonth();


                /*
                 * Month name.
                 */
                const monthName =
                    currentDate.toLocaleString(
                        'default',
                        {
                            month: 'long'
                        }
                    );


                calendarMonth.textContent =
                    `${monthName} ${year}`;


                /*
                 * Clear previous days.
                 */
                calendarDays.innerHTML = '';


                /*
                 * First day of current month.
                 *
                 * 0 = Sunday
                 * 1 = Monday
                 * ...
                 * 6 = Saturday
                 */
                const firstDay =
                    new Date(
                        year,
                        month,
                        1
                    ).getDay();


                /*
                 * Number of days in current month.
                 */
                const daysInMonth =
                    new Date(
                        year,
                        month + 1,
                        0
                    ).getDate();


                /*
                 * Today's date.
                 */
                const today =
                    new Date();


                const todayYear =
                    today.getFullYear();

                const todayMonth =
                    today.getMonth();

                const todayDate =
                    today.getDate();


                /*
                 * Empty cells before day 1.
                 */
                for (
                    let i = 0;
                    i < firstDay;
                    i++
                ) {

                    const emptyDay =
                        document.createElement('div');

                    emptyDay.classList.add(
                        'calendar-day',
                        'empty'
                    );

                    calendarDays.appendChild(
                        emptyDay
                    );
                }


                /*
                 * Create every day.
                 */
                for (
                    let day = 1;
                    day <= daysInMonth;
                    day++
                ) {

                    const dayElement =
                        document.createElement('div');


                    dayElement.classList.add(
                        'calendar-day'
                    );


                    dayElement.textContent =
                        day;


                    /*
                     * Highlight today's date.
                     */
                    if (
                        year === todayYear &&
                        month === todayMonth &&
                        day === todayDate
                    ) {

                        dayElement.classList.add(
                            'today'
                        );

                    }


                    calendarDays.appendChild(
                        dayElement
                    );

                }

            }


            /*
             * Previous month.
             */
            calendarPrev.addEventListener(
                'click',
                function () {

                    currentDate.setMonth(
                        currentDate.getMonth() - 1
                    );

                    renderCalendar();

                }
            );


            /*
             * Next month.
             */
            calendarNext.addEventListener(
                'click',
                function () {

                    currentDate.setMonth(
                        currentDate.getMonth() + 1
                    );

                    renderCalendar();

                }
            );


            /*
             * Initial calendar render.
             */
            renderCalendar();

        });

    </script>

</x-app-layout>

