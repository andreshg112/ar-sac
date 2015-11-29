<?php

require_once 'MiModelo.php';
require_once 'Opcion.php';

class Pregunta extends MiModelo {

    protected $table = 'preguntas';
    protected $primaryKey = 'CODPREGUNTA';

    public function opciones() {
        return $this->hasMany("Opcion", "CODPREGUNTA", "CODPREGUNTA");
    }
}

/*
//INSERTAR UN NUEVO REGISTRO
$usuario = new Usuario;
$usuario->nombre = 'Computador portatil';
$usuario->fecha_nacimiento = '1995-09-17';
$usuario->save();*/
/*
//ACTUALIZAR CAMPO DE UN REGISTRO BUSCANDO 
$usuario = Usuario::find(1);
$usuario->descripcion = 'Procesador i7 cuarta generacion con 8GB de memoria RAM, Tarjeta grafica Nvidia de 4GB';
$usuario->save();
//ELIMINAR UN REGISTRO BUSCANDO
$usuario = Usuario::find(1);
$usuario->delete();*/
