<x-app-layout>

    <div class="dashboard-content departments-page">

        <div class="departments-header">

            <div class="departments-heading">

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
                class="add-department-btn"
                onclick="openCreateModal()"
            >
                <i class="bi bi-plus-lg"></i>
                <span>Add Department</span>
            </button>

        </div>

        @if (session('success'))

            <div class="department-alert">

                <div class="department-alert-message">

                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

                <button
                    type="button"
                    class="department-alert-close"
                    onclick="this.parentElement.remove()"
                    aria-label="Close"
                >
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

        @endif

        <div class="departments-toolbar">

            <div class="view-toggle">

                <button
                    type="button"
                    id="cardViewBtn"
                    class="view-btn active"
                    onclick="switchView('card')"
                >
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                    <span>Card</span>
                </button>

                <button
                    type="button"
                    id="tableViewBtn"
                    class="view-btn"
                    onclick="switchView('table')"
                >
                    <i class="bi bi-table"></i>
                    <span>Table</span>
                </button>

            </div>

        </div>


        @if ($departments->count())

            <div id="cardView" class="departments-grid">

                @foreach ($departments as $department)

                    <div class="department-card">

                        {{-- CARD INFORMATION --}}
                        <div class="department-info">


                            <div class="department-details">

                                <h3 title="{{ $department->name }}">
                                    {{ $department->name }}
                                </h3>

                                <span>
                                    Thesis Repository
                                </span>

                            </div>

                        </div>


                        {{-- CARD ACTIONS --}}
                        <div class="department-actions">

                            {{-- VIEW THESIS --}}
                            <a
                                href="{{ route('admin.departments.thesis', ['department' => $department->id]) }}"
                                class="action-view"
                            >
                                <i class="bi bi-journal-text"></i>
                                <span>View Thesis</span>
                            </a>


                            {{-- EDIT --}}
                            <button
                                type="button"
                                class="action-edit"
                                onclick="openEditModal(
                                    {{ $department->id }},
                                    @js($department->name)
                                )"
                                title="Edit Department"
                            >
                                <i class="bi bi-pencil"></i>
                                <span>Edit</span>
                            </button>


                            {{-- DELETE --}}
                            <button
                                type="button"
                                class="action-delete"
                                onclick="openDeleteModal(
                                    {{ $department->id }},
                                    @js($department->name)
                                )"
                                title="Delete Department"
                            >
                                <i class="bi bi-trash"></i>
                                <span>Delete</span>
                            </button>

                        </div>

                    </div>

                @endforeach

            </div>


            <div
                id="tableView"
                class="department-table-wrapper"
                hidden
            >

                <table class="department-table">

                    <thead>

                        <tr>

                            <th class="number-column">
                                #
                            </th>

                            <th>
                                Department
                            </th>

                            <th>
                                Type
                            </th>

                            <th class="actions-column">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($departments as $department)

                            <tr>

                                {{-- NUMBER --}}
                                <td>

                                    <span class="department-number">
                                        {{ $loop->iteration }}
                                    </span>

                                </td>


                                {{-- DEPARTMENT --}}
                                <td>

                                    <div class="table-department">


                                        <div class="table-department-details">

                                            <strong>
                                                {{ $department->name }}
                                            </strong>

                                            <span>
                                                Department
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- TYPE --}}
                                <td>

                                    <span class="department-type">
                                        Thesis Repository
                                    </span>

                                </td>


                                {{-- ACTIONS --}}
                                <td>

                                    <div class="table-actions">

                                        {{-- VIEW --}}
                                        <a
                                            href="{{ route('admin.departments.thesis', ['department' => $department->id]) }}"
                                            class="table-action view"
                                            title="View Thesis"
                                        >
                                            <i class="bi bi-journal-text"></i>
                                        </a>


                                        {{-- EDIT --}}
                                        <button
                                            type="button"
                                            class="table-action edit"
                                            title="Edit Department"
                                            onclick="openEditModal(
                                                {{ $department->id }},
                                                @js($department->name)
                                            )"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </button>


                                        {{-- DELETE --}}
                                        <button
                                            type="button"
                                            class="table-action delete"
                                            title="Delete Department"
                                            onclick="openDeleteModal(
                                                {{ $department->id }},
                                                @js($department->name)
                                            )"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else
            <div class="department-empty">

                <div class="empty-icon">
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
                    class="add-department-btn"
                    onclick="openCreateModal()"
                >
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Department</span>
                </button>

            </div>

        @endif

    </div>


    @include('admin.departments.create')
    @include('admin.departments.edit')
    @include('admin.departments.delete')


    <style>

        :root {

            --purple: #6538d9;
            --purple-hover: #7c5ce5;

            --purple-soft:
                rgba(101, 56, 217, .10);

            --purple-border:
                rgba(101, 56, 217, .25);

            --card-bg: #ffffff;

            --text: #111111;
            --muted: #777777;

            --border: #e1e1e1;

            --blue: #2563eb;
            --red: #dc2626;

            --shadow:
                0 3px 12px rgba(0, 0, 0, .06);
        }


        [data-bs-theme="dark"] {

            --purple: #8b6cf0;
            --purple-hover: #a992ff;

            --purple-soft:
                rgba(139, 108, 240, .14);

            --purple-border:
                rgba(139, 108, 240, .32);

            --card-bg: #181d33;

            --text: #eeeef8;
            --muted: #999fb9;

            --border: #292e45;

            --blue: #5b8def;
            --red: #f05252;

            --shadow:
                0 3px 12px rgba(0, 0, 0, .30);
        }

        .departments-page {

            padding: 20px;
            color: var(--text);
        }


        [data-bs-theme="dark"] body {

            background: #101426;
            color: #eeeef8;
        }

        .departments-header {

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin: 100px 0 20px;
            padding: 20px 22px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .departments-heading {

            min-width: 0;
        }


        .departments-overline {

            display: block;
            margin-bottom: 5px;
            color: var(--purple);
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .14em;
            text-transform: uppercase;
        }


        .departments-title {

            margin: 0;
            color: var(--text);
            font-size: 1.7rem;
            font-weight: 800;
            line-height: 1.2;
        }


        [data-bs-theme="dark"] .departments-title {

            color: #ffffff;
        }


        .add-department-btn {

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 38px;
            padding: 8px 14px;
            border: 1px solid var(--purple);
            border-radius: 7px;
            background: var(--purple);
            color: #ffffff;
            font-size: .74rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
            transition:
                background-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }


        .add-department-btn:hover {

            background: var(--purple-hover);
            border-color: var(--purple-hover);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow:
                0 5px 15px
                rgba(101, 56, 217, .25);
        }

        .department-alert {

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 18px;
            padding: 11px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--card-bg);
            box-shadow: var(--shadow);
        }


        .department-alert-message {

            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text);
            font-size: .76rem;
            font-weight: 600;
        }


        .department-alert-message i {

            color: var(--purple);
        }


        .department-alert-close {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 28px;

            height: 28px;

            border: 0;

            border-radius: 5px;

            background: transparent;

            color: var(--muted);

            cursor: pointer;
        }


        .department-alert-close:hover {

            background: var(--purple-soft);

            color: var(--purple);
        }


        /* =====================================================
           TOOLBAR
        ====================================================== */

        .departments-toolbar {

            display: flex;

            align-items: center;
            justify-content: flex-end;

            margin-bottom: 18px;
        }


        .view-toggle {

            display: inline-flex;

            align-items: center;

            gap: 4px;

            padding: 4px;

            border: 1px solid var(--border);

            border-radius: 8px;

            background: var(--card-bg);

            box-shadow: var(--shadow);
        }


        .view-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            min-height: 34px;

            padding: 6px 12px;

            border: 0;

            border-radius: 6px;

            background: transparent;

            color: var(--muted);

            font-size: .72rem;

            font-weight: 600;

            cursor: pointer;

            transition:
                background-color .2s ease,
                color .2s ease;
        }


        .view-btn:hover {

            color: var(--purple);
        }


        .view-btn.active {

            background: var(--purple);

            color: #ffffff;

            box-shadow:
                0 2px 7px
                rgba(101, 56, 217, .20);
        }

        .departments-grid {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 16px;
        }


        .department-card {

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            min-height: 145px;

            padding: 16px;

            border: 1px solid var(--border);

            border-radius: 10px;

            background: var(--card-bg);

            box-shadow: var(--shadow);

            transition:
                transform .2s ease,
                border-color .2s ease,
                box-shadow .2s ease;
        }


        .department-card:hover {

            transform: translateY(-2px);

            border-color:
                var(--purple-border);

            box-shadow:
                0 5px 18px
                rgba(0, 0, 0, .08);
        }


        [data-bs-theme="dark"] .department-card:hover {

            box-shadow:
                0 5px 18px
                rgba(0, 0, 0, .30);
        }


        .department-info {

            display: flex;

            align-items: flex-start;

            gap: 12px;
        }


        .department-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 42px;

            height: 42px;

            flex: 0 0 42px;

            border: 1px solid
                var(--purple-border);

            border-radius: 9px;

            background:
                var(--purple-soft);

            color: var(--purple);

            font-size: 1rem;
        }


        .department-icon.small {

            width: 36px;

            height: 36px;

            flex-basis: 36px;

            border-radius: 7px;

            font-size: .85rem;
        }


        /* =====================================================
           DEPARTMENT DETAILS
        ====================================================== */

        .department-details {

            min-width: 0;
        }


        .department-details h3 {

            margin: 2px 0 4px;

            color: var(--text);

            font-size: .88rem;

            font-weight: 700;

            line-height: 1.3;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .department-details span {

            color: var(--muted);

            font-size: .67rem;
        }


        /* =====================================================
           CARD ACTIONS
        ====================================================== */

        .department-actions {

            display: flex;

            align-items: center;

            gap: 5px;

            margin-top: 16px;

            padding-top: 12px;

            /* border-top:
                1px solid var(--border); */
        }


        .department-actions a,
        .department-actions button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 4px;

            min-height: 30px;

            padding: 5px 8px;

            border-radius: 6px;

            background: transparent;

            font-size: .65rem;

            font-weight: 600;

            cursor: pointer;

            text-decoration: none;

            transition:
                background-color .2s ease,
                color .2s ease;
        }


        .action-view {

            flex: 1;

            border: 1px solid var(--purple);

            color: var(--purple);
        }


        .action-view:hover {

            background: var(--purple);

            color: #ffffff;
        }


        .action-edit {

            border: 1px solid var(--blue);

            color: var(--blue);
        }


        .action-edit:hover {

            background: var(--blue);

            color: #ffffff;
        }


        .action-delete {

            border: 1px solid var(--red);

            color: var(--red);
        }


        .action-delete:hover {

            background: var(--red);

            color: #ffffff;
        }


        /* =====================================================
           TABLE WRAPPER
        ====================================================== */

        .department-table-wrapper {

            width: 100%;

            overflow-x: auto;

            border: 1px solid var(--border);

            border-radius: 10px;

            background: var(--card-bg);

            box-shadow: var(--shadow);
        }


        /* =====================================================
           TABLE
        ====================================================== */

        .department-table {

            width: 100%;

            min-width: 650px;

            border-collapse: collapse;
        }


        .department-table th {

            padding: 13px 15px;

            border-bottom:
                1px solid var(--border);

            background:
                var(--purple-soft);

            color: var(--text);

            font-size: .67rem;

            font-weight: 700;

            text-align: left;

            text-transform: uppercase;

            letter-spacing: .04em;
        }


        .department-table td {

            padding: 12px 15px;

            border-bottom:
                1px solid var(--border);

            color: var(--text);

            font-size: .74rem;
        }


        .department-table tbody tr {

            transition:
                background-color .2s ease;
        }


        .department-table tbody tr:hover {

            background: #fafafa;
        }


        .department-table tbody tr:last-child td {

            border-bottom: 0;
        }


        /* =====================================================
           TABLE COLUMNS
        ====================================================== */

        .number-column {

            width: 70px;
        }


        .actions-column {

            width: 150px;

            text-align: right !important;
        }


        /* =====================================================
           TABLE NUMBER
        ====================================================== */

        .department-number {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            width: 28px;

            height: 28px;

            border-radius: 6px;

            background:
                var(--purple-soft);

            color:
                var(--purple);

            font-size: .68rem;

            font-weight: 700;
        }


        /* =====================================================
           TABLE DEPARTMENT
        ====================================================== */

        .table-department {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .table-department-details strong {

            display: block;

            color: var(--text);

            font-size: .74rem;

            font-weight: 700;
        }


        .table-department-details span {

            display: block;

            margin-top: 2px;

            color: var(--muted);

            font-size: .61rem;
        }


        /* =====================================================
           TYPE
        ====================================================== */

        .department-type {

            display: inline-flex;

            padding: 5px 8px;

            border-radius: 5px;

            background:
                var(--purple-soft);

            color:
                var(--purple);

            font-size: .61rem;

            font-weight: 600;
        }


        /* =====================================================
           TABLE ACTIONS
        ====================================================== */

        .table-actions {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 5px;
        }


        .table-action {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            width: 31px;

            height: 31px;

            border-radius: 6px;

            background: transparent;

            cursor: pointer;

            text-decoration: none;

            transition:
                background-color .2s ease,
                color .2s ease;
        }


        .table-action.view {

            border: 1px solid var(--purple);

            color: var(--purple);
        }


        .table-action.view:hover {

            background: var(--purple);

            color: #ffffff;
        }


        .table-action.edit {

            border: 1px solid var(--blue);

            color: var(--blue);
        }


        .table-action.edit:hover {

            background: var(--blue);

            color: #ffffff;
        }


        .table-action.delete {

            border: 1px solid var(--red);

            color: var(--red);
        }


        .table-action.delete:hover {

            background: var(--red);

            color: #ffffff;
        }


        /* =====================================================
           EMPTY STATE
        ====================================================== */

        .department-empty {

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            min-height: 280px;

            padding: 40px 20px;

            border: 1px solid var(--border);

            border-radius: 10px;

            background: var(--card-bg);

            box-shadow: var(--shadow);

            text-align: center;
        }


        .empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 60px;

            height: 60px;

            margin-bottom: 15px;

            border: 1px solid
                var(--purple-border);

            border-radius: 50%;

            background:
                var(--purple-soft);

            color:
                var(--purple);

            font-size: 1.4rem;
        }


        .department-empty h2 {

            margin: 0 0 5px;

            color: var(--text);

            font-size: 1rem;
        }


        .department-empty p {

            margin: 0 0 18px;

            color: var(--muted);

            font-size: .75rem;
        }


        /* =====================================================
           DARK MODE
        ====================================================== */

        [data-bs-theme="dark"] .department-table th {

            background:
                rgba(139, 108, 240, .12);
        }


        [data-bs-theme="dark"] .department-table tbody tr:hover {

            background:
                rgba(139, 108, 240, .08);
        }


        /* =====================================================
           RESPONSIVE - 1200px
        ====================================================== */

        @media (max-width: 1200px) {

            .departments-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }

        }


        /* =====================================================
           RESPONSIVE - 992px
        ====================================================== */

        @media (max-width: 992px) {

            .departments-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        /* =====================================================
           RESPONSIVE - 768px
        ====================================================== */

        @media (max-width: 768px) {

            .departments-header {

                align-items: stretch;

                flex-direction: column;

                gap: 14px;

                padding: 18px;
            }


            .add-department-btn {

                width: 100%;
            }


            .departments-toolbar {

                width: 100%;
            }


            .view-toggle {

                width: 100%;
            }


            .view-btn {

                flex: 1;
            }


            .departments-grid {

                grid-template-columns: 1fr;
            }

        }


        /* =====================================================
           RESPONSIVE - 480px
        ====================================================== */

        @media (max-width: 480px) {

            .departments-page {

                padding: 15px;
            }


            .departments-header {

                margin-top: 20px;

                padding: 16px;
            }


            .departments-title {

                font-size: 1.45rem;
            }


            .department-actions {

                flex-wrap: wrap;
            }


            .department-actions a,
            .department-actions button {

                flex: 1;
            }

        }

    </style>


    {{-- =====================================================
        JAVASCRIPT
    ====================================================== --}}

    <script>

        /* =====================================================
           CARD / TABLE SWITCH
        ====================================================== */

        function switchView(view) {

            const cardView =
                document.getElementById('cardView');

            const tableView =
                document.getElementById('tableView');

            const cardButton =
                document.getElementById('cardViewBtn');

            const tableButton =
                document.getElementById('tableViewBtn');


            if (!cardView || !tableView) {
                return;
            }


            if (view === 'table') {

                cardView.hidden = true;

                tableView.hidden = false;

                cardButton.classList.remove('active');

                tableButton.classList.add('active');

            } else {

                cardView.hidden = false;

                tableView.hidden = true;

                tableButton.classList.remove('active');

                cardButton.classList.add('active');
            }


            localStorage.setItem(
                'departmentView',
                view
            );
        }


        /* =====================================================
           LOAD SAVED VIEW
        ====================================================== */

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const savedView =
                    localStorage.getItem(
                        'departmentView'
                    ) || 'card';


                switchView(savedView);

            }
        );


        /* =====================================================
           MODAL HELPER
        ====================================================== */

        function toggleModal(id, show) {

            const modal =
                document.getElementById(id);


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


        /* =====================================================
           CREATE MODAL
        ====================================================== */

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
                    function () {

                        input.focus();

                    },
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


        /* =====================================================
           EDIT MODAL
        ====================================================== */

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
                    function () {

                        input.focus();

                    },
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


        /* =====================================================
           DELETE MODAL
        ====================================================== */

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

                nameElement.textContent = name;
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


        /* =====================================================
           CLOSE MODALS BY BACKDROP
        ====================================================== */

        document.addEventListener(
            'click',
            function (event) {

                [
                    'createModal',
                    'editModal',
                    'deleteModal'
                ].forEach(
                    function (id) {

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

                    }
                );

            }
        );


        /* =====================================================
           CLOSE MODALS WITH ESC
        ====================================================== */

        document.addEventListener(
            'keydown',
            function (event) {

                if (event.key === 'Escape') {

                    closeCreateModal();

                    closeEditModal();

                    closeDeleteModal();
                }

            }
        );

    </script>

</x-app-layout>