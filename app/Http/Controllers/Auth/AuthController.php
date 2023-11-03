<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function login(Request $request){
        //Almacenamos email y credenciales
        $credentials = $request->only('name', 'password');

        /** VALIDACIONES**/
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciales o usuario invalidas'], 400);
            }
        } catch (JWTException $e) {
            //si token no existe
            return response()->json(['error' => 'No existe token'], 500);
        }

        $log= Log::create([
            'user'=>Auth::user()->id,
            'token'=>$token,
            'accion'=>'Inicio de sesión'
        ]);

        //dd($log);

        //Retonamos el token
        //return response()->json(compact('token'));

        //Instanciamos la function respondWithToken
        return $this->respondWithToken($token);
    }

    //Respuesta que se mostrara en metodo login
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'Expira' => auth()->environment('JWT_TTL')
            'Expira' =>  env('JWT_TTL')
        ]);
    }

}
