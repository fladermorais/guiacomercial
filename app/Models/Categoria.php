<?php

namespace App\Models;

use App\Traits\UploadArquivoTrait;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nome', 
        'alias', 
        'descricao', 
        'img',
        'status',
    ];
    
    public function newInfo($data)
    {
        // dd($data);
        $uploadArquivo = new UploadArquivoTrait;
        $alias = $uploadArquivo->getAlias($data['nome']);
        $data['img']    = $uploadArquivo->uploadArquivo($data['imagem'], $alias, "categorias");
        $data['alias']  = $alias;
        
        $info = $this->create($data);
        return $info;
    }
    
    public function updateInfo($data)
    {
        $uploadArquivo = new UploadArquivoTrait;
        if(isset($data['imagem'])){
            $alias = $uploadArquivo->getAlias($data['nome']);
            $data['alias']  = $alias;
            
            $remove = $uploadArquivo->unlinkArquivo($this->img, 'categorias');
            
            $data['img']    = $uploadArquivo->uploadArquivo($data['imagem'], $alias, "categorias");
        }
        
        $info = $this->update($data);
        return $info;
    }
}
