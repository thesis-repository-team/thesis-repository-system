<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    {{-- =============================================================
    PROFILE SETTINGS POPUP
    STYLE ONLY - BACKEND / ROUTES / FORMS UNCHANGED
============================================================= --}}

    <div class="dashboard-content profile-modal-page">

        <div class="profile-modal-wrapper">

            <div class="profile-modal-card">

                {{-- =================================================
                CLOSE BUTTON
                GO BACK TO DASHBOARD
            ================================================== --}}
                @php
                    $dashboardRoute = match (auth()->user()->role) {
                        'admin' => 'admin.dashboard',
                        'hod' => 'hod.dashboard',
                        default => 'student.dashboard', // student and guest
                    };
                @endphp

                <a href="{{ route($dashboardRoute) }}" class="profile-popup-close" aria-label="{{ __('Close') }}"
                    title="{{ __('Close') }}">
                    <i class="bi bi-x-lg"></i>
                </a>

                {{-- =================================================
                PROFILE INFORMATION
            ================================================== --}}

                <section class="profile-section">

                    <div class="profile-section-header">
                        <div>
                            <h2 class="profile-title">
                                {{ __('Profile Information') }}
                            </h2>

                            <p class="profile-description">
                                {{ __("Update your account's profile information and email address.") }}
                            </p>
                        </div>
                    </div>

                    {{-- =================================================
                    PROFILE VALIDATION ERROR ALERT
                ================================================== --}}

                    @if ($errors->any())

                        <div class="profile-alert profile-alert-danger" x-data="{ show: true }" x-show="show"
                            x-transition x-init="setTimeout(() => show = false, 5000)">

                            <div class="profile-alert-icon">
                                <i class="bi bi-exclamation-circle-fill"></i>
                            </div>

                            <div class="profile-alert-content">

                                <strong>
                                    {{ __('Please check the following:') }}
                                </strong>

                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                            </div>

                            <button type="button" class="profile-alert-close" @click="show = false"
                                aria-label="{{ __('Close') }}">

                                <i class="bi bi-x-lg"></i>

                            </button>

                        </div>

                    @endif


                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">

                        @csrf

                    </form>


                    <form method="post" action="{{ route('profile.update') }}" class="profile-form">

                        @csrf
                        @method('patch')


                        {{-- Full Name --}}

                        @if ($user->role !== 'admin' && $user->role !== 'hod')
                            <div class="form-group">

                                <x-input-label for="full_name" :value="__('Full Name')" />

                                <x-text-input id="full_name" name="full_name" type="text" class="form-input"
                                    :value="old('full_name', $user->name)" required autofocus autocomplete="name" />

                                <x-input-error class="form-error" :messages="$errors->get('full_name')" />

                            </div>
                        @endif


                        {{-- Username --}}

                        <div class="form-group">

                            <x-input-label for="username" :value="__('Username')" />

                            <x-text-input id="username" name="username" type="text" class="form-input"
                                :value="old('username', $user->username)" required autocomplete="username" />

                            <x-input-error class="form-error" :messages="$errors->get('username')" />

                        </div>


                        {{-- Email --}}

                        @if ($user->role !== 'hod')

                            <div class="form-group">

                                <x-input-label for="email" :value="__('Email')" />

                                <x-text-input id="email" name="email" type="email" class="form-input"
                                    :value="old('email', $user->email)" required autocomplete="email" />

                                <x-input-error class="form-error" :messages="$errors->get('email')" />


                                {{-- Email Verification --}}

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())

                                    <div class="profile-alert profile-alert-warning">

                                        <div class="profile-alert-icon">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                        </div>

                                        <div class="profile-alert-content">

                                            <strong>
                                                {{ __('Your email address is unverified.') }}
                                            </strong>

                                            <button form="send-verification" class="verification-button">

                                                {{ __('Click here to re-send the verification email.') }}

                                            </button>

                                        </div>

                                    </div>


                                    @if (session('status') === 'verification-link-sent')
                                        <div class="profile-alert profile-alert-success" x-data="{ show: true }"
                                            x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">

                                            <div class="profile-alert-icon">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </div>

                                            <div class="profile-alert-content">

                                                <strong>
                                                    {{ __('Verification email sent successfully.') }}
                                                </strong>

                                                <p>
                                                    {{ __('A new verification link has been sent to your email address.') }}
                                                </p>

                                            </div>

                                            <button type="button" class="profile-alert-close" @click="show = false"
                                                aria-label="{{ __('Close') }}">

                                                <i class="bi bi-x-lg"></i>

                                            </button>

                                        </div>
                                    @endif

                                @endif

                            </div>

                        @endif


                        {{-- Save Profile --}}

                        <div class="form-actions">

                            <x-primary-button>
                                {{ __('Save Profile') }}
                            </x-primary-button>

                        </div>


                        {{-- Profile Updated Alert --}}

                        @if (session('status') === 'profile-updated')
                            <div class="profile-alert profile-alert-success" x-data="{ show: true }" x-show="show"
                                x-transition x-init="setTimeout(() => show = false, 5000)">

                                <div class="profile-alert-icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>

                                <div class="profile-alert-content">

                                    <strong>
                                        {{ __('Profile updated successfully.') }}
                                    </strong>

                                    <p>
                                        {{ __('Your profile information has been saved successfully.') }}
                                    </p>

                                </div>

                                <button type="button" class="profile-alert-close" @click="show = false"
                                    aria-label="{{ __('Close') }}">

                                    <i class="bi bi-x-lg"></i>

                                </button>

                            </div>
                        @endif

                    </form>

                </section>


                {{-- =================================================
                DIVIDER
            ================================================== --}}

                <div class="profile-divider"></div>


                {{-- =================================================
                UPDATE PASSWORD
            ================================================== --}}

                <section class="profile-section">

                    <div class="profile-section-header">

                        <div>

                            <h2 class="profile-title">
                                {{ __('Update Password') }}
                            </h2>

                            <p class="profile-description">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>

                        </div>

                    </div>


                    {{-- PASSWORD ERROR ALERT --}}

                    @if ($errors->updatePassword->any())

                        <div class="profile-alert profile-alert-danger" x-data="{ show: true }" x-show="show"
                            x-transition x-init="setTimeout(() => show = false, 5000)">

                            <div class="profile-alert-icon">
                                <i class="bi bi-exclamation-circle-fill"></i>
                            </div>

                            <div class="profile-alert-content">

                                <strong>
                                    {{ __('Password update failed.') }}
                                </strong>

                                <ul>
                                    @foreach ($errors->updatePassword->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                            </div>

                            <button type="button" class="profile-alert-close" @click="show = false"
                                aria-label="{{ __('Close') }}">

                                <i class="bi bi-x-lg"></i>

                            </button>

                        </div>

                    @endif


                    <form method="post" action="{{ route('password.update') }}" class="profile-form">

                        @csrf
                        @method('put')


                        {{-- Current Password --}}

                        <div class="form-group">

                            <x-input-label for="update_password_current_password" :value="__('Current Password')" />

                            <x-text-input id="update_password_current_password" name="current_password"
                                type="password" class="form-input" autocomplete="current-password" />

                            <x-input-error class="form-error" :messages="$errors->updatePassword->get('current_password')" />

                        </div>


                        {{-- New Password --}}

                        <div class="form-group">

                            <x-input-label for="update_password_password" :value="__('New Password')" />

                            <x-text-input id="update_password_password" name="password" type="password"
                                class="form-input" autocomplete="new-password" />

                            <x-input-error class="form-error" :messages="$errors->updatePassword->get('password')" />

                        </div>


                        {{-- Confirm Password --}}

                        <div class="form-group">

                            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                type="password" class="form-input" autocomplete="new-password" />

                            <x-input-error class="form-error" :messages="$errors->updatePassword->get('password_confirmation')" />

                        </div>


                        {{-- Save Password --}}

                        <div class="form-actions">

                            <x-primary-button>
                                {{ __('Update Password') }}
                            </x-primary-button>

                        </div>


                        {{-- Password Updated Alert --}}

                        @if (session('status') === 'password-updated')
                            <div class="profile-alert profile-alert-success" x-data="{ show: true }" x-show="show"
                                x-transition x-init="setTimeout(() => show = false, 5000)">

                                <div class="profile-alert-icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>

                                <div class="profile-alert-content">

                                    <strong>
                                        {{ __('Password updated successfully.') }}
                                    </strong>

                                    <p>
                                        {{ __('Your password has been changed successfully.') }}
                                    </p>

                                </div>

                                <button type="button" class="profile-alert-close" @click="show = false"
                                    aria-label="{{ __('Close') }}">

                                    <i class="bi bi-x-lg"></i>

                                </button>

                            </div>
                        @endif

                    </form>

                </section>


                {{-- =================================================
                DIVIDER
            ================================================== --}}

                <div class="profile-divider"></div>


                {{-- =================================================
                DELETE ACCOUNT
            ================================================== --}}

                <section class="profile-section delete-section">

                    <div class="profile-section-header">

                        <div>

                            <h2 class="profile-title delete-title">
                                {{ __('Delete Account') }}
                            </h2>

                            <p class="profile-description">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                            </p>

                        </div>

                    </div>


                    <div class="delete-box">

                        <div class="delete-warning">

                            <div class="delete-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>

                            <div>

                                <h3>
                                    {{ __('Danger Zone') }}
                                </h3>

                                <p>
                                    {{ __('Deleting your account is permanent and cannot be undone.') }}
                                </p>

                            </div>

                        </div>


                        <x-danger-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                            class="delete-button">

                            <i class="bi bi-trash3"></i>

                            {{ __('Delete Account') }}

                        </x-danger-button>

                    </div>


                    {{-- Delete Confirmation Modal --}}

                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

                        <form method="post" action="{{ route('profile.destroy') }}" class="delete-modal">

                            @csrf
                            @method('delete')


                            <div class="delete-modal-icon">
                                <i class="bi bi-trash3-fill"></i>
                            </div>


                            <h2 class="delete-modal-title">
                                {{ __('Are you sure you want to delete your account?') }}
                            </h2>


                            <p class="delete-modal-description">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                            </p>


                            <div class="form-group">

                                <x-input-label for="delete_password" :value="__('Password')" />

                                <x-text-input id="delete_password" name="password" type="password"
                                    class="form-input" placeholder="{{ __('Enter your password') }}" />

                                <x-input-error class="form-error" :messages="$errors->userDeletion->get('password')" />

                            </div>


                            <div class="delete-modal-actions">

                                {{-- Close instead of Cancel --}}

                                <x-secondary-button x-on:click="$dispatch('close')">

                                    <i class="bi bi-x-lg"></i>

                                    {{ __('Close') }}

                                </x-secondary-button>


                                <x-danger-button>

                                    <i class="bi bi-trash3"></i>

                                    {{ __('Delete Account') }}

                                </x-danger-button>

                            </div>

                        </form>

                    </x-modal>

                </section>

            </div>

        </div>

    </div>


    {{-- =============================================================
    PROFILE POPUP CSS
    STYLE ONLY
============================================================= --}}

    <style>
        /* =========================================================
       VARIABLES
    ========================================================= */

        :root {

            --profile-bg: #f5f6f8;
            --profile-card: #ffffff;
            --profile-text: #171717;
            --profile-muted: #6b7280;
            --profile-border: #e5e7eb;
            --profile-input: #ffffff;

            --profile-primary: #4f46e5;
            --profile-primary-hover: #4338ca;

            --profile-danger: #dc2626;
            --profile-danger-bg: #fef2f2;
            --profile-danger-border: #fecaca;

            --profile-success: #16a34a;
            --profile-success-bg: #f0fdf4;
            --profile-success-border: #bbf7d0;

            --profile-warning: #92400e;
            --profile-warning-bg: #fffbeb;
            --profile-warning-border: #fde68a;

            --profile-shadow:
                0 25px 80px rgba(0, 0, 0, .25);
        }


        /* =========================================================
       POPUP PAGE
    ========================================================= */

        .profile-modal-page {

            position: fixed;
            inset: 0;

            width: 100%;
            height: 100vh;

            margin: 0;
            padding: 30px 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow-y: auto;

            background: transparent !important;

            color: var(--profile-text);

            z-index: 9999;
        }


        /* =========================================================
       BLURRED BACKGROUND
    ========================================================= */

        .profile-modal-page::before {

            content: "";

            position: fixed;
            inset: 0;

            background: rgba(0, 0, 0, .38);

            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);

            z-index: -1;

            pointer-events: all;
        }


        /* =========================================================
       LOCK BODY SCROLL
    ========================================================= */

        body.profile-modal-open {
            overflow: hidden;
        }


        /* =========================================================
       POPUP WRAPPER
    ========================================================= */

        .profile-modal-wrapper {

            position: relative;

            width: 100%;
            max-width: 900px;

            margin: auto;

            z-index: 2;
        }


        /* =========================================================
       POPUP CARD
    ========================================================= */

        .profile-modal-card {

            position: relative;

            width: 100%;

            max-height: calc(100vh - 60px);

            overflow-y: auto;

            background: var(--profile-card);

            border: 1px solid var(--profile-border);

            border-radius: 18px;

            box-shadow: var(--profile-shadow);

            scrollbar-width: thin;

            scrollbar-color:
                rgba(107, 114, 128, .35) transparent;

            animation: profilePopupIn .28s ease-out;
        }


        /* =========================================================
       CLOSE BUTTON
    ========================================================= */

        .profile-popup-close {

            position: absolute;

            top: 18px;
            right: 18px;

            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid var(--profile-border);

            border-radius: 10px;

            background: var(--profile-card);

            color: var(--profile-muted);

            text-decoration: none;

            font-size: 14px;

            cursor: pointer;

            z-index: 20;

            transition:
                background .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }


        .profile-popup-close:hover {

            background: var(--profile-danger-bg);

            color: var(--profile-danger);

            border-color: var(--profile-danger-border);

            transform: rotate(4deg);

            box-shadow:
                0 5px 15px rgba(0, 0, 0, .08);
        }


        /* =========================================================
       POPUP ANIMATION
    ========================================================= */

        @keyframes profilePopupIn {

            from {

                opacity: 0;

                transform:
                    translateY(18px) scale(.97);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0) scale(1);
            }
        }


        /* =========================================================
       SECTION
    ========================================================= */

        .profile-section {
            padding: 30px;
        }


        .profile-section-header {
            margin-bottom: 24px;
            padding-right: 50px;
        }


        .profile-title {

            margin: 0;

            color: var(--profile-text);

            font-size: 20px;
            font-weight: 700;

            line-height: 1.4;
        }


        .profile-description {

            margin-top: 6px;
            margin-bottom: 0;

            color: var(--profile-muted);

            font-size: 14px;
            line-height: 1.6;
        }


        /* =========================================================
       FORM
    ========================================================= */

        .profile-form {

            display: flex;

            flex-direction: column;

            gap: 20px;
        }


        .form-group {
            width: 100%;
        }


        /* =========================================================
       INPUT
    ========================================================= */

        .form-input {

            display: block;

            width: 100%;

            margin-top: 7px;

            background: var(--profile-input) !important;

            color: var(--profile-text) !important;

            border: 1px solid var(--profile-border) !important;

            border-radius: 10px !important;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }


        .form-input:focus {

            border-color:
                var(--profile-primary) !important;

            box-shadow:
                0 0 0 4px rgba(79, 70, 229, .12) !important;

            outline: none;
        }


        .form-error {
            margin-top: 6px;
        }


        /* =========================================================
       ALERT
    ========================================================= */

        .profile-alert {

            position: relative;

            display: flex;

            align-items: flex-start;

            gap: 12px;

            width: 100%;

            margin-bottom: 20px;

            padding: 15px 18px;

            border-radius: 10px;

            font-size: 14px;

            line-height: 1.5;

            transition:
                background .3s ease,
                border-color .3s ease,
                color .3s ease;
        }


        .profile-alert-icon {

            flex: 0 0 auto;

            width: 22px;
            height: 22px;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 17px;
        }


        .profile-alert-content {

            min-width: 0;

            flex: 1;
        }


        .profile-alert-content strong {

            display: block;

            font-size: 14px;

            font-weight: 700;
        }


        .profile-alert-content p {

            margin: 3px 0 0;

            font-size: 13px;

            line-height: 1.5;
        }


        .profile-alert-content ul {

            margin: 6px 0 0;

            padding-left: 18px;
        }


        .profile-alert-content li {
            margin: 2px 0;
        }


        .profile-alert-close {

            flex: 0 0 auto;

            width: 28px;
            height: 28px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin: -3px -5px 0 0;

            border: 0;

            border-radius: 7px;

            background: transparent;

            color: inherit;

            font-size: 12px;

            cursor: pointer;

            opacity: .7;

            transition:
                background .2s ease,
                opacity .2s ease;
        }


        .profile-alert-close:hover {

            opacity: 1;

            background:
                rgba(0, 0, 0, .06);
        }


        /* =========================================================
       DANGER ALERT
    ========================================================= */

        .profile-alert-danger {

            border:
                1px solid var(--profile-danger-border);

            background:
                var(--profile-danger-bg);

            color:
                #991b1b;
        }


        .profile-alert-danger .profile-alert-icon {

            color:
                var(--profile-danger);
        }


        /* =========================================================
       SUCCESS ALERT
    ========================================================= */

        .profile-alert-success {

            border:
                1px solid var(--profile-success-border);

            background:
                var(--profile-success-bg);

            color:
                #166534;
        }


        .profile-alert-success .profile-alert-icon {

            color:
                var(--profile-success);
        }


        /* =========================================================
       WARNING ALERT
    ========================================================= */

        .profile-alert-warning {

            border:
                1px solid var(--profile-warning-border);

            background:
                var(--profile-warning-bg);

            color:
                var(--profile-warning);
        }


        .profile-alert-warning .profile-alert-icon {

            color: #d97706;
        }


        /* =========================================================
       VERIFICATION BUTTON
    ========================================================= */

        .verification-button {

            display: inline-block;

            margin-top: 5px;

            padding: 0;

            border: 0;

            background: transparent;

            color: inherit;

            font-size: 13px;

            text-decoration: underline;

            cursor: pointer;

            transition: opacity .2s ease;
        }


        .verification-button:hover {
            opacity: .75;
        }


        /* =========================================================
       ACTIONS
    ========================================================= */

        .form-actions {

            display: flex;

            align-items: center;

            gap: 14px;

            padding-top: 4px;
        }


        /* =========================================================
       DIVIDER
    ========================================================= */

        .profile-divider {

            height: 1px;

            background:
                var(--profile-border);

            margin: 0 30px;
        }


        /* =========================================================
       DELETE SECTION
    ========================================================= */

        .delete-title {

            color:
                var(--profile-danger);
        }


        .delete-box {

            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 18px;

            border-radius: 12px;

            background:
                var(--profile-danger-bg);

            border:
                1px solid var(--profile-danger-border);
        }


        .delete-warning {

            display: flex;

            align-items: center;

            gap: 14px;

            min-width: 0;
        }


        .delete-icon {

            flex: 0 0 auto;

            width: 42px;
            height: 42px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background:
                rgba(220, 38, 38, .1);

            color:
                var(--profile-danger);
        }


        .delete-warning h3 {

            margin: 0;

            font-size: 15px;

            font-weight: 700;

            color:
                var(--profile-danger);
        }


        .delete-warning p {

            margin: 3px 0 0;

            color:
                var(--profile-muted);

            font-size: 13px;
        }


        .delete-button {
            flex-shrink: 0;
        }


        /* =========================================================
       DELETE MODAL
    ========================================================= */

        .delete-modal {
            padding: 28px;
        }


        .delete-modal-icon {

            width: 48px;
            height: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin-bottom: 18px;

            border-radius: 12px;

            background:
                var(--profile-danger-bg);

            color:
                var(--profile-danger);

            font-size: 20px;
        }


        .delete-modal-title {

            margin: 0;

            color:
                var(--profile-text);

            font-size: 20px;

            font-weight: 700;
        }


        .delete-modal-description {

            margin-top: 8px;

            color:
                var(--profile-muted);

            font-size: 14px;

            line-height: 1.6;
        }


        .delete-modal-actions {

            display: flex;

            justify-content: flex-end;

            align-items: center;

            gap: 10px;

            margin-top: 24px;
        }


        /* =========================================================
       DARK MODE
    ========================================================= */

        [data-bs-theme="dark"] .profile-modal-page,
        .dark .profile-modal-page,
        body.dark .profile-modal-page,
        [data-theme="dark"] .profile-modal-page {

            --profile-bg: #101426;

            --profile-card: #181d33;

            --profile-text: #f3f4f6;

            --profile-muted: #999fb9;

            --profile-border: #292e45;

            --profile-input: #20253a;

            --profile-primary: #6366f1;

            --profile-primary-hover: #818cf8;

            --profile-danger: #f87171;

            --profile-danger-bg:
                rgba(127, 29, 29, .20);

            --profile-danger-border:
                rgba(248, 113, 113, .30);

            --profile-success: #4ade80;

            --profile-success-bg:
                rgba(20, 83, 45, .20);

            --profile-success-border:
                rgba(74, 222, 128, .28);

            --profile-warning: #fbbf24;

            --profile-warning-bg:
                rgba(120, 53, 15, .20);

            --profile-warning-border:
                rgba(251, 191, 36, .28);

            --profile-shadow:
                0 25px 80px rgba(0, 0, 0, .55);
        }


        /* =========================================================
       DARK OVERLAY
    ========================================================= */

        [data-bs-theme="dark"] .profile-modal-page::before,
        .dark .profile-modal-page::before,
        body.dark .profile-modal-page::before,
        [data-theme="dark"] .profile-modal-page::before {

            background:
                rgba(0, 0, 0, .58);
        }


        /* =========================================================
       DARK INPUT
    ========================================================= */

        [data-bs-theme="dark"] .profile-modal-page .form-input,
        .dark .profile-modal-page .form-input,
        body.dark .profile-modal-page .form-input,
        [data-theme="dark"] .profile-modal-page .form-input {

            background:
                var(--profile-input) !important;

            border-color:
                var(--profile-border) !important;

            color:
                var(--profile-text) !important;
        }


        [data-bs-theme="dark"] .profile-modal-page .form-input::placeholder,
        .dark .profile-modal-page .form-input::placeholder,
        body.dark .profile-modal-page .form-input::placeholder,
        [data-theme="dark"] .profile-modal-page .form-input::placeholder {

            color:
                #8f96ad !important;
        }


        /* =========================================================
       DARK CLOSE BUTTON
    ========================================================= */

        [data-bs-theme="dark"] .profile-popup-close,
        .dark .profile-popup-close,
        body.dark .profile-popup-close,
        [data-theme="dark"] .profile-popup-close {

            background:
                var(--profile-card);

            border-color:
                var(--profile-border);

            color:
                var(--profile-muted);
        }


        [data-bs-theme="dark"] .profile-popup-close:hover,
        .dark .profile-popup-close:hover,
        body.dark .profile-popup-close:hover,
        [data-theme="dark"] .profile-popup-close:hover {

            background:
                rgba(127, 29, 29, .25);

            color:
                #f87171;

            border-color:
                rgba(248, 113, 113, .35);
        }


        /* =========================================================
       DARK DANGER ALERT
    ========================================================= */

        [data-bs-theme="dark"] .profile-alert-danger,
        .dark .profile-alert-danger,
        body.dark .profile-alert-danger,
        [data-theme="dark"] .profile-alert-danger {

            background:
                rgba(127, 29, 29, .20);

            border-color:
                rgba(248, 113, 113, .30);

            color:
                #fca5a5;
        }


        /* =========================================================
       DARK SUCCESS ALERT
    ========================================================= */

        [data-bs-theme="dark"] .profile-alert-success,
        .dark .profile-alert-success,
        body.dark .profile-alert-success,
        [data-theme="dark"] .profile-alert-success {

            background:
                rgba(20, 83, 45, .20);

            border-color:
                rgba(74, 222, 128, .28);

            color:
                #86efac;
        }


        /* =========================================================
       DARK WARNING ALERT
    ========================================================= */

        [data-bs-theme="dark"] .profile-alert-warning,
        .dark .profile-alert-warning,
        body.dark .profile-alert-warning,
        [data-theme="dark"] .profile-alert-warning {

            background:
                rgba(120, 53, 15, .20);

            border-color:
                rgba(251, 191, 36, .28);

            color:
                #fbbf24;
        }


        /* =========================================================
       DARK ALERT CLOSE
    ========================================================= */

        [data-bs-theme="dark"] .profile-alert-close:hover,
        .dark .profile-alert-close:hover,
        body.dark .profile-alert-close:hover,
        [data-theme="dark"] .profile-alert-close:hover {

            background:
                rgba(255, 255, 255, .08);
        }


        /* =========================================================
       DARK DELETE
    ========================================================= */

        [data-bs-theme="dark"] .delete-warning p,
        .dark .delete-warning p,
        body.dark .delete-warning p,
        [data-theme="dark"] .delete-warning p {

            color:
                var(--profile-muted);
        }


        /* =========================================================
       TABLET
    ========================================================= */

        @media (max-width: 768px) {

            .profile-modal-page {

                padding:
                    20px 12px;
            }


            .profile-modal-card {

                max-height:
                    calc(100vh - 40px);

                border-radius:
                    16px;
            }


            .profile-section {

                padding:
                    24px;
            }


            .profile-divider {

                margin:
                    0 24px;
            }


            .profile-popup-close {

                top: 14px;
                right: 14px;

                width: 36px;
                height: 36px;
            }


            .delete-box {

                align-items:
                    flex-start;

                flex-direction:
                    column;
            }


            .delete-button {

                width: 100%;

                justify-content:
                    center;
            }

        }


        /* =========================================================
       MOBILE
    ========================================================= */

        @media (max-width: 640px) {

            .profile-modal-page {

                padding:
                    10px 8px;

                align-items:
                    flex-start;
            }


            .profile-modal-card {

                max-height:
                    calc(100vh - 20px);

                border-radius:
                    14px;
            }


            .profile-section {

                padding:
                    20px;
            }


            .profile-section-header {

                padding-right:
                    44px;
            }


            .profile-divider {

                margin:
                    0 20px;
            }


            .profile-popup-close {

                top: 12px;
                right: 12px;

                width: 34px;
                height: 34px;

                border-radius: 9px;

                font-size: 12px;
            }


            .profile-title {

                font-size:
                    18px;
            }


            .profile-description {

                font-size:
                    13px;
            }


            .profile-form {

                gap:
                    18px;
            }


            .form-actions {

                align-items:
                    stretch;

                flex-direction:
                    column;
            }


            .form-actions button {

                width: 100%;

                justify-content:
                    center;
            }


            .profile-alert {

                padding:
                    14px;

                gap:
                    10px;

                font-size:
                    13px;
            }


            .profile-alert-content strong {

                font-size:
                    13px;
            }


            .profile-alert-content p,
            .profile-alert-content li {

                font-size:
                    12px;
            }


            .profile-alert-close {

                width:
                    26px;

                height:
                    26px;
            }


            .delete-box {

                padding:
                    15px;
            }


            .delete-warning {

                align-items:
                    flex-start;
            }


            .delete-modal {

                padding:
                    22px;
            }


            .delete-modal-actions {

                flex-direction:
                    column;

                align-items:
                    stretch;
            }


            .delete-modal-actions button {

                width:
                    100%;

                justify-content:
                    center;
            }

        }


        /* =========================================================
       SMALL MOBILE
    ========================================================= */

        @media (max-width: 380px) {

            .profile-modal-page {

                padding:
                    6px;
            }


            .profile-modal-card {

                max-height:
                    calc(100vh - 12px);

                border-radius:
                    12px;
            }


            .profile-section {

                padding:
                    16px;
            }


            .profile-section-header {

                padding-right:
                    42px;
            }


            .profile-divider {

                margin:
                    0 16px;
            }


            .profile-popup-close {

                top: 10px;
                right: 10px;

                width: 32px;
                height: 32px;
            }


            .profile-title {

                font-size:
                    17px;
            }


            .profile-alert {

                padding:
                    12px;
            }


            .delete-warning {

                gap:
                    10px;
            }


            .delete-icon {

                width:
                    38px;

                height:
                    38px;
            }

        }
    </style>


    {{-- =============================================================
    LOCK BACKGROUND SCROLL
============================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.body.classList.add('profile-modal-open');

        });
    </script>

</x-app-layout>
