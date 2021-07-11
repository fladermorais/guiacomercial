<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ImpersonateController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        if($user){
            session()->put('impersonate', $user->id);
        }
        return redirect()->route('logado');
    }

    public function destroy()
    {
        session()->forget('impersonate');
        return redirect()->route('logado');
    }
}
