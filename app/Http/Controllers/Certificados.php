<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Certificados extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('certificado.certificados');
    }

    public function gerarCertificado()
    {

        $usuario = Auth::user();
        
        $file = PDF::loadView('certificado.layout',compact(['usuario']));

        Storage::put("temp/certificado_{$usuario->cpf}.pdf", $file->setPaper('a4', 'landscape')->output());

        return response()->file(storage_path()."/app/temp/certificado_{$usuario->cpf}.pdf", ["Content-Disposition"=>"inline;filename=certificado_{$usuario->cpf}",
            "Content-Type"=>'application/pdf'
        ])->deleteFileAfterSend();

    }
}
