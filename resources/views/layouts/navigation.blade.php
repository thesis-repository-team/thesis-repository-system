<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (Auth::user()->role === 'admin')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.departments.index')" :active="request()->routeIs('admin.departments.index')">
                            {{ __('Departments') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.hods.index')" :active="request()->routeIs('admin.hods.index')">
                            {{ __('HoDs') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.index')">
                            {{ __('Students') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.thesis.index')" :active="request()->routeIs('admin.thesis.index')">
                            {{ __('Theses') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.thesis_requests.index')" :active="request()->routeIs('admin.thesis_requests.index')">
                            {{ __('Thesis Requests') }}
                        </x-nav-link>
                    @elseif (Auth::user()->role === 'hod')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('hod.thesis.index')" :active="request()->routeIs('hod.thesis.index')">
                            {{ __('Theses') }}
                        </x-nav-link>
                        <x-nav-link :href="route('hod.thesis.my-theses')" :active="request()->routeIs('hod.thesis.my-theses')">
                            {{ __('My Theses') }}
                        </x-nav-link>
                        <x-nav-link :href="route('hod.thesis_requests.index')" :active="request()->routeIs('hod.thesis-requests.index')">
                            {{ __('Thesis Requests') }}
                        </x-nav-link>
                    @elseif (Auth::user()->role === 'student')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('student.thesis.index')" :active="request()->routeIs('student.thesis.index')">
                            {{ __('Theses') }}
                        </x-nav-link>
                        <x-nav-link :href="route('student.thesis.my-theses')" :active="request()->routeIs('student.thesis.my-theses')">
                            {{ __('My Theses') }}
                        </x-nav-link>
                        <x-nav-link :href="route('student.thesis_requests.index')" :active="request()->routeIs('student.thesis_requests.index')">
                            {{ __('Thesis Requests') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                {{-- Notification Bell --}}
                <a href="{{ route('notifications.index') }}"
                    class="relative inline-flex items-center justify-center p-2
           text-gray-500 hover:text-gray-700
           focus:outline-none">

                    {{-- Bell Icon --}}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-5-5.917V4a1 1 0 00-2 0v1.083A6 6 0 006 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9" />
                    </svg>

                    {{-- Notification Badge --}}
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <span
                            class="absolute -top-1 -right-1
                   flex items-center justify-center
                   min-w-5 h-5 px-1
                   text-[10px] font-bold
                   text-white
                   bg-red-500
                   rounded-full">

                            {{ auth()->user()->unreadNotifications->count() }}

                        </span>
                    @endif

                </a>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->username }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->username }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
