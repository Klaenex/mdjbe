<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Mdjs;
use Illuminate\Http\Request;

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
        ]);
    }
};
