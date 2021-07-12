<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Site;

class SiteController extends Controller
{
    public function index()
    {
        $dados = Site::find(1);
        return view('Admin.sites.edit', compact('dados'));
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $dados = Site::find(1);
        $dados->nome = $data['nome'];
        $dados->quem_somos = $data['quem_somos'];
        $dados->titulo = $data['titulo'];
        $dados->mensagem = $data['mensagem'];
        if(isset($data['logo'])){
            $caminho = public_path('/storage/logo/');
            $arquivo = $caminho.$dados->logo;
            // dd($arquivo);
            if(file_exists($arquivo)){
                unlink($arquivo);
            }

            $file = $data['logo'];
            $extensao = $data['logo']->getClientOriginalExtension();
            $nome = "logo.".$extensao;
            $path = public_path('/storage/logo/');
            
            $file->move($path, $nome);
            if(!$file){
                return redirect()->back()->with('error', 'Falha ao fazer o upload')->withInput();
            }
            $dados->logo = $nome;

        }
        
        $dados->update();
        if($dados->getChanges()){
            flash('Dados atualizados com sucesso!')->success();
            return redirect()->route('sites.index');
        } else {
            flash('Nenhuma mudança realizada')->warning();
            return redirect()->route('sites.index');
        }
    }
}
