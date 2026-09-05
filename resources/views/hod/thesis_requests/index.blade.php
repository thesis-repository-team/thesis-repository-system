<x-app-layout>

    <div class="dashboard-content thesis-requests-page">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="request-page-header">

            <div class="request-header-content">

                <span class="request-overline">
                    MANAGEMENT
                </span>

                <h1 class="request-page-title">
                    Thesis Requests
                </h1>

                <p class="request-page-description">
                    Review thesis upload requests and their submission information.
                </p>

            </div>

            <div class="request-header-icon">
                <i class="bi bi-journal-check"></i>
            </div>

        </div>


        {{-- =========================================================
            ERROR ALERT
        ========================================================== --}}

        @if (session('error'))

            <div class="request-alert">

                <div class="alert-icon">
                    <i class="bi bi-exclamation-circle-fill"></i>
                </div>

                <div class="alert-content">

                    <strong>
                        Action Failed
                    </strong>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            </div>

        @endif


        {{-- =========================================================
            SUCCESS ALERT
        ========================================================== --}}

        @if (session('success'))

            <div class="request-success">

                <div class="alert-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

                <div class="alert-content">

                    <strong>
                        Success
                    </strong>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            </div>

        @endif


        {{-- =========================================================
            REQUEST GRID
        ========================================================== --}}

        <div class="request-grid">

            @forelse ($thesisRequests as $thesisRequest)

                <article class="request-card">

                    {{-- =================================================
                        CARD CONTENT
                    ================================================== --}}

                    <div class="request-card-content">

                        {{-- =================================================
                            TITLE + STATUS
                        ================================================== --}}

                        <div class="request-title-row">

                            <div class="request-title-area">

                                <div class="request-title-with-icon">

                                    <i class="bi bi-journal-text"></i>

                                    <h3
                                        class="request-title"
                                        title="{{ $thesisRequest->title }}"
                                    >
                                        {{ $thesisRequest->title }}
                                    </h3>

                                </div>

                            </div>


                            {{-- STATUS --}}

                            @if ($thesisRequest->status === 'pending')

                                <span class="request-status pending">

                                    <i class="bi bi-clock"></i>

                                    Pending

                                </span>

                            @elseif ($thesisRequest->status === 'approved')

                                <span class="request-status approved">

                                    <i class="bi bi-check-circle"></i>

                                    Approved

                                </span>

                            @elseif ($thesisRequest->status === 'rejected')

                                <span class="request-status rejected">

                                    <i class="bi bi-x-circle"></i>

                                    Rejected

                                </span>

                            @else

                                <span class="request-status unknown">

                                    <i class="bi bi-question-circle"></i>

                                    {{ ucfirst($thesisRequest->status ?? 'Unknown') }}

                                </span>

                            @endif

                        </div>


                        {{-- =================================================
                            INFORMATION
                        ================================================== --}}

                        <div class="request-information">


                            {{-- DEPARTMENT --}}

                            <div class="request-info">

                                <div class="request-info-icon">
                                    <i class="bi bi-building"></i>
                                </div>

                                <div class="request-info-content">

                                    <span>
                                        Department
                                    </span>

                                    <strong>
                                        {{ $thesisRequest->department?->name ?? 'N/A' }}
                                    </strong>

                                </div>

                            </div>


                            {{-- AUTHOR --}}

                            <div class="request-info">

                                <div class="request-info-icon">
                                    <i class="bi bi-person"></i>
                                </div>

                                <div class="request-info-content">

                                    <span>
                                        Author
                                    </span>

                                    <strong>
                                        {{ $thesisRequest->author_name ?? 'N/A' }}
                                    </strong>

                                </div>

                            </div>


                            {{-- SUBMITTED BY --}}

                            <div class="request-info">

                                <div class="request-info-icon">
                                    <i class="bi bi-person-up"></i>
                                </div>

                                <div class="request-info-content">

                                    <span>
                                        Submitted By
                                    </span>

                                    <strong>
                                        {{ $thesisRequest->user?->username ?? 'N/A' }}
                                    </strong>

                                </div>

                            </div>


                            {{-- SUBMITTED AT --}}

                            <div class="request-info">

                                <div class="request-info-icon">
                                    <i class="bi bi-calendar3"></i>
                                </div>

                                <div class="request-info-content">

                                    <span>
                                        Submitted At
                                    </span>

                                    <strong>
                                        {{ $thesisRequest->submitted_at
                                            ? \Carbon\Carbon::parse($thesisRequest->submitted_at)->format('d M Y')
                                            : 'N/A' }}
                                    </strong>

                                </div>

                            </div>


                            {{-- PUBLISHED BY --}}

                            <div class="request-info">

                                <div class="request-info-icon">
                                    <i class="bi bi-person-check"></i>
                                </div>

                                <div class="request-info-content">

                                    <span>
                                        Published By
                                    </span>

                                    <strong>

                                        @if ($thesisRequest->thesis)

                                            {{ $thesisRequest->thesis?->publishedBy?->full_name
                                                ?? ($thesisRequest->thesis?->publishedBy?->username ?? 'N/A') }}

                                        @else

                                            N/A

                                        @endif

                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        ACTIONS
                    ================================================== --}}

                    <div class="request-actions">


                        {{-- VIEW DETAILS --}}

                        <a
                            href="{{ route('hod.thesis_requests.show', $thesisRequest->id) }}"
                            class="request-action request-action-primary"
                        >

                            <i class="bi bi-eye"></i>

                            <span>
                                View Details
                            </span>

                        </a>


                        {{-- VIEW PDF --}}

                        @if ($thesisRequest->thesis)

                            <a
                                href="{{ route('hod.thesis.view-pdf', $thesisRequest->thesis->id) }}"
                                target="_blank"
                                class="request-action request-action-secondary"
                            >

                                <i class="bi bi-file-earmark-pdf"></i>

                                <span>
                                    View PDF
                                </span>

                            </a>

                        @else

                            <span class="request-action request-action-disabled">

                                <i class="bi bi-file-earmark-x"></i>

                                <span>
                                    No PDF
                                </span>

                            </span>

                        @endif

                    </div>

                </article>


            @empty


                {{-- =================================================
                    EMPTY STATE
                ================================================== --}}

                <div class="request-empty">

                    <div class="request-empty-icon">

                        <i class="bi bi-journal-x"></i>

                    </div>

                    <h3>
                        No Thesis Requests
                    </h3>

                    <p>
                        There are currently no thesis upload requests.
                    </p>

                </div>


            @endforelse

        </div>

    </div>


    <style>

        /* =========================================================
           PAGE VARIABLES
        ========================================================== */

        .thesis-requests-page {

            --request-black: #111111;
            --request-dark: #222222;

            --request-text: #333333;
            --request-muted: #777777;
            --request-light-text: #999999;

            --request-card-bg: #ffffff;
            --request-soft-bg: #fafafa;

            --request-border: #e7e7e7;

            --request-shadow:
                0 4px 18px rgba(0, 0, 0, .055);

            --request-shadow-hover:
                0 12px 30px rgba(0, 0, 0, .10);

        }


        /* =========================================================
           PAGE HEADER
        ========================================================== */

        .request-page-header {

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 20px;
            padding: 18px 20px;

            background: #ffffff;

            border: none !important;
            border-radius: 14px;

            box-shadow:
                0 2px 10px rgba(0, 0, 0, .025);

        }


        .request-header-content {
            min-width: 0;
        }


        .request-overline {

            display: block;

            margin-bottom: 5px;

            color: #666666;

            font-size: .63rem;
            font-weight: 800;

            letter-spacing: .14em;

            text-transform: uppercase;

        }


        .request-page-title {

            margin: 0;

            color: var(--request-black);

            font-size: 1.65rem;
            font-weight: 800;

            line-height: 1.2;

            letter-spacing: -.035em;

        }


        .request-page-description {

            margin: 5px 0 0;

            color: var(--request-muted);

            font-size: .72rem;

            line-height: 1.5;

        }


        /* =========================================================
           HEADER ICON
        ========================================================== */

        .request-header-icon {

            display: flex;
            align-items: center;
            justify-content: center;

            width: 48px;
            height: 48px;

            flex-shrink: 0;

            color: #222222;
            background: #eeeeee;

            border: none !important;
            border-radius: 12px;

            font-size: 1.2rem;

        }


        /* =========================================================
           ALERTS
        ========================================================== */

        .request-alert,
        .request-success {

            display: flex;
            align-items: center;

            gap: 12px;

            margin-bottom: 18px;
            padding: 11px 14px;

            border: none !important;
            border-radius: 10px;

        }


        .request-alert {

            color: #555555;
            background: #f1f1f1;

        }


        .request-success {

            color: #333333;
            background: #eeeeee;

        }


        .alert-icon {

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            font-size: .95rem;

        }


        .alert-content {

            display: flex;
            flex-direction: column;

            gap: 1px;

        }


        .alert-content strong {

            font-size: .68rem;
            font-weight: 800;

        }


        .alert-content span {

            font-size: .65rem;
            font-weight: 500;

        }


        /* =========================================================
           REQUEST GRID
        ========================================================== */

        .request-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 16px;

            width: 100%;

        }


        /* =========================================================
           CARD
        ========================================================== */

        .request-card {

            display: flex;
            flex-direction: column;

            min-width: 0;

            overflow: hidden;

            background: var(--request-card-bg);

            border: none !important;
            border-radius: 14px;

            box-shadow: var(--request-shadow);

            transition:
                transform .22s ease,
                box-shadow .22s ease;

        }


        .request-card:hover {

            transform: translateY(-3px);

            box-shadow: var(--request-shadow-hover);

        }


        /* =========================================================
           CARD CONTENT
        ========================================================== */

        .request-card-content {

            display: flex;
            flex-direction: column;

            flex: 1;

            padding: 17px;

        }


        /* =========================================================
           TITLE ROW
        ========================================================== */

        .request-title-row {

            display: flex;

            align-items: flex-start;
            justify-content: space-between;

            gap: 12px;

            margin-bottom: 16px;

        }


        .request-title-area {

            flex: 1;
            min-width: 0;

        }


        .request-title-with-icon {

            display: flex;

            align-items: center;

            gap: 7px;

            min-width: 0;

        }


        .request-title-with-icon > i {

            flex-shrink: 0;

            color: #333333;

            font-size: .9rem;

            line-height: 1;

        }


        .request-title {

            display: -webkit-box;

            flex: 1;

            min-width: 0;

            margin: 0;

            overflow: hidden;

            color: var(--request-black);

            font-size: .92rem;
            font-weight: 750;

            line-height: 1.4;

            letter-spacing: -.012em;

            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;

        }


        /* =========================================================
           STATUS
        ========================================================== */

        .request-status {

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 4px;

            flex-shrink: 0;

            padding: 5px 9px;

            border: none !important;
            border-radius: 999px;

            font-size: .55rem;
            font-weight: 800;

            white-space: nowrap;

        }


        .request-status i {
            font-size: .62rem;
        }


        .request-status.pending {

            color: #8a6500;
            background: #fff3bf;

        }


        .request-status.approved {

            color: #187a3d;
            background: #dcf7e5;

        }


        .request-status.rejected {

            color: #c62835;
            background: #fde1e4;

        }


        .request-status.unknown {

            color: #666666;
            background: #eeeeee;

        }


        /* =========================================================
           INFORMATION BOX
        ========================================================== */

        .request-information {

            display: flex;

            flex-direction: column;

            gap: 0;

            margin: 0;
            padding: 7px 10px;

            background: var(--request-soft-bg);

            border: none !important;
            border-radius: 10px;

        }


        /* =========================================================
           INFORMATION ITEM
        ========================================================== */

        .request-info {

            display: flex;

            align-items: center;

            gap: 10px;

            width: 100%;
            min-width: 0;

            padding: 9px 4px;

            background: transparent;

            border: none !important;

        }


        .request-info + .request-info {
            border-top: none !important;
        }


        /* =========================================================
           INFORMATION ICON
        ========================================================== */

        .request-info-icon {

            display: flex;

            align-items: center;
            justify-content: center;

            width: 30px;
            height: 30px;

            flex-shrink: 0;

            color: #444444;
            background: #e9e9e9;

            border: none !important;
            border-radius: 7px;

            font-size: .67rem;

        }


        /* =========================================================
           INFORMATION CONTENT
        ========================================================== */

        .request-info-content {

            display: flex;
            flex-direction: column;

            flex: 1;

            min-width: 0;

        }


        .request-info-content span {

            margin-bottom: 2px;

            color: var(--request-light-text);

            font-size: .48rem;
            font-weight: 800;

            letter-spacing: .055em;

            text-transform: uppercase;

        }


        .request-info-content strong {

            display: block;

            overflow: hidden;

            color: var(--request-text);

            font-size: .63rem;
            font-weight: 650;

            line-height: 1.35;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .request-actions {

            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 6px;

            margin-top: auto;
            padding: 11px;

            background: var(--request-soft-bg);

            border: none !important;

        }


        /* =========================================================
           ACTION BUTTON
        ========================================================== */

        .request-action {

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 5px;

            min-width: 0;
            min-height: 35px;

            padding: 6px 8px;

            border: none !important;
            border-radius: 7px;

            outline: none !important;

            text-decoration: none !important;

            font-size: .56rem;
            font-weight: 800;

            white-space: nowrap;

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;

        }


        .request-action i {
            font-size: .65rem;
        }


        /* =========================================================
           VIEW DETAILS - BLUE
        ========================================================== */

        .request-action-primary {

            color: #ffffff !important;

            background: #2563eb !important;

        }


        .request-action-primary:hover {

            color: #ffffff !important;

            background: #1d4ed8 !important;

            transform: translateY(-1px);

        }


        /* =========================================================
           VIEW PDF - RED
        ========================================================== */

        .request-action-secondary {

            color: #ffffff !important;

            background: #dc2626 !important;

        }


        .request-action-secondary:hover {

            color: #ffffff !important;

            background: #b91c1c !important;

            transform: translateY(-1px);

        }


        /* =========================================================
           DISABLED
        ========================================================== */

        .request-action-disabled {

            color: #aaaaaa !important;

            background: #eeeeee !important;

            border: none !important;

            cursor: not-allowed;

            pointer-events: none;

        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .request-empty {

            grid-column: 1 / -1;

            display: flex;

            flex-direction: column;

            align-items: center;
            justify-content: center;

            min-height: 300px;

            padding: 30px;

            text-align: center;

            background: var(--request-card-bg);

            border: none !important;
            border-radius: 14px;

            box-shadow: var(--request-shadow);

        }


        .request-empty-icon {

            display: flex;

            align-items: center;
            justify-content: center;

            width: 58px;
            height: 58px;

            margin-bottom: 12px;

            color: #333333;
            background: #eeeeee;

            border: none !important;
            border-radius: 14px;

            font-size: 1.3rem;

        }


        .request-empty h3 {

            margin: 0 0 5px;

            color: var(--request-black);

            font-size: .95rem;
            font-weight: 800;

        }


        .request-empty p {

            margin: 0;

            color: var(--request-muted);

            font-size: .68rem;

        }


        /* =========================================================
           DARK MODE
           NAVY THEME
        ========================================================== */

        [data-bs-theme="dark"] .thesis-requests-page,
        .dark .thesis-requests-page {

            --request-black: #eeeef8;
            --request-dark: #d5d8e8;

            --request-text: #d5d8e8;
            --request-muted: #999fb9;
            --request-light-text: #999fb9;

            --request-card-bg: #181d33;
            --request-soft-bg: #20253a;

            --request-border: #292e45;

            --request-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

            --request-shadow-hover:
                0 8px 24px rgba(0, 0, 0, .50);

            color-scheme: dark;

        }


        /* =========================================================
           DARK MODE - PAGE HEADER
        ========================================================== */

        [data-bs-theme="dark"] .request-page-header,
        .dark .request-page-header {

            background: #181d33;

            color: #eeeef8;

            border: none !important;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .25);

        }


        [data-bs-theme="dark"] .request-overline,
        .dark .request-overline {

            color: #999fb9;

        }


        [data-bs-theme="dark"] .request-page-title,
        .dark .request-page-title {

            color: #eeeef8;

        }


        [data-bs-theme="dark"] .request-page-description,
        .dark .request-page-description {

            color: #999fb9;

        }


        /* =========================================================
           DARK MODE - HEADER ICON
        ========================================================== */

        [data-bs-theme="dark"] .request-header-icon,
        .dark .request-header-icon {

            color: #d5d8e8;

            background: #20253a;

            border: 1px solid #292e45 !important;

        }


        /* =========================================================
           DARK MODE - ALERTS
        ========================================================== */

        [data-bs-theme="dark"] .request-alert,
        .dark .request-alert {

            color: #d5d8e8;

            background: #181d33;

            border: 1px solid #292e45 !important;

        }


        [data-bs-theme="dark"] .request-success,
        .dark .request-success {

            color: #d5d8e8;

            background: #181d33;

            border: 1px solid #292e45 !important;

        }


        [data-bs-theme="dark"] .alert-content strong,
        .dark .alert-content strong {

            color: #eeeef8;

        }


        [data-bs-theme="dark"] .alert-content span,
        .dark .alert-content span {

            color: #999fb9;

        }


        /* =========================================================
           DARK MODE - CARD
        ========================================================== */

        [data-bs-theme="dark"] .request-card,
        .dark .request-card {

            background: #181d33;

            border: 1px solid #292e45 !important;

            box-shadow:
                0 8px 24px rgba(0, 0, 0, .50);

        }


        [data-bs-theme="dark"] .request-card:hover,
        .dark .request-card:hover {

            border-color: #ffffff !important;

            box-shadow:
                0 12px 30px rgba(0, 0, 0, .55);

        }


        /* =========================================================
           DARK MODE - TITLE
        ========================================================== */

        [data-bs-theme="dark"] .request-title-with-icon > i,
        .dark .request-title-with-icon > i {

            color: #d5d8e8;

        }


        [data-bs-theme="dark"] .request-title,
        .dark .request-title {

            color: #eeeef8;

        }


        /* =========================================================
           DARK MODE - STATUS
        ========================================================== */

        [data-bs-theme="dark"] .request-status.pending,
        .dark .request-status.pending {

            color: #f4d35e;

            background: #302914;

            border: 1px solid #5b4b1c !important;

        }


        [data-bs-theme="dark"] .request-status.approved,
        .dark .request-status.approved {

            color: #86efac;

            background: #0d2a1a;

            border: 1px solid #1f7a46 !important;

        }


        [data-bs-theme="dark"] .request-status.rejected,
        .dark .request-status.rejected {

            color: #ff8b94;

            background: #35181d;

            border: 1px solid #7a2933 !important;

        }


        [data-bs-theme="dark"] .request-status.unknown,
        .dark .request-status.unknown {

            color: #d5d8e8;

            background: #20253a;

            border: 1px solid #292e45 !important;

        }


        /* =========================================================
           DARK MODE - INFORMATION BOX
        ========================================================== */

        [data-bs-theme="dark"] .request-information,
        .dark .request-information {

            background: #20253a;

            border: 1px solid #292e45 !important;

        }


        /* =========================================================
           DARK MODE - INFORMATION ICON
        ========================================================== */

        [data-bs-theme="dark"] .request-info-icon,
        .dark .request-info-icon {

            color: #d5d8e8;

            background: #181d33;

            border: 1px solid #292e45 !important;

        }


        /* =========================================================
           DARK MODE - INFORMATION TEXT
        ========================================================== */

        [data-bs-theme="dark"] .request-info-content span,
        .dark .request-info-content span {

            color: #999fb9;

        }


        [data-bs-theme="dark"] .request-info-content strong,
        .dark .request-info-content strong {

            color: #eeeef8;

        }


        /* =========================================================
           DARK MODE - ACTION AREA
        ========================================================== */

        [data-bs-theme="dark"] .request-actions,
        .dark .request-actions {

            background: #20253a;

            border-top: 1px solid #292e45 !important;

        }


        /* =========================================================
           DARK MODE - VIEW DETAILS
        ========================================================== */

        [data-bs-theme="dark"] .request-action-primary,
        .dark .request-action-primary {

            color: #ffffff !important;

            background: #2563eb !important;

        }


        [data-bs-theme="dark"] .request-action-primary:hover,
        .dark .request-action-primary:hover {

            color: #ffffff !important;

            background: #1d4ed8 !important;

        }


        /* =========================================================
           DARK MODE - VIEW PDF
        ========================================================== */

        [data-bs-theme="dark"] .request-action-secondary,
        .dark .request-action-secondary {

            color: #ffffff !important;

            background: #dc2626 !important;

        }


        [data-bs-theme="dark"] .request-action-secondary:hover,
        .dark .request-action-secondary:hover {

            color: #ffffff !important;

            background: #b91c1c !important;

        }


        /* =========================================================
           DARK MODE - NO PDF
        ========================================================== */

        [data-bs-theme="dark"] .request-action-disabled,
        .dark .request-action-disabled {

            color: #999fb9 !important;

            background: #181d33 !important;

            border: 1px solid #292e45 !important;

        }


        /* =========================================================
           DARK MODE - EMPTY STATE
        ========================================================== */

        [data-bs-theme="dark"] .request-empty,
        .dark .request-empty {

            background: #181d33;

            color: #eeeef8;

            border: 1px solid #292e45 !important;

            box-shadow:
                0 8px 24px rgba(0, 0, 0, .50);

        }


        [data-bs-theme="dark"] .request-empty-icon,
        .dark .request-empty-icon {

            color: #d5d8e8;

            background: #20253a;

            border: 1px solid #292e45 !important;

        }


        [data-bs-theme="dark"] .request-empty h3,
        .dark .request-empty h3 {

            color: #eeeef8;

        }


        [data-bs-theme="dark"] .request-empty p,
        .dark .request-empty p {

            color: #999fb9;

        }


        /* =========================================================
           LARGE TABLET
        ========================================================== */

        @media (max-width: 1200px) {

            .request-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

            }

        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 850px) {

            .request-grid {

                grid-template-columns: 1fr;

            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 600px) {

            .request-page-header {

                padding: 15px;

            }


            .request-header-icon {

                width: 40px;
                height: 40px;

                font-size: 1rem;

            }


            .request-page-title {

                font-size: 1.35rem;

            }


            .request-page-description {

                font-size: .65rem;

            }


            .request-card-content {

                padding: 14px;

            }


            .request-information {

                padding: 6px 8px;

            }


            .request-actions {

                grid-template-columns: 1fr;

            }


            .request-action {

                min-height: 35px;

            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 420px) {

            .request-title-row {

                flex-direction: column;

            }


            .request-status {

                align-self: flex-start;

            }

        }

    </style>

</x-app-layout>