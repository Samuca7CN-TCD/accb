<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Editor;

class SobreController extends Controller
{
    public function index(){
        $editores = Editor::all();
        return view('sobre', compact(['editores']));
    }
}
