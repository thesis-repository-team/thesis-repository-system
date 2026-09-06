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

                {{-- VIEW TOGGLE --}}
                <div class="view-toggle" role="group" aria-label="Thesis view">
                    <button type="button" class="view-toggle-button active" id="tableViewBtn"
                        onclick="setThesisView('table')" aria-label="Table view">
                        <i class="bi bi-list-ul"></i>
                        <span>Table</span>
                    </button>

                    <button type="button" class="view-toggle-button" id="cardViewBtn" onclick="setThesisView('card')"
                        aria-label="Card view">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <span>Card</span>
                    </button>
                </div>
            </div>

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div class="custom-alert alert-success alert-dismissible fade show" role="alert">
                    <div class="alert-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>

                    <div class="alert-content">
                        <strong>Success</strong>
                        <span>{{ session('success') }}</span>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @endif

            {{-- ERROR MESSAGE --}}
            @if (session('error'))
                <div class="custom-alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="alert-icon">
                        <i class="bi bi-exclamation-lg"></i>
                    </div>

                    <div class="alert-content">
                        <strong>Error</strong>
                        <span>{{ session('error') }}</span>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @endif


            {{-- =========================================================
            THESES LIST
        ========================================================== --}}
            @if ($theses->count())

                <div class="thesis-list" id="thesisList">

                    @foreach ($theses as $thesis)
                        {{-- =================================================
                        TABLE / ROW VIEW
                    ================================================== --}}
                        <div class="thesis-row thesis-view-table">

                            {{-- NUMBER --}}
                            <div class="thesis-number">
                                {{ $loop->iteration }}
                            </div>

                            {{-- TITLE + META --}}
                            <div class="thesis-main">
                                <span class="thesis-title" title="{{ $thesis->title }}">
                                    {{ $thesis->title }}
                                </span>

                                <span class="thesis-meta">

                                    <span class="meta-item">
                                        <i class="bi bi-person-fill"></i>
                                        {{ $thesis->author_name }}
                                    </span>

                                    <span class="dot">&bull;</span>

                                    <span class="meta-item">
                                        <i class="bi bi-calendar3"></i>
                                        {{ optional($thesis->published_at)->format('d M Y') ?? 'Not published' }}
                                    </span>

                                    <span class="dot">&bull;</span>

                                    <span class="meta-item">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                        {{ $thesis->files->count() }}
                                        {{ Str::plural('file', $thesis->files->count()) }}
                                    </span>

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


                        {{-- =================================================
                        CARD VIEW
                    ================================================== --}}
                        <article class="thesis-card thesis-view-card">

                            {{-- CARD TOP --}}
                            <div class="card-top">

                                <div class="card-number">
                                    {{ $loop->iteration }}
                                </div>

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

                            </div>


                            {{-- CARD TITLE --}}
                            <div class="card-title-area">

                                <h3 class="card-thesis-title" title="{{ $thesis->title }}">
                                    {{ $thesis->title }}
                                </h3>

                            </div>


                            {{-- CARD INFORMATION --}}
                            <div class="card-info">

                                <div class="card-info-item">

                                    <div class="card-info-icon">
                                        <i class="bi bi-person-fill"></i>
                                    </div>

                                    <div class="card-info-content">

                                        <span class="card-info-label">
                                            Author
                                        </span>

                                        <span class="card-info-value">
                                            {{ $thesis->author_name }}
                                        </span>

                                    </div>

                                </div>


                                <div class="card-info-item">

                                    <div class="card-info-icon">
                                        <i class="bi bi-calendar3"></i>
                                    </div>

                                    <div class="card-info-content">

                                        <span class="card-info-label">
                                            Published
                                        </span>

                                        <span class="card-info-value">
                                            {{ optional($thesis->published_at)->format('d M Y') ?? 'Not published' }}
                                        </span>

                                    </div>

                                </div>


                                <div class="card-info-item">

                                    <div class="card-info-icon">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                    </div>

                                    <div class="card-info-content">

                                        <span class="card-info-label">
                                            Files
                                        </span>

                                        <span class="card-info-value">
                                            {{ $thesis->files->count() }}
                                            {{ Str::plural('file', $thesis->files->count()) }}
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- CARD FILE ACTIONS --}}
                            <div class="card-actions">

                                @forelse ($thesis->files as $file)
                                    <a href="{{ route('student.thesis.view-pdf', $file) }}" target="_blank"
                                        rel="noopener" class="card-view-file-button">

                                        <i class="bi bi-eye-fill"></i>
                                        <span>View PDF</span>

                                    </a>

                                @empty

                                    <span class="card-no-file">

                                        <i class="bi bi-file-earmark-x"></i>
                                        No file available

                                    </span>
                                @endforelse

                            </div>

                        </article>
                    @endforeach

                </div>
            @else
                {{-- EMPTY STATE --}}
                <div class="empty-thesis-state">

                    <div class="empty-icon">
                        <i class="bi bi-journal-x"></i>
                    </div>

                    <h3>No theses found</h3>

                    <p>
                        There are currently no theses available for your department.
                    </p>

                </div>

            @endif

        </div>
    </div>


    <style>
        /* =========================================================
       MY THESES PAGE
    ========================================================= */

        .my-theses-page {
            min-height: 100vh;
        }


        /* =========================================================
       PAGE HEADER
    ========================================================= */

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .page-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
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


        /* =========================================================
       VIEW TOGGLE BUTTONS
    ========================================================= */

        .view-toggle {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px;
            flex-shrink: 0;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .view-toggle-button {
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 13px;
            border: 0;
            border-radius: 7px;
            background: transparent;
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition:
                background 0.2s ease,
                color 0.2s ease,
                transform 0.15s ease;
        }

        .view-toggle-button:hover {
            color: var(--text-dark);
        }

        .view-toggle-button.active {
            background: var(--dashboard-purple);
            color: #ffffff;
            box-shadow: 0 3px 9px rgba(101, 56, 217, 0.22);
        }

        .view-toggle-button i {
            font-size: 14px;
        }


        /* =========================================================
       ALERT
    ========================================================= */

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


        /* =========================================================
       LIST
    ========================================================= */

        .thesis-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }


        /* =========================================================
       TABLE VIEW
    ========================================================= */

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
            transition:
                border-color 0.2s ease,
                transform 0.2s ease;
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

        .meta-item {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            min-width: 0;
        }

        .thesis-meta i {
            font-size: 11px;
        }

        .thesis-meta .dot {
            margin: 0 2px;
            color: var(--border-color);
        }


        /* =========================================================
       STATUS BADGE
    ========================================================= */

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


        /* =========================================================
       TABLE FILE ACTIONS
    ========================================================= */

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
            transition:
                background 0.2s ease,
                transform 0.15s ease;
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


        /* =========================================================
       CARD VIEW
    ========================================================= */

        .thesis-view-card {
            display: none;
        }

        .thesis-card {
            position: relative;
            min-width: 0;
            padding: 15px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 13px;
            box-shadow: var(--shadow);
            transition:
                border-color 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .thesis-card:hover {
            border-color: #d9caf9;
            transform: translateY(-2px);
        }

        .card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 13px;
        }

        .card-number {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 8px;
            background: var(--dashboard-purple);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
        }

        .card-title-area {
            min-width: 0;
            margin-bottom: 14px;
        }

        .card-thesis-title {
            display: -webkit-box;
            overflow: hidden;
            margin: 0;
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 700;
            line-height: 1.4;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .card-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding-top: 12px;
            border-top: 1px solid var(--border-color);
        }

        .card-info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
        }

        .card-info-icon {
            width: 29px;
            height: 29px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: rgba(101, 56, 217, 0.09);
            color: var(--dashboard-purple);
            font-size: 12px;
        }

        .card-info-content {
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .card-info-label {
            color: var(--text-muted);
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.35px;
        }

        .card-info-value {
            overflow: hidden;
            color: var(--text-dark);
            font-size: 11px;
            font-weight: 600;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .card-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
            margin-top: 13px;
            padding-top: 12px;
            border-top: 1px solid var(--border-color);
        }

        .card-view-file-button {
            min-height: 31px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 7px;
            background: var(--dashboard-purple);
            color: #ffffff;
            font-size: 10px;
            font-weight: 600;
            text-decoration: none;
            transition:
                background 0.2s ease,
                transform 0.15s ease;
        }

        .card-view-file-button:hover {
            background: var(--dashboard-purple-dark);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .card-no-file {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            min-height: 31px;
            padding: 6px 10px;
            border-radius: 7px;
            background: #ffe9e9;
            color: #d83232;
            font-size: 10px;
            font-weight: 600;
        }


        /* =========================================================
       CARD VIEW MODE
       
       DESKTOP = 4 CARDS
    ========================================================= */

        .my-theses-page.card-mode .thesis-view-table {
            display: none;
        }

        .my-theses-page.card-mode .thesis-list {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            align-items: stretch;
        }

        .my-theses-page.card-mode .thesis-view-card {
            display: block;
            width: 100%;
            min-width: 0;
        }


        /* =========================================================
       EMPTY STATE
    ========================================================= */

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


        /* =========================================================
       DARK MODE
    ========================================================= */

        [data-bs-theme="dark"] .thesis-row,
        [data-bs-theme="dark"] .thesis-card,
        [data-bs-theme="dark"] .custom-alert,
        [data-bs-theme="dark"] .empty-thesis-state,
        [data-bs-theme="dark"] .view-toggle {
            background: #181d33;
            border-color: #292e45;
        }

        [data-bs-theme="dark"] .empty-icon {
            background: #20253a;
        }

        [data-bs-theme="dark"] .thesis-row:hover,
        [data-bs-theme="dark"] .thesis-card:hover {
            border-color: #3a3060;
        }

        [data-bs-theme="dark"] .page-title,
        [data-bs-theme="dark"] .thesis-title,
        [data-bs-theme="dark"] .card-thesis-title,
        [data-bs-theme="dark"] .card-info-value,
        [data-bs-theme="dark"] .empty-thesis-state h3 {
            color: #ffffff;
        }

        [data-bs-theme="dark"] .page-subtitle,
        [data-bs-theme="dark"] .thesis-meta,
        [data-bs-theme="dark"] .card-info-label,
        [data-bs-theme="dark"] .empty-thesis-state p {
            color: #999fb9;
        }

        [data-bs-theme="dark"] .thesis-meta .dot {
            color: #33394d;
        }

        [data-bs-theme="dark"] .card-info,
        [data-bs-theme="dark"] .card-actions {
            border-color: #292e45;
        }

        [data-bs-theme="dark"] .view-toggle-button:hover {
            color: #ffffff;
        }

        [data-bs-theme="dark"] .card-info-icon {
            background: rgba(150, 120, 255, 0.12);
        }


        /* =========================================================
       TABLET
       
       2 CARDS IN ONE ROW
    ========================================================= */

        @media (max-width: 1100px) {

            .my-theses-page.card-mode .thesis-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

        }

        @media (max-width: 900px) {

            .my-theses-page.card-mode .thesis-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .thesis-row {
                gap: 10px;
                padding: 10px 12px;
            }

            .status-badge {
                padding: 5px 9px;
            }

        }


        /* =========================================================
       MOBILE
       
       MOBILE ALWAYS USES CARD VIEW
       2 CARDS IN ONE ROW
    ========================================================= */

        @media (max-width: 768px) {

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-heading {
                width: 100%;
            }

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

            /*
         * Hide view buttons on mobile.
         */
            .view-toggle {
                display: none;
            }

            /*
         * Hide table rows on mobile.
         */
            .thesis-view-table {
                display: none !important;
            }

            /*
         * Show cards on mobile.
         */
            .thesis-view-card {
                display: block !important;
            }

            /*
         * IMPORTANT:
         * Mobile = 2 cards per row.
         */
            .thesis-list,
            .my-theses-page.card-mode .thesis-list {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
                align-items: stretch;
            }

            /*
         * Compact mobile cards.
         */
            .thesis-card {
                width: 100%;
                min-width: 0;
                padding: 12px;
                border-radius: 11px;
            }

            .card-top {
                gap: 5px;
                margin-bottom: 10px;
            }

            .card-number {
                width: 28px;
                height: 28px;
                border-radius: 7px;
                font-size: 10px;
            }

            .card-top .status-badge {
                max-width: calc(100% - 34px);
                overflow: hidden;
                padding: 4px 7px;
                font-size: 9px;
                text-overflow: ellipsis;
            }

            .card-thesis-title {
                font-size: 12px;
                line-height: 1.35;
            }

            .card-title-area {
                margin-bottom: 11px;
            }

            .card-info {
                gap: 7px;
                padding-top: 10px;
            }

            .card-info-item {
                gap: 6px;
            }

            .card-info-icon {
                width: 25px;
                height: 25px;
                border-radius: 6px;
                font-size: 10px;
            }

            .card-info-label {
                font-size: 8px;
            }

            .card-info-value {
                font-size: 10px;
            }

            .card-actions {
                gap: 5px;
                margin-top: 10px;
                padding-top: 10px;
            }

            .card-view-file-button {
                width: 100%;
                min-height: 29px;
                padding: 5px 7px;
                gap: 5px;
                border-radius: 6px;
                font-size: 9px;
            }

            .card-no-file {
                width: 100%;
                min-height: 29px;
                padding: 5px 7px;
                border-radius: 6px;
                font-size: 9px;
            }

        }


        /* =========================================================
       SMALL MOBILE
       
       STILL 2 CARDS IN ONE ROW
    ========================================================= */

        @media (max-width: 480px) {

            .page-heading {
                gap: 10px;
            }

            .page-title-icon {
                width: 40px;
                height: 40px;
                border-radius: 9px;
                font-size: 16px;
            }

            .page-title {
                font-size: 18px;
            }

            .page-subtitle {
                margin-top: 3px;
                font-size: 12px;
            }

            .custom-alert {
                padding: 12px;
            }

            .alert-icon {
                width: 31px;
                height: 31px;
            }

            /*
         * Keep 2 cards on small phones.
         */
            .thesis-list,
            .my-theses-page.card-mode .thesis-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
            }

            .thesis-card {
                padding: 10px;
                border-radius: 10px;
            }

            .card-top {
                margin-bottom: 9px;
            }

            .card-number {
                width: 26px;
                height: 26px;
                border-radius: 6px;
                font-size: 9px;
            }

            .card-top .status-badge {
                padding: 4px 6px;
                font-size: 8px;
            }

            .card-title-area {
                margin-bottom: 9px;
            }

            .card-thesis-title {
                font-size: 11px;
                line-height: 1.35;
            }

            .card-info {
                gap: 6px;
                padding-top: 9px;
            }

            .card-info-icon {
                width: 23px;
                height: 23px;
                font-size: 9px;
            }

            .card-info-label {
                font-size: 7px;
            }

            .card-info-value {
                font-size: 9px;
            }

            .card-actions {
                margin-top: 9px;
                padding-top: 9px;
            }

            .card-view-file-button {
                min-height: 28px;
                font-size: 8px;
            }

        }


        /* =========================================================
       VERY SMALL MOBILE
       
       STILL 2 CARDS IN ONE ROW
    ========================================================= */

        @media (max-width: 380px) {

            .thesis-list,
            .my-theses-page.card-mode .thesis-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 7px;
            }

            .thesis-card {
                padding: 9px;
            }

            .status-badge {
                font-size: 8px;
                padding: 4px 6px;
            }

            .card-info-value {
                font-size: 8px;
            }

            .card-thesis-title {
                font-size: 10px;
            }

            .card-view-file-button {
                font-size: 8px;
                padding-left: 5px;
                padding-right: 5px;
            }

        }


        /* =========================================================
       REDUCED MOTION
    ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            .thesis-row,
            .thesis-card,
            .view-toggle-button,
            .view-file-button,
            .card-view-file-button {
                transition: none;
            }

            .thesis-row:hover,
            .thesis-card:hover,
            .view-file-button:hover,
            .card-view-file-button:hover {
                transform: none;
            }

        }
    </style>


    {{-- =============================================================
     VIEW SWITCH JAVASCRIPT
============================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const page = document.querySelector('.my-theses-page');

            if (!page) {
                return;
            }

            /*
             * Mobile should ALWAYS use card view.
             */
            if (window.innerWidth <= 768) {

                setThesisView('card', false);

                return;
            }

            /*
             * Restore the user's previous desktop view.
             * Default = table.
             */
            const savedView =
                localStorage.getItem('myThesesView') || 'table';

            setThesisView(savedView, false);

        });


        /*
         * Change between Card and Table.
         */
        function setThesisView(view, save = true) {

            const page =
                document.querySelector('.my-theses-page');

            const tableButton =
                document.getElementById('tableViewBtn');

            const cardButton =
                document.getElementById('cardViewBtn');

            if (!page) {
                return;
            }

            /*
             * Mobile always stays in Card view.
             */
            if (window.innerWidth <= 768) {
                view = 'card';
            }

            /*
             * Remove previous mode.
             */
            page.classList.remove('card-mode');

            /*
             * Reset button states.
             */
            if (tableButton) {
                tableButton.classList.remove('active');
            }

            if (cardButton) {
                cardButton.classList.remove('active');
            }

            /*
             * Apply selected view.
             */
            if (view === 'card') {

                page.classList.add('card-mode');

                if (cardButton) {
                    cardButton.classList.add('active');
                }

            } else {

                if (tableButton) {
                    tableButton.classList.add('active');
                }

            }

            /*
             * Save only on desktop.
             */
            if (save && window.innerWidth > 768) {

                localStorage.setItem(
                    'myThesesView',
                    view
                );

            }

        }


        /*
         * If browser is resized:
         *
         * Desktop -> restore selected view
         * Mobile  -> force Card view
         */
        window.addEventListener('resize', function() {

            const page =
                document.querySelector('.my-theses-page');

            if (!page) {
                return;
            }

            if (window.innerWidth <= 768) {

                setThesisView('card', false);

            } else {

                const savedView =
                    localStorage.getItem('myThesesView') || 'table';

                setThesisView(savedView, false);

            }

        });
    </script>

</x-app-layout>
