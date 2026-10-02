<x-guest-layout>
    <div class="w-full max-w-md mx-auto">
        <!-- Header -->
        <div class="text-center mb-6" style="margin-top: 40px;">
            <img src="{{ asset('image/Small LU Logo.png') }}" alt="Life University Logo" class="w-20 h-20 mx-auto mb-3">
            <h1 class="text-2xl font-bold text-gray-900">Reset Password</h1>
            <p class="text-sm text-gray-500 mt-1">
                Create a new password for your account.
            </p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="mb-2" />
                    <x-text-input
                        id="email"
                        class="w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                        type="email"
                        name="email"
                        :value="old('email', $request->email)"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('New Password')" class="mb-2" />
                    <x-text-input
                        id="password"
                        class="w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="mb-2" />
                    <x-text-input
                        id="password_confirmation"
                        class="w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-3 rounded-lg transition duration-200"
                >
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>