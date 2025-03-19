<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Override the login method to include user type validation
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    // Add user type to the credentials used for authentication
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        
        return $credentials;
    }

    // Redirect users based on their type after login
    protected function authenticated(Request $request, $user)
    {
        if ($user->type === 'admin') {
            return redirect()->route('admin.home');
        }
        
        return redirect()->route('home');
    }
}