<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password'
    ];
    
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // Relacionamentos
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    // Funçoes para criar, verificar e excluir permissões
    public function isAdmin()
    {
        return $this->existRole('Administrador');
    }
    
    public function addRole($role)
    {
        if(is_string($role)){
            $role = Role::where('name', '=', $role)->firstOrFail();
        }
        
        if($this->existRole($role)){
            return;
        }
        
        return $this->roles()->attach($role);
    }
    
    public function existRole($role)
    {
        if(is_string($role)){
            $role = Role::where('name', '=', $role)->firstOrFail();
        }
        
        return (boolean) $this->roles()->find($role->id);
    }
    
    public function removeRole($role)
    {
        if(is_string($role)){
            $role = Role::where('name', '=', $role)->firstOrFail();
        }
        
        return $this->roles()->detach($role);
    }
    
    public function haveRole($roles)
    {
        $userCharges = $this->roles;        
        return $roles->intersect($userCharges)->count();
    }
    
    public function routeNotificationForSlack($notification)
    {
        return "https://hooks.slack.com/services/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";
    }
}