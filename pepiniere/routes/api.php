<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PlanteController;
use App\Http\Controllers\CommandeController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::group(['middleware'=>'api'],function($router){
//     Route::post('/register',[AuthController::class,'register']);
//     Route::post('/login',[AuthController::class,'login']);

//     });



    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/store', [CategorieController::class, 'store']);
    Route::post('/plantes', [PlanteController::class, 'storePlante']);
     // jai utilsé ici un middelware pour verifier si il est authentifié //
    Route::middleware(['check.auth'])->get('/categories', [CategorieController::class, 'afficherCategorie']);

    Route::get('/getplantes/{categorie_id}', [PlanteController::class, 'afficherPlantes']);
    Route::middleware(['check.role:admin'])->put('/modifierCategorie/{id}', [CategorieController::class, 'modifierCategorie']);
    Route::middleware(['check.role:admin'])->put('/modifierPlante/{id}', [PlanteController::class, 'modifierPlante']);
    Route::middleware(['check.role:admin'])->delete('/supprimerCategorie/{id}', [CategorieController::class, 'supprimerCategorie']);
    Route::middleware(['check.role:admin'])->delete('/supprimerPlante/{id}', [PlanteController::class, 'supprimerPlante']);
    Route::get('/afficherPlanteDetailles/{slug}',[PlanteController::class,'afficherPlanteDetailles']);
    Route::middleware(['check.auth'])->post('/AjouterCommande/{slug}',[CommandeController::class,'AjouterCommande']);


    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    
  






















    Route::middleware(['check.auth'])->get('/verifierr/{id}',[CommandeController::class,'verifierr']);



















    Route::middleware(['check.auth'])->delete('/annuler/{id}',[CommandeController::class,'annuler']);
    Route::middleware(['check.role:employe'])->post('/ChangerStatus/{id}',[CommandeController::class,'ChangerStatus']);