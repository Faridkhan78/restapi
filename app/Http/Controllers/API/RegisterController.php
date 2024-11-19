<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Register;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)

    {
        $user = User::with('profile');
        $user = $request->user();
        $user->tokens();
        // $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'user' => $user,
            'message' => 'Your data is display  successfully',

        ], 200);


        $validateUser = Validator::make(
            $request->all(),
            [
                'user_id' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'mobile' => 'required|string|max:15',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
       
        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validateUser->errors()->all()
            ], 401);
        }

        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path() . 'uploads/', $imageName);

        $register = Register::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'image' => $imageName,
            // 'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Register created successfully',
            'register' => $register,
        ], 200);
    }

    

    public function show(string $id)
    {
        $register['register'] = Register::select(
            'id',
            'user_id',
            'name',
            'mobile',
            'image'
        )->where(['id' => $id])->get();
        return response()->json([
            'status' => true,
            'message' => 'Your single Register Post',
            'register' => $register,
        ], 200);
    }

    public function update(Request $request, string $id)
    {

        $validateUser = Validator::make(
            $request->all(),

            [
                'user_id' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'mobile' => 'required|string|max:15',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validateUser->errors()->all()
            ], 401);
        }

        $register = Register::select('id', 'image')->get();

        if ($request->image) {
            $path =  public_path() . '/uploads/';

            if ($register->image != '' && $register->image != null) {
                $old_file =  $path . $register->image;
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }
            $img = $request->image;
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(public_path() . 'uploads/', $imageName);
        } else {
            $imageName = $register->image;
        }

        $register = Register::where(['id' => $id])->update([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'image' => $imageName,
            // 'password' => bcrypt($request->password)
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Register updated successfully',
            'register' => $register,
        ], 200);
    }

    public function destroy(string $id)
    {
        // $register = Register::select('id', 'image')->get();
        $imagePath = Register::select('image')->where('id', $id)->get();

        $filePath = public_path() . '/uploads' . $imagePath[0]['image'];

        unlink($filePath);

        $register = Register::where(['id' => $id])->delete();

        $register = Register::where('id', $id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Your Register has been removed successfully',
            'register' => $register,
        ], 200);
    }
}
