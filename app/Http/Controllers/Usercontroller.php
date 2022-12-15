<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    //
    public function inscription (Request $request){
        $userdata = $request ->validate([
            "name" => ["required", "string", "min:4", "max:255"],
            "email"=> ["required", "email", "unique:users,email"],
            "first_name" => ["required", "string", "min:4", "max:255"],
            "city" => ["required", "string", "min:2", "max:255"],
            "country" => ["required", "string", "min:4", "max:255"],
            "username" => ["required", "string", "min:4", "max:255"],
            "password" => ["required", "string", "min:4", "max:20", "confirmed"]
           ]);
    
           $utilisateur = User::create([
            "name" =>$userdata["name"],
            "email" =>$userdata["email"],
            "first_name " =>$userdata["first_name"],
            "city" =>$userdata["city"],
            "country" =>$userdata["country"],
            "username" =>$userdata["username"],
            "password" =>bcrypt($userdata["password"])
            
           ]);
           return response($utilisateur, 201);

           
    }

    public function connexion(Request $request){
        $userdata = $request ->validate([
            "name" => ["required", "string", "min:4", "max:255"],
            "email"=> ["required", "email"],
            "username" => ["required", "string", "min:4", "max:255"],
            "password" => ["required", "string", "min:4", "max:20"]
           ]);
           $utilisateur= User::where("email",$userdata["email"])->first();
           if(!$utilisateur) return response(["message" => "Aucun utilisateur trouvé avec cet adresse e-mail $userdata[email]"],401);
           if(!Hash::check($userdata["password"],$utilisateur->password)){
            return response(["message" => "Aucun utilisateur trouvé avec ce mot de passe"],401);
           } 
           $token = $utilisateur->createToken("CLE_SECRETE")->plainTextToken; 
           return response([
            "utilisateur"=>$utilisateur,
            "token" => $token
           ],200);
       }
}

