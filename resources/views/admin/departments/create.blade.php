{{-- CREATE MODAL --}}
<div id="createModal"
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
                    Create Department
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Add a new department.
                </p>

            </div>


            <button type="button" onclick="closeCreateModal()"
                class="text-gray-400
                       hover:text-gray-600
                       text-2xl">
                &times;

            </button>

        </div>


        {{-- Create Form --}}
        <form method="POST" action="{{ route('admin.departments.store') }}">

            @csrf

            <div class="p-6">

                <label for="createDepartmentName"
                    class="block text-sm font-semibold
                           text-gray-700 mb-2">

                    Department Name

                </label>

                <input type="text" id="createDepartmentName" name="name" value="{{ old('name') }}"
                    placeholder="Enter department name"
                    class="w-full px-4 py-2.5
                           border border-gray-300
                           rounded-lg
                           focus:ring-2
                           focus:ring-blue-500
                           focus:border-blue-500
                           outline-none">


                @error('name')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Footer --}}
            <div
                class="flex justify-end gap-3
                        px-6 py-4
                        bg-gray-50
                        border-t border-gray-200
                        rounded-b-2xl">

                <button type="button" onclick="closeCreateModal()"
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

                    Create Department

                </button>

            </div>

        </form>

    </div>

</div>
