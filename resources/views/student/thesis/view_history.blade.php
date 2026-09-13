<x-app-layout>

    @php
        $uniqueHistories = $histories
            ->filter(function ($history) {
                return $history->thesis;
            })
            ->unique('thesis_id')
            ->values();
    @endphp

    <div class="dashboard-content thesis-page">

        <div class="thesis-page-header">

            <div class="thesis-header-content">

                <div class="thesis-title-row">

                    <div>

                        <span class="thesis-overline">
                            STUDENT
                        </span>

                        <h1 class="thesis-title">
                            View History
                        </h1>

                    </div>

                </div>

            </div>

        </div>

        <div class="thesis-results-wrapper">

            <div class="thesis-results-toolbar">

                <div class="thesis-view-toggle">

                    <button type="button" id="thesisCardViewButton" class="thesis-view-button is-active"
                        aria-label="Card View">

                        <i class="bi bi-grid-3x3-gap"></i>

                        <span>
                            Cards
                        </span>

                    </button>

                    <button type="button" id="thesisTableViewButton" class="thesis-view-button"
                        aria-label="Table View">

                        <i class="bi bi-table"></i>

                        <span>
                            Table
                        </span>

                    </button>

                </div>

            </div>

            <div id="historyThesisResults" class="thesis-results-container">

                <div class="thesis-partial-card-results">

                    @forelse ($uniqueHistories as $history)
                        @php
                            $thesis = $history->thesis;
                        @endphp

                        <div class="admin-thesis-card">

                            <div class="admin-thesis-card-top">

                                <div class="admin-thesis-card-heading">

                                    <div class="admin-thesis-icon">

                                        <i class="bi bi-journal-text"></i>

                                    </div>

                                    <h3 class="admin-thesis-card-title">

                                        {{ $thesis->title }}

                                    </h3>

                                </div>

                            </div>

                            <div class="admin-thesis-published">

                                <div class="admin-thesis-published-item">

                                    <div class="admin-thesis-published-icon">

                                        <i class="bi bi-person"></i>

                                    </div>

                                    <div class="admin-thesis-published-content">

                                        <span class="admin-thesis-published-label">
                                            Author
                                        </span>

                                        <span class="admin-thesis-published-value">

                                            {{ $thesis->author_name ?? '—' }}

                                        </span>

                                    </div>

                                </div>

                                <div class="admin-thesis-published-item">

                                    <div class="admin-thesis-published-icon">

                                        <i class="bi bi-clock-history"></i>

                                    </div>

                                    <div class="admin-thesis-published-content">

                                        <span class="admin-thesis-published-label">
                                            Viewed At
                                        </span>

                                        <span class="admin-thesis-published-value">

                                            {{ $history->viewed_at ? \Carbon\Carbon::parse($history->viewed_at)->format('M d, Y') : '—' }}

                                        </span>

                                    </div>

                                </div>

                            </div>

                            <div class="admin-thesis-card-body">

                                <div class="admin-thesis-detail">

                                    <div class="admin-thesis-detail-icon">

                                        <i class="bi bi-building"></i>

                                    </div>

                                    <div class="admin-thesis-detail-content">

                                        <span class="admin-thesis-detail-label">
                                            Department
                                        </span>

                                        <span class="admin-thesis-detail-value">

                                            {{ optional($thesis->department)->name ?? '—' }}

                                        </span>

                                    </div>

                                </div>

                                <div class="admin-thesis-detail">

                                    <div class="admin-thesis-detail-icon">

                                        <i class="bi bi-calendar3"></i>

                                    </div>

                                    <div class="admin-thesis-detail-content">

                                        <span class="admin-thesis-detail-label">
                                            Academic Year
                                        </span>

                                        <span class="admin-thesis-detail-value">

                                            {{ $thesis->academic_year ?? '—' }}

                                        </span>

                                    </div>

                                </div>

                                <div class="admin-thesis-detail">

                                    <div class="admin-thesis-detail-icon">

                                        <i class="bi bi-person-check"></i>

                                    </div>

                                    <div class="admin-thesis-detail-content">

                                        <span class="admin-thesis-detail-label">
                                            Published By
                                        </span>

                                        <span class="admin-thesis-detail-value">

                                            {{ optional($thesis->publishedBy)->username ?? (optional($thesis->publishedBy)->full_name ?? '—') }}

                                        </span>

                                    </div>

                                </div>

                                <div class="admin-thesis-submitted">

                                    <span class="admin-thesis-submitted-label">
                                        Published At
                                    </span>

                                    <span class="admin-thesis-submitted-value">

                                        {{ $thesis->published_at ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y') : '—' }}

                                    </span>

                                </div>

                            </div>

                            <div class="admin-thesis-card-footer">

                                <a href="{{ route('student.thesis.show', $thesis->id) }}"
                                    class="admin-thesis-action admin-thesis-view-detail" title="View Detail"
                                    aria-label="View Detail">

                                    <i class="bi bi-file-text"></i>

                                    <span>
                                        View Detail
                                    </span>

                                </a>

                                <a href="{{ route('student.thesis.view-pdf', $thesis->id) }}"
                                    class="admin-thesis-action admin-thesis-view-pdf" title="View PDF"
                                    aria-label="View PDF">

                                    <i class="bi bi-file-earmark-pdf"></i>

                                    <span>
                                        PDF
                                    </span>

                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="admin-thesis-empty">

                            <div class="admin-thesis-empty-icon">

                                <i class="bi bi-clock-history"></i>

                            </div>

                            <h3>
                                No View History
                            </h3>

                            <p>
                                You have not viewed any thesis records yet.
                            </p>

                        </div>
                    @endforelse

                </div>

                <div class="thesis-partial-table-results">

                    <div class="thesis-table-wrapper">

                        <table class="thesis-table">

                            <thead>

                                <tr>

                                    <th>
                                        #
                                    </th>

                                    <th>
                                        Thesis
                                    </th>

                                    <th>
                                        Author
                                    </th>

                                    <th>
                                        Department
                                    </th>

                                    <th>
                                        Academic Year
                                    </th>

                                    <th>
                                        Published By
                                    </th>

                                    <th>
                                        Published At
                                    </th>

                                    <th>
                                        Viewed At
                                    </th>

                                    <th>
                                        Actions
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($uniqueHistories as $history)
                                    @php
                                        $thesis = $history->thesis;
                                    @endphp

                                    <tr>

                                        <td class="thesis-table-number">

                                            {{ $loop->iteration }}

                                        </td>

                                        <td class="thesis-table-title-cell">

                                            <span class="thesis-table-title-text">

                                                {{ $thesis->title }}

                                            </span>

                                        </td>

                                        <td>

                                            {{ $thesis->author_name ?? '—' }}

                                        </td>

                                        <td>

                                            {{ optional($thesis->department)->name ?? '—' }}

                                        </td>

                                        <td>

                                            {{ $thesis->academic_year ?? '—' }}

                                        </td>

                                        <td>

                                            {{ optional($thesis->publishedBy)->username ?? (optional($thesis->publishedBy)->full_name ?? '—') }}

                                        </td>

                                        <td>

                                            {{ $thesis->published_at ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y') : '—' }}

                                        </td>

                                        <td>

                                            {{ $history->viewed_at ? \Carbon\Carbon::parse($history->viewed_at)->format('M d, Y') : '—' }}

                                        </td>

                                        <td>

                                            <div class="thesis-table-actions">

                                                <a href="{{ route('student.thesis.show', $thesis->id) }}"
                                                    class="thesis-table-action thesis-table-view" title="View Detail"
                                                    aria-label="View Detail">

                                                    <i class="bi bi-file-text"></i>
                                                </a>

                                                <a href="{{ route('student.thesis.view-pdf', $thesis->id) }}"
                                                    class="thesis-table-action thesis-table-pdf" title="View PDF"
                                                    aria-label="View PDF">

                                                    <i class="bi bi-file-earmark-pdf"></i>

                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="9" class="thesis-table-empty">

                                            <strong>
                                                No View History
                                            </strong>

                                            <span>
                                                You have not viewed any thesis records yet.
                                            </span>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const results =
                document.getElementById('historyThesisResults');

            const cardButton =
                document.getElementById('thesisCardViewButton');

            const tableButton =
                document.getElementById('thesisTableViewButton');

            function setView(view) {

                if (!results) {
                    return;
                }

                if (view === 'table') {

                    results.classList.add('table-mode');

                    tableButton?.classList.add('is-active');

                    cardButton?.classList.remove('is-active');

                    localStorage.setItem(
                        'studentHistoryView',
                        'table'
                    );

                } else {

                    results.classList.remove('table-mode');

                    cardButton?.classList.add('is-active');

                    tableButton?.classList.remove('is-active');

                    localStorage.setItem(
                        'studentHistoryView',
                        'cards'
                    );

                }

            }

            cardButton?.addEventListener(
                'click',
                function() {
                    setView('cards');
                }
            );

            tableButton?.addEventListener(
                'click',
                function() {
                    setView('table');
                }
            );

            const savedView =
                localStorage.getItem('studentHistoryView');

            setView(
                savedView === 'table' ?
                'table' :
                'cards'
            );

        });
    </script>


    <style>
        :root {

            --thesis-black: #111111;

            --thesis-white: #ffffff;

            --thesis-purple: #6538D9;

            --thesis-purple-hover: #5428C7;

            --thesis-purple-light: #F5F3FF;

            --thesis-purple-soft: #EDE9FE;

            --thesis-page-bg: #FAFAFA;

            --thesis-card-bg: #FFFFFF;

            --thesis-input-bg: #F9FAFB;

            --thesis-text: #111111;

            --thesis-text-secondary: #4B5563;

            --thesis-text-muted: #6B7280;

            --thesis-border-soft: #E5E7EB;

            /* VIEW DETAIL */
            --thesis-detail: #6538D9;

            --thesis-detail-hover: #5428C7;

            /* VIEW PDF */
            --thesis-pdf: #DC2626;

            --thesis-pdf-hover: #B91C1C;

            --thesis-shadow:
                0 8px 24px rgba(17, 17, 17, .08);

            --thesis-card-shadow:
                0 2px 10px rgba(17, 17, 17, .05);
        }


        [data-bs-theme="dark"] {

            --thesis-page-bg: #101426;

            --thesis-card-bg: #181D33;

            --thesis-input-bg: #20253A;

            --thesis-text: #FFFFFF;

            --thesis-text-secondary: #D5D8E8;

            --thesis-text-muted: #999FB9;

            --thesis-border-soft: #292E45;

            --thesis-purple: #7C5CE3;

            --thesis-purple-hover: #9278EA;

            --thesis-purple-light: #292342;

            --thesis-purple-soft: #342C52;

            /* DARK MODE - VIEW DETAIL */
            --thesis-detail: #7C5CE3;

            --thesis-detail-hover: #6538D9;

            /* DARK MODE - VIEW PDF */
            --thesis-pdf: #EF4444;

            --thesis-pdf-hover: #DC2626;

            --thesis-shadow:
                0 8px 24px rgba(0, 0, 0, .35);

            --thesis-card-shadow:
                0 2px 10px rgba(0, 0, 0, .30);
        }


        [data-bs-theme="dark"] body,
        [data-bs-theme="dark"] .dashboard-content {

            background: var(--thesis-page-bg);

            color: var(--thesis-text);
        }


        .thesis-page {

            padding: 20px;

            color: var(--thesis-text);

            background: var(--thesis-page-bg);

            transition:
                color .25s ease,
                background-color .25s ease;
        }


        .thesis-page-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 1rem;

            padding: 20px 0 10px 0;

            margin: 90px 0 20px;

            /* background: var(--thesis-page-bg); */

            /* box-sizing: border-box; */
        }


        [data-bs-theme="dark"] .thesis-page-header {

            background: #171B30;
        }


        .thesis-header-content {

            min-width: 0;

            flex: 1;
        }


        .thesis-title-row {

            display: flex;

            align-items: center;
        }


        .thesis-overline {

            display: block;

            margin-bottom: .2rem;

            color: var(--thesis-purple);

            font-size: .72rem;

            font-weight: 800;

            letter-spacing: .13em;

            line-height: 1.2;

            text-transform: uppercase;
        }


        .thesis-title {

            margin: 0;

            color: var(--thesis-text);

            font-size: 1.9rem;

            font-weight: 700;

            line-height: 1.2;

            letter-spacing: -.035em;
        }


        .thesis-results-wrapper {

            position: relative;

            width: 100%;

            min-height: 100px;

            box-sizing: border-box;
        }


        .thesis-results-toolbar {

            width: 100%;

            display: flex;

            align-items: center;

            justify-content: flex-end;

            margin: 1rem 0 .85rem;
        }


        .thesis-view-toggle {

            display: inline-flex;

            align-items: center;

            gap: 3px;

            padding: 3px;

            background: var(--thesis-purple-light);

            border: 1px solid #DDD6FE;

            border-radius: 8px;
        }


        .thesis-view-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            min-width: 82px;

            height: 38px;

            padding: .4rem .75rem;

            color: var(--thesis-text-muted);

            background: transparent;

            border: 0;

            border-radius: 6px;

            font-size: .75rem;

            font-weight: 800;

            letter-spacing: .03em;

            text-transform: uppercase;

            cursor: pointer;

            transition: .2s ease;
        }


        .thesis-view-button:hover {

            color: var(--thesis-purple);

            background: var(--thesis-purple-soft);
        }


        .thesis-view-button.is-active {

            color: #FFFFFF;

            background: var(--thesis-purple);

            box-shadow:
                0 3px 8px rgba(101, 56, 217, .25);
        }


        [data-bs-theme="dark"] .thesis-view-toggle {

            background: #292342;

            border-color: #403765;
        }


        [data-bs-theme="dark"] .thesis-view-button {

            color: #999FB9;
        }


        [data-bs-theme="dark"] .thesis-view-button:hover {

            color: #C4B5FD;

            background: #342C52;
        }


        [data-bs-theme="dark"] .thesis-view-button.is-active {

            color: #FFFFFF;

            background: var(--thesis-purple);
        }


        .thesis-results-container {

            position: relative;

            width: 100%;

            box-sizing: border-box;
        }


        .thesis-partial-card-results {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 1.25rem;

            width: 100%;
        }


        .thesis-partial-table-results {

            display: none;

            width: 100%;

            overflow: hidden;
        }


        .thesis-results-container.table-mode .thesis-partial-card-results {

            display: none;
        }


        .thesis-results-container.table-mode .thesis-partial-table-results {

            display: block;
        }


        .admin-thesis-card {

            display: flex;

            flex-direction: column;

            min-width: 0;

            overflow: hidden;

            color: var(--thesis-text);

            background: var(--thesis-card-bg);

            border: 1px solid var(--thesis-border-soft);

            border-radius: 16px;

            box-shadow: var(--thesis-card-shadow);

            transition:
                transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease;
        }


        .admin-thesis-card:hover {

            transform: translateY(-5px);

            border-color: #D8CCFF;

            box-shadow: var(--thesis-shadow);
        }


        [data-bs-theme="dark"] .admin-thesis-card:hover {

            border-color: #51447A;
        }


        .admin-thesis-card-top {

            display: flex;

            align-items: flex-start;

            gap: 1rem;

            padding: 1rem;
        }


        .admin-thesis-card-heading {

            display: flex;

            align-items: center;

            gap: .7rem;

            min-width: 0;

            flex: 1;
        }


        .admin-thesis-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 34px;

            height: 34px;

            flex-shrink: 0;

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-radius: 9px;

            font-size: .85rem;
        }


        .admin-thesis-card-title {

            display: -webkit-box;

            margin: 0;

            overflow: hidden;

            color: var(--thesis-text);

            font-size: 1.05rem;

            font-weight: 800;

            line-height: 1.4;

            -webkit-line-clamp: 3;

            -webkit-box-orient: vertical;

            word-break: break-word;
        }


        .admin-thesis-published {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: .45rem;

            margin: 0 .85rem .75rem;

            padding: .55rem .65rem;

            color: var(--thesis-text);

            background: var(--thesis-input-bg);

            border: 1px solid var(--thesis-border-soft);

            border-radius: 8px;
        }


        .admin-thesis-published-item {

            display: flex;

            align-items: center;

            gap: .4rem;

            min-width: 0;
        }


        .admin-thesis-published-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 24px;

            height: 24px;

            flex-shrink: 0;

            color: var(--thesis-purple);

            background: var(--thesis-purple-light);

            border: 1px solid #DDD6FE;

            border-radius: 6px;

            font-size: .58rem;
        }


        .admin-thesis-published-content {

            display: flex;

            flex-direction: column;

            min-width: 0;

            line-height: 1.2;
        }


        .admin-thesis-published-label {

            margin-bottom: .08rem;

            color: var(--thesis-text-muted);

            font-size: .55rem;

            font-weight: 800;

            text-transform: uppercase;
        }


        .admin-thesis-published-value {

            display: block;

            min-width: 0;

            overflow: hidden;

            color: var(--thesis-text-secondary);

            font-size: .66rem;

            font-weight: 700;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        .admin-thesis-card-body {

            display: flex;

            flex-direction: column;

            flex: 1;

            padding: .15rem 1rem 1rem;
        }


        .admin-thesis-detail {

            display: flex;

            align-items: center;

            gap: .65rem;

            min-width: 0;

            margin-bottom: .7rem;
        }


        .admin-thesis-detail-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 32px;

            height: 32px;

            flex-shrink: 0;

            color: var(--thesis-purple);

            background: var(--thesis-purple-light);

            border: 1px solid #DDD6FE;

            border-radius: 8px;

            font-size: .75rem;
        }


        .admin-thesis-detail-content {

            display: flex;

            flex-direction: column;

            min-width: 0;
        }


        .admin-thesis-detail-label {

            margin-bottom: .1rem;

            color: var(--thesis-text-muted);

            font-size: .65rem;

            font-weight: 800;

            text-transform: uppercase;
        }


        .admin-thesis-detail-value {

            overflow: hidden;

            color: var(--thesis-text-secondary);

            font-size: .78rem;

            font-weight: 600;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        .admin-thesis-submitted {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 1rem;

            margin-top: .3rem;

            padding-top: .8rem;

            border-top: 1px solid var(--thesis-border-soft);
        }


        .admin-thesis-submitted-label {

            color: var(--thesis-text-muted);

            font-size: .65rem;

            font-weight: 800;

            text-transform: uppercase;
        }


        .admin-thesis-submitted-value {

            min-width: 0;

            overflow: hidden;

            color: var(--thesis-text-secondary);

            font-size: .78rem;

            font-weight: 700;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        .admin-thesis-card-footer {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: .5rem;

            padding: .75rem;

            background: var(--thesis-input-bg);

            border-top: 1px solid var(--thesis-border-soft);
        }


        .admin-thesis-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            min-height: 38px;

            padding: .4rem .7rem;

            border-radius: 8px;

            text-decoration: none;

            font-size: .72rem;

            font-weight: 800;

            cursor: pointer;

            transition:
                color .2s ease,
                background-color .2s ease,
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }


        /* =========================================
           VIEW DETAIL - DARK PURPLE
        ========================================= */

        .admin-thesis-view-detail {

            color: var(--thesis-detail);

            background: transparent;

            border: 1px solid var(--thesis-detail);
        }


        .admin-thesis-view-detail:hover {

            color: #FFFFFF;

            background: var(--thesis-detail);

            border-color: var(--thesis-detail);

            transform: translateY(-1px);

            box-shadow:
                0 4px 10px rgba(101, 56, 217, .18);
        }


        /* =========================================
           VIEW PDF - RED
        ========================================= */

        .admin-thesis-view-pdf {

            color: var(--thesis-pdf);

            background: transparent;

            border: 1px solid var(--thesis-pdf);
        }


        .admin-thesis-view-pdf:hover {

            color: #FFFFFF;

            background: var(--thesis-pdf);

            border-color: var(--thesis-pdf);

            transform: translateY(-1px);

            box-shadow:
                0 4px 10px rgba(220, 38, 38, .18);
        }


        .admin-thesis-empty {

            grid-column: 1 / -1;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            min-height: 260px;

            padding: 2rem;

            text-align: center;

            color: var(--thesis-text);

            background: var(--thesis-card-bg);

            border: 1px solid var(--thesis-border-soft);

            border-radius: 16px;

            box-shadow: var(--thesis-card-shadow);
        }


        .admin-thesis-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 55px;

            height: 55px;

            margin-bottom: 1rem;

            color: #FFFFFF;

            background: var(--thesis-purple);

            border-radius: 13px;

            font-size: 1.25rem;
        }


        .admin-thesis-empty h3 {

            margin: 0 0 .35rem;

            color: var(--thesis-text);

            font-size: 1rem;

            font-weight: 800;
        }


        .admin-thesis-empty p {

            margin: 0;

            color: var(--thesis-text-muted);

            font-size: .78rem;
        }


        .thesis-table-wrapper {

            width: 100%;

            overflow: hidden;

            background: var(--thesis-card-bg);

            border: 1px solid var(--thesis-border-soft);

            border-radius: 14px;

            box-shadow: var(--thesis-card-shadow);
        }


        .thesis-table {

            width: 100%;

            margin: 0;

            table-layout: fixed;

            border-collapse: collapse;

            color: var(--thesis-text);

            background: var(--thesis-card-bg);
        }


        .thesis-table th:nth-child(1),
        .thesis-table td:nth-child(1) {
            width: 4%;
        }


        .thesis-table th:nth-child(2),
        .thesis-table td:nth-child(2) {
            width: 22%;
        }


        .thesis-table th:nth-child(3),
        .thesis-table td:nth-child(3) {
            width: 12%;
        }


        .thesis-table th:nth-child(4),
        .thesis-table td:nth-child(4) {
            width: 12%;
        }


        .thesis-table th:nth-child(5),
        .thesis-table td:nth-child(5) {
            width: 10%;
        }


        .thesis-table th:nth-child(6),
        .thesis-table td:nth-child(6) {
            width: 13%;
        }


        .thesis-table th:nth-child(7),
        .thesis-table td:nth-child(7) {
            width: 10%;
        }


        .thesis-table th:nth-child(8),
        .thesis-table td:nth-child(8) {
            width: 10%;
        }


        .thesis-table th:nth-child(9),
        .thesis-table td:nth-child(9) {
            width: 7%;
        }


        .thesis-table thead th {

            padding: .85rem .65rem;

            color: #4C3A8A;

            background: #E9E2FF;

            border-bottom: 1px solid #D8CCFF;

            font-size: .72rem;

            font-weight: 800;

            line-height: 1.35;

            text-align: left;

            text-transform: uppercase;

            overflow-wrap: break-word;
        }


        [data-bs-theme="dark"] .thesis-table thead th {

            color: #D8CCFF;

            background: #292342;

            border-bottom-color: #403765;
        }


        .thesis-table tbody td {

            padding: .85rem .65rem;

            color: var(--thesis-text-secondary);

            background: var(--thesis-card-bg);

            border-bottom: 1px solid var(--thesis-border-soft);

            font-size: .80rem;

            font-weight: 600;

            line-height: 1.45;

            vertical-align: middle;

            overflow-wrap: anywhere;
        }


        .thesis-table tbody tr:last-child td {

            border-bottom: 0;
        }


        .thesis-table tbody tr:hover td {

            background: var(--thesis-purple-light);
        }


        [data-bs-theme="dark"] .thesis-table tbody tr:hover td {

            background: #20253A;
        }


        .thesis-table-number {

            color: var(--thesis-purple) !important;

            font-weight: 800 !important;

            text-align: center !important;
        }


        .thesis-table-title-text {

            display: block;

            width: 100%;

            color: var(--thesis-text);

            font-size: .82rem;

            font-weight: 800;

            line-height: 1.45;

            overflow-wrap: anywhere;
        }


        .thesis-table-actions {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: .35rem;

            width: 100%;
        }


        .thesis-table-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            width: 34px;

            height: 34px;

            min-width: 34px;

            border-radius: 6px;

            text-decoration: none;

            cursor: pointer;

            transition:
                color .2s ease,
                background-color .2s ease,
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }


        /* =========================================
           TABLE VIEW DETAIL - DARK PURPLE
        ========================================= */

        .thesis-table-view {

            color: var(--thesis-detail);

            background: transparent;

            border: 1px solid var(--thesis-detail);
        }


        .thesis-table-view:hover {

            color: #FFFFFF;

            background: var(--thesis-detail);

            border-color: var(--thesis-detail);

            transform: translateY(-1px);

            box-shadow:
                0 3px 8px rgba(101, 56, 217, .18);
        }


        /* =========================================
           TABLE VIEW PDF - RED
        ========================================= */

        .thesis-table-pdf {

            color: var(--thesis-pdf);

            background: transparent;

            border: 1px solid var(--thesis-pdf);
        }


        .thesis-table-pdf:hover {

            color: #FFFFFF;

            background: var(--thesis-pdf);

            border-color: var(--thesis-pdf);

            transform: translateY(-1px);

            box-shadow:
                0 3px 8px rgba(220, 38, 38, .18);
        }


        .thesis-table-empty {

            text-align: center;

            padding: 2rem !important;
        }


        .thesis-table-empty strong,
        .thesis-table-empty span {

            display: block;
        }


        .thesis-table-empty strong {

            color: var(--thesis-text);

            margin-bottom: .3rem;
        }


        .thesis-table-empty span {

            color: var(--thesis-text-muted);
        }


        @media (max-width: 1399.98px) {

            .thesis-partial-card-results {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }

        }


        @media (max-width: 1199.98px) {

            .thesis-partial-card-results {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }


            .thesis-table thead th {

                padding: .75rem .5rem;

                font-size: .68rem;
            }


            .thesis-table tbody td {

                padding: .75rem .5rem;

                font-size: .74rem;
            }

        }


        @media (max-width: 767.98px) {

            .thesis-page {

                padding: 12px;
            }


            .thesis-page-header {

                margin: 70px 0 1rem;

                padding: 1rem;
            }


            .thesis-title {

                font-size: 1.4rem;
            }


            .thesis-view-button {

                width: 38px;

                min-width: 38px;

                height: 36px;

                padding: 0;
            }


            .thesis-view-button span {

                display: none;
            }


            .thesis-partial-card-results {

                grid-template-columns: 1fr;

                gap: 1rem;

                padding: 0 .75rem 1rem;
            }


            .admin-thesis-published {

                grid-template-columns: 1fr;
            }


            .thesis-results-container.table-mode {

                padding: 0 .65rem 1rem;
            }


            .thesis-table {

                table-layout: fixed;
            }


            .thesis-table th:nth-child(5),
            .thesis-table td:nth-child(5),
            .thesis-table th:nth-child(6),
            .thesis-table td:nth-child(6),
            .thesis-table th:nth-child(7),
            .thesis-table td:nth-child(7) {

                display: none;
            }


            .thesis-table th:nth-child(1),
            .thesis-table td:nth-child(1) {

                width: 8%;
            }


            .thesis-table th:nth-child(2),
            .thesis-table td:nth-child(2) {

                width: 43%;
            }


            .thesis-table th:nth-child(3),
            .thesis-table td:nth-child(3) {

                width: 20%;
            }


            .thesis-table th:nth-child(4),
            .thesis-table td:nth-child(4) {

                width: 17%;
            }


            .thesis-table th:nth-child(8),
            .thesis-table td:nth-child(8) {

                width: 14%;
            }


            .thesis-table th:nth-child(9),
            .thesis-table td:nth-child(9) {

                display: table-cell;

                width: 14%;
            }


            .thesis-table thead th {

                padding: .65rem .3rem;

                font-size: .62rem;
            }


            .thesis-table tbody td {

                padding: .7rem .3rem;

                font-size: .68rem;
            }


            .thesis-table-title-text {

                font-size: .70rem;
            }


            .thesis-table-action {

                width: 28px;

                height: 28px;

                min-width: 28px;
            }

        }


        @media (max-width: 575.98px) {

            .thesis-page-header {

                padding: .85rem;
            }


            .thesis-title {

                font-size: 1.25rem;
            }


            .thesis-partial-card-results {

                gap: .85rem;

                padding: 0 .65rem 1rem;
            }


            .admin-thesis-card-body {

                padding: .15rem .9rem .9rem;
            }


            .admin-thesis-card-footer {

                padding: .65rem;
            }


            .admin-thesis-action {

                min-height: 36px;

                font-size: .66rem;
            }


            .thesis-table thead th {

                padding: .6rem .25rem;

                font-size: .56rem;
            }


            .thesis-table tbody td {

                padding: .6rem .25rem;

                font-size: .62rem;
            }


            .thesis-table-title-text {

                font-size: .64rem;
            }


            .thesis-table-action {

                width: 25px;

                height: 25px;

                min-width: 25px;

                font-size: .55rem;
            }

        }


        @media (prefers-reduced-motion: reduce) {

            .thesis-page *,
            .thesis-page *::before,
            .thesis-page *::after {

                animation-duration: .01ms !important;

                transition-duration: .01ms !important;
            }

        }
    </style>

</x-app-layout>
