<x-app-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            {{-- <h2>Thesis List</h2> --}}

            {{-- //What we have update --}}
            <input type="text" id="search" class="form-control w-25" placeholder="Search name, department, email...">

            <a href="{{ route('hod.thesis.create') }}" class="btn btn-primary">
                + Add Thesis
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Department</th>
                            <th>Submitted By</th>
                            <th>Published By</th>
                            <th>Published At</th>
                            <th width="170">Action</th>
                        </tr>
                    </thead>

                    <tbody id="hodTable">
                        @include('hod.thesis.table')
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- //what we add more --}}
     <script>
        document.getElementById('search').addEventListener('input', function() {

            let search = this.value;

            fetch("{{ route('hod.thesis.search') }}?search=" + search)

                .then(response => response.text())
                .then(data => {
                    document.getElementById('hodTable').innerHTML = data;
                });
        });
    </script>
</x-app-layout>
