<?php

namespace App\Http\Controllers;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    public function index(){
        return view('welcome')->with('films', Film::all());
    }
}
