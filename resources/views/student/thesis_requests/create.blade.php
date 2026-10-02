<x-app-layout>

    <style>
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

        body.thesis-modal-open {
            overflow: hidden;
        }

        .thesis-request-wrapper {
            position: relative;
            width: 100%;
            max-width: 900px;
            margin: auto;
            z-index: 2;
            transition: max-width 0.4s ease, transform 0.4s ease;
        }

        .thesis-request-wrapper.expanded {
            max-width: 1200px;
        }

        .thesis-request-card {
            position: relative;
            background: var(--tr-card);
            border: 1px solid var(--tr-border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: var(--tr-shadow);
            transition: background 0.3s ease, border-color 0.3s ease;
        }

        .thesis-request-header {
            position: relative;
            padding: 22px 28px;
            background: linear-gradient(135deg, #6538d9, #4f46e5);
            color: #ffffff;
        }

        .thesis-request-header-content {
            display: flex;
            align-items: center;
            gap: 14px;
            padding-right: 55px;
        }

        .thesis-request-header-icon {
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

        .thesis-request-header h3 {
            margin: 0;
            font-size: 21px;
            font-weight: 700;
        }

        .thesis-request-header p {
            margin: 4px 0 0;
            font-size: 13px;
            opacity: 0.9;
        }

        .thesis-expand-btn {
            position: absolute;
            top: 20px;
            right: 24px;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .thesis-expand-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.06);
        }

        .thesis-expand-btn:active {
            transform: scale(0.96);
        }

        .thesis-expand-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25);
        }

        .thesis-request-body {
            padding: 30px;
        }

        .thesis-request-wrapper.expanded .thesis-form-layout {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .thesis-request-wrapper.expanded .thesis-form-group {
            margin-bottom: 0;
        }

        .thesis-request-wrapper.expanded .full-width-field {
            grid-column: 1 / -1;
        }

        .thesis-form-group {
            margin-bottom: 22px;
        }

        .thesis-form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--tr-text);
            font-size: 14px;
            font-weight: 600;
        }

        .thesis-required {
            color: var(--tr-danger);
        }

        .thesis-request-page .form-control {
            width: 100%;
            min-height: 46px;
            padding: 11px 14px;
            border: 1px solid var(--tr-border);
            border-radius: 10px;
            background: var(--tr-input);
            color: var(--tr-text);
            font-size: 14px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .form-control::placeholder {
            color: #9ca3af;
            opacity: 1;
        }

        .thesis-request-page textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .thesis-request-page .form-control:focus {
            border-color: var(--tr-primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
            outline: none;
        }

        .thesis-file-upload-wrapper {
            width: 100%;
        }

        .thesis-file-input {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .thesis-file-dropzone {
            width: 100%;
            min-height: 145px;
            padding: 24px;
            border: 2px dashed var(--tr-border);
            border-radius: 14px;
            background: var(--tr-input);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s ease, background 0.2s ease, transform 0.2s ease;
        }

        .thesis-file-dropzone:hover {
            border-color: var(--tr-primary);
            background: rgba(37, 99, 235, 0.04);
        }

        .thesis-file-dropzone.dragover {
            border-color: var(--tr-primary);
            background: rgba(37, 99, 235, 0.08);
            transform: scale(1.01);
        }

        .thesis-file-upload-icon {
            width: 52px;
            height: 52px;
            margin-bottom: 10px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eff6ff;
            color: #2563eb;
            font-size: 25px;
        }

        .thesis-file-dropzone-title {
            margin: 0;
            color: var(--tr-text);
            font-size: 15px;
            font-weight: 700;
        }

        .thesis-file-dropzone-text {
            margin: 5px 0 0;
            color: var(--tr-muted);
            font-size: 13px;
        }

        .thesis-file-dropzone-text strong {
            color: var(--tr-primary);
        }

        .thesis-selected-file {
            display: none;
            margin-top: 12px;
            padding: 14px;
            border: 1px solid var(--tr-border);
            border-radius: 12px;
            background: var(--tr-input);
        }

        .thesis-selected-file.show {
            display: block;
        }

        .thesis-selected-file-info {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .thesis-selected-file-icon {
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #fef2f2;
            color: #dc2626;
            font-size: 22px;
        }

        .thesis-selected-file-details {
            min-width: 0;
            flex: 1;
        }

        .thesis-selected-file-name {
            margin: 0;
            color: var(--tr-text);
            font-size: 14px;
            font-weight: 700;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .thesis-selected-file-size {
            margin: 4px 0 0;
            color: var(--tr-muted);
            font-size: 12px;
        }

        .thesis-selected-file-actions {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-shrink: 0;
        }

        .thesis-file-action-btn {
            height: 36px;
            padding: 0 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border: 1px solid var(--tr-border);
            border-radius: 8px;
            background: var(--tr-card);
            color: var(--tr-text);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .thesis-file-action-btn:hover {
            border-color: var(--tr-primary);
            color: var(--tr-primary);
            transform: translateY(-1px);
        }

        .thesis-file-action-btn.replace {
            background: var(--tr-primary);
            border-color: var(--tr-primary);
            color: #ffffff;
        }

        .thesis-file-action-btn.replace:hover {
            background: var(--tr-primary-hover);
            color: #ffffff;
        }

        .thesis-file-action-btn.remove {
            color: var(--tr-danger);
        }

        .thesis-file-action-btn.remove:hover {
            border-color: var(--tr-danger);
            background: #fef2f2;
            color: var(--tr-danger);
        }

        .thesis-file-preview {
            display: none;
            margin-top: 14px;
            overflow: hidden;
            border: 1px solid var(--tr-border);
            border-radius: 12px;
            background: var(--tr-input);
        }

        .thesis-file-preview.show {
            display: block;
        }

        .thesis-file-preview-header {
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--tr-border);
        }

        .thesis-file-preview-title {
            margin: 0;
            color: var(--tr-text);
            font-size: 13px;
            font-weight: 700;
        }

        .thesis-file-preview iframe {
            display: block;
            width: 100%;
            height: 450px;
            border: 0;
            background: #ffffff;
        }

        .thesis-request-alert {
            margin-bottom: 24px;
            padding: 15px 18px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: #fef2f2;
            color: #991b1b;
        }

        .thesis-form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--tr-border);
        }

        .thesis-form-actions .btn {
            min-height: 44px;
            padding: 10px 20px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .thesis-form-actions .btn:hover {
            transform: translateY(-1px);
        }

        .thesis-form-actions .btn-secondary {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .thesis-form-actions .btn-secondary:hover {
            background: #e5e7eb;
        }

        .thesis-form-actions .btn-primary {
            background: var(--tr-primary);
            border: 1px solid var(--tr-primary);
            color: #ffffff;
        }

        .thesis-form-actions .btn-primary:hover {
            background: var(--tr-primary-hover);
            border-color: var(--tr-primary-hover);
        }

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

        [data-bs-theme="dark"] .thesis-request-page::before,
        .dark .thesis-request-page::before,
        body.dark .thesis-request-page::before,
        [data-theme="dark"] .thesis-request-page::before {
            background: rgba(0, 0, 0, 0.55);
        }

        [data-bs-theme="dark"] .thesis-request-page .form-control,
        .dark .thesis-request-page .form-control,
        body.dark .thesis-request-page .form-control,
        [data-theme="dark"] .thesis-request-page .form-control {
            background: var(--tr-input);
            border-color: var(--tr-border);
            color: var(--tr-text);
        }

        [data-bs-theme="dark"] .thesis-request-page .form-control::placeholder,
        .dark .thesis-request-page .form-control::placeholder,
        body.dark .thesis-request-page .form-control::placeholder,
        [data-theme="dark"] .thesis-request-page .form-control::placeholder {
            color: #8f96ad;
        }

        [data-bs-theme="dark"] .thesis-file-dropzone,
        .dark .thesis-file-dropzone,
        body.dark .thesis-file-dropzone,
        [data-theme="dark"] .thesis-file-dropzone {
            background: var(--tr-input);
            border-color: var(--tr-border);
        }

        [data-bs-theme="dark"] .thesis-file-upload-icon,
        .dark .thesis-file-upload-icon,
        body.dark .thesis-file-upload-icon,
        [data-theme="dark"] .thesis-file-upload-icon {
            background: #252b43;
            color: #60a5fa;
        }

        [data-bs-theme="dark"] .thesis-selected-file,
        .dark .thesis-selected-file,
        body.dark .thesis-selected-file,
        [data-theme="dark"] .thesis-selected-file {
            background: var(--tr-input);
            border-color: var(--tr-border);
        }

        [data-bs-theme="dark"] .thesis-selected-file-icon,
        .dark .thesis-selected-file-icon,
        body.dark .thesis-selected-file-icon,
        [data-theme="dark"] .thesis-selected-file-icon {
            background: #3a2528;
            color: #f87171;
        }

        [data-bs-theme="dark"] .thesis-file-preview,
        .dark .thesis-file-preview,
        body.dark .thesis-file-preview,
        [data-theme="dark"] .thesis-file-preview {
            background: var(--tr-input);
            border-color: var(--tr-border);
        }

        [data-bs-theme="dark"] .thesis-file-preview iframe,
        .dark .thesis-file-preview iframe,
        body.dark .thesis-file-preview iframe,
        [data-theme="dark"] .thesis-file-preview iframe {
            background: #111318;
        }

        [data-bs-theme="dark"] .thesis-file-action-btn,
        .dark .thesis-file-action-btn,
        body.dark .thesis-file-action-btn,
        [data-theme="dark"] .thesis-file-action-btn {
            background: var(--tr-card);
            border-color: var(--tr-border);
            color: var(--tr-text);
        }

        [data-bs-theme="dark"] .thesis-file-action-btn:hover,
        .dark .thesis-file-action-btn:hover,
        body.dark .thesis-file-action-btn:hover,
        [data-theme="dark"] .thesis-file-action-btn:hover {
            border-color: var(--tr-primary);
            color: var(--tr-primary);
        }

        [data-bs-theme="dark"] .thesis-file-action-btn.replace,
        .dark .thesis-file-action-btn.replace,
        body.dark .thesis-file-action-btn.replace,
        [data-theme="dark"] .thesis-file-action-btn.replace {
            background: var(--tr-primary);
            border-color: var(--tr-primary);
            color: #ffffff;
        }

        [data-bs-theme="dark"] .thesis-file-action-btn.remove:hover,
        .dark .thesis-file-action-btn.remove:hover,
        body.dark .thesis-file-action-btn.remove:hover,
        [data-theme="dark"] .thesis-file-action-btn.remove:hover {
            border-color: var(--tr-danger);
            background: #3a2528;
            color: var(--tr-danger);
        }

        [data-bs-theme="dark"] .thesis-form-actions .btn-secondary,
        .dark .thesis-form-actions .btn-secondary,
        body.dark .thesis-form-actions .btn-secondary,
        [data-theme="dark"] .thesis-form-actions .btn-secondary {
            background: #262a31;
            border-color: #3b4048;
            color: #f3f4f6;
        }

        [data-bs-theme="dark"] .thesis-form-actions .btn-secondary:hover,
        .dark .thesis-form-actions .btn-secondary:hover,
        body.dark .thesis-form-actions .btn-secondary:hover,
        [data-theme="dark"] .thesis-form-actions .btn-secondary:hover {
            background: #30353e;
            border-color: #464c57;
            color: #ffffff;
        }

        [data-bs-theme="dark"] .thesis-request-alert,
        .dark .thesis-request-alert,
        body.dark .thesis-request-alert,
        [data-theme="dark"] .thesis-request-alert {
            background: rgba(127, 29, 29, 0.2);
            border-color: rgba(248, 113, 113, 0.3);
            color: #fca5a5;
        }

        [data-bs-theme="dark"] .thesis-file-dropzone:hover,
        .dark .thesis-file-dropzone:hover,
        body.dark .thesis-file-dropzone:hover,
        [data-theme="dark"] .thesis-file-dropzone:hover {
            background: rgba(59, 130, 246, 0.08);
        }

        @media (max-width: 992px) {
            .thesis-request-wrapper.expanded {
                max-width: 900px;
            }

            .thesis-request-wrapper.expanded .thesis-form-layout {
                grid-template-columns: 1fr;
            }

            .thesis-request-wrapper.expanded .full-width-field {
                grid-column: auto;
            }

            .thesis-file-preview iframe {
                height: 400px;
            }
        }

        @media (max-width: 768px) {
            .thesis-request-page {
                padding: 15px 10px;
                align-items: flex-start;
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .thesis-request-wrapper,
            .thesis-request-wrapper.expanded {
                max-width: 100%;
            }

            .thesis-request-card {
                border-radius: 14px;
            }

            .thesis-request-header {
                padding: 18px 20px;
            }

            .thesis-expand-btn {
                display: none !important;
            }

            .thesis-request-header-content {
                padding-right: 0;
            }

            .thesis-request-header h3 {
                font-size: 18px;
            }

            .thesis-request-header p {
                font-size: 12px;
            }

            .thesis-request-body {
                padding: 22px 18px;
            }

            .thesis-form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .thesis-form-actions .btn {
                width: 100%;
            }

            .thesis-selected-file-info {
                align-items: flex-start;
            }

            .thesis-selected-file {
                padding: 12px;
            }

            .thesis-selected-file-actions {
                flex-wrap: wrap;
            }

            .thesis-file-action-btn {
                padding: 0 9px;
            }

            .thesis-file-preview iframe {
                height: 320px;
            }
        }

        @media (max-width: 480px) {
            .thesis-request-page {
                padding-left: 8px;
                padding-right: 8px;
            }

            .thesis-request-header {
                padding: 16px;
            }

            .thesis-request-body {
                padding: 18px 14px;
            }

            .thesis-selected-file-info {
                flex-wrap: wrap;
            }

            .thesis-selected-file-details {
                width: calc(100% - 60px);
            }

            .thesis-selected-file-actions {
                width: 100%;
                margin-top: 4px;
            }

            .thesis-file-action-btn {
                flex: 1;
            }

            .thesis-file-dropzone {
                min-height: 125px;
                padding: 18px;
            }
        }
    </style>

    <div class="dashboard-content thesis-request-page">
        <div class="thesis-request-wrapper" id="thesisRequestWrapper">
            <div class="thesis-request-card">
                <div class="thesis-request-header">
                    <div class="thesis-request-header-content">
                        <div class="thesis-request-header-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div>
                            <h3>Submit Thesis Request</h3>
                            <p>Provide your thesis information and upload your PDF file.</p>
                        </div>
                    </div>

                    <button type="button" class="thesis-expand-btn" id="thesisExpandBtn" title="Expand Form"
                        aria-label="Expand Form">
                        <i class="bi bi-arrows-fullscreen" id="thesisExpandIcon"></i>
                    </button>
                </div>

                <div class="thesis-request-body">
                    @if ($errors->any())
                        <div class="thesis-request-alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('student.thesis_requests.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="thesis-form-layout">
                            <div class="row">
                                <div class="col-md-6 thesis-form-group">
                                    <label class="thesis-form-label">
                                        Author(s) Name
                                        <span class="thesis-required">*</span>
                                    </label>
                                    <input type="text" name="author_name" class="form-control"
                                        value="{{ old('author_name') }}" required>
                                </div>

                                <div class="col-md-6 thesis-form-group">
                                    <label class="thesis-form-label">
                                        Academic Year
                                        <span class="thesis-required">*</span>
                                    </label>
                                    <input type="text" name="academic_year" class="form-control" placeholder="2025"
                                        value="{{ old('academic_year') }}" required>
                                </div>
                            </div>

                            <div class="thesis-form-group">
                                <label class="thesis-form-label">
                                    Thesis Title
                                    <span class="thesis-required">*</span>
                                </label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    required>
                            </div>

                            <div class="thesis-form-group full-width-field">
                                <label class="thesis-form-label">
                                    Abstract
                                    <span class="thesis-required">*</span>
                                </label>
                                <textarea name="abstract" rows="5" class="form-control" required>{{ old('abstract') }}</textarea>
                            </div>

                            <div class="thesis-form-group full-width-field">
                                <label class="thesis-form-label">Description</label>
                                <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <div class="thesis-form-group full-width-field">
                                <label class="thesis-form-label">
                                    Upload Thesis (PDF)
                                    <span class="thesis-required">*</span>
                                </label>

                                <div class="thesis-file-upload-wrapper">
                                    <input type="file" name="pdf_file" id="thesisPdfFile" class="thesis-file-input"
                                        accept=".pdf,application/pdf" required>

                                    <label for="thesisPdfFile" class="thesis-file-dropzone" id="thesisFileDropzone">
                                        <div class="thesis-file-upload-icon">
                                            <i class="bi bi-cloud-arrow-up"></i>
                                        </div>
                                        <p class="thesis-file-dropzone-title">Choose your thesis PDF</p>
                                        <p class="thesis-file-dropzone-text">
                                            Click here to select a file or drag & drop
                                            <br>
                                            <strong>PDF only</strong>
                                        </p>
                                    </label>

                                    <div class="thesis-selected-file" id="thesisSelectedFile">
                                        <div class="thesis-selected-file-info">
                                            <div class="thesis-selected-file-icon">
                                                <i class="bi bi-file-earmark-pdf"></i>
                                            </div>

                                            <div class="thesis-selected-file-details">
                                                <p class="thesis-selected-file-name" id="thesisFileName">
                                                    No file selected
                                                </p>
                                                <p class="thesis-selected-file-size" id="thesisFileSize">-</p>
                                            </div>

                                            <div class="thesis-selected-file-actions">
                                                <a href="#" target="_blank" class="thesis-file-action-btn"
                                                    id="thesisPreviewBtn" style="display: none;">
                                                    <i class="bi bi-eye"></i>
                                                    View
                                                </a>

                                                <button type="button" class="thesis-file-action-btn replace"
                                                    id="thesisReplaceBtn">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                    Replace
                                                </button>

                                                <button type="button" class="thesis-file-action-btn remove"
                                                    id="thesisRemoveBtn">
                                                    <i class="bi bi-trash"></i>
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="thesis-file-preview" id="thesisFilePreview">
                                        <div class="thesis-file-preview-header">
                                            <p class="thesis-file-preview-title">
                                                <i class="bi bi-file-earmark-pdf me-1"></i>
                                                PDF Preview
                                            </p>

                                            <button type="button" class="thesis-file-action-btn"
                                                id="thesisClosePreviewBtn">
                                                <i class="bi bi-x-lg"></i>
                                                Close
                                            </button>
                                        </div>

                                        <iframe id="thesisPdfPreview" title="Thesis PDF Preview"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="thesis-form-actions">
                            <a href="{{ route('student.thesis_requests.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i>
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-1"></i>
                                Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('thesis-modal-open');

            const wrapper = document.getElementById('thesisRequestWrapper');
            const button = document.getElementById('thesisExpandBtn');
            const icon = document.getElementById('thesisExpandIcon');

            if (wrapper && button && icon) {
                button.addEventListener('click', function() {
                    wrapper.classList.toggle('expanded');

                    if (wrapper.classList.contains('expanded')) {
                        icon.classList.remove('bi-arrows-fullscreen');
                        icon.classList.add('bi-fullscreen-exit');
                        button.setAttribute('title', 'Collapse Form');
                        button.setAttribute('aria-label', 'Collapse Form');
                    } else {
                        icon.classList.remove('bi-fullscreen-exit');
                        icon.classList.add('bi-arrows-fullscreen');
                        button.setAttribute('title', 'Expand Form');
                        button.setAttribute('aria-label', 'Expand Form');
                    }
                });
            }

            const fileInput = document.getElementById('thesisPdfFile');
            const dropzone = document.getElementById('thesisFileDropzone');
            const selectedFile = document.getElementById('thesisSelectedFile');
            const fileName = document.getElementById('thesisFileName');
            const fileSize = document.getElementById('thesisFileSize');
            const replaceBtn = document.getElementById('thesisReplaceBtn');
            const removeBtn = document.getElementById('thesisRemoveBtn');
            const previewBtn = document.getElementById('thesisPreviewBtn');
            const filePreview = document.getElementById('thesisFilePreview');
            const pdfPreview = document.getElementById('thesisPdfPreview');
            const closePreviewBtn = document.getElementById('thesisClosePreviewBtn');

            let currentFileUrl = null;

            function formatFileSize(bytes) {
                if (bytes === 0) {
                    return '0 Bytes';
                }

                const units = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(1024));

                return parseFloat(
                    (bytes / Math.pow(1024, i)).toFixed(2)
                ) + ' ' + units[i];
            }

            function isPdf(file) {
                if (!file) {
                    return false;
                }

                return file.type === 'application/pdf' ||
                    file.name.toLowerCase().endsWith('.pdf');
            }

            function displaySelectedFile(file) {
                if (!file) {
                    return;
                }

                if (!isPdf(file)) {
                    alert('Please select a PDF file only.');
                    clearFile();
                    return;
                }

                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size) + ' • PDF Document';
                selectedFile.classList.add('show');

                if (currentFileUrl) {
                    URL.revokeObjectURL(currentFileUrl);
                }

                currentFileUrl = URL.createObjectURL(file);
                previewBtn.href = currentFileUrl;
                previewBtn.style.display = 'inline-flex';
                pdfPreview.src = currentFileUrl;
                filePreview.classList.add('show');
                dropzone.style.borderColor = '#16a34a';
            }

            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    if (this.files && this.files.length > 0) {
                        displaySelectedFile(this.files[0]);
                    }
                });
            }

            if (replaceBtn) {
                replaceBtn.addEventListener('click', function() {
                    fileInput.click();
                });
            }

            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    clearFile();
                });
            }

            function clearFile() {
                fileInput.value = '';
                selectedFile.classList.remove('show');
                filePreview.classList.remove('show');
                previewBtn.style.display = 'none';
                pdfPreview.src = '';
                fileName.textContent = 'No file selected';
                fileSize.textContent = '-';
                dropzone.style.borderColor = '';

                if (currentFileUrl) {
                    URL.revokeObjectURL(currentFileUrl);
                    currentFileUrl = null;
                }
            }

            if (closePreviewBtn) {
                closePreviewBtn.addEventListener('click', function() {
                    filePreview.classList.remove('show');
                });
            }

            if (dropzone) {
                ['dragenter', 'dragover'].forEach(function(eventName) {
                    dropzone.addEventListener(eventName, function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        dropzone.classList.add('dragover');
                    });
                });

                ['dragleave', 'drop'].forEach(function(eventName) {
                    dropzone.addEventListener(eventName, function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        dropzone.classList.remove('dragover');
                    });
                });

                dropzone.addEventListener('drop', function(event) {
                    const files = event.dataTransfer.files;

                    if (!files || files.length === 0) {
                        return;
                    }

                    const file = files[0];

                    if (!isPdf(file)) {
                        alert('Please select a PDF file only.');
                        return;
                    }

                    try {
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        fileInput.files = dataTransfer.files;
                    } catch (error) {
                        console.warn(
                            'Could not assign dropped file to input.',
                            error
                        );
                    }

                    displaySelectedFile(file);
                });
            }

            window.addEventListener('beforeunload', function() {
                if (currentFileUrl) {
                    URL.revokeObjectURL(currentFileUrl);
                }
            });
        });
    </script>

</x-app-layout>
