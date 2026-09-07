<x-app-layout>

```
<style>
    /* =========================================================
       STUDENT NOTIFICATIONS
    ========================================================== */

    .student-notifications-page {
        margin-left: 263px;
        min-height: 100vh;
        padding: 110px 35px 40px;
        /* background: #f5f6f8; */
        box-sizing: border-box;
    }

    .student-notifications-container {
        width: 100%;
        /* max-width: 1050px; */
        margin: 0 auto;
    }


    /* =========================================================
       PAGE HEADER
    ========================================================== */

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

        background: #1877f2;
        color: #ffffff;

        font-size: 18px;

        box-shadow: 0 4px 10px rgba(24, 119, 242, 0.18);
    }

    .student-header-title {
        margin: 0;

        color: #15171a;

        font-size: 24px;
        font-weight: 700;
        line-height: 1.2;
    }

    .student-header-description {
        margin: 5px 0 0;

        color: #73777d;

        font-size: 13px;
    }


    /* =========================================================
       MARK ALL
    ========================================================== */

    .student-mark-all-form {
        margin: 0;
    }

    .student-mark-all-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        padding: 9px 14px;

        border: 1px solid #d9e4f4;
        border-radius: 8px;

        background: #ffffff;
        color: #1877f2;

        font-size: 12px;
        font-weight: 600;

        cursor: pointer;

        transition:
            background 0.2s ease,
            border-color 0.2s ease,
            transform 0.15s ease;
    }

    .student-mark-all-button:hover {
        background: #edf4ff;
        border-color: #bcd4f7;
    }

    .student-mark-all-button:active {
        transform: translateY(1px);
    }


    /* =========================================================
       SUCCESS ALERT
    ========================================================== */

    .student-notification-success {
        display: flex;
        align-items: center;
        gap: 9px;

        margin-bottom: 18px;
        padding: 12px 15px;

        background: #effaf3;
        border: 1px solid #ccebd7;

        border-radius: 9px;

        color: #16803d;

        font-size: 13px;
        font-weight: 500;
    }


    /* =========================================================
       NOTIFICATIONS PANEL
    ========================================================== */

    .student-notifications-panel {
        background: #ffffff;

        border: 1px solid #e5e7eb;
        border-radius: 13px;

        overflow: hidden;

        box-shadow:
            0 2px 8px rgba(0, 0, 0, 0.04);
    }


    /* =========================================================
       NOTIFICATION ITEM
    ========================================================== */

    .student-notification-item {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        padding: 18px 20px;

        border-bottom: 1px solid #edf0f3;

        background: #ffffff;

        transition:
            background 0.2s ease;
    }

    .student-notification-item:last-child {
        border-bottom: none;
    }

    .student-notification-item:hover {
        background: #fafbfc;
    }


    /* =========================================================
       UNREAD
    ========================================================== */

    .student-notification-item.unread {
        background: #f7faff;
    }

    .student-notification-item.unread:hover {
        background: #f0f6ff;
    }


    /* =========================================================
       NOTIFICATION MAIN
    ========================================================== */

    .student-notification-main {
        display: flex;
        align-items: flex-start;

        gap: 14px;

        flex: 1;
        min-width: 0;
    }


    /* =========================================================
       STATUS ICON
    ========================================================== */

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
        background: #eaf2ff;
        color: #1877f2;
    }

    .student-notification-icon.approved {
        background: #eaf8ef;
        color: #16a34a;
    }

    .student-notification-icon.rejected {
        background: #fff0f0;
        color: #dc2626;
    }


    /* =========================================================
       UNREAD INDICATOR
    ========================================================== */

    .student-unread-indicator {
        position: absolute;

        top: -3px;
        right: -3px;

        width: 9px;
        height: 9px;

        border: 2px solid #ffffff;

        border-radius: 50%;

        background: #1877f2;
    }


    /* =========================================================
       CONTENT
    ========================================================== */

    .student-notification-content {
        min-width: 0;
        flex: 1;
    }

    .student-notification-message {
        margin: 0;

        color: #202328;

        font-size: 14px;
        font-weight: 600;

        line-height: 1.45;

        word-break: break-word;
    }

    .student-notification-thesis {
        display: block;

        margin-top: 5px;

        color: #656a72;

        font-size: 12px;

        line-height: 1.4;
    }

    .student-notification-thesis strong {
        color: #34383e;
    }


    /* =========================================================
       META
    ========================================================== */

    .student-notification-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 7px;

        margin-top: 8px;
    }

    .student-notification-time {
        color: #8a8f97;

        font-size: 11px;
    }


    /* =========================================================
       STATUS
    ========================================================== */

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
        background: #e8f8ee;
        color: #15803d;
    }

    .student-status.rejected {
        background: #ffeded;
        color: #b91c1c;
    }


    /* =========================================================
       NEW
    ========================================================== */

    .student-new {
        display: inline-flex;
        align-items: center;

        padding: 4px 8px;

        border-radius: 5px;

        background: #eaf2ff;
        color: #1877f2;

        font-size: 10px;
        font-weight: 700;
    }


    /* =========================================================
       ACTIONS
    ========================================================== */

    .student-notification-actions {
        display: flex;
        align-items: center;
        gap: 10px;

        flex-shrink: 0;
    }


    /* =========================================================
       VIEW BUTTON
    ========================================================== */

    .student-view-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;

        min-width: 112px;

        padding: 8px 12px;

        border-radius: 7px;

        color: #ffffff;

        text-decoration: none;

        font-size: 11px;
        font-weight: 600;

        transition:
            background 0.2s ease,
            transform 0.15s ease;
    }

    .student-view-button:hover {
        color: #ffffff;
        transform: translateY(-1px);
    }

    .student-view-button.default {
        background: #1877f2;
    }

    .student-view-button.default:hover {
        background: #0d65d9;
    }

    .student-view-button.approved {
        background: #16a34a;
    }

    .student-view-button.approved:hover {
        background: #15803d;
    }

    .student-view-button.rejected {
        background: #dc2626;
    }

    .student-view-button.rejected:hover {
        background: #b91c1c;
    }


    /* =========================================================
       MARK READ
    ========================================================== */

    .student-mark-read-form {
        margin: 0;
    }

    .student-mark-read-button {
        padding: 5px 0;

        border: none;

        background: transparent;

        color: #1877f2;

        font-size: 11px;
        font-weight: 600;

        cursor: pointer;

        white-space: nowrap;
    }

    .student-mark-read-button:hover {
        color: #0d65d9;
        text-decoration: underline;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================== */

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

        background: #eaf2ff;
        color: #1877f2;

        font-size: 22px;
    }

    .student-empty-title {
        margin: 0;

        color: #202328;

        font-size: 17px;
        font-weight: 700;
    }

    .student-empty-text {
        margin: 6px 0 0;

        color: #858a91;

        font-size: 13px;
    }


    /* =========================================================
       TABLET
    ========================================================== */

    @media (max-width: 900px) {

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


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 600px) {

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


        /* Notification */

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


        /* Actions */

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


        {{-- =================================================
             PAGE HEADER
        ================================================== --}}

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


            {{-- MARK ALL AS READ --}}

            @if (auth()->user()->unreadNotifications->count() > 0)

                <form
                    method="POST"
                    action="{{ route('notifications.readAll') }}"
                    class="student-mark-all-form"
                >

                    @csrf

                    <button
                        type="submit"
                        class="student-mark-all-button"
                    >

                        <i class="bi bi-check2-all"></i>

                        Mark all as read

                    </button>

                </form>

            @endif

        </div>


        {{-- =================================================
             SUCCESS MESSAGE
        ================================================== --}}

        @if (session('success'))

            <div class="student-notification-success">

                <i class="bi bi-check-circle-fill"></i>

                {{ session('success') }}

            </div>

        @endif


        {{-- =================================================
             NOTIFICATIONS
        ================================================== --}}

        <div class="student-notifications-panel">

            @forelse (auth()->user()->notifications as $notification)

                @php
                    $status = $notification->data['status'] ?? null;
                    $isUnread = is_null($notification->read_at);
                @endphp


                {{-- =================================================
                     NOTIFICATION
                ================================================== --}}

                <div
                    class="student-notification-item
                        {{ $isUnread ? 'unread' : '' }}"
                >


                    {{-- =================================================
                         MAIN CONTENT
                    ================================================== --}}

                    <div class="student-notification-main">


                        {{-- STATUS ICON --}}

                        <div
                            class="student-notification-icon
                                {{ $status === 'approved'
                                    ? 'approved'
                                    : ($status === 'rejected'
                                        ? 'rejected'
                                        : 'default') }}"
                        >

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


                        {{-- CONTENT --}}

                        <div class="student-notification-content">

                            <p class="student-notification-message">

                                {{ $notification->data['message'] ?? 'You have a new notification.' }}

                            </p>


                            {{-- THESIS --}}

                            @if (!empty($notification->data['title']))

                                <span class="student-notification-thesis">

                                    <strong>Thesis:</strong>

                                    {{ $notification->data['title'] }}

                                </span>

                            @endif


                            {{-- META --}}

                            <div class="student-notification-meta">


                                {{-- STATUS --}}

                                @if (!empty($status))

                                    <span
                                        class="student-status
                                            {{ $status === 'approved'
                                                ? 'approved'
                                                : 'rejected' }}"
                                    >

                                        {{ ucfirst($status) }}

                                    </span>

                                @endif


                                {{-- TIME --}}

                                <span class="student-notification-time">

                                    {{ $notification->created_at->diffForHumans() }}

                                </span>


                                {{-- NEW --}}

                                @if ($isUnread)

                                    <span class="student-new">
                                        New
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         ACTIONS
                    ================================================== --}}

                    <div class="student-notification-actions">


                        {{-- APPROVED --}}

                        @if ($status === 'approved')

                            <a
                                href="{{ route('notifications.open', $notification->id) }}"
                                class="student-view-button approved"
                            >

                                <i class="bi bi-eye"></i>

                                View Thesis

                            </a>


                        {{-- REJECTED --}}

                        @elseif ($status === 'rejected')

                            <a
                                href="{{ route('notifications.open', $notification->id) }}"
                                class="student-view-button rejected"
                            >

                                <i class="bi bi-chat-left-text"></i>

                                View & Comment

                            </a>


                        {{-- OTHER --}}

                        @else

                            <a
                                href="{{ route('notifications.open', $notification->id) }}"
                                class="student-view-button default"
                            >

                                <i class="bi bi-eye"></i>

                                View

                            </a>

                        @endif


                        {{-- MARK AS READ --}}

                        @if ($isUnread)

                            <form
                                method="POST"
                                action="{{ route('notifications.read', $notification->id) }}"
                                class="student-mark-read-form"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="student-mark-read-button"
                                >

                                    Mark as read

                                </button>

                            </form>

                        @endif

                    </div>

                </div>


            @empty


                {{-- =================================================
                     EMPTY STATE
                ================================================== --}}

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
```

</x-app-layout>
