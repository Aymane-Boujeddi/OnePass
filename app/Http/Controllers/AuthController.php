<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $data=$request->validate([
            'name'=>['required','string'],
            'email'=>['required','email','unique:users'],
            'password'=>['required','min:8']

        ]);
        $user=User::create($data);
        $token = $user->createToken('auth-token')->plainTextToken;
        return [
            'message'=>'registered successfully',
            'user'=> $user,
            'token'=>$token
        ];
    }



    public function login(Request $request){
        $data=$request->validate([
            'email'=>['required','email'],
            'password'=>['required','min:8']

        ]);
        $user=User::where('email',$data['email'])->first(); 
       
        if(!$user || !Hash::check($data['password'], $user->password)){
            return response([
                'message'=>'The email or password you entered is incorrect'
            ],401);
        }
        $token = $user->createToken('auth-token')->plainTextToken;
        return [
            'message'=>'logged in successfully',
            'user'=> $user,
            'token'=>$token
        ];
    }

    public function logout(Request $request)
{
    $request->user()->tokens()->delete();
    return [
        'message'=>'logged out successfully'
    ];
}

}
