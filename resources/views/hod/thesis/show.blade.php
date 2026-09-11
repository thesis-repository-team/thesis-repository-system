<x-app-layout>

    <div class="dashboard-content thesis-show-page">

        {{-- =========================================================
            ALERTS
        ========================================================== --}}

        @if (session('success'))

            <div class="thesis-alert thesis-alert-success">

                <i class="bi bi-check-circle-fill"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        @if (session('error'))

            <div class="thesis-alert thesis-alert-danger">

                <i class="bi bi-exclamation-triangle-fill"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        @endif


        {{-- =========================================================
            CHECK THESIS
            ONLY ADMIN OR HOD APPROVED THESIS IS ALLOWED
        ========================================================== --}}

        @php

            $isApprovedThesis =
                $thesis &&
                !is_null($thesis->published_at) &&
                in_array(
                    strtolower($thesis->publishedBy?->role ?? ''),
                    ['admin', 'hod'],
                    true
                );

        @endphp


        {{-- =========================================================
            APPROVED THESIS
        ========================================================== --}}

        @if ($isApprovedThesis)

            {{-- =====================================================
                MAIN CARD
            ====================================================== --}}

            <div class="thesis-show-card">


                {{-- =================================================
                    HEADER
                ================================================== --}}

                <div class="thesis-show-header">

                    <div class="thesis-show-header-content">

                        {{-- OVERLINE --}}

                        <span class="thesis-show-overline">
                            THESIS #{{ $thesis->id }}
                        </span>


                        {{-- TITLE --}}

                        <div class="thesis-show-title-row">

                            <div class="thesis-show-title-icon">

                                <i class="bi bi-journal-text"></i>

                            </div>


                            <h1 class="thesis-show-title">
                                {{ $thesis->title }}
                            </h1>

                        </div>


                        <p class="thesis-show-subtitle">
                            Approved thesis available in the Digital Thesis Repository.
                        </p>

                    </div>


                    {{-- =================================================
                        STATUS
                    ================================================== --}}

                    <div class="thesis-show-status-wrapper">

                        <span class="thesis-show-status status-approved">

                            <i class="bi bi-check-circle-fill"></i>

                            Approved

                        </span>

                    </div>

                </div>


                {{-- =================================================
                    THESIS INFORMATION
                ================================================== --}}

                <div class="thesis-show-content-section">

                    <div class="thesis-section-heading">

                        <div class="thesis-section-heading-icon">

                            <i class="bi bi-info-circle-fill"></i>

                        </div>

                        <div>

                            <h2>
                                Thesis Information
                            </h2>

                            <p>
                                General information about this approved thesis.
                            </p>

                        </div>

                    </div>


                    <div class="thesis-information-form">


                        {{-- =================================================
                            TITLE
                        ================================================== --}}

                        <div class="thesis-form-group">

                            <span class="thesis-form-label">
                                Title
                            </span>

                            <div class="thesis-form-control">
                                {{ $thesis->title ?? 'N/A' }}
                            </div>

                        </div>


                        {{-- =================================================
                            AUTHOR
                        ================================================== --}}

                        <div class="thesis-form-group">

                            <span class="thesis-form-label">
                                Author
                            </span>

                            <div class="thesis-form-control">
                                {{ $thesis->author_name ?? 'N/A' }}
                            </div>

                        </div>


                        {{-- =================================================
                            DEPARTMENT
                        ================================================== --}}

                        <div class="thesis-form-group">

                            <span class="thesis-form-label">
                                Department
                            </span>

                            <div class="thesis-form-control">
                                {{ $thesis->department?->name ?? 'N/A' }}
                            </div>

                        </div>


                        {{-- =================================================
                            ACADEMIC YEAR
                        ================================================== --}}

                        <div class="thesis-form-group">

                            <span class="thesis-form-label">
                                Academic Year
                            </span>

                            <div class="thesis-form-control">
                                {{ $thesis->academic_year ?? 'N/A' }}
                            </div>

                        </div>


                        {{-- =================================================
                            SUBMITTED BY
                        ================================================== --}}

                        <div class="thesis-form-group">

                            <span class="thesis-form-label">
                                Submitted By
                            </span>

                            <div class="thesis-form-control">

                                {{ $thesis->submittedBy?->name
                                    ?? $thesis->submittedBy?->username
                                    ?? $thesis->author_name
                                    ?? 'N/A'
                                }}

                            </div>

                        </div>


                        {{-- =================================================
                            SUBMITTED AT
                        ================================================== --}}

                        <div class="thesis-form-group">

                            <span class="thesis-form-label">
                                Submitted At
                            </span>

                            <div class="thesis-form-control">

                                {{ $thesis->created_at
                                    ? \Carbon\Carbon::parse($thesis->created_at)->format('d M Y, h:i A')
                                    : 'N/A'
                                }}

                            </div>

                        </div>


                        {{-- =================================================
                            PUBLISHED BY
                        ================================================== --}}

                        <div class="thesis-form-group">

                            <span class="thesis-form-label">
                                Published By
                            </span>

                            <div class="thesis-form-control">

                                {{ $thesis->publishedBy?->name
                                    ?? $thesis->publishedBy?->username
                                    ?? 'N/A'
                                }}

                            </div>

                        </div>


                        {{-- =================================================
                            APPROVED BY
                        ================================================== --}}

                        <div class="thesis-form-group">

                            <span class="thesis-form-label">
                                Approved By
                            </span>

                            <div class="thesis-form-control">

                                @if ($thesis->publishedBy?->role === 'admin')

                                    <span class="publisher-role publisher-admin">

                                        <i class="bi bi-shield-check"></i>

                                        Admin

                                    </span>

                                @elseif ($thesis->publishedBy?->role === 'hod')

                                    <span class="publisher-role publisher-hod">

                                        <i class="bi bi-person-check-fill"></i>

                                        Head of Department

                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- =================================================
                            PUBLISHED AT
                        ================================================== --}}

                        <div class="thesis-form-group">

                            <span class="thesis-form-label">
                                Published At
                            </span>

                            <div class="thesis-form-control">

                                {{ $thesis->published_at
                                    ? \Carbon\Carbon::parse($thesis->published_at)->format('d M Y, h:i A')
                                    : 'N/A'
                                }}

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    ABSTRACT
                ================================================== --}}

                <div class="thesis-show-content-section">

                    <div class="thesis-section-heading">

                        <div class="thesis-section-heading-icon">

                            <i class="bi bi-file-text-fill"></i>

                        </div>

                        <div>

                            <h2>
                                Abstract
                            </h2>

                            <p>
                                Abstract of the approved thesis.
                            </p>

                        </div>

                    </div>


                    <div class="thesis-text-content">

                        {{ $thesis->abstract ?? 'No abstract provided.' }}

                    </div>

                </div>


                {{-- =================================================
                    DESCRIPTION
                ================================================== --}}

                <div class="thesis-show-content-section">

                    <div class="thesis-section-heading">

                        <div class="thesis-section-heading-icon">

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


                    <div class="thesis-text-content">

                        {{ $thesis->description ?? 'No description provided.' }}

                    </div>

                </div>


                {{-- =================================================
                    THESIS DOCUMENT
                ================================================== --}}

                <div class="thesis-show-content-section">

                    <div class="thesis-section-heading">

                        <div class="thesis-section-heading-icon thesis-document-icon">

                            <i class="bi bi-file-earmark-pdf-fill"></i>

                        </div>

                        <div>

                            <h2>
                                Thesis Document
                            </h2>

                            <p>
                                Official approved thesis document.
                            </p>

                        </div>

                    </div>


                    <div class="thesis-document-box">


                        {{-- =================================================
                            DOCUMENT INFORMATION
                        ================================================== --}}

                        <div class="thesis-document-left">

                            <div class="thesis-document-file-icon">

                                <i class="bi bi-file-earmark-pdf-fill"></i>

                            </div>


                            <div class="thesis-document-details">

                                <strong>
                                    Approved Thesis PDF
                                </strong>

                                <span>
                                    Official thesis document approved by
                                    {{ $thesis->publishedBy?->role === 'admin'
                                        ? 'Admin'
                                        : 'Head of Department'
                                    }}
                                </span>

                            </div>

                        </div>


                        {{-- =================================================
                            DOCUMENT ACTIONS
                        ================================================== --}}

                        <div class="thesis-document-actions">


                            {{-- =================================================
                                VIEW PDF
                            ================================================== --}}

                            <a
                                href="{{ route('hod.thesis.view-pdf', $thesis->id) }}"
                                target="_blank"
                                class="thesis-view-pdf-button"
                            >

                                <i class="bi bi-eye-fill"></i>

                                View PDF

                            </a>


                            {{-- =================================================
                                DOWNLOAD PDF
                            ================================================== --}}

                            <a
                                href="{{ route('hod.thesis.download', $thesis->id) }}"
                                class="thesis-download-pdf-button"
                            >

                                <i class="bi bi-download"></i>

                                Download PDF

                            </a>

                        </div>

                    </div>

                </div>
            </div>


        @else

            {{-- =====================================================
                NOT APPROVED / NOT FOUND
            ====================================================== --}}

            <div class="thesis-empty-state">

                <div class="thesis-empty-icon">

                    <i class="bi bi-journal-x"></i>

                </div>


                <h2>
                    Thesis Not Available
                </h2>


                <p>
                    This thesis has not been approved by an Admin or Head of Department,
                    or the thesis could not be found.
                </p>

            </div>

        @endif

    </div>


    <style>

        /* =========================================================
           PAGE VARIABLES
        ========================================================== */

        .thesis-show-page {

            --thesis-black: #111111;
            --thesis-text: #222222;
            --thesis-muted: #777777;

            --thesis-card: #ffffff;
            --thesis-soft: #f8f8f8;
            --thesis-soft-purple: #f0ebff;

            --thesis-purple: #6538d9;
            --thesis-purple-hover: #5630bd;

            --thesis-blue: #2563eb;
            --thesis-blue-hover: #1d4ed8;

            --thesis-green: #198754;
            --thesis-green-hover: #157347;

            --thesis-red: #dc3545;
            --thesis-red-hover: #bb2d3b;

            --thesis-border: #eeeeee;

            --thesis-shadow:
                0 4px 18px rgba(35, 20, 65, .07);

            color: var(--thesis-text);

            box-sizing: border-box;
        }


        .thesis-show-page *,
        .thesis-show-page *::before,
        .thesis-show-page *::after {

            box-sizing: border-box;
        }


        /* =========================================================
           ALERTS
        ========================================================== */

        .thesis-alert {

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


        .thesis-alert-success {

            color: #176b3a;

            background: #eefaf3;
        }


        .thesis-alert-danger {

            color: #b42318;

            background: #fff1f1;
        }


        /* =========================================================
           MAIN CARD
        ========================================================== */

        .thesis-show-card {

            width: 100%;

            padding: 22px;

            background: var(--thesis-card);

            border: none !important;

            border-radius: 14px;

            box-shadow: var(--thesis-shadow);

            transition:
                background-color .25s ease,
                box-shadow .25s ease;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .thesis-show-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 25px;

            padding-bottom: 18px;

            border-bottom: 1px solid var(--thesis-border);
        }


        .thesis-show-header-content {

            min-width: 0;

            flex: 1;
        }


        .thesis-show-overline {

            display: block;

            margin-bottom: 6px;

            color: var(--thesis-purple);

            font-size: .61rem;

            font-weight: 800;

            letter-spacing: .13em;

            text-transform: uppercase;
        }


        .thesis-show-title-row {

            display: flex;

            align-items: center;

            gap: 9px;

            min-width: 0;
        }


        .thesis-show-title-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 34px;

            height: 34px;

            flex-shrink: 0;

            color: var(--thesis-purple);

            background: var(--thesis-soft-purple);

            border-radius: 8px;

            font-size: .9rem;
        }


        .thesis-show-title {

            margin: 0;

            min-width: 0;

            color: var(--thesis-black);

            font-size: 1.4rem;

            font-weight: 800;

            line-height: 1.35;

            letter-spacing: -.025em;

            overflow-wrap: anywhere;
        }


        .thesis-show-subtitle {

            margin: 7px 0 0 43px;

            color: var(--thesis-muted);

            font-size: .63rem;

            line-height: 1.5;
        }


        /* =========================================================
           STATUS
        ========================================================== */

        .thesis-show-status-wrapper {

            flex-shrink: 0;

            padding-top: 13px;
        }


        .thesis-show-status {

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

            color: var(--thesis-green);

            background: #eaf7ef;
        }


        /* =========================================================
           CONTENT SECTIONS
        ========================================================== */

        .thesis-show-content-section {

            margin-bottom: 25px;

            padding-bottom: 23px;

            border-bottom: 1px solid var(--thesis-border);
        }


        .thesis-show-content-section:last-of-type {

            margin-bottom: 0;

            padding-bottom: 0;

            border-bottom: none;
        }


        /* =========================================================
           SECTION HEADING
        ========================================================== */

        .thesis-section-heading {

            display: flex;

            align-items: center;

            gap: 9px;

            margin-bottom: 13px;
        }


        .thesis-section-heading-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 32px;

            height: 32px;

            flex-shrink: 0;

            color: var(--thesis-purple);

            background: var(--thesis-soft-purple);

            border-radius: 8px;

            font-size: .75rem;
        }


        .thesis-document-icon {

            color: var(--thesis-red);

            background: #fff0f1;
        }


        .thesis-section-heading h2 {

            margin: 0;

            color: var(--thesis-black);

            font-size: .83rem;

            font-weight: 800;
        }


        .thesis-section-heading p {

            margin: 2px 0 0;

            color: var(--thesis-muted);

            font-size: .62rem;
        }


        /* =========================================================
           INFORMATION GRID
        ========================================================== */

        .thesis-information-form {

            display: grid;

            grid-template-columns: 1.2fr 1fr;

            gap: 12px 28px;

            width: 100%;
        }


        .thesis-form-group {

            display: grid;

            grid-template-columns: 105px minmax(0, 1fr);

            align-items: center;

            gap: 10px;

            width: 100%;

            min-width: 0;
        }


        .thesis-form-label {

            display: block;

            color: var(--thesis-text);

            font-size: .63rem;

            font-weight: 800;

            letter-spacing: .04em;

            text-transform: uppercase;

            white-space: nowrap;
        }


        .thesis-form-control {

            display: flex;

            align-items: center;

            width: 90%;

            min-height: 42px;

            padding: .55rem .75rem;

            color: var(--thesis-text);

            background: var(--thesis-soft);

            border: none !important;

            border-radius: 8px;

            font-family: inherit;

            font-size: .69rem;

            font-weight: 600;

            line-height: 1.45;

            overflow-wrap: anywhere;

            transition: background-color .2s ease;
        }


        .thesis-form-control:hover {

            background: #f3f3f3;
        }


        /* =========================================================
           PUBLISHER ROLE
        ========================================================== */

        .publisher-role {

            display: inline-flex;

            align-items: center;

            gap: 5px;

            font-size: .65rem;

            font-weight: 700;
        }


        .publisher-admin {

            color: var(--thesis-purple);
        }


        .publisher-hod {

            color: var(--thesis-green);
        }


        /* =========================================================
           TEXT CONTENT
        ========================================================== */

        .thesis-text-content {

            padding: 12px;

            color: #555555;

            background: var(--thesis-soft);

            border: none !important;

            border-radius: 9px;

            font-size: .7rem;

            line-height: 1.7;

            white-space: pre-line;

            text-align: justify;

            overflow-wrap: anywhere;
        }


        /* =========================================================
           DOCUMENT
        ========================================================== */

        .thesis-document-box {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding: 11px 12px;

            background: var(--thesis-soft);

            border: none !important;

            border-radius: 9px;
        }


        .thesis-document-left {

            display: flex;

            align-items: center;

            gap: 10px;

            min-width: 0;

            flex: 1;
        }


        .thesis-document-file-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 36px;

            height: 36px;

            flex-shrink: 0;

            color: var(--thesis-red);

            background: #fff0f1;

            border-radius: 8px;

            font-size: .85rem;
        }


        .thesis-document-details {

            display: flex;

            flex-direction: column;

            gap: 2px;

            min-width: 0;
        }


        .thesis-document-details strong {

            color: var(--thesis-text);

            font-size: .7rem;

            font-weight: 700;
        }


        .thesis-document-details span {

            color: var(--thesis-muted);

            font-size: .59rem;
        }


        /* =========================================================
           DOCUMENT ACTIONS
        ========================================================== */

        .thesis-document-actions {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 8px;

            flex-shrink: 0;
        }


        /* =========================================================
           VIEW PDF - BLUE
        ========================================================== */

        .thesis-view-pdf-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 5px;

            min-height: 36px;

            padding: 7px 12px;

            color: var(--thesis-blue) !important;

            background: transparent;

            border: 1px solid var(--thesis-blue) !important;

            border-radius: 7px;

            text-decoration: none;

            font-size: .61rem;

            font-weight: 700;

            white-space: nowrap;

            transition:
                color .2s ease,
                background-color .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }


        .thesis-view-pdf-button:hover {

            color: #ffffff !important;

            background: var(--thesis-blue);

            border-color: var(--thesis-blue) !important;

            transform: translateY(-1px);
        }


        /* =========================================================
           DOWNLOAD PDF - GREEN
        ========================================================== */

        .thesis-download-pdf-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 5px;

            min-height: 36px;

            padding: 7px 12px;

            color: var(--thesis-green) !important;

            background: transparent;

            border: 1px solid var(--thesis-green) !important;

            border-radius: 7px;

            text-decoration: none;

            font-size: .61rem;

            font-weight: 700;

            white-space: nowrap;

            transition:
                color .2s ease,
                background-color .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }


        .thesis-download-pdf-button:hover {

            color: #ffffff !important;

            background: var(--thesis-green);

            border-color: var(--thesis-green) !important;

            transform: translateY(-1px);
        }


        /* =========================================================
           FOOTER ACTIONS
        ========================================================== */

        .thesis-footer-actions {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

            margin-top: 22px;

            padding-top: 18px;

            border-top: 1px solid var(--thesis-border);
        }


        /* =========================================================
           BACK BUTTON
        ========================================================== */

        .thesis-back-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            min-height: 36px;

            padding: 8px 13px;

            color: var(--thesis-text) !important;

            background: transparent;

            border: 1px solid #cccccc !important;

            border-radius: 7px;

            text-decoration: none;

            font-size: .61rem;

            font-weight: 700;

            white-space: nowrap;

            transition: .2s ease;
        }


        .thesis-back-button:hover {

            color: var(--thesis-purple) !important;

            border-color: var(--thesis-purple) !important;

            background: var(--thesis-soft-purple);

            transform: translateY(-1px);
        }


        /* =========================================================
           FOOTER PDF BUTTON
        ========================================================== */

        .thesis-footer-pdf-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            min-height: 36px;

            padding: 8px 13px;

            color: var(--thesis-blue) !important;

            background: transparent;

            border: 1px solid var(--thesis-blue) !important;

            border-radius: 7px;

            text-decoration: none;

            font-size: .61rem;

            font-weight: 700;

            white-space: nowrap;

            transition: .2s ease;
        }


        .thesis-footer-pdf-button:hover {

            color: #ffffff !important;

            background: var(--thesis-blue);

            border-color: var(--thesis-blue) !important;

            transform: translateY(-1px);
        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .thesis-empty-state {

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            min-height: 320px;

            padding: 30px;

            background: var(--thesis-card);

            border-radius: 14px;

            box-shadow: var(--thesis-shadow);

            text-align: center;
        }


        .thesis-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 54px;

            height: 54px;

            margin-bottom: 12px;

            color: #ffffff;

            background: var(--thesis-purple);

            border-radius: 11px;

            font-size: 1.2rem;
        }


        .thesis-empty-state h2 {

            margin: 0 0 5px;

            color: var(--thesis-black);

            font-size: .95rem;

            font-weight: 800;
        }


        .thesis-empty-state p {

            max-width: 500px;

            margin: 0 0 15px;

            color: var(--thesis-muted);

            font-size: .68rem;

            line-height: 1.6;
        }


        .thesis-empty-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            min-height: 36px;

            padding: 8px 13px;

            color: var(--thesis-purple) !important;

            background: transparent;

            border: 1px solid var(--thesis-purple) !important;

            border-radius: 7px;

            text-decoration: none;

            font-size: .61rem;

            font-weight: 700;

            transition: .2s ease;
        }


        .thesis-empty-button:hover {

            color: #ffffff !important;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple) !important;
        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] .thesis-show-page {

            --thesis-black: #ffffff;

            --thesis-text: #eeeef8;

            --thesis-muted: #999fb9;

            --thesis-card: #181d33;

            --thesis-soft: #20253a;

            --thesis-soft-purple: #292342;

            --thesis-purple: #7c5ce3;

            --thesis-purple-hover: #9278ea;

            --thesis-blue: #60a5fa;

            --thesis-blue-hover: #3b82f6;

            --thesis-green: #2fbf71;

            --thesis-green-hover: #25a761;

            --thesis-red: #ff6470;

            --thesis-red-hover: #ff4d5b;

            --thesis-border: #292e45;

            --thesis-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

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
           DARK CARD
        ========================================================== */

        [data-bs-theme="dark"] .thesis-show-card {

            background: #181d33;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .35);
        }


        /* =========================================================
           DARK HEADER
        ========================================================== */

        [data-bs-theme="dark"] .thesis-show-header {

            margin: -22px -22px 25px;

            padding: 18px 22px;

            background: #171b30;

            border-bottom-color: #292e45;

            border-radius: 14px 14px 0 0;
        }


        [data-bs-theme="dark"] .thesis-show-overline {

            color: #7c5ce3;
        }


        [data-bs-theme="dark"] .thesis-show-title-icon {

            color: #7c5ce3;

            background: #292342;
        }


        [data-bs-theme="dark"] .thesis-show-title {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .thesis-show-subtitle {

            color: #999fb9;
        }


        /* =========================================================
           DARK SECTIONS
        ========================================================== */

        [data-bs-theme="dark"] .thesis-show-content-section {

            border-bottom-color: #292e45;
        }


        [data-bs-theme="dark"] .thesis-section-heading-icon {

            color: #7c5ce3;

            background: #292342;
        }


        [data-bs-theme="dark"] .thesis-document-icon {

            color: #ff6470;

            background: #3a2028;
        }


        [data-bs-theme="dark"] .thesis-section-heading h2 {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .thesis-section-heading p {

            color: #999fb9;
        }


        /* =========================================================
           DARK STATUS
        ========================================================== */

        [data-bs-theme="dark"] .status-approved {

            color: #9de2bb;

            background: #19352a;
        }


        /* =========================================================
           DARK INFORMATION
        ========================================================== */

        [data-bs-theme="dark"] .thesis-form-label {

            color: #d5d8e8;
        }


        [data-bs-theme="dark"] .thesis-form-control {

            color: #ffffff;

            background: #20253a;
        }


        [data-bs-theme="dark"] .thesis-form-control:hover {

            background: #252b42;
        }


        [data-bs-theme="dark"] .publisher-admin {

            color: #b39aff;
        }


        [data-bs-theme="dark"] .publisher-hod {

            color: #6ee7a5;
        }


        /* =========================================================
           DARK TEXT
        ========================================================== */

        [data-bs-theme="dark"] .thesis-text-content {

            color: #d5d8e8;

            background: #20253a;
        }


        /* =========================================================
           DARK DOCUMENT
        ========================================================== */

        [data-bs-theme="dark"] .thesis-document-box {

            background: #20253a;
        }


        [data-bs-theme="dark"] .thesis-document-file-icon {

            color: #ff9da5;

            background: #3a2028;
        }


        [data-bs-theme="dark"] .thesis-document-details strong {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .thesis-document-details span {

            color: #999fb9;
        }


        /* =========================================================
           DARK VIEW PDF
        ========================================================== */

        [data-bs-theme="dark"] .thesis-view-pdf-button {

            color: #60a5fa !important;

            background: transparent;

            border-color: #60a5fa !important;
        }


        [data-bs-theme="dark"] .thesis-view-pdf-button:hover {

            color: #ffffff !important;

            background: #3b82f6;

            border-color: #3b82f6 !important;
        }


        /* =========================================================
           DARK DOWNLOAD
        ========================================================== */

        [data-bs-theme="dark"] .thesis-download-pdf-button {

            color: #2fbf71 !important;

            background: transparent;

            border-color: #2fbf71 !important;
        }


        [data-bs-theme="dark"] .thesis-download-pdf-button:hover {

            color: #ffffff !important;

            background: #25a761;

            border-color: #25a761 !important;
        }


        /* =========================================================
           DARK FOOTER
        ========================================================== */

        [data-bs-theme="dark"] .thesis-footer-actions {

            border-top-color: #292e45;
        }


        [data-bs-theme="dark"] .thesis-back-button {

            color: #d5d8e8 !important;

            border-color: #41475f !important;
        }


        [data-bs-theme="dark"] .thesis-back-button:hover {

            color: #b39aff !important;

            background: #292342;

            border-color: #7c5ce3 !important;
        }


        [data-bs-theme="dark"] .thesis-footer-pdf-button {

            color: #60a5fa !important;

            border-color: #60a5fa !important;
        }


        [data-bs-theme="dark"] .thesis-footer-pdf-button:hover {

            color: #ffffff !important;

            background: #3b82f6;

            border-color: #3b82f6 !important;
        }


        /* =========================================================
           DARK ALERTS
        ========================================================== */

        [data-bs-theme="dark"] .thesis-alert-success {

            color: #9de2bb;

            background: #19352a;
        }


        [data-bs-theme="dark"] .thesis-alert-danger {

            color: #ffb4b4;

            background: #3a2028;
        }


        /* =========================================================
           DARK EMPTY
        ========================================================== */

        [data-bs-theme="dark"] .thesis-empty-state {

            background: #181d33;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .35);
        }


        [data-bs-theme="dark"] .thesis-empty-icon {

            color: #ffffff;

            background: #7c5ce3;
        }


        [data-bs-theme="dark"] .thesis-empty-state h2 {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .thesis-empty-state p {

            color: #999fb9;
        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 900px) {

            .thesis-information-form {

                grid-template-columns: 1fr;

                gap: 12px;
            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .thesis-show-card {

                padding: 17px;
            }


            [data-bs-theme="dark"] .thesis-show-header {

                margin: -17px -17px 20px;

                padding: 16px 17px;

                border-radius: 14px 14px 0 0;
            }


            .thesis-show-header {

                flex-direction: column;

                gap: 12px;

                margin-bottom: 20px;
            }


            .thesis-show-status-wrapper {

                padding-top: 0;
            }


            .thesis-show-title {

                font-size: 1.2rem;
            }


            .thesis-show-subtitle {

                margin-left: 43px;
            }


            .thesis-form-group {

                grid-template-columns: 105px minmax(0, 1fr);

                gap: 9px;
            }


            .thesis-form-control {

                width: 100%;
            }


            /* =====================================================
               MOBILE DOCUMENT
            ====================================================== */

            .thesis-document-box {

                align-items: flex-start;

                flex-direction: column;
            }


            .thesis-document-actions {

                display: grid;

                grid-template-columns: 1fr 1fr;

                width: 100%;

                gap: 8px;
            }


            .thesis-view-pdf-button,
            .thesis-download-pdf-button {

                width: 100%;
            }


            /* =====================================================
               MOBILE FOOTER
            ====================================================== */

            .thesis-footer-actions {

                align-items: stretch;

                flex-direction: column;
            }


            .thesis-back-button,
            .thesis-footer-pdf-button {

                width: 100%;
            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 480px) {

            .thesis-show-card {

                padding: 14px;

                border-radius: 11px;
            }


            [data-bs-theme="dark"] .thesis-show-header {

                margin: -14px -14px 20px;

                padding: 14px;

                border-radius: 11px 11px 0 0;
            }


            .thesis-show-title-row {

                align-items: center;

                gap: 7px;
            }


            .thesis-show-title-icon {

                width: 30px;

                height: 30px;

                font-size: .78rem;
            }


            .thesis-show-title {

                font-size: 1.05rem;
            }


            .thesis-show-subtitle {

                margin-left: 37px;

                font-size: .57rem;
            }


            .thesis-section-heading {

                gap: 7px;

                margin-bottom: 10px;
            }


            .thesis-section-heading-icon {

                width: 29px;

                height: 29px;

                font-size: .67rem;
            }


            .thesis-section-heading h2 {

                font-size: .76rem;
            }


            .thesis-section-heading p {

                font-size: .56rem;
            }


            .thesis-show-content-section {

                margin-bottom: 20px;

                padding-bottom: 18px;
            }


            .thesis-information-form {

                gap: 10px;
            }


            .thesis-form-group {

                grid-template-columns: 90px minmax(0, 1fr);

                gap: 8px;
            }


            .thesis-form-label {

                font-size: .59rem;

                letter-spacing: .025em;
            }


            .thesis-form-control {

                min-height: 40px;

                padding: .5rem .65rem;

                font-size: .63rem;
            }


            .thesis-text-content {

                padding: 9px;

                font-size: .65rem;

                line-height: 1.6;

                text-align: left;
            }


            .thesis-document-box {

                padding: 9px;
            }


            .thesis-document-file-icon {

                width: 33px;

                height: 33px;
            }


            .thesis-document-details strong {

                font-size: .66rem;
            }


            .thesis-document-details span {

                font-size: .56rem;
            }


            /* =====================================================
               SMALL MOBILE BUTTONS
            ====================================================== */

            .thesis-document-actions {

                grid-template-columns: 1fr 1fr;

                gap: 6px;
            }


            .thesis-view-pdf-button,
            .thesis-download-pdf-button {

                min-height: 34px;

                padding: 7px 8px;

                font-size: .57rem;
            }


            .thesis-footer-actions {

                gap: 7px;
            }


            .thesis-back-button,
            .thesis-footer-pdf-button {

                min-height: 34px;

                padding: 7px 9px;

                font-size: .58rem;
            }

        }


        /* =========================================================
           VERY SMALL SCREENS
        ========================================================== */

        @media (max-width: 360px) {

            .thesis-form-group {

                grid-template-columns: 80px minmax(0, 1fr);

                gap: 7px;
            }


            .thesis-form-label {

                font-size: .56rem;
            }


            .thesis-form-control {

                font-size: .6rem;

                padding-left: .55rem;

                padding-right: .55rem;
            }


            .thesis-document-actions {

                grid-template-columns: 1fr;
            }


            .thesis-view-pdf-button,
            .thesis-download-pdf-button {

                width: 100%;
            }

        }


        /* =========================================================
           REDUCED MOTION
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            .thesis-show-page *,
            .thesis-show-page *::before,
            .thesis-show-page *::after {

                transition: none !important;

                animation: none !important;
            }

        }

    </style>

</x-app-layout>