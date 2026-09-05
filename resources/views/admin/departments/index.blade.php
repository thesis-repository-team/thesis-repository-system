<x-app-layout>

    <div class="dashboard-content">

        {{-- =========================================================
        PAGE HEADER
        ========================================================== --}}

        <div class="departments-header">

            <div class="departments-header-content">

                <span class="departments-overline">
                    MANAGEMENT
                </span>

                <h1 class="departments-title">
                    Departments
                </h1>

            </div>


            {{-- ADD DEPARTMENT --}}

            <button
                type="button"
                class="departments-add-btn"
                onclick="openCreateModal()"
            >
                <i class="bi bi-plus-lg"></i>

                <span>
                    Add Department
                </span>
            </button>

        </div>


        {{-- =========================================================
        SUCCESS ALERT
        ========================================================== --}}

        @if (session('success'))

            <div class="department-alert" role="alert">

                <div class="department-alert-content">

                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>


                <button
                    type="button"
                    class="department-alert-close"
                    onclick="this.parentElement.remove()"
                    aria-label="Close alert"
                >
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

        @endif


        {{-- =========================================================
        DEPARTMENT LIST
        ========================================================== --}}

        @if ($departments->count() > 0)

            <div class="departments-grid">

                @foreach ($departments as $department)

                    <div class="department-card">

                        {{-- =================================================
                        DEPARTMENT INFORMATION
                        ================================================== --}}

                        <div class="department-information">

                            <h3
                                class="department-name"
                                title="{{ $department->name }}"
                            >
                                {{ $department->name }}
                            </h3>


                            <span class="department-subtitle">
                                Thesis Repository
                            </span>

                        </div>


                        {{-- =================================================
                        ACTIONS
                        ================================================== --}}

                        <div class="department-actions">

                            {{-- VIEW THESIS --}}

                            <a
                                href="{{ route('admin.departments.thesis', ['department' => $department->id]) }}"
                                class="department-view-btn"
                            >
                                <i class="bi bi-journal-text"></i>

                                <span>
                                    View Thesis
                                </span>
                            </a>


                            {{-- EDIT --}}

                            <button
                                type="button"
                                class="department-edit-btn"
                                onclick="openEditModal(
                                    {{ $department->id }},
                                    @js($department->name)
                                )"
                            >
                                <i class="bi bi-pencil"></i>

                                <span>
                                    Edit
                                </span>
                            </button>


                            {{-- DELETE --}}

                            <button
                                type="button"
                                class="department-delete-btn"
                                onclick="openDeleteModal(
                                    {{ $department->id }},
                                    @js($department->name)
                                )"
                            >
                                <i class="bi bi-trash"></i>

                                <span>
                                    Delete
                                </span>
                            </button>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- =========================================================
            EMPTY STATE
            ========================================================== --}}

            <div class="department-empty-state">

                <div class="department-empty-icon">

                    <i class="bi bi-building"></i>

                </div>


                <h2>
                    No Departments Found
                </h2>


                <p>
                    There are currently no departments created
                    in the system.
                </p>


                <button
                    type="button"
                    class="departments-add-btn"
                    onclick="openCreateModal()"
                >
                    <i class="bi bi-plus-lg"></i>

                    <span>
                        Add Department
                    </span>
                </button>

            </div>

        @endif

    </div>


    {{-- =============================================================
    MODALS
    ============================================================== --}}

    @include('admin.departments.create')

    @include('admin.departments.edit')

    @include('admin.departments.delete')


    <style>

        /* =========================================================
           VARIABLES
        ========================================================== */

        :root {

            --department-black: #000000;
            --department-white: #ffffff;

            /* LIGHT MODE */

            --department-page-bg: #ffffff;
            --department-card-bg: #ffffff;
            --department-input-bg: #fafafa;

            --department-text: #000000;
            --department-text-secondary: #333333;
            --department-text-muted: #777777;

            --department-border: #000000;
            --department-border-soft: #dddddd;

            --department-primary: #000000;

            --department-blue: #2563eb;
            --department-red: #dc2626;

            --department-shadow:
                0 4px 18px rgba(0, 0, 0, .07);

            --department-card-shadow:
                0 2px 10px rgba(0, 0, 0, .05);
        }


        /* =========================================================
           DARK MODE
           SAME STYLE AS DASHBOARD
        ========================================================== */

        [data-bs-theme="dark"] {

            --department-black: #000000;
            --department-white: #ffffff;

            /* PAGE */

            --department-page-bg: #101426;

            /* HEADER / CARDS */

            --department-card-bg: #181d33;

            /* INPUT / SOFT AREAS */

            --department-input-bg: #20253a;

            /* TEXT */

            --department-text: #eeeef8;
            --department-text-secondary: #d5d8e8;
            --department-text-muted: #999fb9;

            /* BORDERS */

            --department-border: #ffffff;
            --department-border-soft: #292e45;

            --department-primary: #ffffff;

            /* COLORS */

            --department-blue: #2563eb;
            --department-red: #dc2626;

            /* SHADOWS */

            --department-shadow:
                0 4px 18px rgba(0, 0, 0, .35);

            --department-card-shadow:
                0 2px 10px rgba(0, 0, 0, .30);
        }


        /* =========================================================
           PAGE
        ========================================================== */

        .dashboard-content {

            color:
                var(--department-text);

            /* background:
                var(--department-page-bg); */

            transition:
                color .25s ease,
                background-color .25s ease;
        }


        /* =========================================================
           BODY DARK MODE
        ========================================================== */

        [data-bs-theme="dark"] body {

            background:
                #101426;

            color:
                #eeeef8;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .departments-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 1rem;

            margin-bottom: 24px;

            padding: 15px;

            border:
                1px solid var(--department-border-soft);

            border-radius: 12px;

            background:
                var(--department-card-bg);

            box-shadow:
                var(--department-card-shadow);

            box-sizing: border-box;

            overflow: hidden;

            transition:
                background-color .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }


        /* DARK HEADER */

        [data-bs-theme="dark"] .departments-header {

            background:
                #171b30;

            border-color:
                #282d43;
        }


        .departments-header-content {

            min-width: 0;

            flex: 1;
        }


        .departments-overline {

            display: block;

            margin-bottom: .5rem;

            color:
                var(--department-text-muted);

            font-size: .7rem;

            font-weight: 700;

            letter-spacing: .14em;

            text-transform: uppercase;
        }


        .departments-title {

            margin: 0;

            color:
                var(--department-text);

            font-size: 1.8rem;

            font-weight: 800;

            letter-spacing: -.035em;

            line-height: 1.2;
        }


        /* DARK TITLE */

        [data-bs-theme="dark"] .departments-title {

            color:
                #ffffff;
        }


        /* =========================================================
           ADD BUTTON
        ========================================================== */

        .departments-add-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .5rem;

            min-height: 40px;

            margin: 10px;

            padding: .55rem 1rem;

            border:
                1px solid #000000;

            border-radius: 8px;

            background:
                #000000;

            color:
                #ffffff;

            font-size: .8rem;

            font-weight: 600;

            cursor: pointer;

            white-space: nowrap;

            flex-shrink: 0;

            text-decoration: none;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease;
        }


        .departments-add-btn:hover {

            transform:
                translateY(-1px);

            background:
                #ffffff;

            color:
                #000000;

            border-color:
                #000000;

            box-shadow:
                0 5px 14px rgba(0, 0, 0, .12);
        }


        /* DARK ADD BUTTON */

        [data-bs-theme="dark"] .departments-add-btn {

            background:
                #000000;

            color:
                #ffffff;

            border-color:
                #ffffff;
        }


        [data-bs-theme="dark"] .departments-add-btn:hover {

            background:
                #ffffff;

            color:
                #000000;

            border-color:
                #ffffff;

            box-shadow:
                0 5px 14px rgba(255, 255, 255, .12);
        }


        .departments-add-btn:active {

            transform:
                translateY(0);
        }


        .departments-add-btn i {

            transition:
                transform .2s ease;
        }


        .departments-add-btn:hover i {

            transform:
                rotate(90deg);
        }


        /* =========================================================
           SUCCESS ALERT
        ========================================================== */

        .department-alert {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 1rem;

            margin-bottom: 1.5rem;

            padding: .8rem 1rem;

            border:
                1px solid var(--department-border-soft);

            border-radius: 8px;

            background:
                var(--department-card-bg);

            color:
                var(--department-text);

            box-shadow:
                var(--department-card-shadow);

            transition:
                background-color .25s ease,
                color .25s ease,
                border-color .25s ease;
        }


        /* DARK ALERT */

        [data-bs-theme="dark"] .department-alert {

            background:
                #181d33;

            border-color:
                #292e45;

            color:
                #eeeef8;
        }


        .department-alert-content {

            display: flex;

            align-items: center;

            gap: .6rem;

            font-size: .82rem;

            font-weight: 600;
        }


        .department-alert-content i {

            color:
                var(--department-text);

            font-size: 1rem;
        }


        .department-alert-close {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 28px;

            height: 28px;

            padding: 0;

            border: 0;

            border-radius: 5px;

            background:
                transparent;

            color:
                var(--department-text);

            cursor: pointer;

            transition:
                background-color .2s ease;
        }


        .department-alert-close:hover {

            background:
                var(--department-input-bg);
        }


        /* =========================================================
           GRID
        ========================================================== */

        .departments-grid {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 16px;

            margin-bottom: 18px;
        }


        /* =========================================================
           CARD
        ========================================================== */

        .department-card {

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            gap: 1rem;

            min-height: 86px;

            padding: 1rem;

            border:
                1px solid var(--department-border-soft);

            border-radius: 10px;

            background:
                var(--department-card-bg);

            color:
                var(--department-text);

            box-shadow:
                var(--department-card-shadow);

            transition:
                transform .2s ease,
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;
        }


        /* DARK CARD */

        [data-bs-theme="dark"] .department-card {

            background:
                #181d33;

            border-color:
                #292e45;

            color:
                #eeeef8;

            box-shadow:
                0 2px 10px rgba(0, 0, 0, .30);
        }


        .department-card:hover {

            transform:
                translateY(-2px);

            border-color:
                var(--department-text);

            box-shadow:
                var(--department-shadow);
        }


        /* DARK CARD HOVER */

        [data-bs-theme="dark"] .department-card:hover {

            border-color:
                #555c78;

            box-shadow:
                0 4px 18px rgba(0, 0, 0, .35);
        }


        /* =========================================================
           INFORMATION
        ========================================================== */

        .department-information {

            min-width: 0;

            flex: 1;
        }


        .department-name {

            margin: 0;

            color:
                var(--department-text);

            font-size: .95rem;

            font-weight: 700;

            line-height: 1.3;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        [data-bs-theme="dark"] .department-name {

            color:
                #ffffff;
        }


        .department-subtitle {

            display: block;

            margin-top: .25rem;

            color:
                var(--department-text-muted);

            font-size: .7rem;
        }


        [data-bs-theme="dark"] .department-subtitle {

            color:
                #999fb9;
        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .department-actions {

            display: flex;

            align-items: center;

            gap: .45rem;

            width: 100%;

            padding-top: .8rem;

            border-top:
                1px solid var(--department-border-soft);
        }


        [data-bs-theme="dark"] .department-actions {

            border-color:
                #292e45;
        }


        /* =========================================================
           ACTION BUTTONS
        ========================================================== */

        .department-view-btn,
        .department-edit-btn,
        .department-delete-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: .35rem;

            min-height: 31px;

            padding: .35rem .65rem;

            border-radius: 6px;

            background:
                var(--department-card-bg);

            font-size: .7rem;

            font-weight: 600;

            cursor: pointer;

            text-decoration: none;

            white-space: nowrap;

            transition:
                background-color .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }


        /* =========================================================
           VIEW THESIS
        ========================================================== */

        .department-view-btn {

            border:
                1px solid var(--department-text);

            color:
                var(--department-text);
        }


        [data-bs-theme="dark"] .department-view-btn {

            background:
                #181d33;

            color:
                #ffffff;

            border-color:
                #ffffff;
        }


        .department-view-btn:hover {

            transform:
                translateY(-1px);

            background:
                var(--department-text);

            color:
                var(--department-card-bg);

            border-color:
                var(--department-text);
        }


        [data-bs-theme="dark"] .department-view-btn:hover {

            background:
                #ffffff;

            color:
                #181d33;

            border-color:
                #ffffff;
        }


        /* =========================================================
           EDIT
        ========================================================== */

        .department-edit-btn {

            border:
                1px solid var(--department-blue);

            color:
                var(--department-blue);
        }


        [data-bs-theme="dark"] .department-edit-btn {

            background:
                transparent;

            color:
                #5b8def;

            border-color:
                #5b8def;
        }


        .department-edit-btn:hover {

            transform:
                translateY(-1px);

            background:
                var(--department-blue);

            color:
                #ffffff;

            border-color:
                var(--department-blue);
        }


        /* =========================================================
           DELETE
        ========================================================== */

        .department-delete-btn {

            border:
                1px solid var(--department-red);

            color:
                var(--department-red);
        }


        [data-bs-theme="dark"] .department-delete-btn {

            background:
                transparent;

            color:
                #f05252;

            border-color:
                #f05252;
        }


        .department-delete-btn:hover {

            transform:
                translateY(-1px);

            background:
                var(--department-red);

            color:
                #ffffff;

            border-color:
                var(--department-red);
        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .department-empty-state {

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            min-height: 300px;

            padding: 3rem 1.5rem;

            border:
                1px solid var(--department-border-soft);

            border-radius: 10px;

            background:
                var(--department-card-bg);

            text-align: center;

            box-shadow:
                var(--department-card-shadow);

            color:
                var(--department-text);
        }


        [data-bs-theme="dark"] .department-empty-state {

            background:
                #181d33;

            border-color:
                #292e45;

            color:
                #eeeef8;
        }


        .department-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 64px;

            height: 64px;

            margin-bottom: 1rem;

            border:
                1px solid var(--department-border-soft);

            border-radius: 50%;

            background:
                var(--department-input-bg);

            color:
                var(--department-text);

            font-size: 1.5rem;
        }


        [data-bs-theme="dark"] .department-empty-icon {

            background:
                #20253a;

            border-color:
                #343a52;

            color:
                #ffffff;
        }


        .department-empty-state h2 {

            margin:
                0 0 .4rem;

            color:
                var(--department-text);

            font-size: 1.05rem;

            font-weight: 700;
        }


        [data-bs-theme="dark"] .department-empty-state h2 {

            color:
                #ffffff;
        }


        .department-empty-state p {

            max-width: 400px;

            margin:
                0 0 1.25rem;

            color:
                var(--department-text-muted);

            font-size: .8rem;
        }


        [data-bs-theme="dark"] .department-empty-state p {

            color:
                #999fb9;
        }


        /* =========================================================
           MODAL BACKDROP
        ========================================================== */

        .modal-backdrop-custom {

            position: fixed;

            inset: 0;

            z-index: 5000;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                rgba(0, 0, 0, .72);

            backdrop-filter:
                blur(4px);
        }


        .modal-backdrop-custom.hidden,
        .modal.hidden {

            display:
                none !important;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1200px) {

            .departments-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }

        }


        @media (max-width: 992px) {

            .departments-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 768px) {

            .departments-header {

                align-items: stretch;

                flex-direction: column;

                margin-bottom: 1.25rem;
            }


            .departments-title {

                font-size: 1.5rem;
            }


            .departments-add-btn {

                width:
                    calc(100% - 20px);

                margin: 10px;
            }


            .departments-grid {

                grid-template-columns:
                    1fr;
            }


            .department-card {

                padding: .9rem;
            }


            .department-actions {

                flex-wrap: wrap;

                width: 100%;

                margin-top: .5rem;
            }


            .department-view-btn,
            .department-edit-btn,
            .department-delete-btn {

                flex: 1;

                min-width: 0;
            }

        }


        @media (max-width: 480px) {

            .department-name {

                font-size: .85rem;
            }


            .department-subtitle {

                font-size: .65rem;
            }


            .department-actions {

                gap: .35rem;
            }


            .department-view-btn,
            .department-edit-btn,
            .department-delete-btn {

                padding:
                    .35rem .45rem;

                font-size: .62rem;
            }

        }

    </style>


    <script>

        /* =========================================================
           MODAL HELPER
        ========================================================== */

        function toggleModal(modalId, show) {

            const modal =
                document.getElementById(modalId);


            if (!modal) {
                return;
            }


            modal.classList.toggle(
                'hidden',
                !show
            );


            document.body.classList.toggle(
                'overflow-hidden',
                show
            );
        }


        /* =========================================================
           CREATE MODAL
        ========================================================== */

        function openCreateModal() {

            toggleModal(
                'createModal',
                true
            );


            const input =
                document.getElementById(
                    'createDepartmentName'
                );


            if (input) {

                setTimeout(
                    () => input.focus(),
                    100
                );

            }
        }


        function closeCreateModal() {

            toggleModal(
                'createModal',
                false
            );
        }


        /* =========================================================
           EDIT MODAL
        ========================================================== */

        function openEditModal(id, name) {

            toggleModal(
                'editModal',
                true
            );


            const input =
                document.getElementById(
                    'editDepartmentName'
                );


            const form =
                document.getElementById(
                    'editDepartmentForm'
                );


            if (input) {

                input.value = name;


                setTimeout(
                    () => input.focus(),
                    100
                );

            }


            if (form) {

                form.action =
                    '/admin/departments/update/' + id;

            }
        }


        function closeEditModal() {

            toggleModal(
                'editModal',
                false
            );
        }


        /* =========================================================
           DELETE MODAL
        ========================================================== */

        function openDeleteModal(id, name) {

            toggleModal(
                'deleteModal',
                true
            );


            const nameElement =
                document.getElementById(
                    'deleteDepartmentName'
                );


            const form =
                document.getElementById(
                    'deleteDepartmentForm'
                );


            if (nameElement) {

                nameElement.textContent =
                    name;
            }


            if (form) {

                form.action =
                    '/admin/departments/delete/' + id;
            }
        }


        function closeDeleteModal() {

            toggleModal(
                'deleteModal',
                false
            );
        }


        /* =========================================================
           CLOSE MODAL ON BACKDROP CLICK
        ========================================================== */

        document.addEventListener(
            'click',
            event => {

                [
                    'createModal',
                    'editModal',
                    'deleteModal'
                ].forEach(id => {

                    const modal =
                        document.getElementById(id);


                    if (
                        modal &&
                        event.target === modal
                    ) {

                        toggleModal(
                            id,
                            false
                        );

                    }

                });

            }
        );


        /* =========================================================
           ESCAPE KEY
        ========================================================== */

        document.addEventListener(
            'keydown',
            event => {

                if (
                    event.key === 'Escape'
                ) {

                    closeCreateModal();

                    closeEditModal();

                    closeDeleteModal();

                }

            }
        );


        /* =========================================================
           AUTO DISMISS SUCCESS ALERT
        ========================================================== */

        document.addEventListener(
            'DOMContentLoaded',
            () => {

                const alert =
                    document.querySelector(
                        '.department-alert'
                    );


                if (!alert) {
                    return;
                }


                setTimeout(
                    () => {

                        alert.style.opacity =
                            '0';

                        alert.style.transition =
                            'opacity .3s ease';


                        setTimeout(
                            () => alert.remove(),
                            300
                        );

                    },
                    4000
                );

            }
        );

    </script>

</x-app-layout>