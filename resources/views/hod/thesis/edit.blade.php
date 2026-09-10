<x-app-layout>

    <div class="thesis-edit-wrapper">

        <div class="thesis-edit-card">

            {{-- =================================================
            FORM HEADER
        ================================================== --}}
            <div class="thesis-edit-header">

                <span class="thesis-edit-overline">
                    MANAGEMENT
                </span>

                <h2 class="thesis-edit-title">
                    Edit Thesis
                </h2>

                <p class="thesis-edit-description">
                    Update the thesis information and files.
                </p>

            </div>


            {{-- =================================================
            FORM
        ================================================== --}}
            <form action="{{ route('hod.thesis.update', $thesis) }}" method="POST" enctype="multipart/form-data"
                class="thesis-edit-form">

                @csrf
                @method('PUT')


                {{-- =================================================
                TITLE
            ================================================== --}}
                <div class="thesis-edit-group">

                    <label for="title" class="thesis-edit-label">
                        Title
                    </label>

                    <input type="text" id="title" name="title" value="{{ old('title', $thesis->title) }}"
                        class="thesis-edit-control @error('title') is-invalid @enderror"
                        placeholder="Enter thesis title" required>

                    @error('title')
                        <div class="thesis-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =================================================
                AUTHOR NAME
            ================================================== --}}
                <div class="thesis-edit-group">

                    <label for="author_name" class="thesis-edit-label">
                        Author Name
                    </label>

                    <input type="text" id="author_name" name="author_name"
                        value="{{ old('author_name', $thesis->author_name) }}"
                        class="thesis-edit-control @error('author_name') is-invalid @enderror"
                        placeholder="Enter author name" required>

                    @error('author_name')
                        <div class="thesis-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =================================================
                ABSTRACT
            ================================================== --}}
                <div class="thesis-edit-group thesis-edit-full">

                    <label for="abstract" class="thesis-edit-label">
                        Abstract
                    </label>

                    <textarea id="abstract" name="abstract"
                        class="thesis-edit-control thesis-edit-textarea @error('abstract') is-invalid @enderror"
                        placeholder="Enter thesis abstract">{{ old('abstract', $thesis->abstract) }}</textarea>

                    @error('abstract')
                        <div class="thesis-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =================================================
                DESCRIPTION
            ================================================== --}}
                <div class="thesis-edit-group thesis-edit-full">

                    <label for="description" class="thesis-edit-label">
                        Description
                    </label>

                    <textarea id="description" name="description"
                        class="thesis-edit-control thesis-edit-textarea @error('description') is-invalid @enderror"
                        placeholder="Enter thesis description">{{ old('description', $thesis->description) }}</textarea>

                    @error('description')
                        <div class="thesis-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =================================================
                CURRENT FILES
            ================================================== --}}
                <div class="thesis-edit-group thesis-edit-full">

                    <label class="thesis-edit-label">
                        Current Thesis File(s)
                    </label>

                    @if ($thesis->files->count())

                        <div class="thesis-current-files">

                            @foreach ($thesis->files as $file)
                                <div class="thesis-current-file">

                                    <div class="thesis-file-name">

                                        <i class="bi bi-file-earmark-pdf"></i>

                                        <span>
                                            {{ $file->file_name }}
                                        </span>

                                    </div>


                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                        class="thesis-view-button">

                                        <i class="bi bi-eye"></i>
                                        View

                                    </a>

                                </div>
                            @endforeach

                        </div>
                    @else
                        <div class="thesis-no-file">
                            No file uploaded.
                        </div>

                    @endif

                </div>


                {{-- =================================================
                REPLACE FILES
            ================================================== --}}
                <div class="thesis-edit-group thesis-edit-full">

                    <label for="files" class="thesis-edit-label">
                        Replace Thesis File(s)
                    </label>

                    <input type="file" id="files" name="files[]"
                        class="thesis-edit-control thesis-file-input @error('files') is-invalid @enderror"
                        accept=".pdf" multiple>

                    <div class="thesis-file-help">
                        Leave empty to keep the current file(s).
                        PDF files only.
                    </div>

                    @error('files')
                        <div class="thesis-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                    @error('files.*')
                        <div class="thesis-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =================================================
                ACTIONS
            ================================================== --}}
                <div class="thesis-edit-actions">

                    {{-- CANCEL - NO ICON --}}
                    <a href="{{ route('hod.thesis.index') }}" class="thesis-cancel-button">
                        Cancel
                    </a>


                    {{-- UPDATE - NO ICON --}}
                    <button type="submit" class="thesis-update-button">
                        Update Thesis
                    </button>

                </div>

            </form>

        </div>

    </div>


    <style>
        /* =========================================================
       PAGE
    ========================================================== */

        .thesis-edit-wrapper {

            --thesis-card-bg: #ffffff;
            --thesis-input-bg: #fafafa;
            --thesis-input-focus-bg: #ffffff;

            --thesis-text: #111111;
            --thesis-text-secondary: #333333;
            --thesis-muted: #777777;

            --thesis-border: #dddddd;
            --thesis-divider: #eeeeee;

            --thesis-blue: #0d6efd;
            --thesis-blue-hover: #0b5ed7;

            --thesis-red: #dc3545;
            --thesis-red-hover: #bb2d3b;

            --thesis-shadow:
                0 4px 18px rgba(0, 0, 0, .06);

            margin-left: 250px;
            width: 86%;

            padding-top: 118px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 30px;

            box-sizing: border-box;
            overflow-x: hidden;

            color: var(--thesis-text);
        }


        /* =========================================================
       CARD
    ========================================================== */

        .thesis-edit-card {

            width: 100%;

            background: var(--thesis-card-bg);

            border-radius: 12px;

            box-shadow: var(--thesis-shadow);

            overflow: hidden;

            box-sizing: border-box;
        }


        /* =========================================================
       HEADER
    ========================================================== */

        .thesis-edit-header {

            width: 100%;

            padding: 1.4rem 1.5rem;

            box-sizing: border-box;
        }


        .thesis-edit-overline {

            display: block;

            margin-bottom: .25rem;

            color: #6538d9;

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .1em;

            text-transform: uppercase;
        }


        .thesis-edit-title {

            margin: 0;

            color: var(--thesis-text);

            font-size: 1.25rem;

            font-weight: 800;

            line-height: 1.3;
        }


        .thesis-edit-description {

            margin: .35rem 0 0;

            color: var(--thesis-muted);

            font-size: .78rem;

            line-height: 1.5;
        }


        /* =========================================================
       FORM
    ========================================================== */

        .thesis-edit-form {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 1.15rem 1.25rem;

            width: 100%;

            padding: 1.5rem;

            box-sizing: border-box;
        }


        /* =========================================================
       GROUP
    ========================================================== */

        .thesis-edit-group {

            min-width: 0;

            width: 100%;

            box-sizing: border-box;
        }


        .thesis-edit-full {

            grid-column: 1 / -1;
        }


        /* =========================================================
       LABEL
    ========================================================== */

        .thesis-edit-label {

            display: block;

            margin-bottom: .45rem;

            color: var(--thesis-text-secondary);

            font-size: .68rem;

            font-weight: 800;

            letter-spacing: .05em;

            text-transform: uppercase;
        }


        /* =========================================================
       INPUT
    ========================================================== */

        .thesis-edit-control {

            display: block;

            width: 100%;

            height: 45px;

            min-width: 0;

            padding: .55rem .85rem;

            box-sizing: border-box;

            color: var(--thesis-text);

            background: var(--thesis-input-bg);

            border: 1px solid var(--thesis-border);

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


        .thesis-edit-control::placeholder {

            color: var(--thesis-muted);

            opacity: .8;
        }


        .thesis-edit-control:hover {

            border-color: var(--thesis-text-secondary);
        }


        .thesis-edit-control:focus {

            color: var(--thesis-text);

            background: var(--thesis-input-focus-bg);

            border-color: var(--thesis-blue);

            box-shadow:
                0 0 0 3px rgba(13, 110, 253, .12);
        }


        .thesis-edit-control.is-invalid {

            border-color: var(--thesis-red);
        }


        /* =========================================================
       TEXTAREA
    ========================================================== */

        .thesis-edit-textarea {

            height: 100px;

            min-height: 100px;

            resize: vertical;

            line-height: 1.5;
        }


        /* =========================================================
       CURRENT FILES
    ========================================================== */

        .thesis-current-files {

            display: flex;

            flex-direction: column;

            gap: .55rem;

            width: 100%;
        }


        .thesis-current-file {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 1rem;

            min-height: 45px;

            padding: .55rem .7rem;

            background: var(--thesis-input-bg);

            border: 1px solid var(--thesis-border);

            border-radius: 8px;

            box-sizing: border-box;

            transition:
                background .2s ease,
                border-color .2s ease;
        }


        .thesis-current-file:hover {

            border-color: var(--thesis-text-secondary);
        }


        /* =========================================================
       FILE NAME
    ========================================================== */

        .thesis-file-name {

            display: flex;

            align-items: center;

            gap: .55rem;

            min-width: 0;

            color: var(--thesis-text-secondary);

            font-size: .78rem;
        }


        .thesis-file-name i {

            flex-shrink: 0;

            color: var(--thesis-red);

            font-size: 1rem;
        }


        .thesis-file-name span {

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================================================
       VIEW BUTTON
    ========================================================== */

        .thesis-view-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .35rem;

            flex-shrink: 0;

            padding: .4rem .7rem;

            color: #ffffff;

            background: var(--thesis-blue);

            border: 1px solid var(--thesis-blue);

            border-radius: 6px;

            font-size: .68rem;

            font-weight: 800;

            text-decoration: none;

            text-transform: uppercase;

            transition:
                background .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }


        .thesis-view-button:hover {

            color: #ffffff;

            background: var(--thesis-blue-hover);

            border-color: var(--thesis-blue-hover);

            transform: translateY(-1px);
        }


        /* =========================================================
       NO FILE
    ========================================================== */

        .thesis-no-file {

            padding: .75rem;

            color: var(--thesis-muted);

            background: var(--thesis-input-bg);

            border: 1px solid var(--thesis-divider);

            border-radius: 8px;

            font-size: .72rem;
        }


        /* =========================================================
       FILE INPUT
    ========================================================== */

        .thesis-file-input {

            padding-top: .65rem;

            padding-bottom: .65rem;

            cursor: pointer;
        }


        .thesis-file-input::file-selector-button {

            margin-right: .6rem;

            padding: .4rem .7rem;

            color: #ffffff;

            background: #111111;

            border: none;

            border-radius: 6px;

            font-size: .7rem;

            font-weight: 700;

            cursor: pointer;

            transition: background .2s ease;
        }


        .thesis-file-input::file-selector-button:hover {

            background: #222222;
        }


        /* =========================================================
       FILE HELP
    ========================================================== */

        .thesis-file-help {

            margin-top: .4rem;

            color: var(--thesis-muted);

            font-size: .68rem;

            line-height: 1.5;
        }


        /* =========================================================
       ERROR
    ========================================================== */

        .thesis-edit-error {

            margin-top: .35rem;

            color: var(--thesis-red);

            font-size: .7rem;

            font-weight: 600;

            line-height: 1.4;
        }


        /* =========================================================
       ACTIONS
    ========================================================== */

        .thesis-edit-actions {

            grid-column: 1 / -1;

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: .6rem;

            width: 100%;

            padding-top: 1rem;

            border-top:
                1px solid var(--thesis-divider);

            box-sizing: border-box;
        }


        /* =========================================================
       BUTTON BASE
    ========================================================== */

        .thesis-cancel-button,
        .thesis-update-button {

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
                background .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }


        /* =========================================================
       CANCEL
       RED BORDER
       NO ICON
    ========================================================== */

        .thesis-cancel-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            color: var(--thesis-red);

            background: transparent;

            border: 1px solid var(--thesis-red);
        }


        .thesis-cancel-button:hover {

            color: #ffffff;

            background: var(--thesis-red);

            border-color: var(--thesis-red);

            transform: translateY(-1px);
        }


        /* =========================================================
       UPDATE
       BLUE BORDER
       NO ICON
    ========================================================== */

        .thesis-update-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            color: var(--thesis-blue);

            background: transparent;

            border: 1px solid var(--thesis-blue);
        }


        .thesis-update-button:hover {

            color: #ffffff;

            background: var(--thesis-blue);

            border-color: var(--thesis-blue);

            transform: translateY(-1px);
        }


        /* =========================================================
       DARK MODE VARIABLES
    ========================================================== */

        [data-bs-theme="dark"] .thesis-edit-wrapper {

            --thesis-card-bg: #181d33;

            --thesis-input-bg: #20253a;

            --thesis-input-focus-bg: #20253a;

            --thesis-text: #eeeef8;

            --thesis-text-secondary: #d5d8e8;

            --thesis-muted: #999fb9;

            --thesis-border: #292e45;

            --thesis-divider: #292e45;

            --thesis-shadow:
                0 8px 24px rgba(0, 0, 0, .50);
        }


        .dark .thesis-edit-wrapper {

            --thesis-card-bg: #181d33;

            --thesis-input-bg: #20253a;

            --thesis-input-focus-bg: #20253a;

            --thesis-text: #eeeef8;

            --thesis-text-secondary: #d5d8e8;

            --thesis-muted: #999fb9;

            --thesis-border: #292e45;

            --thesis-divider: #292e45;

            --thesis-shadow:
                0 8px 24px rgba(0, 0, 0, .50);
        }


        /* =========================================================
       DARK MODE CARD
    ========================================================== */

        [data-bs-theme="dark"] .thesis-edit-card,
        .dark .thesis-edit-card {

            background: #181d33;

            color: #eeeef8;

            box-shadow:
                0 8px 24px rgba(0, 0, 0, .50);
        }


        /* =========================================================
       DARK MODE HEADER
    ========================================================== */

        [data-bs-theme="dark"] .thesis-edit-title,
        .dark .thesis-edit-title {

            color: #eeeef8;
        }


        [data-bs-theme="dark"] .thesis-edit-overline,
        .dark .thesis-edit-overline {

            color: #999fb9;
        }


        [data-bs-theme="dark"] .thesis-edit-description,
        .dark .thesis-edit-description {

            color: #999fb9;
        }


        /* =========================================================
       DARK MODE LABEL
    ========================================================== */

        [data-bs-theme="dark"] .thesis-edit-label,
        .dark .thesis-edit-label {

            color: #d5d8e8;
        }


        /* =========================================================
       DARK MODE INPUTS
    ========================================================== */

        [data-bs-theme="dark"] .thesis-edit-control,
        .dark .thesis-edit-control {

            color: #eeeef8;

            background: #20253a;

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .thesis-edit-control::placeholder,
        .dark .thesis-edit-control::placeholder {

            color: #999fb9;

            opacity: .9;
        }


        [data-bs-theme="dark"] .thesis-edit-control:hover,
        .dark .thesis-edit-control:hover {

            border-color: #555b75;
        }


        [data-bs-theme="dark"] .thesis-edit-control:focus,
        .dark .thesis-edit-control:focus {

            color: #eeeef8;

            background: #20253a;

            border-color: var(--thesis-blue);

            box-shadow:
                0 0 0 3px rgba(13, 110, 253, .18);
        }


        /* =========================================================
       DARK MODE CURRENT FILE
    ========================================================== */

        [data-bs-theme="dark"] .thesis-current-file,
        .dark .thesis-current-file {

            color: #d5d8e8;

            background: #20253a;

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .thesis-current-file:hover,
        .dark .thesis-current-file:hover {

            border-color: #555b75;
        }


        [data-bs-theme="dark"] .thesis-file-name,
        .dark .thesis-file-name {

            color: #d5d8e8;
        }


        [data-bs-theme="dark"] .thesis-file-name i,
        .dark .thesis-file-name i {

            color: #f87171;
        }


        /* =========================================================
       DARK MODE NO FILE
    ========================================================== */

        [data-bs-theme="dark"] .thesis-no-file,
        .dark .thesis-no-file {

            color: #999fb9;

            background: #20253a;

            border-color: #292e45;
        }


        /* =========================================================
       DARK MODE FILE INPUT
    ========================================================== */

        [data-bs-theme="dark"] .thesis-file-input,
        .dark .thesis-file-input {

            color: #eeeef8;

            background: #20253a;

            border-color: #292e45;
        }


        [data-bs-theme="dark"] .thesis-file-input::file-selector-button,
        .dark .thesis-file-input::file-selector-button {

            color: #111111;

            background: #ffffff;
        }


        [data-bs-theme="dark"] .thesis-file-input::file-selector-button:hover,
        .dark .thesis-file-input::file-selector-button:hover {

            color: #111111;

            background: #e5e5e5;
        }


        [data-bs-theme="dark"] .thesis-file-help,
        .dark .thesis-file-help {

            color: #999fb9;
        }


        /* =========================================================
       DARK MODE ERRORS
    ========================================================== */

        [data-bs-theme="dark"] .thesis-edit-error,
        .dark .thesis-edit-error {

            color: #fca5a5;
        }


        /* =========================================================
       DARK MODE ACTION BORDER
    ========================================================== */

        [data-bs-theme="dark"] .thesis-edit-actions,
        .dark .thesis-edit-actions {

            border-top-color: #292e45;
        }


        /* =========================================================
       DARK MODE VIEW BUTTON
    ========================================================== */

        [data-bs-theme="dark"] .thesis-view-button,
        .dark .thesis-view-button {

            color: #ffffff;

            background: #0d6efd;

            border-color: #0d6efd;
        }


        [data-bs-theme="dark"] .thesis-view-button:hover,
        .dark .thesis-view-button:hover {

            color: #ffffff;

            background: #0b5ed7;

            border-color: #0b5ed7;
        }


        /* =========================================================
       DARK MODE CANCEL
       RED BORDER
    ========================================================== */

        [data-bs-theme="dark"] .thesis-cancel-button,
        .dark .thesis-cancel-button {

            color: #f87171;

            background: transparent;

            border-color: #dc3545;
        }


        [data-bs-theme="dark"] .thesis-cancel-button:hover,
        .dark .thesis-cancel-button:hover {

            color: #ffffff;

            background: #dc3545;

            border-color: #dc3545;
        }


        /* =========================================================
       DARK MODE UPDATE
       BLUE BORDER
    ========================================================== */

        [data-bs-theme="dark"] .thesis-update-button,
        .dark .thesis-update-button {

            color: #60a5fa;

            background: transparent;

            border-color: #0d6efd;
        }


        [data-bs-theme="dark"] .thesis-update-button:hover,
        .dark .thesis-update-button:hover {

            color: #ffffff;

            background: #0d6efd;

            border-color: #0d6efd;
        }


        /* =========================================================
       DARK MODE AUTOFILL
    ========================================================== */

        [data-bs-theme="dark"] .thesis-edit-control:-webkit-autofill,
        .dark .thesis-edit-control:-webkit-autofill {

            -webkit-text-fill-color: #eeeef8;

            -webkit-box-shadow:
                0 0 0 1000px #20253a inset;

            box-shadow:
                0 0 0 1000px #20253a inset;

            border-color: #292e45;
        }


        /* =========================================================
       MOBILE
    ========================================================== */

        @media (max-width: 767.98px) {

            .thesis-edit-wrapper {

                width: 100%;

                margin-left: 0;

                padding-top: 90px;

                padding-left: 10px;

                padding-right: 10px;

                padding-bottom: 20px;
            }


            .thesis-edit-header {

                padding: 1rem;
            }


            .thesis-edit-form {

                grid-template-columns: 1fr;

                gap: 1rem;

                padding: 1rem;
            }


            .thesis-edit-full {

                grid-column: auto;
            }


            .thesis-edit-actions {

                flex-direction: column-reverse;

                align-items: stretch;
            }


            .thesis-cancel-button,
            .thesis-update-button {

                width: 100%;

                text-align: center;
            }


            .thesis-current-file {

                align-items: flex-start;

                flex-direction: column;

                gap: .6rem;
            }


            .thesis-view-button {

                width: 100%;
            }

        }


        /* =========================================================
       SMALL MOBILE
    ========================================================== */

        @media (max-width: 575.98px) {

            .thesis-edit-wrapper {

                padding-top: 85px;

                padding-left: 8px;

                padding-right: 8px;
            }


            .thesis-edit-header {

                padding: .9rem;
            }


            .thesis-edit-form {

                padding: .9rem;
            }


            .thesis-edit-title {

                font-size: 1.05rem;
            }


            .thesis-edit-description {

                font-size: .7rem;
            }


            .thesis-edit-control {

                height: 44px;

                font-size: .8rem;
            }


            .thesis-edit-textarea {

                height: 95px;

                min-height: 95px;
            }


            .thesis-current-file {

                padding: .5rem;
            }


            .thesis-file-name {

                font-size: .72rem;
            }


            .thesis-view-button {

                padding: .4rem .6rem;

                font-size: .65rem;
            }


            .thesis-cancel-button,
            .thesis-update-button {

                min-height: 44px;

                font-size: .68rem;
            }

        }
    </style>

</x-app-layout>
