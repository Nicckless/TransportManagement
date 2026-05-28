<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function Login(Request $request){
        $credentials = $request->validate([
            'name'=>['required','string'],
            'password'=>['required']
        ]);

        $worker = Worker::where('name', $credentials['name'])->first();

        if(!$worker || !Hash::check($credentials['password'],$worker->password)){
            return response()->json([
                'message'=>'Invalid Credentials'
            ],401);
        }
        // if(!Auth::guard('worker')->attempt($credentials)){
        //     return response()->json([
        //         'message'=>'Invalid Credentials'
        //     ],401);
        // }

        // $user = Auth::guard('worker')->user();

        $token = $worker->createToken('api-token')->plainTextToken;

        return response()->json([
            'token'=>$token,
            'user'=>$worker
        ],200);
    }

    public function Logout(Request $request){
        $tokenText = $request->bearerToken();

        if(!$tokenText){
            return response()->json([
                'success'=>false,
                'message'=>'Token was not provided!'
            ]);
        }

        $token = PersonalAccessToken::findToken($tokenText);

        if($token){
            $token->delete();

            return response()->json([
                'success'=>true,
                'message'=>"Logout was successful."
            ],200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid token'
        ], 401);
    }

    public function CreateUser(Request $request){
        $credentials = $request->validate([
            'name'=>['required','string'],
            'password'=>['required'],
            'role'=>['required','string']
        ]);

        $worker = Worker::create([
            'name' => $credentials['name'],
            'password' => $credentials['password'],
            'role' => $credentials['role']
        ]);

        return response()->json([
            'message' => 'Worker successfully created.',
            'worker' => $worker
        ]);
    }

    public function GetAllWorkers(){
        return response()->json(
            Worker::all()
        );
    }

    public function GetWorkerById(string $id){
        $worker = Worker::find($id);
        if(!$worker){
            return response()->json([
                'success' => false,
                'message' => "Failed to retreive the worker with id {$id}"
            ]);
        }

        return response()->json([
            'success'=>true,
            'worker'=>$worker
        ]);
    }

    public function RemoveWorkerById(string $id){
         $worker = Worker::find($id);
         if(!$worker){
            return response()->json([
                'success' => false,
                'message' => "Failed to retreive the worker with id {$id}"
            ]);
        }
        
         $worker->delete();

         return response()->json([
            'success'=>true,
            'message'=>"Successfully removed the worker!"
        ]);
    }
}
