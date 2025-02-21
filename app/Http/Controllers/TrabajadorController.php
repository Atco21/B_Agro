<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Explotacion;
use Illuminate\Support\Facades\Hash;



class TrabajadorController extends Controller
{
    public function index()
    {
        $explotacion = Explotacion::all();
        $users = User::where('rol', '!=', 'admin')->get();
        return view('trabajadores', compact('users'), compact('explotacion'));


    }



    public function store(Request $request){

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'dni' => 'required|string|max:9|unique:users,dni',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'direccion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'usuario' => 'required|string|unique:users,usuario',
            'password' => 'required|string|min:6',
            'rol' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'explotacion_id' => 'required|integer|exists:explotaciones,id',
        ]);
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('imagenes', 'public');
        }
        $trabajador = User::create([
            'nombre' => $request->nombre,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password), // Encriptar contraseña
            'rol' => $request->rol,
            'imagen' => $imagenPath,
            'explotacion_id' => $request->explotacion_id,
        ]);

        return redirect()->route('trabajadores')->with('success', 'Trabajador registrado correctamente.');
    }



    public function mostrarAplicadores(){
        $trabajadores = Trabajador::where('rol', 'aplicador')->get();
        return response()->json($trabajadores);
    }

    public function register(Request $request)
    {

        //dump($request->all());
    // Validar los datos recibidos
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'dni' => 'required|string|unique:users,dni',
        'telefono'=> 'nullable|string|max:9',
        'email' => 'nullable|email',
        'usuario' => 'required|string|unique:users,usuario',
        'password' => 'required|string|min:6',
        'rol' => 'required|string',
    ]);
    $imagenPath = null;
    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('imagenes', 'public');
    }    try {
        // Crear el usuario con la contraseña cifrada
        $user = User::create([
            'nombre' => $request->nombre,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password), // Encriptar contraseña
            'rol' => $request->rol,
            'imagen' => $imagenPath,
            'explotacion_id' => $request->explotacion_id,
        ]);


        //dump($user);



        // Generar un token de acceso
        $token = $user->createToken('MyApp')->accessToken;

        // Preparar la respuesta de éxito
        return response()->json([
            'success' => [
                'token' => $token,
                'nombre' => $user->nombre,
            ]
        ], 201); // Código HTTP 201: Creado
    } catch (\Exception $e) {
        // Manejar errores inesperados
        return response()->json([
            'error' => 'No se pudo registrar el usuario.',
            'details' => $e->getMessage(),
        ], 500); // Código HTTP 500: Error interno del servidor
    }
   }




}
