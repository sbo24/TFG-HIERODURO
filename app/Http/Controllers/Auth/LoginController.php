<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        if (!Auth::check()) {
            return route('index');
        } else {
            return '/';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }



    protected function authenticated(Request $request, $user)
    {
        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        } else {
            return redirect()->intended(route('index'));
        }
    }

    public function showLoginForm()
    {
        return redirect()->route('index');
    }



}
