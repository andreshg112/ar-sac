<?php

require_once 'MiModelo.php';

class Participante extends MiModelo {

    protected $table = "participantes";
    protected $hidden = ["id"];

}
