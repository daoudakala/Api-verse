<?php
use App\Http\Controllers\Usercontroller; 
use App\Http\Controllers\VerseUsercontroller; 
use App\Http\Controllers\Authcontroller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::post("/user/inscription", [Usercontroller::class, "inscription"]);
//Route::post("/user/connexion", [Usercontroller::class, "connexion"]);

//Public routes 
Route::post('/register',[AuthController::class,"register"]);
Route::post('/login',[AuthController::class,"login"]);
Route::get('/verses',[VerseUserController::class,"index"]);
Route::get('/verses/search/{year}',[VerseUserController::class,"search"]); 
Route::get('/verses/{id}',[VerseUserController::class,"show"]);
//Protected routes 

Route::group(["middleware" =>['auth:sanctum']], function(){
    Route::post('/verses',[VerseUserController::class,"store"]);
    Route::put('/verses/{id}',[VerseUserController::class,"update"]);
    Route::delete('/verses/{id}',[VerseUserController::class,"destroy"]);
    Route::post('/logout',[AuthController::class,"logout"]);
});

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
