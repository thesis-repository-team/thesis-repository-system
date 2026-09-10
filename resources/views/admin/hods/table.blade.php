{{-- =========================================================
    ADMIN HOD RESULTS
    CARD VIEW + TABLE VIEW
========================================================= --}}


{{-- =========================================================
    CARD VIEW
========================================================= --}}

<div class="hod-partial-card-results">

    @forelse ($hods as $hod)

        <div class="admin-student-card">

            <div class="admin-student-card-body">

                <div class="admin-student-card-top">

                    {{-- HOD INFORMATION --}}

                    <div class="admin-student-profile">

                        <div class="admin-student-icon">

                            <i class="bi bi-person-badge"></i>

                        </div>

                        <div class="admin-student-profile-info">

                            <h3 class="admin-student-card-title">
                                {{ $hod->full_name }}
                            </h3>

                            <span class="admin-student-id">
                                HoD #{{ $loop->iteration }}
                            </span>

                        </div>

                    </div>


                    {{-- HOD STATUS --}}

                    @if ($hod->is_active)

                        <span
                            class="admin-student-permission admin-student-permission-allowed"
                            title="HoD is Active">

                            <i class="bi bi-check-circle-fill"></i>

                            <span>
                                Active
                            </span>

                        </span>

                    @else

                        <span
                            class="admin-student-permission admin-student-permission-denied"
                            title="HoD is Inactive">

                            <i class="bi bi-x-circle-fill"></i>

                            <span>
                                Inactive
                            </span>

                        </span>

                    @endif

                </div>


                {{-- DIVIDER --}}

                <div class="admin-student-card-divider"></div>


                {{-- EMAIL --}}

                <div class="admin-student-info-row">

                    <div class="admin-student-info-icon">

                        <i class="bi bi-envelope"></i>

                    </div>

                    <div class="admin-student-info-content">

                        <span class="admin-student-info-label">
                            Email
                        </span>

                        <span
                            class="admin-student-info-value admin-student-email"
                            title="{{ $hod->user->email ?? 'N/A' }}">

                            {{ $hod->user->email ?? 'N/A' }}

                        </span>

                    </div>

                </div>


                {{-- DEPARTMENT --}}

                <div class="admin-student-info-row">

                    <div class="admin-student-info-icon">

                        <i class="bi bi-building"></i>

                    </div>

                    <div class="admin-student-info-content">

                        <span class="admin-student-info-label">
                            Department
                        </span>

                        <span class="admin-student-info-value">

                            {{ $hod->department->name ?? 'N/A' }}

                        </span>

                    </div>

                </div>


                {{-- STARTED YEAR --}}

                <div class="admin-student-info-row admin-student-year-row">

                    <div class="admin-student-info-icon">

                        <i class="bi bi-calendar3"></i>

                    </div>

                    <div class="admin-student-info-content">

                        <span class="admin-student-info-label">
                            Started Year
                        </span>

                        <span class="admin-student-year-badge">

                            {{ $hod->started_year ?? 'N/A' }}

                        </span>

                    </div>

                </div>


                {{-- CARD ACTION --}}

                <div class="admin-student-card-action">

                    <a
                        href="{{ route('admin.hods.edit', $hod->id) }}"
                        class="admin-student-edit-button"
                        data-tooltip="Edit HoD"
                        aria-label="Edit HoD">

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
                No HoD Records Found
            </h5>

            <p>
                There are no department leaders matching your filter criteria.
            </p>

        </div>

    @endforelse

</div>



{{-- =========================================================
    TABLE VIEW
========================================================= --}}

