{{-- =========================================================
     CARD VIEW
========================================================= --}}

<div class="student-partial-card-results">

    @forelse ($students as $student)
        <div class="admin-student-card">

            {{-- CARD BODY --}}
            <div class="admin-student-card-body">

                {{-- =================================================
                     TOP SECTION
                ================================================== --}}

                <div class="admin-student-card-top">

                    <div class="admin-student-profile">

                        <div class="admin-student-icon">
                            <i class="bi bi-person"></i>
                        </div>

                        <div class="admin-student-profile-info">

                            <h3 class="admin-student-card-title">
                                {{ $student->full_name }}
                            </h3>

                            <span class="admin-student-id">
                                Student #{{ $loop->iteration }}
                            </span>

                        </div>

                    </div>


                    {{-- UPLOAD PERMISSION --}}

                    @if ($student->upload_permission)
                        <span class="admin-student-permission admin-student-permission-allowed">

                            <i class="bi bi-check-circle-fill"></i>

                            Allowed

                        </span>
                    @else
                        <span class="admin-student-permission admin-student-permission-denied">

                            <i class="bi bi-x-circle-fill"></i>

                            Not Allowed

                        </span>
                    @endif

                </div>


                {{-- =================================================
                     DIVIDER
                ================================================== --}}

                <div class="admin-student-card-divider"></div>


                {{-- =================================================
                     EMAIL
                ================================================== --}}

                <div class="admin-student-info-row">

                    <div class="admin-student-info-icon">
                        <i class="bi bi-envelope"></i>
                    </div>

                    <div class="admin-student-info-content">

                        <span class="admin-student-info-label">
                            Email
                        </span>

                        <span class="admin-student-info-value admin-student-email"
                            title="{{ $student->user->email ?? 'N/A' }}">

                            {{ $student->user->email ?? 'N/A' }}

                        </span>

                    </div>

                </div>


                {{-- =================================================
                     DEPARTMENT
                ================================================== --}}

                <div class="admin-student-info-row">

                    <div class="admin-student-info-icon">
                        <i class="bi bi-building"></i>
                    </div>

                    <div class="admin-student-info-content">

                        <span class="admin-student-info-label">
                            Department
                        </span>

                        <span class="admin-student-info-value">

                            {{ $student->department->name ?? 'N/A' }}

                        </span>

                    </div>

                </div>


                {{-- =================================================
                     STARTED YEAR
                ================================================== --}}

                <div class="admin-student-info-row">

                    <div class="admin-student-info-icon">
                        <i class="bi bi-calendar3"></i>
                    </div>

                    <div class="admin-student-info-content">

                        <span class="admin-student-info-label">
                            Started Year
                        </span>

                        <span class="admin-student-year-badge">

                            {{ $student->started_year ?? 'N/A' }}

                        </span>

                    </div>

                </div>


                {{-- =================================================
                     EDIT BUTTON
                ================================================== --}}

                <div class="admin-student-card-action">

                    <a href="{{ route('hod.students.edit', $student->id) }}" class="admin-student-edit-button">

                        <i class="bi bi-pencil-square"></i>

                        <span>
                            Edit
                        </span>

                    </a>

                </div>

            </div>

        </div>

    @empty

        <div class="admin-student-empty-result">

            <div class="admin-student-empty-result-icon">

                <i class="bi bi-people"></i>

            </div>

            <h5>
                No Students Found
            </h5>

            <p>
                No students match your current search or filter.
            </p>

        </div>
    @endforelse

</div>



{{-- =========================================================
     TABLE VIEW
========================================================= --}}

