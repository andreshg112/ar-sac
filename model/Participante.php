<?php

require_once 'MiModelo.php';

class Participante extends MiModelo {

    protected $table = "participantes";
    protected $hidden = ["id"];
    public $incrementing = false; //Para desactivar el auto-incrementable de Eloquent en esta tabla
    protected $key1 = 'CODRETO';
    protected $key2 = 'EMAIL';

    //protected $primaryKey = ['CODRETO', 'EMAIL'];
    //Para sobreescribir la busqueda por defecto
    /*function newQuery() {
        $query = parent::newQuery();
        $query->where($this->key1, '=', $this->CODRETO)->where($this->key2, '=', $this->EMAIL);
        return $query;
    }*/

}