<div class="hod-partial-table-results">

    @if ($hods->count())

        <div class="hod-table-wrapper">

            <table class="hod-data-table">

                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            HoD
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Department
                        </th>

                        <th>
                            Started Year
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="hod-table-action-heading">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($hods as $hod)

                        <tr>

                            {{-- NUMBER --}}

                            <td class="hod-table-number">
                                {{ $loop->iteration }}
                            </td>


                            {{-- HOD --}}

                            <td>

                                <div class="hod-table-user">

                                    <div class="hod-table-user-info">

                                        <span class="hod-table-name">
                                            {{ $hod->full_name }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- EMAIL --}}

                            <td>

                                <span
                                    class="hod-table-email"
                                    title="{{ $hod->user->email ?? 'N/A' }}">

                                    {{ $hod->user->email ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- DEPARTMENT --}}

                            <td>

                                <span
                                    class="hod-table-department"
                                    title="{{ $hod->department->name ?? 'N/A' }}">

                                    {{ $hod->department->name ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- STARTED YEAR --}}

                            <td>

                                <span class="hod-table-year">
                                    {{ $hod->started_year ?? 'N/A' }}
                                </span>

                            </td>


                            {{-- STATUS --}}

                            <td>

                                @if ($hod->is_active)

                                    <span class="hod-table-status hod-table-status-active">

                                        <i class="bi bi-check-circle-fill"></i>

                                        Active

                                    </span>

                                @else

                                    <span class="hod-table-status hod-table-status-inactive">

                                        <i class="bi bi-x-circle-fill"></i>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- EDIT ACTION --}}

                            <td>

                                <div class="hod-table-actions">

                                    <a
                                        href="{{ route('admin.hods.edit', $hod->id) }}"
                                        class="hod-table-edit-button"
                                        data-tooltip="Edit HoD"
                                        aria-label="Edit HoD">

                                        <i class="bi bi-pencil-square"></i>

                                        <span>
                                            Edit
                                        </span>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="hod-table-empty">

            <div class="hod-table-empty-icon">

                <i class="bi bi-people"></i>

            </div>

            <h5>
                No HoD Records Found
            </h5>

            <p>
                There are no department leaders matching your filter criteria.
            </p>

        </div>

    @endif

</div>



<style>

/* =========================================================
   HOD COLOR SYSTEM
========================================================= */

.hod-partial-card-results,
.hod-partial-table-results {

    --hod-page-bg: #f0f2f5;
    --hod-card-bg: #ffffff;
    --hod-card-soft: #faf9ff;
    --hod-input-bg: #f8f7fc;

    --hod-text: #16121f;
    --hod-text-secondary: #514d5a;
    --hod-text-muted: #8a8792;

    --hod-border: #e4e1eb;
    --hod-border-soft: #e5e1ee;

    --hod-primary: #6538d9;
    --hod-primary-hover: #5630bd;

    --hod-primary-soft: #f0ebff;
    --hod-primary-soft-hover: #e8e0ff;

    --hod-white: #ffffff;
    --hod-black: #111111;

    --hod-success: #15803d;
    --hod-success-bg: #f0fdf4;
    --hod-success-border: #22c55e;

    --hod-danger: #dc2626;
    --hod-danger-bg: #fef2f2;
    --hod-danger-border: #ef4444;

    --hod-shadow:
        0 4px 18px rgba(35, 20, 65, .08);

    --hod-card-shadow:
        0 2px 10px rgba(35, 20, 65, .05);

}


/* =========================================================
   DARK MODE
========================================================= */

[data-bs-theme="dark"] .hod-partial-card-results,
[data-bs-theme="dark"] .hod-partial-table-results,
.dark .hod-partial-card-results,
.dark .hod-partial-table-results {

    --hod-page-bg: #101426;

    --hod-card-bg: #181d33;
    --hod-card-soft: #1c2138;
    --hod-input-bg: #20253a;

    --hod-text: #ffffff;
    --hod-text-secondary: #d5d8e8;
    --hod-text-muted: #999fb9;

    --hod-border: #292e45;
    --hod-border-soft: #292e45;

    --hod-primary: #7c5ce3;
    --hod-primary-hover: #9278ea;

    --hod-primary-soft: #292342;
    --hod-primary-soft-hover: #342c52;

    --hod-white: #ffffff;
    --hod-black: #000000;

    --hod-success: #4ade80;
    --hod-success-bg: #07140b;
    --hod-success-border: #22c55e;

    --hod-danger: #f87171;
    --hod-danger-bg: #1a0808;
    --hod-danger-border: #ef4444;

    --hod-shadow:
        0 8px 24px rgba(0, 0, 0, .35);

    --hod-card-shadow:
        0 2px 10px rgba(0, 0, 0, .30);

}


