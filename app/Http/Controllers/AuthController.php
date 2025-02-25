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
        $token = $user->createToken('agrocontrol')->accessToken;


       // $explotacion = Explotacion::all();

       return redirect()->to('/explotaciones');
        // Devolver el token al frontend
      //  return view('explotacion', compact('explotacion'));
    }

    // Si falla la autenticación, devolver error
    return response()->json(['error' => 'Credenciales incorrectas'], 401);
}


    public function loginAngular(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
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
