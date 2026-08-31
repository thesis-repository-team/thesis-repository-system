
<x-app-layout>

    <div class="dashboard-content">

        {{-- =========================================================
             PAGE HEADER
        ========================================================== --}}

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

            <button
                type="button"
                onclick="openCreateModal()"
                class="departments-add-btn">

                <i class="bi bi-plus-lg"></i>

                <span>
                    Add Department
                </span>

            </button>

        </div>


        {{-- =========================================================
             SUCCESS MESSAGE
        ========================================================== --}}

        @if (session('success'))

            <div
                class="department-alert"
                role="alert">

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
                    aria-label="Close alert">

                    <i class="bi bi-x-lg"></i>

                </button>

            </div>

        @endif


        {{-- =========================================================
             DEPARTMENT GRID
        ========================================================== --}}

        @if ($departments->count() > 0)

            <div class="departments-grid">

                @foreach ($departments as $department)

                    <div class="department-card-wrapper">

                        <div class="department-card">

                            {{-- =================================================
                                 INFORMATION
                            ================================================== --}}

                            <div class="department-information">

                                <div class="department-name-row">

                                    <h3
                                        class="department-name"
                                        title="{{ $department->name }}">

                                        {{ $department->name }}

                                    </h3>

                                </div>

                                <span class="department-subtitle">
                                    Thesis Repository
                                </span>

                            </div>


                            {{-- =================================================
                                 ACTIONS
                            ================================================== --}}

                            <div class="department-actions">

                                {{-- EDIT --}}

                                <button
                                    type="button"
                                    onclick="openEditModal(
                                        {{ $department->id }},
                                        @js($department->name)
                                    )"
                                    class="department-edit-btn">

                                    <i class="bi bi-pencil"></i>

                                    <span>
                                        Edit
                                    </span>

                                </button>


                                {{-- DELETE --}}

                                <button
                                    type="button"
                                    onclick="openDeleteModal(
                                        {{ $department->id }},
                                        @js($department->name)
                                    )"
                                    class="department-delete-btn">

                                    <i class="bi bi-trash"></i>

                                    <span>
                                        Delete
                                    </span>

                                </button>

                            </div>

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
                    There are currently no departments created in the system.
                </p>

                <button
                    type="button"
                    onclick="openCreateModal()"
                    class="departments-add-btn">

                    <i class="bi bi-plus-lg"></i>

                    <span>
                        Add Department
                    </span>

                </button>

            </div>

        @endif

    </div>


    {{-- =========================================================
         MODALS
    ========================================================== --}}

    @include('admin.departments.create')
    @include('admin.departments.edit')
    @include('admin.departments.delete')


    <style>

        /* =========================================================
           DEPARTMENT THEME
           WHITE / BLACK / DARK PURPLE
        ========================================================== */

        :root {

            /* =====================================================
               MAIN COLORS
            ====================================================== */

            --dept-black: #111111;
            --dept-black-dark: #080808;
            --dept-white: #ffffff;

            --dept-purple: #3b236f;
            --dept-purple-dark: #2b1855;
            --dept-purple-light: #f1edf8;


            /* =====================================================
               TEXT
            ====================================================== */

            --dept-text-main: #111111;
            --dept-text-sub: #666666;
            --dept-text-muted: #888888;


            /* =====================================================
               BACKGROUND
            ====================================================== */

            --dept-bg-page: #f7f6f9;
            --dept-bg-card: #ffffff;
            --dept-bg-hover: #faf9fc;


            /* =====================================================
               BORDER
            ====================================================== */

            --dept-border: #dedede;
            --dept-border-hover: #3b236f;


            /* =====================================================
               SHADOW
            ====================================================== */

            --dept-shadow:
                0 2px 8px rgba(0, 0, 0, 0.06);

            --dept-shadow-hover:
                0 8px 20px rgba(59, 35, 111, 0.13);


            /* =====================================================
               ADD BUTTON - BLACK / WHITE
            ====================================================== */

            --dept-btn-bg: #000000;
            --dept-btn-text: #ffffff;
            --dept-btn-border: #000000;


            /* =====================================================
               ALERT
            ====================================================== */

            --dept-alert-bg: #f1edf8;
            --dept-alert-border: #d8cee9;
            --dept-alert-text: #2b1855;


            /* =====================================================
               EDIT BUTTON - BLUE
            ====================================================== */

            --dept-edit-bg: #ffffff;
            --dept-edit-text: #2563eb;
            --dept-edit-border: #2563eb;

            --dept-edit-hover-bg: #2563eb;
            --dept-edit-hover-text: #ffffff;


            /* =====================================================
               DELETE BUTTON - RED
            ====================================================== */

            --dept-delete-bg: #ffffff;
            --dept-delete-text: #dc2626;
            --dept-delete-border: #dc2626;

            --dept-delete-hover-bg: #dc2626;
            --dept-delete-hover-text: #ffffff;
        }


        /* =========================================================
           MODAL
        ========================================================== */

        .modal-backdrop-custom.hidden,
        .modal.hidden {
            display: none !important;
        }


        .modal-backdrop-custom {

            position: fixed;

            inset: 0;

            z-index: 5000;

            background: rgba(17, 17, 17, 0.72);

            backdrop-filter: blur(4px);

            display: flex;

            align-items: center;

            justify-content: center;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .departments-header {

            margin-bottom: 24px;

            padding: 15px;

            border-radius: 12px;

            border: 1px solid #ded8e9;

            background: var(--dept-white);

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


        /* =========================================================
           OVERLINE
        ========================================================== */

        .departments-overline {

            display: block;

            margin-bottom: 0.5rem;

            color: var(--dept-purple);

            font-size: 0.75rem;

            font-weight: 700;

            letter-spacing: 0.14em;

            text-transform: uppercase;
        }


        /* =========================================================
           TITLE
        ========================================================== */

        .departments-title {

            margin: 0;

            color: var(--dept-black);

            font-size: 1.8rem;

            font-weight: 800;

            letter-spacing: -0.035em;

            line-height: 1.2;
        }


        /* =========================================================
           ADD BUTTON - BLACK / WHITE
        ========================================================== */

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
                background 0.2s ease,
                color 0.2s ease,
                border-color 0.2s ease;
        }


        .departments-add-btn:hover {

            transform: translateY(-2px);

            background: #ffffff;

            color: #000000;

            border-color: #000000;

            box-shadow:
                0 6px 15px rgba(0, 0, 0, 0.12);
        }


        .departments-add-btn:active {

            transform: translateY(0);
        }


        .departments-add-btn i {

            transition:
                transform 0.2s ease;
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

            color: var(--dept-purple);

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

            color: var(--dept-purple-dark);

            cursor: pointer;

            border-radius: 5px;

            transition:
                background 0.2s ease;
        }


        .department-alert-close:hover {

            background: #ded6eb;
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


        .department-card-wrapper {

            min-width: 0;
        }


        /* =========================================================
           DEPARTMENT CARD
        ========================================================== */

        .department-card {

            background: var(--dept-bg-card);

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

            transition:
                transform 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }


        .department-card:hover {

            transform: translateY(-2px);

            background: var(--dept-bg-hover);

            border-color: var(--dept-purple);

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


        /* =========================================================
           DEPARTMENT NAME
        ========================================================== */

        .department-name {

            margin: 0;

            color: var(--dept-black);

            font-size: 0.95rem;

            font-weight: 700;

            line-height: 1.3;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        /* =========================================================
           SUBTITLE
        ========================================================== */

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
        ========================================================== */

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
        ========================================================== */

        .department-edit-btn {

            background: var(--dept-edit-bg);

            color: var(--dept-edit-text);

            border: 1px solid var(--dept-edit-border);
        }


        .department-edit-btn:hover {

            background: var(--dept-edit-hover-bg);

            color: var(--dept-edit-hover-text);

            border-color: var(--dept-edit-hover-bg);

            transform: translateY(-1px);
        }


        .department-edit-btn i {

            transition:
                transform 0.2s ease;
        }


        .department-edit-btn:hover i {

            transform: rotate(-8deg);
        }


        /* =========================================================
           DELETE BUTTON - RED
        ========================================================== */

        .department-delete-btn {

            background: var(--dept-delete-bg);

            color: var(--dept-delete-text);

            border: 1px solid var(--dept-delete-border);
        }


        .department-delete-btn:hover {

            background: var(--dept-delete-hover-bg);

            color: var(--dept-delete-hover-text);

            border-color: var(--dept-delete-hover-bg);

            transform: translateY(-1px);
        }


        .department-delete-btn i {

            transition:
                transform 0.2s ease;
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

            background: var(--dept-purple-light);

            color: var(--dept-purple);

            border: 1px solid #d8cee9;

            font-size: 1.5rem;
        }


        .department-empty-state h2 {

            margin: 0 0 0.4rem;

            color: var(--dept-black);

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


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

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

            const modal =
                document.getElementById(modalId);

            if (!modal) {
                return;
            }


            if (show) {

                modal.classList.remove('hidden');

                document.body.classList.add(
                    'overflow-hidden'
                );

            } else {

                modal.classList.add('hidden');

                document.body.classList.remove(
                    'overflow-hidden'
                );

            }

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

                setTimeout(function() {

                    input.focus();

                }, 100);

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


            const nameInput =
                document.getElementById(
                    'editDepartmentName'
                );


            if (nameInput) {

                nameInput.value = name;

                setTimeout(function() {

                    nameInput.focus();

                }, 100);

            }


            const form =
                document.getElementById(
                    'editDepartmentForm'
                );


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


            if (nameElement) {

                nameElement.textContent = name;

            }


            const form =
                document.getElementById(
                    'deleteDepartmentForm'
                );


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
           CLOSE MODAL WHEN CLICKING BACKDROP
        ========================================================== */

        document.addEventListener(
            'click',
            function(event) {

                const modalIds = [
                    'createModal',
                    'editModal',
                    'deleteModal'
                ];


                modalIds.forEach(
                    function(id) {

                        const modal =
                            document.getElementById(id);


                        if (
                            modal &&
                            event.target === modal
                        ) {

                            modal.classList.add(
                                'hidden'
                            );

                            document.body.classList.remove(
                                'overflow-hidden'
                            );

                        }

                    }
                );

            }
        );


        /* =========================================================
           ESC KEY
        ========================================================== */

        document.addEventListener(
            'keydown',
            function(event) {

                if (event.key === 'Escape') {

                    closeCreateModal();

                    closeEditModal();

                    closeDeleteModal();

                }

            }
        );


        /* =========================================================
           SUCCESS ALERT AUTO REMOVE
        ========================================================== */

        document.addEventListener(
            'DOMContentLoaded',
            function() {

                const alert =
                    document.querySelector(
                        '.department-alert'
                    );


                if (alert) {

                    setTimeout(
                        function() {

                            alert.style.opacity = '0';

                            alert.style.transition =
                                'opacity 0.3s ease';


                            setTimeout(
                                function() {

                                    alert.remove();

                                },
                                300
                            );

                        },
                        4000
                    );

                }

            }
        );

    </script>

</x-app-layout>
