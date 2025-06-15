<?php

namespace App;

use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password', 'quantidade'
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
        return config('app.slack');
    }
    
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];
    }
    
    public function rulesUpdate()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->id)]
        ];
    }
    
    public function newInfo($data)
    {
        $data['password'] = Hash::make($data['password']);
        $info = $this->create($data);
        return $info;
    }
    
    public function updateInfo($data)
    {
        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $info = $this->update($data);
        return $info;
    }
}
