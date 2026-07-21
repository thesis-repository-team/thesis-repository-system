<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header">
            <h3>Edit Thesis</h3>
        </div>

        <div class="card-body">

            <form
                action="{{ route('hod.thesis.update',$thesis) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Title</label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title',$thesis->title) }}">
                </div>

                <div class="mb-3">
                    <label>Author Name</label>

                    <input
                        type="text"
                        name="author_name"
                        class="form-control"
                        value="{{ old('author_name',$thesis->author_name) }}">
                </div>

                <div class="mb-3">

                    <label>Department</label>

                    <select
                        name="department_id"
                        class="form-select">

                        @foreach($departments as $department)

                        <option
                            value="{{ $department->id }}"
                            {{ $thesis->department_id == $department->id ? 'selected' : '' }}>

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
                        class="form-control">{{ old('abstract',$thesis->abstract) }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Description</label>

                    <textarea
                        name="description"
                        rows="6"
                        class="form-control">{{ old('description',$thesis->description) }}</textarea>

                </div>

                <button class="btn btn-primary">
                    Update Thesis
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