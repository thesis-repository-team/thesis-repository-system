<nav x-data="{ open: false }" class="dashboard-navigation">

    {{-- =====================================================
         DESKTOP SIDEBAR
    ====================================================== --}}
    <aside class="dashboard-sidebar">

        {{-- BRAND --}}
        <div class="sidebar-brand">

            <div class="sidebar-logo">
                <img src="{{ asset('image/Small LU Logo.png') }}" alt="Life University Logo">
            </div>

            <div class="sidebar-brand-text">
                <h1>Thesis Repository</h1>
                <p>
                    @if (Auth::user()->role === 'admin')
                        Admin Dashboard
                    @elseif (Auth::user()->role === 'hod')
                        HoD Dashboard
                    @elseif (Auth::user()->role === 'student')
                        Student Dashboard
                    @elseif (Auth::user()->role === 'guest')
                        Dashboard
                    @endif
                </p>
            </div>

        </div>


        {{-- SIDEBAR NAVIGATION --}}
        <div class="sidebar-navigation">

            {{-- MAIN --}}
            <div class="sidebar-section-title">
                MAIN
            </div>

            {{-- DASHBOARD --}}
            <a href="
    @if (auth()->user()->role === 'admin') {{ route('admin.dashboard') }}
    @elseif(auth()->user()->role === 'hod')
        {{ route('hod.dashboard') }}
    @else
        {{ route('student.dashboard') }} @endif
