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
                    CARD HEADER
                ================================================== --}}

                    <div class="request-card-top">

                        <div class="request-title-area">

                            <span class="request-label">
                                <i class="bi bi-journal-text"></i>
                                THESIS TITLE
                            </span>

                            <h3 class="request-title" title="{{ $thesisRequest->title }}">

                                {{ $thesisRequest->title }}

                            </h3>

                        </div>


                        {{-- =================================================
                        STATUS
                    ================================================== --}}

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
                            <span class="request-status">

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
                                    {{ $thesisRequest->department->name ?? 'N/A' }}
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
                                    {{ $thesisRequest->user->username ?? 'N/A' }}
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

                                    {{ $thesisRequest->submitted_at ? \Carbon\Carbon::parse($thesisRequest->submitted_at)->format('d M Y') : 'N/A' }}

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

                                        {{ $thesisRequest->thesis?->publishedBy?->full_name ??
                                            ($thesisRequest->thesis?->publishedBy?->username ?? 'N/A') }}

                                    </strong>

                                </div>

                            </div>
                        @endif

                    </div>


                    {{-- =================================================
                    ABSTRACT
                ================================================== --}}

                    <div class="request-section">

                        <div class="request-section-title">

                            <span class="section-icon">
                                <i class="bi bi-file-text"></i>
                            </span>

                            <span>
                                Abstract
                            </span>

                        </div>

                        <p class="request-text" title="{{ $thesisRequest->abstract ?? '' }}">

                            {{ $thesisRequest->abstract ?? 'No abstract provided.' }}

                        </p>

                    </div>


                    {{-- =================================================
                    DESCRIPTION
                ================================================== --}}

                    <div class="request-section">

                        <div class="request-section-title">

                            <span class="section-icon">
                                <i class="bi bi-card-text"></i>
                            </span>

                            <span>
                                Description
                            </span>

                        </div>

                        <p class="request-text" title="{{ $thesisRequest->description ?? '' }}">

                            {{ $thesisRequest->description ?? 'No description provided.' }}

                        </p>

                    </div>


                    {{-- =================================================
                    ACTIONS
                ================================================== --}}

                    <div class="request-actions">

                        {{-- DETAILS --}}

                        <a href="{{ route('hod.thesis_requests.show', $thesisRequest->id) }}"
                            class="request-action request-action-primary">

                            <i class="bi bi-eye"></i>

                            <span>
                                Details
                            </span>

                        </a>


                        {{-- PDF --}}

                        @if ($thesisRequest->thesis)
                            <a href="{{ route('hod.thesis.view-pdf', $thesisRequest->thesis->id) }}" target="_blank"
                                class="request-action request-action-secondary">

                                <i class="bi bi-file-earmark-pdf"></i>

                                <span>
                                    PDF
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


                        {{-- DOWNLOAD --}}

                        @if ($thesisRequest->thesis && $thesisRequest->thesis->files && $thesisRequest->thesis->files->count())
                            @php
                                $file = $thesisRequest->thesis->files->first();
                            @endphp

                            <a href="{{ route('hod.thesis.download', $file->id) }}"
                                class="request-action request-action-download">

                                <i class="bi bi-download"></i>

                                <span>
                                    Download
                                </span>

                            </a>
                        @else
                            <span class="request-action request-action-disabled">

                                <i class="bi bi-file-earmark-x"></i>

                                <span>
                                    No File
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


    {{-- =============================================================
    CSS
============================================================= --}}

    <style>
        /* =========================================================
       ROOT
    ========================================================== */

        .thesis-requests-page {

            --request-black: #111111;
            --request-dark: #222222;
            --request-text: #333333;

            --request-muted: #777777;
            --request-light-text: #999999;

            --request-card-bg: #ffffff;
            --request-soft-bg: #fafafa;

            --request-grey: #666666;
            --request-light-grey: #f1f1f1;

            --request-shadow:
                0 4px 18px rgba(0, 0, 0, .055);

            --request-shadow-hover:
                0 12px 30px rgba(0, 0, 0, .10);

        }


        /* =========================================================
       MAIN CONTAINER
    ========================================================== */

        .requests-container {

            width: 100%;

            padding: 18px;

            box-sizing: border-box;

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

            border: none;

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
       CARD TOP
    ========================================================== */

        .request-card-top {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 12px;

            padding: 17px;

        }


        .request-title-area {

            flex: 1;

            min-width: 0;

        }


        .request-label {

            display: flex;

            align-items: center;

            gap: 5px;

            margin-bottom: 6px;

            color: #666666;

            font-size: .54rem;

            font-weight: 800;

            letter-spacing: .1em;

            text-transform: uppercase;

        }


        .request-label i {

            font-size: .66rem;

        }


        .request-title {

            display: -webkit-box;

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

            border-radius: 999px;

            font-size: .55rem;

            font-weight: 800;

            white-space: nowrap;

        }


        .request-status i {

            font-size: .62rem;

        }


        /* =========================================================
       PENDING - YELLOW
    ========================================================== */

        .request-status.pending {

            color: #8a6500;

            background: #fff3bf;

        }


        /* =========================================================
       APPROVED - GREEN
    ========================================================== */

        .request-status.approved {

            color: #187a3d;

            background: #dcf7e5;

        }


        /* =========================================================
       REJECTED - RED
    ========================================================== */

        .request-status.rejected {

            color: #c62835;

            background: #fde1e4;

        }


        /* =========================================================
       UNKNOWN - GREY
    ========================================================== */

        .request-status:not(.pending):not(.approved):not(.rejected) {

            color: #666666;

            background: #eeeeee;

        }


        /* =========================================================
       INFORMATION BOX
    ========================================================== */

        .request-information {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 1px;

            margin: 0 17px 16px;

            overflow: hidden;

            background: #eeeeee;

            border: none;

            border-radius: 10px;

        }


        /* =========================================================
       INFORMATION ITEM
    ========================================================== */

        .request-info {

            display: flex;

            align-items: center;

            gap: 8px;

            min-width: 0;

            padding: 9px;

            background: #fafafa;

        }


        .request-info-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 27px;

            height: 27px;

            flex-shrink: 0;

            color: #444444;

            background: #e9e9e9;

            border-radius: 7px;

            font-size: .65rem;

        }


        .request-info-content {

            display: flex;

            flex-direction: column;

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

            overflow: hidden;

            color: var(--request-text);

            font-size: .61rem;

            font-weight: 650;

            line-height: 1.3;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =========================================================
       SECTION
    ========================================================== */

        .request-section {

            margin: 0 17px 13px;

        }


        .request-section-title {

            display: flex;

            align-items: center;

            gap: 6px;

            margin-bottom: 6px;

            color: var(--request-black);

            font-size: .65rem;

            font-weight: 800;

        }


        .section-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 20px;

            height: 20px;

            color: #444444;

            background: #e9e9e9;

            border-radius: 5px;

            font-size: .58rem;

        }


        /* =========================================================
       TEXT
    ========================================================== */

        .request-text {

            display: -webkit-box;

            min-height: 48px;

            max-height: 62px;

            margin: 0;

            padding: 8px 9px;

            overflow: hidden;

            color: #707070;

            background: #fafafa;

            border: none;

            border-radius: 8px;

            font-size: .61rem;

            line-height: 1.55;

            -webkit-line-clamp: 3;

            -webkit-box-orient: vertical;

        }


        /* =========================================================
       ACTIONS
    ========================================================== */

        .request-actions {

            display: grid;

            grid-template-columns:
                1.2fr 1fr 1fr;

            gap: 6px;

            margin-top: auto;

            padding: 11px;

            background: #fafafa;

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

            min-height: 32px;

            padding: 6px 7px;

            border: none;

            border-radius: 7px;

            text-decoration: none;

            font-size: .56rem;

            font-weight: 800;

            white-space: nowrap;

            transition:
                all .2s ease;

        }


        .request-action i {

            font-size: .65rem;

        }


        /* =========================================================
       DETAILS
    ========================================================== */

        .request-action-primary {

            color: #ffffff;

            background: #111111;

        }


        .request-action-primary:hover {

            color: #ffffff;

            background: #333333;

            transform: translateY(-1px);

        }


        /* =========================================================
       PDF
    ========================================================== */

        .request-action-secondary {

            color: #222222;

            background: #eeeeee;

        }


        .request-action-secondary:hover {

            color: #111111;

            background: #dddddd;

            transform: translateY(-1px);

        }


        /* =========================================================
       DOWNLOAD
    ========================================================== */

        .request-action-download {

            color: #222222;

            background: #e5e5e5;

        }


        .request-action-download:hover {

            color: #ffffff;

            background: #222222;

            transform: translateY(-1px);

        }


        /* =========================================================
       DISABLED
    ========================================================== */

        .request-action-disabled {

            color: #aaaaaa;

            background: #eeeeee;

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

            background: #ffffff;

            border: none;

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

            .requests-container {

                padding: 14px;

            }

            .request-grid {

                grid-template-columns: 1fr;

            }

        }


        /* =========================================================
       MOBILE
    ========================================================== */

        @media (max-width: 600px) {

            .requests-container {

                padding: 10px;

            }


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


            .request-card-top {

                padding: 14px;

            }


            .request-information {

                margin:
                    0 14px 14px;

            }


            .request-section {

                margin-left: 14px;

                margin-right: 14px;

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

            .request-information {

                grid-template-columns: 1fr;

            }


            .request-card-top {

                flex-direction: column;

            }


            .request-status {

                align-self: flex-start;

            }

        }
    </style>


</x-app-layout>
