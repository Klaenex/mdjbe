<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Mdjs;
use App\Models\DispositifParticulier;
use App\Models\Image;
use App\Http\Requests\UpdateMdjRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Mdjcontroller extends Controller
{
    public function index()
    {
        return Inertia::render('Mdjs/Index', [
            'mdjs' => Mdjs::paginate(25),
            'user' => auth()->user()
        ]);
    }
    public function edit($id)
    {
        return Inertia::render('Mdjs/Edit', [
            'editMdj' => Mdjs::findOrFail($id),
            'dispositifsParticulier' => DispositifParticulier::All(),
            'img' => Image::where('mdj_id', $id),

        ]);
    }
    public function update(UpdateMdjRequest $request, $id)
    {
        $validatedData = $request->validated();



        DB::beginTransaction();

        try {
            $mdj = Mdjs::findOrFail($id);

            // Mise à jour des informations de la Mdj
            $mdj->update($validatedData);

            // Traitement des images, si fournies
            // if ($request->hasFile('photos')) {
            //     foreach ($request->file('photos') as $photo) {
            //         $path = $photo->store('photos', 'public'); // Stocke dans le disque 'public'
            //         Image::create([
            //             'mdj_id' => $mdj->id,
            //             'path' => $path,
            //             // Ajoutez d'autres champs nécessaires ici
            //         ]);
            //     }
            // }

            DB::commit();

            return redirect()->route('mdjs.edit', $mdj->id)
                ->with('success', 'La maison de jeunes a été mise à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour.']);
        }
    }
};
