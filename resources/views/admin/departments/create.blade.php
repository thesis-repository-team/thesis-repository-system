{{-- CREATE MODAL --}}

<div id="createModal" class="hidden department-modal">

    <div class="department-modal-container">

        {{-- Modal Header --}}
        <div class="department-modal-header">

            <div class="department-modal-heading">

                <span class="department-modal-overline">
                    DEPARTMENT MANAGEMENT
                </span>

                <h3 class="department-modal-title">
                    Create Department
                </h3>

                <p class="department-modal-description">
                    Add a new department to the thesis repository.
                </p>

            </div>

            <button type="button" onclick="closeCreateModal()" class="department-modal-close" aria-label="Close">

                <i class="bi bi-x-lg"></i>

            </button>

        </div>


        {{-- Create Form --}}
        <form method="POST" action="{{ route('admin.departments.store') }}">

            @csrf

            {{-- Modal Body --}}
            <div class="department-modal-body">

                <div class="department-form-group">

                    <label for="createDepartmentName" class="department-modal-label">

                        Department Name

                    </label>

                    <input type="text" id="createDepartmentName" name="name" value="{{ old('name') }}"
                        placeholder="Enter department name" class="department-modal-input" autocomplete="off">

                    @error('name')
                        <p class="department-modal-error">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Footer --}}
            <div class="department-modal-footer">

                <button type="button" onclick="closeCreateModal()" class="department-modal-cancel">

                    <i class="bi bi-x-circle"></i>

                    <span>Cancel</span>

                </button>


                <button type="submit" class="department-modal-submit">

                    <i class="bi bi-plus-lg"></i>

                    <span>Create Department</span>

                </button>

            </div>

        </form>

    </div>


</div>

<style>

/* =========================================================
   CREATE DEPARTMENT MODAL
   FIXED + MATCHED TO THESIS PAGE
========================================================= */


/* =========================================================
   COLOR SYSTEM
========================================================= */

.department-modal {

    --department-purple: #6538D9;
    --department-purple-hover: #5428C7;

    --department-purple-light: #F5F3FF;
    --department-purple-soft: #EDE9FE;

    --department-white: #FFFFFF;
    --department-page-bg: #FAFAFA;

    --department-text: #111111;
    --department-text-secondary: #4B5563;
    --department-text-muted: #6B7280;

    --department-border: #E5E7EB;
    --department-border-light: #EEEEEE;

    --department-input-bg: #FFFFFF;

    --department-danger: #DC2626;

    --department-shadow:
        0 20px 50px rgba(17, 17, 17, .14);
}


/* =========================================================
   MODAL OVERLAY
========================================================= */

.department-modal {

    position: fixed;

    inset: 0;

    width: 100%;
    height: 100%;

    padding: 1.5rem;

    box-sizing: border-box;

    display: flex;

    align-items: center;
    justify-content: center;

    z-index: 99999;

    background: rgba(17, 17, 17, .48);

    /* IMPORTANT:
       Do not blur the modal itself */
    backdrop-filter: none;
    -webkit-backdrop-filter: none;

    isolation: isolate;
}


/* =========================================================
   HIDDEN
========================================================= */

.department-modal.hidden {

    display: none !important;

}


/* =========================================================
   MODAL CONTAINER
========================================================= */

.department-modal-container {

    position: relative;

    z-index: 100000;

    width: 100%;

    max-width: 560px;

    margin: 0 auto;

    overflow: hidden;

    box-sizing: border-box;

    opacity: 1 !important;

    visibility: visible;

    filter: none !important;

    color: var(--department-text);

    background: #FFFFFF !important;

    border: 1px solid #E5E7EB;

    border-top: 3px solid var(--department-purple);

    border-radius: 16px;

    box-shadow:
        0 20px 50px rgba(17, 17, 17, .18);

    isolation: isolate;

    animation:
        departmentModalShow .22s ease-out;
}


/* =========================================================
   MODAL ANIMATION
========================================================= */

@keyframes departmentModalShow {

    from {

        opacity: 0;

        transform:
            translateY(10px)
            scale(.98);

    }

    to {

        opacity: 1;

        transform:
            translateY(0)
            scale(1);

    }

}


/* =========================================================
   HEADER
========================================================= */

