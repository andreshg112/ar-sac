<?php

require_once './model/Usuario.php';

class UsuarioController {

    public static function get_usuarios($limit, $filtro, $orden) {
        //Perfeccionar el filtro para buscar que contengan el parametro $filtro, usando %
        //Lo anterior se puede hacer enviando los datos concatenados por un % en vez de espacios
        //Devuelve n (limit) usuarios al azar filtrando por el parametro 'filtro', 
        //ordenando por "NOMBRE" (principalmente) 
        //si se le pasa el parametro "orden" (sin importar su valor)
        $respuesta = new stdClass();
        $respuesta->usuarios = Usuario::selectRaw("*, concat(NOMBRE, ' ', APELLIDO, ' ', EMAIL) as datos_concatenados")
                ->havingRaw("datos_concatenados like '%$filtro%'")
                ->take($limit)
                ->orderByRaw($orden)
                ->get();
        if (count($respuesta->usuarios) == 0) {
            $respuesta->result = false;
            $respuesta->mensaje = "No hay usuarios que cumplan con el criterio de búsqueda.";
        }
        return $respuesta;
    }

    public static function post_usuarios($recibido) {
        $usuario = new Usuario();
        $usuario->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $usuario->save();
        if ($respuesta->result) {
            $respuesta->mensaje = "Usuario registrado correctamente.";
            $respuesta->usuario = $usuario;
        } else {
            $respuesta->mensaje = "Error registrando el usuario.";
        }
        return $respuesta;
    }

    public static function iniciar_sesion($email, $contrasenia) {
        $usuario = Usuario::where('EMAIL', '=', $email)->first();
        $respuesta = new stdClass();
        if ($usuario) {
            if ($usuario->CONTRASENIA == $contrasenia) {
                $respuesta->result = 1;
                $respuesta->usuario = $usuario;
                $respuesta->mensaje = "Datos ingresados correctamente.";
            } else {
                $respuesta->result = 0;
                $respuesta->mensaje = "Contraseña incorrecta.";
            }
        } else {
            $respuesta->result = -1;
            $respuesta->mensaje = "El email ingresado no se encuentra registrado.";
        }
        return $respuesta;
    }

}
