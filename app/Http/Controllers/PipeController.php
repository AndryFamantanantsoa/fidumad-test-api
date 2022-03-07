<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PipeController extends Controller
{
    
    public function index () {
        $lists_rib = Http::get("http://localhost:3000/api/operations");
        return response($lists_rib);
    }

    public function show () {

        
    }
}