.department-modal-header {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 1.5rem;

    width: 100%;

    padding: 1.65rem 2rem;

    box-sizing: border-box;

    opacity: 1 !important;

    filter: none !important;

    color: var(--department-text);

    background:
        linear-gradient(
            135deg,
            #FFFFFF 0%,
            #FAF9FF 100%
        ) !important;

    border-bottom:
        1px solid var(--department-border-light);

}


/* =========================================================
   HEADER CONTENT
========================================================= */

.department-modal-heading {

    position: relative;

    z-index: 2;

    min-width: 0;

    flex: 1;

}


/* =========================================================
   OVERLINE
========================================================= */

.department-modal-overline {

    display: block;

    margin-bottom: .4rem;

    color:
        var(--department-purple) !important;

    font-size: .62rem;

    font-weight: 900;

    letter-spacing: .14em;

    line-height: 1.4;

    text-transform: uppercase;

}


/* =========================================================
   TITLE
========================================================= */

.department-modal-title {

    margin: 0;

    color:
        var(--department-text) !important;

    font-size: 1.4rem;

    font-weight: 900;

    letter-spacing: -.025em;

    line-height: 1.25;

}


/* =========================================================
   DESCRIPTION
========================================================= */

.department-modal-description {

    margin: .45rem 0 0;

    color:
        var(--department-text-muted) !important;

    font-size: .8rem;

    line-height: 1.5;

}


/* =========================================================
   CLOSE BUTTON
========================================================= */

.department-modal-close {

    position: relative;

    z-index: 3;

    display: flex;

    align-items: center;

    justify-content: center;

    width: 36px;

    height: 36px;

    flex-shrink: 0;

    padding: 0;

    color:
        var(--department-text-muted);

    background:
        transparent !important;

    border:
        1px solid transparent;

    border-radius: 8px;

    font-size: .82rem;

    cursor: pointer;

    opacity: 1 !important;

    filter: none !important;

    transition:
        background-color .2s ease,
        color .2s ease,
        border-color .2s ease,
        transform .2s ease;

}


.department-modal-close:hover {

    color:
        var(--department-purple);

    background:
        var(--department-purple-light) !important;

    border-color:
        #DDD6FE;

    transform:
        rotate(90deg);

}


/* =========================================================
   FORM
========================================================= */

.department-modal-container form {

    position: relative;

    z-index: 2;

    margin: 0;

    padding: 0;

    opacity: 1 !important;

    filter: none !important;

}


/* =========================================================
   BODY
========================================================= */

.department-modal-body {

    position: relative;

    z-index: 2;

    width: 100%;

    padding: 1.85rem 2rem;

    box-sizing: border-box;

    opacity: 1 !important;

    filter: none !important;

    color:
        var(--department-text);

    background:
        #FFFFFF !important;

}


/* =========================================================
   FORM GROUP
========================================================= */

.department-form-group {

    width: 100%;

}


/* =========================================================
   LABEL
========================================================= */

.department-modal-label {

    display: block;

    margin-bottom: .6rem;

    color:
        var(--department-text) !important;

    font-size: .78rem;

    font-weight: 800;

    line-height: 1.4;

}


/* =========================================================
   INPUT
========================================================= */

.department-modal-input {

    display: block;

    width: 100%;

    min-height: 48px;

    box-sizing: border-box;

    padding: .75rem 1rem;

    color:
        var(--department-text) !important;

    background:
        #FFFFFF !important;

    border:
        1px solid #D1D5DB;

    border-radius: 9px;

    outline: none;

    opacity: 1 !important;

    filter: none !important;

    font-family: inherit;

    font-size: .84rem;

    line-height: 1.4;

    transition:
        background-color .2s ease,
        border-color .2s ease,
        box-shadow .2s ease;

}


.department-modal-input::placeholder {

    color:
        #9CA3AF !important;

    opacity:
        1 !important;

}


.department-modal-input:hover {

    border-color:
        #A78BFA;

}


.department-modal-input:focus {

    color:
        var(--department-text) !important;

    background:
        #FFFFFF !important;

    border-color:
        var(--department-purple);

    box-shadow:
        0 0 0 3px rgba(101, 56, 217, .12);

}


/* =========================================================
   ERROR
========================================================= */

