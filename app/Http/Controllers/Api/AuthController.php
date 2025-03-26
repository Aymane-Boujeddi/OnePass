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



    public function login(Request $request){
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'The email or password you entered is incorrect'
            ], 401);
        }

        $ipAddress = $request->ip();

        //cet ip pour tester l accés des autres appreil
        //$ipAddress="127.0.0.21";

        $appareil = AdressIp::where('adressIP', $ipAddress)
                            ->where('user_id', $user->id)
                            ->first();
        

        
        if ($appareil && $appareil->etat === 'liste_blanche') {
            $token = $user->createToken('auth-token')->plainTextToken;
            return [
                'message' => 'Logged in successfully',
                'user' => $user,
                'token' => $token
            ];
            
        }

        
        if (!$appareil) {
            $appareil = AdressIp::create([
                'adressIP' => $ipAddress,
                'nameAppareil' => 'Nouvel appareil',
                'etat' => 'en_Attente',
                'user_id' => $user->id
            ]);
           // return response()->json([$appareil]);
            

            
            Mail::to($user->email)->send(new NewDeviceNotification($appareil));
            
            return response([
                'message' => 'Nouvel appareil détecté. Veuillez confirmer via l’e-mail envoyé.'
            ], 403);
        }

        
        if ($appareil->etat === 'liste_noir') {
            return response([
                'message' => 'Accès refusé. Contactez le support.'
            ], 403);
        }

        return response([
            'message' => 'Votre appareil est en attente de validation. Veuillez vérifier votre e-mail.'
        ], 403);
    }

    public function logout(Request $request)
{
    $request->user()->tokens()->delete();
    return [
        'message'=>'logged out successfully'
    ];
}

}
