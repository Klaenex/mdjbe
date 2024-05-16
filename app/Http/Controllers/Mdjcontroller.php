<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Mdjs;
use App\Models\DispositifParticulier;
use App\Models\Image;
use App\Models\ProjetPorteur;
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
        $images = Image::where('mdj_id', $id)->get();
        $dp = DispositifParticulier::all();
        $projetPorteur = ProjetPorteur::where('mdj_id', $id)->orderBy('id', 'desc')->get();
        return Inertia::render('Mdjs/Edit', [
            'editMdj' => $mdj,
            'dp' => $dp,
            'img' => $images,
            'projetPorteur' => $projetPorteur
        ]);
    }

    public function update(UpdateMdjRequest $request, $id)
    {
        Log::info('Mise à jour Mdj - données reçues', ['data' => $request->all()]);

        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $mdj = Mdjs::findOrFail($id);
            $mdj->update($validatedData);
            $this->handleImageUpload($request, $mdj);

            if ($request->has('projects')) {
                $this->handleProjects($request->projects, $mdj);
            }

            DB::commit();
            return redirect()->route('mdjs.edit', $mdj->id)
                ->with('success', 'La maison de jeunes a été mise à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de la mise à jour de la Mdj: {$e->getMessage()}", ['exception' => $e]);
            return back()->withErrors($request->errors())->withInput();
        }
    }


    protected function handleImageUpload($request, $mdj)
    {
        $types = ['logo', 'image1', 'image2'];

        foreach ($types as $type) {
            if ($request->hasFile($type)) {
                $this->uploadAndReplaceImage($request->file($type), $mdj, $type);
            }
        }
    }

    protected function uploadAndReplaceImage($file, $mdj, $type)
    {
        if ($file->isValid()) {
            $existingImage = Image::where('mdj_id', $mdj->id)->where('type', $type)->first();

            if ($existingImage) {
                Storage::disk('public')->delete($existingImage->path);
                $existingImage->delete();
            }

            $directory = $type === 'logo' ? 'images/logo' : 'images/photos';
            $path = $file->store($directory, 'public');

            Image::create([
                'mdj_id' => $mdj->id,
                'path' => $path,
                'name' => $file->getClientOriginalName(),
                'ext' => $file->extension(),
                'desc' => $type === 'logo' ? 'Logo de la maison de jeunes' : 'Image de la maison de jeunes',
                'type' => $type
            ]);
        } else {
            Log::error("Fichier invalide pour le champ {$type}.");
            return back()->withErrors(['upload' => "Le fichier pour le champ {$type} n'est pas valide."]);
        }
    }


    protected function handleProjects($projects, $mdj)
    {
        foreach ($projects as $project) {
            try {
                ProjetPorteur::create([
                    'mdj_id' => $mdj->id,  // Assurez-vous que cette valeur est bien passée
                    'name' => $project['name']
                ]);
            } catch (\Exception $e) {
                Log::error("Erreur lors de la création d'un projet porteur: {$e->getMessage()}");
                // Ajouter une gestion d'erreur appropriée
            }
        }
    }

    public function deleteProject($id)
    {
        try {
            $project = ProjetPorteur::findOrFail($id);
            $project->delete();
            return redirect()->back()->with('success', 'Le projet a bien été supprimé');
        } catch (\Exception $e) {
            Log::error("Erreur lors de la suppression du projet porteur: {$e->getMessage()}", ['exception' => $e]);
            return redirect()->back()->with('error', 'Erreur lors de la suppression du projet');
        }
    }
}
