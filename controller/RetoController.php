<?php

require_once './model/Reto.php';
require_once './model/Participante.php';
require_once './model/RespondidaReto.php';

class RetoController {

    public static function post_retos($recibido) {
        $participantes = isset($recibido->participantes) ? $recibido->participantes : array();
        unset($recibido->participantes);
        $reto = new Reto();
        $reto->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $reto->save();
        foreach ($participantes as $value) {
            $participante = new Participante();
            $participante->add_data($value);
            $participante->CODRETO = $reto->CODRETO;
            $participante->save();
        }
        if ($respuesta->result) {
            $respuesta->mensaje = "Reto creado correctamente.";
            $respuesta->reto = $reto;
        } else {
            $respuesta->mensaje = "No se pudo crear el reto.";
        }
        return $respuesta;
    }

    public static function post_respondida($recibido) {
        $opcion = $recibido->opcion;
        unset($recibido->opcion);
        $respondida = new RespondidaReto();
        $respondida->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $respondida->save();
        if ($respuesta->result) {
            $participante = Participante::where('EMAIL', $recibido->email)
                    ->where('CODRETO', $recibido->codreto);
            $campo = '';
            if ($opcion->VALIDEZ == 'CORRECTA') {
                $campo = 'CORRECTAS';
            } else {
                $campo = 'INCORRECTAS';
            }
            $respuesta->result_2 = $participante->increment($campo);
            $respuesta->mensaje = "Respuesta guardada correctamente.";
            $respuesta->reto = $respondida;
        } else {
            $respuesta->mensaje = "No se pudo guardar la respuesta.";
        }
        return $respuesta;
    }

}
