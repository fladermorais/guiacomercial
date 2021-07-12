<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nome', 
        'alias', 
        'descricao', 
        'img',
    ];
    
    public function geraAlias( $str ) 
    {
        $palavra1 = strtr(utf8_decode($str),utf8_decode("ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ"),"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
        $palavra1 = str_replace(' ', '_', $palavra1);
        $palavra1 = strtolower($palavra1);
        return $palavra1;
    }
}
