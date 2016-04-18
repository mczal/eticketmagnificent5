<?php

namespace App\Http\Controllers\api;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller{

  public function authenticate(Request $request){

    $this->validate($request, [
      'username' => 'required',
      'password' => 'required',
    ]);

    $user = User::where('username' , $request->username);
    if($user == null || $user == ''){
      return response()->json([
        'error' => 'error',
        'message' => 'no user',
      ]);
    }else{
      //check user nya nih
    }

  }

}
