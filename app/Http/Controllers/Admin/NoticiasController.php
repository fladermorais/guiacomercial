<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoticiasStoreRequest;
use App\Http\Requests\NoticiasUpdateRequest;
use App\Models\CatBlog;
use App\Models\Noticias;
use Illuminate\Http\Request;

class NoticiasController extends Controller
{
    public function index()
    {
        $noticias = Noticias::orderBy('titulo')->get();
        return view('Admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        $categorias = CatBlog::where('status', 'A')->orderBy('titulo')->get();
        return view('Admin.noticias.create', compact('categorias'));
    }

    public function store(NoticiasStoreRequest $request)
    {
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
        $categorias = CatBlog::where('status', 'A')->orderBy('titulo')->get();
        $info = $noticia;
        return view('Admin.noticias.edit', compact('categorias', 'info'));
    }

    public function update(NoticiasUpdateRequest $request, Noticias $noticia)
    {
        $data = $request->all();
        $response = $noticia->updateInfo($data);
        if($response){
            flash('Notícia atualizada com sucesso!')->success();
            return redirect()->route('noticias.index');
        }
    }
}