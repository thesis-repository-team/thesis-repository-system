<x-app-layout>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Head of Departments</h2>
            <a href="{{ route('admin.hods.create') }}" class="btn btn-primary">
                + Add HoD
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                @if ($hods->count())
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

                            <tbody>
                                @foreach ($hods as $hod)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $hod->full_name }}</td>
                                        <td>{{ $hod->user->email }}</td>
                                        <td>
                                            {{ $hod->department->name ?? 'N/A' }}
                                        </td>
                                        <td>{{ $hod->started_year }}</td>
                                        <td>
                                            @if ($hod->is_active)
                                                <span class="badge bg-success">
                                                    Active
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('admin.hods.show', $hod->id) }}"
                                                class="btn btn-info btn-sm">
                                                View
                                            </a> --}}

                                            <a href="{{ route('admin.hods.edit', $hod->id) }}"
                                                class="btn btn-warning btn-sm">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <h5>No Head of Department found.</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
