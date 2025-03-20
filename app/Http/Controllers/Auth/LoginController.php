<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function username()
    {
        $login = request()->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        request()->merge([$field => $login]);
        return $field;
    }

    // Override the login method to include user type validation
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        $login = $request->get('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        
        return [
            $field => $login,
            'password' => $request->get('password')
        ];    }

    protected function authenticated(Request $request, $user)
    {
           $requestUri = $request->getRequestUri();

           if (str_contains($requestUri, 'login_user') && $user->type === 'admin') {
               Auth::logout();
            //    session()->flash('error', 'Admins cannot log in from this page.');
               return redirect()->route('login_user');
           }
        // $request->getRequestUri();
        if ($user->type === 'admin') {
            return redirect()->route('admin.home');
        }
        
        return redirect()->route('home');
    }
}