"
                class="sidebar-link">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
            {{-- <a href="{{ route('dashboard') }}"
                class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>

            </a> --}}


            {{-- ADMIN --}}
            @if (Auth::user()->role === 'admin')
                <div class="sidebar-section-title">
                    MANAGEMENT
                </div>


                {{-- DEPARTMENTS --}}
                <a href="{{ route('admin.departments.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">

                    <i class="bi bi-building"></i>
                    <span>Departments</span>

                </a>


                {{-- HOD --}}
                <a href="{{ route('admin.hods.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.hods.*') ? 'active' : '' }}">

                    <i class="bi bi-person-badge"></i>
                    <span>HoD Management</span>

                </a>


                {{-- STUDENTS --}}
                <a href="{{ route('admin.students.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">

                    <i class="bi bi-people"></i>
                    <span>Students</span>

                </a>


                {{-- THESES --}}
                <a href="{{ route('admin.thesis.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.thesis.*') ? 'active' : '' }}">

                    <i class="bi bi-journal-bookmark"></i>
                    <span>Theses</span>

                </a>


                {{-- REQUESTS --}}
                <a href="{{ route('admin.thesis_requests.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.thesis_requests.*') ? 'active' : '' }}">

                    <i class="bi bi-clock-history"></i>
                    <span>Thesis Requests</span>

                </a>

                {{-- =================================================
                 HOD
            ================================================== --}}
            @elseif (Auth::user()->role === 'hod')
                <div class="sidebar-section-title">
                    MANAGEMENT
                </div>


                {{-- STUDENTS --}}
                <a href="{{ route('hod.students.index') }}"
                    class="sidebar-link {{ request()->routeIs('hod.students.*') ? 'active' : '' }}">

                    <i class="bi bi-people"></i>
                    <span>Students</span>

                </a>

                <a href="{{ route('hod.thesis.index') }}"
                    class="sidebar-link {{ request()->routeIs('hod.thesis.index') ? 'active' : '' }}">

                    <i class="bi bi-journal-bookmark"></i>
                    <span>Theses</span>

                </a>


                <a href="{{ route('hod.thesis.my-theses') }}"
                    class="sidebar-link {{ request()->routeIs('hod.thesis.my-theses') ? 'active' : '' }}">

                    <i class="bi bi-bookmark-heart"></i>
                    <span>My Theses</span>

                </a>


                <a href="{{ route('hod.thesis_requests.index') }}"
                    class="sidebar-link {{ request()->routeIs('hod.thesis_requests.*') ? 'active' : '' }}">

                    <i class="bi bi-clock-history"></i>
                    <span>Thesis Requests</span>

                </a>


                {{-- =================================================
                 STUDENT
            ================================================== --}}
            @elseif (Auth::user()->role === 'student')
                <div class="sidebar-section-title">
                    MANAGEMENT
                </div>


                <a href="{{ route('student.thesis.index') }}"
                    class="sidebar-link {{ request()->routeIs('student.thesis.index') ? 'active' : '' }}">

                    <i class="bi bi-journal-bookmark"></i>
                    <span>Theses</span>

                </a>

                <a href="{{ route('student.thesis.my-theses') }}"
                    class="sidebar-link {{ request()->routeIs('student.thesis.my-theses') ? 'active' : '' }}">

                    <i class="bi bi-bookmark-heart"></i>
                    <span>My Theses</span>

                </a>


                <a href="{{ route('student.thesis_requests.index') }}"
                    class="sidebar-link {{ request()->routeIs('student.thesis_requests.*') ? 'active' : '' }}">

                    <i class="bi bi-clock-history"></i>
                    <span>Thesis Requests</span>

                </a>


                <a href="{{ route('student.thesis.view_history') }}"
                    class="sidebar-link {{ request()->routeIs('student.thesis.view_history') ? 'active' : '' }}">

                    <i class="bi bi-clock-history"></i>
                    <span>View History</span>

                </a>


                <a href="{{ route('student.saved_thesis.index') }}"
                    class="sidebar-link {{ request()->routeIs('student.saved_thesis.index') ? 'active' : '' }}">

                    <i class="bi bi-bookmark"></i>
                    <span>Bookmarks</span>

                </a>
            @elseif (Auth::user()->role === 'guest')
                <div class="sidebar-section-title">
                    MANAGEMENT
                </div>

                <a href="{{ route('student.thesis.index') }}"
                    class="sidebar-link {{ request()->routeIs('student.thesis.index') ? 'active' : '' }}">

                    <i class="bi bi-journal-bookmark"></i>
                    <span>Theses</span>

                </a>

                <a href="{{ route('student.thesis.view_history') }}"
                    class="sidebar-link {{ request()->routeIs('student.thesis.view_history') ? 'active' : '' }}">

                    <i class="bi bi-clock-history"></i>
                    <span>View History</span>

                </a>


                <a href="{{ route('student.saved_thesis.index') }}"
                    class="sidebar-link {{ request()->routeIs('student.saved_thesis.index') ? 'active' : '' }}">

                    <i class="bi bi-bookmark"></i>
                    <span>Bookmarks</span>

                </a>
            @endif

        </div>


        {{-- SIDEBAR BOTTOM --}}
        <div class="sidebar-bottom">

            {{-- SETTINGS --}}
            <a href="{{ route('profile.edit') }}"
                class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">

                <i class="bi bi-gear"></i>
                <span>Settings</span>

            </a>


            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="sidebar-link logout-link">

                    <i class="bi bi-box-arrow-right" style="color: #dc3545;"></i>
                    <span style="color: #dc3545;">Logout</span>

                </button>

            </form>

        </div>

    </aside>


    {{-- =====================================================
         HEADER
    ====================================================== --}}
    <header class="dashboard-header">

        <div class="header-left">

            <div class="desktop-welcome">

                <h2>
                    Hi, {{ Auth::user()->username }}
                </h2>

                <p>
                    Let's manage the thesis repository today!
                </p>

            </div>

        </div>


        {{-- HEADER RIGHT --}}
        <div class="header-right">

            {{-- NOTIFICATIONS --}}
            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'hod' || Auth::user()->role === 'student')
                <a href="{{ route('notifications.index') }}" class="header-icon-button notification-button">

                    <i class="bi bi-bell"></i>

                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <span class="notification-count">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endif

                </a>
            @endif

            {{-- DARK MODE --}}
            <button type="button" class="header-icon-button theme-toggle" onclick="toggleDashboardTheme()">

                <i class="bi bi-moon-stars" id="themeIcon"></i>

            </button>


            {{-- USER --}}
            <div class="desktop-user-menu">

                <a href="{{ route('profile.edit') }}" class="header-user">

                    <div class="header-avatar">

                        {{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}

                    </div>

                    <div class="header-user-info">

                        <strong>
                            {{ Auth::user()->username }}
                        </strong>

                        <span>
                            {{ ucfirst(Auth::user()->role) }}
                        </span>

                    </div>

                    <i class="bi bi-chevron-down"></i>

                </a>

            </div>


            {{-- MOBILE BUTTON --}}
            <button type="button" class="mobile-menu-button" @click="open = !open">

                <i class="bi" :class="open ? 'bi-x-lg' : 'bi-list'">
                </i>

            </button>

        </div>

    </header>


    {{-- =====================================================
         MOBILE NAVIGATION
    ====================================================== --}}
    <div class="mobile-navigation" x-show="open" x-transition>

        <div class="mobile-user-card">

            <div class="mobile-user-avatar">
                {{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}
            </div>

            <div class="mobile-user-info">

                <strong>
                    {{ Auth::user()->username }}
                </strong>

                <span>
                    {{ Auth::user()->email }}
                </span>

            </div>

        </div>


        <div class="mobile-navigation-links">

            <a href="{{ route('dashboard') }}"
                class="mobile-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>

            </a>


            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.departments.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">

                    <i class="bi bi-building"></i>
                    <span>Departments</span>

                </a>


                <a href="{{ route('admin.hods.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('admin.hods.*') ? 'active' : '' }}">

                    <i class="bi bi-person-badge"></i>
                    <span>HoD Management</span>

                </a>


                <a href="{{ route('admin.students.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">

                    <i class="bi bi-people"></i>
                    <span>Students</span>

                </a>


                <a href="{{ route('admin.thesis.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('admin.thesis.*') ? 'active' : '' }}">

                    <i class="bi bi-journal-bookmark"></i>
                    <span>Theses</span>

                </a>


                <a href="{{ route('admin.thesis_requests.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('admin.thesis_requests.*') ? 'active' : '' }}">

                    <i class="bi bi-clock-history"></i>
                    <span>Thesis Requests</span>

                </a>
            @elseif (Auth::user()->role === 'hod')
                {{-- STUDENTS --}}
                <a href="{{ route('hod.students.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('hod.students.*') ? 'active' : '' }}">

                    <i class="bi bi-people"></i>
                    <span>Students</span>

                </a>

                <a href="{{ route('hod.thesis.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('hod.thesis.*') ? 'active' : '' }}">

                    <i class="bi bi-journal-bookmark"></i>
                    <span>Theses</span>

                </a>


                <a href="{{ route('hod.thesis.my-theses') }}"
                    class="mobile-nav-link {{ request()->routeIs('hod.thesis.my-theses') ? 'active' : '' }}">

                    <i class="bi bi-bookmark-heart"></i>
                    <span>My Theses</span>

                </a>


                <a href="{{ route('hod.thesis_requests.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('hod.thesis_requests.*') ? 'active' : '' }}">

                    <i class="bi bi-clock-history"></i>
                    <span>Thesis Requests</span>

                </a>
            @elseif (Auth::user()->role === 'student')
                <a href="{{ route('student.thesis.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('student.thesis.*') ? 'active' : '' }}">

                    <i class="bi bi-journal-bookmark"></i>
                    <span>Theses</span>

                </a>


                <a href="{{ route('student.thesis.my-theses') }}"
                    class="mobile-nav-link {{ request()->routeIs('student.thesis.my-theses') ? 'active' : '' }}">

                    <i class="bi bi-bookmark-heart"></i>
                    <span>My Theses</span>

                </a>


                <a href="{{ route('student.thesis_requests.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('student.thesis_requests.*') ? 'active' : '' }}">

                    <i class="bi bi-clock-history"></i>
                    <span>Thesis Requests</span>

                </a>


                <a href="{{ route('student.thesis.view_history') }}"
                    class="mobile-nav-link {{ request()->routeIs('student.thesis.view_history') ? 'active' : '' }}">

                    <i class="bi bi-clock-history"></i>
                    <span>View History</span>

                </a>


                <a href="{{ route('student.saved_thesis.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('student.saved_thesis.index') ? 'active' : '' }}">

                    <i class="bi bi-bookmark"></i>
                    <span>Bookmarks</span>

                </a>
            @elseif (Auth::user()->role === 'guest')
                <a href="{{ route('student.thesis.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('student.thesis.*') ? 'active' : '' }}">

                    <i class="bi bi-journal-bookmark"></i>
                    <span>Theses</span>

                </a>

                <a href="{{ route('student.thesis.view_history') }}"
                    class="mobile-nav-link {{ request()->routeIs('student.thesis.view_history') ? 'active' : '' }}">

                    <i class="bi bi-clock-history"></i>
                    <span>View History</span>

                </a>


                <a href="{{ route('student.saved_thesis.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('student.saved_thesis.index') ? 'active' : '' }}">

                    <i class="bi bi-bookmark"></i>
                    <span>Bookmarks</span>

                </a>
            @endif


            <a href="{{ route('profile.edit') }}"
                class="mobile-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">

                <i class="bi bi-gear"></i>
                <span>Settings</span>

            </a>


            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="mobile-nav-link logout-link" style="color: #dc3545;">

                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>

                </button>

            </form>

        </div>

    </div>


    {{-- =====================================================
         MOBILE BOTTOM NAVIGATION
    ====================================================== --}}
    <div class="mobile-bottom-bar">

        <a href="{{ route('dashboard') }}"
            class="mobile-bottom-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">

            <i class="bi bi-grid-fill"></i>
            <span>Home</span>

        </a>


        @if (Auth::user()->role === 'admin')
            <a href="{{ route('admin.departments.index') }}"
                class="mobile-bottom-item {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">

                <i class="bi bi-building"></i>
                <span>Departments</span>

            </a>


            <a href="{{ route('admin.thesis.index') }}"
                class="mobile-bottom-item {{ request()->routeIs('admin.thesis.*') ? 'active' : '' }}">

                <i class="bi bi-journal-bookmark"></i>
                <span>Theses</span>

            </a>
        @elseif (Auth::user()->role === 'hod')
            <a href="{{ route('hod.thesis.index') }}"
                class="mobile-bottom-item {{ request()->routeIs('hod.thesis.*') ? 'active' : '' }}">

                <i class="bi bi-journal-bookmark"></i>
                <span>Theses</span>

            </a>
        @elseif (Auth::user()->role === 'student')
            <a href="{{ route('student.thesis.index') }}"
                class="mobile-bottom-item {{ request()->routeIs('student.thesis.*') ? 'active' : '' }}">

                <i class="bi bi-journal-bookmark"></i>
                <span>Theses</span>

            </a>
        @elseif (Auth::user()->role === 'guest')
            <a href="{{ route('student.thesis.index') }}"
                class="mobile-bottom-item {{ request()->routeIs('student.thesis.*') ? 'active' : '' }}">

                <i class="bi bi-journal-bookmark"></i>
                <span>Theses</span>

            </a>
        @endif


        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'hod' || Auth::user()->role === 'student')
            <a href="{{ route('notifications.index') }}" class="mobile-bottom-item position-relative">

                <i class="bi bi-bell"></i>
                <span>Alerts</span>

                @if (auth()->user()->unreadNotifications->count() > 0)
                    <small class="mobile-notification-badge">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </small>
                @endif
            </a>
        @endif

        <a href="{{ route('profile.edit') }}"
            class="mobile-bottom-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">

            <i class="bi bi-person"></i>
            <span>Profile</span>

        </a>

    </div>

</nav>


{{-- =====================================================
     THEME SCRIPT
====================================================== --}}
<script>
    function toggleDashboardTheme() {

        const html = document.documentElement;

        const current =
            html.getAttribute('data-bs-theme') || 'light';

        const next =
            current === 'dark' ? 'light' : 'dark';

        html.setAttribute(
            'data-bs-theme',
            next
        );

        localStorage.setItem(
            'dashboardTheme',
            next
        );

        updateThemeIcon(next);
    }


    function updateThemeIcon(theme) {

        const icon =
            document.getElementById('themeIcon');

        if (!icon) return;

        icon.classList.remove(
            'bi-moon-stars',
            'bi-sun'
        );

        icon.classList.add(
            theme === 'dark' ?
            'bi-sun' :
            'bi-moon-stars'
        );
    }


    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const saved =
                localStorage.getItem('dashboardTheme');

            const theme =
                saved || 'light';

            document.documentElement.setAttribute(
                'data-bs-theme',
                theme
            );

            updateThemeIcon(theme);

        }
    );
</script>
