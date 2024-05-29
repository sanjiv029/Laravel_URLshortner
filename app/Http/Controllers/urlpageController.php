<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\URL;
use App\Models\Visitor;

class urlpageController extends Controller
{
public function index(){
     // Ensure the user is authenticated
        $userID = auth()->user()->id;
         Log::info($userID);
        $urls= URL::where("user_id", $userID)->get();
        return view('urls.index', compact('urls'));

}

public function view($id){
    $url = URL::findOrFail($id);
    if($url->user_id != auth()->user()->id){
        abort(404);
    }
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
    'user_id'=> auth()->user()->id,
    'original_url'=> $request->url,
    'short_url'=> $ran_string
   ]);
   return redirect()->action([urlpageController::class,'index']);
}
public function edit($id){
    $url = URL::findOrFail($id);
    //checks if user is accessing its own data or not
    if($url->user_id != auth()->user()->id){
        abort(404);
    }
    Log::info($url);
  //  dd($url);
    return view('urls.edit',compact('url'));
}
public function update(Request $request, $id){
   // dd($request, $id);
   $request ->validate([
        'url'=> 'url|max:2048'
    ] );

   $url = URL::findOrFail($id);
   if($url->user_id != auth()->user()->id){
    abort(404);
    }
   $url->update(
   ['original_url'=> $request->url]
   );
   $request->session()-> flash('success','URL was updated successfully');
   return redirect()->action([urlpageController::class,'index']);
}
public function destroy(Request $request ,$id){
    $url = URL::findOrFail($id);
    if($url->user_id != auth()->user()->id){
        abort(404);
    }
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
