<?php

require_once './config.php';

class Pregunta extends Illuminate\Database\Eloquent\Model {

    protected $table = 'preguntas';
    public $timestamps = false;

}

/*
//INSERTAR UN NUEVO REGISTRO
$usuario = new Usuario;
$usuario->nombre = 'Computador portatil';
$usuario->fecha_nacimiento = '1995-09-17';
$usuario->save();*/
/*
//MUESTRA TODOS LOS REGISTROS DE LA TABLA
echo $usuario = Usuario::All();
$usuario = Usuario::All();
echo json_encode($usuario);

//ACTUALIZAR CAMPO DE UN REGISTRO BUSCANDO 
$usuario = Usuario::find(1);
$usuario->descripcion = 'Procesador i7 cuarta generacion con 8GB de memoria RAM, Tarjeta grafica Nvidia de 4GB';
$usuario->save();

//ELIMINAR UN REGISTRO BUSCANDO
$usuario = Usuario::find(1);
$usuario->delete();*/