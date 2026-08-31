<x-app-layout>

    <div class="dashboard-content my-theses-page">
        <div class="dashboard-main mt-4">

            {{-- PAGE HEADER --}}
            <div class="page-header">
                <div class="page-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                    <div>
                        <h2 class="page-title">My Theses</h2>
                        <p class="page-subtitle">Theses available from your department.</p>
                    </div>
                </div>
            </div>

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div class="custom-alert alert-success alert-dismissible fade show" role="alert">
                    <div class="alert-icon"><i class="bi bi-check-lg"></i></div>
                    <div class="alert-content">
                        <strong>Success</strong>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- ERROR MESSAGE --}}
            @if (session('error'))
                <div class="custom-alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="alert-icon"><i class="bi bi-exclamation-lg"></i></div>
                    <div class="alert-content">
                        <strong>Error</strong>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- THESES LIST --}}
            @if ($theses->count())
                <div class="thesis-list">
                    @foreach ($theses as $thesis)
                        <div class="thesis-row">

                            {{-- NUMBER --}}
                            <div class="thesis-number">{{ $loop->iteration }}</div>

                            {{-- TITLE + META --}}
                            <div class="thesis-main">
                                <span class="thesis-title" title="{{ $thesis->title }}">
                                    {{ $thesis->title }}
                                </span>

                                <span class="thesis-meta">
                                    <i class="bi bi-person-fill"></i>
                                    {{ $thesis->author_name }}

                                    <span class="dot">&bull;</span>

                                    <i class="bi bi-calendar3"></i>
                                    {{ optional($thesis->published_at)->format('d M Y') ?? 'Not published' }}

                                    <span class="dot">&bull;</span>

                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                    {{ $thesis->files->count() }} {{ Str::plural('file', $thesis->files->count()) }}
                                </span>
                            </div>

                            {{-- STATUS --}}
                            @if ($thesis->published_at)
                                <span class="status-badge status-published">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Published
                                </span>
                            @else
                                <span class="status-badge status-unpublished">
                                    <i class="bi bi-clock-fill"></i>
                                    Not published
                                </span>
                            @endif

                            {{-- FILE ACTIONS --}}
                            <div class="thesis-actions">
                                @forelse ($thesis->files as $file)
                                    <a href="{{ route('student.thesis.view-pdf', $file) }}" target="_blank"
                                        rel="noopener" class="view-file-button" title="{{ $file->file_name }}"
                                        aria-label="View {{ $file->file_name }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                @empty
                                    <span class="no-file-badge" title="No file available">
                                        <i class="bi bi-file-earmark-x"></i>
                                    </span>
                                @endforelse
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                {{-- EMPTY STATE --}}
                <div class="empty-thesis-state">
                    <div class="empty-icon">
                        <i class="bi bi-journal-x"></i>
                    </div>
                    <h3>No theses found</h3>
                    <p>There are currently no theses available for your department.</p>
                </div>
            @endif

        </div>
    </div>

    <style>
        /* =========================================================
           MY THESES PAGE
           Compact single-line rows, matches dashboard design
        ========================================================= */

        .my-theses-page {
            min-height: 100vh;
        }

        /* ==================== PAGE HEADER ==================== */
        .page-header {
            margin-bottom: 22px;
        }

        .page-heading {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .page-title-icon {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: var(--dashboard-purple);
            color: white;
            font-size: 20px;
            box-shadow: 0 7px 18px rgba(101, 56, 217, 0.25);
        }

        .page-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .page-subtitle {
            margin: 6px 0 0;
            color: var(--text-muted);
            font-size: 14px;
        }

        /* ==================== ALERT ==================== */
        .custom-alert {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding: 14px 16px;
            border: 1px solid var(--border-color);
            border-radius: 11px;
            background: var(--card-bg);
            box-shadow: var(--shadow);
        }

        .alert-icon {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            font-size: 15px;
        }

        .alert-content {
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding-right: 30px;
        }

        .alert-content strong {
            font-size: 13px;
            font-weight: 700;
        }

        .alert-content span {
            margin-top: 1px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .alert-success .alert-icon {
            background: #e6f7ed;
            color: #188650;
        }

        .alert-danger .alert-icon {
            background: #ffe9e9;
            color: #d83232;
        }

        .custom-alert .btn-close {
            position: absolute;
            right: 14px;
            margin: 0;
        }

        /* ==================== THESIS LIST ==================== */
        .thesis-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* ==================== THESIS ROW (single line) ==================== */
        .thesis-row {
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 60px;
            padding: 10px 16px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 11px;
            box-shadow: var(--shadow);
            transition: border-color 0.2s ease, transform 0.2s ease;
        }

        .thesis-row:hover {
            border-color: #d9caf9;
            transform: translateY(-1px);
        }

        .thesis-number {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--dashboard-purple);
            color: white;
            font-size: 12px;
            font-weight: 700;
        }

        .thesis-main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .thesis-title {
            overflow: hidden;
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .thesis-meta {
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 5px;
            color: var(--text-muted);
            font-size: 12px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .thesis-meta i {
            font-size: 11px;
        }

        .thesis-meta .dot {
            margin: 0 2px;
            color: var(--border-color);
        }

        /* ==================== STATUS BADGE ==================== */
        .status-badge {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-published {
            background: #e6f7ed;
            color: #188650;
        }

        .status-unpublished {
            background: #fff0d8;
            color: #ed8c16;
        }

        /* ==================== FILE ACTIONS ==================== */
        .thesis-actions {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .view-file-button {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 8px;
            background: var(--dashboard-purple);
            color: white;
            font-size: 13px;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.15s ease;
        }

        .view-file-button:hover {
            background: var(--dashboard-purple-dark);
            color: white;
            transform: translateY(-1px);
        }

        .no-file-badge {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #ffe9e9;
            color: #d83232;
            font-size: 13px;
        }

        /* ==================== EMPTY STATE ==================== */
        .empty-thesis-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 320px;
            padding: 40px 20px;
            text-align: center;
            background: var(--card-bg);
            border: 1px dashed var(--border-color);
            border-radius: 11px;
        }

        .empty-icon {
            width: 68px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            border-radius: 50%;
            background: var(--page-bg);
            color: var(--text-muted);
            font-size: 26px;
        }

        .empty-thesis-state h3 {
            margin: 0 0 7px;
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .empty-thesis-state p {
            max-width: 420px;
            margin: 0;
            color: var(--text-muted);
            font-size: 13px;
            line-height: 1.6;
        }

        /* ==================== DARK MODE ==================== */
        [data-bs-theme="dark"] .thesis-row,
        [data-bs-theme="dark"] .custom-alert,
        [data-bs-theme="dark"] .empty-thesis-state {
            background: #181d33;
            border-color: #292e45;
        }

        [data-bs-theme="dark"] .empty-icon {
            background: #20253a;
        }

        [data-bs-theme="dark"] .thesis-row:hover {
            border-color: #3a3060;
        }

        [data-bs-theme="dark"] .page-title,
        [data-bs-theme="dark"] .thesis-title,
        [data-bs-theme="dark"] .empty-thesis-state h3 {
            color: white;
        }

        [data-bs-theme="dark"] .page-subtitle,
        [data-bs-theme="dark"] .thesis-meta,
        [data-bs-theme="dark"] .empty-thesis-state p {
            color: #999fb9;
        }

        [data-bs-theme="dark"] .thesis-meta .dot {
            color: #33394d;
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 768px) {
            .page-title-icon {
                width: 44px;
                height: 44px;
                font-size: 17px;
            }

            .page-title {
                font-size: 19px;
            }

            .page-subtitle {
                font-size: 13px;
            }

            .thesis-row {
                flex-wrap: wrap;
                gap: 8px 10px;
                padding: 10px 12px;
            }

            .thesis-main {
                min-width: 0;
                flex-basis: 100%;
                order: 1;
            }

            .thesis-number {
                order: 0;
            }

            .status-badge {
                order: 2;
            }

            .thesis-actions {
                order: 3;
                margin-left: auto;
            }

            .thesis-title {
                font-size: 13px;
                white-space: normal;
            }

            .thesis-meta {
                white-space: normal;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 480px) {
            .thesis-meta .dot {
                display: none;
            }

            .thesis-meta {
                gap: 3px 8px;
            }

            .view-file-button,
            .no-file-badge {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .thesis-row,
            .view-file-button {
                transition: none;
            }

            .thesis-row:hover,
            .view-file-button:hover {
                transform: none;
            }
        }
    </style>

</x-app-layout>
