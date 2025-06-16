<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\Welcome;
use App\Models\Mdjs;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

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
        $mdj = Mdjs::all();

        return Inertia::render('Users/Create', [
            'user' => auth()->user(),
            'mdjs' => $mdj,
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        // Validation des données entrantes
        $validatedData = $request->validated();

        DB::beginTransaction(); // Début de la transaction
        try {
            $password = Str::random(10);

            // Création de l'utilisateur
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($password),
                'is_admin' => $validatedData['is_admin'],
            ]);

            // Vérifier si l'utilisateur doit être attribué à une maison de jeunes existante
            if (! empty($validatedData['mdjExist'])) {
                // Assigner l'utilisateur à une maison de jeunes existante
                $mdj = Mdjs::findOrFail($validatedData['mjExist']);
                $mdj->user_id = $user->id;
                $mdj->save();
            } else {
                // Création d'un enregistrement associé dans `mdjs`
                Mdjs::create([
                    'name' => $validatedData['mj'],
                    'user_id' => $user->id,
                ]);
            }

            // $token = Password::broker()->createToken($user);
            // Mail::to($user->email)->send(new Welcome($token, $user->id));

            DB::commit(); // Validation de la transaction

            return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé et email envoyé avec succès.');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return back()->with('error', 'Erreur de base de données lors de la création de l\'utilisateur.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Erreur lors de la création de l\'utilisateur.');
        }
    }

    public function edit($id)
    {
        return Inertia::render('Users/Edit', [
            'editUser' => User::findOrFail($id),
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $validatedData = $request->validated();

        try {
            $user = User::findOrFail($id);
            $user->update($validatedData);

            return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la modification de l\'utilisateur.')->withInput();
        }
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function editSelf(): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => auth()->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function updateSelf(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        return Redirect::route('admin.profile.edit')
            ->with('success', 'Profil mis à jour.');
    }

    public function destroySelf(Request $request): RedirectResponse
    {
        $request->validate(['password' => ['required', 'current_password']]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