/* =========================================================
   CARD VIEW
========================================================= */

.hod-partial-card-results {

    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 1.25rem;

    width: 100%;

}


/* =========================================================
   TABLE VIEW
========================================================= */

.hod-partial-table-results {

    display: none;

    width: 100%;

    min-width: 0;

}


/* =========================================================
   HOD CARD
========================================================= */

.admin-student-card {

    position: relative;

    height: 100%;

    overflow: hidden;

    color: var(--hod-text);

    background: var(--hod-card-bg);

    border: 1px solid var(--hod-border);

    border-radius: 12px;

    box-shadow: var(--hod-card-shadow);

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        border-color .2s ease,
        background-color .2s ease;

}


.admin-student-card:hover {

    transform: translateY(-3px);

    border-color: rgba(101, 56, 217, .35);

    box-shadow:
        0 10px 28px rgba(101, 56, 217, .12);

}


/* =========================================================
   CARD BODY
========================================================= */

.admin-student-card-body {

    display: flex;

    flex-direction: column;

    min-height: 100%;

    padding: 1.25rem;

}


/* =========================================================
   TOP SECTION
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

    min-width: 0;

    gap: .75rem;

}


/* =========================================================
   AVATAR
========================================================= */

.admin-student-icon {

    display: flex;

    align-items: center;

    justify-content: center;

    width: 48px;

    height: 48px;

    flex: 0 0 48px;

    color: var(--hod-primary);

    background: var(--hod-primary-soft);

    border: 1px solid rgba(101, 56, 217, .16);

    border-radius: 50%;

    transition:
        background-color .2s ease,
        color .2s ease,
        transform .2s ease;

}


.admin-student-icon i {

    font-size: 1.2rem;

}


.admin-student-card:hover .admin-student-icon {

    color: var(--hod-white);

    background: var(--hod-primary);

    border-color: var(--hod-primary);

    transform: scale(1.04);

}


/* =========================================================
   PROFILE INFO
========================================================= */

.admin-student-profile-info {

    min-width: 0;

}


/* =========================================================
   NAME
========================================================= */

.admin-student-card-title {

    margin: 0 0 .2rem;

    overflow: hidden;

    color: var(--hod-text);

    font-size: .88rem;

    font-weight: 800;

    line-height: 1.3;

    text-overflow: ellipsis;

    white-space: nowrap;

    text-transform: uppercase;

}


/* =========================================================
   HOD ID
========================================================= */

.admin-student-id {

    display: block;

    color: var(--hod-text-muted);

    font-family: monospace;

    font-size: .68rem;

    letter-spacing: .02em;

}


/* =========================================================
   STATUS BADGE
========================================================= */

.admin-student-permission {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

    gap: .35rem;

    min-height: 28px;

    padding: .35rem .6rem;

    border: 1px solid;

    border-radius: 20px;

    font-family: monospace;

    font-size: .61rem;

    font-weight: 800;

    line-height: 1;

    text-transform: uppercase;

    white-space: nowrap;

}


.admin-student-permission-allowed {

    color: var(--hod-success);

    background: var(--hod-success-bg);

    border-color: var(--hod-success-border);

}


.admin-student-permission-allowed:hover {

    color: #ffffff;

    background: var(--hod-success);

}


.admin-student-permission-denied {

    color: var(--hod-danger);

    background: var(--hod-danger-bg);

    border-color: var(--hod-danger-border);

}


.admin-student-permission-denied:hover {

    color: #ffffff;

    background: var(--hod-danger);

}


/* =========================================================
   DIVIDER
========================================================= */

.admin-student-card-divider {

    width: 100%;

    height: 1px;

    margin: 1rem 0;

    background: var(--hod-border);

}


/* =========================================================
   INFORMATION ROW
========================================================= */

.admin-student-info-row {

    display: flex;

    align-items: center;

    gap: .8rem;

    min-width: 0;

    margin-bottom: 1rem;

}


.admin-student-year-row {

    margin-bottom: 1.25rem;

}


/* =========================================================
   INFORMATION ICON
========================================================= */

