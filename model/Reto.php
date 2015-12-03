<?php

require_once 'MiModelo.php';

class Reto extends MiModelo {

    protected $table = "retos";
    protected $primaryKey = "CODRETO";

    public function participantes() {
        return $this->hasMany("Participante", "CODRETO", "CODRETO");
    }

}
