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
            'dispositifsParticulier' => DispositifParticulier::all(),
            'img' => $images,
        ]);
    }

    public function update(UpdateMdjRequest $request, $id)
    {

        $validatedData = $request->validated();

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
            $this->uploadAndSaveImage($request->file('logo'), $mdj, true, 'logo');
        }

        // Gérer le téléchargement des images supplémentaires
        $imageFields = ['image1', 'image2'];
        foreach ($imageFields as $imageField) {
            if ($request->hasFile($imageField)) {
                $this->uploadAndSaveImage($request->file($imageField), $mdj, false, $imageField);
            }
        }
    }

    protected function uploadAndSaveImage($file, $mdj, $isLogo, $fieldName)
    {
        if ($file->isValid()) {
            $directory = $isLogo ? 'images/logo' : 'images/photos';
            // $oldImage = Image::where('mdj_id', $mdj->id)->get();
            // dd($oldImage);

            // if ($oldImage) {
            //     Storage::disk('public')->delete($oldImage->path);
            //     $oldImage->delete();
            // }

            try {
                $path = $file->store($directory, 'public');

                $mdj->images()->create([
                    'mdj_id' => $mdj->id,
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'ext' => $file->extensoin(),
                    'logo' => $isLogo,
                    'desc' => $isLogo ? 'Logo de la maison de jeunes' : 'Image de la maison de jeunes',
                ]);
            } catch (\Exception $e) {
                Log::error("Erreur lors de l'upload de l'image {$fieldName}: {$e->getMessage()}");
                return back()->withErrors(['upload' => "Erreur lors de l'upload de l'image {$fieldName}"]);
            }
        } else {
            Log::error("Fichier invalide pour le champ {$fieldName}.");
            return back()->withErrors(['upload' => "Le fichier pour le champ {$fieldName} n'est pas valide."]);
        }
    }
}
