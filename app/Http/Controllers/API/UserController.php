<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{

    public function getDetails(Request $request){
        
        // dd($request);
        $user = Auth::user();
        if($user){
         return response()->json([           
             'message' => 'User Fetch Data successfully',
             // 'user' => $user
         ], 200);
        }else{
         return response()->json([
             'message' => 'User not found',
         ], 404);
        }
     }
}
