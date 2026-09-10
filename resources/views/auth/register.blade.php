<x-guest-layout>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="row g-0">
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

                <div class="col-md-7">
                    <div class="auth-right">
                        <div class="form-container">
                            <h2 class="form-title">
                                Create Account
                            </h2>
                            <p class="form-subtitle">
                                Please fill in your information to register.
                            </p>

                            @if (session('success'))
                                <div class="alert alert-success">

                                    {{ session('success') }}

                                </div>
                            @endif

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

                            <form method="POST" action="{{ route('register') }}">

                                @csrf
                                <div class="row g-3">
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

                                <div id="student-fields"
                                    style="display: {{ str_ends_with(old('email', ''), '@lifeun.edu.kh') ? 'block' : 'none' }};">
                                    <div class="row g-3">
                                        <div class="col-md-6">

                                            <label for="department_id" class="form-label">
                                                Department
                                            </label>

                                            <div class="input-group-custom">
                                                <select id="department_id" name="department_id"
                                                    class="department-select">
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
                                            <label for="started_year" class="form-label">
                                                Start Year
                                            </label>
                                            <div class="input-group-custom">
                                                <i class="bi bi-calendar input-icon"></i>
                                                <input type="number" class="form-control" id="started_year"
                                                    name="started_year" value="{{ old('started_year') }}"
                                                    placeholder="Enter Start Year" min="1900" max="2200">
                                            </div>

                                            @error('started_year')
                                                <div class="text-danger small mb-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-auth mt-2">
                                    <i class="bi bi-person-plus me-1"></i>
                                    Create Account
                                </button>
                            </form>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        const email = document.getElementById('email');
        const studentFields = document.getElementById('student-fields');
        const department = document.getElementById('department_id');
        const startedYear = document.getElementById('started_year');
        const fullName = document.getElementById('full_name');

        function toggleStudentFields() {

            const isStudent =
                email.value.toLowerCase().endsWith('@lifeun.edu.kh');

            studentFields.style.display =
                isStudent ? 'block' : 'none';

            department.required = isStudent;
            startedYear.required = isStudent;
            fullName.required = isStudent;
        }

        toggleStudentFields();

        email.addEventListener('input', toggleStudentFields);
    </script>
</x-guest-layout>
