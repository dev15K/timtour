<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $items = Items::where('deleted_at', null)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('index', compact('items'));
    }
}
