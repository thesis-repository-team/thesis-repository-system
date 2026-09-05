<x-app-layout>

```
<div class="student-edit-wrapper">

    <div class="student-edit-card">

        {{-- Header --}}
        <div class="student-edit-header">

            <div>

                <span class="student-edit-overline">
                    MANAGEMENT
                </span>

                <h2 class="student-edit-title">
                    Edit Student
                </h2>

                <p class="student-edit-description">
                    Update the student account information.
                </p>

            </div>

        </div>


        {{-- Form --}}
        <form
            action="{{ route('admin.students.update', $student->id) }}"
            method="POST"
            class="student-edit-form">

            @csrf
            @method('PUT')


            {{-- Full Name --}}
            <div class="student-form-group">

                <label
                    for="full_name"
                    class="student-form-label">

                    Full Name

                </label>

                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    value="{{ old('full_name', $student->full_name) }}"
                    class="student-form-control @error('full_name') is-invalid @enderror"
                    placeholder="Enter full name"
                    required>

                @error('full_name')

                    <div class="student-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Email --}}
            <div class="student-form-group">

                <label
                    for="email"
                    class="student-form-label">

                    Email

                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $student->user->email ?? '') }}"
                    class="student-form-control @error('email') is-invalid @enderror"
                    placeholder="Enter email address"
                    required>

                @error('email')

                    <div class="student-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Username --}}
            <div class="student-form-group">

                <label
                    for="username"
                    class="student-form-label">

                    Username

                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username', $student->user->username ?? '') }}"
                    class="student-form-control @error('username') is-invalid @enderror"
                    placeholder="Enter username"
                    required>

                @error('username')

                    <div class="student-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Upload Permission --}}
            <div class="student-form-group">

                <label
                    for="upload_permission"
                    class="student-form-label">

                    Upload Permission

                </label>

                <select
                    id="upload_permission"
                    name="upload_permission"
                    class="student-form-control student-form-select @error('upload_permission') is-invalid @enderror"
                    required>

                    <option
                        value="1"
                        {{ old('upload_permission', $student->upload_permission) == '1' ? 'selected' : '' }}>

                        Allowed

                    </option>

                    <option
                        value="0"
                        {{ old('upload_permission', $student->upload_permission) == '0' ? 'selected' : '' }}>

                        Not Allowed

                    </option>

                </select>

                @error('upload_permission')

                    <div class="student-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Actions --}}
            <div class="student-form-actions">

                <a
                    href="{{ route('admin.students.index') }}"
                    class="student-cancel-button">

                    <i class="bi bi-x-lg"></i>

                    Cancel

                </a>


                <button
                    type="submit"
                    class="student-save-button">

                    <i class="bi bi-check-lg"></i>

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</div>


<style>

    :root {

        --student-blue: #2563eb;
        --student-blue-hover: #1d4ed8;

        --student-red: #dc2626;
        --student-red-hover: #b91c1c;

        --student-black: #000000;
        --student-white: #ffffff;

        --student-page-bg: #ffffff;
        --student-card-bg: #ffffff;

        --student-input-bg: #fafafa;

        --student-text: #000000;
        --student-text-secondary: #000000;
        --student-text-muted: #000000;

        --student-border: #dddddd;
        --student-border-soft: #eeeeee;

        --student-placeholder: #999999;

        --student-shadow:
            0 4px 18px rgba(0, 0, 0, .06);

    }


    /* =========================================================
       DARK MODE
    ========================================================== */

    [data-bs-theme="dark"] {

        --student-page-bg: #101426;

        --student-card-bg: #181d33;

        --student-input-bg: #20253a;

        --student-text: #ffffff;

        --student-text-secondary: #eeeef8;

        --student-text-muted: #999fb9;

        --student-border: #343a52;

        --student-border-soft: #292e45;

        --student-placeholder: #777f9c;

        --student-shadow:
            0 4px 18px rgba(0, 0, 0, .30);

    }


    /* =========================================================
       PAGE
    ========================================================== */

    .student-edit-wrapper {

        margin-left: 250px;

        width: calc(100% - 250px);

        padding-top: 118px;
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 30px;

        box-sizing: border-box;

        overflow-x: hidden;

        color: var(--student-text);

        background: var(--student-page-bg);

        transition:
            background-color .25s ease,
            color .25s ease;

    }


    /* =========================================================
       CARD
    ========================================================== */

    .student-edit-card {

        width: 100%;

        max-width: none;

        margin: 0;

        background: var(--student-card-bg);

        color: var(--student-text);

        border:
            1px solid var(--student-border-soft);

        border-radius: 12px;

        box-shadow: var(--student-shadow);

        overflow: hidden;

        box-sizing: border-box;

        transition:
            background-color .25s ease,
            color .25s ease,
            border-color .25s ease,
            box-shadow .25s ease;

    }


    /* =========================================================
       HEADER
    ========================================================== */

    .student-edit-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        width: 100%;

        padding: 1.4rem 1.5rem;

        background: var(--student-card-bg);

        border-bottom:
            1px solid var(--student-border-soft);

        box-sizing: border-box;

    }


    .student-edit-overline {

        display: block;

        margin-bottom: .25rem;

        color: var(--student-text);

        font-size: .65rem;

        font-weight: 800;

        letter-spacing: .1em;

        text-transform: uppercase;

    }


    .student-edit-title {

        margin: 0;

        color: var(--student-text);

        font-size: 1.25rem;

        font-weight: 800;

        line-height: 1.3;

    }


    .student-edit-description {

        margin: .35rem 0 0;

        color: var(--student-text-muted);

        font-size: .78rem;

        line-height: 1.5;

    }


    /* =========================================================
       FORM
    ========================================================== */

    .student-edit-form {

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 1.15rem 1.25rem;

        width: 100%;

        padding: 1.5rem;

        background: var(--student-card-bg);

        box-sizing: border-box;

    }


    /* =========================================================
       FORM GROUP
    ========================================================== */

    .student-form-group {

        min-width: 0;

        width: 100%;

        box-sizing: border-box;

    }


    /* =========================================================
       LABEL
    ========================================================== */

    .student-form-label {

        display: block;

        margin-bottom: .45rem;

        color: var(--student-text-secondary);

        font-size: .68rem;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .05em;

    }


    /* =========================================================
       INPUTS
    ========================================================== */

    .student-form-control {

        display: block;

        width: 100%;

        max-width: 100%;

        min-width: 0;

        height: 45px;

        padding: .55rem .85rem;

        color: var(--student-text);

        background: var(--student-input-bg);

        border:
            1px solid var(--student-border-soft);

        border-radius: 8px;

        outline: none;

        font-family: inherit;

        font-size: .82rem;

        box-sizing: border-box;

        transition:
            background-color .2s ease,
            color .2s ease,
            border-color .2s ease,
            box-shadow .2s ease;

    }


    .student-form-control:hover {

        border-color: var(--student-border);

    }


    .student-form-control::placeholder {

        color: var(--student-placeholder);

        opacity: 1;

    }


    .student-form-control:focus {

        color: var(--student-text);

        background: var(--student-input-bg);

        border-color: var(--student-blue);

        box-shadow:
            0 0 0 3px
            rgba(37, 99, 235, .10);

    }


    /* =========================================================
       INVALID
    ========================================================== */

    .student-form-control.is-invalid {

        border-color: var(--student-red);

        box-shadow: none;

    }


    /* =========================================================
       SELECT
    ========================================================== */

    .student-form-select {

        cursor: pointer;

    }


    .student-form-select option {

        color: #000000;

        background: #ffffff;

    }


    [data-bs-theme="dark"]
    .student-form-select option {

        color: #ffffff;

        background: #181d33;

    }


    /* =========================================================
       ERRORS
    ========================================================== */

    .student-error {

        margin-top: .35rem;

        color: var(--student-red) !important;

        font-size: .7rem;

        font-weight: 600;

        line-height: 1.4;

    }


    /* =========================================================
       ACTIONS
    ========================================================== */

    .student-form-actions {

        grid-column: 1 / -1;

        display: flex;

        align-items: center;

        justify-content: flex-end;

        gap: .6rem;

        width: 100%;

        padding-top: 1rem;

        border-top:
            1px solid var(--student-border-soft);

        box-sizing: border-box;

    }


    /* =========================================================
       BUTTONS
    ========================================================== */

    .student-cancel-button,
    .student-save-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: .4rem;

        min-height: 42px;

        padding: .65rem 1rem;

        border-radius: 8px;

        font-size: .7rem;

        font-weight: 800;

        text-transform: uppercase;

        text-decoration: none;

        cursor: pointer;

        box-sizing: border-box;

        transition:
            background-color .2s ease,
            color .2s ease,
            border-color .2s ease,
            transform .2s ease;

    }


    /* =========================================================
       CANCEL
    ========================================================== */

    .student-cancel-button {

        color: #ffffff !important;

        background: var(--student-red);

        border:
            1px solid var(--student-red);

    }


    .student-cancel-button:hover {

        color: #ffffff !important;

        background: var(--student-red-hover);

        border-color: var(--student-red-hover);

        transform:
            translateY(-1px);

    }


    /* =========================================================
       SAVE
    ========================================================== */

    .student-save-button {

        color: #ffffff !important;

        background: var(--student-blue);

        border:
            1px solid var(--student-blue);

    }


    .student-save-button:hover {

        color: #ffffff !important;

        background: var(--student-blue-hover);

        border-color: var(--student-blue-hover);

        transform:
            translateY(-1px);

    }


    .student-save-button i,
    .student-cancel-button i {

        color: #ffffff !important;

        font-size: .85rem;

    }


    /* =========================================================
       TABLET
    ========================================================== */

    @media (max-width: 1000px) {

        .student-edit-wrapper {

            margin-left: 250px;

            width: calc(100% - 250px);

            padding-left: 15px;

            padding-right: 15px;

        }

    }


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 767.98px) {

        .student-edit-wrapper {

            width: 100%;

            margin-left: 0;

            padding-top: 90px;

            padding-left: 10px;

            padding-right: 10px;

            padding-bottom: 20px;

            overflow-x: hidden;

        }


        .student-edit-card {

            width: 100%;

            max-width: 100%;

            margin: 0;

        }


        .student-edit-header {

            padding: 1rem;

        }


        .student-edit-title {

            font-size: 1.1rem;

        }


        .student-edit-description {

            font-size: .72rem;

        }


        .student-edit-form {

            grid-template-columns: 1fr;

            gap: 1rem;

            padding: 1rem;

        }


        .student-form-actions {

            flex-direction: column-reverse;

            align-items: stretch;

        }


        .student-cancel-button,
        .student-save-button {

            width: 100%;

            text-align: center;

        }

    }


    /* =========================================================
       SMALL MOBILE
    ========================================================== */

    @media (max-width: 575.98px) {

        .student-edit-wrapper {

            padding-top: 85px;

            padding-left: 8px;

            padding-right: 8px;

        }


        .student-edit-header {

            padding: .9rem;

        }


        .student-edit-form {

            padding: .9rem;

        }


        .student-edit-title {

            font-size: 1.05rem;

        }


        .student-edit-description {

            font-size: .7rem;

        }


        .student-form-control {

            height: 44px;

            font-size: .8rem;

        }

    }


    /* =========================================================
       REDUCED MOTION
    ========================================================== */

    @media (prefers-reduced-motion: reduce) {

        .student-edit-wrapper *,
        .student-edit-wrapper *::before,
        .student-edit-wrapper *::after {

            transition: none !important;

            animation: none !important;

        }

    }

</style>
```

</x-app-layout>
