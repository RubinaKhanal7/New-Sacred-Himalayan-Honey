<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function userIndex()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }
}
