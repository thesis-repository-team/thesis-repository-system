<div id="deleteModal"
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
                    Delete Department
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    This action cannot be undone.
                </p>
            </div>

            <button type="button" onclick="closeDeleteModal()"
                class="text-gray-400
                       hover:text-gray-600
                       text-2xl">

                &times;

            </button>

        </div>


        {{-- Delete Content --}}
        <div class="p-6">

            <div class="flex items-start gap-3">

                {{-- Warning Icon --}}
                <div
                    class="flex-shrink-0
                            w-10 h-10
                            flex items-center justify-center
                            rounded-full
                            bg-red-100">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.84 21h16.32a2 2 0 001.73-3.14l-8.18-14a2 2 0 00-3.42 0z" />

                    </svg>

                </div>


                {{-- Message --}}
                <div>

                    <p class="text-gray-700">
                        Are you sure you want to delete
                        <strong id="deleteDepartmentName"></strong>?
                    </p>

                    <p class="text-sm text-gray-500 mt-2">
                        All data associated with this department may be affected.
                    </p>

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div
            class="flex justify-end gap-3
                    px-6 py-4
                    bg-gray-50
                    border-t border-gray-200
                    rounded-b-2xl">

            {{-- Cancel --}}
            <button type="button" onclick="closeDeleteModal()"
                class="px-4 py-2
                       border border-gray-300
                       text-gray-700
                       rounded-lg
                       hover:bg-gray-100">

                Cancel

            </button>


            {{-- Delete Form --}}
            <form id="deleteDepartmentForm" method="POST"
                action="{{ route('admin.departments.destroy', ['department' => '__ID__']) }}">

                @csrf
                @method('DELETE')

                <button type="submit"
                    class="inline-flex items-center gap-2
                           px-5 py-2
                           bg-red-600
                           text-white
                           rounded-lg
                           hover:bg-red-700">

                    {{-- Trash Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14" />

                    </svg>

                    Delete

                </button>

            </form>

        </div>

    </div>

</div>
