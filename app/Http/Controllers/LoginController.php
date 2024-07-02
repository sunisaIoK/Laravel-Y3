<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Closure;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('layouts.login');
    }

    public function processLogin(Request $request)
    {
        $inputUsername = $request->input('username');
        $inputPassword = $request->input('password');

        $hardcodedUsername = 'admin123';
        $hardcodedPassword = '12345';

        if ($inputUsername === $hardcodedUsername && $inputPassword === $hardcodedPassword) {
            Session::put('loggedIn', true);
            return redirect()->route('TableProduct');
        }



        return redirect()->back()->withErrors(['error' => 'Invalid Credentials.']);
    }


    public function logout() {
        Session::forget('loggedIn');
        return redirect()->route('login');
    }

    public function handle($request, Closure $next) {
        if (!Session::has('loggedIn')) {
            return redirect()->route('login');
        }

        return $next($request);
    }


    public function __construct() {
        $this->middleware('customAuth')->except(['showLoginForm', 'processLogin']);
    }



}

