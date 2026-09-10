<x-app-layout>

    <div class="dashboard-content">

        <div class="student-thesis-page">

            {{-- =====================================================
                PAGE HEADER
            ====================================================== --}}
            <div class="page-header">

                <div class="page-heading">

                    <div class="heading-icon">
                        <i class="fa-solid fa-book-open"></i>
                    </div>

                    <div>
                        <h2 class="page-title">
                            Thesis Records Hub
                        </h2>

                        <p class="page-subtitle">
                            View, filter, and manage student thesis records
                        </p>
                    </div>

                </div>

            </div>


            {{-- =====================================================
                SEARCH AND FILTER
            ====================================================== --}}
            <div class="filter-card">

                <div class="filter-card-title">

                    <span class="section-label">
                        <i class="fa-solid fa-sliders"></i>
                        Search and Filter Bar
                    </span>

                    <small>
                        Find thesis records quickly
                    </small>

                </div>


                <form
                    action="{{ route('student.thesis.index') }}"
                    method="GET"
                    class="filter-row"
                    id="thesisFilterForm"
                >

                    {{-- SEARCH --}}
                    <div class="filter-item search-box">

                        <label for="search">
                            Search Records
                        </label>

                        <div class="input-wrapper">

                            <i class="fa-solid fa-magnifying-glass"></i>

                            <input
                                type="text"
                                id="search"
                                name="search"
                                class="form-control"
                                placeholder="Search name, department, email..."
                                value="{{ request('search') }}"
                                autocomplete="off"
                            >

                        </div>

                    </div>


                    {{-- DEPARTMENT --}}
                    <div class="filter-item">

                        <label for="departmentFilter">
                            Department
                        </label>

                        <select
                            class="form-select"
                            id="departmentFilter"
                            name="department"
                        >

                            <option value="">
                                All Departments
                            </option>

                            @foreach ($departments as $department)

                                <option
                                    value="{{ $department->name }}"
                                    {{ request('department') == $department->name ? 'selected' : '' }}
                                >
                                    {{ $department->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- YEAR --}}
                    <div class="filter-item">

                        <label for="yearFilter">
                            Published Year
                        </label>

                        <select
                            class="form-select"
                            id="yearFilter"
                            name="year"
                        >

                            <option value="">
                                All Years
                            </option>

                            @foreach ($published_at as $published)

                                <option
                                    value="{{ $published }}"
                                    {{ request('year') == $published ? 'selected' : '' }}
                                >
                                    {{ $published }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- RESET --}}
                    <div class="filter-item filter-button">

                        <label>&nbsp;</label>

                        <button
                            type="button"
                            id="resetFilter"
                            class="btn-reset"
                        >
                            <i class="bi bi-arrow-counterclockwise"></i>
                            Reset
                        </button>

                    </div>

                </form>

            </div>


            {{-- =====================================================
                THESIS LIST
            ====================================================== --}}
            <div class="thesis-card">

                {{-- =================================================
                    VIEW CONTROLS
                ================================================== --}}
                <div class="thesis-view-toolbar">

                    <div
                        class="thesis-view-controls"
                        role="group"
                        aria-label="View mode"
                    >

                        <button
                            type="button"
                            id="tableViewBtn"
                            class="thesis-view-btn active"
                            title="Table view"
                        >
                            <i class="fa-solid fa-table-list"></i>
                            <span>Table</span>
                        </button>


                        <button
                            type="button"
                            id="cardViewBtn"
                            class="thesis-view-btn"
                            title="Card view"
                        >
                            <i class="fa-solid fa-grip"></i>
                            <span>Card</span>
                        </button>

                    </div>

                </div>


                {{-- =================================================
                    TABLE VIEW
                ================================================== --}}
                <div
                    class="table-wrapper"
                    id="thesisTableView"
                >

                    <table class="thesis-table">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Title</th>

                                <th>Author</th>

                                <th>Department</th>

                                <th>Submitted By</th>

                                <th>Published By</th>

                                <th>Published At</th>

                                <th>Action</th>

                            </tr>

                        </thead>


                        <tbody id="studentTable">

                            @include('student.thesis.table')

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                    CARD VIEW
                ================================================== --}}
                <div
                    class="thesis-card-view"
                    id="thesisCardView"
                ></div>

            </div>

        </div>

    </div>


    {{-- =============================================================
        PAGE CSS
    ============================================================= --}}
    <style>

        /* =========================================================
           MAIN PAGE
        ========================================================= */

        .student-thesis-page {

            --st-bg: #f5f7fa;
            --st-card: #ffffff;
            --st-border: #e5e7eb;
            --st-border-light: #f0f1f3;

            --st-text: #111827;
            --st-text-secondary: #374151;
            --st-muted: #6b7280;
            --st-placeholder: #9ca3af;

            --st-blue: #2563eb;
            --st-green: #16a34a;
            --st-orange: #ea580c;

            width: 100%;
            min-height: calc(100vh - 70px);

            padding: 20px;

            background: var(--st-bg);

            box-sizing: border-box;

        }


        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .student-thesis-page .page-header {

            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 24px;

        }


        .student-thesis-page .page-heading {

            display: flex;
            align-items: center;

            gap: 14px;

        }


        .student-thesis-page .heading-icon {

            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 12px;

            background: var(--dashboard-purple);
            color: #ffffff;

            font-size: 20px;

        }


        .student-thesis-page .page-title {

            margin: 0;

            color: var(--st-text);

            font-size: 28px;
            line-height: 1.2;
            font-weight: 750;

            letter-spacing: -0.5px;

        }


        .student-thesis-page .page-subtitle {

            margin: 6px 0 0;

            color: var(--st-muted);

            font-size: 13px;
            line-height: 1.5;

        }


        /* =========================================================
           FILTER CARD
        ========================================================= */

        .student-thesis-page .filter-card {

            width: 100%;

            margin-bottom: 24px;

            padding: 21px 23px;

            background: var(--st-card);

            border: 1px solid var(--st-border);

            border-radius: 14px;

            box-shadow:
                0 4px 15px rgba(15, 23, 42, 0.04);

            box-sizing: border-box;

        }


        .student-thesis-page .filter-card-title {

            margin-bottom: 17px;

        }


        .student-thesis-page .section-label {

            display: block;

            color: var(--st-text);

            font-size: 14px;
            font-weight: 700;

        }


        .student-thesis-page .section-label i {

            margin-right: 6px;

            color: var(--st-blue);

        }


        .student-thesis-page .filter-card-title small {

            display: block;

            margin-top: 4px;

            color: var(--st-muted);

            font-size: 11px;

        }


        /* =========================================================
           FILTER ROW
        ========================================================= */

        .student-thesis-page .filter-row {

            width: 100%;

            display: grid;

            grid-template-columns:
                minmax(0, 2fr)
                minmax(0, 1.25fr)
                minmax(0, 1fr)
                110px;

            gap: 14px;

            align-items: end;

        }


        .student-thesis-page .filter-item {

            width: 100%;
            min-width: 0;

        }


        .student-thesis-page .filter-item label {

            display: block;

            margin-bottom: 7px;

            color: var(--st-text-secondary);

            font-size: 11px;
            font-weight: 700;

        }


        /* =========================================================
           SEARCH
        ========================================================= */

        .student-thesis-page .input-wrapper {

            position: relative;

            width: 100%;

        }


        .student-thesis-page .input-wrapper i {

            position: absolute;

            top: 50%;
            left: 14px;

            z-index: 2;

            color: var(--st-placeholder);

            font-size: 13px;

            transform: translateY(-50%);

            pointer-events: none;

        }


        .student-thesis-page .input-wrapper .form-control {

            padding-left: 39px;

        }


        /* =========================================================
           INPUTS
        ========================================================= */

        .student-thesis-page .filter-card .form-control,
        .student-thesis-page .filter-card .form-select {

            width: 100%;
            height: 43px;

            padding-top: 0;
            padding-bottom: 0;

            border: 1px solid #d1d5db;

            border-radius: 8px;

            background: #ffffff;

            color: var(--st-text-secondary);

            font-size: 12px;

            box-shadow: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;

        }


        .student-thesis-page .filter-card .form-control::placeholder {

            color: var(--st-placeholder);

        }


        .student-thesis-page .filter-card .form-control:focus,
        .student-thesis-page .filter-card .form-select:focus {

            border-color: var(--st-blue);

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, .10);

            outline: none;

        }


        /* =========================================================
           RESET
        ========================================================= */

        .student-thesis-page .filter-button {

            width: 110px;

        }


        .student-thesis-page .btn-reset {

            width: 100%;
            height: 43px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 6px;

            border: 1px solid #d1d5db;

            border-radius: 8px;

            background: #ffffff;

            color: #374151;

            font-size: 12px;
            font-weight: 650;

            cursor: pointer;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .15s ease;

        }


        .student-thesis-page .btn-reset:hover {

            background: #111827;
            border-color: #111827;
            color: #ffffff;

        }


        .student-thesis-page .btn-reset:active {

            transform: scale(.98);

        }


        /* =========================================================
           THESIS MAIN CONTAINER
        ========================================================= */

        .student-thesis-page .thesis-card {

            width: 100%;

            display: block;

            background: transparent;

            border: 0;

            box-shadow: none;

            overflow: visible;

        }


        /* =========================================================
           VIEW TOOLBAR
        ========================================================= */

        .student-thesis-page .thesis-view-toolbar {

            width: 100%;

            display: flex;
            align-items: center;
            justify-content: flex-end;

            margin-bottom: 12px;

        }


        .student-thesis-page .thesis-view-controls {

            display: inline-flex;

            align-items: center;

            gap: 4px;

            padding: 4px;

            border: 1px solid var(--st-border);

            border-radius: 10px;

            background: var(--st-card);

        }


        .student-thesis-page .thesis-view-btn {

            min-height: 32px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 6px;

            padding: 6px 11px;

            border: 0;

            border-radius: 7px;

            background: transparent;

            color: var(--st-muted);

            font-size: 11px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s ease;

        }


        .student-thesis-page .thesis-view-btn:hover {

            color: var(--st-text);

        }


        .student-thesis-page .thesis-view-btn.active {

            background: var(--dashboard-purple);

            color: #ffffff;

        }


        .student-thesis-page .thesis-view-btn:active {

            transform: scale(.97);

        }


        /* =========================================================
           TABLE BACKGROUND
           
           IMPORTANT:
           Background only appears in TABLE mode.
        ========================================================= */

        .student-thesis-page:not(.card-view-active) .table-wrapper {

            width: 100%;
            max-width: 100%;

            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            box-shadow:
                0 4px 15px rgba(15, 23, 42, .04);

            overflow-x: auto;
            overflow-y: visible;

            box-sizing: border-box;

        }


        /* =========================================================
           TABLE
        ========================================================= */

        .student-thesis-page .thesis-table {

            width: 100%;
            max-width: 100%;

            table-layout: fixed;

            border-collapse: collapse;

            border-spacing: 0;

        }


        .student-thesis-page:not(.card-view-active) .thesis-table {

            background: #ffffff;

        }


        .student-thesis-page:not(.card-view-active) .thesis-table tbody {

            background: #ffffff;

        }


        .student-thesis-page:not(.card-view-active) .thesis-table tbody tr {

            background: #ffffff;

        }


        /* =========================================================
           TABLE HEADER
        ========================================================= */

        .student-thesis-page .thesis-table thead {

            background: var(--dashboard-purple);

            color: #ffffff;

        }


        .student-thesis-page .thesis-table th {

            padding: 12px 10px;

            color: #ffffff;

            text-align: left;

            font-size: 10px;

            font-weight: 700;

            letter-spacing: .25px;

            text-transform: uppercase;

            vertical-align: middle;

            white-space: normal;

        }


        /* =========================================================
           TABLE CELLS
        ========================================================= */

        .student-thesis-page .thesis-table td {

            padding: 13px 10px;

            border-bottom: 1px solid var(--st-border);

            background: #ffffff;

            color: var(--st-text-secondary);

            font-size: 11px;

            line-height: 1.45;

            vertical-align: middle;

            overflow-wrap: anywhere;

            word-break: break-word;

        }


        .student-thesis-page .thesis-table tbody tr {

            transition: background-color .15s ease;

        }


        .student-thesis-page .thesis-table tbody tr:hover td {

            background: #f8fafc;

        }


        .student-thesis-page .thesis-table tbody tr:last-child td {

            border-bottom: 0;

        }


        /* =========================================================
           COLUMN WIDTHS
        ========================================================= */

        .student-thesis-page .thesis-table th:nth-child(1),
        .student-thesis-page .thesis-table td:nth-child(1) {

            width: 4%;

            text-align: center;

        }


        .student-thesis-page .thesis-table th:nth-child(2),
        .student-thesis-page .thesis-table td:nth-child(2) {

            width: 22%;

        }


        .student-thesis-page .thesis-table th:nth-child(3),
        .student-thesis-page .thesis-table td:nth-child(3) {

            width: 12%;

        }


        .student-thesis-page .thesis-table th:nth-child(4),
        .student-thesis-page .thesis-table td:nth-child(4) {

            width: 16%;

        }


        .student-thesis-page .thesis-table th:nth-child(5),
        .student-thesis-page .thesis-table td:nth-child(5) {

            width: 12%;

        }


        .student-thesis-page .thesis-table th:nth-child(6),
        .student-thesis-page .thesis-table td:nth-child(6) {

            width: 11%;

        }


        .student-thesis-page .thesis-table th:nth-child(7),
        .student-thesis-page .thesis-table td:nth-child(7) {

            width: 15%;

        }


        /* =========================================================
           ACTION COLUMN
           
           VIEW / DOWNLOAD / SAVE
           ALL SAME SIZE AND PADDING
        ========================================================= */

        .student-thesis-page .thesis-table th:nth-child(8),
        .student-thesis-page .thesis-table td:nth-child(8) {

            width: 20%;

            text-align: center;

            white-space: nowrap;

        }


        .student-thesis-page .thesis-table td:nth-child(8) {

            padding-left: 8px;
            padding-right: 8px;

        }


        /* =========================================================
           ACTION MENU
        ========================================================= */

        .student-thesis-page .action-menu {

            position: relative;

            width: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

        }


        /* =========================================================
           ACTION BUTTON
        ========================================================= */

        .student-thesis-page .action-menu-button {

            width: 34px;
            height: 34px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 0;

            border: 1px solid #e5e7eb;

            border-radius: 8px;

            background: #ffffff;

            color: #4b5563;

            font-size: 14px;

            cursor: pointer;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease;

        }


        .student-thesis-page .action-menu-button:hover {

            background: #f3f4f6;

            border-color: #d1d5db;

            color: #111827;

        }


        .student-thesis-page .action-menu-button.active {

            background: #111827;

            border-color: #111827;

            color: #ffffff;

        }


        /* =========================================================
           DESKTOP ACTION BUTTONS
           
           SAME:
           - WIDTH
           - HEIGHT
           - PADDING
           - BORDER
           - RADIUS
           - ICON ALIGNMENT
        ========================================================= */

        @media (min-width: 769px) {

            .student-thesis-page .action-dropdown {

                position: static;

                width: auto;
                max-width: 100%;

                display: flex;

                align-items: center;
                justify-content: center;

                gap: 7px;

                margin: 0;
                padding: 0;

                background: transparent;

                border: 0;

                border-radius: 0;

                box-shadow: none;

                opacity: 1;

                visibility: visible;

                pointer-events: auto;

                transform: none;

            }


            .student-thesis-page .action-dropdown-item {

                width: 34px !important;

                min-width: 34px !important;

                max-width: 34px !important;

                height: 34px !important;

                min-height: 34px !important;

                max-height: 34px !important;

                display: inline-flex !important;

                align-items: center;

                justify-content: center;

                padding: 0 !important;

                margin: 0;

                border: 1px solid #e5e7eb;

                border-radius: 8px;

                background: #ffffff;

                color: #374151;

                text-decoration: none;

                font-size: 0;

                line-height: 1;

                text-align: center;

                white-space: nowrap;

                box-sizing: border-box;

                flex: 0 0 34px;

                cursor: pointer;

                transition:
                    background-color .2s ease,
                    border-color .2s ease,
                    color .2s ease,
                    transform .15s ease;

            }


            .student-thesis-page .action-dropdown-item:hover {

                background: #f3f4f6;

                border-color: #d1d5db;

                color: #111827;

                text-decoration: none;

            }


            .student-thesis-page .action-dropdown-item:active {

                transform: scale(.96);

            }


            /* =====================================================
               ALL ACTION ICONS SAME SIZE
            ====================================================== */

            .student-thesis-page .action-item-icon {

                width: 28px !important;

                height: 28px !important;

                min-width: 28px !important;

                min-height: 28px !important;

                display: inline-flex !important;

                align-items: center;

                justify-content: center;

                flex-shrink: 0;

                padding: 0 !important;

                margin: 0;

                border-radius: 7px;

                font-size: 12px !important;

                line-height: 1;

                box-sizing: border-box;

            }


            .student-thesis-page .action-item-icon i {

                margin: 0;

                padding: 0;

                font-size: 12px;

                line-height: 1;

            }


            /* =====================================================
               ACTION FORM
            ====================================================== */

            .student-thesis-page .action-dropdown-form {

                width: auto;

                margin: 0;

                padding: 0;

                display: flex;

                align-items: center;

                justify-content: center;

            }


            .student-thesis-page .action-dropdown-button {

                appearance: none;

                font-family: inherit;

                cursor: pointer;

            }


            /* Hide mobile menu button on desktop */

            .student-thesis-page .action-menu-button {

                display: none;

            }

        }


        /* =========================================================
           ACTION ICON COLORS
        ========================================================= */

        .student-thesis-page .view-icon {

            background: #ecfdf5;

            color: #16a34a;

        }


        .student-thesis-page .download-icon {

            background: #eff6ff;

            color: #2563eb;

        }


        .student-thesis-page .bookmark-icon {

            background: #fff7ed;

            color: #ea580c;

        }


        .student-thesis-page .share-icon {

            background: #f5f3ff;

            color: #7c3aed;

        }


        .student-thesis-page .no-file-icon {

            background: #f3f4f6;

            color: #9ca3af;

        }


        /* =========================================================
           DROPDOWN MOBILE
        ========================================================= */

        .student-thesis-page .action-dropdown {

            position: absolute;

            top: calc(100% + 7px);

            right: 0;

            z-index: 10000;

            width: 215px;

            padding: 6px;

            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 10px;

            box-shadow:
                0 12px 28px rgba(15, 23, 42, .15),
                0 2px 6px rgba(15, 23, 42, .06);

            opacity: 0;

            visibility: hidden;

            pointer-events: none;

            transform: translateY(-5px);

            transition:
                opacity .15s ease,
                visibility .15s ease,
                transform .15s ease;

        }


        .student-thesis-page .action-dropdown.show {

            opacity: 1;

            visibility: visible;

            pointer-events: auto;

            transform: translateY(0);

        }


        .student-thesis-page .action-dropdown-item {

            width: 100%;

            min-height: 38px;

            display: flex;

            align-items: center;

            gap: 9px;

            padding: 6px 8px;

            border: 0;

            border-radius: 7px;

            background: transparent;

            color: #374151;

            text-decoration: none;

            font-size: 11px;

            font-weight: 550;

            text-align: left;

            box-sizing: border-box;

            cursor: pointer;

            transition:
                background-color .15s ease,
                color .15s ease;

        }


        .student-thesis-page .action-dropdown-item:hover {

            background: #f3f4f6;

            color: #111827;

            text-decoration: none;

        }


        .student-thesis-page .action-dropdown-empty {

            display: flex;

            align-items: center;

            gap: 8px;

            padding: 8px;

            color: #9ca3af;

            font-size: 10px;

        }


        /* =========================================================
           TITLE
        ========================================================= */

        .student-thesis-page .thesis-title-cell {

            width: 100%;
            min-width: 0;

        }


        .student-thesis-page .thesis-title {

            display: block;

            color: var(--st-text);

            font-weight: 650;

            line-height: 1.4;

            overflow-wrap: anywhere;

            word-break: break-word;

        }


        /* =========================================================
           DATE
        ========================================================= */

        .student-thesis-page .published-date {

            display: inline-flex;

            align-items: center;

            gap: 5px;

            max-width: 100%;

            color: #4b5563;

            overflow-wrap: anywhere;

        }


        .student-thesis-page .published-date i {

            flex-shrink: 0;

            color: #6b7280;

            font-size: 10px;

        }


        .student-thesis-page .not-published {

            display: inline-flex;

            align-items: center;

            gap: 5px;

            color: #9ca3af;

            font-size: 10px;

        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .student-thesis-page .empty-thesis-state {

            display: flex;

            flex-direction: column;

            align-items: center;
            justify-content: center;

            gap: 5px;

            padding: 35px 15px;

            color: #6b7280;

        }


        .student-thesis-page .empty-thesis-icon {

            width: 46px;
            height: 46px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin-bottom: 4px;

            border-radius: 50%;

            background: #f3f4f6;

            color: #9ca3af;

            font-size: 20px;

        }


        .student-thesis-page .empty-thesis-state strong {

            color: #374151;

            font-size: 13px;

        }


        .student-thesis-page .empty-thesis-state span {

            color: #9ca3af;

            font-size: 11px;

        }


        /* =========================================================
           CARD VIEW
        ========================================================= */

        .student-thesis-page .thesis-card-view {

            display: none;

            width: 100%;

            padding: 18px 0 4px;

            box-sizing: border-box;

        }


        .student-thesis-page.card-view-active .table-wrapper {

            display: none;

        }


        .student-thesis-page.card-view-active .thesis-card-view {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 12px;

        }


        /* =========================================================
           RECORD CARD
        ========================================================= */

        .student-thesis-page .thesis-record-card {

            min-width: 0;

            position: relative;

            padding: 14px 13px 13px;

            background: var(--st-card);

            border: 1px solid var(--st-border);

            border-radius: 14px;

            box-shadow:
                0 5px 18px rgba(15, 23, 42, .06);

            box-sizing: border-box;

            overflow: hidden;

        }


        .student-thesis-page .thesis-record-card-main {

            display: grid;

            grid-template-columns:
                58px minmax(0, 1fr);

            gap: 10px;

            align-items: start;

        }


        .student-thesis-page .thesis-record-card-pdf {

            width: 58px;
            height: 58px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 9px;

            background: #f5f5f7;

            color: #e12525;

            font-size: 34px;

        }


        .student-thesis-page .thesis-record-card-content {

            min-width: 0;

        }


        .student-thesis-page .thesis-record-card-title {

            margin: 0 0 5px;

            color: var(--st-text);

            font-size: 13px;

            font-weight: 750;

            line-height: 1.28;

            overflow-wrap: anywhere;

            word-break: break-word;

        }


        .student-thesis-page .thesis-record-card-row {

            display: block;

            padding: 1px 0;

            border: 0;

        }


        .student-thesis-page .thesis-record-card-label {

            display: inline;

            color: var(--st-text);

            font-size: 9px;

            font-weight: 750;

        }


        .student-thesis-page .thesis-record-card-label::after {

            content: ": ";

        }


        .student-thesis-page .thesis-record-card-value {

            display: inline;

            min-width: 0;

            color: var(--st-text-secondary);

            font-size: 9px;

            line-height: 1.45;

            overflow-wrap: anywhere;

            word-break: break-word;

        }


        .student-thesis-page .thesis-record-card-action {

            margin-top: 10px;

            padding-top: 0;

        }


        .student-thesis-page .thesis-record-card-action .thesis-action-buttons {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 8px;

            flex-wrap: nowrap;

        }


        .student-thesis-page .thesis-record-card-action .thesis-action-btn {

            flex: 1 1 0;

            min-width: 0;

            min-height: 34px;

            justify-content: center;

            border-radius: 10px;

        }


        /* =========================================================
           SEARCH LOADING
        ========================================================= */

        .student-thesis-page .search-loading {

            opacity: .55;

            pointer-events: none;

            transition: opacity .15s ease;

        }


        /* =========================================================
           DARK MODE
        ========================================================= */

        [data-bs-theme="dark"] .student-thesis-page {

            --st-bg: #101426;

            --st-card: #181d33;

            --st-border: #292e45;

            --st-border-light: #292e45;

            --st-text: #ffffff;

            --st-text-secondary: #d9dcea;

            --st-muted: #999fb9;

            --st-placeholder: #8f96af;

        }


        [data-bs-theme="dark"] .student-thesis-page .filter-card {

            box-shadow: none;

        }


        /* =========================================================
           DARK TABLE
        ========================================================= */

        [data-bs-theme="dark"]
        .student-thesis-page:not(.card-view-active)
        .table-wrapper {

            background: #181d33;

            border-color: #292e45;

            box-shadow: none;

        }


        [data-bs-theme="dark"]
        .student-thesis-page:not(.card-view-active)
        .thesis-table {

            background: #181d33;

        }


        [data-bs-theme="dark"]
        .student-thesis-page:not(.card-view-active)
        .thesis-table tbody {

            background: #181d33;

        }


        [data-bs-theme="dark"]
        .student-thesis-page:not(.card-view-active)
        .thesis-table tbody tr {

            background: #181d33;

        }


        [data-bs-theme="dark"]
        .student-thesis-page .thesis-table td {

            background: #181d33;

            border-color: #292e45;

            color: #d9dcea;

        }


        [data-bs-theme="dark"]
        .student-thesis-page .thesis-table tbody tr:hover td {

            background: #20253a;

        }


        /* =========================================================
           DARK INPUTS
        ========================================================= */

        [data-bs-theme="dark"]
        .student-thesis-page .filter-card .form-control,
        [data-bs-theme="dark"]
        .student-thesis-page .filter-card .form-select {

            background: #20253a;

            border-color: #343a52;

            color: #ffffff;

        }


        [data-bs-theme="dark"]
        .student-thesis-page .filter-card .form-control::placeholder {

            color: #8f96af;

        }


        [data-bs-theme="dark"]
        .student-thesis-page .filter-card .form-control:focus,
        [data-bs-theme="dark"]
        .student-thesis-page .filter-card .form-select:focus {

            border-color: #7040df;

            box-shadow:
                0 0 0 3px rgba(112, 64, 223, .15);

        }


        /* =========================================================
           DARK RESET
        ========================================================= */

        [data-bs-theme="dark"]
        .student-thesis-page .btn-reset {

            background: #20253a;

            border-color: #343a52;

            color: #ffffff;

        }


        [data-bs-theme="dark"]
        .student-thesis-page .btn-reset:hover {

            background: #ffffff;

            border-color: #ffffff;

            color: #111827;

        }


        /* =========================================================
           DARK VIEW CONTROLS
        ========================================================= */

        [data-bs-theme="dark"]
        .student-thesis-page .thesis-view-controls {

            background: #20253a;

            border-color: #343a52;

        }


        [data-bs-theme="dark"]
        .student-thesis-page .thesis-view-btn {

            color: #aeb5cc;

        }


        [data-bs-theme="dark"]
        .student-thesis-page .thesis-view-btn:hover {

            color: #ffffff;

        }


        /* =========================================================
           DARK ACTION BUTTONS
        ========================================================= */

        [data-bs-theme="dark"]
        .student-thesis-page .action-dropdown-item {

            background: #20253a;

            border-color: #343a52;

            color: #ffffff;

        }


        [data-bs-theme="dark"]
        .student-thesis-page .action-dropdown-item:hover {

            background: #2b3149;

            border-color: #454c68;

            color: #ffffff;

        }


        [data-bs-theme="dark"]
        .student-thesis-page .action-dropdown {

            background: #181d33;

            border-color: #343a52;

            box-shadow:
                0 15px 35px rgba(0, 0, 0, .35);

        }


        /* =========================================================
           DARK CARD
        ========================================================= */

        [data-bs-theme="dark"]
        .student-thesis-page .thesis-record-card {

            box-shadow: none;

        }


        [data-bs-theme="dark"]
        .student-thesis-page .thesis-record-card-pdf {

            background: #292d3f;

            color: #ff5757;

        }


        /* =========================================================
           TABLET 1200
        ========================================================= */

        @media (max-width: 1200px) {

            .student-thesis-page {

                padding-left: 24px;
                padding-right: 24px;

            }


            .student-thesis-page .thesis-table th,
            .student-thesis-page .thesis-table td {

                padding-left: 7px;
                padding-right: 7px;

                font-size: 10px;

            }


            .student-thesis-page .thesis-table th {

                font-size: 9px;

            }

        }


        /* =========================================================
           TABLET 992
        ========================================================= */

        @media (max-width: 992px) {

            .student-thesis-page {

                padding: 25px 20px 50px;

            }


            .student-thesis-page .filter-row {

                grid-template-columns: 1fr 1fr;

            }


            .student-thesis-page .search-box {

                grid-column: span 2;

            }


            .student-thesis-page .filter-button {

                width: 100%;

            }


            .student-thesis-page .thesis-table th,
            .student-thesis-page .thesis-table td {

                padding: 9px 6px;

                font-size: 9px;

            }


            .student-thesis-page .thesis-table th {

                font-size: 8px;

            }

        }


        /* =========================================================
           CARD VIEW 900
        ========================================================= */

        @media (max-width: 900px) {

            .student-thesis-page.card-view-active
            .thesis-card-view {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 10px;

            }


            .student-thesis-page .thesis-record-card {

                padding: 12px 11px 11px;

            }


            .student-thesis-page .thesis-record-card-main {

                grid-template-columns:
                    48px minmax(0, 1fr);

                gap: 8px;

            }


            .student-thesis-page .thesis-record-card-pdf {

                width: 48px;
                height: 48px;

                font-size: 28px;

            }


            .student-thesis-page .thesis-record-card-title {

                font-size: 12px;

            }


            .student-thesis-page .thesis-record-card-label,
            .student-thesis-page .thesis-record-card-value {

                font-size: 8px;

            }

        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 768px) {

            /* Hide view switcher */

            .student-thesis-page .thesis-view-controls {

                display: none !important;

            }


            /* Always hide table */

            .student-thesis-page .table-wrapper {

                display: none !important;

            }


            /* Always show cards */

            .student-thesis-page .thesis-card-view {

                display: grid !important;

                grid-template-columns:
                    repeat(2, minmax(0, 1fr)) !important;

                gap: 8px;

                width: 100%;

                padding: 8px 0 0;

            }


            .student-thesis-page {

                padding: 18px 14px 80px;

            }


            /* HEADER */

            .student-thesis-page .page-header {

                margin-bottom: 18px;

            }


            .student-thesis-page .page-heading {

                align-items: flex-start;

                gap: 10px;

            }


            .student-thesis-page .heading-icon {

                width: 42px;
                height: 42px;

                border-radius: 10px;

                font-size: 17px;

            }


            .student-thesis-page .page-title {

                font-size: 21px;

            }


            .student-thesis-page .page-subtitle {

                margin-top: 4px;

                font-size: 11px;

            }


            /* FILTER */

            .student-thesis-page .filter-card {

                padding: 17px;

                margin-bottom: 20px;

                border-radius: 12px;

            }


            .student-thesis-page .filter-row {

                display: flex;

                flex-direction: column;

                align-items: stretch;

                gap: 12px;

            }


            .student-thesis-page .search-box,
            .student-thesis-page .filter-item,
            .student-thesis-page .filter-button {

                width: 100%;

            }


            /* THESIS CARD CONTAINER */

            .student-thesis-page .thesis-card {

                background: transparent;

                border: 0;

                box-shadow: none;

            }


            /* RECORD CARD */

            .student-thesis-page .thesis-record-card {

                width: 100%;

                min-width: 0;

                padding: 11px;

                border-radius: 12px;

                box-shadow:
                    0 3px 12px rgba(15, 23, 42, .06);

                overflow: hidden;

                display: grid;

                grid-template-columns:
                    38px minmax(0, 1fr);

                column-gap: 8px;

                row-gap: 7px;

                align-content: start;

            }


            .student-thesis-page .thesis-record-card-main,
            .student-thesis-page .thesis-record-card-content {

                display: contents;

            }


            .student-thesis-page .thesis-record-card-pdf {

                grid-column: 1;
                grid-row: 1;

                width: 38px;
                height: 38px;

                border-radius: 9px;

                font-size: 22px;

            }


            .student-thesis-page .thesis-record-card-title {

                grid-column: 2;
                grid-row: 1;

                align-self: center;

                min-width: 0;

                margin: 0;

                font-size: 10.5px;

                line-height: 1.3;

                overflow-wrap: anywhere;

                word-break: break-word;

            }


            .student-thesis-page .thesis-record-card-row {

                grid-column: 1 / -1;

                width: 100%;

                min-width: 0;

                display: grid;

                grid-template-columns:
                    68px minmax(0, 1fr);

                gap: 5px;

                align-items: start;

                padding: 2px 0;

                margin: 0;

            }


            .student-thesis-page .thesis-record-card-label {

                display: block;

                min-width: 0;

                color: var(--st-text);

                font-size: 8px;

                font-weight: 750;

                line-height: 1.35;

                white-space: nowrap;

            }


            .student-thesis-page .thesis-record-card-label::after {

                content: none;

            }


            .student-thesis-page .thesis-record-card-value {

                display: block;

                min-width: 0;

                color: var(--st-text-secondary);

                font-size: 8px;

                line-height: 1.35;

                overflow-wrap: anywhere;

                word-break: break-word;

            }


            .student-thesis-page .thesis-record-card-action {

                grid-column: 1 / -1;

                width: 100%;

                min-width: 0;

                margin-top: 3px;

                padding-top: 7px;

                border-top: 1px solid var(--st-border-light);

            }


            /* MOBILE ACTION BUTTONS */

            .student-thesis-page
            .thesis-record-card-action
            .thesis-action-buttons {

                width: 100%;

                display: grid;

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

                gap: 6px;

            }


            .student-thesis-page
            .thesis-record-card-action
            .thesis-action-btn {

                width: 100%;

                min-width: 0;

                height: 36px;

                min-height: 36px;

                padding: 0;

                border-radius: 9px;

                font-size: 0 !important;

                line-height: 1;

                display: inline-flex;

                align-items: center;

                justify-content: center;

                gap: 0;

            }


            .student-thesis-page
            .thesis-record-card-action
            .thesis-action-btn i,
            .student-thesis-page
            .thesis-record-card-action
            .thesis-action-btn .bi,
            .student-thesis-page
            .thesis-record-card-action
            .thesis-action-btn .fa,
            .student-thesis-page
            .thesis-record-card-action
            .thesis-action-btn .fa-solid,
            .student-thesis-page
            .thesis-record-card-action
            .thesis-action-btn .fa-regular,
            .student-thesis-page
            .thesis-record-card-action
            .thesis-action-btn svg {

                display: inline-flex;

                align-items: center;
                justify-content: center;

                font-size: 16px !important;

                line-height: 1;

            }


            /* DARK MOBILE */

            [data-bs-theme="dark"]
            .student-thesis-page .thesis-record-card {

                background: var(--st-card);

                border-color: var(--st-border);

                box-shadow: none;

            }


            [data-bs-theme="dark"]
            .student-thesis-page .thesis-record-card-action {

                border-top-color: var(--st-border);

            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================= */

        @media (max-width: 576px) {

            .student-thesis-page {

                padding: 15px 10px 70px;

            }


            .student-thesis-page .page-title {

                font-size: 19px;

            }


            .student-thesis-page .page-subtitle {

                font-size: 10px;

            }


            .student-thesis-page .filter-card {

                padding: 15px;

                border-radius: 11px;

            }


            .student-thesis-page .filter-card .form-control,
            .student-thesis-page .filter-card .form-select,
            .student-thesis-page .btn-reset {

                height: 42px;

            }


            .student-thesis-page .thesis-record-card {

                padding: 9px;

            }

        }


        /* =========================================================
           VERY SMALL PHONE
        ========================================================= */

        @media (max-width: 380px) {

            .student-thesis-page {

                padding-left: 8px;
                padding-right: 8px;

            }


            .student-thesis-page .page-title {

                font-size: 17px;

            }


            .student-thesis-page .heading-icon {

                width: 37px;
                height: 37px;

                font-size: 14px;

            }


            .student-thesis-page .thesis-record-card {

                padding: 9px 8px;

            }


            .student-thesis-page .thesis-record-card-pdf {

                width: 36px;
                height: 36px;

                font-size: 21px;

            }


            .student-thesis-page .thesis-record-card-title {

                font-size: 10px;

            }

        }

    </style>


    {{-- =============================================================
        SEARCH / FILTER / VIEW SCRIPT
    ============================================================= --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const searchInput =
                document.getElementById('search');

            const departmentFilter =
                document.getElementById('departmentFilter');

            const yearFilter =
                document.getElementById('yearFilter');

            const resetFilter =
                document.getElementById('resetFilter');

            const studentTable =
                document.getElementById('studentTable');

            const filterForm =
                document.getElementById('thesisFilterForm');

            const thesisPage =
                document.querySelector('.student-thesis-page');

            const thesisCardView =
                document.getElementById('thesisCardView');

            const tableViewBtn =
                document.getElementById('tableViewBtn');

            const cardViewBtn =
                document.getElementById('cardViewBtn');


            /* =====================================================
               BUILD CARD VIEW
            ====================================================== */

            function buildCardView() {

                if (!studentTable || !thesisCardView) {
                    return;
                }


                thesisCardView.innerHTML = '';


                const rows =
                    studentTable.querySelectorAll('tr');


                rows.forEach(function (row) {

                    const cells =
                        row.querySelectorAll('td');


                    if (!cells.length) {
                        return;
                    }


                    /* EMPTY STATE */

                    if (cells.length === 1) {

                        const emptyCard =
                            document.createElement('div');

                        emptyCard.className =
                            'thesis-record-card';

                        emptyCard.innerHTML =
                            '<div class="thesis-record-card-value" style="text-align:center; display:block;">' +
                            cells[0].innerHTML +
                            '</div>';

                        thesisCardView.appendChild(
                            emptyCard
                        );

                        return;
                    }


                    if (cells.length < 8) {
                        return;
                    }


                    const card =
                        document.createElement('article');

                    card.className =
                        'thesis-record-card';


                    const title =
                        cells[1].textContent.trim() ||
                        'Untitled Thesis';


                    card.innerHTML = `

                        <div class="thesis-record-card-main">

                            <div
                                class="thesis-record-card-pdf"
                                aria-hidden="true"
                            >
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>


                            <div class="thesis-record-card-content">

                                <h3
                                    class="thesis-record-card-title"
                                ></h3>


                                <div class="thesis-record-card-row">

                                    <span class="thesis-record-card-label">
                                        Author
                                    </span>

                                    <span class="thesis-record-card-value"></span>

                                </div>


                                <div class="thesis-record-card-row">

                                    <span class="thesis-record-card-label">
                                        Department
                                    </span>

                                    <span class="thesis-record-card-value"></span>

                                </div>


                                <div class="thesis-record-card-row">

                                    <span class="thesis-record-card-label">
                                        Submitted By
                                    </span>

                                    <span class="thesis-record-card-value"></span>

                                </div>


                                <div class="thesis-record-card-row">

                                    <span class="thesis-record-card-label">
                                        Published By
                                    </span>

                                    <span class="thesis-record-card-value"></span>

                                </div>


                                <div class="thesis-record-card-row">

                                    <span class="thesis-record-card-label">
                                        Upload
                                    </span>

                                    <span class="thesis-record-card-value"></span>

                                </div>

                            </div>

                        </div>


                        <div class="thesis-record-card-action"></div>

                    `;


                    card.querySelector(
                        '.thesis-record-card-title'
                    ).textContent = title;


                    const values =
                        card.querySelectorAll(
                            '.thesis-record-card-value'
                        );


                    values[0].textContent =
                        cells[2].textContent.trim();


                    values[1].textContent =
                        cells[3].textContent.trim();


                    values[2].textContent =
                        cells[4].textContent.trim();


                    values[3].textContent =
                        cells[5].textContent.trim();


                    values[4].innerHTML =
                        cells[6].innerHTML;


                    card.querySelector(
                        '.thesis-record-card-action'
                    ).innerHTML =
                        cells[7].innerHTML;


                    thesisCardView.appendChild(card);

                });

            }


            /* =====================================================
               SET VIEW
            ====================================================== */

            function setView(view) {

                if (
                    !thesisPage ||
                    !tableViewBtn ||
                    !cardViewBtn
                ) {
                    return;
                }


                const isMobile =
                    window.matchMedia(
                        '(max-width: 768px)'
                    ).matches;


                /* MOBILE ALWAYS CARD */

                if (isMobile) {
                    view = 'card';
                }


                if (view === 'card') {

                    thesisPage.classList.add(
                        'card-view-active'
                    );


                    tableViewBtn.classList.remove(
                        'active'
                    );


                    cardViewBtn.classList.add(
                        'active'
                    );


                    buildCardView();

                } else {

                    thesisPage.classList.remove(
                        'card-view-active'
                    );


                    cardViewBtn.classList.remove(
                        'active'
                    );


                    tableViewBtn.classList.add(
                        'active'
                    );

                }


                localStorage.setItem(
                    'studentThesisView',
                    view
                );

            }


            /* =====================================================
               TABLE BUTTON
            ====================================================== */

            if (tableViewBtn) {

                tableViewBtn.addEventListener(
                    'click',
                    function () {

                        setView('table');

                    }
                );

            }


            /* =====================================================
               CARD BUTTON
            ====================================================== */

            if (cardViewBtn) {

                cardViewBtn.addEventListener(
                    'click',
                    function () {

                        setView('card');

                    }
                );

            }


            /* =====================================================
               CHECK REQUIRED ELEMENTS
            ====================================================== */

            if (
                !searchInput ||
                !departmentFilter ||
                !yearFilter ||
                !resetFilter ||
                !studentTable ||
                !filterForm
            ) {

                console.error(
                    'Thesis search/filter elements were not found.'
                );

                return;

            }


            let searchTimer = null;

            let currentRequest = null;


            /* =====================================================
               LOAD THESIS DATA
            ====================================================== */

            function loadThesisData() {

                const search =
                    searchInput.value.trim();

                const department =
                    departmentFilter.value;

                const year =
                    yearFilter.value;


                const params =
                    new URLSearchParams();


                params.set(
                    'search',
                    search
                );


                params.set(
                    'department',
                    department
                );


                params.set(
                    'year',
                    year
                );


                const url =
                    "{{ route('student.thesis.search') }}" +
                    "?" +
                    params.toString();


                /* CANCEL PREVIOUS REQUEST */

                if (currentRequest) {
                    currentRequest.abort();
                }


                currentRequest =
                    new AbortController();


                studentTable.classList.add(
                    'search-loading'
                );


                fetch(url, {

                    method: 'GET',

                    signal:
                        currentRequest.signal,

                    headers: {

                        'X-Requested-With':
                            'XMLHttpRequest',

                        'Accept':
                            'text/html'

                    }

                })

                .then(function (response) {

                    if (!response.ok) {

                        throw new Error(
                            'Search request failed: ' +
                            response.status
                        );

                    }

                    return response.text();

                })

                .then(function (html) {

                    studentTable.innerHTML =
                        html;


                    if (
                        thesisPage &&
                        thesisPage.classList.contains(
                            'card-view-active'
                        )
                    ) {

                        buildCardView();

                    }

                })

                .catch(function (error) {

                    if (
                        error.name ===
                        'AbortError'
                    ) {
                        return;
                    }


                    console.error(
                        'Thesis search error:',
                        error
                    );

                })

                .finally(function () {

                    studentTable.classList.remove(
                        'search-loading'
                    );

                });

            }


            /* =====================================================
               SEARCH
            ====================================================== */

            searchInput.addEventListener(
                'input',
                function () {

                    clearTimeout(
                        searchTimer
                    );


                    searchTimer =
                        setTimeout(
                            function () {

                                loadThesisData();

                            },
                            300
                        );

                }
            );


            /* =====================================================
               DEPARTMENT
            ====================================================== */

            departmentFilter.addEventListener(
                'change',
                function () {

                    loadThesisData();

                }
            );


            /* =====================================================
               YEAR
            ====================================================== */

            yearFilter.addEventListener(
                'change',
                function () {

                    loadThesisData();

                }
            );


            /* =====================================================
               RESET
            ====================================================== */

            resetFilter.addEventListener(
                'click',
                function () {

                    clearTimeout(
                        searchTimer
                    );


                    searchInput.value = '';

                    departmentFilter.value = '';

                    yearFilter.value = '';


                    loadThesisData();


                    setTimeout(
                        function () {

                            searchInput.focus();

                        },
                        100
                    );

                }
            );


            /* =====================================================
               PREVENT FORM SUBMIT
            ====================================================== */

            filterForm.addEventListener(
                'submit',
                function (event) {

                    event.preventDefault();

                    loadThesisData();

                }
            );


            /* =====================================================
               INITIAL VIEW
            ====================================================== */

            const savedView =
                localStorage.getItem(
                    'studentThesisView'
                );


            const isMobile =
                window.matchMedia(
                    '(max-width: 768px)'
                ).matches;


            setView(

                isMobile
                    ? 'card'
                    : (
                        savedView === 'card'
                            ? 'card'
                            : 'table'
                    )

            );


            /* =====================================================
               RESPONSIVE VIEW
            ====================================================== */

            let wasMobile =
                isMobile;


            window.addEventListener(
                'resize',
                function () {

                    const nowMobile =
                        window.matchMedia(
                            '(max-width: 768px)'
                        ).matches;


                    if (
                        nowMobile !==
                        wasMobile
                    ) {

                        wasMobile =
                            nowMobile;


                        if (nowMobile) {

                            setView('card');

                        } else {

                            const currentView =
                                localStorage.getItem(
                                    'studentThesisView'
                                ) || 'table';


                            setView(

                                currentView === 'card'
                                    ? 'card'
                                    : 'table'

                            );

                        }

                    }

                }
            );

        });

    </script>

</x-app-layout>