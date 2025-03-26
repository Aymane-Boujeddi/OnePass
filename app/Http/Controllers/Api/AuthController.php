<?php


namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\AdressIp;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewDeviceNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Mail;
use App\Mail\WarningEmail;

class AuthController extends Controller
{
 
    public function register(Request $request){
        $data=$request->validate([
            'name'=>['required','string'],
            'email'=>['required','email','unique:users'],
            'password'=>['required','min:8']

        ]);
        $ipAddress=$request->ip();
        $user=User::create($data);

        AdressIp::create([
            'adressIP' => $ipAddress,
            'nameAppareil' => 'Appareil principal',
            'etat' => 'liste_blanche',
            'user_id' => $user->id
        ]);

        $token = $user->createToken('auth-token')->plainTextToken;
        return [
            'message'=>'registered successfully',
            'user'=> $user,
            'token'=>$token
        ];
    }

    
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);
    
        $key = 'login-attempts:' . $request->ip();
        $maxAttempts = 10;
        $BlockDuration = 60;
    
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);

            if (!cache()->has($key . ':email_sent')) {
                Mail::to($data['email'])->send(new WarningEmail());
                cache()->put($key . ':email_sent', true, $seconds);
            }

            return response()->json([
                'message' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.'
            ], 429);
        }
    
    
        $user = User::where('email', $data['email'])->first();
    
        if (!$user || !Hash::check($data['password'], $user->password)) {
            RateLimiter::hit($key, $BlockDuration * 60); 
    
            return response([
                'message' => 'The email or password you entered is incorrect'
            ], 401); 
        }
    
        $token = $user->createToken('auth-token')->plainTextToken;
        RateLimiter::clear($key);

        return response()->json([
            'message' => 'Logged in successfully',
            'user' => $user,
            'token' => $token
        ]);
    }
    

    public function logout(Request $request)
{
    $request->user()->tokens()->delete();
    return [
        'message'=>'logged out successfully'
    ];
}

}
