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
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Mark all as read
                    </button>
                </form>
            @endif
        </div>

        @if (session('success'))
            <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            @forelse (auth()->user()->notifications as $notification)

                <div class="flex items-start justify-between px-6 py-5 border-b border-gray-100
                    {{ is_null($notification->read_at) ? 'bg-blue-50' : 'bg-white' }}">

                    <div class="flex items-start gap-4">

                        <div class="w-10 h-10 flex items-center justify-center rounded-full
                            {{ is_null($notification->read_at)
                                ? 'bg-blue-100 text-blue-600'
                                : 'bg-gray-100 text-gray-500' }}">

                            @if (($notification->data['status'] ?? '') === 'approved')
                                ✓
                            @elseif (($notification->data['status'] ?? '') === 'rejected')
                                ✕
                            @else
                                🔔
                            @endif

                        </div>

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

                            @if (!empty($notification->data['status']))
                                <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $notification->data['status'] === 'approved'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($notification->data['status']) }}
                                </span>
                            @endif

                            <p class="text-sm text-gray-500 mt-2">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>

                            @if (is_null($notification->read_at))
                                <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold
                                    text-blue-600 bg-blue-100 rounded-full">
                                    New
                                </span>
                            @endif
                        </div>
                    </div>

                    @if (is_null($notification->read_at))
                        <form method="POST"
                            action="{{ route('notifications.read', $notification->id) }}">
                            @csrf
                            <button type="submit"
                                class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                Mark as read
                            </button>
                        </form>
                    @endif

                </div>

            @empty

                <div class="py-16 text-center">
                    <div class="text-4xl">🔔</div>

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
