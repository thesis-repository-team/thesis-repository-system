<x-app-layout>
    <style>
        :root {
            --notifications-page-bg: #f5f5f7;
            --notifications-card-bg: #ffffff;
            --notifications-item-bg: #ffffff;
            --notifications-text: #111111;
            --notifications-text-secondary: #666666;
            --notifications-text-muted: #999999;
            --notifications-border: #e5e5e5;
            --notifications-primary: #6538D9;
            --notifications-primary-hover: #542cc2;
            --notifications-unread-bg: #f3efff;
            --notifications-unread-hover: #ebe4ff;
            --notifications-avatar-bg: #eeeeef;
            --notifications-avatar-text: #666666;
            --notifications-hover: #f7f7f8;
            --notifications-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        [data-bs-theme="dark"] {
            --notifications-page-bg: #11182f;
            --notifications-card-bg: #181d33;
            --notifications-item-bg: #181d33;
            --notifications-text: #ffffff;
            --notifications-text-secondary: #c8ccdc;
            --notifications-text-muted: #9298b0;
            --notifications-border: #292e45;
            --notifications-primary: #7c5ce3;
            --notifications-primary-hover: #9278ea;
            --notifications-unread-bg: #27203d;
            --notifications-unread-hover: #30274b;
            --notifications-avatar-bg: #292e45;
            --notifications-avatar-text: #d5d8e8;
            --notifications-hover: #20253a;
            --notifications-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
        }

        [data-bs-theme="dark"] body,
        [data-bs-theme="dark"] .dashboard-content {
            background: var(--notifications-page-bg);
            color: var(--notifications-text);
        }

        .notifications-page {
            margin-left: 263px;
            padding: 118px 30px 40px;
            min-height: 100vh;
            background: var(--notifications-page-bg);
            color: var(--notifications-text);
            box-sizing: border-box;
            transition:
                background-color .2s ease,
                color .2s ease;
        }

        .notifications-wrapper {
            width: 100%;
            margin: 0 auto;
        }

        .notifications-card {
            width: 100%;
            background: var(--notifications-card-bg);
            border: 1px solid var(--notifications-border);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--notifications-shadow);
            transition:
                background-color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease;
        }

        .notifications-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            background: var(--notifications-card-bg);
            transition:
                background-color .2s ease,
                border-color .2s ease;
        }

        .notifications-title {
            margin: 0;
            color: var(--notifications-text);
            font-size: 22px;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -0.2px;
            transition: color .2s ease;
        }

        .mark-all-form {
            margin: 0;
        }

        .mark-all-button {
            border: none;
            background: transparent;
            color: var(--notifications-primary);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            padding: 7px 8px;
            border-radius: 6px;
            transition:
                background-color .2s ease,
                color .2s ease;
        }

        .mark-all-button:hover {
            background: var(--notifications-hover);
            color: var(--notifications-primary-hover);
        }

        .notification-section-title {
            margin: 0;
            padding: 15px 22px 9px;
            background: var(--notifications-card-bg);
            color: var(--notifications-text);
            font-size: 14px;
            font-weight: 700;
            line-height: 1.3;
            letter-spacing: .1px;
            transition:
                background-color .2s ease,
                color .2s ease;
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
            color: var(--notifications-text);
            box-sizing: border-box;
            transition:
                background-color .15s ease,
                border-color .2s ease;
        }

        .notification-item:hover {
            background: var(--notifications-hover);
            text-decoration: none;
        }

        .notification-item.unread {
            background: var(--notifications-unread-bg);
            border-left: 3px solid var(--notifications-primary);
            padding-left: 19px;
        }

        .notification-item.unread:hover {
            background: var(--notifications-unread-hover);
        }

        .notification-avatar {
            flex: 0 0 48px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            overflow: hidden;
            background: var(--notifications-avatar-bg);
            color: var(--notifications-avatar-text);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 600;
            box-sizing: border-box;
            transition:
                background-color .2s ease,
                color .2s ease;
        }

        .notification-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .notification-avatar-letter {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--notifications-avatar-text);
        }

        .notification-content {
            flex: 1;
            min-width: 0;
        }

        .notification-main-text {
            margin: 0;
            color: var(--notifications-text);
            font-size: 14px;
            line-height: 1.45;
            word-break: break-word;
            transition: color .2s ease;
        }

        .notification-main-text strong {
            color: var(--notifications-text);
            font-weight: 700;
            transition: color .2s ease;
        }

        .notification-time {
            margin-top: 3px;
            color: var(--notifications-text-secondary);
            font-size: 12px;
            line-height: 1.3;
            transition: color .2s ease;
        }

        .unread-dot {
            flex: 0 0 9px;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--notifications-primary);
            box-shadow: 0 0 0 3px rgba(101, 56, 217, 0.12);
            transition: background-color .2s ease;
        }

        .notifications-empty {
            padding: 80px 20px;
            text-align: center;
            background: var(--notifications-card-bg);
            transition: background-color .2s ease;
        }

        .empty-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--notifications-avatar-bg);
            color: var(--notifications-avatar-text);
            font-size: 20px;
            transition:
                background-color .2s ease,
                color .2s ease;
        }

        .empty-title {
            margin: 0;
            color: var(--notifications-text);
            font-size: 16px;
            font-weight: 700;
            transition: color .2s ease;
        }

        .empty-text {
            margin: 6px 0 0;
            color: var(--notifications-text-secondary);
            font-size: 13px;
            transition: color .2s ease;
        }

        .notification-empty-section {
            padding: 10px 22px 18px;
            background: var(--notifications-card-bg);
            color: var(--notifications-text-secondary);
            font-size: 13px;
            transition:
                background-color .2s ease,
                color .2s ease;
        }

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

            .notification-item.unread {
                padding-left: 21px;
            }
        }

        @media (max-width: 900px) {
            .notifications-page {
                margin-left: 263px;
                padding: 118px 20px 35px;
            }
        }

        @media (max-width: 600px) {
            .notifications-page {
                margin-left: 0;
                padding: 90px 10px 30px;
                min-height: 100vh;
            }

            .notifications-card {
                border-radius: 8px;
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

            .notification-item.unread {
                padding-left: 11px;
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

        @media (max-width: 400px) {
            .notifications-page {
                padding-left: 6px;
                padding-right: 6px;
            }

            .notifications-header {
                padding: 14px;
            }

            .notifications-title {
                font-size: 18px;
            }

            .mark-all-button {
                font-size: 11px;
            }

            .notification-item {
                padding: 11px 12px;
                gap: 9px;
            }

            .notification-item.unread {
                padding-left: 9px;
            }

            .notification-avatar {
                flex: 0 0 38px;
                width: 38px;
                height: 38px;
                font-size: 13px;
            }

            .notification-main-text {
                font-size: 12px;
            }
        }
    </style>

    <div class="notifications-page">
        <div class="notifications-wrapper">
            <div class="notifications-card">
                <div class="notifications-header">
                    <h2 class="notifications-title">Notifications</h2>
                    <form method="POST" action="{{ route('notifications.readAll') }}" class="mark-all-form">
                        @csrf
                        <button type="submit" class="mark-all-button">Mark all as read</button>
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
                    <h3 class="notification-section-title">New</h3>
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
                                <div class="notification-avatar">
                                    @if ($avatar)
                                        <img src="{{ asset($avatar) }}" alt="{{ $authorName ?? 'User' }}">
                                    @else
                                        <div class="notification-avatar-letter">{{ $initial }}</div>
                                    @endif
                                </div>
                                <div class="notification-content">
                                    <p class="notification-main-text">
                                        @if ($authorName)
                                            <strong>{{ $authorName }}</strong>
                                        @endif
                                        {{ $message }}
                                    </p>
                                    <div class="notification-time">
                                        {{ $notification->created_at->format('l g:i A') }}
                                    </div>
                                </div>
                                <span class="unread-dot"></span>
                            </a>
                        @endforeach
                    </div>
                @endif

                @if ($earlierNotifications->count() > 0)
                    <h3 class="notification-section-title">Earlier</h3>
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
                                <div class="notification-avatar">
                                    @if ($avatar)
                                        <img src="{{ asset($avatar) }}" alt="{{ $authorName ?? 'User' }}">
                                    @else
                                        <div class="notification-avatar-letter">{{ $initial }}</div>
                                    @endif
                                </div>
                                <div class="notification-content">
                                    <p class="notification-main-text">
                                        @if ($authorName)
                                            <strong>{{ $authorName }}</strong>
                                        @endif
                                        {{ $message }}
                                    </p>
                                    <div class="notification-time">{{ $notification->created_at->format('l g:i A') }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                @if ($newNotifications->count() === 0 && $earlierNotifications->count() === 0)
                    <div class="notifications-empty">
                        <div class="empty-icon">🔔</div>
                        <h3 class="empty-title">No notifications</h3>
                        <p class="empty-text">You don't have any notifications yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
