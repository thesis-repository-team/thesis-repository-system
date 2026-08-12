<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('error'))
                <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-700 px-4 py-3">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Title</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Department</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Author</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Submitted By
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Published By
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Submission Date
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Abstract</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Description</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">PDF</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($thesisRequests as $thesisRequest)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-semibold text-gray-900">
                                    {{ $thesisRequest->title }}
                                </td>

                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $thesisRequest->department->name }}
                                </td>

                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $thesisRequest->author_name }}
                                </td>

                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $thesisRequest->user->username }}
                                </td>

                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $thesisRequest->thesis?->publishedBy?->name ?? 'N/A' }}
                                </td>

                                <td class="px-4 py-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $thesisRequest->submitted_at }}
                                </td>

                                <td class="px-4 py-3 text-sm text-gray-700 max-w-xs">
                                    <div class="line-clamp-3">
                                        {{ $thesisRequest->abstract }}
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-sm text-gray-700 max-w-xs">
                                    <div class="line-clamp-3">
                                        {{ $thesisRequest->description }}
                                    </div>
                                </td>
                                <td>
                                    @if ($thesisRequest->status == 'pending')
                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>
                                    @elseif($thesisRequest->status == 'approved')
                                        <span class="badge bg-success">
                                            Approved
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('admin.thesis_requests.show', $thesisRequest->id) }}"
                                        target="_blank"
                                        class="inline-flex items-center rounded-md bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700 hover:bg-gray-200">
                                        View Details
                                    </a>
                                    <a href="{{ route('admin.thesis_requests.view-request-pdf', $thesisRequest->id) }}"
                                        target="_blank"
                                        class="inline-flex items-center rounded-md bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700 hover:bg-gray-200">
                                        View PDF
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-8 text-center text-sm text-gray-500">
                                    No thesis upload requests found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
