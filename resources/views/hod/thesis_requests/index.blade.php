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

                <h1 class="request-page-title">
                    Thesis Requests
                </h1>

                <p class="request-page-description">
                    Review thesis upload requests and their submission information.
                </p>

            </div>

        </div>


        {{-- =========================================================
        ALERT
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

                                <span class="request-label">

                                    <i class="bi bi-journal-text"></i>

                                    Thesis Title

                                </span>

                                <h3 class="request-title" title="{{ $thesisRequest->title }}">

                                    {{ $thesisRequest->title }}

                                </h3>

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
                                <span class="request-status">

                                    <i class="bi bi-question-circle"></i>

                                    {{ ucfirst($thesisRequest->status ?? 'Unknown') }}

                                </span>
                            @endif

                        </div>


                        {{-- =================================================
                        BASIC INFORMATION
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

                                <i class="bi bi-file-text"></i>

                                Abstract

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

                                <i class="bi bi-card-text"></i>

                                Description

                            </div>

                            <p class="request-text" title="{{ $thesisRequest->description ?? '' }}">

                                {{ $thesisRequest->description ?? 'No description provided.' }}

                            </p>

                        </div>

                    </div>


                    {{-- =================================================
                    CARD ACTIONS
                ================================================== --}}

                    <div class="request-actions">


                        {{-- VIEW DETAILS --}}

                        <a href="{{ route('admin.thesis_requests.show', $thesisRequest->id) }}"
                            class="request-action request-action-primary">

                            <i class="bi bi-eye"></i>

                            <span>
                                View Details
                            </span>

                        </a>


                        {{-- VIEW PDF --}}

                        @if ($thesisRequest->thesis)
                            <a href="{{ route('admin.thesis.view-pdf', $thesisRequest->thesis->id) }}" target="_blank"
                                class="request-action request-action-secondary">

                                <i class="bi bi-file-earmark-pdf"></i>

                                <span>
                                    View PDF
                                </span>

                            </a>
                        @else
                            <span class="request-action request-action-secondary request-action-disabled">

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

                            <a href="{{ route('admin.thesis.download', $file->id) }}"
                                class="request-action request-action-download">

                                <i class="bi bi-download"></i>

                                <span>
                                    Download
                                </span>

                            </a>
                        @else
                            <span class="request-action request-action-download request-action-disabled">

                                <i class="bi bi-file-earmark-x"></i>

                                <span>
                                    No File
                                </span>

                            </span>
                        @endif

                    </div>

                </article>


            @empty


                {{-- =====================================================
                EMPTY STATE
            ====================================================== --}}

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
       PAGE
    ========================================================== */

        .thesis-requests-page {

            --request-black: #111111;
            --request-text: #222222;
            --request-muted: #777777;

            --request-background: #ffffff;
            --request-soft: #f7f7f7;

        }


        /* =========================================================
       PAGE HEADER
    ========================================================== */

        .request-page-header {

            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            margin-bottom: 1.25rem;

            padding: 0 15px;

        }


        .request-overline {

            display: block;

            margin-bottom: .2rem;

            color: #777777;

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .13em;

            text-transform: uppercase;

        }


        .request-page-title {

            margin: 0;

            color: #111111;

            font-size: 1.8rem;

            font-weight: 800;

            line-height: 1.2;

            letter-spacing: -.035em;

        }


        .request-page-description {

            margin: .4rem 0 0;

            color: #888888;

            font-size: .72rem;

        }


        /* =========================================================
       ALERT
    ========================================================== */

        .request-alert,
        .request-success {

            display: flex;

            align-items: center;

            gap: .6rem;

            margin: 0 15px 1.25rem;

            padding: .8rem 1rem;

            border-radius: 10px;

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

            gap: 1.2rem;

            width: 100%;

            padding: 0 15px 1.5rem;

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

            background: #ffffff;

            border: none;

            border-radius: 14px;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .06);

            transition:
                transform .2s ease,
                box-shadow .2s ease;

        }


        .request-card:hover {

            transform: translateY(-3px);

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
       TITLE + STATUS
    ========================================================== */

        .request-title-row {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: .75rem;

            margin-bottom: 1rem;

        }


        .request-title-area {

            flex: 1;

            min-width: 0;

        }


        .request-label {

            display: flex;

            align-items: center;

            gap: .35rem;

            margin-bottom: .4rem;

            color: #999999;

            font-size: .57rem;

            font-weight: 800;

            letter-spacing: .07em;

            text-transform: uppercase;

        }


        .request-label i {

            color: #111111;

            font-size: .7rem;

        }


        .request-title {

            display: -webkit-box;

            margin: 0;

            overflow: hidden;

            color: #222222;

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

            padding: .4rem .65rem;

            border-radius: 999px;

            font-size: .6rem;

            font-weight: 700;

            white-space: nowrap;

        }


        .request-status.pending {

            color: #8a6500;

            background: #fff8df;

        }


        .request-status.approved {

            color: #176b3a;

            background: #eaf8ef;

        }


        .request-status.rejected {

            color: #a52a35;

            background: #fff0f1;

        }


        .request-status:not(.pending):not(.approved):not(.rejected) {

            color: #555555;

            background: #f2f2f2;

        }


        /* =========================================================
       INFORMATION
    ========================================================== */

        .request-information {

            display: flex;

            flex-direction: column;

            margin-bottom: 1rem;

            padding: .7rem .75rem;

            background: #f8f8f8;

            border-radius: 10px;

        }


        .request-info {

            display: flex;

            align-items: center;

            gap: .6rem;

            min-width: 0;

            padding: .42rem 0;

        }


        .request-info-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 28px;

            height: 28px;

            flex-shrink: 0;

            color: #555555;

            background: #ffffff;

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

            color: #999999;

            font-size: .52rem;

            font-weight: 800;

            letter-spacing: .04em;

            text-transform: uppercase;

        }


        .request-info-content strong {

            overflow: hidden;

            color: #222222;

            font-size: .68rem;

            font-weight: 600;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =========================================================
       ABSTRACT / DESCRIPTION
    ========================================================== */

        .request-section {

            margin-bottom: .85rem;

        }


        .request-section-title {

            display: flex;

            align-items: center;

            gap: .35rem;

            margin-bottom: .35rem;

            color: #222222;

            font-size: .68rem;

            font-weight: 800;

        }


        .request-section-title i {

            color: #777777;

        }


        .request-text {

            display: -webkit-box;

            margin: 0;

            min-height: 55px;

            padding: .65rem .7rem;

            overflow: hidden;

            color: #777777;

            background: #fafafa;

            border: none;

            border-radius: 8px;

            font-size: .67rem;

            line-height: 1.55;

            -webkit-line-clamp: 3;

            -webkit-box-orient: vertical;

        }


        /* =========================================================
       ACTIONS
    ========================================================== */

        .request-actions {

            display: flex;

            gap: .45rem;

            padding: .75rem;

            background: #fafafa;

        }


        .request-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .35rem;

            flex: 1;

            min-width: 0;

            min-height: 36px;

            padding: .4rem .5rem;

            border: none;

            border-radius: 7px;

            text-decoration: none;

            font-size: .58rem;

            font-weight: 800;

            white-space: nowrap;

            transition: .2s ease;

        }


        /* =========================================================
       VIEW DETAILS
    ========================================================== */

        .request-action-primary {

            color: #ffffff;

            background: #111111;

        }


        .request-action-primary:hover {

            color: #ffffff;

            background: #333333;

        }


        /* =========================================================
       VIEW PDF
    ========================================================== */

        .request-action-secondary {

            color: #111111;

            background: #ffffff;

        }


        .request-action-secondary:hover {

            color: #ffffff;

            background: #111111;

        }


        /* =========================================================
       DOWNLOAD
    ========================================================== */

        .request-action-download {

            color: #ffffff;

            background: #111111;

        }


        .request-action-download:hover {

            color: #ffffff;

            background: #333333;

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

            background: #ffffff;

            border: none;

            border-radius: 14px;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .06);

        }


        .request-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 52px;

            height: 52px;

            margin-bottom: .8rem;

            color: #ffffff;

            background: #111111;

            border-radius: 12px;

            font-size: 1.2rem;

        }


        .request-empty h3 {

            margin: 0 0 .3rem;

            color: #111111;

            font-size: .95rem;

            font-weight: 800;

        }


        .request-empty p {

            margin: 0;

            color: #888888;

            font-size: .7rem;

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

                padding: 0 1rem;

            }


            .request-page-title {

                font-size: 1.4rem;

            }


            .request-page-description {

                font-size: .68rem;

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

                padding: .35rem .5rem;

                font-size: .55rem;

            }


            .request-actions {

                flex-direction: column;

            }


            .request-action {

                width: 100%;

                min-height: 36px;

            }

        }
    </style>


</x-app-layout>
