<?php

require_once './model/Reto.php';

class RetoController {

    public static function post_retos($recibido) {
        $reto = new Reto();
        $reto->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $reto->save();
        if ($respuesta->result) {
            $respuesta->mensaje = "Reto creado correctamente.";
            $respuesta->area = $reto;
        } else {
            $respuesta->mensaje = "No se pudo crear el reto.";
        }
        return $respuesta;
    }

}