.admin-student-info-icon {

    display: flex;

    align-items: center;

    justify-content: center;

    width: 36px;

    height: 36px;

    flex: 0 0 36px;

    color: var(--hod-primary);

    background: var(--hod-primary-soft);

    border: 1px solid rgba(101, 56, 217, .15);

    border-radius: 8px;

}


.admin-student-info-icon i {

    font-size: .88rem;

}


/* =========================================================
   INFORMATION CONTENT
========================================================= */

.admin-student-info-content {

    display: flex;

    flex-direction: column;

    min-width: 0;

    gap: .18rem;

}


.admin-student-info-label {

    color: var(--hod-text-muted);

    font-size: .61rem;

    font-weight: 800;

    letter-spacing: .06em;

    line-height: 1.2;

    text-transform: uppercase;

}


.admin-student-info-value {

    display: block;

    overflow: hidden;

    color: var(--hod-text);

    font-size: .76rem;

    font-weight: 600;

    line-height: 1.4;

    text-overflow: ellipsis;

    white-space: nowrap;

}


/* =========================================================
   EMAIL
========================================================= */

.admin-student-email {

    max-width: 220px;

}


/* =========================================================
   YEAR BADGE
========================================================= */

.admin-student-year-badge {

    display: inline-flex;

    align-items: center;

    width: fit-content;

    padding: .3rem .55rem;

    color: var(--hod-primary);

    background: var(--hod-primary-soft);

    border: 1px solid rgba(101, 56, 217, .18);

    border-radius: 6px;

    font-family: monospace;

    font-size: .7rem;

    font-weight: 800;

    line-height: 1;

}


/* =========================================================
   CARD ACTION
========================================================= */

.admin-student-card-action {

    display: flex;

    justify-content: flex-end;

    margin-top: auto;

    padding-top: 1rem;

    border-top: 1px solid var(--hod-border);

}


/* =========================================================
   CARD EDIT BUTTON
   BLUE/PURPLE BORDER
   TRANSPARENT NORMAL
========================================================= */

.admin-student-edit-button {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: .4rem;

    min-width: 86px;

    min-height: 36px;

    padding: .45rem .8rem;

    color: var(--hod-primary);

    background: transparent;

    border: 1px solid var(--hod-primary);

    border-radius: 7px;

    font-size: .68rem;

    font-weight: 800;

    line-height: 1;

    text-decoration: none;

    text-transform: uppercase;

    transition:
        background-color .2s ease,
        color .2s ease,
        border-color .2s ease,
        transform .2s ease,
        box-shadow .2s ease;

}


/* =========================================================
   CARD EDIT BUTTON HOVER
   WHITE BACKGROUND
========================================================= */

.admin-student-edit-button:hover {

    color: var(--hod-primary);

    background: #ffffff;

    border-color: var(--hod-primary);

    transform: translateY(-1px);

    box-shadow:
        0 5px 14px rgba(101, 56, 217, .16);

}


/* =========================================================
   CARD EDIT BUTTON ICON
========================================================= */

.admin-student-edit-button i {

    color: inherit;

    font-size: .75rem;

}


/* =========================================================
   EMPTY CARD
========================================================= */

.admin-student-empty-result {

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    min-height: 280px;

    grid-column: 1 / -1;

    padding: 2.5rem 1rem;

    text-align: center;

    color: var(--hod-text);

    background: var(--hod-card-bg);

    border: 1px solid var(--hod-border);

    border-radius: 12px;

    box-shadow: var(--hod-card-shadow);

}


.admin-student-empty-result-icon {

    display: flex;

    align-items: center;

    justify-content: center;

    width: 64px;

    height: 64px;

    margin-bottom: 1rem;

    color: var(--hod-primary);

    background: var(--hod-primary-soft);

    border: 1px solid rgba(101, 56, 217, .18);

    border-radius: 50%;

}


.admin-student-empty-result-icon i {

    font-size: 1.5rem;

}


.admin-student-empty-result h5 {

    margin: 0 0 .4rem;

    color: var(--hod-text);

    font-size: .85rem;

    font-weight: 800;

    text-transform: uppercase;

}


