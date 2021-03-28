<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $remember = $request->get('remember') == 1;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return response()->json(['success' => 'Authenticate Success!']);
        }

        return response()->json(['errors' => ['email' => ['The provided credentials do not match our records.']]], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index');
    }
}
