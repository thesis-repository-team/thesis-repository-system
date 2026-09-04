{{-- DELETE MODAL --}}

<div id="deleteModal" class="hidden department-delete-modal">

    <div class="department-delete-modal-container">

        {{-- =====================================================
             MODAL HEADER
        ====================================================== --}}

        <div class="department-delete-modal-header">

            <div class="department-delete-modal-heading">

                <span class="department-delete-modal-overline">
                    DEPARTMENT MANAGEMENT
                </span>

                <h3 class="department-delete-modal-title">
                    Delete Department
                </h3>

                <p class="department-delete-modal-description">
                    This action cannot be undone.
                </p>

            </div>


            {{-- Close Button --}}
            <button
                type="button"
                onclick="closeDeleteModal()"
                class="department-delete-modal-close"
                aria-label="Close">

                <i class="bi bi-x-lg"></i>

            </button>

        </div>


        {{-- =====================================================
             DELETE CONTENT
        ====================================================== --}}

        <div class="department-delete-modal-body">

            <div class="department-delete-warning">

                {{-- Warning Icon --}}
                <div class="department-delete-warning-icon">

                    <i class="bi bi-exclamation-triangle"></i>

                </div>


                {{-- Message --}}
                <div class="department-delete-warning-content">

                    <p class="department-delete-message">

                        Are you sure you want to delete
                        <strong id="deleteDepartmentName"></strong>?

                    </p>

                    <p class="department-delete-description">

                        All data associated with this department may be affected.

                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
             MODAL FOOTER
        ====================================================== --}}

        <div class="department-delete-modal-footer">

            {{-- Cancel --}}
            <button
                type="button"
                onclick="closeDeleteModal()"
                class="department-delete-cancel">

                <i class="bi bi-x-circle"></i>

                <span>Cancel</span>

            </button>


            {{-- Delete Form --}}
            <form
                id="deleteDepartmentForm"
                method="POST"
                action="{{ route('admin.departments.destroy', ['department' => '__ID__']) }}">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="department-delete-submit">

                    <i class="bi bi-trash"></i>

                    <span>Delete</span>

                </button>

            </form>

        </div>

    </div>

</div>


<style>

/* =========================================================
   DELETE DEPARTMENT MODAL
========================================================= */

.department-delete-modal {
    position: fixed;
    inset: 0;

    z-index: 5000;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 1.5rem;

    box-sizing: border-box;

    background: rgba(0, 0, 0, .72);

    backdrop-filter: blur(5px);
}


.department-delete-modal.hidden {
    display: none !important;
}


/* =========================================================
   MODAL CONTAINER
========================================================= */

.department-delete-modal-container {
    width: 100%;
    max-width: 560px;

    overflow: hidden;

    box-sizing: border-box;

    background: var(--department-card-bg);

    color: var(--department-text);

    border: 1px solid var(--department-border-soft);

    border-radius: 16px;

    box-shadow:
        0 20px 60px rgba(0, 0, 0, .20);

    transition:
        background-color .25s ease,
        color .25s ease,
        border-color .25s ease,
        box-shadow .25s ease;
}


/* =========================================================
   HEADER
========================================================= */

.department-delete-modal-header {
    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 1.5rem;

    padding: 1.75rem 2rem;

    background: var(--department-card-bg);

    border-bottom:
        1px solid var(--department-border-soft);
}


.department-delete-modal-heading {
    min-width: 0;
}


.department-delete-modal-overline {
    display: block;

    margin-bottom: .45rem;

    color: var(--department-text-muted);

    font-size: .68rem;

    font-weight: 700;

    letter-spacing: .14em;

    text-transform: uppercase;
}


.department-delete-modal-title {
    margin: 0;

    color: var(--department-text);

    font-size: 1.45rem;

    font-weight: 800;

    letter-spacing: -.025em;

    line-height: 1.25;
}


.department-delete-modal-description {
    margin: .5rem 0 0;

    color: var(--department-text-muted);

    font-size: .82rem;

    line-height: 1.5;
}


/* =========================================================
   CLOSE BUTTON
========================================================= */

.department-delete-modal-close {
    display: flex;

    align-items: center;

    justify-content: center;

    width: 36px;

    height: 36px;

    flex-shrink: 0;

    padding: 0;

    border: 0;

    border-radius: 7px;

    background: transparent;

    color: var(--department-text-muted);

    font-size: .9rem;

    cursor: pointer;

    transition:
        background-color .2s ease,
        color .2s ease,
        transform .2s ease;
}


.department-delete-modal-close:hover {
    background: var(--department-input-bg);

    color: var(--department-text);

    transform: translateY(-1px);
}


/* =========================================================
   BODY
========================================================= */

.department-delete-modal-body {
    padding: 2rem;
}


.department-delete-warning {
    display: flex;

    align-items: flex-start;

    gap: 1rem;
}


/* =========================================================
   WARNING ICON
========================================================= */

.department-delete-warning-icon {
    display: flex;

    align-items: center;

    justify-content: center;

    width: 44px;

    height: 44px;

    flex-shrink: 0;

    border-radius: 50%;

    background: rgba(220, 38, 38, .10);

    color: var(--department-red);

    font-size: 1.15rem;
}


/* =========================================================
   WARNING CONTENT
========================================================= */

.department-delete-warning-content {
    min-width: 0;
}


.department-delete-message {
    margin: 0;

    color: var(--department-text);

    font-size: .88rem;

    line-height: 1.55;
}


