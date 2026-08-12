<x-app-layout>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="flex justify-between items-center mb-6">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Departments
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Manage all departments
                    </p>
                </div>


                {{-- Create Button --}}
                <button type="button" onclick="openCreateModal()"
                    class="inline-flex items-center gap-2
                       px-4 py-2
                       bg-blue-600
                       text-white
                       rounded-lg
                       hover:bg-blue-700
                       transition">

                    <span class="text-lg">+</span>

                    Add Department

                </button>

            </div>


            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div
                    class="mb-6 px-4 py-3
                        bg-green-50
                        border border-green-200
                        text-green-700
                        rounded-lg">

                    {{ session('success') }}

                </div>
            @endif


            {{-- DEPARTMENT LIST --}}
            <div
                class="bg-white
                    rounded-xl
                    shadow-sm
                    border border-gray-200
                    overflow-hidden">

                @forelse ($departments as $department)
                    <div
                        class="flex items-center justify-between
                            px-6 py-4
                            border-b border-gray-100
                            last:border-b-0
                            hover:bg-gray-50
                            transition">

                        {{-- Department Information --}}
                        <div>

                            <h3 class="font-semibold text-gray-800">
                                {{ $department->name }}
                            </h3>

                            <p class="text-xs text-gray-400 mt-1">
                                Department #{{ $department->id }}
                            </p>

                        </div>


                        {{-- ACTION BUTTONS --}}
                        <div class="flex items-center gap-2">


                            {{-- EDIT --}}
                            <button type="button"
                                onclick="openEditModal(
                                {{ $department->id }},
                                @js($department->name))"
                                class="inline-flex items-center gap-2
                                   px-3 py-2
                                   text-blue-600
                                   bg-blue-50
                                   hover:bg-blue-100
                                   rounded-lg
                                   font-medium
                                   transition">

                                {{-- Edit Icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h5m7-13l-4 4m0 0l-4 4m4-4h6" />

                                </svg>

                                Edit

                            </button>


                            {{-- DELETE --}}
                            <button type="button"
                                onclick="openDeleteModal({{ $department->id }},@js($department->name))"
                                class="inline-flex items-center gap-2
                                    px-3 py-2
                                    text-red-600
                                    bg-red-50
                                    hover:bg-red-100
                                    rounded-lg
                                    font-medium
                                    transition">

                                {{-- Trash Icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14" />

                                </svg>

                                Delete

                            </button>

                        </div>

                    </div>

                @empty

                    <div class="py-12 text-center">

                        <p class="text-gray-500">
                            No departments found.
                        </p>

                        <button type="button" onclick="openCreateModal()"
                            class="mt-3 text-blue-600
                               hover:text-blue-700
                               font-medium">

                            Create your first department

                        </button>

                    </div>
                @endforelse

            </div>

        </div>

    </div>


    {{-- CREATE MODAL --}}
    @include('admin.departments.create')


    {{-- EDIT MODAL --}}
    @include('admin.departments.edit')


    {{-- DELETE MODAL --}}
    @include('admin.departments.delete')


    {{-- JAVASCRIPT --}}
    <script>
        // CREATE
        function openCreateModal() {

            document
                .getElementById('createModal')
                .classList.remove('hidden');

            document
                .getElementById('createDepartmentName')
                .focus();
        }

        function closeCreateModal() {

            document
                .getElementById('createModal')
                .classList.add('hidden');
        }


        // EDIT
        function openEditModal(id, name) {

            document.getElementById('editModal')
                .classList.remove('hidden');

            document.getElementById('editDepartmentName')
                .value = name;

            let form = document.getElementById('editDepartmentForm');

            form.action = '/admin/departments/update/' + id;

            document.getElementById('editDepartmentName')
                .focus();

        }

        function closeEditModal() {

            document
                .getElementById('editModal')
                .classList.add('hidden');
        }

        // DELETE
        function openDeleteModal(id, name) {
            document.getElementById('deleteModal')
                .classList.remove('hidden');

            document.getElementById('deleteDepartmentName')
                .textContent = name;

            let form = document.getElementById('deleteDepartmentForm');

            form.action = '/admin/departments/delete/' + id;

        }

        function closeDeleteModal() {

            document
                .getElementById('deleteModal')
                .classList.add('hidden');
        }

        // CLOSE MODAL WHEN CLICKING OUTSIDE
        document.addEventListener('click', function(event) {

            const createModal =
                document.getElementById('createModal');

            const editModal =
                document.getElementById('editModal');

            const deleteModal =
                document.getElementById('deleteModal');

            // Close Create Modal
            if (event.target === createModal) {
                closeCreateModal();
            }


            // Close Edit Modal
            if (event.target === editModal) {
                closeEditModal();
            }

            // Close Delete Modal
            if (event.target === deleteModal) {
                closeDeleteModal();
            }

        });

        // ESC KEY
        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {

                closeCreateModal();
                closeEditModal();
                closeDeleteModal();

            }

        });
    </script>

</x-app-layout>
