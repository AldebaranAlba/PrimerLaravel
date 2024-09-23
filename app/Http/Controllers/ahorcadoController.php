<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ahorcadoController extends Controller
{


    public function reiniciarVariables(){
        //SESION PALABRA 1
        $rojo = str_split('rojo');
        Session::put('palabra1', $rojo);
        $palabra = Session::get('palabra1');

        //SESION INTENTO
        Session::put('intento', );
        $intento = Session::get('intento',4);

        //SESION RESPUESTA
        $res = str_split('****');
        Session::put('palabra1_respuesta', $res);
        $miRespuesta = Session::get('palabra1_respuesta');

        $coin = 0;
        Session::get('coincidencias',0);
        Session::put('coincidencias', $coin);



        // Retornar el valor actualizado de 'intento'
        return response()->json(compact('palabra','intento', 'miRespuesta'));
    }

    public function start()
    {
        //SESION INTENTO
        Session::get('intento',7);
        Session::put('intento', 7);

        //SESION PALABRA 1
        Session::get('palabra1', null);
        $rojo = str_split('rojo');
        Session::put('palabra1', $rojo);

        Session::get('palabra2', null);
        $comprar = str_split('comprar');
        Session::put('palabra2', $comprar);

        Session::get('palabra3', null);
        $rodriguez = str_split('rodriguez');
        Session::put('palabra3', $rodriguez);

        Session::get('palabra4', null);
        $programacion = str_split('programacion');
        Session::put('palabra4', $programacion);

        Session::get('palabra5', null);
        $esternocleidomastoideo = str_split('esternocleidomastoideo');
        Session::put('palabra5', $esternocleidomastoideo);



        //SESION RESPUESTA
        Session::get('palabra1_respuesta', null);
        $res = str_split('****');
        Session::put('palabra1_respuesta', $res);

        Session::get('palabra2_respuesta', null);
        $res2 = str_split('*******');
        Session::put('palabra2_respuesta', $res2);

        Session::get('palabra3_respuesta', null);
        $res3 = str_split('*********');
        Session::put('palabra3_respuesta', $res3);

        Session::get('palabra4_respuesta', null);
        $res4 = str_split('************');
        Session::put('palabra4_respuesta', $res4);

        Session::get('palabra5_respuesta', null);
        $res5 = str_split('**********************');
        Session::put('palabra5_respuesta', $res5);


        $coin = 0;
        Session::get('coincidencias',0);
        Session::put('coincidencias', $coin);

        return "Bienvenido al Juego del Ahorcado!!!!!

                Este juego conciste en descubrir la palabra oculta antes de se acaben \n
                tu numero de intentos. El juego cuanta con 5 niveles de dificultad \n
                para que pruebes que tan bueno eres.

                Para iniciar el juego realiza una peticion al endpoint de local host 127.0.0.1/game/(numero de la dificultad) \n
                Dificultad:

                1: Facilote
                2: Facil
                3: Normal
                4: Dificl
                5: EXTREMO!!!!";


    }
    public function game(int $difcultad = 0, $palabra = " " )
    {
        //Crea las variables de sesion en caso de no existir
        $intento = Session::get('intento',7);
        $intento = $intento - 1;

        switch ($difcultad) {
            case 1:

                $coincidencias = Session::get('coincidencias',0);

                $palabra_respuesta = Session::get('palabra1_respuesta');

                $palabra_desafio = Session::get('palabra1');


                if ($intento != -1) {

                    // Palabra que el usuario introdujo en el URI
                    $palabra_usuario = str_split($palabra);

                    if (count($palabra_usuario) > count($palabra_desafio)) {
                        return "Tu cadena ingresada no puede ser más larga que la palabra del ahorcado. " .
                            "Intentos restantes: " . $intento .
                            " Palabra de cuatro letras: " . implode('', $palabra_respuesta);
                    } else {
                        // Comparar la palabra usuario con la palabra desafío
                        for ($i = 0; $i < count($palabra_desafio); $i++) {
                            for($j = 0; $j < count($palabra_usuario); $j++){
                                if($palabra_desafio[$i] === $palabra_usuario[$j]){
                                    $palabra_respuesta[$i] =  $palabra_usuario[$j];
                                    $coincidencias++;

                                    // Marcamos la letra en el desafío como encontrada
                                    $palabra_desafio[$i] = "&";

                                    break;
                                }
                            }
                            Session::put('palabra1_respuesta', $palabra_respuesta);
                            Session::put('palabra1', $palabra_desafio);
                            Session::put('coincidencias', $coincidencias);


                        }

                        if ($coincidencias === 4) {
                            return "¡Felicidades, has ganado!
                            Palabra escondida: rojo ".
                            "regresa a: 127.0.0.1:8000/api/start para volver a jugar";
                        } else {
//                            $intento = $intento - 1;
                            Session::put('intento', $intento);
                            return "Intentos restantes: " . $intento .
                                "
                                Palabra de cuatro letras:
                                " . implode('', $palabra_respuesta);
                        }
                    }
                } else {
                    return "¡Has perdido! Realiza una nueva petición para comenzar de nuevo."
                               . "regresa a: 127.0.0.1:8000/api/start para volver a jugar";
                }


                break;
            case 2:
                $coincidencias = Session::get('coincidencias',0);

                $palabra_respuesta = Session::get('palabra2_respuesta');

                $palabra_desafio = Session::get('palabra2');


                if ($intento != -1) {

                    // Palabra que el usuario introdujo en el URI
                    $palabra_usuario = str_split($palabra);

                    if (count($palabra_usuario) > count($palabra_desafio)) {
                        return "Tu cadena ingresada no puede ser más larga que la palabra del ahorcado. " .
                            "Intentos restantes: " . $intento
                            .implode('', $palabra_respuesta);
                    } else {
                        // Comparar la palabra usuario con la palabra desafío
                        for ($i = 0; $i < count($palabra_desafio); $i++) {
                            for($j = 0; $j < count($palabra_usuario); $j++){
                                if($palabra_desafio[$i] === $palabra_usuario[$j]){
                                    $palabra_respuesta[$i] =  $palabra_usuario[$j];
                                    $coincidencias++;

                                    // Marcamos la letra en el desafío como encontrada
                                    $palabra_desafio[$i] = "&";

                                    break;
                                }
                            }
                            Session::put('palabra2_respuesta', $palabra_respuesta);
                            Session::put('palabra2', $palabra_desafio);
                            Session::put('coincidencias', $coincidencias);


                        }

                        if ($coincidencias === 7) {
                            return "¡Felicidades, has ganado!
                            Palabra escondida: comprar ".
                                "regresa a: 127.0.0.1:8000/api/start para volver a jugar";
                        } else {
//                            $intento = $intento - 1;
                            Session::put('intento', $intento);
                            return "Intentos restantes: " . $intento .
                                "
                                Palabra de siete letras:
                                " . implode('', $palabra_respuesta);
                        }
                    }
                } else {
                    return "¡Has perdido! Realiza una nueva petición para comenzar de nuevo."
                        . "regresa a: 127.0.0.1:8000/api/start para volver a jugar";
                }
                break;
            case 3:
                $coincidencias = Session::get('coincidencias',0);

                $palabra_respuesta = Session::get('palabra3_respuesta');

                $palabra_desafio = Session::get('palabra3');


                if ($intento != -1) {

                    // Palabra que el usuario introdujo en el URI
                    $palabra_usuario = str_split($palabra);

                    if (count($palabra_usuario) > count($palabra_desafio)) {
                        return "Tu cadena ingresada no puede ser más larga que la palabra del ahorcado. " .
                            "Intentos restantes: " . $intento .
                            implode('', $palabra_respuesta);
                    } else {
                        // Comparar la palabra usuario con la palabra desafío
                        for ($i = 0; $i < count($palabra_desafio); $i++) {
                            for($j = 0; $j < count($palabra_usuario); $j++){
                                if($palabra_desafio[$i] === $palabra_usuario[$j]){
                                    $palabra_respuesta[$i] =  $palabra_usuario[$j];
                                    $coincidencias++;

                                    // Marcamos la letra en el desafío como encontrada
                                    $palabra_desafio[$i] = "&";

                                    break;
                                }
                            }
                            Session::put('palabra3_respuesta', $palabra_respuesta);
                            Session::put('palabra3', $palabra_desafio);
                            Session::put('coincidencias', $coincidencias);


                        }

                        if ($coincidencias === 9) {
                            return "¡Felicidades, has ganado!
                            Palabra escondida: rodriguez ".
                                "regresa a: 127.0.0.1:8000/api/start para volver a jugar";
                        } else {
//                            $intento = $intento - 1;
                            Session::put('intento', $intento);
                            return "Intentos restantes: " . $intento .
                                "
                                Palabra de nueve letras:
                                " . implode('', $palabra_respuesta);
                        }
                    }
                } else {
                    return "¡Has perdido! Realiza una nueva petición para comenzar de nuevo."
                        . "regresa a: 127.0.0.1:8000/api/start para volver a jugar";
                }
                break;
            case 4:
                $coincidencias = Session::get('coincidencias',0);

                $palabra_respuesta = Session::get('palabra4_respuesta');

                $palabra_desafio = Session::get('palabra4');


                if ($intento != -1) {

                    // Palabra que el usuario introdujo en el URI
                    $palabra_usuario = str_split($palabra);

                    if (count($palabra_usuario) > count($palabra_desafio)) {
                        return "Tu cadena ingresada no puede ser más larga que la palabra del ahorcado. " .
                            "Intentos restantes: " . $intento .
                            implode('', $palabra_respuesta);
                    } else {
                        // Comparar la palabra usuario con la palabra desafío
                        for ($i = 0; $i < count($palabra_desafio); $i++) {
                            for($j = 0; $j < count($palabra_usuario); $j++){
                                if($palabra_desafio[$i] === $palabra_usuario[$j]){
                                    $palabra_respuesta[$i] =  $palabra_usuario[$j];
                                    $coincidencias++;

                                    // Marcamos la letra en el desafío como encontrada
                                    $palabra_desafio[$i] = "&";

                                    break;
                                }
                            }
                            Session::put('palabra4_respuesta', $palabra_respuesta);
                            Session::put('palabra4', $palabra_desafio);
                            Session::put('coincidencias', $coincidencias);


                        }

                        if ($coincidencias === 12) {
                            return "¡Felicidades, has ganado!
                            Palabra escondida: programacion ".
                                "regresa a: 127.0.0.1:8000/api/start para volver a jugar";
                        } else {
//                            $intento = $intento - 1;
                            Session::put('intento', $intento);
                            return "Intentos restantes: " . $intento .
                                "
                                Palabra de doce letras:
                                " . implode('', $palabra_respuesta);
                        }
                    }
                } else {
                    return "¡Has perdido! Realiza una nueva petición para comenzar de nuevo."
                        . "regresa a: 127.0.0.1:8000/api/start para volver a jugar";
                }
                break;
            case 5:
                $coincidencias = Session::get('coincidencias',0);

                $palabra_respuesta = Session::get('palabra5_respuesta');

                $palabra_desafio = Session::get('palabra5');


                if ($intento != -1) {

                    // Palabra que el usuario introdujo en el URI
                    $palabra_usuario = str_split($palabra);

                    if (count($palabra_usuario) > count($palabra_desafio)) {
                        return "Tu cadena ingresada no puede ser más larga que la palabra del ahorcado. " .
                            "Intentos restantes: " . $intento .
                            implode('', $palabra_respuesta);
                    } else {
                        // Comparar la palabra usuario con la palabra desafío
                        for ($i = 0; $i < count($palabra_desafio); $i++) {
                            for($j = 0; $j < count($palabra_usuario); $j++){
                                if($palabra_desafio[$i] === $palabra_usuario[$j]){
                                    $palabra_respuesta[$i] =  $palabra_usuario[$j];
                                    $coincidencias++;

                                    // Marcamos la letra en el desafío como encontrada
                                    $palabra_desafio[$i] = "&";

                                    break;
                                }
                            }
                            Session::put('palabra5_respuesta', $palabra_respuesta);
                            Session::put('palabra5', $palabra_desafio);
                            Session::put('coincidencias', $coincidencias);


                        }

                        if ($coincidencias === 22) {
                            return "¡Felicidades, has ganado!
                            Palabra escondida: esternocleidomastoideo ".
                                "regresa a: 127.0.0.1:8000/api/start para volver a jugar";
                        } else {
//                            $intento = $intento - 1;
                            Session::put('intento', $intento);
                            return "Intentos restantes: " . $intento .
                                "
                                Palabra de veintidos letras:
                                " . implode('', $palabra_respuesta);
                        }
                    }
                } else {
                    return "¡Has perdido! Realiza una nueva petición para comenzar de nuevo."
                        . "regresa a: 127.0.0.1:8000/api/start para volver a jugar";
                }
                break;
        }
    }


    public function juego(Request $request, $dificultad = 0, $palabra = ""){

        $validator = Validator::make($request->all(), [
            "nombre" => "required|string|max:30",
            "palabra" => "required|string|max:60",
            "apellido_materno" => "string|max:60",
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
        }

        $palabras = ["rojo", "animal","pelicano", "eustaquio","esternocleidomastoideo"];

    }
}
