<x-app-layout>

    <div class="dashboard-content">

        <main class="dashboard-main">

            {{-- =================================================
                 HERO
            ================================================== --}}
            <section class="dashboard-hero">

                <div class="hero-content">

                    <span class="hod-hero-label">
                        HEAD OF DEPARTMENT
                    </span>

                    <h1 class="hod-hero-title">
                        {{ $departmentName ?? 'Your Department' }}
                    </h1>

                    <p class="hod-hero-description">
                        Manage your department's thesis submissions,
                        students, and academic repository.
                    </p>

                    <div class="hod-hero-actions">

                        <a href="{{ route('hod.thesis.index') }}" class="hero-button">
    
                            View Thesis
    
                        </a>
                    </div>


                </div>


                <div class="hero-image">

                    <i class="bi bi-mortarboard-fill"></i>

                </div>

            </section>


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

            </section>


            {{-- =================================================
                 LOWER CONTENT
            ================================================== --}}
            <section class="dashboard-lower-grid">


                {{-- =================================================
                     LEFT COLUMN
                ================================================== --}}
                <div>


                    {{-- =================================================
                         THESIS REQUEST CHART
                    ================================================== --}}
                    <div class="dashboard-card">

                        <div class="dashboard-card-header">

                            <h3>
                                Thesis Requests Overview
                            </h3>

                            <select class="dashboard-select">
                                <option>
                                    This Month
                                </option>

                                <option>
                                    This Year
                                </option>
                            </select>

                        </div>


                        <div class="chart-container">

                            <div class="chart">

                                <svg viewBox="0 0 700 250" preserveAspectRatio="none">

                                    {{-- GRID --}}

                                    <line x1="50" y1="30" x2="680" y2="30"
                                        stroke="#eeeeF4" />

                                    <line x1="50" y1="80" x2="680" y2="80"
                                        stroke="#eeeeF4" />

                                    <line x1="50" y1="130" x2="680" y2="130"
                                        stroke="#eeeeF4" />

                                    <line x1="50" y1="180" x2="680" y2="180"
                                        stroke="#eeeeF4" />


                                    {{-- AREA --}}

                                    <path d="
                                        M50 175
                                        L200 130
                                        L350 90
                                        L500 65
                                        L680 115
                                        L680 210
                                        L50 210
                                        Z
                                        " fill="#eee8ff" opacity="0.8" />


                                    {{-- LINE --}}

                                    <polyline
                                        points="
                                        50,175
                                        200,130
                                        350,90
                                        500,65
                                        680,115
                                        "
                                        fill="none" stroke="#6538d9" stroke-width="4" />


                                    {{-- POINTS --}}

                                    <circle cx="50" cy="175" r="6" fill="#6538d9" />

                                    <circle cx="200" cy="130" r="6" fill="#6538d9" />

                                    <circle cx="350" cy="90" r="6" fill="#6538d9" />

                                    <circle cx="500" cy="65" r="6" fill="#6538d9" />

                                    <circle cx="680" cy="115" r="6" fill="#6538d9" />

                                </svg>

                            </div>


                            {{-- CHART STATS --}}

                            <div class="chart-bottom">

                                <div>

                                    <span class="chart-stat-number">
                                        {{ $pendingRequestsCount ?? 0 }}
                                    </span>

                                    <span class="chart-stat-label pending">
                                        Pending
                                    </span>

                                </div>


                                <div>

                                    <span class="chart-stat-number">
                                        {{ $approvedThesisCount ?? 0 }}
                                    </span>

                                    <span class="chart-stat-label approved">
                                        Approved
                                    </span>

                                </div>


                                <div>

                                    <span class="chart-stat-number">
                                        {{ $rejectedRequestsCount ?? 0 }}
                                    </span>

                                    <span class="chart-stat-label rejected">
                                        Rejected
                                    </span>

                                </div>


                                <div>

                                    <span class="chart-stat-number">
                                        {{ $totalRequestsCount ?? 0 }}
                                    </span>

                                    <span class="chart-stat-label">
                                        Total
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         RECENT THESIS REQUESTS
                    ================================================== --}}
                    <div class="dashboard-card" style="margin-top: 16px;">

                        <div class="dashboard-card-header">

                            <h3>
                                Recent Thesis Requests
                            </h3>

                        </div>


                        <div class="request-list">

                            @forelse($recentRequests ?? [] as $request)
                                <div class="request-item">

                                    {{-- AVATAR --}}

                                    <div class="request-avatar">

                                        {{ strtoupper(substr($request->user->username ?? 'U', 0, 2)) }}

                                    </div>


                                    {{-- INFORMATION --}}

                                    <div class="request-info">

                                        <span class="request-title">

                                            {{ $request->thesis->title ?? 'Untitled Thesis' }}

                                        </span>

                                        <span class="request-name">

                                            {{ $request->user->username ?? 'Unknown Student' }}

                                        </span>

                                    </div>


                                    {{-- STATUS --}}

                                    @if ($request->is_approved === null)
                                        <span class="status-badge status-pending">
                                            Pending
                                        </span>
                                    @elseif($request->is_approved == 1)
                                        <span class="status-badge status-approved">
                                            Approved
                                        </span>
                                    @else
                                        <span class="status-badge status-rejected">
                                            Rejected
                                        </span>
                                    @endif

                                </div>

                            @empty

                                <div class="request-empty">

                                    <i class="bi bi-inbox"></i>

                                    <span>
                                        No thesis requests yet
                                    </span>

                                </div>
                            @endforelse


                            <a href="{{ route('hod.thesis_requests.index') }}" class="view-all">

                                <span>
                                    View all requests
                                </span>

                                <i class="bi bi-chevron-right"></i>

                            </a>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     RIGHT COLUMN
                ================================================== --}}
                <div class="dashboard-right-column">


                    {{-- =================================================
                         DEPARTMENT OVERVIEW
                    ================================================== --}}
                    <div class="dashboard-card hod-card">

                        <h3>
                            Department Overview
                        </h3>


                        {{-- DEPARTMENT --}}

                        <div class="hod-item">

                            <div class="hod-avatar">
                                <i class="bi bi-building"></i>
                            </div>

                            <div class="hod-info">

                                <strong>
                                    {{ $departmentName ?? 'Your Department' }}
                                </strong>

                                <span>
                                    Current Department
                                </span>

                            </div>

                        </div>


                        {{-- TOTAL AUTHORS --}}

                        <div class="hod-item">

                            <div class="hod-avatar">
                                <i class="bi bi-people"></i>
                            </div>

                            <div class="hod-info">

                                <strong>
                                    {{ $authorsCount ?? 0 }}
                                </strong>

                                <span>
                                    Thesis Authors
                                </span>

                            </div>

                        </div>


                        {{-- PUBLISHED THESIS --}}

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


                    {{-- =================================================
                         QUICK ACTIONS
                    ================================================== --}}
                    <div class="dashboard-card hod-card" style="margin-top: 16px;">

                        <h3>
                            Quick Actions
                        </h3>


                        {{-- REQUESTS --}}

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


                        {{-- THESIS --}}

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


                        {{-- NOTIFICATIONS --}}

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

        </main>

    </div>

</x-app-layout>
