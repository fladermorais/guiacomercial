<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatBlog;
use App\Models\MenuConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenuConfigController extends Controller
{
    public function index()
    {
        if(Gate::denies('menus.index')){
            abort(403, "Não Autorizado");
        }
        $infos = MenuConfig::orderBy('alias')->get();
        return view('Admin.menus.index', compact('infos'));
    }

    public function create()
    {
        if(Gate::denies('menus.create')){
            abort(403, "Não Autorizado");
        }
        $categorias = CatBlog::where('status', 'A')->orderBy('titulo')->get();
        return view('Admin.menus.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        if(Gate::denies('menus.create')){
            abort(403, "Não Autorizado");
        }
        $data = $request->all();
        $menu = new MenuConfig;
        $response = $menu->newInfo($data);
        if($response){
            flash('Item de menu criado com sucesso')->success();
            return redirect()->route('menus.index');
        }
    }

    public function edit(MenuConfig $menu)
    {
        if(Gate::denies('menus.edit')){
            abort(403, "Não Autorizado");
        }
        $categorias = CatBlog::where('status', 'A')->orderBy('titulo')->get();
        $info = $menu;
        return view('Admin.menus.edit', compact('categorias', 'info'));
    }

    public function update(Request $request, MenuConfig $menu)
    {
        if(Gate::denies('menus.edit')){
            abort(403, "Não Autorizado");
        }
        $data = $request->all();
        $response = $menu->updateInfo($data);
        if($response){
            flash('Item de menu atualizado com sucesso')->success();
            return redirect()->route('menus.index');
        }
    }

    public function destroy(MenuConfig $menu)
    {
        if(Gate::denies('menus.delete')){
            abort(403, "Não Autorizado");
        }
        $response = $menu->deleteInfo();
        if($response){
            flash('Item de menu removido com sucesso')->success();
            return redirect()->route('menus.index');
        }
    }
}