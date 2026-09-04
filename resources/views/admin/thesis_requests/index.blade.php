<x-app-layout>

    <div class="dashboard-content thesis-requests-page">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="request-page-header">

            <div>

                <span class="request-overline">
                    MANAGEMENT
                </span>

                <h2 class="request-page-title">
                    Thesis Requests
                </h2>

            </div>

        </div>


        {{-- =========================================================
            ALERTS
        ========================================================== --}}

        @if (session('error'))

            <div class="request-alert">

                <i class="bi bi-exclamation-circle"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        @endif


        @if (session('success'))

            <div class="request-success">

                <i class="bi bi-check-circle"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        {{-- =========================================================
            GRID
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

                                        @if ($thesisRequest->submitted_at)

                                            {{ \Carbon\Carbon::parse($thesisRequest->submitted_at)->format('d M Y') }}

                                        @else

                                            N/A

                                        @endif

                                    </strong>

                                </div>

                            </div>


                            {{-- PUBLISHED BY --}}

                            @if ($thesisRequest->thesis)

                                <div class="request-info">

                                    <div class="request-info-icon">

                                        <i class="bi bi-person-check"></i>

                                    </div>

                                    <div class="request-info-content">

                                        <span>
                                            Published By
                                        </span>

                                        <strong>

                                            {{ $thesisRequest->thesis?->publishedBy?->full_name
                                                ?? $thesisRequest->thesis?->publishedBy?->username
                                                ?? 'N/A' }}

                                        </strong>

                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                        ACTIONS
                    ================================================== --}}

                    <div class="request-actions">

                        {{-- VIEW DETAILS --}}

                        <a
                            href="{{ route('admin.thesis_requests.show', $thesisRequest->id) }}"
                            class="request-action request-action-details"
                        >

                            <i class="bi bi-eye"></i>

                            <span>
                                View Details
                            </span>

                        </a>


                        {{-- VIEW PDF --}}

                        @if ($thesisRequest->thesis)

                            <a
                                href="{{ route('admin.thesis.view-pdf', $thesisRequest->thesis->id) }}"
                                target="_blank"
                                class="request-action request-action-pdf"
                            >

                                <i class="bi bi-file-earmark-pdf"></i>

                                <span>
                                    View PDF
                                </span>

                            </a>

                        @else

                            <span
                                class="request-action request-action-pdf request-action-disabled"
                            >

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
           VARIABLES
        ========================================================== */

        :root {

            --thesis-request-black: #000000;
            --thesis-request-white: #ffffff;

            --thesis-request-page-bg: #ffffff;
            --thesis-request-card-bg: #ffffff;
            --thesis-request-input-bg: #fafafa;

            --thesis-request-text: #000000;
            --thesis-request-text-secondary: #333333;
            --thesis-request-text-muted: #777777;

            --thesis-request-border: transparent;
            --thesis-request-border-soft: transparent;

            --thesis-request-shadow:
                0 4px 18px rgba(0, 0, 0, .07);

            --thesis-request-card-shadow:
                0 2px 10px rgba(0, 0, 0, .05);

            --thesis-request-primary: #000000;
        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] {

            --thesis-request-black: #000000;
            --thesis-request-white: #ffffff;

            --thesis-request-page-bg: #000000;
            --thesis-request-card-bg: #000000;
            --thesis-request-input-bg: #0d0d0d;

            --thesis-request-text: #ffffff;
            --thesis-request-text-secondary: #dddddd;
            --thesis-request-text-muted: #999999;

            --thesis-request-border: transparent;
            --thesis-request-border-soft: transparent;

            --thesis-request-primary: #ffffff;

            --thesis-request-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

            --thesis-request-card-shadow:
                0 2px 10px rgba(0, 0, 0, .35);
        }


        /* =========================================================
           PAGE
        ========================================================== */

        .dashboard-page,
        .thesis-requests-page {

            color: var(--thesis-request-text);

            transition:
                color .25s ease,
                background-color .25s ease;
        }


        /* =========================================================
           PAGE HEADER
        ========================================================== */

        .request-page-header {

            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            margin-bottom: 1.5rem;

            padding: 0 15px;
        }


        .request-overline {

            display: block;

            margin-bottom: .25rem;

            color: var(--thesis-request-text-muted);

            font-size: .65rem;
            font-weight: 800;

            letter-spacing: .13em;

            text-transform: uppercase;
        }


        .request-page-title {

            margin: 0;

            color: var(--thesis-request-text);

            font-size: 1.8rem;
            font-weight: 600;

            line-height: 1.2;

            letter-spacing: -.035em;
        }


        /* =========================================================
           ALERTS
        ========================================================== */

        .request-alert,
        .request-success {

            display: flex;

            align-items: center;

            gap: .6rem;

            margin:
                0 15px 1.25rem;

            padding: .8rem 1rem;

            border: none !important;

            border-radius: 9px;

            font-size: .75rem;

            font-weight: 600;
        }


        .request-alert {

            color: #b42318;

            background: #fff5f5;
        }


        .request-success {

            color: #176b3a;

            background: #f0fff5;
        }


        /* =========================================================
           GRID
        ========================================================== */

        .request-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 1.25rem;

            width: 100%;

            padding:
                0 15px 1.5rem;

            box-sizing: border-box;
        }


        /* =========================================================
           CARD
        ========================================================== */

        .request-card {

            display: flex;

            flex-direction: column;

            min-width: 0;

            overflow: hidden;

            color: var(--thesis-request-text);

            background:
                var(--thesis-request-card-bg);

            border: none !important;

            border-radius: 14px;

            box-shadow:
                var(--thesis-request-card-shadow);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }


        .request-card:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 10px 28px rgba(0, 0, 0, .09);
        }


        /* =========================================================
           CARD CONTENT
        ========================================================== */

        .request-card-content {

            display: flex;

            flex-direction: column;

            flex: 1;

            padding: 1rem;
        }


        /* =========================================================
           TITLE
        ========================================================== */

        .request-title-row {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: .75rem;

            margin-bottom: 1rem;
        }


        .request-title-area {

            flex: 1;

            min-width: 0;
        }


        .request-title-with-icon {

            display: flex;

            align-items: center;

            gap: .5rem;

            min-width: 0;
        }


        .request-title-with-icon > i {

            flex-shrink: 0;

            color:
                var(--thesis-request-text);

            font-size: 1.1rem;

            line-height: 1;
        }


        .request-title-with-icon .request-title {

            flex: 1;

            min-width: 0;
        }


        .request-title {

            display: -webkit-box;

            margin: 0;

            overflow: hidden;

            color:
                var(--thesis-request-text);

            font-size: .98rem;

            font-weight: 800;

            line-height: 1.4;

            letter-spacing: -.015em;

            -webkit-line-clamp: 3;

            -webkit-box-orient: vertical;
        }


        /* =========================================================
           STATUS
        ========================================================== */

        .request-status {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            gap: .3rem;

            padding:
                .4rem .65rem;

            border: none !important;

            border-radius: 999px;

            font-size: .6rem;

            font-weight: 700;

            white-space: nowrap;
        }


        .request-status.pending {

            color: #8a6500;

            background: #fff4d2;
        }


        .request-status.approved {

            color: #176b3a;

            background: #e5f7ed;
        }


        .request-status.rejected {

            color: #d92d3a;

            background: #ffe7e9;
        }


        .request-status.unknown {

            color:
                var(--thesis-request-text-secondary);

            background:
                var(--thesis-request-input-bg);
        }


        /* =========================================================
           INFORMATION
        ========================================================== */

        .request-information {

            display: flex;

            flex-direction: column;

            margin-bottom: 0;

            padding:
                .7rem .75rem;

            background:
                var(--thesis-request-input-bg);

            border: none !important;

            border-radius: 9px;
        }


        .request-info {

            display: flex;

            align-items: center;

            gap: .6rem;

            min-width: 0;

            padding: .42rem 0;
        }


        .request-info + .request-info {

            border-top: none !important;
        }


        .request-info-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 28px;
            height: 28px;

            flex-shrink: 0;

            color:
                var(--thesis-request-text-secondary);

            background:
                var(--thesis-request-card-bg);

            border: none !important;

            border-radius: 7px;

            font-size: .68rem;
        }


        .request-info-content {

            display: flex;

            flex-direction: column;

            min-width: 0;
        }


        .request-info-content span {

            margin-bottom: .08rem;

            color:
                var(--thesis-request-text-muted);

            font-size: .52rem;

            font-weight: 800;

            letter-spacing: .04em;

            text-transform: uppercase;
        }


        .request-info-content strong {

            overflow: hidden;

            color:
                var(--thesis-request-text-secondary);

            font-size: .68rem;

            font-weight: 600;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .request-actions {

            display: flex;

            gap: .5rem;

            padding: .75rem;

            background:
                var(--thesis-request-input-bg);

            border: none !important;
        }


        .request-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            flex: 1;

            min-width: 0;

            min-height: 38px;

            padding:
                .45rem .7rem;

            border: none !important;

            border-radius: 7px;

            text-decoration: none;

            font-size: .6rem;

            font-weight: 800;

            white-space: nowrap;

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;
        }


        .request-action:hover {

            color: #ffffff;

            transform:
                translateY(-1px);
        }


        /* =========================================================
           VIEW DETAILS - BLUE
        ========================================================== */

        .request-action-details {

            color: #ffffff;

            background: #1463d8;
        }


        .request-action-details:hover {

            color: #ffffff;

            background: #0d4fae;
        }


        /* =========================================================
           VIEW PDF - RED
        ========================================================== */

        .request-action-pdf {

            color: #ffffff;

            background: #d92d3a;
        }


        .request-action-pdf:hover {

            color: #ffffff;

            background: #b4232f;
        }


        /* =========================================================
           DISABLED
        ========================================================== */

        .request-action-disabled {

            opacity: .45;

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

            min-height: 280px;

            padding: 2rem;

            text-align: center;

            color:
                var(--thesis-request-text);

            background:
                var(--thesis-request-card-bg);

            border: none !important;

            border-radius: 14px;

            box-shadow:
                var(--thesis-request-card-shadow);
        }


        .request-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 52px;
            height: 52px;

            margin-bottom: .8rem;

            color: #ffffff;

            background:
                var(--thesis-request-black);

            border: none !important;

            border-radius: 11px;

            font-size: 1.2rem;
        }


        .request-empty h3 {

            margin:
                0 0 .3rem;

            color:
                var(--thesis-request-text);

            font-size: .95rem;

            font-weight: 800;
        }


        .request-empty p {

            margin: 0;

            color:
                var(--thesis-request-text-muted);

            font-size: .7rem;
        }


        /* =========================================================
           REMOVE ALL BORDERS
        ========================================================== */

        .thesis-requests-page table,
        .thesis-requests-page table th,
        .thesis-requests-page table td,
        .thesis-requests-page thead,
        .thesis-requests-page tbody,
        .thesis-requests-page tr {

            border: none !important;

            border-top: none !important;
            border-right: none !important;
            border-bottom: none !important;
            border-left: none !important;
        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1199.98px) {

            .request-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }
        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .request-page-header {

                padding:
                    0 1rem;
            }


            .request-page-title {

                font-size: 1.4rem;
            }


            .request-grid {

                grid-template-columns: 1fr;

                gap: 1rem;

                padding:
                    0 .75rem 1rem;
            }


            .request-alert,
            .request-success {

                margin-left: .75rem;

                margin-right: .75rem;
            }


            .request-title-row {

                align-items: flex-start;
            }
        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 480px) {

            .request-card {

                border-radius: 12px;
            }


            .request-card-content {

                padding: .85rem;
            }


            .request-title-row {

                gap: .5rem;
            }


            .request-status {

                padding:
                    .35rem .5rem;

                font-size: .55rem;
            }


            .request-actions {

                flex-direction: column;
            }


            .request-action {

                width: 100%;

                min-height: 38px;
            }
        }

    </style>

</x-app-layout>