.admin-student-empty-result p {

    margin: 0;

    color: var(--hod-text-muted);

    font-size: .74rem;

}


/* =========================================================
   TABLE WRAPPER
========================================================= */

.hod-table-wrapper {

    width: 100%;

    max-width: 100%;

    overflow: hidden;

    box-sizing: border-box;

    background: var(--hod-card-bg);

    border: 1px solid var(--hod-border);

    border-radius: 12px;

    box-shadow: var(--hod-card-shadow);

}


/* =========================================================
   TABLE
========================================================= */

.hod-data-table {

    width: 100%;

    max-width: 100%;

    min-width: 0;

    table-layout: fixed;

    border-collapse: collapse;

    border-spacing: 0;

    color: var(--hod-text);

    background: var(--hod-card-bg);

    font-size: .72rem;

}


/* =========================================================
   TABLE HEADER
========================================================= */

.hod-data-table thead th {

    padding: .85rem .6rem;

    color: var(--hod-text-secondary);

    background: var(--hod-input-bg);

    border-bottom: 1px solid var(--hod-border);

    font-size: .63rem;

    font-weight: 800;

    letter-spacing: .05em;

    line-height: 1.25;

    text-align: left;

    text-transform: uppercase;

    white-space: normal;

    overflow-wrap: anywhere;

}


/* =========================================================
   TABLE CELLS
========================================================= */

.hod-data-table tbody td {

    padding: .85rem .6rem;

    color: var(--hod-text);

    background: var(--hod-card-bg);

    border-bottom: 1px solid var(--hod-border);

    vertical-align: middle;

    overflow: hidden;

    overflow-wrap: anywhere;

    word-break: break-word;

    line-height: 1.4;

}


.hod-data-table tbody tr:last-child td {

    border-bottom: 0;

}


.hod-data-table tbody tr {

    transition:
        background-color .2s ease;

}


.hod-data-table tbody tr:hover td {

    background: var(--hod-primary-soft);

}


/* =========================================================
   COLUMN WIDTHS
========================================================= */

.hod-data-table th:nth-child(1),
.hod-data-table td:nth-child(1) {
    width: 5%;
}


.hod-data-table th:nth-child(2),
.hod-data-table td:nth-child(2) {
    width: 21%;
}


.hod-data-table th:nth-child(3),
.hod-data-table td:nth-child(3) {
    width: 19%;
}


.hod-data-table th:nth-child(4),
.hod-data-table td:nth-child(4) {
    width: 17%;
}


.hod-data-table th:nth-child(5),
.hod-data-table td:nth-child(5) {
    width: 10%;
}


.hod-data-table th:nth-child(6),
.hod-data-table td:nth-child(6) {
    width: 12%;
}


.hod-data-table th:nth-child(7),
.hod-data-table td:nth-child(7) {
    width: 16%;
}


/* =========================================================
   NUMBER
========================================================= */

.hod-table-number {

    color: var(--hod-text-muted) !important;

    font-family: monospace;

    font-size: .68rem;

    font-weight: 700;

    text-align: center;

}


/* =========================================================
   HOD USER
========================================================= */

.hod-table-user {

    display: flex;

    align-items: center;

    gap: .55rem;

    min-width: 0;

}


/* =========================================================
   USER INFO
========================================================= */

.hod-table-user-info {

    display: flex;

    flex-direction: column;

    min-width: 0;

    gap: .12rem;

}


/* =========================================================
   NAME
========================================================= */

.hod-table-name {

    display: block;

    max-width: 100%;

    overflow: hidden;

    color: var(--hod-text);

    font-size: .72rem;

    font-weight: 800;

    line-height: 1.3;

    overflow-wrap: anywhere;

    word-break: break-word;

    text-overflow: ellipsis;

    white-space: normal;

    text-transform: uppercase;

}


/* =========================================================
   EMAIL
========================================================= */

.hod-table-email {

    display: block;

    max-width: 100%;

    overflow: hidden;

    color: var(--hod-text-secondary);

    font-size: .68rem;

    line-height: 1.35;

    overflow-wrap: anywhere;

    word-break: break-word;

    white-space: normal;

}


