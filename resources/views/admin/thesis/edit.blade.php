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
                class="thesis-edit-form">

                @csrf
                @method('PUT')


                {{-- =================================================
                    TITLE
                ================================================== --}}

                <div class="thesis-edit-group">

                    <label
                        for="title"
                        class="thesis-edit-label">

                        Title

                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $thesis->title) }}"
                        class="thesis-edit-control @error('title') is-invalid @enderror"
                        placeholder="Enter thesis title"
                        required>

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
                        class="thesis-edit-label">

                        Author Name

                    </label>

                    <input
                        type="text"
                        id="author_name"
                        name="author_name"
                        value="{{ old('author_name', $thesis->author_name) }}"
                        class="thesis-edit-control @error('author_name') is-invalid @enderror"
                        placeholder="Enter author name"
                        required>

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
                        class="thesis-edit-label">

                        Abstract

                    </label>

                    <textarea
                        id="abstract"
                        name="abstract"
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

                    <label
                        for="description"
                        class="thesis-edit-label">

                        Description

                    </label>

                    <textarea
                        id="description"
                        name="description"
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


                                    <a
                                        href="{{ asset('storage/' . $file->file_path) }}"
                                        target="_blank"
                                        class="thesis-view-button">

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
                        class="thesis-edit-label">

                        Replace Thesis File(s)

                    </label>

                    <input
                        type="file"
                        id="files"
                        name="files[]"
                        class="thesis-edit-control thesis-file-input @error('files') is-invalid @enderror"
                        accept=".pdf"
                        multiple>


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

                    <a
                        href="{{ route('admin.thesis.index') }}"
                        class="thesis-cancel-button">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="thesis-update-button">

                        <i class="bi bi-check-lg"></i>

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

            margin-left: 250px;

            width: 86%;

            padding-top: 118px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 30px;

            box-sizing: border-box;

            overflow-x: hidden;

        }


        /* =========================================================
           CARD
        ========================================================== */

        .thesis-edit-card {

            width: 100%;

            background: #ffffff;

            border-radius: 12px;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .06);

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

            color: #777777;

            font-size: .65rem;

            font-weight: 800;

            letter-spacing: .1em;

            text-transform: uppercase;

        }


        .thesis-edit-title {

            margin: 0;

            color: #000000;

            font-size: 1.25rem;

            font-weight: 800;

            line-height: 1.3;

        }


        .thesis-edit-description {

            margin: .35rem 0 0;

            color: #777777;

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

            color: #333333;

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

            color: #000000;

            background: #fafafa;

            border: 1px solid #dddddd;

            border-radius: 8px;

            outline: none;

            font-family: inherit;

            font-size: .82rem;

            transition: .2s ease;

        }


        .thesis-edit-control:hover {

            border-color: #bbbbbb;

        }


        .thesis-edit-control:focus {

            background: #ffffff;

            border-color: #000000;

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, .08);

        }


        .thesis-edit-control.is-invalid {

            border-color: #000000;

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

            background: #fafafa;

            border: 1px solid #dddddd;

            border-radius: 8px;

            box-sizing: border-box;

        }


        .thesis-file-name {

            display: flex;

            align-items: center;

            gap: .55rem;

            min-width: 0;

            color: #222222;

            font-size: .78rem;

        }


        .thesis-file-name i {

            flex-shrink: 0;

            color: #000000;

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

            flex-shrink: 0;

            padding: .4rem .7rem;

            color: #000000;

            background: #ffffff;

            border: 1px solid #dddddd;

            border-radius: 6px;

            font-size: .68rem;

            font-weight: 800;

            text-decoration: none;

            text-transform: uppercase;

            transition: .2s ease;

        }


        .thesis-view-button:hover {

            color: #ffffff;

            background: #000000;

            border-color: #000000;

        }


        /* =========================================================
           NO FILE
        ========================================================== */

        .thesis-no-file {

            padding: .75rem;

            color: #777777;

            background: #fafafa;

            border: 1px solid #eeeeee;

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

            background: #000000;

            border: none;

            border-radius: 6px;

            font-size: .7rem;

            font-weight: 700;

            cursor: pointer;

        }


        .thesis-file-input::file-selector-button:hover {

            background: #222222;

        }


        /* =========================================================
           FILE HELP
        ========================================================== */

        .thesis-file-help {

            margin-top: .4rem;

            color: #777777;

            font-size: .68rem;

            line-height: 1.5;

        }


        /* =========================================================
           ERROR
        ========================================================== */

        .thesis-edit-error {

            margin-top: .35rem;

            color: #000000;

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

            border-top: 1px solid #eeeeee;

            box-sizing: border-box;

        }


        /* =========================================================
           BUTTONS
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

            transition: .2s ease;

        }


        /* =========================================================
           CANCEL
        ========================================================== */

        .thesis-cancel-button {

            color: #000000;

            background: #ffffff;

            border: 1px solid #dddddd;

        }


        .thesis-cancel-button:hover {

            color: #ffffff;

            background: #000000;

            border-color: #000000;

        }


        /* =========================================================
           UPDATE
        ========================================================== */

        .thesis-update-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .4rem;

            color: #ffffff;

            background: #000000;

            border: 1px solid #000000;

        }


        .thesis-update-button:hover {

            background: #222222;

            border-color: #222222;

            transform: translateY(-1px);

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

        }

    </style>

</x-app-layout>