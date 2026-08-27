@forelse($hods as $hod)
    <div class="col-12 col-md-6 col-xl-4">

        <div class="hod-card">

            {{-- =========================================================
                CARD HEADER
            ========================================================== --}}
            <div class="hod-card-top">

                {{-- NUMBER --}}
                <span class="hod-number">
                    <i class="bi bi-hash"></i>
                    {{ $loop->iteration }}
                </span>


                {{-- =====================================================
                    STATUS
                ====================================================== --}}

                @if ($hod->is_active)
                    {{-- ACTIVE = GREEN --}}
                    <span class="hod-status hod-status-active" title="HoD is Active">
                        <span class="hod-status-dot"></span>

                        <span>
                            Active
                        </span>
                    </span>
                @else
                    {{-- INACTIVE = RED --}}
                    <span class="hod-status hod-status-inactive" title="HoD is Inactive">
                        <span class="hod-status-dot"></span>

                        <span>
                            Inactive
                        </span>
                    </span>
                @endif

            </div>


            {{-- =========================================================
                PROFILE
            ========================================================== --}}
            <div class="hod-profile">

                <h5 class="hod-name">
                    {{ $hod->full_name }}
                </h5>


                <div class="hod-email">

                    <i class="bi bi-envelope-fill"></i>

                    <span>
                        {{ $hod->user->email ?? 'N/A' }}
                    </span>

                </div>

            </div>


            {{-- =========================================================
                INFORMATION
            ========================================================== --}}
            <div class="hod-info-box">

                {{-- DEPARTMENT --}}
                <div class="hod-info-item hod-info-department">

                    <span class="hod-info-label">

                        <i class="bi bi-building"></i>

                        Department

                    </span>

                    <span class="hod-info-value">

                        {{ $hod->department->name ?? 'N/A' }}

                    </span>

                </div>


                {{-- STARTED YEAR --}}
                <div class="hod-info-item hod-info-year">

                    <span class="hod-info-label">

                        <i class="bi bi-calendar3"></i>

                        Started Year

                    </span>

                    <span class="hod-info-value hod-year">

                        {{ $hod->started_year ?? 'N/A' }}

                    </span>

                </div>

            </div>


            {{-- =========================================================
                ACTION
            ========================================================== --}}
            <div class="hod-card-action">

                <a href="{{ route('admin.hods.edit', $hod->id) }}" class="hod-edit-button"
                    data-tooltip="Edit HoD Profile" aria-label="Edit HoD Profile">

                    <span class="hod-edit-icon">

                        <i class="bi bi-pencil-square"></i>

                    </span>

                    <span class="hod-edit-text">
                        Edit HoD Profile
                    </span>

                    <span class="hod-arrow">

                        <i class="bi bi-arrow-right"></i>

                    </span>

                </a>

            </div>

        </div>

    </div>


@empty

    {{-- =============================================================
        EMPTY STATE
    ============================================================= --}}
    <div class="col-12">

        <div class="hod-empty-state">

            <div class="hod-empty-icon">

                <i class="bi bi-people"></i>

            </div>

            <h6>
                No HoD Records Found
            </h6>

            <p>
                There are no department leaders matching your filter criteria.
            </p>

        </div>

    </div>
@endforelse


