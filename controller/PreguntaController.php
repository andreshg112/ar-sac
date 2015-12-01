<?php

require_once './model/Pregunta.php';

class PreguntaController {

    //Aplicar filtro despues
    public static function get_preguntas() {
        $respuesta = new stdClass();
        $respuesta->preguntas = Pregunta::all();
        foreach ($respuesta->preguntas as $pregunta) {
            $pregunta->encabezado;
        }
        if (count($respuesta->preguntas) == 0) {
            $respuesta->result = false;
            $respuesta->mensaje = "No hay preguntas registradas.";
        }
        return $respuesta;
    }

    public static function post_preguntas($recibido) {
        $opciones = $recibido->opciones;
        unset($recibido->opciones);
        $pregunta = new Pregunta();
        $pregunta->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $pregunta->save();
        foreach ($opciones as $key => $value) {
            $opcion = new Opcion();
            $opcion->add_data($value);
            $opcion->CODPREGUNTA = $pregunta->CODPREGUNTA;
            $opcion->save();
        }
        if ($respuesta->result) {
            $respuesta->mensaje = "Pregunta registrada correctamente.";
            $respuesta->pregunta = $pregunta;
        } else {
            $respuesta->mensaje = "No se pudo registrar la pregunta.";
        }
        return $respuesta;
    }

    public static function put_preguntas($id) {
        //Refactorizar
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

    public static function get_opciones_pregunta($id) {
        $respuesta = new stdClass();
        $pregunta = Pregunta::find($id);
        if ($pregunta) {
            $respuesta->opciones = $pregunta->opciones;
            if (count($respuesta->opciones) == 0) {
                $respuesta->result = false;
                $respuesta->mensaje = "No hay opciones registradas para la pregunta con código '$id'.";
            } else {
                $respuesta->result = true;
            }
        } else {
            $respuesta->result = false;
            $respuesta->mensaje = "La pregunta con código '$id' no se encuentra registrada.";
        }
        return $respuesta;
    }

    public static function get_pregunta_no_respondida($email, $id_reto, $id_area) {
        $respuesta = new stdClass();
        $pregunta = Pregunta::whereNotIn("CODPREGUNTA", function($query) use ($email, $id_reto) {
                    $query->select("CODPREGUNTA")
                    ->from("RESPONDIDAS_RETO")
                    ->where("EMAIL", "=", "$email")
                    ->where("ID_RETO", "=", "$id_reto");
                })
                ->where("CODAREA", "=", "$id_area")
                ->orderByRaw("rand()")
                ->first();
        if ($pregunta) {
            $pregunta->encabezado;
            $respuesta->pregunta = $pregunta;
            $respuesta->result = true;
        } else {
            $respuesta->result = false;
            $respuesta->mensaje = "Error. Revise los datos enviados.";
        }
        return $respuesta;
    }

}
