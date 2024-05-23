<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Throwable;

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
        if ($user->is_admin == 1) {
            Session::flash('admin_welcome', 'Bienvenido Administrador');
        } else {
            Session::flash('error_message', 'No tienes permisos para acceder a esta área.');
        }

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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            // Manejar la excepción InvalidStateException aquí
            return redirect()->route('login')->with('error', 'Hubo un problema al intentar iniciar sesión con Google. Por favor, inténtalo de nuevo.');
        }

        // Si no hubo excepciones, continuamos con el flujo normal
        $user = User::where('email', $googleUser->email)->first();
        if (!$user) {
            $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => Hash::make(rand(100000, 999999))]);
        }

        Auth::login($user);

        return redirect()->to('/');
    }


}
