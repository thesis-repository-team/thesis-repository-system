<x-app-layout>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Notifications
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        View updates about your thesis requests
                    </p>
                </div>

                @if (auth()->user()->unreadNotifications->count() > 0)
                    <form method="POST" action="{{ route('notifications.readAll') }}">

                        @csrf

                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white
                                   rounded-lg hover:bg-blue-700">

                            Mark all as read

                        </button>

                    </form>
                @endif
            </div>


            {{-- Success Message --}}
            @if (session('success'))
                <div
                    class="mb-6 px-4 py-3 bg-green-50
                            border border-green-200 text-green-700
                            rounded-lg">

                    {{ session('success') }}

                </div>
            @endif


            {{-- Notifications --}}
            <div class="bg-white rounded-xl shadow-sm
                        border border-gray-200 overflow-hidden">

                @forelse (auth()->user()->notifications as $notification)
                    @php
                        $status = $notification->data['status'] ?? null;
                        $isUnread = is_null($notification->read_at);
                    @endphp


                    <div
                        class="flex items-start justify-between
                                px-6 py-5 border-b border-gray-100

                                {{ $isUnread ? 'bg-blue-50' : 'bg-white' }}">


                        {{-- LEFT SIDE --}}
                        <div class="flex items-start gap-4">

                            {{-- Icon --}}
                            <div
                                class="w-10 h-10 flex-shrink-0
                                        flex items-center justify-center
                                        rounded-full

                                {{ $status === 'approved'
                                    ? 'bg-green-100 text-green-600'
                                    : ($status === 'rejected'
                                        ? 'bg-red-100 text-red-600'
                                        : ($isUnread
                                            ? 'bg-blue-100 text-blue-600'
                                            : 'bg-gray-100 text-gray-500')) }}">

                                @if ($status === 'approved')
                                    ✓
                                @elseif ($status === 'rejected')
                                    ✕
                                @else
                                    🔔
                                @endif

                            </div>


                            {{-- Notification Content --}}
                            <div>

                                <p class="text-gray-800 font-medium">
                                    {{ $notification->data['message'] ?? 'You have a new notification.' }}
                                </p>


                                @if (!empty($notification->data['title']))
                                    <p class="text-sm text-gray-600 mt-1">

                                        <strong>Thesis:</strong>

                                        {{ $notification->data['title'] }}

                                    </p>
                                @endif


                                {{-- Status --}}
                                @if (!empty($status))
                                    <span
                                        class="inline-block mt-2 px-2 py-1
                                                 text-xs font-semibold
                                                 rounded-full

                                        {{ $status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">

                                        {{ ucfirst($status) }}

                                    </span>
                                @endif


                                {{-- Time --}}
                                <p class="text-sm text-gray-500 mt-2">

                                    {{ $notification->created_at->diffForHumans() }}

                                </p>


                                {{-- New --}}
                                @if ($isUnread)
                                    <span
                                        class="inline-block mt-2 px-2 py-1
                                                 text-xs font-semibold
                                                 text-blue-600
                                                 bg-blue-100 rounded-full">

                                        New

                                    </span>
                                @endif

                            </div>

                        </div>


                        {{-- RIGHT SIDE --}}
                        <div class="flex flex-col items-end gap-2 ml-4">


                            {{-- APPROVED --}}
                            @if ($status === 'approved')
                                <a href="{{ route('notifications.open', $notification->id) }}"
                                    class="px-4 py-2 bg-green-600 text-white
                                          text-sm font-medium rounded-lg
                                          hover:bg-green-700 transition">

                                    View Thesis

                                </a>


                                {{-- REJECTED --}}
                            @elseif ($status === 'rejected')
                                <a href="{{ route('notifications.open', $notification->id) }}"
                                    class="px-4 py-2 bg-red-600 text-white
                                          text-sm font-medium rounded-lg
                                          hover:bg-red-700 transition">

                                    View & Comment

                                </a>


                                {{-- OTHER --}}
                            @else
                                <a href="{{ route('notifications.open', $notification->id) }}"
                                    class="px-4 py-2 bg-blue-600 text-white
                                          text-sm font-medium rounded-lg
                                          hover:bg-blue-700 transition">

                                    View

                                </a>
                            @endif


                            {{-- Mark as read --}}
                            @if ($isUnread)
                                <form method="POST" action="{{ route('notifications.read', $notification->id) }}">

                                    @csrf

                                    <button type="submit"
                                        class="text-sm text-blue-600
                                               hover:text-blue-800
                                               font-medium">

                                        Mark as read

                                    </button>

                                </form>
                            @endif

                        </div>

                    </div>


                @empty

                    <div class="py-16 text-center">

                        <div class="text-4xl">
                            🔔
                        </div>

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
