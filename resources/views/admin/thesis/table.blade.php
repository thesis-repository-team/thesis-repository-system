@forelse($theses as $thesis)
    <div class="col-12 col-md-6 col-xl-4">

        <div class="card thesis-card h-100">

            {{-- =====================================================
                HEADER: BADGES
            ====================================================== --}}
            <div class="card-header thesis-card-header">

                <span class="thesis-badge thesis-badge-number">
                    #{{ $loop->iteration }}
                </span>

                @if ($thesis->published_at)
                    <span class="thesis-badge thesis-badge-published">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        Published
                    </span>
                @else
                    <span class="thesis-badge thesis-badge-unpublished">
                        <i class="bi bi-clock-history me-1"></i>
                        Not Published
                    </span>
                @endif

            </div>


            {{-- =====================================================
                BODY
            ====================================================== --}}
            <div class="card-body thesis-card-body">


                {{-- =================================================
                    TITLE
                ================================================== --}}
                <h5 class="thesis-title" title="{{ $thesis->title }}">

                    {{ $thesis->title }}

                </h5>


                {{-- =================================================
                    AUTHOR & DEPARTMENT
                ================================================== --}}
                <div class="thesis-author-box">

                    <div class="thesis-author-icon">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div class="thesis-author-info">

                        <div class="thesis-author-name text-truncate">
                            {{ $thesis->author_name }}
                        </div>

                        <div class="thesis-department text-truncate">

                            <i class="bi bi-building me-1"></i>

                            {{ $thesis->department->name ?? 'N/A' }}

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    META INFORMATION
                ================================================== --}}
                <div class="thesis-meta">


                    {{-- SUBMITTED BY --}}
                    <div class="thesis-meta-row">

                        <span class="thesis-meta-label">

                            <i class="bi bi-person-up thesis-icon-blue me-1"></i>

                            Submitted By

                        </span>

                        <span class="thesis-meta-value">

                            {{ $thesis->submittedBy->name ?? 'N/A' }}

                        </span>

                    </div>


                    {{-- PUBLISHED BY --}}
                    <div class="thesis-meta-row">

                        <span class="thesis-meta-label">

                            <i class="bi bi-person-check-fill thesis-icon-green me-1"></i>

                            Published By

                        </span>

                        <span class="thesis-meta-value">

                            {{ $thesis->publishedBy?->name ?? '—' }}

                        </span>

                    </div>


                    {{-- PUBLISHED AT --}}
                    <div class="thesis-meta-row">

                        <span class="thesis-meta-label">

                            <i class="bi bi-calendar3 thesis-icon-orange me-1"></i>

                            Published At

                        </span>

                        <span class="thesis-meta-value">

                            {{ $thesis->published_at ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y') : '—' }}

                        </span>

                    </div>


                </div>


                {{-- =================================================
                    ATTACHMENTS
                ================================================== --}}
                <div class="thesis-attachments">


                    {{-- ATTACHMENT HEADER --}}
                    <div class="thesis-attachments-header">

                        <span class="thesis-attachments-title">

                            <i class="bi bi-file-earmark-pdf thesis-icon-red me-1"></i>

                            Attachments

                        </span>


                        <span class="thesis-file-count">

                            {{ $thesis->files->count() }}

                            {{ Str::plural('file', $thesis->files->count()) }}

                        </span>

                    </div>


                    {{-- FILES --}}
                    @if ($thesis->files && $thesis->files->count())
                        <div class="thesis-file-list">

                            @foreach ($thesis->files as $file)
                                <div class="btn-group btn-group-sm thesis-file-buttons" role="group">


                                    {{-- VIEW BUTTON --}}
                                    <a href="{{ route('admin.thesis.view-pdf', $file) }}" target="_blank"
                                        class="btn thesis-btn thesis-btn-view">

                                        <i class="bi bi-eye"></i>

                                        <span>View</span>

                                    </a>


                                    {{-- DOWNLOAD BUTTON --}}
                                    <a href="{{ route('admin.thesis.download', $file) }}"
                                        class="btn thesis-btn thesis-btn-download">

                                        <i class="bi bi-download"></i>

                                        <span>Download</span>

                                    </a>


                                </div>
                            @endforeach

                        </div>
                    @else
                        {{-- NO FILES --}}
                        <div class="thesis-no-files">

                            <i class="bi bi-file-earmark-x me-1"></i>

                            No documents attached

                        </div>
                    @endif


                </div>

            </div>

        </div>

    </div>


@empty


    {{-- =============================================================
        EMPTY STATE
    ============================================================= --}}
    <div class="col-12">

        <div class="card thesis-empty-card">

            <div class="card-body thesis-empty-body">

                <div class="thesis-empty-icon">

                    <i class="bi bi-journal-x"></i>

                </div>

                <h5 class="thesis-empty-title">

                    No Thesis Found

                </h5>

                <p class="thesis-empty-text">

                    No theses match your current search or filter criteria.

                </p>

            </div>

        </div>

    </div>


@endforelse



{{-- ================================================================
    THESIS CARD CSS
    CARD = MONOCHROME
    BUTTONS / STATUS = SEMANTIC COLORS
    LIGHT + DARK MODE
================================================================ --}}

<style>
    /* =============================================================
       BASE CARD VARIABLES
    ============================================================= */

    .thesis-card,
    .thesis-empty-card {

        --thesis-bg: #ffffff;
        --thesis-surface: #f7f7f7;
        --thesis-surface-hover: #eeeeee;

        --thesis-border: #d6d6d6;
        --thesis-border-strong: #b5b5b5;

        --thesis-text: #111111;
        --thesis-muted: #666666;

        --thesis-icon-bg: #eeeeee;
        --thesis-icon-text: #111111;

        /* Semantic colors */
        --color-blue: #0d6efd;
        --color-blue-dark: #0a58ca;

        --color-green: #198754;
        --color-green-dark: #146c43;

        --color-red: #dc3545;
        --color-red-dark: #b02a37;

        --color-orange: #fd7e14;
        --color-orange-dark: #ca6510;

        --color-gray: #6c757d;
        --color-gray-dark: #5c636a;


        background-color: var(--thesis-bg);

        color: var(--thesis-text);

        border: 1px solid var(--thesis-border);

        border-radius: 18px;

        box-shadow:
            0 4px 16px rgba(0, 0, 0, 0.06);

        overflow: hidden;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease,
            transform 0.2s ease;
    }


    /* =============================================================
       CARD HOVER
    ============================================================= */

    .thesis-card:hover {

        border-color: var(--thesis-border-strong);

        box-shadow:
            0 8px 24px rgba(0, 0, 0, 0.10);

        transform: translateY(-2px);
    }


    /* =============================================================
       DARK MODE
    ============================================================= */

    [data-bs-theme="dark"] .thesis-card,
    [data-bs-theme="dark"] .thesis-empty-card {

        --thesis-bg: #111111;

        --thesis-surface: #1b1b1b;

        --thesis-surface-hover: #242424;

        --thesis-border: #3b3b3b;

        --thesis-border-strong: #5a5a5a;

        --thesis-text: #f5f5f5;

        --thesis-muted: #a5a5a5;

        --thesis-icon-bg: #242424;

        --thesis-icon-text: #ffffff;

        box-shadow:
            0 6px 20px rgba(0, 0, 0, 0.30);
    }


    [data-bs-theme="dark"] .thesis-card:hover {

        border-color: #6a6a6a;

        box-shadow:
            0 10px 28px rgba(0, 0, 0, 0.40);
    }


    /* =============================================================
       HEADER
    ============================================================= */

    .thesis-card-header {

        background: transparent;

        border: 0;

        padding: 20px 20px 0;

        display: flex;

        justify-content: space-between;

        align-items: center;

        gap: 10px;
    }


    /* =============================================================
       GENERAL BADGE
    ============================================================= */

    .thesis-badge {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 32px;

        padding: 6px 12px;

        border-radius: 999px;

        font-size: 0.78rem;

        font-weight: 600;

        line-height: 1;

        white-space: nowrap;
    }


    /* =============================================================
       NUMBER BADGE
    ============================================================= */

    .thesis-badge-number {

        background: var(--thesis-surface);

        color: var(--thesis-text);

        border: 1px solid var(--thesis-border);
    }


    /* =============================================================
       PUBLISHED BADGE
    ============================================================= */

    .thesis-badge-published {

        background: rgba(25, 135, 84, 0.12);

        color: var(--color-green);

        border: 1px solid rgba(25, 135, 84, 0.30);
    }


    /* =============================================================
       NOT PUBLISHED BADGE
    ============================================================= */

    .thesis-badge-unpublished {

        background: rgba(108, 117, 125, 0.12);

        color: var(--color-gray);

        border: 1px solid rgba(108, 117, 125, 0.30);
    }


    /* =============================================================
       DARK MODE STATUS BADGES
    ============================================================= */

    [data-bs-theme="dark"] .thesis-badge-published {

        background: rgba(25, 135, 84, 0.18);

        color: #4ddf9a;

        border-color: rgba(77, 223, 154, 0.35);
    }


    [data-bs-theme="dark"] .thesis-badge-unpublished {

        background: rgba(173, 181, 189, 0.12);

        color: #ced4da;

        border-color: rgba(173, 181, 189, 0.30);
    }


    /* =============================================================
       BODY
    ============================================================= */

    .thesis-card-body {

        padding: 20px;

        display: flex;

        flex-direction: column;

        min-width: 0;
    }


    /* =============================================================
       TITLE
    ============================================================= */

    .thesis-title {

        margin: 0 0 18px;

        color: var(--thesis-text);

        font-size: 1.05rem;

        font-weight: 700;

        line-height: 1.45;

        display: -webkit-box;

        -webkit-box-orient: vertical;

        -webkit-line-clamp: 2;

        overflow: hidden;

        min-height:
            calc(1.05rem * 1.45 * 2);
    }


    /* =============================================================
       AUTHOR BOX
    ============================================================= */

    .thesis-author-box {

        display: flex;

        align-items: center;

        padding: 12px;

        margin-bottom: 18px;

        background: var(--thesis-surface);

        border: 1px solid var(--thesis-border);

        border-radius: 12px;

        min-width: 0;
    }


    /* =============================================================
       AUTHOR ICON
    ============================================================= */

    .thesis-author-icon {

        width: 42px;

        height: 42px;

        flex: 0 0 42px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        background: rgba(13, 110, 253, 0.12);

        color: var(--color-blue);

        border: 1px solid rgba(13, 110, 253, 0.25);

        font-size: 1.05rem;
    }


    /* =============================================================
       AUTHOR INFO
    ============================================================= */

    .thesis-author-info {

        min-width: 0;

        margin-left: 12px;
    }


    .thesis-author-name {

        color: var(--thesis-text);

        font-weight: 600;

        font-size: 0.92rem;
    }


    .thesis-department {

        color: var(--thesis-muted);

        font-size: 0.78rem;

        margin-top: 2px;
    }


    /* =============================================================
       META
    ============================================================= */

    .thesis-meta {

        display: flex;

        flex-direction: column;

        gap: 10px;

        margin-bottom: 18px;
    }


    .thesis-meta-row {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 12px;

        color: var(--thesis-muted);

        font-size: 0.80rem;

        line-height: 1.4;
    }


    .thesis-meta-label {

        display: inline-flex;

        align-items: center;

        min-width: 0;
    }


    .thesis-meta-value {

        color: var(--thesis-text);

        font-weight: 600;

        text-align: right;

        max-width: 55%;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* =============================================================
       SEMANTIC ICON COLORS
    ============================================================= */

    .thesis-icon-blue {

        color: var(--color-blue);
    }


    .thesis-icon-green {

        color: var(--color-green);
    }


    .thesis-icon-orange {

        color: var(--color-orange);
    }


    .thesis-icon-red {

        color: var(--color-red);
    }


    /* =============================================================
       ATTACHMENTS
    ============================================================= */

    .thesis-attachments {

        margin-top: auto;

        padding-top: 16px;

        border-top: 1px solid var(--thesis-border);
    }


    .thesis-attachments-header {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 10px;

        margin-bottom: 10px;
    }


    .thesis-attachments-title {

        color: var(--thesis-text);

        font-size: 0.82rem;

        font-weight: 600;
    }


    .thesis-file-count {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        padding: 5px 10px;

        background: var(--thesis-surface);

        color: var(--thesis-muted);

        border: 1px solid var(--thesis-border);

        border-radius: 999px;

        font-size: 0.72rem;

        font-weight: 600;

        white-space: nowrap;
    }


    /* =============================================================
       FILE LIST
    ============================================================= */

    .thesis-file-list {

        display: flex;

        flex-direction: column;

        gap: 8px;
    }


    .thesis-file-buttons {
        gap: 8px;
        width: 100%;
        display: flex;
    }


    /* =============================================================
       VIEW BUTTON
       BLUE
    ============================================================= */

    .thesis-btn-view {
        flex: none;
        width: 50%;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 5px;

        min-height: 36px;

        background: var(--color-blue);

        color: #ffffff;

        border: 1px solid var(--color-blue);

        font-size: 0.78rem;

        font-weight: 600;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            transform 0.2s ease;
    }


    .thesis-btn-view:hover {

        background: var(--color-blue-dark);

        color: #ffffff;

        border-color: var(--color-blue-dark);

        transform: translateY(-1px);
    }


    /* =============================================================
       DOWNLOAD BUTTON
       GREEN
    ============================================================= */

    .thesis-btn-download {

        width: 50%;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 5px;

        min-height: 36px;

        background: var(--color-green);

        color: #ffffff;

        border: 1px solid var(--color-green);

        font-size: 0.78rem;

        font-weight: 600;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            transform 0.2s ease;
    }


    .thesis-btn-download:hover {

        background: var(--color-green-dark);

        color: #ffffff;

        border-color: var(--color-green-dark);

        transform: translateY(-1px);
    }


    /* =============================================================
       BUTTON FOCUS
    ============================================================= */

    .thesis-btn:focus {

        box-shadow:
            0 0 0 0.2rem rgba(13, 110, 253, 0.20);
    }


    /* =============================================================
       NO FILES
    ============================================================= */

    .thesis-no-files {

        padding: 10px;

        text-align: center;

        background: var(--thesis-surface);

        color: var(--thesis-muted);

        border: 1px solid var(--thesis-border);

        border-radius: 10px;

        font-size: 0.78rem;
    }


    /* =============================================================
       EMPTY STATE
    ============================================================= */

    .thesis-empty-card {

        border-radius: 18px;
    }


    .thesis-empty-body {

        padding: 55px 20px;

        text-align: center;
    }


    .thesis-empty-icon {

        margin-bottom: 15px;

        color: var(--thesis-muted);

        font-size: 3.5rem;

        line-height: 1;
    }


    .thesis-empty-title {

        margin-bottom: 5px;

        color: var(--thesis-text);

        font-weight: 700;
    }


    .thesis-empty-text {

        margin: 0;

        color: var(--thesis-muted);

        font-size: 0.82rem;
    }


    /* =============================================================
       MOBILE
    ============================================================= */

    @media (max-width: 575.98px) {

        .thesis-card {

            border-radius: 14px;
        }


        .thesis-card-header {

            padding: 16px 16px 0;
        }


        .thesis-card-body {

            padding: 16px;
        }


        .thesis-badge {

            min-height: 29px;

            padding: 5px 9px;

            font-size: 0.70rem;
        }


        .thesis-title {

            font-size: 0.98rem;

            margin-bottom: 15px;
        }


        .thesis-author-box {

            padding: 10px;

            margin-bottom: 15px;
        }


        .thesis-author-icon {

            width: 38px;

            height: 38px;

            flex-basis: 38px;
        }


        .thesis-author-info {

            margin-left: 10px;
        }


        .thesis-meta-row {

            font-size: 0.75rem;
        }


        .thesis-meta-value {

            max-width: 48%;
        }


        .thesis-btn-view,
        .thesis-btn-download {

            min-height: 34px;

            font-size: 0.74rem;
        }
    }


    /* =============================================================
       VERY SMALL MOBILE
    ============================================================= */

    @media (max-width: 380px) {

        .thesis-card-header {

            align-items: flex-start;
        }


        .thesis-badge-status {

            max-width: 150px;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .thesis-meta-row {

            align-items: flex-start;
        }


        .thesis-meta-value {

            max-width: 45%;
        }


        .thesis-btn span {

            display: none;
        }


        .thesis-btn-view,
        .thesis-btn-download {

            width: 50%;

            font-size: 0.95rem;
        }
    }
</style>
