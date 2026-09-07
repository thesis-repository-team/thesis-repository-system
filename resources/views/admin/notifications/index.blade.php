<x-app-layout>

    <style>

        .notifications-page {
            margin-left: 263px;
            padding: 118px 30px 40px;
            min-height: 100vh;

            background: #f0f2f5;

            box-sizing: border-box;
        }


        .notifications-wrapper {
            width: 100%;
            margin: 0 auto;
        }


        /* =========================================================
   MAIN CARD
========================================================= */

        .notifications-card {
            width: 100%;

            background: #ffffff;

            border-radius: 10px;

            overflow: hidden;

            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }


        /* =========================================================
   HEADER
========================================================= */

        .notifications-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 18px 22px;

            background: #ffffff;
        }


        /* =========================================================
   TITLE
========================================================= */

        .notifications-title {
            margin: 0;

            color: #050505;

            font-size: 22px;
            font-weight: 700;

            line-height: 1.2;
        }


        /* =========================================================
   MARK ALL AS READ
========================================================= */

        .mark-all-form {
            margin: 0;
        }

        .mark-all-button {
            border: none;

            background: transparent;

            color: #1877f2;

            font-size: 13px;
            font-weight: 600;

            cursor: pointer;

            padding: 7px 8px;

            border-radius: 6px;

            transition:
                background 0.2s ease,
                color 0.2s ease;
        }

        .mark-all-button:hover {
            background: #f0f2f5;

            color: #0d65d9;
        }


        .notification-section-title {
            margin: 0;

            padding: 14px 22px 8px;

            background: #ffffff;

            color: #050505;

            font-size: 15px;
            font-weight: 700;

            line-height: 1.3;
        }

        .notifications-list {
            width: 100%;
        }

        .notification-item {
            position: relative;

            display: flex;
            align-items: center;

            width: 100%;

            padding: 13px 22px;

            gap: 13px;

            text-decoration: none;

            background: #ffffff;

            box-sizing: border-box;

            transition: background 0.15s ease;
        }


        /* =========================================================
   HOVER
========================================================= */

        .notification-item:hover {
            background: #f5f6f7;
        }


        /* =========================================================
   UNREAD NOTIFICATION
========================================================= */

        .notification-item.unread {
            background: #edf3ff;
        }

        .notification-item.unread:hover {
            background: #e4edff;
        }


        /* =========================================================
   AVATAR
========================================================= */

        .notification-avatar {
            flex: 0 0 48px;

            width: 48px;
            height: 48px;

            border-radius: 50%;

            overflow: hidden;

            background: #e4e6eb;

            color: #65676b;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 16px;
            font-weight: 600;

            box-sizing: border-box;
        }


        /* =========================================================
   AVATAR IMAGE
========================================================= */

        .notification-avatar img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;
        }


        /* =========================================================
   AVATAR LETTER
========================================================= */

        .notification-avatar-letter {
            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
        }


        /* =========================================================
   NOTIFICATION CONTENT
========================================================= */

        .notification-content {
            flex: 1;

            min-width: 0;
        }


        /* =========================================================
   MAIN MESSAGE
========================================================= */

        .notification-main-text {
            margin: 0;

            color: #050505;

            font-size: 14px;

            line-height: 1.45;

            word-break: break-word;
        }


        /* =========================================================
   AUTHOR NAME
========================================================= */

        .notification-main-text strong {
            color: #050505;

            font-weight: 700;
        }


        /* =========================================================
   TIME
========================================================= */

        .notification-time {
            margin-top: 3px;

            color: #65676b;

            font-size: 12px;

            line-height: 1.3;
        }


        /* =========================================================
   UNREAD DOT
========================================================= */

        .unread-dot {
            flex: 0 0 9px;

            width: 9px;
            height: 9px;

            border-radius: 50%;

            background: #1877f2;
        }


        /* =========================================================
   EMPTY STATE
========================================================= */

        .notifications-empty {
            padding: 80px 20px;

            text-align: center;

            background: #ffffff;
        }


        /* =========================================================
   EMPTY ICON
========================================================= */

        .empty-icon {
            width: 50px;
            height: 50px;

            margin: 0 auto 15px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #e4e6eb;

            color: #65676b;

            font-size: 20px;
        }


        /* =========================================================
   EMPTY TITLE
========================================================= */

        .empty-title {
            margin: 0;

            color: #050505;

            font-size: 16px;

            font-weight: 700;
        }


        /* =========================================================
   EMPTY TEXT
========================================================= */

        .empty-text {
            margin: 6px 0 0;

            color: #65676b;

            font-size: 13px;
        }


        /* =========================================================
   NO NOTIFICATIONS IN SECTION
========================================================= */

        .notification-empty-section {
            padding: 10px 22px 18px;

            background: #ffffff;

            color: #65676b;

            font-size: 13px;
        }


        /* =========================================================
   LARGE DESKTOP
========================================================= */

        @media (min-width: 1200px) {

            .notifications-page {
                padding-left: 40px;
                padding-right: 40px;
            }

            .notifications-header {
                padding-left: 24px;
                padding-right: 24px;
            }

            .notification-section-title {
                padding-left: 24px;
                padding-right: 24px;
            }

            .notification-item {
                padding-left: 24px;
                padding-right: 24px;
            }

        }


        /* =========================================================
   TABLET
========================================================= */

        @media (max-width: 900px) {

            .notifications-page {
                margin-left: 263px;

                padding: 118px 20px 35px;
            }

        }


        /* =========================================================
   MOBILE
========================================================= */

        @media (max-width: 600px) {

            .notifications-page {
                margin-left: 0;

                padding: 90px 10px 30px;

                min-height: 100vh;
            }


            .notifications-header {
                padding: 16px;
            }


            .notifications-title {
                font-size: 20px;
            }


            .mark-all-button {
                font-size: 12px;

                padding: 6px;
            }


            .notification-section-title {
                padding: 14px 16px 8px;

                font-size: 14px;
            }


            .notification-item {
                padding: 12px 14px;

                gap: 11px;
            }


            .notification-avatar {
                flex: 0 0 42px;

                width: 42px;
                height: 42px;

                font-size: 14px;
            }


            .notification-main-text {
                font-size: 13px;

                line-height: 1.4;
            }


            .notification-time {
                font-size: 11px;
            }


            .unread-dot {
                flex: 0 0 8px;

                width: 8px;
                height: 8px;
            }

        }
    </style>


    <div class="notifications-page">

        <div class="notifications-wrapper">

            <div class="notifications-card">

                {{-- =================================================
                     HEADER
                ================================================== --}}

                <div class="notifications-header">

                    <h2 class="notifications-title">
                        Notifications
                    </h2>


                    {{-- MARK ALL AS READ --}}

                    <form method="POST" action="{{ route('notifications.readAll') }}" class="mark-all-form">

                        @csrf

                        <button type="submit" class="mark-all-button">
                            Mark all as read
                        </button>

                    </form>

                </div>


                {{-- =================================================
                     NEW NOTIFICATIONS
                ================================================== --}}

                @php

                    $newNotifications = auth()
                        ->user()
                        ->notifications->filter(function ($notification) {
                            return is_null($notification->read_at);
                        });

                    $earlierNotifications = auth()
                        ->user()
                        ->notifications->filter(function ($notification) {
                            return !is_null($notification->read_at);
                        });

                @endphp


                {{-- =================================================
                     NEW
                ================================================== --}}

                @if ($newNotifications->count() > 0)

                    <h3 class="notification-section-title">
                        New
                    </h3>


                    <div class="notifications-list">

                        @foreach ($newNotifications as $notification)
                            @php

                                $message = $notification->data['message'] ?? 'New notification';

                                $authorName = $notification->data['author_name'] ?? null;

                                $avatar =
                                    $notification->data['author_avatar'] ?? ($notification->data['avatar'] ?? null);

                                $initial = $authorName ? strtoupper(substr($authorName, 0, 1)) : 'N';

                            @endphp


                            <a href="{{ route('notifications.open', $notification->id) }}"
                                class="notification-item unread">

                                {{-- AVATAR --}}

                                <div class="notification-avatar">

                                    @if ($avatar)
                                        <img src="{{ asset($avatar) }}" alt="{{ $authorName ?? 'User' }}">
                                    @else
                                        <div class="notification-avatar-letter">
                                            {{ $initial }}
                                        </div>
                                    @endif

                                </div>


                                {{-- CONTENT --}}

                                <div class="notification-content">

                                    <p class="notification-main-text">

                                        @if ($authorName)
                                            <strong>
                                                {{ $authorName }}
                                            </strong>
                                        @endif

                                        {{ $message }}

                                    </p>


                                    <div class="notification-time">

                                        {{ $notification->created_at->format('l g:i A') }}

                                    </div>

                                </div>


                                {{-- UNREAD DOT --}}

                                <span class="unread-dot"></span>

                            </a>
                        @endforeach

                    </div>

                @endif


                {{-- =================================================
                     EARLIER
                ================================================== --}}

                @if ($earlierNotifications->count() > 0)

                    <h3 class="notification-section-title">
                        Earlier
                    </h3>


                    <div class="notifications-list">

                        @foreach ($earlierNotifications as $notification)
                            @php

                                $message = $notification->data['message'] ?? 'New notification';

                                $authorName = $notification->data['author_name'] ?? null;

                                $avatar =
                                    $notification->data['author_avatar'] ?? ($notification->data['avatar'] ?? null);

                                $initial = $authorName ? strtoupper(substr($authorName, 0, 1)) : 'N';

                            @endphp


                            <a href="{{ route('notifications.open', $notification->id) }}" class="notification-item">

                                {{-- AVATAR --}}

                                <div class="notification-avatar">

                                    @if ($avatar)
                                        <img src="{{ asset($avatar) }}" alt="{{ $authorName ?? 'User' }}">
                                    @else
                                        <div class="notification-avatar-letter">
                                            {{ $initial }}
                                        </div>
                                    @endif

                                </div>


                                {{-- CONTENT --}}

                                <div class="notification-content">

                                    <p class="notification-main-text">

                                        @if ($authorName)
                                            <strong>
                                                {{ $authorName }}
                                            </strong>
                                        @endif

                                        {{ $message }}

                                    </p>


                                    <div class="notification-time">

                                        {{ $notification->created_at->format('l g:i A') }}

                                    </div>

                                </div>

                            </a>
                        @endforeach

                    </div>

                @endif


                {{-- =================================================
                     EMPTY
                ================================================== --}}

                @if ($newNotifications->count() === 0 && $earlierNotifications->count() === 0)
                    <div class="notifications-empty">

                        <div class="empty-icon">
                            🔔
                        </div>

                        <h3 class="empty-title">
                            No notifications
                        </h3>

                        <p class="empty-text">
                            You don't have any notifications yet.
                        </p>

                    </div>
                @endif


                {{-- =================================================
                     NO NEW NOTIFICATIONS
                ================================================== --}}

                @if ($newNotifications->count() === 0 && $earlierNotifications->count() > 0)
                    {{-- New section intentionally hidden when empty --}}
                @endif

            </div>

        </div>

    </div>

</x-app-layout>
