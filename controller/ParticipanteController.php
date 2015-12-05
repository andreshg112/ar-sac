<?php

require_once './model/Area.php';

class ParticipanteController {

    public static function get_resultados_participante($id) {
        $respuesta = new stdClass();
        $participante = Participante::where("EMAIL", $id)->get();
        if (count($participante) != 0) {
            $respuesta->result = false;
            $respuesta->correctas = $participante->sum('CORRECTAS');
            $respuesta->incorrectas = $participante->sum('INCORRECTAS');
            $respuesta->resultados = Participante::selectRaw('participantes.EMAIL, areas.NOMAREA, sum(CORRECTAS) as CORRECTAS, sum(INCORRECTAS) as INCORRECTAS')
                    ->join('retos', 'retos.CODRETO', '=', 'participantes.CODRETO')
                    ->join('areas', 'areas.CODAREA', '=', 'retos.CODAREA')
                    ->where('participantes.EMAIL', $id)
                    ->groupBy('areas.CODAREA')
                    ->get();
        } else {
            $respuesta->result = false;
            $respuesta->mensaje = "No hay resultados que mostrar.";
        }
        return $respuesta;
    }

    public static function get_resultados_generales() {
        $respuesta = new stdClass();
        $participantes = Participante::all();
        if (count($participantes) != 0) {
            $respuesta->result = false;
            $respuesta->correctas = $participantes->sum('CORRECTAS');
            $respuesta->incorrectas = $participantes->sum('INCORRECTAS');
            $respuesta->resultados = Participante::selectRaw('areas.NOMAREA, sum(CORRECTAS) as CORRECTAS, sum(INCORRECTAS) as INCORRECTAS')
                    ->join('retos', 'retos.CODRETO', '=', 'participantes.CODRETO')
                    ->join('areas', 'areas.CODAREA', '=', 'retos.CODAREA')
                    ->groupBy('areas.CODAREA')
                    ->get();
        } else {
            $respuesta->result = false;
            $respuesta->mensaje = "No hay resultados que mostrar.";
        }
        return $respuesta;
    }

}
