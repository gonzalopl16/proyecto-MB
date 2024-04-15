<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Option;
use Illuminate\Http\Request;

class MainFamilyController extends Controller
{
    public function show(Family $family){
        
        return view('families.show', compact('family'));
    }
}
