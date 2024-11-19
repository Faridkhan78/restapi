<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    
    public function signup(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]
        );
        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validateUser->errors()->all()
            ], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            // 'password' => bcrypt($request->password)
        ]);
        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'user' => $user,
        ], 200);
    }
    public function login(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );
        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Authentication failed',
                'errors' => $validateUser->errors()->all()
            ], 404);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            return response()->json([
                'status' => true,
                'message' => 'User logged in  successfully',
                'token' => $authUser->createToken("API Token")->plainTextToken,
                'tokan_type' => 'bearer'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email and password does not matched',
            ], 401);
        }
    }
    public function logout(Request $request)
    {
        
        // $user = $request->user();
        // $user->tokens()->delete();
        
        // return response()->json([
            //     'status' => true,
            //     'user' => $user,
            //     'message' => 'You logged out  successfully',
            
            // ], 200);
            
            $user = Auth::user();
            $getDetail = User::where('id',$user->id)->with('register')->first();

            // $getDetail = User::with('register')->find(Auth::id());


        if($user){
         return response()->json([           
             'message' => 'User updated successfully',
             'user' => $getDetail
         ], 200);
        }else{
         return response()->json([
             'message' => 'User not found',
         ], 404);
        }
    }
    public function update(Request $request ,$id){
       $request->validate([
        'name' => ['required','string','max:255'],
        'email' => ['required','email','unique:users,email,'.$id],
        // 'password' => ['nullable','min:6']  // Password is optional, minimum 6 characters if provided
       ]);
       $user = User::find($id);
       if($user){
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        // if($request->has('password')){
        //     $user->password = bcrypt($request->password);
        // }
        // $user->save();
        return response()->json([           
            'message' => 'User updated successfully',
            // 'user' => $user
        ], 200);
       }else{
        return response()->json([
            'message' => 'User not found',
        ], 404);
       }
    }

    

    // update
    // public function update(Request $request, $id)
    // {
        // Find the user by ID
    //     $user = User::find($id);
        
    //     // Check if user exists
    //     if (!$user) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'User not found'
    //         ], 404);
    //     }

    //     // Validate the incoming request data
    //     $validateUser = Validator::make(
    //         $request->all(),
    //         [
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|email|unique:users,email,' . $user->id,  // Exclude current user from unique check
    //             'password' => 'nullable|min:6'  // Password is optional, minimum 6 characters if provided
    //         ]
    //     );

    //     // Check for validation errors
    //     if ($validateUser->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Validation Error',
    //             'errors' => $validateUser->errors()->all()
    //         ], 422);
    //     }

    //     // Update the user's information
    //     $user->name = $request->name;
    //     $user->email = $request->email;

    //     // Only update the password if it’s provided
    //     if ($request->filled('password')) {
    //         $user->password = bcrypt($request->password);
    //     }

    //     // Save the updated user data
    //     $user->save();

    //     // Return success response
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'User updated successfully',
    //         'user' => $user,
    //     ], 200);
    // }

    // public function update(Request $request)
    // {

    //     $validateUser = Validator::make(
    //         $request->all(),
    //         [
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|email|unique:users,email',
    //             'password' => 'required'
    //         ]
    //     );
    //     if ($validateUser->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Validation Error',
    //             'errors' => $validateUser->errors()->all()
    //         ], 401);
    //     }

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         // 'password' => bcrypt($request->password)
    //     ]);
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'User updated successfully',
    //         'user' => $user,
    //     ], 200);
    // }

    // public function destroy($id){
    //     $user = Auth::user();
    //     if($user){
    //         $user->delete();
    //         return response()->json([
    //             'message' => 'User deleted successfully',
    //         ], 200);
    //     }else{
    //         return response()->json([
    //             'message' => 'User not found',
    //         ], 404);
    //     }
    // }
    public function destroy($id){
       
        $user = User::find($id);
        if($user){
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully',
            ], 200);
        }else{
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }
    }
}
