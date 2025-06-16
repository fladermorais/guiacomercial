<?php

namespace App\Models;

use App\Traits\UploadArquivoTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SubCategorias extends Model
{
    
    use Notifiable;
    
    protected $fillable = [
        'categoria_id', 
        'nome', 
        'alias', 
        'descricao', 
        'img', 
        'status'
    ];
    protected $table = 'sub_categorias';
    
    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    
    public function newInfo($data)
    {
        $trait = new UploadArquivoTrait;
        $data['alias'] = $trait->getAlias($data['nome']);
        $data['status'] = "sim";
        $info = $this->create($data);
        return $info;
    }
    
    public function updateInfo($data)
    {
        if(isset($data['nome'])){
            $trait = new UploadArquivoTrait;
            $data['alias'] = $trait->getAlias($data['nome']);
        }
        $info = $this->update($data);
        return $info;
    }
    
    public function routeNotificationForSlack($notification)
    {
        return config('app.slack');
    }
    
}
