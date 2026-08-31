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

            <form action="{{ route('hod.students.update', $student->id) }}" method="POST" class="student-edit-form">

                @csrf
                @method('PUT')


                {{-- FULL NAME --}}

                <div class="student-form-group">

                    <label for="full_name" class="student-form-label">

                        Full Name

                    </label>

                    <input type="text" id="full_name" name="full_name"
                        value="{{ old('full_name', $student->full_name) }}"
                        class="student-form-control @error('full_name') is-invalid @enderror"
                        placeholder="Enter full name" required>

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

                    <input type="email" id="email" name="email"
                        value="{{ old('email', $student->user->email) }}"
                        class="student-form-control @error('email') is-invalid @enderror"
                        placeholder="Enter email address" required>

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

                    <input type="text" id="username" name="username"
                        value="{{ old('username', $student->user->username) }}"
                        class="student-form-control @error('username') is-invalid @enderror"
                        placeholder="Enter username" required>

                    @error('username')
                        <div class="student-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- STATUS / UPLOAD PERMISSION --}}

                <div class="student-form-group">

                    <label for="upload_permission" class="student-form-label">

                        Upload Permission

                    </label>

                    <select id="upload_permission" name="upload_permission"
                        class="student-form-control student-form-select @error('upload_permission') is-invalid @enderror"
                        required>

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

                    <a href="{{ route('hod.students.index') }}" class="student-cancel-button">

                        Cancel

                    </a>

                    <button type="submit" class="student-save-button">

                        <i class="bi bi-check-lg"></i>

                        Save Student

                    </button>

                </div>

            </form>

        </div>

    </div>


    <style>
        :root {

            --student-black: #000000;
            --student-white: #ffffff;

            --student-text: #000000;
            --student-text-secondary: #333333;
            --student-text-muted: #777777;

            --student-border: #dddddd;

            --student-input-bg: #fafafa;

        }


        /* =========================================================
       PAGE
    ========================================================== */

        .student-edit-wrapper {

            margin-left: 250px;

            width: 86%;

            padding-top: 118px;

            padding-left: 20px;

            padding-right: 20px;

            padding-bottom: 30px;

            box-sizing: border-box;

            overflow-x: hidden;

            color: var(--student-text);

        }


        /* =========================================================
       FULL SCREEN CARD
    ========================================================== */

        .student-edit-card {

            width: 100%;

            max-width: none;

            margin: 0;

            background: #ffffff;

            border-radius: 12px;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .06);

            overflow: hidden;

            box-sizing: border-box;

        }


        /* =========================================================
       FORM HEADER
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

            color: #777777;

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .1em;

            text-transform: uppercase;

        }


        .student-edit-title {

            margin: 0;

            color: #000000;

            font-size: 1.25rem;

            font-weight: 800;

            line-height: 1.3;

        }


        .student-edit-description {

            margin: .35rem 0 0;

            color: #777777;

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

            color: #333333;

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

            color: #000000;

            background: #fafafa;

            border: 1px solid #dddddd;

            border-radius: 8px;

            outline: none;

            font-family: inherit;

            font-size: .82rem;

            box-sizing: border-box;

            transition: .2s ease;

        }


        .student-form-control:focus {

            background: #ffffff;

            border-color: #000000;

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, .08);

        }


        .student-form-control.is-invalid {

            border-color: #000000;

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


        /* =========================================================
       ERROR
    ========================================================== */

        .student-error {

            margin-top: .35rem;

            color: #000000;

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

            border-top: 1px solid #eeeeee;

            box-sizing: border-box;

        }


        /* =========================================================
       BUTTONS
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
       CANCEL
    ========================================================== */

        .student-cancel-button {

            color: #000000;

            background: #ffffff;

            border: 1px solid #dddddd;

        }


        .student-cancel-button:hover {

            color: #ffffff;

            background: #000000;

            border-color: #000000;

        }


        /* =========================================================
       SAVE
    ========================================================== */

        .student-save-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            color: #ffffff;

            background: #000000;

            border: 1px solid #000000;

        }


        .student-save-button:hover {

            color: #ffffff;

            background: #222222;

            border-color: #222222;

            transform: translateY(-1px);

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
    </style>


</x-app-layout>
