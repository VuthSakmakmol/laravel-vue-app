<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {  // Check if the user is authenticated
            // Check if the user is an admin
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('message', 'Welcome Admin!');
            } else {
                // For regular users
                $message = 'Welcome, you are logged in as a User!';
                return view('user.dashboard', compact('message'));  // Display user dashboard
            }
        }

        // If user is not authenticated, redirect to login
        return redirect()->route('login')->with('error', 'Please login first.');
    }
}
