<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Log;


use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $successStatus = 200;


    public function login(Request $request)
{
    // Validar los datos
    $request->validate([
        'usuario' => 'required',
        'password' => 'required'
    ]);

    // Intentar autenticar al usuario
    if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password])) {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Generar el token con Passport
        $token = $user->createToken('MyApp')->accessToken;

        // Devolver el token al frontend
        // return response()->json([
        //     'token' => $token
        // ]);
        return redirect()->route('explotaciones');
    }

    // Si falla la autenticación, devolver error
    return response()->json(['error' => 'Credenciales incorrectas'], 401);
}


public function loginAngular(Request $request)
    {
        if (Auth::attempt(['usuario' => request('usuario'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['rol'] = $user->rol;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }




    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }



        /**
     * logout api
     *
     */
    public function logout(Request $request)
    {

        $isUser = $request->user()->token()->revoke();
        if($isUser){
            $success['message'] = "Successfully logged out.";
            return response()->json(['success' => $isUser], $this->successStatus);
        }
        else{
            return response()->json(['error' => 'Unauthorised'], 401);
        }


    }
}
