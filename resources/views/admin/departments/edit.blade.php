{{-- EDIT MODAL --}}
<div id="editModal"
    class="hidden fixed inset-0 z-50
           bg-black/50
           flex items-center justify-center
           px-4">

    <div class="bg-white
                w-full max-w-md
                rounded-2xl
                shadow-xl">


        {{-- Modal Header --}}
        <div
            class="flex items-center justify-between
                    px-6 py-4
                    border-b border-gray-200">

            <div>

                <h3 class="text-xl font-bold text-gray-800">
                    Edit Department
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Update the department name.
                </p>

            </div>


            <button type="button" onclick="closeEditModal()"
                class="text-gray-400
                       hover:text-gray-600
                       text-2xl">

                &times;

            </button>

        </div>


        {{-- Edit Form --}}
        <form id="editDepartmentForm" method="POST"
            action="{{ route('admin.departments.update', ['department' => '__ID__']) }}">

            @csrf
            @method('PUT')

            <div class="p-6">

                <label for="editDepartmentName"
                    class="block text-sm font-semibold
                           text-gray-700 mb-2">

                    Department Name

                </label>

                <input type="text" id="editDepartmentName" name="name"
                    class="w-full px-4 py-2.5
                           border border-gray-300
                           rounded-lg
                           focus:ring-2
                           focus:ring-blue-500
                           focus:border-blue-500
                           outline-none">

            </div>


            {{-- Footer --}}
            <div
                class="flex justify-end gap-3
                        px-6 py-4
                        bg-gray-50
                        border-t border-gray-200
                        rounded-b-2xl">

                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2
                           border border-gray-300
                           text-gray-700
                           rounded-lg
                           hover:bg-gray-100">

                    Cancel

                </button>


                <button type="submit"
                    class="px-5 py-2
                           bg-blue-600
                           text-white
                           rounded-lg
                           hover:bg-blue-700">

                    Save

                </button>

            </div>

        </form>

    </div>

</div>