/* =========================================================
   DEPARTMENT
========================================================= */

.hod-table-department {

    display: block;

    max-width: 100%;

    overflow: hidden;

    color: var(--hod-text-secondary);

    font-size: .68rem;

    font-weight: 600;

    line-height: 1.35;

    overflow-wrap: anywhere;

    word-break: break-word;

    white-space: normal;

}


/* =========================================================
   YEAR
========================================================= */

.hod-table-year {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-width: 48px;

    padding: .3rem .45rem;

    color: var(--hod-primary);

    background: var(--hod-primary-soft);

    border: 1px solid rgba(101, 56, 217, .18);

    border-radius: 6px;

    font-family: monospace;

    font-size: .64rem;

    font-weight: 800;

}


/* =========================================================
   STATUS
========================================================= */

.hod-table-status {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: .3rem;

    padding: .3rem .45rem;

    border: 1px solid;

    border-radius: 20px;

    font-family: monospace;

    font-size: .56rem;

    font-weight: 800;

    line-height: 1;

    text-transform: uppercase;

    white-space: nowrap;

}


.hod-table-status-active {

    color: var(--hod-success);

    background: var(--hod-success-bg);

    border-color: var(--hod-success-border);

}


.hod-table-status-inactive {

    color: var(--hod-danger);

    background: var(--hod-danger-bg);

    border-color: var(--hod-danger-border);

}


/* =========================================================
   ACTION HEADING
========================================================= */

.hod-table-action-heading {

    text-align: right !important;

}


/* =========================================================
   ACTION AREA
========================================================= */

.hod-table-actions {

    display: flex;

    align-items: center;

    justify-content: flex-end;

}


/* =========================================================
   TABLE EDIT BUTTON
   BLUE/PURPLE BORDER
========================================================= */

.hod-table-edit-button {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: .35rem;

    min-width: 70px;

    min-height: 32px;

    padding: .4rem .6rem;

    color: var(--hod-primary);

    background: transparent;

    border: 1px solid var(--hod-primary);

    border-radius: 7px;

    text-decoration: none;

    font-size: .6rem;

    font-weight: 800;

    line-height: 1;

    text-transform: uppercase;

    transition:
        background-color .2s ease,
        color .2s ease,
        border-color .2s ease,
        transform .2s ease,
        box-shadow .2s ease;

}


/* =========================================================
   TABLE EDIT BUTTON HOVER
   WHITE BACKGROUND
========================================================= */

.hod-table-edit-button:hover {

    color: var(--hod-primary);

    background: #ffffff;

    border-color: var(--hod-primary);

    transform: translateY(-1px);

    box-shadow:
        0 5px 14px rgba(101, 56, 217, .16);

}


/* =========================================================
   TABLE EDIT ICON
========================================================= */

.hod-table-edit-button i {

    color: inherit;

    font-size: .7rem;

}


/* =========================================================
   TABLE EMPTY
========================================================= */

.hod-table-empty {

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    min-height: 280px;

    padding: 2.5rem 1rem;

    color: var(--hod-text);

    background: var(--hod-card-bg);

    border: 1px solid var(--hod-border);

    border-radius: 12px;

    text-align: center;

    box-shadow: var(--hod-card-shadow);

}


.hod-table-empty-icon {

    display: flex;

    align-items: center;

    justify-content: center;

    width: 60px;

    height: 60px;

    margin-bottom: 1rem;

    color: var(--hod-primary);

    background: var(--hod-primary-soft);

    border: 1px solid rgba(101, 56, 217, .18);

    border-radius: 50%;

}


.hod-table-empty-icon i {

    font-size: 1.4rem;

}


.hod-table-empty h5 {

    margin: 0 0 .4rem;

    color: var(--hod-text);

    font-size: .82rem;

    font-weight: 800;

    text-transform: uppercase;

}


.hod-table-empty p {

    margin: 0;

    color: var(--hod-text-muted);

    font-size: .72rem;

}


/* =========================================================
   DARK MODE TABLE
========================================================= */

[data-bs-theme="dark"] .hod-table-wrapper,
.dark .hod-table-wrapper {

    background: #181d33;

    border-color: #292e45;

}


