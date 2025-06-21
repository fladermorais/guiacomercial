<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoticiasStoreRequest;
use App\Http\Requests\NoticiasUpdateRequest;
use App\Models\CatBlog;
use App\Models\Noticias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NoticiasController extends Controller
{
    public function index()
    {
        if(Gate::denies('noticias.index')){
            abort(403, "Não Autorizado");
        }
        $noticias = Noticias::orderBy('titulo')->get();
        return view('Admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        if(Gate::denies('noticias.create')){
            abort(403, "Não Autorizado");
        }
        $categorias = CatBlog::where('status', 'A')->orderBy('titulo')->get();
        return view('Admin.noticias.create', compact('categorias'));
    }

    public function store(NoticiasStoreRequest $request)
    {
        if(Gate::denies('noticias.create')){
            abort(403, "Não Autorizado");
        }
        $data = $request->all();
        $info = new Noticias;
        $response = $info->newInfo($data);
        if($response){
            flash('Notícia cadastrada com sucesso!')->success();
            return redirect()->route('noticias.index');
        }
    }

    public function edit(Noticias $noticia)
    {
        if(Gate::denies('noticias.edit')){
            abort(403, "Não Autorizado");
        }
        $categorias = CatBlog::where('status', 'A')->orderBy('titulo')->get();
        $info = $noticia;
        return view('Admin.noticias.edit', compact('categorias', 'info'));
    }

    public function update(NoticiasUpdateRequest $request, Noticias $noticia)
    {
        if(Gate::denies('noticias.edit')){
            abort(403, "Não Autorizado");
        }
        $data = $request->all();
        $response = $noticia->updateInfo($data);
        if($response){
            flash('Notícia atualizada com sucesso!')->success();
            return redirect()->route('noticias.index');
        }
    }
}