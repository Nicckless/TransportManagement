<?php

use App\Http\Controllers\TruckController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/user',function(Request $request){

});

Route::get('/test',function(){
    return response()->json([
        'message'=>'Everything Ok'
    ]);
});

//Worker Endpoints

Route::post('/login',[UserController::class,'Login']);

Route::post('/logout',[UserController::class,'Logout']);

Route::get('/allWorkers',[UserController::class,'GetAllWorkers']);

Route::get('/getWorker/{id}',[UserController::class,'GetWorkerById']);

Route::delete('/worker/{id}',[UserController::class,'RemoveWorkerById']);

Route::post('/createWorker',[UserController::class,'CreateUser']);

//Truck Endpoints

Route::post('/registerTruck',[TruckController::class,'CreateTruck']);

Route::get('/allTrucks',[TruckController::class,'GetAllTrucks']);

Route::delete('/truck/{id}',[TruckController::class,'RemoveTruckById']);

Route::patch('/truck/{id}',[TruckController::class,'ChangeTruckInfo']);