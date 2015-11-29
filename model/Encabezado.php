<?php

require_once 'MiModelo.php';

class Encabezado extends MiModelo {
    
    //Agregar tabla Encabezado en la base de datos
    protected $table = "encabezados";
    protected $primaryKey = "CODENCABEZADO";

    public function preguntas() {
        return $this->hasMany("Pregunta", "CODENCABEZADO", "CODENCABEZADO");
    }

}
