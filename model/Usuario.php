<?php

require_once 'MiModelo.php';

class Usuario extends MiModelo {

    protected $table = "usuarios";
    //protected $primaryKey = "EMAIL"; //No se debe usar porque al guardar (save), 
    //le asigna un valor numerico del auto_increment
    //Modificar en la BD los campos para que sean mayusculas
    protected $hidden = ["CONTRASENIA", "id", "active", "datos_concatenados"];
    protected $fillable = array('CONTRASENIA', 'EMAIL', 'NOMBRE', 'APELLIDO', 'SEXO');
    public $incrementing = false;
    protected $primaryKey = 'EMAIL';

    public function retos() {
        return $this->belongsToMany('Reto', 'participantes', 'EMAIL', 'CODRETO');
    }

    public function participantes() {
        return $this->hasMany('Participante', 'EMAIL', 'EMAIL');
    }

}
