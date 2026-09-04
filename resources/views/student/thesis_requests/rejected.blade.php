<x-app-layout>

    <style>
        /* =========================================================
       REJECTED THESIS / RESUBMIT PAGE
       Styled to match CREATE THESIS REQUEST
       Frontend only - Backend/Input names unchanged
    ========================================================= */

        .rejected-thesis-page {
            --tr-bg: #f5f6f8;
            --tr-card: #ffffff;
            --tr-text: #171717;
            --tr-muted: #6b7280;
            --tr-border: #e5e7eb;
            --tr-input: #ffffff;
            --tr-primary: #2563eb;
            --tr-primary-hover: #1d4ed8;
            --tr-purple: #6538d9;
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
            box-sizing: border-box;
        }


        /* =========================================================
       BLURRED BACKGROUND
    ========================================================= */

        .rejected-thesis-page::before {
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

        body.rejected-modal-open {
            overflow: hidden;
        }


        /* =========================================================
       MAIN WRAPPER
    ========================================================= */

        .rejected-thesis-wrapper {
            position: relative;
            width: 100%;
            max-width: 900px;
            margin: auto;
            z-index: 2;
        }


        /* =========================================================
       MAIN CARD
    ========================================================= */

        .rejected-thesis-card {
            position: relative;
            background: var(--tr-card);
            border: 1px solid var(--tr-border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: var(--tr-shadow);
            transition:
                background 0.3s ease,
                border-color 0.3s ease;
        }


        /* =========================================================
       HEADER
    ========================================================= */

        .rejected-thesis-header {
            position: relative;
            padding: 22px 28px;
            background: linear-gradient(135deg,
                    #6538d9,
                    #4f46e5);
            color: #ffffff;
        }

        .rejected-header-content {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .rejected-header-icon {
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

        .rejected-thesis-header h3 {
            margin: 0;
            color: #ffffff;
            font-size: 21px;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .rejected-thesis-header p {
            margin: 4px 0 0;
            color: #ffffff;
            font-size: 13px;
            opacity: 0.9;
        }


        /* =========================================================
       BODY
    ========================================================= */

        .rejected-thesis-body {
            padding: 30px;
        }


        /* =========================================================
       ALERTS
    ========================================================= */

        .rejected-alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 24px;
            padding: 15px 18px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.6;
        }

        .rejected-alert-icon {
            flex-shrink: 0;
            font-size: 17px;
        }

        .rejected-alert ul {
            margin: 4px 0 0;
            padding-left: 18px;
        }

        .rejected-alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .rejected-alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }


        /* =========================================================
       REJECTED MESSAGE
    ========================================================= */

        .rejected-message {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 24px;
            padding: 15px 18px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: #fef2f2;
            color: #991b1b;
        }

        .rejected-message-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            background: #fee2e2;
            color: #dc2626;
            font-size: 17px;
        }

        .rejected-message h3 {
            margin: 0 0 4px;
            color: #991b1b;
            font-size: 14px;
            font-weight: 700;
        }

        .rejected-message p {
            margin: 0;
            color: #7f1d1d;
            font-size: 12px;
            line-height: 1.6;
        }


        /* =========================================================
       FEEDBACK CARD
    ========================================================= */

        .rejected-feedback-card {
            margin-bottom: 24px;
            border: 1px solid var(--tr-border);
            border-radius: 12px;
            background: var(--tr-card);
            overflow: hidden;
        }

        .rejected-feedback-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            background: #f8f7ff;
            border-bottom: 1px solid #e9e7f5;
        }

        .rejected-section-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            background: #eee9ff;
            color: var(--tr-purple);
            font-size: 17px;
        }

        .rejected-feedback-header h4 {
            margin: 0;
            color: var(--tr-text);
            font-size: 15px;
            font-weight: 700;
        }

        .rejected-feedback-header p {
            margin: 3px 0 0;
            color: var(--tr-muted);
            font-size: 11px;
        }

        .rejected-feedback-body {
            padding: 20px;
        }

        .feedback-box {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 15px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-left: 4px solid #dc2626;
            border-radius: 10px;
        }

        .feedback-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 9px;
            background: #fee2e2;
            color: #dc2626;
            font-size: 16px;
        }

        .feedback-text {
            flex: 1;
            color: #4b5563;
            font-size: 13px;
            line-height: 1.8;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .no-feedback {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 14px;
            background: #f9fafb;
            border: 1px solid var(--tr-border);
            border-radius: 9px;
            color: var(--tr-muted);
            font-size: 12px;
        }

        .no-feedback i {
            color: var(--tr-purple);
            font-size: 16px;
        }


        /* =========================================================
       RESUBMIT SECTION
    ========================================================= */

        .resubmit-section {
            margin-bottom: 0;
        }

        .resubmit-section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
        }

        .resubmit-section-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            background: #eee9ff;
            color: var(--tr-purple);
            font-size: 17px;
        }

        .resubmit-section-header h4 {
            margin: 0;
            color: var(--tr-text);
            font-size: 16px;
            font-weight: 700;
        }

        .resubmit-section-header p {
            margin: 3px 0 0;
            color: var(--tr-muted);
            font-size: 11px;
        }


        /* =========================================================
       FORM GRID
    ========================================================= */

        .rejected-form-layout {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .rejected-form-group {
            min-width: 0;
            margin-bottom: 0;
        }

        .rejected-form-wide {
            grid-column: 1 / -1;
        }


        /* =========================================================
       FORM LABEL
    ========================================================= */

        .rejected-form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--tr-text);
            font-size: 14px;
            font-weight: 600;
        }

        .rejected-required {
            color: var(--tr-danger);
        }

        .optional-label {
            color: var(--tr-muted);
            font-size: 12px;
            font-weight: 400;
            margin-left: 3px;
        }


        /* =========================================================
       INPUT
    ========================================================= */

        .rejected-form-control {
            width: 100%;
            min-height: 46px;
            padding: 11px 14px;
            border: 1px solid var(--tr-border);
            border-radius: 10px;
            background: var(--tr-input);
            color: var(--tr-text);
            outline: none;
            font-family: inherit;
            font-size: 14px;
            box-sizing: border-box;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .rejected-form-control:hover {
            border-color: #cbd5e1;
        }

        .rejected-form-control:focus {
            border-color: var(--tr-primary);
            background: var(--tr-input);
            color: var(--tr-text);
            box-shadow:
                0 0 0 4px rgba(37, 99, 235, 0.12);
            outline: none;
        }

        .rejected-form-control::placeholder {
            color: #9ca3af;
        }


        /* =========================================================
       TEXTAREA
    ========================================================= */

        .rejected-textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.7;
        }


        /* =========================================================
       CURRENT PDF
    ========================================================= */

        .current-pdf-box {
            width: 100%;
            min-height: 46px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border: 1px solid var(--tr-border);
            border-radius: 10px;
            background: var(--tr-input);
            box-sizing: border-box;
        }

        .current-pdf-info {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 0;
        }

        .pdf-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            background: #fef2f2;
            color: #dc2626;
            font-size: 20px;
        }

        .pdf-details {
            min-width: 0;
        }

        .pdf-details strong {
            display: block;
            color: var(--tr-text);
            font-size: 13px;
            font-weight: 700;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .pdf-details span {
            display: block;
            margin-top: 3px;
            color: var(--tr-muted);
            font-size: 11px;
        }


        /* =========================================================
       VIEW PDF BUTTON
    ========================================================= */

        .view-pdf-button {
            min-height: 38px;
            padding: 0 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            flex-shrink: 0;
            border: 1px solid var(--tr-primary);
            border-radius: 8px;
            background: var(--tr-primary);
            color: #ffffff;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .view-pdf-button:hover {
            background: var(--tr-primary-hover);
            border-color: var(--tr-primary-hover);
            color: #ffffff;
            transform: translateY(-1px);
        }


        /* =========================================================
       NO PDF
    ========================================================= */

        .no-pdf-box {
            min-height: 46px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 11px 13px;
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 10px;
            color: #92400e;
            font-size: 12px;
            box-sizing: border-box;
        }


        /* =========================================================
       FILE INPUT
    ========================================================= */

        .rejected-file-input {
            padding: 7px 8px;
            cursor: pointer;
        }

        .rejected-file-input::file-selector-button {
            margin-right: 10px;
            padding: 8px 14px;
            border: 0;
            border-radius: 8px;
            background: #eff6ff;
            color: var(--tr-primary);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .rejected-file-input::file-selector-button:hover {
            background: #dbeafe;
        }


        /* =========================================================
       FILE HELP
    ========================================================= */

        .file-help {
            display: flex;
            align-items: flex-start;
            gap: 7px;
            margin-top: 7px;
            color: var(--tr-muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .file-help i {
            flex-shrink: 0;
            color: var(--tr-primary);
        }


        /* =========================================================
       FIELD ERROR
    ========================================================= */

        .field-error {
            display: flex;
            align-items: flex-start;
            gap: 5px;
            margin: 7px 0 0;
            color: var(--tr-danger);
            font-size: 11px;
            line-height: 1.4;
        }


        /* =========================================================
       FORM DIVIDER
    ========================================================= */

        .rejected-form-divider {
            height: 1px;
            margin: 25px 0 20px;
            background: var(--tr-border);
        }


        /* =========================================================
       ACTIONS
    ========================================================= */

        .rejected-form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }

        .rejected-btn {
            min-height: 44px;
            padding: 10px 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border-radius: 9px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .rejected-btn:hover {
            transform: translateY(-1px);
        }


        /* =========================================================
       BACK BUTTON
    ========================================================= */

        .rejected-btn-back {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .rejected-btn-back:hover {
            background: #e5e7eb;
            border-color: #cbd5e1;
            color: #1f2937;
        }


        /* =========================================================
       SUBMIT BUTTON
    ========================================================= */

        .rejected-btn-submit {
            background: var(--tr-primary);
            border: 1px solid var(--tr-primary);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.18);
        }

        .rejected-btn-submit:hover {
            background: var(--tr-primary-hover);
            border-color: var(--tr-primary-hover);
            color: #ffffff;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.24);
        }


        /* =========================================================
       DARK MODE
    ========================================================= */

        [data-bs-theme="dark"] .rejected-thesis-page,
        .dark .rejected-thesis-page,
        body.dark .rejected-thesis-page,
        [data-theme="dark"] .rejected-thesis-page {

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
       DARK OVERLAY
    ========================================================= */

        [data-bs-theme="dark"] .rejected-thesis-page::before,
        .dark .rejected-thesis-page::before,
        body.dark .rejected-thesis-page::before,
        [data-theme="dark"] .rejected-thesis-page::before {

            background: rgba(0, 0, 0, 0.55);
        }


        /* =========================================================
       DARK HEADER
    ========================================================= */

        [data-bs-theme="dark"] .rejected-thesis-header,
        .dark .rejected-thesis-header,
        body.dark .rejected-thesis-header,
        [data-theme="dark"] .rejected-thesis-header {

            background: linear-gradient(135deg,
                    #6538d9,
                    #4f46e5);
        }


        /* =========================================================
       DARK FEEDBACK
    ========================================================= */

        [data-bs-theme="dark"] .rejected-feedback-card,
        .dark .rejected-feedback-card,
        body.dark .rejected-feedback-card,
        [data-theme="dark"] .rejected-feedback-card {

            background: var(--tr-card);
            border-color: var(--tr-border);
        }

        [data-bs-theme="dark"] .rejected-feedback-header,
        .dark .rejected-feedback-header,
        body.dark .rejected-feedback-header,
        [data-theme="dark"] .rejected-feedback-header {

            background: #211d3b;
            border-bottom-color: #302b4b;
        }

        [data-bs-theme="dark"] .rejected-feedback-header h4,
        .dark .rejected-feedback-header h4,
        body.dark .rejected-feedback-header h4,
        [data-theme="dark"] .rejected-feedback-header h4 {

            color: #ffffff;
        }


        /* =========================================================
       DARK INPUT
    ========================================================= */

        [data-bs-theme="dark"] .rejected-form-control,
        .dark .rejected-form-control,
        body.dark .rejected-form-control,
        [data-theme="dark"] .rejected-form-control {

            background: var(--tr-input);
            border-color: var(--tr-border);
            color: var(--tr-text);
        }

        [data-bs-theme="dark"] .rejected-form-control:hover,
        .dark .rejected-form-control:hover,
        body.dark .rejected-form-control:hover,
        [data-theme="dark"] .rejected-form-control:hover {

            border-color: #484e69;
        }

        [data-bs-theme="dark"] .rejected-form-control:focus,
        .dark .rejected-form-control:focus,
        body.dark .rejected-form-control:focus,
        [data-theme="dark"] .rejected-form-control:focus {

            background: var(--tr-input);
            border-color: var(--tr-primary);
            color: #ffffff;
        }

        [data-bs-theme="dark"] .rejected-form-control::placeholder,
        .dark .rejected-form-control::placeholder,
        body.dark .rejected-form-control::placeholder,
        [data-theme="dark"] .rejected-form-control::placeholder {

            color: #8f96ad;
        }


        /* =========================================================
       DARK FEEDBACK BOX
    ========================================================= */

        [data-bs-theme="dark"] .feedback-box,
        .dark .feedback-box,
        body.dark .feedback-box,
        [data-theme="dark"] .feedback-box {

            background: #321f27;
            border-color: #4e2a34;
            border-left-color: #e24444;
        }

        [data-bs-theme="dark"] .feedback-icon,
        .dark .feedback-icon,
        body.dark .feedback-icon,
        [data-theme="dark"] .feedback-icon {

            background: #4a2932;
            color: #ff7777;
        }

        [data-bs-theme="dark"] .feedback-text,
        .dark .feedback-text,
        body.dark .feedback-text,
        [data-theme="dark"] .feedback-text {

            color: #c2c5d3;
        }


        /* =========================================================
       DARK NO FEEDBACK
    ========================================================= */

        [data-bs-theme="dark"] .no-feedback,
        .dark .no-feedback,
        body.dark .no-feedback,
        [data-theme="dark"] .no-feedback {

            background: var(--tr-input);
            border-color: var(--tr-border);
            color: var(--tr-muted);
        }


        /* =========================================================
       DARK CURRENT PDF
    ========================================================= */

        [data-bs-theme="dark"] .current-pdf-box,
        .dark .current-pdf-box,
        body.dark .current-pdf-box,
        [data-theme="dark"] .current-pdf-box {

            background: var(--tr-input);
            border-color: var(--tr-border);
        }

        [data-bs-theme="dark"] .pdf-details strong,
        .dark .pdf-details strong,
        body.dark .pdf-details strong,
        [data-theme="dark"] .pdf-details strong {

            color: #ffffff;
        }

        [data-bs-theme="dark"] .pdf-details span,
        .dark .pdf-details span,
        body.dark .pdf-details span,
        [data-theme="dark"] .pdf-details span {

            color: var(--tr-muted);
        }


        /* =========================================================
       DARK FILE INPUT
    ========================================================= */

        [data-bs-theme="dark"] .rejected-file-input::file-selector-button,
        .dark .rejected-file-input::file-selector-button,
        body.dark .rejected-file-input::file-selector-button,
        [data-theme="dark"] .rejected-file-input::file-selector-button {

            background: #252b43;
            color: #60a5fa;
        }

        [data-bs-theme="dark"] .rejected-file-input::file-selector-button:hover,
        .dark .rejected-file-input::file-selector-button:hover,
        body.dark .rejected-file-input::file-selector-button:hover,
        [data-theme="dark"] .rejected-file-input::file-selector-button:hover {

            background: #303750;
        }


        /* =========================================================
       DARK REJECTED MESSAGE
    ========================================================= */

        [data-bs-theme="dark"] .rejected-message,
        .dark .rejected-message,
        body.dark .rejected-message,
        [data-theme="dark"] .rejected-message {

            background: #321f27;
            border-color: #4e2a34;
        }

        [data-bs-theme="dark"] .rejected-message-icon,
        .dark .rejected-message-icon,
        body.dark .rejected-message-icon,
        [data-theme="dark"] .rejected-message-icon {

            background: #4a2932;
            color: #ff7777;
        }

        [data-bs-theme="dark"] .rejected-message h3,
        .dark .rejected-message h3,
        body.dark .rejected-message h3,
        [data-theme="dark"] .rejected-message h3 {

            color: #ff7777;
        }

        [data-bs-theme="dark"] .rejected-message p,
        .dark .rejected-message p,
        body.dark .rejected-message p,
        [data-theme="dark"] .rejected-message p {

            color: #c2a2a8;
        }


        /* =========================================================
       DARK ALERT
    ========================================================= */

        [data-bs-theme="dark"] .rejected-alert-danger,
        .dark .rejected-alert-danger,
        body.dark .rejected-alert-danger,
        [data-theme="dark"] .rejected-alert-danger {

            background: rgba(127, 29, 29, 0.2);
            border-color: rgba(248, 113, 113, 0.3);
            color: #fca5a5;
        }

        [data-bs-theme="dark"] .rejected-alert-success,
        .dark .rejected-alert-success,
        body.dark .rejected-alert-success,
        [data-theme="dark"] .rejected-alert-success {

            background: rgba(22, 101, 52, 0.2);
            border-color: rgba(74, 222, 128, 0.3);
            color: #86efac;
        }


        /* =========================================================
       DARK NO PDF
    ========================================================= */

        [data-bs-theme="dark"] .no-pdf-box,
        .dark .no-pdf-box,
        body.dark .no-pdf-box,
        [data-theme="dark"] .no-pdf-box {

            background: rgba(120, 83, 8, 0.18);
            border-color: rgba(250, 204, 21, 0.25);
            color: #fcd34d;
        }


        /* =========================================================
       DARK BACK BUTTON
    ========================================================= */

        [data-bs-theme="dark"] .rejected-btn-back,
        .dark .rejected-btn-back,
        body.dark .rejected-btn-back,
        [data-theme="dark"] .rejected-btn-back {

            background: #262a31;
            border-color: #3b4048;
            color: #f3f4f6;
        }

        [data-bs-theme="dark"] .rejected-btn-back:hover,
        .dark .rejected-btn-back:hover,
        body.dark .rejected-btn-back:hover,
        [data-theme="dark"] .rejected-btn-back:hover {

            background: #30353e;
            border-color: #464c57;
            color: #ffffff;
        }


        /* =========================================================
       TABLET
    ========================================================= */

        @media (max-width: 992px) {

            .rejected-thesis-page {
                padding: 25px 16px;
            }

            .rejected-thesis-wrapper {
                max-width: 900px;
            }

            .rejected-form-layout {
                grid-template-columns: 1fr;
            }

            .rejected-form-wide {
                grid-column: auto;
            }
        }


        /* =========================================================
       MOBILE
    ========================================================= */

        @media (max-width: 768px) {

            .rejected-thesis-page {
                padding: 15px 10px 20px;
                align-items: flex-start;
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .rejected-thesis-wrapper {
                max-width: 100%;
            }

            .rejected-thesis-card {
                border-radius: 14px;
            }

            .rejected-thesis-header {
                padding: 18px 20px;
            }

            .rejected-header-content {
                align-items: flex-start;
            }

            .rejected-header-icon {
                width: 42px;
                height: 42px;
                font-size: 18px;
            }

            .rejected-thesis-header h3 {
                font-size: 18px;
            }

            .rejected-thesis-header p {
                font-size: 12px;
                line-height: 1.5;
            }

            .rejected-thesis-body {
                padding: 22px 18px;
            }

            .rejected-alert {
                font-size: 12px;
            }

            .rejected-message {
                padding: 14px;
            }

            .rejected-message-icon {
                width: 34px;
                height: 34px;
                font-size: 15px;
            }

            .rejected-message h3 {
                font-size: 13px;
            }

            .rejected-message p {
                font-size: 11px;
            }

            .rejected-feedback-header {
                padding: 14px 15px;
            }

            .rejected-feedback-body {
                padding: 16px 15px;
            }

            .rejected-section-icon,
            .resubmit-section-icon {
                width: 37px;
                height: 37px;
                font-size: 15px;
            }

            .rejected-feedback-header h4,
            .resubmit-section-header h4 {
                font-size: 14px;
            }

            .rejected-feedback-header p,
            .resubmit-section-header p {
                font-size: 10px;
            }

            .rejected-form-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .rejected-form-wide {
                grid-column: auto;
            }

            .rejected-form-label {
                font-size: 13px;
            }

            .rejected-form-control {
                font-size: 13px;
            }

            .rejected-textarea {
                min-height: 130px;
            }

            .current-pdf-box {
                flex-direction: column;
                align-items: stretch;
            }

            .view-pdf-button {
                width: 100%;
            }

            .rejected-form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .rejected-btn {
                width: 100%;
                min-height: 44px;
            }
        }


        /* =========================================================
       SMALL MOBILE
    ========================================================= */

        @media (max-width: 480px) {

            .rejected-thesis-page {
                padding-left: 8px;
                padding-right: 8px;
            }

            .rejected-thesis-header {
                padding: 16px;
            }

            .rejected-thesis-body {
                padding: 18px 14px;
            }

            .rejected-header-icon {
                width: 40px;
                height: 40px;
            }

            .rejected-thesis-header h3 {
                font-size: 17px;
            }

            .rejected-thesis-header p {
                font-size: 11px;
            }

            .feedback-box {
                padding: 13px;
            }

            .feedback-text {
                font-size: 12px;
            }

            .current-pdf-box {
                padding: 9px;
            }

            .current-pdf-info {
                align-items: flex-start;
            }

            .pdf-details strong {
                white-space: normal;
                overflow-wrap: anywhere;
            }

            .rejected-form-control {
                font-size: 12px;
            }

            .rejected-file-input::file-selector-button {
                font-size: 11px;
                padding: 7px 11px;
            }
        }
    </style>


    {{-- =========================================================
     RESUBMIT THESIS MODAL
========================================================== --}}

    <div class="dashboard-content rejected-thesis-page">

        <div class="rejected-thesis-wrapper">

            <div class="rejected-thesis-card">

                {{-- =====================================================
                 HEADER
            ====================================================== --}}

                <div class="rejected-thesis-header">

                    <div class="rejected-header-content">

                        <div class="rejected-header-icon">
                            <i class="bi bi-file-earmark-x"></i>
                        </div>

                        <div>
                            <h3>
                                Thesis Rejected
                            </h3>

                            <p>
                                Review the HoD feedback and resubmit your thesis.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- =====================================================
                 BODY
            ====================================================== --}}

                <div class="rejected-thesis-body">

                    {{-- =================================================
                     ERROR MESSAGE
                ================================================== --}}

                    @if (session('error'))
                        <div class="rejected-alert rejected-alert-danger">

                            <div class="rejected-alert-icon">
                                <i class="bi bi-exclamation-circle-fill"></i>
                            </div>

                            <div>
                                {{ session('error') }}
                            </div>

                        </div>
                    @endif


                    {{-- =================================================
                     SUCCESS MESSAGE
                ================================================== --}}

                    @if (session('success'))
                        <div class="rejected-alert rejected-alert-success">

                            <div class="rejected-alert-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>

                            <div>
                                {{ session('success') }}
                            </div>

                        </div>
                    @endif


                    {{-- =================================================
                     VALIDATION ERRORS
                ================================================== --}}

                    @if ($errors->any())

                        <div class="rejected-alert rejected-alert-danger">

                            <div class="rejected-alert-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>

                            <div>

                                <strong>
                                    Please correct the following errors:
                                </strong>

                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                     REJECTED MESSAGE
                ================================================== --}}

                    <div class="rejected-message">

                        <div class="rejected-message-icon">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>

                        <div>

                            <h3>
                                Your thesis has been rejected
                            </h3>

                            <p>
                                Please review the feedback below and make the necessary
                                changes before resubmitting.
                            </p>

                        </div>

                    </div>


                    {{-- =================================================
                     HOD FEEDBACK
                ================================================== --}}

                    <div class="rejected-feedback-card">

                        <div class="rejected-feedback-header">

                            <div class="rejected-section-icon">
                                <i class="bi bi-chat-left-text"></i>
                            </div>

                            <div>

                                <h4>
                                    HoD Feedback
                                </h4>

                                <p>
                                    Feedback provided by the Head of Department
                                </p>

                            </div>

                        </div>


                        <div class="rejected-feedback-body">

                            @if ($thesisRequest->remarks)
                                <div class="feedback-box">

                                    <div class="feedback-icon">
                                        <i class="bi bi-quote"></i>
                                    </div>

                                    <div class="feedback-text">
                                        {{ $thesisRequest->remarks }}
                                    </div>

                                </div>
                            @else
                                <div class="no-feedback">

                                    <i class="bi bi-chat-left-dots"></i>

                                    <span>
                                        No feedback was provided.
                                    </span>

                                </div>
                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                     RESUBMIT SECTION
                ================================================== --}}

                    <div class="resubmit-section">

                        <div class="resubmit-section-header">

                            <div class="resubmit-section-icon">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>

                            <div>

                                <h4>
                                    Resubmit Thesis
                                </h4>

                                <p>
                                    Update your thesis information and submit it again.
                                </p>

                            </div>

                        </div>


                        {{-- =================================================
                         FORM
                    ================================================== --}}

                        <form action="{{ route('student.thesis_requests.resubmit', $thesisRequest) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')


                            <div class="rejected-form-layout">


                                {{-- =================================================
                                 TITLE
                            ================================================== --}}

                                <div class="rejected-form-group">

                                    <label class="rejected-form-label">

                                        Thesis Title

                                        <span class="rejected-required">
                                            *
                                        </span>

                                    </label>

                                    <input type="text" name="title"
                                        value="{{ old('title', $thesisRequest->title) }}" required
                                        class="rejected-form-control" placeholder="Enter thesis title">

                                    @error('title')
                                        <p class="field-error">

                                            <i class="bi bi-exclamation-circle"></i>

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>


                                {{-- =================================================
                                 AUTHOR
                            ================================================== --}}

                                <div class="rejected-form-group">

                                    <label class="rejected-form-label">

                                        Author Name

                                        <span class="rejected-required">
                                            *
                                        </span>

                                    </label>

                                    <input type="text" name="author_name"
                                        value="{{ old('author_name', $thesisRequest->author_name) }}" required
                                        class="rejected-form-control" placeholder="Enter author name">

                                    @error('author_name')
                                        <p class="field-error">

                                            <i class="bi bi-exclamation-circle"></i>

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>


                                {{-- =================================================
                                 ABSTRACT
                            ================================================== --}}

                                <div class="rejected-form-group rejected-form-wide">

                                    <label class="rejected-form-label">

                                        Abstract

                                        <span class="rejected-required">
                                            *
                                        </span>

                                    </label>

                                    <textarea name="abstract" rows="7" required class="rejected-form-control rejected-textarea"
                                        placeholder="Enter thesis abstract">{{ old('abstract', $thesisRequest->abstract) }}</textarea>

                                    @error('abstract')
                                        <p class="field-error">

                                            <i class="bi bi-exclamation-circle"></i>

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>


                                {{-- =================================================
                                 DESCRIPTION
                            ================================================== --}}

                                <div class="rejected-form-group rejected-form-wide">

                                    <label class="rejected-form-label">

                                        Description

                                        <span class="rejected-required">
                                            *
                                        </span>

                                    </label>

                                    <textarea name="description" rows="7" required class="rejected-form-control rejected-textarea"
                                        placeholder="Enter thesis description">{{ old('description', $thesisRequest->description) }}</textarea>

                                    @error('description')
                                        <p class="field-error">

                                            <i class="bi bi-exclamation-circle"></i>

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>


                                {{-- =================================================
                                 CURRENT PDF
                            ================================================== --}}

                                <div class="rejected-form-group">

                                    <label class="rejected-form-label">
                                        Current Thesis PDF
                                    </label>

                                    @if ($thesisRequest->pdf_file)
                                        <div class="current-pdf-box">

                                            <div class="current-pdf-info">

                                                <div class="pdf-icon">
                                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                                </div>

                                                <div class="pdf-details">

                                                    <strong>
                                                        {{ $thesisRequest->thesis_name }}
                                                    </strong>

                                                    <span>
                                                        Current thesis document
                                                    </span>

                                                </div>

                                            </div>


                                            <a href="{{ asset('storage/' . $thesisRequest->pdf_file) }}"
                                                target="_blank" class="view-pdf-button">

                                                <i class="bi bi-eye-fill"></i>

                                                View PDF

                                            </a>

                                        </div>
                                    @else
                                        <div class="no-pdf-box">

                                            <i class="bi bi-file-earmark-x"></i>

                                            <span>
                                                No current thesis PDF was found.
                                            </span>

                                        </div>
                                    @endif

                                </div>


                                {{-- =================================================
                                 REPLACE PDF
                            ================================================== --}}

                                <div class="rejected-form-group">

                                    <label class="rejected-form-label">

                                        Replace Thesis PDF

                                        <span class="optional-label">
                                            (Optional)
                                        </span>

                                    </label>

                                    <input type="file" name="thesis_file" accept=".pdf"
                                        class="rejected-form-control rejected-file-input">

                                    <div class="file-help">

                                        <i class="bi bi-info-circle"></i>

                                        <span>
                                            Leave empty to keep the current PDF.
                                        </span>

                                    </div>

                                    <div class="file-help">

                                        <i class="bi bi-file-earmark-pdf"></i>

                                        <span>
                                            Upload a new PDF to replace the current thesis.
                                        </span>

                                    </div>

                                    @error('thesis_file')
                                        <p class="field-error">

                                            <i class="bi bi-exclamation-circle"></i>

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                             DIVIDER
                        ================================================== --}}

                            <div class="rejected-form-divider"></div>


                            {{-- =================================================
                             ACTIONS
                        ================================================== --}}

                            <div class="rejected-form-actions">

                                <a href="{{ route('student.thesis_requests.index') }}"
                                    class="rejected-btn rejected-btn-back">

                                    <i class="bi bi-arrow-left"></i>

                                    Back

                                </a>


                                <button type="submit" class="rejected-btn rejected-btn-submit">

                                    <i class="bi bi-arrow-repeat"></i>

                                    Resubmit Thesis

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
     JAVASCRIPT
     Only controls modal background scroll.
     No backend/input behavior changed.
========================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.body.classList.add('rejected-modal-open');

        });
    </script>

</x-app-layout>
