@forelse ($students as $student)
    {{-- =====================================================
            STUDENT CARD
        ====================================================== --}}

    <div class="student-item-card">

        {{-- =================================================
                CARD BODY
            ================================================== --}}

        <div class="student-item-card-body">

            {{-- =================================================
                    TOP SECTION
                ================================================== --}}

            <div class="student-item-top">

                {{-- STUDENT INFORMATION --}}
                <div class="student-profile">

                    {{-- AVATAR --}}
                    <div class="student-avatar">
                        <i class="bi bi-person"></i>
                    </div>

                    {{-- NAME + ID --}}
                    <div class="student-profile-info">

                        <h5 class="student-name">
                            {{ $student->full_name }}
                        </h5>

                        <span class="student-id">
                            Student #{{ $loop->iteration }}
                        </span>

                    </div>

                </div>


                {{-- =================================================
                        UPLOAD PERMISSION
                    ================================================== --}}

                @if ($student->upload_permission)
                    {{-- ALLOWED --}}
                    <span class="student-permission student-permission-allowed" title="Upload Allowed">

                        <i class="bi bi-check-circle-fill"></i>

                        <span>
                            Allowed
                        </span>

                    </span>
                @else
                    {{-- NOT ALLOWED --}}
                    <span class="student-permission student-permission-denied" title="Upload Not Allowed">

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

            <div class="student-card-divider"></div>


            {{-- =================================================
                    EMAIL
                ================================================== --}}

            <div class="student-info-row">

                <div class="student-info-icon">
                    <i class="bi bi-envelope"></i>
                </div>

                <div class="student-info-content">

                    <span class="student-info-label">
                        Email
                    </span>

                    <span class="student-info-value student-email" title="{{ $student->user->email ?? 'N/A' }}">
                        {{ $student->user->email ?? 'N/A' }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                    DEPARTMENT
                ================================================== --}}

            <div class="student-info-row">

                <div class="student-info-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div class="student-info-content">

                    <span class="student-info-label">
                        Department
                    </span>

                    <span class="student-info-value">
                        {{ $student->department->name ?? 'N/A' }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                    STARTED YEAR
                ================================================== --}}

            <div class="student-info-row student-year-row">

                <div class="student-info-icon">
                    <i class="bi bi-calendar3"></i>
                </div>

                <div class="student-info-content">

                    <span class="student-info-label">
                        Started Year
                    </span>

                    <span class="student-year-badge">
                        {{ $student->started_year ?? 'N/A' }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                    CARD ACTION
                ================================================== --}}

            <div class="student-card-action">

                <a href="{{ route('hod.students.edit', $student->id) }}" class="student-edit-button"
                    data-tooltip="Edit Student" aria-label="Edit Student">

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

    <div class="col-12">

        <div class="student-empty-result">

            <div class="student-empty-result-icon">
                <i class="bi bi-people"></i>
            </div>

            <h5>
                No Students Found
            </h5>

            <p>
                No students match your current search or filter.
            </p>

        </div>

    </div>
@endforelse


{{-- =============================================================
    STUDENT CARD CSS
    BLACK + WHITE DESIGN
    GREEN = ALLOWED
    RED = NOT ALLOWED
    LIGHT + DARK MODE
============================================================= --}}

<style>

/* =========================================================
   LIGHT MODE
========================================================= */

.student-item-card,
.student-empty-result {

    --student-card-bg: #ffffff;
    --student-soft-bg: #f7f7f7;

    --student-text: #000000;
    --student-secondary: #333333;
    --student-muted: #777777;

    --student-border: #dddddd;

    --student-success: #15803d;
    --student-success-bg: #f0fdf4;
    --student-success-border: #22c55e;

    --student-danger: #dc2626;
    --student-danger-bg: #fef2f2;
    --student-danger-border: #ef4444;

    --student-shadow:
        0 3px 12px rgba(0, 0, 0, .06);

    --student-shadow-hover:
        0 8px 24px rgba(0, 0, 0, .10);
}


/* =========================================================
   DARK MODE VARIABLES

   PAGE  : #101426
   CARD  : #181d33
   SOFT  : #20253a
   BORDER: #292e45
========================================================= */

