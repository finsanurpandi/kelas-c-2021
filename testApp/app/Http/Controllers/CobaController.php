<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function test()
    {
        // $data['nama'] = 'Finsa Nurpandi';
        // $data['kampus'] = 'Universitas Suryakancana';
        $nama = '<strong>Finsa Nurpandi</strong>';
        $kampus = 'Universitas Suryakancana';
        $fruits = ['Mangga', 'Jeruk','Jambu'];

        return view('coba.index', compact('nama', 'kampus', 'fruits'));
    }
}
