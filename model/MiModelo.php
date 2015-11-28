<?php

require_once './config.php';

abstract class MiModelo extends Illuminate\Database\Eloquent\Model {

    public $timestamps = false; //Para "evadir" un error que sale si no se usa esta sentencia.

    public function add_data($recibido) {
        //Se reciben los atributos en un array u objeto estandar ($recibido)
        //(tal vez enviados por POST), y agregarlos a este objeto (this) instanciado.
        foreach ($recibido as $key => $value) {
            $KEY = strtoupper($key);
            $this->$KEY = $value;
        }
    }

}
