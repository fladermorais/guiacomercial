<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        // Anuncios
        Permission::firstOrCreate([
            "name"  =>  "empresas.index",
            "description"   =>  "Anúncios - Listar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "empresas.create",
            "description"   =>  "Anúncios - Criar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "empresas.edit",
            "description"   =>  "Anúncios - Editar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "empresas.delete",
            "description"   =>  "Anúncios - Remover",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "empresas.alterClient",
            "description"   =>  "Anúncios - Alterar o Usuário",
            ]
        );
        
        // Cargos
        Permission::firstOrCreate([
            "name"  =>  "roles.index",
            "description"   =>  "Cargos - Listar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "roles.create",
            "description"   =>  "Cargos - Criar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "roles.edit",
            "description"   =>  "Cargos - Editar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "roles.delete",
            "description"   =>  "Cargos - Remover",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "rolePermission.delete",
            "description"   =>  "Cargos - Relacionamento com Permissões - Deletar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "rolePermission.edit",
            "description"   =>  "Cargos - Relacionamento com Permissões - Editar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "rolePermission.index",
            "description"   =>  "Cargos - Relacionamento com Permissões - Listar",
            ]
        );
        
        
        // Categorias
        Permission::firstOrCreate([
            "name"  =>  "categorias.active",
            "description"   =>  "Categorias - Ativar/Desativar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "categorias.create",
            "description"   =>  "Categorias - Criar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "categorias.edit",
            "description"   =>  "Categorias - Editar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "categorias.index",
            "description"   =>  "Categorias - Listar",
            ]
        );
        
        
        
        // Permissões
        Permission::firstOrCreate([
            "name"  =>  "permissions.index",
            "description"   =>  "Permissões - Listar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "permissions.create",
            "description"   =>  "Permissões - Criar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "permissions.edit",
            "description"   =>  "Permissões - Editar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "permissions.delete",
            "description"   =>  "Permissões - Remover",
            ]
        );
        
        
        //Sites
        Permission::firstOrCreate([
            "name"  =>  "sites.index",
            "description"   =>  "Site - Informações básicas do Site",
            ]
        );
        
        
        // Categorias
        Permission::firstOrCreate([
            "name"  =>  "subCategorias.active",
            "description"   =>  "Sub Categorias - Ativar/Desativar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "subCategorias.create",
            "description"   =>  "Sub Categorias - Criar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "subCategorias.edit",
            "description"   =>  "Sub Categorias - Editar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "subCategorias.index",
            "description"   =>  "Sub Categorias - Listar",
            ]
        );
        
        
        // Usuários
        Permission::firstOrCreate([
            "name"  =>  "usuarios.index",
            "description"   =>  "Usuários - Listar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "usuarios.create",
            "description"   =>  "Usuários - Criar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "usuarios.edit",
            "description"   =>  "Usuários - Editar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "usuarios.delete",
            "description"   =>  "Usuários - Deletar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "userRoles.delete",
            "description"   =>  "Usuários - Deletar Cargos",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "userRoles.index",
            "description"   =>  "Usuários - Listar Cargos",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "userRoles.store",
            "description"   =>  "Usuários - Criar Cargos",
            ]
        );
        
        // Galeria de Fotos
        Permission::firstOrCreate([
            "name"  =>  "galeria.index",
            "description"   =>  "Galeria de Fotos - Listar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "galeria.store",
            "description"   =>  "Galeria de Fotos - Fazer upload de fotos",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "galeria.delete",
            "description"   =>  "Galeria de Fotos - Remover foto",
            ]
        );
        
        // Categorias de Notícias
        Permission::firstOrCreate([
            "name"  =>  "categoriaBlog.index",
            "description"   =>  "Categoria Blog - Listar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "categoriaBlog.create",
            "description"   =>  "Categoria Blog - Criar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "categoriaBlog.edit",
            "description"   =>  "Categoria Blog - Editar",
            ]
        );

        // Notícias
        Permission::firstOrCreate([
            "name"  =>  "noticias.index",
            "description"   =>  "Notícias - Listar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "noticias.create",
            "description"   =>  "Notícias - Criar",
            ]
        );
        Permission::firstOrCreate([
            "name"  =>  "noticias.edit",
            "description"   =>  "Notícias - Editar",
            ]
        );
    }
}