<x-app-layout>

    <div class="dashboard-content thesis-page">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="thesis-page-header">

            <div>

                <span class="thesis-overline">
                    MANAGEMENT
                </span>

                <h1 class="thesis-title">
                    My Thesis
                </h1>

            </div>

        </div>


        {{-- =========================================================
            THESIS CARDS
        ========================================================== --}}

        <div class="thesis-card-grid">

            @forelse ($theses as $thesis)

                <div class="admin-thesis-card">

                    {{-- =================================================
                        CARD HEADER
                    ================================================== --}}

                    <div class="admin-thesis-card-top">

                        <div class="admin-thesis-card-heading">

                            <div class="admin-thesis-icon">
                                <i class="bi bi-journal-text"></i>
                            </div>

                            <h3 class="admin-thesis-card-title">
                                {{ $thesis->title }}
                            </h3>

                        </div>


                        {{-- STATUS --}}

                        <div class="admin-thesis-status">

                            @if ($thesis->published_at)

                                <span class="admin-thesis-status-badge approved">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Published
                                </span>

                            @else

                                <span class="admin-thesis-status-badge pending">
                                    <i class="bi bi-clock-fill"></i>
                                    Unpublished
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                        AUTHOR + DEPARTMENT
                    ================================================== --}}

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
                                    {{ $thesis->author_name }}
                                </span>

                            </div>

                        </div>


                        <div class="admin-thesis-published-item">

                            <div class="admin-thesis-published-icon">
                                <i class="bi bi-building"></i>
                            </div>

                            <div class="admin-thesis-published-content">

                                <span class="admin-thesis-published-label">
                                    Department
                                </span>

                                <span class="admin-thesis-published-value">
                                    {{ $thesis->department?->name ?? 'N/A' }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        CARD DETAILS
                    ================================================== --}}

                    <div class="admin-thesis-card-body">

                        {{-- SUBMITTED BY --}}

                        <div class="admin-thesis-detail">

                            <div class="admin-thesis-detail-icon">
                                <i class="bi bi-person-check"></i>
                            </div>

                            <div class="admin-thesis-detail-content">

                                <span class="admin-thesis-detail-label">
                                    Submitted By
                                </span>

                                <span class="admin-thesis-detail-value">
                                    {{ $thesis->submittedBy?->name ?? 'N/A' }}
                                </span>

                            </div>

                        </div>


                        {{-- PUBLISHED BY --}}

                        <div class="admin-thesis-detail">

                            <div class="admin-thesis-detail-icon">
                                <i class="bi bi-person-badge"></i>
                            </div>

                            <div class="admin-thesis-detail-content">

                                <span class="admin-thesis-detail-label">
                                    Published By
                                </span>

                                <span class="admin-thesis-detail-value">
                                    {{ $thesis->publishedBy?->name ?? 'N/A' }}
                                </span>

                            </div>

                        </div>


                        {{-- PUBLISHED AT --}}

                        <div class="admin-thesis-detail">

                            <div class="admin-thesis-detail-icon">
                                <i class="bi bi-calendar3"></i>
                            </div>

                            <div class="admin-thesis-detail-content">

                                <span class="admin-thesis-detail-label">
                                    Published At
                                </span>

                                <span class="admin-thesis-detail-value">
                                    {{ $thesis->published_at?->format('M d, Y h:i A') ?? 'Not Published' }}
                                </span>

                            </div>

                        </div>


                        {{-- THESIS NUMBER --}}

                        <div class="admin-thesis-submitted">

                            <span class="admin-thesis-submitted-label">
                                Thesis No.
                            </span>

                            <span class="admin-thesis-submitted-value">
                                #{{ $loop->iteration }}
                            </span>

                        </div>

                    </div>


                    {{-- =================================================
                        ACTIONS
                    ================================================== --}}

                    <div class="admin-thesis-card-footer">

                        {{-- EDIT --}}

                        <a
                            href="{{ route('hod.thesis.edit', $thesis) }}"
                            class="admin-thesis-action admin-thesis-edit"
                        >
                            <i class="bi bi-pencil-square"></i>
                            <span>Edit</span>
                        </a>


                        {{-- DELETE --}}

                        <form
                            action="{{ route('hod.thesis.destroy', $thesis) }}"
                            method="POST"
                            class="admin-thesis-delete-form"
                            onsubmit="return confirm('Are you sure you want to delete this thesis?');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="admin-thesis-action admin-thesis-delete"
                            >
                                <i class="bi bi-trash3"></i>
                                <span>Delete</span>
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                {{-- =================================================
                    EMPTY STATE
                ================================================== --}}

                <div class="admin-thesis-empty">

                    <div class="admin-thesis-empty-icon">
                        <i class="bi bi-journal-x"></i>
                    </div>

                    <h3>
                        No Thesis Found
                    </h3>

                    <p>
                        There are no thesis records available.
                    </p>

                </div>

            @endforelse

        </div>

    </div>


    <style>

        /* =========================================================
           VARIABLES
        ========================================================= */

        .thesis-page {

            --thesis-black: #000000;
            --thesis-white: #ffffff;

            --thesis-page-bg: #ffffff;
            --thesis-card-bg: #ffffff;
            --thesis-input-bg: #fafafa;
            --thesis-soft: #f7f7f7;

            --thesis-text: #111111;
            --thesis-text-secondary: #333333;
            --thesis-muted: #777777;

            --thesis-border: #e7e7e7;
            --thesis-border-soft: #eeeeee;

            --thesis-shadow:
                0 2px 8px rgba(0, 0, 0, .04);

            --thesis-card-shadow:
                0 12px 30px rgba(0, 0, 0, .10);
        }


        /* =========================================================
           DARK MODE VARIABLES
        ========================================================= */

        [data-bs-theme="dark"] .thesis-page,
        .dark .thesis-page {

            --thesis-black: #000000;
            --thesis-white: #ffffff;

            --thesis-page-bg: #101426;
            --thesis-card-bg: #181d33;
            --thesis-input-bg: #20253a;
            --thesis-soft: #20253a;

            --thesis-text: #eeeef8;
            --thesis-text-secondary: #d5d8e8;
            --thesis-muted: #999fb9;

            --thesis-border: #292e45;
            --thesis-border-soft: #292e45;

            --thesis-shadow:
                0 3px 12px rgba(0, 0, 0, .35);

            --thesis-card-shadow:
                0 8px 24px rgba(0, 0, 0, .50);

            color-scheme: dark;
        }


        /* =========================================================
           PAGE
        ========================================================= */

        .thesis-page {

            color: var(--thesis-text);

            transition:
                background .2s ease,
                color .2s ease;
        }


        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .thesis-page-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 1rem;

            padding: 15px;

            color: var(--thesis-text);

            background: var(--thesis-page-bg);

            box-sizing: border-box;

            transition:
                background .2s ease,
                color .2s ease;
        }


        /* =========================================================
           OVERLINE
        ========================================================= */

        .thesis-overline {

            display: block;

            margin-bottom: .2rem;

            color: var(--thesis-muted);

            font-size: .7rem;

            font-weight: 800;

            letter-spacing: .13em;

            text-transform: uppercase;
        }


        /* =========================================================
           TITLE
        ========================================================= */

        .thesis-title {

            margin: 0;

            color: var(--thesis-text);

            font-size: 1.8rem;

            font-weight: 800;

            line-height: 1.2;

            letter-spacing: -.035em;
        }


        /* =========================================================
           CARD GRID
        ========================================================= */

        .thesis-card-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 1.25rem;

            width: 100%;

            margin-top: 1rem;

            box-sizing: border-box;

            transition: opacity .2s ease;
        }


        /* =========================================================
           CARD
        ========================================================= */

        .admin-thesis-card {

            display: flex;

            flex-direction: column;

            min-width: 0;

            overflow: hidden;

            color: var(--thesis-text);

            background: var(--thesis-card-bg);

            border: 1px solid var(--thesis-border);

            border-radius: 16px;

            box-shadow: var(--thesis-shadow);

            transition:
                transform .25s ease,
                box-shadow .25s ease,
                background .2s ease,
                border-color .2s ease;
        }


        .admin-thesis-card:hover {

            transform: translateY(-5px);

            box-shadow: var(--thesis-card-shadow);
        }


        /* =========================================================
           CARD TOP
        ========================================================= */

        .admin-thesis-card-top {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

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


        /* =========================================================
           THESIS ICON
        ========================================================= */

        .admin-thesis-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 34px;

            height: 34px;

            flex-shrink: 0;

            color: var(--thesis-white);

            background: var(--thesis-black);

            border-radius: 9px;

            font-size: .8rem;

            transition:
                background .2s ease,
                color .2s ease;
        }


        /* =========================================================
           CARD TITLE
        ========================================================= */

        .admin-thesis-card-title {

            display: -webkit-box;

            margin: 0;

            overflow: hidden;

            color: var(--thesis-text);

            font-size: 1rem;

            font-weight: 800;

            line-height: 1.4;

            letter-spacing: -.02em;

            -webkit-line-clamp: 3;

            -webkit-box-orient: vertical;
        }


        /* =========================================================
           STATUS
        ========================================================= */

        .admin-thesis-status {

            flex-shrink: 0;
        }


        .admin-thesis-status-badge {

            display: inline-flex;

            align-items: center;

            gap: .35rem;

            padding: .4rem .6rem;

            border-radius: 20px;

            font-size: .57rem;

            font-weight: 800;

            text-transform: uppercase;

            white-space: nowrap;
        }


        /* PUBLISHED */

        .admin-thesis-status-badge.approved {

            color: #146c43;

            background: #d1e7dd;
        }


        /* UNPUBLISHED */

        .admin-thesis-status-badge.pending {

            color: #555555;

            background: #eeeeee;
        }


        /* =========================================================
           DARK STATUS
        ========================================================= */

        [data-bs-theme="dark"] .admin-thesis-status-badge.approved,
        .dark .admin-thesis-status-badge.approved {

            color: #4ade80;

            background: #07140b;

            border: 1px solid #166534;
        }


        [data-bs-theme="dark"] .admin-thesis-status-badge.pending,
        .dark .admin-thesis-status-badge.pending {

            color: #d5d8e8;

            background: #20253a;

            border: 1px solid #292e45;
        }


        /* =========================================================
           AUTHOR + DEPARTMENT
        ========================================================= */

        .admin-thesis-published {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: .65rem;

            margin:
                0 1rem 1rem;

            padding: .75rem;

            background: var(--thesis-soft);

            border-radius: 10px;

            transition:
                background .2s ease;
        }


        .admin-thesis-published-item {

            display: flex;

            align-items: center;

            gap: .5rem;

            min-width: 0;
        }


        .admin-thesis-published-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 29px;

            height: 29px;

            flex-shrink: 0;

            color: var(--thesis-text-secondary);

            background: var(--thesis-card-bg);

            border-radius: 7px;

            font-size: .68rem;

            transition:
                background .2s ease,
                color .2s ease;
        }


        .admin-thesis-published-content {

            display: flex;

            flex-direction: column;

            min-width: 0;
        }


        .admin-thesis-published-label {

            margin-bottom: .12rem;

            color: var(--thesis-muted);

            font-size: .5rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;
        }


        .admin-thesis-published-value {

            overflow: hidden;

            color: var(--thesis-text-secondary);

            font-size: .62rem;

            font-weight: 700;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================================================
           CARD BODY
        ========================================================= */

        .admin-thesis-card-body {

            display: flex;

            flex-direction: column;

            flex: 1;

            padding:
                .15rem 1rem 1rem;
        }


        /* =========================================================
           DETAILS
        ========================================================= */

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

            color: var(--thesis-text-secondary);

            background: var(--thesis-soft);

            border-radius: 8px;

            font-size: .72rem;

            transition:
                background .2s ease,
                color .2s ease;
        }


        .admin-thesis-detail-content {

            display: flex;

            flex-direction: column;

            min-width: 0;
        }


        .admin-thesis-detail-label {

            margin-bottom: .1rem;

            color: var(--thesis-muted);

            font-size: .55rem;

            font-weight: 800;

            letter-spacing: .06em;

            text-transform: uppercase;
        }


        .admin-thesis-detail-value {

            overflow: hidden;

            color: var(--thesis-text);

            font-size: .7rem;

            font-weight: 600;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================================================
           THESIS NUMBER
        ========================================================= */

        .admin-thesis-submitted {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 1rem;

            margin-top: .3rem;

            padding-top: .8rem;

            border-top:
                1px solid var(--thesis-border-soft);
        }


        .admin-thesis-submitted-label {

            color: var(--thesis-muted);

            font-size: .53rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;
        }


        .admin-thesis-submitted-value {

            overflow: hidden;

            color: var(--thesis-text-secondary);

            font-size: .62rem;

            font-weight: 700;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .admin-thesis-card-footer {

            display: flex;

            align-items: center;

            gap: .5rem;

            padding: .75rem;

            background: var(--thesis-soft);

            border-top:
                1px solid var(--thesis-border-soft);

            transition:
                background .2s ease,
                border-color .2s ease;
        }


        /* =========================================================
           ACTIONS
        ========================================================= */

        .admin-thesis-action {

            display: inline-flex !important;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            flex: 1;

            min-height: 36px;

            padding: .4rem .7rem;

            border-radius: 8px;

            font-size: .62rem;

            font-weight: 800;

            text-decoration: none !important;

            cursor: pointer;

            box-shadow: none !important;

            transition:
                background .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }


        .admin-thesis-action i {

            color: inherit !important;
        }


        /* =========================================================
           EDIT BUTTON
        ========================================================= */

        .admin-thesis-edit,
        .admin-thesis-edit:visited {

            color: #ffffff !important;

            background: #2563eb !important;

            border:
                1px solid #2563eb !important;
        }


        .admin-thesis-edit:hover,
        .admin-thesis-edit:focus,
        .admin-thesis-edit:active {

            color: #ffffff !important;

            background: #1d4ed8 !important;

            border-color: #1d4ed8 !important;

            transform: translateY(-1px);

            text-decoration: none !important;
        }


        /* =========================================================
           DELETE BUTTON
        ========================================================= */

        .admin-thesis-delete,
        .admin-thesis-delete:visited {

            width: 100%;

            color: #ffffff !important;

            background: #dc2626 !important;

            border:
                1px solid #dc2626 !important;
        }


        .admin-thesis-delete:hover,
        .admin-thesis-delete:focus,
        .admin-thesis-delete:active {

            color: #ffffff !important;

            background: #b91c1c !important;

            border-color: #b91c1c !important;

            transform: translateY(-1px);
        }


        /* =========================================================
           DELETE FORM
        ========================================================= */

        .admin-thesis-delete-form {

            display: flex;

            flex: 1;

            width: 100%;

            margin: 0;

            padding: 0;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

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

            border:
                1px solid var(--thesis-border);

            border-radius: 16px;

            transition:
                background .2s ease,
                border-color .2s ease,
                color .2s ease;
        }


        .admin-thesis-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 55px;

            height: 55px;

            margin-bottom: 1rem;

            color: var(--thesis-white);

            background: var(--thesis-black);

            border-radius: 13px;
        }


        .admin-thesis-empty h3 {

            margin:
                0 0 .35rem;

            color: var(--thesis-text);

            font-size: 1rem;

            font-weight: 800;
        }


        .admin-thesis-empty p {

            margin: 0;

            color: var(--thesis-muted);

            font-size: .7rem;
        }


        /* =========================================================
           EXPLICIT DARK MODE
           Prevent Bootstrap / global styles from overriding cards
        ========================================================= */

        [data-bs-theme="dark"] .thesis-page,
        .dark .thesis-page {

            /* background: #101426; */

            color: #eeeef8;
        }


        [data-bs-theme="dark"] .thesis-page-header,
        .dark .thesis-page-header {

            background: #181d33;

            color: #eeeef8;
        }


        [data-bs-theme="dark"] .thesis-title,
        .dark .thesis-title {

            color: #eeeef8;
        }


        [data-bs-theme="dark"] .thesis-overline,
        .dark .thesis-overline {

            color: #999fb9;
        }


        /* CARD */

        [data-bs-theme="dark"] .admin-thesis-card,
        .dark .admin-thesis-card {

            color: #eeeef8;

            background: #181d33;

            border-color: #292e45;

            box-shadow:
                0 3px 12px rgba(0, 0, 0, .35);
        }


        [data-bs-theme="dark"] .admin-thesis-card:hover,
        .dark .admin-thesis-card:hover {

            border-color: #3b4260;

            box-shadow:
                0 8px 24px rgba(0, 0, 0, .50);
        }


        /* THESIS ICON */

        [data-bs-theme="dark"] .admin-thesis-icon,
        .dark .admin-thesis-icon {

            color: #000000;

            background: #ffffff;
        }


        /* TITLE */

        [data-bs-theme="dark"] .admin-thesis-card-title,
        .dark .admin-thesis-card-title {

            color: #eeeef8;
        }


        /* PUBLISHED / AUTHOR AREA */

        [data-bs-theme="dark"] .admin-thesis-published,
        .dark .admin-thesis-published {

            background: #20253a;
        }


        [data-bs-theme="dark"] .admin-thesis-published-icon,
        .dark .admin-thesis-published-icon {

            color: #d5d8e8;

            background: #181d33;

            border: 1px solid #292e45;
        }


        [data-bs-theme="dark"] .admin-thesis-published-label,
        .dark .admin-thesis-published-label {

            color: #999fb9;
        }


        [data-bs-theme="dark"] .admin-thesis-published-value,
        .dark .admin-thesis-published-value {

            color: #d5d8e8;
        }


        /* DETAIL ICON */

        [data-bs-theme="dark"] .admin-thesis-detail-icon,
        .dark .admin-thesis-detail-icon {

            color: #d5d8e8;

            background: #20253a;

            border: 1px solid #292e45;
        }


        /* DETAIL LABEL */

        [data-bs-theme="dark"] .admin-thesis-detail-label,
        .dark .admin-thesis-detail-label {

            color: #999fb9;
        }


        /* DETAIL VALUE */

        [data-bs-theme="dark"] .admin-thesis-detail-value,
        .dark .admin-thesis-detail-value {

            color: #eeeef8;
        }


        /* THESIS NUMBER */

        [data-bs-theme="dark"] .admin-thesis-submitted,
        .dark .admin-thesis-submitted {

            border-top-color: #292e45;
        }


        [data-bs-theme="dark"] .admin-thesis-submitted-label,
        .dark .admin-thesis-submitted-label {

            color: #999fb9;
        }


        [data-bs-theme="dark"] .admin-thesis-submitted-value,
        .dark .admin-thesis-submitted-value {

            color: #d5d8e8;
        }


        /* FOOTER */

        [data-bs-theme="dark"] .admin-thesis-card-footer,
        .dark .admin-thesis-card-footer {

            background: #20253a;

            border-top-color: #292e45;
        }


        /* EDIT */

        [data-bs-theme="dark"] .admin-thesis-edit,
        .dark .admin-thesis-edit {

            color: #ffffff !important;

            background: #2563eb !important;

            border-color: #2563eb !important;
        }


        [data-bs-theme="dark"] .admin-thesis-edit:hover,
        .dark .admin-thesis-edit:hover {

            color: #ffffff !important;

            background: #1d4ed8 !important;

            border-color: #1d4ed8 !important;
        }


        /* DELETE */

        [data-bs-theme="dark"] .admin-thesis-delete,
        .dark .admin-thesis-delete {

            color: #ffffff !important;

            background: #dc2626 !important;

            border-color: #dc2626 !important;
        }


        [data-bs-theme="dark"] .admin-thesis-delete:hover,
        .dark .admin-thesis-delete:hover {

            color: #ffffff !important;

            background: #b91c1c !important;

            border-color: #b91c1c !important;
        }


        /* EMPTY */

        [data-bs-theme="dark"] .admin-thesis-empty,
        .dark .admin-thesis-empty {

            color: #eeeef8;

            background: #181d33;

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .admin-thesis-empty-icon,
        .dark .admin-thesis-empty-icon {

            color: #000000;

            background: #ffffff;
        }


        [data-bs-theme="dark"] .admin-thesis-empty h3,
        .dark .admin-thesis-empty h3 {

            color: #eeeef8;
        }


        [data-bs-theme="dark"] .admin-thesis-empty p,
        .dark .admin-thesis-empty p {

            color: #999fb9;
        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 1199.98px) {

            .thesis-card-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 767.98px) {

            .thesis-page-header {

                padding: 1rem;
            }


            .thesis-title {

                font-size: 1.35rem;
            }


            .thesis-card-grid {

                grid-template-columns: 1fr;

                gap: 1rem;

                padding:
                    0 .75rem 1rem;
            }


            .admin-thesis-card-top {

                gap: .6rem;
            }


            .admin-thesis-card-title {

                font-size: .9rem;
            }
        }


        /* =========================================================
           SMALL MOBILE
        ========================================================= */

        @media (max-width: 575.98px) {

            .thesis-page-header {

                padding: .85rem;
            }


            .thesis-title {

                font-size: 1.15rem;
            }


            .admin-thesis-card-body {

                padding:
                    .15rem .9rem .9rem;
            }


            .admin-thesis-card-footer {

                padding: .65rem;
            }


            .admin-thesis-action {

                min-height: 34px;

                font-size: .58rem;
            }


            .admin-thesis-published {

                grid-template-columns: 1fr;
            }


            .admin-thesis-status-badge {

                padding:
                    .35rem .5rem;

                font-size: .5rem;
            }
        }


        /* =========================================================
           REDUCED MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            .thesis-page *,
            .thesis-page *::before,
            .thesis-page *::after {

                transition: none !important;

                animation: none !important;
            }
        }

    </style>

</x-app-layout>