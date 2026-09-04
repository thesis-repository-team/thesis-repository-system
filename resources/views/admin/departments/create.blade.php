{{-- CREATE MODAL --}}

<div id="createModal" class="hidden department-modal">

```
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

        <button
            type="button"
            onclick="closeCreateModal()"
            class="department-modal-close"
            aria-label="Close">

            <i class="bi bi-x-lg"></i>

        </button>

    </div>


    {{-- Create Form --}}
    <form method="POST"
          action="{{ route('admin.departments.store') }}">

        @csrf

        {{-- Modal Body --}}
        <div class="department-modal-body">

            <div class="department-form-group">

                <label
                    for="createDepartmentName"
                    class="department-modal-label">

                    Department Name

                </label>

                <input
                    type="text"
                    id="createDepartmentName"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter department name"
                    class="department-modal-input"
                    autocomplete="off"
                >

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

            <button
                type="button"
                onclick="closeCreateModal()"
                class="department-modal-cancel">

                <i class="bi bi-x-circle"></i>

                <span>Cancel</span>

            </button>


            <button
                type="submit"
                class="department-modal-submit">

                <i class="bi bi-plus-lg"></i>

                <span>Create Department</span>

            </button>

        </div>

    </form>

</div>
```

</div>

<style>

/* =========================================================
   CREATE DEPARTMENT MODAL
========================================================= */

.department-modal {
    position: fixed;
    inset: 0;

    z-index: 5000;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 1.5rem;

    background: rgba(0, 0, 0, .72);

    backdrop-filter: blur(5px);

    box-sizing: border-box;
}


/* =========================================================
   HIDDEN
========================================================= */

.department-modal.hidden {
    display: none !important;
}


/* =========================================================
   MODAL CARD
========================================================= */

.department-modal-container {
    width: 100%;
    max-width: 560px;

    overflow: hidden;

    border:
        1px solid var(--department-border-soft);

    border-radius: 16px;

    background:
        var(--department-card-bg);

    color:
        var(--department-text);

    box-shadow:
        0 20px 60px rgba(0, 0, 0, .20);

    transform: translateY(0);

    transition:
        background-color .25s ease,
        color .25s ease,
        border-color .25s ease,
        box-shadow .25s ease;
}


/* =========================================================
   HEADER
========================================================= */

.department-modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;

    gap: 1.5rem;

    padding: 1.75rem 2rem;

    border-bottom:
        1px solid var(--department-border-soft);

    background:
        var(--department-card-bg);
}


.department-modal-heading {
    min-width: 0;
}


.department-modal-overline {
    display: block;

    margin-bottom: .45rem;

    color:
        var(--department-text-muted);

    font-size: .68rem;
    font-weight: 700;

    letter-spacing: .14em;
    text-transform: uppercase;
}


.department-modal-title {
    margin: 0;

    color:
        var(--department-text);

    font-size: 1.45rem;
    font-weight: 800;

    letter-spacing: -.025em;

    line-height: 1.25;
}


.department-modal-description {
    margin: .5rem 0 0;

    color:
        var(--department-text-muted);

    font-size: .82rem;

    line-height: 1.5;
}


/* =========================================================
   CLOSE BUTTON
========================================================= */

.department-modal-close {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 36px;
    height: 36px;

    flex-shrink: 0;

    padding: 0;

    border: 0;
    border-radius: 7px;

    background:
        transparent;

    color:
        var(--department-text-muted);

    font-size: .9rem;

    cursor: pointer;

    transition:
        background-color .2s ease,
        color .2s ease;
}


.department-modal-close:hover {
    background:
        var(--department-input-bg);

    color:
        var(--department-text);
}


/* =========================================================
   BODY
========================================================= */

.department-modal-body {
    padding: 2rem;
}


.department-form-group {
    width: 100%;
}


.department-modal-label {
    display: block;

    margin-bottom: .65rem;

    color:
        var(--department-text);

    font-size: .82rem;
    font-weight: 700;
}


.department-modal-input {
    display: block;

    width: 100%;

    min-height: 48px;

    box-sizing: border-box;

    padding: .75rem 1rem;

    border:
        1px solid var(--department-border-soft);

    border-radius: 8px;

    outline: none;

    background:
        var(--department-input-bg);

    color:
        var(--department-text);

    font-family: inherit;

    font-size: .85rem;

    transition:
        background-color .25s ease,
        color .25s ease,
        border-color .2s ease,
        box-shadow .2s ease;
}


.department-modal-input::placeholder {
    color:
        var(--department-text-muted);
}


