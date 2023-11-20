<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\Department;

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

    public function store(Request $request)
    {
        // dd($request->all());
        // Lecturer::create($request->all());

        //Validation
        $validated = $request->validate([
            'nidn' => 'required|unique:lecturers,nidn|digits:10',
            'nama' => 'required|max:60|min:3',
            'department_id' => 'required'
        ]);

        Lecturer::create($validated);

        return redirect()->route('lecturer.index');
    }
}
