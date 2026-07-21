<x-app-layout>
    <div class="container py-4">

        {{-- <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Head of Departments</h2>

            <a href="{{ route('admin..create') }}" class="btn btn-primary">
                + Add HoD
            </a>
        </div> --}}

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">

                @if($students->count())
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Started Year</th>
                                    <th>Upload</th>
                                    <th width="180">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $student->full_name }}</td>

                                        <td>{{ $student->user->email }}</td>


                                        <td>
                                            {{ $student->department->name ?? 'N/A' }}
                                        </td>

                                        <td>{{ $student->started_year }}</td>

                                        <td>
                                            @if($student->upload_permission)
                                                <span class="badge bg-success">
                                                    Allowed
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    not allowed
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            {{-- <a href="{{ route('admin.hods.show', $hod->id) }}"
                                                class="btn btn-info btn-sm">
                                                View
                                            </a> --}}

                                            <a href="{{ route('admin.students.edit', $student->id) }}"
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
                        <h5>No Students found.</h5>
                    </div>
                @endif

            </div>
        </div>

    </div>
</x-app-layout>