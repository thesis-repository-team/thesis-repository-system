<x-app-layout>

    <div class="thesis-create-wrapper">

        <div class="thesis-create-card">

            {{-- HEADER --}}
            <div class="thesis-create-header">
                <span class="thesis-create-overline">MANAGEMENT</span>

                <h2 class="thesis-create-title">
                    Add Thesis
                </h2>

                <p class="thesis-create-description">
                    Add a new thesis to the repository.
                </p>
            </div>


            {{-- FORM --}}
            <form
                action="{{ route('admin.thesis.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="thesis-create-form">

                @csrf


                {{-- TITLE --}}
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
                        required>

                    @error('title')
                        <div class="thesis-error">{{ $message }}</div>
                    @enderror
                </div>


                {{-- AUTHOR --}}
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
                        required>

                    @error('author_name')
                        <div class="thesis-error">{{ $message }}</div>
                    @enderror
                </div>


                {{-- DEPARTMENT --}}
                <div class="thesis-form-group">
                    <label for="department_id" class="thesis-form-label">
                        Department
                    </label>

                    <select
                        id="department_id"
                        name="department_id"
                        class="thesis-form-control thesis-form-select @error('department_id') is-invalid @enderror"
                        required>

                        <option value="">Select Department</option>

                        @foreach ($departments as $department)
                            <option
                                value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('department_id')
                        <div class="thesis-error">{{ $message }}</div>
                    @enderror
                </div>


                {{-- FILE --}}
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
                        required>

                    <small class="thesis-file-help">
                        PDF only. You may upload one or more files.
                    </small>

                    @error('files')
                        <div class="thesis-error">{{ $message }}</div>
                    @enderror

                    @error('files.*')
                        <div class="thesis-error">{{ $message }}</div>
                    @enderror
                </div>


                {{-- ABSTRACT --}}
                <div class="thesis-form-group thesis-full-width">
                    <label for="abstract" class="thesis-form-label">
                        Abstract
                    </label>

                    <textarea
                        id="abstract"
                        name="abstract"
                        class="thesis-form-control thesis-textarea @error('abstract') is-invalid @enderror"
                        rows="5"
                        placeholder="Enter thesis abstract">{{ old('abstract') }}</textarea>

                    @error('abstract')
                        <div class="thesis-error">{{ $message }}</div>
                    @enderror
                </div>


                {{-- DESCRIPTION --}}
                <div class="thesis-form-group thesis-full-width">
                    <label for="description" class="thesis-form-label">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="thesis-form-control thesis-textarea @error('description') is-invalid @enderror"
                        rows="5"
                        placeholder="Enter thesis description">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="thesis-error">{{ $message }}</div>
                    @enderror
                </div>


                {{-- ACTIONS --}}
                <div class="thesis-form-actions">

                    <a
                        href="{{ route('admin.thesis.index') }}"
                        class="thesis-cancel-button">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="thesis-save-button">

                        <i class="bi bi-check-lg"></i>

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
            margin-left: 250px;
            width: 86%;
            padding: 118px 20px 30px;
            box-sizing: border-box;
        }


        /* =========================================================
           CARD
        ========================================================== */

        .thesis-create-card {
            width: 100%;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .06);
            overflow: hidden;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .thesis-create-header {
            padding: 1.4rem 1.5rem;
        }

        .thesis-create-overline {
            display: block;
            margin-bottom: .25rem;
            color: #777;
            font-size: .65rem;
            font-weight: 800;
            letter-spacing: .1em;
        }

        .thesis-create-title {
            margin: 0;
            color: #000;
            font-size: 1.25rem;
            font-weight: 800;
        }

        .thesis-create-description {
            margin: .35rem 0 0;
            color: #777;
            font-size: .78rem;
        }


        /* =========================================================
           FORM
        ========================================================== */

        .thesis-create-form {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.15rem 1.25rem;
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
            color: #333;
            font-size: .68rem;
            font-weight: 800;
            letter-spacing: .05em;
            text-transform: uppercase;
        }


        /* =========================================================
           INPUT / SELECT / TEXTAREA
        ========================================================== */

        .thesis-form-control {
            display: block;
            width: 100%;
            min-width: 0;
            height: 45px;
            padding: .55rem .85rem;
            box-sizing: border-box;

            color: #000;
            background: #fafafa;

            border: 1px solid #ddd;
            border-radius: 8px;

            outline: none;
            font-family: inherit;
            font-size: .82rem;

            transition: .2s ease;
        }

        .thesis-form-control:hover {
            border-color: #bbb;
        }

        .thesis-form-control:focus {
            background: #fff;
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, .08);
        }

        .thesis-form-control.is-invalid {
            border-color: #000;
        }


        /* =========================================================
           SELECT
        ========================================================== */

        .thesis-form-select {
            cursor: pointer;
        }

        .thesis-form-select option {
            background: #fff;
            color: #000;
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
           FILE
        ========================================================== */

        .thesis-file-input {
            padding-top: .65rem;
            cursor: pointer;
        }

        .thesis-file-input::file-selector-button {
            margin-right: .6rem;
            padding: .4rem .7rem;

            color: #fff;
            background: #000;

            border: 0;
            border-radius: 6px;

            font-size: .7rem;
            font-weight: 700;

            cursor: pointer;
        }

        .thesis-file-help {
            display: block;
            margin-top: .4rem;
            color: #777;
            font-size: .68rem;
        }


        /* =========================================================
           ERROR
        ========================================================== */

        .thesis-error {
            margin-top: .35rem;
            color: #000;
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

            border-top: 1px solid #eee;
        }


        /* =========================================================
           BUTTONS
        ========================================================== */

        .thesis-cancel-button,
        .thesis-save-button {
            min-height: 42px;
            padding: .65rem 1rem;

            border-radius: 8px;

            font-size: .7rem;
            font-weight: 800;

            text-transform: uppercase;
            text-decoration: none;

            cursor: pointer;

            transition: .2s ease;
        }


        /* CANCEL */

        .thesis-cancel-button {
            color: #000;
            background: #fff;
            border: 1px solid #ddd;
        }

        .thesis-cancel-button:hover {
            color: #fff;
            background: #000;
            border-color: #000;
        }


        /* SAVE */

        .thesis-save-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;

            color: #fff;
            background: #000;

            border: 1px solid #000;
        }

        .thesis-save-button:hover {
            background: #222;
            border-color: #222;
            transform: translateY(-1px);
        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .thesis-create-wrapper {
                width: 100%;
                margin-left: 0;
                padding: 90px 10px 20px;
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
        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 575.98px) {

            .thesis-create-wrapper {
                padding: 85px 8px 20px;
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

    </style>

</x-app-layout>