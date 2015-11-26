<?php

require_once './config.php';

abstract class MiModelo extends Illuminate\Database\Eloquent\Model {

    public $timestamps = false; //Para "evadir" un error que sale si no se usa esta sentencia.

    //Se reciben los atributos en un array u objeto estandar 
    //(tal vez enviados por POST), y agregarlos a este (this) objeto instanciado.

    public function add_data($received) {
        foreach ($received as $key => $value) {
            $KEY = strtoupper($key);
            $this->$KEY = $value;
        }
    }

}
