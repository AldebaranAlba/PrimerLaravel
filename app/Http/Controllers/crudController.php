<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Faker\Provider\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class crudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $id = null)
    {
        $persona = Persona::find($id);

        if($persona){
            return response()->json($persona);
        }else{
            return response()->json([
                "msg" => "no se ha podido encontrar a la persona"
            ]);
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "nombre" => "required|string|max:60",
            "apellido_paterno" => "required|string|max:60",
            "apellido_materno" => "string|max:60",
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
        }

        $persona = Persona::create([
            "nombre" => $request->nombre,
            "apellido_paterno" => $request->apellido_paterno,
            "apellido_materno" => $request->apellido_materno,
        ]);

        return response()->json([
            "msg" => "Se ha creado a la persona exitosamente",
            "data" => $persona
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona, int $id = null)
    {
        $persona = Persona::find($id);

        if(!$persona->id){
            return response()->json([
                "msg" => "No se ha podido encontrar a la persona",
            ]);
        }

        $persona->update([
            "nombre"=>request()->nombre,
            "apellido_paterno"=>request()->apellido_paterno,
            "apellido_materno"=>request()->apellido_materno,
        ]);

        return response()->json([
            "msg"=> "La actualizacion se realizo con exito",
            "data" => $persona
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona, int $id = null)
    {
        $persona = Persona::find($id);

        if(!$persona->id){
            return response()->json([
                "msg" => "No se ha podido encontrar a la persona",
            ]);
        }

        $persona->delete();

        return response()->json([
            "msg"=> "La eliminacion de la persona con id: ".$persona->id." se realizo con exito",
        ]);
    }
}
