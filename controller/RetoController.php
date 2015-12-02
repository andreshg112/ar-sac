<?php

require_once './model/Reto.php';
require_once './model/RespondidaReto.php';

class RetoController {

    public static function post_retos($recibido) {
        $reto = new Reto();
        $reto->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $reto->save();
        if ($respuesta->result) {
            $respuesta->mensaje = "Reto creado correctamente.";
            $respuesta->reto = $reto;
        } else {
            $respuesta->mensaje = "No se pudo crear el reto.";
        }
        return $respuesta;
    }

    public static function post_respondida($recibido) {
        $respondida = new RespondidaReto();
        $respondida->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $respondida->save();
        
        if ($respuesta->result) {
            $respuesta->mensaje = "Respuesta guardada correctamente.";
            $respuesta->reto = $respondida;
        } else {
            $respuesta->mensaje = "No se pudo guardar la respuesta.";
        }
        return $respuesta;
    }
}