.department-modal-error {

    display: flex;

    align-items: center;

    gap: .4rem;

    margin: .6rem 0 0;

    color:
        var(--department-danger);

    font-size: .72rem;

    font-weight: 700;

    line-height: 1.4;

}


/* =========================================================
   FOOTER
========================================================= */

.department-modal-footer {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: flex-end;

    gap: .7rem;

    width: 100%;

    padding: 1.15rem 2rem;

    box-sizing: border-box;

    opacity: 1 !important;

    filter: none !important;

    background:
        #FAFAFA !important;

    border-top:
        1px solid var(--department-border-light);

}


/* =========================================================
   BUTTON BASE
========================================================= */

.department-modal-cancel,
.department-modal-submit {

    position: relative;

    z-index: 3;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: .45rem;

    min-height: 41px;

    padding: .58rem 1.05rem;

    border-radius: 8px;

    box-sizing: border-box;

    font-family: inherit;

    font-size: .74rem;

    font-weight: 800;

    line-height: 1;

    cursor: pointer;

    opacity: 1 !important;

    filter: none !important;

    transition:
        background-color .2s ease,
        color .2s ease,
        border-color .2s ease,
        box-shadow .2s ease,
        transform .2s ease;

}


.department-modal-cancel:hover,
.department-modal-submit:hover {

    transform:
        translateY(-1px);

}


.department-modal-cancel:active,
.department-modal-submit:active {

    transform:
        translateY(0);

}


/* =========================================================
   CANCEL BUTTON
========================================================= */

.department-modal-cancel {

    color:
        var(--department-text-secondary);

    background:
        #FFFFFF !important;

    border:
        1px solid #D1D5DB;

}


.department-modal-cancel:hover {

    color:
        var(--department-purple);

    background:
        var(--department-purple-light) !important;

    border-color:
        #C4B5FD;

    box-shadow:
        0 4px 12px rgba(101, 56, 217, .10);

}


/* =========================================================
   CREATE BUTTON
========================================================= */

.department-modal-submit {

    color:
        #FFFFFF !important;

    background:
        var(--department-purple) !important;

    border:
        1px solid var(--department-purple);

    box-shadow:
        0 4px 12px rgba(101, 56, 217, .18);

}


.department-modal-submit:hover {

    color:
        #FFFFFF !important;

    background:
        var(--department-purple-hover) !important;

    border-color:
        var(--department-purple-hover);

    box-shadow:
        0 6px 16px rgba(101, 56, 217, .22);

}


/* =========================================================
   BUTTON ICONS
========================================================= */

.department-modal-cancel i,
.department-modal-submit i {

    font-size: .82rem;

    line-height: 1;

}


/* =========================================================
   DARK MODE
========================================================= */

[data-bs-theme="dark"] .department-modal {

    --department-purple:
        #7C5CE3;

    --department-purple-hover:
        #9278EA;

    --department-purple-light:
        #292342;

    --department-purple-soft:
        #342C52;

    --department-text:
        #FFFFFF;

    --department-text-secondary:
        #D5D8E8;

    --department-text-muted:
        #999FB9;

    --department-border:
        #292E45;

    --department-border-light:
        #292E45;

    background:
        rgba(0, 0, 0, .72);

}


/* =========================================================
   DARK CONTAINER
========================================================= */

[data-bs-theme="dark"] .department-modal-container {

    opacity: 1 !important;

    filter: none !important;

    color:
        #FFFFFF;

    background:
        #181D33 !important;

    border-color:
        #292E45;

    border-top-color:
        #7C5CE3;

    box-shadow:
        0 25px 60px rgba(0, 0, 0, .60);

}


/* =========================================================
   DARK HEADER
========================================================= */

[data-bs-theme="dark"] .department-modal-header {

    opacity: 1 !important;

    filter: none !important;

    color:
        #FFFFFF;

    background:
        linear-gradient(
            135deg,
            #181D33 0%,
            #161A2E 100%
        ) !important;

    border-bottom-color:
        #292E45;

}


/* =========================================================
   DARK OVERLINE
========================================================= */

[data-bs-theme="dark"] .department-modal-overline {

    color:
        #A78BFA !important;

}


/* =========================================================
   DARK TITLE
========================================================= */

[data-bs-theme="dark"] .department-modal-title {

    color:
        #FFFFFF !important;

}


