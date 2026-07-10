<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }
    public function create()
    {
        $departments = Department::all();
        return view('admin.departments.create', compact('departments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);
        Department::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.departments.index');
    }
}
