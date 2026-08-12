<x-app-layout>

<div class="py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Notifications
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    View your latest notifications
                </p>
            </div>

            {{-- Mark All as Read --}}
            @if (auth()->user()->unreadNotifications->count() > 0)
                <form method="POST" action="{{ route('notifications.readAll') }}">
                    @csrf

                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2
                               bg-blue-600 text-white rounded-lg
                               hover:bg-blue-700 transition">

                        {{-- Check Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7" />

                        </svg>

                        Mark all as read

                    </button>
                </form>
            @endif

        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 px-4 py-3
                        bg-green-50
                        border border-green-200
                        text-green-700
                        rounded-lg">

                {{ session('success') }}

            </div>
        @endif


        {{-- Error Message --}}
        @if (session('error'))
            <div class="mb-6 px-4 py-3
                        bg-red-50
                        border border-red-200
                        text-red-700
                        rounded-lg">

                {{ session('error') }}

            </div>
        @endif


        {{-- Notifications --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            @forelse (auth()->user()->notifications as $notification)

                {{-- Clickable Notification --}}
                <div class="relative">

                    <a href="{{ route('notifications.open', $notification->id) }}"
                        class="flex items-start justify-between
                               px-6 py-5
                               border-b border-gray-100
                               last:border-b-0
                               transition
                               hover:bg-gray-50
                               {{ is_null($notification->read_at)
                                    ? 'bg-blue-50 hover:bg-blue-100'
                                    : 'bg-white hover:bg-gray-50' }}">

                        {{-- Left Side --}}
                        <div class="flex items-start gap-4">

                            {{-- Notification Icon --}}
                            <div class="flex-shrink-0
                                        w-10 h-10
                                        flex items-center justify-center
                                        rounded-full
                                        {{ is_null($notification->read_at)
                                            ? 'bg-blue-100 text-blue-600'
                                            : 'bg-gray-100 text-gray-500' }}">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032
                                           2.032 0 0118 14.158V11a6
                                           6 0 00-5-5.917V4a1 1 0
                                           00-2 0v1.083A6 6 0 006
                                           11v3.159c0 .538-.214
                                           1.055-.595 1.436L4
                                           17h5m6 0v1a3 3 0
                                           01-6 0v-1m6 0H9" />

                                </svg>

                            </div>


                            {{-- Notification Content --}}
                            <div class="min-w-0">

                                {{-- Message --}}
                                <p class="text-gray-800 font-medium">
                                    {{ $notification->data['message'] ?? 'You have a new notification.' }}
                                </p>


                                {{-- Thesis Title --}}
                                @if (!empty($notification->data['title']))
                                    <p class="text-sm text-gray-600 mt-1">
                                        <span class="font-medium">
                                            Thesis:
                                        </span>

                                        {{ $notification->data['title'] }}
                                    </p>
                                @endif


                                {{-- Student Name --}}
                                @if (!empty($notification->data['author_name']))
                                    <p class="text-sm text-gray-600 mt-1">
                                        <span class="font-medium">
                                            Student:
                                        </span>

                                        {{ $notification->data['author_name'] }}
                                    </p>
                                @endif


                                {{-- Time --}}
                                <p class="text-sm text-gray-500 mt-2">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>


                                {{-- New Badge --}}
                                @if (is_null($notification->read_at))
                                    <span class="inline-flex items-center mt-2
                                                 px-2 py-1
                                                 text-xs font-semibold
                                                 text-blue-600
                                                 bg-blue-100
                                                 rounded-full">

                                        New

                                    </span>
                                @endif

                            </div>

                        </div>


                        {{-- Arrow --}}
                        <div class="flex-shrink-0 ml-4 mt-2">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7" />

                            </svg>

                        </div>

                    </a>


                    {{-- Mark as Read --}}
                    @if (is_null($notification->read_at))

                        <form method="POST"
                            action="{{ route('notifications.read', $notification->id) }}"
                            class="absolute right-14 bottom-5">

                            @csrf

                            <button type="submit"
                                class="text-xs
                                       text-blue-600
                                       hover:text-blue-800
                                       font-medium
                                       bg-white
                                       px-2 py-1
                                       rounded">

                                Mark as read

                            </button>

                        </form>

                    @endif

                </div>

            @empty

                {{-- Empty State --}}
                <div class="py-16 text-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="mx-auto h-12 w-12 text-gray-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032
                               2.032 0 0118 14.158V11a6
                               6 0 00-5-5.917V4a1 1 0
                               00-2 0v1.083A6 6 0 006
                               11v3.159c0 .538-.214
                               1.055-.595 1.436L4
                               17h5m6 0v1a3 3 0
                               01-6 0v-1m6 0H9" />

                    </svg>

                    <h3 class="mt-4 text-lg font-semibold text-gray-700">
                        No notifications
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        You don't have any notifications yet.
                    </p>

                </div>

            @endforelse

        </div>

    </div>
</div>

</x-app-layout>
