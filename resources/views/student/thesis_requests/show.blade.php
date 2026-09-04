<x-app-layout>

    {{-- =========================================================
    THESIS REQUEST SHOW PAGE
========================================================== --}}

    <style>
        /* =========================================================
       THESIS REQUEST MODAL
    ========================================================= */

        .thesis-request-page {

            --tr-bg: #f5f6f8;
            --tr-card: #ffffff;
            --tr-text: #171717;
            --tr-muted: #6b7280;
            --tr-border: #e5e7eb;
            --tr-input: #ffffff;

            --tr-primary: #2563eb;
            --tr-primary-hover: #1d4ed8;

            --tr-danger: #dc2626;
            --tr-success: #16a34a;

            --tr-shadow: 0 25px 80px rgba(0, 0, 0, 0.25);

            position: fixed;
            inset: 0;

            width: 100%;
            height: 100vh;

            margin: 0;
            padding: 30px 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow-y: auto;

            background: transparent;

            color: var(--tr-text);

            z-index: 9999;

            transition: color 0.3s ease;
        }


        /* =========================================================
       BLURRED BACKGROUND
    ========================================================= */

        .thesis-request-page::before {

            content: "";

            position: fixed;
            inset: 0;

            background: rgba(0, 0, 0, 0.38);

            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);

            z-index: -1;

            pointer-events: all;
        }


        /* =========================================================
       BODY SCROLL LOCK
    ========================================================= */

        body.thesis-modal-open {
            overflow: hidden !important;
        }


        /* =========================================================
       MAIN WRAPPER
    ========================================================= */

        .thesis-request-wrapper {

            position: relative;

            width: 100%;
            max-width: 900px;

            max-height: calc(100vh - 60px);

            margin: auto;

            overflow-y: auto;
            overflow-x: hidden;

            padding: 2px;

            z-index: 2;

            animation: thesisShowIn 0.28s ease-out;
        }


        @keyframes thesisShowIn {

            from {
                opacity: 0;
                transform: translateY(20px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }


        /* =========================================================
       CARD
    ========================================================= */

        .request-detail-card {

            position: relative;

            background: var(--tr-card);

            border: 1px solid var(--tr-border) !important;

            border-radius: 18px !important;

            overflow: hidden;

            box-shadow: var(--tr-shadow) !important;

            transition:
                background 0.3s ease,
                border-color 0.3s ease;
        }


        /* =========================================================
       HEADER
    ========================================================= */

        .request-show-header {

            position: relative;

            padding: 22px 28px;

            background: linear-gradient(135deg,
                    #6538d9,
                    #4f46e5);

            color: #ffffff;
        }


        .request-show-header-content {

            display: flex;

            align-items: center;

            gap: 14px;

            min-width: 0;
        }


        .request-show-header-icon {

            width: 45px;
            height: 45px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 12px;

            background: rgba(255, 255, 255, 0.16);

            font-size: 20px;
        }


        .request-show-header-text {

            min-width: 0;
        }


        .request-show-header h3 {

            margin: 0;

            font-size: 21px;

            font-weight: 700;

            line-height: 1.35;
        }


        .request-show-header p {

            margin: 4px 0 0;

            font-size: 13px;

            opacity: 0.9;
        }


        /* =========================================================
       STATUS IN HEADER
    ========================================================= */

        .request-show-status {

            margin-left: auto;

            flex-shrink: 0;
        }


        .request-show-status .badge {

            font-size: 12px;

            font-weight: 700;

            padding: 8px 13px !important;

            border-radius: 999px;
        }


        /* =========================================================
       BODY
    ========================================================= */

        .thesis-request-body {

            padding: 30px;
        }


        /* =========================================================
       ALERTS
    ========================================================= */

        .thesis-request-alert {

            margin-bottom: 24px;

            padding: 15px 18px;

            border: 1px solid #fecaca;

            border-radius: 10px;

            background: #fef2f2;

            color: #991b1b;
        }


        .thesis-alert {

            border-radius: 10px;

            margin-bottom: 20px;

            padding: 14px 18px;

            box-shadow: none;
        }


        /* =========================================================
       REQUEST TITLE SECTION
    ========================================================= */

        .request-title-section {

            display: flex;

            align-items: flex-start;

            gap: 14px;

            margin-bottom: 25px;
        }


        .request-title-icon {

            width: 52px;
            height: 52px;

            min-width: 52px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background: #eff6ff;

            color: #2563eb;

            font-size: 24px;
        }


        .request-title-content {

            min-width: 0;

            flex: 1;
        }


        .request-title {

            margin: 0 0 5px;

            color: var(--tr-text);

            font-size: 25px;

            font-weight: 700;

            line-height: 1.35;

            word-break: break-word;
        }


        .request-id {

            color: var(--tr-muted);

            font-size: 13px;
        }


        .request-id strong {

            color: var(--tr-text);
        }


        /* =========================================================
       SECTION DIVIDER
    ========================================================= */

        .section-divider {

            height: 1px;

            background: var(--tr-border);

            margin: 25px 0;
        }


        /* =========================================================
       INFORMATION GRID
    ========================================================= */

        .info-item {

            height: 100%;

            padding: 15px 17px;

            background: var(--tr-input);

            border: 1px solid var(--tr-border);

            border-radius: 12px;

            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }


        .info-item:hover {

            background: var(--tr-card);

            border-color: #cbd5e1;

            transform: translateY(-1px);
        }


        .info-label {

            display: flex;

            align-items: center;

            margin-bottom: 7px;

            color: var(--tr-muted);

            font-size: 12px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 0.04em;
        }


        .info-label i {

            font-size: 14px;
        }


        .info-value {

            color: var(--tr-text);

            font-size: 14px;

            font-weight: 600;

            line-height: 1.5;

            word-break: break-word;
        }


        /* =========================================================
       CONTENT SECTIONS
    ========================================================= */

        .content-section {

            margin-bottom: 25px;
        }


        .content-section-header {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 12px;
        }


        .content-section-icon {

            width: 34px;
            height: 34px;

            min-width: 34px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: #eff6ff;

            color: #2563eb;

            font-size: 15px;
        }


        .content-section-header h5 {

            color: var(--tr-text);

            font-size: 15px;
        }


        .text-content {

            padding: 18px;

            background: var(--tr-input);

            border: 1px solid var(--tr-border);

            border-radius: 12px;

            color: var(--tr-text);

            font-size: 14px;

            line-height: 1.8;

            text-align: justify;

            white-space: pre-line;

            word-break: break-word;
        }


        /* =========================================================
       PDF SECTION
    ========================================================= */

        .pdf-section {

            margin-top: 10px;

            margin-bottom: 25px;

            padding: 18px;

            background: var(--tr-input);

            border: 1px solid var(--tr-border);

            border-radius: 13px;
        }


        .pdf-icon {

            background: #fef2f2;

            color: #dc2626;
        }


        .pdf-action {

            margin-top: 15px;
        }


        .pdf-button {

            min-height: 44px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 10px 20px;

            border-radius: 9px;

            background: var(--tr-primary);

            border: 1px solid var(--tr-primary);

            color: #ffffff;

            font-size: 14px;

            font-weight: 600;

            text-decoration: none;

            transition: all 0.2s ease;
        }


        .pdf-button:hover {

            background: var(--tr-primary-hover);

            border-color: var(--tr-primary-hover);

            color: #ffffff;

            transform: translateY(-1px);

            box-shadow:
                0 6px 15px rgba(37, 99, 235, 0.20);
        }


        /* =========================================================
       REJECTION BOX
    ========================================================= */

        .rejection-box {

            margin-top: 10px;

            margin-bottom: 25px;

            padding: 18px 20px;

            border: 1px solid #fecaca !important;

            border-left: 5px solid #dc2626 !important;

            border-radius: 12px;

            background: #fef2f2;

            color: #374151;
        }


        .rejection-icon {

            width: 42px;
            height: 42px;

            min-width: 42px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: #fee2e2;

            color: #dc2626;

            font-size: 18px;
        }


        .rejection-box h5 {

            color: #dc2626 !important;

            font-size: 16px;
        }


        .rejection-box p {

            color: #374151;

            line-height: 1.6;

            font-size: 14px;
        }


        .rejection-text {

            white-space: pre-line;

            word-break: break-word;
        }


        /* =========================================================
       ACTION BUTTONS
    ========================================================= */

        .request-actions {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 10px;

            margin-top: 25px;

            padding-top: 20px;

            border-top: 1px solid var(--tr-border);
        }


        .request-actions .btn {

            min-height: 44px;

            padding: 10px 20px;

            border-radius: 9px;

            font-size: 14px;

            font-weight: 600;

            transition: all 0.2s ease;
        }


        .request-actions .btn:hover {

            transform: translateY(-1px);
        }


        .request-actions .btn-secondary {

            background: #f3f4f6;

            border: 1px solid #d1d5db;

            color: #374151;
        }


        .request-actions .btn-secondary:hover {

            background: #e5e7eb;

            border-color: #cbd5e1;

            color: #1f2937;
        }


        /* =========================================================
       EMPTY STATE
    ========================================================= */

        .empty-request-card {

            width: 100%;

            max-width: 600px;

            margin: auto;

            padding: 60px 30px;

            text-align: center;

            background: var(--tr-card);

            border: 1px solid var(--tr-border);

            border-radius: 18px;

            box-shadow: var(--tr-shadow);
        }


        .empty-icon {

            width: 70px;
            height: 70px;

            margin: 0 auto 18px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 18px;

            background: #f3f4f6;

            color: #6b7280;

            font-size: 32px;
        }


        .empty-request-card h5 {

            color: var(--tr-text);
        }


        .empty-request-card p {

            color: var(--tr-muted) !important;
        }


        /* =========================================================
       CUSTOM SCROLLBAR
    ========================================================= */

        .thesis-request-wrapper::-webkit-scrollbar {

            width: 7px;
        }


        .thesis-request-wrapper::-webkit-scrollbar-track {

            background: transparent;
        }


        .thesis-request-wrapper::-webkit-scrollbar-thumb {

            background: rgba(107, 114, 128, 0.45);

            border-radius: 20px;
        }


        .thesis-request-wrapper::-webkit-scrollbar-thumb:hover {

            background: rgba(75, 85, 99, 0.65);
        }


        /* =========================================================
       DARK MODE
    ========================================================= */

        [data-bs-theme="dark"] .thesis-request-page,
        .dark .thesis-request-page,
        body.dark .thesis-request-page,
        [data-theme="dark"] .thesis-request-page {

            --tr-bg: #101426;
            --tr-card: #181d33;
            --tr-text: #f3f4f6;
            --tr-muted: #999fb9;
            --tr-border: #292e45;
            --tr-input: #20253a;

            --tr-primary: #3b82f6;
            --tr-primary-hover: #2563eb;

            --tr-danger: #f87171;
            --tr-success: #4ade80;

            --tr-shadow: 0 25px 80px rgba(0, 0, 0, 0.55);
        }


        /* =========================================================
       DARK MODE OVERLAY
    ========================================================= */

        [data-bs-theme="dark"] .thesis-request-page::before,
        .dark .thesis-request-page::before,
        body.dark .thesis-request-page::before,
        [data-theme="dark"] .thesis-request-page::before {

            background: rgba(0, 0, 0, 0.55);
        }


        /* =========================================================
       DARK MODE HEADER
    ========================================================= */

        [data-bs-theme="dark"] .request-show-header,
        .dark .request-show-header,
        body.dark .request-show-header,
        [data-theme="dark"] .request-show-header {

            background: linear-gradient(135deg,
                    #5530b8,
                    #4338ca);
        }


        /* =========================================================
       DARK MODE TITLE
    ========================================================= */

        [data-bs-theme="dark"] .request-title-icon,
        .dark .request-title-icon,
        body.dark .request-title-icon,
        [data-theme="dark"] .request-title-icon {

            background: #252b43;

            color: #60a5fa;
        }


        /* =========================================================
       DARK MODE INFO
    ========================================================= */

        [data-bs-theme="dark"] .info-item,
        .dark .info-item,
        body.dark .info-item,
        [data-theme="dark"] .info-item {

            background: var(--tr-input);

            border-color: var(--tr-border);
        }


        [data-bs-theme="dark"] .info-item:hover,
        .dark .info-item:hover,
        body.dark .info-item:hover,
        [data-theme="dark"] .info-item:hover {

            background: var(--tr-card);

            border-color: #3b425c;
        }


        /* =========================================================
       DARK MODE CONTENT
    ========================================================= */

        [data-bs-theme="dark"] .content-section-icon,
        .dark .content-section-icon,
        body.dark .content-section-icon,
        [data-theme="dark"] .content-section-icon {

            background: #252b43;

            color: #60a5fa;
        }


        [data-bs-theme="dark"] .text-content,
        .dark .text-content,
        body.dark .text-content,
        [data-theme="dark"] .text-content {

            background: var(--tr-input);

            border-color: var(--tr-border);

            color: var(--tr-text);
        }


        /* =========================================================
       DARK MODE PDF
    ========================================================= */

        [data-bs-theme="dark"] .pdf-section,
        .dark .pdf-section,
        body.dark .pdf-section,
        [data-theme="dark"] .pdf-section {

            background: var(--tr-input);

            border-color: var(--tr-border);
        }


        [data-bs-theme="dark"] .pdf-icon,
        .dark .pdf-icon,
        body.dark .pdf-icon,
        [data-theme="dark"] .pdf-icon {

            background: #3a2528;

            color: #f87171;
        }


        /* =========================================================
       DARK MODE REJECTION
    ========================================================= */

        [data-bs-theme="dark"] .rejection-box,
        .dark .rejection-box,
        body.dark .rejection-box,
        [data-theme="dark"] .rejection-box {

            background: rgba(127, 29, 29, 0.20);

            border-color: rgba(248, 113, 113, 0.30) !important;

            border-left-color: #f87171 !important;
        }


        [data-bs-theme="dark"] .rejection-icon,
        .dark .rejection-icon,
        body.dark .rejection-icon,
        [data-theme="dark"] .rejection-icon {

            background: #3a2528;

            color: #f87171;
        }


        [data-bs-theme="dark"] .rejection-box p,
        .dark .rejection-box p,
        body.dark .rejection-box p,
        [data-theme="dark"] .rejection-box p {

            color: #d1d5db;
        }


        /* =========================================================
       DARK MODE ACTIONS
    ========================================================= */

        [data-bs-theme="dark"] .request-actions,
        .dark .request-actions,
        body.dark .request-actions,
        [data-theme="dark"] .request-actions {

            border-color: var(--tr-border);
        }


        [data-bs-theme="dark"] .request-actions .btn-secondary,
        .dark .request-actions .btn-secondary,
        body.dark .request-actions .btn-secondary,
        [data-theme="dark"] .request-actions .btn-secondary {

            background: #262a31;

            border-color: #3b4048;

            color: #f3f4f6;
        }


        [data-bs-theme="dark"] .request-actions .btn-secondary:hover,
        .dark .request-actions .btn-secondary:hover,
        body.dark .request-actions .btn-secondary:hover,
        [data-theme="dark"] .request-actions .btn-secondary:hover {

            background: #30353e;

            border-color: #464c57;

            color: #ffffff;
        }


        /* =========================================================
       DARK MODE EMPTY STATE
    ========================================================= */

        [data-bs-theme="dark"] .empty-request-card,
        .dark .empty-request-card,
        body.dark .empty-request-card,
        [data-theme="dark"] .empty-request-card {

            background: var(--tr-card);

            border-color: var(--tr-border);
        }


        [data-bs-theme="dark"] .empty-icon,
        .dark .empty-icon,
        body.dark .empty-icon,
        [data-theme="dark"] .empty-icon {

            background: #252b43;

            color: #9ca3af;
        }


        /* =========================================================
       TABLET
    ========================================================= */

        @media (max-width: 992px) {

            .thesis-request-page {

                padding: 25px 16px;
            }


            .thesis-request-wrapper {

                max-width: 850px;

                max-height: calc(100vh - 50px);
            }


            .thesis-request-body {

                padding: 26px;
            }


            .request-title {

                font-size: 22px;
            }
        }


        /* =========================================================
       MOBILE
    ========================================================= */

        @media (max-width: 768px) {

            .thesis-request-page {

                padding: 15px 10px;

                align-items: flex-start;

                padding-top: 20px;

                padding-bottom: 20px;
            }


            .thesis-request-wrapper {

                width: 100%;

                max-width: 100%;

                max-height: calc(100vh - 40px);
            }


            .request-detail-card {

                border-radius: 14px !important;
            }


            .request-show-header {

                padding: 18px 20px;
            }


            .request-show-header-content {

                align-items: flex-start;

                gap: 12px;
            }


            .request-show-header-icon {

                width: 42px;
                height: 42px;

                min-width: 42px;

                border-radius: 11px;

                font-size: 18px;
            }


            .request-show-header h3 {

                font-size: 18px;
            }


            .request-show-header p {

                font-size: 12px;

                line-height: 1.5;
            }


            .request-show-status {

                margin-left: 0;

                margin-top: 12px;
            }


            .request-show-header {

                display: block;
            }


            .request-show-header-content {

                width: 100%;
            }


            .request-show-status .badge {

                font-size: 11px;

                padding: 7px 11px !important;
            }


            .thesis-request-body {

                padding: 22px 18px;
            }


            .request-title-section {

                gap: 12px;

                margin-bottom: 20px;
            }


            .request-title-icon {

                width: 44px;
                height: 44px;

                min-width: 44px;

                border-radius: 11px;

                font-size: 19px;
            }


            .request-title {

                font-size: 19px;

                line-height: 1.4;
            }


            .request-id {

                font-size: 12px;
            }


            .section-divider {

                margin: 20px 0;
            }


            .info-item {

                padding: 13px 14px;
            }


            .info-label {

                font-size: 10px;
            }


            .info-value {

                font-size: 13px;
            }


            .content-section {

                margin-bottom: 22px;
            }


            .content-section-header {

                margin-bottom: 10px;
            }


            .content-section-icon {

                width: 31px;
                height: 31px;

                min-width: 31px;

                font-size: 13px;
            }


            .content-section-header h5 {

                font-size: 14px;
            }


            .text-content {

                padding: 14px;

                font-size: 13px;

                line-height: 1.7;

                text-align: left;
            }


            .pdf-section {

                padding: 15px;

                margin-bottom: 22px;
            }


            .pdf-button {

                width: 100%;

                min-height: 46px;
            }


            .rejection-box {

                padding: 15px;
            }


            .rejection-icon {

                width: 36px;
                height: 36px;

                min-width: 36px;

                font-size: 15px;
            }


            .rejection-box h5 {

                font-size: 14px;

                margin-bottom: 12px !important;
            }


            .rejection-box p {

                font-size: 13px;
            }


            .request-actions {

                flex-direction: column;

                align-items: stretch;

                justify-content: stretch;

                margin-top: 22px;

                padding-top: 18px;
            }


            .request-actions .btn {

                width: 100%;

                min-height: 46px;
            }


            .empty-request-card {

                padding: 50px 22px;

                border-radius: 14px;
            }
        }


        /* =========================================================
       SMALL MOBILE
    ========================================================= */

        @media (max-width: 480px) {

            .thesis-request-page {

                padding-left: 8px;

                padding-right: 8px;
            }


            .thesis-request-wrapper {

                max-height: calc(100vh - 16px);
            }


            .request-show-header {

                padding: 16px;
            }


            .request-show-header h3 {

                font-size: 17px;
            }


            .request-show-header p {

                font-size: 11px;
            }


            .thesis-request-body {

                padding: 18px 14px;
            }


            .request-title-section {

                gap: 10px;
            }


            .request-title-icon {

                width: 40px;
                height: 40px;

                min-width: 40px;

                border-radius: 10px;
            }


            .request-title {

                font-size: 17px;
            }


            .request-id {

                font-size: 11px;
            }


            .info-item {

                padding: 12px;
            }


            .info-label {

                font-size: 9.5px;
            }


            .info-value {

                font-size: 12.5px;
            }


            .text-content {

                padding: 12px;

                font-size: 12.5px;
            }


            .pdf-section {

                padding: 13px;
            }


            .rejection-box {

                padding: 13px;
            }


            .rejection-box p {

                font-size: 12.5px;
            }


            .request-actions .btn {

                font-size: 13px;
            }


            .empty-request-card {

                padding: 45px 18px;
            }
        }
    </style>


    {{-- =========================================================
     THESIS REQUEST MODAL
========================================================== --}}

    <div class="dashboard-content thesis-request-page">

        <div class="thesis-request-wrapper">

            @if (session('success'))
                <div class="alert alert-success thesis-alert">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}

                </div>
            @endif


            @if (session('error'))
                <div class="alert alert-danger thesis-alert">

                    <i class="bi bi-exclamation-circle-fill me-2"></i>

                    {{ session('error') }}

                </div>
            @endif


            @if ($thesisRequest)

                {{-- =================================================
                 MAIN CARD
            ================================================== --}}

                <div class="card border-0 request-detail-card">

                    {{-- =================================================
                     CREATE-PAGE STYLE HEADER
                ================================================== --}}

                    <div class="request-show-header">

                        <div class="request-show-header-content">

                            <div class="request-show-header-icon">

                                <i class="bi bi-file-earmark-text"></i>

                            </div>

                            <div class="request-show-header-text">

                                <h3>
                                    Thesis Upload Request
                                </h3>

                                <p>
                                    Review the thesis information and submitted PDF file.
                                </p>

                            </div>

                        </div>


                        {{-- Status --}}

                        <div class="request-show-status">

                            @if ($thesisRequest->status === 'approved')
                                <span class="badge bg-success">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Approved

                                </span>
                            @elseif ($thesisRequest->status === 'pending')
                                <span class="badge bg-warning text-dark">

                                    <i class="bi bi-clock me-1"></i>

                                    Pending

                                </span>
                            @else
                                <span class="badge bg-danger">

                                    <i class="bi bi-x-circle me-1"></i>

                                    Rejected

                                </span>
                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                     BODY
                ================================================== --}}

                    <div class="thesis-request-body">

                        {{-- =================================================
                         TITLE
                    ================================================== --}}

                        <div class="request-title-section">

                            <div class="request-title-icon">

                                <i class="bi bi-file-earmark-text"></i>

                            </div>

                            <div class="request-title-content">

                                <h2 class="request-title">

                                    {{ $thesisRequest->title }}

                                </h2>

                                <div class="request-id">

                                    Request ID:

                                    <strong>
                                        #{{ $thesisRequest->id }}
                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- Divider --}}

                        <div class="section-divider"></div>


                        {{-- =================================================
                         INFORMATION
                    ================================================== --}}

                        <div class="row g-3 g-md-4 mb-4">

                            {{-- Author --}}

                            <div class="col-md-6">

                                <div class="info-item">

                                    <div class="info-label">

                                        <i class="bi bi-person me-1"></i>

                                        Author(s) Name

                                    </div>

                                    <div class="info-value">

                                        {{ $thesisRequest->author_name }}

                                    </div>

                                </div>

                            </div>


                            {{-- Department --}}

                            <div class="col-md-6">

                                <div class="info-item">

                                    <div class="info-label">

                                        <i class="bi bi-building me-1"></i>

                                        Department

                                    </div>

                                    <div class="info-value">

                                        {{ $thesisRequest->department->name }}

                                    </div>

                                </div>

                            </div>


                            {{-- Submitted By --}}

                            <div class="col-md-6">

                                <div class="info-item">

                                    <div class="info-label">

                                        <i class="bi bi-person-check me-1"></i>

                                        Submitted By

                                    </div>

                                    <div class="info-value">

                                        {{ $thesisRequest->user->username }}

                                    </div>

                                </div>

                            </div>


                            {{-- Reviewed By --}}

                            <div class="col-md-6">

                                <div class="info-item">

                                    <div class="info-label">

                                        <i class="bi bi-person-badge me-1"></i>

                                        Reviewed By

                                    </div>

                                    <div class="info-value">

                                        {{ $thesisRequest->reviewer?->name ?? 'Not yet reviewed' }}

                                    </div>

                                </div>

                            </div>


                            {{-- Submitted At --}}

                            <div class="col-md-6">

                                <div class="info-item">

                                    <div class="info-label">

                                        <i class="bi bi-calendar-event me-1"></i>

                                        Submitted At

                                    </div>

                                    <div class="info-value">

                                        {{ $thesisRequest->submitted_at?->format('F d, Y h:i A') ?? 'Not available' }}

                                    </div>

                                </div>

                            </div>


                            {{-- Reviewed At --}}

                            <div class="col-md-6">

                                <div class="info-item">

                                    <div class="info-label">

                                        <i class="bi bi-calendar-check me-1"></i>

                                        Reviewed At

                                    </div>

                                    <div class="info-value">

                                        {{ $thesisRequest->reviewed_at?->format('F d, Y h:i A') ?? 'Not yet reviewed' }}

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                         ABSTRACT
                    ================================================== --}}

                        <div class="content-section">

                            <div class="content-section-header">

                                <div class="content-section-icon">

                                    <i class="bi bi-file-text"></i>

                                </div>

                                <h5 class="fw-bold m-0">

                                    Abstract

                                </h5>

                            </div>


                            <div class="text-content">

                                {{ $thesisRequest->abstract }}

                            </div>

                        </div>


                        {{-- =================================================
                         DESCRIPTION
                    ================================================== --}}

                        <div class="content-section">

                            <div class="content-section-header">

                                <div class="content-section-icon">

                                    <i class="bi bi-card-text"></i>

                                </div>

                                <h5 class="fw-bold m-0">

                                    Description

                                </h5>

                            </div>


                            <div class="text-content">

                                {{ $thesisRequest->description }}

                            </div>

                        </div>


                        {{-- =================================================
                         PDF
                    ================================================== --}}

                        <div class="pdf-section">

                            <div class="content-section-header">

                                <div class="content-section-icon pdf-icon">

                                    <i class="bi bi-file-earmark-pdf"></i>

                                </div>

                                <h5 class="fw-bold m-0">

                                    Thesis PDF

                                </h5>

                            </div>


                            <div class="pdf-action">

                                <a href="{{ route('student.thesis_requests.view-request-pdf', $thesisRequest) }}"
                                    target="_blank" class="pdf-button">

                                    <i class="bi bi-file-earmark-pdf me-2"></i>

                                    View PDF

                                </a>

                            </div>

                        </div>


                        {{-- =================================================
                         REJECTION REASON
                    ================================================== --}}

                        @if ($thesisRequest->status === 'rejected')
                            <div class="rejection-box">

                                <div class="d-flex align-items-start gap-3">

                                    <div class="rejection-icon">

                                        <i class="bi bi-exclamation-triangle-fill"></i>

                                    </div>


                                    <div class="flex-grow-1">

                                        <h5 class="fw-bold mb-3">

                                            Thesis Request Rejected

                                        </h5>


                                        <p class="mb-2">

                                            <strong>
                                                Rejected By:
                                            </strong>

                                            {{ $thesisRequest->reviewer?->name ?? 'Unknown' }}

                                        </p>


                                        <p class="mb-1">

                                            <strong>
                                                Rejection Reason:
                                            </strong>

                                        </p>


                                        <p class="mb-0 rejection-text">

                                            {{ $thesisRequest->remarks ?? 'No rejection reason provided.' }}

                                        </p>

                                    </div>

                                </div>

                            </div>
                        @endif


                        {{-- =================================================
                         ACTION BUTTON
                    ================================================== --}}

                        <div class="request-actions">

                            <a href="{{ route('student.thesis_requests.index') }}" class="btn btn-secondary">

                                <i class="bi bi-x-circle me-1"></i>

                                Cancel

                            </a>

                        </div>

                    </div>

                </div>
            @else
                {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

                <div class="empty-request-card">

                    <div class="empty-icon">

                        <i class="bi bi-file-earmark-x"></i>

                    </div>


                    <h5 class="fw-bold">

                        No requests found

                    </h5>


                    <p class="small mb-4">

                        There are currently no thesis upload requests.

                    </p>


                    <a href="{{ route('student.thesis_requests.index') }}" class="btn btn-secondary">

                        <i class="bi bi-arrow-left me-2"></i>

                        Back to Requests

                    </a>

                </div>

            @endif

        </div>

    </div>


    {{-- =========================================================
     PREVENT BACKGROUND SCROLL
========================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.body.classList.add('thesis-modal-open');

        });
    </script>

</x-app-layout>