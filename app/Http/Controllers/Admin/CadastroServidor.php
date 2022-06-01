<?php

namespace App\Http\Controllers\Admin;

use App\Models\Servidor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SecretariaServidores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class CadastroServidor extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()) || 
            Gate::allows('isAdminCartao', Auth::user()))
        {
            if($request->has('cpf'))
            {
                $servidores = Servidor::whereRaw("LOWER(cpf) like '%".strtolower($request->input('cpf'))."%'")->paginate(30);
                return view('admin.servidores.index',compact(['servidores']));
            }

            $servidores = Servidor::orderBy('servidor_confirmado','ASC')->paginate(30);
            return view('admin.servidores.index',compact(['servidores']));
        }
        return abort(403);
    }

    public function detalhes($idServidor)
    {
        if(Gate::allows('isAdminCurso', Auth::user()) || 
            Gate::allows('isAdminCartao', Auth::user()))
        {
            $servidor = Servidor::find($idServidor);

            if($servidor != null)
            {
                $secretarias = SecretariaServidores::all();
                return view('admin.servidores.confirmar',compact(['servidor','secretarias']));
            }
        }
        return abort(403);
    }

    public function editar($idServidor)
    {
        if(Gate::allows('isAdminCurso', Auth::user()) || 
            Gate::allows('isAdminCartao', Auth::user()))
        {
            $servidor = Servidor::find($idServidor);

            if($servidor != null)
            {
                $secretarias = SecretariaServidores::all();
                return view('admin.servidores.atualizacao',compact(['servidor','secretarias']));
            }
        }
        return abort(403);
    }

    public function update(Request $request, $idServidor)
    {
        if(Gate::allows('isAdminCurso', Auth::user()) || 
        Gate::allows('isAdminCartao', Auth::user()))
        {
            //Valida os dados do servidor
            $validated = $request->validate([
                'nome'=>'required',
                'cpf'=>'required|cpf',
                'tipo_vinculo'=>'required|in:efetivo,efetcomis,comissionado,temporario,federal',
                'matricula'=>'required|regex:/^[0-9]+$/',
                'sexo'=>'required|in:f,m,o,n',
                'cargo'=>'required|min:5',
                'funcao'=>'required|min:5',
                'secretaria'=>'required|regex:/^[0-9]+$/',
                'email'=>'required|email',
                'celular'=>'required|celular_com_ddd',
                'telefone'=>'nullable|telefone_com_ddd',
            ]);

            //Mapeia os campos validados para o nome das colunas do banco
            //de dados
            $mappedData = [
                'nome'=>$validated['nome'],
                'cpf'=>$validated['cpf'],
                'tipo_vinculo'=>$validated['tipo_vinculo'],
                'matricula'=>$validated['matricula'],
                'sexo'=>$validated['sexo'],
                'cargo'=>$validated['cargo'],
                'funcao'=>$validated['funcao'],
                'id_secretaria_servidores'=>$validated['secretaria'],
                'email'=>$validated['email'],
                'celular'=>$validated['celular'],
                'telefone'=>$validated['telefone'],
            ];

            //busca o cadastro do servidor pelo cpf do usuário logado
            //e atualiza.
            $servidor = Servidor::find($idServidor);
            $servidor->update($mappedData);
            Session::flash('success','Dados atualizados!');
            return redirect()->route('show.cadastros',['idServidor'=>$servidor->id]);
        }
        RETURN abort(403);
    }

    public function confirmarDados($idServidor)
    {
        if(Gate::allows('isAdminCurso', Auth::user()) || 
            Gate::allows('isAdminCartao', Auth::user()))
        {
            $servidor = Servidor::find($idServidor);

            if($servidor != null)
            {
                $servidor->servidor_confirmado = true;
                $servidor->update();

                Session::flash('success','Cadastro validado com sucesso!');
                return redirect()->route('listar.cadastros',['idServidor'=>$servidor->id]);
            }
        }
        return abort(403);
    }
}
