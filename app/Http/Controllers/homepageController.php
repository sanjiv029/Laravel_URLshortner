<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
class homepageController extends Controller
{
    public function index(){
      /*  $data ='Sanjiv';
       $array =[
       [ 'name'=>'Sanjiv',
        'school'=>'PMC'],
        [ 'name'=>'Sanji',
        'school'=>'PMU']
       ]; */

        return view("welcome");
        //->with(['data'=>$data,'array'=>$array]);
    }
}
