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
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;


class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return Inertia::render('Users/Index', [
            'users' => $users,
            'user' => auth()->user()
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'is_admin' => ['required'],
            'mj' => ['required']
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $password = Str::random(10);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'is_admin' => $request->is_admin,
                'password' => Hash::make($password),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => "Erreur lors de la création de l'utilisateur"]);
        }

        try {
            Mdjs::create([
                'name' => $request->mj
            ]);
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['msg' => 'Erreur lors de la création de la maison de jeunes']);
        }
        try {
            $token = Password::broker()->createToken($user);
            Mail::to($request->email)->send(new Welcome($token, $user->id));
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['msg' => 'Erreur lors de l\'envoi de l\'e-mail.']);
        }

        return redirect()->route('users.index')->with('message', 'Utilisateur créé et email envoyé avec succès.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return Inertia::render('Users/Edit', ['editUser' => $user]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'is_admin' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
            // Le mot de passe n'est pas mis à jour ici
        ]);

        return redirect()->route('users.index')->with('message', 'Utilisateur mis à jour avec succès.');
    }
}
