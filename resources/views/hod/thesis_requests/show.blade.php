```blade
<x-app-layout>

<div class="dashboard-content thesis-request-review-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="review-page-header">

        <div>

            <span class="review-overline">
                MANAGEMENT
            </span>

            <h1 class="review-page-title">
                Thesis Request Review
            </h1>

            <p class="review-page-description">
                Review the thesis submission information and make a decision.
            </p>

        </div>

        <a
            href="{{ route('hod.thesis_requests.index') }}"
            class="review-back-button">

            <i class="bi bi-arrow-left"></i>

            <span>
                Back to Requests
            </span>

        </a>

    </div>


    {{-- =========================================================
        ALERTS
    ========================================================== --}}

    @if (session('success'))

        <div class="review-alert review-alert-success">

            <div class="review-alert-icon">
                <i class="bi bi-check-circle"></i>
            </div>

            <div>
                <strong>
                    Success
                </strong>

                <span>
                    {{ session('success') }}
                </span>
            </div>

        </div>

    @endif


    @if (session('error'))

        <div class="review-alert review-alert-error">

            <div class="review-alert-icon">
                <i class="bi bi-exclamation-circle"></i>
            </div>

            <div>
                <strong>
                    Error
                </strong>

                <span>
                    {{ session('error') }}
                </span>
            </div>

        </div>

    @endif


    @if ($thesisRequest)

        {{-- =====================================================
            MAIN REQUEST CARD
        ====================================================== --}}

        <article class="review-card">


            {{-- =================================================
                REQUEST HEADER
            ================================================== --}}

            <div class="review-card-header">

                <div class="review-title-area">

                    <div class="review-title-label">

                        <i class="bi bi-journal-text"></i>

                        Thesis Submission

                    </div>

                    <h2 class="review-title">
                        {{ $thesisRequest->title }}
                    </h2>

                    <div class="review-request-id">

                        <span>
                            Request ID
                        </span>

                        <strong>
                            #{{ $thesisRequest->id }}
                        </strong>

                    </div>

                </div>


                {{-- STATUS --}}

                <div class="review-status-area">

                    @if ($thesisRequest->status === 'approved')

                        <span class="review-status approved">

                            <i class="bi bi-check-circle-fill"></i>

                            Approved

                        </span>

                    @elseif ($thesisRequest->status === 'pending')

                        <span class="review-status pending">

                            <i class="bi bi-clock-fill"></i>

                            Pending Review

                        </span>

                    @elseif ($thesisRequest->status === 'rejected')

                        <span class="review-status rejected">

                            <i class="bi bi-x-circle-fill"></i>

                            Rejected

                        </span>

                    @else

                        <span class="review-status unknown">

                            <i class="bi bi-question-circle-fill"></i>

                            {{ ucfirst($thesisRequest->status ?? 'Unknown') }}

                        </span>

                    @endif

                </div>

            </div>


            {{-- =================================================
                REQUEST INFORMATION
            ================================================== --}}

            <div class="review-section">

                <div class="review-section-heading">

                    <div class="review-section-icon">

                        <i class="bi bi-info-lg"></i>

                    </div>

                    <div>

                        <h3>
                            Request Information
                        </h3>

                        <p>
                            Basic information about this thesis submission.
                        </p>

                    </div>

                </div>


                <div class="review-information-grid">


                    {{-- AUTHOR --}}

                    <div class="review-info-item">

                        <div class="review-info-icon">

                            <i class="bi bi-person"></i>

                        </div>

                        <div class="review-info-content">

                            <span>
                                Author
                            </span>

                            <strong>
                                {{ $thesisRequest->author_name ?? 'N/A' }}
                            </strong>

                        </div>

                    </div>


                    {{-- DEPARTMENT --}}

                    <div class="review-info-item">

                        <div class="review-info-icon">

                            <i class="bi bi-building"></i>

                        </div>

                        <div class="review-info-content">

                            <span>
                                Department
                            </span>

                            <strong>
                                {{ $thesisRequest->department?->name ?? 'N/A' }}
                            </strong>

                        </div>

                    </div>


                    {{-- SUBMITTED BY --}}

                    <div class="review-info-item">

                        <div class="review-info-icon">

                            <i class="bi bi-person-up"></i>

                        </div>

                        <div class="review-info-content">

                            <span>
                                Submitted By
                            </span>

                            <strong>
                                {{ $thesisRequest->user?->name
                                    ?? $thesisRequest->user?->username
                                    ?? 'N/A' }}
                            </strong>

                        </div>

                    </div>


                    {{-- SUBMITTED AT --}}

                    <div class="review-info-item">

                        <div class="review-info-icon">

                            <i class="bi bi-calendar3"></i>

                        </div>

                        <div class="review-info-content">

                            <span>
                                Submitted At
                            </span>

                            <strong>

                                {{ $thesisRequest->submitted_at
                                    ? \Carbon\Carbon::parse($thesisRequest->submitted_at)->format('d M Y, h:i A')
                                    : 'N/A' }}

                            </strong>

                        </div>

                    </div>


                    {{-- REVIEWED BY --}}

                    <div class="review-info-item">

                        <div class="review-info-icon">

                            <i class="bi bi-person-check"></i>

                        </div>

                        <div class="review-info-content">

                            <span>
                                Reviewed By
                            </span>

                            <strong>

                                {{ $thesisRequest->reviewer?->name
                                    ?? $thesisRequest->reviewer?->username
                                    ?? 'Not yet reviewed' }}

                            </strong>

                        </div>

                    </div>


                    {{-- REVIEWED AT --}}

                    <div class="review-info-item">

                        <div class="review-info-icon">

                            <i class="bi bi-calendar-check"></i>

                        </div>

                        <div class="review-info-content">

                            <span>
                                Reviewed At
                            </span>

                            <strong>

                                {{ $thesisRequest->reviewed_at
                                    ? \Carbon\Carbon::parse($thesisRequest->reviewed_at)->format('d M Y, h:i A')
                                    : 'Not yet reviewed' }}

                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                ABSTRACT
            ================================================== --}}

            <div class="review-section">

                <div class="review-section-heading">

                    <div class="review-section-icon">

                        <i class="bi bi-file-text"></i>

                    </div>

                    <div>

                        <h3>
                            Abstract
                        </h3>

                        <p>
                            Thesis abstract submitted by the student.
                        </p>

                    </div>

                </div>


                <div class="review-text-box">

                    @if ($thesisRequest->abstract)

                        {{ $thesisRequest->abstract }}

                    @else

                        <span class="review-empty-text">
                            No abstract provided.
                        </span>

                    @endif

                </div>

            </div>


            {{-- =================================================
                DESCRIPTION
            ================================================== --}}

            <div class="review-section">

                <div class="review-section-heading">

                    <div class="review-section-icon">

                        <i class="bi bi-card-text"></i>

                    </div>

                    <div>

                        <h3>
                            Description
                        </h3>

                        <p>
                            Additional information about the thesis.
                        </p>

                    </div>

                </div>


                <div class="review-text-box">

                    @if ($thesisRequest->description)

                        {{ $thesisRequest->description }}

                    @else

                        <span class="review-empty-text">
                            No description provided.
                        </span>

                    @endif

                </div>

            </div>


            {{-- =================================================
                PDF
            ================================================== --}}

            <div class="review-section">

                <div class="review-section-heading">

                    <div class="review-section-icon">

                        <i class="bi bi-file-earmark-pdf"></i>

                    </div>

                    <div>

                        <h3>
                            Thesis Document
                        </h3>

                        <p>
                            Open the submitted thesis document for review.
                        </p>

                    </div>

                </div>


                <a
                    href="{{ route('hod.thesis_requests.view-request-pdf', $thesisRequest) }}"
                    target="_blank"
                    class="review-pdf-button">

                    <div class="review-pdf-icon">

                        <i class="bi bi-file-earmark-pdf"></i>

                    </div>

                    <div class="review-pdf-content">

                        <strong>
                            View Thesis PDF
                        </strong>

                        <span>
                            Open the submitted document in a new tab
                        </span>

                    </div>

                    <i class="bi bi-arrow-up-right review-pdf-arrow"></i>

                </a>

            </div>


            {{-- =================================================
                REJECTION DETAILS
            ================================================== --}}

            @if ($thesisRequest->status === 'rejected')

                <div class="review-rejection">

                    <div class="review-rejection-icon">

                        <i class="bi bi-x-lg"></i>

                    </div>

                    <div class="review-rejection-content">

                        <h3>
                            Thesis Request Rejected
                        </h3>

                        <div class="review-rejection-meta">

                            <div>

                                <span>
                                    Rejected By
                                </span>

                                <strong>

                                    {{ $thesisRequest->reviewer?->name
                                        ?? $thesisRequest->reviewer?->username
                                        ?? 'Unknown' }}

                                </strong>

                            </div>

                        </div>

                        <div class="review-rejection-reason">

                            <span>
                                Rejection Reason
                            </span>

                            <p>
                                {{ $thesisRequest->remarks ?? 'No rejection reason provided.' }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =================================================
                REVIEW ACTIONS
            ================================================== --}}

            @if ($thesisRequest->status === 'pending')

                <div class="review-decision-section">

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


                    {{-- APPROVE --}}

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
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="approve-button">

                                <i class="bi bi-check-circle"></i>

                                Approve Request

                            </button>

                        </form>

                    </div>


                    {{-- REJECT --}}

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
                            method="POST">

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
                                    required>{{ old('remarks') }}</textarea>

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
                                    class="reject-button">

                                    <i class="bi bi-x-circle"></i>

                                    Reject Request

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            @endif


        </article>


    @else

        {{-- =====================================================
            EMPTY STATE
        ====================================================== --}}

        <div class="review-empty">

            <div class="review-empty-icon">

                <i class="bi bi-journal-x"></i>

            </div>

            <h3>
                Request Not Found
            </h3>

            <p>
                The thesis upload request could not be found.
            </p>

            <a
                href="{{ route('hod.thesis_requests.index') }}"
                class="review-empty-button">

                <i class="bi bi-arrow-left"></i>

                Back to Requests

            </a>

        </div>

    @endif

</div>


{{-- =============================================================
    CSS
============================================================= --}}

<style>

    /* =========================================================
       PAGE
    ========================================================== */

    .thesis-request-review-page {

        --review-black: #111111;
        --review-dark: #222222;

        --review-text: #333333;

        --review-muted: #777777;

        --review-light: #f7f7f7;
        --review-lighter: #fafafa;

        --review-border: #eeeeee;

        --review-green: #176b3a;
        --review-green-bg: #edf9f1;

        --review-red: #a52a35;
        --review-red-bg: #fff1f2;

        --review-yellow: #8a6500;
        --review-yellow-bg: #fff8df;

    }


    /* =========================================================
       PAGE HEADER
    ========================================================== */

    .review-page-header {

        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 1rem;

        margin-bottom: 1.5rem;

        padding: 0 15px;

    }


    .review-overline {

        display: block;

        margin-bottom: .25rem;

        color: #888888;

        font-size: .62rem;

        font-weight: 800;

        letter-spacing: .14em;

        text-transform: uppercase;

    }


    .review-page-title {

        margin: 0;

        color: #111111;

        font-size: 1.8rem;

        font-weight: 800;

        line-height: 1.2;

        letter-spacing: -.035em;

    }


    .review-page-description {

        margin: .4rem 0 0;

        color: #888888;

        font-size: .72rem;

    }


    /* =========================================================
       BACK BUTTON
    ========================================================== */

    .review-back-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: .45rem;

        min-height: 38px;

        padding: .55rem .8rem;

        color: #222222;

        background: #ffffff;

        border: none;

        border-radius: 9px;

        box-shadow:
            0 3px 14px rgba(0, 0, 0, .05);

        text-decoration: none;

        font-size: .65rem;

        font-weight: 800;

        transition: .2s ease;

    }


    .review-back-button:hover {

        color: #ffffff;

        background: #111111;

        transform: translateY(-1px);

    }


    /* =========================================================
       ALERT
    ========================================================== */

    .review-alert {

        display: flex;

        align-items: center;

        gap: .7rem;

        margin: 0 15px 1.25rem;

        padding: .8rem 1rem;

        border-radius: 10px;

    }


    .review-alert-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 32px;

        height: 32px;

        flex-shrink: 0;

        border-radius: 8px;

        font-size: .85rem;

    }


    .review-alert > div:last-child {

        display: flex;

        flex-direction: column;

        gap: .08rem;

    }


    .review-alert strong {

        font-size: .68rem;

        font-weight: 800;

    }


    .review-alert span {

        font-size: .65rem;

    }


    .review-alert-success {

        color: #176b3a;

        background: #f0fff5;

    }


    .review-alert-success .review-alert-icon {

        background: #dff5e7;

    }


    .review-alert-error {

        color: #a52a35;

        background: #fff3f4;

    }


    .review-alert-error .review-alert-icon {

        background: #ffe1e4;

    }


    /* =========================================================
       MAIN CARD
    ========================================================== */

    .review-card {

        margin: 0 15px 1.5rem;

        overflow: hidden;

        background: #ffffff;

        border: none;

        border-radius: 16px;

        box-shadow:
            0 5px 24px rgba(0, 0, 0, .06);

    }


    /* =========================================================
       CARD HEADER
    ========================================================== */

    .review-card-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 1.5rem;

        padding: 1.5rem;

        background: #ffffff;

        border-bottom: 1px solid #f0f0f0;

    }


    .review-title-area {

        flex: 1;

        min-width: 0;

    }


    .review-title-label {

        display: flex;

        align-items: center;

        gap: .4rem;

        margin-bottom: .55rem;

        color: #888888;

        font-size: .6rem;

        font-weight: 800;

        letter-spacing: .08em;

        text-transform: uppercase;

    }


    .review-title-label i {

        color: #111111;

        font-size: .75rem;

    }


    .review-title {

        margin: 0;

        color: #111111;

        font-size: 1.45rem;

        font-weight: 800;

        line-height: 1.35;

        letter-spacing: -.025em;

    }


    .review-request-id {

        display: flex;

        align-items: center;

        gap: .4rem;

        margin-top: .5rem;

        color: #999999;

        font-size: .62rem;

    }


    .review-request-id strong {

        color: #555555;

        font-weight: 700;

    }


    /* =========================================================
       STATUS
    ========================================================== */

    .review-status-area {

        flex-shrink: 0;

    }


    .review-status {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: .4rem;

        padding: .5rem .75rem;

        border-radius: 999px;

        font-size: .62rem;

        font-weight: 800;

        white-space: nowrap;

    }


    .review-status.pending {

        color: var(--review-yellow);

        background: var(--review-yellow-bg);

    }


    .review-status.approved {

        color: var(--review-green);

        background: var(--review-green-bg);

    }


    .review-status.rejected {

        color: var(--review-red);

        background: var(--review-red-bg);

    }


    .review-status.unknown {

        color: #555555;

        background: #f2f2f2;

    }


    /* =========================================================
       SECTION
    ========================================================== */

    .review-section {

        padding: 1.35rem 1.5rem;

        border-bottom: 1px solid #f2f2f2;

    }


    .review-section-heading {

        display: flex;

        align-items: center;

        gap: .7rem;

        margin-bottom: 1rem;

    }


    .review-section-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 34px;

        height: 34px;

        flex-shrink: 0;

        color: #333333;

        background: #f5f5f5;

        border-radius: 9px;

        font-size: .8rem;

    }


    .review-section-heading h3 {

        margin: 0;

        color: #222222;

        font-size: .8rem;

        font-weight: 800;

    }


    .review-section-heading p {

        margin: .15rem 0 0;

        color: #999999;

        font-size: .61rem;

    }


    /* =========================================================
       INFORMATION GRID
    ========================================================== */

    .review-information-grid {

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: .7rem;

    }


    .review-info-item {

        display: flex;

        align-items: center;

        gap: .65rem;

        min-width: 0;

        padding: .8rem;

        background: #f8f8f8;

        border-radius: 10px;

    }


    .review-info-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 32px;

        height: 32px;

        flex-shrink: 0;

        color: #555555;

        background: #ffffff;

        border-radius: 8px;

        font-size: .72rem;

    }


    .review-info-content {

        display: flex;

        flex-direction: column;

        min-width: 0;

    }


    .review-info-content span {

        margin-bottom: .12rem;

        color: #999999;

        font-size: .53rem;

        font-weight: 800;

        letter-spacing: .06em;

        text-transform: uppercase;

    }


    .review-info-content strong {

        overflow: hidden;

        color: #222222;

        font-size: .68rem;

        font-weight: 700;

        line-height: 1.4;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    /* =========================================================
       TEXT CONTENT
    ========================================================== */

    .review-text-box {

        min-height: 90px;

        padding: .9rem 1rem;

        color: #555555;

        background: #fafafa;

        border-radius: 10px;

        font-size: .7rem;

        line-height: 1.7;

        text-align: justify;

        white-space: pre-line;

    }


    .review-empty-text {

        color: #aaaaaa;

        font-style: italic;

    }


    /* =========================================================
       PDF BUTTON
    ========================================================== */

    .review-pdf-button {

        display: flex;

        align-items: center;

        gap: .8rem;

        padding: .8rem;

        color: #222222;

        background: #f8f8f8;

        border: none;

        border-radius: 11px;

        text-decoration: none;

        transition: .2s ease;

    }


    .review-pdf-button:hover {

        color: #111111;

        background: #f1f1f1;

        transform: translateY(-1px);

    }


    .review-pdf-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 38px;

        height: 38px;

        flex-shrink: 0;

        color: #a52a35;

        background: #ffffff;

        border-radius: 9px;

        font-size: .95rem;

    }


    .review-pdf-content {

        display: flex;

        flex-direction: column;

        flex: 1;

        min-width: 0;

    }


    .review-pdf-content strong {

        color: #222222;

        font-size: .68rem;

        font-weight: 800;

    }


    .review-pdf-content span {

        margin-top: .1rem;

        color: #999999;

        font-size: .58rem;

    }


    .review-pdf-arrow {

        color: #888888;

        font-size: .75rem;

    }


    /* =========================================================
       REJECTION BOX
    ========================================================== */

    .review-rejection {

        display: flex;

        gap: .8rem;

        margin: 1.25rem 1.5rem;

        padding: 1rem;

        background: #fff4f5;

        border-radius: 11px;

    }


    .review-rejection-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 34px;

        height: 34px;

        flex-shrink: 0;

        color: #a52a35;

        background: #ffe1e4;

        border-radius: 8px;

        font-size: .75rem;

    }


    .review-rejection-content {

        flex: 1;

        min-width: 0;

    }


    .review-rejection-content h3 {

        margin: 0 0 .7rem;

        color: #a52a35;

        font-size: .78rem;

        font-weight: 800;

    }


    .review-rejection-meta {

        margin-bottom: .7rem;

    }


    .review-rejection-meta div {

        display: flex;

        align-items: center;

        gap: .4rem;

    }


    .review-rejection-meta span {

        color: #999999;

        font-size: .58rem;

        font-weight: 700;

    }


    .review-rejection-meta strong {

        color: #444444;

        font-size: .64rem;

    }


    .review-rejection-reason {

        padding: .7rem;

        background: #ffffff;

        border-radius: 8px;

    }


    .review-rejection-reason span {

        display: block;

        margin-bottom: .3rem;

        color: #999999;

        font-size: .55rem;

        font-weight: 800;

        letter-spacing: .04em;

        text-transform: uppercase;

    }


    .review-rejection-reason p {

        margin: 0;

        color: #555555;

        font-size: .65rem;

        line-height: 1.6;

    }


    /* =========================================================
       DECISION SECTION
    ========================================================== */

    .review-decision-section {

        padding: 1.5rem;

        background: #fafafa;

    }


    .review-decision-header {

        margin-bottom: 1rem;

    }


    .review-decision-overline {

        display: block;

        margin-bottom: .2rem;

        color: #999999;

        font-size: .55rem;

        font-weight: 800;

        letter-spacing: .1em;

    }


    .review-decision-header h3 {

        margin: 0;

        color: #222222;

        font-size: .9rem;

        font-weight: 800;

    }


    .review-decision-header p {

        margin: .25rem 0 0;

        color: #999999;

        font-size: .62rem;

    }


    /* =========================================================
       APPROVE BOX
    ========================================================== */

    .approve-box {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 1rem;

        margin-bottom: .8rem;

        padding: 1rem;

        background: #ffffff;

        border-radius: 11px;

    }


    .approve-content {

        display: flex;

        align-items: center;

        gap: .7rem;

        min-width: 0;

    }


    .approve-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 38px;

        height: 38px;

        flex-shrink: 0;

        color: #176b3a;

        background: #eaf8ef;

        border-radius: 9px;

    }


    .approve-content > div:last-child {

        display: flex;

        flex-direction: column;

        min-width: 0;

    }


    .approve-content strong {

        color: #222222;

        font-size: .68rem;

        font-weight: 800;

    }


    .approve-content span {

        margin-top: .12rem;

        color: #999999;

        font-size: .58rem;

    }


    .approve-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: .4rem;

        min-height: 38px;

        padding: .55rem .9rem;

        color: #ffffff;

        background: #176b3a;

        border: none;

        border-radius: 8px;

        font-size: .62rem;

        font-weight: 800;

        cursor: pointer;

        transition: .2s ease;

    }


    .approve-button:hover {

        background: #12572f;

        transform: translateY(-1px);

    }


    /* =========================================================
       REJECT BOX
    ========================================================== */

    .reject-box {

        padding: 1rem;

        background: #ffffff;

        border-radius: 11px;

    }


    .reject-heading {

        display: flex;

        align-items: center;

        gap: .7rem;

        margin-bottom: .9rem;

    }


    .reject-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 38px;

        height: 38px;

        flex-shrink: 0;

        color: #a52a35;

        background: #fff0f1;

        border-radius: 9px;

    }


    .reject-heading > div:last-child {

        display: flex;

        flex-direction: column;

    }


    .reject-heading strong {

        color: #222222;

        font-size: .68rem;

        font-weight: 800;

    }


    .reject-heading span {

        margin-top: .12rem;

        color: #999999;

        font-size: .58rem;

    }


    /* =========================================================
       TEXTAREA
    ========================================================== */

    .review-textarea-wrapper label {

        display: block;

        margin-bottom: .4rem;

        color: #555555;

        font-size: .62rem;

        font-weight: 800;

    }


    .review-textarea {

        display: block;

        width: 100%;

        min-height: 115px;

        padding: .75rem;

        color: #333333;

        background: #fafafa;

        border: none;

        border-radius: 8px;

        outline: none;

        resize: vertical;

        font-family: inherit;

        font-size: .65rem;

        line-height: 1.6;

        box-sizing: border-box;

        transition: .2s ease;

    }


    .review-textarea::placeholder {

        color: #aaaaaa;

    }


    .review-textarea:focus {

        background: #f5f5f5;

        box-shadow:
            0 0 0 2px rgba(17, 17, 17, .08);

    }


    .review-validation-error {

        display: flex;

        align-items: center;

        gap: .3rem;

        margin-top: .35rem;

        color: #a52a35;

        font-size: .58rem;

    }


    .reject-submit {

        display: flex;

        justify-content: flex-end;

        margin-top: .8rem;

    }


    .reject-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: .4rem;

        min-height: 38px;

        padding: .55rem .9rem;

        color: #ffffff;

        background: #a52a35;

        border: none;

        border-radius: 8px;

        font-size: .62rem;

        font-weight: 800;

        cursor: pointer;

        transition: .2s ease;

    }


    .reject-button:hover {

        background: #8f222c;

        transform: translateY(-1px);

    }


    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .review-empty {

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: center;

        min-height: 360px;

        margin: 0 15px;

        padding: 2rem;

        text-align: center;

        background: #ffffff;

        border-radius: 16px;

        box-shadow:
            0 5px 24px rgba(0, 0, 0, .06);

    }


    .review-empty-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 56px;

        height: 56px;

        margin-bottom: .9rem;

        color: #ffffff;

        background: #111111;

        border-radius: 13px;

        font-size: 1.2rem;

    }


    .review-empty h3 {

        margin: 0 0 .3rem;

        color: #222222;

        font-size: .95rem;

        font-weight: 800;

    }


    .review-empty p {

        margin: 0 0 1rem;

        color: #999999;

        font-size: .65rem;

    }


    .review-empty-button {

        display: inline-flex;

        align-items: center;

        gap: .4rem;

        padding: .55rem .8rem;

        color: #ffffff;

        background: #111111;

        border-radius: 8px;

        text-decoration: none;

        font-size: .62rem;

        font-weight: 800;

        transition: .2s ease;

    }


    .review-empty-button:hover {

        color: #ffffff;

        background: #333333;

    }


    /* =========================================================
       TABLET
    ========================================================== */

    @media (max-width: 767.98px) {

        .review-page-header {

            align-items: flex-start;

            flex-direction: column;

            padding: 0 12px;

        }


        .review-page-title {

            font-size: 1.45rem;

        }


        .review-card {

            margin-left: 12px;

            margin-right: 12px;

        }


        .review-card-header {

            flex-direction: column;

            padding: 1.15rem;

        }


        .review-status-area {

            align-self: flex-start;

        }


        .review-section {

            padding: 1.15rem;

        }


        .review-information-grid {

            grid-template-columns: 1fr;

        }


        .review-rejection {

            margin-left: 1.15rem;

            margin-right: 1.15rem;

        }


        .review-decision-section {

            padding: 1.15rem;

        }


        .approve-box {

            align-items: stretch;

            flex-direction: column;

        }


        .approve-button {

            width: 100%;

        }


        .reject-submit {

            display: block;

        }


        .reject-button {

            width: 100%;

        }


        .review-empty {

            margin-left: 12px;

            margin-right: 12px;

        }

    }


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 480px) {

        .review-page-title {

            font-size: 1.3rem;

        }


        .review-page-description {

            font-size: .65rem;

        }


        .review-back-button {

            width: 100%;

        }


        .review-title {

            font-size: 1.05rem;

        }


        .review-title-label {

            font-size: .55rem;

        }


        .review-card {

            border-radius: 13px;

        }


        .review-card-header {

            padding: 1rem;

        }


        .review-section {

            padding: 1rem;

        }


        .review-section-heading {

            align-items: flex-start;

        }


        .review-text-box {

            font-size: .65rem;

            line-height: 1.6;

        }


        .review-pdf-content span {

            display: none;

        }


        .review-rejection {

            margin: 1rem;

            padding: .8rem;

        }


        .review-decision-section {

            padding: 1rem;

        }

    }

</style>


</x-app-layout>
```
