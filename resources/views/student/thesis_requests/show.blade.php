<x-app-layout>
    <div class="dashboard-content thesis-show-page">

        @if (session('success'))
            <div class="thesis-alert thesis-alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="thesis-alert thesis-alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        {{-- 
        @php
            $isApprovedThesisRequest = $thesisRequest && strtolower($thesisRequest->status ?? '') === 'approved';
        @endphp --}}


        <div class="thesis-show-card">
            <div class="thesis-show-header">
                <div class="thesis-show-header-content">
                    <span class="thesis-show-overline">
                        THESIS REQUEST #{{ $thesisRequest->id }}
                    </span>
                    <div class="thesis-show-title-row">
                        <div class="thesis-show-title-icon">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <h1 class="thesis-show-title">
                            {{ $thesisRequest->title }}
                        </h1>
                    </div>
                    <p class="thesis-show-subtitle">
                        Approved thesis request available in the Digital Thesis Repository.
                    </p>
                </div>

                <div class="thesis-show-status-wrapper">
                    @php
                        $status = strtolower($thesisRequest->status ?? 'pending');
                    @endphp

                    <span class="thesis-show-status status-{{ $status }}">
                        @if ($status === 'approved')
                            <i class="bi bi-check-circle-fill"></i>
                        @elseif ($status === 'rejected')
                            <i class="bi bi-x-circle-fill"></i>
                        @else
                            <i class="bi bi-clock-fill"></i>
                        @endif

                        {{ ucfirst($status) }}
                    </span>
                    {{-- <span class="thesis-show-status status-approved">
                            <i class="bi bi-check-circle-fill"></i>
                            Approved
                        </span> --}}
                </div>
            </div>

            <div class="thesis-show-content-section">
                <div class="thesis-section-heading">
                    <div class="thesis-section-heading-icon">
                        <i class="bi bi-info-circle-fill"></i>
                    </div>
                    <div>
                        <h2>Thesis Request Information</h2>
                        <p>General information about this thesis request.</p>
                    </div>
                </div>

                <div class="thesis-information-form">
                    <div class="thesis-form-group">
                        <span class="thesis-form-label">Title</span>
                        <div class="thesis-form-control">
                            {{ $thesisRequest->title ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="thesis-form-group">
                        <span class="thesis-form-label">Author</span>
                        <div class="thesis-form-control">
                            {{ $thesisRequest->author_name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="thesis-form-group">
                        <span class="thesis-form-label">Department</span>
                        <div class="thesis-form-control">
                            {{ $thesisRequest->department?->name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="thesis-form-group">
                        <span class="thesis-form-label">Submitted By</span>
                        <div class="thesis-form-control">
                            {{ $thesisRequest->user?->name ?? ($thesisRequest->user?->username ?? ($thesisRequest->author_name ?? 'N/A')) }}
                        </div>
                    </div>

                    <div class="thesis-form-group">
                        <span class="thesis-form-label">Submitted At</span>
                        <div class="thesis-form-control">
                            {{ $thesisRequest->submitted_at
                                ? \Carbon\Carbon::parse($thesisRequest->submitted_at)->format('d M Y, h:i A')
                                : 'N/A' }}
                        </div>
                    </div>

                    <div class="thesis-form-group">
                        <span class="thesis-form-label">Reviewed By</span>
                        <div class="thesis-form-control">
                            {{ $thesisRequest->reviewer?->name ?? ($thesisRequest->reviewer?->username ?? 'N/A') }}
                        </div>
                    </div>

                    <div class="thesis-form-group">
                        <span class="thesis-form-label">Reviewed At</span>
                        <div class="thesis-form-control">
                            {{ $thesisRequest->reviewed_at
                                ? \Carbon\Carbon::parse($thesisRequest->reviewed_at)->format('d M Y, h:i A')
                                : 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="thesis-show-content-section">
                <div class="thesis-section-heading">
                    <div class="thesis-section-heading-icon">
                        <i class="bi bi-file-text-fill"></i>
                    </div>
                    <div>
                        <h2>Abstract</h2>
                        <p>Abstract submitted with this thesis request.</p>
                    </div>
                </div>
                <div class="thesis-text-content">
                    {{ $thesisRequest->abstract ?? 'No abstract provided.' }}
                </div>
            </div>

            <div class="thesis-show-content-section">
                <div class="thesis-section-heading">
                    <div class="thesis-section-heading-icon">
                        <i class="bi bi-card-text"></i>
                    </div>
                    <div>
                        <h2>Description</h2>
                        <p>Description submitted with this thesis request.</p>
                    </div>
                </div>
                <div class="thesis-text-content">
                    {{ $thesisRequest->description ?? 'No description provided.' }}
                </div>
            </div>

            <div class="thesis-show-content-section">
                {{-- <div class="thesis-section-heading">
                    <div class="thesis-section-heading-icon thesis-document-icon">
                        <i class="bi bi-file-earmark-pdf-fill"></i>
                    </div>
                    <div>
                        <h2>Thesis Document</h2>
                        <p>Official PDF submitted with this approved thesis request.</p>
                    </div>
                </div> --}}
                <div class="thesis-document-box">
                    <div class="thesis-document-left">
                        <div class="thesis-document-file-icon">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </div>
                        <div class="thesis-document-details">
                            <strong>Thesis Request PDF</strong>
                            {{-- <span>
                                Official thesis document from the approved request
                            </span> --}}
                        </div>
                    </div>
                    <div class="thesis-document-actions">
                        <a href="#thesis-request-pdf-preview" class="thesis-view-pdf-button" id="viewPdfButton">
                            <i class="bi bi-file-earmark-pdf">PDF</i> 
                        </a>
                    </div>
                </div>
                <div class="thesis-pdf-preview-box" id="thesis-request-pdf-preview">
                    <div class="thesis-pdf-preview-header">
                        <div class="thesis-pdf-preview-title">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                            <span>PDF Preview</span>
                        </div>
                        <div class="thesis-pdf-preview-header-actions">
                            @php
                                $status = strtolower($thesisRequest->status ?? 'pending');
                            @endphp

                            <span class="thesis-show-status status-{{ $status }}">
                                @if ($status === 'approved')
                                    <i class="bi bi-check-circle-fill"></i>
                                @elseif ($status === 'rejected')
                                    <i class="bi bi-x-circle-fill"></i>
                                @else
                                    <i class="bi bi-clock-fill"></i>
                                @endif

                                {{ ucfirst($status) }}
                            </span>

                            <button type="button" class="thesis-pdf-close-button" id="closePdfButton">
                                <i class="bi bi-x-lg"></i>
                                Close
                            </button>
                        </div>
                    </div>
                    <div class="thesis-pdf-frame-wrapper">
                        <iframe src="{{ route('student.thesis_requests.view-request-pdf', $thesisRequest) }}"
                            title="Thesis Request PDF Preview" class="thesis-pdf-frame"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .thesis-show-status.status-pending {
            background: #fff7d6;
            color: #b7791f;
            border: 1px solid #f6d365;
        }

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
            --thesis-green: #198754;
            --thesis-red: #dc3545;
            --thesis-border: #eeeeee;
            --thesis-shadow: 0 4px 18px rgba(35, 20, 65, .07);
            color: var(--thesis-text);
            box-sizing: border-box;
        }

        .thesis-show-page *,
        .thesis-show-page *::before,
        .thesis-show-page *::after {
            box-sizing: border-box;
        }

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

        .thesis-show-card {
            width: 100%;
            padding: 22px;
            background: var(--thesis-card);
            border: none !important;
            border-radius: 14px;
            box-shadow: var(--thesis-shadow);
            transition: background-color .25s ease, box-shadow .25s ease;
        }

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

        .publisher-role {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: .65rem;
            font-weight: 700;
        }

        .publisher-hod {
            color: var(--thesis-green);
        }

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

        .thesis-document-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            flex-shrink: 0;
        }

        .thesis-view-pdf-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 36px;
            padding: 7px 12px;
            color: var(--thesis-red) !important;
            background: transparent;
            border: 1px solid var(--thesis-red) !important;
            border-radius: 7px;
            text-decoration: none;
            font-size: .61rem;
            font-weight: 700;
            white-space: nowrap;
            transition: color .2s ease, background-color .2s ease,
                border-color .2s ease, transform .2s ease;
        }

        .thesis-view-pdf-button:hover {
            color: #ffffff !important;
            background: var(--thesis-red);
            border-color: var(--thesis-red) !important;
            transform: translateY(-1px);
        }

        .thesis-pdf-preview-box {
            display: none;
            width: 100%;
            margin-top: 15px;
            overflow: hidden;
            background: #ffffff;
            border: 1px solid var(--thesis-border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .04);
            scroll-margin-top: 20px;
        }

        .thesis-pdf-preview-box.pdf-preview-visible {
            display: block;
        }

        .thesis-pdf-preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            min-height: 44px;
            padding: 9px 12px;
            background: var(--thesis-soft);
            border-bottom: 1px solid var(--thesis-border);
        }

        .thesis-pdf-preview-title {
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--thesis-text);
            font-size: .65rem;
            font-weight: 800;
        }

        .thesis-pdf-preview-title i {
            color: var(--thesis-red);
            font-size: .85rem;
        }

        .thesis-pdf-preview-header-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            flex-shrink: 0;
        }

        .thesis-pdf-preview-status {
            padding: 4px 8px;
            color: var(--thesis-green);
            background: #eaf7ef;
            border-radius: 999px;
            font-size: .55rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .thesis-pdf-close-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 28px;
            padding: 5px 9px;
            color: var(--thesis-text);
            background: #ffffff;
            border: 1px solid var(--thesis-border);
            border-radius: 6px;
            font-family: inherit;
            font-size: .58rem;
            font-weight: 700;
            cursor: pointer;
            transition: color .2s ease, background-color .2s ease,
                border-color .2s ease, transform .2s ease;
        }

        .thesis-pdf-close-button:hover {
            color: #ffffff;
            background: var(--thesis-text);
            border-color: var(--thesis-text);
            transform: translateY(-1px);
        }

        .thesis-pdf-frame-wrapper {
            width: 100%;
            height: 620px;
            background: #ffffff;
        }

        .thesis-pdf-frame {
            display: block;
            width: 100%;
            height: 100%;
            border: 0;
            background: #ffffff;
        }

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

        [data-bs-theme="dark"] .thesis-show-page {
            --thesis-black: #ffffff;
            --thesis-text: #eeeef8;
            --thesis-muted: #999fb9;
            --thesis-card: #181d33;
            --thesis-soft: #20253a;
            --thesis-soft-purple: #292342;
            --thesis-purple: #7c5ce3;
            --thesis-blue: #60a5fa;
            --thesis-green: #2fbf71;
            --thesis-red: #ff6470;
            --thesis-border: #292e45;
            --thesis-shadow: 0 4px 18px rgba(0, 0, 0, .35);
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

        [data-bs-theme="dark"] .thesis-show-card,
        [data-bs-theme="dark"] .thesis-empty-state {
            background: #181d33;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .35);
        }

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

        [data-bs-theme="dark"] .thesis-show-title,
        [data-bs-theme="dark"] .thesis-section-heading h2,
        [data-bs-theme="dark"] .thesis-empty-state h2 {
            color: #ffffff;
        }

        [data-bs-theme="dark"] .thesis-show-subtitle,
        [data-bs-theme="dark"] .thesis-section-heading p,
        [data-bs-theme="dark"] .thesis-document-details span,
        [data-bs-theme="dark"] .thesis-empty-state p {
            color: #999fb9;
        }

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

        [data-bs-theme="dark"] .status-approved {
            color: #9de2bb;
            background: #19352a;
        }

        [data-bs-theme="dark"] .thesis-form-label {
            color: #d5d8e8;
        }

        [data-bs-theme="dark"] .thesis-form-control,
        [data-bs-theme="dark"] .thesis-text-content,
        [data-bs-theme="dark"] .thesis-document-box {
            color: #ffffff;
            background: #20253a;
        }

        [data-bs-theme="dark"] .thesis-form-control:hover {
            background: #252b42;
        }

        [data-bs-theme="dark"] .thesis-text-content {
            color: #d5d8e8;
        }

        [data-bs-theme="dark"] .publisher-hod {
            color: #6ee7a5;
        }

        [data-bs-theme="dark"] .thesis-document-file-icon {
            color: #ff9da5;
            background: #3a2028;
        }

        [data-bs-theme="dark"] .thesis-document-details strong {
            color: #ffffff;
        }

        [data-bs-theme="dark"] .thesis-pdf-preview-box {
            background: #181d33;
            border-color: #292e45;
        }

        [data-bs-theme="dark"] .thesis-pdf-preview-header {
            background: #20253a;
            border-bottom-color: #292e45;
        }

        [data-bs-theme="dark"] .thesis-pdf-preview-title {
            color: #ffffff;
        }

        [data-bs-theme="dark"] .thesis-pdf-preview-status {
            color: #9de2bb;
            background: #19352a;
        }

        [data-bs-theme="dark"] .thesis-pdf-close-button {
            color: #eeeef8;
            background: #181d33;
            border-color: #292e45;
        }

        [data-bs-theme="dark"] .thesis-pdf-close-button:hover {
            color: #181d33;
            background: #eeeef8;
            border-color: #eeeef8;
        }

        [data-bs-theme="dark"] .thesis-pdf-frame-wrapper,
        [data-bs-theme="dark"] .thesis-pdf-frame {
            background: #111827;
        }

        [data-bs-theme="dark"] .thesis-view-pdf-button {
            color: #ff6470 !important;
            border-color: #ff6470 !important;
        }

        [data-bs-theme="dark"] .thesis-view-pdf-button:hover {
            color: #ffffff !important;
            background: #dc3545;
            border-color: #dc3545 !important;
        }

        [data-bs-theme="dark"] .thesis-empty-icon {
            color: #ffffff;
            background: #7c5ce3;
        }

        @media (max-width: 900px) {
            .thesis-information-form {
                grid-template-columns: 1fr;
                gap: 12px;
            }
        }

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

            .thesis-document-box {
                align-items: flex-start;
                flex-direction: column;
            }

            .thesis-document-actions {
                width: 100%;
            }

            .thesis-view-pdf-button {
                width: 100%;
            }

            .thesis-pdf-frame-wrapper {
                height: 500px;
            }
        }

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

            .thesis-view-pdf-button {
                min-height: 34px;
                padding: 7px 8px;
                font-size: .57rem;
            }

            .thesis-pdf-preview-header {
                min-height: 40px;
                padding: 8px 9px;
            }

            .thesis-pdf-preview-title {
                font-size: .59rem;
            }

            .thesis-pdf-preview-header-actions {
                gap: 5px;
            }

            .thesis-pdf-preview-status {
                padding: 3px 6px;
                font-size: .5rem;
            }

            .thesis-pdf-close-button {
                min-height: 26px;
                padding: 4px 7px;
                font-size: .5rem;
            }

            .thesis-pdf-frame-wrapper {
                height: 420px;
            }
        }

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

            .thesis-pdf-preview-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .thesis-pdf-preview-header-actions {
                width: 100%;
                justify-content: space-between;
            }

            .thesis-pdf-frame-wrapper {
                height: 380px;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .thesis-show-page *,
            .thesis-show-page *::before,
            .thesis-show-page *::after {
                transition: none !important;
                animation: none !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewPdfButton = document.getElementById('viewPdfButton');
            const closePdfButton = document.getElementById('closePdfButton');
            const pdfPreview = document.getElementById('thesis-request-pdf-preview');

            if (viewPdfButton && pdfPreview) {
                viewPdfButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    pdfPreview.classList.add('pdf-preview-visible');
                    setTimeout(function() {
                        pdfPreview.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }, 50);
                });
            }

            if (closePdfButton && pdfPreview) {
                closePdfButton.addEventListener('click', function() {
                    pdfPreview.classList.remove('pdf-preview-visible');
                    setTimeout(function() {
                        viewPdfButton.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 50);
                });
            }
        });
    </script>
</x-app-layout>
