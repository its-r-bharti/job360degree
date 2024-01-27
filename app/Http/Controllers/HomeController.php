<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index(){
        return view('component.home');
    } 

    public function contact(){
        return view('component.layout.contact');
    } 
}
