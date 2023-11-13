<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;

class LecturerController extends Controller
{
    public function index()
    {
        $lectures = Lecturer::all();

        dd($lectures);
        // echo "<pre>";
        // print_r($lectures);
        // echo "</pre>";
    }
}
