<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }
  public function register_process(Request $request){
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6'
    ]);

    $data['name'] = $request->name;
    $data['email'] = $request->email;
    $data['password'] = Hash::make($request->password);

    User::create($data);

    $login = [
      'email' => $request->email,
      'password' => $request->password
    ];

    if(Auth::attempt($login)){
      return redirect()->route('admin.dashboard-analytics');
    } else{
      return redirect()->route('auth-login-basic')->with('failed', 'Wrong email or password');
    }
  }
}
