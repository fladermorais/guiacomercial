<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategorias;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notification;
use App\Notifications\NewAnnouncement;

class SubCategoriaController extends Controller
{
    public function index()
    {
        if(Gate::denies('subCategorias.index')){
            abort(403, "Não Autorizado");
        }
        $categorias = SubCategorias::orderBy('nome', 'asc')->paginate(20);
        return view('Admin.subcategorias.index', compact('categorias'));
    }
    
    public function search(Request $request)
    {
        $data = $request->all();
        
        $categorias = SubCategorias::where('nome', 'like', '%' . $data['search']. '%')->paginate(20);
        
        $resultado = [
            'total' =>  count($categorias),
            'palavra'   =>  $data['search'],
        ];
        return view('Admin.subcategorias.index', compact('categorias', 'resultado'));
    }
    
    public function create()
    {
        if(Gate::denies('subCategorias.store')){
            abort(403, "Não Autorizado");
        }
        $categorias = Categoria::orderBy('nome', 'asc')->get();
        return view('Admin.subcategorias.create', compact('categorias'));
    }
    
    public function store(Request $request)
    {
        if(Gate::denies('subCategorias.store')){
            abort(403, "Não Autorizado");
        }
        $data = $request->all();
        
        $categoria = new SubCategorias();
        $validator = Validator::make($data, $categoria->rules());
        if($validator->fails()){
            flash('Preencha os campos obrigatórios')->warning();
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        
        $categoriaPrincipal = Categoria::find($data['categoria_id']);
        if(!isset($categoriaPrincipal)){
            flash('Categoria não existe no sistema')->error();
            return redirect()->back()->withInput();
        }
        
        $response = $categoria->newInfo($data);
        if($response){
            flash('Sub Categoria Cadastrada com sucesso!')->success();
            return redirect()->route('subCategorias.index');
        }
    }
    
    public function edit($id)
    {
        if(Gate::denies('subCategorias.edit')){
            abort(403, "Não Autorizado");
        }
        $categoria = SubCategorias::find($id);
        if(!isset($categoria)){
            flash('Categoria não encontrada no sistema')->error();
            return redirect()->route('subCategorias.index');
        }
        $categorias = Categoria::orderBy('nome', 'asc')->get();
        return view('Admin.subcategorias.edit', compact('categoria', 'categorias'));
    }
    
    public function update(Request $request, $id)
    {
        if(Gate::denies('subCategorias.edit')){
            abort(403, "Não Autorizado");
        }
        $categoria = SubCategorias::find($id);
        if(!isset($categoria)){
            flash('Categoria não encontrada no sistema')->error();
            return redirect()->route('subCategorias.index');
        }
        $data = $request->all();
        
        $validator = Validator::make($data, $categoria->rules());
        if($validator->fails()){
            return redirect()->route('subCategorias.index')
            ->withErrors($validator)
            ->withInput();
        }
        
        $categoriaPrincipal = Categoria::find($data['categoria_id']);
        if(!isset($categoriaPrincipal)){
            flash('Categoria Principal não existe no sistema')->error();
            return redirect()->back()->withInput();
        }
        
        $response = $categoria->updateInfo($data);
        if($response){
            \Notification::send($categoria, new NewAnnouncement("Categoria Alterada com sucesso no sistema!"));
            flash('Sub Categoria Atualizada com sucesso!')->success();
            return redirect()->route('subCategorias.index');
        } else {
            flash('Nenhuma mudança realizada!')->warning();
            return redirect()->route('subCategorias.index');
        }
    }
    
    public function active($id)
    {
        if(Gate::denies('subCategorias.active')){
            abort(403, "Não Autorizado");
        }
        $categoria = SubCategorias::find($id);
        if(!isset($categoria)){
            flash('Categoria não existe no sistema!')->error();
            return redirect()->back();
        }
        if($categoria->status == "sim"){
            $data['status'] = "nao";
        } else {
            $data['status'] = "sim";
        }
        $categoria->updateInfo($data);
        flash('Categoria Atualizada com suceso')->success();
        return redirect()->route('subCategorias.index');
    }
}