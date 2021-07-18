<?php

namespace App\Models;

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
}
