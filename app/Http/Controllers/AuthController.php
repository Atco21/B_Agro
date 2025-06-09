<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;

use App\Models\Explotacion;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $successStatus = 200;


    public function login(Request $request)
{
    $request->validate([
        'usuario' => 'required',
        'password' => 'required'
    ]);

    if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password])) {
        $user = Auth::user();


        $token = $user->createToken('agrocontrol')->accessToken;



       return redirect()->to('/explotaciones/general');

    }

    return response()->json(['error' => 'Credenciales incorrectas'], 401);
}


    public function loginAngular(Request $request)
    {
        if (Auth::attempt(['usuario' => request('usuario'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['rol'] = $user->rol;
            $success['explotacionId'] = $user->explotacion_id;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

     public function me(Request $request)
    {


        $user = $request->user();

        return response()->json([
            'id'      => $user->id,
            'usuario' => $user->usuario,
            'email'   => $user->email,
            'rol'     => $user->rol,

        ], 200);
    }





    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }



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
