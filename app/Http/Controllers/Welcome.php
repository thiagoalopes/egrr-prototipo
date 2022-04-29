<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Parceiro;
use Illuminate\Http\Request;

class Welcome extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $parceiros = Parceiro::all();
        $cursos = Cursos::all();
        return view('home.index', compact(['parceiros','cursos']));
    }

    public function homeServidor()
    {
        return view('home.servidor');
    }
}