[data-bs-theme="dark"] .student-item-card,
[data-bs-theme="dark"] .student-empty-result,
.dark .student-item-card,
.dark .student-empty-result {

    --student-card-bg: #181d33;
    --student-soft-bg: #20253a;

    --student-text: #eeeef8;
    --student-secondary: #d5d8e8;
    --student-muted: #999fb9;

    --student-border: #292e45;

    --student-success: #4ade80;
    --student-success-bg: #07140b;
    --student-success-border: #22c55e;

    --student-danger: #f87171;
    --student-danger-bg: #1a0808;
    --student-danger-border: #ef4444;

    --student-shadow:
        0 4px 16px rgba(0, 0, 0, .35);

    --student-shadow-hover:
        0 8px 28px rgba(0, 0, 0, .55);
}


/* =========================================================
   CARD
========================================================= */

.student-item-card {

    position: relative;

    display: flex;
    flex-direction: column;

    width: 100%;
    height: 100%;

    overflow: hidden;

    color: var(--student-text);

    background: var(--student-card-bg);

    border: 1px solid var(--student-border);

    border-radius: 8px;

    box-shadow: var(--student-shadow);

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        border-color .2s ease,
        background-color .2s ease;
}


.student-item-card:hover {

    transform: translateY(-3px);

    border-color: var(--student-text);

    box-shadow: var(--student-shadow-hover);
}


/* =========================================================
   CARD BODY
========================================================= */

.student-item-card-body {

    display: flex;

    flex-direction: column;

    min-height: 100%;

    padding: 1.25rem;

    color: var(--student-text);

    background: var(--student-card-bg);
}


/* =========================================================
   TOP
========================================================= */

.student-item-top {

    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: .75rem;
}


/* =========================================================
   PROFILE
========================================================= */

.student-profile {

    display: flex;

    align-items: center;

    min-width: 0;

    gap: .75rem;
}


.student-profile-info {

    min-width: 0;
}


/* =========================================================
   AVATAR
========================================================= */

