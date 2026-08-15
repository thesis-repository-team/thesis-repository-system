<x-app-layout>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Header --}}
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Thesis Rejected
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Review the HoD feedback and resubmit your thesis.
                </p>
            </div>

            {{-- Error --}}
            @if (session('error'))
                <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Success --}}
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Rejected Message --}}
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <h3 class="font-semibold text-red-800">
                    Your thesis has been rejected
                </h3>

                <p class="text-sm text-red-700 mt-1">
                    Please review the feedback and make the necessary changes.
                </p>
            </div>

            {{-- HoD Feedback --}}
            <div class="bg-white border rounded-lg p-6 mb-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    HoD Feedback
                </h3>

                @if ($thesisRequest->remarks)
                    <div class="p-4 bg-red-50 text-gray-700 rounded-lg">
                        {{ $thesisRequest->remarks }}
                    </div>
                @else
                    <p class="text-gray-500">
                        No feedback was provided.
                    </p>
                @endif

            </div>

            {{-- Resubmit Form --}}
            <div class="bg-white border rounded-lg p-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-5">
                    Resubmit Thesis
                </h3>

                <form
                    action="{{ route(
                        'student.thesis_requests.resubmit',
                        $thesisRequest
                    ) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">
                            Thesis Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $thesisRequest->title) }}"
                            required
                            class="w-full border-gray-300 rounded-lg">

                        @error('title')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Author --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">
                            Author Name
                        </label>

                        <input
                            type="text"
                            name="author_name"
                            value="{{ old('author_name', $thesisRequest->author_name) }}"
                            required
                            class="w-full border-gray-300 rounded-lg">

                        @error('author_name')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Abstract --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">
                            Abstract
                        </label>

                        <textarea
                            name="abstract"
                            rows="5"
                            required
                            class="w-full border-gray-300 rounded-lg">{{ old('abstract', $thesisRequest->abstract) }}</textarea>

                        @error('abstract')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            required
                            class="w-full border-gray-300 rounded-lg">{{ old('description', $thesisRequest->description) }}</textarea>

                        @error('description')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- PDF --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2">
                            Corrected Thesis PDF
                        </label>

                        <input
                            type="file"
                            name="thesis_file"
                            accept=".pdf"
                            required
                            class="w-full border border-gray-300 rounded-lg p-2">

                        <p class="text-xs text-gray-500 mt-1">
                            PDF only, maximum 20MB.
                        </p>

                        @error('thesis_file')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-between">

                        <a
                            href="{{ route('student.thesis_requests.index') }}"
                            class="px-4 py-2 border rounded-lg text-gray-700">
                            Back
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Resubmit Thesis
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>