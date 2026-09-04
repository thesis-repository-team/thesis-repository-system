@forelse ($students as $student)

    {{-- =====================================================
        STUDENT CARD
    ====================================================== --}}

    <div class="admin-student-card">

        {{-- =================================================
            CARD BODY
        ================================================== --}}

        <div class="admin-student-card-body">

            {{-- =================================================
                TOP SECTION
            ================================================== --}}

            <div class="admin-student-card-top">

                {{-- STUDENT INFORMATION --}}

                <div class="admin-student-profile">

                    {{-- AVATAR --}}

                    <div class="admin-student-icon">
                        <i class="bi bi-person"></i>
                    </div>


                    {{-- NAME + ID --}}

                    <div class="admin-student-profile-info">

                        <h3 class="admin-student-card-title">
                            {{ $student->full_name }}
                        </h3>

                        <span class="admin-student-id">
                            Student #{{ $loop->iteration }}
                        </span>

                    </div>

                </div>


                {{-- =================================================
                    UPLOAD PERMISSION
                ================================================== --}}

                @if ($student->upload_permission)

                    {{-- ALLOWED --}}

                    <span
                        class="admin-student-permission admin-student-permission-allowed"
                        title="Upload Allowed">

                        <i class="bi bi-check-circle-fill"></i>

                        <span>
                            Allowed
                        </span>

                    </span>

                @else

                    {{-- NOT ALLOWED --}}

                    <span
                        class="admin-student-permission admin-student-permission-denied"
                        title="Upload Not Allowed">

                        <i class="bi bi-x-circle-fill"></i>

                        <span>
                            Not Allowed
                        </span>

                    </span>

                @endif

            </div>


            {{-- =================================================
                DIVIDER
            ================================================== --}}

            <div class="admin-student-card-divider"></div>


            {{-- =================================================
                EMAIL
            ================================================== --}}

            <div class="admin-student-info-row">

                <div class="admin-student-info-icon">
                    <i class="bi bi-envelope"></i>
                </div>

                <div class="admin-student-info-content">

                    <span class="admin-student-info-label">
                        Email
                    </span>

                    <span
                        class="admin-student-info-value admin-student-email"
                        title="{{ $student->user->email ?? 'N/A' }}">

                        {{ $student->user->email ?? 'N/A' }}

                    </span>

                </div>

            </div>


            {{-- =================================================
                DEPARTMENT
            ================================================== --}}

            <div class="admin-student-info-row">

                <div class="admin-student-info-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div class="admin-student-info-content">

                    <span class="admin-student-info-label">
                        Department
                    </span>

                    <span class="admin-student-info-value">
                        {{ $student->department->name ?? 'N/A' }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                STARTED YEAR
            ================================================== --}}

            <div class="admin-student-info-row admin-student-year-row">

                <div class="admin-student-info-icon">
                    <i class="bi bi-calendar3"></i>
                </div>

                <div class="admin-student-info-content">

                    <span class="admin-student-info-label">
                        Started Year
                    </span>

                    <span class="admin-student-year-badge">
                        {{ $student->started_year ?? 'N/A' }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                CARD ACTION
            ================================================== --}}

            <div class="admin-student-card-action">

                <a
                    href="{{ route('admin.students.edit', $student->id) }}"
                    class="admin-student-edit-button"
                    data-tooltip="Edit Student"
                    aria-label="Edit Student">

                    <i class="bi bi-pencil-square"></i>

                    <span>
                        Edit
                    </span>

                </a>

            </div>

        </div>

    </div>


@empty

    {{-- =========================================================
        EMPTY RESULT
    ========================================================== --}}

    <div class="admin-student-empty-result">

        <div class="admin-student-empty-result-icon">

            <i class="bi bi-people"></i>

        </div>

        <h5>
            No Students Found
        </h5>

        <p>
            No students match your current search or filter.
        </p>

    </div>

@endforelse


