<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use JWTFactory;
use JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class APILoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid credentials', 'error' => 1], 401);
            }
        }
        catch (JWTException $e) {
            return response()->json(['error' =>1, 'message' => 'could_not_create_token'], 500);
        }
        return response()->json(['token' => $token, 'error'=> 0]);
    }
}