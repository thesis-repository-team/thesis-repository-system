<x-app-layout>
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <input type="text" id="search" class="form-control w-25" placeholder="Search name, department, email...">

            {{-- Department Filter --}}
            <select class="form-select w-25" id="departmentFilter" name="department">
                <option value="">All Departments</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Software Engineering">Software Engineering</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Physics">Physics</option>
            </select>

            {{-- Year Filter --}}
            <select class="form-select w-25" id="yearFilter" name="started_year">
                <option value="">All Years</option>
                <option value="2026">2026</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
            </select>

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

                loadData(); 
            });

        });
    </script>

</x-app-layout>
