<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function GetAllTrucks(){
        return response()->json(
            Truck::all()
        );
    }

    public function GetTruckById(string $id){
        $truck = Truck::find($id);
        if(!$truck){
            return response()->json([
                'success' => false,
                'message' => "Failed to retreive the truck with id {$id}"
            ]);
        }
        return response()->json([
            'success' => true,
            'truck'=>$truck
        ]);
    }

    public function CreateTruck(Request $request){
        $truckValues = $request->validate([
            'licence_plate'=>['required','string'],
            'kilometrage'=>['required'],
        ]);

        $truck = Truck::create([
            'licence_plate' => $truckValues['licence_plate'],
            'kilometrage' =>$truckValues['kilometrage'],
            'driver_id'
        ]);

        return response()->json($truck);
    }

    public function RemoveTruckById(string $id){
        $truck = Truck::find($id);
        if(!$truck){
            return response()->json([
                'success' => false,
                'message' => "Failed to retreive the truck with id {$id}"
            ]);
        }
        $truck->delete();

        return response()->json([
            'success'=>true,
            'message'=>"Truck was successfully removed."
        ]);
    }

    public function ChangeTruckInfo(Request $request,string $id){
        $truck = Truck::find($id);
        $truckValues = $request->validate([
            'kilometrage'=>['sometimes','nullable','integer'],
            'driver_id'=>['sometimes','nullable','integer','exists:workers,id']
        ]);

        $truck->update($truckValues);

        return response()->json([
            'success'=>true,
            'message'=>"Truck data has been updated!",
            'Truck'=>$truck
        ],200);
    }
}
