<x-app-layout>

    <div class="dashboard-content thesis-requests-page">

        <div class="request-page-header">

            <div class="request-header-top">

                <div class="request-header-content">

                    <span class="request-overline">
                        MANAGEMENT
                    </span>

                    <h2 class="request-page-title">
                        Thesis Requests
                    </h2>

                    {{-- <p class="request-page-description">
                        Review and manage thesis upload requests.
                    </p> --}}

                </div>

                <div class="request-header-action">

                    <a href="{{ route('student.thesis_requests.create') }}" class="request-add-button">
                        <i class="bi bi-plus-lg"></i>

                        <span>
                            Add New Request
                        </span>
                    </a>

                </div>

            </div>

        </div>


        @if (session('error'))
            <div class="request-alert">

                <i class="bi bi-exclamation-circle"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>
        @endif


        @if (session('success'))
            <div class="request-success">

                <i class="bi bi-check-circle"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>
        @endif


        <div id="requestResultsContainer">

            <div class="request-view-row">

                <div class="request-view-toggle">

                    <button type="button" id="requestCardViewBtn" class="request-view-button active">
                        <i class="bi bi-grid-3x3-gap-fill"></i>

                        <span>
                            Card
                        </span>
                    </button>


                    <button type="button" id="requestTableViewBtn" class="request-view-button">
                        <i class="bi bi-table"></i>

                        <span>
                            Table
                        </span>
                    </button>

                </div>

            </div>


            <div id="requestCardView" class="request-grid">

                @forelse ($thesisRequests as $thesisRequest)
                    <article class="request-card">

                        <div class="request-card-content">

                            <div class="request-title-row">

                                <div class="request-title-area">

                                    <div class="request-title-with-icon">

                                        <i class="bi bi-journal-text"></i>

                                        <h3 class="request-title" title="{{ $thesisRequest->title }}">
                                            {{ $thesisRequest->title }}
                                        </h3>

                                    </div>

                                </div>


                                @if ($thesisRequest->status === 'pending')
                                    <span class="request-status pending">
                                        <i class="bi bi-clock"></i>
                                        Pending
                                    </span>
                                @elseif ($thesisRequest->status === 'approved')
                                    <span class="request-status approved">
                                        <i class="bi bi-check-circle"></i>
                                        Approved
                                    </span>
                                @elseif ($thesisRequest->status === 'rejected')
                                    <span class="request-status rejected">
                                        <i class="bi bi-x-circle"></i>
                                        Rejected
                                    </span>
                                @else
                                    <span class="request-status unknown">
                                        <i class="bi bi-question-circle"></i>
                                        {{ ucfirst($thesisRequest->status ?? 'Unknown') }}
                                    </span>
                                @endif

                            </div>


                            <div class="request-information">

                                <div class="request-info">

                                    <div class="request-info-icon">
                                        <i class="bi bi-building"></i>
                                    </div>

                                    <div class="request-info-content">

                                        <span>
                                            Department
                                        </span>

                                        <strong>
                                            {{ $thesisRequest->department?->name ?? 'N/A' }}
                                        </strong>

                                    </div>

                                </div>


                                <div class="request-info">

                                    <div class="request-info-icon">
                                        <i class="bi bi-person"></i>
                                    </div>

                                    <div class="request-info-content">

                                        <span>
                                            Author
                                        </span>

                                        <strong>
                                            {{ $thesisRequest->author_name ?? 'N/A' }}
                                        </strong>

                                    </div>

                                </div>


                                <div class="request-info">

                                    <div class="request-info-icon">
                                        <i class="bi bi-person-up"></i>
                                    </div>

                                    <div class="request-info-content">

                                        <span>
                                            Submitted By
                                        </span>

                                        <strong>
                                            {{ $thesisRequest->user?->username ?? 'N/A' }}
                                        </strong>

                                    </div>

                                </div>


                                <div class="request-info">

                                    <div class="request-info-icon">
                                        <i class="bi bi-calendar3"></i>
                                    </div>

                                    <div class="request-info-content">

                                        <span>
                                            Submitted At
                                        </span>

                                        <strong>

                                            @if ($thesisRequest->submitted_at)
                                                {{ \Carbon\Carbon::parse($thesisRequest->submitted_at)->format('d M Y') }}
                                            @else
                                                N/A
                                            @endif

                                        </strong>

                                    </div>

                                </div>


                                @if ($thesisRequest->thesis)
                                    <div class="request-info">

                                        <div class="request-info-icon">
                                            <i class="bi bi-person-check"></i>
                                        </div>

                                        <div class="request-info-content">

                                            <span>
                                                Published By
                                            </span>

                                            <strong>
                                                {{ $thesisRequest->thesis?->publishedBy?->full_name ??
                                                    ($thesisRequest->thesis?->publishedBy?->username ?? 'N/A') }}
                                            </strong>

                                        </div>

                                    </div>
                                @endif

                            </div>

                        </div>


                        <div class="request-actions">

                            <a href="{{ route('student.thesis_requests.show', $thesisRequest->id) }}"
                                class="request-action request-action-details" title="View Details"
                                aria-label="View Details">

                                <i class="bi bi-file-text"></i>

                                <span>
                                    View Details
                                </span>

                            </a>


                            @if ($thesisRequest->thesis)
                                <a href="{{ route('student.thesis.view-pdf', $thesisRequest->thesis->id) }}"
                                    target="_blank" class="request-action request-action-pdf" title="View PDF"
                                    aria-label="View PDF">

                                    <i class="bi bi-file-earmark-pdf"></i>

                                    <span>
                                        PDF
                                    </span>

                                </a>
                            @else
                                <span class="request-action request-action-pdf request-action-disabled" title="No PDF">

                                    <i class="bi bi-file-earmark-x"></i>

                                    <span>
                                        No PDF
                                    </span>

                                </span>
                            @endif

                        </div>

                    </article>

                @empty

                    <div class="request-empty">

                        <div class="request-empty-icon">
                            <i class="bi bi-journal-x"></i>
                        </div>

                        <h3>
                            No Thesis Requests
                        </h3>

                        <p>
                            There are currently no thesis upload requests.
                        </p>

                    </div>
                @endforelse

            </div>


            <div id="requestTableView" class="request-table-container">

                <div class="request-table-scroll">

                    <table class="request-table">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Thesis Title</th>

                                <th>Author</th>

                                <th>Department</th>

                                <th>Submitted By</th>

                                <th>Submitted At</th>

                                <th>Published By</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($thesisRequests as $thesisRequest)
                                <tr>

                                    <td class="request-table-number">
                                        {{ $loop->iteration }}
                                    </td>


                                    <td>

                                        <div class="request-table-title">

                                            <span title="{{ $thesisRequest->title }}">
                                                {{ $thesisRequest->title }}
                                            </span>

                                        </div>

                                    </td>


                                    <td>

                                        <span class="request-table-text">
                                            {{ $thesisRequest->author_name ?? 'N/A' }}
                                        </span>

                                    </td>


                                    <td>

                                        <span class="request-table-department">
                                            {{ $thesisRequest->department?->name ?? 'N/A' }}
                                        </span>

                                    </td>


                                    <td>

                                        <span class="request-table-text">
                                            {{ $thesisRequest->user?->username ?? 'N/A' }}
                                        </span>

                                    </td>


                                    <td>

                                        <span class="request-table-text">

                                            @if ($thesisRequest->submitted_at)
                                                {{ \Carbon\Carbon::parse($thesisRequest->submitted_at)->format('d M Y') }}
                                            @else
                                                N/A
                                            @endif

                                        </span>

                                    </td>


                                    <td>

                                        <span class="request-table-text">

                                            @if ($thesisRequest->thesis)
                                                {{ $thesisRequest->thesis?->publishedBy?->full_name ??
                                                    ($thesisRequest->thesis?->publishedBy?->username ?? 'N/A') }}
                                            @else
                                                N/A
                                            @endif

                                        </span>

                                    </td>


                                    <td>

                                        @if ($thesisRequest->status === 'pending')
                                            <span class="request-table-status pending">
                                                <i class="bi bi-clock"></i>
                                                Pending
                                            </span>
                                        @elseif ($thesisRequest->status === 'approved')
                                            <span class="request-table-status approved">
                                                <i class="bi bi-check-circle"></i>
                                                Approved
                                            </span>
                                        @elseif ($thesisRequest->status === 'rejected')
                                            <span class="request-table-status rejected">
                                                <i class="bi bi-x-circle"></i>
                                                Rejected
                                            </span>
                                        @else
                                            <span class="request-table-status unknown">
                                                <i class="bi bi-question-circle"></i>
                                                {{ ucfirst($thesisRequest->status ?? 'Unknown') }}
                                            </span>
                                        @endif

                                    </td>


                                    <td>

                                        <div class="request-table-actions">

                                            <a href="{{ route('student.thesis_requests.show', $thesisRequest->id) }}"
                                                class="request-table-action request-table-details"
                                                title="View Details" aria-label="View Details">

                                                <i class="bi bi-file-text"></i>

                                            </a>


                                            @if ($thesisRequest->thesis)
                                                <a href="{{ route('student.thesis.view-pdf', $thesisRequest->thesis->id) }}"
                                                    target="_blank" class="request-table-action request-table-pdf"
                                                    title="View PDF" aria-label="View PDF">

                                                    <i class="bi bi-file-earmark-pdf"></i>

                                                </a>
                                            @else
                                                <span class="request-table-action request-table-pdf disabled"
                                                    title="No PDF" aria-label="No PDF">

                                                    <i class="bi bi-file-earmark-x"></i>

                                                </span>
                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="request-table-empty">

                                        <div class="request-empty">

                                            <div class="request-empty-icon">
                                                <i class="bi bi-journal-x"></i>
                                            </div>

                                            <h3>
                                                No Thesis Requests
                                            </h3>

                                            <p>
                                                There are currently no thesis upload requests.
                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    <style>
        :root {

            --thesis-request-page-bg: #f0f2f5;
            --thesis-request-card-bg: #ffffff;
            --thesis-request-card-bg-soft: #faf9ff;
            --thesis-request-input-bg: #f8f7fc;

            --thesis-request-text: #16121f;
            --thesis-request-text-secondary: #514d5a;
            --thesis-request-text-muted: #8a8792;

            --thesis-request-border: #e4e1eb;
            --thesis-request-border-soft: #e9e6ef;

            --thesis-request-primary: #6538d9;
            --thesis-request-primary-hover: #5630bd;
            --thesis-request-primary-soft: #f0ebff;

            /* DARK PURPLE VIEW DETAILS */
            --thesis-request-details: #5426a8;
            --thesis-request-details-hover: #421d87;

            /* RED VIEW PDF */
            --thesis-request-pdf: #dc2626;
            --thesis-request-pdf-hover: #b91c1c;

            --thesis-request-shadow:
                0 4px 18px rgba(35, 20, 65, .08);

            --thesis-request-card-shadow:
                0 2px 10px rgba(35, 20, 65, .05);

        }


        [data-bs-theme="dark"] {

            --thesis-request-page-bg: #101426;
            --thesis-request-card-bg: #181d33;
            --thesis-request-card-bg-soft: #1c2138;
            --thesis-request-input-bg: #20253a;

            --thesis-request-text: #ffffff;
            --thesis-request-text-secondary: #d5d8e8;
            --thesis-request-text-muted: #999fb9;

            --thesis-request-border: #292e45;
            --thesis-request-border-soft: #292e45;

            --thesis-request-primary: #7c5ce3;
            --thesis-request-primary-hover: #9278ea;
            --thesis-request-primary-soft: #292342;

            /* DARK PURPLE VIEW DETAILS */
            --thesis-request-details: #7c5ce3;
            --thesis-request-details-hover: #6538d9;

            /* RED VIEW PDF */
            --thesis-request-pdf: #ef4444;
            --thesis-request-pdf-hover: #dc2626;

            --thesis-request-shadow:
                0 8px 24px rgba(0, 0, 0, .35);

            --thesis-request-card-shadow:
                0 2px 10px rgba(0, 0, 0, .30);

        }


        body {

            background:
                var(--thesis-request-page-bg);

            color:
                var(--thesis-request-text);

            transition:
                background-color .25s ease,
                color .25s ease;

        }


        .dashboard-content.thesis-requests-page {

            min-height: 100vh;

            padding: 20px;

            background:
                var(--thesis-request-page-bg);

            color:
                var(--thesis-request-text);

        }


        .request-page-header {

            width: 100%;

            margin-top: 90px;
            margin-bottom: 12px;
            padding: 20px 0 15px 0;


            /* box-sizing: border-box;

            background:
                var(--thesis-request-card-bg);

            border:
                1px solid var(--thesis-request-border-soft); */

            /* border-radius: 12px;

            box-shadow:
                var(--thesis-request-card-shadow); */

        }


        .request-header-top {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            width: 100%;

            gap: 30px;

        }


        .request-header-content {

            min-width: 0;

            flex: 1;

        }


        .request-overline {

            display: block;

            margin-bottom: 4px;

            color:
                var(--thesis-request-primary);

            font-size: .72rem;

            font-weight: 800;

            letter-spacing: .13em;

            text-transform: uppercase;

        }


        .request-page-title {

            margin: 0;

            color:
                var(--thesis-request-text);

            font-size: 1.9rem;

            font-weight: 700;

            line-height: 1.2;

            letter-spacing: -.035em;

        }


        .request-page-description {

            margin: 6px 0 0;

            color:
                var(--thesis-request-text-muted);

            font-size: .8rem;

            line-height: 1.5;

        }


        .request-header-action {

            flex-shrink: 0;

            padding-top: 4px;

        }


        .request-add-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            min-height: 40px;

            padding: 0 16px;

            color: #ffffff;

            background:
                var(--thesis-request-primary);

            border:
                1px solid var(--thesis-request-primary);

            border-radius: 8px;

            text-decoration: none;

            font-size: .75rem;

            font-weight: 800;

            box-shadow:
                0 5px 14px rgba(101, 56, 217, .20);

            transition:
                background-color .2s ease,
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;

        }


        .request-add-button:hover {

            color: #ffffff;

            background:
                var(--thesis-request-primary-hover);

            border-color:
                var(--thesis-request-primary-hover);

            transform: translateY(-1px);

            box-shadow:
                0 7px 17px rgba(101, 56, 217, .27);

        }


        .request-add-button i {

            font-size: .85rem;

        }


        .request-view-row {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            width: 100%;

            margin-bottom: 14px;

        }


        .request-view-toggle {

            display: inline-flex;

            align-items: center;

            gap: 3px;

            padding: 4px;

            background:
                var(--thesis-request-card-bg);

            border:
                1px solid var(--thesis-request-border);

            border-radius: 10px;

            box-shadow:
                0 3px 10px rgba(35, 20, 65, .06);

        }


        .request-view-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            min-width: 88px;

            height: 36px;

            padding: 0 13px;

            color:
                var(--thesis-request-text-muted);

            background: transparent;

            border:
                1px solid transparent;

            border-radius: 7px;

            font-size: .72rem;

            font-weight: 700;

            cursor: pointer;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;

        }


        .request-view-button i {

            font-size: .82rem;

        }


        .request-view-button:hover {

            color:
                var(--thesis-request-primary);

            background:
                var(--thesis-request-primary-soft);

        }


        .request-view-button.active {

            color: #ffffff;

            background:
                var(--thesis-request-primary);

            border-color:
                var(--thesis-request-primary);

            box-shadow:
                0 3px 8px rgba(101, 56, 217, .22);

        }


        .request-view-button.active:hover {

            color: #ffffff;

            background:
                var(--thesis-request-primary-hover);

            border-color:
                var(--thesis-request-primary-hover);

            transform: translateY(-1px);

        }


        [data-bs-theme="dark"] .request-view-toggle {

            background:
                #181d33;

            border-color:
                #292e45;

            box-shadow:
                0 4px 14px rgba(0, 0, 0, .25);

        }


        [data-bs-theme="dark"] .request-view-button {

            color:
                #999fb9;

        }


        [data-bs-theme="dark"] .request-view-button:hover {

            color:
                #c4b5fd;

            background:
                #292342;

        }


        [data-bs-theme="dark"] .request-view-button.active {

            color: #ffffff;

            background:
                #7c5ce3;

            border-color:
                #7c5ce3;

            box-shadow:
                0 4px 10px rgba(124, 92, 227, .30);

        }


        [data-bs-theme="dark"] .request-view-button.active:hover {

            color: #ffffff;

            background:
                #9278ea;

            border-color:
                #9278ea;

        }


        .request-alert,
        .request-success {

            display: flex;

            align-items: center;

            gap: .6rem;

            margin: 0 0 1.25rem;

            padding: .85rem 1rem;

            border-radius: 9px;

            font-size: .82rem;

            font-weight: 600;

        }


        .request-alert {

            color: #b42318;

            background: #fff5f5;

            border-left:
                4px solid #d92d3a;

        }


        .request-success {

            color: #176b3a;

            background: #f0fff5;

            border-left:
                4px solid #21a366;

        }


        [data-bs-theme="dark"] .request-alert {

            color: #ffb4b4;

            background: #3a2028;

            border-color: #55303a;

        }


        [data-bs-theme="dark"] .request-success {

            color: #9de2bb;

            background: #19352a;

            border-color: #28543f;

        }


        #requestResultsContainer {

            width: 100%;

        }


        #requestResultsContainer #requestCardView {

            display: grid;

        }


        #requestResultsContainer #requestTableView {

            display: none;

        }


        #requestResultsContainer.table-mode #requestCardView {

            display: none;

        }


        #requestResultsContainer.table-mode #requestTableView {

            display: block;

        }


        .request-grid {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 1.25rem;

            width: 100%;

        }


        .request-card {

            display: flex;

            flex-direction: column;

            min-width: 0;

            overflow: hidden;

            color:
                var(--thesis-request-text);

            background:
                var(--thesis-request-card-bg);

            border:
                1px solid var(--thesis-request-border-soft);

            border-radius: 14px;

            box-shadow:
                var(--thesis-request-card-shadow);

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background-color .2s ease,
                border-color .2s ease;

        }


        .request-card:hover {

            transform: translateY(-3px);

            border-color:
                rgba(101, 56, 217, .30);

            box-shadow:
                0 10px 28px rgba(35, 20, 65, .11);

        }


        [data-bs-theme="dark"] .request-card:hover {

            border-color:
                rgba(124, 92, 227, .35);

            background:
                var(--thesis-request-card-bg-soft);

            box-shadow:
                0 10px 30px rgba(0, 0, 0, .45);

        }


        .request-card-content {

            display: flex;

            flex-direction: column;

            flex: 1;

            padding: 1rem;

        }


        .request-title-row {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: .75rem;

            margin-bottom: 1rem;

        }


        .request-title-area {

            flex: 1;

            min-width: 0;

        }


        .request-title-with-icon {

            display: flex;

            align-items: center;

            gap: .5rem;

            min-width: 0;

        }


        .request-title-with-icon>i {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 32px;

            height: 32px;

            flex-shrink: 0;

            color:
                var(--thesis-request-primary);

            background:
                var(--thesis-request-primary-soft);

            border-radius: 8px;

            font-size: .9rem;

        }


        .request-title {

            display: -webkit-box;

            flex: 1;

            min-width: 0;

            margin: 0;

            overflow: hidden;

            color:
                var(--thesis-request-text);

            font-size: 1.05rem;

            font-weight: 800;

            line-height: 1.4;

            letter-spacing: -.015em;

            -webkit-line-clamp: 3;

            -webkit-box-orient: vertical;

        }


        .request-status {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            gap: .3rem;

            padding: .42rem .68rem;

            border-radius: 999px;

            font-size: .68rem;

            font-weight: 700;

            white-space: nowrap;

        }


        .request-status.pending {

            color: #8a6500;

            background: #fff4d2;

        }


        .request-status.approved {

            color: #176b3a;

            background: #e5f7ed;

        }


        .request-status.rejected {

            color: #d92d3a;

            background: #ffe7e9;

        }


        .request-status.unknown {

            color:
                var(--thesis-request-text-secondary);

            background:
                var(--thesis-request-input-bg);

        }


        .request-information {

            display: flex;

            flex-direction: column;

            padding: .7rem .75rem;

            background:
                var(--thesis-request-input-bg);

            border-radius: 9px;

        }


        .request-info {

            display: flex;

            align-items: center;

            gap: .6rem;

            min-width: 0;

            padding: .45rem 0;

        }


        .request-info-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 30px;

            height: 30px;

            flex-shrink: 0;

            color:
                var(--thesis-request-primary);

            background:
                var(--thesis-request-card-bg);

            border:
                1px solid var(--thesis-request-border-soft);

            border-radius: 7px;

            font-size: .75rem;

        }


        .request-info-content {

            display: flex;

            flex-direction: column;

            min-width: 0;

        }


        .request-info-content span {

            margin-bottom: .08rem;

            color:
                var(--thesis-request-text-muted);

            font-size: .60rem;

            font-weight: 800;

            letter-spacing: .04em;

            text-transform: uppercase;

        }


        .request-info-content strong {

            overflow: hidden;

            color:
                var(--thesis-request-text-secondary);

            font-size: .78rem;

            font-weight: 600;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        .request-actions {

            display: flex;

            align-items: center;

            gap: .5rem;

            padding: .75rem;

            background:
                var(--thesis-request-input-bg);

            border-top:
                1px solid var(--thesis-request-border-soft);

        }


        .request-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            flex: 1;

            min-width: 0;

            min-height: 40px;

            padding: .45rem .7rem;

            border: 1px solid;

            border-radius: 7px;

            background: transparent;

            text-decoration: none;

            font-size: .72rem;

            font-weight: 800;

            white-space: nowrap;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;

        }


        .request-action:hover {

            transform: translateY(-1px);

        }


        /* ================================
           VIEW DETAILS - DARK PURPLE
        ================================= */

        .request-action-details {

            color:
                var(--thesis-request-details);

            background: transparent;

            border-color:
                var(--thesis-request-details);

        }


        .request-action-details:hover {

            color: #ffffff;

            background:
                var(--thesis-request-details);

            border-color:
                var(--thesis-request-details);

            box-shadow:
                0 5px 12px rgba(84, 38, 168, .25);

        }


        /* ================================
           VIEW PDF - RED
        ================================= */

        .request-action-pdf {

            color:
                var(--thesis-request-pdf);

            background: transparent;

            border-color:
                var(--thesis-request-pdf);

        }


        .request-action-pdf:hover {

            color: #ffffff;

            background:
                var(--thesis-request-pdf);

            border-color:
                var(--thesis-request-pdf);

            box-shadow:
                0 5px 12px rgba(220, 38, 38, .20);

        }


        .request-action-disabled {

            opacity: .45;

            cursor: not-allowed;

            pointer-events: none;

        }


        .request-empty {

            grid-column: 1 / -1;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            min-height: 280px;

            padding: 2rem;

            text-align: center;

            color:
                var(--thesis-request-text);

            background:
                var(--thesis-request-card-bg);

            border:
                1px solid var(--thesis-request-border-soft);

            border-radius: 14px;

            box-shadow:
                var(--thesis-request-card-shadow);

        }


        .request-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 52px;

            height: 52px;

            margin-bottom: .8rem;

            color: #ffffff;

            background:
                var(--thesis-request-primary);

            border-radius: 11px;

            font-size: 1.2rem;

        }


        .request-empty h3 {

            margin: 0 0 .3rem;

            color:
                var(--thesis-request-text);

            font-size: 1rem;

            font-weight: 800;

        }


        .request-empty p {

            margin: 0;

            color:
                var(--thesis-request-text-muted);

            font-size: .78rem;

        }


        .request-table-container {

            width: 100%;

            overflow: hidden;

            background:
                var(--thesis-request-card-bg);

            border:
                1px solid var(--thesis-request-border-soft);

            border-radius: 14px;

            box-shadow:
                var(--thesis-request-card-shadow);

        }


        .request-table-scroll {

            width: 100%;

            overflow-x: auto;

        }


        .request-table {

            width: 100%;

            min-width: 1200px;

            border-collapse: collapse;

            background:
                var(--thesis-request-card-bg);

            color:
                var(--thesis-request-text);

        }


        .request-table thead {

            background: #e9e2ff;

        }


        .request-table th {

            padding: 16px;

            color: #4c3a8a;

            background: #e9e2ff;

            border-bottom:
                1px solid #d8ccff !important;

            text-align: left;

            font-size: .72rem;

            font-weight: 800;

            letter-spacing: .06em;

            text-transform: uppercase;

            white-space: nowrap;

        }


        [data-bs-theme="dark"] .request-table thead {

            background: #292342;

        }


        [data-bs-theme="dark"] .request-table th {

            color: #d8ccff;

            background: #292342;

            border-bottom-color:
                #403765 !important;

        }


        .request-table tbody tr {

            border-bottom:
                1px solid var(--thesis-request-border-soft);

            transition:
                background-color .2s ease;

        }


        .request-table tbody tr:last-child {

            border-bottom: none;

        }


        .request-table tbody tr:hover {

            background:
                var(--thesis-request-primary-soft);

        }


        .request-table td {

            padding: 16px;

            color:
                var(--thesis-request-text-secondary);

            font-size: .80rem;

            vertical-align: middle;

        }


        .request-table-title {

            display: flex;

            align-items: center;

            min-width: 280px;

        }


        .request-table-title span {

            display: block;

            max-width: 320px;

            overflow: hidden;

            color:
                var(--thesis-request-text);

            font-size: .80rem;

            font-weight: 700;

            line-height: 1.4;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        .request-table-number {

            color:
                var(--thesis-request-primary) !important;

            font-size: .80rem !important;

            font-weight: 800;

        }


        .request-table-text {

            color:
                var(--thesis-request-text-secondary);

            font-size: .80rem;

            font-weight: 600;

        }


        .request-table-department {

            display: inline-block;

            padding: .38rem .6rem;

            color:
                var(--thesis-request-primary);

            background:
                var(--thesis-request-primary-soft);

            border-radius: 6px;

            font-size: .70rem;

            font-weight: 700;

            white-space: nowrap;

        }


        .request-table-status {

            display: inline-flex;

            align-items: center;

            gap: .3rem;

            padding: .38rem .62rem;

            border-radius: 999px;

            font-size: .68rem;

            font-weight: 800;

            white-space: nowrap;

        }


        .request-table-status.pending {

            color: #8a6500;

            background: #fff4d2;

        }


        .request-table-status.approved {

            color: #176b3a;

            background: #e5f7ed;

        }


        .request-table-status.rejected {

            color: #d92d3a;

            background: #ffe7e9;

        }


        .request-table-status.unknown {

            color:
                var(--thesis-request-text-secondary);

            background:
                var(--thesis-request-input-bg);

        }


        .request-table-actions {

            display: flex;

            align-items: center;

            gap: 6px;

        }


        .request-table-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            width: 36px;

            height: 36px;

            border: 1px solid;

            border-radius: 7px;

            background: transparent;

            text-decoration: none;

            font-size: .85rem;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;

        }


        .request-table-action:hover {

            color: #ffffff;

            transform: translateY(-1px);

        }


        /* ================================
           TABLE VIEW DETAILS - DARK PURPLE
        ================================= */

        .request-table-details {

            color:
                var(--thesis-request-details);

            background: transparent;

            border-color:
                var(--thesis-request-details);

        }


        .request-table-details:hover {

            color: #ffffff;

            background:
                var(--thesis-request-details);

            border-color:
                var(--thesis-request-details);

            box-shadow:
                0 5px 12px rgba(84, 38, 168, .25);

        }


        /* ================================
           TABLE VIEW PDF - RED
        ================================= */

        .request-table-pdf {

            color:
                var(--thesis-request-pdf);

            background: transparent;

            border-color:
                var(--thesis-request-pdf);

        }


        .request-table-pdf:hover {

            color: #ffffff;

            background:
                var(--thesis-request-pdf);

            border-color:
                var(--thesis-request-pdf);

            box-shadow:
                0 5px 12px rgba(220, 38, 38, .20);

        }


        .request-table-action.disabled {

            opacity: .45;

            cursor: not-allowed;

            pointer-events: none;

        }


        .request-table-empty {

            padding: 0 !important;

            text-align: center;

        }


        .request-table-empty .request-empty {

            min-height: 280px;

            margin: 0;

            border: none;

            box-shadow: none;

            border-radius: 0;

        }


        .thesis-requests-page table,
        .thesis-requests-page table th,
        .thesis-requests-page table td,
        .thesis-requests-page thead,
        .thesis-requests-page tbody {

            border-left: none !important;

            border-right: none !important;

            border-top: none !important;

        }


        .thesis-requests-page .request-table tbody tr {

            border-bottom:
                1px solid var(--thesis-request-border-soft) !important;

        }


        .thesis-requests-page .request-table tbody tr:last-child {

            border-bottom: none !important;

        }


        @media (min-width: 768px) and (max-width: 1199.98px) {

            .request-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

            }

        }


        @media (min-width: 1200px) and (max-width: 1399.98px) {

            .request-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

            }

        }


        @media (min-width: 1400px) {

            .request-grid {

                grid-template-columns:
                    repeat(4, minmax(0, 1fr));

            }

        }


        @media (max-width: 767.98px) {

            .dashboard-content.thesis-requests-page {

                padding: 12px;

            }


            .request-page-header {

                margin-top: 80px;

                margin-bottom: 10px;

                padding: .9rem 1rem;

            }


            .request-header-top {

                flex-direction: column;

                gap: 16px;

            }


            .request-header-action {

                width: 100%;

                padding-top: 0;

            }


            .request-add-button {

                width: 100%;

            }


            .request-page-title {

                font-size: 1.5rem;

            }


            .request-page-description {

                font-size: .74rem;

            }


            .request-view-row {

                justify-content: flex-end;

                margin-top: 12px;

                margin-bottom: 14px;

            }


            .request-view-toggle {

                width: auto;

            }


            .request-view-button {

                min-width: 78px;

                height: 35px;

            }


            .request-grid {

                grid-template-columns: 1fr;

                gap: 1rem;

            }


            .request-alert,
            .request-success {

                margin-left: 0;

                margin-right: 0;

            }

        }


        @media (max-width: 480px) {

            .request-card {

                border-radius: 12px;

            }


            .request-card-content {

                padding: .85rem;

            }


            .request-title-row {

                gap: .5rem;

            }


            .request-title {

                font-size: .98rem;

            }


            .request-status {

                padding: .35rem .5rem;

                font-size: .62rem;

            }


            .request-actions {

                flex-direction: column;

            }


            .request-action {

                width: 100%;

                min-height: 40px;

                font-size: .70rem;

            }


            .request-view-button {

                min-width: 76px;

                padding: 0 10px;

            }

        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const requestResultsContainer =
                document.getElementById('requestResultsContainer');

            const requestCardViewButton =
                document.getElementById('requestCardViewBtn');

            const requestTableViewButton =
                document.getElementById('requestTableViewBtn');


            function setRequestView(view) {

                if (!requestResultsContainer) {
                    return;
                }


                if (view === 'table') {

                    requestResultsContainer.classList.add('table-mode');


                    if (requestTableViewButton) {

                        requestTableViewButton.classList.add('active');

                    }


                    if (requestCardViewButton) {

                        requestCardViewButton.classList.remove('active');

                    }


                    localStorage.setItem(
                        'thesisRequestsView',
                        'table'
                    );

                } else {

                    requestResultsContainer.classList.remove('table-mode');


                    if (requestCardViewButton) {

                        requestCardViewButton.classList.add('active');

                    }


                    if (requestTableViewButton) {

                        requestTableViewButton.classList.remove('active');

                    }


                    localStorage.setItem(
                        'thesisRequestsView',
                        'cards'
                    );

                }

            }


            if (requestCardViewButton) {

                requestCardViewButton.addEventListener(
                    'click',
                    function() {
                        setRequestView('cards');
                    }
                );

            }


            if (requestTableViewButton) {

                requestTableViewButton.addEventListener(
                    'click',
                    function() {
                        setRequestView('table');
                    }
                );

            }


            const savedRequestView =
                localStorage.getItem('thesisRequestsView');


            setRequestView(
                savedRequestView === 'table' ?
                'table' :
                'cards'
            );

        });
    </script>


</x-app-layout>
