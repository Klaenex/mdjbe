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
use Illuminate\Support\Facades\Log;  // Assurez-vous que Log est importé

class MdjController extends Controller
{
    public function index()
    {
        return Inertia::render('Mdjs/Index', [
            'mdjs' => Mdjs::paginate(25),
            'user' => auth()->user(),
        ]);
    }

    public function edit($id)
    {
        $mdj = Mdjs::findOrFail($id);
        $images = Image::where('mdj_id', $id)->get(); // Assurez-vous que la requête est exécutée

        return Inertia::render('Mdjs/Edit', [
            'editMdj' => $mdj,
            'dp' => DispositifParticulier::all(),
            'img' => $images,
        ]);
    }

    public function update(UpdateMdjRequest $request, $id)
    {
        $validatedData = $request->validated();
        //    dd($validatedData);
        DB::beginTransaction();

        try {
            $mdj = Mdjs::findOrFail($id);
            $mdj->update($validatedData);

            $this->handleImageUpload($request, $mdj);

            DB::commit();
            return redirect()->route('mdjs.edit', $mdj->id)
                ->with('success', 'La maison de jeunes a été mise à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de la mise à jour de la Mdj: {$e->getMessage()}");
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour.']);
        }
    }


    protected function handleImageUpload($request, $mdj)
    {
        // Gérer le téléchargement du logo
        if ($request->hasFile('logo')) {
            $this->uploadAndSaveImage($request->file('logo'), $mdj, 'logo');
        }

        // Gérer le téléchargement de l'image1
        if ($request->hasFile('image1')) {
            $this->uploadAndSaveImage($request->file('image1'), $mdj, 'image1');
        }

        // Gérer le téléchargement de l'image2
        if ($request->hasFile('image2')) {
            $this->uploadAndSaveImage($request->file('image2'), $mdj, 'image2');
        }
    }



    protected function uploadAndSaveImage($file, $mdj, $type)
    {
        if ($file->isValid()) {
            $directory = $type === 'logo' ? 'images/logo' : 'images/photos';

            try {
                // Stockage du nouveau fichier
                $path = $file->store($directory, 'public');

                // Création d'une nouvelle instance de l'image avec le type
                Image::create([
                    'mdj_id' => $mdj->id,
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'ext' => $file->extension(),
                    'desc' => $type === 'logo' ? 'Logo de la maison de jeunes' : 'Image de la maison de jeunes',
                    'type' => $type
                ]);
            } catch (\Exception $e) {
                Log::error("Erreur lors de l'upload de l'image {$type}: {$e->getMessage()}");
                return back()->withErrors(['upload' => "Erreur lors de l'upload de l'image {$type}: {$e->getMessage()}"]);
            }
        } else {
            Log::error("Fichier invalide pour le champ {$type}.");
            return back()->withErrors(['upload' => "Le fichier pour le champ {$type} n'est pas valide."]);
        }
    }
}
