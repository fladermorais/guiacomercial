<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaStoreRequest;
use App\Http\Requests\CategoriaUpdateRequest;
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
    
    public function store(CategoriaStoreRequest $request)
    {       
        if(Gate::denies('categorias.create')){
            abort(403, "Não Autorizado");
        }
        
        $data = $request->all();
        
        $categoria = new Categoria();
        
        $response = $categoria->newInfo($data);
        if($response){
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
    
    public function update(CategoriaUpdateRequest $request, $id)
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
        
        $response = $categoria->updateInfo($data);
        if($response){
            flash('Categoria atualizada com sucesso!')->success();
            return redirect()->route('categorias.index');
        } else {
            flash('Erro ao atualizar a categoria')->error();
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
            $data['status'] = "nao";
        } else {
            $data['status'] = "sim";
        }
        $response = $categoria->updateInfo($data);
        if($response){
            flash('Categoria Atualizada com suceso')->success();
        } else {
            flash('Erro ao atualizar')->error();
            return back();
        }
        return redirect()->route('categorias.index');
    }
}