<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Notifications\Notification;
use App\Notifications\NewClient;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    
    use RegistersUsers;
    
    /**
    * Where to redirect users after registration.
    *
    * @var string
    */
    protected $redirectTo = '/admin';
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function register(Request $request)
    {
        return redirect()->route('home');
        $data = $request->all();
        if(($data['valorA'] + $data['valorB']) != $data['valorC']){
            flash('Valor da Verificação nao confere')->error();
            return redirect()->back()->withInput();
        }

        $email = explode("@", $data['email']);
        $email2 = explode(".", $email[1]);
        // dd($email2);

        
        if(isset($email2[1]) && $email2[1] != "com"){
            flash('Confira seu e-mail, aparentemente ele é um span')->error();
            return redirect()->back()->withInput();
        }

        if(isset($email2[2]) && $email2[2] != "br"){
            flash('Confira seu e-mail, aparentemente ele é um span')->error();
            return redirect()->back()->withInput();
        }
        
        $this->validator($request->all())->validate();
        
        event(new Registered($user = $this->create($request->all())));
        
        $this->guard()->login($user);
        
        return $this->registered($request, $user)
        ?: redirect($this->redirectPath());
    }
    
    /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function validator(array $data)
    {   
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );
    }
    
    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\User
    */
    protected function create(array $data)
    {
        $role = Role::where('name', '=','Cliente')->first();
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            ]
        );
        
        $user->roles()->attach($role);
        
        \Notification::send($user, new NewClient("Novo Usuário Cadastrado no sistema!"));
        
        return $user;
    }
}
