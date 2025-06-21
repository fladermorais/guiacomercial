<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaBlogRequest;
use App\Models\CatBlog;
use Illuminate\Http\Request;

class CatBlogController extends Controller
{
    public function index()
    {
        $categorias = CatBlog::orderBy('status')->orderBy('titulo')->get();
        return view('Admin.categoriaBlog.index', compact('categorias'));
    }
    
    public function search(Request $request)
    {
        $data = $request->all();
        
        $categorias = CatBlog::where('titulo', 'like', '%' . $data['search']. '%')->get();
        $resultado = [
            'total' =>  count($categorias),
            'palavra'   =>  $data['search'],
        ];
        return view('Admin.categoriaBlog.index', compact('categorias', 'resultado'));
    }
    
    public function create()
    {
        return view('Admin.categoriaBlog.create');
    }
    
    public function store(CategoriaBlogRequest $request)
    {
        $data = $request->all();
        $categoria = new CatBlog;
        $response = $categoria->newInfo($data);
        if($response){
            flash('Categoria cadastrada com sucesso!')->success();
            return redirect()->route('categoriaBlog.index');
        }
    }
    
    public function edit(CatBlog $categoriaBlog)
    {
        $categoria = $categoriaBlog;
        return view('Admin.categoriaBlog.edit', compact('categoria'));
    }
    
    public function update(CategoriaBlogRequest $request, CatBlog $categoriaBlog)
    {
        $data = $request->all();
        $response = $categoriaBlog->updateInfo($data);
        if($response){
            flash('Categoria atualizada com sucesso!')->success();
            return redirect()->route('categoriaBlog.index');
        }
    }
}