<?php

namespace App\Models;

use App\Traits\UploadArquivoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriaFoto extends Model
{
    use HasFactory;
    
    protected $table = 'galeria_fotos';
    
    protected $fillable = ['empresa_id', 'titulo', 'path'];
    
    public function newInfo($files, $empresa)
    {
        $count = 0;
        foreach($files['images'] as $file){
            $trait = new UploadArquivoTrait;
            
            $titulo = $trait->getAlias($empresa->id . "_" . date('Hmis') . "_" . $count + 1);
            $info = ([
                'empresa_id'    =>  $empresa->id,
                'titulo'        =>  $titulo,
                'path'          =>  $trait->uploadArquivo($file, $titulo, 'galeria'),
            ]);
            
            $criar = $this->create($info);
            if($criar){
                $count ++;
            }
        }
        return $count;
    }
    
    public function deleteInfo()
    {
        $trait = new UploadArquivoTrait;
        $remove = $trait->unlinkArquivo($this->path, 'galeria');
        $this->delete();
        return $remove;
    }
}