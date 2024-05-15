<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index(Request $request){
        
        return view('welcome');
    }

    public function show(Request $request, $nik){
        $result = "Nama Anda ".$request->nama." dengan NIK ".$nik;
        return $result;
    }
}
