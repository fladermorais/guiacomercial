<?php

namespace App;

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



    public function geraAlias( $str ) 
    {
        $palavra1 = strtr(utf8_decode($str),utf8_decode("ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ"),"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
        $palavra1 = str_replace(' ', '_', $palavra1);
        $palavra1 = strtolower($palavra1);
        return $palavra1;
    }

    public function routeNotificationForSlack($notification)
    {
        return config('app.slack');
    }

}