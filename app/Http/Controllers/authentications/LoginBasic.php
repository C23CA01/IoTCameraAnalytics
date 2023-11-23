<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function login_process(Request $request){
    $request->validate([
      'email' => 'required',
      'password' => 'required',
    ]);
    $data = [
      'email' => $request->email,
      'password' => $request->password
    ];

    if(Auth::attempt($data)){
      return redirect()->route('admin.dashboard-analytics');
    } else{
      return redirect()->route('auth-login-basic')->with('failed', 'Wrong email or password');
    }
  }

  public function logout(){
    Auth::logout();
    return redirect()->route('auth-login-basic');
  }
}
