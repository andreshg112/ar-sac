<?php

require_once './model/Pregunta.php';

class PreguntaController {

    //Aplicar filtro despues
    public static function get_preguntas() {
        $respuesta = new stdClass();
        $respuesta->preguntas = Pregunta::all();
        if (count($respuesta->preguntas) == 0) {
            $respuesta->result = false;
            $respuesta->mensaje = "No hay preguntas registradas.";
        }
        return $respuesta;
    }

    public static function post_preguntas() {
        $request = \Slim\Slim::getInstance()->request();
        // Los datos serán accesibles de esta forma:
        $recibido = json_decode($request->getBody());
        $pregunta = new Pregunta();
        $pregunta->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $pregunta->save();
        if ($respuesta->result) {
            $respuesta->mensaje = "Pregunta registrada correctamente.";
            $respuesta->pregunta = $pregunta;
        } else {
            $respuesta->mensaje = "No se pudo registrar la pregunta.";
        }
        return $respuesta;
    }

    public static function put_preguntas($id) {
        $request = \Slim\Slim::getInstance()->request();
        // Los datos serán accesibles de esta forma:
        $recibido = json_decode($request->getBody());
        $pregunta = Pregunta::find($id);
        $pregunta->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $pregunta->save();
        if ($respuesta->result) {
            $respuesta->mensaje = "Pregunta actualizada correctamente.";
            $respuesta->pregunta = $pregunta;
        } else {
            $respuesta->mensaje = "No se pudo actualizar la pregunta.";
        }
        return $respuesta;
    }

    //Modificar porque no se puede eliminar por llave foranea
    public static function delete_pregunta($id) {
        // Los datos serán accesibles de esta forma:
        $pregunta = Pregunta::find($id);
        echo $pregunta->delete();
    }

}
