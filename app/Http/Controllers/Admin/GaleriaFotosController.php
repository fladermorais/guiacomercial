<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GaleriaFotosRequest;
use App\Models\Empresa;
use App\Models\GaleriaFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class GaleriaFotosController extends Controller
{
    public function show(Empresa $empresa)
    {
        if(Gate::denies('galeria.index')){
            abort(403, "Não Autorizado");
        }
        return view('Admin.empresas.galeria', compact('empresa'));
    }
    
    public function store(GaleriaFotosRequest $request, Empresa $empresa)
    {
        if(Gate::denies('galeria.store')){
            abort(403, "Não Autorizado");
        }
        $data = $request->all();
        
        $galeria = new GaleriaFoto;
        $response = $galeria->newInfo($data, $empresa);
        if($response){
            flash('Foram adicionadas: ' . $response . ' novas fotos')->success();
            return redirect()->route('galeria.show', $empresa);
        }
    }

    public function destroy(GaleriaFoto $galeria)
    {
        if(Gate::denies('galeria.delete')){
            abort(403, "Não Autorizado");
        }
        $response = $galeria->deleteInfo();
        if($response){
            flash('Foto excluída com sucesso!')->success();
            return back();
        }
    }
}