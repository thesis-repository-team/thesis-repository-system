<x-app-layout>


    <div class="dashboard-page">
        {{-- =========================================================
            SUCCESS MESSAGE
        ========================================================== --}}
        @if (session('success'))
            <div class="request-alert request-alert-success">
                <i class="bi bi-check-circle-fill"></i>

                <span>
                    {{ session('success') }}
                </span>
            </div>
        @endif


        {{-- =========================================================
            ERROR MESSAGE
        ========================================================== --}}
        @if (session('error'))
            <div class="request-alert request-alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>

                <span>
                    {{ session('error') }}
                </span>
            </div>
        @endif


        @if ($thesisRequest)

            {{-- =====================================================
                MAIN REQUEST CARD
            ====================================================== --}}
            <div class="request-detail-card">


                {{-- =================================================
                    CARD HEADER
                ================================================== --}}
                <div class="request-detail-header">

                    <div class="request-header-content">

                        <div class="request-header-label">
                            <i class="bi bi-file-earmark-text"></i>
                            Thesis Upload Request
                        </div>

                        <h2 class="request-title">
                            {{ $thesisRequest->title }}
                        </h2>

                        <div class="request-id">
                            <i class="bi bi-hash"></i>
                            Request ID: {{ $thesisRequest->id }}
                        </div>

                    </div>


                    {{-- =================================================
                        STATUS
                    ================================================== --}}
                    <div class="request-status-wrapper">

                        @if ($thesisRequest->status === 'approved')
                            <span class="request-status request-status-approved">
                                <i class="bi bi-check-circle-fill"></i>
                                Approved
                            </span>
                        @elseif($thesisRequest->status === 'pending')
                            <span class="request-status request-status-pending">
                                <i class="bi bi-clock-history"></i>
                                Pending
                            </span>
                        @else
                            <span class="request-status request-status-rejected">
                                <i class="bi bi-x-circle-fill"></i>
                                Rejected
                            </span>
                        @endif

                    </div>

                </div>


                {{-- =================================================
                    CARD BODY
                ================================================== --}}
                <div class="request-detail-body">


                    {{-- =================================================
                        INFORMATION SECTION
                    ================================================== --}}
                    <div class="request-section">

                        <div class="request-section-heading">
                            <div class="request-section-icon request-section-icon-blue">
                                <i class="bi bi-info-circle-fill"></i>
                            </div>

                            <div>
                                <h5>
                                    Request Information
                                </h5>

                                <p>
                                    Basic information about this thesis request.
                                </p>
                            </div>
                        </div>


                        <div class="row g-3">


                            {{-- AUTHOR --}}
                            <div class="col-12 col-md-6">

                                <div class="info-item">

                                    <div class="info-icon info-icon-blue">
                                        <i class="bi bi-person-fill"></i>
                                    </div>

                                    <div class="info-content">

                                        <div class="info-label">
                                            Author(s) Name
                                        </div>

                                        <div class="info-value">
                                            {{ $thesisRequest->author_name }}
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- DEPARTMENT --}}
                            <div class="col-12 col-md-6">

                                <div class="info-item">

                                    <div class="info-icon info-icon-purple">
                                        <i class="bi bi-building"></i>
                                    </div>

                                    <div class="info-content">

                                        <div class="info-label">
                                            Department
                                        </div>

                                        <div class="info-value">
                                            {{ $thesisRequest->department?->name ?? 'N/A' }}
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- SUBMITTED BY --}}
                            <div class="col-12 col-md-6">

                                <div class="info-item">

                                    <div class="info-icon info-icon-cyan">
                                        <i class="bi bi-person-up"></i>
                                    </div>

                                    <div class="info-content">

                                        <div class="info-label">
                                            Submitted By
                                        </div>

                                        <div class="info-value">
                                            {{ $thesisRequest->user?->name ?? ($thesisRequest->user?->username ?? 'N/A') }}
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- REVIEWED BY --}}
                            <div class="col-12 col-md-6">

                                <div class="info-item">

                                    <div class="info-icon info-icon-green">
                                        <i class="bi bi-person-check-fill"></i>
                                    </div>

                                    <div class="info-content">

                                        <div class="info-label">
                                            Reviewed By
                                        </div>

                                        <div class="info-value">
                                            {{ $thesisRequest->reviewer?->name ?? 'Not yet reviewed' }}
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- SUBMITTED AT --}}
                            <div class="col-12 col-md-6">

                                <div class="info-item">

                                    <div class="info-icon info-icon-orange">
                                        <i class="bi bi-calendar3"></i>
                                    </div>

                                    <div class="info-content">

                                        <div class="info-label">
                                            Submitted At
                                        </div>

                                        <div class="info-value">
                                            {{ $thesisRequest->submitted_at?->format('F d, Y h:i A') ?? 'N/A' }}
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- REVIEWED AT --}}
                            <div class="col-12 col-md-6">

                                <div class="info-item">

                                    <div class="info-icon info-icon-gray">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>

                                    <div class="info-content">

                                        <div class="info-label">
                                            Reviewed At
                                        </div>

                                        <div class="info-value">
                                            {{ $thesisRequest->reviewed_at?->format('F d, Y h:i A') ?? 'Not yet reviewed' }}
                                        </div>

                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>


                    {{-- =================================================
                        ABSTRACT
                    ================================================== --}}
                    <div class="request-section">

                        <div class="request-section-heading">

                            <div class="request-section-icon request-section-icon-blue">
                                <i class="bi bi-file-text-fill"></i>
                            </div>

                            <div>
                                <h5>
                                    Abstract
                                </h5>

                                <p>
                                    Thesis abstract submitted for review.
                                </p>
                            </div>

                        </div>


                        <div class="text-content">
                            {{ $thesisRequest->abstract }}
                        </div>

                    </div>


                    {{-- =================================================
                        DESCRIPTION
                    ================================================== --}}
                    <div class="request-section">

                        <div class="request-section-heading">

                            <div class="request-section-icon request-section-icon-purple">
                                <i class="bi bi-card-text"></i>
                            </div>

                            <div>
                                <h5>
                                    Description
                                </h5>

                                <p>
                                    Additional information about the thesis.
                                </p>
                            </div>

                        </div>


                        <div class="text-content">
                            {{ $thesisRequest->description }}
                        </div>

                    </div>


                    {{-- =================================================
                        PDF SECTION
                    ================================================== --}}
                    <div class="request-pdf-section">

                        <div class="request-pdf-content">

                            <div class="request-pdf-icon">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                            </div>

                            <div>

                                <h6>
                                    Thesis Document
                                </h6>

                                <p>
                                    Open the submitted PDF document to review the complete thesis.
                                </p>

                            </div>

                        </div>


                        <a href="{{ route('admin.thesis_requests.view-request-pdf', $thesisRequest) }}" target="_blank"
                            class="request-pdf-button">

                            <i class="bi bi-eye-fill"></i>

                            <span>
                                View PDF
                            </span>

                        </a>

                    </div>


                    {{-- =================================================
                        REJECTION DETAILS
                    ================================================== --}}
                    @if ($thesisRequest->status === 'rejected')
                        <div class="rejection-box">

                            <div class="rejection-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>


                            <div class="rejection-content">

                                <h5>
                                    Thesis Request Rejected
                                </h5>


                                <div class="rejection-row">

                                    <strong>
                                        Rejected By:
                                    </strong>

                                    <span>
                                        {{ $thesisRequest->reviewer?->name ?? 'Unknown' }}
                                    </span>

                                </div>


                                <div class="rejection-reason-label">
                                    Rejection Reason
                                </div>


                                <div class="rejection-reason">
                                    {{ $thesisRequest->remarks ?? 'No rejection reason provided.' }}
                                </div>

                            </div>

                        </div>
                    @endif


                    {{-- =================================================
                        REVIEW ACTIONS
                    ================================================== --}}
                    @if ($thesisRequest->status === 'pending')
                        <div class="review-divider"></div>


                        <div class="review-action-box">


                            {{-- ACTION HEADER --}}
                            <div class="review-action-header">

                                <div class="review-action-icon">
                                    <i class="bi bi-clipboard-check"></i>
                                </div>

                                <div>

                                    <h5>
                                        Review Decision
                                    </h5>

                                    <p>
                                        Choose whether to approve or reject this thesis request.
                                    </p>

                                </div>

                            </div>


                            {{-- APPROVE --}}
                            <form action="{{ route('admin.thesis_requests.approve', $thesisRequest) }}"
                                method="POST" class="mb-3">

                                @csrf

                                <button type="submit" class="review-approve-button">

                                    <i class="bi bi-check-circle-fill"></i>

                                    <span>
                                        Approve Request
                                    </span>

                                </button>

                            </form>


                            {{-- REJECT --}}
                            <form action="{{ route('admin.thesis_requests.reject', $thesisRequest) }}"
                                method="POST">

                                @csrf

                                @method('PUT')


                                <div class="mb-3">

                                    <label for="remarks" class="review-label">

                                        <i class="bi bi-chat-left-text me-1"></i>

                                        Rejection Reason

                                    </label>


                                    <textarea name="remarks" id="remarks" class="review-textarea" rows="5"
                                        placeholder="Please explain why this thesis request is rejected..." required>{{ old('remarks') }}</textarea>


                                    @error('remarks')
                                        <div class="review-error">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                <div class="review-reject-wrapper">

                                    <button type="submit" class="review-reject-button">

                                        <i class="bi bi-x-circle-fill"></i>

                                        <span>
                                            Reject Request
                                        </span>

                                    </button>

                                </div>

                            </form>

                        </div>
                    @endif

                </div>

            </div>
        @else
            {{-- =====================================================
                EMPTY STATE
            ====================================================== --}}
            <div class="request-empty-state">

                <div class="request-empty-icon">
                    <i class="bi bi-journal-x"></i>
                </div>

                <h5>
                    No Requests Found
                </h5>

                <p>
                    There are currently no thesis upload requests.
                </p>

            </div>

        @endif

    </div>


    {{-- =============================================================
        FULL PAGE CSS
        LIGHT + DARK MODE
        MONOCHROME CARDS + SEMANTIC COLORS
    ============================================================= --}}
    <style>
        /* =========================================================
           ROOT VARIABLES
        ========================================================== */

        .dashboard-page {

            --request-bg: #ffffff;
            --request-surface: #f7f7f7;
            --request-surface-hover: #eeeeee;

            --request-border: #d6d6d6;
            --request-border-strong: #b7b7b7;

            --request-text: #111111;
            --request-muted: #666666;

            /* Semantic colors */

            --blue: #0d6efd;
            --blue-dark: #0a58ca;

            --purple: #6f42c1;
            --purple-dark: #59339d;

            --cyan: #0dcaf0;
            --cyan-dark: #0aa2c0;

            --green: #198754;
            --green-dark: #146c43;

            --orange: #fd7e14;
            --orange-dark: #ca6510;

            --red: #dc3545;
            --red-dark: #b02a37;

            --yellow: #ffc107;
            --yellow-dark: #997404;
        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] .dashboard-page {

            --request-bg: #111111;
            --request-surface: #1b1b1b;
            --request-surface-hover: #242424;

            --request-border: #3b3b3b;
            --request-border-strong: #5b5b5b;

            --request-text: #f5f5f5;
            --request-muted: #a5a5a5;

            --blue: #6ea8fe;
            --blue-dark: #8bb9fe;

            --purple: #a98eda;
            --purple-dark: #c1a7e8;

            --cyan: #6edff6;
            --cyan-dark: #8ae8f8;

            --green: #75d9a8;
            --green-dark: #9ae6c0;

            --orange: #ffb36b;
            --orange-dark: #ffc58c;

            --red: #ea868f;
            --red-dark: #f0a1a8;

            --yellow: #ffda6a;
            --yellow-dark: #ffe08a;
        }


        /* =========================================================
           PAGE HEADER
        ========================================================== */
        .page-header-title {

            color: var(--request-text);

            font-size: 1.4rem;
        }


        .page-header-subtitle {

            color: var(--request-muted);

            font-size: 0.82rem;

            margin-top: 4px;
        }


        /* =========================================================
           ALERTS
        ========================================================== */

        .request-alert {

            display: flex;

            align-items: center;

            gap: 10px;

            padding: 12px 15px;

            margin-bottom: 20px;

            border-radius: 10px;

            font-size: 0.84rem;

            font-weight: 500;
        }


        .request-alert-success {

            background: rgba(25, 135, 84, 0.10);

            color: var(--green);

            border: 1px solid rgba(25, 135, 84, 0.30);
        }


        .request-alert-danger {

            background: rgba(220, 53, 69, 0.10);

            color: var(--red);

            border: 1px solid rgba(220, 53, 69, 0.30);
        }


        /* =========================================================
           MAIN CARD
        ========================================================== */

        .request-detail-card {

            background: var(--request-bg);

            color: var(--request-text);

            border: 1px solid var(--request-border);

            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, 0.06);

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }


        [data-bs-theme="dark"] .request-detail-card {

            box-shadow:
                0 8px 28px rgba(0, 0, 0, 0.35);
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .request-detail-header {

            display: flex;

            justify-content: space-between;

            align-items: flex-start;

            gap: 25px;

            padding: 28px 30px;

            background: var(--request-surface);

            border-bottom: 1px solid var(--request-border);
        }


        .request-header-content {

            min-width: 0;

            flex: 1;
        }


        .request-header-label {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            margin-bottom: 9px;

            color: var(--blue);

            font-size: 0.75rem;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 0.05em;
        }


        .request-title {

            margin: 0 0 8px;

            color: var(--request-text);

            font-size: 1.65rem;

            font-weight: 700;

            line-height: 1.3;

            overflow-wrap: anywhere;
        }


        .request-id {

            color: var(--request-muted);

            font-size: 0.78rem;

            font-weight: 500;
        }


        /* =========================================================
           STATUS
        ========================================================== */

        .request-status-wrapper {

            flex-shrink: 0;
        }


        .request-status {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 8px 14px;

            border-radius: 999px;

            font-size: 0.78rem;

            font-weight: 700;

            white-space: nowrap;
        }


        .request-status-approved {

            background: rgba(25, 135, 84, 0.12);

            color: var(--green);

            border: 1px solid rgba(25, 135, 84, 0.30);
        }


        .request-status-pending {

            background: rgba(255, 193, 7, 0.14);

            color: var(--yellow-dark);

            border: 1px solid rgba(255, 193, 7, 0.35);
        }


        .request-status-rejected {

            background: rgba(220, 53, 69, 0.12);

            color: var(--red);

            border: 1px solid rgba(220, 53, 69, 0.30);
        }


        [data-bs-theme="dark"] .request-status-pending {

            color: var(--yellow);
        }


        /* =========================================================
           BODY
        ========================================================== */

        .request-detail-body {

            padding: 30px;
        }


        /* =========================================================
           SECTION
        ========================================================== */

        .request-section {

            margin-bottom: 30px;
        }


        .request-section-heading {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 17px;
        }


        .request-section-heading h5 {

            margin: 0;

            color: var(--request-text);

            font-size: 0.98rem;

            font-weight: 700;
        }


        .request-section-heading p {

            margin: 3px 0 0;

            color: var(--request-muted);

            font-size: 0.75rem;
        }


        .request-section-icon {

            width: 38px;

            height: 38px;

            flex: 0 0 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 10px;

            font-size: 0.95rem;
        }


        .request-section-icon-blue {

            color: var(--blue);

            background: rgba(13, 110, 253, 0.12);

            border: 1px solid rgba(13, 110, 253, 0.22);
        }


        .request-section-icon-purple {

            color: var(--purple);

            background: rgba(111, 66, 193, 0.12);

            border: 1px solid rgba(111, 66, 193, 0.22);
        }


        /* =========================================================
           INFO ITEMS
        ========================================================== */

        .info-item {

            height: 100%;

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 13px;

            background: var(--request-surface);

            border: 1px solid var(--request-border);

            border-radius: 12px;

            transition:
                border-color 0.2s ease,
                background-color 0.2s ease;
        }


        .info-item:hover {

            background: var(--request-surface-hover);

            border-color: var(--request-border-strong);
        }


        .info-icon {

            width: 38px;

            height: 38px;

            flex: 0 0 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 10px;

            font-size: 0.95rem;
        }


        .info-icon-blue {

            color: var(--blue);

            background: rgba(13, 110, 253, 0.12);

            border: 1px solid rgba(13, 110, 253, 0.22);
        }


        .info-icon-purple {

            color: var(--purple);

            background: rgba(111, 66, 193, 0.12);

            border: 1px solid rgba(111, 66, 193, 0.22);
        }


        .info-icon-cyan {

            color: var(--cyan);

            background: rgba(13, 202, 240, 0.12);

            border: 1px solid rgba(13, 202, 240, 0.22);
        }


        .info-icon-green {

            color: var(--green);

            background: rgba(25, 135, 84, 0.12);

            border: 1px solid rgba(25, 135, 84, 0.22);
        }


        .info-icon-orange {

            color: var(--orange);

            background: rgba(253, 126, 20, 0.12);

            border: 1px solid rgba(253, 126, 20, 0.22);
        }


        .info-icon-gray {

            color: var(--request-muted);

            background: var(--request-surface-hover);

            border: 1px solid var(--request-border);
        }


        .info-content {

            min-width: 0;

            flex: 1;
        }


        .info-label {

            margin-bottom: 3px;

            color: var(--request-muted);

            font-size: 0.68rem;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 0.04em;
        }


        .info-value {

            color: var(--request-text);

            font-size: 0.85rem;

            font-weight: 600;

            overflow-wrap: anywhere;
        }


        /* =========================================================
           TEXT CONTENT
        ========================================================== */

        .text-content {

            padding: 17px;

            background: var(--request-surface);

            color: var(--request-text);

            border: 1px solid var(--request-border);

            border-radius: 12px;

            font-size: 0.88rem;

            line-height: 1.75;

            text-align: justify;

            white-space: pre-line;
        }


        /* =========================================================
           PDF SECTION
        ========================================================== */

        .request-pdf-section {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            padding: 16px;

            margin-bottom: 30px;

            background: var(--request-surface);

            border: 1px solid var(--request-border);

            border-radius: 12px;
        }


        .request-pdf-content {

            display: flex;

            align-items: center;

            gap: 12px;

            min-width: 0;
        }


        .request-pdf-icon {

            width: 42px;

            height: 42px;

            flex: 0 0 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 10px;

            color: var(--red);

            background: rgba(220, 53, 69, 0.12);

            border: 1px solid rgba(220, 53, 69, 0.22);

            font-size: 1rem;
        }


        .request-pdf-content h6 {

            margin: 0 0 3px;

            color: var(--request-text);

            font-size: 0.85rem;

            font-weight: 700;
        }


        .request-pdf-content p {

            margin: 0;

            color: var(--request-muted);

            font-size: 0.72rem;
        }


        .request-pdf-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            flex-shrink: 0;

            padding: 9px 15px;

            border-radius: 8px;

            background: var(--red);

            color: #ffffff;

            border: 1px solid var(--red);

            text-decoration: none;

            font-size: 0.78rem;

            font-weight: 600;

            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }


        .request-pdf-button:hover {

            background: var(--red-dark);

            color: #ffffff;

            border-color: var(--red-dark);

            transform: translateY(-1px);
        }


        /* =========================================================
           REJECTION BOX
        ========================================================== */

        .rejection-box {

            display: flex;

            align-items: flex-start;

            gap: 14px;

            padding: 17px;

            margin-bottom: 30px;

            background: rgba(220, 53, 69, 0.08);

            border: 1px solid rgba(220, 53, 69, 0.25);

            border-left: 5px solid var(--red);

            border-radius: 12px;
        }


        .rejection-icon {

            width: 38px;

            height: 38px;

            flex: 0 0 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: var(--red);

            background: rgba(220, 53, 69, 0.12);

            border-radius: 9px;
        }


        .rejection-content {

            min-width: 0;

            flex: 1;
        }


        .rejection-content h5 {

            margin: 0 0 12px;

            color: var(--red);

            font-size: 0.95rem;

            font-weight: 700;
        }


        .rejection-row {

            display: flex;

            flex-wrap: wrap;

            gap: 5px;

            margin-bottom: 12px;

            color: var(--request-text);

            font-size: 0.8rem;
        }


        .rejection-reason-label {

            margin-bottom: 5px;

            color: var(--red);

            font-size: 0.75rem;

            font-weight: 700;
        }


        .rejection-reason {

            color: var(--request-text);

            font-size: 0.82rem;

            line-height: 1.6;

            white-space: pre-line;
        }


        /* =========================================================
           REVIEW DIVIDER
        ========================================================== */

        .review-divider {

            height: 1px;

            margin: 30px 0;

            background: var(--request-border);
        }


        /* =========================================================
           REVIEW ACTION BOX
        ========================================================== */

        .review-action-box {

            padding: 20px;

            background: var(--request-surface);

            border: 1px dashed var(--request-border-strong);

            border-radius: 14px;
        }


        .review-action-header {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 20px;
        }


        .review-action-icon {

            width: 40px;

            height: 40px;

            flex: 0 0 40px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 10px;

            color: var(--blue);

            background: rgba(13, 110, 253, 0.12);

            border: 1px solid rgba(13, 110, 253, 0.22);
        }


        .review-action-header h5 {

            margin: 0 0 3px;

            color: var(--request-text);

            font-size: 0.95rem;

            font-weight: 700;
        }


        .review-action-header p {

            margin: 0;

            color: var(--request-muted);

            font-size: 0.73rem;
        }


        /* =========================================================
           APPROVE BUTTON
        ========================================================== */

        .review-approve-button {

            width: 100%;

            min-height: 42px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 9px 15px;

            border: 1px solid var(--green);

            border-radius: 8px;

            background: var(--green);

            color: #ffffff;

            font-size: 0.82rem;

            font-weight: 600;

            cursor: pointer;

            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }


        .review-approve-button:hover {

            background: var(--green-dark);

            border-color: var(--green-dark);

            color: #ffffff;

            transform: translateY(-1px);
        }


        /* =========================================================
           FORM LABEL
        ========================================================== */

        .review-label {

            display: block;

            margin-bottom: 7px;

            color: var(--request-text);

            font-size: 0.78rem;

            font-weight: 700;
        }


        /* =========================================================
           TEXTAREA
        ========================================================== */

        .review-textarea {

            width: 100%;

            display: block;

            padding: 11px 13px;

            background: var(--request-bg);

            color: var(--request-text);

            border: 1px solid var(--request-border-strong);

            border-radius: 9px;

            outline: none;

            resize: vertical;

            font-size: 0.82rem;

            line-height: 1.55;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }


        .review-textarea::placeholder {

            color: var(--request-muted);

            opacity: 0.75;
        }


        .review-textarea:focus {

            border-color: var(--blue);

            box-shadow:
                0 0 0 3px rgba(13, 110, 253, 0.12);
        }


        /* =========================================================
           ERROR
        ========================================================== */

        .review-error {

            margin-top: 6px;

            color: var(--red);

            font-size: 0.75rem;

            font-weight: 500;
        }


        /* =========================================================
           REJECT BUTTON
        ========================================================== */

        .review-reject-wrapper {

            display: flex;

            justify-content: flex-end;
        }


        .review-reject-button {

            min-height: 40px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 8px 18px;

            border: 1px solid var(--red);

            border-radius: 8px;

            background: var(--red);

            color: #ffffff;

            font-size: 0.80rem;

            font-weight: 600;

            cursor: pointer;

            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }


        .review-reject-button:hover {

            background: var(--red-dark);

            border-color: var(--red-dark);

            color: #ffffff;

            transform: translateY(-1px);
        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .request-empty-state {

            padding: 65px 20px;

            text-align: center;

            background: var(--request-bg);

            color: var(--request-text);

            border: 1px solid var(--request-border);

            border-radius: 18px;

            box-shadow:
                0 4px 16px rgba(0, 0, 0, 0.05);
        }


        .request-empty-icon {

            margin-bottom: 15px;

            color: var(--request-muted);

            font-size: 3.5rem;

            line-height: 1;
        }


        .request-empty-state h5 {

            margin-bottom: 5px;

            color: var(--request-text);

            font-size: 1rem;

            font-weight: 700;
        }


        .request-empty-state p {

            margin: 0;

            color: var(--request-muted);

            font-size: 0.8rem;
        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .request-detail-header {

                flex-direction: column;

                padding: 22px 18px;

                gap: 15px;
            }


            .request-title {

                font-size: 1.25rem;
            }


            .request-detail-body {

                padding: 20px 18px;
            }


            .request-status-wrapper {

                width: 100%;
            }


            .request-status {

                font-size: 0.72rem;

                padding: 7px 11px;
            }


            .request-pdf-section {

                flex-direction: column;

                align-items: stretch;

                gap: 13px;
            }


            .request-pdf-button {

                width: 100%;
            }


            .review-reject-wrapper {

                display: block;
            }


            .review-reject-button {

                width: 100%;
            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 480px) {

            .request-detail-card {

                border-radius: 14px;
            }


            .request-detail-header {

                padding: 18px 15px;
            }


            .request-detail-body {

                padding: 17px 15px;
            }


            .request-title {

                font-size: 1.1rem;

                line-height: 1.4;
            }


            .request-header-label {

                font-size: 0.68rem;
            }


            .info-item {

                padding: 11px;
            }


            .info-icon {

                width: 34px;

                height: 34px;

                flex-basis: 34px;

                font-size: 0.82rem;
            }


            .info-label {

                font-size: 0.62rem;
            }


            .info-value {

                font-size: 0.78rem;
            }


            .text-content {

                padding: 13px;

                font-size: 0.82rem;

                line-height: 1.65;

                text-align: left;
            }


            .request-section-heading h5 {

                font-size: 0.9rem;
            }


            .request-section-heading p {

                font-size: 0.68rem;
            }


            .request-pdf-content p {

                font-size: 0.67rem;
            }


            .review-action-box {

                padding: 15px;
            }

        }
    </style>

</x-app-layout>
