<x-app-layout>

<div class="dashboard-content">

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
            PAGE HEADER
        ====================================================== --}}

        <div class="request-header">

            <div class="request-header-content">

                <span class="request-overline">
                    THESIS REQUEST
                </span>

                <h1 class="request-title">
                    {{ $thesisRequest->title }}
                </h1>

                <span class="request-id">
                    Request #{{ $thesisRequest->id }}
                </span>

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


        {{-- =====================================================
            REQUEST INFORMATION
        ====================================================== --}}

        <section class="request-section">

            <div class="section-heading">

                <div class="section-heading-icon">
                    <i class="bi bi-info-circle-fill"></i>
                </div>

                <div>
                    <h2>Request Information</h2>
                    <p>Details about this thesis submission.</p>
                </div>

            </div>


            {{-- VERTICAL INFORMATION LIST --}}

            <div class="information-list">


                {{-- AUTHOR --}}

                <div class="information-row">

                    <div class="information-label">

                        <i class="bi bi-person-fill"></i>

                        <span>
                            Author
                        </span>

                    </div>

                    <div class="information-value">
                        {{ $thesisRequest->author_name ?? 'N/A' }}
                    </div>

                </div>


                {{-- DEPARTMENT --}}

                <div class="information-row">

                    <div class="information-label">

                        <i class="bi bi-building-fill"></i>

                        <span>
                            Department
                        </span>

                    </div>

                    <div class="information-value">
                        {{ $thesisRequest->department?->name ?? 'N/A' }}
                    </div>

                </div>


                {{-- SUBMITTED BY --}}

                <div class="information-row">

                    <div class="information-label">

                        <i class="bi bi-person-up"></i>

                        <span>
                            Submitted By
                        </span>

                    </div>

                    <div class="information-value">
                        {{ $thesisRequest->user?->name
                            ?? $thesisRequest->user?->username
                            ?? 'N/A' }}
                    </div>

                </div>


                {{-- SUBMITTED AT --}}

                <div class="information-row">

                    <div class="information-label">

                        <i class="bi bi-calendar3"></i>

                        <span>
                            Submitted At
                        </span>

                    </div>

                    <div class="information-value">

                        {{ $thesisRequest->submitted_at
                            ? \Carbon\Carbon::parse($thesisRequest->submitted_at)->format('d M Y, h:i A')
                            : 'N/A' }}

                    </div>

                </div>


                {{-- REVIEWED BY --}}

                <div class="information-row">

                    <div class="information-label">

                        <i class="bi bi-person-check-fill"></i>

                        <span>
                            Reviewed By
                        </span>

                    </div>

                    <div class="information-value">

                        {{ $thesisRequest->reviewer?->name
                            ?? $thesisRequest->reviewer?->username
                            ?? 'Not reviewed' }}

                    </div>

                </div>


                {{-- REVIEWED AT --}}

                <div class="information-row">

                    <div class="information-label">

                        <i class="bi bi-calendar-check-fill"></i>

                        <span>
                            Reviewed At
                        </span>

                    </div>

                    <div class="information-value">

                        {{ $thesisRequest->reviewed_at
                            ? \Carbon\Carbon::parse($thesisRequest->reviewed_at)->format('d M Y, h:i A')
                            : 'Not reviewed' }}

                    </div>

                </div>


            </div>

        </section>


        {{-- =====================================================
            ABSTRACT
        ====================================================== --}}

        <section class="request-section">

            <div class="section-heading">

                <div class="section-heading-icon">
                    <i class="bi bi-file-text-fill"></i>
                </div>

                <div>
                    <h2>Abstract</h2>
                    <p>Abstract submitted with the thesis request.</p>
                </div>

            </div>


            <div class="text-content">

                {{ $thesisRequest->abstract ?? 'No abstract provided.' }}

            </div>

        </section>


        {{-- =====================================================
            DESCRIPTION
        ====================================================== --}}

        <section class="request-section">

            <div class="section-heading">

                <div class="section-heading-icon">
                    <i class="bi bi-card-text"></i>
                </div>

                <div>
                    <h2>Description</h2>
                    <p>Description of the thesis project.</p>
                </div>

            </div>


            <div class="text-content">

                {{ $thesisRequest->description ?? 'No description provided.' }}

            </div>

        </section>


        {{-- =====================================================
            THESIS DOCUMENT
        ====================================================== --}}

        <section class="request-section">

            <div class="section-heading">

                <div class="section-heading-icon document-icon">
                    <i class="bi bi-file-earmark-pdf-fill"></i>
                </div>

                <div>
                    <h2>Thesis Document</h2>
                    <p>Submitted thesis document.</p>
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
                    href="{{ route('admin.thesis_requests.view-request-pdf', $thesisRequest) }}"
                    target="_blank"
                    class="view-pdf-button">

                    <i class="bi bi-eye-fill"></i>

                    View PDF

                </a>

            </div>

        </section>


        {{-- =====================================================
            REJECTION DETAILS
        ====================================================== --}}

        @if ($thesisRequest->status === 'rejected')

            <section class="request-section rejection-section">

                <div class="section-heading">

                    <div class="section-heading-icon rejection-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>

                    <div>
                        <h2>Rejection Details</h2>
                        <p>Information about why this request was rejected.</p>
                    </div>

                </div>


                <div class="information-list">


                    {{-- REJECTED BY --}}

                    <div class="information-row">

                        <div class="information-label">

                            <i class="bi bi-person-x-fill"></i>

                            <span>
                                Rejected By
                            </span>

                        </div>

                        <div class="information-value">
                            {{ $thesisRequest->reviewer?->name
                                ?? $thesisRequest->reviewer?->username
                                ?? 'Unknown' }}
                        </div>

                    </div>


                    {{-- REJECTION REASON --}}

                    <div class="information-row information-row-reason">

                        <div class="information-label">

                            <i class="bi bi-chat-left-text-fill"></i>

                            <span>
                                Rejection Reason
                            </span>

                        </div>

                        <div class="information-value reason-value">

                            {{ $thesisRequest->remarks
                                ?? 'No rejection reason provided.' }}

                        </div>

                    </div>

                </div>

            </section>

        @endif


        {{-- =====================================================
            REVIEW DECISION
        ====================================================== --}}

        @if ($thesisRequest->status === 'pending')

            <section class="request-section review-section">

                <div class="section-heading">

                    <div class="section-heading-icon">
                        <i class="bi bi-clipboard-check-fill"></i>
                    </div>

                    <div>
                        <h2>Review Decision</h2>
                        <p>Choose whether to approve or reject this thesis request.</p>
                    </div>

                </div>


                {{-- APPROVE --}}

                <form
                    action="{{ route('admin.thesis_requests.approve', $thesisRequest) }}"
                    method="POST"
                    class="approve-form">

                    @csrf

                    <button
                        type="submit"
                        class="action-button approve-button">

                        <i class="bi bi-check-circle-fill"></i>

                        Approve Request

                    </button>

                </form>


                {{-- REJECT --}}

                <form
                    action="{{ route('admin.thesis_requests.reject', $thesisRequest) }}"
                    method="POST">

                    @csrf
                    @method('PUT')


                    <div class="reject-area">

                        <label
                            for="remarks"
                            class="review-label">

                            <i class="bi bi-chat-left-text-fill"></i>

                            Rejection Reason

                        </label>


                        <textarea
                            name="remarks"
                            id="remarks"
                            class="review-textarea"
                            rows="5"
                            placeholder="Please explain why this thesis request is rejected..."
                            required>{{ old('remarks') }}</textarea>


                        @error('remarks')

                            <div class="review-error">

                                <i class="bi bi-exclamation-circle-fill"></i>

                                {{ $message }}

                            </div>

                        @enderror


                        <button
                            type="submit"
                            class="action-button reject-button">

                            <i class="bi bi-x-circle-fill"></i>

                            Reject Request

                        </button>

                    </div>

                </form>

            </section>

        @endif


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
   PAGE