/* =========================================================
   DARK DESCRIPTION
========================================================= */

[data-bs-theme="dark"] .department-modal-description {

    color:
        #999FB9 !important;

}


/* =========================================================
   DARK CLOSE
========================================================= */

[data-bs-theme="dark"] .department-modal-close {

    color:
        #999FB9;

    background:
        transparent !important;

}


[data-bs-theme="dark"] .department-modal-close:hover {

    color:
        #C4B5FD;

    background:
        #292342 !important;

    border-color:
        #403765;

}


/* =========================================================
   DARK BODY
========================================================= */

[data-bs-theme="dark"] .department-modal-body {

    opacity: 1 !important;

    filter: none !important;

    color:
        #FFFFFF;

    background:
        #181D33 !important;

}


/* =========================================================
   DARK LABEL
========================================================= */

[data-bs-theme="dark"] .department-modal-label {

    color:
        #FFFFFF !important;

}


/* =========================================================
   DARK INPUT
========================================================= */

[data-bs-theme="dark"] .department-modal-input {

    color:
        #FFFFFF !important;

    background:
        #20253A !important;

    border-color:
        #292E45;

}


[data-bs-theme="dark"] .department-modal-input::placeholder {

    color:
        #777E99 !important;

}


[data-bs-theme="dark"] .department-modal-input:hover {

    border-color:
        #7C5CE3;

}


[data-bs-theme="dark"] .department-modal-input:focus {

    color:
        #FFFFFF !important;

    background:
        #20253A !important;

    border-color:
        #7C5CE3;

    box-shadow:
        0 0 0 3px rgba(124, 92, 227, .18);

}


/* =========================================================
   DARK FOOTER
========================================================= */

[data-bs-theme="dark"] .department-modal-footer {

    opacity: 1 !important;

    filter: none !important;

    background:
        #101426 !important;

    border-top-color:
        #292E45;

}


/* =========================================================
   DARK CANCEL
========================================================= */

[data-bs-theme="dark"] .department-modal-cancel {

    color:
        #D5D8E8;

    background:
        #181D33 !important;

    border-color:
        #414760;

}


[data-bs-theme="dark"] .department-modal-cancel:hover {

    color:
        #FFFFFF;

    background:
        #292342 !important;

    border-color:
        #7C5CE3;

}


/* =========================================================
   DARK CREATE
========================================================= */

[data-bs-theme="dark"] .department-modal-submit {

    color:
        #FFFFFF !important;

    background:
        #7C5CE3 !important;

    border-color:
        #7C5CE3;

    box-shadow:
        0 4px 12px rgba(124, 92, 227, .22);

}


[data-bs-theme="dark"] .department-modal-submit:hover {

    color:
        #FFFFFF !important;

    background:
        #9278EA !important;

    border-color:
        #9278EA;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 600px) {

    .department-modal {

        padding:
            1rem;

    }


    .department-modal-container {

        max-width:
            100%;

        border-radius:
            13px;

    }


    .department-modal-header {

        padding:
            1.35rem;

    }


    .department-modal-body {

        padding:
            1.35rem;

    }


    .department-modal-footer {

        padding:
            1rem 1.35rem;

    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .department-modal-header {

        gap:
            1rem;

    }


    .department-modal-title {

        font-size:
            1.25rem;

    }


    .department-modal-description {

        font-size:
            .76rem;

    }


    .department-modal-footer {

        flex-direction:
            column-reverse;

        align-items:
            stretch;

    }


    .department-modal-cancel,
    .department-modal-submit {

        width:
            100%;

    }

}


/* =========================================================
   EXTRA SMALL
========================================================= */

@media (max-width: 360px) {

    .department-modal {

        padding:
            .75rem;

    }


    .department-modal-header {

        padding:
            1.15rem;

    }


    .department-modal-body {

        padding:
            1.15rem;

    }


    .department-modal-footer {

        padding:
            .9rem 1.15rem;

    }

}


/* =========================================================
   REDUCED MOTION
========================================================= */

@media (prefers-reduced-motion: reduce) {

    .department-modal *,
    .department-modal *::before,
    .department-modal *::after {

        animation-duration:
            .01ms !important;

        animation-iteration-count:
            1 !important;

        transition-duration:
            .01ms !important;

    }

}

</style>