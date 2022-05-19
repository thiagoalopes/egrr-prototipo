<?php

namespace App\Http\Controllers\Admin;

use DatePeriod;
use DateInterval;
use App\Models\Turmas;
use App\Models\Inscricoes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Frequencia as ModelsFrequencia;
use DateTime;

class Frequencia extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($idTurma, $dataAula=null)
    {
        $turma = Turmas::find($idTurma);

        if($turma->situacao->turma != 'fechada')
        {
            dd('1');
        }

        $inscricoes = Inscricoes::where('id_turma', $idTurma)->get();

        $dataInicio = new DateTime($turma->data_inicio);

        $dataTermino = new DateTime($turma->data_termino);
        $dataTermino = $dataTermino->modify( '+1 day' );

        $intervalo = new DateInterval('P1D');
        $periodo = new DatePeriod($dataInicio, $intervalo ,$dataTermino);

        $datas = [];

        foreach ($periodo as $data) {
            array_push($datas, $data);
        }

        if($dataAula != null)
        {
            if(strtotime($dataAula))
            {
                $frequencia = ModelsFrequencia::where('id_turma', $idTurma)
                ->where('data_aula', $dataAula)
                ->get();

                if($frequencia != null)
                {
                    return view('admin.frequencias.index', compact(['datas','inscricoes']));
                }
            }
        }

        return view('admin.frequencias.index', compact(['datas','inscricoes']));
    }
}
