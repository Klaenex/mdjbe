<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class Mdjcontroller extends Controller
{
    public function index()
    {
        return Inertia::render('Mdjs/Index');
    }
};