<style>

    /* =========================================================
       VARIABLES
    ========================================================== */

    .admin-student-card,
    .admin-student-empty-result {

        --student-black: #000000;
        --student-white: #ffffff;

        --student-card-bg: #ffffff;
        --student-soft-bg: #f7f7f7;

        --student-text: #000000;
        --student-secondary: #333333;
        --student-muted: #777777;

        --student-border: #dddddd;
        --student-border-strong: #000000;


        /* =====================================================
           ALLOWED
        ====================================================== */

        --student-success: #15803d;
        --student-success-bg: #f0fdf4;
        --student-success-border: #22c55e;


        /* =====================================================
           NOT ALLOWED
        ====================================================== */

        --student-danger: #dc2626;
        --student-danger-bg: #fef2f2;
        --student-danger-border: #ef4444;


        --student-shadow:
            0 3px 12px rgba(0, 0, 0, .06);

        --student-shadow-hover:
            0 8px 24px rgba(0, 0, 0, .10);
    }


    /* =========================================================
       DARK MODE
    ========================================================== */

    [data-bs-theme="dark"] .admin-student-card,
    [data-bs-theme="dark"] .admin-student-empty-result,
    .dark .admin-student-card,
    .dark .admin-student-empty-result {

        --student-black: #000000;
        --student-white: #ffffff;

        --student-card-bg: #000000;
        --student-soft-bg: #111111;

        --student-text: #ffffff;
        --student-secondary: #dddddd;
        --student-muted: #999999;

        --student-border: #333333;
        --student-border-strong: #ffffff;


        /* =====================================================
           ALLOWED - DARK
        ====================================================== */

        --student-success: #4ade80;
        --student-success-bg: #07140b;
        --student-success-border: #22c55e;


        /* =====================================================
           NOT ALLOWED - DARK
        ====================================================== */

        --student-danger: #f87171;
        --student-danger-bg: #1a0808;
        --student-danger-border: #ef4444;


        --student-shadow:
            0 3px 12px rgba(0, 0, 0, .40);

        --student-shadow-hover:
            0 8px 24px rgba(0, 0, 0, .60);
    }


    /* =========================================================
       CARD
    ========================================================== */

    .admin-student-card {

        position: relative;

        height: 100%;

        overflow: hidden;

        color: var(--student-text);

        background: var(--student-card-bg);

        border: 2px solid var(--student-border);

        border-radius: 8px;

        box-shadow: var(--student-shadow);

        transition:
            transform .2s ease,
            box-shadow .2s ease,
            border-color .2s ease,
            background-color .2s ease;
    }


    .admin-student-card:hover {

        transform: translateY(-3px);

        border-color: var(--student-border-strong);

        box-shadow: var(--student-shadow-hover);
    }


    /* =========================================================
       CARD BODY
    ========================================================== */

    .admin-student-card-body {

        display: flex;

        flex-direction: column;

        min-height: 100%;

        padding: 1.25rem;
    }


    /* =========================================================
       TOP SECTION
    ========================================================== */

    .admin-student-card-top {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: .75rem;
    }


    /* =========================================================
       PROFILE
    ========================================================== */

    .admin-student-profile {

        display: flex;

        align-items: center;

        min-width: 0;

        gap: .75rem;
    }


    /* =========================================================
       AVATAR
    ========================================================== */

    .admin-student-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 48px;

        height: 48px;

        flex: 0 0 48px;

        color: var(--student-text);

        background: var(--student-soft-bg);

        border: 1px solid var(--student-border);

        border-radius: 50%;

        transition:
            background-color .2s ease,
            color .2s ease,
            border-color .2s ease;
    }


    .admin-student-card:hover .admin-student-icon {

        color: var(--student-white);

        background: var(--student-black);

        border-color: var(--student-black);
    }


    [data-bs-theme="dark"] .admin-student-card:hover .admin-student-icon,
    .dark .admin-student-card:hover .admin-student-icon {

        color: var(--student-black);

        background: var(--student-white);

        border-color: var(--student-white);
    }


    .admin-student-icon i {

        font-size: 1.2rem;
    }


    /* =========================================================
       PROFILE INFO
    ========================================================== */

    .admin-student-profile-info {

        min-width: 0;
    }


    /* =========================================================
       STUDENT NAME
    ========================================================== */

    .admin-student-card-title {

        margin: 0 0 .2rem;

        overflow: hidden;

        color: var(--student-text);

        font-size: .88rem;

        font-weight: 800;

        line-height: 1.3;

        text-overflow: ellipsis;

        white-space: nowrap;

        text-transform: uppercase;
    }


    /* =========================================================
       STUDENT ID
    ========================================================== */

    .admin-student-id {

        display: block;

        color: var(--student-muted);

        font-family: monospace;

        font-size: .68rem;

        letter-spacing: .02em;
    }


    /* =========================================================
       PERMISSION BADGE
    ========================================================== */

    .admin-student-permission {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        flex-shrink: 0;

        gap: .35rem;

        min-height: 28px;

        padding: .35rem .6rem;

        border: 1px solid;

        border-radius: 6px;

        font-family: monospace;

        font-size: .61rem;

        font-weight: 800;

        line-height: 1;

        text-transform: uppercase;

        white-space: nowrap;

        transition:
            color .2s ease,
            background-color .2s ease,
            border-color .2s ease,
            box-shadow .2s ease;
    }


    .admin-student-permission i {

        font-size: .72rem;
    }


    /* =========================================================
       ALLOWED = GREEN
    ========================================================== */

    .admin-student-permission-allowed {

        color: var(--student-success);

        background: var(--student-success-bg);

        border-color: var(--student-success-border);

        box-shadow:
            inset 0 0 0 1px rgba(34, 197, 94, .05);
    }


    .admin-student-permission-allowed i {

        color: var(--student-success);
    }


    /* =========================================================
       NOT ALLOWED = RED
    ========================================================== */

    .admin-student-permission-denied {

        color: var(--student-danger);

        background: var(--student-danger-bg);

        border-color: var(--student-danger-border);

        box-shadow:
            inset 0 0 0 1px rgba(239, 68, 68, .05);
    }


    .admin-student-permission-denied i {

        color: var(--student-danger);
    }


    /* =========================================================
       PERMISSION HOVER
    ========================================================== */

    .admin-student-permission-allowed:hover {

        background: var(--student-success);

        color: #ffffff;

        border-color: var(--student-success);
    }


    .admin-student-permission-allowed:hover i {

        color: #ffffff;
    }


    .admin-student-permission-denied:hover {

        background: var(--student-danger);

        color: #ffffff;

        border-color: var(--student-danger);
    }


    .admin-student-permission-denied:hover i {

        color: #ffffff;
    }


    /* =========================================================
       DIVIDER
    ========================================================== */

    .admin-student-card-divider {

        width: 100%;

        height: 1px;

        margin: 1rem 0;

        background: var(--student-border);
    }


    /* =========================================================
       INFORMATION ROW
    ========================================================== */

    .admin-student-info-row {

        display: flex;

        align-items: center;

        gap: .8rem;

        min-width: 0;

        margin-bottom: 1rem;
    }


    .admin-student-year-row {

        margin-bottom: 1.25rem;
    }


    /* =========================================================
       INFORMATION ICON
    ========================================================== */

    .admin-student-info-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 36px;

        height: 36px;

        flex: 0 0 36px;

        color: var(--student-text);

        background: var(--student-soft-bg);

        border: 1px solid var(--student-border);

        border-radius: 7px;
    }


    .admin-student-info-icon i {

        font-size: .88rem;
    }


    /* =========================================================
       INFORMATION CONTENT
    ========================================================== */

    .admin-student-info-content {

        display: flex;

        flex-direction: column;

        min-width: 0;

        gap: .18rem;
    }


    .admin-student-info-label {

        color: var(--student-muted);

        font-size: .61rem;

        font-weight: 800;

        letter-spacing: .06em;

        line-height: 1.2;

        text-transform: uppercase;
    }


    .admin-student-info-value {

        display: block;

        overflow: hidden;

        color: var(--student-text);

        font-size: .76rem;

        font-weight: 600;

        line-height: 1.4;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* =========================================================
       EMAIL
    ========================================================== */

    .admin-student-email {

        max-width: 220px;
    }


    /* =========================================================
       YEAR BADGE
    ========================================================== */

    .admin-student-year-badge {

        display: inline-flex;

        align-items: center;

        width: fit-content;

        padding: .3rem .55rem;

        color: var(--student-text);

        background: var(--student-soft-bg);

        border: 1px solid var(--student-border);

        border-radius: 5px;

        font-family: monospace;

        font-size: .7rem;

        font-weight: 700;

        line-height: 1;
    }


    /* =========================================================
       ACTION AREA
    ========================================================== */

    .admin-student-card-action {

        position: relative;

        display: flex;

        justify-content: flex-end;

        margin-top: auto;

        padding-top: 1rem;

        border-top: 1px solid var(--student-border);
    }


    /* =========================================================
       EDIT BUTTON
    ========================================================== */

    .admin-student-edit-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: .4rem;

        min-width: 86px;

        min-height: 36px;

        padding: .45rem .8rem;

        color: var(--student-white);

        background: var(--student-black);

        border: 1px solid var(--student-black);

        border-radius: 6px;

        font-size: .68rem;

        font-weight: 800;

        line-height: 1;

        text-decoration: none;

        text-transform: uppercase;

        transition:
            background-color .2s ease,
            color .2s ease,
            border-color .2s ease,
            transform .2s ease,
            box-shadow .2s ease;
    }


    /* =========================================================
       DARK MODE BUTTON
    ========================================================== */

    [data-bs-theme="dark"] .admin-student-edit-button,
    .dark .admin-student-edit-button {

        color: var(--student-black);

        background: var(--student-white);

        border-color: var(--student-white);
    }


    .admin-student-edit-button i {

        font-size: .75rem;
    }


    /* =========================================================
       BUTTON HOVER - LIGHT
    ========================================================== */

    .admin-student-edit-button:hover {

        color: var(--student-black);

        background: var(--student-white);

        border-color: var(--student-black);

        transform: translateY(-1px);

        box-shadow:
            0 5px 14px rgba(0, 0, 0, .12);
    }


    /* =========================================================
       BUTTON HOVER - DARK
    ========================================================== */

    [data-bs-theme="dark"] .admin-student-edit-button:hover,
    .dark .admin-student-edit-button:hover {

        color: var(--student-white);

        background: var(--student-black);

        border-color: var(--student-white);

        box-shadow:
            0 5px 14px rgba(255, 255, 255, .08);
    }


    /* =========================================================
       EMPTY RESULT
    ========================================================== */

    .admin-student-empty-result {

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: center;

        min-height: 280px;

        padding: 2.5rem 1rem;

        text-align: center;

        color: var(--student-text);

        background: var(--student-card-bg);

        border: 2px solid var(--student-border);

        border-radius: 8px;

        box-shadow: var(--student-shadow);
    }


    .admin-student-empty-result-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 64px;

        height: 64px;

        margin-bottom: 1rem;

        color: var(--student-text);

        background: var(--student-soft-bg);

        border: 1px solid var(--student-border);

        border-radius: 50%;
    }


    .admin-student-empty-result-icon i {

        font-size: 1.5rem;
    }


    .admin-student-empty-result h5 {

        margin: 0 0 .4rem;

        color: var(--student-text);

        font-size: .85rem;

        font-weight: 800;

        text-transform: uppercase;
    }


    .admin-student-empty-result p {

        margin: 0;

        color: var(--student-muted);

        font-size: .74rem;
    }


    /* =========================================================
       TABLET
    ========================================================== */

    @media (max-width: 991.98px) {

        .admin-student-card-body {

            padding: 1.1rem;
        }


        .admin-student-card-title {

            font-size: .82rem;
        }


        .admin-student-permission {

            padding: .28rem .45rem;

            font-size: .58rem;
        }

    }


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 767.98px) {

        .admin-student-card {

            border-radius: 7px;
        }


        .admin-student-card-body {

            padding: 1rem;
        }


        .admin-student-card-title {

            font-size: .84rem;
        }


        .admin-student-icon {

            width: 44px;

            height: 44px;

            flex-basis: 44px;
        }


        .admin-student-permission {

            min-height: 25px;

            padding: .25rem .45rem;

            font-size: .56rem;
        }


        .admin-student-info-value {

            font-size: .74rem;
        }


        .admin-student-email {

            max-width: calc(100vw - 120px);
        }

    }


    /* =========================================================
       SMALL MOBILE
    ========================================================== */

    @media (max-width: 575.98px) {

        .admin-student-card-body {

            padding: .9rem;
        }


        .admin-student-card-top {

            gap: .5rem;
        }


        .admin-student-profile {

            gap: .6rem;
        }


        .admin-student-icon {

            width: 42px;

            height: 42px;

            flex-basis: 42px;
        }


        .admin-student-icon i {

            font-size: 1.05rem;
        }


        .admin-student-card-title {

            max-width: 170px;

            font-size: .78rem;
        }


        .admin-student-id {

            font-size: .62rem;
        }


        /* =====================================================
           PERMISSION BADGE = ICON ONLY
        ====================================================== */

        .admin-student-permission {

            width: 30px;

            height: 30px;

            min-height: 30px;

            padding: 0;

            border-radius: 50%;
        }


        .admin-student-permission span {

            display: none;
        }


        .admin-student-permission i {

            margin: 0;

            font-size: .75rem;
        }


        /* =====================================================
           INFORMATION
        ====================================================== */

        .admin-student-info-row {

            gap: .65rem;

            margin-bottom: .85rem;
        }


        .admin-student-info-icon {

            width: 34px;

            height: 34px;

            flex-basis: 34px;
        }


        .admin-student-info-label {

            font-size: .58rem;
        }


        .admin-student-info-value {

            font-size: .7rem;
        }


        .admin-student-email {

            max-width: calc(100vw - 115px);
        }


        .admin-student-year-row {

            margin-bottom: 1rem;
        }


        /* =====================================================
           ACTION
        ====================================================== */

        .admin-student-card-action {

            padding-top: .8rem;
        }


        /* =====================================================
           EDIT BUTTON = ICON ONLY
        ====================================================== */

        .admin-student-edit-button {

            width: 38px;

            min-width: 38px;

            height: 36px;

            min-height: 36px;

            padding: 0;
        }


        .admin-student-edit-button span {

            display: none;
        }


        .admin-student-edit-button i {

            margin: 0;

            font-size: .8rem;
        }


        /* =====================================================
           MOBILE TOOLTIP
        ====================================================== */

        .admin-student-edit-button[data-tooltip]::after {

            content: attr(data-tooltip);

            position: absolute;

            right: 0;

            bottom: calc(100% + 8px);

            padding: .4rem .6rem;

            color: #ffffff;

            background: #000000;

            border-radius: 5px;

            font-size: .62rem;

            font-weight: 700;

            white-space: nowrap;

            opacity: 0;

            pointer-events: none;

            transform: translateY(3px);

            transition:
                opacity .15s ease,
                transform .15s ease;

            z-index: 100;
        }


        .admin-student-edit-button[data-tooltip]:hover::after {

            opacity: 1;

            transform: translateY(0);
        }


        .admin-student-empty-result {

            min-height: 230px;

            padding: 2rem 1rem;
        }

    }


    /* =========================================================
       VERY SMALL MOBILE
    ========================================================== */

    @media (max-width: 380px) {

        .admin-student-card-title {

            max-width: 135px;
        }


        .admin-student-permission {

            width: 28px;

            height: 28px;

            min-height: 28px;
        }


        .admin-student-info-value {

            max-width: 190px;
        }

    }


    /* =========================================================
       REDUCED MOTION
    ========================================================== */

    @media (prefers-reduced-motion: reduce) {

        .admin-student-card,
        .admin-student-icon,
        .admin-student-edit-button,
        .admin-student-permission {

            transition: none !important;
        }

    }

</style>