.department-delete-message strong {
    color: var(--department-text);

    font-weight: 700;
}


.department-delete-description {
    margin: .5rem 0 0;

    color: var(--department-text-muted);

    font-size: .78rem;

    line-height: 1.5;
}


/* =========================================================
   FOOTER
========================================================= */

.department-delete-modal-footer {
    display: flex;

    align-items: center;

    justify-content: flex-end;

    gap: .75rem;

    padding: 1.25rem 2rem;

    background: var(--department-input-bg);

    border-top:
        1px solid var(--department-border-soft);

    transition:
        background-color .25s ease,
        border-color .25s ease;
}


/* =========================================================
   DELETE FORM
========================================================= */

.department-delete-modal-footer form {
    margin: 0;
}


/* =========================================================
   BUTTON BASE
========================================================= */

.department-delete-cancel,
.department-delete-submit {
    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: .45rem;

    min-height: 40px;

    padding: .6rem 1rem;

    border-radius: 7px;

    font-family: inherit;

    font-size: .78rem;

    font-weight: 600;

    cursor: pointer;

    transition:
        transform .2s ease,
        background-color .2s ease,
        color .2s ease,
        border-color .2s ease,
        box-shadow .2s ease;
}


.department-delete-cancel:hover,
.department-delete-submit:hover {
    transform: translateY(-1px);
}


/* =========================================================
   CANCEL BUTTON
   NORMAL
========================================================= */

.department-delete-cancel {
    border:
        1px solid var(--department-red);

    background: transparent;

    color: var(--department-red);
}


/* =========================================================
   CANCEL BUTTON
   HOVER
========================================================= */

.department-delete-cancel:hover {
    background: var(--department-red);

    color: #ffffff;

    border-color: var(--department-red);

    box-shadow:
        0 5px 14px rgba(220, 38, 38, .16);
}


/* =========================================================
   DELETE BUTTON
   NORMAL
========================================================= */

.department-delete-submit {
    border:
        1px solid var(--department-red);

    background: transparent;

    color: var(--department-red);
}


/* =========================================================
   DELETE BUTTON
   HOVER
========================================================= */

.department-delete-submit:hover {
    background: var(--department-red);

    color: #ffffff;

    border-color: var(--department-red);

    box-shadow:
        0 5px 14px rgba(220, 38, 38, .16);
}


/* =========================================================
   DARK MODE
========================================================= */

[data-bs-theme="dark"] .department-delete-modal-container {
    background: #000000;

    color: #ffffff;

    border-color: #333333;

    box-shadow:
        0 20px 60px rgba(0, 0, 0, .60);
}


/* =========================================================
   DARK MODE HEADER
========================================================= */

[data-bs-theme="dark"] .department-delete-modal-header {
    background: #000000;

    border-color: #333333;
}


[data-bs-theme="dark"] .department-delete-modal-title {
    color: #ffffff;
}


[data-bs-theme="dark"] .department-delete-modal-description,
[data-bs-theme="dark"] .department-delete-modal-overline {
    color: #999999;
}


/* =========================================================
   DARK MODE CLOSE
========================================================= */

[data-bs-theme="dark"] .department-delete-modal-close {
    color: #999999;
}


[data-bs-theme="dark"] .department-delete-modal-close:hover {
    background: #0d0d0d;

    color: #ffffff;
}


/* =========================================================
   DARK MODE BODY
========================================================= */

[data-bs-theme="dark"] .department-delete-warning-icon {
    background: rgba(220, 38, 38, .12);

    color: #dc2626;
}


[data-bs-theme="dark"] .department-delete-message {
    color: #ffffff;
}


[data-bs-theme="dark"] .department-delete-message strong {
    color: #ffffff;
}


[data-bs-theme="dark"] .department-delete-description {
    color: #999999;
}


/* =========================================================
   DARK MODE FOOTER
========================================================= */

[data-bs-theme="dark"] .department-delete-modal-footer {
    background: #0d0d0d;

    border-color: #333333;
}


/* =========================================================
   DARK MODE CANCEL
========================================================= */

[data-bs-theme="dark"] .department-delete-cancel {
    background: #000000;

    color: #dc2626;

    border-color: #dc2626;
}


[data-bs-theme="dark"] .department-delete-cancel:hover {
    background: #dc2626;

    color: #ffffff;

    border-color: #dc2626;

    box-shadow:
        0 5px 14px rgba(220, 38, 38, .20);
}


/* =========================================================
   DARK MODE DELETE
========================================================= */

[data-bs-theme="dark"] .department-delete-submit {
    background: #000000;

    color: #dc2626;

    border-color: #dc2626;
}


[data-bs-theme="dark"] .department-delete-submit:hover {
    background: #dc2626;

    color: #ffffff;

    border-color: #dc2626;

    box-shadow:
        0 5px 14px rgba(220, 38, 38, .25);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 600px) {

    .department-delete-modal {
        padding: 1rem;
    }


    .department-delete-modal-container {
        max-width: 100%;

        border-radius: 12px;
    }


    .department-delete-modal-header {
        padding: 1.35rem;
    }


    .department-delete-modal-body {
        padding: 1.35rem;
    }


    .department-delete-modal-footer {
        padding: 1rem 1.35rem;
    }

}


@media (max-width: 480px) {

    .department-delete-modal-footer {
        flex-direction: column-reverse;

        align-items: stretch;
    }


    .department-delete-cancel,
    .department-delete-submit {
        width: 100%;
    }


    .department-delete-modal-footer form {
        width: 100%;
    }

}

</style>