<x-app-layout>

    <div class="thesis-create-wrapper">

        <div class="thesis-create-card">

            {{-- =========================================================
                HEADER
            ========================================================== --}}

            <div class="thesis-create-header">

                <div>

                    <span class="thesis-create-overline">
                        MANAGEMENT
                    </span>

                    <h2 class="thesis-create-title">
                        Add Thesis
                    </h2>

                    <p class="thesis-create-description">
                        Add a new thesis to the repository.
                    </p>

                </div>

            </div>


            {{-- =========================================================
                FORM
            ========================================================== --}}

            <form action="{{ route('admin.thesis.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="thesis-create-form">

                @csrf


                {{-- =====================================================
                    TITLE
                ====================================================== --}}

                <div class="thesis-form-group">

                    <label for="title" class="thesis-form-label">
                        Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        class="thesis-form-control @error('title') is-invalid @enderror"
                        placeholder="Enter thesis title"
                        required
                    >

                    @error('title')
                        <div class="thesis-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =====================================================
                    AUTHOR
                ====================================================== --}}

                <div class="thesis-form-group">

                    <label for="author_name" class="thesis-form-label">
                        Author Name
                    </label>

                    <input
                        type="text"
                        id="author_name"
                        name="author_name"
                        value="{{ old('author_name') }}"
                        class="thesis-form-control @error('author_name') is-invalid @enderror"
                        placeholder="Enter author name"
                        required
                    >

                    @error('author_name')
                        <div class="thesis-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =====================================================
                    DEPARTMENT
                ====================================================== --}}

                <div class="thesis-form-group">

                    <label for="department_id" class="thesis-form-label">
                        Department
                    </label>

                    <select
                        id="department_id"
                        name="department_id"
                        class="thesis-form-control thesis-form-select @error('department_id') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            Select Department
                        </option>

                        @foreach ($departments as $department)

                            <option
                                value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}
                            >
                                {{ $department->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('department_id')
                        <div class="thesis-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =====================================================
                    FILE
                ====================================================== --}}

                <div class="thesis-form-group">

                    <label for="files" class="thesis-form-label">
                        Thesis File(s)
                    </label>

                    <input
                        type="file"
                        id="files"
                        name="files[]"
                        class="thesis-form-control thesis-file-input @error('files') is-invalid @enderror"
                        accept=".pdf"
                        multiple
                        required
                    >

                    <small class="thesis-file-help">
                        PDF only. You may upload one or more files.
                    </small>

                    @error('files')
                        <div class="thesis-error">
                            {{ $message }}
                        </div>
                    @enderror

                    @error('files.*')
                        <div class="thesis-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =====================================================
                    ABSTRACT
                ====================================================== --}}

                <div class="thesis-form-group thesis-full-width">

                    <label for="abstract" class="thesis-form-label">
                        Abstract
                    </label>

                    <textarea
                        id="abstract"
                        name="abstract"
                        class="thesis-form-control thesis-textarea @error('abstract') is-invalid @enderror"
                        rows="5"
                        placeholder="Enter thesis abstract"
                    >{{ old('abstract') }}</textarea>

                    @error('abstract')
                        <div class="thesis-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =====================================================
                    DESCRIPTION
                ====================================================== --}}

                <div class="thesis-form-group thesis-full-width">

                    <label for="description" class="thesis-form-label">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="thesis-form-control thesis-textarea @error('description') is-invalid @enderror"
                        rows="5"
                        placeholder="Enter thesis description"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="thesis-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =====================================================
                    ACTIONS
                ====================================================== --}}

                <div class="thesis-form-actions">

                    {{-- CANCEL --}}

                    <a
                        href="{{ route('admin.thesis.index') }}"
                        class="thesis-cancel-button"
                    >
                        Cancel
                    </a>


                    {{-- CREATE --}}

                    <button
                        type="submit"
                        class="thesis-save-button"
                    >
                        Create
                    </button>

                </div>

            </form>

        </div>

    </div>


    <style>

        /* =========================================================
           VARIABLES
        ========================================================== */

        :root {

            --thesis-purple: #6538d9;
            --thesis-purple-hover: #5427c4;

            --thesis-blue: #2563eb;
            --thesis-blue-hover: #1d4ed8;

            --thesis-red: #dc2626;
            --thesis-red-hover: #b91c1c;

            --thesis-black: #000000;
            --thesis-white: #ffffff;

            --thesis-page-bg: #ffffff;
            --thesis-card-bg: #ffffff;
            --thesis-input-bg: #fafafa;

            --thesis-text: #000000;
            --thesis-text-secondary: #000000;
            --thesis-text-muted: #666666;

            --thesis-border: #dddddd;
            --thesis-border-soft: #eeeeee;

            --thesis-placeholder: #999999;

            --thesis-shadow:
                0 4px 18px rgba(0, 0, 0, .06);

        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] {

            --thesis-page-bg: #101426;

            --thesis-card-bg: #181d33;

            --thesis-input-bg: #20253a;

            --thesis-text: #ffffff;

            --thesis-text-secondary: #eeeef8;

            --thesis-text-muted: #999fb9;

            --thesis-border: #343a52;

            --thesis-border-soft: #292e45;

            --thesis-placeholder: #777f9c;

            --thesis-shadow:
                0 4px 18px rgba(0, 0, 0, .30);

        }


        /* =========================================================
           PAGE
        ========================================================== */

        .thesis-create-wrapper {

            margin-left: 250px;

            width: calc(100% - 250px);

            padding-top: 118px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 30px;

            box-sizing: border-box;

            overflow-x: hidden;

            color: var(--thesis-text);

            /* background: var(--thesis-page-bg); */

            transition:
                background-color .25s ease,
                color .25s ease;

        }


        /* =========================================================
           CARD
        ========================================================== */

        .thesis-create-card {

            width: 100%;

            max-width: none;

            margin: 0;

            background: var(--thesis-card-bg);

            color: var(--thesis-text);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 12px;

            box-shadow: var(--thesis-shadow);

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

        .thesis-create-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            width: 100%;

            padding: 1.4rem 1.5rem;

            background: var(--thesis-card-bg);

            border-bottom:
                1px solid var(--thesis-border-soft);

            box-sizing: border-box;

        }


        /* =========================================================
           MANAGEMENT / OVERLINE
        ========================================================== */

        .thesis-create-overline {

            display: block;

            margin-bottom: .25rem;

            color: var(--thesis-purple);

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .1em;

            text-transform: uppercase;

        }


        /* =========================================================
           TITLE
        ========================================================== */

        .thesis-create-title {

            margin: 0;

            color: var(--thesis-text);

            font-size: 1.25rem;

            font-weight: 800;

            line-height: 1.3;

        }


        /* =========================================================
           DESCRIPTION
        ========================================================== */

        .thesis-create-description {

            margin: .35rem 0 0;

            color: var(--thesis-text-muted);

            font-size: .78rem;

            line-height: 1.5;

        }


        /* =========================================================
           FORM
        ========================================================== */

        .thesis-create-form {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 1.15rem 1.25rem;

            width: 100%;

            padding: 1.5rem;

            background: var(--thesis-card-bg);

            box-sizing: border-box;

        }


        .thesis-form-group {

            min-width: 0;

            width: 100%;

            box-sizing: border-box;

        }


        .thesis-full-width {

            grid-column: 1 / -1;

        }


        /* =========================================================
           LABEL
        ========================================================== */

        .thesis-form-label {

            display: block;

            margin-bottom: .45rem;

            color: var(--thesis-text-secondary);

            font-size: .68rem;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .05em;

        }


        /* =========================================================
           INPUT / SELECT / TEXTAREA
        ========================================================== */

        .thesis-form-control {

            display: block;

            width: 100%;

            max-width: 100%;

            min-width: 0;

            height: 45px;

            padding: .55rem .85rem;

            color: var(--thesis-text);

            background: var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

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


        .thesis-form-control::placeholder {

            color: var(--thesis-placeholder);

            opacity: 1;

        }


        .thesis-form-control:hover {

            border-color: var(--thesis-border);

        }


        .thesis-form-control:focus {

            color: var(--thesis-text);

            background: var(--thesis-input-bg);

            border-color: var(--thesis-purple);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .10);

        }


        /* =========================================================
           INVALID
        ========================================================== */

        .thesis-form-control.is-invalid {

            border-color: var(--thesis-red);

            box-shadow: none;

        }


        /* =========================================================
           SELECT
        ========================================================== */

        .thesis-form-select {

            cursor: pointer;

        }


        .thesis-form-select option {

            color: #000000;

            background: #ffffff;

        }


        [data-bs-theme="dark"] .thesis-form-select option {

            color: #ffffff;

            background: #181d33;

        }


        /* =========================================================
           TEXTAREA
        ========================================================== */

        .thesis-textarea {

            height: auto;

            min-height: 115px;

            resize: vertical;

            line-height: 1.5;

        }


        /* =========================================================
           FILE INPUT
        ========================================================== */

        .thesis-file-input {

            padding-top: .65rem;

            cursor: pointer;

        }


        /* =========================================================
           CHOOSE FILE BUTTON — PURPLE
        ========================================================== */

        .thesis-file-input::file-selector-button {

            margin-right: .6rem;

            padding: .4rem .75rem;

            color: #ffffff;

            background: var(--thesis-purple);

            border:
                1px solid var(--thesis-purple);

            border-radius: 6px;

            font-size: .7rem;

            font-weight: 700;

            cursor: pointer;

            transition:
                background-color .2s ease,
                border-color .2s ease;

        }


        .thesis-file-input::file-selector-button:hover {

            background: var(--thesis-purple-hover);

            border-color: var(--thesis-purple-hover);

        }


        [data-bs-theme="dark"] .thesis-file-input::file-selector-button {

            color: #ffffff;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);

        }


        [data-bs-theme="dark"] .thesis-file-input::file-selector-button:hover {

            background: var(--thesis-purple-hover);

            border-color: var(--thesis-purple-hover);

        }


        /* =========================================================
           FILE HELP
        ========================================================== */

        .thesis-file-help {

            display: block;

            margin-top: .4rem;

            color: var(--thesis-text-muted);

            font-size: .68rem;

        }


        /* =========================================================
           ERROR
        ========================================================== */

        .thesis-error {

            margin-top: .35rem;

            color: var(--thesis-red) !important;

            font-size: .7rem;

            font-weight: 600;

            line-height: 1.4;

        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .thesis-form-actions {

            grid-column: 1 / -1;

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: .6rem;

            width: 100%;

            padding-top: 1rem;

            border-top:
                1px solid var(--thesis-border-soft);

            box-sizing: border-box;

        }


        /* =========================================================
           CANCEL BUTTON
           RED BORDER / NO ICON
        ========================================================== */

        .thesis-cancel-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 42px;

            padding: .65rem 1.1rem;

            color: var(--thesis-red) !important;

            background: transparent;

            border:
                1px solid var(--thesis-red);

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


        .thesis-cancel-button:hover {

            color: #ffffff !important;

            background: var(--thesis-red);

            border-color: var(--thesis-red);

            transform:
                translateY(-1px);

        }


        /* =========================================================
           CREATE BUTTON
           BLUE BORDER / NO ICON
        ========================================================== */

        .thesis-save-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 42px;

            padding: .65rem 1.1rem;

            color: var(--thesis-blue) !important;

            background: transparent;

            border:
                1px solid var(--thesis-blue);

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


        .thesis-save-button:hover {

            color: #ffffff !important;

            background: var(--thesis-blue);

            border-color: var(--thesis-blue);

            transform:
                translateY(-1px);

        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1000px) {

            .thesis-create-wrapper {

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

            .thesis-create-wrapper {

                width: 100%;

                margin-left: 0;

                padding-top: 90px;

                padding-left: 10px;

                padding-right: 10px;

                padding-bottom: 20px;

                overflow-x: hidden;

            }


            .thesis-create-card {

                width: 100%;

                max-width: 100%;

                margin: 0;

            }


            .thesis-create-header {

                padding: 1rem;

            }


            .thesis-create-title {

                font-size: 1.1rem;

            }


            .thesis-create-description {

                font-size: .72rem;

            }


            .thesis-create-form {

                grid-template-columns: 1fr;

                gap: 1rem;

                padding: 1rem;

            }


            .thesis-full-width {

                grid-column: auto;

            }


            .thesis-form-actions {

                flex-direction: column-reverse;

                align-items: stretch;

            }


            .thesis-cancel-button,
            .thesis-save-button {

                width: 100%;

                text-align: center;

            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .thesis-create-wrapper {

                padding-top: 85px;

                padding-left: 8px;

                padding-right: 8px;

            }


            .thesis-create-header {

                padding: .9rem;

            }


            .thesis-create-form {

                padding: .9rem;

            }


            .thesis-create-title {

                font-size: 1.05rem;

            }


            .thesis-create-description {

                font-size: .7rem;

            }


            .thesis-form-control {

                height: 44px;

                font-size: .8rem;

            }


            .thesis-textarea {

                min-height: 105px;

            }

        }


        /* =========================================================
           REDUCED MOTION
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            .thesis-create-wrapper *,
            .thesis-create-wrapper *::before,
            .thesis-create-wrapper *::after {

                transition: none !important;

                animation: none !important;

            }

        }

    </style>


</x-app-layout>