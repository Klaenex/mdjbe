<?php

namespace App\Http\Controllers;

use App\Models\Mdjs;
use Inertia\Inertia;
use Inertia\Response;

class FrontendController extends Controller
{
    /**
     * @var Mdjs
     */
    protected $mdjs;

    public function __construct(Mdjs $mdjs)
    {
        $this->mdjs = $mdjs;
    }

    public function index(): Response
    {
        $mdjs = $this->mdjs
            ->select('id', 'name', 'city', 'region')
            ->orderBy('name')
            ->paginate(15);

        return Inertia::render('Web/Mdjs/Index', [
            'mdjs' => $mdjs,
        ]);
    }

    public function show(int $id): Response
    {
        $mdj = $this->mdjs
            ->select('id', 'name', 'city', 'region')
            ->findOrFail($id);

        return Inertia::render('Web/Mdjs/Show', [
            'mdj' => $mdj,
        ]);
    }
}
