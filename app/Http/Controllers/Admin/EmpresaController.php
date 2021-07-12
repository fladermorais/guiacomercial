<?php

namespace App\Http\Controllers\Admin;

use App\Categoria;
use App\Empresa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubCategorias;
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
        
        $validator = Validator::make($data, [
            'nome'      =>  ['required'],
            'descricao' =>  ['required'],
            'logo'      =>  ['required'],
            'imagem'    =>  ['required'],
            'telefone'  =>  ['required']
            ]
        );
        
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
        $empresa = new Empresa();    
        $empresa->user_id = auth()->user()->id;
        $empresa->categoria_id = $data['categoria'];
        (isset($data['subcategoria']) ? $empresa->subcategoria_id = $data['subcategoria'] : "");
        $empresa->nome = $data['nome'];
        $empresa->alias = $empresa->geraAlias($data['nome']);
        (isset($data['email'])? $empresa->email = $data['email'] : "" );
        (isset($data['telefone']) ? $empresa->telefone = $data['telefone'] : "" );
        (isset($data['whatsapp']) ? $empresa->whatsapp = $data['whatsapp'] : "" );
        (isset($data['descricao']) ? $empresa->descricao = $data['descricao'] : "" );
        (isset($data['endereco']) ? $empresa->endereco = $data['endereco'] : "" );
        (isset($data['bairro']) ? $empresa->bairro = $data['bairro'] : "" );
        (isset($data['cidade']) ? $empresa->cidade = $data['cidade'] : "" );
        (isset($data['estado']) ? $empresa->estado = $data['estado'] : "" );
        (isset($data['horario']) ? $empresa->horario_atendimento = $data['horario'] : "" );
        (isset($data['site']) ? $empresa->site = $data['site'] : "" );
        (isset($data['facebook']) ? $empresa->facebook = $data['facebook'] : "" );
        (isset($data['instagran']) ? $empresa->instagran = $data['instagran'] : "" );
        
        (isset($data['segunda']) ? $empresa->segunda = $data['segunda'] : "" );
        (isset($data['segunda_final']) ? $empresa->segunda_final = $data['segunda_final'] : "" );
        (isset($data['terca']) ? $empresa->terca = $data['terca'] : "" );
        (isset($data['terca_final']) ? $empresa->terca_final = $data['terca_final'] : "" );
        (isset($data['quarta']) ? $empresa->quarta = $data['quarta'] : "" );
        (isset($data['quarta_final']) ? $empresa->quarta_final = $data['quarta_final'] : "" );
        (isset($data['quinta']) ? $empresa->quinta = $data['quinta'] : "" );
        (isset($data['quinta_final']) ? $empresa->quinta_final = $data['quinta_final'] : "" );
        (isset($data['sexta']) ? $empresa->sexta = $data['sexta'] : "" );
        (isset($data['sexta_final']) ? $empresa->sexta_final = $data['sexta_final'] : "" );
        (isset($data['sabado']) ? $empresa->sabado = $data['sabado'] : "" );
        (isset($data['sabado_final']) ? $empresa->sabado_final = $data['sabado_final'] : "" );
        (isset($data['domingo']) ? $empresa->domingo = $data['domingo'] : "" );
        (isset($data['domingo_final']) ? $empresa->domingo_final = $data['domingo_final'] : "" );
        (isset($data['feriado']) ? $empresa->feriado = $data['feriado'] : "" );
        (isset($data['feriado_final']) ? $empresa->feriado_final = $data['feriado_final'] : "" );
        
        $empresa->view = 0;
        $empresa->like = 0;
        
        if(isset($data['logo'])){
            $file = $data['logo'];
            $extensao = $data['logo']->getClientOriginalExtension();
            $nome = $empresa->alias.".".$extensao;
            $path = public_path('/storage/logo');
            
            $file->move($path, $nome);
            if(!$file){
                return redirect()->back()->with('error', 'Falha ao fazer o upload')->withInput();
            }
            $empresa->img = $nome;
        } 
        
        if(isset($data['imagem'])){
            $file2 = $data['imagem'];
            $extensao2 = $data['imagem']->getClientOriginalExtension();
            $nome2 = $empresa->alias.".".$extensao2;
            $path2 = public_path('/storage/imagem');
            
            $file2->move($path2, $nome2);
            if(!$file){
                return redirect()->back()->with('error', 'Falha ao fazer o upload')->withInput();
            }
            $empresa->foto = $nome2;
        } 
        
        $empresa->save();
        if($empresa->id){
            
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
        // dd($data);
        $empresa->categoria_id = $data['categoria'];
        (isset($data['subcategoria']) ? $empresa->subcategoria_id = $data['subcategoria'] : "");
        $empresa->nome = $data['nome'];
        $empresa->alias = $empresa->geraAlias($data['nome']);
        $empresa->email = $data['email'];
        (isset($data['telefone']) ? $empresa->telefone = $data['telefone'] : $empresa->telefone = "" );
        (isset($data['whatsapp']) ? $empresa->whatsapp = $data['whatsapp'] : $empresa->whatsapp = "" );
        (isset($data['descricao']) ? $empresa->descricao = $data['descricao'] : $empresa->descricao = "" );
        (isset($data['endereco']) ? $empresa->endereco = $data['endereco'] : $empresa->endereco = "" );
        (isset($data['bairro']) ? $empresa->bairro = $data['bairro'] : $empresa->bairro = "" );
        (isset($data['cidade']) ? $empresa->cidade = $data['cidade'] : $empresa->cidade = "" );
        (isset($data['estado']) ? $empresa->estado = $data['estado'] : $empresa->estado = "" );
        (isset($data['horario']) ? $empresa->horario_atendimento = $data['horario'] : $empresa->horario_atendimento = "" );
        (isset($data['site']) ? $empresa->site = $data['site'] : $empresa->site = "" );
        (isset($data['facebook']) ? $empresa->facebook = $data['facebook'] : $empresa->facebook = "" );
        (isset($data['instagran']) ? $empresa->instagran = $data['instagran'] : $empresa->instagran = "" );
        
        (isset($data['segunda']) ? $empresa->segunda = $data['segunda'] : $empresa->segunda = "" );
        (isset($data['segunda_final']) ? $empresa->segunda_final = $data['segunda_final'] : $empresa->segunda_final = "" );
        (isset($data['terca']) ? $empresa->terca = $data['terca'] : $empresa->terca = "" );
        (isset($data['terca_final']) ? $empresa->terca_final = $data['terca_final'] : "" );
        (isset($data['quarta']) ? $empresa->quarta = $data['quarta'] : $empresa->quarta = "" );
        (isset($data['quarta_final']) ? $empresa->quarta_final = $data['quarta_final'] : $empresa->quarta_final = "" );
        (isset($data['quinta']) ? $empresa->quinta = $data['quinta'] : $empresa->quinta = "" );
        (isset($data['quinta_final']) ? $empresa->quinta_final = $data['quinta_final'] : $empresa->quinta_final = "" );
        (isset($data['sexta']) ? $empresa->sexta = $data['sexta'] : $empresa->sexta = "" );
        (isset($data['sexta_final']) ? $empresa->sexta_final = $data['sexta_final'] : $empresa->sexta_final = "" );
        (isset($data['sabado']) ? $empresa->sabado = $data['sabado'] : $empresa->sabado = "" );
        (isset($data['sabado_final']) ? $empresa->sabado_final = $data['sabado_final'] : $empresa->sabado_final = "" );
        (isset($data['domingo']) ? $empresa->domingo = $data['domingo'] : $empresa->domingo = "" );
        (isset($data['domingo_final']) ? $empresa->domingo_final = $data['domingo_final'] : $empresa->domingo_final = "" );
        (isset($data['feriado']) ? $empresa->feriado = $data['feriado'] : $empresa->feriado = "" );
        (isset($data['feriado_final']) ? $empresa->feriado_final = $data['feriado_final'] : $empresa->feriado_final = "" );
        
        if(isset($data['logo'])){
            if(isset($empresa->img)){
                $caminho = public_path('/storage/logo/');
                $arquivo = $caminho.$empresa->img;
                if(file_exists($arquivo)){
                    unlink($arquivo);
                }
            }
            $file = $data['logo'];
            $extensao = $data['logo']->getClientOriginalExtension();
            $nome = $empresa->alias.".".$extensao;
            $path = public_path('/storage/logo');
            
            $file->move($path, $nome);
            if(!$file){
                return redirect()->back()->with('error', 'Falha ao fazer o upload')->withInput();
            }
            $empresa->img = $nome;
        } 
        
        if(isset($data['imagem'])){
            if(isset($empresa->imagem)){
                $caminho = public_path('/storage/imagem/');
                $arquivo = $caminho.$empresa->foto;
                if(file_exists($arquivo)){
                    unlink($arquivo);
                }
            }
            $file2 = $data['imagem'];
            $extensao2 = $data['imagem']->getClientOriginalExtension();
            $nome2 = $empresa->alias.".".$extensao2;
            $path2 = public_path('/storage/imagem');
            
            $file2->move($path2, $nome2);
            if(!$file2){
                return redirect()->back()->with('error', 'Falha ao fazer o upload')->withInput();
            }
            $empresa->foto = $nome2;
        } 
        
        $empresa->update();
        if($empresa->getChanges()){
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
        
        // Apagando a Logo
        if(isset($empresa->img)){
            $caminho = public_path('/storage/'.auth()->user()->id.'/logo/');
            $arquivo = $caminho.$empresa->img;
            if(file_exists($arquivo)){
                unlink($arquivo);
            }
        }
        
        // Apagando a Imagem
        if(isset($empresa->foto)){
            $caminho = public_path('/storage/'. auth()->user()->id .'/imagem/');
            $arquivo = $caminho.$empresa->foto;
            if(file_exists($arquivo)){
                unlink($arquivo);
            }
        }
        
        $empresa->delete();
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
