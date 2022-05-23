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

    public function index(Request $request, $idTurma)
    {
        $dataAula = $request->input('data_aula');

        
        if($dataAula != null && strtotime($dataAula))
        {
            $inscricoes = Inscricoes::where('id_turma', $idTurma)
            ->where('situacao_inscricao', 'confirmada')
            ->get();

            
            if($inscricoes != null)
            {
                //Cadastra todos os servidores inscritos aprovados na tb frequencia na turma no dia da aula selecionada
                foreach ($inscricoes as $inscricao) {
                    $frequencia = ModelsFrequencia::where('id_turma', $idTurma)
                    ->where('id_servidor', $inscricao->id_servidor)
                    ->where('data_aula', $dataAula)
                    ->first();

                    if($frequencia == null)
                    {
                        ModelsFrequencia::create([
                            'id_inscricao'=>$inscricao->id,
                            'id_servidor'=>$inscricao->servidor->id,
                            'id_secretaria_servidor'=>$inscricao->servidor->secretaria->id,
                            'id_curso'=>$inscricao->turma->curso->id,
                            'id_turma'=>$inscricao->turma->id,
                            'id_professor'=>$inscricao->turma->curso->professor->id,
                            'nome_servidor'=>$inscricao->servidor->nome,
                            'sigla_secretaria'=>$inscricao->servidor->secretaria->sigla,
                            'nome_curso'=>$inscricao->turma->curso->nome,
                            'descricao_turma'=>$inscricao->turma->descricao_turma,
                            'nome_professor'=>$inscricao->turma->curso->professor->nome,
                            'data_aula'=>$dataAula,
                        ]);
                    }
                }

                $frequencias = ModelsFrequencia::where('id_turma', $idTurma)
                ->where('data_aula', $dataAula)
                ->get();

                if($frequencias != null)
                {
                    $frequenciaServidor = [];

                    foreach ($inscricoes as $inscricao) {
                        foreach ($frequencias as $frequencia) {
                            
                            if($frequencia->id_servidor == $inscricao->id_servidor)
                            {
                                $frequenciaServidor[$frequencia->id_servidor] = $frequencia;
                                break;
                            }
                        }
                    }

                    return view('admin.frequencias.index', compact(['frequenciaServidor','inscricoes']));

                }
                return view('admin.frequencias.index', compact(['inscricoes']));
            }
        }
        
        $turma = Turmas::find($idTurma);

        if($turma)
        {
            $dataInicio = new DateTime($turma->data_inicio);
    
            $dataTermino = new DateTime($turma->data_termino);
            $dataTermino = $dataTermino->modify( '+1 day' );
    
            $intervalo = new DateInterval('P1D');
            $periodo = new DatePeriod($dataInicio, $intervalo ,$dataTermino);
    
            $datas = [];
    
            foreach ($periodo as $data) {
                array_push($datas, $data);
            }
    
            return view('admin.frequencias.index', compact(['datas']));
        }

        return abort(404);
    }

    public function salvar(Request $request)
    {
        return 'ok1';
    }

    public function atualizar(Request $request)
    {
        if($request->input('id_frequencia') != null && $request->input('ispresente') != null)
        {
            $frequencia = ModelsFrequencia::find($request->input('id_frequencia'));
            if($frequencia != null)
            {
                $frequencia->ispresente = $request->input('ispresente');
                $frequencia->update();

                return response()->json(['result'=>'success'], 200);
            }
        }
        return response()->json(['result'=>'fail'], 400);
    }
}
