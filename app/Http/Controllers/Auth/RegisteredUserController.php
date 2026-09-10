<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $departments = Department::all();

        return view('auth.register', compact('departments'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'full_name' => ['nullable', 'string', 'max:100'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'started_year' => ['nullable', 'integer', 'min:2000'],
        ]);

        $isStudent = str_ends_with(
            strtolower($request->email),
            '@lifeun.edu.kh'
        );

        // Create user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $isStudent ? 'student' : 'guest',
        ]);

        // Only students have a student profile
        if ($isStudent) {
            // Extra validation for students
            $request->validate([
                'full_name' => ['required', 'string', 'max:100'],
                'department_id' => ['required', 'exists:departments,id'],
                'started_year' => ['required', 'integer', 'min:2000'],
            ]);

            Student::create([
                'full_name' => $request->full_name,
                'user_id' => $user->id,
                'department_id' => $request->department_id,
                'upload_permission' => false,
                'started_year' => $request->started_year,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect()->route('verification.notice');
        }

        // Guest
        Auth::login($user);

        return redirect()->route('student.dashboard');
    }
}