<x-app-layout>

    <div class="dashboard-content history-page">

        <div class="history-container">

            {{-- =====================================================
        PAGE HEADER
    ====================================================== --}}

            <div class="page-header">

                <div>
                    <div class="page-title-wrapper">

                        <div class="page-title-icon">
                            <i class="fas fa-history"></i>
                        </div>

                        <div>
                            <h2 class="page-title">
                                View History
                            </h2>

                            <p class="page-subtitle">
                                Review the theses you have viewed previously.
                            </p>
                        </div>

                    </div>
                </div>

                <a href="{{ route('student.thesis.index') }}" class="browse-button">
                    <i class="fas fa-search"></i>
                    <span>Browse Theses</span>
                </a>

            </div>


            {{-- =====================================================
        HISTORY CARD
    ====================================================== --}}

            <div class="history-card">

                <div class="history-card-header">

                    @if ($histories->count())
                        <div class="history-count">
                            {{ $histories->count() }}
                            <span>Viewed</span>
                        </div>
                    @endif

                </div>


                <div class="history-card-body">

                    @if ($histories->count())

                        {{-- =================================================
                    VIEW SWITCHER
                ================================================== --}}

                        <div class="history-view-toolbar">

                            <div class="history-view-toggle" role="group" aria-label="History view">

                                <button type="button" class="history-view-button active" data-history-view="card"
                                    aria-pressed="true">

                                    <i class="fas fa-grip"></i>
                                    <span>Card</span>

                                </button>

                                <button type="button" class="history-view-button" data-history-view="table"
                                    aria-pressed="false">

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

                                            {{-- Card Header --}}

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


                                            {{-- Card Information --}}

                                            <div class="history-item-info">

                                                <div class="history-info-row">

                                                    <span class="history-info-label">

                                                        <i class="fas fa-user"></i>
                                                        Author

                                                    </span>

                                                    <strong>
                                                        {{ $thesis->author_name }}
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


                                            {{-- Card Actions --}}

                                            <div class="history-item-actions">

                                                @if ($thesis->files && $thesis->files->count())
                                                    @foreach ($thesis->files as $file)
                                                        <a href="{{ route('student.thesis.view-pdf', ['file' => $file->id]) }}"
                                                            target="_blank" class="action-btn view-pdf-btn"
                                                            title="View PDF" aria-label="View PDF">

                                                            <i class="fas fa-file-pdf"></i>
                                                            <span>View PDF</span>

                                                        </a>


                                                        <a href="{{ route('student.thesis.download', $file) }}"
                                                            class="action-btn download-btn" title="Download"
                                                            aria-label="Download">

                                                            <i class="fas fa-download"></i>
                                                            <span>Download</span>

                                                        </a>
                                                    @endforeach
                                                @else
                                                    <span class="no-pdf">

                                                        <i class="fas fa-file-circle-xmark"></i>
                                                        No PDF

                                                    </span>
                                                @endif


                                                {{-- Save / Remove --}}

                                                @if (isset($savedThesisIds) && in_array($thesis->id, $savedThesisIds))
                                                    <form
                                                        action="{{ route('student.saved_thesis.destroy', $thesis->id) }}"
                                                        method="POST" class="save-thesis-form">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="save-btn saved"
                                                            title="Remove saved thesis"
                                                            aria-label="Remove saved thesis">

                                                            <i class="fas fa-bookmark"></i>

                                                        </button>

                                                    </form>
                                                @else
                                                    <form
                                                        action="{{ route('student.saved_thesis.store', $thesis->id) }}"
                                                        method="POST" class="save-thesis-form">

                                                        @csrf

                                                        <button type="submit" class="save-btn" title="Save thesis"
                                                            aria-label="Save thesis">

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

                        <div class="history-table-view" hidden>

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

                                                    {{-- Number --}}

                                                    <td class="number-cell">

                                                        <span class="history-number">
                                                            {{ $loop->iteration }}
                                                        </span>

                                                    </td>


                                                    {{-- Thesis --}}

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


                                                    {{-- Author --}}

                                                    <td class="author-cell">

                                                        <div class="author-info">

                                                            <div class="author-avatar">
                                                                <i class="fas fa-user"></i>
                                                            </div>

                                                            <span>
                                                                {{ $thesis->author_name }}
                                                            </span>

                                                        </div>

                                                    </td>


                                                    {{-- Viewed --}}

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


                                                    {{-- Actions --}}

                                                    <td class="action-cell">

                                                        <div class="action-buttons">

                                                            @if ($thesis->files && $thesis->files->count())
                                                                @foreach ($thesis->files as $file)
                                                                    <a href="{{ route('student.thesis.view-pdf', ['file' => $file->id]) }}"
                                                                        target="_blank" class="action-btn view-pdf-btn"
                                                                        title="View PDF">

                                                                        <i class="fas fa-file-pdf"></i>
                                                                        <span>View PDF</span>

                                                                    </a>


                                                                    <a href="{{ route('student.thesis.download', $file) }}"
                                                                        class="action-btn download-btn"
                                                                        title="Download">

                                                                        <i class="fas fa-download"></i>
                                                                        <span>Download</span>

                                                                    </a>
                                                                @endforeach
                                                            @else
                                                                <span class="no-pdf">

                                                                    <i class="fas fa-file-circle-xmark"></i>
                                                                    No PDF

                                                                </span>
                                                            @endif


                                                            {{-- Save / Remove --}}

                                                            @if (isset($savedThesisIds) && in_array($thesis->id, $savedThesisIds))
                                                                <form
                                                                    action="{{ route('student.saved_thesis.destroy', $thesis->id) }}"
                                                                    method="POST" class="save-thesis-form">

                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="submit" class="save-btn saved"
                                                                        title="Remove saved thesis"
                                                                        aria-label="Remove saved thesis">

                                                                        <i class="fas fa-bookmark"></i>

                                                                    </button>

                                                                </form>
                                                            @else
                                                                <form
                                                                    action="{{ route('student.saved_thesis.store', $thesis->id) }}"
                                                                    method="POST" class="save-thesis-form">

                                                                    @csrf

                                                                    <button type="submit" class="save-btn"
                                                                        title="Save thesis" aria-label="Save thesis">

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
                    EMPTY STATE
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

                            <a href="{{ route('student.thesis.index') }}" class="empty-button">

                                <i class="fas fa-search"></i>
                                Browse Theses

                            </a>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <style>
        /* =========================================================
       STUDENT THESIS HISTORY
       CARD + TABLE VIEW
       LIGHT + DARK MODE
    ========================================================= */

        .history-page {

            --history-purple: #6538d9;
            --history-purple-dark: #5030b8;
            --history-purple-light: #eee8ff;
            --history-text: #151a3b;
            --history-muted: #6d7392;
            --history-border: #ececf4;
            --history-card: #ffffff;
            --history-page-bg: #f8f8fc;

            --history-shadow:
                0 5px 20px rgba(30, 25, 70, 0.07);

            min-height: 100vh;
            background: var(--history-page-bg);
            color: var(--history-text);

            font-family:
                "Inter",
                "Segoe UI",
                Arial,
                sans-serif;

            padding: 118px 18px 35px;
            box-sizing: border-box;
        }


        .history-container {
            width: 100%;
            margin: 0 auto;
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


        .page-title-wrapper {

            display: flex;
            align-items: center;
            gap: 14px;
        }


        .page-title-icon {

            width: 48px;
            height: 48px;

            border-radius: 12px;

            background: var(--history-purple-light);
            color: var(--history-purple);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 20px;
            flex-shrink: 0;
        }


        .page-title {

            margin: 0;

            font-size: 24px;
            font-weight: 700;

            color: var(--history-text);
        }


        .page-subtitle {

            margin: 5px 0 0;

            color: var(--history-muted);
            font-size: 13px;
        }


        .browse-button {

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            min-height: 42px;
            padding: 0 17px;

            border-radius: 9px;

            background: var(--history-purple);
            color: #ffffff;

            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition:
                background .2s ease,
                transform .2s ease;

            white-space: nowrap;
        }


        .browse-button:hover {

            background: var(--history-purple-dark);
            color: #ffffff;

            transform: translateY(-1px);
        }


        /* =========================================================
       MAIN CARD
    ========================================================= */

        .history-card {

            background: var(--history-card);

            border: 1px solid var(--history-border);
            border-radius: 12px;

            box-shadow: var(--history-shadow);

            overflow: hidden;
        }


        .history-card-header {

            min-height: 78px;

            padding: 18px 20px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            border-bottom: 1px solid var(--history-border);
        }


        .history-card-header h3 {

            margin: 0;

            font-size: 16px;
            font-weight: 700;

            color: var(--history-text);
        }


        .history-card-header h3 i {

            color: var(--history-purple);
            margin-right: 7px;
        }


        .history-card-header p {

            margin: 5px 0 0;

            color: var(--history-muted);
            font-size: 12px;
        }


        .history-count {

            min-width: 55px;

            padding: 7px 11px;

            border-radius: 8px;

            background: var(--history-purple-light);
            color: var(--history-purple);

            font-size: 14px;
            font-weight: 700;

            text-align: center;
        }


        .history-count span {

            display: block;

            margin-top: 1px;

            font-size: 9px;
            font-weight: 600;

            text-transform: uppercase;
            letter-spacing: .03em;
        }


        .history-card-body {
            padding: 0;
        }


        /* =========================================================
       CARD / TABLE SWITCHER
    ========================================================= */

        .history-view-toolbar {

            display: flex;
            justify-content: flex-end;

            padding: 15px 18px 0;
        }


        .history-view-toggle {

            display: inline-flex;
            align-items: center;

            gap: 3px;

            padding: 4px;

            background: var(--history-card);

            border: 1px solid var(--history-border);

            border-radius: 10px;

            box-shadow:
                0 3px 12px rgba(30, 25, 70, .05);
        }


        .history-view-button {

            min-height: 34px;

            padding: 0 12px;

            border: 0;
            border-radius: 7px;

            background: transparent;
            color: var(--history-muted);

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 6px;

            font-size: 11px;
            font-weight: 700;

            cursor: pointer;

            transition:
                background .2s ease,
                color .2s ease,
                box-shadow .2s ease;

            white-space: nowrap;
        }


        .history-view-button:hover {

            background: var(--history-purple-light);
            color: var(--history-purple);
        }


        .history-view-button.active {

            background: var(--history-purple);
            color: #ffffff;

            box-shadow:
                0 3px 9px rgba(101, 56, 217, .22);
        }


        .history-view-button.active:hover {

            background: var(--history-purple-dark);
            color: #ffffff;
        }


        .history-card-view[hidden],
        .history-table-view[hidden] {

            display: none !important;
        }


        /* =========================================================
       CARD VIEW
    ========================================================= */

        .history-card-view {

            padding: 16px 18px 20px;
        }


        /* DESKTOP = 4 CARDS PER ROW */

        .history-card-grid {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 16px;
        }


        .history-item-card {

            min-width: 0;

            background: var(--history-card);

            border: 1px solid var(--history-border);
            border-radius: 12px;

            padding: 16px;

            box-shadow:
                0 3px 12px rgba(30, 25, 70, .04);

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }


        .history-item-card:hover {

            transform: translateY(-2px);

            box-shadow:
                0 7px 20px rgba(30, 25, 70, .08);

            border-color: #ddd5f8;
        }


        .history-item-header {

            padding-bottom: 13px;

            border-bottom: 1px solid var(--history-border);
        }


        .history-item-title-area {

            display: flex;
            align-items: flex-start;

            gap: 11px;
        }


        .history-item-icon {

            width: 42px;
            height: 42px;

            flex-shrink: 0;

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
        }


        .history-item-number {

            display: block;

            margin-bottom: 3px;

            color: var(--history-purple);

            font-size: 9px;
            font-weight: 700;
        }


        .history-item-heading h4 {

            margin: 0;

            color: var(--history-text);

            font-size: 13px;
            line-height: 1.45;

            font-weight: 700;
        }


        .history-thesis-id {

            display: block;

            margin-top: 5px;

            color: var(--history-muted);

            font-size: 9px;
        }


        .history-item-info {

            padding: 13px 0;

            display: flex;
            flex-direction: column;

            gap: 9px;
        }


        .history-info-row {

            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 10px;
        }


        .history-info-label {

            display: flex;

            align-items: center;

            gap: 6px;

            color: var(--history-muted);

            font-size: 10px;

            white-space: nowrap;
        }


        .history-info-label i {

            width: 14px;

            color: var(--history-purple);

            text-align: center;
        }


        .history-info-row strong {

            max-width: 65%;

            color: var(--history-text);

            font-size: 10px;
            font-weight: 600;

            text-align: right;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        .history-item-actions {

            padding-top: 12px;

            border-top: 1px solid var(--history-border);

            display: flex;

            align-items: center;

            gap: 6px;

            flex-wrap: wrap;
        }


        /* =========================================================
       TABLE
    ========================================================= */

        .history-table-view {
            width: 100%;
        }


        .history-table-wrapper {

            width: 100%;

            overflow-x: auto;
        }


        .history-table {

            width: 100%;

            min-width: 900px;

            border-collapse: collapse;
        }


        .history-table thead {
            background: #faf9fd;
        }


        .history-table th {

            padding: 14px 18px;

            color: #6d7392;

            font-size: 11px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .04em;

            border-bottom: 1px solid var(--history-border);

            text-align: left;

            white-space: nowrap;
        }


        .history-table td {

            padding: 16px 18px;

            border-bottom: 1px solid #f0f0f5;

            vertical-align: middle;
        }


        .history-table tbody tr {

            transition: background .2s ease;
        }


        .history-table tbody tr:hover {

            background: #faf9fe;
        }


        .number-column {

            width: 60px;

            text-align: center !important;
        }


        .number-cell {
            text-align: center;
        }


        .history-number {

            width: 28px;
            height: 28px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: #f2effc;
            color: var(--history-purple);

            font-size: 11px;
            font-weight: 700;
        }


        .thesis-cell {
            min-width: 300px;
        }


        .thesis-info {

            display: flex;

            align-items: center;

            gap: 11px;
        }


        .thesis-icon {

            width: 40px;
            height: 40px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: #eee8ff;
            color: var(--history-purple);

            font-size: 17px;
        }


        .thesis-text {
            min-width: 0;
        }


        .thesis-text strong {

            display: block;

            max-width: 420px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            color: var(--history-text);

            font-size: 13px;
            font-weight: 600;
        }


        .thesis-text span {

            display: block;

            margin-top: 4px;

            color: var(--history-muted);

            font-size: 10px;
        }


        /* =========================================================
       AUTHOR
    ========================================================= */

        .author-info {

            display: flex;

            align-items: center;

            gap: 9px;

            white-space: nowrap;
        }


        .author-avatar {

            width: 32px;
            height: 32px;

            flex-shrink: 0;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #f0ebff;
            color: var(--history-purple);

            font-size: 12px;
        }


        .author-info span {

            color: var(--history-text);

            font-size: 12px;

            font-weight: 500;
        }


        /* =========================================================
       DATE
    ========================================================= */

        .date-info {

            display: flex;

            align-items: center;

            gap: 9px;

            white-space: nowrap;
        }


        .date-info>i {

            color: var(--history-purple);

            font-size: 14px;
        }


        .date-info strong {

            display: block;

            color: var(--history-text);

            font-size: 11px;

            font-weight: 600;
        }


        .date-info span {

            display: block;

            margin-top: 3px;

            color: var(--history-muted);

            font-size: 10px;
        }


        /* =========================================================
       TABLE ACTIONS
    ========================================================= */

        .action-column {
            min-width: 270px;
        }


        .action-cell {

            min-width: 270px;

            white-space: nowrap;
        }


        .action-buttons {

            display: flex;

            align-items: center;

            gap: 6px;

            flex-wrap: nowrap;

            white-space: nowrap;
        }


        .action-btn {

            min-height: 32px;

            padding: 0 10px;

            border-radius: 7px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            text-decoration: none;

            border: 0;

            font-size: 10px;

            font-weight: 600;

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;

            white-space: nowrap;

            flex: 0 0 auto;
        }


        .view-pdf-btn {

            background: #e6f7ed;

            color: #188650;
        }


        .view-pdf-btn:hover {

            background: #188650;

            color: #ffffff;

            transform: translateY(-1px);
        }


        .download-btn {

            background: #e1efff;

            color: #3484dc;
        }


        .download-btn:hover {

            background: #3484dc;

            color: #ffffff;

            transform: translateY(-1px);
        }


        /* =========================================================
       SAVE BUTTON
    ========================================================= */

        .save-thesis-form {

            display: inline-flex;

            margin: 0;
            padding: 0;

            flex: 0 0 auto;
        }


        .save-btn {

            width: 32px;
            height: 32px;

            padding: 0;

            border: 1px solid transparent;

            border-radius: 7px;

            background: #eee8ff;

            color: var(--history-purple);

            display: inline-flex;

            align-items: center;
            justify-content: center;

            cursor: pointer;

            font-size: 13px;

            line-height: 1;

            appearance: none;
            -webkit-appearance: none;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .15s ease,
                box-shadow .2s ease;
        }


        .save-btn:hover {

            background: var(--history-purple);

            border-color: var(--history-purple);

            color: #ffffff;

            transform: translateY(-1px);
        }


        .save-btn:focus {

            outline: none;

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .18);
        }


        .save-btn.saved {

            background: var(--history-purple);

            border-color: var(--history-purple);

            color: #ffffff;
        }


        .save-btn.saved:hover {

            background: #d83232;

            border-color: #d83232;

            color: #ffffff;
        }


        .save-btn i {
            pointer-events: none;
        }


        /* =========================================================
       NO PDF
    ========================================================= */

        .no-pdf {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 7px 10px;

            border-radius: 7px;

            background: #fff0d8;

            color: #ed8c16;

            font-size: 10px;

            font-weight: 600;

            white-space: nowrap;
        }


        /* =========================================================
       EMPTY STATE
    ========================================================= */

        .empty-history {

            padding: 70px 20px;

            text-align: center;
        }


        .empty-icon {

            width: 70px;
            height: 70px;

            margin: 0 auto 18px;

            border-radius: 50%;

            background: var(--history-purple-light);

            color: var(--history-purple);

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 27px;
        }


        .empty-history h4 {

            margin: 0;

            color: var(--history-text);

            font-size: 18px;

            font-weight: 700;
        }


        .empty-history p {

            margin: 7px 0 20px;

            color: var(--history-muted);

            font-size: 13px;
        }


        .empty-button {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            min-height: 40px;

            padding: 0 16px;

            border-radius: 8px;

            background: var(--history-purple);

            color: #ffffff;

            text-decoration: none;

            font-size: 12px;

            font-weight: 600;
        }


        .empty-button:hover {

            background: var(--history-purple-dark);

            color: #ffffff;
        }


        /* =========================================================
       DARK MODE
    ========================================================= */

        [data-bs-theme="dark"] .history-page {

            --history-page-bg: #101426;

            --history-card: #181d33;

            --history-border: #292e45;

            --history-text: #f5f5fb;

            --history-muted: #999fb9;

            --history-shadow:
                0 5px 20px rgba(0, 0, 0, .20);
        }


        [data-bs-theme="dark"] .page-title {
            color: #ffffff;
        }


        [data-bs-theme="dark"] .page-title-icon {

            background: #25203f;

            color: #a88cff;
        }


        [data-bs-theme="dark"] .history-card-header {
            border-color: #292e45;
        }


        [data-bs-theme="dark"] .history-card-header h3 {
            color: #ffffff;
        }


        [data-bs-theme="dark"] .history-view-toggle {

            background: #181d33;

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .history-view-button {
            color: #999fb9;
        }


        [data-bs-theme="dark"] .history-view-button:hover {

            background: #25203f;

            color: #a88cff;
        }


        [data-bs-theme="dark"] .history-view-button.active {

            background: var(--history-purple);

            color: #ffffff;
        }


        [data-bs-theme="dark"] .history-item-card {

            background: #181d33;

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .history-item-card:hover {
            border-color: #40385f;
        }


        [data-bs-theme="dark"] .history-item-header {
            border-color: #292e45;
        }


        [data-bs-theme="dark"] .history-item-icon {

            background: #25203f;

            color: #a88cff;
        }


        [data-bs-theme="dark"] .history-item-heading h4 {
            color: #ffffff;
        }


        [data-bs-theme="dark"] .history-item-actions {
            border-color: #292e45;
        }


        [data-bs-theme="dark"] .history-table thead {
            background: #20253a;
        }


        [data-bs-theme="dark"] .history-table th {

            color: #aeb4cd;

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .history-table td {
            border-color: #292e45;
        }


        [data-bs-theme="dark"] .history-table tbody tr:hover {
            background: #20253a;
        }


        [data-bs-theme="dark"] .history-number {

            background: #25203f;

            color: #a88cff;
        }


        [data-bs-theme="dark"] .thesis-icon {

            background: #25203f;

            color: #a88cff;
        }


        [data-bs-theme="dark"] .thesis-text strong {
            color: #ffffff;
        }


        [data-bs-theme="dark"] .thesis-text span {
            color: #999fb9;
        }


        [data-bs-theme="dark"] .author-avatar {

            background: #25203f;

            color: #a88cff;
        }


        [data-bs-theme="dark"] .author-info span {
            color: #d1d4e1;
        }


        [data-bs-theme="dark"] .date-info strong {
            color: #e5e7f0;
        }


        [data-bs-theme="dark"] .date-info span {
            color: #999fb9;
        }


        [data-bs-theme="dark"] .history-count {

            background: #25203f;

            color: #a88cff;
        }


        [data-bs-theme="dark"] .save-btn {

            background: #25203f;

            color: #a88cff;
        }


        [data-bs-theme="dark"] .save-btn.saved {

            background: var(--history-purple);

            border-color: var(--history-purple);

            color: #ffffff;
        }


        [data-bs-theme="dark"] .empty-history h4 {
            color: #ffffff;
        }


        [data-bs-theme="dark"] .empty-icon {

            background: #25203f;

            color: #a88cff;
        }


        /* =========================================================
       TABLET
    ========================================================= */

        @media (max-width: 1100px) {

            .history-page {

                padding-left: 15px;
                padding-right: 15px;
            }


            /* Tablet = 2 cards per row */

            .history-card-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }


            .history-table {
                min-width: 850px;
            }

        }


        /* =========================================================
       MOBILE
       2 CARDS PER ROW
    ========================================================= */

        @media (max-width: 700px) {

            .history-page {

                padding: 90px 12px 80px;
            }


            .page-header {

                align-items: flex-start;

                flex-direction: column;

                gap: 13px;

                margin-bottom: 16px;
            }


            .page-title {
                font-size: 20px;
            }


            .page-subtitle {
                font-size: 11px;
            }


            .page-title-icon {

                width: 42px;
                height: 42px;

                font-size: 17px;
            }


            .browse-button {
                width: 100%;
            }


            .history-card {
                border-radius: 11px;
            }


            .history-card-header {
                padding: 15px;
            }


            .history-card-header h3 {
                font-size: 14px;
            }


            .history-card-header p {
                font-size: 10px;
            }


            .history-count {

                min-width: 45px;

                font-size: 12px;
            }


            /* Hide Card/Table switcher on mobile */

            .history-view-toolbar {
                display: none;
            }


            /* Always show cards */

            .history-card-view {

                display: block !important;

                padding: 13px;
            }


            .history-table-view {
                display: none !important;
            }


            /* =====================================================
           MOBILE = 2 CARDS PER ROW
        ===================================================== */

            .history-card-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 10px;
            }


            .history-item-card {

                padding: 12px;

                border-radius: 10px;

                box-shadow:
                    0 3px 12px rgba(30, 25, 70, .05);
            }


            .history-item-icon {

                width: 34px;
                height: 34px;

                font-size: 14px;

                border-radius: 8px;
            }


            .history-item-title-area {

                gap: 8px;
            }


            .history-item-number {

                font-size: 8px;

                margin-bottom: 2px;
            }


            .history-item-heading h4 {

                font-size: 11px;

                line-height: 1.35;

                display: -webkit-box;

                -webkit-line-clamp: 2;

                -webkit-box-orient: vertical;

                overflow: hidden;
            }


            .history-thesis-id {

                font-size: 8px;

                margin-top: 4px;

                overflow: hidden;

                text-overflow: ellipsis;

                white-space: nowrap;
            }


            .history-item-info {

                padding: 10px 0;

                gap: 7px;
            }


            .history-info-row {

                align-items: flex-start;

                gap: 5px;
            }


            .history-info-label {

                gap: 4px;

                font-size: 8px;
            }


            .history-info-label i {

                width: 11px;

                font-size: 8px;
            }


            .history-info-row strong {

                max-width: 58%;

                font-size: 8px;
            }


            /* =====================================================
           MOBILE ACTION BUTTONS
           ICON ONLY
        ===================================================== */

            .history-item-actions {

                padding-top: 10px;

                gap: 5px;

                flex-wrap: nowrap;
            }


            .history-item-actions .action-btn {

                width: 31px;
                height: 31px;

                min-width: 31px;
                min-height: 31px;

                padding: 0;

                border-radius: 7px;

                gap: 0;

                font-size: 11px;

                flex: 0 0 31px;
            }


            /* Hide View PDF / Download text on mobile */

            .history-item-actions .action-btn span {

                display: none !important;
            }


            /* Keep icons centered */

            .history-item-actions .action-btn i {

                margin: 0;

                display: inline-flex;

                align-items: center;

                justify-content: center;
            }


            /* Save button matches action buttons */

            .history-item-actions .save-btn {

                width: 31px;
                height: 31px;

                min-width: 31px;
                min-height: 31px;

                border-radius: 7px;

                font-size: 11px;

                flex: 0 0 31px;
            }


            .save-thesis-form {

                width: 31px;
                height: 31px;

                flex: 0 0 31px;
            }


            /* No PDF stays readable */

            .history-item-actions .no-pdf {

                padding: 6px 7px;

                font-size: 8px;

                gap: 4px;

                overflow: hidden;

                white-space: nowrap;
            }


            .empty-history {
                padding: 55px 15px;
            }

        }


        /* =========================================================
       VERY SMALL MOBILE
    ========================================================= */

        @media (max-width: 380px) {

            .history-page {

                padding-left: 9px;
                padding-right: 9px;
            }


            .history-card-view {
                padding: 10px;
            }


            .history-card-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 8px;
            }


            .history-item-card {
                padding: 10px;
            }


            .history-item-actions {

                gap: 4px;
            }


            .history-item-actions .action-btn {

                width: 29px;
                height: 29px;

                min-width: 29px;
                min-height: 29px;

                flex-basis: 29px;

                font-size: 10px;
            }


            .history-item-actions .save-btn {

                width: 29px;
                height: 29px;

                min-width: 29px;
                min-height: 29px;

                flex-basis: 29px;

                font-size: 10px;
            }


            .save-thesis-form {

                width: 29px;
                height: 29px;

                flex-basis: 29px;
            }

        }
    </style>


    {{-- =========================================================
CARD / TABLE JAVASCRIPT
========================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const page = document.querySelector('.history-page');

            if (!page) {
                return;
            }


            const buttons =
                page.querySelectorAll('[data-history-view]');

            const cardView =
                page.querySelector('.history-card-view');

            const tableView =
                page.querySelector('.history-table-view');


            if (!buttons.length || !cardView || !tableView) {
                return;
            }


            const storageKey = 'studentHistoryView';


            function isMobile() {

                return window.innerWidth <= 700;
            }


            function setHistoryView(view, save = true) {

                /*
                 * Mobile must ALWAYS use Card view.
                 */

                if (isMobile()) {
                    view = 'card';
                }


                const isCard =
                    view === 'card';


                cardView.hidden = !isCard;

                tableView.hidden = isCard;


                buttons.forEach(function(button) {

                    const active =
                        button.dataset.historyView === view;


                    button.classList.toggle(
                        'active',
                        active
                    );


                    button.setAttribute(
                        'aria-pressed',
                        active ? 'true' : 'false'
                    );

                });


                /*
                 * Save desktop choice.
                 */

                if (save && !isMobile()) {

                    localStorage.setItem(
                        storageKey,
                        view
                    );

                }

            }


            /*
             * Load saved view.
             * Default = Card
             */

            let savedView =
                localStorage.getItem(storageKey);


            if (
                savedView !== 'card' &&
                savedView !== 'table'
            ) {

                savedView = 'card';

            }


            setHistoryView(savedView, false);


            /*
             * Card / Table buttons
             */

            buttons.forEach(function(button) {

                button.addEventListener('click', function() {

                    const selectedView =
                        button.dataset.historyView;


                    setHistoryView(
                        selectedView,
                        true
                    );

                });

            });


            /*
             * When resizing:
             * Mobile = Card
             * Desktop = restore saved choice
             */

            let wasMobile = isMobile();


            window.addEventListener('resize', function() {

                const currentlyMobile =
                    isMobile();


                if (currentlyMobile) {

                    setHistoryView(
                        'card',
                        false
                    );

                } else if (wasMobile && !currentlyMobile) {

                    const desktopView =
                        localStorage.getItem(storageKey) ||
                        'card';


                    setHistoryView(
                        desktopView,
                        false
                    );

                }


                wasMobile = currentlyMobile;

            });

        });
    </script>

</x-app-layout>
