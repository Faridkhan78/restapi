<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Register;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'user_id' => 'required|string|max:255',
                'name' => 'required',
                'mobile' => 'required',
                'image' => 'required',
            ]
        );
        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validateUser->errors()->all()
            ], 401);
        }

        $register = Register::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'image' => $request->image,
            // 'password' => bcrypt($request->password)
        ]);
        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'user' => $register,
        ], 200);
    }
}
