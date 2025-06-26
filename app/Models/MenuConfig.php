<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuConfig extends Model
{
    use HasFactory;
    
    protected $table = "menu_configs";
    protected $fillable = ['categoria_id', 'alias', 'exibe_menu', 'exibe_home', 'ordem'];
    
    public function categorias()
    {
        return $this->belongsTo(CatBlog::class, 'categoria_id', 'id');
    }

    public function newInfo($data)
    {
        $info = $this->create($data);
        return $info;
    }

    public function updateInfo($data)
    {
        $info = $this->update($data);
        return $info;
    }

    public function deleteInfo()
    {
        $info = $this->delete();
        return $info;
    }
}