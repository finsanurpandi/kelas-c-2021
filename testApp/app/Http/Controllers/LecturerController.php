<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\Department;
use App\Http\Requests\StoreLecturerRequest;
use App\Http\Requests\UpdateLecturerRequest;

class LecturerController extends Controller
{
    public function index()
    {
        $data['lecturers'] = Lecturer::all();
        // $data['lecturers'] = Lecturer::where('department_id', 1)->get(); //first()

        // dd($lectures);
        // echo "<pre>";
        // print_r($lectures);
        // echo "</pre>";

        return view('lecturer.index', $data);
    }

    public function create()
    {
        $data['departments'] = Department::pluck('name', 'id');
        return view('lecturer.create', $data);
    }

    public function store(StoreLecturerRequest $request)
    {
        // dd($request->all());
        // Lecturer::create($request->all());

        //Validation
        // $validated = $request->validate([
        //     'nidn' => 'required|unique:lecturers,nidn|digits:10',
        //     'nama' => 'required|max:60|min:3',
        //     'department_id' => 'required'
        // ]);

        // Lecturer::create($validated);
        Lecturer::create($request->validate());

        return redirect()->route('lecturer.index');
    }

    public function edit(string $nidn)
    {
        $data['lecturer'] = Lecturer::findOrFail($nidn);
        $data['departments'] = Department::pluck('name', 'id');
        return view('lecturer.create', $data);
    }

    public function update(UpdateLecturerRequest $request, $nidn)
    {
        $lecturer = Lecturer::findOrFail($nidn);
        $lecturer->update($request->validated());

        return redirect()->route('lecturer.index');
    }

    public function destroy(string $nidn)
    {
        Lecturer::findOrFail($nidn)->delete();

        return redirect()->route('lecturer.index');
    }
}
