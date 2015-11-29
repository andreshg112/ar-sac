<?php

require_once 'MiModelo.php';

class Area extends MiModelo {

    protected $table = "areas";
    protected $primaryKey = "CODAREA";

    public function preguntas() {
        return $this->hasMany("Pregunta", "CODAREA", "CODAREA");
    }

}
