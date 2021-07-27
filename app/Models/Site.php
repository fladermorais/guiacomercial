<?php

namespace App\Models;

use App\Traits\UploadArquivoTrait;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = "sites";
    
    protected $fillable = [
        'logo', 
        'nome', 
        'quem_somos', 
        'titulo', 
        'mensagem', 
    ];
    
    public function updateInfo($data)
    {
        $trait = new UploadArquivoTrait;

        if(isset($data['logo'])){
            $remove = $trait->unlinkArquivo($this->logo, 'logo');
            $alias = $trait->getAlias($data['nome']);
            $data['logo'] = $trait->uploadArquivo($data['logo'], $alias, 'logo');
        }
        $info = $this->update($data);
        return $info;
    }
}
