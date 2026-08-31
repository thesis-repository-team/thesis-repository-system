<x-app-layout>

    <div class="dashboard-content rejected-thesis-page">

        <div class="rejected-thesis-container">

            {{-- =====================================================
                PAGE HEADER
            ====================================================== --}}
            <div class="rejected-page-header">

                <div class="rejected-header-icon">
                    <i class="bi bi-file-earmark-x"></i>
                </div>

                <div>
                    <h2>Thesis Rejected</h2>
                    <p>Review the HoD feedback and resubmit your thesis.</p>
                </div>

            </div>


            {{-- =====================================================
                ERROR MESSAGE
            ====================================================== --}}
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


            {{-- =====================================================
                SUCCESS MESSAGE
            ====================================================== --}}
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


            {{-- =====================================================
                VALIDATION ERRORS
            ====================================================== --}}
            @if ($errors->any())
                <div class="rejected-alert rejected-alert-danger">

                    <div class="rejected-alert-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>

                    <div>

                        <strong>Please correct the following errors:</strong>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                </div>
            @endif


            {{-- =====================================================
                REJECTED MESSAGE
            ====================================================== --}}
            <div class="rejected-message">

                <div class="rejected-message-icon">
                    <i class="bi bi-x-circle-fill"></i>
                </div>

                <div>

                    <h3>Your thesis has been rejected</h3>

                    <p>
                        Please review the feedback below and make the necessary
                        changes before resubmitting.
                    </p>

                </div>

            </div>


            {{-- =====================================================
                HOD FEEDBACK
            ====================================================== --}}
            <div class="rejected-card">

                <div class="rejected-card-header">

                    <div class="section-icon purple">
                        <i class="bi bi-chat-left-text"></i>
                    </div>

                    <div>

                        <h3>HoD Feedback</h3>

                        <p>
                            Feedback provided by the Head of Department
                        </p>

                    </div>

                </div>


                <div class="rejected-card-body">

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


            {{-- =====================================================
                RESUBMIT CARD
            ====================================================== --}}
            <div class="rejected-card resubmit-card">

                <div class="rejected-card-header">

                    <div class="section-icon purple">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>

                    <div>

                        <h3>Resubmit Thesis</h3>

                        <p>
                            Update your thesis information and submit it again.
                        </p>

                    </div>

                </div>


                <div class="rejected-card-body">

                    <form action="{{ route('student.thesis_requests.resubmit', $thesisRequest) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')


                        {{-- =================================================
                            FORM GRID
                        ================================================== --}}
                        <div class="rejected-form-grid">


                            {{-- =================================================
                                TITLE
                            ================================================== --}}
                            <div class="rejected-form-group">

                                <label class="rejected-form-label">
                                    Thesis Title
                                    <span>*</span>
                                </label>

                                <input type="text" name="title" value="{{ old('title', $thesisRequest->title) }}"
                                    required class="rejected-form-control" placeholder="Enter thesis title">

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
                                    <span>*</span>
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
                                    <span>*</span>
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
                                    <span>*</span>
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


                                        <a href="{{ asset('storage/' . $thesisRequest->pdf_file) }}" target="_blank"
                                            class="view-pdf-button">

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
                        <div class="form-divider"></div>


                        {{-- =================================================
                            BUTTONS
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


    <style>
        /* =========================================================
           REJECTED THESIS PAGE
           Clean Centered Design
           Light + Dark Mode
        ========================================================= */

        .rejected-thesis-page {

            --rt-purple: #6538d9;
            --rt-purple-dark: #5030b8;
            --rt-purple-light: #eee8ff;

            --rt-bg: #f7f7fa;
            --rt-card: #ffffff;
            --rt-border: #e7e7ef;

            --rt-text: #171a2f;
            --rt-muted: #70758e;

            min-height: 100vh;

            background: var(--rt-bg);

            color: var(--rt-text);

            padding: 30px 20px 50px;

            box-sizing: border-box;

        }


        /* =========================================================
           CENTERED CONTAINER
        ========================================================= */

        .rejected-thesis-container {

            width: 100%;

            max-width: 1100px;

            margin: 0 auto;

        }


        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .rejected-page-header {

            display: flex;

            align-items: center;

            gap: 14px;

            margin-bottom: 22px;

        }

        .rejected-header-icon {

            width: 48px;
            height: 48px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: var(--rt-purple);

            color: #ffffff;

            font-size: 20px;

            box-shadow:
                0 7px 18px rgba(101, 56, 217, 0.20);

        }

        .rejected-page-header h2 {

            margin: 0;

            font-size: 25px;

            font-weight: 750;

            letter-spacing: -0.025em;

            color: var(--rt-text);

        }

        .rejected-page-header p {

            margin: 5px 0 0;

            color: var(--rt-muted);

            font-size: 13px;

        }


        /* =========================================================
           ALERTS
        ========================================================= */

        .rejected-alert {

            display: flex;

            align-items: flex-start;

            gap: 11px;

            margin-bottom: 17px;

            padding: 14px 16px;

            border-radius: 9px;

            border: 1px solid transparent;

            font-size: 12px;

            line-height: 1.6;

        }

        .rejected-alert-icon {

            flex-shrink: 0;

            font-size: 16px;

        }

        .rejected-alert ul {

            margin: 6px 0 0;

            padding-left: 18px;

        }

        .rejected-alert-danger {

            background: #fff0f0;

            border-color: #ffd1d1;

            color: #d83232;

        }

        .rejected-alert-success {

            background: #ebf9f0;

            border-color: #c9ecd7;

            color: #188650;

        }


        /* =========================================================
           REJECTED MESSAGE
        ========================================================= */

        .rejected-message {

            display: flex;

            align-items: flex-start;

            gap: 13px;

            margin-bottom: 20px;

            padding: 17px;

            background: #fff6f6;

            border: 1px solid #ffdada;

            border-left: 4px solid #d83232;

            border-radius: 10px;

        }

        .rejected-message-icon {

            width: 38px;
            height: 38px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #ffe3e3;

            color: #d83232;

            font-size: 17px;

        }

        .rejected-message h3 {

            margin: 0 0 5px;

            color: #c52c2c;

            font-size: 14px;

            font-weight: 700;

        }

        .rejected-message p {

            margin: 0;

            color: #8d4b4b;

            font-size: 12px;

            line-height: 1.6;

        }


        /* =========================================================
           CARD
        ========================================================= */

        .rejected-card {

            margin-bottom: 20px;

            background: var(--rt-card);

            border: 1px solid var(--rt-border);

            border-radius: 12px;

            overflow: hidden;

            box-shadow:
                0 4px 18px rgba(25, 25, 55, 0.055);

        }


        /* =========================================================
           CARD HEADER
        ========================================================= */

        .rejected-card-header {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 17px 21px;

            background: linear-gradient(135deg,
                    #f5f0ff 0%,
                    #fbfaff 100%);

            border-bottom: 1px solid #ece7fa;

        }

        .section-icon {

            width: 40px;
            height: 40px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 10px;

            font-size: 17px;

        }

        .section-icon.purple {

            background: var(--rt-purple-light);

            color: var(--rt-purple);

        }

        .rejected-card-header h3 {

            margin: 0;

            color: #191d3c;

            font-size: 15px;

            font-weight: 700;

        }

        .rejected-card-header p {

            margin: 3px 0 0;

            color: #777d9b;

            font-size: 10px;

        }


        /* =========================================================
           CARD BODY
        ========================================================= */

        .rejected-card-body {

            padding: 24px;

        }


        /* =========================================================
           FEEDBACK
        ========================================================= */

        .feedback-box {

            display: flex;

            align-items: flex-start;

            gap: 12px;

            padding: 16px;

            background: #fff5f5;

            border: 1px solid #ffdcdc;

            border-left: 4px solid #d83232;

            border-radius: 9px;

        }

        .feedback-icon {

            width: 34px;
            height: 34px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: #ffe1e1;

            color: #d83232;

            font-size: 15px;

        }

        .feedback-text {

            flex: 1;

            color: #4f536a;

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

            background: #fafafd;

            border: 1px solid #eeeef4;

            border-radius: 9px;

            color: #777d9b;

            font-size: 12px;

        }

        .no-feedback i {

            color: var(--rt-purple);

            font-size: 16px;

        }


        /* =========================================================
           FORM GRID
           
           Desktop:
           Title       | Author
           Abstract    | Description
           Current PDF | Replace PDF
           
           Mobile:
           Everything becomes one column.
        ========================================================= */

        .rejected-form-grid {

            display: grid;

            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 0 22px;

        }


        .rejected-form-group {

            min-width: 0;

            margin-bottom: 20px;

        }


        .rejected-form-wide {

            min-width: 0;

        }


        /* =========================================================
           FORM LABEL
        ========================================================= */

        .rejected-form-label {

            display: block;

            margin-bottom: 8px;

            color: var(--rt-text);

            font-size: 12px;

            font-weight: 650;

        }

        .rejected-form-label>span:first-of-type {

            color: #d83232;

        }

        .optional-label {

            color: #8b8fa5 !important;

            font-weight: 400;

            margin-left: 3px;

        }


        /* =========================================================
           INPUTS
        ========================================================= */

        .rejected-form-control {

            display: block;

            width: 100%;

            min-height: 45px;

            padding: 10px 13px;

            background: #ffffff;

            color: var(--rt-text);

            border: 1px solid #dcdce6;

            border-radius: 8px;

            outline: none;

            font-family: inherit;

            font-size: 13px;

            box-sizing: border-box;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;

        }

        .rejected-form-control:hover {

            border-color: #c8c3db;

        }

        .rejected-form-control:focus {

            border-color: var(--rt-purple);

            background: #ffffff;

            color: var(--rt-text);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, 0.11);

        }

        .rejected-form-control::placeholder {

            color: #a1a5b8;

        }


        /* =========================================================
           TEXTAREA
        ========================================================= */

        .rejected-textarea {

            min-height: 165px;

            resize: vertical;

            line-height: 1.7;

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

            padding: 7px 13px;

            border: 0;

            border-radius: 6px;

            background: var(--rt-purple-light);

            color: var(--rt-purple);

            font-size: 11px;

            font-weight: 650;

            cursor: pointer;

            transition: background 0.2s ease;

        }

        .rejected-file-input::file-selector-button:hover {

            background: #e0d6ff;

        }


        /* =========================================================
           CURRENT PDF
        ========================================================= */

        .current-pdf-box {

            min-height: 45px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 12px;

            padding: 8px 9px;

            background: #fafafd;

            border: 1px solid #eeeef4;

            border-radius: 9px;

            box-sizing: border-box;

        }

        .current-pdf-info {

            display: flex;

            align-items: center;

            gap: 9px;

            min-width: 0;

        }

        .pdf-icon {

            width: 38px;
            height: 38px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: #ffe9e9;

            color: #d83232;

            font-size: 17px;

        }

        .pdf-details {

            min-width: 0;

        }

        .pdf-details strong {

            display: block;

            max-width: 100%;

            color: #252a47;

            font-size: 11px;

            font-weight: 700;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

        }

        .pdf-details span {

            display: block;

            margin-top: 3px;

            color: #777d9b;

            font-size: 9px;

        }


        /* =========================================================
           VIEW PDF
        ========================================================= */

        .view-pdf-button {

            min-height: 36px;

            padding: 0 12px;

            flex-shrink: 0;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 6px;

            background: var(--rt-purple);

            color: #ffffff;

            border-radius: 7px;

            font-size: 10px;

            font-weight: 650;

            text-decoration: none;

            white-space: nowrap;

            transition:
                background 0.2s ease,
                transform 0.2s ease;

        }

        .view-pdf-button:hover {

            background: var(--rt-purple-dark);

            color: #ffffff;

            transform: translateY(-1px);

        }


        /* =========================================================
           NO PDF
        ========================================================= */

        .no-pdf-box {

            min-height: 45px;

            display: flex;

            align-items: center;

            gap: 8px;

            padding: 10px 12px;

            background: #fff8e8;

            border: 1px solid #ffe4a8;

            border-radius: 8px;

            color: #a86b00;

            font-size: 11px;

            box-sizing: border-box;

        }


        /* =========================================================
           FILE HELP
        ========================================================= */

        .file-help {

            display: flex;

            align-items: flex-start;

            gap: 6px;

            margin-top: 6px;

            color: #777d9b;

            font-size: 10px;

            line-height: 1.5;

        }

        .file-help i {

            flex-shrink: 0;

            color: var(--rt-purple);

        }


        /* =========================================================
           FIELD ERROR
        ========================================================= */

        .field-error {

            display: flex;

            align-items: flex-start;

            gap: 5px;

            margin: 6px 0 0;

            color: #d83232;

            font-size: 11px;

            line-height: 1.4;

        }


        /* =========================================================
           DIVIDER
        ========================================================= */

        .form-divider {

            height: 1px;

            margin: 3px 0 20px;

            background: var(--rt-border);

        }


        /* =========================================================
           BUTTONS
        ========================================================= */

        .rejected-form-actions {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 12px;

        }

        .rejected-btn {

            min-height: 42px;

            padding: 0 17px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            border-radius: 8px;

            font-family: inherit;

            font-size: 12px;

            font-weight: 650;

            text-decoration: none;

            cursor: pointer;

            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;

        }

        .rejected-btn:hover {

            transform: translateY(-1px);

        }


        /* =========================================================
           BACK
        ========================================================= */

        .rejected-btn-back {

            background: #f1f1f5;

            border: 1px solid #e2e2ea;

            color: #555b76;

        }

        .rejected-btn-back:hover {

            background: #e8e8ef;

            border-color: #d6d6e0;

            color: #333952;

        }


        /* =========================================================
           SUBMIT
        ========================================================= */

        .rejected-btn-submit {

            background: var(--rt-purple);

            border: 1px solid var(--rt-purple);

            color: #ffffff;

            box-shadow:
                0 6px 15px rgba(101, 56, 217, 0.18);

        }

        .rejected-btn-submit:hover {

            background: var(--rt-purple-dark);

            border-color: var(--rt-purple-dark);

            color: #ffffff;

            box-shadow:
                0 8px 18px rgba(101, 56, 217, 0.24);

        }


        /* =========================================================
           DARK MODE
        ========================================================= */

        [data-bs-theme="dark"] .rejected-thesis-page {

            --rt-bg: #101426;

            --rt-card: #181d33;

            --rt-border: #292e45;

            --rt-text: #f4f4fb;

            --rt-muted: #999fb9;

        }


        [data-bs-theme="dark"] .rejected-page-header h2 {

            color: #ffffff;

        }

        [data-bs-theme="dark"] .rejected-page-header p {

            color: #999fb9;

        }


        [data-bs-theme="dark"] .rejected-card {

            background: #181d33;

            border-color: #292e45;

        }


        [data-bs-theme="dark"] .rejected-card-header {

            background: linear-gradient(135deg,
                    #211d3b 0%,
                    #1c2036 100%);

            border-bottom-color: #302b4b;

        }

        [data-bs-theme="dark"] .rejected-card-header h3 {

            color: #ffffff;

        }

        [data-bs-theme="dark"] .rejected-card-header p {

            color: #999fb9;

        }


        [data-bs-theme="dark"] .rejected-form-label {

            color: #f1f1f8;

        }


        [data-bs-theme="dark"] .rejected-form-control {

            background: #20253a;

            border-color: #343a52;

            color: #f4f4fb;

        }

        [data-bs-theme="dark"] .rejected-form-control:hover {

            border-color: #484e69;

        }

        [data-bs-theme="dark"] .rejected-form-control:focus {

            background: #20253a;

            border-color: var(--rt-purple);

            color: #ffffff;

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, 0.20);

        }

        [data-bs-theme="dark"] .rejected-form-control::placeholder {

            color: #777d98;

        }


        [data-bs-theme="dark"] .feedback-box {

            background: #321f27;

            border-color: #4e2a34;

            border-left-color: #e24444;

        }

        [data-bs-theme="dark"] .feedback-icon {

            background: #4a2932;

            color: #ff7777;

        }

        [data-bs-theme="dark"] .feedback-text {

            color: #c2c5d3;

        }


        [data-bs-theme="dark"] .no-feedback {

            background: #20253a;

            border-color: #292e45;

            color: #999fb9;

        }


        [data-bs-theme="dark"] .current-pdf-box {

            background: #20253a;

            border-color: #292e45;

        }

        [data-bs-theme="dark"] .pdf-details strong {

            color: #ffffff;

        }

        [data-bs-theme="dark"] .pdf-details span {

            color: #999fb9;

        }


        [data-bs-theme="dark"] .file-help {

            color: #999fb9;

        }


        [data-bs-theme="dark"] .form-divider {

            background: #292e45;

        }


        [data-bs-theme="dark"] .rejected-btn-back {

            background: #252a40;

            border-color: #343a52;

            color: #c3c6d5;

        }

        [data-bs-theme="dark"] .rejected-btn-back:hover {

            background: #2d3249;

            border-color: #41475f;

            color: #ffffff;

        }


        [data-bs-theme="dark"] .rejected-message {

            background: #321f27;

            border-color: #4e2a34;

            border-left-color: #e24444;

        }

        [data-bs-theme="dark"] .rejected-message-icon {

            background: #4a2932;

            color: #ff7777;

        }

        [data-bs-theme="dark"] .rejected-message h3 {

            color: #ff7777;

        }

        [data-bs-theme="dark"] .rejected-message p {

            color: #c2a2a8;

        }


        [data-bs-theme="dark"] .rejected-alert-danger {

            background: #351e26;

            border-color: #5a2d36;

            color: #ff7b7b;

        }

        [data-bs-theme="dark"] .rejected-alert-success {

            background: #183326;

            border-color: #28543c;

            color: #62d895;

        }


        [data-bs-theme="dark"] .rejected-file-input::file-selector-button {

            background: #2a2350;

            color: #bba8ff;

        }

        [data-bs-theme="dark"] .rejected-file-input::file-selector-button:hover {

            background: #332a60;

        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 900px) {

            .rejected-thesis-page {

                padding: 25px 16px 40px;

            }

            .rejected-thesis-container {

                max-width: 100%;

            }

            .rejected-card-body {

                padding: 21px;

            }

        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 700px) {

            .rejected-thesis-page {

                padding: 20px 12px 35px;

            }


            .rejected-page-header {

                align-items: flex-start;

                margin-bottom: 18px;

            }

            .rejected-header-icon {

                width: 42px;

                height: 42px;

                font-size: 18px;

            }

            .rejected-page-header h2 {

                font-size: 20px;

            }

            .rejected-page-header p {

                font-size: 11px;

                line-height: 1.5;

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


            .rejected-card-header {

                padding: 14px 15px;

            }

            .section-icon {

                width: 37px;

                height: 37px;

                font-size: 15px;

            }

            .rejected-card-header h3 {

                font-size: 14px;

            }

            .rejected-card-header p {

                font-size: 9px;

            }


            .rejected-card-body {

                padding: 18px 15px;

            }


            /* One column on mobile */

            .rejected-form-grid {

                grid-template-columns: 1fr;

                gap: 0;

            }


            .rejected-form-group {

                margin-bottom: 17px;

            }


            .rejected-textarea {

                min-height: 140px;

            }


            .feedback-box {

                padding: 13px;

            }

            .feedback-text {

                font-size: 12px;

                line-height: 1.7;

            }


            .current-pdf-box {

                flex-direction: column;

                align-items: stretch;

                gap: 10px;

            }

            .view-pdf-button {

                width: 100%;

            }


            .rejected-form-actions {

                flex-direction: column-reverse;

                align-items: stretch;

                gap: 8px;

            }

            .rejected-btn {

                width: 100%;

                min-height: 43px;

            }


            .rejected-alert {

                font-size: 11px;

            }

        }


        /* =========================================================
           VERY SMALL MOBILE
        ========================================================= */

        @media (max-width: 380px) {

            .rejected-thesis-page {

                padding-left: 9px;

                padding-right: 9px;

            }

            .rejected-card-body {

                padding: 15px 12px;

            }

            .rejected-card-header {

                padding: 13px;

            }

            .rejected-page-header h2 {

                font-size: 18px;

            }

            .rejected-form-control {

                font-size: 12px;

            }

        }
    </style>

</x-app-layout>