.student-avatar {

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


.student-avatar i {

    font-size: 1.2rem;
}


/* =========================================================
   AVATAR HOVER - LIGHT
========================================================= */

.student-item-card:hover .student-avatar {

    color: #ffffff;

    background: #000000;

    border-color: #000000;
}


/* =========================================================
   AVATAR HOVER - DARK
========================================================= */

[data-bs-theme="dark"] .student-item-card:hover .student-avatar,
.dark .student-item-card:hover .student-avatar {

    color: #000000;

    background: #ffffff;

    border-color: #ffffff;
}


/* =========================================================
   STUDENT NAME
========================================================= */

.student-name {

    margin:
        0 0 .2rem;

    overflow:
        hidden;

    color:
        var(--student-text);

    font-size:
        .88rem;

    font-weight:
        800;

    line-height:
        1.3;

    text-overflow:
        ellipsis;

    white-space:
        nowrap;

    text-transform:
        uppercase;
}


/* =========================================================
   STUDENT ID
========================================================= */

.student-id {

    display:
        block;

    color:
        var(--student-muted);

    font-family:
        monospace;

    font-size:
        .68rem;

    letter-spacing:
        .02em;
}


/* =========================================================
   PERMISSION
========================================================= */

.student-permission {

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    flex-shrink:
        0;

    gap:
        .35rem;

    min-height:
        28px;

    padding:
        .35rem .6rem;

    border:
        1px solid;

    border-radius:
        6px;

    font-family:
        monospace;

    font-size:
        .61rem;

    font-weight:
        800;

    line-height:
        1;

    text-transform:
        uppercase;

    white-space:
        nowrap;

    transition:
        background-color .2s ease,
        color .2s ease,
        border-color .2s ease;
}


.student-permission i {

    font-size:
        .72rem;
}


/* =========================================================
   ALLOWED
========================================================= */

.student-permission-allowed {

    color:
        var(--student-success);

    background:
        var(--student-success-bg);

    border-color:
        var(--student-success-border);
}


.student-permission-allowed i {

    color:
        var(--student-success);
}


/* =========================================================
   NOT ALLOWED
========================================================= */

.student-permission-denied {

    color:
        var(--student-danger);

    background:
        var(--student-danger-bg);

    border-color:
        var(--student-danger-border);
}


.student-permission-denied i {

    color:
        var(--student-danger);
}


/* =========================================================
   PERMISSION HOVER
========================================================= */

.student-permission-allowed:hover {

    color:
        #ffffff;

    background:
        var(--student-success);

    border-color:
        var(--student-success);
}


.student-permission-allowed:hover i {

    color:
        #ffffff;
}


.student-permission-denied:hover {

    color:
        #ffffff;

    background:
        var(--student-danger);

    border-color:
        var(--student-danger);
}


.student-permission-denied:hover i {

    color:
        #ffffff;
}


/* =========================================================
   DIVIDER
========================================================= */

.student-card-divider {

    width:
        100%;

    height:
        1px;

    margin:
        1rem 0;

    background:
        var(--student-border);
}


/* =========================================================
   INFORMATION ROW
========================================================= */

.student-info-row {

    display:
        flex;

    align-items:
        center;

    gap:
        .8rem;

    min-width:
        0;

    margin-bottom:
        1rem;
}


.student-year-row {

    margin-bottom:
        1.25rem;
}


/* =========================================================
   INFORMATION ICON
========================================================= */

.student-info-icon {

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    width:
        36px;

    height:
        36px;

    flex:
        0 0 36px;

    color:
        var(--student-text);

    background:
        var(--student-soft-bg);

    border:
        1px solid var(--student-border);

    border-radius:
        7px;
}


.student-info-icon i {

    font-size:
        .88rem;
}


/* =========================================================
   INFORMATION CONTENT
========================================================= */

.student-info-content {

    display:
        flex;

    flex-direction:
        column;

    min-width:
        0;

    gap:
        .18rem;
}


/* =========================================================
   LABEL
========================================================= */

.student-info-label {

    color:
        var(--student-muted);

    font-size:
        .61rem;

    font-weight:
        800;

    letter-spacing:
        .06em;

    line-height:
        1.2;

    text-transform:
        uppercase;
}


/* =========================================================
   VALUE
========================================================= */

.student-info-value {

    display:
        block;

    overflow:
        hidden;

    color:
        var(--student-text);

    font-size:
        .76rem;

    font-weight:
        600;

    line-height:
        1.4;

    text-overflow:
        ellipsis;

    white-space:
        nowrap;
}


.student-email {

    max-width:
        220px;
}


/* =========================================================
   YEAR BADGE
========================================================= */

.student-year-badge {

    display:
        inline-flex;

    align-items:
        center;

    width:
        fit-content;

    padding:
        .3rem .55rem;

    color:
        var(--student-text);

    background:
        var(--student-soft-bg);

    border:
        1px solid var(--student-border);

    border-radius:
        5px;

    font-family:
        monospace;

    font-size:
        .7rem;

    font-weight:
        700;

    line-height:
        1;
}


/* =========================================================
   ACTION
========================================================= */

.student-card-action {

    position:
        relative;

    display:
        flex;

    justify-content:
        flex-end;

    margin-top:
        auto;

    padding-top:
        1rem;

    border-top:
        1px solid var(--student-border);
}


/* =========================================================
   EDIT BUTTON
========================================================= */

.student-edit-button {

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    gap:
        .4rem;

    min-width:
        86px;

    min-height:
        36px;

    padding:
        .45rem .8rem;

    color:
        #ffffff;

    background:
        #000000;

    border:
        1px solid #000000;

    border-radius:
        6px;

    font-size:
        .68rem;

    font-weight:
        800;

    line-height:
        1;

    text-decoration:
        none;

    text-transform:
        uppercase;

    transition:
        background-color .2s ease,
        color .2s ease,
        border-color .2s ease,
        transform .2s ease,
        box-shadow .2s ease;
}


/* =========================================================
   EDIT BUTTON DARK
========================================================= */

[data-bs-theme="dark"] .student-edit-button,
.dark .student-edit-button {

    color:
        #000000 !important;

    background:
        #ffffff !important;

    border-color:
        #ffffff !important;
}


.student-edit-button i {

    font-size:
        .75rem;
}


/* =========================================================
   EDIT BUTTON HOVER - LIGHT
========================================================= */

.student-edit-button:hover {

    color:
        #000000;

    background:
        #ffffff;

    border-color:
        #000000;

    transform:
        translateY(-1px);

    box-shadow:
        0 5px 14px rgba(0, 0, 0, .12);
}


/* =========================================================
   EDIT BUTTON HOVER - DARK
========================================================= */

[data-bs-theme="dark"] .student-edit-button:hover,
.dark .student-edit-button:hover {

    color:
        #ffffff !important;

    background:
        #000000 !important;

    border-color:
        #ffffff !important;

    box-shadow:
        0 5px 14px rgba(255, 255, 255, .08);
}


/* =========================================================
   EMPTY RESULT
========================================================= */

.student-empty-result {

    display:
        flex;

    flex-direction:
        column;

    align-items:
        center;

    justify-content:
        center;

    min-height:
        280px;

    padding:
        2.5rem 1rem;

    text-align:
        center;

    color:
        var(--student-text);

    background:
        var(--student-card-bg);

    border:
        1px solid var(--student-border);

    border-radius:
        8px;

    box-shadow:
        var(--student-shadow);
}


/* =========================================================
   EMPTY ICON
========================================================= */

.student-empty-result-icon {

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    width:
        64px;

    height:
        64px;

    margin-bottom:
        1rem;

    color:
        var(--student-text);

    background:
        var(--student-soft-bg);

    border:
        1px solid var(--student-border);

    border-radius:
        50%;
}


.student-empty-result-icon i {

    font-size:
        1.5rem;
}


/* =========================================================
   EMPTY TITLE
========================================================= */

.student-empty-result h5 {

    margin:
        0 0 .4rem;

    color:
        var(--student-text);

    font-size:
        .85rem;

    font-weight:
        800;

    text-transform:
        uppercase;
}


/* =========================================================
   EMPTY TEXT
========================================================= */

.student-empty-result p {

    margin:
        0;

    color:
        var(--student-muted);

    font-size:
        .74rem;
}


/* =========================================================
   EXPLICIT DARK MODE
   Prevent Bootstrap from overriding the card
========================================================= */

[data-bs-theme="dark"] .student-item-card,
.dark .student-item-card {

    background-color:
        #181d33 !important;

    color:
        #eeeef8 !important;

    border-color:
        #292e45 !important;
}


[data-bs-theme="dark"] .student-item-card-body,
.dark .student-item-card-body {

    background-color:
        #181d33 !important;

    color:
        #eeeef8 !important;
}


[data-bs-theme="dark"] .student-name,
.dark .student-name {

    color:
        #eeeef8 !important;
}


[data-bs-theme="dark"] .student-id,
.dark .student-id {

    color:
        #999fb9 !important;
}


[data-bs-theme="dark"] .student-info-label,
.dark .student-info-label {

    color:
        #999fb9 !important;
}


[data-bs-theme="dark"] .student-info-value,
.dark .student-info-value {

    color:
        #eeeef8 !important;
}


[data-bs-theme="dark"] .student-avatar,
.dark .student-avatar {

    color:
        #eeeef8 !important;

    background-color:
        #20253a !important;

    border-color:
        #292e45 !important;
}


[data-bs-theme="dark"] .student-info-icon,
.dark .student-info-icon {

    color:
        #eeeef8 !important;

    background-color:
        #20253a !important;

    border-color:
        #292e45 !important;
}


[data-bs-theme="dark"] .student-year-badge,
.dark .student-year-badge {

    color:
        #eeeef8 !important;

    background-color:
        #20253a !important;

    border-color:
        #292e45 !important;
}


[data-bs-theme="dark"] .student-card-divider,
.dark .student-card-divider {

    background-color:
        #292e45 !important;
}


[data-bs-theme="dark"] .student-card-action,
.dark .student-card-action {

    border-color:
        #292e45 !important;
}


/* =========================================================
   DARK EMPTY STATE
========================================================= */

[data-bs-theme="dark"] .student-empty-result,
.dark .student-empty-result {

    background-color:
        #181d33 !important;

    color:
        #eeeef8 !important;

    border-color:
        #292e45 !important;
}


[data-bs-theme="dark"] .student-empty-result-icon,
.dark .student-empty-result-icon {

    color:
        #eeeef8 !important;

    background-color:
        #20253a !important;

    border-color:
        #292e45 !important;
}


[data-bs-theme="dark"] .student-empty-result h5,
.dark .student-empty-result h5 {

    color:
        #eeeef8 !important;
}


[data-bs-theme="dark"] .student-empty-result p,
.dark .student-empty-result p {

    color:
        #999fb9 !important;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991.98px) {

    .student-item-card-body {

        padding:
            1.1rem;
    }


    .student-name {

        font-size:
            .82rem;
    }


    .student-permission {

        padding:
            .28rem .45rem;

        font-size:
            .58rem;
    }
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767.98px) {

    .student-item-card {

        border-radius:
            7px;
    }


    .student-item-card-body {

        padding:
            1rem;
    }


    .student-name {

        font-size:
            .84rem;
    }


    .student-avatar {

        width:
            44px;

        height:
            44px;

        flex-basis:
            44px;
    }


    .student-permission {

        min-height:
            25px;

        padding:
            .25rem .45rem;

        font-size:
            .56rem;
    }


    .student-info-value {

        font-size:
            .74rem;
    }


    .student-email {

        max-width:
            calc(100vw - 120px);
    }
}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 575.98px) {

    .student-item-card-body {

        padding:
            .9rem;
    }


    .student-item-top {

        gap:
            .5rem;
    }


    .student-profile {

        gap:
            .6rem;
    }


    .student-avatar {

        width:
            42px;

        height:
            42px;

        flex-basis:
            42px;
    }


    .student-avatar i {

        font-size:
            1.05rem;
    }


    .student-name {

        max-width:
            170px;

        font-size:
            .78rem;
    }


    .student-id {

        font-size:
            .62rem;
    }


    /* =====================================================
       PERMISSION ICON ONLY
    ====================================================== */

    .student-permission {

        width:
            30px;

        height:
            30px;

        min-height:
            30px;

        padding:
            0;

        border-radius:
            50%;
    }


    .student-permission span {

        display:
            none;
    }


    .student-permission i {

        margin:
            0;

        font-size:
            .75rem;
    }


    /* =====================================================
       INFO
    ====================================================== */

    .student-info-row {

        gap:
            .65rem;

        margin-bottom:
            .85rem;
    }


    .student-info-icon {

        width:
            34px;

        height:
            34px;

        flex-basis:
            34px;
    }


    .student-info-label {

        font-size:
            .58rem;
    }


    .student-info-value {

        font-size:
            .7rem;
    }


    .student-email {

        max-width:
            calc(100vw - 115px);
    }


    .student-year-row {

        margin-bottom:
            1rem;
    }


    /* =====================================================
       ACTION
    ====================================================== */

    .student-card-action {

        padding-top:
            .8rem;
    }


    /* =====================================================
       EDIT ICON ONLY
    ====================================================== */

    .student-edit-button {

        width:
            38px;

        min-width:
            38px;

        height:
            36px;

        min-height:
            36px;

        padding:
            0;
    }


    .student-edit-button span {

        display:
            none;
    }


    .student-edit-button i {

        margin:
            0;

        font-size:
            .8rem;
    }


    /* =====================================================
       TOOLTIP
    ====================================================== */

    .student-edit-button[data-tooltip]::after {

        content:
            attr(data-tooltip);

        position:
            absolute;

        right:
            0;

        bottom:
            calc(100% + 8px);

        z-index:
            100;

        padding:
            .4rem .6rem;

        color:
            #ffffff;

        background:
            #000000;

        border-radius:
            5px;

        font-size:
            .62rem;

        font-weight:
            700;

        white-space:
            nowrap;

        opacity:
            0;

        pointer-events:
            none;

        transform:
            translateY(3px);

        transition:
            opacity .15s ease,
            transform .15s ease;
    }


    .student-edit-button[data-tooltip]:hover::after {

        opacity:
            1;

        transform:
            translateY(0);
    }


    /* =====================================================
       EMPTY
    ====================================================== */

    .student-empty-result {

        min-height:
            230px;

        padding:
            2rem 1rem;
    }
}


/* =========================================================
   VERY SMALL MOBILE
========================================================= */

@media (max-width: 380px) {

    .student-name {

        max-width:
            135px;
    }


    .student-permission {

        width:
            28px;

        height:
            28px;

        min-height:
            28px;
    }


    .student-info-value {

        max-width:
            190px;
    }
}


/* =========================================================
   REDUCED MOTION
========================================================= */

@media (prefers-reduced-motion: reduce) {

    .student-item-card,
    .student-avatar,
    .student-edit-button,
    .student-permission {

        transition:
            none !important;
    }
}

</style>
