<x-app-layout>

    <div class="student-edit-wrapper">

        <div class="student-edit-card">

            {{-- =================================================
            FORM HEADER
            ================================================== --}}

            <div class="student-edit-header">

                <div>

                    <span class="student-edit-overline">
                        MANAGEMENT
                    </span>

                    <h2 class="student-edit-title">
                        Edit Student
                    </h2>

                    <p class="student-edit-description">
                        Update the student account information and upload permission.
                    </p>

                </div>

            </div>


            {{-- =================================================
            FORM
            ================================================== --}}

            <form action="{{ route('hod.students.update', $student->id) }}"
                  method="POST"
                  class="student-edit-form">

                @csrf
                @method('PUT')


                {{-- FULL NAME --}}

                <div class="student-form-group">

                    <label for="full_name" class="student-form-label">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        value="{{ old('full_name', $student->full_name) }}"
                        class="student-form-control @error('full_name') is-invalid @enderror"
                        placeholder="Enter full name"
                        required
                    >

                    @error('full_name')
                        <div class="student-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- EMAIL --}}

                <div class="student-form-group">

                    <label for="email" class="student-form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $student->user->email) }}"
                        class="student-form-control @error('email') is-invalid @enderror"
                        placeholder="Enter email address"
                        required
                    >

                    @error('email')
                        <div class="student-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- USERNAME --}}

                <div class="student-form-group">

                    <label for="username" class="student-form-label">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username', $student->user->username) }}"
                        class="student-form-control @error('username') is-invalid @enderror"
                        placeholder="Enter username"
                        required
                    >

                    @error('username')
                        <div class="student-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- UPLOAD PERMISSION --}}

                <div class="student-form-group">

                    <label for="upload_permission" class="student-form-label">
                        Upload Permission
                    </label>

                    <select
                        id="upload_permission"
                        name="upload_permission"
                        class="student-form-control student-form-select @error('upload_permission') is-invalid @enderror"
                        required
                    >

                        <option value="1"
                            {{ old('upload_permission', $student->upload_permission) == 1 ? 'selected' : '' }}>
                            Allowed
                        </option>

                        <option value="0"
                            {{ old('upload_permission', $student->upload_permission) == 0 ? 'selected' : '' }}>
                            Not Allowed
                        </option>

                    </select>

                    @error('upload_permission')
                        <div class="student-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =================================================
                ACTIONS
                ================================================== --}}

                <div class="student-form-actions">

                    <div class="student-form-note">

                        <i class="bi bi-info-circle"></i>

                        <span>
                            <strong>Upload Permission</strong>
                            controls whether this student can request to upload thesis documents.
                        </span>

                    </div>


                    <div class="student-form-buttons">

                        <a
                            href="{{ route('hod.students.index') }}"
                            class="student-cancel-button"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="student-save-button">
                            Save Student
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <style>

        /* =========================================================
           LIGHT MODE VARIABLES
        ========================================================== */

        :root {

            --student-purple: #6538d9;
            --student-purple-dark: #5428c7;
            --student-purple-light: #f4f0ff;

            --student-red: #dc3545;
            --student-red-dark: #bb2d3b;
            --student-red-light: #fff1f2;

            --student-black: #000000;
            --student-white: #ffffff;

            --student-page-bg: #ffffff;
            --student-card-bg: #ffffff;
            --student-card-bg-soft: #fafafa;

            --student-input-bg: #fafafa;

            --student-text: #000000;
            --student-text-secondary: #333333;
            --student-text-muted: #777777;

            --student-border: #dddddd;
            --student-border-soft: #eeeeee;

            --student-hover: #fafafa;

            --student-primary: #6538d9;
            --student-primary-hover: #5428c7;

            --student-primary-soft: #f4f0ff;
            --student-primary-soft-hover: #eee8ff;

            --student-shadow:
                0 8px 24px rgba(101, 56, 217, .08);

            --student-card-shadow:
                0 4px 18px rgba(101, 56, 217, .08);

        }


        /* =========================================================
           DARK MODE VARIABLES
        ========================================================== */

        [data-bs-theme="dark"] {

            --student-black: #000000;
            --student-white: #FFFFFF;

            --student-page-bg: #101426;
            --student-card-bg: #181D33;
            --student-card-bg-soft: #1C2138;

            --student-input-bg: #20253A;

            --student-text: #FFFFFF;
            --student-text-secondary: #D5D8E8;
            --student-text-muted: #999FB9;

            --student-border: #292E45;
            --student-border-soft: #292E45;

            --student-hover: #20253A;

            --student-primary: #7C5CE3;
            --student-primary-hover: #9278EA;

            --student-primary-soft: #292342;
            --student-primary-soft-hover: #342C52;

            --student-purple: #7C5CE3;
            --student-purple-dark: #9278EA;
            --student-purple-light: #292342;

            --student-red: #dc3545;
            --student-red-dark: #bb2d3b;
            --student-red-light: #3A2027;

            --student-shadow:
                0 8px 24px rgba(0, 0, 0, .35);

            --student-card-shadow:
                0 2px 10px rgba(0, 0, 0, .30);

        }


        /* =========================================================
           PAGE
        ========================================================== */

        .student-edit-wrapper {

            margin-left: 250px;

            width: 86%;

            padding-top: 130px;

            padding-left: 30px;

            padding-right: 40px;

            padding-bottom: 40px;

            box-sizing: border-box;

            overflow-x: hidden;

            color: var(--student-text);

        }


        /* =========================================================
           CARD
        ========================================================== */

        .student-edit-card {

            width: 100%;

            max-width: none;

            margin: 0;

            background: var(--student-card-bg);

            border-radius: 12px;

            box-shadow: var(--student-card-shadow);

            overflow: hidden;

            box-sizing: border-box;

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

            box-sizing: border-box;

        }


        .student-edit-overline {

            display: block;

            margin-bottom: .25rem;

            color: var(--student-primary);

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
           INPUT / SELECT
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

            border: 1px solid var(--student-border);

            border-radius: 8px;

            outline: none;

            font-family: inherit;

            font-size: .82rem;

            box-sizing: border-box;

            transition: .2s ease;

        }


        .student-form-control:hover {

            border-color: var(--student-primary);

        }


        .student-form-control:focus {

            color: var(--student-text);

            background: var(--student-card-bg);

            border-color: var(--student-primary);

            box-shadow:
                0 0 0 3px rgba(124, 92, 227, .15);

        }


        .student-form-control::placeholder {

            color: var(--student-text-muted);

            opacity: 1;

        }


        .student-form-control.is-invalid {

            border-color: var(--student-red);

        }


        /* =========================================================
           SELECT
        ========================================================== */

        .student-form-select {

            cursor: pointer;

        }


        .student-form-select option {

            color: var(--student-text);

            background: var(--student-card-bg);

        }


        /* =========================================================
           ERROR
        ========================================================== */

        .student-error {

            margin-top: .35rem;

            color: var(--student-red);

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

            justify-content: space-between;

            width: 100%;

            padding-top: 1rem;

            border-top: 1px solid var(--student-border-soft);

            box-sizing: border-box;

        }


        /* =========================================================
           NOTE
        ========================================================== */

        .student-form-note {

            display: flex;

            align-items: flex-start;

            gap: .5rem;

            max-width: 55%;

            color: var(--student-text-muted);

            font-size: .7rem;

            line-height: 1.5;

        }


        .student-form-note i {

            margin-top: .1rem;

            color: var(--student-primary);

            font-size: .8rem;

            flex-shrink: 0;

        }


        .student-form-note strong {

            color: var(--student-text-secondary);

            font-weight: 800;

        }


        /* =========================================================
           BUTTON CONTAINER
        ========================================================== */

        .student-form-buttons {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: .6rem;

            flex-shrink: 0;

        }


        /* =========================================================
           BUTTON BASE
        ========================================================== */

        .student-cancel-button,
        .student-save-button {

            min-height: 42px;

            padding: .65rem 1rem;

            border-radius: 8px;

            font-size: .7rem;

            font-weight: 800;

            text-transform: uppercase;

            text-decoration: none;

            cursor: pointer;

            box-sizing: border-box;

            transition: .2s ease;

        }


        /* =========================================================
           CANCEL BUTTON
           WHITE / DARK CARD + RED BORDER
        ========================================================== */

        .student-cancel-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            color: var(--student-red);

            background: var(--student-card-bg);

            border: 1px solid var(--student-red);

        }


        .student-cancel-button:hover {

            color: #ffffff;

            background: var(--student-red);

            border-color: var(--student-red);

            transform: translateY(-1px);

            box-shadow:
                0 4px 12px rgba(220, 53, 69, .18);

        }


        /* =========================================================
           SAVE BUTTON
           NO BACKGROUND — PURPLE BORDER
        ========================================================== */

        .student-save-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            color: var(--student-primary);

            background: var(--student-card-bg);

            border: 1px solid var(--student-primary-hover);

        }


        /* =========================================================
           SAVE BUTTON HOVER
        ========================================================== */

        .student-save-button:hover {

            color: #ffffff;

            background: var(--student-primary);

            border-color: var(--student-primary-hover);

            transform: translateY(-1px);

            box-shadow:
                0 4px 12px rgba(84, 40, 199, .25);

        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1000px) {

            .student-edit-wrapper {

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

                flex-direction: column;

                align-items: stretch;

                gap: 1rem;

            }


            .student-form-note {

                max-width: 100%;

            }


            .student-form-buttons {

                width: 100%;

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

    </style>

</x-app-layout>