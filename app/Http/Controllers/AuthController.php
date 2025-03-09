<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;


use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $successStatus = 200;


    public function login()
    {
        if (Auth::attempt(['usuario' => request('usuario'), 'password' => request('password')])) {
            $user = Auth::user();
            $token =  $user->createToken('MyApp')->accessToken;

            session(['token' => $token]); // Guarda el token en la sesión

            if ($user->rol == 'admin') {
                return redirect()->route('explotaciones'); // Redirige a explotaciones
            }

        }

            return response()->json(['error' => 'Unauthorised'], 401);
    }

    public function loginAngular(Request $request)
    {
        if (Auth::attempt(['usuario' => request('usuario'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
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
