<?php

class AreaController {

    public static function get_areas() {
        $respuesta = new stdClass();
        $respuesta->areas = Area::all();
        if (count($respuesta->areas) == 0) {
            $respuesta->result = false;
            $respuesta->mensaje = "No hay áreas registradas.";
        }
        return $respuesta;
    }

}
