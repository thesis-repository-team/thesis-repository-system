<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header">
            <h3>Add Thesis</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('hod.thesis.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Title</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title') }}">
                </div>

                <div class="mb-3">
                    <label>Author Name</label>
                    <input
                        type="text"
                        name="author_name"
                        class="form-control"
                        value="{{ old('author_name') }}">
                </div>

                <div class="mb-3">
                    <label>Department</label>

                    <select
                        name="department_id"
                        class="form-select">

                        <option value="">Select Department</option>

                        @foreach($departments as $department)

                            <option
                                value="{{ $department->id }}">

                                {{ $department->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">
                    <label>Abstract</label>

                    <textarea
                        name="abstract"
                        rows="5"
                        class="form-control">{{ old('abstract') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Description</label>

                    <textarea
                        name="description"
                        rows="6"
                        class="form-control">{{ old('description') }}</textarea>
                </div>

                <button class="btn btn-success">
                    Save Thesis
                </button>

                <a href="{{ route('hod.thesis.index') }}"
                    class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

</x-app-layout>