<div class="student-partial-table-results">

    <div class="student-table-wrapper">

        <table class="student-table">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Student</th>

                    <th>Email</th>

                    <th>Department</th>

                    <th>Started Year</th>

                    <th>Upload Permission</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse ($students as $student)
                    <tr>

                        {{-- NUMBER --}}

                        <td>
                            {{ $loop->iteration }}
                        </td>


                        {{-- STUDENT --}}

                        <td>

                            <div class="student-table-profile">
                                {{-- 
                                <div class="student-table-avatar">

                                    <i class="bi bi-person"></i>

                                </div> --}}

                                <div>

                                    <span class="student-table-name">

                                        {{ $student->full_name }}

                                    </span>

                                    {{-- <span class="student-table-number">

                                        Student #{{ $loop->iteration }}

                                    </span> --}}

                                </div>

                            </div>

                        </td>


                        {{-- EMAIL --}}

                        <td>

                            <div class="student-table-email" title="{{ $student->user->email ?? 'N/A' }}">

                                {{ $student->user->email ?? 'N/A' }}

                            </div>

                        </td>


                        {{-- DEPARTMENT --}}

                        <td>

                            {{ $student->department->name ?? 'N/A' }}

                        </td>


                        {{-- YEAR --}}

                        <td>

                            <span class="student-table-year">

                                {{ $student->started_year ?? 'N/A' }}

                            </span>

                        </td>


                        {{-- UPLOAD PERMISSION --}}

                        <td>

                            @if ($student->upload_permission)
                                <span class="student-table-permission allowed">

                                    <i class="bi bi-check-circle-fill"></i>

                                    Allowed

                                </span>
                            @else
                                <span class="student-table-permission denied">

                                    <i class="bi bi-x-circle-fill"></i>

                                    Not Allowed

                                </span>
                            @endif

                        </td>


                        {{-- ACTION --}}

                        <td>

                            <a href="{{ route('admin.students.edit', $student->id) }}"
                                class="student-table-edit-button">

                                <i class="bi bi-pencil-square"></i>

                                <span>
                                    Edit
                                </span>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="student-table-empty">

                            <i class="bi bi-people"></i>

                            <strong>
                                No Students Found
                            </strong>

                            <span>
                                No students match your current search or filter.
                            </span>

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>



