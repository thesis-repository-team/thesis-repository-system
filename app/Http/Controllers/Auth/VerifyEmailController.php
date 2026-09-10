<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;


class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if (! $request->user()->hasVerifiedEmail()) {
            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }
        }

        $user = $request->user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard', ['verified' => 1]),
            'hod' => redirect()->route('hod.dashboard', ['verified' => 1]),
            'student', 'guest' => redirect()->route('student.dashboard', ['verified' => 1]),
        };
    }
}

// class VerifyEmailController extends Controller
// {
//     /**
//      * Mark the authenticated user's email address as verified.
//      */
//     public function __invoke(EmailVerificationRequest $request): RedirectResponse
//     {
//         if ($request->user()->hasVerifiedEmail()) {
//             return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
//         }

//         if ($request->user()->markEmailAsVerified()) {
//             event(new Verified($request->user()));
//         }

//         return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
//     }
// }