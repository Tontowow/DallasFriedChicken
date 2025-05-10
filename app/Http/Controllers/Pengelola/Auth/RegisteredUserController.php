<?php

namespace App\Http\Controllers\Pengelola\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengelola;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('pengelola.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 
            'unique:'.Pengelola::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $Pengelola = Pengelola::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($Pengelola));

        Auth::guard('pengelola')->login($Pengelola);

        return redirect(route('pengelola.dashboard', absolute: false));
    }
}
