<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategorias;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notification;
use App\Notifications\NewAnnouncement;
use App\User;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    public function index()
    {
        if(Gate::denies('empresas.index')){
            abort(403, "Não Autorizado");
        }
        if(auth()->user()->existRole('Administrador')){
            $empresa = Empresa::orderBy('nome', 'asc')->paginate(30);
            $total = 0;
        } else {
            $empresa = Empresa::where('user_id', '=', auth()->user()->id)->paginate(30);
            $verifica = Empresa::where('user_id', '=', auth()->user()->id)->get();
            $total = count($verifica);
        }
        
        if($total <= auth()->user()->quantidade) {
            $criar = 1;
        } else {
            $criar = 0;
        }
        
        return view('Admin.empresas.index', compact('empresa', 'criar'));
    }
    
    public function search(Request $request)
    {
        $data = $request->all();
        
        $empresa = Empresa::where('nome', 'like', '%' . $data['search']. '%')->paginate(20);
        $criar = 1;
        $resultado = [
            'total' =>  count($empresa),
            'palavra'   =>  $data['search'],
        ];
        return view('Admin.empresas.index', compact('empresa', 'criar', 'resultado'));
    }
    
    public function create()
    {
        if(Gate::denies('empresas.create')){
            abort(403, "Não Autorizado");
        }
        $verifica = Empresa::where('user_id', '=', auth()->user()->id)->get();
        if(count($verifica) >= auth()->user()->quantidade) {
            flash('Só é permitido o cadastro de uma empresa por conta')->warning();
            return redirect()->route('empresas.index');
        }
        $categorias = Categoria::where('status', '=', 'sim')->orderBy('nome', 'asc')->get();
        $subcategorias = subCategorias::where('status', '=', 'sim')->orderBy('nome', 'asc')->get();
        return view('Admin.empresas.create', compact('categorias', 'subcategorias'));
    }
    
    public function store(Request $request)
    {
        if(Gate::denies('empresas.create')){
            abort(403, "Não Autorizado");
        }
        $data = $request->all();
        $empresa = new Empresa;
        $validator = Validator::make($data, $empresa->rules());
        
        if($validator->fails()){
            flash('Preencha os Campos Obrigatórios')->warning();
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $verifica = Empresa::where('user_id', '=', auth()->user()->id)->get();
        if(count($verifica) >= auth()->user()->quantidade) {
            flash('Só é permitido o cadastro de uma empresa por conta')->warning();
            return redirect()->route('empresas.index');
        }
        
        $response = $empresa->newInfo($data);
        if($response){
            \Notification::send($empresa, new NewAnnouncement("Novo Anúncio Inserido no sistema!"));
            
            flash('Empresa Cadastrada com sucesso!')->success();
            return redirect()->route('empresas.index');
        } else {
            flash('Erro ao cadastrar a Empresa')->error();
            return redirect()->route('empresas.index');
        }
    }
    
    public function edit($id)
    {
        if(Gate::denies('empresas.edit')){
            abort(403, "Não Autorizado");
        }
        $empresa = Empresa::find($id);
        $categorias = Categoria::where('status', '=', 'sim')->orderBy('nome', 'asc')->get();
        $subcategorias = subCategorias::where('status', '=', 'sim')->orderBy('nome', 'asc')->get();
        if(!isset($empresa)){
            flash('Anúncio nao existe no sistema')->error();
            return redirect()->back();
        }
        
        if(auth()->user()->existRole('Administrador')){
            return view('Admin.empresas.edit', compact('empresa', 'categorias', 'subcategorias'));    
        }
        if($empresa->user_id != auth()->user()->id){
            flash('Ação não permitida')->error();
            return redirect()->back();
        }
        return view('Admin.empresas.edit', compact('empresa', 'categorias', 'subcategorias'));
    }
    
    public function update(Request $request, $id)
    {
        if(Gate::denies('empresas.edit')){
            abort(403, "Não Autorizado");
        }
        $empresa = Empresa::find($id);
        if(!isset($empresa)){
            flash('Anúncio nao existe no sistema')->error();
            return redirect()->back();
        }
        if(!auth()->user()->existRole('Administrador')){
            if($empresa->user_id != auth()->user()->id){
                flash('Ação não permitida')->error();
                return redirect()->back();
            }    
        }
        
        $data = $request->all();
        
        $response = $empresa->updateInfo($data);
        if($response){
            flash('Anúncio atualizado com sucesso!')->success();
            return redirect()->route('empresas.index');
        } else {
            flash('Nenhuma mudança realizada')->warning();
            return redirect()->route('empresas.index');
        }
    }
    
    public function delete($id)
    {
        if(Gate::denies('empresas.delete')){
            abort(403, "Não Autorizado");
        }
        $empresa = Empresa::find($id);
        if(!isset($empresa)){
            flash('Anúncio nao existe no sistema')->error();
            return redirect()->back();
        }
        
        if($empresa->user_id != auth()->user()->id){
            flash('Ação não permitida')->error();
            return redirect()->back();
        }
        
        $response = $empresa->deleteInfo();
        
        flash('Anúncio excluído com sucesso!')->success();
        return redirect()->route('empresas.index');
    }
    
    public function subcategoria($id)
    {
        $categoriaPrincipal = Categoria::find($id);
        $categoria = SubCategorias::where('categoria_id', '=', $id)->get();
        if(isset($categoriaPrincipal)){
            $categoria = SubCategorias::select('id', 'nome')->where('categoria_id', '=', $id)->orderBy('nome', 'asc')->get();
            if(count($categoria) > 0){
                return $categoria;
            }
        }
    }
    
    public function alterClient($id)
    {
        if(Gate::denies('empresas.alterClient')){
            abort(403, "Não Autorizado");
        }
        
        $empresa = Empresa::find($id);
        if(!isset($empresa)){
            flash('Anúncio nao existe no sistema')->error();
            return redirect()->back();
        }
        $users = User::orderBy('name')->get();
        
        return view('Admin.empresas.alter', compact('empresa', 'users'));
        
    }
    
    public function alterClientUpdate(Request $request, $id)
    {
        if(Gate::denies('empresas.alterClient')){
            abort(403, "Não Autorizado");
        }
        
        $empresa = Empresa::find($id);
        if(!isset($empresa)){
            flash('Anúncio nao existe no sistema')->error();
            return redirect()->back();
        }
        $data = $request->all();
        // dd($data);
        
        $validator = Validator::make($data, [
            "user_id"   =>  "required",
            ]
        );
        if($validator->fails()){
            flash('Atente-se ao formulário')->warning();
            return back()->withInput();
        }
        $cliente = DB::table('users')->where('id', $data['user_id'])->first();
        
        $verifica = Empresa::where('user_id', '=', $data['user_id'])->get();
        
        if(count($verifica) >= $cliente->quantidade) {
            flash('Só é permitido o cadastro de uma empresa por conta')->warning();
            return back();
        }
        
        $response = $empresa->updateInfo($data);
        if($response){
            flash('Usuário alterado com sucesso!')->success();
            return redirect()->route('empresas.index');
        }
    }
}
