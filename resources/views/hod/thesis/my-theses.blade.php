
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

                        <a href="{{ route('hod.thesis.edit', $thesis) }}" class="admin-thesis-action admin-thesis-edit">

                            <i class="bi bi-pencil-square"></i>

                            <span>
                                Edit
                            </span>

                        </a>


                        {{-- DELETE --}}

                        <form action="{{ route('hod.thesis.destroy', $thesis) }}" method="POST"
                            class="admin-thesis-delete-form"
                            onsubmit="return confirm('Are you sure you want to delete this thesis?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="admin-thesis-action admin-thesis-delete">

                                <i class="bi bi-trash3"></i>

                                <span>
                                    Delete
                                </span>

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
    ========================================================== */

    :root {
        --thesis-black: #000000;
        --thesis-white: #ffffff;
        --thesis-text: #111111;
        --thesis-muted: #777777;
        --thesis-border: #e7e7e7;
        --thesis-soft: #f7f7f7;
    }


    /* =========================================================
       PAGE
    ========================================================== */

    .thesis-page {
        color: var(--thesis-text);
    }


    /* =========================================================
       PAGE HEADER
    ========================================================== */

    .thesis-page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;

        padding: 15px;

        background: #ffffff;
        box-sizing: border-box;
    }


    .thesis-overline {
        display: block;

        margin-bottom: .2rem;

        color: #777777;

        font-size: .7rem;
        font-weight: 800;

        letter-spacing: .13em;
        text-transform: uppercase;
    }


    .thesis-title {
        margin: 0;

        color: #111111;

        font-size: 1.8rem;
        font-weight: 800;

        line-height: 1.2;
        letter-spacing: -.035em;
    }


    /* =========================================================
       ADD BUTTON
    ========================================================== */

    .thesis-add-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: .5rem;

        min-height: 44px;

        padding: .65rem 1rem;

        color: #ffffff;

        background: #000000;

        border: 1px solid #000000;
        border-radius: 8px;

        text-decoration: none;

        font-size: .68rem;
        font-weight: 800;

        letter-spacing: .03em;
        text-transform: uppercase;

        transition: .2s ease;
    }


    .thesis-add-button:hover {
        color: #ffffff;

        background: #252525;
        border-color: #252525;

        transform: translateY(-2px);
    }


    /* =========================================================
       CARD GRID
    ========================================================== */

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
    ========================================================== */

    .admin-thesis-card {
        display: flex;
        flex-direction: column;

        min-width: 0;

        overflow: hidden;

        background: #ffffff;

        border: 1px solid #e7e7e7;

        border-radius: 16px;

        box-shadow:
            0 2px 8px rgba(0, 0, 0, .04);

        transition:
            transform .25s ease,
            box-shadow .25s ease;
    }


    .admin-thesis-card:hover {
        transform: translateY(-5px);

        box-shadow:
            0 12px 30px rgba(0, 0, 0, .10);
    }


    /* =========================================================
       CARD TOP
    ========================================================== */

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
    ========================================================== */

    .admin-thesis-icon {
        display: flex;

        align-items: center;
        justify-content: center;

        width: 34px;
        height: 34px;

        flex-shrink: 0;

        color: #ffffff;

        background: #000000;

        border-radius: 9px;

        font-size: .8rem;
    }


    /* =========================================================
       TITLE
    ========================================================== */

    .admin-thesis-card-title {
        display: -webkit-box;

        margin: 0;

        overflow: hidden;

        color: #111111;

        font-size: 1rem;

        font-weight: 800;

        line-height: 1.4;

        letter-spacing: -.02em;

        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }


    /* =========================================================
       STATUS
    ========================================================== */

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


    .admin-thesis-status-badge.approved {
        color: #146c43;

        background: #d1e7dd;
    }


    .admin-thesis-status-badge.pending {
        color: #555555;

        background: #eeeeee;
    }


    /* =========================================================
       AUTHOR + DEPARTMENT
    ========================================================== */

    .admin-thesis-published {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: .65rem;

        margin:
            0 1rem 1rem;

        padding: .75rem;

        background: #f7f7f7;

        border-radius: 10px;
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

        color: #555555;

        background: #ffffff;

        border-radius: 7px;

        font-size: .68rem;
    }


    .admin-thesis-published-content {
        display: flex;

        flex-direction: column;

        min-width: 0;
    }


    .admin-thesis-published-label {
        margin-bottom: .12rem;

        color: #999999;

        font-size: .5rem;

        font-weight: 800;

        letter-spacing: .05em;

        text-transform: uppercase;
    }


    .admin-thesis-published-value {
        overflow: hidden;

        color: #333333;

        font-size: .62rem;

        font-weight: 700;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* =========================================================
       CARD BODY
    ========================================================== */

    .admin-thesis-card-body {
        display: flex;

        flex-direction: column;

        flex: 1;

        padding:
            .15rem 1rem 1rem;
    }


    /* =========================================================
       DETAILS
    ========================================================== */

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

        color: #555555;

        background: #f5f5f5;

        border-radius: 8px;

        font-size: .72rem;
    }


    .admin-thesis-detail-content {
        display: flex;

        flex-direction: column;

        min-width: 0;
    }


    .admin-thesis-detail-label {
        margin-bottom: .1rem;

        color: #999999;

        font-size: .55rem;

        font-weight: 800;

        letter-spacing: .06em;

        text-transform: uppercase;
    }


    .admin-thesis-detail-value {
        overflow: hidden;

        color: #222222;

        font-size: .7rem;

        font-weight: 600;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* =========================================================
       THESIS NUMBER
    ========================================================== */

    .admin-thesis-submitted {
        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 1rem;

        margin-top: .3rem;

        padding-top: .8rem;

        border-top: 1px solid #eeeeee;
    }


    .admin-thesis-submitted-label {
        color: #999999;

        font-size: .53rem;

        font-weight: 800;

        letter-spacing: .05em;

        text-transform: uppercase;
    }


    .admin-thesis-submitted-value {
        overflow: hidden;

        color: #333333;

        font-size: .62rem;

        font-weight: 700;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .admin-thesis-card-footer {
        display: flex;

        align-items: center;

        gap: .5rem;

        padding: .75rem;

        background: #fafafa;

        border-top: 1px solid #eeeeee;
    }


    /* =========================================================
       ACTIONS
    ========================================================== */

    .admin-thesis-action {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: .4rem;

        flex: 1;

        min-height: 36px;

        padding: .4rem .7rem;

        border-radius: 8px;

        text-decoration: none;

        font-size: .62rem;

        font-weight: 800;

        cursor: pointer;

        transition: .2s ease;
    }


    /* =========================================================
       EDIT
    ========================================================== */

    .admin-thesis-edit {
        color: #ffffff;

        background: #000000;

        border: 1px solid #000000;
    }


    .admin-thesis-edit:hover {
        color: #ffffff;

        background: #292929;

        border-color: #292929;
    }


    /* =========================================================
       DELETE
    ========================================================== */

    .admin-thesis-delete-form {
        display: flex;

        flex: 1;

        margin: 0;
        padding: 0;
    }


    .admin-thesis-delete {
        width: 100%;

        color: #111111;

        background: #ffffff;

        border: 1px solid #dddddd;
    }


    .admin-thesis-delete:hover {
        color: #ffffff;

        background: #dc2626;

        border-color: #dc2626;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .admin-thesis-empty {
        grid-column: 1 / -1;

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: center;

        min-height: 260px;

        padding: 2rem;

        text-align: center;

        background: #ffffff;

        border: 1px solid #e5e5e5;

        border-radius: 16px;
    }


    .admin-thesis-empty-icon {
        display: flex;

        align-items: center;
        justify-content: center;

        width: 55px;
        height: 55px;

        margin-bottom: 1rem;

        color: #ffffff;

        background: #000000;

        border-radius: 13px;
    }


    .admin-thesis-empty h3 {
        margin: 0 0 .35rem;

        color: #111111;

        font-size: 1rem;

        font-weight: 800;
    }


    .admin-thesis-empty p {
        margin: 0;

        color: #888888;

        font-size: .7rem;
    }


    /* =========================================================
       TABLET
    ========================================================== */

    @media (max-width: 1199.98px) {

        .thesis-card-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

    }


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 767.98px) {

        .thesis-page-header {
            padding: 1rem;
        }


        .thesis-title {
            font-size: 1.35rem;
        }


        .thesis-add-button {
            width: 44px;

            height: 44px;

            min-width: 44px;

            padding: 0;
        }


        .thesis-add-button span {
            display: none;
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
    ========================================================== */

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
</style>

</x-app-layout>

