<x-guest-layout>

    <div class="auth-wrapper">

        <div class="auth-card">

            <div class="row g-0">


                <!-- =================================================
                     LEFT BRANDING
                     ================================================= -->

                <div class="col-md-5">

                    <div class="auth-left">

                        <img src="{{ asset('image/Small LU Logo.png') }}" alt="Life University Logo"
                            class="university-logo-register">

                        <div class="auth-brand-content">

                            <h2 class="university-name-register">
                                A Digital Thesis Repository Platform in Life University
                            </h2>

                            <h3 class="paragrah">
                                A thesis repository that store thesis in life university
                                <br> A thesis repository that easy manage for admin and hod <br> It is easy for student
                                to search
                            </h3>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     RIGHT REGISTER FORM
                     ================================================= -->

                <div class="col-md-7">

                    <div class="auth-right">

                        <div class="form-container">

                            <h2 class="form-title">
                                Create Account
                            </h2>

                            <p class="form-subtitle">
                                Please fill in your information to register.
                            </p>


                            <!-- =================================================
                                 SUCCESS MESSAGE
                                 ================================================= -->

                            @if (session('success'))
                                <div class="alert alert-success">

                                    {{ session('success') }}

                                </div>
                            @endif


                            <!-- =================================================
                                 ERROR MESSAGE
                                 ================================================= -->

                            @if ($errors->any())

                                <div class="alert alert-danger alert-message">

                                    <ul class="mb-0">

                                        @foreach ($errors->all() as $error)
                                            <li>
                                                {{ $error }}
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>

                            @endif


                            <!-- =================================================
                                 REGISTER FORM
                                 ================================================= -->

                            <form method="POST" action="{{ route('register') }}">

                                @csrf
                                <div class="row g-3">
                                    <!-- =================================================
                                         FULL NAME
                                         ================================================= -->
                                    <div class="col-md-6">
                                        <label for="full_name" class="form-label">
                                            Full Name
                                        </label>
                                        <div class="input-group-custom">

                                            <i class="bi bi-person input-icon"></i>

                                            <input type="text" class="form-control" id="full_name" name="full_name"
                                                value="{{ old('full_name') }}" placeholder="Enter your full name"
                                                required autofocus>
                                        </div>

                                        @error('full_name')
                                            <div class="text-danger small mb-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- =================================================
                                         USERNAME
                                         ================================================= -->

                                    <div class="col-md-6">
                                        <label for="username" class="form-label">
                                            Username
                                        </label>

                                        <div class="input-group-custom">

                                            <i class="bi bi-person-badge input-icon"></i>

                                            <input type="text" class="form-control" id="username" name="username"
                                                value="{{ old('username') }}" placeholder="Enter your username"
                                                required>

                                        </div>

                                        @error('username')
                                            <div class="text-danger small mb-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- =================================================
                                     EMAIL
                                     ================================================= -->

                                <label for="email" class="form-label">
                                    Email Address
                                </label>

                                <div class="input-group-custom">

                                    <i class="bi bi-envelope input-icon"></i>

                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Enter your email" required
                                        autocomplete="username">

                                </div>

                                @error('email')
                                    <div class="text-danger small mb-2">
                                        {{ $message }}
                                    </div>
                                @enderror


                                <!-- =================================================
                                     PASSWORD
                                     ================================================= -->
                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <div class="input-group-custom">

                                    <i class="bi bi-lock input-icon"></i>

                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Create a password" required autocomplete="new-password">

                                    <button type="button" class="password-toggle" id="togglePassword"
                                        aria-label="Show password">

                                        <i class="bi bi-eye" id="passwordIcon"></i>

                                    </button>

                                </div>

                                @error('password')
                                    <div class="text-danger small mb-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <!-- =================================================
                                     CONFIRM PASSWORD
                                     ================================================= -->

                                <label for="password_confirmation" class="form-label">
                                    Confirm Password
                                </label>

                                <div class="input-group-custom">

                                    <i class="bi bi-lock-fill input-icon"></i>

                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirm your password" required
                                        autocomplete="new-password">

                                    <button type="button" class="password-toggle" id="toggleConfirmPassword"
                                        aria-label="Show password">

                                        <i class="bi bi-eye" id="confirmPasswordIcon"></i>

                                    </button>

                                </div>

                                @error('password_confirmation')
                                    <div class="text-danger small mb-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <!-- =================================================
                                     DEPARTMENT
                                     ================================================= -->

                                        <label for="department_id" class="form-label">
                                            Department
                                        </label>

                                        <div class="input-group-custom">

                                            <select id="department_id" name="department_id" class="department-select" required>

                                                <option value="">
                                                    Select Department
                                                </option>

                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                        @error('department_id')
                                            <div class="text-danger small mb-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <!-- =================================================
                                     START YEAR
                                     ================================================= -->

                                        <label for="started_year" class="form-label">
                                            Start Year
                                        </label>

                                        <div class="input-group-custom">

                                            <i class="bi bi-calendar input-icon"></i>

                                            <input type="number" class="form-control" id="started_year"
                                                name="started_year" value="{{ old('started_year') }}"
                                                placeholder="Enter Start Year" min="1900" max="2200"
                                                required>

                                        </div>

                                        @error('started_year')
                                            <div class="text-danger small mb-2">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <!-- =================================================
                                     REGISTER BUTTON
                                     ================================================= -->

                                <button type="submit" class="btn btn-primary btn-auth mt-2">

                                    <i class="bi bi-person-plus me-1"></i>

                                    Create Account

                                </button>

                            </form>


                            <!-- =================================================
                                 LOGIN LINK
                                 ================================================= -->

                            <div class="switch-text">

                                Already have an account?

                                <a href="{{ route('login') }}" class="switch-btn">
                                    Login
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         PASSWORD SHOW / HIDE
         ========================================================= -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {


            /* =====================================================
               PASSWORD
               ===================================================== */

            const passwordInput =
                document.getElementById('password');

            const togglePassword =
                document.getElementById('togglePassword');

            const passwordIcon =
                document.getElementById('passwordIcon');


            if (
                togglePassword &&
                passwordInput &&
                passwordIcon
            ) {

                togglePassword.addEventListener(
                    'click',
                    function() {

                        if (
                            passwordInput.type === 'password'
                        ) {

                            passwordInput.type = 'text';

                            passwordIcon.classList.replace(
                                'bi-eye',
                                'bi-eye-slash'
                            );

                            togglePassword.setAttribute(
                                'aria-label',
                                'Hide password'
                            );

                        } else {

                            passwordInput.type = 'password';

                            passwordIcon.classList.replace(
                                'bi-eye-slash',
                                'bi-eye'
                            );

                            togglePassword.setAttribute(
                                'aria-label',
                                'Show password'
                            );

                        }

                    }
                );

            }


            /* =====================================================
               CONFIRM PASSWORD
               ===================================================== */

            const confirmPasswordInput =
                document.getElementById(
                    'password_confirmation'
                );

            const toggleConfirmPassword =
                document.getElementById(
                    'toggleConfirmPassword'
                );

            const confirmPasswordIcon =
                document.getElementById(
                    'confirmPasswordIcon'
                );


            if (
                toggleConfirmPassword &&
                confirmPasswordInput &&
                confirmPasswordIcon
            ) {

                toggleConfirmPassword.addEventListener(
                    'click',
                    function() {

                        if (
                            confirmPasswordInput.type === 'password'
                        ) {

                            confirmPasswordInput.type = 'text';

                            confirmPasswordIcon.classList.replace(
                                'bi-eye',
                                'bi-eye-slash'
                            );

                            toggleConfirmPassword.setAttribute(
                                'aria-label',
                                'Hide password'
                            );

                        } else {

                            confirmPasswordInput.type = 'password';

                            confirmPasswordIcon.classList.replace(
                                'bi-eye-slash',
                                'bi-eye'
                            );

                            toggleConfirmPassword.setAttribute(
                                'aria-label',
                                'Show password'
                            );

                        }

                    }
                );

            }

        });
    </script>

</x-guest-layout>
