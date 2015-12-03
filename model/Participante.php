<?php

require_once 'MiModelo.php';

class Participante extends MiModelo {

    protected $table = "participantes";
    protected $hidden = ["id"];

    //protected $secondaryKey = 'something'
    //protected $primaryKey = ['CODRETO', 'EMAIL'];
    //Para sobreescribir la busqueda por defecto
//    function newQuery() {
//        $query = parent::newQuery();
//        $query->where($this->secondaryKey, '=', $this->type);
//        return $query;
//    }
}
