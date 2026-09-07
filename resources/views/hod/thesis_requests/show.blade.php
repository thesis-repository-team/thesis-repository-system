<x-app-layout>

    <div class="dashboard-content thesis-request-page">

        {{-- =========================================================
            ALERTS
        ========================================================== --}}

        @if (session('success'))

            <div class="request-alert request-alert-success">

                <i class="bi bi-check-circle-fill"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


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
                MAIN CARD
            ====================================================== --}}

            <div class="request-form-card">


                {{-- =================================================
                    HEADER
                ================================================== --}}

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

                            <h2>
                                Request Information
                            </h2>

                            <p>
                                Details about this thesis submission.
                            </p>

                        </div>

                    </div>


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


                        <a
                            href="{{ route('hod.thesis_requests.view-request-pdf', $thesisRequest) }}"
                            target="_blank"
                            class="view-pdf-button"
                        >

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

                    <div class="review-decision-section">


                        {{-- =================================================
                            REVIEW HEADER
                        ================================================== --}}

                        <div class="review-decision-header">

                            <div>

                                <span class="review-decision-overline">
                                    ACTION REQUIRED
                                </span>

                                <h3>
                                    Review Decision
                                </h3>

                                <p>
                                    Choose whether to approve or reject this thesis submission.
                                </p>

                            </div>

                        </div>


                        {{-- =================================================
                            APPROVE
                        ================================================== --}}

                        <div class="approve-box">

                            <div class="approve-content">

                                <div class="approve-icon">

                                    <i class="bi bi-check-lg"></i>

                                </div>


                                <div>

                                    <strong>
                                        Approve Thesis Request
                                    </strong>

                                    <span>
                                        Approving will accept this thesis submission.
                                    </span>

                                </div>

                            </div>


                            <form
                                action="{{ route('hod.thesis_requests.approve', $thesisRequest) }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="approve-button"
                                >

                                    <i class="bi bi-check-circle"></i>

                                    Approve Request

                                </button>

                            </form>

                        </div>


                        {{-- =================================================
                            REJECT
                        ================================================== --}}

                        <div class="reject-box">

                            <div class="reject-heading">

                                <div class="reject-icon">

                                    <i class="bi bi-x-lg"></i>

                                </div>


                                <div>

                                    <strong>
                                        Reject Thesis Request
                                    </strong>

                                    <span>
                                        Please provide a reason for rejecting this submission.
                                    </span>

                                </div>

                            </div>


                            <form
                                action="{{ route('hod.thesis_requests.reject', $thesisRequest) }}"
                                method="POST"
                            >

                                @csrf

                                @method('PUT')


                                <div class="review-textarea-wrapper">

                                    <label for="remarks">
                                        Rejection Reason
                                    </label>


                                    <textarea
                                        name="remarks"
                                        id="remarks"
                                        rows="5"
                                        class="review-textarea"
                                        placeholder="Explain why this thesis request is being rejected..."
                                        required
                                    >{{ old('remarks') }}</textarea>


                                    @error('remarks')

                                        <div class="review-validation-error">

                                            <i class="bi bi-exclamation-circle"></i>

                                            {{ $message }}

                                        </div>

                                    @enderror

                                </div>


                                <div class="reject-submit">

                                    <button
                                        type="submit"
                                        class="reject-button"
                                    >

                                        <i class="bi bi-x-circle"></i>

                                        Reject Request

                                    </button>

                                </div>

                            </form>

                        </div>

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
           GLOBAL PAGE
        ========================================================== */

        .thesis-request-page {

            color: var(--request-text);

            transition:
                color .25s ease;
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

            transition:
                background-color .25s ease,
                box-shadow .25s ease;
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


        .request-title-row > i {

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
           INFORMATION
        ========================================================== */

        .request-information-form {

            display: grid;

            grid-template-columns:
                1.2fr 1fr;

            gap: 12px 28px;

            width: 100%;

            box-sizing: border-box;
        }


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
           REJECTION ICON
        ========================================================== */

        .rejection-icon {

            color: var(--request-red);

            background: #fff0f1;
        }


        /* =========================================================
           REVIEW DECISION
        ========================================================== */

        .review-decision-section {

            margin-top: 8px;

            padding-top: 5px;
        }


        /* =========================================================
           REVIEW HEADER
        ========================================================== */

        .review-decision-header {

            margin-bottom: 18px;
        }


        .review-decision-overline {

            display: block;

            margin-bottom: 4px;

            color: var(--request-red);

            font-size: .59rem;

            font-weight: 800;

            letter-spacing: .12em;

            text-transform: uppercase;
        }


        .review-decision-header h3 {

            margin: 0;

            color: var(--request-black);

            font-size: .95rem;

            font-weight: 800;

            letter-spacing: -.01em;
        }


        .review-decision-header p {

            margin: 4px 0 0;

            color: var(--request-muted);

            font-size: .63rem;
        }


        /* =========================================================
           APPROVE BOX
        ========================================================== */

        .approve-box {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 18px;

            width: 100%;

            padding: 14px;

            margin-bottom: 12px;

            box-sizing: border-box;

            background: #f5faf7;

            border: none !important;

            border-radius: 10px;
        }


        .approve-content {

            display: flex;

            align-items: center;

            gap: 11px;

            min-width: 0;
        }


        .approve-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 38px;

            height: 38px;

            flex-shrink: 0;

            color: var(--request-green);

            background: #e4f5eb;

            border-radius: 9px;

            font-size: .9rem;
        }


        .approve-content > div:last-child {

            display: flex;

            flex-direction: column;

            gap: 3px;

            min-width: 0;
        }


        .approve-content strong {

            color: var(--request-text);

            font-size: .69rem;

            font-weight: 800;
        }


        .approve-content span {

            color: var(--request-muted);

            font-size: .59rem;

            line-height: 1.4;
        }


        /* =========================================================
           APPROVE BUTTON
        ========================================================== */

        .approve-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            flex-shrink: 0;

            min-height: 36px;

            padding: 8px 13px;

            color: #ffffff !important;

            background: var(--request-green);

            border: none !important;

            border-radius: 7px;

            font-family: inherit;

            font-size: .61rem;

            font-weight: 700;

            cursor: pointer;

            white-space: nowrap;

            transition: .2s ease;
        }


        .approve-button:hover {

            color: #ffffff !important;

            background: #157347;

            transform: translateY(-1px);
        }


        /* =========================================================
           REJECT BOX
        ========================================================== */

        .reject-box {

            padding: 14px;

            /* background: lightpink; */

            /* border: none !important; */

            border-radius: 10px;
        }


        .reject-heading {

            display: flex;

            align-items: center;

            gap: 11px;

            margin-bottom: 12px;
        }


        .reject-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 38px;

            height: 38px;

            flex-shrink: 0;

            color: var(--request-red);

            background: #ffe8ea;

            border-radius: 9px;

            font-size: .85rem;
        }


        .reject-heading > div:last-child {

            display: flex;

            flex-direction: column;

            gap: 3px;
        }


        .reject-heading strong {

            color: var(--request-text);

            font-size: .69rem;

            font-weight: 800;
        }


        .reject-heading span {

            color: var(--request-muted);

            font-size: .59rem;

            line-height: 1.4;
        }


        /* =========================================================
           TEXTAREA
        ========================================================== */

        .review-textarea-wrapper {

            width: 100%;
        }


        .review-textarea-wrapper label {

            display: block;

            margin-bottom: 6px;

            color: var(--request-text);

            font-size: .63rem;

            font-weight: 700;
        }


        .review-textarea {

            display: block;

            width: 100%;

            min-height: 100px;

            padding: 10px 11px;

            box-sizing: border-box;

            color: var(--request-text);

            background: #ffffff;

            border: 1px solid #eeeeee !important;

            border-radius: 8px;

            outline: none;

            resize: vertical;

            font-family: inherit;

            font-size: .66rem;

            line-height: 1.55;

            transition: .2s ease;
        }


        .review-textarea:focus {

            border-color: #dddddd !important;

            outline: none;

            box-shadow:
                0 0 0 2px rgba(220, 53, 69, .08);
        }


        .review-textarea::placeholder {

            color: #999999;
        }


        /* =========================================================
           VALIDATION ERROR
        ========================================================== */

        .review-validation-error {

            display: flex;

            align-items: center;

            gap: 5px;

            margin-top: 6px;

            color: var(--request-red);

            font-size: .6rem;
        }


        /* =========================================================
           REJECT SUBMIT
        ========================================================== */

        .reject-submit {

            display: flex;

            justify-content: flex-end;

            margin-top: 9px;
        }


        .reject-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            min-height: 36px;

            padding: 8px 13px;

            color: #ffffff !important;

            background: var(--request-red);

            border: none !important;

            border-radius: 7px;

            font-family: inherit;

            font-size: .61rem;

            font-weight: 700;

            cursor: pointer;

            white-space: nowrap;

            transition: .2s ease;
        }


        .reject-button:hover {

            color: #ffffff !important;

            background: #bb2d3b;

            transform: translateY(-1px);
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
            --request-text: #eeeef8;
            --request-muted: #999fb9;

            --request-card: #181d33;
            --request-soft: #20253a;
            --request-soft-blue: #252b42;

            --request-blue: #ffffff;
            --request-green: #198754;
            --request-red: #dc3545;
            --request-yellow: #ffc107;

            --request-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

            background: #101426;

            color: #eeeef8;
        }


        [data-bs-theme="dark"] body {

            background: #101426;

            color: #eeeef8;
        }


        [data-bs-theme="dark"] .dashboard-content {

            background: #101426;

            color: #eeeef8;
        }


        /* =========================================================
           DARK MAIN CARD
        ========================================================== */

        [data-bs-theme="dark"] .request-form-card {

            background: #181d33;

            border: none !important;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .35);
        }


        /* =========================================================
           DARK HEADER
        ========================================================== */

        [data-bs-theme="dark"] .request-header {

            background: #171b30;

            margin:
                -22px -22px 25px;

            padding:
                18px 22px;

            border-radius:
                14px 14px 0 0;
        }


        [data-bs-theme="dark"] .request-overline {

            color: #999fb9;
        }


        [data-bs-theme="dark"] .request-title-row > i {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .request-title {

            color: #ffffff;
        }


        /* =========================================================
           DARK STATUS
        ========================================================== */

        [data-bs-theme="dark"] .status-approved {

            color: #9de2bb;

            background: #19352a;
        }


        [data-bs-theme="dark"] .status-pending {

            color: #f5d36b;

            background: #3a321b;
        }


        [data-bs-theme="dark"] .status-rejected {

            color: #ff9da5;

            background: #3a2028;
        }


        [data-bs-theme="dark"] .status-default {

            color: #d5d8e8;

            background: #20253a;
        }


        /* =========================================================
           DARK SECTION HEADINGS
        ========================================================== */

        [data-bs-theme="dark"] .section-heading-icon {

            color: #ffffff;

            background: #20253a;
        }


        [data-bs-theme="dark"] .section-heading h2 {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .section-heading p {

            color: #999fb9;
        }


        /* =========================================================
           DARK FORM LABELS
        ========================================================== */

        [data-bs-theme="dark"] .request-form-label {

            color: #d5d8e8;
        }


        /* =========================================================
           DARK FORM VALUES
        ========================================================== */

        [data-bs-theme="dark"] .request-form-control {

            color: #ffffff;

            background: #20253a;

            border: none !important;
        }


        [data-bs-theme="dark"] .request-form-control:hover {

            background: #252b42;
        }


        /* =========================================================
           DARK ABSTRACT / DESCRIPTION
        ========================================================== */

        [data-bs-theme="dark"] .text-content {

            color: #d5d8e8;

            background: #20253a;
        }


        /* =========================================================
           DARK DOCUMENT
        ========================================================== */

        [data-bs-theme="dark"] .document-box {

            background: #20253a;
        }


        [data-bs-theme="dark"] .document-file-icon {

            color: #ff9da5;

            background: #3a2028;
        }


        [data-bs-theme="dark"] .document-details strong {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .document-details span {

            color: #999fb9;
        }


        /* =========================================================
           DARK REJECTION
        ========================================================== */

        [data-bs-theme="dark"] .rejection-icon {

            color: #ff9da5;

            background: #3a2028;
        }


        /* =========================================================
           DARK REVIEW HEADER
        ========================================================== */

        [data-bs-theme="dark"] .review-decision-overline {

            color: #ff9da5;
        }


        [data-bs-theme="dark"] .review-decision-header h3 {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .review-decision-header p {

            color: #999fb9;
        }


        /* =========================================================
           DARK APPROVE BOX
        ========================================================== */

        [data-bs-theme="dark"] .approve-box {

            background: #19352a;
        }


        [data-bs-theme="dark"] .approve-icon {

            color: #9de2bb;

            background: #214c39;
        }


        [data-bs-theme="dark"] .approve-content strong {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .approve-content span {

            color: #999fb9;
        }


        /* =========================================================
           DARK REJECT BOX
        ========================================================== */

        [data-bs-theme="dark"] .reject-box {

            background: #3a2028;
        }


        [data-bs-theme="dark"] .reject-icon {

            color: #ff9da5;

            background: #4a2730;
        }


        [data-bs-theme="dark"] .reject-heading strong {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .reject-heading span {

            color: #999fb9;
        }


        /* =========================================================
           DARK TEXTAREA
        ========================================================== */

        [data-bs-theme="dark"] .review-textarea {

            color: #ffffff;

            background: #20253a;

            border: none !important;
        }


        [data-bs-theme="dark"] .review-textarea-wrapper label {

            color: #d5d8e8;
        }


        [data-bs-theme="dark"] .review-textarea:focus {

            background: #252b42;

            border: none !important;

            box-shadow:
                0 0 0 2px rgba(255, 255, 255, .10);
        }


        [data-bs-theme="dark"] .review-textarea::placeholder {

            color: #777f9c;
        }


        /* =========================================================
           DARK ALERTS
        ========================================================== */

        [data-bs-theme="dark"] .request-alert-success {

            color: #9de2bb;

            background: #19352a;
        }


        [data-bs-theme="dark"] .request-alert-danger {

            color: #ffb4b4;

            background: #3a2028;
        }


        /* =========================================================
           DARK EMPTY STATE
        ========================================================== */

        [data-bs-theme="dark"] .empty-request {

            background: #181d33;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .35);
        }


        [data-bs-theme="dark"] .empty-icon {

            color: #000000;

            background: #ffffff;
        }


        [data-bs-theme="dark"] .empty-request h2 {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .empty-request p {

            color: #999fb9;
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


            [data-bs-theme="dark"] .request-header {

                margin:
                    -17px -17px 20px;

                padding:
                    16px 17px;

                border-radius:
                    14px 14px 0 0;
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


            /* REVIEW DECISION */

            .approve-box {

                align-items: flex-start;

                flex-direction: column;
            }


            .approve-button {

                width: 100%;
            }


            .reject-submit {

                justify-content: stretch;
            }


            .reject-button {

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


            [data-bs-theme="dark"] .request-header {

                margin:
                    -14px -14px 20px;

                padding:
                    14px;

                border-radius:
                    11px 11px 0 0;
            }


            .request-title-row {

                align-items: center;

                gap: 7px;
            }


            .request-title-row > i {

                font-size: 1rem;
            }


            .request-title {

                font-size: 1.05rem;
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


            /* REVIEW */

            .review-decision-header h3 {

                font-size: .86rem;
            }


            .review-decision-header p {

                font-size: .59rem;
            }


            .approve-box,
            .reject-box {

                padding: 11px;

                border-radius: 9px;
            }


            .approve-icon,
            .reject-icon {

                width: 34px;

                height: 34px;

                font-size: .78rem;
            }


            .approve-content strong,
            .reject-heading strong {

                font-size: .65rem;
            }


            .approve-content span,
            .reject-heading span {

                font-size: .56rem;
            }


            .review-textarea {

                min-height: 90px;

                font-size: .63rem;
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