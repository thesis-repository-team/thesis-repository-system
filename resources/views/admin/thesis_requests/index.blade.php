<x-app-layout>
    <div class="dashboard-content">

        {{-- =========================================================
            ERROR MESSAGE
        ========================================================== --}}
        @if (session('error'))
            <div class="thesis-request-alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif


        {{-- =========================================================
            THESIS REQUEST CARDS
        ========================================================== --}}
        <div class="row g-4">

            @forelse ($thesisRequests as $thesisRequest)
                <div class="col-12 col-md-6 col-xl-4">

                    {{-- =================================================
                        MAIN CARD
                    ================================================== --}}
                    <div class="thesis-request-card h-100">

                        {{-- =================================================
                            CARD HEADER
                        ================================================== --}}
                        <div class="thesis-request-header">

                            <div class="thesis-request-number">
                                #{{ $loop->iteration }}
                            </div>


                            {{-- STATUS --}}
                            @if ($thesisRequest->status == 'pending')
                                <span class="thesis-status thesis-status-pending">
                                    <i class="bi bi-clock-history me-1"></i>
                                    Pending
                                </span>
                            @elseif($thesisRequest->status == 'approved')
                                <span class="thesis-status thesis-status-approved">
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    Approved
                                </span>
                            @else
                                <span class="thesis-status thesis-status-rejected">
                                    <i class="bi bi-x-circle-fill me-1"></i>
                                    Rejected
                                </span>
                            @endif

                        </div>


                        {{-- =================================================
                            CARD BODY
                        ================================================== --}}
                        <div class="thesis-request-body">


                            {{-- =================================================
                                TITLE
                            ================================================== --}}
                            <div class="thesis-request-title-section">

                                <div class="thesis-request-label">
                                    <i class="bi bi-journal-text"></i>
                                    Thesis Title
                                </div>

                                <h5 class="thesis-request-title" title="{{ $thesisRequest->title }}">

                                    {{ $thesisRequest->title }}

                                </h5>

                            </div>


                            {{-- =================================================
                                BASIC INFORMATION
                            ================================================== --}}
                            <div class="thesis-request-info">


                                {{-- DEPARTMENT --}}
                                <div class="thesis-info-item">

                                    <div class="thesis-info-icon thesis-icon-blue">
                                        <i class="bi bi-building"></i>
                                    </div>

                                    <div class="thesis-info-content">

                                        <span class="thesis-info-label">
                                            Department
                                        </span>

                                        <span class="thesis-info-value">
                                            {{ $thesisRequest->department->name }}
                                        </span>

                                    </div>

                                </div>


                                {{-- AUTHOR --}}
                                <div class="thesis-info-item">

                                    <div class="thesis-info-icon thesis-icon-purple">
                                        <i class="bi bi-person-fill"></i>
                                    </div>

                                    <div class="thesis-info-content">

                                        <span class="thesis-info-label">
                                            Author
                                        </span>

                                        <span class="thesis-info-value">
                                            {{ $thesisRequest->author_name }}
                                        </span>

                                    </div>

                                </div>


                                {{-- SUBMITTED BY --}}
                                <div class="thesis-info-item">

                                    <div class="thesis-info-icon thesis-icon-cyan">
                                        <i class="bi bi-person-up"></i>
                                    </div>

                                    <div class="thesis-info-content">

                                        <span class="thesis-info-label">
                                            Submitted By
                                        </span>

                                        <span class="thesis-info-value">
                                            {{ $thesisRequest->user->username }}
                                        </span>

                                    </div>

                                </div>


                                {{-- PUBLISHED BY --}}
                                <div class="thesis-info-item">

                                    <div class="thesis-info-icon thesis-icon-green">
                                        <i class="bi bi-person-check-fill"></i>
                                    </div>

                                    <div class="thesis-info-content">

                                        <span class="thesis-info-label">
                                            Published By
                                        </span>

                                        <span class="thesis-info-value">
                                            {{ $thesisRequest->thesis?->publishedBy?->name ?? 'N/A' }}
                                        </span>

                                    </div>

                                </div>


                                {{-- SUBMISSION DATE --}}
                                <div class="thesis-info-item">

                                    <div class="thesis-info-icon thesis-icon-orange">
                                        <i class="bi bi-calendar3"></i>
                                    </div>

                                    <div class="thesis-info-content">

                                        <span class="thesis-info-label">
                                            Submission Date
                                        </span>

                                        <span class="thesis-info-value">
                                            {{ $thesisRequest->submitted_at }}
                                        </span>

                                    </div>

                                </div>


                            </div>


                            {{-- =================================================
                                ABSTRACT
                            ================================================== --}}
                            <div class="thesis-content-section">

                                <div class="thesis-content-header">

                                    <span class="thesis-content-title">
                                        <i class="bi bi-file-text me-1"></i>
                                        Abstract
                                    </span>

                                </div>

                                <div class="thesis-content-box">

                                    {{ $thesisRequest->abstract }}

                                </div>

                            </div>


                            {{-- =================================================
                                DESCRIPTION
                            ================================================== --}}
                            <div class="thesis-content-section">

                                <div class="thesis-content-header">

                                    <span class="thesis-content-title">
                                        <i class="bi bi-card-text me-1"></i>
                                        Description
                                    </span>

                                </div>

                                <div class="thesis-content-box">

                                    {{ $thesisRequest->description }}

                                </div>

                            </div>


                            {{-- =================================================
                                ACTIONS
                            ================================================== --}}
                            <div class="thesis-request-actions">


                                {{-- VIEW DETAILS --}}
                                <a href="{{ route('admin.thesis_requests.show', $thesisRequest->id) }}" target="_blank"
                                    class="thesis-request-btn thesis-request-btn-details">

                                    <i class="bi bi-eye-fill"></i>

                                    <span>
                                        View Details
                                    </span>

                                </a>


                                {{-- VIEW PDF --}}
                                <a href="{{ route('admin.thesis_requests.view-request-pdf', $thesisRequest->id) }}"
                                    target="_blank" class="thesis-request-btn thesis-request-btn-pdf">

                                    <i class="bi bi-file-earmark-pdf-fill"></i>

                                    <span>
                                        View PDF
                                    </span>

                                </a>


                            </div>

                        </div>

                    </div>

                </div>

            @empty


                {{-- =====================================================
                    EMPTY STATE
                ====================================================== --}}
                <div class="col-12">

                    <div class="thesis-request-empty">

                        <div class="thesis-request-empty-icon">
                            <i class="bi bi-journal-x"></i>
                        </div>

                        <h5 class="thesis-request-empty-title">
                            No Thesis Upload Requests
                        </h5>

                        <p class="thesis-request-empty-text">
                            No thesis upload requests found.
                        </p>

                    </div>

                </div>
            @endforelse

        </div>

    </div>


    {{-- =============================================================
        THESIS REQUEST CARD CSS
        MONOCHROME CARD
        SEMANTIC COLORS FOR STATUS + ACTIONS
        LIGHT + DARK MODE
    ============================================================= --}}
    <style>
        /* =========================================================
           CARD VARIABLES
        ========================================================== */

        .thesis-request-card,
        .thesis-request-empty {

            --request-bg: #ffffff;
            --request-surface: #f7f7f7;
            --request-surface-hover: #eeeeee;

            --request-border: #d6d6d6;
            --request-border-strong: #b5b5b5;

            --request-text: #111111;
            --request-muted: #666666;

            /* Semantic colors */

            --request-blue: #0d6efd;
            --request-blue-dark: #0a58ca;

            --request-purple: #6f42c1;
            --request-purple-dark: #59339d;

            --request-cyan: #0dcaf0;
            --request-cyan-dark: #0aa2c0;

            --request-green: #198754;
            --request-green-dark: #146c43;

            --request-orange: #fd7e14;
            --request-orange-dark: #ca6510;

            --request-red: #dc3545;
            --request-red-dark: #b02a37;

            --request-yellow: #ffc107;
            --request-yellow-dark: #cc9a06;


            background-color: var(--request-bg);

            color: var(--request-text);

            border: 1px solid var(--request-border);

            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 4px 16px rgba(0, 0, 0, 0.06);

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }


        /* =========================================================
           CARD HOVER
        ========================================================== */

        .thesis-request-card:hover {

            border-color: var(--request-border-strong);

            box-shadow:
                0 9px 25px rgba(0, 0, 0, 0.10);

            transform: translateY(-2px);
        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] .thesis-request-card,
        [data-bs-theme="dark"] .thesis-request-empty {

            --request-bg: #111111;

            --request-surface: #1b1b1b;

            --request-surface-hover: #242424;

            --request-border: #3b3b3b;

            --request-border-strong: #5a5a5a;

            --request-text: #f5f5f5;

            --request-muted: #a5a5a5;

            --request-blue: #6ea8fe;
            --request-blue-dark: #8bb9fe;

            --request-purple: #a98eda;
            --request-purple-dark: #c1a7e8;

            --request-cyan: #6edff6;
            --request-cyan-dark: #8ae8f8;

            --request-green: #75d9a8;
            --request-green-dark: #9ae6c0;

            --request-orange: #ffb36b;
            --request-orange-dark: #ffc58c;

            --request-red: #ea868f;
            --request-red-dark: #f0a1a8;

            --request-yellow: #ffda6a;
            --request-yellow-dark: #ffe08a;


            box-shadow:
                0 6px 22px rgba(0, 0, 0, 0.30);
        }


        [data-bs-theme="dark"] .thesis-request-card:hover {

            border-color: #666666;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.42);
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .thesis-request-header {

            padding: 18px 20px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 10px;

            background: var(--request-surface);

            border-bottom: 1px solid var(--request-border);
        }


        /* =========================================================
           REQUEST NUMBER
        ========================================================== */

        .thesis-request-number {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 34px;

            height: 30px;

            padding: 0 10px;

            border-radius: 999px;

            background: var(--request-bg);

            color: var(--request-text);

            border: 1px solid var(--request-border);

            font-size: 0.75rem;

            font-weight: 700;
        }


        /* =========================================================
           STATUS
        ========================================================== */

        .thesis-status {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 6px 11px;

            border-radius: 999px;

            font-size: 0.73rem;

            font-weight: 700;

            white-space: nowrap;
        }


        /* PENDING */

        .thesis-status-pending {

            background: rgba(255, 193, 7, 0.14);

            color: #9a6700;

            border: 1px solid rgba(255, 193, 7, 0.35);
        }


        /* APPROVED */

        .thesis-status-approved {

            background: rgba(25, 135, 84, 0.12);

            color: var(--request-green);

            border: 1px solid rgba(25, 135, 84, 0.30);
        }


        /* REJECTED */

        .thesis-status-rejected {

            background: rgba(220, 53, 69, 0.12);

            color: var(--request-red);

            border: 1px solid rgba(220, 53, 69, 0.30);
        }


        /* DARK STATUS */

        [data-bs-theme="dark"] .thesis-status-pending {

            color: #ffda6a;

            background: rgba(255, 193, 7, 0.16);

            border-color: rgba(255, 218, 106, 0.35);
        }


        [data-bs-theme="dark"] .thesis-status-approved {

            background: rgba(117, 217, 168, 0.14);

            color: var(--request-green);

            border-color: rgba(117, 217, 168, 0.30);
        }


        [data-bs-theme="dark"] .thesis-status-rejected {

            background: rgba(234, 134, 143, 0.14);

            color: var(--request-red);

            border-color: rgba(234, 134, 143, 0.30);
        }


        /* =========================================================
           BODY
        ========================================================== */

        .thesis-request-body {

            padding: 20px;

            display: flex;

            flex-direction: column;

            min-width: 0;
        }


        /* =========================================================
           TITLE SECTION
        ========================================================== */

        .thesis-request-title-section {

            margin-bottom: 18px;
        }


        .thesis-request-label {

            display: flex;

            align-items: center;

            gap: 6px;

            margin-bottom: 7px;

            color: var(--request-muted);

            font-size: 0.72rem;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 0.04em;
        }


        .thesis-request-label i {

            color: var(--request-blue);

            font-size: 0.9rem;
        }


        .thesis-request-title {

            margin: 0;

            color: var(--request-text);

            font-size: 1.05rem;

            font-weight: 700;

            line-height: 1.45;

            display: -webkit-box;

            -webkit-box-orient: vertical;

            -webkit-line-clamp: 3;

            overflow: hidden;
        }


        /* =========================================================
           INFORMATION BOX
        ========================================================== */

        .thesis-request-info {

            display: flex;

            flex-direction: column;

            gap: 8px;

            margin-bottom: 18px;

            padding: 13px;

            background: var(--request-surface);

            border: 1px solid var(--request-border);

            border-radius: 12px;
        }


        /* =========================================================
           INFORMATION ITEM
        ========================================================== */

        .thesis-info-item {

            display: flex;

            align-items: center;

            gap: 11px;

            min-width: 0;
        }


        .thesis-info-icon {

            width: 34px;

            height: 34px;

            flex: 0 0 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 9px;

            font-size: 0.9rem;
        }


        /* BLUE */

        .thesis-icon-blue {

            color: var(--request-blue);

            background: rgba(13, 110, 253, 0.12);

            border: 1px solid rgba(13, 110, 253, 0.20);
        }


        /* PURPLE */

        .thesis-icon-purple {

            color: var(--request-purple);

            background: rgba(111, 66, 193, 0.12);

            border: 1px solid rgba(111, 66, 193, 0.20);
        }


        /* CYAN */

        .thesis-icon-cyan {

            color: var(--request-cyan);

            background: rgba(13, 202, 240, 0.12);

            border: 1px solid rgba(13, 202, 240, 0.20);
        }


        /* GREEN */

        .thesis-icon-green {

            color: var(--request-green);

            background: rgba(25, 135, 84, 0.12);

            border: 1px solid rgba(25, 135, 84, 0.20);
        }


        /* ORANGE */

        .thesis-icon-orange {

            color: var(--request-orange);

            background: rgba(253, 126, 20, 0.12);

            border: 1px solid rgba(253, 126, 20, 0.20);
        }


        /* =========================================================
           INFORMATION TEXT
        ========================================================== */

        .thesis-info-content {

            min-width: 0;

            display: flex;

            flex-direction: column;
        }


        .thesis-info-label {

            color: var(--request-muted);

            font-size: 0.68rem;

            line-height: 1.2;

            margin-bottom: 2px;
        }


        .thesis-info-value {

            color: var(--request-text);

            font-size: 0.82rem;

            font-weight: 600;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================================================
           CONTENT SECTIONS
        ========================================================== */

        .thesis-content-section {

            margin-bottom: 15px;
        }


        .thesis-content-header {

            margin-bottom: 7px;
        }


        .thesis-content-title {

            display: inline-flex;

            align-items: center;

            color: var(--request-text);

            font-size: 0.78rem;

            font-weight: 700;
        }


        .thesis-content-title i {

            color: var(--request-blue);
        }


        /* =========================================================
           ABSTRACT / DESCRIPTION BOX
        ========================================================== */

        .thesis-content-box {

            padding: 11px 12px;

            background: var(--request-surface);

            color: var(--request-muted);

            border: 1px solid var(--request-border);

            border-radius: 10px;

            font-size: 0.78rem;

            line-height: 1.55;

            display: -webkit-box;

            -webkit-box-orient: vertical;

            -webkit-line-clamp: 3;

            overflow: hidden;

            min-height: 56px;
        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .thesis-request-actions {

            display: flex;

            gap: 8px;

            margin-top: auto;

            padding-top: 17px;

            border-top: 1px solid var(--request-border);
        }


        /* =========================================================
           GENERAL BUTTON
        ========================================================== */

        .thesis-request-btn {

            flex: 1;

            min-height: 38px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            padding: 8px 12px;

            border-radius: 8px;

            font-size: 0.76rem;

            font-weight: 600;

            text-decoration: none;

            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease,
                transform 0.2s ease;
        }


        /* =========================================================
           VIEW DETAILS BUTTON
           BLUE
        ========================================================== */

        .thesis-request-btn-details {

            background: var(--request-blue);

            color: #ffffff;

            border: 1px solid var(--request-blue);
        }


        .thesis-request-btn-details:hover {

            background: var(--request-blue-dark);

            color: #ffffff;

            border-color: var(--request-blue-dark);

            transform: translateY(-1px);
        }


        /* =========================================================
           VIEW PDF BUTTON
           RED
        ========================================================== */

        .thesis-request-btn-pdf {

            background: var(--request-red);

            color: #ffffff;

            border: 1px solid var(--request-red);
        }


        .thesis-request-btn-pdf:hover {

            background: var(--request-red-dark);

            color: #ffffff;

            border-color: var(--request-red-dark);

            transform: translateY(-1px);
        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .thesis-request-empty {

            padding: 60px 20px;

            text-align: center;

            background: var(--request-bg);

            border: 1px solid var(--request-border);

            border-radius: 18px;

            box-shadow:
                0 4px 16px rgba(0, 0, 0, 0.05);
        }


        .thesis-request-empty-icon {

            margin-bottom: 15px;

            color: var(--request-muted);

            font-size: 3.5rem;

            line-height: 1;
        }


        .thesis-request-empty-title {

            margin-bottom: 5px;

            color: var(--request-text);

            font-size: 1.05rem;

            font-weight: 700;
        }


        .thesis-request-empty-text {

            margin: 0;

            color: var(--request-muted);

            font-size: 0.82rem;
        }


        /* =========================================================
           ERROR ALERT
        ========================================================== */

        .thesis-request-alert {

            display: flex;

            align-items: center;

            margin-bottom: 20px;

            padding: 12px 15px;

            background: rgba(220, 53, 69, 0.10);

            color: #b02a37;

            border: 1px solid rgba(220, 53, 69, 0.30);

            border-radius: 10px;

            font-size: 0.84rem;

            font-weight: 500;
        }


        [data-bs-theme="dark"] .thesis-request-alert {

            background: rgba(234, 134, 143, 0.12);

            color: #ea868f;

            border-color: rgba(234, 134, 143, 0.30);
        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .thesis-request-card {

                border-radius: 14px;
            }


            .thesis-request-header {

                padding: 15px 16px;

                gap: 8px;
            }


            .thesis-request-body {

                padding: 16px;
            }


            .thesis-request-number {

                min-width: 31px;

                height: 28px;

                font-size: 0.70rem;
            }


            .thesis-status {

                padding: 5px 9px;

                font-size: 0.68rem;
            }


            .thesis-request-title {

                font-size: 0.98rem;
            }


            .thesis-info-icon {

                width: 32px;

                height: 32px;

                flex-basis: 32px;

                font-size: 0.82rem;
            }


            .thesis-info-value {

                font-size: 0.78rem;
            }


            .thesis-content-box {

                font-size: 0.76rem;
            }


            .thesis-request-btn {

                min-height: 36px;

                padding: 7px 8px;

                font-size: 0.72rem;
            }

        }


        /* =========================================================
           VERY SMALL MOBILE
        ========================================================== */

        @media (max-width: 380px) {

            .thesis-request-header {

                align-items: flex-start;
            }


            .thesis-request-actions {

                flex-direction: column;
            }


            .thesis-request-btn {

                width: 100%;

                flex: none;
            }

        }
    </style>

</x-app-layout>
