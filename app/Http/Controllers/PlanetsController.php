<?php

namespace App\Http\Controllers;
use App\Models\Planet;
use Illuminate\Http\Request;

class PlanetsController extends Controller
{
    public function index(){
        return view('welcome')->with('planets', Planet::all());
    }
}
