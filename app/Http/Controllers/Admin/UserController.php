<?php

namespace App\Http\Controllers\Admin;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Models\Role;
use Illuminate\Notifications\Notification;
use App\Notifications\NewClient;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        if(Gate::denies('usuarios.index')){
            abort(403, "Não Autorizado");
        }
        
        $users = User::orderBy('name', 'asc')->get();
        return view('Admin.user.index', compact('users'));
    }
    
    public function search(Request $request)
    {
        $data = $request->all();
        
        $users = User::where('name', 'like', '%' . $data['search']. '%')->get();
        $resultado = [
            'total' =>  count($users),
            'palavra'   =>  $data['search'],
        ];
        return view('Admin.user.index', compact('users', 'resultado'));
    }
    
    public function create()
    {
        if(Gate::denies('usuarios.create')){
            abort(403, "Não Autorizado");
        }
        return view('Admin.user.create');
    }
    
    public function store(UserStoreRequest $request)
    {
        if(Gate::denies('usuarios.create')){
            abort(403, "Não Autorizado");
        }
        $data = $request->all();
        $user = new User;
        
        $response = $user->newInfo($data);
        
        \Notification::send($user, new NewClient("Novo Usuário Cadastrado no sistema!"));
        
        flash('Usuário Criado com sucesso')->success();
        return redirect()->route('usuarios.index');
    }
    
    public function edit($id)
    {
        if(Gate::denies('usuarios.edit')){
            abort(403, "Não Autorizado");
        }
        $user = User::find($id);
        if(isset($user)){
            
            if(auth()->user()->id == $id || auth()->user()->existRole('Administrador')){
                return view('Admin.user.edit', compact('user'));
            } else {
                flash('Ação não permitida')->important();
                return redirect()->route('usuarios.index');
            }
        }
    }
    
    public function update(UserUpdateRequest $request, $id)
    {
        if(Gate::denies('usuarios.edit')){
            abort(403, "Não Autorizado");
        }
        $data = $request->all();
        $user = User::find($id);     
        
        $response = $user->updateInfo($data);
        
        flash("Usuário Atualizado com sucesso!")->success();
        if(auth()->user()->existRole('Administrador')){
            return redirect()->route('usuarios.index');
        } else {
            return redirect()->route('logado');
        }
        
        
        flash("Usuário Atualizado com sucesso!")->success();
        if(auth()->user()->existRole('Administrador')){
            return redirect()->route('usuarios.index');
        } else {
            return redirect()->route('logado');
        }
        
    }
    
    public function delete($id)
    {
        if(Gate::denies('usuarios.delete')){
            abort(403, "Não Autorizado");
        }
        $user = User::find($id);
        if(isset($user->id)){
            if(auth()->user()->id == $id){
                flash('Não é permitido excluir o próprio usuário')->error();
                return redirect()->route('usuarios.index');
            } else {
                //Verificando os anúncios
                $anuncios = Empresa::where('user_id', $id)->first();
                if(isset($anuncios)){
                    flash('Não é possível excluir o usuário, pois o mesmo possui um anúncio')->warning();
                    return back();
                }
                
                // Verificando as Permissões
                $permissoes = DB::table('role_user')->where('user_id', $id)->first();
                if(isset($permissoes)){
                    $role = Role::find($permissoes->role_id);
                    $user->removeRole($role->name);
                }
                $user->delete();
                flash('Usuário Excluido com sucesso')->success();
                return redirect()->route('usuarios.index');
            }
        } else {
            flash("Usuário não existe no sistema")->error();
            return redirect()->route('usuarios.index');
        }
    }
    
    public function active($id)
    {
        $user = User::withTrashed()->find($id);
        if(isset($user)){
            $user->restore();
            flash("Usuário Ativado")->success();
            return redirect()->route("usuarios.index");
        } else {
            flash("Usuário não encontrado no sistema")->error();
            return redirect()->route("usuarios.index");
        }
    }    
    
    // Rotas referente a Roles
    public function role($user){
        $user = User::find($user);
        $roles = Role::all();
        
        return view('Admin.user.role', compact('user', 'roles'));
    }
    
    public function roleStore(Request $request, $user)
    {
        $user = User::find($user);
        $role = Role::find($request['role_id']);
        $user->addRole($role);
        return redirect()->back();
    }
    public function roleDelete($user, $role)
    {
        $user = User::find($user);
        $role = Role::find($role);
        $user->removeRole($role);
        return redirect()->back();
    }
}