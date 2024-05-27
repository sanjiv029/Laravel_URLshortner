<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\URL;
use App\Models\Visitor;

class urlpageController extends Controller
{
public function index(){
    $urls = URL::all();
    //Auth()->logout();
    return view("urls.index",compact("urls"));

}
public function view($id){
    $url = URL::findOrFail($id);
    return view("urls.view",compact("url"));
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
   $request->session()-> flash('success','URL was updated successfully');
   return redirect()->action([urlpageController::class,'index']);
}
public function destroy(Request $request ,$id){
    $url = URL::findOrFail($id);
    $url->delete();
    $request->session()-> flash('success','URL was deleted successfully');
    return redirect()->action([urlpageController::class,'index']);

}

public function redirect(Request $request,$short_url){
    $url = URL::where('short_url',$short_url)->first();

   // dd($request->userAgent()) ;

   if($url){
    //record ip and user agent
    Visitor::create([
            'url_id'=> $url->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        //increment count of visitors
        $url->increment('visitor_count');
    return redirect()->away($url->original_url);
    }
    abort(404);

}
}
