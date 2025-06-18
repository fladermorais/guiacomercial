<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GaleriaFotosRequest;
use App\Models\Empresa;
use App\Models\GaleriaFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GaleriaFotosController extends Controller
{
    public function show(Empresa $empresa)
    {
        return view('Admin.empresas.galeria', compact('empresa'));
    }
    
    public function store(GaleriaFotosRequest $request, Empresa $empresa)
    {
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
        $response = $galeria->deleteInfo();
        if($response){
            flash('Foto excluída com sucesso!')->success();
            return back();
        }
    }
}