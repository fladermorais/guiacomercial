<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function index()
    {
        if(Gate::denies('permissions.index')){
            abort(403, "Não Autorizado");
        }
        $permissions = Permission::orderBy('description', 'asc')->get();
        return view('Admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        if(Gate::denies('permissions.create')){
            abort(403, "Não Autorizado");
        }
        return view('Admin.permissions.create');
    }

    public function store(Request $request)
    {
        if(Gate::denies('permissions.create')){
            abort(403, "Não Autorizado");
        }
        $data = $request->all();
        $permission = new Permission();
        $permission->create($data);
        flash("Permissão criado com sucesso")->success();
        return redirect()->route("permissions.index");
    }

    public function edit($id)
    {
        if(Gate::denies('permissions.edit')){
            abort(403, "Não Autorizado");
        }
        $permission = Permission::find($id);
        if(!isset($permission)){
            flash("Permissão não existe no sistema")->error();
            return redirect()->route('permissions.index');
        }
        return view('Admin.permissions.edit', compact('permission'));
    }

    public function update (Request $request, $id)
    {
        if(Gate::denies('permissions.edit')){
            abort(403, "Não Autorizado");
        }
        $permission = Permission::find($id);
        if(!isset($permission)){
            flash("Permissão não existe no sistema")->error();
            return redirect()->route('permissions.index');
        }
        $data = $request->all();
        $permission->update($data);
        flash("Permissão atualizado com sucesso no sistema")->success();
        return redirect()->route('permissions.index');
    }
}
