<div class="thesis-partial-card-results">
    @forelse ($theses as $thesis)
        @php
            $publishedBy = $thesis->publishedBy;
            $isApprovedByAdminOrHod =
                $thesis->published_at && $publishedBy && in_array($publishedBy->role, ['admin', 'hod'], true);
            $publishedByName = optional($publishedBy)->username ?? (optional($publishedBy)->full_name ?? '—');
        @endphp
        @if ($isApprovedByAdminOrHod)
            <div class="admin-thesis-card">
                <div class="admin-thesis-card-top">
                    <div class="admin-thesis-card-heading">
                        <div class="admin-thesis-icon">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <h3 class="admin-thesis-card-title">
                            {{ $thesis->title }}
                        </h3>
                        <a href="{{ route('admin.thesis.edit', $thesis->id) }}" class="admin-thesis-edit"
                            title="Edit Thesis" aria-label="Edit Thesis">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </div>
                </div>
                <div class="admin-thesis-published">
                    <div class="admin-thesis-published-item">
                        <div class="admin-thesis-published-icon">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div class="admin-thesis-published-content">
                            <span class="admin-thesis-published-label">
                                Approved By
                            </span>
                            <span class="admin-thesis-published-value">
                                {{ $publishedByName }}
                            </span>
                        </div>
                    </div>
                    <div class="admin-thesis-published-item">
                        <div class="admin-thesis-published-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="admin-thesis-published-content">
                            <span class="admin-thesis-published-label">
                                Approved At
                            </span>
                            <span class="admin-thesis-published-value">
                                {{ $thesis->published_at ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y') : '—' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="admin-thesis-card-body">
                    <div class="admin-thesis-detail">
                        <div class="admin-thesis-detail-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="admin-thesis-detail-content">
                            <span class="admin-thesis-detail-label">
                                Author
                            </span>
                            <span class="admin-thesis-detail-value">
                                {{ $thesis->author_name ?? '—' }}
                            </span>
                        </div>
                    </div>
                    <div class="admin-thesis-detail">
                        <div class="admin-thesis-detail-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="admin-thesis-detail-content">
                            <span class="admin-thesis-detail-label">
                                Department
                            </span>
                            <span class="admin-thesis-detail-value">
                                {{ optional($thesis->department)->name ?? '—' }}
                            </span>
                        </div>
                    </div>
                    <div class="admin-thesis-detail">
                        <div class="admin-thesis-detail-icon">
                            <i class="bi bi-calendar3"></i>
                        </div>
                        <div class="admin-thesis-detail-content">
                            <span class="admin-thesis-detail-label">
                                Academic Year
                            </span>
                            <span class="admin-thesis-detail-value">
                                {{ $thesis->academic_year ?? '—' }}
                            </span>
                        </div>
                    </div>
                    <div class="admin-thesis-submitted">
                        <span class="admin-thesis-submitted-label">
                            Submitted By
                        </span>
                        <span class="admin-thesis-submitted-value">
                            {{ optional($thesis->submittedBy)->username ?? (optional($thesis->submittedBy)->full_name ?? '—') }}
                        </span>
                    </div>
                </div>
                <div class="admin-thesis-card-footer">
                    <a href="{{ route('admin.thesis.show', $thesis->id) }}"
                        class="admin-thesis-action admin-thesis-view">
                        <i class="bi bi-file-text"></i>
                        <span>View Detail</span>
                    </a>
                    @if ($thesis->files && $thesis->files->count())
                        @php
                            $file = $thesis->files->first();
                        @endphp
                        <a href="{{ route('admin.thesis.view-pdf', $file->id) }}" target="_blank"
                            class="admin-thesis-action admin-thesis-pdf">
                            <i class="bi bi-file-earmark-pdf"></i>
                            <span>PDF</span>
                        </a>
                    @else
                        <span class="admin-thesis-action admin-thesis-download disabled">
                            <i class="bi bi-file-earmark-pdf"></i>
                            <span>No File</span>
                        </span>
                    @endif
                </div>
            </div>
        @endif
    @empty
        <div class="admin-thesis-empty">
            <div class="admin-thesis-empty-icon">
                <i class="bi bi-journal-x"></i>
            </div>
            <h3>No Thesis Found</h3>
            <p>There are no approved thesis records matching your search or filters.</p>
        </div>
    @endforelse
</div>
<div class="thesis-partial-table-results">
    <div class="thesis-table-wrapper">
        <table class="thesis-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Thesis</th>
                    <th>Author</th>
                    <th>Department</th>
                    <th>Academic Year</th>
                    <th>Submitted By</th>
                    <th>Approved By</th>
                    <th>Approved At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($theses as $thesis)
                    @php
                        $publishedBy = $thesis->publishedBy;
                        $isApprovedByAdminOrHod =
                            $thesis->published_at &&
                            $publishedBy &&
                            in_array($publishedBy->role, ['admin', 'hod'], true);
                        $publishedByName =
                            optional($publishedBy)->username ?? (optional($publishedBy)->full_name ?? '—');
                    @endphp
                    @if ($isApprovedByAdminOrHod)
                        <tr>
                            <td class="thesis-table-number">
                                {{ $loop->iteration }}
                            </td>
                            <td class="thesis-table-title-cell">
                                <span class="thesis-table-title-text">{{ $thesis->title }}</span>
                            </td>
                            <td>
                                {{ $thesis->author_name ?? '—' }}
                            </td>
                            <td>
                                {{ optional($thesis->department)->name ?? '—' }}
                            </td>
                            <td>
                                {{ $thesis->academic_year ?? '—' }}
                            </td>
                            <td>
                                {{ optional($thesis->submittedBy)->username ?? (optional($thesis->submittedBy)->full_name ?? '—') }}
                            </td>
                            <td>
                                {{ $publishedByName }}</td>
                            <td>
                                {{ $thesis->published_at ? \Carbon\Carbon::parse($thesis->published_at)->format('M d, Y') : '—' }}
                            </td>
                            <td>
                                <div class="thesis-table-actions">
                                    <a href="{{ route('admin.thesis.show', $thesis->id) }}"
                                        class="thesis-table-action admin-thesis-view" title="View Thesis"
                                        aria-label="View Thesis">
                                        <i class="bi bi-file-text"></i>
                                    </a>
                                    @if ($thesis->files && $thesis->files->count())
                                        @php
                                            $file = $thesis->files->first();
                                        @endphp
                                        <a href="{{ route('admin.thesis.view-pdf', $file->id) }}" target="_blank"
                                            class="thesis-table-action admin-thesis-pdf" title="View PDF"
                                            aria-label="View PDF">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </a>
                                    @else
                                        <span class="thesis-table-action thesis-table-download disabled" title="No File"
                                            aria-label="No File">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </span>
                                    @endif
                                    <a href="{{ route('admin.thesis.edit', $thesis->id) }}"
                                        class="thesis-table-action admin-thesis-edit" title="Edit Thesis"
                                        aria-label="Edit Thesis">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="9" class="thesis-table-empty">
                            <strong>No Thesis Found</strong>
                            <span>
                                There are no approved thesis records matching your search or filters.
                            </span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
