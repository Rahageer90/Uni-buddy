<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // You can load data here if needed, or pass an empty array
        return view('home.index', [
            'user' => $user,
        ]);
    }
}
