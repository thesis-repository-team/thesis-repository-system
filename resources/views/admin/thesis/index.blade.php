<x-app-layout>
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
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
            <select class="form-select w-25" id="yearFilter" name="year">
                <option value="">All Years</option>
                @foreach ($published_at as $year)
                    <option value="{{ $year }}">
                        {{ $year }}
                    </option>
                @endforeach
            </select>

            {{-- <select id="keywordFilter" class="form-select" name="keyword_id">
                <option value="">All Keywords</option>
                @foreach ($keywords as $keyword)
                    <option value="{{ $keyword->id }}">
                        {{ $keyword->keyword_name }}
                    </option>
                @endforeach
            </select> --}}


            {{-- Reset Button --}}
            <button type="button" id="resetFilter" class="btn btn-secondary">
                <i class="bi bi-arrow-counterclockwise me-1"></i>
                Reset
            </button>

            <a href="{{ route('admin.thesis.create') }}" class="btn btn-primary">
                + Add Thesis
            </a>
        </div>


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

                    <tbody id="adminHodTable">
                        @include('admin.thesis.table')
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
                // let keyword = document.getElementById('keywordFilter').value;
                let year = document.getElementById('yearFilter').value;

                fetch(
                        "{{ route('admin.thesis.search') }}" +
                        "?search=" + encodeURIComponent(search) +
                        "&department=" + encodeURIComponent(department) +
                        // "&keyword_id=" + encodeURIComponent(department) +
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
            // document.getElementById('keywordFilter').addEventListener('change', loadData);
            document.getElementById('resetFilter').addEventListener('click', function() {

                document.getElementById('search').value = "";
                document.getElementById('departmentFilter').value = "";
                // document.getElementById('keywordFilter').value = "";
                document.getElementById('yearFilter').value = "";

                loadData();
            });

        });
    </script>
</x-app-layout>
