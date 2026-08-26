<x-guest-layout>

    <div class="auth-wrapper">

        <div class="auth-card">

            <div class="row g-0">

                {{-- =====================================================
                     LEFT BRANDING
                     ===================================================== --}}

                <div class="col-md-5">

                    <div class="auth-left">

                        <img src="{{ asset('image/Small LU Logo.png') }}" alt="Life University Logo"
                            class="university-logo">

                        <h2 class="university-name-login">
                           A Digital Thesis Repository Platform in Life University
                        </h2>

                    </div>

                </div>


                {{-- =====================================================
                     RIGHT FORM
                     ===================================================== --}}

                <div class="col-md-7">

                    <div class="auth-right">

                        <div class="form-container">

                            <h2 class="form-title">
                                Reset Password
                            </h2>

                            <p class="form-subtitle">
                                Enter your email address and we will
                                send you a password reset link.
                            </p>


                            {{-- =================================================
                                 SESSION STATUS
                                 ================================================= --}}

                            @if (session('status'))
                                <div class="alert alert-success">

                                    <i class="bi bi-check-circle me-1"></i>

                                    {{ session('status') }}

                                </div>
                            @endif


                            {{-- =================================================
                                 VALIDATION ERRORS
                                 ================================================= --}}

                            @if ($errors->any())

                                <div class="alert alert-danger">

                                    <ul class="mb-0">

                                        @foreach ($errors->all() as $error)
                                            <li>
                                                {{ $error }}
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>

                            @endif


                            {{-- =================================================
                                 RESET EMAIL FORM
                                 ================================================= --}}

                            <form method="POST" action="{{ route('password.email') }}">

                                @csrf


                                {{-- EMAIL --}}

                                <label for="email" class="form-label">
                                    Email Address
                                </label>


                                <div class="input-group-custom">

                                    <i class="bi bi-envelope input-icon"></i>


                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Enter your email" required autofocus
                                        autocomplete="email">

                                </div>


                                @error('email')
                                    <div class="text-danger small mb-3">
                                        {{ $message }}
                                    </div>
                                @enderror


                                {{-- BUTTON --}}

                                <button type="submit" class="btn btn-primary btn-auth">

                                    <i class="bi bi-envelope-arrow-up me-1"></i>

                                    Email Password Reset Link

                                </button>

                            </form>


                            {{-- =================================================
                                 BACK TO LOGIN
                                 ================================================= --}}

                            <div class="switch-text">

                                Remember your password?

                                <a href="{{ route('login') }}" class="switch-btn">
                                    Back to Login
                                </a>

                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>