[data-bs-theme="dark"] .hod-data-table,
.dark .hod-data-table {

    background: #181d33;

    color: #ffffff;

}


[data-bs-theme="dark"] .hod-data-table thead th,
.dark .hod-data-table thead th {

    color: #d5d8e8;

    background: #20253a;

    border-color: #292e45;

}


[data-bs-theme="dark"] .hod-data-table tbody td,
.dark .hod-data-table tbody td {

    color: #ffffff;

    background: #181d33;

    border-color: #292e45;

}


[data-bs-theme="dark"] .hod-data-table tbody tr:hover td,
.dark .hod-data-table tbody tr:hover td {

    background: #292342;

}


[data-bs-theme="dark"] .hod-table-name,
.dark .hod-table-name {

    color: #ffffff;

}


[data-bs-theme="dark"] .hod-table-email,
[data-bs-theme="dark"] .hod-table-department,
.dark .hod-table-email,
.dark .hod-table-department {

    color: #d5d8e8;

}


[data-bs-theme="dark"] .hod-table-year,
.dark .hod-table-year {

    color: #a98ff0;

    background: #292342;

    border-color: #4c3c75;

}


/* =========================================================
   DARK MODE EDIT BUTTON
   NORMAL = BLUE/PURPLE BORDER
   HOVER = WHITE
========================================================= */

[data-bs-theme="dark"] .admin-student-edit-button,
.dark .admin-student-edit-button {

    color: #a98ff0;

    background: transparent;

    border-color: #7c5ce3;

}


[data-bs-theme="dark"] .admin-student-edit-button:hover,
.dark .admin-student-edit-button:hover {

    color: #7c5ce3;

    background: #ffffff;

    border-color: #7c5ce3;

    box-shadow:
        0 5px 14px rgba(124, 92, 227, .25);

}


[data-bs-theme="dark"] .hod-table-edit-button,
.dark .hod-table-edit-button {

    color: #a98ff0;

    background: transparent;

    border-color: #7c5ce3;

}


[data-bs-theme="dark"] .hod-table-edit-button:hover,
.dark .hod-table-edit-button:hover {

    color: #7c5ce3;

    background: #ffffff;

    border-color: #7c5ce3;

    box-shadow:
        0 5px 14px rgba(124, 92, 227, .25);

}


/* =========================================================
   CARD TABLET
========================================================= */

@media (max-width: 1250px) {

    .hod-partial-card-results {

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

    }

}


/* =========================================================
   CARD SMALL TABLET
========================================================= */

