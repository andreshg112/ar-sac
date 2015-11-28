<?php

require_once 'MiModelo.php';

class Usuario extends MiModelo {

    protected $table = "usuarios";
    //protected $primaryKey = "EMAIL"; //No se debe usar porque al guardar (save), 
    //le asigna un valor numerico del auto_increment
    protected $hidden = ["CONTRASENIA", "id", "active", "datos_concatenados"];
    protected $fillable = array('EMAIL', 'NOMBRE', 'APELLIDO', 'FECHANAC', 'SEXO');

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
