<x-app-layout>

    <div class="dashboard-content thesis-request-page">

        <div class="container-fluid px-3 px-md-4 py-3 py-md-4">

            {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}
            <div class="page-header mb-4">

                <div class="page-heading-content">
                    <h2 class="page-title">
                        <i class="bi bi-clock-history me-2"></i>
                        Thesis Requests
                    </h2>

                    <p class="page-subtitle mb-0">
                        Submit and track your thesis requests.
                    </p>
                </div>

                <div class="page-header-actions">

                    {{-- CARD / TABLE VIEW SWITCH --}}
                    @if (auth()->user()->student->upload_permission && $thesisRequests->count())
                        <div class="view-switch" role="group" aria-label="Change request view">

                            <button type="button" class="view-switch-btn active" id="cardViewBtn" data-view="card"
                                title="Card view">
                                <i class="bi bi-grid-3x3-gap-fill"></i>
                                <span>Card</span>
                            </button>

                            <button type="button" class="view-switch-btn" id="tableViewBtn" data-view="table"
                                title="Table view">
                                <i class="bi bi-table"></i>
                                <span>Table</span>
                            </button>

                        </div>
                    @endif

                    @if (auth()->user()->student->upload_permission)
                        <a href="{{ route('student.thesis_requests.create') }}" class="create-request-btn">
                            <i class="bi bi-plus-lg"></i>
                            <span>New Request</span>
                        </a>
                    @endif

                </div>
            </div>


            {{-- =====================================================
             SUCCESS MESSAGE
        ====================================================== --}}
            @if (session('success'))
                <div class="alert custom-alert alert-success alert-dismissible fade show" role="alert">

                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>

                </div>
            @endif


            {{-- =====================================================
             ERROR MESSAGE
        ====================================================== --}}
            @if (session('error'))
                <div class="alert custom-alert alert-danger alert-dismissible fade show" role="alert">

                    <i class="bi bi-exclamation-circle-fill"></i>

                    <span>
                        {{ session('error') }}
                    </span>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>

                </div>
            @endif


            {{-- =====================================================
             UPLOAD PERMISSION CHECK
        ====================================================== --}}
            @if (!auth()->user()->student->upload_permission)

                <div class="permission-card">

                    <div class="permission-card-body">

                        {{-- HEADER --}}
                        <div class="permission-header">

                            <div class="permission-icon">
                                <i class="bi bi-lock-fill"></i>
                            </div>

                            <h3>
                                Thesis Upload Permission Required
                            </h3>

                            <p>
                                Your account does not currently have permission
                                to submit a thesis.
                            </p>

                        </div>


                        <div class="permission-divider"></div>


                        {{-- WHY --}}
                        <div class="information-section">

                            <h4>
                                Why can't I submit a thesis?
                            </h4>

                            <p>
                                Students can only submit a thesis after receiving
                                upload permission from their Head of Department.
                                This process helps the school maintain control over
                                thesis submissions and prevents unauthorized uploads.
                            </p>

                        </div>


                        {{-- HOW TO GET PERMISSION --}}
                        <div class="permission-information">

                            <h4>
                                How to get upload permission
                            </h4>

                            <p>
                                If you are the
                                <strong>
                                    team leader of a fourth-year academic group thesis
                                </strong>,
                                please go to your school and provide the following information:
                            </p>


                            <div class="information-grid">

                                {{-- ACCOUNT --}}
                                <div class="information-item">

                                    <div class="information-item-icon">
                                        <i class="bi bi-person"></i>
                                    </div>

                                    <div>
                                        <strong>
                                            Account Name
                                        </strong>

                                        <small>
                                            Your student account full name and username
                                        </small>
                                    </div>

                                </div>


                                {{-- EMAIL --}}
                                <div class="information-item">

                                    <div class="information-item-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>

                                    <div>
                                        <strong>
                                            Email Address
                                        </strong>

                                        <small>
                                            The email registered in your account
                                        </small>
                                    </div>

                                </div>


                                {{-- DEPARTMENT --}}
                                <div class="information-item">

                                    <div class="information-item-icon">
                                        <i class="bi bi-building"></i>
                                    </div>

                                    <div>
                                        <strong>
                                            Department
                                        </strong>

                                        <small>
                                            Your current academic department
                                        </small>
                                    </div>

                                </div>

                            </div>


                            <p class="permission-note">
                                The Admin or Head of Department will review your
                                information and grant upload permission when appropriate.
                            </p>

                        </div>


                        {{-- WHEN TO SUBMIT --}}
                        <div class="information-section">

                            <h4>
                                When should the thesis be submitted?
                            </h4>

                            <p>
                                The thesis should be submitted to the repository only
                                after the group has successfully completed the
                                <strong>final thesis defense</strong>
                                and finished all required corrections and final printing.
                            </p>

                            <p>
                                At this stage, the final approved version of the thesis
                                can be uploaded by the student team leader
                                (with upload permission), the Head of Department,
                                or the Admin.
                            </p>

                        </div>


                        {{-- PROCESS --}}
                        <div class="information-section">

                            <h4>
                                Thesis submission process
                            </h4>


                            {{-- STEP 1 --}}
                            <div class="process-step">

                                <div class="step-number">
                                    1
                                </div>

                                <div class="step-content">

                                    <strong>
                                        Complete and pass the final defense
                                    </strong>

                                    <p>
                                        Complete your thesis defense and make all
                                        corrections required by your supervisor
                                        or examination committee.
                                    </p>

                                </div>

                            </div>


                            {{-- STEP 2 --}}
                            <div class="process-step">

                                <div class="step-number">
                                    2
                                </div>

                                <div class="step-content">

                                    <strong>
                                        Prepare the final version
                                    </strong>

                                    <p>
                                        Prepare and print the final approved version
                                        of your thesis before submitting it to the repository.
                                    </p>

                                </div>

                            </div>


                            {{-- STEP 3 --}}
                            <div class="process-step">

                                <div class="step-number">
                                    3
                                </div>

                                <div class="step-content">

                                    <strong>
                                        Upload the final thesis
                                    </strong>

                                    <p>
                                        The student team leader with upload permission,
                                        Head of Department, or Admin can upload the
                                        final thesis to the repository.
                                    </p>

                                </div>

                            </div>


                            {{-- STEP 4 --}}
                            <div class="process-step">

                                <div class="step-number">
                                    4
                                </div>

                                <div class="step-content">

                                    <strong>
                                        Review and publish
                                    </strong>

                                    <p>
                                        The submission is reviewed by the Head of
                                        Department or Admin. Once approved, the final
                                        thesis is published in the repository.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- REJECTION --}}
                        <div class="rejection-notice">

                            <div class="rejection-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>

                            <div>

                                <strong>
                                    If your thesis request is rejected
                                </strong>

                                <p>
                                    Please check the rejection comment from the Admin
                                    or Head of Department to understand what is wrong
                                    with your submission and make the necessary
                                    corrections before submitting again.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>
            @else
                {{-- =====================================================
                 REQUEST LIST
            ====================================================== --}}
                @if ($thesisRequests->count())

                    {{-- =================================================
                     CARD VIEW
                ================================================== --}}
                    <div class="request-list" id="cardView">

                        @foreach ($thesisRequests as $thesisRequest)
                            <article class="request-card">

                                {{-- CARD HEADER --}}
                                <div class="request-card-header">

                                    <div class="request-number">
                                        {{ $loop->iteration }}
                                    </div>

                                    <div class="request-title-wrapper">

                                        <h3 class="request-title">
                                            {{ $thesisRequest->title }}
                                        </h3>

                                        <p class="request-author">
                                            <i class="bi bi-people"></i>
                                            {{ $thesisRequest->author_name }}
                                        </p>

                                    </div>


                                    {{-- STATUS --}}
                                    <div class="request-status">

                                        @if ($thesisRequest->status === 'pending')
                                            <span class="status-badge status-pending">
                                                <i class="bi bi-clock"></i>
                                                Pending
                                            </span>
                                        @elseif ($thesisRequest->status === 'approved')
                                            <span class="status-badge status-approved">
                                                <i class="bi bi-check-circle-fill"></i>
                                                Approved
                                            </span>
                                        @else
                                            <span class="status-badge status-rejected">
                                                <i class="bi bi-x-circle-fill"></i>
                                                Rejected
                                            </span>
                                        @endif

                                    </div>

                                </div>


                                {{-- CARD BODY --}}
                                <div class="request-card-body">

                                    <div class="request-info">

                                        <span class="request-info-label">
                                            Submitted By
                                        </span>

                                        <strong>
                                            {{ $thesisRequest->user->name ?? 'N/A' }}
                                        </strong>

                                    </div>


                                    <div class="request-info">

                                        <span class="request-info-label">
                                            Department
                                        </span>

                                        <strong>
                                            {{ $thesisRequest->department->name ?? 'N/A' }}
                                        </strong>

                                    </div>


                                    <div class="request-info">

                                        <span class="request-info-label">
                                            Submitted At
                                        </span>

                                        <strong>
                                            {{ $thesisRequest->submitted_at }}
                                        </strong>

                                    </div>

                                </div>


                                {{-- CARD FOOTER --}}
                                <div class="request-card-footer">

                                    <span class="request-id">
                                        <i class="bi bi-journal-text"></i>
                                        Request #{{ $loop->iteration }}
                                    </span>


                                    <div class="request-actions">

                                        <a href="{{ route('student.thesis_requests.show', $thesisRequest) }}"
                                            target="_blank" class="action-btn action-view">

                                            <i class="bi bi-eye"></i>

                                            <span>
                                                View Details
                                            </span>

                                        </a>


                                        @if ($thesisRequest->pdf_file)
                                            <a href="{{ route('student.thesis_requests.view-request-pdf', $thesisRequest) }}"
                                                target="_blank" class="action-btn action-pdf">

                                                <i class="bi bi-file-earmark-pdf"></i>

                                                <span>
                                                    View PDF
                                                </span>

                                            </a>
                                        @endif

                                    </div>

                                </div>

                            </article>
                        @endforeach

                    </div>


                    {{-- =================================================
                     TABLE VIEW
                ================================================== --}}
                    <div class="request-table-wrapper" id="tableView">

                        <div class="request-table-scroll">

                            <table class="request-table">

                                <thead>

                                    <tr>

                                        <th class="table-number">
                                            #
                                        </th>

                                        <th class="table-title">
                                            Thesis Title
                                        </th>

                                        <th>
                                            Author
                                        </th>

                                        <th>
                                            Submitted By
                                        </th>

                                        <th>
                                            Department
                                        </th>

                                        <th>
                                            Submitted At
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th class="table-action">
                                            Action
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach ($thesisRequests as $thesisRequest)
                                        <tr>

                                            {{-- NUMBER --}}
                                            <td class="table-number">

                                                <span class="table-number-badge">
                                                    {{ $loop->iteration }}
                                                </span>

                                            </td>


                                            {{-- TITLE --}}
                                            <td class="table-title">

                                                <div class="table-title-content">

                                                    <strong>
                                                        {{ $thesisRequest->title }}
                                                    </strong>

                                                </div>

                                            </td>


                                            {{-- AUTHOR --}}
                                            <td>

                                                <div class="table-author">

                                                    <i class="bi bi-people"></i>

                                                    <span>
                                                        {{ $thesisRequest->author_name }}
                                                    </span>

                                                </div>

                                            </td>


                                            {{-- SUBMITTED BY --}}
                                            <td>

                                                <span class="table-text">
                                                    {{ $thesisRequest->user->name ?? 'N/A' }}
                                                </span>

                                            </td>


                                            {{-- DEPARTMENT --}}
                                            <td>

                                                <span class="table-text">
                                                    {{ $thesisRequest->department->name ?? 'N/A' }}
                                                </span>

                                            </td>


                                            {{-- SUBMITTED AT --}}
                                            <td>

                                                <span class="table-text table-date">
                                                    {{ $thesisRequest->submitted_at }}
                                                </span>

                                            </td>


                                            {{-- STATUS --}}
                                            <td>

                                                @if ($thesisRequest->status === 'pending')
                                                    <span class="status-badge status-pending">
                                                        <i class="bi bi-clock"></i>
                                                        Pending
                                                    </span>
                                                @elseif ($thesisRequest->status === 'approved')
                                                    <span class="status-badge status-approved">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        Approved
                                                    </span>
                                                @else
                                                    <span class="status-badge status-rejected">
                                                        <i class="bi bi-x-circle-fill"></i>
                                                        Rejected
                                                    </span>
                                                @endif

                                            </td>


                                            {{-- ACTION --}}
                                            <td class="table-action">

                                                <div class="table-actions">

                                                    <a href="{{ route('student.thesis_requests.show', $thesisRequest) }}"
                                                        target="_blank" class="action-btn action-view">

                                                        <i class="bi bi-eye"></i>

                                                        <span>
                                                            View Details
                                                        </span>

                                                    </a>


                                                    @if ($thesisRequest->pdf_file)
                                                        <a href="{{ route('student.thesis_requests.view-request-pdf', $thesisRequest) }}"
                                                            target="_blank" class="action-btn action-pdf">

                                                            <i class="bi bi-file-earmark-pdf"></i>

                                                            <span>
                                                                View PDF
                                                            </span>

                                                        </a>
                                                    @endif

                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>
                @else
                    {{-- =================================================
                     EMPTY STATE
                ================================================== --}}
                    <div class="empty-request-state">

                        <div class="empty-request-icon">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>

                        <h3>
                            No thesis requests found
                        </h3>

                        <p>
                            You have not submitted any thesis requests yet.
                        </p>

                        <a href="{{ route('student.thesis_requests.create') }}" class="empty-create-btn">

                            <i class="bi bi-plus-lg"></i>

                            Create New Request

                        </a>

                    </div>

                @endif

            @endif

        </div>

    </div>


    {{-- =============================================================
     PAGE CSS
============================================================= --}}
    <style>
        /* =========================================================
       THEME VARIABLES
    ========================================================= */

        .thesis-request-page {

            --dashboard-purple: #6538d9;
            --dashboard-purple-dark: #5030b8;
            --dashboard-purple-light: #eee8ff;

            --request-bg: #f8f8fc;
            --request-card: #ffffff;
            --request-border: #e8e8f0;
            --request-text: #151a3b;
            --request-muted: #6d7392;

            --request-shadow:
                0 4px 16px rgba(30, 25, 70, 0.06);

            --request-shadow-hover:
                0 8px 24px rgba(30, 25, 70, 0.10);

            --request-radius: 12px;

            min-height: calc(100vh - 80px);

            color: var(--request-text);
        }


        /* =========================================================
       PAGE HEADER
    ========================================================= */

        .thesis-request-page .page-header {

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;
        }


        .thesis-request-page .page-heading-content {
            min-width: 0;
        }


        .thesis-request-page .page-title {

            margin: 0;

            color: var(--request-text);

            font-size: 1.7rem;
            font-weight: 700;

            line-height: 1.3;

            letter-spacing: -0.025em;
        }


        .thesis-request-page .page-title i {
            color: var(--dashboard-purple);
        }


        .thesis-request-page .page-subtitle {

            margin-top: 6px;

            color: var(--request-muted);

            font-size: 0.9rem;

            line-height: 1.5;
        }


        /* =========================================================
       PAGE HEADER ACTIONS
    ========================================================= */

        .thesis-request-page .page-header-actions {

            display: flex;
            align-items: center;
            justify-content: flex-end;

            gap: 10px;

            flex: 0 0 auto;
        }


        /* =========================================================
       CARD / TABLE SWITCH
    ========================================================= */

        .thesis-request-page .view-switch {

            display: inline-flex;
            align-items: center;

            padding: 3px;

            gap: 2px;

            background: var(--request-card);

            border: 1px solid var(--request-border);

            border-radius: 9px;

            box-shadow: 0 2px 8px rgba(30, 25, 70, 0.05);
        }


        .thesis-request-page .view-switch-btn {

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 6px;

            min-height: 36px;

            padding: 7px 11px;

            border: 0;

            border-radius: 7px;

            background: transparent;

            color: var(--request-muted);

            font-size: 0.76rem;
            font-weight: 600;

            cursor: pointer;

            transition:
                background 0.2s ease,
                color 0.2s ease,
                transform 0.2s ease;
        }


        .thesis-request-page .view-switch-btn i {
            font-size: 0.82rem;
        }


        .thesis-request-page .view-switch-btn:hover {

            background: var(--dashboard-purple-light);

            color: var(--dashboard-purple);

        }


        .thesis-request-page .view-switch-btn.active {

            background: var(--dashboard-purple);

            color: #ffffff;

            box-shadow:
                0 4px 10px rgba(101, 56, 217, 0.20);
        }


        .thesis-request-page .view-switch-btn.active:hover {

            background: var(--dashboard-purple-dark);

            color: #ffffff;
        }


        /* =========================================================
       CREATE BUTTON
    ========================================================= */

        .thesis-request-page .create-request-btn,
        .thesis-request-page .empty-create-btn {

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            border: 0;

            background: var(--dashboard-purple);

            color: #ffffff;

            text-decoration: none;

            font-weight: 600;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }


        .thesis-request-page .create-request-btn {

            min-height: 44px;

            padding: 10px 17px;

            border-radius: 9px;

            font-size: 0.88rem;

            white-space: nowrap;
        }


        .thesis-request-page .create-request-btn:hover,
        .thesis-request-page .empty-create-btn:hover {

            background: var(--dashboard-purple-dark);

            color: #ffffff;

            transform: translateY(-1px);

            box-shadow:
                0 7px 18px rgba(101, 56, 217, 0.25);
        }


        .thesis-request-page .create-request-btn:active,
        .thesis-request-page .empty-create-btn:active {

            transform: translateY(0);
        }


        /* =========================================================
       ALERTS
    ========================================================= */

        .thesis-request-page .custom-alert {

            display: flex;
            align-items: center;

            gap: 9px;

            border-radius: 10px;

            padding: 13px 16px;

            margin-bottom: 20px;

            font-size: 0.86rem;
        }


        .thesis-request-page .custom-alert .btn-close {
            margin-left: auto;
        }


        .thesis-request-page .alert-success {

            background: #e6f7ed;

            border: 1px solid #c9ead7;

            color: #188650;
        }


        .thesis-request-page .alert-success .bi {
            color: #20955b;
        }


        .thesis-request-page .alert-danger {

            background: #ffe9e9;

            border: 1px solid #f5cccc;

            color: #d83232;
        }


        .thesis-request-page .alert-danger .bi {
            color: #e24242;
        }


        /* =========================================================
       PERMISSION CARD
    ========================================================= */

        .thesis-request-page .permission-card {

            width: 100%;

            overflow: hidden;

            background: var(--request-card);

            border: 1px solid var(--request-border);

            border-radius: var(--request-radius);

            box-shadow: var(--request-shadow);
        }


        .thesis-request-page .permission-card-body {
            padding: 36px;
        }


        /* =========================================================
       PERMISSION HEADER
    ========================================================= */

        .thesis-request-page .permission-header {
            text-align: center;
        }


        .thesis-request-page .permission-icon {

            width: 68px;
            height: 68px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin: 0 auto 18px;

            border-radius: 50%;

            background: #fff0d8;

            color: #ed8c16;

            font-size: 1.65rem;
        }


        .thesis-request-page .permission-header h3 {

            margin: 0 0 8px;

            color: var(--request-text);

            font-size: 1.3rem;

            font-weight: 700;
        }


        .thesis-request-page .permission-header p {

            max-width: 650px;

            margin: 0 auto;

            color: var(--request-muted);

            font-size: 0.9rem;

            line-height: 1.6;
        }


        .thesis-request-page .permission-divider {

            height: 1px;

            margin: 28px 0;

            background: var(--request-border);
        }


        /* =========================================================
       INFORMATION
    ========================================================= */

        .thesis-request-page .information-section {
            margin-bottom: 30px;
        }


        .thesis-request-page .information-section:last-child {
            margin-bottom: 0;
        }


        .thesis-request-page .information-section h4,
        .thesis-request-page .permission-information h4 {

            margin: 0 0 10px;

            color: var(--request-text);

            font-size: 1.02rem;

            font-weight: 700;
        }


        .thesis-request-page .information-section p,
        .thesis-request-page .permission-information p {

            margin: 0 0 10px;

            color: var(--request-muted);

            font-size: 0.88rem;

            line-height: 1.75;
        }


        .thesis-request-page .information-section strong,
        .thesis-request-page .permission-information strong {

            color: var(--request-text);
        }


        /* =========================================================
       PERMISSION INFORMATION
    ========================================================= */

        .thesis-request-page .permission-information {

            padding: 22px;

            margin-bottom: 30px;

            background: #faf8ff;

            border: 1px solid #ece6fc;

            border-radius: 11px;
        }


        .thesis-request-page .information-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 13px;

            margin: 18px 0;
        }


        .thesis-request-page .information-item {

            display: flex;

            align-items: flex-start;

            gap: 12px;

            min-width: 0;

            padding: 15px;

            background: var(--request-card);

            border: 1px solid var(--request-border);

            border-radius: 10px;

            transition:
                border-color 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }


        .thesis-request-page .information-item:hover {

            border-color: #dcd0ff;

            transform: translateY(-1px);

            box-shadow:
                0 5px 15px rgba(101, 56, 217, 0.07);
        }


        .thesis-request-page .information-item-icon {

            flex: 0 0 36px;

            width: 36px;
            height: 36px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: #e9ddff;

            color: #6435d5;
        }


        .thesis-request-page .information-item div:last-child {
            min-width: 0;
        }


        .thesis-request-page .information-item strong {

            display: block;

            margin-bottom: 4px;

            font-size: 0.84rem;
        }


        .thesis-request-page .information-item small {

            display: block;

            color: var(--request-muted);

            font-size: 0.74rem;

            line-height: 1.5;
        }


        .thesis-request-page .permission-note {
            margin-bottom: 0 !important;
        }


        /* =========================================================
       PROCESS
    ========================================================= */

        .thesis-request-page .process-step {

            display: flex;

            align-items: flex-start;

            gap: 13px;

            margin-bottom: 18px;
        }


        .thesis-request-page .process-step:last-child {
            margin-bottom: 0;
        }


        .thesis-request-page .step-number {

            flex: 0 0 31px;

            width: 31px;
            height: 31px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: var(--dashboard-purple);

            color: #ffffff;

            font-size: 0.78rem;

            font-weight: 700;

            box-shadow:
                0 4px 10px rgba(101, 56, 217, 0.18);
        }


        .thesis-request-page .step-content {
            min-width: 0;
        }


        .thesis-request-page .step-content strong {

            display: block;

            margin-bottom: 3px;

            color: var(--request-text);

            font-size: 0.88rem;
        }


        .thesis-request-page .step-content p {

            margin: 0;

            color: var(--request-muted);

            font-size: 0.8rem;

            line-height: 1.6;
        }


        /* =========================================================
       REJECTION
    ========================================================= */

        .thesis-request-page .rejection-notice {

            display: flex;

            align-items: flex-start;

            gap: 13px;

            padding: 16px;

            background: #ffe9e9;

            border: 1px solid #f5cccc;

            border-radius: 10px;

            color: #d83232;
        }


        .thesis-request-page .rejection-icon {

            flex: 0 0 auto;

            color: #e24242;

            font-size: 1.2rem;
        }


        .thesis-request-page .rejection-notice strong {

            display: block;

            margin-bottom: 4px;

            color: #c92d2d;

            font-size: 0.86rem;
        }


        .thesis-request-page .rejection-notice p {

            margin: 0;

            color: #b83333;

            font-size: 0.78rem;

            line-height: 1.6;
        }


        /* =========================================================
       CARD REQUEST LIST
    ========================================================= */

        .thesis-request-page .request-list {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 18px;

            width: 100%;
        }


        /* =========================================================
       REQUEST CARD
    ========================================================= */

        .thesis-request-page .request-card {

            display: flex;

            flex-direction: column;

            min-width: 0;

            overflow: hidden;

            background: var(--request-card);

            border: 1px solid var(--request-border);

            border-radius: var(--request-radius);

            box-shadow: var(--request-shadow);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
        }


        .thesis-request-page .request-card:hover {

            transform: translateY(-3px);

            box-shadow: var(--request-shadow-hover);

            border-color: #ddd8ed;
        }


        /* =========================================================
       REQUEST HEADER
    ========================================================= */

        .thesis-request-page .request-card-header {

            display: flex;

            align-items: flex-start;

            gap: 12px;

            min-height: 94px;

            padding: 16px;

            background: var(--request-card);

            border-bottom: 1px solid var(--request-border);
        }


        .thesis-request-page .request-number {

            flex: 0 0 38px;

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background:
                linear-gradient(135deg,
                    #7040df,
                    #6234d4);

            color: #ffffff;

            font-size: 0.8rem;

            font-weight: 700;

            box-shadow:
                0 5px 12px rgba(101, 56, 217, 0.18);
        }


        .thesis-request-page .request-title-wrapper {

            flex: 1;

            min-width: 0;
        }


        .thesis-request-page .request-title {

            margin: 0;

            display: -webkit-box;

            overflow: hidden;

            -webkit-box-orient: vertical;

            -webkit-line-clamp: 2;

            overflow-wrap: anywhere;

            color: var(--request-text);

            font-size: 0.94rem;

            font-weight: 700;

            line-height: 1.4;
        }


        .thesis-request-page .request-author {

            display: flex;

            align-items: center;

            gap: 5px;

            margin: 6px 0 0;

            overflow: hidden;

            color: var(--request-muted);

            font-size: 0.76rem;

            line-height: 1.4;

            white-space: nowrap;

            text-overflow: ellipsis;
        }


        .thesis-request-page .request-author i {

            flex: 0 0 auto;

            color: #6435d5;
        }


        .thesis-request-page .request-status {
            flex: 0 0 auto;
        }


        /* =========================================================
       STATUS
    ========================================================= */

        .thesis-request-page .status-badge {

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 4px;

            white-space: nowrap;

            padding: 5px 8px;

            border: 1px solid transparent;

            border-radius: 20px;

            font-size: 0.67rem;

            font-weight: 600;
        }


        .thesis-request-page .status-pending {

            background: #eee8ff;

            border-color: #dfd4ff;

            color: #6435d5;
        }


        .thesis-request-page .status-approved {

            background: #e6f7ed;

            border-color: #ccebd9;

            color: #188650;
        }


        .thesis-request-page .status-rejected {

            background: #ffe9e9;

            border-color: #f5cccc;

            color: #d83232;
        }


        /* =========================================================
       REQUEST BODY
    ========================================================= */

        .thesis-request-page .request-card-body {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 10px;

            padding: 14px 16px;

            background: #fafafe;

            border-bottom: 1px solid var(--request-border);

            flex: 1;
        }


        .thesis-request-page .request-info {

            display: flex;

            flex-direction: column;

            gap: 4px;

            min-width: 0;
        }


        .thesis-request-page .request-info-label {

            color: var(--request-muted);

            font-size: 0.63rem;

            font-weight: 600;

            text-transform: uppercase;

            letter-spacing: 0.04em;
        }


        .thesis-request-page .request-info strong {

            display: block;

            overflow: hidden;

            color: var(--request-text);

            font-size: 0.76rem;

            font-weight: 600;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================================================
       REQUEST FOOTER
    ========================================================= */

        .thesis-request-page .request-card-footer {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

            padding: 11px 16px;

            background: var(--request-card);
        }


        .thesis-request-page .request-id {

            display: inline-flex;

            align-items: center;

            gap: 4px;

            color: var(--request-muted);

            font-size: 0.68rem;

            white-space: nowrap;
        }


        .thesis-request-page .request-id i {
            color: var(--dashboard-purple);
        }


        .thesis-request-page .request-actions {

            display: flex;

            align-items: center;

            gap: 6px;
        }


        /* =========================================================
       ACTION BUTTONS
    ========================================================= */

        .thesis-request-page .action-btn {

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 5px;

            padding: 7px 10px;

            border: 0;

            border-radius: 7px;

            text-decoration: none;

            font-size: 0.69rem;

            font-weight: 600;

            white-space: nowrap;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }


        .thesis-request-page .action-view {

            background: var(--dashboard-purple);

            color: #ffffff;
        }


        .thesis-request-page .action-view:hover {

            background: var(--dashboard-purple-dark);

            color: #ffffff;

            transform: translateY(-1px);

            box-shadow:
                0 5px 13px rgba(101, 56, 217, 0.2);
        }


        .thesis-request-page .action-pdf {

            background: #e24444;

            color: #ffffff;
        }


        .thesis-request-page .action-pdf:hover {

            background: #d83232;

            color: #ffffff;

            transform: translateY(-1px);

            box-shadow:
                0 5px 13px rgba(226, 68, 68, 0.2);
        }


        /* =========================================================
       TABLE VIEW
    ========================================================= */

        .thesis-request-page .request-table-wrapper {

            display: none;

            width: 100%;

            overflow: hidden;

            background: var(--request-card);

            border: 1px solid var(--request-border);

            border-radius: var(--request-radius);

            box-shadow: var(--request-shadow);
        }


        .thesis-request-page .request-table-scroll {

            width: 100%;

            overflow-x: auto;

            scrollbar-width: thin;
        }


        .thesis-request-page .request-table {

            width: 100%;

            min-width: 1050px;

            margin: 0;

            border-collapse: separate;

            border-spacing: 0;

            background: var(--request-card);

            color: var(--request-text);
        }


        .thesis-request-page .request-table thead th {

            padding: 13px 14px;

            background: #faf8ff;

            border-bottom: 1px solid var(--request-border);

            color: var(--request-muted);

            font-size: 0.67rem;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 0.035em;

            text-align: left;

            white-space: nowrap;
        }


        .thesis-request-page .request-table tbody td {

            padding: 13px 14px;

            border-bottom: 1px solid var(--request-border);

            vertical-align: middle;

            font-size: 0.76rem;
        }


        .thesis-request-page .request-table tbody tr:last-child td {
            border-bottom: 0;
        }


        .thesis-request-page .request-table tbody tr {

            transition:
                background 0.15s ease;
        }


        .thesis-request-page .request-table tbody tr:hover {

            background: #faf9ff;
        }


        .thesis-request-page .request-table .table-number {

            width: 58px;

            text-align: center;
        }


        .thesis-request-page .table-number-badge {

            display: inline-flex;

            align-items: center;
            justify-content: center;

            width: 30px;
            height: 30px;

            border-radius: 8px;

            background: #eee8ff;

            color: var(--dashboard-purple);

            font-size: 0.72rem;

            font-weight: 700;
        }


        .thesis-request-page .request-table .table-title {

            width: 24%;

            min-width: 230px;
        }


        .thesis-request-page .table-title-content {

            min-width: 0;

            max-width: 330px;
        }


        .thesis-request-page .table-title-content strong {

            display: -webkit-box;

            overflow: hidden;

            color: var(--request-text);

            font-size: 0.78rem;

            font-weight: 700;

            line-height: 1.45;

            -webkit-box-orient: vertical;

            -webkit-line-clamp: 2;
        }


        .thesis-request-page .table-author {

            display: flex;

            align-items: center;

            gap: 6px;

            min-width: 130px;

            color: var(--request-muted);

            white-space: nowrap;
        }


        .thesis-request-page .table-author i {

            flex: 0 0 auto;

            color: var(--dashboard-purple);

        }


        .thesis-request-page .table-text {

            display: block;

            max-width: 160px;

            overflow: hidden;

            color: var(--request-text);

            font-size: 0.75rem;

            font-weight: 600;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        .thesis-request-page .table-date {

            color: var(--request-muted);

            font-weight: 500;

        }


        .thesis-request-page .request-table .table-action {

            min-width: 205px;

            text-align: right;

            white-space: nowrap;
        }


        .thesis-request-page .table-actions {

            display: inline-flex;

            align-items: center;

            justify-content: flex-end;

            gap: 6px;

            white-space: nowrap;
        }


        /* =========================================================
       EMPTY STATE
    ========================================================= */

        .thesis-request-page .empty-request-state {

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            min-height: 340px;

            padding: 40px 20px;

            text-align: center;

            background: var(--request-card);

            border: 1px dashed var(--request-border);

            border-radius: var(--request-radius);

            box-shadow: var(--request-shadow);
        }


        .thesis-request-page .empty-request-icon {

            width: 70px;
            height: 70px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin-bottom: 17px;

            border-radius: 50%;

            background: #f0ebff;

            color: #6435d5;

            font-size: 1.7rem;
        }


        .thesis-request-page .empty-request-state h3 {

            margin: 0 0 7px;

            color: var(--request-text);

            font-size: 1.04rem;

            font-weight: 700;
        }


        .thesis-request-page .empty-request-state p {

            margin: 0 0 17px;

            color: var(--request-muted);

            font-size: 0.84rem;
        }


        .thesis-request-page .empty-create-btn {

            padding: 9px 15px;

            border-radius: 9px;

            font-size: 0.81rem;
        }


        /* =========================================================
       DARK MODE
    ========================================================= */

        [data-bs-theme="dark"] .thesis-request-page {

            --request-bg: #101426;

            --request-card: #181d33;

            --request-border: #292e45;

            --request-text: #f4f4fa;

            --request-muted: #999fb9;

            --request-shadow:
                0 5px 22px rgba(0, 0, 0, 0.22);

            --request-shadow-hover:
                0 10px 30px rgba(0, 0, 0, 0.32);

            color: var(--request-text);
        }


        [data-bs-theme="dark"] .thesis-request-page .permission-card,
        [data-bs-theme="dark"] .thesis-request-page .request-card,
        [data-bs-theme="dark"] .thesis-request-page .request-table-wrapper,
        [data-bs-theme="dark"] .thesis-request-page .empty-request-state {

            background: #181d33;

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .thesis-request-page .view-switch {

            background: #181d33;

            border-color: #343a52;
        }


        [data-bs-theme="dark"] .thesis-request-page .view-switch-btn:hover {

            background: #25203f;

            color: #a58be9;
        }


        [data-bs-theme="dark"] .thesis-request-page .view-switch-btn.active {

            background: var(--dashboard-purple);

            color: #ffffff;
        }


        [data-bs-theme="dark"] .thesis-request-page .page-title,
        [data-bs-theme="dark"] .thesis-request-page .permission-header h3,
        [data-bs-theme="dark"] .thesis-request-page .information-section h4,
        [data-bs-theme="dark"] .thesis-request-page .permission-information h4,
        [data-bs-theme="dark"] .thesis-request-page .information-section strong,
        [data-bs-theme="dark"] .thesis-request-page .permission-information strong,
        [data-bs-theme="dark"] .thesis-request-page .information-item strong,
        [data-bs-theme="dark"] .thesis-request-page .request-title,
        [data-bs-theme="dark"] .thesis-request-page .request-info strong,
        [data-bs-theme="dark"] .thesis-request-page .empty-request-state h3,
        [data-bs-theme="dark"] .thesis-request-page .table-title-content strong,
        [data-bs-theme="dark"] .thesis-request-page .table-text {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .thesis-request-page .page-subtitle,
        [data-bs-theme="dark"] .thesis-request-page .permission-header p,
        [data-bs-theme="dark"] .thesis-request-page .information-section p,
        [data-bs-theme="dark"] .thesis-request-page .permission-information p,
        [data-bs-theme="dark"] .thesis-request-page .information-item small,
        [data-bs-theme="dark"] .thesis-request-page .step-content p,
        [data-bs-theme="dark"] .thesis-request-page .request-author,
        [data-bs-theme="dark"] .thesis-request-page .request-info-label,
        [data-bs-theme="dark"] .thesis-request-page .request-id,
        [data-bs-theme="dark"] .thesis-request-page .empty-request-state p,
        [data-bs-theme="dark"] .thesis-request-page .table-author,
        [data-bs-theme="dark"] .thesis-request-page .table-date,
        [data-bs-theme="dark"] .thesis-request-page .request-table thead th {

            color: #999fb9;
        }


        [data-bs-theme="dark"] .thesis-request-page .request-card-header,
        [data-bs-theme="dark"] .thesis-request-page .request-card-footer {

            background: #181d33;

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .thesis-request-page .request-card-body {

            background: #20253a;

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .thesis-request-page .request-table {

            background: #181d33;

            color: #f4f4fa;
        }


        [data-bs-theme="dark"] .thesis-request-page .request-table thead th {

            background: #20253a;

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .thesis-request-page .request-table tbody td {

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .thesis-request-page .request-table tbody tr:hover {

            background: #20253a;
        }


        [data-bs-theme="dark"] .thesis-request-page .table-number-badge {

            background: #25203f;

            color: #a58be9;
        }


        [data-bs-theme="dark"] .thesis-request-page .permission-information {

            background: #20253a;

            border-color: #343a52;
        }


        [data-bs-theme="dark"] .thesis-request-page .information-item {

            background: #181d33;

            border-color: #343a52;
        }


        [data-bs-theme="dark"] .thesis-request-page .information-item:hover {

            border-color: #4d3a8e;
        }


        [data-bs-theme="dark"] .thesis-request-page .empty-request-icon {

            background: #25203f;

            color: #8c6ce8;
        }


        [data-bs-theme="dark"] .thesis-request-page .permission-icon {

            background: #3a2d19;

            color: #f0a23a;
        }


        [data-bs-theme="dark"] .thesis-request-page .status-pending {

            background: #25203f;

            border-color: #453775;

            color: #a58be9;
        }


        [data-bs-theme="dark"] .thesis-request-page .status-approved {

            background: #19382a;

            border-color: #285b43;

            color: #61c990;
        }


        [data-bs-theme="dark"] .thesis-request-page .status-rejected {

            background: #3d2024;

            border-color: #65343a;

            color: #f08080;
        }


        [data-bs-theme="dark"] .thesis-request-page .rejection-notice {

            background: #3d2024;

            border-color: #65343a;

            color: #f08080;
        }


        [data-bs-theme="dark"] .thesis-request-page .rejection-icon {

            color: #f08080;
        }


        [data-bs-theme="dark"] .thesis-request-page .rejection-notice strong,
        [data-bs-theme="dark"] .thesis-request-page .rejection-notice p {

            color: #f08080;
        }


        /* =========================================================
       DESKTOP TABLE BUTTONS
    ========================================================= */

        @media (min-width: 993px) {

            .thesis-request-page .request-table-wrapper {
                display: none;
            }

        }


        /* =========================================================
       LARGE DESKTOP
    ========================================================= */

        @media (min-width: 1400px) {

            .thesis-request-page .request-list {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 20px;
            }

        }


        /* =========================================================
       TABLET
    ========================================================= */

        @media (max-width: 992px) {

            .thesis-request-page .information-grid {

                grid-template-columns: 1fr;
            }


            .thesis-request-page .request-list {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 15px;
            }


            .thesis-request-page .request-card-header {

                min-height: 90px;
            }


            .thesis-request-page .request-card-body {

                grid-template-columns:
                    1fr 1fr;
            }


            .thesis-request-page .request-info:last-child {

                grid-column: 1 / -1;
            }

        }


        /* =========================================================
       MOBILE TABLET
    ========================================================= */

        @media (max-width: 768px) {

            .thesis-request-page .page-title {

                font-size: 1.45rem;
            }


            .thesis-request-page .page-subtitle {

                font-size: 0.84rem;
            }


            .thesis-request-page .permission-card-body {

                padding: 28px 22px;
            }


            .thesis-request-page .request-list {

                grid-template-columns: 1fr;

                gap: 14px;
            }


            .thesis-request-page .request-card-body {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }


            .thesis-request-page .request-info:last-child {

                grid-column: auto;
            }

        }


        /* =========================================================
       MOBILE
       
       IMPORTANT:
       Mobile shows CARD ONLY.
       Table and view buttons are hidden.
    ========================================================= */

        @media (max-width: 767px) {

            .thesis-request-page .view-switch {
                display: none !important;
            }


            .thesis-request-page .request-table-wrapper {
                display: none !important;
            }


            .thesis-request-page .request-list {
                display: grid !important;
            }

        }


        /* =========================================================
       MOBILE
    ========================================================= */

        @media (max-width: 576px) {

            .thesis-request-page .container-fluid {

                padding-left: 12px !important;

                padding-right: 12px !important;
            }


            .thesis-request-page .page-header {

                align-items: flex-start;

                gap: 12px;

                margin-bottom: 18px !important;
            }


            .thesis-request-page .page-header-actions {

                gap: 7px;
            }


            .thesis-request-page .page-title {

                font-size: 1.22rem;
            }


            .thesis-request-page .page-title i {

                margin-right: 4px !important;
            }


            .thesis-request-page .page-subtitle {

                margin-top: 4px;

                font-size: 0.77rem;
            }


            .thesis-request-page .create-request-btn {

                min-height: 40px;

                padding: 8px 11px;

                border-radius: 8px;

                font-size: 0.74rem;
            }


            .thesis-request-page .create-request-btn i {

                font-size: 0.83rem;
            }


            /* PERMISSION */

            .thesis-request-page .permission-card {

                border-radius: 12px;
            }


            .thesis-request-page .permission-card-body {

                padding: 22px 15px;
            }


            .thesis-request-page .permission-icon {

                width: 58px;
                height: 58px;

                margin-bottom: 15px;

                font-size: 1.4rem;
            }


            .thesis-request-page .permission-header h3 {

                font-size: 1.05rem;
            }


            .thesis-request-page .permission-header p {

                font-size: 0.79rem;
            }


            .thesis-request-page .permission-divider {

                margin: 22px 0;
            }


            .thesis-request-page .information-section h4,
            .thesis-request-page .permission-information h4 {

                font-size: 0.94rem;
            }


            .thesis-request-page .information-section p,
            .thesis-request-page .permission-information p {

                font-size: 0.79rem;

                line-height: 1.65;
            }


            .thesis-request-page .permission-information {

                padding: 15px;
            }


            .thesis-request-page .information-item {

                padding: 12px;
            }


            .thesis-request-page .information-item-icon {

                flex-basis: 34px;

                width: 34px;
                height: 34px;
            }


            .thesis-request-page .rejection-notice {

                padding: 13px;
            }


            /* REQUEST CARD */

            .thesis-request-page .request-card {

                border-radius: 11px;
            }


            .thesis-request-page .request-card-header {

                min-height: auto;

                padding: 14px;

                gap: 9px;
            }


            .thesis-request-page .request-number {

                flex-basis: 34px;

                width: 34px;
                height: 34px;

                border-radius: 8px;

                font-size: 0.72rem;
            }


            .thesis-request-page .request-title {

                font-size: 0.87rem;
            }


            .thesis-request-page .request-author {

                font-size: 0.7rem;
            }


            .thesis-request-page .status-badge {

                padding: 5px 7px;

                font-size: 0.61rem;
            }


            .thesis-request-page .request-card-body {

                grid-template-columns: 1fr;

                gap: 10px;

                padding: 13px 14px;
            }


            .thesis-request-page .request-info:last-child {

                grid-column: auto;
            }


            .thesis-request-page .request-info-label {

                font-size: 0.62rem;
            }


            .thesis-request-page .request-info strong {

                font-size: 0.76rem;
            }


            .thesis-request-page .request-card-footer {

                flex-direction: column;

                align-items: stretch;

                padding: 12px 14px;

                gap: 9px;
            }


            .thesis-request-page .request-id {

                font-size: 0.67rem;
            }


            .thesis-request-page .request-actions {

                width: 100%;
            }


            .thesis-request-page .action-btn {

                flex: 1;

                padding: 8px 7px;

                font-size: 0.69rem;
            }


            /* EMPTY */

            .thesis-request-page .empty-request-state {

                min-height: 300px;

                padding: 30px 15px;

                border-radius: 12px;
            }


            .thesis-request-page .empty-request-icon {

                width: 60px;
                height: 60px;

                font-size: 1.45rem;
            }

        }


        /* =========================================================
       VERY SMALL MOBILE
    ========================================================= */

        @media (max-width: 380px) {

            .thesis-request-page .page-header {

                flex-direction: column;

                gap: 10px;
            }


            .thesis-request-page .page-header-actions {

                width: 100%;
            }


            .thesis-request-page .create-request-btn {

                width: 100%;
            }


            .thesis-request-page .request-card-header {

                flex-wrap: wrap;
            }


            .thesis-request-page .request-status {

                margin-left: 43px;
            }


            .thesis-request-page .request-actions {

                flex-direction: column;
            }


            .thesis-request-page .action-btn {

                width: 100%;
            }

        }


        /* =========================================================
       REDUCE MOTION
    ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            .thesis-request-page *,
            .thesis-request-page *::before,
            .thesis-request-page *::after {

                transition: none !important;
            }

        }
    </style>


    {{-- =============================================================
     CARD / TABLE VIEW JAVASCRIPT
============================================================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const cardView = document.getElementById('cardView');
            const tableView = document.getElementById('tableView');

            const cardViewBtn = document.getElementById('cardViewBtn');
            const tableViewBtn = document.getElementById('tableViewBtn');

            if (!cardView || !tableView || !cardViewBtn || !tableViewBtn) {
                return;
            }


            /*
             * =========================================================
             * VIEW CHANGE FUNCTION
             * =========================================================
             */
            function setRequestView(view, savePreference = true) {

                /*
                 * MOBILE:
                 * Always force CARD view.
                 */
                if (window.innerWidth <= 767) {

                    view = 'card';
                }


                if (view === 'table') {

                    cardView.style.display = 'none';

                    tableView.style.display = 'block';

                    cardViewBtn.classList.remove('active');

                    tableViewBtn.classList.add('active');

                } else {

                    cardView.style.display = 'grid';

                    tableView.style.display = 'none';

                    cardViewBtn.classList.add('active');

                    tableViewBtn.classList.remove('active');
                }


                /*
                 * Save selected view.
                 */
                if (savePreference && window.innerWidth > 767) {

                    localStorage.setItem(
                        'thesisRequestView',
                        view
                    );
                }

            }


            /*
             * =========================================================
             * CARD BUTTON
             * =========================================================
             */
            cardViewBtn.addEventListener('click', function() {

                setRequestView('card');

            });


            /*
             * =========================================================
             * TABLE BUTTON
             * =========================================================
             */
            tableViewBtn.addEventListener('click', function() {

                setRequestView('table');

            });


            /*
             * =========================================================
             * LOAD SAVED VIEW
             * =========================================================
             */
            const savedView =
                localStorage.getItem('thesisRequestView') || 'card';


            if (window.innerWidth <= 767) {

                setRequestView('card', false);

            } else {

                setRequestView(savedView, false);

            }


            /*
             * =========================================================
             * RESPONSIVE RESIZE
             * =========================================================
             */
            let lastMobileState =
                window.innerWidth <= 767;


            window.addEventListener('resize', function() {

                const isMobile =
                    window.innerWidth <= 767;


                /*
                 * Only react when crossing the mobile breakpoint.
                 */
                if (isMobile !== lastMobileState) {

                    if (isMobile) {

                        setRequestView('card', false);

                    } else {

                        const saved =
                            localStorage.getItem('thesisRequestView') || 'card';

                        setRequestView(saved, false);

                    }


                    lastMobileState = isMobile;
                }

            });

        });
    </script>

</x-app-layout>
