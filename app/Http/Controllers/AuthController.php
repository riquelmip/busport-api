<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function __construct()
    {
        //para que siempre que se quiera acceder a este controlador, verifique la autorizacion, execptuando los metodos del login y registro
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        $user = auth()->user();

        if ($user == null) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        return response()->json($user);
    }

    public function logout()
    {

        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6', //|confirmed significa que en elfom, debe haber otro campo llamado password_confirm
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
            $validator->validate(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'Usuario registrado',
            'user' => $user
        ], 201);
    }
}
