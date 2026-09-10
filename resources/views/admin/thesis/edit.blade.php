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

            <form
                action="{{ route('admin.thesis.update', $thesis) }}"
                method="POST"
                enctype="multipart/form-data"
                class="thesis-edit-form"
            >

                @csrf
                @method('PUT')


                {{-- =================================================
                    TITLE
                ================================================== --}}

                <div class="thesis-edit-group">

                    <label
                        for="title"
                        class="thesis-edit-label"
                    >
                        Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $thesis->title) }}"
                        class="thesis-edit-control @error('title') is-invalid @enderror"
                        placeholder="Enter thesis title"
                        required
                    >

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

                    <label
                        for="author_name"
                        class="thesis-edit-label"
                    >
                        Author Name
                    </label>

                    <input
                        type="text"
                        id="author_name"
                        name="author_name"
                        value="{{ old('author_name', $thesis->author_name) }}"
                        class="thesis-edit-control @error('author_name') is-invalid @enderror"
                        placeholder="Enter author name"
                        required
                    >

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

                    <label
                        for="abstract"
                        class="thesis-edit-label"
                    >
                        Abstract
                    </label>

                    <textarea
                        id="abstract"
                        name="abstract"
                        class="thesis-edit-control thesis-edit-textarea @error('abstract') is-invalid @enderror"
                        placeholder="Enter thesis abstract"
                    >{{ old('abstract', $thesis->abstract) }}</textarea>

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

                    <label
                        for="description"
                        class="thesis-edit-label"
                    >
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="thesis-edit-control thesis-edit-textarea @error('description') is-invalid @enderror"
                        placeholder="Enter thesis description"
                    >{{ old('description', $thesis->description) }}</textarea>

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


                                    <a
                                        href="{{ asset('storage/' . $file->file_path) }}"
                                        target="_blank"
                                        class="thesis-view-button"
                                    >
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

                    <label
                        for="files"
                        class="thesis-edit-label"
                    >
                        Replace Thesis File(s)
                    </label>

                    <input
                        type="file"
                        id="files"
                        name="files[]"
                        class="thesis-edit-control thesis-file-input @error('files') is-invalid @enderror"
                        accept=".pdf"
                        multiple
                    >

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

                    {{-- CANCEL --}}

                    <a
                        href="{{ route('admin.thesis.index') }}"
                        class="thesis-cancel-button"
                    >
                        Cancel
                    </a>


                    {{-- UPDATE --}}

                    <button
                        type="submit"
                        class="thesis-update-button"
                    >
                        Update Thesis
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

            --thesis-page-bg: #ffffff;
            --thesis-card-bg: #ffffff;
            --thesis-input-bg: #fafafa;

            --thesis-text: #000000;
            --thesis-text-secondary: #333333;
            --thesis-text-muted: #777777;

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

        .thesis-edit-wrapper {

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

        .thesis-edit-card {

            width: 100%;

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

        .thesis-edit-header {

            width: 100%;

            padding: 1.4rem 1.5rem;

            background: var(--thesis-card-bg);

            border-bottom:
                1px solid var(--thesis-border-soft);

            box-sizing: border-box;

        }


        /* =========================================================
           MANAGEMENT
        ========================================================== */

        .thesis-edit-overline {

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

        .thesis-edit-title {

            margin: 0;

            color: var(--thesis-text);

            font-size: 1.25rem;

            font-weight: 800;

            line-height: 1.3;

        }


        /* =========================================================
           DESCRIPTION
        ========================================================== */

        .thesis-edit-description {

            margin: .35rem 0 0;

            color: var(--thesis-text-muted);

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

            background: var(--thesis-card-bg);

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

            max-width: 100%;

            height: 45px;

            min-width: 0;

            padding: .55rem .85rem;

            box-sizing: border-box;

            color: var(--thesis-text);

            background: var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            outline: none;

            font-family: inherit;

            font-size: .82rem;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease;

        }


        .thesis-edit-control::placeholder {

            color: var(--thesis-placeholder);

            opacity: 1;

        }


        .thesis-edit-control:hover {

            border-color: var(--thesis-border);

        }


        .thesis-edit-control:focus {

            color: var(--thesis-text);

            background: var(--thesis-input-bg);

            border-color: var(--thesis-purple);

            box-shadow:
                0 0 0 3px rgba(101, 56, 217, .10);

        }


        .thesis-edit-control.is-invalid {

            border-color: var(--thesis-red);

            box-shadow: none;

        }


        /* =========================================================
           TEXTAREA
        ========================================================== */

        .thesis-edit-textarea {

            height: 110px;

            min-height: 110px;

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

            color: var(--thesis-text);

            background: var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

            border-radius: 8px;

            box-sizing: border-box;

            transition:
                background-color .2s ease,
                border-color .2s ease;

        }


        /* =========================================================
           FILE NAME
        ========================================================== */

        .thesis-file-name {

            display: flex;

            align-items: center;

            gap: .55rem;

            min-width: 0;

            color: var(--thesis-text);

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
           PURPLE BORDER
        ========================================================== */

        .thesis-view-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            padding: .4rem .75rem;

            color: var(--thesis-purple);

            background: transparent;

            border:
                1px solid var(--thesis-purple);

            border-radius: 6px;

            font-size: .68rem;

            font-weight: 800;

            text-decoration: none;

            text-transform: uppercase;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease;

        }


        .thesis-view-button:hover {

            color: #ffffff;

            background: var(--thesis-purple);

            border-color: var(--thesis-purple);

        }


        /* =========================================================
           NO FILE
        ========================================================== */

        .thesis-no-file {

            padding: .75rem;

            color: var(--thesis-text-muted);

            background: var(--thesis-input-bg);

            border:
                1px solid var(--thesis-border-soft);

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


        /* =========================================================
           CHOOSE FILE
           PURPLE
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


        /* =========================================================
           FILE HELP
        ========================================================== */

        .thesis-file-help {

            margin-top: .4rem;

            color: var(--thesis-text-muted);

            font-size: .68rem;

            line-height: 1.5;

        }


        /* =========================================================
           ERROR
        ========================================================== */

        .thesis-edit-error {

            margin-top: .35rem;

            color: var(--thesis-red) !important;

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
                1px solid var(--thesis-border-soft);

            box-sizing: border-box;

        }


        /* =========================================================
           CANCEL
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
           UPDATE
           BLUE BORDER / NO ICON
        ========================================================== */

        .thesis-update-button {

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


        .thesis-update-button:hover {

            color: #ffffff !important;

            background: var(--thesis-blue);

            border-color: var(--thesis-blue);

            transform:
                translateY(-1px);

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


            .thesis-edit-card {

                width: 100%;

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

        }


        /* =========================================================
           REDUCED MOTION
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            .thesis-edit-wrapper *,
            .thesis-edit-wrapper *::before,
            .thesis-edit-wrapper *::after {

                transition: none !important;

                animation: none !important;

            }

        }

    </style>

</x-app-layout>