<?php

class Usuario extends MiModelo {

    protected $table = "usuarios";
    protected $primaryKey = "EMAIL";
    protected $hidden = ["CONTRASENIA"];
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
