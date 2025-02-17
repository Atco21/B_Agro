<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajador;
use App\Models\Explotacion;
use Illuminate\Support\Facades\Hash;


class TrabajadorController extends Controller
{
    public function index()
    {
        $explotacion = Explotacion::all();
        $trabajadores = Trabajador::all();
        return view('trabajadores', compact('trabajadores'), compact('explotacion'));


    }



    public function store(Request $request){

        $validatedData = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'dni' => 'required|string|max:9|unique:trabajadores,dni',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|unique:trabajadores,email',
            'direccion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'usuario' => 'required|string|unique:trabajadores,usuario',
            'password' => 'required|string|min:6',
            'rol' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'explotacion_id' => 'required|integer|exists:explotaciones,id',
        ]);
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('imagenes', 'public');
        }
        $trabajador = Trabajador::create([
            'nombre_completo' => $request->nombre_completo,
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


}
