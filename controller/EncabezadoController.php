<?php

require_once './model/Encabezado.php';

class EncabezadoController {

    public static function get_encabezados() {
        $respuesta = new stdClass();
        $respuesta->encabezados = Encabezado::all();
        if (count($respuesta->encabezados) == 0) {
            $respuesta->result = false;
            $respuesta->mensaje = "No hay encabezados registradas.";
        }
        return $respuesta;
    }

    public static function post_encabezados($recibido) {
        $encabezado = new Encabezado();
        $encabezado->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $encabezado->save();
        if ($respuesta->result) {
            $respuesta->mensaje = "Encabezado registrado correctamente.";
            $respuesta->encabezado = $encabezado;
        } else {
            $respuesta->mensaje = "No se pudo registrar el encabezado.";
        }
        return $respuesta;
    }

}
