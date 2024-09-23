<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class trabajounoController extends Controller
{
    public function index($numero, int $segundo = null, string $fibonacci = null)
    {
        $validate = Validator::make(request()->all(),[
           'numero' => 'required|integer',
        ]);

        if($validate->fails()){
            return response()->json([
                'msg' => "error en la validacion",
                'error' => $validate->messages()
            ]);
        }

        if($numero > $segundo){
            return response()->json(["el primer numero tiene que ser menor al segundo "]);
        }

        //Si estan los 3 parametros
        if ($numero && $segundo && $fibonacci) {

            $fibona = [];
            $a = 0;
            $b = 1;

            //mientras que a sea menor al numero final
            while ($a <= $segundo) {

                //si a es mayor al numero inicial
                if ($a >= $numero) {
                    //guarda el numero a en mi arreglo donde pongo la seciencia fibonacci
                    $fibona[] = $a;
                }

                //Creo una variable temporal donde hago la operacion de la suma de los dos numeros
                $temp = $a + $b;
                //hago igual a $a al numero siguiente de la secuencia
                $a = $b;
                //igualo a b a el resultado de la suma realizada en temp.
                $b = $temp;
            }

            return response()->json([
                "numero" => $fibona
            ], 200);

        } elseif ($numero && $segundo) {
            // Si solo está el primer número y el segundo
            // Muestra el rango de tablas de multiplicar entre los dos números
            $tabla = [];

            //En este ciclo sacon el numero de veces que se hara la tabla
            for ($e = $numero; $e <= $segundo; $e++) {
                $multiplicacion = [];
                for ($i = 1; $i <= 10; $i++) {
//                    $multiplicacion[] = $e * $i;
                    $tabla[] = [
                        "numero" => $e,
                        "tabla" => $e . " X ". $i . " = " . $e*$i
                    ];

                }

            }

            return response()->json($tabla, 200);

        } elseif ($numero) {
            // Si solo hay un número
            // Solo muestra la tabla de multiplicar de ese número
            $tabla = [];

            for ($i = 1; $i <= 10; $i++) {
                $tabla[] = $numero * $i;
            }

            return response()->json([
                "numero" => $numero,
                "tabla" => $tabla
            ], 200);
        }

    }

    public function peticionForm(Request $request, $numero, int $segundo = null, string $fibonacci = null)
    {
        $validator = Validator::make($request->all(), [
           "numero" => "required|integer",
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
        }

        return response()->json([
            'saludo' => 'Muy buenas  :)',
            'data'=>[
                "numero" =>$request->numero,
                "segundo" =>$request->segundo,
                "request" => $request->fibonacci,
            ]
        ],200);

//        return response()->json([
//            'saludo' => 'Muy buenas  :)',
//             'data'=>[
//              "nova" =>$request-> nombre
//             ]
//        ],200);
    }

    public function insertarEnBase(Request $request){
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
            "data" => $persona
        ]);



    }


}