@media (max-width: 950px) {

    .hod-partial-card-results {

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

    }

}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 900px) {

    .hod-data-table {

        font-size: .65rem;

    }


    .hod-data-table thead th {

        padding: .65rem .45rem;

        font-size: .56rem;

    }


    .hod-data-table tbody td {

        padding: .65rem .45rem;

        font-size: .62rem;

    }


    .hod-table-user {

        gap: .4rem;

    }


    .hod-table-name {

        font-size: .63rem;

    }


    .hod-table-email,
    .hod-table-department {

        font-size: .59rem;

    }


    .hod-table-year {

        min-width: 44px;

        padding: .25rem .3rem;

        font-size: .57rem;

    }


    .hod-table-status {

        gap: .2rem;

        padding: .27rem .3rem;

        font-size: .51rem;

    }


    .hod-table-status i {

        font-size: .5rem;

    }


    .hod-table-edit-button {

        min-width: 62px;

        min-height: 30px;

        padding: .35rem .45rem;

        font-size: .55rem;

    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767.98px) {

    .hod-partial-card-results {

        grid-template-columns:
            minmax(0, 1fr);

        gap: 1rem;

    }


    .admin-student-card {

        border-radius: 10px;

    }


    .admin-student-card-body {

        padding: 1rem;

    }


    .admin-student-card-title {

        font-size: .84rem;

    }


    .admin-student-icon {

        width: 44px;

        height: 44px;

        flex-basis: 44px;

    }


    .admin-student-permission {

        min-height: 25px;

        padding: .25rem .45rem;

        font-size: .56rem;

    }


    .admin-student-info-value {

        font-size: .74rem;

    }


    .admin-student-email {

        max-width:
            calc(100vw - 120px);

    }


    /* TABLE */

    .hod-table-wrapper {

        border-radius: 8px;

    }


    .hod-data-table {

        width: 100%;

        min-width: 0;

        table-layout: fixed;

    }


    .hod-data-table thead th {

        padding: .5rem .25rem;

        font-size: .47rem;

        letter-spacing: .02em;

    }


    .hod-data-table tbody td {

        padding: .5rem .25rem;

        font-size: .52rem;

    }


    .hod-table-user {

        gap: .25rem;

    }


    .hod-table-name {

        font-size: .53rem;

    }


    .hod-table-email,
    .hod-table-department {

        font-size: .5rem;

    }


    .hod-table-year {

        min-width: 38px;

        padding: .22rem .25rem;

        font-size: .49rem;

    }


    .hod-table-status {

        gap: .15rem;

        padding: .23rem .25rem;

        font-size: .45rem;

    }


    .hod-table-status i {

        font-size: .43rem;

    }


    /* TABLE EDIT ICON ONLY */

    .hod-table-edit-button {

        width: 29px;

        min-width: 29px;

        height: 29px;

        min-height: 29px;

        padding: 0;

    }


    .hod-table-edit-button span {

        display: none;

    }


    .hod-table-edit-button i {

        margin: 0;

        font-size: .62rem;

    }


    .hod-table-number {

        font-size: .52rem;

    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 575.98px) {

    .admin-student-card-body {

        padding: .9rem;

    }


    .admin-student-card-top {

        gap: .5rem;

    }


    .admin-student-profile {

        gap: .6rem;

    }


    .admin-student-icon {

        width: 42px;

        height: 42px;

        flex-basis: 42px;

    }


    .admin-student-icon i {

        font-size: 1.05rem;

    }


    .admin-student-card-title {

        max-width: 170px;

        font-size: .78rem;

    }


    .admin-student-id {

        font-size: .62rem;

    }


    /* STATUS ICON ONLY */

    .admin-student-permission {

        width: 30px;

        height: 30px;

        min-height: 30px;

        padding: 0;

        border-radius: 50%;

    }


    .admin-student-permission span {

        display: none;

    }


    .admin-student-permission i {

        margin: 0;

        font-size: .75rem;

    }


    /* INFORMATION */

    .admin-student-info-row {

        gap: .65rem;

        margin-bottom: .85rem;

    }


    .admin-student-info-icon {

        width: 34px;

        height: 34px;

        flex-basis: 34px;

    }


    .admin-student-info-label {

        font-size: .58rem;

    }


    .admin-student-info-value {

        font-size: .7rem;

    }


    .admin-student-email {

        max-width:
            calc(100vw - 115px);

    }


    .admin-student-year-row {

        margin-bottom: 1rem;

    }


    /* CARD ACTION */

    .admin-student-card-action {

        padding-top: .8rem;

    }


    /* CARD EDIT ICON ONLY */

    .admin-student-edit-button {

        width: 38px;

        min-width: 38px;

        height: 36px;

        min-height: 36px;

        padding: 0;

    }


    .admin-student-edit-button span {

        display: none;

    }


    .admin-student-edit-button i {

        margin: 0;

        font-size: .8rem;

    }


    /* EMPTY */

    .admin-student-empty-result {

        min-height: 230px;

        padding: 2rem 1rem;

    }

}


/* =========================================================
   VERY SMALL MOBILE
========================================================= */

@media (max-width: 380px) {

    .admin-student-card-title {

        max-width: 135px;

    }


    .admin-student-permission {

        width: 28px;

        height: 28px;

        min-height: 28px;

    }


    .admin-student-info-value {

        max-width: 190px;

    }

}


/* =========================================================
   REDUCED MOTION
========================================================= */

@media (prefers-reduced-motion: reduce) {

    .admin-student-card,
    .admin-student-icon,
    .admin-student-edit-button,
    .admin-student-permission,
    .hod-table-edit-button {

        transition: none !important;

    }

}

</style>