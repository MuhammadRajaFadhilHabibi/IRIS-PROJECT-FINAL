<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //

    public function index()
    {
        return view('regist');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|unique:users,name',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255'
        ]);

        User::create([
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return view('login');

        
    }
}
