<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function update(Request $request, $userId): RedirectResponse
    {
        $userId = $request->query('userId');
        $token = $request->query('token');
        printf($token);
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'email_verified' => ['required', 'boolean'],
        ]);


        $user = User::findOrFail($userId);

        $user->update([
            'password' => Hash::make($request->password),
            'email_verified_at' => $request->email_verified ? now() : null,
        ]);


        return redirect(RouteServiceProvider::HOME);
    }






    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        dd($request);
        return redirect(RouteServiceProvider::HOME);
    }
}
