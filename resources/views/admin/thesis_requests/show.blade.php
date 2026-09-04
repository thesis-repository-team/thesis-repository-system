<x-app-layout>

    <div class="dashboard-content thesis-request-page">

        {{-- =========================================================
            ALERTS
        ========================================================== --}}

        @if (session('success'))
            <div class="request-alert request-alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif


        @if (session('error'))
            <div class="request-alert request-alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif


        @if ($thesisRequest)

            {{-- =====================================================
                MAIN CARD
            ====================================================== --}}

            <div class="request-form-card">


                <div class="request-header">

                    <div class="request-header-content">

                        <span class="request-overline">
                            REQUEST #{{ $thesisRequest->id }}
                        </span>

                        <div class="request-title-row">

                            <i class="bi bi-journal-text"></i>

                            <h1 class="request-title">
                                {{ $thesisRequest->title }}
                            </h1>

                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="request-status-wrapper">

                        @if ($thesisRequest->status === 'approved')
                            <span class="request-status status-approved">
                                <i class="bi bi-check-circle-fill"></i>
                                Approved
                            </span>
                        @elseif ($thesisRequest->status === 'pending')
                            <span class="request-status status-pending">
                                <i class="bi bi-clock-fill"></i>
                                Pending
                            </span>
                        @elseif ($thesisRequest->status === 'rejected')
                            <span class="request-status status-rejected">
                                <i class="bi bi-x-circle-fill"></i>
                                Rejected
                            </span>
                        @else
                            <span class="request-status status-default">
                                <i class="bi bi-question-circle-fill"></i>
                                {{ ucfirst($thesisRequest->status ?? 'Unknown') }}
                            </span>
                        @endif

                    </div>

                </div>

                {{-- =================================================
                    REQUEST INFORMATION
                ================================================== --}}

                <div class="request-content-section">

                    <div class="section-heading">

                        <div class="section-heading-icon">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>

                        <div>
                            <h2>Request Information</h2>

                            <p>
                                Details about this thesis submission.
                            </p>
                        </div>

                    </div>


                    {{-- =================================================
                        TWO UNEQUAL COLUMNS
                    ================================================== --}}

                    <div class="request-information-form">


                        {{-- AUTHOR --}}

                        <div class="request-form-group">

                            <span class="request-form-label">
                                Author
                            </span>

                            <div class="request-form-control">
                                {{ $thesisRequest->author_name ?? 'N/A' }}
                            </div>

                        </div>


                        {{-- DEPARTMENT --}}

                        <div class="request-form-group">

                            <span class="request-form-label">
                                Department
                            </span>

                            <div class="request-form-control">
                                {{ $thesisRequest->department?->name ?? 'N/A' }}
                            </div>

                        </div>


                        {{-- SUBMITTED BY --}}

                        <div class="request-form-group">

                            <span class="request-form-label">
                                Submitted By
                            </span>

                            <div class="request-form-control">
                                {{ $thesisRequest->user?->name ?? ($thesisRequest->user?->username ?? 'N/A') }}
                            </div>

                        </div>


                        {{-- SUBMITTED AT --}}

                        <div class="request-form-group">

                            <span class="request-form-label">
                                Submitted At
                            </span>

                            <div class="request-form-control">

                                {{ $thesisRequest->submitted_at
                                    ? \Carbon\Carbon::parse($thesisRequest->submitted_at)->format('d M Y, h:i A')
                                    : 'N/A' }}

                            </div>

                        </div>


                        {{-- REVIEWED BY --}}

                        <div class="request-form-group">

                            <span class="request-form-label">
                                Reviewed By
                            </span>

                            <div class="request-form-control">

                                {{ $thesisRequest->reviewer?->name ?? ($thesisRequest->reviewer?->username ?? 'Not reviewed') }}

                            </div>

                        </div>


                        {{-- REVIEWED AT --}}

                        <div class="request-form-group">

                            <span class="request-form-label">
                                Reviewed At
                            </span>

                            <div class="request-form-control">

                                {{ $thesisRequest->reviewed_at
                                    ? \Carbon\Carbon::parse($thesisRequest->reviewed_at)->format('d M Y, h:i A')
                                    : 'Not reviewed' }}

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    ABSTRACT
                ================================================== --}}

                <div class="request-content-section">

                    <div class="section-heading">

                        <div class="section-heading-icon">
                            <i class="bi bi-file-text-fill"></i>
                        </div>

                        <div>

                            <h2>
                                Abstract
                            </h2>

                            <p>
                                Abstract submitted with the thesis request.
                            </p>

                        </div>

                    </div>


                    <div class="text-content">

                        {{ $thesisRequest->abstract ?? 'No abstract provided.' }}

                    </div>

                </div>


                {{-- =================================================
                    DESCRIPTION
                ================================================== --}}

                <div class="request-content-section">

                    <div class="section-heading">

                        <div class="section-heading-icon">
                            <i class="bi bi-card-text"></i>
                        </div>

                        <div>

                            <h2>
                                Description
                            </h2>

                            <p>
                                Description of the thesis project.
                            </p>

                        </div>

                    </div>


                    <div class="text-content">

                        {{ $thesisRequest->description ?? 'No description provided.' }}

                    </div>

                </div>


                {{-- =================================================
                    THESIS DOCUMENT
                ================================================== --}}

                <div class="request-content-section">

                    <div class="section-heading">

                        <div class="section-heading-icon document-icon">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </div>

                        <div>

                            <h2>
                                Thesis Document
                            </h2>

                            <p>
                                Submitted thesis document.
                            </p>

                        </div>

                    </div>


                    <div class="document-box">

                        <div class="document-left">

                            <div class="document-file-icon">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                            </div>

                            <div class="document-details">

                                <strong>
                                    Submitted Thesis PDF
                                </strong>

                                <span>
                                    Complete submitted document
                                </span>

                            </div>

                        </div>


                        <a href="{{ route('admin.thesis_requests.view-request-pdf', $thesisRequest) }}" target="_blank"
                            class="view-pdf-button">

                            <i class="bi bi-eye-fill"></i>

                            View PDF

                        </a>

                    </div>

                </div>


                {{-- =================================================
                    REJECTION DETAILS
                ================================================== --}}

                @if ($thesisRequest->status === 'rejected')
                    <div class="request-content-section">

                        <div class="section-heading">

                            <div class="section-heading-icon rejection-icon">

                                <i class="bi bi-exclamation-triangle-fill"></i>

                            </div>

                            <div>

                                <h2>
                                    Rejection Details
                                </h2>

                                <p>
                                    Information about why this request was rejected.
                                </p>

                            </div>

                        </div>


                        <div class="request-information-form">


                            {{-- REJECTED BY --}}

                            <div class="request-form-group">

                                <span class="request-form-label">
                                    Rejected By
                                </span>

                                <div class="request-form-control">

                                    {{ $thesisRequest->reviewer?->name ?? ($thesisRequest->reviewer?->username ?? 'Unknown') }}

                                </div>

                            </div>


                            {{-- REJECTION REASON --}}

                            <div class="request-form-group">

                                <span class="request-form-label">
                                    Reason
                                </span>

                                <div class="request-form-control reason-value">

                                    {{ $thesisRequest->remarks ?? 'No rejection reason provided.' }}

                                </div>

                            </div>


                        </div>

                    </div>
                @endif


                {{-- =================================================
                    REVIEW DECISION
                ================================================== --}}

                @if ($thesisRequest->status === 'pending')
                    <div class="request-content-section review-section">

                        <div class="section-heading">

                            <div class="section-heading-icon">

                                <i class="bi bi-clipboard-check-fill"></i>

                            </div>

                            <div>

                                <h2>
                                    Review Decision
                                </h2>

                                <p>
                                    Choose whether to approve or reject this thesis request.
                                </p>

                            </div>

                        </div>


                        {{-- APPROVE FORM --}}

                        <form action="{{ route('admin.thesis_requests.approve', $thesisRequest) }}" method="POST"
                            class="approve-form">

                            @csrf

                            <button type="submit" class="action-button approve-button">

                                <i class="bi bi-check-circle-fill"></i>

                                Approve Request

                            </button>

                        </form>


                        {{-- REJECT FORM --}}

                        <form action="{{ route('admin.thesis_requests.reject', $thesisRequest) }}" method="POST">

                            @csrf

                            @method('PUT')


                            <div class="reject-area">

                                <label for="remarks" class="review-label">

                                    <i class="bi bi-chat-left-text-fill"></i>

                                    Rejection Reason

                                </label>


                                <textarea name="remarks" id="remarks" class="review-textarea" rows="5"
                                    placeholder="Please explain why this thesis request is rejected..." required>{{ old('remarks') }}</textarea>


                                @error('remarks')
                                    <div class="review-error">

                                        <i class="bi bi-exclamation-circle-fill"></i>

                                        {{ $message }}

                                    </div>
                                @enderror


                                <button type="submit" class="action-button reject-button">

                                    <i class="bi bi-x-circle-fill"></i>

                                    Reject Request

                                </button>

                            </div>

                        </form>

                    </div>
                @endif

            </div>
        @else
            {{-- =====================================================
                EMPTY STATE
            ====================================================== --}}

            <div class="empty-request">

                <div class="empty-icon">
                    <i class="bi bi-journal-x"></i>
                </div>

                <h2>
                    No Requests Found
                </h2>

                <p>
                    There are currently no thesis upload requests.
                </p>

            </div>

        @endif

    </div>


    <style>
        /* =========================================================
           VARIABLES
        ========================================================== */

        .thesis-request-page {

            --request-black: #111111;
            --request-text: #222222;
            --request-muted: #777777;

            --request-card: #ffffff;
            --request-soft: #f8f8f8;
            --request-soft-blue: #f1f5ff;

            --request-blue: #0d6efd;
            --request-green: #198754;
            --request-red: #dc3545;
            --request-yellow: #997404;

            --request-shadow:
                0 4px 18px rgba(0, 0, 0, .055);

            color: var(--request-text);
        }


        /* =========================================================
           ALERTS
        ========================================================== */

        .request-alert {

            display: flex;

            align-items: center;

            gap: 8px;

            margin-bottom: 16px;

            padding: 10px 13px;

            border: none !important;

            border-radius: 8px;

            font-size: .72rem;

            font-weight: 600;
        }


        .request-alert-success {

            color: #176b3a;

            background: #eefaf3;
        }


        .request-alert-danger {

            color: #b42318;

            background: #fff1f1;
        }


        /* =========================================================
           MAIN CARD
        ========================================================== */

        .request-form-card {

            width: 100%;

            padding: 22px;

            background: var(--request-card);

            border: none !important;

            border-radius: 14px;

            box-shadow: var(--request-shadow);

            box-sizing: border-box;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .request-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 25px;

            padding-bottom: 18px;

            border: none !important;
        }


        .request-header-content {

            min-width: 0;

            flex: 1;
        }


        .request-overline {

            display: block;

            margin-bottom: 5px;

            color: var(--request-muted);

            font-size: .61rem;

            font-weight: 800;

            letter-spacing: .13em;

            text-transform: uppercase;
        }


        .request-title-row {

            display: flex;

            align-items: center;

            gap: 9px;

            min-width: 0;
        }


        .request-title-row>i {

            flex-shrink: 0;

            color: var(--request-black);

            font-size: 1.15rem;

            line-height: 1;
        }


        .request-title {

            margin: 0;

            min-width: 0;

            color: var(--request-black);

            font-size: 1.4rem;

            font-weight: 800;

            line-height: 1.35;

            letter-spacing: -.025em;

            overflow-wrap: anywhere;
        }


        .request-id {

            display: block;

            margin-top: 5px;

            color: var(--request-muted);

            font-size: .67rem;
        }


        /* =========================================================
           STATUS
        ========================================================== */

        .request-status-wrapper {

            flex-shrink: 0;

            padding-top: 13px;
        }


        .request-status {

            display: inline-flex;

            align-items: center;

            gap: 5px;

            padding: 6px 11px;

            border: none !important;

            border-radius: 999px;

            font-size: .62rem;

            font-weight: 700;

            white-space: nowrap;
        }


        .status-approved {

            color: var(--request-green);

            background: #eaf7ef;
        }


        .status-pending {

            color: var(--request-yellow);

            background: #fff8df;
        }


        .status-rejected {

            color: var(--request-red);

            background: #fff0f1;
        }


        .status-default {

            color: #555555;

            background: #f1f1f1;
        }


        /* =========================================================
           CONTENT SECTIONS
        ========================================================== */

        .request-content-section {

            margin-bottom: 25px;

            padding-bottom: 23px;

            border: none !important;
        }


        .request-content-section:last-child {

            margin-bottom: 0;

            padding-bottom: 0;

            border-bottom: none !important;
        }


        /* =========================================================
           SECTION HEADING
        ========================================================== */

        .section-heading {

            display: flex;

            align-items: center;

            gap: 9px;

            margin-bottom: 13px;
        }


        .section-heading-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 32px;

            height: 32px;

            flex-shrink: 0;

            color: var(--request-blue);

            background: var(--request-soft-blue);

            border: none !important;

            border-radius: 8px;

            font-size: .75rem;
        }


        .section-heading h2 {

            margin: 0;

            color: var(--request-black);

            font-size: .83rem;

            font-weight: 800;
        }


        .section-heading p {

            margin: 2px 0 0;

            color: var(--request-muted);

            font-size: .62rem;
        }


        /* =========================================================
           REQUEST INFORMATION
           UNEQUAL 2 COLUMNS
        ========================================================== */

        .request-information-form {

            display: grid;

            /*
             * Left column is slightly wider
             * than the right column.
             */
            grid-template-columns:
                1.2fr 1fr;

            gap: 12px 28px;

            width: 100%;

            box-sizing: border-box;
        }


        /* =========================================================
           FORM GROUP
           LABEL + VALUE SAME ROW
        ========================================================== */

        .request-form-group {

            display: grid;

            grid-template-columns:
                105px minmax(0, 1fr);

            align-items: center;

            gap: 10px;

            width: 100%;

            min-width: 0;

            box-sizing: border-box;
        }


        /* =========================================================
           LABEL
        ========================================================== */

        .request-form-label {

            display: block;

            margin: 0;

            color: var(--request-text);

            font-size: .63rem;

            font-weight: 800;

            letter-spacing: .04em;

            text-transform: uppercase;

            white-space: nowrap;
        }


        /* =========================================================
           VALUE
        ========================================================== */

        .request-form-control {

            display: flex;

            align-items: center;

            width: 90%;

            min-height: 42px;

            padding: .55rem .75rem;

            box-sizing: border-box;

            color: var(--request-text);

            background: var(--request-soft);

            border: none !important;

            border-radius: 8px;

            outline: none;

            font-family: inherit;

            font-size: .69rem;

            font-weight: 600;

            line-height: 1.45;

            overflow-wrap: anywhere;

            transition:
                background-color .2s ease,
                color .2s ease;
        }


        .request-form-control:hover {

            background: #f3f3f3;
        }


        /* =========================================================
           REJECTION REASON
        ========================================================== */

        .reason-value {

            color: var(--request-red);

            line-height: 1.6;
        }


        /* =========================================================
           ABSTRACT / DESCRIPTION
        ========================================================== */

        .text-content {

            padding: 12px;

            color: #555555;

            background: var(--request-soft);

            border: none !important;

            border-radius: 9px;

            font-size: .7rem;

            line-height: 1.7;

            white-space: pre-line;

            text-align: justify;
        }


        /* =========================================================
           DOCUMENT
        ========================================================== */

        .document-box {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding: 11px 12px;

            background: var(--request-soft);

            border: none !important;

            border-radius: 9px;
        }


        .document-left {

            display: flex;

            align-items: center;

            gap: 10px;

            min-width: 0;
        }


        .document-file-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 36px;

            height: 36px;

            flex-shrink: 0;

            color: var(--request-red);

            background: #fff0f1;

            border: none !important;

            border-radius: 8px;

            font-size: .85rem;
        }


        .document-details {

            display: flex;

            flex-direction: column;

            gap: 2px;

            min-width: 0;
        }


        .document-details strong {

            color: var(--request-text);

            font-size: .7rem;

            font-weight: 700;
        }


        .document-details span {

            color: var(--request-muted);

            font-size: .59rem;
        }


        /* =========================================================
           VIEW PDF
        ========================================================== */

        .view-pdf-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 5px;

            flex-shrink: 0;

            padding: 7px 12px;

            color: #ffffff !important;

            background: var(--request-red);

            border: none !important;

            border-radius: 7px;

            text-decoration: none;

            font-size: .61rem;

            font-weight: 700;

            white-space: nowrap;

            transition: .2s ease;
        }


        .view-pdf-button:hover {

            color: #ffffff !important;

            background: #bb2d3b;

            transform: translateY(-1px);
        }


        /* =========================================================
           REJECTION
        ========================================================== */

        .rejection-icon {

            color: var(--request-red);

            background: #fff0f1;
        }


        /* =========================================================
           REVIEW
        ========================================================== */

        .review-section {

            border: none !important;

            margin-bottom: 0;

            padding-bottom: 0;
        }


        .approve-form {

            margin: 0 0 10px;
        }


        .action-button {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            width: 100%;

            min-height: 39px;

            padding: 9px 14px;

            color: #ffffff !important;

            border: none !important;

            border-radius: 7px;

            font-size: .65rem;

            font-weight: 700;

            cursor: pointer;

            transition: .2s ease;
        }


        .action-button:hover {

            color: #ffffff !important;

            transform: translateY(-1px);
        }


        .approve-button {

            background: var(--request-green);
        }


        .approve-button:hover {

            background: #157347;
        }


        .reject-area {

            margin-top: 8px;
        }


        .review-label {

            display: flex;

            align-items: center;

            gap: 5px;

            margin-bottom: 6px;

            color: var(--request-text);

            font-size: .68rem;

            font-weight: 700;
        }


        .review-label i {

            color: var(--request-red);
        }


        .review-textarea {

            display: block;

            width: 100%;

            min-height: 100px;

            padding: 10px 11px;

            box-sizing: border-box;

            color: var(--request-text);

            background: var(--request-soft);

            border: none !important;

            border-radius: 8px;

            outline: none;

            resize: vertical;

            font-family: inherit;

            font-size: .68rem;

            line-height: 1.55;
        }


        .review-textarea:focus {

            border: none !important;

            outline: none;

            box-shadow:
                0 0 0 2px rgba(220, 53, 69, .12);
        }


        .review-textarea::placeholder {

            color: #999999;
        }


        .reject-button {

            margin-top: 8px;

            background: var(--request-red);
        }


        .reject-button:hover {

            background: #bb2d3b;
        }


        .review-error {

            display: flex;

            align-items: center;

            gap: 5px;

            margin-top: 5px;

            color: var(--request-red);

            font-size: .61rem;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .empty-request {

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            min-height: 320px;

            padding: 30px;

            background: var(--request-card);

            border: none !important;

            border-radius: 14px;

            box-shadow: var(--request-shadow);

            text-align: center;
        }


        .empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 54px;

            height: 54px;

            margin-bottom: 12px;

            color: #ffffff;

            background: #111111;

            border: none !important;

            border-radius: 11px;

            font-size: 1.2rem;
        }


        .empty-request h2 {

            margin: 0 0 5px;

            color: var(--request-black);

            font-size: .95rem;

            font-weight: 800;
        }


        .empty-request p {

            margin: 0;

            color: var(--request-muted);

            font-size: .68rem;
        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] .thesis-request-page {

            --request-black: #ffffff;
            --request-text: #eeeeee;
            --request-muted: #999999;

            --request-card: #000000;
            --request-soft: #0d0d0d;
            --request-soft-blue: #101820;

            --request-shadow:
                0 4px 18px rgba(0, 0, 0, .4);
        }


        [data-bs-theme="dark"] .request-form-card {

            background: #000000;

            border: none !important;
        }


        [data-bs-theme="dark"] .request-form-control {

            color: #ffffff;

            background: #0d0d0d;

            border: none !important;
        }


        [data-bs-theme="dark"] .request-form-control:hover {

            background: #151515;
        }


        [data-bs-theme="dark"] .text-content {

            color: #cccccc;

            background: #0d0d0d;
        }


        [data-bs-theme="dark"] .document-box {

            background: #0d0d0d;
        }


        [data-bs-theme="dark"] .document-file-icon,

        [data-bs-theme="dark"] .rejection-icon {

            background: #281316;
        }


        [data-bs-theme="dark"] .review-textarea {

            color: #eeeeee;

            background: #0d0d0d;

            border: none !important;
        }


        [data-bs-theme="dark"] .request-title-row>i {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .empty-icon {

            color: #000000;

            background: #ffffff;
        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 900px) {

            .request-information-form {

                grid-template-columns: 1fr;

                gap: 12px;
            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .request-form-card {

                padding: 17px;
            }


            .request-header {

                flex-direction: column;

                gap: 12px;

                margin-bottom: 20px;
            }


            .request-status-wrapper {

                padding-top: 0;
            }


            .request-title {

                font-size: 1.2rem;
            }


            /*
             * Keep label and value
             * on the same row.
             */

            .request-form-group {

                grid-template-columns:
                    105px minmax(0, 1fr);

                gap: 9px;
            }


            .document-box {

                align-items: flex-start;

                flex-direction: column;
            }


            .view-pdf-button {

                width: 100%;
            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 480px) {

            .request-form-card {

                padding: 14px;

                border-radius: 11px;
            }


            .request-title-row {

                align-items: center;

                gap: 7px;
            }


            .request-title-row>i {

                font-size: 1rem;
            }


            .request-title {

                font-size: 1.05rem;
            }


            .request-id {

                font-size: .62rem;
            }


            .section-heading {

                gap: 7px;

                margin-bottom: 10px;
            }


            .section-heading-icon {

                width: 29px;

                height: 29px;

                font-size: .67rem;
            }


            .section-heading h2 {

                font-size: .76rem;
            }


            .section-heading p {

                font-size: .56rem;
            }


            .request-content-section {

                margin-bottom: 20px;

                padding-bottom: 18px;
            }


            .request-information-form {

                gap: 10px;
            }


            .request-form-group {

                grid-template-columns:
                    90px minmax(0, 1fr);

                gap: 8px;
            }


            .request-form-label {

                font-size: .59rem;

                letter-spacing: .025em;
            }


            .request-form-control {

                min-height: 40px;

                padding: .5rem .65rem;

                font-size: .63rem;
            }


            .text-content {

                padding: 9px;

                font-size: .65rem;

                line-height: 1.6;

                text-align: left;
            }


            .document-box {

                padding: 9px;
            }


            .document-file-icon {

                width: 33px;

                height: 33px;
            }


            .document-details strong {

                font-size: .66rem;
            }


            .document-details span {

                font-size: .56rem;
            }

        }


        /* =========================================================
           VERY SMALL SCREENS
        ========================================================== */

        @media (max-width: 360px) {

            .request-form-group {

                grid-template-columns:
                    80px minmax(0, 1fr);

                gap: 7px;
            }


            .request-form-label {

                font-size: .56rem;
            }


            .request-form-control {

                font-size: .6rem;

                padding-left: .55rem;

                padding-right: .55rem;
            }

        }


        /* =========================================================
           REDUCED MOTION
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            .thesis-request-page *,

            .thesis-request-page *::before,

            .thesis-request-page *::after {

                transition: none !important;

                animation: none !important;
            }

        }
    </style>

</x-app-layout>
