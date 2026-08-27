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
                @foreach ($published_at as $published)
                    <option value="{{ $published }}">
                        {{ $published }}
                    </option>
                @endforeach
            </select>

            {{-- Reset Button --}}
            <button type="button" id="resetFilter" class="btn btn-secondary">
                <i class="bi bi-arrow-counterclockwise me-1"></i>
                Reset
            </button>
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

    <style>
        /* =========================================================
   STUDENT THESIS PAGE
========================================================= */

        .student-thesis-page {
            width: 100%;
            padding: 30px 35px;
            min-height: calc(100vh - 70px);
            background: #f5f6f8;
            box-sizing: border-box;
        }


        /* =========================================================
   PAGE HEADER
========================================================= */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-title {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #111827;
        }

        .page-subtitle {
            margin: 5px 0 0;
            font-size: 14px;
            color: #6b7280;
        }


        /* =========================================================
   FILTER CARD
========================================================= */

        .filter-card {
            width: 100%;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 22px 24px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            box-sizing: border-box;
        }

        .filter-row {
            width: 100%;
            display: grid;
            grid-template-columns: 2fr 1.4fr 1.2fr 120px;
            gap: 18px;
            align-items: end;
        }

        .filter-item {
            width: 100%;
        }

        .search-box {
            width: 100%;
        }


        /* =========================================================
   FILTER LABEL
========================================================= */

        .filter-item label {
            display: block;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }


        /* =========================================================
   SEARCH
========================================================= */

        .input-wrapper {
            position: relative;
            width: 100%;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 14px;
            z-index: 2;
        }

        .input-wrapper .form-control {
            padding-left: 40px;
        }


        /* =========================================================
   INPUT / SELECT
========================================================= */

        .filter-card .form-control,
        .filter-card .form-select {
            width: 100%;
            height: 44px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #ffffff;
            color: #374151;
            font-size: 14px;
        }

        .filter-card .form-control::placeholder {
            color: #9ca3af;
        }

        .filter-card .form-control:focus,
        .filter-card .form-select:focus {
            border-color: #111827;
            box-shadow: 0 0 0 2px rgba(17, 24, 39, 0.08);
        }


        /* =========================================================
   RESET BUTTON
========================================================= */

        .filter-button {
            width: 120px;
        }

        .btn-reset {
            width: 100%;
            height: 44px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #ffffff;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-reset i {
            margin-right: 6px;
        }

        .btn-reset:hover {
            background: #111827;
            border-color: #111827;
            color: #ffffff;
        }


        /* =========================================================
   THESIS CARD
========================================================= */

        .thesis-card {
            width: 100%;
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }


        /* =========================================================
   CARD HEADER
========================================================= */

        .thesis-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
        }

        .thesis-card-header h5 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #111827;
        }

        .thesis-card-header span {
            display: block;
            margin-top: 4px;
            font-size: 13px;
            color: #6b7280;
        }

        .thesis-icon {
            width: 42px;
            height: 42px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #111827;
            color: #ffffff;
            font-size: 18px;
        }


        /* =========================================================
   TABLE
========================================================= */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .thesis-table {
            width: 100%;
            min-width: 1200px;
            border-collapse: collapse;
        }

        .thesis-table thead {
            background: #111827;
            color: #ffffff;
        }

        .thesis-table th {
            padding: 15px 16px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            white-space: nowrap;
            text-align: left;
        }

        .thesis-table td {
            padding: 15px 16px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
            color: #374151;
            vertical-align: middle;
        }

        .thesis-table tbody tr {
            transition: background 0.15s ease;
        }

        .thesis-table tbody tr:hover {
            background: #f9fafb;
        }

        .thesis-table tbody tr:last-child td {
            border-bottom: none;
        }


        /* =========================================================
   TABLE COLUMNS
========================================================= */

        .thesis-table th:first-child,
        .thesis-table td:first-child {
            width: 50px;
            text-align: center;
        }

        .thesis-table th:nth-child(2),
        .thesis-table td:nth-child(2) {
            min-width: 250px;
        }

        .thesis-table th:nth-child(3),
        .thesis-table td:nth-child(3) {
            min-width: 150px;
        }

        .thesis-table th:nth-child(4),
        .thesis-table td:nth-child(4) {
            min-width: 170px;
        }

        .thesis-table th:nth-child(5),
        .thesis-table td:nth-child(5) {
            min-width: 150px;
        }

        .thesis-table th:nth-child(6),
        .thesis-table td:nth-child(6) {
            min-width: 150px;
        }

        .thesis-table th:nth-child(7),
        .thesis-table td:nth-child(7) {
            min-width: 130px;
            white-space: nowrap;
        }

        .thesis-table th:nth-child(8),
        .thesis-table td:nth-child(8) {
            width: 170px;
            min-width: 170px;
            text-align: center;
        }


        /* =========================================================
   ACTION BUTTON
========================================================= */

        .thesis-table .btn {
            border-radius: 7px;
            font-size: 12px;
            padding: 7px 10px;
        }


        /* =========================================================
   TABLE SCROLLBAR
========================================================= */

        .table-wrapper::-webkit-scrollbar {
            height: 8px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: #f3f4f6;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: #9ca3af;
            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }


        /* =========================================================
   RESPONSIVE
========================================================= */

        @media (max-width: 1200px) {

            .student-thesis-page {
                padding: 25px;
            }

            .filter-row {
                grid-template-columns: 1.5fr 1fr 1fr 110px;
                gap: 12px;
            }
        }


        @media (max-width: 992px) {

            .filter-row {
                grid-template-columns: 1fr 1fr;
            }

            .search-box {
                grid-column: span 2;
            }

            .filter-button {
                width: 100%;
            }
        }


        @media (max-width: 768px) {

            .student-thesis-page {
                padding: 20px 15px;
            }

            .page-title {
                font-size: 23px;
            }

            .filter-card {
                padding: 18px;
            }

            .filter-row {
                display: flex;
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .search-box,
            .filter-item,
            .filter-button {
                width: 100%;
            }

            .thesis-card-header {
                padding: 17px;
            }

            .thesis-card-header h5 {
                font-size: 16px;
            }
        }


        @media (max-width: 576px) {

            .student-thesis-page {
                padding: 15px 10px;
            }

            .page-title {
                font-size: 21px;
            }

            .filter-card {
                padding: 15px;
            }

            .thesis-card-header {
                padding: 15px;
            }

            .thesis-icon {
                width: 36px;
                height: 36px;
                font-size: 15px;
            }
        }
    </style>

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
