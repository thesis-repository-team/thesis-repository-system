<x-app-layout>

    <style>
        :root {
            --bg-page: #f0f2f5;
            --bg-card: #ffffff;
            --bg-hover: #f7f7f9;
            --bg-unread: #f3f0ff;
            --bg-unread-hover: #ebe6ff;
            --bg-purple-soft: #f0ebff;
            --text-main: #11182f;
            --text-muted: #777b86;
            --border: #eeeeee;
            --border-light: #f1f1f1;
            --purple: #6538d9;
            --purple-hover: #4f29b5;
        }

        [data-bs-theme="dark"] {
            --bg-page: #101426;
            --bg-card: #181D33;
            --bg-hover: #20253A;
            --bg-unread: #292342;
            --bg-unread-hover: #342C52;
            --bg-purple-soft: #292342;
            --text-main: #FFFFFF;
            --text-muted: #B7BDD4;
            --border: #292E45;
            --border-light: #24293D;
            --purple: #7C5CE3;
            --purple-hover: #9278EA;
        }

        .hod-notifications-page {
            margin-left: 263px;
            padding: 118px 30px 40px;
            min-height: 100vh;
            background: var(--bg-page);
            box-sizing: border-box;
        }

        .hod-notifications-wrapper {
            width: 100%;
            margin: 0 auto;
        }

        .hod-notifications-card {
            width: 100%;
            background: var(--bg-card);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
        }

        .hod-notifications-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
        }

        .hod-notifications-title-wrapper {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .hod-notifications-title-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--bg-purple-soft);
            color: var(--purple);
            font-size: 18px;
        }

        .hod-notifications-title {
            margin: 0;
            color: var(--text-main);
            font-size: 22px;
            font-weight: 700;
            line-height: 1.2;
        }

        .hod-mark-all-form {
            margin: 0;
        }

        .hod-mark-all-button {
            border: none;
            background: transparent;
            color: var(--purple);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            padding: 7px 9px;
            border-radius: 6px;
            transition: background .2s ease, color .2s ease;
        }

        .hod-mark-all-button:hover {
            background: var(--bg-purple-soft);
            color: var(--purple-hover);
        }

        .hod-notification-section-title {
            margin: 0;
            padding: 16px 22px 9px;
            background: var(--bg-card);
            color: var(--text-main);
            font-size: 15px;
            font-weight: 700;
            line-height: 1.3;
        }

        .hod-notifications-list {
            width: 100%;
        }

        .hod-notification-item {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            padding: 13px 22px;
            gap: 13px;
            text-decoration: none;
            background: var(--bg-card);
            box-sizing: border-box;
            border-bottom: 1px solid var(--border-light);
            transition: background .15s ease;
        }

        .hod-notification-item:last-child {
            border-bottom: none;
        }

        .hod-notification-item:hover {
            background: var(--bg-hover);
        }

        .hod-notification-item.unread {
            background: var(--bg-unread);
        }

        .hod-notification-item.unread:hover {
            background: var(--bg-unread-hover);
        }

        .hod-notification-avatar {
            flex: 0 0 48px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            overflow: hidden;
            background: var(--bg-hover);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 600;
            box-sizing: border-box;
        }

        .hod-notification-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .hod-notification-avatar-letter {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hod-notification-content {
            flex: 1;
            min-width: 0;
        }

        .hod-notification-main-text {
            margin: 0;
            color: var(--text-main);
            font-size: 14px;
            line-height: 1.45;
            word-break: break-word;
        }

        .hod-notification-main-text strong {
            color: var(--text-main);
            font-weight: 700;
        }

        .hod-notification-time {
            margin-top: 3px;
            color: var(--text-muted);
            font-size: 12px;
            line-height: 1.3;
        }

        .hod-unread-dot {
            flex: 0 0 9px;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--purple);
        }

        .hod-notification-empty-section {
            padding: 10px 22px 18px;
            background: var(--bg-card);
            color: var(--text-muted);
            font-size: 13px;
        }

        .hod-notifications-empty {
            padding: 80px 20px;
            text-align: center;
            background: var(--bg-card);
        }

        .hod-empty-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--bg-purple-soft);
            color: var(--purple);
            font-size: 21px;
        }

        .hod-empty-title {
            margin: 0;
            color: var(--text-main);
            font-size: 16px;
            font-weight: 700;
        }

        .hod-empty-text {
            margin: 6px 0 0;
            color: var(--text-muted);
            font-size: 13px;
        }

        @media (min-width: 1200px) {
            .hod-notifications-page {
                padding-left: 40px;
                padding-right: 40px;
            }

            .hod-notifications-header {
                padding-left: 24px;
                padding-right: 24px;
            }

            .hod-notification-section-title {
                padding-left: 24px;
                padding-right: 24px;
            }

            .hod-notification-item {
                padding-left: 24px;
                padding-right: 24px;
            }
        }

        @media (max-width: 900px) {
            .hod-notifications-page {
                margin-left: 263px;
                padding: 118px 20px 35px;
            }
        }

        @media (max-width: 600px) {
            .hod-notifications-page {
                margin-left: 0;
                padding: 90px 10px 30px;
                min-height: 100vh;
            }

            .hod-notifications-header {
                padding: 16px;
            }

            .hod-notifications-title-wrapper {
                gap: 9px;
            }

            .hod-notifications-title-icon {
                width: 34px;
                height: 34px;
                font-size: 16px;
            }

            .hod-notifications-title {
                font-size: 20px;
            }

            .hod-mark-all-button {
                font-size: 12px;
                padding: 6px;
            }

            .hod-notification-section-title {
                padding: 14px 16px 8px;
                font-size: 14px;
            }

            .hod-notification-item {
                padding: 12px 14px;
                gap: 11px;
            }

            .hod-notification-avatar {
                flex: 0 0 42px;
                width: 42px;
                height: 42px;
                font-size: 14px;
            }

            .hod-notification-main-text {
                font-size: 13px;
                line-height: 1.4;
            }

            .hod-notification-time {
                font-size: 11px;
            }

            .hod-unread-dot {
                flex: 0 0 8px;
                width: 8px;
                height: 8px;
            }
        }
    </style>

    <div class="hod-notifications-page">
        <div class="hod-notifications-wrapper">
            <div class="hod-notifications-card">
                <div class="hod-notifications-header">
                    <div class="hod-notifications-title-wrapper">
                        <div class="hod-notifications-title-icon">
                            <i class="bi bi-bell-fill"></i>
                        </div>

                        <h2 class="hod-notifications-title">
                            Notifications
                        </h2>
                    </div>

                    <form method="POST" action="{{ route('notifications.readAll') }}" class="hod-mark-all-form">
                        @csrf

                        <button type="submit" class="hod-mark-all-button">
                            Mark all as read
                        </button>
                    </form>
                </div>

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

                @if ($newNotifications->count() > 0)
                    <h3 class="hod-notification-section-title">
                        New
                    </h3>

                    <div class="hod-notifications-list">
                        @foreach ($newNotifications as $notification)
                            @php
                                $message = $notification->data['message'] ?? 'New notification';
                                $authorName = $notification->data['author_name'] ?? null;
                                $avatar =
                                    $notification->data['author_avatar'] ?? ($notification->data['avatar'] ?? null);
                                $initial = $authorName ? strtoupper(substr($authorName, 0, 1)) : 'N';
                            @endphp

                            <a href="{{ route('notifications.open', $notification->id) }}"
                                class="hod-notification-item unread">
                                <div class="hod-notification-avatar">
                                    @if ($avatar)
                                        <img src="{{ asset($avatar) }}" alt="{{ $authorName ?? 'User' }}">
                                    @else
                                        <div class="hod-notification-avatar-letter">
                                            {{ $initial }}
                                        </div>
                                    @endif
                                </div>

                                <div class="hod-notification-content">
                                    <p class="hod-notification-main-text">
                                        @if ($authorName)
                                            <strong>
                                                {{ $authorName }}
                                            </strong>
                                        @endif

                                        {{ $message }}
                                    </p>

                                    <div class="hod-notification-time">
                                        {{ $notification->created_at->format('l g\:i A') }}
                                    </div>
                                </div>

                                <span class="hod-unread-dot"></span>
                            </a>
                        @endforeach
                    </div>
                @endif

                @if ($earlierNotifications->count() > 0)
                    <h3 class="hod-notification-section-title">
                        Earlier
                    </h3>

                    <div class="hod-notifications-list">
                        @foreach ($earlierNotifications as $notification)
                            @php
                                $message = $notification->data['message'] ?? 'New notification';
                                $authorName = $notification->data['author_name'] ?? null;
                                $avatar =
                                    $notification->data['author_avatar'] ?? ($notification->data['avatar'] ?? null);
                                $initial = $authorName ? strtoupper(substr($authorName, 0, 1)) : 'N';
                            @endphp

                            <a href="{{ route('notifications.open', $notification->id) }}"
                                class="hod-notification-item">
                                <div class="hod-notification-avatar">
                                    @if ($avatar)
                                        <img src="{{ asset($avatar) }}" alt="{{ $authorName ?? 'User' }}">
                                    @else
                                        <div class="hod-notification-avatar-letter">
                                            {{ $initial }}
                                        </div>
                                    @endif
                                </div>

                                <div class="hod-notification-content">
                                    <p class="hod-notification-main-text">
                                        @if ($authorName)
                                            <strong>
                                                {{ $authorName }}
                                            </strong>
                                        @endif

                                        {{ $message }}
                                    </p>

                                    <div class="hod-notification-time">
                                        {{ $notification->created_at->format('l g\:i A') }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                @if ($newNotifications->count() === 0 && $earlierNotifications->count() === 0)
                    <div class="hod-notifications-empty">
                        <div class="hod-empty-icon">
                            <i class="bi bi-bell"></i>
                        </div>

                        <h3 class="hod-empty-title">
                            No notifications
                        </h3>

                        <p class="hod-empty-text">
                            You don't have any notifications yet.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
