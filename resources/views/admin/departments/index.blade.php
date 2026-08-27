<x-app-layout>

    <div class="dashboard-content">

        <div class="departments-dashboard-page">
            {{-- <div class="departments-dashboard-page"> --}}

            <div class="departments-header">

                <div class="departments-header-content">

                    <div class="departments-title-row">

                        <div>
                            <span class="departments-overline">
                                MANAGEMENT
                            </span>

                            <h1 class="departments-title">
                                Departments
                            </h1>

                        </div>

                    </div>

                </div>

                {{-- ADD BUTTON --}}

                <button type="button" onclick="openCreateModal()" class="departments-add-btn">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Department</span>
                </button>

            </div>

        </div>

        @if (session('success'))
            <div class="department-alert" role="alert">

                <div class="department-alert-content">

                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

                <button type="button" class="department-alert-close" onclick="this.parentElement.remove()"
                    aria-label="Close alert">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>
        @endif

        @if ($departments->count() > 0)

            <div class="departments-grid">

                @foreach ($departments as $department)
                    <div class="department-card-wrapper">

                        <div class="department-card">

                            {{-- INFORMATION --}}

                            <div class="department-information">

                                <div class="department-name-row">

                                    <h3 class="department-name" title="{{ $department->name }}">
                                        {{ $department->name }}
                                    </h3>

                                </div>

                                <span class="department-subtitle">
                                    Thesis Repository
                                </span>

                            </div>


                            {{-- ACTIONS --}}

                            <div class="department-actions">

                                {{-- EDIT --}}

                                <button type="button"
                                    onclick="openEditModal(
                                        {{ $department->id }},
                                        @js($department->name)
                                    )"
                                    class="department-edit-btn">
                                    <i class="bi bi-pencil"></i>
                                    <span>Edit</span>
                                </button>


                                {{-- DELETE --}}

                                <button type="button"
                                    onclick="openDeleteModal(
                                        {{ $department->id }},
                                        @js($department->name)
                                    )"
                                    class="department-delete-btn">
                                    <i class="bi bi-trash"></i>
                                    <span>Delete</span>
                                </button>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <div class="department-empty-state">

                <div class="department-empty-icon">
                    <i class="bi bi-building"></i>
                </div>

                <h2>
                    No Departments Found
                </h2>

                <p>
                    There are currently no departments created in the system.
                </p>

                <button type="button" onclick="openCreateModal()" class="departments-add-btn">
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
        /* .departments-dashboard-page {

            --dept-text-main: #111111;
            --dept-text-sub: #666666;

            --dept-bg-card: #ffffff;
            --dept-bg-hover: #f7f7f7;

            --dept-border: #dddddd;
            --dept-border-hover: #111111;

            --dept-shadow:
                0 2px 8px rgba(0, 0, 0, 0.06);

            --dept-shadow-hover:
                0 8px 20px rgba(0, 0, 0, 0.10);

            --dept-btn-bg: #111111;
            --dept-btn-text: #ffffff;
            --dept-btn-border: #111111;

            --dept-alert-bg: #f5f5f5;
            --dept-alert-border: #cccccc;
            --dept-alert-text: #222222;

            --dept-edit-bg: #ffffff;
            --dept-edit-text: #333333;
            --dept-edit-border: #cccccc;

            --dept-edit-hover-bg: #111111;
            --dept-edit-hover-text: #ffffff;

            --dept-delete-bg: #ffffff;
            --dept-delete-text: #222222;
            --dept-delete-border: #bbbbbb;

            --dept-delete-hover-bg: #111111;
            --dept-delete-hover-text: #ffffff;

            color: var(--dept-text-main);

            box-sizing: border-box;
        } */

        .departments-dashboard-page {

            --dept-text-main: #111111;
            --dept-text-sub: #666666;

            --dept-bg-page: #f5f5f5;

            --dept-bg-card: #ffffff;
            --dept-bg-hover: #f7f7f7;

            --dept-border: #dddddd;
            --dept-border-hover: #111111;

            --dept-shadow:
                0 2px 8px rgba(0, 0, 0, 0.06);

            --dept-shadow-hover:
                0 8px 20px rgba(0, 0, 0, 0.10);

            /* ADD BUTTON */
            --dept-btn-bg: #111111;
            --dept-btn-text: #ffffff;
            --dept-btn-border: #111111;

            /* ALERT */
            --dept-alert-bg: #f5f5f5;
            --dept-alert-border: #cccccc;
            --dept-alert-text: #222222;

            /* EDIT */
            --dept-edit-bg: #ffffff;
            --dept-edit-text: #333333;
            --dept-edit-border: #cccccc;

            --dept-edit-hover-bg: #111111;
            --dept-edit-hover-text: #ffffff;

            /* DELETE */
            --dept-delete-bg: #ffffff;
            --dept-delete-text: #222222;
            --dept-delete-border: #bbbbbb;

            --dept-delete-hover-bg: #111111;
            --dept-delete-hover-text: #ffffff;

            /* APPLY PAGE BACKGROUND */
            background: var(--dept-bg-page);

            color: var(--dept-text-main);

            box-sizing: border-box;
        }

        .modal-backdrop-custom.hidden,
        .modal.hidden {

            display: none !important;
        }

        .modal-backdrop-custom {
            position: fixed;
            inset: 0;
            z-index: 5000;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(3px);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .departments-header {
            /* display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1.5rem;
            margin-bottom: 1.75rem;
            padding-left: 0.8rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--dept-border); */
            /* min-height: 230px; */

            margin-bottom: 24px;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #ece6fc;
            background: white;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            overflow: hidden;
            box-sizing: border-box;
        }


        .departments-header-content {
            min-width: 0;
            flex: 1;
        }


        .departments-title-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }


        .departments-overline {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dept-text-sub);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }


        .departments-title {
            margin: 0;
            color: var(--dept-text-main);
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -0.035em;
            line-height: 1.2;
        }

        .departments-add-btn {

            display: inline-flex;
            margin: 10px;
            align-items: center;

            justify-content: center;

            gap: 0.5rem;

            min-height: 40px;

            padding: 0.55rem 1rem;

            border: 1px solid var(--dept-btn-border);

            border-radius: 10px;

            background: var(--dept-btn-bg);

            color: var(--dept-btn-text);

            font-size: 0.8rem;

            font-weight: 600;

            cursor: pointer;

            white-space: nowrap;

            flex-shrink: 0;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }


        .departments-add-btn:hover {

            transform: translateY(-2px);

            background: #333333;

            box-shadow: var(--dept-shadow-hover);
        }


        .departments-add-btn:active {

            transform: translateY(0);
        }


        .departments-add-btn i {

            transition: transform 0.2s ease;
        }


        .departments-add-btn:hover i {

            transform: rotate(90deg);
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

            padding: 0.8rem 1rem;

            border: 1px solid var(--dept-alert-border);

            border-radius: 8px;

            background: var(--dept-alert-bg);

            color: var(--dept-alert-text);
        }


        .department-alert-content {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.82rem;
            font-weight: 600;
        }


        .department-alert-content i {

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

            background: transparent;

            color: var(--dept-alert-text);

            cursor: pointer;

            border-radius: 5px;

            transition: background 0.2s ease;
        }


        .department-alert-close:hover {

            background: #dddddd;
        }


        /* =========================================================
           DEPARTMENT GRID
        ========================================================== */

        .departments-grid {
            display: grid;
            grid-template-columns:
                repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 18px;
        }


        .department-card-wrapper {
            min-width: 0;
        }

        .department-card {
            /* display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 1rem;

            min-height: 86px;

            padding: 1rem;

            background: var(--dept-bg-card);

            color: var(--dept-text-main);

            border: 1px solid var(--dept-border);

            border-radius: 10px;

            box-shadow: var(--dept-shadow);

            transition:
                transform 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease; */

            background: white;
            color: var(--dept-text-main);
            border: 1px solid var(--dept-border);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 1rem;
            border-radius: 11px;
            padding: 1rem;
            min-height: 86px;
            box-shadow: var(--dept-shadow);
            /* box-sizing: border-box; */
            transition:
                transform 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }


        .department-card:hover {

            transform: translateY(-2px);

            background: var(--dept-bg-hover);

            border-color: var(--dept-border-hover);

            box-shadow: var(--dept-shadow-hover);
        }


        /* =========================================================
           INFORMATION
        ========================================================== */

        .department-information {

            min-width: 0;

            flex: 1;
        }


        .department-name-row {

            display: flex;

            align-items: center;

            gap: 0.45rem;

            min-width: 0;
        }


        .department-name {

            margin: 0;

            color: var(--dept-text-main);

            font-size: 0.95rem;

            font-weight: 700;

            line-height: 1.3;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .department-subtitle {

            display: block;

            margin-top: 0.25rem;

            color: var(--dept-text-sub);

            font-size: 0.7rem;
        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .department-actions {

            display: flex;
            border-top: 1px solid #eeeeF4;
            padding-top: 1rem;
            align-items: center;
            gap: 1rem;

            flex-shrink: 0;
        }


        /* =========================================================
   ACTION BUTTONS
========================================================= */

        .department-edit-btn,
        .department-delete-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;

            min-height: 31px;
            padding: 0.35rem 0.7rem;

            border-radius: 6px;

            font-size: 0.7rem;
            font-weight: 600;

            cursor: pointer;

            transition:
                background 0.2s ease,
                color 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }


        /* =========================================================
   EDIT BUTTON - BLUE
========================================================= */

        .department-edit-btn {
            background: #ffffff;

            color: #2563eb;

            border: 1px solid #2563eb;
        }

        .department-edit-btn:hover {
            background: #2563eb;

            color: #ffffff;

            border-color: #2563eb;

            transform: translateY(-1px);
        }

        .department-edit-btn i {
            transition: transform 0.2s ease;
        }

        .department-edit-btn:hover i {
            transform: rotate(-8deg);
        }


        /* =========================================================
   DELETE BUTTON - RED
========================================================= */

        .department-delete-btn {
            background: #ffffff;

            color: #dc2626;

            border: 1px solid #dc2626;
        }

        .department-delete-btn:hover {
            background: #dc2626;

            color: #ffffff;

            border-color: #dc2626;

            transform: translateY(-1px);
        }

        .department-delete-btn i {
            transition: transform 0.2s ease;
        }

        .department-delete-btn:hover i {
            transform: scale(1.1);
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

            text-align: center;

            background: var(--dept-bg-card);

            border: 1px solid var(--dept-border);

            border-radius: 10px;

            box-shadow: var(--dept-shadow);
        }


        .department-empty-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 64px;

            height: 64px;

            margin-bottom: 1rem;

            border-radius: 50%;

            background: #f3f3f3;

            color: #666666;

            border: 1px solid var(--dept-border);

            font-size: 1.5rem;
        }


        .department-empty-state h2 {

            margin: 0 0 0.4rem;

            color: var(--dept-text-main);

            font-size: 1.05rem;

            font-weight: 700;
        }


        .department-empty-state p {

            max-width: 400px;

            margin: 0 0 1.25rem;

            color: var(--dept-text-sub);

            font-size: 0.8rem;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 768px) {

            .departments-header {

                align-items: stretch;

                flex-direction: column;

                margin-bottom: 1.25rem;
            }


            .departments-title-row {

                flex-direction: column;

                gap: 0.5rem;
            }


            .departments-title {

                font-size: 1.5rem;
            }


            .departments-add-btn {

                width: 100%;
            }


            .departments-grid {

                grid-template-columns: 1fr;
            }


            .department-card {

                align-items: flex-start;

                flex-direction: column;

                padding: 0.9rem;
            }


            .department-information {

                width: 100%;
            }


            .department-actions {

                width: 100%;

                margin-top: 0.5rem;

                padding-top: 0.5rem;

                border-top: 1px dashed var(--dept-border);
            }


            .department-edit-btn,
            .department-delete-btn {

                flex: 1;
            }

        }


        @media (max-width: 480px) {

            .department-name {

                font-size: 0.85rem;
            }


            .department-subtitle {

                font-size: 0.65rem;
            }

        }
    </style>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}

    <script>
        /* =========================================================
                                   MODAL TOGGLING
                                ========================================================== */

        function toggleModal(modalId, show) {

            const modal = document.getElementById(modalId);

            if (!modal) {
                return;
            }

            if (show) {

                modal.classList.remove('hidden');

                document.body.classList.add('overflow-hidden');

            } else {

                modal.classList.add('hidden');

                document.body.classList.remove('overflow-hidden');

            }
        }


        /* =========================================================
           CREATE MODAL
        ========================================================== */

        function openCreateModal() {

            toggleModal('createModal', true);

            const input =
                document.getElementById('createDepartmentName');

            if (input) {

                setTimeout(function() {

                    input.focus();

                }, 100);
            }
        }


        function closeCreateModal() {

            toggleModal('createModal', false);
        }


        /* =========================================================
           EDIT MODAL
        ========================================================== */

        function openEditModal(id, name) {

            toggleModal('editModal', true);

            const nameInput =
                document.getElementById('editDepartmentName');

            if (nameInput) {

                nameInput.value = name;

                setTimeout(function() {

                    nameInput.focus();

                }, 100);
            }


            const form =
                document.getElementById('editDepartmentForm');

            if (form) {

                form.action =
                    '/admin/departments/update/' + id;
            }
        }


        function closeEditModal() {

            toggleModal('editModal', false);
        }


        /* =========================================================
           DELETE MODAL
        ========================================================== */

        function openDeleteModal(id, name) {

            toggleModal('deleteModal', true);

            const nameElement =
                document.getElementById('deleteDepartmentName');

            if (nameElement) {

                nameElement.textContent = name;
            }


            const form =
                document.getElementById('deleteDepartmentForm');

            if (form) {

                form.action =
                    '/admin/departments/delete/' + id;
            }
        }


        function closeDeleteModal() {

            toggleModal('deleteModal', false);
        }


        /* =========================================================
           CLOSE MODAL WHEN CLICKING BACKDROP
        ========================================================== */

        document.addEventListener('click', function(event) {

            const modalIds = [
                'createModal',
                'editModal',
                'deleteModal'
            ];


            modalIds.forEach(function(id) {

                const modal =
                    document.getElementById(id);


                if (
                    modal &&
                    event.target === modal
                ) {

                    modal.classList.add('hidden');

                    document.body.classList.remove(
                        'overflow-hidden'
                    );
                }

            });

        });


        /* =========================================================
           ESC KEY
        ========================================================== */

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {

                closeCreateModal();

                closeEditModal();

                closeDeleteModal();
            }

        });


        /* =========================================================
           SUCCESS ALERT AUTO REMOVE
        ========================================================== */

        document.addEventListener('DOMContentLoaded', function() {

            const alert =
                document.querySelector('.department-alert');


            if (alert) {

                setTimeout(function() {

                    alert.style.opacity = '0';

                    alert.style.transition =
                        'opacity 0.3s ease';


                    setTimeout(function() {

                        alert.remove();

                    }, 300);

                }, 4000);

            }

        });
    </script>

</x-app-layout>
