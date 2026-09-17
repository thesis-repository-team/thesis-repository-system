<x-app-layout>

    <div class="dashboard-content thesis-page">

        <div class="thesis-page-header">

            <div class="thesis-header-content">

                <div class="thesis-title-row">

                    <div>

                        <span class="thesis-overline">
                            STUDENT
                        </span>

                        <h1 class="thesis-title">
                            Saved Theses
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


            <div id="savedThesisResults" class="thesis-results-container">

                {{-- =================================================
                    CARD VIEW
                ================================================== --}}

                <div class="thesis-partial-card-results">

                    @forelse ($savedTheses as $saved)
                        @php
                            $thesis = $saved->thesis;
                        @endphp

                        @if ($thesis)
                            <div class="admin-thesis-card">

                                <div class="admin-thesis-card-top">

                                    <div class="admin-thesis-card-heading">

                                        <div class="admin-thesis-icon">
                                            <i class="bi bi-bookmark-fill"></i>
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
                                            <i class="bi bi-bookmark"></i>
                                        </div>

                                        <div class="admin-thesis-published-content">

                                            <span class="admin-thesis-published-label">
                                                Saved At
                                            </span>

                                            <span class="admin-thesis-published-value">
                                                {{ $saved->saved_at ? \Carbon\Carbon::parse($saved->saved_at)->format('M d, Y') : '—' }}
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

                                    {{-- VIEW DETAIL --}}
                                    <a href="{{ route('student.thesis.show', $thesis->id) }}"
                                        class="admin-thesis-action admin-thesis-view-detail" title="View Detail">
                                        <i class="bi bi-file-text"></i>

                                        <span>
                                            View Detail
                                        </span>
                                    </a>


                                    {{-- VIEW PDF --}}
                                    <a href="{{ route('student.thesis.view-pdf', $thesis->id) }}"
                                        class="admin-thesis-action admin-thesis-view-pdf" title="View PDF">
                                        <i class="bi bi-file-earmark-pdf"></i>

                                        <span>
                                            PDF
                                        </span>
                                    </a>


                                    {{-- REMOVE --}}
                                    <form method="POST"
                                        action="{{ route('student.saved_thesis.destroy', $thesis->id) }}"
                                        class="saved-remove-form">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="admin-thesis-action admin-thesis-remove"
                                            title="Remove from Saved">
                                            <i class="bi bi-bookmark-x"></i>

                                            <span>
                                                Remove
                                            </span>
                                        </button>

                                    </form>

                                </div>

                            </div>
                        @endif

                    @empty

                        <div class="admin-thesis-empty">

                            <div class="admin-thesis-empty-icon">
                                <i class="bi bi-bookmark-x"></i>
                            </div>

                            <h3>
                                No Saved Theses
                            </h3>

                            <p>
                                You have not saved any thesis records yet.
                            </p>

                        </div>
                    @endforelse

                </div>


                {{-- =================================================
                    TABLE VIEW
                ================================================== --}}

                <div class="thesis-partial-table-results">

                    <div class="thesis-table-wrapper">

                        <table class="thesis-table">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Thesis</th>

                                    <th>Author</th>

                                    <th>Department</th>

                                    <th>Academic Year</th>

                                    <th>Published By</th>

                                    <th>Published At</th>

                                    <th>Saved At</th>

                                    <th>Actions</th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($savedTheses as $saved)
                                    @php
                                        $thesis = $saved->thesis;
                                    @endphp

                                    @if ($thesis)
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
                                                {{ $saved->saved_at ? \Carbon\Carbon::parse($saved->saved_at)->format('M d, Y') : '—' }}
                                            </td>


                                            <td>

                                                <div class="thesis-table-actions">

                                                    {{-- VIEW DETAIL --}}
                                                    <a href="{{ route('student.thesis.show', $thesis->id) }}"
                                                        class="thesis-table-action thesis-table-view"
                                                        title="View Detail">
                                                        <i class="bi bi-file-text"></i>
                                                    </a>


                                                    {{-- VIEW PDF --}}
                                                    <a href="{{ route('student.thesis.view-pdf', $thesis->id) }}"
                                                        class="thesis-table-action thesis-table-pdf" title="PDF">
                                                        <i class="bi bi-file-earmark-pdf"></i>
                                                    </a>


                                                    {{-- REMOVE --}}
                                                    <form method="POST"
                                                        action="{{ route('student.saved_thesis.destroy', $thesis->id) }}">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="thesis-table-action thesis-table-remove"
                                                            title="Remove">
                                                            <i class="bi bi-bookmark-x"></i>
                                                        </button>

                                                    </form>

                                                </div>

                                            </td>

                                        </tr>
                                    @endif

                                @empty

                                    <tr>

                                        <td colspan="9" class="thesis-table-empty">

                                            <strong>
                                                No Saved Theses
                                            </strong>

                                            <span>
                                                You have not saved any thesis records yet.
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


    {{-- =============================================================
        JAVASCRIPT
    ============================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const results =
                document.getElementById('savedThesisResults');

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
                        'studentSavedThesisView',
                        'table'
                    );

                } else {

                    results.classList.remove('table-mode');

                    cardButton?.classList.add('is-active');

                    tableButton?.classList.remove('is-active');


                    localStorage.setItem(
                        'studentSavedThesisView',
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
                localStorage.getItem(
                    'studentSavedThesisView'
                );


            setView(
                savedView === 'table' ?
                'table' :
                'cards'
            );

        });
    </script>


    {{-- =============================================================
        CSS
    ============================================================== --}}

    <style>
        :root {

            --thesis-purple: #6538D9;
            --thesis-purple-hover: #5428C7;

            /* DARK PURPLE FOR VIEW DETAIL */
            --thesis-detail: #4C1D95;
            --thesis-detail-hover: #3B0764;

            --thesis-purple-light: #F5F3FF;
            --thesis-purple-soft: #EDE9FE;

            --thesis-page-bg: #FAFAFA;
            --thesis-card-bg: #FFFFFF;
            --thesis-input-bg: #F9FAFB;

            --thesis-text: #111111;
            --thesis-text-secondary: #4B5563;
            --thesis-text-muted: #6B7280;

            --thesis-border-soft: #E5E7EB;

            /* BLUE PDF */
            --thesis-blue: #2563EB;
            --thesis-blue-hover: #1D4ED8;

            /* RED REMOVE */
            --thesis-remove: #DC2626;
            --thesis-remove-hover: #B91C1C;

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
            --thesis-purple-light: #292342;
            --thesis-purple-soft: #342C52;

            /* DARK PURPLE FOR VIEW DETAIL */
            --thesis-detail: #6D28D9;
            --thesis-detail-hover: #7C3AED;

            --thesis-blue: #60A5FA;
            --thesis-blue-hover: #3B82F6;

            --thesis-remove: #F87171;
            --thesis-remove-hover: #EF4444;

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

        }


        .thesis-page-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            padding: 20px 0 10px 0;

            margin: 80px 0 10px;

            /* background: var(--thesis-page-bg); */

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

            text-transform: uppercase;

        }


        .thesis-title {

            margin: 0;

            color: var(--thesis-text);

            font-size: 1.9rem;

            font-weight: 700;

            line-height: 1.2;

        }


        .thesis-results-wrapper {

            position: relative;

            width: 100%;

        }


        .thesis-results-toolbar {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            width: 100%;

            margin: 1rem 0 .85rem;

        }


        .thesis-view-toggle {

            display: inline-flex;

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

        }


        [data-bs-theme="dark"] .thesis-view-toggle {

            background: #292342;

            border-color: #403765;

        }


        .thesis-results-container {

            width: 100%;

        }


        .thesis-partial-card-results {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 1.25rem;

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

            transition: .25s ease;

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

            min-width: 0;

            padding: 1rem;

        }


        .admin-thesis-card-heading {

            display: flex;

            align-items: center;

            min-width: 0;

            gap: .7rem;

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

        }


        .admin-thesis-card-title {

            display: -webkit-box;

            min-width: 0;

            margin: 0;

            overflow: hidden;

            color: var(--thesis-text);

            font-size: 1.05rem;

            font-weight: 800;

            line-height: 1.4;

            text-overflow: ellipsis;

            -webkit-line-clamp: 3;

            -webkit-box-orient: vertical;

        }


        .admin-thesis-published {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: .45rem;

            margin: 0 .85rem .75rem;

            padding: .55rem .65rem;

            background: var(--thesis-input-bg);

            border: 1px solid var(--thesis-border-soft);

            border-radius: 8px;

        }


        .admin-thesis-published-item {

            display: flex;

            align-items: center;

            min-width: 0;

            gap: .4rem;

        }


        .admin-thesis-published-icon,
        .admin-thesis-detail-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            color: var(--thesis-purple);

            background: var(--thesis-purple-light);

            border: 1px solid #DDD6FE;

        }


        .admin-thesis-published-icon {

            width: 24px;

            height: 24px;

            border-radius: 6px;

            font-size: .58rem;

        }


        .admin-thesis-published-content,
        .admin-thesis-detail-content {

            display: flex;

            flex-direction: column;

            min-width: 0;

        }


        .admin-thesis-published-label,
        .admin-thesis-detail-label,
        .admin-thesis-submitted-label {

            color: var(--thesis-text-muted);

            font-size: .6rem;

            font-weight: 800;

            text-transform: uppercase;

        }


        .admin-thesis-published-value {

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

            min-width: 0;

            padding: .15rem 1rem 1rem;

        }


        .admin-thesis-detail {

            display: flex;

            align-items: center;

            min-width: 0;

            gap: .65rem;

            margin-bottom: .7rem;

        }


        .admin-thesis-detail-icon {

            width: 32px;

            height: 32px;

            border-radius: 8px;

            font-size: .75rem;

        }


        .admin-thesis-detail-content {

            min-width: 0;

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

            min-width: 0;

            gap: 1rem;

            margin-top: .3rem;

            padding-top: .8rem;

            border-top: 1px solid var(--thesis-border-soft);

        }


        .admin-thesis-submitted-value {

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

            justify-content: stretch;

            gap: .35rem;

            width: 100%;

            padding: .65rem;

            background: var(--thesis-input-bg);

            border-top: 1px solid var(--thesis-border-soft);

        }


        .admin-thesis-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            flex: 1 1 0;

            min-width: 0;

            width: 0;

            min-height: 34px;

            padding: .35rem .25rem;

            border-radius: 7px;

            background: transparent;

            text-decoration: none;

            font-size: .63rem;

            font-weight: 800;

            line-height: 1;

            white-space: nowrap;

            cursor: pointer;

            transition:
                color .2s ease,
                background-color .2s ease,
                border-color .2s ease,
                transform .2s ease;

        }


        .admin-thesis-action i {

            flex-shrink: 0;

            font-size: .68rem;

        }


        .saved-remove-form {

            display: flex;

            flex: 1 1 0;

            min-width: 0;

            width: 0;

            margin: 0;

        }


        .saved-remove-form .admin-thesis-action {

            width: 100%;

        }


        /* =========================================================
           VIEW DETAIL = DARK PURPLE
        ========================================================== */

        .admin-thesis-view-detail {

            color: var(--thesis-detail);

            border: 1px solid var(--thesis-detail);

        }


        .admin-thesis-view-detail:hover {

            color: #FFFFFF;

            background: var(--thesis-detail-hover);

            border-color: var(--thesis-detail-hover);

            transform: translateY(-1px);

        }


        /* =========================================================
           VIEW PDF = BLUE
        ========================================================== */

        .admin-thesis-view-pdf {

            color: var(--thesis-blue);

            border: 1px solid var(--thesis-blue);

        }


        .admin-thesis-view-pdf:hover {

            color: #FFFFFF;

            background: var(--thesis-blue);

            border-color: var(--thesis-blue);

            transform: translateY(-1px);

        }


        /* =========================================================
           REMOVE = RED
        ========================================================== */

        .admin-thesis-remove {

            color: var(--thesis-remove);

            border: 1px solid var(--thesis-remove);

        }


        .admin-thesis-remove:hover {

            color: #FFFFFF;

            background: var(--thesis-remove);

            border-color: var(--thesis-remove);

            transform: translateY(-1px);

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


        /* =========================================================
           TABLE
        ========================================================== */

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
            width: 12%;
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
            width: 8%;
        }


        .thesis-table thead th {

            padding: .85rem .65rem;

            color: #4C3A8A;

            background: #E9E2FF;

            border-bottom: 1px solid #D8CCFF;

            font-size: .72rem;

            font-weight: 800;

            text-transform: uppercase;

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
            background: #FAFAFA;
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

            color: var(--thesis-text);

            font-size: .82rem;

            font-weight: 800;

            line-height: 1.45;

        }


        /* =========================================================
           TABLE ACTIONS
        ========================================================== */

        .thesis-table-actions {

            display: flex;

            align-items: center;

            justify-content: center;

            margin-right: 20px;

            gap: .3rem;

        }


        .thesis-table-actions form {

            display: flex;

            margin: 0;

        }


        .thesis-table-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            width: 34px;

            height: 34px;

            min-width: 34px;

            padding: 0;

            border-radius: 6px;

            background: transparent;

            cursor: pointer;

            transition: .2s ease;

        }


        /* TABLE VIEW DETAIL = DARK PURPLE */

        .thesis-table-view {

            color: var(--thesis-detail);

            border: 1px solid var(--thesis-detail);

        }


        .thesis-table-view:hover {

            color: #FFFFFF;

            background: var(--thesis-detail-hover);

            border-color: var(--thesis-detail-hover);

        }


        /* TABLE VIEW PDF = BLUE */

        .thesis-table-pdf {

            color: var(--thesis-blue);

            border: 1px solid var(--thesis-blue);

        }


        .thesis-table-pdf:hover {

            color: #FFFFFF;

            background: var(--thesis-blue);

            border-color: var(--thesis-blue);

        }


        /* TABLE REMOVE = RED */

        .thesis-table-remove {

            color: var(--thesis-remove);

            border: 1px solid var(--thesis-remove);

        }


        .thesis-table-remove:hover {

            color: #FFFFFF;

            background: var(--thesis-remove);

            border-color: var(--thesis-remove);

        }


        .thesis-table-empty {

            padding: 2rem !important;

            text-align: center;

        }


        .thesis-table-empty strong,
        .thesis-table-empty span {

            display: block;

        }


        .thesis-table-empty strong {

            margin-bottom: .3rem;

            color: var(--thesis-text);

        }


        .thesis-table-empty span {

            color: var(--thesis-text-muted);

        }


        /* =========================================================
           LARGE SCREEN
        ========================================================== */

        @media (max-width: 1399.98px) {

            .thesis-partial-card-results {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

            }

        }


        /* =========================================================
           MEDIUM SCREEN
        ========================================================== */

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


        /* =========================================================
           TABLET / MOBILE
        ========================================================== */

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


            .admin-thesis-card-footer {

                gap: .3rem;

                padding: .6rem;

            }


            .admin-thesis-action {

                min-height: 34px;

                padding: .3rem .25rem;

                font-size: .60rem;

            }


            .admin-thesis-action i {
                font-size: .66rem;
            }


            .thesis-results-container.table-mode {
                padding: 0 .65rem 1rem;
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


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

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


            .admin-thesis-card-footer {

                gap: .25rem;

                padding: .55rem;

            }


            .admin-thesis-action {

                min-height: 32px;

                padding: .28rem .2rem;

                gap: .18rem;

                font-size: .55rem;

                border-radius: 6px;

            }


            .admin-thesis-action i {
                font-size: .60rem;
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


        /* =========================================================
           REDUCED MOTION
        ========================================================== */

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
