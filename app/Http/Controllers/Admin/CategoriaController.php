<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CategoriaController extends Controller
{
    public function index()
    {
        if(Gate::denies('categorias.index')){
            abort(403, "Não Autorizado");
        }
        $categorias = Categoria::orderBy('status', 'asc')->orderBy('nome', 'asc')->get();
        return view('Admin.categorias.index', compact('categorias'));
    }
    
    public function search(Request $request){
        $data = $request->all();
        
        $categorias = Categoria::where('nome', 'like', '%' . $data['search']. '%')->get();
        $resultado = [
            'total' =>  count($categorias),
            'palavra'   =>  $data['search'],
        ];
        return view('Admin.categorias.index', compact('categorias', 'resultado'));


    }

    public function create()
    {
        if(Gate::denies('categorias.create')){
            abort(403, "Não Autorizado");
        }
        return view('Admin.categorias.create');
    }
    
    public function store(Request $request)
    {       
        if(Gate::denies('categorias.create')){
            abort(403, "Não Autorizado");
        }
        function geraAlias( $str ) {
            $palavra1 = strtr(utf8_decode($str),utf8_decode("ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ"),"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
            $palavra1 = str_replace(' ', '_', $palavra1);
            $palavra1 = strtolower($palavra1);
            return $palavra1;
        }
        
        $data = $request->all();
        $categoria = new Categoria();
        
        if($data['imagem']){
            $file = $data['imagem'];
            $extensao = $data['imagem']->getClientOriginalExtension();
            $nome = $categoria->geraAlias($data['nome']).".".$extensao;
            $path = public_path('/storage/categorias');
            
            $file->move($path, $nome);
            
            if(!$file){
                return redirect()->back()->with('error', 'Falha ao fazer o upload')->withInput();
            }
        } else {
            $nome = "";
        }
        
        
        $categoria->nome = $data['nome'];
        $categoria->alias = $categoria->geraAlias($data['nome']);
        $categoria->descricao = $data['descricao'];
        $categoria->status = "sim";
        $categoria->img = $nome;
        $categoria->save();
        if($categoria->id){
            flash('Categoria criada com sucesso!')->success();
            return redirect()->route('categorias.index');
        } else {
            flash('Erro ao cadastrar a categoria')->error();
            return redirect()->route('categorias.index');
        }
        
    }
    
    public function edit($id)
    {
        if(Gate::denies('categorias.edit')){
            abort(403, "Não Autorizado");
        }
        $categoria = Categoria::find($id);
        if(!isset($categoria)){
            flash('Categoria não existe no sistema!')->error();
            return redirect()->back();
        }
        return view('Admin.categorias.edit', compact('categoria'));
    }
    
    public function update(Request $request, $id)
    {
        if(Gate::denies('categorias.edit')){
            abort(403, "Não Autorizado");
        }
        $categoria = Categoria::find($id);
        if(!isset($categoria)){
            flash('Categoria não existe no sistema!')->error();
            return redirect()->back();
        }
        $data = $request->all();
        
        if(isset($data['imagem'])){
            if(isset($categoria->img)){
                $caminho = public_path('/storage/anexo/');
                $arquivo = $caminho.$categoria->img;
                if(file_exists($arquivo)){
                    unlink($arquivo);
                }
            }
            $file = $data['imagem'];
            $extensao = $data['imagem']->getClientOriginalExtension();
            $nome = $categoria->geraAlias($data['nome']).".".$extensao;
            $path = public_path('/storage/categorias');
            
            $file->move($path, $nome);
            
            if(!$file){
                return redirect()->back()->with('error', 'Falha ao fazer o upload')->withInput();
            }
            $categoria->img = $nome;
        }
        
        $categoria->nome = $data['nome'];
        $categoria->alias = $categoria->geraAlias($data['nome']);
        $categoria->descricao = $data['descricao'];
        $categoria->status = "sim";
        $categoria->update();
        if($categoria->getChanges()){
            flash('Categoria atualizada com sucesso!')->success();
            return redirect()->route('categorias.index');
        } else {
            flash('Nenhuma mudança realizada')->warning();
            return redirect()->route('categorias.index');
        }
        
    }
    
    public function active($id)
    {
        if(Gate::denies('categorias.active')){
            abort(403, "Não Autorizado");
        }
        $categoria = Categoria::find($id);
        if(!isset($categoria)){
            flash('Categoria não existe no sistema!')->error();
            return redirect()->back();
        }
        if($categoria->status == "sim"){
            $categoria->status = "nao";
        } else {
            $categoria->status = "sim";
        }
        $categoria->update();
        flash('Categoria Atualizada com suceso')->success();
        return redirect()->route('categorias.index');
    }
    
    
}
