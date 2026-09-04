<x-app-layout>

    <div class="hod-create-wrapper">

        <div class="hod-create-card">

            {{-- Header --}}
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


            {{-- Form --}}
            <form
                action="{{ route('admin.hods.update', $hod) }}"
                method="POST"
                class="hod-create-form">

                @csrf
                @method('PUT')


                {{-- Full Name --}}
                <div class="hod-form-group">

                    <label
                        for="full_name"
                        class="hod-form-label">

                        Full Name

                    </label>

                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        value="{{ old('full_name', $hod->full_name) }}"
                        class="hod-form-control @error('full_name') is-invalid @enderror"
                        placeholder="Enter full name"
                        required>

                    @error('full_name')

                        <div class="hod-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Email --}}
                <div class="hod-form-group">

                    <label
                        for="email"
                        class="hod-form-label">

                        Email

                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $hod->user->email ?? '') }}"
                        class="hod-form-control @error('email') is-invalid @enderror"
                        placeholder="Enter email address"
                        required>

                    @error('email')

                        <div class="hod-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Username --}}
                <div class="hod-form-group">

                    <label
                        for="username"
                        class="hod-form-label">

                        Username

                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username', $hod->user->username ?? '') }}"
                        class="hod-form-control @error('username') is-invalid @enderror"
                        placeholder="Enter username"
                        required>

                    @error('username')

                        <div class="hod-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Password --}}
                <div class="hod-form-group">

                    <label
                        for="password"
                        class="hod-form-label">

                        Password

                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="hod-form-control @error('password') is-invalid @enderror"
                        placeholder="Leave blank to keep current password">

                    @error('password')

                        <div class="hod-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Department --}}
                <div class="hod-form-group">

                    <label
                        for="department_id"
                        class="hod-form-label">

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
                                {{ old('department_id', $hod->department_id) == $department->id ? 'selected' : '' }}>

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


                {{-- Started Year --}}
                <div class="hod-form-group">

                    <label
                        for="started_year"
                        class="hod-form-label">

                        Started Year

                    </label>

                    <input
                        type="number"
                        id="started_year"
                        name="started_year"
                        value="{{ old('started_year', $hod->started_year) }}"
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


                {{-- Status --}}
                <div class="hod-form-group">

                    <label
                        for="is_active"
                        class="hod-form-label">

                        Status

                    </label>

                    <select
                        id="is_active"
                        name="is_active"
                        class="hod-form-control hod-form-select @error('is_active') is-invalid @enderror">

                        <option
                            value="1"
                            {{ old('is_active', $hod->is_active) == '1' ? 'selected' : '' }}>

                            Active

                        </option>

                        <option
                            value="0"
                            {{ old('is_active', $hod->is_active) == '0' ? 'selected' : '' }}>

                            Inactive

                        </option>

                    </select>

                    @error('is_active')

                        <div class="hod-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Actions --}}
                <div class="hod-form-actions">

                    <a
                        href="{{ route('admin.hods.index') }}"
                        class="hod-cancel-button">

                        <i class="bi bi-x-lg"></i>

                        Cancel

                    </a>


                    <button
                        type="submit"
                        class="hod-save-button">

                        <i class="bi bi-check-lg"></i>

                        Save Changes

                    </button>

                </div>

            </form>

        </div>

    </div>


    <style>

        :root {

            --hod-blue: #2563eb;
            --hod-blue-hover: #1d4ed8;

            --hod-red: #dc2626;
            --hod-red-hover: #b91c1c;

            --hod-black: #000000;
            --hod-white: #ffffff;

            --hod-page-bg: #ffffff;
            --hod-card-bg: #ffffff;

            --hod-input-bg: #fafafa;

            --hod-text: #000000;
            --hod-text-secondary: #000000;
            --hod-text-muted: #000000;

            --hod-border: #dddddd;
            --hod-border-soft: #eeeeee;

            --hod-placeholder: #999999;

            --hod-shadow:
                0 4px 18px rgba(0, 0, 0, .06);
        }


        /* Dark Mode */

        [data-bs-theme="dark"] {

            --hod-page-bg: #000000;
            --hod-card-bg: #000000;

            --hod-input-bg: #0d0d0d;

            --hod-text: #ffffff;
            --hod-text-secondary: #ffffff;
            --hod-text-muted: #ffffff;

            --hod-border: #333333;
            --hod-border-soft: #333333;

            --hod-placeholder: #777777;

            --hod-shadow:
                0 4px 18px rgba(255, 255, 255, .04);
        }


        /* Page */

        .hod-create-wrapper {

            margin-left: 250px;

            width: calc(100% - 250px);

            padding-top: 118px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 30px;

            box-sizing: border-box;

            overflow-x: hidden;

            color: var(--hod-text);

            /* background: var(--hod-page-bg); */

            transition:
                background-color .25s ease,
                color .25s ease;
        }


        /* Card */

        .hod-create-card {

            width: 100%;

            max-width: none;

            margin: 0;

            background: var(--hod-card-bg);

            color: var(--hod-text);

            border:
                1px solid var(--hod-border-soft);

            border-radius: 12px;

            box-shadow: var(--hod-shadow);

            overflow: hidden;

            box-sizing: border-box;

            transition:
                background-color .25s ease,
                color .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }


        /* Header */

        .hod-create-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            width: 100%;

            padding: 1.4rem 1.5rem;

            background: var(--hod-card-bg);

            box-sizing: border-box;
        }


        .hod-create-overline {

            display: block;

            margin-bottom: .25rem;

            color: var(--hod-text);

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .1em;

            text-transform: uppercase;
        }


        .hod-create-title {

            margin: 0;

            color: var(--hod-text);

            font-size: 1.25rem;

            font-weight: 800;

            line-height: 1.3;
        }


        .hod-create-description {

            margin: .35rem 0 0;

            color: var(--hod-text-secondary);

            font-size: .78rem;

            line-height: 1.5;
        }


        /* Form */

        .hod-create-form {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 1.15rem 1.25rem;

            width: 100%;

            padding: 1.5rem;

            background: var(--hod-card-bg);

            box-sizing: border-box;
        }


        .hod-form-group {

            min-width: 0;

            width: 100%;

            box-sizing: border-box;
        }


        /* Labels */

        .hod-form-label {

            display: block;

            margin-bottom: .45rem;

            color: var(--hod-text-secondary);

            font-size: .68rem;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .05em;
        }


        /* Inputs */

        .hod-form-control {

            display: block;

            width: 100%;

            max-width: 100%;

            min-width: 0;

            height: 45px;

            padding: .55rem .85rem;

            color: var(--hod-text);

            background: var(--hod-input-bg);

            border:
                1px solid var(--hod-border-soft);

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


        .hod-form-control::placeholder {

            color: var(--hod-placeholder);

            opacity: 1;
        }


        .hod-form-control:focus {

            color: var(--hod-text);

            background: var(--hod-input-bg);

            border-color: var(--hod-blue);

            box-shadow:
                0 0 0 3px
                rgba(37, 99, 235, .10);
        }


        /* Dark Inputs */

        [data-bs-theme="dark"] .hod-form-control {

            color: #ffffff;

            background: #0d0d0d;

            border-color: #333333;
        }


        [data-bs-theme="dark"] .hod-form-control:focus {

            color: #ffffff;

            background: #0d0d0d;

            border-color: var(--hod-blue);

            box-shadow:
                0 0 0 3px
                rgba(37, 99, 235, .18);
        }


        [data-bs-theme="dark"]
        .hod-form-control::placeholder {

            color: #777777;
        }


        /* Invalid */

        .hod-form-control.is-invalid {

            border-color: var(--hod-red);

            box-shadow: none;
        }


        /* Select */

        .hod-form-select {

            cursor: pointer;
        }


        .hod-form-select option {

            color: #000000;

            background: #ffffff;
        }


        [data-bs-theme="dark"]
        .hod-form-select option {

            color: #ffffff;

            background: #000000;
        }


        /* Errors */

        .hod-error {

            margin-top: .35rem;

            color: var(--hod-red) !important;

            font-size: .7rem;

            font-weight: 600;

            line-height: 1.4;
        }


        /* Actions */

        .hod-form-actions {

            grid-column: 1 / -1;

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: .6rem;

            width: 100%;

            padding-top: 1rem;

            box-sizing: border-box;
        }


        /* Buttons */

        .hod-cancel-button,
        .hod-save-button {

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


        /* Cancel */

        .hod-cancel-button {

            color: #ffffff !important;

            background: var(--hod-red);

            border:
                1px solid var(--hod-red);
        }


        .hod-cancel-button:hover {

            color: #ffffff !important;

            background: var(--hod-red-hover);

            border-color: var(--hod-red-hover);

            transform: translateY(-1px);
        }


        /* Save */

        .hod-save-button {

            color: #ffffff !important;

            background: var(--hod-blue);

            border:
                1px solid var(--hod-blue);
        }


        .hod-save-button:hover {

            color: #ffffff !important;

            background: var(--hod-blue-hover);

            border-color: var(--hod-blue-hover);

            transform: translateY(-1px);
        }


        .hod-save-button i,
        .hod-cancel-button i {

            color: #ffffff !important;

            font-size: .85rem;
        }


        /* Tablet */

        @media (max-width: 1000px) {

            .hod-create-wrapper {

                margin-left: 250px;

                width: calc(100% - 250px);

                padding-left: 15px;

                padding-right: 15px;
            }
        }


        /* Mobile */

        @media (max-width: 767.98px) {

            .hod-create-wrapper {

                width: 100%;

                margin-left: 0;

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


        /* Small Mobile */

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


        /* Reduced Motion */

        @media (prefers-reduced-motion: reduce) {

            .hod-create-wrapper *,
            .hod-create-wrapper *::before,
            .hod-create-wrapper *::after {

                transition: none !important;

                animation: none !important;
            }
        }

    </style>

</x-app-layout>