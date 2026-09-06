<x-app-layout>

    <div class="dashboard-page">

        <div class="dashboard-content">

            {{-- =================================================
                 STATISTICS
            ================================================== --}}
            <section class="dashboard-grid">

                {{-- PENDING REQUESTS --}}
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


                {{-- APPROVED THESIS --}}
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


                {{-- REJECTED REQUESTS --}}
                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon green">
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


                {{-- TOTAL THESIS --}}
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


                {{-- TOTAL STUDENTS --}}
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
                                {{ $studentsCount ?? ($authorsCount ?? 0) }}
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
                                <span class="dashboard-section-label"> DEPARTMENT </span>
                                <h3> Department Overview </h3>
                            </div>
                        </div>
                        {{-- DEPARTMENT --}}
                        <div class="hod-item">
                            <div class="hod-avatar">
                                <i class="bi bi-building"></i>
                            </div>

                            <div class="hod-info">
                                <strong>
                                    {{ $department->name ?? ($departmentName ?? 'Your Department') }} </strong>
                                <span> Current Department </span>
                            </div>
                        </div>

                        {{-- STUDENTS --}}
                        <div class="hod-item">
                            <div class="hod-avatar">
                                <i class="bi bi-people"></i>
                            </div>

                            <div class="hod-info">
                                <strong> {{ $studentsCount ?? ($authorsCount ?? 0) }} </strong>
                                <span> Department Students </span>
                            </div>
                        </div>

                        {{-- PUBLISHED THESIS --}}
                        <div class="hod-item">
                            <div class="hod-avatar"> 
                                <i class="bi bi-book"></i> 
                            </div>
                            <div class="hod-info"> 
                                <strong> {{ $publishedThesisCount ?? 0 }} </strong> <span> Published
                                    Thesis </span> </div>
                        </div> <a href="{{ route('hod.thesis.index') }}" class="view-all"> <span> View all thesis
                            </span> <i class="bi bi-chevron-right"></i> </a>
                    </div> {{-- RECENT THESIS REQUESTS --}} <div class="dashboard-card dashboard-row1-right">
                        <div class="dashboard-card-header">
                            <div> <span class="dashboard-section-label"> MANAGEMENT </span>
                                <h3> Recent Thesis Requests </h3>
                            </div> <a href="{{ route('hod.thesis_requests.index') }}" class="view-all"> <span> View all
                                </span> <i class="bi bi-chevron-right"></i> </a>
                        </div>
                        <div class="request-list">
                            @forelse($recentRequests ?? [] as $request)
                                <div class="request-item"> {{-- AVATAR --}} <div class="request-avatar">
                                        {{ strtoupper(substr($request->user?->username ?? 'U', 0, 2)) }} </div>
                                    {{-- REQUEST INFORMATION --}} <div class="request-info"> <strong class="request-title">
                                            {{ $request->thesis?->title ?? 'Untitled Thesis' }} </strong> <span
                                            class="request-name"> {{ $request->user?->username ?? 'Unknown Student' }}
                                        </span> </div> {{-- STATUS --}} @if ($request->is_approved === null)
                                        <span class="status-badge status-pending"> Pending </span>
                                    @elseif ($request->is_approved == 1)
                                        <span class="status-badge status-approved"> Approved </span>
                                    @else
                                        <span class="status-badge status-rejected"> Rejected </span>
                                    @endif
                            </div> @empty <div class="dashboard-empty"> <i class="bi bi-inbox"></i> <span> No thesis
                                        requests yet </span> </div>
                            @endforelse
                        </div>
                    </div>
                </div> {{-- ================================================= ROW 2 Recent Thesis 70% Recent Students 30% ================================================== --}} <div class="dashboard-lower-row dashboard-row-70-30">
                    {{-- RECENT THESIS --}} <div class="dashboard-card dashboard-row2-left">
                        <div class="dashboard-card-header">
                            <div> <span class="dashboard-section-label"> THESIS REPOSITORY </span>
                                <h3> Recent Thesis </h3>
                            </div> <a href="{{ route('hod.thesis.index') }}" class="view-all"> <span> View all </span>
                                <i class="bi bi-chevron-right"></i> </a>
                        </div>
                        <div class="thesis-list">
                            @forelse($recentTheses ?? [] as $thesis)
                                <div class="thesis-item"> {{-- THESIS ICON --}} <div class="thesis-avatar"> <i
                                            class="bi bi-journal-text"></i> </div> {{-- THESIS INFORMATION --}} <div
                                        class="thesis-info"> <strong> {{ $thesis->title ?? 'Untitled Thesis' }}
                                        </strong> <span>
                                            {{ $thesis->student?->full_name ?? ($thesis->author?->full_name ?? ($thesis->submittedBy?->username ?? 'Unknown Author')) }}
                                        </span> </div> {{-- STATUS --}} <span
                                    class="status-badge status-published"> Published </span> </div> @empty <div
                                    class="dashboard-empty"> <i class="bi bi-journal-x"></i> <span> No recent thesis.
                                    </span> </div>
                            @endforelse
                        </div>
                    </div> {{-- RECENT STUDENTS --}} <div class="dashboard-card dashboard-row2-right">
                        <div class="dashboard-card-header">
                            <div> <span class="dashboard-section-label"> STUDENTS </span>
                                <h3> Recent Students </h3>
                            </div>
                        </div>
                        <div class="student-list">
                            @forelse($recentStudents ?? [] as $student)
                                @php
                                    $studentName =
                                        $student->full_name ??
                                        ($student->user?->full_name ??
                                            ($student->user?->username ?? ($student->username ?? 'Unknown Student')));
                                    $studentEmail = $student->user?->email ?? ($student->email ?? null);
                                    $studentUsername = $student->user?->username ?? ($student->username ?? null);
                                @endphp <div class="student-item"> {{-- AVATAR --}} <div
                                        class="student-avatar"> {{ strtoupper(substr($studentName, 0, 2)) }} </div>
                                    {{-- STUDENT INFORMATION --}} <div class="student-info"> <strong> {{ $studentName }}
                                        </strong> <span>
                                            {{ $studentEmail ?? ($studentUsername ?? 'Department Student') }} </span>
                                    </div> {{-- ARROW --}} <i class="bi bi-chevron-right student-arrow"></i>
                            </div> @empty <div class="dashboard-empty"> <i class="bi bi-people"></i> <span> No
                                        students yet </span> </div>
                            @endforelse
                        </div>
                    </div>
                </div> {{-- ================================================= ROW 3 Quick Actions 30% Calendar 70% ================================================== --}} <div class="dashboard-lower-row dashboard-row-30-70">
                    {{-- QUICK ACTIONS --}} <div class="dashboard-card dashboard-row3-left">
                        <div class="dashboard-card-header">
                            <div> <span class="dashboard-section-label"> MANAGEMENT </span>
                                <h3> Quick Actions </h3>
                            </div>
                        </div> {{-- REVIEW REQUESTS --}} <a href="{{ route('hod.thesis_requests.index') }}"
                            class="hod-item quick-action">
                            <div class="hod-avatar"> <i class="bi bi-inbox"></i> </div>
                            <div class="hod-info"> <strong> Review Requests </strong> <span> Review pending thesis
                                    submissions </span> </div> <i class="bi bi-chevron-right"></i>
                        </a> {{-- MANAGE THESIS --}} <a href="{{ route('hod.thesis.index') }}"
                            class="hod-item quick-action">
                            <div class="hod-avatar"> <i class="bi bi-journal-text"></i> </div>
                            <div class="hod-info"> <strong> Manage Thesis </strong> <span> View department thesis
                                </span> </div> <i class="bi bi-chevron-right"></i>
                        </a> {{-- NOTIFICATIONS --}} <a href="{{ route('notifications.index') }}"
                            class="hod-item quick-action">
                            <div class="hod-avatar"> <i class="bi bi-bell"></i> </div>
                            <div class="hod-info"> <strong> Notifications </strong> <span> View recent notifications
                                </span> </div> <i class="bi bi-chevron-right"></i>
                        </a>
                    </div> {{-- CALENDAR --}} <div class="dashboard-card dashboard-row3-right calendar-card">
                        <div class="dashboard-card-header">
                            <div> <span class="dashboard-section-label"> SCHEDULE </span>
                                <h3> Calendar </h3>
                            </div>
                        </div>
                        <div class="calendar-wrapper"> {{-- CALENDAR HEADER --}} <div class="calendar-header"> <button
                                    type="button" class="calendar-nav" id="hodCalendarPrev"
                                    aria-label="Previous month"> <i class="bi bi-chevron-left"></i> </button>
                                <div class="calendar-month" id="hodCalendarMonth"></div> <button type="button"
                                    class="calendar-nav" id="hodCalendarNext" aria-label="Next month"> <i
                                        class="bi bi-chevron-right"></i> </button>
                            </div> {{-- WEEKDAYS --}} <div class="calendar-weekdays"> <span>Sun</span>
                                <span>Mon</span> <span>Tue</span> <span>Wed</span> <span>Thu</span> <span>Fri</span>
                                <span>Sat</span>
                            </div> {{-- DAYS --}} <div class="calendar-days" id="hodCalendarDays"></div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </div>


    <style>
        /* =========================================================
           THEME
        ========================================================== */

        :root {

            --dashboard-black: #000000;
            --dashboard-white: #ffffff;

            --dashboard-page-bg: #ffffff;
            --dashboard-card-bg: #ffffff;

            --dashboard-text: #000000;
            --dashboard-text-secondary: #333333;
            --dashboard-text-muted: #777777;

            --dashboard-border: #000000;
            --dashboard-border-soft: #dddddd;

            --dashboard-divider: #eeeeee;

            --dashboard-soft: #f7f7f7;

            --dashboard-card-shadow:
                0 2px 10px rgba(0, 0, 0, .05);
        }


        [data-bs-theme="dark"] {

            --dashboard-page-bg: #000000;
            --dashboard-card-bg: #000000;

            --dashboard-text: #ffffff;
            --dashboard-text-secondary: #dddddd;
            --dashboard-text-muted: #999999;

            --dashboard-border: #ffffff;
            --dashboard-border-soft: #333333;

            --dashboard-divider: #333333;

            --dashboard-soft: #111111;

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

            color: var(--dashboard-text);
        }


        .dashboard-main {

            width: 100%;
        }


        /* =========================================================
           STATISTICS GRID
        ========================================================== */

        .dashboard-grid {

            display: grid;

            grid-template-columns:
                repeat(5, minmax(0, 1fr));

            gap: 18px;

            width: 100%;

            margin-bottom: 20px;
        }


        /* =========================================================
           STAT CARDS
        ========================================================== */

        .stat-card {

            min-width: 0;

            padding: 20px;

            background: var(--dashboard-card-bg);

            color: var(--dashboard-text);

            border-radius: 12px;

            box-shadow:
                var(--dashboard-card-shadow);

            transition:
                background-color .25s ease,
                color .25s ease;
        }


        .stat-card-top {

            display: flex;

            align-items: center;

            gap: 13px;
        }


        .stat-icon {

            width: 40px;
            height: 40px;

            min-width: 40px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 10px;

            font-size: 17px;
        }


        .stat-icon.purple {

            background: #f1edff;
            color: #6538d9;
        }


        .stat-icon.blue {

            background: #eff6ff;
            color: #2563eb;
        }


        .stat-icon.green {

            background: #ecfdf3;
            color: #15803d;
        }


        .stat-icon.orange {

            background: #fff7ed;
            color: #ea580c;
        }


        .stat-card-title {

            color: var(--dashboard-text-secondary);

            font-size: 14px;

            font-weight: 600;
        }


        .stat-number {

            color: var(--dashboard-text);

            font-size: 28px;

            font-weight: 700;
        }


        .stat-footer {

            margin-top: 16px;

            color: var(--dashboard-text-muted);

            font-size: 12px;

            font-weight: 500;
        }


        /* =========================================================
           LOWER DASHBOARD GRID

           ROW 1:
           Department Overview 30%
           Recent Thesis Requests 70%

           ROW 2:
           Recent Thesis
           Recent Students

           ROW 3:
           Quick Actions
           Calendar
        ========================================================== */

        /* ========================================================= LOWER DASHBOARD ========================================================= */
        .dashboard-lower-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
        }

        /* ========================================================= EACH ROW HAS ITS OWN GRID ========================================================= */
        .dashboard-lower-row {
            display: grid;
            width: 100%;
            gap: 20px;
            align-items: stretch;
        }

        /* ========================================================= 30% LEFT / 70% RIGHT Row 1: Department Overview = 30% Recent Thesis Requests = 70% Row 3: Quick Actions = 30% Calendar = 70% ========================================================= */
        .dashboard-row-30-70 {
            grid-template-columns: minmax(0, 3fr) minmax(0, 7fr);
        }

        /* ========================================================= 70% LEFT / 30% RIGHT Row 2: Recent Thesis = 70% Recent Students = 30% ========================================================= */
        .dashboard-row-70-30 {
            grid-template-columns: minmax(0, 7fr) minmax(0, 3fr);
        }

        /* ========================================================= CARDS ========================================================= */
        .dashboard-lower-row>.dashboard-card {
            width: 100%;
            min-width: 0;
            box-sizing: border-box;
        }

        /* ========================================================= TABLET ========================================================= */
        @media (max-width: 1000px) {
            .dashboard-lower-grid {
                gap: 16px;
            }

            .dashboard-lower-row {
                gap: 16px;
            }
        }

        /* ========================================================= MOBILE ========================================================= */
        @media (max-width: 800px) {
            .dashboard-lower-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        /* ========================================================= SMALL MOBILE ========================================================= */
        @media (max-width: 600px) {
            .dashboard-lower-grid {
                gap: 16px;
            }

            .dashboard-lower-row {
                gap: 16px;
            }
        }

        /* =========================================================
           CARDS
        ========================================================== */

        .dashboard-card {

            width: 100%;

            min-width: 0;

            box-sizing: border-box;

            padding: 22px;

            background: var(--dashboard-card-bg);

            color: var(--dashboard-text);

            border-radius: 12px;

            box-shadow:
                var(--dashboard-card-shadow);

            transition:
                background-color .25s ease,
                color .25s ease;
        }


        .dashboard-row1-left,
        .dashboard-row1-right,
        .dashboard-row2-left,
        .dashboard-row2-right,
        .dashboard-row3-left,
        .dashboard-row3-right {

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

            font-weight: 700;

            letter-spacing: 1px;

            text-transform: uppercase;
        }


        .dashboard-card-header h3 {

            margin: 0;

            color: var(--dashboard-text);

            font-size: 18px;

            font-weight: 700;
        }


        /* =========================================================
           VIEW ALL
        ========================================================== */

        .view-all {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            flex-shrink: 0;

            color: var(--dashboard-text-muted);

            font-size: 12px;

            font-weight: 500;

            text-decoration: none;

            transition:
                color .2s ease;
        }


        .view-all:hover {

            color: var(--dashboard-text);
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

            font-weight: 600;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        .request-name {

            display: block;

            overflow: hidden;

            color: var(--dashboard-text-muted);

            font-size: 12px;

            white-space: nowrap;

            text-overflow: ellipsis;
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

            font-weight: 600;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        .thesis-info span {

            display: block;

            overflow: hidden;

            color: var(--dashboard-text-muted);

            font-size: 12px;

            white-space: nowrap;

            text-overflow: ellipsis;
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

            gap: 13px;

            min-height: 58px;

            padding: 9px 0;

            transition:
                background-color .2s ease;
        }


        .student-item+.student-item {

            border-top:
                1px solid var(--dashboard-divider);
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

            color: var(--dashboard-text);

            font-size: 11px;

            font-weight: 700;

            border:
                1px solid var(--dashboard-border-soft);
        }


        .student-info {

            min-width: 0;

            flex: 1;
        }


        .student-info strong {

            display: block;

            overflow: hidden;

            margin-bottom: 4px;

            color: var(--dashboard-text);

            font-size: 14px;

            font-weight: 600;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        .student-info span {

            display: block;

            overflow: hidden;

            color: var(--dashboard-text-muted);

            font-size: 12px;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        .student-arrow {

            flex-shrink: 0;

            color: var(--dashboard-text-muted);

            font-size: 11px;
        }


        /* =========================================================
           HOD / DEPARTMENT ITEMS
        ========================================================== */

        .hod-item {

            display: flex;

            align-items: center;

            gap: 11px;

            min-height: 58px;

            padding: 10px 0;
        }


        .hod-item+.hod-item {

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

            background: var(--dashboard-soft);

            color: var(--dashboard-text);

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

            font-weight: 600;

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


        /* =========================================================
           QUICK ACTIONS
        ========================================================== */

        .quick-action {

            color: var(--dashboard-text);

            text-decoration: none;

            transition:
                background-color .2s ease;
        }


        .quick-action:hover {

            background: var(--dashboard-soft);
        }


        .quick-action>i.bi-chevron-right {

            color: var(--dashboard-text-muted);

            font-size: 12px;
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
           CALENDAR
        ========================================================== */

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

            width: 30px;
            height: 30px;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 0;

            border:
                1px solid var(--dashboard-border-soft);

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


        .calendar-weekdays {

            display: grid;

            grid-template-columns:
                repeat(7, 1fr);

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

            gap: 8px;

            min-height: 120px;

            padding: 15px;

            text-align: center;

            color: var(--dashboard-text-muted);

            font-size: 12px;
        }


        .dashboard-empty i {

            font-size: 16px;
        }


        /* =========================================================
           RESPONSIVE — LARGE TABLET
        ========================================================== */

        @media (max-width: 1200px) {

            .dashboard-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }

        }


        /* =========================================================
           RESPONSIVE — TABLET
        ========================================================== */

        @media (max-width: 1000px) {

            /*
             * Keep the same 30% / 70% ratio
             * while reducing the gap.
             */
            .dashboard-lower-grid {

                grid-template-columns:
                    minmax(0, 3fr) minmax(0, 7fr);

                gap: 16px;
            }


            .dashboard-card {

                padding: 20px;
            }

        }


        /* =========================================================
           RESPONSIVE — SMALL TABLET
        ========================================================== */

        @media (max-width: 800px) {

            .dashboard-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }


            /*
             * On small screens, stack all cards
             * into one column.
             */
            .dashboard-lower-grid {

                grid-template-columns: 1fr;

                grid-template-areas:

                    "department"

                    "requests"

                    "thesis"

                    "students"

                    "actions"

                    "calendar";

                gap: 16px;
            }


            .dashboard-row1-left,
            .dashboard-row1-right,
            .dashboard-row2-left,
            .dashboard-row2-right,
            .dashboard-row3-left,
            .dashboard-row3-right {

                min-height: auto;
            }

        }


        /* =========================================================
           RESPONSIVE — MOBILE
        ========================================================== */

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


    {{-- =============================================================
         HOD CALENDAR JAVASCRIPT
    ============================================================= --}}
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


            /*
             * Stop if calendar elements do not exist.
             */
            if (
                !calendarMonth ||
                !calendarDays ||
                !calendarPrev ||
                !calendarNext
            ) {
                return;
            }


            /*
             * Current calendar month.
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
                        'default', {
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
                 * First day of month.
                 *
                 * Sunday = 0
                 * Monday = 1
                 * ...
                 * Saturday = 6
                 */
                const firstDay =
                    new Date(
                        year,
                        month,
                        1
                    ).getDay();


                /*
                 * Number of days in month.
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
                const today = new Date();

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


                /*
                 * Create calendar days.
                 */
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


                    /*
                     * Highlight today.
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
                function() {

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
                function() {

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
