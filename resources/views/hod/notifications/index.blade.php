<x-app-layout>


<style>
    /* =========================================================
       HOD NOTIFICATIONS PAGE
    ========================================================== */

    .hod-notifications-page {
        margin-left: 263px;
        padding: 118px 30px 40px;
        min-height: 100vh;
        /* background: #f0f2f5; */
        box-sizing: border-box;
    }

    .hod-notifications-wrapper {
        width: 100%;
        margin: 0 auto;
    }

    /* =========================================================
       MAIN CARD
    ========================================================== */

    .hod-notifications-card {
        width: 100%;
        background: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    /* =========================================================
       HEADER
    ========================================================== */

    .hod-notifications-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 22px;
        background: #ffffff;
        border-bottom: 1px solid #eeeeee;
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
        background: #f0ebff;
        color: #6538d9;
        font-size: 18px;
    }

    .hod-notifications-title {
        margin: 0;
        color: #11182f;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.2;
    }

    /* =========================================================
       MARK ALL AS READ
    ========================================================== */

    .hod-mark-all-form {
        margin: 0;
    }

    .hod-mark-all-button {
        border: none;
        background: transparent;
        color: #6538d9;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        padding: 7px 9px;
        border-radius: 6px;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .hod-mark-all-button:hover {
        background: #f0ebff;
        color: #4f29b5;
    }

    /* =========================================================
       SECTION TITLE
    ========================================================== */

    .hod-notification-section-title {
        margin: 0;
        padding: 16px 22px 9px;
        background: #ffffff;
        color: #11182f;
        font-size: 15px;
        font-weight: 700;
        line-height: 1.3;
    }

    /* =========================================================
       NOTIFICATION LIST
    ========================================================== */

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
        background: #ffffff;
        box-sizing: border-box;
        border-bottom: 1px solid #f1f1f1;
        transition: background 0.15s ease;
    }

    .hod-notification-item:last-child {
        border-bottom: none;
    }

    .hod-notification-item:hover {
        background: #f7f7f9;
    }

    /* =========================================================
       UNREAD
    ========================================================== */

    .hod-notification-item.unread {
        background: #f3f0ff;
    }

    .hod-notification-item.unread:hover {
        background: #ebe6ff;
    }

    /* =========================================================
       AVATAR
    ========================================================== */

    .hod-notification-avatar {
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

    /* =========================================================
       NOTIFICATION CONTENT
    ========================================================== */

    .hod-notification-content {
        flex: 1;
        min-width: 0;
    }

    .hod-notification-main-text {
        margin: 0;
        color: #11182f;
        font-size: 14px;
        line-height: 1.45;
        word-break: break-word;
    }

    .hod-notification-main-text strong {
        color: #11182f;
        font-weight: 700;
    }

    .hod-notification-time {
        margin-top: 3px;
        color: #777b86;
        font-size: 12px;
        line-height: 1.3;
    }

    /* =========================================================
       UNREAD DOT
    ========================================================== */

    .hod-unread-dot {
        flex: 0 0 9px;
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #6538d9;
    }

    /* =========================================================
       EMPTY SECTION
    ========================================================== */

    .hod-notification-empty-section {
        padding: 10px 22px 18px;
        background: #ffffff;
        color: #777b86;
        font-size: 13px;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .hod-notifications-empty {
        padding: 80px 20px;
        text-align: center;
        background: #ffffff;
    }

    .hod-empty-icon {
        width: 54px;
        height: 54px;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f0ebff;
        color: #6538d9;
        font-size: 21px;
    }

    .hod-empty-title {
        margin: 0;
        color: #11182f;
        font-size: 16px;
        font-weight: 700;
    }

    .hod-empty-text {
        margin: 6px 0 0;
        color: #777b86;
        font-size: 13px;
    }

    /* =========================================================
       LARGE DESKTOP
    ========================================================== */

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

    /* =========================================================
       TABLET
    ========================================================== */

    @media (max-width: 900px) {

        .hod-notifications-page {
            margin-left: 263px;
            padding: 118px 20px 35px;
        }
    }

    /* =========================================================
       MOBILE
    ========================================================== */

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

            {{-- =================================================
                 HEADER
            ================================================== --}}

            <div class="hod-notifications-header">

                <div class="hod-notifications-title-wrapper">

                    <div class="hod-notifications-title-icon">
                        <i class="bi bi-bell-fill"></i>
                    </div>

                    <h2 class="hod-notifications-title">
                        Notifications
                    </h2>

                </div>


                {{-- MARK ALL AS READ --}}

                <form
                    method="POST"
                    action="{{ route('notifications.readAll') }}"
                    class="hod-mark-all-form"
                >

                    @csrf

                    <button
                        type="submit"
                        class="hod-mark-all-button"
                    >
                        Mark all as read
                    </button>

                </form>

            </div>


            {{-- =================================================
                 GET NOTIFICATIONS
            ================================================== --}}

            @php

                $newNotifications = auth()
                    ->user()
                    ->notifications
                    ->filter(function ($notification) {
                        return is_null($notification->read_at);
                    });

                $earlierNotifications = auth()
                    ->user()
                    ->notifications
                    ->filter(function ($notification) {
                        return !is_null($notification->read_at);
                    });

            @endphp


            {{-- =================================================
                 NEW NOTIFICATIONS
            ================================================== --}}

            @if ($newNotifications->count() > 0)

                <h3 class="hod-notification-section-title">
                    New
                </h3>

                <div class="hod-notifications-list">

                    @foreach ($newNotifications as $notification)

                        @php

                            $message =
                                $notification->data['message']
                                ?? 'New notification';

                            $authorName =
                                $notification->data['author_name']
                                ?? null;

                            $avatar =
                                $notification->data['author_avatar']
                                ?? ($notification->data['avatar'] ?? null);

                            $initial =
                                $authorName
                                ? strtoupper(substr($authorName, 0, 1))
                                : 'N';

                        @endphp


                        <a
                            href="{{ route('notifications.open', $notification->id) }}"
                            class="hod-notification-item unread"
                        >

                            {{-- AVATAR --}}

                            <div class="hod-notification-avatar">

                                @if ($avatar)

                                    <img
                                        src="{{ asset($avatar) }}"
                                        alt="{{ $authorName ?? 'User' }}"
                                    >

                                @else

                                    <div class="hod-notification-avatar-letter">
                                        {{ $initial }}
                                    </div>

                                @endif

                            </div>


                            {{-- CONTENT --}}

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

                                    {{ $notification->created_at->format('l g:i A') }}

                                </div>

                            </div>


                            {{-- UNREAD DOT --}}

                            <span class="hod-unread-dot"></span>

                        </a>

                    @endforeach

                </div>

            @endif


            {{-- =================================================
                 EARLIER NOTIFICATIONS
            ================================================== --}}

            @if ($earlierNotifications->count() > 0)

                <h3 class="hod-notification-section-title">
                    Earlier
                </h3>

                <div class="hod-notifications-list">

                    @foreach ($earlierNotifications as $notification)

                        @php

                            $message =
                                $notification->data['message']
                                ?? 'New notification';

                            $authorName =
                                $notification->data['author_name']
                                ?? null;

                            $avatar =
                                $notification->data['author_avatar']
                                ?? ($notification->data['avatar'] ?? null);

                            $initial =
                                $authorName
                                ? strtoupper(substr($authorName, 0, 1))
                                : 'N';

                        @endphp


                        <a
                            href="{{ route('notifications.open', $notification->id) }}"
                            class="hod-notification-item"
                        >

                            {{-- AVATAR --}}

                            <div class="hod-notification-avatar">

                                @if ($avatar)

                                    <img
                                        src="{{ asset($avatar) }}"
                                        alt="{{ $authorName ?? 'User' }}"
                                    >

                                @else

                                    <div class="hod-notification-avatar-letter">
                                        {{ $initial }}
                                    </div>

                                @endif

                            </div>


                            {{-- CONTENT --}}

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

                                    {{ $notification->created_at->format('l g:i A') }}

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

            @endif


            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            @if (
                $newNotifications->count() === 0 &&
                $earlierNotifications->count() === 0
            )

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
