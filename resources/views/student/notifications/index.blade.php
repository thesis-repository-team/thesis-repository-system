<x-app-layout>
    <style>
        :root {
            --bg-page: #f5f6f8;
            --bg-card: #ffffff;
            --bg-hover: #fafbfc;
            --bg-unread: #f7faff;
            --bg-unread-hover: #f0f6ff;
            --bg-blue-soft: #eaf2ff;
            --text-main: #202328;
            --text-heading: #15171a;
            --text-muted: #73777d;
            --text-light: #8a8f97;
            --border: #e5e7eb;
            --border-light: #edf0f3;
            --blue: #1877f2;
            --blue-hover: #0d65d9;
            --success: #16a34a;
            --success-bg: #effaf3;
            --success-border: #ccebd7;
            --danger: #dc2626;
            --danger-bg: #fff0f0;
        }

        [data-bs-theme="dark"] {
            --bg-page: #101426;
            --bg-card: #181D33;
            --bg-hover: #20253A;
            --bg-unread: #1F2A44;
            --bg-unread-hover: #263454;
            --bg-blue-soft: #24324F;
            --text-main: #FFFFFF;
            --text-heading: #FFFFFF;
            --text-muted: #B7BDD4;
            --text-light: #999FB9;
            --border: #292E45;
            --border-light: #24293D;
            --blue: #5B9CFF;
            --blue-hover: #79AEFF;
            --success: #4ADE80;
            --success-bg: rgba(20, 83, 45, .20);
            --success-border: rgba(74, 222, 128, .28);
            --danger: #F87171;
            --danger-bg: rgba(127, 29, 29, .20);
        }

        .student-notifications-page {
            margin-left: 263px;
            min-height: 100vh;
            padding: 110px 30px 40px;
            background: var(--bg-page);
            box-sizing: border-box;
        }

        .student-notifications-container {
            width: 100%;
            margin: 20px auto;
        }

        .student-notifications-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .student-header-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .student-header-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--blue);
            color: #fff;
            font-size: 18px;
            box-shadow: 0 4px 10px rgba(24, 119, 242, .18);
        }

        .student-header-title {
            margin: 0;
            color: var(--text-heading);
            font-size: 24px;
            font-weight: 700;
            line-height: 1.2;
        }

        .student-header-description {
            margin: 5px 0 0;
            color: var(--text-muted);
            font-size: 13px;
        }

        .student-mark-all-form {
            margin: 0;
        }

        .student-mark-all-button {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--bg-card);
            color: var(--blue);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s ease, border-color .2s ease, transform .15s ease;
        }

        .student-mark-all-button:hover {
            background: var(--bg-blue-soft);
            border-color: var(--blue);
        }

        .student-mark-all-button:active {
            transform: translateY(1px);
        }

        .student-notification-success {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 18px;
            padding: 12px 15px;
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            border-radius: 9px;
            color: var(--success);
            font-size: 13px;
            font-weight: 500;
        }

        .student-notifications-panel {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 13px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
        }

        .student-notification-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--border-light);
            background: var(--bg-card);
            transition: background .2s ease;
        }

        .student-notification-item:last-child {
            border-bottom: none;
        }

        .student-notification-item:hover {
            background: var(--bg-hover);
        }

        .student-notification-item.unread {
            background: var(--bg-unread);
        }

        .student-notification-item.unread:hover {
            background: var(--bg-unread-hover);
        }

        .student-notification-main {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            flex: 1;
            min-width: 0;
        }

        .student-notification-icon {
            position: relative;
            width: 45px;
            height: 45px;
            flex: 0 0 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            font-size: 17px;
        }

        .student-notification-icon.default {
            background: var(--bg-blue-soft);
            color: var(--blue);
        }

        .student-notification-icon.approved {
            background: rgba(22, 163, 74, .12);
            color: var(--success);
        }

        .student-notification-icon.rejected {
            background: rgba(220, 38, 38, .12);
            color: var(--danger);
        }

        .student-unread-indicator {
            position: absolute;
            top: -3px;
            right: -3px;
            width: 9px;
            height: 9px;
            border: 2px solid var(--bg-card);
            border-radius: 50%;
            background: var(--blue);
        }

        .student-notification-content {
            min-width: 0;
            flex: 1;
        }

        .student-notification-message {
            margin: 0;
            color: var(--text-main);
            font-size: 14px;
            font-weight: 600;
            line-height: 1.45;
            word-break: break-word;
        }

        .student-notification-thesis {
            display: block;
            margin-top: 5px;
            color: var(--text-muted);
            font-size: 12px;
            line-height: 1.4;
        }

        .student-notification-thesis strong {
            color: var(--text-main);
        }

        .student-notification-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 7px;
            margin-top: 8px;
        }

        .student-notification-time {
            color: var(--text-light);
            font-size: 11px;
        }

        .student-status {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 10px;
            font-weight: 700;
            line-height: 1;
        }

        .student-status.approved {
            background: rgba(22, 163, 74, .12);
            color: var(--success);
        }

        .student-status.rejected {
            background: rgba(220, 38, 38, .12);
            color: var(--danger);
        }

        .student-new {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 5px;
            background: var(--bg-blue-soft);
            color: var(--blue);
            font-size: 10px;
            font-weight: 700;
        }

        .student-notification-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .student-view-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-width: 112px;
            padding: 8px 12px;
            border-radius: 7px;
            color: #fff;
            text-decoration: none;
            font-size: 11px;
            font-weight: 600;
            transition: background .2s ease, transform .15s ease;
        }

        .student-view-button:hover {
            color: #fff;
            transform: translateY(-1px);
        }

        .student-view-button.default {
            background: var(--blue);
        }

        .student-view-button.default:hover {
            background: var(--blue-hover);
        }

        .student-view-button.approved {
            background: var(--success);
        }

        .student-view-button.approved:hover {
            filter: brightness(.95);
        }

        .student-view-button.rejected {
            background: var(--danger);
        }

        .student-view-button.rejected:hover {
            filter: brightness(.95);
        }

        .student-mark-read-form {
            margin: 0;
        }

        .student-mark-read-button {
            padding: 5px 0;
            border: none;
            background: transparent;
            color: var(--blue);
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }

        .student-mark-read-button:hover {
            color: var(--blue-hover);
            text-decoration: underline;
        }

        .student-notifications-empty {
            padding: 85px 20px;
            text-align: center;
        }

        .student-empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--bg-blue-soft);
            color: var(--blue);
            font-size: 22px;
        }

        .student-empty-title {
            margin: 0;
            color: var(--text-main);
            font-size: 17px;
            font-weight: 700;
        }

        .student-empty-text {
            margin: 6px 0 0;
            color: var(--text-muted);
            font-size: 13px;
        }

        @media (max-width:900px) {
            .student-notifications-page {
                margin-left: 263px;
                padding: 110px 20px 35px;
            }

            .student-notification-item {
                align-items: flex-start;
            }

            .student-notification-actions {
                flex-direction: column;
                align-items: flex-end;
            }
        }

        @media (max-width:600px) {
            .student-notifications-page {
                margin-left: 0;
                padding: 90px 10px 30px;
            }

            .student-notifications-header {
                flex-direction: column;
                align-items: stretch;
                margin-bottom: 18px;
            }

            .student-header-left {
                align-items: flex-start;
            }

            .student-header-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
            }

            .student-header-title {
                font-size: 20px;
            }

            .student-header-description {
                font-size: 12px;
            }

            .student-mark-all-form {
                width: 100%;
            }

            .student-mark-all-button {
                width: 100%;
                justify-content: center;
            }

            .student-notification-item {
                flex-direction: column;
                align-items: stretch;
                padding: 16px;
                gap: 13px;
            }

            .student-notification-main {
                gap: 11px;
            }

            .student-notification-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                font-size: 15px;
            }

            .student-notification-message {
                font-size: 13px;
            }

            .student-notification-thesis {
                font-size: 12px;
            }

            .student-notification-actions {
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                gap: 6px;
            }

            .student-view-button {
                width: 100%;
            }

            .student-mark-read-button {
                width: 100%;
                padding: 5px;
                text-align: center;
            }
        }
    </style>

    <div class="student-notifications-page">
        <div class="student-notifications-container">
            <div class="student-notifications-header">
                <div class="student-header-left">
                    <div class="student-header-icon">
                        <i class="bi bi-bell-fill"></i>
                    </div>
                    <div>
                        <h2 class="student-header-title">
                            Notifications
                        </h2>
                        <p class="student-header-description">
                            View updates about your thesis requests
                        </p>
                    </div>
                </div>

                @if (auth()->user()->unreadNotifications->count() > 0)
                    <form method="POST" action="{{ route('notifications.readAll') }}" class="student-mark-all-form">
                        @csrf
                        <button type="submit" class="student-mark-all-button">
                            <i class="bi bi-check2-all"></i>
                            Mark all as read
                        </button>
                    </form>
                @endif
            </div>

            @if (session('success'))
                <div class="student-notification-success">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="student-notifications-panel">
                @forelse (auth()->user()->notifications as $notification)
                    @php
                        $status = $notification->data['status'] ?? null;
                        $isUnread = is_null($notification->read_at);
                    @endphp

                    <div class="student-notification-item {{ $isUnread ? 'unread' : '' }}">
                        <div class="student-notification-main">
                            <div
                                class="student-notification-icon {{ $status === 'approved' ? 'approved' : ($status === 'rejected' ? 'rejected' : 'default') }}">
                                @if ($status === 'approved')
                                    <i class="bi bi-check-lg"></i>
                                @elseif ($status === 'rejected')
                                    <i class="bi bi-x-lg"></i>
                                @else
                                    <i class="bi bi-bell-fill"></i>
                                @endif

                                @if ($isUnread)
                                    <span class="student-unread-indicator"></span>
                                @endif
                            </div>

                            <div class="student-notification-content">
                                <p class="student-notification-message">
                                    {{ $notification->data['message'] ?? 'You have a new notification.' }}
                                </p>

                                @if (!empty($notification->data['title']))
                                    <span class="student-notification-thesis">
                                        <strong>Thesis:</strong>
                                        {{ $notification->data['title'] }}
                                    </span>
                                @endif

                                <div class="student-notification-meta">
                                    @if (!empty($status))
                                        <span
                                            class="student-status {{ $status === 'approved' ? 'approved' : 'rejected' }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    @endif

                                    <span class="student-notification-time">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </span>

                                    @if ($isUnread)
                                        <span class="student-new">
                                            New
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="student-notification-actions">
                            @if ($status === 'approved')
                                <a href="{{ route('notifications.open', $notification->id) }}"
                                    class="student-view-button approved">
                                    <i class="bi bi-eye"></i>
                                    View Thesis
                                </a>
                            @elseif ($status === 'rejected')
                                <a href="{{ route('notifications.open', $notification->id) }}"
                                    class="student-view-button rejected">
                                    <i class="bi bi-chat-left-text"></i>
                                    View & Comment
                                </a>
                            @else
                                <a href="{{ route('notifications.open', $notification->id) }}"
                                    class="student-view-button default">
                                    <i class="bi bi-eye"></i>
                                    View
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="student-notifications-empty">
                        <div class="student-empty-icon">
                            <i class="bi bi-bell"></i>
                        </div>
                        <h3 class="student-empty-title">
                            No notifications
                        </h3>
                        <p class="student-empty-text">
                            You don't have any notifications yet.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
