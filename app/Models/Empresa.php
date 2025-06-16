<?php

namespace App\Models;

use App\Traits\UploadArquivoTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Empresa extends Model
{
    use Notifiable;
    
    protected $fillable = [
        'user_id', 
        'categoria_id', 
        'subcategoria_id',
        'nome', 
        'alias', 
        'img', 
        'email', 
        'telefone', 
        'whatsapp', 
        'descricao', 
        'endereco', 
        'bairro', 
        'cidade', 
        'estado', 
        'cep', 
        'horario_atendimento', 
        'site', 
        'facebook', 
        'instagran', 
        'view', 
        'like', 
        'foto', 
        'segunda', 
        'segunda_final',
        'terca',
        'terca_final',
        'quarta',
        'quarta_final',
        'quinta',
        'quinta_final',
        'sexta',
        'sexta_final',
        'sabado',
        'sabado_final',
        'domingo',
        'domingo_final',
        'feriado',
        'feriado_final',
    ];
    
    public function geraAlias( $str ) 
    {
        $palavra1 = strtr(utf8_decode($str),utf8_decode("ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ"),"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
        $palavra1 = str_replace(' ', '_', $palavra1);
        $palavra1 = strtolower($palavra1);
        return $palavra1;
    }
    
    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    
    public function subcategorias()
    {
        return $this->belongsTo(SubCategorias::class, 'subcategoria_id');
    }
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function routeNotificationForSlack($notification)
    {
        return config('app.slack');
    }
    
    public function updateInfo($data)
    {
        $trait = new UploadArquivoTrait;
        
        $data['categoria_id'] = $data['categoria'];
        
        (isset($data['subcategoria']) ? $data['subcategoria_id'] = $data['subcategoria'] : "");
        $data['alias']          =   $trait->getAlias($data['nome']);
        
        if(isset($data['logo'])){
            $remover = $trait->unlinkArquivo($this->img, 'logo');
            $data['img'] = $trait->uploadArquivo($data['logo'], $data['alias'], 'logo');
        } 
        
        if(isset($data['imagem'])){
            $remover = $trait->unlinkArquivo($this->foto, 'imagem');
            $data['foto'] = $trait->uploadArquivo($data['imagem'], $data['alias'], 'imagem');
        } 
        
        $info = $this->update($data);
        return $info;
    }
    
    public function newInfo($data)
    {
        $trait = new UploadArquivoTrait;
        
        $data['user_id'] = auth()->user()->id;
        $data['categoria_id'] = $data['categoria'];
        (isset($data['subcategoria']) ? $data['subcategoria_id'] = $data['subcategoria'] : "");
        $data['alias']          =   $trait->getAlias($data['nome']);
        $data['view'] = 0;
        $data['like'] = 0;
        
        if(isset($data['logo'])){
            $data['img'] = $trait->uploadArquivo($data['logo'], $data['alias'], 'logo');
        } 
        
        if(isset($data['imagem'])){
            $data['foto'] = $trait->uploadArquivo($data['imagem'], $data['alias'], 'imagem');
        } 
        
        $info = $this->create($data);
        return $info;
    }
    
    public function deleteInfo()
    {
        $trait = new UploadArquivoTrait;
        // Apagando a Logo
        $removerImg = $trait->unlinkArquivo($this->img, 'logo');
        
        // Apagando a Imagem
        $removerFoto = $trait->unlinkArquivo($this->foto, 'imagem');
        
        $info = $this->delete();
        
        return $info;
    }
}