<style>
    /* ================================================================
       HOD CARD
       MONOCHROME DESIGN
       ACTIVE = GREEN
       INACTIVE = RED
       LIGHT + DARK MODE
    ================================================================= */

    .hod-card {

        /* ============================================================
           BASE COLORS
        ============================================================= */

        --hod-card-bg: #ffffff;
        --hod-card-bg-soft: #f7f7f7;

        --hod-border: #d8d8d8;
        --hod-border-strong: #000000;

        --hod-text: #111111;
        --hod-text-secondary: #555555;
        --hod-text-muted: #888888;

        --hod-primary: #111111;


        /* ============================================================
           ACTIVE = GREEN
        ============================================================= */

        --hod-active: #15803d;
        --hod-active-bg: #f0fdf4;
        --hod-active-border: #22c55e;


        /* ============================================================
           INACTIVE = RED
        ============================================================= */

        --hod-inactive: #dc2626;
        --hod-inactive-bg: #fef2f2;
        --hod-inactive-border: #ef4444;


        /* ============================================================
           YEAR
        ============================================================= */

        --hod-year: #111111;
        --hod-year-bg: #f3f3f3;


        /* ============================================================
           BUTTON
        ============================================================= */

        --hod-button-bg: #111111;
        --hod-button-text: #ffffff;

        --hod-button-hover-bg: #ffffff;
        --hod-button-hover-text: #111111;


        /* ============================================================
           SHADOW
        ============================================================= */

        --hod-shadow:
            0 5px 18px rgba(0, 0, 0, .06);

        --hod-hover-shadow:
            0 12px 30px rgba(0, 0, 0, .12);


        /* ============================================================
           CARD
        ============================================================= */

        position: relative;

        height: 100%;

        display: flex;

        flex-direction: column;

        padding: 1.25rem;

        color: var(--hod-text);

        background: var(--hod-card-bg);

        border: 2px solid var(--hod-border);

        border-radius: 10px;

        box-shadow: var(--hod-shadow);

        overflow: hidden;

        transition:
            transform .2s ease,
            border-color .2s ease,
            box-shadow .2s ease,
            background-color .2s ease;
    }


    /* ================================================================
       DARK MODE
    ================================================================= */

    [data-bs-theme="dark"] .hod-card,
    .dark .hod-card {

        --hod-card-bg: #000000;
        --hod-card-bg-soft: #111111;

        --hod-border: #333333;
        --hod-border-strong: #ffffff;

        --hod-text: #ffffff;
        --hod-text-secondary: #cccccc;
        --hod-text-muted: #888888;


        /* ============================================================
           ACTIVE = GREEN
        ============================================================= */

        --hod-active: #4ade80;
        --hod-active-bg: #07140b;
        --hod-active-border: #22c55e;


        /* ============================================================
           INACTIVE = RED
        ============================================================= */

        --hod-inactive: #f87171;
        --hod-inactive-bg: #1a0808;
        --hod-inactive-border: #ef4444;


        --hod-year: #ffffff;
        --hod-year-bg: #111111;


        --hod-button-bg: #ffffff;
        --hod-button-text: #000000;

        --hod-button-hover-bg: #000000;
        --hod-button-hover-text: #ffffff;


        --hod-shadow:
            0 8px 25px rgba(0, 0, 0, .4);

        --hod-hover-shadow:
            0 15px 35px rgba(0, 0, 0, .6);
    }


    /* ================================================================
       CARD HOVER
    ================================================================= */

    .hod-card:hover {

        transform: translateY(-3px);

        border-color: var(--hod-border-strong);

        box-shadow: var(--hod-hover-shadow);
    }


    /* ================================================================
       CARD TOP
    ================================================================= */

    .hod-card-top {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: .75rem;

        margin-bottom: 1.25rem;
    }


    /* ================================================================
       NUMBER
    ================================================================= */

    .hod-number {

        display: inline-flex;

        align-items: center;

        gap: .15rem;

        padding: .35rem .6rem;

        color: var(--hod-text-secondary);

        background: var(--hod-card-bg-soft);

        border: 1px solid var(--hod-border);

        border-radius: 6px;

        font-family: monospace;

        font-size: .68rem;

        font-weight: 700;

        line-height: 1;
    }


    .hod-number i {

        color: var(--hod-text-muted);

        font-size: .65rem;
    }


    /* ================================================================
       STATUS BASE
    ================================================================= */

    .hod-status {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: .4rem;

        min-height: 28px;

        padding: .35rem .7rem;

        border: 1px solid;

        border-radius: 999px;

        font-size: .61rem;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .04em;

        white-space: nowrap;

        transition:
            background-color .2s ease,
            color .2s ease,
            border-color .2s ease,
            box-shadow .2s ease;
    }


    /* ================================================================
       STATUS DOT
    ================================================================= */

    .hod-status-dot {

        width: 7px;

        height: 7px;

        flex-shrink: 0;

        border-radius: 50%;

        background: currentColor;
    }


    /* ================================================================
       ACTIVE = GREEN
    ================================================================= */

    .hod-status-active {

        color: var(--hod-active);

        background: var(--hod-active-bg);

        border-color: var(--hod-active-border);

        box-shadow:
            0 0 0 1px rgba(34, 197, 94, .05);
    }


    .hod-status-active .hod-status-dot {

        background: var(--hod-active);

        box-shadow:
            0 0 0 3px rgba(34, 197, 94, .12);
    }


    /* ================================================================
       INACTIVE = RED
    ================================================================= */

    .hod-status-inactive {

        color: var(--hod-inactive);

        background: var(--hod-inactive-bg);

        border-color: var(--hod-inactive-border);

        box-shadow:
            0 0 0 1px rgba(239, 68, 68, .05);
    }


    .hod-status-inactive .hod-status-dot {

        background: var(--hod-inactive);

        box-shadow:
            0 0 0 3px rgba(239, 68, 68, .12);
    }


    /* ================================================================
       STATUS HOVER
    ================================================================= */

    .hod-status-active:hover {

        color: #ffffff;

        background: var(--hod-active);

        border-color: var(--hod-active);
    }


    .hod-status-active:hover .hod-status-dot {

        background: #ffffff;

    }


    .hod-status-inactive:hover {

        color: #ffffff;

        background: var(--hod-inactive);

        border-color: var(--hod-inactive);
    }


    .hod-status-inactive:hover .hod-status-dot {

        background: #ffffff;

    }


    /* ================================================================
       PROFILE
    ================================================================= */

    .hod-profile {

        min-height: 78px;

        margin-bottom: 1.2rem;
    }


    .hod-name {

        margin: 0 0 .55rem;

        color: var(--hod-text);

        font-size: 1rem;

        font-weight: 800;

        line-height: 1.35;

        word-break: break-word;

        overflow-wrap: anywhere;
    }


    .hod-email {

        display: flex;

        align-items: flex-start;

        gap: .45rem;

        color: var(--hod-text-secondary);

        font-size: .76rem;

        line-height: 1.5;

        word-break: break-word;

        overflow-wrap: anywhere;
    }


    .hod-email i {

        flex-shrink: 0;

        margin-top: .15rem;

        color: var(--hod-text);

        font-size: .75rem;
    }


    /* ================================================================
       INFORMATION BOX
    ================================================================= */

    .hod-info-box {

        display: grid;

        grid-template-columns:
            minmax(0, 1.5fr) minmax(90px, 1fr);

        margin-bottom: 1.25rem;

        background: var(--hod-card-bg-soft);

        border: 1px solid var(--hod-border);

        border-radius: 8px;

        overflow: hidden;
    }


    .hod-info-item {

        min-width: 0;

        padding: .85rem;
    }


    /* ================================================================
       DEPARTMENT
    ================================================================= */

    .hod-info-department {

        background: var(--hod-card-bg-soft);
    }


    /* ================================================================
       YEAR
    ================================================================= */

    .hod-info-year {

        background: var(--hod-year-bg);

        border-left: 1px solid var(--hod-border);
    }


    /* ================================================================
       INFORMATION LABEL
    ================================================================= */

    .hod-info-label {

        display: flex;

        align-items: center;

        gap: .35rem;

        margin-bottom: .35rem;

        color: var(--hod-text-muted);

        font-size: .6rem;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .06em;
    }


    .hod-info-label i {

        color: var(--hod-text);

        font-size: .65rem;
    }


    /* ================================================================
       INFORMATION VALUE
    ================================================================= */

    .hod-info-value {

        display: block;

        color: var(--hod-text);

        font-size: .78rem;

        font-weight: 700;

        line-height: 1.4;

        word-break: break-word;

        overflow-wrap: anywhere;
    }


    .hod-year {

        color: var(--hod-year);

        font-family: monospace;

        font-size: .82rem;
    }


    /* ================================================================
       ACTION
    ================================================================= */

    .hod-card-action {

        position: relative;

        margin-top: auto;

        padding-top: 1rem;

        border-top: 1px solid var(--hod-border);
    }


    /* ================================================================
       EDIT BUTTON
    ================================================================= */

    .hod-edit-button {

        position: relative;

        min-height: 43px;

        display: flex;

        align-items: center;

        width: 100%;

        padding: .45rem .5rem;

        color: var(--hod-button-text);

        background: var(--hod-button-bg);

        border: 1px solid var(--hod-button-bg);

        border-radius: 7px;

        text-decoration: none;

        font-size: .7rem;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .03em;

        transition:
            background-color .2s ease,
            color .2s ease,
            border-color .2s ease,
            box-shadow .2s ease,
            transform .2s ease;
    }


    .hod-edit-button:hover {

        color: var(--hod-button-hover-text);

        background: var(--hod-button-hover-bg);

        border-color: var(--hod-button-hover-text);

        box-shadow:
            0 6px 16px rgba(0, 0, 0, .12);

        transform: translateY(-1px);
    }


    .hod-edit-button:focus-visible {

        outline: 2px solid var(--hod-text);

        outline-offset: 3px;
    }


    /* ================================================================
       EDIT ICON
    ================================================================= */

    .hod-edit-icon {

        width: 33px;

        height: 33px;

        flex-shrink: 0;

        display: flex;

        align-items: center;

        justify-content: center;

        margin-right: .5rem;

        background: rgba(128, 128, 128, .18);

        border-radius: 6px;
    }


    .hod-edit-icon i {

        font-size: .9rem;
    }


    /* ================================================================
       EDIT TEXT
    ================================================================= */

    .hod-edit-text {

        flex: 1;

        min-width: 0;

        padding-left: .2rem;

        text-align: left;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }


    /* ================================================================
       ARROW
    ================================================================= */

    .hod-arrow {

        width: 30px;

        height: 30px;

        flex-shrink: 0;

        display: flex;

        align-items: center;

        justify-content: center;

        transition: transform .2s ease;
    }


    .hod-edit-button:hover .hod-arrow {

        transform: translateX(4px);
    }


    /* ================================================================
       EMPTY STATE
    ================================================================= */

    .hod-empty-state {

        padding: 4rem 1.5rem;

        text-align: center;

        color: var(--hod-text);

        background: var(--hod-card-bg);

        border: 2px solid var(--hod-border);

        border-radius: 10px;

        box-shadow: var(--hod-shadow);
    }


    .hod-empty-icon {

        width: 65px;

        height: 65px;

        display: flex;

        align-items: center;

        justify-content: center;

        margin: 0 auto 1rem;

        color: var(--hod-text);

        background: var(--hod-card-bg-soft);

        border: 1px solid var(--hod-border);

        border-radius: 10px;

        font-size: 1.5rem;
    }


    .hod-empty-state h6 {

        margin-bottom: .4rem;

        color: var(--hod-text);

        font-size: .85rem;

        font-weight: 800;

        text-transform: uppercase;
    }


    .hod-empty-state p {

        max-width: 500px;

        margin: 0 auto;

        color: var(--hod-text-secondary);

        font-size: .78rem;

        line-height: 1.6;
    }


    /* ================================================================
       TABLET
    ================================================================= */

    @media (max-width: 991.98px) {

        .hod-card {

            padding: 1.1rem;
        }


        .hod-name {

            font-size: .95rem;
        }


        .hod-status {

            padding: .32rem .6rem;

            font-size: .58rem;
        }

    }


    /* ================================================================
       MOBILE
    ================================================================= */

    @media (max-width: 767.98px) {

        .hod-card {

            padding: 1rem;

            border-radius: 8px;
        }


        .hod-card:hover {

            transform: translateY(-2px);
        }


        /* ============================================================
           ICON ONLY EDIT BUTTON
        ============================================================ */

        .hod-edit-button {

            width: 44px;

            height: 44px;

            min-height: 44px;

            margin-left: auto;

            padding: 0;

            justify-content: center;

            border-radius: 7px;
        }


        .hod-edit-text,
        .hod-arrow {

            display: none;
        }


        .hod-edit-icon {

            width: 100%;

            height: 100%;

            margin: 0;

            background: transparent;

            border-radius: 0;
        }


        .hod-edit-icon i {

            font-size: 1rem;
        }


        /* ============================================================
           MOBILE TOOLTIP
        ============================================================ */

        .hod-edit-button[data-tooltip]::after {

            content: attr(data-tooltip);

            position: absolute;

            left: 50%;

            top: calc(100% + 8px);

            transform:
                translateX(-50%) translateY(-3px);

            padding: .4rem .6rem;

            color: #ffffff;

            background: #111111;

            border: 1px solid #333333;

            border-radius: 5px;

            font-size: .62rem;

            font-weight: 700;

            white-space: nowrap;

            opacity: 0;

            pointer-events: none;

            transition:
                opacity .15s ease,
                transform .15s ease;

            z-index: 100;
        }


        [data-bs-theme="dark"] .hod-edit-button[data-tooltip]::after,
        .dark .hod-edit-button[data-tooltip]::after {

            color: #000000;

            background: #ffffff;

            border-color: #ffffff;
        }


        .hod-edit-button[data-tooltip]:hover::after {

            opacity: 1;

            transform:
                translateX(-50%) translateY(0);
        }

    }


    /* ================================================================
       SMALL MOBILE
    ================================================================= */

    @media (max-width: 575.98px) {

        .hod-card {

            padding: .95rem;
        }


        .hod-card-top {

            margin-bottom: 1rem;
        }


        .hod-info-box {

            grid-template-columns: 1fr;
        }


        .hod-info-year {

            border-left: 0;

            border-top: 1px solid var(--hod-border);
        }


        .hod-name {

            font-size: .95rem;
        }


        .hod-email {

            font-size: .73rem;
        }


        .hod-status {

            min-height: 27px;

            padding: .3rem .55rem;

            font-size: .57rem;
        }


        .hod-info-item {

            padding: .75rem;
        }


        .hod-empty-state {

            padding: 3rem 1rem;
        }

    }


    /* ================================================================
       VERY SMALL MOBILE
    ================================================================= */

    @media (max-width: 380px) {

        .hod-card-top {

            align-items: flex-start;
        }


        .hod-status {

            font-size: .54rem;

            padding: .28rem .5rem;
        }


        .hod-number {

            font-size: .62rem;
        }


        .hod-name {

            font-size: .9rem;
        }

    }


    /* ================================================================
       REDUCED MOTION
    ================================================================= */

    @media (prefers-reduced-motion: reduce) {

        .hod-card,
        .hod-edit-button,
        .hod-arrow,
        .hod-status {

            transition: none !important;
        }

    }
</style>
