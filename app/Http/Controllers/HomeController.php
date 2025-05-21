<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function App\Http\Controllers\ui\view;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('ui.index');
    }
}
