<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\URL;

class urlpageController extends Controller
{
public function index(){
    $urls = URL::all();
    return view("urls.index",compact("urls"));
}
public function create(){
    return view("urls.create");
}
public function store(Request $request){
    $request ->validate(
        [
            'url'=> 'url|max:2048'
        ]
        );

    $ran_string = Str::random(8);
    // return $ran_string;
   URL::create([
    'original_url'=> $request->url,
    'short_url'=> $ran_string
   ]);
   return redirect()->action([urlpageController::class,'index']);
}
public function edit($id){
    $url = URL::findOrFail($id);
  //  dd($url);
    return view('urls.edit',compact('url'));
}
public function update(Request $request, $id){
   // dd($request, $id);
   $request ->validate([
        'url'=> 'url|max:2048'
    ] );

   $url = URL::findOrFail($id);
   $url->update(
   ['original_url'=> $request->url]
   );
   return redirect()->action([urlpageController::class,'index']);
}
}
