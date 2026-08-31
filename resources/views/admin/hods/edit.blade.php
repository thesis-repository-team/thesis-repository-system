<x-app-layout>

    <div class="hod-create-wrapper">

        <div class="hod-create-card">

            {{-- =================================================
                FORM HEADER
            ================================================== --}}

            <div class="hod-create-header">

                <div>

                    <span class="hod-create-overline">
                        MANAGEMENT
                    </span>

                    <h2 class="hod-create-title">
                        Edit Head of Department
                    </h2>

                    <p class="hod-create-description">
                        Update the Head of Department account.
                    </p>

                </div>

            </div>


            {{-- =================================================
                FORM
            ================================================== --}}

            <form
                action="{{ route('admin.hods.store') }}"
                method="POST"
                class="hod-create-form">

                @csrf


                {{-- FULL NAME --}}

                <div class="hod-form-group">

                    <label for="full_name" class="hod-form-label">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        value="{{ old('full_name') }}"
                        class="hod-form-control @error('full_name') is-invalid @enderror"
                        placeholder="Enter full name"
                        required>

                    @error('full_name')
                        <div class="hod-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- EMAIL --}}

                <div class="hod-form-group">

                    <label for="email" class="hod-form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="hod-form-control @error('email') is-invalid @enderror"
                        placeholder="Enter email address"
                        required>

                    @error('email')
                        <div class="hod-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- USERNAME --}}

                <div class="hod-form-group">

                    <label for="username" class="hod-form-label">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        class="hod-form-control @error('username') is-invalid @enderror"
                        placeholder="Enter username"
                        required>

                    @error('username')
                        <div class="hod-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- PASSWORD --}}

                <div class="hod-form-group">

                    <label for="password" class="hod-form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="hod-form-control @error('password') is-invalid @enderror"
                        placeholder="Enter password"
                        required>

                    @error('password')
                        <div class="hod-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- DEPARTMENT --}}

                <div class="hod-form-group">

                    <label for="department_id" class="hod-form-label">
                        Department
                    </label>

                    <select
                        id="department_id"
                        name="department_id"
                        class="hod-form-control hod-form-select @error('department_id') is-invalid @enderror"
                        required>

                        <option value="">
                            Select Department
                        </option>

                        @foreach ($departments as $department)

                            <option
                                value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}>

                                {{ $department->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('department_id')
                        <div class="hod-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- STARTED YEAR --}}

                <div class="hod-form-group">

                    <label for="started_year" class="hod-form-label">
                        Started Year
                    </label>

                    <input
                        type="number"
                        id="started_year"
                        name="started_year"
                        value="{{ old('started_year') }}"
                        class="hod-form-control @error('started_year') is-invalid @enderror"
                        placeholder="2025"
                        min="1900"
                        max="2100"
                        required>

                    @error('started_year')
                        <div class="hod-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- STATUS --}}

                <div class="hod-form-group">

                    <label for="is_active" class="hod-form-label">
                        Status
                    </label>

                    <select
                        id="is_active"
                        name="is_active"
                        class="hod-form-control hod-form-select">

                        <option
                            value="1"
                            {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option
                            value="0"
                            {{ old('is_active') === '0' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>


                {{-- =================================================
                    ACTIONS
                ================================================== --}}

                <div class="hod-form-actions">

                    <a
                        href="{{ route('admin.hods.index') }}"
                        class="hod-cancel-button">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="hod-save-button">

                        <i class="bi bi-check-lg"></i>

                        Save HoD

                    </button>

                </div>

            </form>

        </div>

    </div>


    <style>

        :root {

            --hod-black: #000000;
            --hod-white: #ffffff;

            --hod-text: #000000;
            --hod-text-secondary: #333333;
            --hod-text-muted: #777777;

            --hod-border: #dddddd;

            --hod-input-bg: #fafafa;

        }


        /* =========================================================
           PAGE
        ========================================================== */

        .hod-create-wrapper {

            margin-left: 250px;
            width: 86%;

            padding-top: 118px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 30px;

            box-sizing: border-box;

            overflow-x: hidden;

            color: var(--hod-text);

        }


        /* =========================================================
           FULL SCREEN CARD
        ========================================================== */

        .hod-create-card {

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

        .hod-create-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            width: 100%;

            padding: 1.4rem 1.5rem;

            box-sizing: border-box;

        }


        .hod-create-overline {

            display: block;

            margin-bottom: .25rem;

            color: #777777;

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .1em;

            text-transform: uppercase;

        }


        .hod-create-title {

            margin: 0;

            color: #000000;

            font-size: 1.25rem;

            font-weight: 800;

            line-height: 1.3;

        }


        .hod-create-description {

            margin: .35rem 0 0;

            color: #777777;

            font-size: .78rem;

            line-height: 1.5;

        }


        /* =========================================================
           FORM
        ========================================================== */

        .hod-create-form {

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

        .hod-form-group {

            min-width: 0;

            width: 100%;

            box-sizing: border-box;

        }


        /* =========================================================
           LABEL
        ========================================================== */

        .hod-form-label {

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

        .hod-form-control {

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


        .hod-form-control:focus {

            background: #ffffff;

            border-color: #000000;

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, .08);

        }


        .hod-form-control.is-invalid {

            border-color: #000000;

        }


        /* =========================================================
           SELECT
        ========================================================== */

        .hod-form-select {

            cursor: pointer;

        }


        .hod-form-select option {

            color: #000000;

            background: #ffffff;

        }


        /* =========================================================
           ERROR
        ========================================================== */

        .hod-error {

            margin-top: .35rem;

            color: #000000;

            font-size: .7rem;

            font-weight: 600;

            line-height: 1.4;

        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .hod-form-actions {

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

        .hod-cancel-button,
        .hod-save-button {

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

        .hod-cancel-button {

            color: #000000;

            background: #ffffff;

            border: 1px solid #dddddd;

        }


        .hod-cancel-button:hover {

            color: #ffffff;

            background: #000000;

            border-color: #000000;

        }


        /* =========================================================
           SAVE
        ========================================================== */

        .hod-save-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            color: #ffffff;

            background: #000000;

            border: 1px solid #000000;

        }


        .hod-save-button:hover {

            color: #ffffff;

            background: #222222;

            border-color: #222222;

            transform: translateY(-1px);

        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1000px) {

            .hod-create-wrapper {

                padding-left: 15px;

                padding-right: 15px;

            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .hod-create-wrapper {

                width: 100%;

                padding-top: 90px;

                padding-left: 10px;

                padding-right: 10px;

                padding-bottom: 20px;

                overflow-x: hidden;

            }


            .hod-create-card {

                width: 100%;

                max-width: 100%;

                margin: 0;

            }


            .hod-create-header {

                padding: 1rem;

            }


            .hod-create-title {

                font-size: 1.1rem;

            }


            .hod-create-description {

                font-size: .72rem;

            }


            .hod-create-form {

                grid-template-columns: 1fr;

                gap: 1rem;

                padding: 1rem;

            }


            .hod-form-actions {

                flex-direction: column-reverse;

                align-items: stretch;

            }


            .hod-cancel-button,
            .hod-save-button {

                width: 100%;

                text-align: center;

            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .hod-create-wrapper {

                padding-top: 85px;

                padding-left: 8px;

                padding-right: 8px;

            }


            .hod-create-header {

                padding: .9rem;

            }


            .hod-create-form {

                padding: .9rem;

            }


            .hod-create-title {

                font-size: 1.05rem;

            }


            .hod-create-description {

                font-size: .7rem;

            }


            .hod-form-control {

                height: 44px;

                font-size: .8rem;

            }

        }

    </style>

</x-app-layout>