<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Http\Reponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function register(Request $request){

        $userdata = $request ->validate([
            "name" => ["required", "string", "min:4", "max:255"],
            "email"=> ["required", "email", "unique:users,email"],
            "first_name" => ["required", "string", "min:4", "max:255"],
            "city" => ["required", "string", "min:2", "max:255"],
            "country" => ["required", "string", "min:4", "max:255"],
            "username" => ["required", "string", "min:4", "max:255"],
            "password" => ["required", "string", "min:4", "max:20", "confirmed"]
           ]);

           $user = User::create([
            
            "name" =>$userdata["name"],
            "email" =>$userdata["email"],
            "first_name" =>$userdata["first_name"],
            "city" =>$userdata["city"],
            "country" =>$userdata["country"],
            "username" =>$userdata["username"],
            "password" =>bcrypt($userdata["password"])
            
           ]);

           $token = $user->createToken('myAppToken')->plainTextToken;

           $response = [
            'user' =>$user, 
            'token' =>$token
           ];
           return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message'=>'Déconnexion'
        ];
    }


    public function login(Request $request){
        // faire un choix entre l'email et le username 
        $userdata = $request ->validate([
            "email"=> ["required", "email"],
            "password" => ["required", "string"]
           ]);

           //Verification de l'email 
           $user = User::where('email',$userdata['email'])->first();

           //Vérification du mot de passe 
           if(!$user || !Hash::check($userdata['password'], $user->password)){
            return response([
                'message'=> 'Bad credentials'
            ],401);
           }

           $token = $user->createToken('myAppToken')->plainTextToken;

           $response = [
            'user' =>$user, 
            'token' =>$token
           ];
           return response($response, 201);
    }

} //fin de la classe 
