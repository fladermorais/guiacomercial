<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatBlog extends Model
{
    use HasFactory;
    protected $table = 'cat_blogs';
    protected $fillable = ['titulo', 'status'];

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

    public function active()
    {
        $data = [
            "status"    =>  'A'
        ];
        $this->update($data);
    }

    public function inactive()
    {
        $data = [
            "status"    =>  'I'
        ];
        $this->update($data);
    }
}