<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use App\Models\User;
use App\Models\Mdjs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::paginate(10),
            'user' => auth()->user(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create', [
            'user' => auth()->user(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'is_admin' => 'required|boolean',
            'mj' => 'required|string',
        ]);


        try {
            $password = Str::random(10);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($password),
                'is_admin' => $validatedData['is_admin'],
            ]);

            Mdjs::create([
                'name' => $validatedData['mj'],
            ]);

            $token = Password::broker()->createToken($user);
            Mail::to($user->email)->send(new Welcome($token, $user->id));

            return redirect()->route('users.index')->with('success', 'Utilisateur créé et email envoyé avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la création de l\'utilisateur.')->withInput();
        }
    }

    public function edit($id)
    {
        return Inertia::render('Users/Edit', [
            'editUser' => User::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'is_admin' => 'required|boolean',
        ]);


        try {
            $user = User::findOrFail($id);
            $user->update($validatedData);
            return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Erreur lors de la modification de l\'utilisateur.');
        }
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
