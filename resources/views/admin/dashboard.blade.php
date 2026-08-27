<x-app-layout>

    <div class="dashboard-content">

        <main class="dashboard-main">

            {{-- =================================================
                 HERO
            ================================================== --}}
            <section class="dashboard-hero">

                <div class="hero-content">

                    <h1>
                        Dashboard Overview
                    </h1>

                    <p>
                        Here's what's happening with your repository
                    </p>

                    <a href="{{ route('admin.thesis.index') }}"
                       class="hero-button">

                        View Analytics

                    </a>

                </div>


                <div class="hero-image">

                    <i class="bi bi-mortarboard-fill"></i>

                </div>

            </section>


            {{-- =================================================
                 STATISTICS
            ================================================== --}}
            <section class="dashboard-grid">


                {{-- DEPARTMENTS --}}
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
                                {{ $departmentsCount ?? 6 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Total Departments
                    </div>

                </div>


                {{-- HODS --}}
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
                                {{ $hodsCount ?? 12 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Active HoDs
                    </div>

                </div>


                {{-- STUDENTS --}}
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
                                {{ $studentsCount ?? 245 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Total Students
                    </div>

                </div>


                {{-- THESES --}}
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
                                {{ $thesesCount ?? 156 }}
                            </div>

                        </div>

                    </div>

                    <div class="stat-footer">
                        Total Theses
                    </div>

                </div>

            </section>


            {{-- =================================================
                 LOWER CONTENT
            ================================================== --}}
            <section class="dashboard-lower-grid">


                {{-- =================================================
                     LEFT
                ================================================== --}}
                <div>

                    {{-- THESIS REQUEST CHART --}}
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

                                <svg viewBox="0 0 700 250"
                                     preserveAspectRatio="none">

                                    {{-- GRID --}}
                                    <line x1="50"
                                          y1="30"
                                          x2="680"
                                          y2="30"
                                          stroke="#eeeeF4"/>

                                    <line x1="50"
                                          y1="80"
                                          x2="680"
                                          y2="80"
                                          stroke="#eeeeF4"/>

                                    <line x1="50"
                                          y1="130"
                                          x2="680"
                                          y2="130"
                                          stroke="#eeeeF4"/>

                                    <line x1="50"
                                          y1="180"
                                          x2="680"
                                          y2="180"
                                          stroke="#eeeeF4"/>


                                    {{-- AREA --}}
                                    <path
                                        d="
                                        M50 175
                                        L200 130
                                        L350 90
                                        L500 65
                                        L680 115
                                        L680 210
                                        L50 210
                                        Z
                                        "
                                        fill="#eee8ff"
                                        opacity="0.8"
                                    />


                                    {{-- LINE --}}
                                    <polyline
                                        points="
                                        50,175
                                        200,130
                                        350,90
                                        500,65
                                        680,115
                                        "
                                        fill="none"
                                        stroke="#6538d9"
                                        stroke-width="4"
                                    />


                                    {{-- POINTS --}}
                                    <circle
                                        cx="50"
                                        cy="175"
                                        r="6"
                                        fill="#6538d9"
                                    />

                                    <circle
                                        cx="200"
                                        cy="130"
                                        r="6"
                                        fill="#6538d9"
                                    />

                                    <circle
                                        cx="350"
                                        cy="90"
                                        r="6"
                                        fill="#6538d9"
                                    />

                                    <circle
                                        cx="500"
                                        cy="65"
                                        r="6"
                                        fill="#6538d9"
                                    />

                                    <circle
                                        cx="680"
                                        cy="115"
                                        r="6"
                                        fill="#6538d9"
                                    />

                                </svg>

                            </div>


                            {{-- CHART STATS --}}
                            <div class="chart-bottom">

                                <div>
                                    <span class="chart-stat-number">
                                        32
                                    </span>

                                    <span class="chart-stat-label pending">
                                        Pending
                                    </span>
                                </div>


                                <div>
                                    <span class="chart-stat-number">
                                        18
                                    </span>

                                    <span class="chart-stat-label approved">
                                        Approved
                                    </span>
                                </div>


                                <div>
                                    <span class="chart-stat-number">
                                        7
                                    </span>

                                    <span class="chart-stat-label rejected">
                                        Rejected
                                    </span>
                                </div>


                                <div>
                                    <span class="chart-stat-number">
                                        57
                                    </span>

                                    <span class="chart-stat-label">
                                        Total
                                    </span>
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- RECENT REQUESTS --}}
                    <div class="dashboard-card"
                         style="margin-top: 16px;">

                        <div class="dashboard-card-header">

                            <h3>
                                Recent Thesis Requests
                            </h3>

                        </div>


                        <div class="request-list">

                            <div class="request-item">

                                <div class="request-avatar">
                                    JS
                                </div>

                                <div class="request-info">

                                    <span class="request-title">
                                        E-Learning Platform
                                    </span>

                                    <span class="request-name">
                                        John Smith
                                    </span>

                                </div>

                                <span class="status-badge status-pending">
                                    Pending
                                </span>

                            </div>


                            <div class="request-item">

                                <div class="request-avatar">
                                    MC
                                </div>

                                <div class="request-info">

                                    <span class="request-title">
                                        AI Chatbot System
                                    </span>

                                    <span class="request-name">
                                        Maria Clara
                                    </span>

                                </div>

                                <span class="status-badge status-approved">
                                    Approved
                                </span>

                            </div>


                            <div class="request-item">

                                <div class="request-avatar">
                                    DB
                                </div>

                                <div class="request-info">

                                    <span class="request-title">
                                        Library Management
                                    </span>

                                    <span class="request-name">
                                        David Brown
                                    </span>

                                </div>

                                <span class="status-badge status-pending">
                                    Pending
                                </span>

                            </div>


                            <div class="request-item">

                                <div class="request-avatar">
                                    LW
                                </div>

                                <div class="request-info">

                                    <span class="request-title">
                                        Web Analytics Dashboard
                                    </span>

                                    <span class="request-name">
                                        Linda White
                                    </span>

                                </div>

                                <span class="status-badge status-rejected">
                                    Rejected
                                </span>

                            </div>


                            <div class="request-item">

                                <div class="request-avatar">
                                    RK
                                </div>

                                <div class="request-info">

                                    <span class="request-title">
                                        Mobile Banking App
                                    </span>

                                    <span class="request-name">
                                        Robert Kim
                                    </span>

                                </div>

                                <span class="status-badge status-approved">
                                    Approved
                                </span>

                            </div>


                            <a href="{{ route('admin.thesis_requests.index') }}"
                               class="view-all">

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


                    {{-- CALENDAR --}}
                    <div class="dashboard-card calendar-card">

                        <div class="calendar-header">

                            <h3>
                                Calendar
                            </h3>

                        </div>


                        <div class="calendar-month">

                            <i class="bi bi-chevron-left"></i>

                            <strong>
                                May 2024
                            </strong>

                            <i class="bi bi-chevron-right"></i>

                        </div>


                        <div class="calendar-grid">

                            <span class="calendar-day-name">Mon</span>
                            <span class="calendar-day-name">Tue</span>
                            <span class="calendar-day-name">Wed</span>
                            <span class="calendar-day-name">Thu</span>
                            <span class="calendar-day-name">Fri</span>
                            <span class="calendar-day-name">Sat</span>
                            <span class="calendar-day-name">Sun</span>


                            <span class="calendar-day muted">29</span>
                            <span class="calendar-day muted">30</span>

                            <span class="calendar-day">1</span>
                            <span class="calendar-day">2</span>
                            <span class="calendar-day">3</span>
                            <span class="calendar-day">4</span>
                            <span class="calendar-day">5</span>

                            <span class="calendar-day">6</span>
                            <span class="calendar-day">7</span>
                            <span class="calendar-day">8</span>
                            <span class="calendar-day">9</span>
                            <span class="calendar-day">10</span>
                            <span class="calendar-day">11</span>
                            <span class="calendar-day">12</span>

                            <span class="calendar-day">13</span>
                            <span class="calendar-day">14</span>

                            <span class="calendar-day today">
                                15
                            </span>

                            <span class="calendar-day">16</span>
                            <span class="calendar-day">17</span>
                            <span class="calendar-day">18</span>
                            <span class="calendar-day">19</span>

                            <span class="calendar-day">20</span>
                            <span class="calendar-day">21</span>
                            <span class="calendar-day">22</span>
                            <span class="calendar-day">23</span>
                            <span class="calendar-day">24</span>
                            <span class="calendar-day">25</span>
                            <span class="calendar-day">26</span>

                            <span class="calendar-day">27</span>
                            <span class="calendar-day">28</span>
                            <span class="calendar-day">29</span>
                            <span class="calendar-day">30</span>
                            <span class="calendar-day">31</span>

                            <span class="calendar-day muted">1</span>
                            <span class="calendar-day muted">2</span>

                        </div>

                    </div>


                    {{-- SCHEDULE --}}
                    <div class="dashboard-card schedule-card">

                        <h3>
                            Today's Schedule
                        </h3>


                        <div class="schedule-item">

                            <div class="schedule-time">
                                09:00
                            </div>

                            <div class="schedule-info">

                                <strong>
                                    HoD Meeting
                                </strong>

                                <span>
                                    Conference Room
                                </span>

                            </div>

                        </div>


                        <div class="schedule-item">

                            <div class="schedule-time">
                                11:00
                            </div>

                            <div class="schedule-info">

                                <strong>
                                    Thesis Review
                                </strong>

                                <span>
                                    Review Room 1
                                </span>

                            </div>

                        </div>


                        <div class="schedule-item">

                            <div class="schedule-time">
                                14:00
                            </div>

                            <div class="schedule-info">

                                <strong>
                                    Student Consultation
                                </strong>

                                <span>
                                    Office 3
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- RECENT HODS --}}
                    <div class="dashboard-card hod-card">

                        <h3>
                            Recent Registered HoDs
                        </h3>


                        <div class="hod-item">

                            <div class="hod-avatar">
                                SJ
                            </div>

                            <div class="hod-info">

                                <strong>
                                    Dr. Sarah Johnson
                                </strong>

                                <span>
                                    Computer Science
                                </span>

                            </div>

                            <div class="hod-time">
                                2 days ago
                            </div>

                        </div>


                        <div class="hod-item">

                            <div class="hod-avatar">
                                MC
                            </div>

                            <div class="hod-info">

                                <strong>
                                    Dr. Michael Chen
                                </strong>

                                <span>
                                    Information Technology
                                </span>

                            </div>

                            <div class="hod-time">
                                3 days ago
                            </div>

                        </div>


                        <div class="hod-item">

                            <div class="hod-avatar">
                                ED
                            </div>

                            <div class="hod-info">

                                <strong>
                                    Dr. Emily Davis
                                </strong>

                                <span>
                                    Software Engineering
                                </span>

                            </div>

                            <div class="hod-time">
                                5 days ago
                            </div>

                        </div>


                        <a href="{{ route('admin.hods.index') }}"
                           class="view-all">

                            <span>
                                View all HoDs
                            </span>

                            <i class="bi bi-chevron-right"></i>

                        </a>

                    </div>

                </div>

            </section>

        </main>

    </div>

</x-app-layout>