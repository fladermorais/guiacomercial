<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\MenuConfig;
use App\Models\Site;
use App\Models\SubCategorias;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function logado()
    {
        if(auth()->user()->existRole('Cliente')){
            return redirect()->route('empresas.index');
        } else {
            $hoje = date("Y-m-d H:d:s", strtotime('+1 day'));
            $ontem = date("Y-m-d H:d:s", strtotime('-5 day'));

            $clientes = User::count();
            $anuncios = Empresa::count();
            $categorias = Categoria::count();
            $subcategorias = SubCategorias::count();
            $novos = Empresa::whereBetween('created_at', [$ontem, $hoje])->count();
            return view('home', compact('clientes', 'anuncios', 'categorias', 'subcategorias', 'novos'));
        }
        
    }

    public function index()
    {   
        $dados = Site::find(1);
        $menus = MenuConfig::orderBy('ordem')->get();
        $anuncios = Empresa::orderBy(DB::raw('RAND()'))->limit(6)->get();
        return view('Site.welcome', compact('dados', 'anuncios', 'menus'));
    }

    public function categoria($alias)
    {
        $dados = Site::find(1);
        $menus = MenuConfig::orderBy('ordem')->get();
        $categoria = Categoria::where('alias', '=', $alias)->first();
        $subcategorias = SubCategorias::join('empresas', 'empresas.subcategoria_id', 'sub_categorias.id')
            ->select([
                'sub_categorias.id as categoria',
                'sub_categorias.img as img',
                'sub_categorias.alias as alias',
                'sub_categorias.nome as nome',
                'sub_categorias.descricao as descricao'
                ] )
            ->where('empresas.categoria_id', $categoria->id)
            ->groupBy('alias')
            ->orderBy('sub_categorias.nome', 'asc')
            ->get();
        $anuncios = Empresa::where('categoria_id', $categoria->id)->orderBy('nome', 'asc')->get();
        $breadcrumbs = [
            'home'      =>  '/',
            'categoria' =>  ucfirst($categoria->alias),
            'atual'     =>  ucfirst($categoria->alias)
        ];
        return view('Site.categoria', compact('dados', 'categoria', 'anuncios', 'subcategorias', 'breadcrumbs', 'menus'));
    }

    public function subcategoria($alias)
    {
        $dados = Site::find(1);
        $menus = MenuConfig::orderBy('ordem')->get();
        $categoria = SubCategorias::where('alias', '=', $alias)->first();
        $anuncios = Empresa::where('subcategoria_id', '=', $categoria->id)->orderBy('nome', 'asc')->get();
        $breadcrumbs = [
            'home'      =>  '/',
            'categoria' =>  ucfirst($categoria->categorias->alias),
            'atual'     =>  ucfirst($categoria->alias)
        ];
        return view('Site.categoria', compact('dados', 'categoria', 'anuncios', 'breadcrumbs', 'menus'));
    }

    public function categorias()
    {
        $dados = Site::find(1);
        $breadcrumbs = [
                'home'      =>  '/',
                'categoria' =>  'Categorias',
                'atual'     =>  'Categorias'
            ];
        
        $anuncios = Empresa::inRandomOrder()->paginate(3);
        $menus = MenuConfig::orderBy('ordem')->get();
        return view('Site.categorias', compact('dados', 'breadcrumbs', 'anuncios', 'menus'));
        
    }

    public function anuncio($alias)
    {
        $dados = Site::find(1);
        $anuncio = Empresa::where('alias', '=', $alias)->first();
        $anuncio->view = $anuncio->view + 1;
        $anuncio->update();

        $breadcrumbs = [
            'home'      =>  '/',
            'categoria' =>  ucfirst($anuncio->categorias->alias),
            'atual'     =>  $anuncio->nome
        ];
        $menus = MenuConfig::orderBy('ordem')->get();
        return view('Site.anuncio', compact('dados', 'anuncio', 'breadcrumbs', 'menus'));
    }

    public function like($id)
    {
        $anuncio = Empresa::find($id);
        $anuncio->like = $anuncio->like + 1;
        $anuncio->update();
        if($anuncio->getChanges()){
            flash('Obrigado por gostar de nosso post!')->success();
            return redirect()->back();
        }
    }

    public function sobre()
    {
        $dados = Site::find(1);
        $sobre = Site::first();
        $menus = MenuConfig::orderBy('ordem')->get();
        return view('Site.sobre', compact('sobre', 'dados', 'menus'));
    }

    public function search(Request $request)
    {
        $data = $request->all();
        $dados = Site::find(1);
        $resultados = Empresa::where('nome', 'like',  '%'. $data['busca'].'%')->orWhere('descricao', 'like', '%'.$data['busca'].'%')->get();
        $result = [
            'total'     =>  count($resultados),
            'palavra'   =>  $data['busca'],
        ];
        $menus = MenuConfig::orderBy('ordem')->get();
        return view('Site.resultado', compact('resultados', 'dados', 'result', 'menus'));
    }
}