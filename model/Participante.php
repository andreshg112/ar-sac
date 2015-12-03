<?php

require_once 'MiModelo.php';

class Participante extends MiModelo {

    protected $table = "participantes";
    protected $hidden = ["id"];

    //protected $incrementing = false; //Para desactivar el auto-incrementable de Eloquent en esta tabla
}
