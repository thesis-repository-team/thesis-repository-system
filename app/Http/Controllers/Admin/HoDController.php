<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\HoD;
use App\Models\User;
use Illuminate\Http\Request;

class HoDController extends Controller
{
    public function index()
    {
        $hods = HoD::all();
        return view('admin.hods.index', compact('hods'));
    }

    public function create()
    {
        $departments = Department::all();
        $hods = HoD::all();

        return view('admin.hods.create', compact('departments', 'hods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:users,username',
            'password' => 'required|string|min:8',
            'email' => 'required|email|unique:users,email',
            'full_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            // 'is_active' => 'boolean',
            'started_year' => 'nullable|date_format:Y',
        ]);

        \DB::transaction(function () use ($request) {
            $user = User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'role' => 'hod',
            ]);

            HoD::create([
                'user_id' => $user->id,
                'full_name' => $request->full_name,
                'department_id' => $request->department_id,
                'is_active' => true,
                'started_year' => $request->started_year,
            ]);
        });

        return redirect()->route('admin.hods.index');
    }

    public function edit(HoD $hod)
    {
        $departments = Department::all();

        return view('admin.hods.edit', compact('departments', 'hod'));
    }

    public function update(Request $request, HoD $hod)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $hod->user_id,
            'username' => 'required|string|max:100|unique:users,username,' . $hod->user_id,
            'password' => 'nullable|string|min:8',
            'full_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'is_active' => 'required|boolean',
            'started_year' => 'nullable|date_format:Y',
        ]);

        \DB::transaction(function () use ($request, $hod) {
            $user = $hod->user;
            $user->username = $request->username;
            if ($request->email) {
                $user->email = $request->email;
            }
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            $hod->update([
                'full_name' => $request->full_name,
                'department_id' => $request->department_id,
                'is_active' => $request->is_active,
                'started_year' => $request->started_year,
            ]);
        });

        return redirect()->route('admin.hods.index');
    }
}
