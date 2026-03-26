<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtenemos al usuario que inició sesión
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }
}