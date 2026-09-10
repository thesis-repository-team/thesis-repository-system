<x-app-layout>

    <div class="dashboard-content history-page">

        <div class="page-header">

            <div>
                <div class="page-title-wrapper">

                    <div class="page-title-icon">
                        <i class="fas fa-history"></i>
                    </div>

                    <div>
                        <h2 class="page-title">View History</h2>

                        <p class="page-subtitle">
                            Review the theses you have viewed previously.
                        </p>
                    </div>

                </div>
            </div>

            <a
                href="{{ route('student.thesis.index') }}"
                class="browse-button"
            >
                <i class="fas fa-search"></i>
                <span>Browse Theses</span>
            </a>

        </div>


        {{-- =========================================================
             MAIN HISTORY CARD
        ========================================================== --}}

        <div class="history-card">

            <div class="history-card-body">

                @if ($histories->count())

                    {{-- =================================================
                         VIEW TOGGLE
                    ================================================== --}}

                    <div class="history-view-toolbar">

                        <div
                            class="history-view-toggle"
                            role="group"
                            aria-label="History view"
                        >

                            <button
                                type="button"
                                class="history-view-button active"
                                data-history-view="card"
                                aria-pressed="true"
                            >
                                <i class="fas fa-grip"></i>
                                <span>Card</span>
                            </button>

                            <button
                                type="button"
                                class="history-view-button"
                                data-history-view="table"
                                aria-pressed="false"
                            >
                                <i class="fas fa-table"></i>
                                <span>Table</span>
                            </button>

                        </div>

                    </div>


                    {{-- =================================================
                         CARD VIEW
                    ================================================== --}}

                    <div class="history-card-view">

                        <div class="history-card-grid">

                            @foreach ($histories as $history)

                                @if ($history->thesis)

                                    @php
                                        $thesis = $history->thesis;
                                    @endphp

                                    <div class="history-item-card">

                                        {{-- =================================
                                             CARD HEADER
                                        ================================== --}}

                                        <div class="history-item-header">

                                            <div class="history-item-title-area">

                                                <div class="history-item-icon">
                                                    <i class="fas fa-file-lines"></i>
                                                </div>

                                                <div class="history-item-heading">

                                                    <span class="history-item-number">
                                                        ID: {{ $loop->iteration }}
                                                    </span>

                                                    <h4>
                                                        {{ $thesis->title }}
                                                    </h4>

                                                    <span class="history-thesis-id">
                                                        Thesis ID: {{ $thesis->id }}
                                                    </span>

                                                </div>

                                            </div>

                                        </div>


                                        {{-- =================================
                                             CARD INFORMATION
                                        ================================== --}}

                                        <div class="history-item-info">

                                            <div class="history-info-row">

                                                <span class="history-info-label">
                                                    <i class="fas fa-user"></i>
                                                    Author
                                                </span>

                                                <strong>
                                                    {{ $thesis->author_name ?? 'N/A' }}
                                                </strong>

                                            </div>


                                            <div class="history-info-row">

                                                <span class="history-info-label">
                                                    <i class="far fa-calendar-alt"></i>
                                                    Viewed
                                                </span>

                                                <strong>

                                                    @if ($history->viewed_at)

                                                        {{ $history->viewed_at->format('M d, Y h:i A') }}

                                                    @else

                                                        N/A

                                                    @endif

                                                </strong>

                                            </div>

                                        </div>


                                        {{-- =================================
                                             CARD ACTIONS
                                        ================================== --}}

                                        <div class="history-item-actions">

                                            @if ($thesis->files && $thesis->files->count())

                                                @foreach ($thesis->files as $file)

                                                    <a
                                                        href="{{ route('student.thesis.view-pdf', ['file' => $file->id]) }}"
                                                        target="_blank"
                                                        class="action-btn view-pdf-btn"
                                                        title="View PDF"
                                                        aria-label="View PDF"
                                                    >
                                                        <i class="fas fa-file-pdf"></i>
                                                        <span>View PDF</span>
                                                    </a>


                                                    <a
                                                        href="{{ route('student.thesis.download', $file) }}"
                                                        class="action-btn download-btn"
                                                        title="Download"
                                                        aria-label="Download"
                                                    >
                                                        <i class="fas fa-download"></i>
                                                        <span>Download</span>
                                                    </a>

                                                @endforeach

                                            @else

                                                <span class="no-pdf">

                                                    <i class="fas fa-file-circle-xmark"></i>

                                                    <span>No PDF</span>

                                                </span>

                                            @endif


                                            {{-- SAVE THESIS --}}

                                            @if (
                                                isset($savedThesisIds) &&
                                                in_array($thesis->id, $savedThesisIds)
                                            )

                                                <form
                                                    action="{{ route('student.saved_thesis.destroy', $thesis->id) }}"
                                                    method="POST"
                                                    class="save-thesis-form"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="save-btn saved"
                                                        title="Remove saved thesis"
                                                        aria-label="Remove saved thesis"
                                                    >
                                                        <i class="fas fa-bookmark"></i>
                                                    </button>

                                                </form>

                                            @else

                                                <form
                                                    action="{{ route('student.saved_thesis.store', $thesis->id) }}"
                                                    method="POST"
                                                    class="save-thesis-form"
                                                >

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="save-btn"
                                                        title="Save thesis"
                                                        aria-label="Save thesis"
                                                    >
                                                        <i class="far fa-bookmark"></i>
                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </div>

                                @endif

                            @endforeach

                        </div>

                    </div>


                    {{-- =================================================
                         TABLE VIEW
                    ================================================== --}}

                    <div
                        class="history-table-view"
                        hidden
                    >

                        <div class="history-table-wrapper">

                            <table class="history-table">

                                <thead>

                                    <tr>

                                        <th class="number-column">
                                            ID
                                        </th>

                                        <th>
                                            Thesis Title
                                        </th>

                                        <th>
                                            Author
                                        </th>

                                        <th>
                                            Viewed At
                                        </th>

                                        <th class="action-column">
                                            Action
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach ($histories as $history)

                                        @if ($history->thesis)

                                            @php
                                                $thesis = $history->thesis;
                                            @endphp

                                            <tr>

                                                {{-- ID --}}

                                                <td class="number-cell">

                                                    <span class="history-number">
                                                        {{ $loop->iteration }}
                                                    </span>

                                                </td>


                                                {{-- THESIS --}}

                                                <td class="thesis-cell">

                                                    <div class="thesis-info">

                                                        <div class="thesis-icon">
                                                            <i class="fas fa-file-lines"></i>
                                                        </div>

                                                        <div class="thesis-text">

                                                            <strong>
                                                                {{ $thesis->title }}
                                                            </strong>

                                                            <span>
                                                                Thesis ID: {{ $thesis->id }}
                                                            </span>

                                                        </div>

                                                    </div>

                                                </td>


                                                {{-- AUTHOR --}}

                                                <td class="author-cell">

                                                    <div class="author-info">

                                                        <div class="author-avatar">
                                                            <i class="fas fa-user"></i>
                                                        </div>

                                                        <span>
                                                            {{ $thesis->author_name ?? 'N/A' }}
                                                        </span>

                                                    </div>

                                                </td>


                                                {{-- VIEWED DATE --}}

                                                <td class="date-cell">

                                                    <div class="date-info">

                                                        <i class="far fa-calendar-alt"></i>

                                                        <div>

                                                            <strong>

                                                                @if ($history->viewed_at)

                                                                    {{ $history->viewed_at->format('M d, Y') }}

                                                                @else

                                                                    N/A

                                                                @endif

                                                            </strong>


                                                            <span>

                                                                @if ($history->viewed_at)

                                                                    {{ $history->viewed_at->format('h:i A') }}

                                                                @else

                                                                    N/A

                                                                @endif

                                                            </span>

                                                        </div>

                                                    </div>

                                                </td>


                                                {{-- ACTIONS --}}

                                                <td class="action-cell">

                                                    <div class="action-buttons">

                                                        @if ($thesis->files && $thesis->files->count())

                                                            @foreach ($thesis->files as $file)

                                                                <a
                                                                    href="{{ route('student.thesis.view-pdf', ['file' => $file->id]) }}"
                                                                    target="_blank"
                                                                    class="action-btn view-pdf-btn"
                                                                    title="View PDF"
                                                                >
                                                                    <i class="fas fa-file-pdf"></i>
                                                                    <span>View PDF</span>
                                                                </a>


                                                                <a
                                                                    href="{{ route('student.thesis.download', $file) }}"
                                                                    class="action-btn download-btn"
                                                                    title="Download"
                                                                >
                                                                    <i class="fas fa-download"></i>
                                                                    <span>Download</span>
                                                                </a>

                                                            @endforeach

                                                        @else

                                                            <span class="no-pdf">

                                                                <i class="fas fa-file-circle-xmark"></i>

                                                                <span>No PDF</span>

                                                            </span>

                                                        @endif


                                                        {{-- SAVE BUTTON --}}

                                                        @if (
                                                            isset($savedThesisIds) &&
                                                            in_array($thesis->id, $savedThesisIds)
                                                        )

                                                            <form
                                                                action="{{ route('student.saved_thesis.destroy', $thesis->id) }}"
                                                                method="POST"
                                                                class="save-thesis-form"
                                                            >

                                                                @csrf

                                                                @method('DELETE')

                                                                <button
                                                                    type="submit"
                                                                    class="save-btn saved"
                                                                    title="Remove saved thesis"
                                                                    aria-label="Remove saved thesis"
                                                                >
                                                                    <i class="fas fa-bookmark"></i>
                                                                </button>

                                                            </form>

                                                        @else

                                                            <form
                                                                action="{{ route('student.saved_thesis.store', $thesis->id) }}"
                                                                method="POST"
                                                                class="save-thesis-form"
                                                            >

                                                                @csrf

                                                                <button
                                                                    type="submit"
                                                                    class="save-btn"
                                                                    title="Save thesis"
                                                                    aria-label="Save thesis"
                                                                >
                                                                    <i class="far fa-bookmark"></i>
                                                                </button>

                                                            </form>

                                                        @endif

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

                    {{-- =================================================
                         EMPTY HISTORY
                    ================================================== --}}

                    <div class="empty-history">

                        <div class="empty-icon">
                            <i class="fas fa-history"></i>
                        </div>

                        <h4>
                            No View History
                        </h4>

                        <p>
                            You have not viewed any thesis yet.
                        </p>

                        <a
                            href="{{ route('student.thesis.index') }}"
                            class="empty-button"
                        >
                            <i class="fas fa-search"></i>
                            Browse Theses
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
         PAGE CSS
    ========================================================== --}}

    <style>

        /* =========================================================
           PAGE
        ========================================================== */

        .history-page {

            --history-purple: #6538d9;
            --history-purple-dark: #5030b8;
            --history-purple-light: #eee8ff;

            --history-text: #151a3b;
            --history-muted: #6d7392;

            --history-border: #e8e8f0;

            /* CARD BACKGROUND */
            --history-card: #ffffff;

            /* PAGE BACKGROUND */
            --history-page-bg: #f4f5f9;

            --history-shadow:
                0 5px 20px rgba(30, 25, 70, .07);

            min-height: 100vh;

            background: var(--history-page-bg);

            color: var(--history-text);

            font-family:
                "Inter",
                "Segoe UI",
                Arial,
                sans-serif;

            padding:
                118px
                18px
                35px;

            box-sizing: border-box;

        }


        /* =========================================================
           PAGE HEADER
        ========================================================== */

        .history-page .page-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 22px;

        }


        .page-title-wrapper {

            display: flex;

            align-items: center;

            gap: 14px;

        }


        .page-title-icon {

            width: 48px;

            height: 48px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 12px;

            background: var(--history-purple-light);

            color: var(--history-purple);

            font-size: 21px;

            flex-shrink: 0;

        }


        .page-title {

            margin: 0;

            font-size: 23px;

            line-height: 1.2;

            font-weight: 700;

            color: var(--history-text);

        }


        .page-subtitle {

            margin: 5px 0 0;

            font-size: 13px;

            color: var(--history-muted);

        }


        /* =========================================================
           BROWSE BUTTON
        ========================================================== */

        .browse-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            padding: 11px 17px;

            border-radius: 9px;

            background: var(--history-purple);

            color: #ffffff;

            text-decoration: none;

            font-size: 13px;

            font-weight: 600;

            transition:
                background .2s ease,
                transform .2s ease,
                box-shadow .2s ease;

            white-space: nowrap;

        }


        .browse-button:hover {

            background: var(--history-purple-dark);

            color: #ffffff;

            transform: translateY(-1px);

            box-shadow:
                0 5px 15px rgba(101, 56, 217, .22);

        }


        /* =========================================================
           MAIN HISTORY CONTAINER
        ========================================================== */

        .history-card {

            width: 100%;

            /* background: var(--history-card); */

            /* border: 1px solid var(--history-border); */

            border-radius: 13px;

            

            /* box-shadow: var(--history-shadow); */

            overflow: hidden;

        }


        /* .history-card-body {

            padding: 20px;

        } */


        /* =========================================================
           VIEW TOOLBAR
        ========================================================== */

        .history-view-toolbar {

            display: flex;

            justify-content: flex-end;

            align-items: center;

            margin-bottom: 18px;

        }


        .history-view-toggle {

            display: inline-flex;

            align-items: center;

            padding: 3px;

            gap: 2px;

            background: var(--history-card);

            border: 1px solid var(--history-border);

            border-radius: 9px;

            box-shadow:
                0 3px 10px rgba(30, 25, 70, .05);

        }


        .history-view-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            min-width: 85px;

            padding: 8px 12px;

            border: none;

            border-radius: 7px;

            background: transparent;

            color: var(--history-muted);

            font-size: 12px;

            font-weight: 600;

            cursor: pointer;

            transition:
                background .2s ease,
                color .2s ease;

        }


        .history-view-button:hover {

            color: var(--history-purple);

        }


        .history-view-button.active {

            background: var(--history-purple);

            color: #ffffff;

        }


        /* =========================================================
           CARD GRID
        ========================================================== */

        .history-card-grid {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 16px;

        }


        /* =========================================================
           HISTORY ITEM CARD
        ========================================================== */

        .history-item-card {

            /*
             * IMPORTANT:
             * This is the card background.
             */
            background: #ffffff;

            border: 1px solid var(--history-border);

            border-radius: 12px;

            padding: 16px;

            box-shadow:
                0 4px 14px rgba(30, 25, 70, .055);

            min-width: 0;

            display: flex;

            flex-direction: column;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;

        }


        .history-item-card:hover {

            transform: translateY(-2px);

            border-color: #dcd7ef;

            box-shadow:
                0 8px 22px rgba(30, 25, 70, .09);

        }


        /* =========================================================
           ITEM HEADER
        ========================================================== */

        .history-item-header {

            margin-bottom: 15px;

        }


        .history-item-title-area {

            display: flex;

            align-items: flex-start;

            gap: 12px;

        }


        .history-item-icon {

            width: 42px;

            height: 42px;

            min-width: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 10px;

            background: var(--history-purple-light);

            color: var(--history-purple);

            font-size: 17px;

        }


        .history-item-heading {

            min-width: 0;

            flex: 1;

        }


        .history-item-number {

            display: block;

            margin-bottom: 4px;

            font-size: 10px;

            font-weight: 700;

            color: var(--history-purple);

            text-transform: uppercase;

            letter-spacing: .3px;

        }


        .history-item-heading h4 {

            margin: 0;

            color: var(--history-text);

            font-size: 14px;

            line-height: 1.4;

            font-weight: 700;

            display: -webkit-box;

            -webkit-line-clamp: 2;

            -webkit-box-orient: vertical;

            overflow: hidden;

        }


        .history-thesis-id {

            display: block;

            margin-top: 5px;

            font-size: 10px;

            color: var(--history-muted);

        }


        /* =========================================================
           ITEM INFORMATION
        ========================================================== */

        .history-item-info {

            display: flex;

            flex-direction: column;

            gap: 9px;

            padding: 13px 0;

            border-top: 1px solid var(--history-border);

            border-bottom: 1px solid var(--history-border);

        }


        .history-info-row {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

        }


        .history-info-label {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            color: var(--history-muted);

            font-size: 11px;

            font-weight: 500;

        }


        .history-info-label i {

            width: 14px;

            text-align: center;

            color: var(--history-purple);

        }


        .history-info-row strong {

            max-width: 60%;

            text-align: right;

            font-size: 11px;

            font-weight: 600;

            color: var(--history-text);

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =========================================================
           ITEM ACTIONS
        ========================================================== */

        .history-item-actions {

            display: flex;

            align-items: center;

            gap: 6px;

            padding-top: 13px;

            margin-top: auto;

            min-width: 0;

        }


        .action-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 5px;

            min-height: 32px;

            padding: 7px 9px;

            border-radius: 7px;

            text-decoration: none;

            border: 1px solid transparent;

            font-size: 10px;

            font-weight: 600;

            white-space: nowrap;

            transition:
                background .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .2s ease;

        }


        .action-btn:hover {

            transform: translateY(-1px);

        }


        /* VIEW PDF */

        .view-pdf-btn {

            background: #eaf8ef;

            color: #188447;

            border-color: #d2efdc;

        }


        .view-pdf-btn:hover {

            background: #188447;

            color: #ffffff;

            border-color: #188447;

        }


        /* DOWNLOAD */

        .download-btn {

            background: #edf4ff;

            color: #2868c7;

            border-color: #d8e7ff;

        }


        .download-btn:hover {

            background: #2868c7;

            color: #ffffff;

            border-color: #2868c7;

        }


        /* SAVE */

        .save-thesis-form {

            margin: 0;

            margin-left: auto;

            display: flex;

        }


        .save-btn {

            width: 32px;

            height: 32px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 0;

            border: 1px solid #e0d9f7;

            border-radius: 7px;

            background: #f7f4ff;

            color: var(--history-purple);

            cursor: pointer;

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;

        }


        .save-btn:hover {

            background: var(--history-purple);

            color: #ffffff;

            transform: translateY(-1px);

        }


        .save-btn.saved {

            background: var(--history-purple);

            color: #ffffff;

            border-color: var(--history-purple);

        }


        .no-pdf {

            display: inline-flex;

            align-items: center;

            gap: 5px;

            color: #a04c4c;

            background: #fff1f1;

            border: 1px solid #f2d7d7;

            border-radius: 7px;

            padding: 7px 9px;

            font-size: 10px;

            font-weight: 600;

        }


        /* =========================================================
           TABLE
        ========================================================== */

        .history-table-view {

            width: 100%;

        }


        .history-table-wrapper {

            width: 100%;

            overflow-x: auto;

            border: 1px solid var(--history-border);

            border-radius: 10px;

        }


        .history-table {

            width: 100%;

            min-width: 900px;

            border-collapse: collapse;

            background: var(--history-card);

        }


        .history-table thead th {

            padding: 11px 12px;

            background: #f7f7fb;

            border-bottom: 1px solid var(--history-border);

            color: var(--history-muted);

            font-size: 10px;

            font-weight: 700;

            text-align: left;

            text-transform: uppercase;

            letter-spacing: .35px;

            white-space: nowrap;

        }


        .history-table tbody td {

            padding: 11px 12px;

            border-bottom: 1px solid var(--history-border);

            color: var(--history-text);

            font-size: 11px;

            vertical-align: middle;

        }


        .history-table tbody tr:last-child td {

            border-bottom: none;

        }


        .history-table tbody tr {

            transition: background .2s ease;

        }


        .history-table tbody tr:hover {

            background: #faf9ff;

        }


        .number-column {

            width: 55px;

        }


        .number-cell {

            text-align: center;

        }


        .history-number {

            width: 27px;

            height: 27px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            border-radius: 7px;

            background: var(--history-purple-light);

            color: var(--history-purple);

            font-size: 10px;

            font-weight: 700;

        }


        /* =========================================================
           THESIS TABLE CELL
        ========================================================== */

        .thesis-cell {

            min-width: 270px;

        }


        .thesis-info {

            display: flex;

            align-items: center;

            gap: 10px;

            min-width: 0;

        }


        .thesis-icon {

            width: 34px;

            height: 34px;

            min-width: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 8px;

            background: var(--history-purple-light);

            color: var(--history-purple);

            font-size: 14px;

        }


        .thesis-text {

            min-width: 0;

            display: flex;

            flex-direction: column;

            gap: 3px;

        }


        .thesis-text strong {

            font-size: 11px;

            font-weight: 700;

            color: var(--history-text);

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            max-width: 330px;

        }


        .thesis-text span {

            font-size: 9px;

            color: var(--history-muted);

        }


        /* =========================================================
           AUTHOR
        ========================================================== */

        .author-info {

            display: flex;

            align-items: center;

            gap: 8px;

            white-space: nowrap;

        }


        .author-avatar {

            width: 28px;

            height: 28px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #f1f1f6;

            color: var(--history-muted);

            font-size: 11px;

        }


        .author-cell span {

            font-size: 11px;

            color: var(--history-text);

        }


        /* =========================================================
           DATE
        ========================================================== */

        .date-info {

            display: flex;

            align-items: center;

            gap: 8px;

        }


        .date-info > i {

            color: var(--history-purple);

            font-size: 14px;

        }


        .date-info > div {

            display: flex;

            flex-direction: column;

            gap: 2px;

        }


        .date-info strong {

            font-size: 10px;

            color: var(--history-text);

        }


        .date-info span {

            font-size: 9px;

            color: var(--history-muted);

        }


        /* =========================================================
           TABLE ACTION
        ========================================================== */

        .action-column {

            width: 230px;

        }


        .action-buttons {

            display: flex;

            align-items: center;

            gap: 6px;

        }


        .action-cell .save-thesis-form {

            margin-left: 0;

        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .empty-history {

            min-height: 350px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            text-align: center;

            padding: 40px 20px;

        }


        .empty-icon {

            width: 68px;

            height: 68px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 16px;

            border-radius: 50%;

            background: var(--history-purple-light);

            color: var(--history-purple);

            font-size: 27px;

        }


        .empty-history h4 {

            margin: 0 0 7px;

            font-size: 17px;

            font-weight: 700;

            color: var(--history-text);

        }


        .empty-history p {

            margin: 0 0 18px;

            color: var(--history-muted);

            font-size: 12px;

        }


        .empty-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 10px 16px;

            border-radius: 8px;

            background: var(--history-purple);

            color: #ffffff;

            text-decoration: none;

            font-size: 12px;

            font-weight: 600;

            transition:
                background .2s ease,
                transform .2s ease;

        }


        .empty-button:hover {

            background: var(--history-purple-dark);

            color: #ffffff;

            transform: translateY(-1px);

        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] .history-page {

            --history-page-bg: #101426;

            --history-card: #181d33;

            --history-border: #292e45;

            --history-text: #f5f5fb;

            --history-muted: #999fb9;

            --history-shadow:
                0 5px 20px rgba(0, 0, 0, .20);

        }


        [data-bs-theme="dark"] .history-item-card {

            background: #181d33;

            border-color: #292e45;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, .18);

        }


        [data-bs-theme="dark"] .history-item-card:hover {

            border-color: #3b4160;

            box-shadow:
                0 8px 24px rgba(0, 0, 0, .25);

        }


        [data-bs-theme="dark"] .history-table thead th {

            background: #20253b;

        }


        [data-bs-theme="dark"] .history-table tbody tr:hover {

            background: #1d2238;

        }


        [data-bs-theme="dark"] .author-avatar {

            background: #252a41;

            color: #aeb4cd;

        }


        [data-bs-theme="dark"] .history-view-toggle {

            background: #181d33;

        }


        [data-bs-theme="dark"] .history-view-button {

            color: #999fb9;

        }


        [data-bs-theme="dark"] .view-pdf-btn {

            background: rgba(24, 132, 71, .15);

            border-color: rgba(24, 132, 71, .30);

            color: #65d595;

        }


        [data-bs-theme="dark"] .download-btn {

            background: rgba(40, 104, 199, .15);

            border-color: rgba(40, 104, 199, .30);

            color: #75a9f5;

        }


        [data-bs-theme="dark"] .save-btn {

            background: #242942;

            border-color: #353b58;

            color: #a994f3;

        }


        [data-bs-theme="dark"] .save-btn.saved {

            background: var(--history-purple);

            border-color: var(--history-purple);

            color: #ffffff;

        }


        [data-bs-theme="dark"] .no-pdf {

            background: rgba(160, 76, 76, .14);

            border-color: rgba(160, 76, 76, .28);

            color: #ef9696;

        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1200px) {

            .history-card-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

            }

        }


        @media (max-width: 1000px) {

            .history-card-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

            }

        }


        @media (max-width: 700px) {

            .history-page {

                padding:
                    90px
                    12px
                    80px;

            }


            .history-page .page-header {

                flex-direction: column;

                align-items: stretch;

            }


            .page-title-wrapper {

                align-items: flex-start;

            }


            .browse-button {

                width: 100%;

            }


            .history-card-body {

                padding: 14px;

            }


            /*
             * On small screens the card view is easier to use.
             */
            .history-view-toolbar {

                display: none;

            }


            .history-card-view {

                display: block !important;

            }


            .history-table-view {

                display: none !important;

            }


            .history-card-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 10px;

            }


            .history-item-card {

                padding: 12px;

            }


            .history-item-title-area {

                gap: 8px;

            }


            .history-item-icon {

                width: 35px;

                height: 35px;

                min-width: 35px;

                font-size: 14px;

            }


            .history-item-heading h4 {

                font-size: 12px;

            }


            .history-item-number {

                font-size: 8px;

            }


            .history-thesis-id {

                font-size: 8px;

            }


            .history-info-label {

                font-size: 9px;

            }


            .history-info-row strong {

                font-size: 9px;

            }


            .history-item-actions {

                gap: 4px;

            }


            .action-btn {

                width: 30px;

                min-width: 30px;

                height: 30px;

                min-height: 30px;

                padding: 0;

                font-size: 11px;

            }


            .action-btn span {

                display: none;

            }


            .save-btn {

                width: 30px;

                height: 30px;

            }


            .no-pdf {

                width: 30px;

                height: 30px;

                padding: 0;

                justify-content: center;

            }


            .no-pdf span {

                display: none;

            }

        }


        @media (max-width: 450px) {

            .history-page {

                padding-left: 9px;

                padding-right: 9px;

            }


            .history-card-body {

                padding: 10px;

            }


            .history-card-grid {

                grid-template-columns: 1fr;

                gap: 10px;

            }


            .history-item-card {

                padding: 13px;

            }


            .page-title {

                font-size: 20px;

            }


            .page-title-icon {

                width: 42px;

                height: 42px;

                font-size: 18px;

            }

        }


        @media (max-width: 380px) {

            .history-page {

                padding-top: 85px;

            }


            .history-item-actions {

                gap: 3px;

            }


            .action-btn,
            .save-btn,
            .no-pdf {

                width: 28px;

                min-width: 28px;

                height: 28px;

                min-height: 28px;

            }

        }

    </style>


    {{-- =========================================================
         VIEW TOGGLE JAVASCRIPT
    ========================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const viewButtons =
                document.querySelectorAll('.history-view-button');

            const cardView =
                document.querySelector('.history-card-view');

            const tableView =
                document.querySelector('.history-table-view');


            if (!viewButtons.length || !cardView || !tableView) {
                return;
            }


            viewButtons.forEach(function (button) {

                button.addEventListener('click', function () {

                    const selectedView =
                        this.dataset.historyView;


                    viewButtons.forEach(function (btn) {

                        btn.classList.remove('active');

                        btn.setAttribute(
                            'aria-pressed',
                            'false'
                        );

                    });


                    this.classList.add('active');

                    this.setAttribute(
                        'aria-pressed',
                        'true'
                    );


                    if (
                        selectedView === 'table' &&
                        window.innerWidth > 700
                    ) {

                        cardView.hidden = true;

                        tableView.hidden = false;

                    } else {

                        cardView.hidden = false;

                        tableView.hidden = true;

                    }

                });

            });


            /*
             * Always return to card view on mobile.
             */
            function handleResponsiveView() {

                if (window.innerWidth <= 700) {

                    cardView.hidden = false;

                    tableView.hidden = true;

                }

            }


            handleResponsiveView();


            window.addEventListener(
                'resize',
                handleResponsiveView
            );

        });

    </script>

</x-app-layout>