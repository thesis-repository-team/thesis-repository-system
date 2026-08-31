<x-app-layout>

```
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

            <a href="{{ route('student.thesis.index') }}"
                class="browse-button">

                <i class="fas fa-search"></i>
                <span>Browse Theses</span>

            </a>

        </div>


        {{-- =====================================================
            HISTORY CARD
        ====================================================== --}}

        <div class="history-card">

            <div class="history-card-header">

                <div>

                    <h3>
                        <i class="fas fa-clock-rotate-left"></i>
                        Thesis History
                    </h3>

                    <p>
                        Your recently viewed thesis documents
                    </p>

                </div>

                @if ($histories->count())

                    <div class="history-count">

                        {{ $histories->count() }}

                        <span>
                            Viewed
                        </span>

                    </div>

                @endif

            </div>


            <div class="history-card-body">

                @if ($histories->count())

                    {{-- =================================================
                        DESKTOP TABLE
                    ================================================== --}}

                    <div class="history-table-wrapper">

                        <table class="history-table">

                            <thead>

                                <tr>

                                    <th class="number-column">
                                        #
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

                                            {{-- =================================================
                                                NUMBER
                                            ================================================== --}}

                                            <td class="number-cell">

                                                <span class="history-number">
                                                    {{ $loop->iteration }}
                                                </span>

                                            </td>


                                            {{-- =================================================
                                                THESIS
                                            ================================================== --}}

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
                                                            Thesis #{{ $thesis->id }}
                                                        </span>

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- =================================================
                                                AUTHOR
                                            ================================================== --}}

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


                                            {{-- =================================================
                                                VIEWED AT
                                            ================================================== --}}

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


                                            {{-- =================================================
                                                ACTION
                                            ================================================== --}}

                                            <td class="action-cell">

                                                @if ($thesis->files && $thesis->files->count())

                                                    <div class="action-buttons">

                                                        @foreach ($thesis->files as $file)

                                                            {{-- View PDF --}}

                                                            <a href="{{ route('student.thesis.view-pdf', ['file' => $file->id]) }}"
                                                                target="_blank"
                                                                class="action-btn view-pdf-btn"
                                                                title="View PDF">

                                                                <i class="fas fa-file-pdf"></i>

                                                                <span>
                                                                    View PDF
                                                                </span>

                                                            </a>


                                                            {{-- Download --}}

                                                            <a href="{{ route('student.thesis.download', $file) }}"
                                                                class="action-btn download-btn"
                                                                title="Download">

                                                                <i class="fas fa-download"></i>

                                                                <span>
                                                                    Download
                                                                </span>

                                                            </a>


                                                            {{-- =================================================
                                                                SAVED THESIS
                                                            ================================================== --}}

                                                            @if (isset($savedThesisIds) && in_array($thesis->id, $savedThesisIds))

                                                                {{-- Already Saved --}}

                                                                <form
                                                                    action="{{ route('student.saved_thesis.destroy', $thesis->id) }}"
                                                                    method="POST"
                                                                    class="d-inline">

                                                                    @csrf

                                                                    @method('DELETE')

                                                                    <button type="submit"
                                                                        class="save-btn saved"
                                                                        title="Remove saved thesis">

                                                                        <i class="fas fa-bookmark"></i>

                                                                    </button>

                                                                </form>

                                                            @else

                                                                {{-- Not Saved --}}

                                                                <form
                                                                    action="{{ route('student.saved_thesis.store', $thesis->id) }}"
                                                                    method="POST"
                                                                    class="d-inline">

                                                                    @csrf

                                                                    <button type="submit"
                                                                        class="save-btn"
                                                                        title="Save thesis">

                                                                        <i class="far fa-bookmark"></i>

                                                                    </button>

                                                                </form>

                                                            @endif

                                                        @endforeach

                                                    </div>

                                                @else

                                                    <span class="no-pdf">

                                                        <i class="fas fa-file-circle-xmark"></i>

                                                        No PDF

                                                    </span>

                                                @endif

                                            </td>

                                        </tr>

                                    @endif

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- =================================================
                        MOBILE CARD VIEW
                    ================================================== --}}

                    <div class="mobile-history-list">

                        @foreach ($histories as $history)

                            @if ($history->thesis)

                                @php
                                    $thesis = $history->thesis;
                                @endphp

                                <div class="mobile-history-item">

                                    {{-- Mobile Header --}}

                                    <div class="mobile-item-header">

                                        <div class="mobile-thesis-heading">

                                            <div class="mobile-thesis-icon">
                                                <i class="fas fa-file-lines"></i>
                                            </div>

                                            <div>

                                                <span class="mobile-number">
                                                    #{{ $loop->iteration }}
                                                </span>

                                                <h4>
                                                    {{ $thesis->title }}
                                                </h4>

                                            </div>

                                        </div>

                                    </div>


                                    {{-- Mobile Information --}}

                                    <div class="mobile-item-info">

                                        <div class="mobile-info-row">

                                            <span class="mobile-info-label">

                                                <i class="fas fa-user"></i>

                                                Author

                                            </span>

                                            <strong>
                                                {{ $thesis->author_name }}
                                            </strong>

                                        </div>


                                        <div class="mobile-info-row">

                                            <span class="mobile-info-label">

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


                                    {{-- Mobile Actions --}}

                                    @if ($thesis->files && $thesis->files->count())

                                        <div class="mobile-actions">

                                            @foreach ($thesis->files as $file)

                                                {{-- View PDF --}}

                                                <a href="{{ route('student.thesis.view-pdf', ['file' => $file->id]) }}"
                                                    target="_blank"
                                                    class="mobile-action view-pdf-btn">

                                                    <i class="fas fa-file-pdf"></i>

                                                    View PDF

                                                </a>


                                                {{-- Download --}}

                                                <a href="{{ route('student.thesis.download', $file) }}"
                                                    class="mobile-action download-btn">

                                                    <i class="fas fa-download"></i>

                                                    Download

                                                </a>


                                                {{-- Save / Remove --}}

                                                @if (isset($savedThesisIds) && in_array($thesis->id, $savedThesisIds))

                                                    <form
                                                        action="{{ route('student.saved_thesis.destroy', $thesis->id) }}"
                                                        method="POST">

                                                        @csrf

                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="mobile-save-button saved"
                                                            title="Remove saved thesis">

                                                            <i class="fas fa-bookmark"></i>

                                                        </button>

                                                    </form>

                                                @else

                                                    <form
                                                        action="{{ route('student.saved_thesis.store', $thesis->id) }}"
                                                        method="POST">

                                                        @csrf

                                                        <button type="submit"
                                                            class="mobile-save-button"
                                                            title="Save thesis">

                                                            <i class="far fa-bookmark"></i>

                                                        </button>

                                                    </form>

                                                @endif

                                            @endforeach

                                        </div>

                                    @else

                                        <div class="mobile-no-pdf">

                                            <i class="fas fa-file-circle-xmark"></i>

                                            No PDF available

                                        </div>

                                    @endif

                                </div>

                            @endif

                        @endforeach

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

                        <a href="{{ route('student.thesis.index') }}"
                            class="empty-button">

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
       PURPLE / NAVY DESIGN
       LIGHT + DARK MODE
    ========================================================= */

    .history-page {

        --history-purple: #6538d9;
        --history-purple-dark: #5030b8;
        --history-purple-light: #eee8ff;

        --history-sidebar: #11182f;

        --history-text: #151a3b;
        --history-muted: #6d7392;

        --history-border: #ececf4;

        --history-card: #ffffff;
        --history-page: #f8f8fc;

        --history-shadow:
            0 5px 20px rgba(30, 25, 70, 0.07);

        min-height: 100vh;

        background: var(--history-page);
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
        max-width: 1400px;

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

        transition: all .2s ease;

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
       TABLE
    ========================================================= */

    .history-table-wrapper {

        width: 100%;

        overflow-x: auto;
    }


    .history-table {

        width: 100%;

        border-collapse: collapse;

        min-width: 900px;
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


    /* =========================================================
       THESIS
    ========================================================= */

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

        color: #252a47;

        font-size: 13px;

        font-weight: 600;
    }


    .thesis-text span {

        display: block;

        margin-top: 4px;

        color: #8a8fa8;

        font-size: 10px;
    }


    /* =========================================================
       AUTHOR
    ========================================================= */

    .author-info {

        display: flex;

        align-items: center;

        gap: 9px;
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

        color: #3c4260;

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
    }


    .date-info > i {

        color: var(--history-purple);

        font-size: 14px;
    }


    .date-info strong {

        display: block;

        color: #363b58;

        font-size: 11px;

        font-weight: 600;
    }


    .date-info span {

        display: block;

        margin-top: 3px;

        color: #8589a2;

        font-size: 10px;
    }


    /* =========================================================
       ACTIONS
    ========================================================= */

    .action-column {

        min-width: 260px;
    }


    .action-cell {

        min-width: 260px;
    }


    .action-buttons {

        display: flex;

        align-items: center;

        gap: 6px;

        flex-wrap: wrap;
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

        transition: all .2s ease;

        white-space: nowrap;
    }


    .view-pdf-btn {

        background: #e6f7ed;

        color: #188650;
    }


    .view-pdf-btn:hover {

        background: #188650;

        color: #ffffff;
    }


    .download-btn {

        background: #e1efff;

        color: #3484dc;
    }


    .download-btn:hover {

        background: #3484dc;

        color: #ffffff;
    }


    .save-btn {

        width: 32px;
        height: 32px;

        border: 0;

        border-radius: 7px;

        background: #eee8ff;

        color: var(--history-purple);

        display: inline-flex;

        align-items: center;

        justify-content: center;

        cursor: pointer;

        transition: all .2s ease;
    }


    .save-btn:hover {

        background: var(--history-purple);

        color: #ffffff;
    }


    .save-btn.saved {

        background: var(--history-purple);

        color: #ffffff;
    }


    .save-btn.saved:hover {

        background: #d83232;

        color: #ffffff;
    }


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
       MOBILE CARD VIEW
    ========================================================= */

    .mobile-history-list {

        display: none;
    }


    /* =========================================================
       DARK MODE
    ========================================================= */

    [data-bs-theme="dark"] .history-page {

        --history-page: #101426;

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

    @media (max-width: 1000px) {

        .history-page {

            padding-left: 15px;

            padding-right: 15px;
        }


        .history-table {

            min-width: 850px;
        }

    }


    /* =========================================================
       MOBILE
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


        /* Hide desktop table */

        .history-table-wrapper {

            display: none;
        }


        /* Show mobile cards */

        .mobile-history-list {

            display: flex;

            flex-direction: column;

            gap: 12px;

            padding: 13px;

            background: #f8f8fc;
        }


        .mobile-history-item {

            background: #ffffff;

            border: 1px solid #ececf4;

            border-radius: 11px;

            padding: 15px;

            box-shadow:
                0 3px 12px rgba(30, 25, 70, .05);
        }


        .mobile-item-header {

            padding-bottom: 13px;

            border-bottom: 1px solid #eeeef4;
        }


        .mobile-thesis-heading {

            display: flex;

            align-items: flex-start;

            gap: 10px;
        }


        .mobile-thesis-icon {

            width: 40px;
            height: 40px;

            flex-shrink: 0;

            border-radius: 9px;

            background: #eee8ff;

            color: var(--history-purple);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 16px;
        }


        .mobile-number {

            display: block;

            margin-bottom: 3px;

            color: var(--history-purple);

            font-size: 9px;

            font-weight: 700;
        }


        .mobile-thesis-heading h4 {

            margin: 0;

            color: #252a47;

            font-size: 13px;

            line-height: 1.45;

            font-weight: 700;
        }


        .mobile-item-info {

            padding: 12px 0;

            display: flex;

            flex-direction: column;

            gap: 9px;
        }


        .mobile-info-row {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;
        }


        .mobile-info-label {

            color: #777d9b;

            font-size: 10px;

            display: flex;

            align-items: center;

            gap: 6px;
        }


        .mobile-info-label i {

            color: var(--history-purple);

            width: 14px;

            text-align: center;
        }


        .mobile-info-row strong {

            max-width: 60%;

            color: #363b58;

            font-size: 10px;

            font-weight: 600;

            text-align: right;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        .mobile-actions {

            padding-top: 12px;

            border-top: 1px solid #eeeef4;

            display: flex;

            align-items: center;

            gap: 6px;

            flex-wrap: wrap;
        }


        .mobile-action {

            flex: 1;

            min-width: 100px;

            min-height: 34px;

            padding: 0 9px;

            border-radius: 7px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 5px;

            text-decoration: none;

            font-size: 10px;

            font-weight: 600;
        }


        .mobile-save-button {

            width: 34px;
            height: 34px;

            flex-shrink: 0;

            border: 0;

            border-radius: 7px;

            background: #eee8ff;

            color: var(--history-purple);

            display: flex;

            align-items: center;

            justify-content: center;

            cursor: pointer;
        }


        .mobile-save-button.saved {

            background: var(--history-purple);

            color: #ffffff;
        }


        .mobile-no-pdf {

            padding-top: 12px;

            border-top: 1px solid #eeeef4;

            color: #ed8c16;

            font-size: 10px;

            font-weight: 600;
        }


        .empty-history {

            padding: 55px 15px;
        }

    }


    /* =========================================================
       DARK MODE - MOBILE
    ========================================================= */

    @media (max-width: 700px) {

        [data-bs-theme="dark"] .mobile-history-list {

            background: #101426;
        }


        [data-bs-theme="dark"] .mobile-history-item {

            background: #181d33;

            border-color: #292e45;

            box-shadow:
                0 3px 12px rgba(0, 0, 0, .15);
        }


        [data-bs-theme="dark"] .mobile-item-header {

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .mobile-thesis-icon {

            background: #25203f;

            color: #a88cff;
        }


        [data-bs-theme="dark"] .mobile-thesis-heading h4 {

            color: #ffffff;
        }


        [data-bs-theme="dark"] .mobile-number {

            color: #a88cff;
        }


        [data-bs-theme="dark"] .mobile-info-label {

            color: #999fb9;
        }


        [data-bs-theme="dark"] .mobile-info-row strong {

            color: #e5e7f0;
        }


        [data-bs-theme="dark"] .mobile-actions {

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .mobile-save-button {

            background: #25203f;

            color: #a88cff;
        }


        [data-bs-theme="dark"] .mobile-save-button.saved {

            background: var(--history-purple);

            color: #ffffff;
        }

    }

</style>
```

</x-app-layout>
