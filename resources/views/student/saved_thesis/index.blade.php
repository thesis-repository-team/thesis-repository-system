<x-app-layout>

    <style>
        /* =========================================================
       SAVED THESES PAGE
       CARD + TABLE VIEW
       LIGHT + DARK MODE
    ========================================================= */

        .saved-theses-page {
            --st-purple: #6538d9;
            --st-purple-dark: #5030b8;
            --st-purple-light: #eee8ff;

            --st-bg: #f8f8fc;
            --st-card: #ffffff;
            --st-border: #e7e7ef;

            --st-text: #151a3b;
            --st-muted: #6d7392;

            --st-success: #20955b;
            --st-danger: #d83232;

            --st-shadow: 0 4px 15px rgba(30, 25, 70, 0.06);

            min-height: 100vh;
            background: var(--st-bg);
            color: var(--st-text);
            padding: 18px 0 35px;
        }

        /* =========================================================
       CONTAINER
    ========================================================= */

        .saved-theses-container {
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
            padding: 0 18px;
            margin-top: 10%;
        }

        /* =========================================================
       PAGE HEADER
    ========================================================= */

        .saved-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 18px;
        }

        .saved-page-title {
            margin: 0;
            color: var(--st-text);
            font-size: 23px;
            font-weight: 700;
            line-height: 1.3;
        }

        .saved-page-title i {
            color: var(--st-purple);
            margin-right: 7px;
        }

        /* =========================================================
       BACK BUTTON
    ========================================================= */

        .saved-back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;

            min-height: 36px;
            padding: 0 13px;

            border: 1px solid #ddd5f7;
            border-radius: 7px;

            background: var(--st-purple-light);
            color: var(--st-purple);

            text-decoration: none;
            font-size: 12px;
            font-weight: 600;

            transition: all 0.2s ease;
        }

        .saved-back-button:hover {
            background: var(--st-purple);
            border-color: var(--st-purple);
            color: #ffffff;
            transform: translateY(-1px);
        }

        /* =========================================================
       ALERTS
    ========================================================= */

        .saved-alert {
            border: 0;
            border-radius: 8px;
            padding: 10px 13px;
            margin-bottom: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .saved-alert-success {
            background: #e6f7ed;
            color: #188650;
            border-left: 4px solid var(--st-success);
        }

        .saved-alert-info {
            background: #e8f2ff;
            color: #2875c7;
            border-left: 4px solid #3484dc;
        }

        /* =========================================================
       MAIN CARD
    ========================================================= */

        .saved-theses-card {
            background: var(--st-card);
            border: 1px solid var(--st-border);
            border-radius: 10px;
            box-shadow: var(--st-shadow);
            overflow: hidden;
        }

        /* =========================================================
       CARD HEADER
    ========================================================= */

        .saved-card-header {
            min-height: 52px;
            padding: 0 16px;

            display: flex;
            align-items: center;

            background: linear-gradient(135deg,
                    #7040df 0%,
                    #6234d4 100%);

            color: #ffffff;
        }

        .saved-card-header h5 {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
        }

        .saved-card-header i {
            margin-right: 6px;
        }

        /* =========================================================
       CARD BODY
    ========================================================= */

        .saved-card-body {
            padding: 15px;
        }

        /* =========================================================
       VIEW SWITCHER
    ========================================================= */

        .saved-view-toolbar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 15px;
        }

        .saved-view-toggle {
            display: inline-flex;
            align-items: center;
            gap: 3px;

            padding: 4px;

            background: var(--st-card);
            border: 1px solid var(--st-border);
            border-radius: 9px;

            box-shadow: 0 3px 10px rgba(30, 25, 70, 0.05);
        }

        .saved-view-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;

            min-height: 34px;
            padding: 0 12px;

            border: 0;
            border-radius: 6px;

            background: transparent;
            color: var(--st-muted);

            font-size: 11px;
            font-weight: 700;

            cursor: pointer;

            transition:
                background 0.2s ease,
                color 0.2s ease,
                transform 0.2s ease;
        }

        .saved-view-button i {
            font-size: 11px;
        }

        .saved-view-button:hover {
            background: var(--st-purple-light);
            color: var(--st-purple);
        }

        .saved-view-button.active {
            background: var(--st-purple);
            color: #ffffff;
            box-shadow: 0 3px 8px rgba(101, 56, 217, 0.25);
        }

        .saved-view-button.active:hover {
            background: var(--st-purple-dark);
            color: #ffffff;
        }

        /* =========================================================
       HIDDEN VIEW
    ========================================================= */

        .saved-card-view[hidden],
        .saved-table-view[hidden] {
            display: none !important;
        }

        /* =========================================================
       THESIS GRID
    ========================================================= */

        .saved-theses-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        /* =========================================================
       THESIS ITEM
    ========================================================= */

        .saved-thesis-item {
            min-width: 0;
            padding: 15px;

            background: var(--st-card);

            border: 1px solid var(--st-border);
            border-radius: 9px;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
        }

        .saved-thesis-item:hover {
            transform: translateY(-2px);
            border-color: #d8cff5;
            box-shadow: 0 7px 20px rgba(50, 35, 100, 0.08);
        }

        /* =========================================================
       THESIS CONTENT
    ========================================================= */

        .saved-thesis-content {
            display: flex;
            flex-direction: column;
            gap: 13px;
            height: 100%;
        }

        .saved-thesis-info {
            min-width: 0;
        }

        /* =========================================================
       THESIS TITLE
    ========================================================= */

        .saved-thesis-title {
            margin: 0 0 10px;

            color: var(--st-text);
            font-size: 15px;
            font-weight: 700;
            line-height: 1.4;

            word-break: break-word;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* =========================================================
       INFORMATION
    ========================================================= */

        .saved-info-row {
            margin-bottom: 5px;

            color: var(--st-muted);
            font-size: 11.5px;
            line-height: 1.45;

            word-break: break-word;
        }

        .saved-info-row strong {
            color: var(--st-text);
            font-weight: 600;
        }

        .saved-info-row i {
            width: 16px;
            margin-right: 3px;
            color: var(--st-purple);
        }

        /* =========================================================
       SAVED DATE
    ========================================================= */

        .saved-date {
            margin-top: 8px;

            color: var(--st-muted);
            font-size: 10.5px;
            line-height: 1.4;
        }

        .saved-date i {
            color: var(--st-purple);
            margin-right: 3px;
        }

        /* =========================================================
       ACTIONS
    ========================================================= */

        .saved-actions {
            display: flex;
            align-items: center;
            gap: 7px;

            width: 100%;
            margin-top: auto;
        }

        .saved-action-button {
            min-height: 32px;
            padding: 0 10px;

            border-radius: 6px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;

            font-size: 11px;
            font-weight: 600;

            transition: all 0.2s ease;

            text-decoration: none;
            cursor: pointer;
        }

        .saved-action-view {
            flex: 1;

            background: var(--st-purple);
            border: 1px solid var(--st-purple);
            color: #ffffff;
        }

        .saved-action-view:hover {
            background: var(--st-purple-dark);
            border-color: var(--st-purple-dark);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .saved-action-remove {
            flex: 1;

            background: #fff0f0;
            border: 1px solid #ffd7d7;
            color: var(--st-danger);
        }

        .saved-action-remove:hover {
            background: var(--st-danger);
            border-color: var(--st-danger);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .saved-actions form {
            flex: 1;
            margin: 0;
        }

        .saved-actions form button {
            width: 100%;
        }

        /* =========================================================
       TABLE VIEW
    ========================================================= */

        .saved-table-view {
            width: 100%;
        }

        .saved-table-wrapper {
            width: 100%;
            overflow-x: auto;

            background: var(--st-card);

            border: 1px solid var(--st-border);
            border-radius: 9px;

            box-shadow: 0 3px 12px rgba(30, 25, 70, 0.04);
        }

        .saved-theses-table {
            width: 100%;
            min-width: 900px;

            border-collapse: collapse;
            border-spacing: 0;
        }

        .saved-theses-table th {
            padding: 12px 13px;

            background: #faf9fe;

            border-bottom: 1px solid var(--st-border);

            color: var(--st-muted);

            font-size: 10px;
            font-weight: 700;

            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.03em;

            white-space: nowrap;
        }

        .saved-theses-table td {
            padding: 13px;

            border-bottom: 1px solid var(--st-border);

            color: var(--st-text);

            font-size: 11.5px;
            line-height: 1.45;

            vertical-align: middle;
        }

        .saved-theses-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .saved-theses-table tbody tr {
            transition: background 0.2s ease;
        }

        .saved-theses-table tbody tr:hover {
            background: #faf8ff;
        }

        .saved-table-number {
            width: 45px;

            color: var(--st-muted) !important;
            font-weight: 700;

            text-align: center;
        }

        .saved-table-title {
            min-width: 250px;
            max-width: 380px;

            color: var(--st-text);
            font-weight: 700;

            word-break: break-word;
        }

        .saved-table-author {
            min-width: 150px;
            color: var(--st-muted);
        }

        .saved-table-department {
            min-width: 130px;
            color: var(--st-muted);
        }

        .saved-table-date {
            min-width: 145px;
            color: var(--st-muted);
            white-space: nowrap;
        }

        .saved-table-action-cell {
            width: 1%;
            min-width: 155px;
            white-space: nowrap;
        }

        /* =========================================================
       TABLE ACTION BUTTONS
    ========================================================= */

        .saved-table-actions {
            display: flex;
            align-items: center;
            justify-content: flex-start;

            gap: 6px;

            flex-wrap: nowrap;
            white-space: nowrap;
        }

        .saved-table-actions .saved-action-button {
            flex: 0 0 auto;

            min-height: 30px;
            padding: 0 9px;

            font-size: 10.5px;
        }

        .saved-table-actions form {
            flex: 0 0 auto;
            margin: 0;
        }

        .saved-table-actions form button {
            width: auto;
        }

        /* =========================================================
       EMPTY STATE
    ========================================================= */

        .saved-empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .saved-empty-icon {
            width: 62px;
            height: 62px;
            margin: 0 auto 15px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: var(--st-purple-light);
            color: var(--st-purple);

            font-size: 25px;
        }

        .saved-empty-state h5 {
            margin: 0 0 6px;

            color: var(--st-text);
            font-size: 16px;
            font-weight: 700;
        }

        .saved-empty-state p {
            margin: 0;

            color: var(--st-muted);
            font-size: 12px;
        }

        /* =========================================================
       DARK MODE
    ========================================================= */

        [data-bs-theme="dark"] .saved-theses-page {
            --st-bg: #101426;
            --st-card: #181d33;
            --st-border: #292e45;

            --st-text: #ffffff;
            --st-muted: #999fb9;

            --st-shadow: 0 5px 18px rgba(0, 0, 0, 0.22);
        }

        [data-bs-theme="dark"] .saved-thesis-item {
            background: #181d33;
            border-color: #292e45;
        }

        [data-bs-theme="dark"] .saved-thesis-item:hover {
            border-color: #443a67;
            box-shadow: 0 7px 20px rgba(0, 0, 0, 0.25);
        }

        [data-bs-theme="dark"] .saved-back-button {
            background: #25203f;
            border-color: #39315c;
            color: #bdaeff;
        }

        [data-bs-theme="dark"] .saved-back-button:hover {
            background: var(--st-purple);
            border-color: var(--st-purple);
            color: #ffffff;
        }

        [data-bs-theme="dark"] .saved-alert-success {
            background: #173728;
            color: #7bd5a6;
            border-left-color: var(--st-success);
        }

        [data-bs-theme="dark"] .saved-alert-info {
            background: #182f4a;
            color: #82b9ee;
            border-left-color: #3484dc;
        }

        [data-bs-theme="dark"] .saved-action-remove {
            background: #351d23;
            border-color: #55303a;
            color: #ff7777;
        }

        [data-bs-theme="dark"] .saved-action-remove:hover {
            background: var(--st-danger);
            border-color: var(--st-danger);
            color: #ffffff;
        }

        [data-bs-theme="dark"] .saved-empty-icon {
            background: #25203f;
            color: #bdaeff;
        }

        [data-bs-theme="dark"] .saved-view-toggle {
            background: #181d33;
            border-color: #292e45;
        }

        [data-bs-theme="dark"] .saved-view-button:hover {
            background: #25203f;
            color: #bdaeff;
        }

        [data-bs-theme="dark"] .saved-view-button.active {
            background: var(--st-purple);
            color: #ffffff;
        }

        [data-bs-theme="dark"] .saved-table-wrapper {
            background: #181d33;
            border-color: #292e45;
        }

        [data-bs-theme="dark"] .saved-theses-table th {
            background: #20253a;
            border-color: #292e45;
            color: #999fb9;
        }

        [data-bs-theme="dark"] .saved-theses-table td {
            border-color: #292e45;
        }

        [data-bs-theme="dark"] .saved-theses-table tbody tr:hover {
            background: #20253a;
        }

        /* =========================================================
       LARGE DESKTOP
    ========================================================= */

        @media (min-width: 1200px) {

            .saved-theses-container {
                max-width: 1320px;
            }

            .saved-theses-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        /* =========================================================
       TABLET
    ========================================================= */

        @media (max-width: 900px) {

            .saved-theses-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .saved-table-wrapper {
                border-radius: 8px;
            }
        }

        /* =========================================================
       MOBILE
       CARD ONLY
    ========================================================= */

        @media (max-width: 768px) {

            .saved-theses-page {
                padding-top: 14px;
                padding-bottom: 25px;
            }

            .saved-theses-container {
                padding: 0 12px;
            }

            .saved-page-header {
                align-items: flex-start;
                flex-direction: column;
                margin-bottom: 15px;
            }

            .saved-page-title {
                font-size: 20px;
            }

            .saved-back-button {
                width: auto;
                min-height: 34px;
            }

            .saved-card-header {
                min-height: 48px;
                padding: 0 13px;
            }

            .saved-card-header h5 {
                font-size: 13px;
            }

            .saved-card-body {
                padding: 12px;
            }

            /* Hide Card/Table switcher on mobile */
            .saved-view-toolbar {
                display: none;
            }

            /* Always use cards on mobile */
            .saved-card-view {
                display: block !important;
            }

            .saved-table-view {
                display: none !important;
            }

            .saved-theses-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .saved-thesis-item {
                padding: 13px;
            }

            .saved-thesis-title {
                font-size: 14px;
            }

            .saved-info-row {
                font-size: 11px;
            }

            .saved-actions {
                gap: 6px;
            }

            .saved-action-button {
                min-height: 34px;
                font-size: 11px;
            }
        }

        /* =========================================================
       SMALL MOBILE
    ========================================================= */

        @media (max-width: 480px) {

            .saved-theses-container {
                padding: 0 10px;
            }

            .saved-page-title {
                font-size: 18px;
            }

            .saved-back-button {
                width: 100%;
            }

            .saved-card-body {
                padding: 10px;
            }

            .saved-thesis-item {
                padding: 12px;
            }

            .saved-thesis-title {
                font-size: 14px;
                margin-bottom: 8px;
            }

            .saved-info-row {
                font-size: 10.5px;
            }

            .saved-date {
                font-size: 10px;
            }

            .saved-actions {
                flex-direction: row;
            }

            .saved-action-button {
                min-height: 32px;
                padding: 0 7px;
                font-size: 10px;
            }

            .saved-action-button i {
                font-size: 10px;
            }

            .saved-empty-state {
                padding: 45px 12px;
            }

            .saved-empty-icon {
                width: 55px;
                height: 55px;
                font-size: 22px;
            }
        }
    </style>


    <div class="dashboard-content saved-theses-page">

        <div class="saved-theses-container">

            {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

            <div class="saved-page-header">

                <h2 class="saved-page-title">
                    <i class="fas fa-bookmark"></i>
                    Saved Theses
                </h2>

                <a href="{{ route('student.thesis.index') }}" class="saved-back-button">

                    <i class="fas fa-arrow-left"></i>
                    Back to Theses

                </a>

            </div>


            {{-- =====================================================
             SUCCESS MESSAGE
        ====================================================== --}}

            @if (session('success'))
                <div class="saved-alert saved-alert-success">

                    <i class="fas fa-check-circle me-1"></i>

                    {{ session('success') }}

                </div>
            @endif


            {{-- =====================================================
             INFO MESSAGE
        ====================================================== --}}

            @if (session('info'))
                <div class="saved-alert saved-alert-info">

                    <i class="fas fa-info-circle me-1"></i>

                    {{ session('info') }}

                </div>
            @endif


            {{-- =====================================================
             MAIN CARD
        ====================================================== --}}

            <div class="saved-theses-card">


                {{-- =================================================
                 CARD HEADER
            ================================================== --}}

                <div class="saved-card-header">

                    <h5>

                        <i class="fas fa-bookmark"></i>

                        My Saved Theses

                    </h5>

                </div>


                {{-- =================================================
                 CARD BODY
            ================================================== --}}

                <div class="saved-card-body">


                    @if ($savedTheses->count() > 0)


                        {{-- =============================================
                         CARD / TABLE VIEW BUTTONS
                    ============================================== --}}

                        <div class="saved-view-toolbar">

                            <div class="saved-view-toggle" role="group" aria-label="Choose saved theses view">

                                <button type="button" class="saved-view-button active" data-saved-view="card"
                                    aria-pressed="true">

                                    <i class="fas fa-th-large"></i>

                                    Card

                                </button>

                                <button type="button" class="saved-view-button" data-saved-view="table"
                                    aria-pressed="false">

                                    <i class="fas fa-table"></i>

                                    Table

                                </button>

                            </div>

                        </div>


                        {{-- =============================================
                         CARD VIEW
                    ============================================== --}}

                        <div class="saved-card-view">


                            <div class="saved-theses-grid">

                                @foreach ($savedTheses as $saved)
                                    @if ($saved->thesis)
                                        {{-- =================================
                                         THESIS CARD
                                    ================================== --}}

                                        <div class="saved-thesis-item">

                                            <div class="saved-thesis-content">


                                                {{-- ==========================
                                                 THESIS INFORMATION
                                            =========================== --}}

                                                <div class="saved-thesis-info">


                                                    {{-- Thesis Title --}}

                                                    <h5 class="saved-thesis-title">

                                                        {{ $saved->thesis->title }}

                                                    </h5>


                                                    {{-- Author --}}

                                                    @if ($saved->thesis->author_name)
                                                        <div class="saved-info-row">

                                                            <strong>
                                                                Author:
                                                            </strong>

                                                            {{ $saved->thesis->author_name }}

                                                        </div>
                                                    @endif


                                                    {{-- Department --}}

                                                    @if ($saved->thesis->department)
                                                        <div class="saved-info-row">

                                                            <strong>
                                                                Department:
                                                            </strong>

                                                            {{ $saved->thesis->department->dept_name }}

                                                        </div>
                                                    @endif


                                                    {{-- Saved Date --}}

                                                    <div class="saved-date">

                                                        <i class="fas fa-clock"></i>

                                                        Saved:

                                                        {{ $saved->saved_at ? $saved->saved_at->format('d M Y, h:i A') : $saved->created_at->format('d M Y, h:i A') }}

                                                    </div>


                                                </div>


                                                {{-- ==========================
                                                 ACTION BUTTONS
                                            =========================== --}}

                                                <div class="saved-actions">


                                                    {{-- View --}}

                                                    <a href="{{ route('student.thesis.show', $saved->thesis->id) }}"
                                                        class="saved-action-button saved-action-view">

                                                        <i class="fas fa-eye"></i>

                                                        View

                                                    </a>


                                                    {{-- Remove --}}

                                                    <form
                                                        action="{{ route('student.saved_thesis.destroy', $saved->thesis->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to remove this thesis from your saved theses?');">

                                                        @csrf

                                                        @method('DELETE')


                                                        <button type="submit"
                                                            class="saved-action-button saved-action-remove">

                                                            <i class="fas fa-trash"></i>

                                                            Remove

                                                        </button>

                                                    </form>


                                                </div>


                                            </div>

                                        </div>
                                    @endif
                                @endforeach

                            </div>

                        </div>


                        {{-- =============================================
                         TABLE VIEW
                    ============================================== --}}

                        <div class="saved-table-view" hidden>


                            <div class="saved-table-wrapper">

                                <table class="saved-theses-table">

                                    <thead>

                                        <tr>

                                            <th class="saved-table-number">
                                                #
                                            </th>

                                            <th>
                                                Title
                                            </th>

                                            <th>
                                                Author
                                            </th>

                                            <th>
                                                Department
                                            </th>

                                            <th>
                                                Saved Date
                                            </th>

                                            <th>
                                                Action
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @php
                                            $tableNumber = 1;
                                        @endphp


                                        @foreach ($savedTheses as $saved)
                                            @if ($saved->thesis)
                                                <tr>

                                                    {{-- Number --}}

                                                    <td class="saved-table-number">

                                                        {{ $tableNumber++ }}

                                                    </td>


                                                    {{-- Title --}}

                                                    <td class="saved-table-title">

                                                        {{ $saved->thesis->title }}

                                                    </td>


                                                    {{-- Author --}}

                                                    <td class="saved-table-author">

                                                        @if ($saved->thesis->author_name)
                                                            {{ $saved->thesis->author_name }}
                                                        @else
                                                            <span>—</span>
                                                        @endif

                                                    </td>


                                                    {{-- Department --}}

                                                    <td class="saved-table-department">

                                                        @if ($saved->thesis->department)
                                                            {{ $saved->thesis->department->dept_name }}
                                                        @else
                                                            <span>—</span>
                                                        @endif

                                                    </td>


                                                    {{-- Saved Date --}}

                                                    <td class="saved-table-date">

                                                        <i class="fas fa-clock"
                                                            style="color: var(--st-purple); margin-right: 4px;"></i>

                                                        {{ $saved->saved_at ? $saved->saved_at->format('d M Y, h:i A') : $saved->created_at->format('d M Y, h:i A') }}

                                                    </td>


                                                    {{-- Actions --}}

                                                    <td class="saved-table-action-cell">

                                                        <div class="saved-table-actions">


                                                            {{-- View --}}

                                                            <a href="{{ route('student.thesis.show', $saved->thesis->id) }}"
                                                                class="saved-action-button saved-action-view">

                                                                <i class="fas fa-eye"></i>

                                                                View

                                                            </a>


                                                            {{-- Remove --}}

                                                            <form
                                                                action="{{ route('student.saved_thesis.destroy', $saved->thesis->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to remove this thesis from your saved theses?');">

                                                                @csrf

                                                                @method('DELETE')


                                                                <button type="submit"
                                                                    class="saved-action-button saved-action-remove">

                                                                    <i class="fas fa-trash"></i>

                                                                    Remove

                                                                </button>

                                                            </form>


                                                        </div>

                                                    </td>

                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>
                    @else
                        {{-- =============================================
                         EMPTY STATE
                    ============================================== --}}

                        <div class="saved-empty-state">

                            <div class="saved-empty-icon">

                                <i class="fas fa-bookmark"></i>

                            </div>

                            <h5>
                                No Saved Theses
                            </h5>

                            <p>
                                You have not saved any theses yet.
                            </p>

                        </div>

                    @endif


                </div>

            </div>

        </div>

    </div>


    {{-- =============================================================
     CARD / TABLE VIEW JAVASCRIPT
============================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const page = document.querySelector('.saved-theses-page');

            if (!page) {
                return;
            }


            const viewButtons =
                page.querySelectorAll('[data-saved-view]');

            const cardView =
                page.querySelector('.saved-card-view');

            const tableView =
                page.querySelector('.saved-table-view');


            if (!viewButtons.length || !cardView || !tableView) {
                return;
            }


            const storageKey = 'savedThesesView';


            /* =========================================================
               CHECK MOBILE
            ========================================================= */

            function isMobile() {

                return window.innerWidth <= 768;

            }


            /* =========================================================
               SET VIEW
            ========================================================= */

            function setView(view, savePreference = true) {

                /*
                 * Mobile always uses Card view.
                 */

                if (isMobile()) {

                    view = 'card';

                }


                const showCard = view === 'card';


                /* Card */

                cardView.hidden = !showCard;


                /* Table */

                tableView.hidden = showCard;


                /* Buttons */

                viewButtons.forEach(function(button) {

                    const buttonView =
                        button.getAttribute('data-saved-view');

                    const isActive =
                        buttonView === view;


                    button.classList.toggle(
                        'active',
                        isActive
                    );


                    button.setAttribute(
                        'aria-pressed',
                        isActive ? 'true' : 'false'
                    );

                });


                /*
                 * Save only desktop preference.
                 */

                if (savePreference && !isMobile()) {

                    localStorage.setItem(
                        storageKey,
                        view
                    );

                }

            }


            /* =========================================================
               LOAD SAVED VIEW
            ========================================================= */

            let savedView =
                localStorage.getItem(storageKey);


            if (
                savedView !== 'card' &&
                savedView !== 'table'
            ) {

                savedView = 'card';

            }


            setView(savedView, false);


            /* =========================================================
               BUTTON CLICK
            ========================================================= */

            viewButtons.forEach(function(button) {

                button.addEventListener(
                    'click',
                    function() {

                        const selectedView =
                            button.getAttribute(
                                'data-saved-view'
                            );


                        setView(
                            selectedView,
                            true
                        );

                    }
                );

            });


            /* =========================================================
               WINDOW RESIZE
            ========================================================= */

            let resizeTimer;


            window.addEventListener(
                'resize',
                function() {

                    clearTimeout(resizeTimer);


                    resizeTimer = setTimeout(
                        function() {

                            /*
                             * Mobile = Card only
                             */

                            if (isMobile()) {

                                setView(
                                    'card',
                                    false
                                );

                                return;

                            }


                            /*
                             * Desktop = restore selected
                             * desktop preference
                             */

                            const currentView =
                                localStorage.getItem(
                                    storageKey
                                ) || 'card';


                            setView(
                                currentView,
                                false
                            );

                        },
                        100
                    );

                }
            );

        });
    </script>

</x-app-layout>
