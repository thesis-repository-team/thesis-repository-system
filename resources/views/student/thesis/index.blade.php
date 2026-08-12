<x-app-layout>

    <div class="container mt-3">
        <form action="{{ route('student.thesis.index') }}" method="GET" class="mb-3 d-flex gap-2">

            {{-- Search --}}
            <input type="text" id="search" name="search" class="form-control w-25"
                placeholder="Search name, department, email...">

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
            <select class="form-select w-25" id="yearFilter" name="year">
                <option value="">All Years</option>
                {{-- // Year options can be dynamically generated based on the available years in the database need to change --}}
                <option value="2026">2026</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
            </select>

            {{-- Reset Button --}}
            <button type="button" id="resetFilter" class="btn btn-secondary">
                <i class="bi bi-arrow-counterclockwise me-1"></i>
                Reset
            </button>

            <div class="d-flex justify-content-between align-items-center mb">
                @if (auth()->user()->student && auth()->user()->student->upload_permission)
                    <a href="{{ route('student.thesis.create') }}" class="btn btn-primary"> + Request Upload </a>
                @endif
            </div>
        </form>
        

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

                    <tbody id="studentTable">
                        @include('student.thesis.table')
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function loadData() {

                let search = document.getElementById('search').value;
                let department = document.getElementById('departmentFilter').value;
                let year = document.getElementById('yearFilter').value;

                fetch(
                        "{{ route('student.thesis.search') }}" +
                        "?search=" + encodeURIComponent(search) +
                        "&department=" + encodeURIComponent(department) +
                        "&year=" + encodeURIComponent(year)
                    )
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('studentTable').innerHTML = data;
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