<style>
    /* =========================================================
   CARD GRID
========================================================= */

    .student-partial-card-results {

        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 1.25rem;

        width: 100%;

    }


    /* =========================================================
   STUDENT CARD
========================================================= */

    .admin-student-card {

        position: relative;

        width: 100%;

        min-width: 0;

        overflow: hidden;

        background: #ffffff;

        border: 1px solid #e1e1e1;

        border-radius: 12px;

        box-shadow:
            0 2px 10px rgba(0, 0, 0, .04);

        transition:
            transform .2s ease,
            box-shadow .2s ease,
            border-color .2s ease;

    }


    .admin-student-card:hover {

        transform: translateY(-2px);

        border-color: #cfcfcf;

        box-shadow:
            0 8px 24px rgba(0, 0, 0, .08);

    }


    /* =========================================================
   CARD BODY
========================================================= */

    .admin-student-card-body {

        padding: 1.15rem;

    }


    /* =========================================================
   CARD TOP
========================================================= */

    .admin-student-card-top {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: .75rem;

    }


    /* =========================================================
   PROFILE
========================================================= */

    .admin-student-profile {

        display: flex;

        align-items: center;

        gap: .75rem;

        min-width: 0;

        flex: 1;

    }


    .admin-student-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 43px;

        height: 43px;

        flex-shrink: 0;

        color: #ffffff;

        background: #6538d9;

        border-radius: 50%;

    }


    .admin-student-icon i {

        font-size: 1rem;

    }


    .admin-student-profile-info {

        min-width: 0;

    }


    .admin-student-card-title {

        margin: 0;

        overflow: hidden;

        color: #111111;

        font-size: .9rem;

        font-weight: 800;

        line-height: 1.35;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    .admin-student-id {

        display: block;

        margin-top: .2rem;

        color: #888888;

        font-size: .62rem;

        font-weight: 600;

    }


    /* =========================================================
   PERMISSION
========================================================= */

    .admin-student-permission {

        display: inline-flex;

        align-items: center;

        gap: .3rem;

        flex-shrink: 0;

        padding: .3rem .45rem;

        border-radius: 5px;

        font-size: .55rem;

        font-weight: 800;

        text-transform: uppercase;

        white-space: nowrap;

    }


    .admin-student-permission i {

        font-size: .62rem;

    }


    .admin-student-permission-allowed {

        color: #15803d;

        background: #f0fdf4;

        border: 1px solid #bbf7d0;

    }


    .admin-student-permission-denied {

        color: #dc2626;

        background: #fef2f2;

        border: 1px solid #fecaca;

    }


    /* =========================================================
   DIVIDER
========================================================= */

    .admin-student-card-divider {

        width: 100%;

        height: 1px;

        margin: 1rem 0;

        background: #eeeeee;

    }


    /* =========================================================
   INFORMATION ROW
========================================================= */

    .admin-student-info-row {

        display: flex;

        align-items: center;

        gap: .7rem;

        min-width: 0;

        margin-bottom: .75rem;

    }


    .admin-student-info-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 32px;

        height: 32px;

        flex-shrink: 0;

        color: #6538d9;

        background: #f5f2ff;

        border-radius: 7px;

    }


    .admin-student-info-icon i {

        font-size: .78rem;

    }


    .admin-student-info-content {

        display: flex;

        flex-direction: column;

        min-width: 0;

        flex: 1;

    }


    .admin-student-info-label {

        margin-bottom: .12rem;

        color: #888888;

        font-size: .57rem;

        font-weight: 800;

        letter-spacing: .04em;

        text-transform: uppercase;

    }


    .admin-student-info-value {

        overflow: hidden;

        color: #222222;

        font-size: .73rem;

        font-weight: 700;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    .admin-student-email {

        display: block;

    }


    .admin-student-year-badge {

        display: inline-flex;

        align-items: center;

        width: fit-content;

        padding: .2rem .4rem;

        color: #222222;

        background: #f5f5f5;

        border: 1px solid #dddddd;

        border-radius: 4px;

        font-family: monospace;

        font-size: .65rem;

        font-weight: 700;

    }


    /* =========================================================
   CARD ACTION
========================================================= */

    .admin-student-card-action {

        margin-top: 1rem;

        padding-top: .85rem;

        border-top: 1px solid #eeeeee;

    }


    .admin-student-edit-button {

        display: flex;

        align-items: center;

        justify-content: center;

        gap: .45rem;

        width: 100%;

        height: 37px;

        color: #6538d9;

        background: transparent;

        border: 1px solid #6538d9;

        border-radius: 6px;

        font-size: .65rem;

        font-weight: 800;

        text-decoration: none;

        text-transform: uppercase;

        transition: .2s ease;

    }


    .admin-student-edit-button:hover {

        color: #ffffff;

        background: #6538d9;

        border-color: #6538d9;

    }


    .admin-student-edit-button i {

        font-size: .8rem;

    }


    /* =========================================================
   EMPTY CARD
========================================================= */

    .admin-student-empty-result {

        grid-column: 1 / -1;

        padding: 4rem 1rem;

        text-align: center;

    }


    .admin-student-empty-result-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 65px;

        height: 65px;

        margin: 0 auto 1rem;

        color: #777777;

        background: #f7f7f7;

        border: 1px solid #e5e5e5;

        border-radius: 50%;

    }


    .admin-student-empty-result-icon i {

        font-size: 1.6rem;

    }


    .admin-student-empty-result h5 {

        margin: 0 0 .35rem;

        color: #222222;

        font-size: .85rem;

        font-weight: 800;

        text-transform: uppercase;

    }


    .admin-student-empty-result p {

        margin: 0;

        color: #888888;

        font-size: .72rem;

    }


    /* =========================================================
   DARK MODE CARD
========================================================= */

    [data-bs-theme="dark"] .admin-student-card {

        background: #181d33;

        border-color: #292e45;

        box-shadow:
            0 3px 12px rgba(0, 0, 0, .3);

    }


    [data-bs-theme="dark"] .admin-student-card:hover {

        background: #1b2038;

        border-color: #3a405a;

        box-shadow:
            0 8px 24px rgba(0, 0, 0, .4);

    }


    [data-bs-theme="dark"] .admin-student-card-title {

        color: #ffffff;

    }


    [data-bs-theme="dark"] .admin-student-id {

        color: #8e95b0;

    }


    [data-bs-theme="dark"] .admin-student-card-divider {

        background: #292e45;

    }


    [data-bs-theme="dark"] .admin-student-info-icon {

        color: #a88ff0;

        background: #25203c;

    }


    [data-bs-theme="dark"] .admin-student-info-label {

        color: #8e95b0;

    }


    [data-bs-theme="dark"] .admin-student-info-value {

        color: #eeeef8;

    }


    [data-bs-theme="dark"] .admin-student-year-badge {

        color: #eeeeee;

        background: #20253a;

        border-color: #343a52;

    }


    [data-bs-theme="dark"] .admin-student-card-action {

        border-color: #292e45;

    }


    [data-bs-theme="dark"] .admin-student-edit-button {

        color: #a88ff0;

        border-color: #a88ff0;

    }


    [data-bs-theme="dark"] .admin-student-edit-button:hover {

        color: #ffffff;

        background: #6538d9;

        border-color: #6538d9;

    }


    [data-bs-theme="dark"] .admin-student-empty-result h5 {

        color: #ffffff;

    }


    [data-bs-theme="dark"] .admin-student-empty-result-icon {

        color: #999fb9;

        background: #20253a;

        border-color: #343a52;

    }


    /* =========================================================
   TABLE
========================================================= */

    .student-partial-table-results {

        display: none;

    }


    .student-results-container.table-mode .student-partial-card-results {

        display: none;

    }


    .student-results-container.table-mode .student-partial-table-results {

        display: block;

    }


    .student-table-wrapper {

        width: 100%;

        overflow-x: auto;

        background: #ffffff;

        border: 1px solid #e1e1e1;

        border-radius: 10px;

    }


    .student-table {

        width: 100%;

        min-width: 950px;

        border-collapse: collapse;

    }


    .student-table th {

        padding: .85rem;

        color: #444444;

        background: #f8f8f8;

        border-bottom: 1px solid #dddddd;

        font-size: .64rem;

        font-weight: 800;

        text-align: left;

        text-transform: uppercase;

        white-space: nowrap;

    }


    .student-table td {

        padding: .8rem;

        color: #222222;

        background: #ffffff;

        border-bottom: 1px solid #eeeeee;

        font-size: .74rem;

        vertical-align: middle;

    }


    .student-table tbody tr:hover td {

        background: #fafafa;

    }


    .student-table tbody tr:last-child td {

        border-bottom: 0;

    }


    /* =========================================================
   TABLE PROFILE
========================================================= */

    .student-table-profile {

        display: flex;

        align-items: center;

        gap: .6rem;

        min-width: 190px;

    }


    .student-table-avatar {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 35px;

        height: 35px;

        flex-shrink: 0;

        color: #ffffff;

        background: #6538d9;

        border-radius: 50%;

    }


    .student-table-name {

        display: block;

        max-width: 210px;

        overflow: hidden;

        color: #222222;

        font-size: .74rem;

        font-weight: 800;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    .student-table-number {

        display: block;

        margin-top: .12rem;

        color: #888888;

        font-size: .58rem;

    }


    .student-table-email {

        max-width: 220px;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    /* =========================================================
   TABLE YEAR
========================================================= */

    .student-table-year {

        display: inline-flex;

        padding: .25rem .45rem;

        color: #333333;

        background: #f5f5f5;

        border: 1px solid #dddddd;

        border-radius: 5px;

        font-family: monospace;

        font-size: .63rem;

    }


    /* =========================================================
   TABLE PERMISSION
========================================================= */

    .student-table-permission {

        display: inline-flex;

        align-items: center;

        gap: .3rem;

        padding: .3rem .5rem;

        border-radius: 5px;

        font-size: .6rem;

        font-weight: 800;

        white-space: nowrap;

    }


    .student-table-permission.allowed {

        color: #15803d;

        background: #f0fdf4;

        border: 1px solid #bbf7d0;

    }


    .student-table-permission.denied {

        color: #dc2626;

        background: #fef2f2;

        border: 1px solid #fecaca;

    }


    /* =========================================================
   TABLE EDIT
========================================================= */

    .student-table-edit-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: .35rem;

        min-width: 75px;

        height: 33px;

        padding: .3rem .6rem;

        color: #6538d9;

        background: transparent;

        border: 1px solid #6538d9;

        border-radius: 6px;

        font-size: .61rem;

        font-weight: 800;

        text-decoration: none;

        text-transform: uppercase;

        transition: .2s ease;

    }


    .student-table-edit-button:hover {

        color: #ffffff;

        background: #6538d9;

        border-color: #6538d9;

    }


    /* =========================================================
   TABLE EMPTY
========================================================= */

    .student-table-empty {

        height: 220px;

        text-align: center !important;

    }


    .student-table-empty i {

        display: block;

        margin-bottom: .5rem;

        color: #888888;

        font-size: 1.7rem;

    }


    .student-table-empty strong {

        display: block;

        color: #333333;

        font-size: .8rem;

    }


    .student-table-empty span {

        display: block;

        margin-top: .25rem;

        color: #888888;

        font-size: .7rem;

    }


    /* =========================================================
   DARK MODE TABLE
========================================================= */

    [data-bs-theme="dark"] .student-table-wrapper {

        background: #181d33;

        border-color: #292e45;

    }


    [data-bs-theme="dark"] .student-table th {

        color: #d5d8e8;

        background: #20253a;

        border-color: #343a52;

    }


    [data-bs-theme="dark"] .student-table td {

        color: #eeeef8;

        background: #181d33;

        border-color: #292e45;

    }


    [data-bs-theme="dark"] .student-table tbody tr:hover td {

        background: #20253a;

    }


    [data-bs-theme="dark"] .student-table-name {

        color: #ffffff;

    }


    [data-bs-theme="dark"] .student-table-number {

        color: #8e95b0;

    }


    [data-bs-theme="dark"] .student-table-year {

        color: #eeeeee;

        background: #20253a;

        border-color: #343a52;

    }


    [data-bs-theme="dark"] .student-table-permission.allowed {

        color: #4ade80;

        background: #07140b;

        border-color: #166534;

    }


    [data-bs-theme="dark"] .student-table-permission.denied {

        color: #f87171;

        background: #1a0808;

        border-color: #7f1d1d;

    }


    [data-bs-theme="dark"] .student-table-edit-button {

        color: #a88ff0;

        border-color: #a88ff0;

    }


    [data-bs-theme="dark"] .student-table-edit-button:hover {

        color: #ffffff;

        background: #6538d9;

        border-color: #6538d9;

    }


    [data-bs-theme="dark"] .student-table-empty strong {

        color: #ffffff;

    }


    [data-bs-theme="dark"] .student-table-empty i {

        color: #999fb9;

    }


    /* =========================================================
   RESPONSIVE
========================================================= */

    @media (max-width: 1399.98px) {

        .student-partial-card-results {

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

        }

    }


    @media (max-width: 1199.98px) {

        .student-partial-card-results {

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

        }

    }


    @media (max-width: 767.98px) {

        .student-partial-card-results {

            grid-template-columns: 1fr;

            gap: 1rem;

        }


        .admin-student-card-body {

            padding: 1rem;

        }


        .admin-student-card-title {

            font-size: .84rem;

        }


        .admin-student-permission {

            font-size: .5rem;

        }


        .student-table-wrapper {

            border-radius: 8px;

        }

    }


    @media (max-width: 575.98px) {

        .admin-student-card-top {

            gap: .5rem;

        }


        .admin-student-icon {

            width: 40px;

            height: 40px;

        }


        .admin-student-permission span {

            display: none;

        }


        .admin-student-permission {

            width: 25px;

            height: 25px;

            justify-content: center;

            padding: 0;

        }


        .admin-student-info-value {

            font-size: .7rem;

        }

    }
</style>
