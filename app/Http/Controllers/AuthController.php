<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRequest;
use App\Services\Auth\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() : View {
        return view('Auth.login');
    }

    public function authentication(AuthRequest $request, AuthService $authImpl) : RedirectResponse {
        $isAuthenticated = $authImpl->authProcess($request->validated());
        if($isAuthenticated) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->with('errors', "You're credentials are wrong")->onlyInput('email');
    }

    public function signOut(Request $request) : void {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    }
}
