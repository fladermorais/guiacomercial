<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Site;
use App\Models\SubCategorias;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function logado()
    {
        // dd(auth()->user());
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

            // dd($clientes, $anuncios, $categorias, $subcategorias);

            return view('home', compact('clientes', 'anuncios', 'categorias', 'subcategorias', 'novos'));
        }
        
    }



    

    public function index()
    {   
        $dados = Site::find(1);
        // $anuncios = Empresa::all()->random()->limit(6)->get();
        $anuncios = Empresa::orderBy(DB::raw('RAND()'))->limit(6)->get();
        return view('Site.welcome', compact('dados', 'anuncios'));
    }

    public function categoria($alias)
    {
        $dados = Site::find(1);
        $categoria = Categoria::where('alias', '=', $alias)->first();
        // $subcategorias = SubCategorias::where('categoria_id', '=', $categoria->id)->get();
        // dd($subcategorias);
        $subcategorias = SubCategorias::join('empresas', 'empresas.subcategoria_id', 'sub_categorias.id')
            ->select([
                // DB::raw('count(*) as total'),
                'sub_categorias.id as categoria',
                'sub_categorias.img as img',
                'sub_categorias.alias as alias',
                'sub_categorias.nome as nome',
                'sub_categorias.descricao as descricao'
                ] )
            ->where('empresas.categoria_id', $categoria->id)
            ->groupBy('alias')
            ->orderBy('sub_categorias.nome', 'asc')
            // ->groupBy('categoria', 'img', 'alias', 'nome', 'descricao')
            ->get();
            // dd($subcategorias);
        $anuncios = Empresa::where('categoria_id', $categoria->id)->orderBy('nome', 'asc')->get();
        $breadcrumbs = [
            'home'      =>  '/',
            'categoria' =>  ucfirst($categoria->alias),
            'atual'     =>  ucfirst($categoria->alias)
        ];
        // dd($breadcrumbs);
        return view('Site.categoria', compact('dados', 'categoria', 'anuncios', 'subcategorias', 'breadcrumbs'));
        // dd($categoria);
    }

    public function subcategoria($alias)
    {
        $dados = Site::find(1);
        $categoria = SubCategorias::where('alias', '=', $alias)->first();
        $anuncios = Empresa::where('subcategoria_id', '=', $categoria->id)->orderBy('nome', 'asc')->get();
        $breadcrumbs = [
            'home'      =>  '/',
            'categoria' =>  ucfirst($categoria->categorias->alias),
            'atual'     =>  ucfirst($categoria->alias)
        ];
        // dd($breadcrumbs);
        return view('Site.categoria', compact('dados', 'categoria', 'anuncios', 'breadcrumbs'));
    }

    public function categorias()
    {
        $dados = Site::find(1);
        // $categorias = Categoria::join('empresas', 'empresas.categoria_id', 'categorias.id')->select([
        //     DB::raw('count(*) as total'),
        //     'categorias.id as categoria',
        //     'categorias.img as img',
        //     'categorias.alias as alias',
        //     'categorias.nome as nome',
        //     'categorias.descricao as descricao'
        //     ] )
        //     ->orderBy('categorias.nome', 'asc')
        //     ->groupBy('categoria', 'img', 'alias', 'nome', 'descricao')
        //     ->get();
        
        // dd($categorias);
        $breadcrumbs = [
                'home'      =>  '/',
                'categoria' =>  'Categorias',
                'atual'     =>  'Categorias'
            ];
        // dd($breadcrumbs);
        // $categorias = Categoria::orderBy('nome', 'asc')->get();
        
        $anuncios = Empresa::inRandomOrder()->paginate(3);

        return view('Site.categorias', compact('dados', 'breadcrumbs', 'anuncios'));
        
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
        
        return view('Site.anuncio', compact('dados', 'anuncio', 'breadcrumbs'));
        // dd($anuncio);
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
        return view('Site.sobre', compact('sobre', 'dados'));
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
        return view('Site.resultado', compact('resultados', 'dados', 'result'));
        dd($resultados);
        
        
    }
}