.department-modal-input:hover {
    border-color:
        var(--department-text-muted);
}


.department-modal-input:focus {
    border-color:
        var(--department-blue);

    box-shadow:
        0 0 0 3px rgba(37, 99, 235, .12);
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
        var(--department-red);

    font-size: .75rem;
    font-weight: 500;
}


/* =========================================================
   FOOTER
========================================================= */

.department-modal-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: .75rem;

    padding: 1.25rem 2rem;

    border-top:
        1px solid var(--department-border-soft);

    background:
        var(--department-input-bg);

    transition:
        background-color .25s ease,
        border-color .25s ease;
}


/* =========================================================
   BUTTON BASE
========================================================= */

.department-modal-cancel,
.department-modal-submit {
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


.department-modal-cancel:hover,
.department-modal-submit:hover {
    transform: translateY(-1px);
}


/* =========================================================
   CANCEL — RED
========================================================= */

.department-modal-cancel {
    border:
        1px solid var(--department-red);

    background:
        transparent;

    color:
        var(--department-red);
}


.department-modal-cancel:hover {
    background:
        var(--department-red);

    color:
        #ffffff;

    border-color:
        var(--department-red);

    box-shadow:
        0 5px 14px rgba(220, 38, 38, .16);
}


/* =========================================================
   CREATE — BLUE
========================================================= */

.department-modal-submit {
    border:
        1px solid var(--department-blue);

    background:
        var(--department-blue);

    color:
        #ffffff;
}


.department-modal-submit:hover {
    background:
        #ffffff;

    color:
        var(--department-blue);

    border-color:
        var(--department-blue);

    box-shadow:
        0 5px 14px rgba(37, 99, 235, .16);
}


/* =========================================================
   DARK MODE
========================================================= */

[data-bs-theme="dark"] .department-modal-container {
    background:
        #000000;

    color:
        #ffffff;

    border-color:
        #333333;

    box-shadow:
        0 20px 60px rgba(0, 0, 0, .60);
}


[data-bs-theme="dark"] .department-modal-header {
    background:
        #000000;

    border-color:
        #333333;
}


[data-bs-theme="dark"] .department-modal-title {
    color:
        #ffffff;
}


[data-bs-theme="dark"] .department-modal-description {
    color:
        #999999;
}


[data-bs-theme="dark"] .department-modal-overline {
    color:
        #999999;
}


[data-bs-theme="dark"] .department-modal-close {
    color:
        #999999;
}


[data-bs-theme="dark"] .department-modal-close:hover {
    background:
        #0d0d0d;

    color:
        #ffffff;
}


[data-bs-theme="dark"] .department-modal-input {
    background:
        #0d0d0d;

    color:
        #ffffff;

    border-color:
        #333333;
}


[data-bs-theme="dark"] .department-modal-input:hover {
    border-color:
        #666666;
}


[data-bs-theme="dark"] .department-modal-input:focus {
    background:
        #0d0d0d;

    color:
        #ffffff;

    border-color:
        #2563eb;

    box-shadow:
        0 0 0 3px rgba(37, 99, 235, .18);
}


[data-bs-theme="dark"] .department-modal-footer {
    background:
        #0d0d0d;

    border-color:
        #333333;
}


/* =========================================================
   DARK MODE — CANCEL
========================================================= */

[data-bs-theme="dark"] .department-modal-cancel {
    background:
        #000000;

    color:
        #dc2626;

    border-color:
        #dc2626;
}


[data-bs-theme="dark"] .department-modal-cancel:hover {
    background:
        #dc2626;

    color:
        #ffffff;

    border-color:
        #dc2626;
}


/* =========================================================
   DARK MODE — CREATE
========================================================= */

[data-bs-theme="dark"] .department-modal-submit {
    background:
        #2563eb;

    color:
        #ffffff;

    border-color:
        #2563eb;
}


[data-bs-theme="dark"] .department-modal-submit:hover {
    background:
        #ffffff;

    color:
        #2563eb;

    border-color:
        #2563eb;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 600px) {

    .department-modal {
        padding: 1rem;
    }

    .department-modal-container {
        max-width: 100%;
        border-radius: 12px;
    }

    .department-modal-header {
        padding: 1.35rem;
    }

    .department-modal-body {
        padding: 1.35rem;
    }

    .department-modal-footer {
        padding: 1rem 1.35rem;
    }

}


@media (max-width: 480px) {

    .department-modal-footer {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .department-modal-cancel,
    .department-modal-submit {
        width: 100%;
    }

}

</style>
