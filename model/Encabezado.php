<?php

require_once 'MiModelo.php';

class Encabezado extends MiModelo {

    protected $table = "encabezados";
    protected $primaryKey = "ID_ENCABEZADO";

    public function preguntas() {
        return $this->hasMany("Pregunta", "ID_ENCABEZADO", "ID_ENCABEZADO");
    }

}
