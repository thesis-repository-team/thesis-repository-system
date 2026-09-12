<x-app-layout>

    <div class="dashboard-page">

        <div class="dashboard-content">

            <section class="dashboard-grid">

                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon purple">
                            <i class="bi bi-hourglass-split"></i>
                        </div>

                        <div>
                            <div class="stat-card-title">
                                Pending Requests
                            </div>

                            <div class="stat-number">
                                {{ $pendingRequestsCount ?? 0 }}
                            </div>
                        </div>
                    </div>

                    <div class="stat-footer">
                        Waiting for review
                    </div>
                </div>


                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon blue">
                            <i class="bi bi-check-circle"></i>
                        </div>

                        <div>
                            <div class="stat-card-title">
                                Approved Thesis
                            </div>

                            <div class="stat-number">
                                {{ $approvedThesisCount ?? 0 }}
                            </div>
                        </div>
                    </div>

                    <div class="stat-footer">
                        Approved submissions
                    </div>
                </div>


                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon red">
                            <i class="bi bi-x-circle"></i>
                        </div>

                        <div>
                            <div class="stat-card-title">
                                Rejected
                            </div>

                            <div class="stat-number">
                                {{ $rejectedRequestsCount ?? 0 }}
                            </div>
                        </div>
                    </div>

                    <div class="stat-footer">
                        Rejected requests
                    </div>
                </div>


                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon orange">
                            <i class="bi bi-journal-bookmark"></i>
                        </div>

                        <div>
                            <div class="stat-card-title">
                                Total Thesis
                            </div>

                            <div class="stat-number">
                                {{ $thesesCount ?? 0 }}
                            </div>
                        </div>
                    </div>

                    <div class="stat-footer">
                        Your department
                    </div>
                </div>


                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon purple">
                            <i class="bi bi-people"></i>
                        </div>

                        <div>
                            <div class="stat-card-title">
                                Total Students
                            </div>

                            <div class="stat-number">
                                {{ $studentsCount ?? 0 }}
                            </div>
                        </div>
                    </div>

                    <div class="stat-footer">
                        Department students
                    </div>
                </div>

            </section>


            <section class="dashboard-lower-grid">

                <div class="dashboard-lower-row dashboard-row-30-70">

                    <div class="dashboard-card dashboard-row1-left">

                        <div class="dashboard-card-header">
                            <div>
                                <span class="dashboard-section-label">
                                    DEPARTMENT
                                </span>

                                <h3>
                                    Department Overview
                                </h3>
                            </div>
                        </div>


                        <div class="hod-item">
                            <div class="hod-avatar">
                                <i class="bi bi-building"></i>
                            </div>

                            <div class="hod-info">
                                <strong>
                                    {{ $department->name ?? 'Your Department' }}
                                </strong>

                                <span>
                                    Current Department
                                </span>
                            </div>
                        </div>


                        <div class="hod-item">
                            <div class="hod-avatar">
                                <i class="bi bi-people"></i>
                            </div>

                            <div class="hod-info">
                                <strong>
                                    {{ $studentsCount ?? 0 }}
                                </strong>

                                <span>
                                    Department Students
                                </span>
                            </div>
                        </div>


                        <div class="hod-item">
                            <div class="hod-avatar">
                                <i class="bi bi-book"></i>
                            </div>

                            <div class="hod-info">
                                <strong>
                                    {{ $publishedThesisCount ?? 0 }}
                                </strong>

                                <span>
                                    Published Thesis
                                </span>
                            </div>
                        </div>


                        <a href="{{ route('hod.thesis.index') }}" class="view-all">
                            <span>
                                View all thesis
                            </span>

                            <i class="bi bi-chevron-right"></i>
                        </a>

                    </div>


                    <div class="dashboard-card dashboard-row1-right">

                        <div class="dashboard-card-header">

                            <div>
                                <span class="dashboard-section-label">
                                    MANAGEMENT
                                </span>

                                <h3>
                                    Recent Thesis Requests
                                </h3>
                            </div>

                            <a href="{{ route('hod.thesis_requests.index') }}" class="view-all">
                                <span>
                                    View all
                                </span>

                                <i class="bi bi-chevron-right"></i>
                            </a>

                        </div>


                        <div class="request-list">

                            @forelse($recentRequests ?? [] as $request)
                                <div class="request-item">

                                    <div class="request-avatar">
                                        {{ strtoupper(substr($request->user?->username ?? 'U', 0, 2)) }}
                                    </div>


                                    <div class="request-info">

                                        <strong class="request-title">
                                            {{ $request->title ?? ($request->thesis?->title ?? 'Untitled Thesis') }}
                                        </strong>

                                        <span class="request-name">
                                            {{ $request->user?->username ?? 'Unknown Student' }}
                                        </span>

                                    </div>


                                    @if ($request->status === 'pending')
                                        <span class="status-badge status-pending">
                                            Pending
                                        </span>
                                    @elseif ($request->status === 'approved')
                                        <span class="status-badge status-approved">
                                            Approved
                                        </span>
                                    @elseif ($request->status === 'rejected')
                                        <span class="status-badge status-rejected">
                                            Rejected
                                        </span>
                                    @else
                                        <span class="status-badge status-pending">
                                            Unknown
                                        </span>
                                    @endif

                                </div>

                            @empty

                                <div class="dashboard-empty">
                                    <i class="bi bi-inbox"></i>

                                    <span>
                                        No thesis requests yet
                                    </span>
                                </div>
                            @endforelse

                        </div>

                    </div>

                </div>


                <div class="dashboard-lower-row dashboard-row-55-45">

                    <div class="dashboard-card dashboard-row2-left">

                        <div class="dashboard-card-header">

                            <div>
                                <span class="dashboard-section-label">
                                    THESIS REPOSITORY
                                </span>

                                <h3>
                                    Recent Thesis
                                </h3>
                            </div>

                            <a href="{{ route('hod.thesis.index') }}" class="view-all">
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
                                            {{ $thesis->submittedBy?->username ?? ($thesis->author_name ?? 'Unknown Author') }}
                                        </span>

                                    </div>


                                    <span class="status-badge status-published">
                                        Published
                                    </span>

                                </div>

                            @empty

                                <div class="dashboard-empty">
                                    <i class="bi bi-journal-x"></i>

                                    <span>
                                        No recent thesis.
                                    </span>
                                </div>
                            @endforelse

                        </div>

                    </div>


                    <div class="dashboard-card dashboard-row2-right">

                        <div class="dashboard-card-header">

                            <div>
                                <span class="dashboard-section-label">
                                    STUDENTS
                                </span>

                                <h3>
                                    Recent Students
                                </h3>
                            </div>

                        </div>


                        <div class="student-list">

                            @forelse($recentStudents ?? [] as $student)
                                @php
                                    $studentName =
                                        $student->full_name ?? ($student->user?->username ?? 'Unknown Student');

                                    $studentEmail = $student->user?->email ?? null;
                                @endphp


                                <div class="student-item">

                                    <div class="student-avatar">
                                        {{ strtoupper(substr($studentName, 0, 2)) }}
                                    </div>


                                    <div class="student-info">

                                        <strong>
                                            {{ $studentName }}
                                        </strong>

                                        <span>
                                            {{ $studentEmail ?? 'Department Student' }}
                                        </span>

                                    </div>


                                    <i class="bi bi-chevron-right student-arrow"></i>

                                </div>

                            @empty

                                <div class="dashboard-empty">
                                    <i class="bi bi-people"></i>

                                    <span>
                                        No students yet
                                    </span>
                                </div>
                            @endforelse

                        </div>

                    </div>

                </div>


                <div class="dashboard-lower-row dashboard-row-60-40">

                    <div class="dashboard-card dashboard-row3-left calendar-card">

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

                            <div class="calendar-header">

                                <button type="button" class="calendar-nav" id="hodCalendarPrev"
                                    aria-label="Previous month">
                                    <i class="bi bi-chevron-left"></i>
                                </button>


                                <div class="calendar-month" id="hodCalendarMonth"></div>


                                <button type="button" class="calendar-nav" id="hodCalendarNext"
                                    aria-label="Next month">
                                    <i class="bi bi-chevron-right"></i>
                                </button>

                            </div>


                            <div class="calendar-weekdays">
                                <span>Sun</span>
                                <span>Mon</span>
                                <span>Tue</span>
                                <span>Wed</span>
                                <span>Thu</span>
                                <span>Fri</span>
                                <span>Sat</span>
                            </div>


                            <div class="calendar-days" id="hodCalendarDays"></div>

                        </div>

                    </div>


                    <div class="dashboard-card dashboard-row3-right">

                        <div class="dashboard-card-header">

                            <div>
                                <span class="dashboard-section-label">
                                    MANAGEMENT
                                </span>

                                <h3>
                                    Quick Actions
                                </h3>
                            </div>

                        </div>


                        <a href="{{ route('hod.thesis_requests.index') }}" class="hod-item quick-action">

                            <div class="hod-avatar">
                                <i class="bi bi-inbox"></i>
                            </div>

                            <div class="hod-info">

                                <strong>
                                    Review Requests
                                </strong>

                                <span>
                                    Review pending thesis submissions
                                </span>

                            </div>

                            <i class="bi bi-chevron-right"></i>

                        </a>


                        <a href="{{ route('hod.thesis.index') }}" class="hod-item quick-action">

                            <div class="hod-avatar">
                                <i class="bi bi-journal-text"></i>
                            </div>

                            <div class="hod-info">

                                <strong>
                                    Manage Thesis
                                </strong>

                                <span>
                                    View department thesis
                                </span>

                            </div>

                            <i class="bi bi-chevron-right"></i>

                        </a>


                        <a href="{{ route('notifications.index') }}" class="hod-item quick-action">

                            <div class="hod-avatar">
                                <i class="bi bi-bell"></i>
                            </div>

                            <div class="hod-info">

                                <strong>
                                    Notifications
                                </strong>

                                <span>
                                    View recent notifications
                                </span>

                            </div>

                            <i class="bi bi-chevron-right"></i>

                        </a>

                    </div>

                </div>

            </section>

        </div>

    </div>


    <style>
        :root {
            --dashboard-black: #111111;
            --dashboard-white: #ffffff;
            --dashboard-page-bg: #f6f7fb;
            --dashboard-card-bg: #ffffff;
            --dashboard-text: #171717;
            --dashboard-text-secondary: #4b5563;
            --dashboard-text-muted: #8a8f9b;
            --dashboard-border: #e5e7eb;
            --dashboard-border-soft: #e8eaf0;
            --dashboard-divider: #eeeeF2;
            --dashboard-soft: #f5f3ff;
            --dashboard-purple: #6538d9;
            --dashboard-purple-dark: #5428c7;
            --dashboard-purple-soft: #f1edff;
            --dashboard-blue: #2563eb;
            --dashboard-blue-soft: #eff6ff;
            --dashboard-green: #15803d;
            --dashboard-green-soft: #ecfdf3;
            --dashboard-orange: #ea580c;
            --dashboard-orange-soft: #fff7ed;
            --dashboard-red: #dc2626;
            --dashboard-red-soft: #fef2f2;
            --dashboard-card-shadow: 0 4px 18px rgba(20, 24, 40, .06);
            --dashboard-card-shadow-hover: 0 8px 25px rgba(20, 24, 40, .09);
        }


        [data-bs-theme="dark"] {
            --dashboard-black: #ffffff;
            --dashboard-white: #111525;
            --dashboard-page-bg: #0f1322;
            --dashboard-card-bg: #181d31;
            --dashboard-text: #f4f5fb;
            --dashboard-text-secondary: #c8ccda;
            --dashboard-text-muted: #9298ad;
            --dashboard-border: #292f45;
            --dashboard-border-soft: #292f45;
            --dashboard-divider: #292f45;
            --dashboard-soft: #222741;
            --dashboard-purple: #8b6cf2;
            --dashboard-purple-dark: #9a7df5;
            --dashboard-purple-soft: #292344;
            --dashboard-blue: #5d8df5;
            --dashboard-blue-soft: #202b4a;
            --dashboard-green: #4ade80;
            --dashboard-green-soft: #173526;
            --dashboard-orange: #fb923c;
            --dashboard-orange-soft: #3b291d;
            --dashboard-red: #f87171;
            --dashboard-red-soft: #3a2025;
            --dashboard-card-shadow: 0 5px 20px rgba(0, 0, 0, .28);
            --dashboard-card-shadow-hover: 0 10px 30px rgba(0, 0, 0, .35);
        }


        .dashboard-page {
            min-height: 100vh;
            color: var(--dashboard-text);
            background: var(--dashboard-page-bg);
            transition: color .25s ease, background-color .25s ease;
        }


        .dashboard-content {
            color: var(--dashboard-text);
        }


        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 18px;
            width: 100%;
            margin-bottom: 20px;
        }


        .stat-card {
            min-width: 0;
            padding: 20px;
            background: var(--dashboard-card-bg);
            color: var(--dashboard-text);
            border: 1px solid var(--dashboard-border);
            border-radius: 14px;
            box-shadow: var(--dashboard-card-shadow);
            transition:
                background-color .25s ease,
                color .25s ease,
                border-color .25s ease,
                box-shadow .25s ease,
                transform .2s ease;
        }


        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--dashboard-card-shadow-hover);
        }


        .stat-card-top {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 15px;
        }


        .stat-card-title {
            color: var(--dashboard-text-secondary);
            font-size: 14px;
            font-weight: 600;
        }


        .stat-number {
            color: var(--dashboard-text);
            font-size: 29px;
            line-height: 1.15;
            font-weight: 750;
        }


        .stat-footer {
            color: var(--dashboard-text-muted);
            font-size: 12px;
            font-weight: 500;
        }


        .stat-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            font-size: 17px;
        }


        .stat-icon.purple {
            background: var(--dashboard-purple-soft);
            color: var(--dashboard-purple);
        }


        .stat-icon.blue {
            background: var(--dashboard-blue-soft);
            color: var(--dashboard-blue);
        }


        .stat-icon.green {
            background: var(--dashboard-green-soft);
            color: var(--dashboard-green);
        }


        .stat-icon.orange {
            background: var(--dashboard-orange-soft);
            color: var(--dashboard-orange);
        }


        .stat-icon.red {
            background: var(--dashboard-red-soft);
            color: var(--dashboard-red);
        }


        .dashboard-lower-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
        }


        .dashboard-lower-row {
            display: grid;
            width: 100%;
            gap: 20px;
            align-items: stretch;
        }


        .dashboard-row-30-70 {
            grid-template-columns:
                minmax(0, 3fr) minmax(0, 7fr);
        }


        .dashboard-row-55-45 {
            grid-template-columns:
                minmax(0, 5.5fr) minmax(0, 4.5fr);
        }


        .dashboard-row-60-40 {
            grid-template-columns:
                minmax(0, 6fr) minmax(0, 4fr);
        }


        .dashboard-card {
            width: 100%;
            min-width: 0;
            box-sizing: border-box;
            padding: 22px;
            background: var(--dashboard-card-bg);
            color: var(--dashboard-text);
            border: 1px solid var(--dashboard-border);
            border-radius: 14px;
            box-shadow: var(--dashboard-card-shadow);
            transition:
                background-color .25s ease,
                color .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }


        .dashboard-card:hover {
            box-shadow: var(--dashboard-card-shadow-hover);
        }


        .dashboard-row1-left,
        .dashboard-row1-right,
        .dashboard-row2-left,
        .dashboard-row2-right,
        .dashboard-row3-left,
        .dashboard-row3-right {
            min-height: 270px;
        }


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
            color: var(--dashboard-purple);
            font-size: 10px;
            font-weight: 750;
            letter-spacing: 1.1px;
            text-transform: uppercase;
        }


        .dashboard-card-header h3 {
            margin: 0;
            color: var(--dashboard-text);
            font-size: 18px;
            font-weight: 700;
        }


        .view-all {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
            color: var(--dashboard-text-muted);
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: color .2s ease;
        }


        .view-all:hover {
            color: var(--dashboard-purple);
        }


        .request-list,
        .thesis-list,
        .student-list {
            width: 100%;
        }


        .request-item,
        .thesis-item,
        .student-item {
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 58px;
            padding: 9px 0;
        }


        .request-item+.request-item,
        .thesis-item+.thesis-item,
        .student-item+.student-item {
            border-top: 1px solid var(--dashboard-divider);
        }


        .request-avatar {
            width: 38px;
            height: 38px;
            min-width: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--dashboard-blue);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
        }


        .request-info,
        .thesis-info,
        .student-info {
            min-width: 0;
            flex: 1;
        }


        .request-title,
        .thesis-info strong,
        .student-info strong {
            display: block;
            overflow: hidden;
            margin-bottom: 4px;
            color: var(--dashboard-text);
            font-size: 14px;
            font-weight: 650;
            white-space: nowrap;
            text-overflow: ellipsis;
        }


        .request-name,
        .thesis-info span,
        .student-info span {
            display: block;
            overflow: hidden;
            color: var(--dashboard-text-muted);
            font-size: 12px;
            white-space: nowrap;
            text-overflow: ellipsis;
        }


        .thesis-avatar {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--dashboard-purple-soft);
            color: var(--dashboard-purple);
            font-size: 15px;
        }


        .student-avatar {
            width: 38px;
            height: 38px;
            min-width: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--dashboard-soft);
            color: var(--dashboard-purple);
            font-size: 11px;
            font-weight: 700;
            border: 1px solid var(--dashboard-border-soft);
        }


        .student-arrow {
            flex-shrink: 0;
            color: var(--dashboard-text-muted);
            font-size: 11px;
        }


        .hod-item {
            display: flex;
            align-items: center;
            gap: 11px;
            min-height: 58px;
            padding: 10px 0;
        }


        .hod-item+.hod-item {
            border-top: 1px solid var(--dashboard-divider);
        }


        .hod-avatar {
            width: 38px;
            height: 38px;
            min-width: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--dashboard-soft);
            color: var(--dashboard-purple);
            font-size: 14px;
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
            font-weight: 650;
            white-space: nowrap;
            text-overflow: ellipsis;
        }


        .hod-info span {
            display: block;
            overflow: hidden;
            color: var(--dashboard-text-muted);
            font-size: 11px;
            white-space: nowrap;
            text-overflow: ellipsis;
        }


        .quick-action {
            color: var(--dashboard-text);
            text-decoration: none;
            border-radius: 9px;
            transition:
                background-color .2s ease,
                padding-left .2s ease;
        }


        .quick-action:hover {
            padding-left: 7px;
            background: var(--dashboard-soft);
        }


        .quick-action>i.bi-chevron-right {
            color: var(--dashboard-text-muted);
            font-size: 12px;
            transition:
                color .2s ease,
                transform .2s ease;
        }


        .quick-action:hover>i.bi-chevron-right {
            color: var(--dashboard-purple);
            transform: translateX(2px);
        }


        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            min-width: 68px;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 10px;
            font-weight: 650;
            white-space: nowrap;
        }


        .status-published,
        .status-approved {
            background: var(--dashboard-green-soft);
            color: var(--dashboard-green);
        }


        .status-pending {
            background: var(--dashboard-blue-soft);
            color: var(--dashboard-blue);
        }


        .status-rejected {
            background: var(--dashboard-red-soft);
            color: var(--dashboard-red);
        }


        .calendar-card {
            min-height: 270px;
        }


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
            font-weight: 700;
            text-align: center;
        }


        .calendar-nav {
            width: 31px;
            height: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: 1px solid var(--dashboard-border);
            border-radius: 8px;
            background: var(--dashboard-card-bg);
            color: var(--dashboard-text-secondary);
            cursor: pointer;
            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease;
        }


        .calendar-nav:hover {
            background: var(--dashboard-purple);
            color: #ffffff;
            border-color: var(--dashboard-purple);
        }


        .calendar-nav i {
            font-size: 10px;
        }


        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            margin-bottom: 7px;
        }


        .calendar-weekdays span {
            color: var(--dashboard-text-muted);
            font-size: 9px;
            font-weight: 700;
            text-align: center;
        }


        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
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
            font-weight: 500;
            transition:
                background-color .2s ease,
                color .2s ease;
        }


        .calendar-day.empty {
            visibility: hidden;
        }


        .calendar-day.today {
            background: var(--dashboard-purple);
            color: #ffffff;
            font-weight: 700;
            box-shadow:
                0 3px 8px rgba(101, 56, 217, .25);
        }


        .calendar-day:not(.empty):not(.today):hover {
            background: var(--dashboard-purple-soft);
            color: var(--dashboard-purple);
        }


        .dashboard-empty {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 120px;
            padding: 15px;
            text-align: center;
            color: var(--dashboard-text-muted);
            font-size: 12px;
        }


        .dashboard-empty i {
            color: var(--dashboard-purple);
            font-size: 16px;
        }


        @media (max-width: 1200px) {

            .dashboard-grid {
                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }

        }


        @media (max-width: 1000px) {

            .dashboard-card {
                padding: 20px;
            }

        }


        @media (max-width: 800px) {

            .dashboard-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }


            .dashboard-lower-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }

        }


        @media (max-width: 600px) {

            .dashboard-grid {
                grid-template-columns: 1fr;
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


            .status-badge {
                display: none;
            }


            .view-all span {
                display: none;
            }


            .request-item,
            .thesis-item,
            .student-item {
                min-height: 52px;
            }


            .request-title,
            .thesis-info strong,
            .student-info strong {
                font-size: 12px;
            }


            .request-name,
            .thesis-info span,
            .student-info span {
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const calendarMonth =
                document.getElementById('hodCalendarMonth');

            const calendarDays =
                document.getElementById('hodCalendarDays');

            const calendarPrev =
                document.getElementById('hodCalendarPrev');

            const calendarNext =
                document.getElementById('hodCalendarNext');


            if (
                !calendarMonth ||
                !calendarDays ||
                !calendarPrev ||
                !calendarNext
            ) {
                return;
            }


            let currentDate = new Date();


            function renderCalendar() {

                const year =
                    currentDate.getFullYear();

                const month =
                    currentDate.getMonth();


                const monthName =
                    currentDate.toLocaleString(
                        'default', {
                            month: 'long'
                        }
                    );


                calendarMonth.textContent =
                    `${monthName} ${year}`;


                calendarDays.innerHTML = '';


                const firstDay =
                    new Date(
                        year,
                        month,
                        1
                    ).getDay();


                const daysInMonth =
                    new Date(
                        year,
                        month + 1,
                        0
                    ).getDate();


                const today = new Date();


                const todayYear =
                    today.getFullYear();

                const todayMonth =
                    today.getMonth();

                const todayDate =
                    today.getDate();


                for (
                    let i = 0; i < firstDay; i++
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


                for (
                    let day = 1; day <= daysInMonth; day++
                ) {

                    const dayElement =
                        document.createElement('div');


                    dayElement.classList.add(
                        'calendar-day'
                    );


                    dayElement.textContent =
                        day;


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


            calendarPrev.addEventListener(
                'click',
                function() {

                    currentDate.setMonth(
                        currentDate.getMonth() - 1
                    );

                    renderCalendar();

                }
            );


            calendarNext.addEventListener(
                'click',
                function() {

                    currentDate.setMonth(
                        currentDate.getMonth() + 1
                    );

                    renderCalendar();

                }
            );


            renderCalendar();

        });
    </script>


</x-app-layout>
