<?php

foreach (glob("controller/*.php") as $filename) {
    require_once $filename;
}

//echo Pregunta::whereNotIn("CODPREGUNTA", function($query) {
//            $query->select('CODPREGUNTA')
//            ->from("RESPONDIDAS_RETO")
//            ->where("EMAIL", "=", "andreshg112@gmail.com");
//        })
//        ->orderByRaw("rand()")
//        ->first();

//echo Pregunta::whereNotIn("CODPREGUNTA", [1])
//        ->orderByRaw("rand()")
//        ->first();

echo json_encode(PreguntaController::get_pregunta_no_respondida("andreshg112@gmail.com", "1", "1"));