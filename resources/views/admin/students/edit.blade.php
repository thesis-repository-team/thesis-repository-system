<x-app-layout>

    <div class="student-edit-wrapper">

        <div class="student-edit-card">

            <div class="student-edit-header">
                <span class="student-edit-overline">MANAGEMENT</span>

                <h2 class="student-edit-title">Edit Student</h2>

                <p class="student-edit-description">
                    Update the student account information.
                </p>
            </div>


            <form action="{{ route('admin.students.update', $student->id) }}" method="POST" class="student-edit-form">

                @csrf
                @method('PUT')


                <div class="student-form-group">

                    <label for="full_name" class="student-form-label">
                        Full Name
                    </label>

                    <input type="text" id="full_name" name="full_name"
                        value="{{ old('full_name', $student->full_name) }}"
                        class="student-form-control @error('full_name') is-invalid @enderror"
                        placeholder="Enter full name" required>

                    @error('full_name')
                        <div class="student-error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="student-form-group">

                    <label for="email" class="student-form-label">
                        Email
                    </label>

                    <input type="email" id="email" name="email"
                        value="{{ old('email', $student->user->email ?? '') }}"
                        class="student-form-control @error('email') is-invalid @enderror"
                        placeholder="Enter email address" required>

                    @error('email')
                        <div class="student-error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="student-form-group">

                    <label for="username" class="student-form-label">
                        Username
                    </label>

                    <input type="text" id="username" name="username"
                        value="{{ old('username', $student->user->username ?? '') }}"
                        class="student-form-control @error('username') is-invalid @enderror"
                        placeholder="Enter username" required>

                    @error('username')
                        <div class="student-error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="student-form-group">

                    <label for="upload_permission" class="student-form-label">
                        Upload Permission
                    </label>

                    <select id="upload_permission" name="upload_permission"
                        class="student-form-control @error('upload_permission') is-invalid @enderror" required>

                        <option value="1"
                            {{ old('upload_permission', $student->upload_permission) == '1' ? 'selected' : '' }}>
                            Allowed
                        </option>

                        <option value="0"
                            {{ old('upload_permission', $student->upload_permission) == '0' ? 'selected' : '' }}>
                            Not Allowed
                        </option>

                    </select>

                    @error('upload_permission')
                        <div class="student-error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="student-form-actions">

                    <a href="{{ route('admin.students.index') }}" class="student-cancel-button">
                        Cancel
                    </a>

                    <button type="submit" class="student-save-button">
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

    <style>
        :root {
            --student-blue: #2563eb;
            --student-blue-hover: #2563eb;

            --student-red: #dc2626;
            --student-red-hover: #dc2626;

            --student-purple: #6538d9;

            --student-page-bg: #ffffff;
            --student-card-bg: #ffffff;
            --student-input-bg: #fafafa;

            --student-text: #111111;
            --student-muted: #666666;

            --student-border: #dddddd;
            --student-border-soft: #eeeeee;

            --student-placeholder: #999999;

            --student-shadow: 0 4px 18px rgba(0, 0, 0, .06);
        }


        /* DARK MODE */

        [data-bs-theme="dark"] {
            --student-page-bg: #101426;
            --student-card-bg: #181d33;
            --student-input-bg: #20253a;

            --student-text: #ffffff;
            --student-muted: #999fb9;

            --student-border: #343a52;
            --student-border-soft: #292e45;

            --student-placeholder: #777f9c;

            --student-shadow: 0 4px 18px rgba(0, 0, 0, .30);
        }


        /* PAGE */

        .student-edit-wrapper {
            width: calc(100% - 250px);
            margin-left: 250px;
            padding: 118px 20px 30px;

            box-sizing: border-box;
            /* background: var(--student-page-bg); */
            color: var(--student-text);

            overflow-x: hidden;
        }


        /* CARD */

        .student-edit-card {
            width: 100%;

            background: var(--student-card-bg);
            border: 1px solid var(--student-border-soft);
            border-radius: 12px;

            box-shadow: var(--student-shadow);
            overflow: hidden;
        }


        /* HEADER */

        .student-edit-header {
            padding: 1.4rem 1.5rem;

            background: var(--student-card-bg);
            border-bottom: 1px solid var(--student-border-soft);
        }

        .student-edit-overline {
            display: block;
            margin-bottom: .25rem;

            color: var(--student-purple);

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
        }

        .student-edit-description {
            margin: .35rem 0 0;

            color: var(--student-muted);

            font-size: .78rem;
        }


        /* FORM */

        .student-edit-form {
            display: grid;

            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 1.15rem 1.25rem;

            padding: 1.5rem;

            background: var(--student-card-bg);
        }


        /* FORM GROUP */

        .student-form-group {
            min-width: 0;
        }


        /* LABEL */

        .student-form-label {
            display: block;

            margin-bottom: .45rem;

            color: var(--student-text);

            font-size: .68rem;
            font-weight: 800;
            letter-spacing: .05em;
            text-transform: uppercase;
        }


        /* INPUT */

        .student-form-control {
            display: block;

            width: 100%;
            height: 45px;

            padding: .55rem .85rem;

            color: var(--student-text);
            background: var(--student-input-bg);

            border: 1px solid var(--student-border-soft);
            border-radius: 8px;

            outline: none;

            font-family: inherit;
            font-size: .82rem;

            box-sizing: border-box;

            transition: .2s ease;
        }

        .student-form-control:hover {
            border-color: var(--student-border);
        }

        .student-form-control:focus {
            border-color: var(--student-purple);

            box-shadow: 0 0 0 3px rgba(101, 56, 217, .10);
        }

        .student-form-control::placeholder {
            color: var(--student-placeholder);
        }

        .student-form-control.is-invalid {
            border-color: var(--student-red);
        }


        /* SELECT */

        .student-form-control option {
            color: #111111;
            background: #ffffff;
        }

        [data-bs-theme="dark"] .student-form-control option {
            color: #ffffff;
            background: #181d33;
        }


        /* ERROR */

        .student-error {
            margin-top: .35rem;

            color: var(--student-red) !important;

            font-size: .7rem;
            font-weight: 600;
        }


        /* ACTIONS */

        .student-form-actions {
            grid-column: 1 / -1;

            display: flex;
            justify-content: flex-end;
            align-items: center;

            gap: .65rem;

            padding-top: 1rem;

            border-top: 1px solid var(--student-border-soft);
        }


        /* BUTTONS */

        .student-cancel-button,
        .student-save-button {
            min-height: 40px;

            padding: .6rem 1.1rem;

            border-radius: 8px;

            font-size: .7rem;
            font-weight: 800;

            text-transform: uppercase;
            text-decoration: none;

            cursor: pointer;

            transition: .2s ease;
        }


        /* CANCEL */

        .student-cancel-button {
            color: var(--student-red) !important;

            background: transparent;

            border: 1px solid var(--student-red);
        }

        .student-cancel-button:hover {
            color: #ffffff !important;

            background: var(--student-red);

            border-color: var(--student-red);
        }


        /* SAVE */

        .student-save-button {
            color: var(--student-blue) !important;

            background: transparent;

            border: 1px solid var(--student-blue);
        }

        .student-save-button:hover {
            color: #ffffff !important;

            background: var(--student-blue);

            border-color: var(--student-blue);
        }


        /* TABLET */

        @media (max-width: 1000px) {

            .student-edit-wrapper {
                width: calc(100% - 250px);
                margin-left: 250px;

                padding-left: 15px;
                padding-right: 15px;
            }
        }


        /* MOBILE */

        @media (max-width: 767.98px) {

            .student-edit-wrapper {
                width: 100%;
                margin-left: 0;

                padding: 90px 10px 20px;
            }

            .student-edit-header {
                padding: 1rem;
            }

            .student-edit-form {
                grid-template-columns: 1fr;
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


        /* SMALL MOBILE */

        @media (max-width: 575.98px) {

            .student-edit-wrapper {
                padding: 85px 8px 20px;
            }

            .student-edit-header,
            .student-edit-form {
                padding: .9rem;
            }

            .student-form-control {
                height: 44px;
            }
        }
    </style>

</x-app-layout>
