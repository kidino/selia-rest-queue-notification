<?php

namespace App\Http\Controllers\Chinook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        return view('chinook.main.index');
    }
}
