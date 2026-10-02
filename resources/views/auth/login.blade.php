<x-guest-layout>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="row g-0">
                <div class="col-md-5">
                    <div class="auth-left">
                        <img src="{{ asset('image/Small LU Logo.png') }}" alt="Life University Logo"
                            class="university-logo">
                        <h2 class="university-name-login">
                            A Digital Thesis Repository Platform in Life University
                        </h2>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="auth-right">
                        <div class="form-container">
                            <h2 class="form-title">
                                Login
                            </h2>

                            <p class="form-subtitle">
                                Welcome back! Please enter your details.
                            </p>

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

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <label for="email" class="form-label">
                                    Email Address
                                </label>

                                <div class="input-group-custom">
                                    <i class="bi bi-envelope input-icon"></i>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Enter your email" required autofocus
                                        autocomplete="username">
                                </div>

                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <div class="input-group-custom">
                                    <i class="bi bi-lock input-icon"></i>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter your password" required autocomplete="current-password">

                                    <button type="button" class="password-toggle" id="togglePassword"
                                        aria-label="Show password">
                                        <i class="bi bi-eye" id="passwordIcon"></i>
                                    </button>
                                </div>

                                <div class="remember-row">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="forgot-password">
                                            Forgot password?
                                        </a>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary btn-auth">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>
                                    Login
                                </button>
                            </form>

                            @if (Route::has('register'))
                                <div class="switch-text">
                                    Don't have an account?
                                    <a href="{{ route('register') }}" class="switch-btn">
                                        Register
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const passwordIcon = document.getElementById('passwordIcon');

        if (togglePassword && passwordInput && passwordIcon) {
            togglePassword.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordIcon.classList.replace('bi-eye', 'bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    passwordIcon.classList.replace('bi-eye-slash', 'bi-eye');
                }
            });
        }
    </script>
</x-guest-layout>
