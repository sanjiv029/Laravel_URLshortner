<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
class homepageController extends Controller
{
    public function index(){
        return view("welcome");

    }
    public function upload_page(){
        return view('file');
    }
    public function upload(Request $request) {
        $request -> validate([
            'file' => 'required|image'
        ]);
        // Assume the image is stored and the path is obtained

        $path = $request->file('file')->store('Images');
        $fullPath = $path;

        // Store the full path in session
        session(['path' => $fullPath]);

        return redirect()->back()->with('path',$path);
    }
}
