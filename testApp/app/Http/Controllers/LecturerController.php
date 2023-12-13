<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\Department;
use App\Models\User;
use App\Http\Requests\StoreLecturerRequest;
use App\Http\Requests\UpdateLecturerRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class LecturerController extends Controller
{
    public function index()
    {
        // $data['lecturers'] = Lecturer::all();
        $data['lecturers'] = Lecturer::with('department')->get();
        // $data['lecturers'] = Lecturer::where('department_id', 1)->get(); //first()
        // $data['students'] = Lecturer::find('5136152709')->students()->get();
        $data['user'] = auth()->user();

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

    // relationship
    public function lecturer_student(string $nidn)
    {
        // $data['students'] = Lecturer::findOrFail($nidn)->students()->with('department')->get();
        $data['students'] = Lecturer::findOrFail($nidn)->students;
        $data['departments'] = Department::findOrFail(3)->students;
        $data['department'] = Department::findOrFail(3)->student;
        $data['users'] = User::with('roles')->get();

        return view('lecturer.lecture_student', $data);
    }

    // MAIL
    public function sentMail()
    {
        $lecturer = Lecturer::find('1062044373');
        $subject = 'Invoice for NIDN '. $lecturer->nidn;

        $clients = [
            'client1@mail.com',
            'client2@mail.com',
            'client3@mail.com',
            'client4@mail.com',
            'client5@mail.com',
            'client6@mail.com',
            'client7@mail.com',
            'client8@mail.com',
            'client9@mail.com',
            'client10@mail.com',
        ];

        foreach($clients as $client)
        {
            Mail::to($client)->queue(new TestMail($lecturer, $subject));
        }
        
    }
}
