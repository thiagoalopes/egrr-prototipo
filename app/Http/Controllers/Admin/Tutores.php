<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tutores as ModelsTutores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Tutores extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            $tutores = ModelsTutores::all();
            return view('admin.tutor.index', compact(['tutores']));
        }

        return abort(403);
    }

    public function cadastro()
    {
        return 'ok';
    }
}