========================================================= */

.thesis-request-page {

    --request-black: #111111;
    --request-text: #222222;
    --request-muted: #777777;
    --request-light: #f7f7f7;
    --request-border: #e5e5e5;

    --request-blue: #0d6efd;
    --request-green: #198754;
    --request-red: #dc3545;
    --request-yellow: #997404;

    color: var(--request-text);

}


/* =========================================================
   ALERT
========================================================= */

.request-alert {

    display: flex;
    align-items: center;

    gap: 9px;

    margin-bottom: 20px;

    padding: 11px 14px;

    border-radius: 8px;

    font-size: .78rem;
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
   HEADER
========================================================= */

.request-header {

    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 25px;

    margin-bottom: 40px;

    padding-bottom: 22px;

    border-bottom: 1px solid var(--request-border);

}


.request-header-content {

    min-width: 0;

}


.request-overline {

    display: block;

    margin-bottom: 7px;

    color: #888888;

    font-size: .63rem;

    font-weight: 800;

    letter-spacing: .13em;

}


.request-title {

    margin: 0 0 7px;

    color: var(--request-black);

    font-size: 1.55rem;

    font-weight: 800;

    line-height: 1.35;

    letter-spacing: -.025em;

    overflow-wrap: anywhere;

}


.request-id {

    color: var(--request-muted);

    font-size: .72rem;

}


/* =========================================================
   STATUS
========================================================= */

.request-status-wrapper {

    flex-shrink: 0;

}


.request-status {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 7px 13px;

    border-radius: 999px;

    font-size: .68rem;

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
   SECTION
========================================================= */

.request-section {

    margin-bottom: 40px;

}


.section-heading {

    display: flex;

    align-items: center;

    gap: 11px;

    margin-bottom: 18px;

}


.section-heading-icon {

    display: flex;

    align-items: center;

    justify-content: center;

    width: 34px;

    height: 34px;

    flex-shrink: 0;

    color: var(--request-blue);

    background: #f1f5ff;

    border-radius: 9px;

    font-size: .78rem;

}


.section-heading h2 {

    margin: 0;

    color: var(--request-black);

    font-size: .92rem;

    font-weight: 800;

}


.section-heading p {

    margin: 3px 0 0;

    color: var(--request-muted);

    font-size: .67rem;

}


/* =========================================================
   REQUEST INFORMATION
========================================================= */

.information-list {

    display: flex;

    flex-direction: column;

    width: 100%;

}


/*
|--------------------------------------------------------------------------
| THIS IS THE MAIN STRUCTURE YOU REQUESTED
|--------------------------------------------------------------------------
|
| Author             John Doe
| Department         Information Technology
| Submitted By       john123
| Submitted At       29 Aug 2026
| Reviewed By        Not reviewed
| Reviewed At        Not reviewed
|
*/

.information-row {

    display: grid;

    grid-template-columns: 180px minmax(0, 1fr);

    align-items: center;

    gap: 20px;

    min-height: 48px;

    padding: 8px 0;

    border-bottom: 1px solid #eeeeee;

}


.information-row:last-child {

    border-bottom: none;

}


.information-label {

    display: flex;

    align-items: center;

    gap: 9px;

    color: var(--request-muted);

    font-size: .75rem;

    font-weight: 600;

}


.information-label i {

    width: 18px;

    color: #888888;

    font-size: .78rem;

    text-align: center;

}


.information-value {

    min-width: 0;

    color: var(--request-text);

    font-size: .78rem;

    font-weight: 600;

    overflow-wrap: anywhere;

}


/* =========================================================
   ABSTRACT / DESCRIPTION
========================================================= */

.text-content {

    padding: 15px 0;

    color: #444444;

    font-size: .8rem;

    line-height: 1.8;

    white-space: pre-line;

    text-align: justify;

}


/* =========================================================
   DOCUMENT
========================================================= */

.document-box {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    padding: 15px;

    background: #f8f8f8;

    border-radius: 10px;

}


.document-left {

    display: flex;

    align-items: center;

    gap: 12px;

    min-width: 0;

}


.document-file-icon {

    display: flex;

    align-items: center;

    justify-content: center;

    width: 38px;

    height: 38px;

    flex-shrink: 0;

    color: var(--request-red);

    background: #fff0f1;

    border-radius: 9px;

    font-size: .95rem;

}


.document-details {

    display: flex;

    flex-direction: column;

    gap: 3px;

}


.document-details strong {

    color: var(--request-text);

    font-size: .78rem;

    font-weight: 700;

}


.document-details span {

    color: var(--request-muted);

    font-size: .66rem;

}


.view-pdf-button {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 6px;

    padding: 8px 14px;

    color: #ffffff;

    background: var(--request-red);

    border-radius: 7px;

    text-decoration: none;

    font-size: .68rem;

    font-weight: 700;

    white-space: nowrap;

    transition: .2s ease;

}


.view-pdf-button:hover {

    color: #ffffff;

    background: #bb2d3b;

    transform: translateY(-1px);

}


/* =========================================================
   REJECTION
========================================================= */

.rejection-section {

    padding-top: 5px;

}


.rejection-icon {

    color: var(--request-red);

    background: #fff0f1;

}


.rejection-section .section-heading h2 {

    color: var(--request-red);

}


.reason-value {

    color: var(--request-red);

    font-weight: 500;

    line-height: 1.6;

}


/* =========================================================
   REVIEW DECISION
========================================================= */

.review-section {

    padding-top: 5px;

}


.approve-form {

    margin-bottom: 18px;

}


.action-button {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

    width: 100%;

    min-height: 42px;

    padding: 10px 15px;

    border: none;

    border-radius: 8px;

    color: #ffffff;

    font-size: .75rem;

    font-weight: 700;

    cursor: pointer;

    transition: .2s ease;

}


.action-button:hover {

    transform: translateY(-1px);

}


.approve-button {

    background: var(--request-green);

}


.approve-button:hover {

    background: #157347;

}


.reject-area {

    margin-top: 5px;

}


.review-label {

    display: flex;

    align-items: center;

    gap: 6px;

    margin-bottom: 8px;

    color: var(--request-text);

    font-size: .75rem;

    font-weight: 700;

}


.review-label i {

    color: var(--request-red);

}


.review-textarea {

    display: block;

    width: 100%;

    min-height: 110px;

    padding: 12px;

    color: var(--request-text);

    background: #ffffff;

    border: 1px solid #dddddd;

    border-radius: 8px;

    outline: none;

    resize: vertical;

    font-family: inherit;

    font-size: .76rem;

    line-height: 1.6;

    box-sizing: border-box;

    transition: border-color .2s ease;

}


.review-textarea:focus {

    border-color: var(--request-red);

    box-shadow: 0 0 0 3px rgba(220, 53, 69, .08);

}


.review-textarea::placeholder {

    color: #999999;

}


.reject-button {

    margin-top: 12px;

    background: var(--request-red);

}


.reject-button:hover {

    background: #bb2d3b;

}


.review-error {

    margin-top: 6px;

    color: var(--request-red);

    font-size: .7rem;

}


/* =========================================================
   EMPTY
========================================================= */

.empty-request {

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    min-height: 350px;

    text-align: center;

}


.empty-icon {

    display: flex;

    align-items: center;

    justify-content: center;

    width: 58px;

    height: 58px;

    margin-bottom: 14px;

    color: #ffffff;

    background: #111111;

    border-radius: 12px;

    font-size: 1.3rem;

}


.empty-request h2 {

    margin: 0 0 5px;

    color: var(--request-black);

    font-size: 1rem;

    font-weight: 800;

}


.empty-request p {

    margin: 0;

    color: var(--request-muted);

    font-size: .72rem;

}


/* =========================================================
   DARK MODE
========================================================= */

[data-bs-theme="dark"] .thesis-request-page {

    --request-black: #f5f5f5;

    --request-text: #eeeeee;

    --request-muted: #999999;

    --request-light: #1f1f1f;

    --request-border: #333333;

}


[data-bs-theme="dark"] .information-row {

    border-bottom-color: #333333;

}


[data-bs-theme="dark"] .information-value {

    color: #eeeeee;

}


[data-bs-theme="dark"] .text-content {

    color: #cccccc;

}


[data-bs-theme="dark"] .document-box {

    background: #1f1f1f;

}


[data-bs-theme="dark"] .review-textarea {

    color: #eeeeee;

    background: #1f1f1f;

    border-color: #444444;

}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 767.98px) {

    .request-header {

        flex-direction: column;

        gap: 15px;

        margin-bottom: 30px;

    }


    .request-title {

        font-size: 1.3rem;

    }


    .information-row {

        grid-template-columns: 145px minmax(0, 1fr);

        gap: 15px;

    }


    .information-label {

        font-size: .7rem;

    }


    .information-value {

        font-size: .74rem;

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
   MOBILE
========================================================= */

@media (max-width: 480px) {

    .request-title {

        font-size: 1.15rem;

    }


    .section-heading {

        gap: 8px;

    }


    .section-heading-icon {

        width: 30px;

        height: 30px;

    }


    .section-heading h2 {

        font-size: .85rem;

    }


    .section-heading p {

        font-size: .62rem;

    }


    /*
    |--------------------------------------------------------------------------
    | Still ONE COLUMN STRUCTURE
    |--------------------------------------------------------------------------
    */

    .information-row {

        grid-template-columns: 1fr;

        gap: 4px;

        padding: 11px 0;

    }


    .information-label {

        gap: 7px;

        font-size: .68rem;

    }


    .information-value {

        padding-left: 25px;

        font-size: .74rem;

    }


    .text-content {

        font-size: .76rem;

        text-align: left;

    }


    .document-box {

        padding: 12px;

    }

}

</style>

</x-app-layout>