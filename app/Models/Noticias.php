<?php

namespace App\Models;

use App\Services\UploadFileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    use HasFactory;
    
    protected $fillable = ['alias', 'titulo', 'categoria_id', 'imagem', 'referencia', 'linkExterno', 'descricao', 'views', 'status', 'user_id', 'seo_titulo', 'seo_keywords', 'seo_canonical', 'seo_descricao' ];
    
    public function categorias()
    {
        return $this->belongsTo(CatBlog::class, 'categoria_id', 'id');
    }

    public function newInfo($data)
    {
        $data['alias']      = UploadFileService::getAlias($data['titulo']);
        $data['user_id']    = auth()->user()->id;
        $data['imagem']     = UploadFileService::uploadArquivo($data['arquivo'], $data['alias'], 'noticias');
        $data['views']      = 0;
        $data['seo_canonical'] = route('noticias.index', $data['alias']);

        $info = $this->create($data);
        return $info;
    }

    public function updateInfo($data)
    {
        $data['alias']      = UploadFileService::getAlias($data['titulo']);
        if(isset($data['arquivo'])){
            $removeImagem = UploadFileService::unlinkArquivo($this->imagem, 'noticias');
            $data['imagem']     = UploadFileService::uploadArquivo($data['arquivo'], $data['alias'], 'noticias');
        } else {
            unset($data['imagem']);
            unset($data['arquivo']);
        }
        $data['seo_canonical'] = route('noticias.index', $data['alias']);
        $info = $this->update($data);
        return $info;
    }
}