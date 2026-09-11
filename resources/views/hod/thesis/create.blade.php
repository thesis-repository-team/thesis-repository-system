```blade
<x-app-layout>

    <div class="thesis-create-wrapper">

        <div class="thesis-create-card">

            {{-- =====================================================
                HEADER
            ====================================================== --}}

            <div class="thesis-create-header">

                <span class="thesis-create-overline">
                    MANAGEMENT
                </span>

                <h2 class="thesis-create-title">
                    Add Thesis
                </h2>

                <p class="thesis-create-description">
                    Add a new thesis to your department's repository.
                </p>

            </div>



            {{-- =====================================================
                FORM
            ====================================================== --}}

            <form
                action="{{ route('hod.thesis.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="thesis-create-form">

                @csrf


                {{-- =================================================
                    TITLE
                ================================================== --}}

                <div class="thesis-form-group">

                    <label
                        for="title"
                        class="thesis-form-label">

                        Title

                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        class="thesis-form-control @error('title') is-invalid @enderror"
                        placeholder="Enter thesis title"
                        required>

                    @error('title')

                        <div class="thesis-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                    AUTHOR
                ================================================== --}}

                <div class="thesis-form-group">

                    <label
                        for="author_name"
                        class="thesis-form-label">

                        Author Name

                    </label>

                    <input
                        type="text"
                        id="author_name"
                        name="author_name"
                        value="{{ old('author_name') }}"
                        class="thesis-form-control @error('author_name') is-invalid @enderror"
                        placeholder="Enter author name"
                        required>

                    @error('author_name')

                        <div class="thesis-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                    DEPARTMENT
                    SHOW ONLY HOD'S DEPARTMENT
                ================================================== --}}

                <div class="thesis-form-group">

                    <label class="thesis-form-label">
                        Department
                    </label>

                    <input
                        type="hidden"
                        name="department_id"
                        value="{{ $department->id }}">

                    
                    <div class="thesis-department-display">

                        <span class="thesis-department-name">
                            {{ $department->name }}
                        </span>

                    </div>

                    @error('department_id')

                        <div class="thesis-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="thesis-form-group">
                    <label for="academic_year" class="thesis-form-label">
                        Academic Year
                    </label>

                    <input type="number" id="academic_year" name="academic_year" value="{{ old('academic_year') }}"
                        class="thesis-form-control @error('academic_year') is-invalid @enderror" placeholder="e.g. 2012"
                        min="1900" max="2100" required>

                    @error('academic_year')
                        <div class="thesis-error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- =================================================
                    FILE
                ================================================== --}}

                <div class="thesis-form-group">

                    <label
                        for="files"
                        class="thesis-form-label">

                        Thesis File(s)

                    </label>

                    <input
                        type="file"
                        id="files"
                        name="files[]"
                        class="thesis-form-control thesis-file-input @error('files') is-invalid @enderror"
                        accept=".pdf"
                        multiple
                        required>

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


                {{-- =================================================
                    ABSTRACT
                ================================================== --}}

                <div class="thesis-form-group thesis-full-width">

                    <label
                        for="abstract"
                        class="thesis-form-label">

                        Abstract

                    </label>

                    <textarea
                        id="abstract"
                        name="abstract"
                        class="thesis-form-control thesis-textarea @error('abstract') is-invalid @enderror"
                        rows="5"
                        placeholder="Enter thesis abstract">{{ old('abstract') }}</textarea>

                    @error('abstract')

                        <div class="thesis-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                    DESCRIPTION
                ================================================== --}}

                <div class="thesis-form-group thesis-full-width">

                    <label
                        for="description"
                        class="thesis-form-label">

                        Description

                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="thesis-form-control thesis-textarea @error('description') is-invalid @enderror"
                        rows="5"
                        placeholder="Enter thesis description">{{ old('description') }}</textarea>

                    @error('description')

                        <div class="thesis-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                    ACTIONS
                ================================================== --}}

                <div class="thesis-form-actions">

                    {{-- CANCEL --}}

                    <a
                        href="{{ route('hod.thesis.index') }}"
                        class="thesis-cancel-button">

                        Cancel

                    </a>


                    {{-- SAVE --}}

                    <button
                        type="submit"
                        class="thesis-save-button">

                        Save Thesis

                    </button>

                </div>

            </form>

        </div>

    </div>


    <style>

        /* =========================================================
           PAGE
        ========================================================== */

        .thesis-create-wrapper {

            --thesis-purple: #6538d9;
            --thesis-purple-hover: #5630bd;

            --thesis-blue: #0d6efd;
            --thesis-blue-hover: #0b5ed7;

            --thesis-red: #dc3545;
            --thesis-red-hover: #bb2d3b;

            --thesis-card-bg: #ffffff;
            --thesis-input-bg: #fafafa;
            --thesis-input-focus-bg: #ffffff;

            --thesis-text: #111111;
            --thesis-text-secondary: #333333;
            --thesis-muted: #777777;

            --thesis-border: #dddddd;
            --thesis-divider: #eeeeee;

            --thesis-shadow:
                0 4px 18px rgba(0, 0, 0, .06);

            margin-left: 250px;
            width: 86%;

            padding:
                118px
                20px
                30px;

            box-sizing: border-box;

            color: var(--thesis-text);
        }


        /* =========================================================
           CARD
        ========================================================== */

        .thesis-create-card {

            width: 100%;

            background:
                var(--thesis-card-bg);

            border-radius: 12px;

            box-shadow:
                var(--thesis-shadow);

            overflow: hidden;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .thesis-create-header {

            padding:
                1.4rem
                1.5rem;

            border-bottom:
                1px solid
                var(--thesis-divider);
        }


        .thesis-create-overline {

            display: block;

            margin-bottom: .25rem;

            color:
                var(--thesis-purple);

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .1em;
        }


        .thesis-create-title {

            margin: 0;

            color:
                var(--thesis-text);

            font-size: 1.25rem;

            font-weight: 800;
        }


        .thesis-create-description {

            margin: .35rem 0 0;

            color:
                var(--thesis-muted);

            font-size: .78rem;
        }


        /* =========================================================
           FORM
        ========================================================== */

        .thesis-create-form {

            display: grid;

            grid-template-columns:
                repeat(
                    2,
                    minmax(0, 1fr)
                );

            gap:
                1.15rem
                1.25rem;

            padding: 1.5rem;
        }


        .thesis-form-group {

            min-width: 0;
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

            color:
                var(--thesis-text-secondary);

            font-size: .68rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;
        }


        /* =========================================================
           INPUT / TEXTAREA
        ========================================================== */

        .thesis-form-control {

            display: block;

            width: 100%;

            min-width: 0;

            height: 45px;

            padding:
                .55rem
                .85rem;

            box-sizing: border-box;

            color:
                var(--thesis-text);

            background:
                var(--thesis-input-bg);

            border:
                1px solid
                var(--thesis-border);

            border-radius: 8px;

            outline: none;

            font-family: inherit;

            font-size: .82rem;

            transition:
                background .2s ease,
                color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease;
        }


        .thesis-form-control::placeholder {

            color:
                var(--thesis-muted);

            opacity: .8;
        }


        .thesis-form-control:hover {

            border-color:
                var(--thesis-purple);
        }


        .thesis-form-control:focus {

            color:
                var(--thesis-text);

            background:
                var(--thesis-input-focus-bg);

            border-color:
                var(--thesis-purple);

            box-shadow:
                0 0 0 3px
                rgba(101, 56, 217, .12);
        }


        .thesis-form-control.is-invalid {

            border-color:
                var(--thesis-red);
        }


        .thesis-form-control.is-invalid:focus {

            border-color:
                var(--thesis-red);

            box-shadow:
                0 0 0 3px
                rgba(220, 53, 69, .12);
        }


        /* =========================================================
           HOD DEPARTMENT DISPLAY
        ========================================================== */

        .thesis-department-display {

            width: 100%;

            min-height: 45px;

            padding:
                .55rem
                .85rem;

            box-sizing: border-box;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: .75rem;

            background:
                var(--thesis-input-bg);

            border:
                1px solid
                var(--thesis-border);

            border-radius: 8px;

            cursor: default;
        }


        .thesis-department-name {

            color:
                var(--thesis-text);

            font-size: .82rem;

            font-weight: 700;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        .thesis-department-note {

            flex-shrink: 0;

            color:
                var(--thesis-muted);

            font-size: .65rem;

            font-weight: 600;

            white-space: nowrap;
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


        .thesis-file-input::file-selector-button {

            margin-right: .6rem;

            padding:
                .4rem
                .7rem;

            color:
                #ffffff;

            background:
                var(--thesis-purple);

            border: 0;

            border-radius: 6px;

            font-size: .7rem;

            font-weight: 700;

            cursor: pointer;

            transition:
                background .2s ease,
                transform .2s ease;
        }


        .thesis-file-input::file-selector-button:hover {

            background:
                var(--thesis-purple-hover);

            transform:
                translateY(-1px);
        }


        .thesis-file-help {

            display: block;

            margin-top: .4rem;

            color:
                var(--thesis-muted);

            font-size: .68rem;
        }


        /* =========================================================
           ERROR
        ========================================================== */

        .thesis-error {

            margin-top: .35rem;

            color:
                var(--thesis-red);

            font-size: .7rem;

            font-weight: 600;
        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .thesis-form-actions {

            grid-column: 1 / -1;

            display: flex;

            justify-content: flex-end;

            align-items: center;

            gap: .6rem;

            padding-top: 1rem;

            border-top:
                1px solid
                var(--thesis-divider);
        }


        /* =========================================================
           BUTTON BASE
        ========================================================== */

        .thesis-cancel-button,
        .thesis-save-button {

            min-height: 42px;

            padding:
                .65rem
                1rem;

            border-radius: 8px;

            font-size: .7rem;

            font-weight: 800;

            text-transform: uppercase;

            text-decoration: none;

            cursor: pointer;

            transition:
                background .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }


        /* =========================================================
           CANCEL BUTTON
        ========================================================== */

        .thesis-cancel-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 105px;

            color:
                var(--thesis-red);

            background:
                #ffffff;

            border:
                1px solid
                var(--thesis-red);
        }


        .thesis-cancel-button:hover {

            color:
                #ffffff;

            background:
                var(--thesis-red);

            border-color:
                var(--thesis-red);

            transform:
                translateY(-1px);

            box-shadow:
                0 4px 12px
                rgba(220, 53, 69, .18);
        }


        /* =========================================================
           SAVE BUTTON
        ========================================================== */

        .thesis-save-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 120px;

            color:
                var(--thesis-blue);

            background:
                #ffffff;

            border:
                1px solid
                var(--thesis-blue);
        }


        .thesis-save-button:hover {

            color:
                #ffffff;

            background:
                var(--thesis-blue);

            border-color:
                var(--thesis-blue);

            transform:
                translateY(-1px);

            box-shadow:
                0 4px 12px
                rgba(13, 110, 253, .18);
        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] .thesis-create-wrapper,
        .dark .thesis-create-wrapper {

            --thesis-card-bg: #181d33;

            --thesis-input-bg: #20253a;

            --thesis-input-focus-bg: #20253a;

            --thesis-text: #eeeef8;

            --thesis-text-secondary: #d5d8e8;

            --thesis-muted: #999fb9;

            --thesis-border: #292e45;

            --thesis-divider: #292e45;

            --thesis-purple: #7c5ce3;

            --thesis-purple-hover: #6d4fd0;

            --thesis-shadow:
                0 8px 24px
                rgba(0, 0, 0, .50);
        }


        [data-bs-theme="dark"] .thesis-create-card,
        .dark .thesis-create-card {

            background:
                #181d33;

            color:
                #eeeef8;

            box-shadow:
                0 8px 24px
                rgba(0, 0, 0, .50);
        }


        [data-bs-theme="dark"] .thesis-create-header,
        .dark .thesis-create-header {

            border-bottom-color:
                #292e45;
        }


        [data-bs-theme="dark"] .thesis-create-title,
        .dark .thesis-create-title {

            color:
                #eeeef8;
        }


        [data-bs-theme="dark"] .thesis-create-overline,
        .dark .thesis-create-overline {

            color:
                #7c5ce3;
        }


        [data-bs-theme="dark"] .thesis-create-description,
        .dark .thesis-create-description {

            color:
                #999fb9;
        }


        [data-bs-theme="dark"] .thesis-form-label,
        .dark .thesis-form-label {

            color:
                #d5d8e8;
        }


        [data-bs-theme="dark"] .thesis-form-control,
        .dark .thesis-form-control {

            color:
                #eeeef8;

            background:
                #20253a;

            border-color:
                #292e45;
        }


        [data-bs-theme="dark"] .thesis-form-control::placeholder,
        .dark .thesis-form-control::placeholder {

            color:
                #999fb9;

            opacity: .9;
        }


        [data-bs-theme="dark"] .thesis-form-control:hover,
        .dark .thesis-form-control:hover {

            border-color:
                #7c5ce3;
        }


        [data-bs-theme="dark"] .thesis-form-control:focus,
        .dark .thesis-form-control:focus {

            color:
                #eeeef8;

            background:
                #20253a;

            border-color:
                #7c5ce3;

            box-shadow:
                0 0 0 3px
                rgba(124, 92, 227, .16);
        }


        /* =========================================================
           DARK MODE DEPARTMENT
        ========================================================== */

        [data-bs-theme="dark"] .thesis-department-display,
        .dark .thesis-department-display {

            background:
                #20253a;

            border-color:
                #292e45;
        }


        [data-bs-theme="dark"] .thesis-department-name,
        .dark .thesis-department-name {

            color:
                #eeeef8;
        }


        [data-bs-theme="dark"] .thesis-department-note,
        .dark .thesis-department-note {

            color:
                #999fb9;
        }


        /* =========================================================
           DARK MODE FILE
        ========================================================== */

        [data-bs-theme="dark"] .thesis-file-input,
        .dark .thesis-file-input {

            color:
                #eeeef8;

            background:
                #20253a;
        }


        [data-bs-theme="dark"] .thesis-file-input::file-selector-button,
        .dark .thesis-file-input::file-selector-button {

            color:
                #ffffff;

            background:
                #7c5ce3;
        }


        [data-bs-theme="dark"] .thesis-file-input::file-selector-button:hover,
        .dark .thesis-file-input::file-selector-button:hover {

            color:
                #ffffff;

            background:
                #6d4fd0;
        }


        [data-bs-theme="dark"] .thesis-file-help,
        .dark .thesis-file-help {

            color:
                #999fb9;
        }


        /* =========================================================
           DARK MODE ERRORS
        ========================================================== */

        [data-bs-theme="dark"] .thesis-error,
        .dark .thesis-error {

            color:
                #fca5a5;
        }


        /* =========================================================
           DARK MODE ACTION BORDER
        ========================================================== */

        [data-bs-theme="dark"] .thesis-form-actions,
        .dark .thesis-form-actions {

            border-top-color:
                #292e45;
        }


        /* =========================================================
           DARK MODE CANCEL
        ========================================================== */

        [data-bs-theme="dark"] .thesis-cancel-button,
        .dark .thesis-cancel-button {

            color:
                #f87171;

            background:
                transparent;

            border-color:
                #f87171;
        }


        [data-bs-theme="dark"] .thesis-cancel-button:hover,
        .dark .thesis-cancel-button:hover {

            color:
                #ffffff;

            background:
                #dc3545;

            border-color:
                #dc3545;
        }


        /* =========================================================
           DARK MODE SAVE
        ========================================================== */

        [data-bs-theme="dark"] .thesis-save-button,
        .dark .thesis-save-button {

            color:
                #60a5fa;

            background:
                transparent;

            border-color:
                #60a5fa;
        }


        [data-bs-theme="dark"] .thesis-save-button:hover,
        .dark .thesis-save-button:hover {

            color:
                #ffffff;

            background:
                #0d6efd;

            border-color:
                #0d6efd;
        }


        /* =========================================================
           DARK MODE AUTOFILL
        ========================================================== */

        [data-bs-theme="dark"] .thesis-form-control:-webkit-autofill,
        .dark .thesis-form-control:-webkit-autofill {

            -webkit-text-fill-color:
                #eeeef8;

            -webkit-box-shadow:
                0 0 0 1000px
                #20253a inset;

            box-shadow:
                0 0 0 1000px
                #20253a inset;

            border-color:
                #292e45;
        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .thesis-create-wrapper {

                width: 100%;

                margin-left: 0;

                padding:
                    90px
                    10px
                    20px;
            }


            .thesis-create-header {

                padding: 1rem;
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


            .thesis-department-display {

                align-items: flex-start;

                flex-direction: column;

                gap: .2rem;
            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .thesis-create-wrapper {

                padding:
                    85px
                    8px
                    20px;
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


            .thesis-form-control {

                height: 44px;

                font-size: .8rem;
            }


            .thesis-textarea {

                min-height: 105px;
            }

        }


        /* =========================================================
           VERY SMALL MOBILE
        ========================================================== */

        @media (max-width: 380px) {

            .thesis-create-wrapper {

                padding:
                    80px
                    6px
                    15px;
            }


            .thesis-create-card {

                border-radius: 9px;
            }


            .thesis-create-header {

                padding: .8rem;
            }


            .thesis-create-form {

                padding: .8rem;
            }


            .thesis-create-title {

                font-size: 1rem;
            }


            .thesis-create-description {

                font-size: .72rem;
            }


            .thesis-form-label {

                font-size: .64rem;
            }


            .thesis-form-control {

                font-size: .78rem;
            }

        }


        /* =========================================================
           REDUCED MOTION
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            .thesis-form-control,
            .thesis-cancel-button,
            .thesis-save-button,
            .thesis-file-input::file-selector-button {

                transition: none;
            }

        }

    </style>

</x-app-layout>
```
