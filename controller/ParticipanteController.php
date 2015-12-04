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
            //DB::raw("select participantes.EMAIL, retos.CODAREA, areas.NOMAREA, sum(CORRECTAS), sum(INCORRECTAS) from `participantes` inner join retos on retos.CODRETO = participantes.CODRETO inner join areas on areas.CODAREA = retos.CODAREA WHERE participantes.EMAIL = '$id' group by retos.codarea ");
        } else {
            $respuesta->result = false;
            $respuesta->mensaje = "El usuario no ha participado en ningún reto.";
        }
        return $respuesta;
    }

}
