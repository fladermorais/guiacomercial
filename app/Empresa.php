<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Empresa extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id', 
        'categoria_id', 
        'nome', 
        'alias', 
        'img', 
        'email', 
        'telefone', 
        'whatsapp', 
        'descricao', 
        'endereco', 
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
        return "https://hooks.slack.com/services/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";
    }
    
    public function updateInfo($data)
    {
        $info = $this->update($data);
        return $info;
    }
}
