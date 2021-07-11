<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        if(Gate::denies('roles.index')){
            abort(403, "Não Autorizado");
        }
        $roles = Role::all();
        return view('Admin.roles.index', compact('roles'));
    }

    public function create()
    {
        if(Gate::denies('roles.create')){
            abort(403, "Não Autorizado");
        }
        return view('Admin.roles.create');
    }

    public function store(Request $request)
    {
        if(Gate::denies('roles.create')){
            abort(403, "Não Autorizado");
        }
        $data = $request->all();
        $role = new Role();
        $role->create($data);
        flash("Cargo criado com sucesso")->success();
        return redirect()->route("roles.index");
    }

    public function edit($id)
    {
        if(Gate::denies('roles.edit')){
            abort(403, "Não Autorizado");
        }
        $role = Role::find($id);
        if(!isset($role)){
            flash("Cargo não existe no sistema")->error();
            return redirect()->route('roles.index');
        }
        return view('Admin.roles.edit', compact('role'));
    }

    public function update (Request $request, $id)
    {
        if(Gate::denies('roles.edit')){
            abort(403, "Não Autorizado");
        }
        $role = Role::find($id);
        if(!isset($role)){
            flash("Cargo não existe no sistema")->error();
            return redirect()->route('roles.index');
        }
        $data = $request->all();
        $role->update($data);
        flash("Cargo atualizado com sucesso no sistema")->success();
        return redirect()->route('roles.index');
    }


    // Funções
    public function permission($role)
    {
        if(Gate::denies('rolePermission.index')){
            abort(403, "Não Autorizado");
        }
        $role = Role::find($role);
        $permissions = Permission::all();
        return view('Admin.roles.permissions', compact('role', 'permissions'));
    }

    public function permissionStore(Request $request, $role)
    {
        if(Gate::denies('rolePermission.store')){
            abort(403, "Não Autorizado");
        }
        $role = Role::find($role);
        $permission = Permission::find($request['permission_id']);
        $role->addPermission($permission);
        return redirect()->back();
    }

    public function permissionDelete($role, $permission)
    {
        if(Gate::denies('rolePermission.delete')){
            abort(403, "Não Autorizado");
        }
        $role = Role::find($role);
        $permission = Permission::find($permission);
        $role->removePermission($permission);
        return redirect()->back();
    }
}
