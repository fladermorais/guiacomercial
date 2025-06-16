<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteUpdateRequest;
use App\Models\Site;

class SiteController extends Controller
{
    public function index()
    {
        $dados = Site::find(1);
        return view('Admin.sites.edit', compact('dados'));
    }

    public function update(SiteUpdateRequest $request)
    {
        $data = $request->all();

        $dados = Site::find(1);
                
        $response = $dados->updateInfo($data);
        if($response){
            flash('Dados atualizados com sucesso!')->success();
            return redirect()->route('sites.index');
        } else {
            flash('Nenhuma mudança realizada')->warning();
            return redirect()->route('sites.index');
        }
    }
}