<x-app-layout>
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <input type="text" id="search" class="form-control w-25" placeholder="Search name, department, email...">

            {{-- Department Filter --}}
            <select class="form-select w-25" id="departmentFilter" name="department">
                <option value="">All Departments</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->name }}">
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>

            {{-- Year Filter --}}
            <select class="form-select w-25" id="yearFilter" name="started_year">
                <option value="">All Years</option>
                <option value="2026">2026</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
            </select>
<<<<<<< Updated upstream
=======
            
            {{-- Reset Button --}}
            <button type="button" id="resetFilter" class="btn btn-secondary">
                <i class="bi bi-arrow-counterclockwise me-1"></i>
                Reset
            </button>
>>>>>>> Stashed changes

            <a href="{{ route('admin.hods.create') }}" class="btn btn-primary">
                + Add HoD
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Started Year</th>
                                <th>Status</th>
                                <th width="180">Actions</th>
                            </tr>
                        </thead>

                        <tbody id="adminHodTable">

                            @include('admin.hods.table')

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<<<<<<< Updated upstream

    {{-- <script>
        document.getElementById('search').addEventListener('input', function() {

            let search = this.value;

            fetch("{{ route('admin.hods.search') }}?search=" + search)

                .then(response => response.text())
                .then(data => {
                    document.getElementById('hodTable').innerHTML = data;
                });
        });
    </script> --}}

=======
>>>>>>> Stashed changes
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function loadData() {

                let search = document.getElementById('search').value;
                let department = document.getElementById('departmentFilter').value;
                let year = document.getElementById('yearFilter').value;

                fetch(
                        "{{ route('admin.hods.search') }}" +
                        "?search=" + encodeURIComponent(search) +
                        "&department=" + encodeURIComponent(department) +
                        "&year=" + encodeURIComponent(year)
                    )
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('adminHodTable').innerHTML = data;
                    })
                    .catch(error => console.log(error));
            }

            document.getElementById('search').addEventListener('input', loadData);
            document.getElementById('departmentFilter').addEventListener('change', loadData);
            document.getElementById('yearFilter').addEventListener('change', loadData);
            document.getElementById('resetFilter').addEventListener('click', function() {

                document.getElementById('search').value = "";
                document.getElementById('departmentFilter').value = "";
                document.getElementById('yearFilter').value = "";

<<<<<<< Updated upstream
                loadData(); 
=======
                loadData();
>>>>>>> Stashed changes
            });

        });
    </script>

</x-app-layout>
