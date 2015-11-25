<?php

//Buen Manual
//https://manuais.iessanclemente.net/index.php/Introduccion_a_API_REST_y_framework_Slim_de_PHP

require 'Slim/Slim.php';
require_once 'model/Pregunta.php';
// El framework Slim tiene definido un namespace llamado Slim
// Por eso aparece \Slim\ antes del nombre de la clase.
\Slim\Slim::registerAutoloader();

// Creamos la aplicación.
$app = new \Slim\Slim();

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
#$app->contentType('text/html; charset=utf-8');
// Definimos conexion de la base de datos.
// Lo haremos utilizando PDO con el driver mysql.
//$db->exec("set names utf8");


$app->get('/', function() {
    echo "Pagina de gestión API REST de mi aplicación.";
});

// Cuando accedamos por get a la ruta /usuarios ejecutará lo siguiente:
$app->get('/preguntas', function() {
    echo Pregunta::All();
});

// Accedemos por get a /usuarios/ pasando un id de usuario. 
// Por ejemplo /usuarios/veiga
// Ruta /usuarios/id
// Los parámetros en la url se definen con :parametro
// El valor del parámetro :idusuario se pasará a la función de callback como argumento
$app->get('/preguntas/:id', function($id) {
    echo 'pregunta por id';
});
//preguntas por filtro 
$app->get('/preguntas?filtro=:filtro', function($id) {
    echo "pregunta por filtro";
});

$app->put('/preguntas/:id', function($id) {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->save();
});

$app->delete('/preguntas/:id', function($id) {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->delete();
});

// Alta de usuarios en la API REST
$app->post('/preguntas', function() {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->save();

    if ($estado)
        echo json_encode(array('estado' => true, 'mensaje' => 'Datos insertados correctamente. ', 'id' => $usuario->id));
    else
        echo json_encode(array('estado' => false, 'mensaje' => "Error al insertar datos en la tabla.", 'id' => ''));
});
//aqui empiezan las áreas
$app->get('/areas', function() {
   echo "todas las areas";
});

// Accedemos por get a /usuarios/ pasando un id de usuario. 
// Por ejemplo /usuarios/veiga
// Ruta /usuarios/id
// Los parámetros en la url se definen con :parametro
// El valor del parámetro :idusuario se pasará a la función de callback como argumento
$app->get('/areas/:id', function($id) {
    echo 'areas por id';
});
$app->get('/preguntas/:id', function($id) {
    echo 'preguntas por el id del area';
});

$app->put('/areas/:id/preguntas', function($id) {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->save();
});

$app->delete('/areas/:id', function($id) {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->delete();
});

// Alta de usuarios en la API REST
$app->post('/areas', function() {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->save();

    if ($estado)
        echo json_encode(array('estado' => true, 'mensaje' => 'Datos insertados correctamente. ', 'id' => $usuario->id));
    else
        echo json_encode(array('estado' => false, 'mensaje' => "Error al insertar datos en la tabla.", 'id' => ''));
});

// aqui empiezan encabezados 
$app->get('/encabezados', function() {
    echo 'todos los encabezados';
});

// Accedemos por get a /usuarios/ pasando un id de usuario. 
// Por ejemplo /usuarios/veiga
// Ruta /usuarios/id
// Los parámetros en la url se definen con :parametro
// El valor del parámetro :idusuario se pasará a la función de callback como argumento
$app->get('/encabezados/:id', function($id) {
    echo 'encabezados por id ';
});
//encabezados por filtro 
$app->get('/encabezados?filtro=:filtro', function($id) {
    echo 'filtro encabezados';
});

$app->put('/encabezados/:id', function($id) {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->save();
});

$app->delete('/encabezados/:id', function($id) {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->delete();
});

// Alta de usuarios en la API REST
$app->post('/encabezados', function() {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->save();

    if ($estado)
        echo json_encode(array('estado' => true, 'mensaje' => 'Datos insertados correctamente. ', 'id' => $usuario->id));
    else
        echo json_encode(array('estado' => false, 'mensaje' => "Error al insertar datos en la tabla.", 'id' => ''));
});

//aqui empiezan las opciones 
$app->get('/opciones', function() {
    echo 'todas las opciones';
});

// Accedemos por get a /usuarios/ pasando un id de usuario. 
// Por ejemplo /usuarios/veiga
// Ruta /usuarios/id
// Los parámetros en la url se definen con :parametro
// El valor del parámetro :idusuario se pasará a la función de callback como argumento
$app->get('/opciones/:id', function($id) {
    echo 'opciones por id ';
});

$app->put('/opciones/:id', function($id) {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->save();
});

$app->delete('/opciones/:id', function($id) {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->delete();
});

// Alta de usuarios en la API REST
$app->post('/opciones', function() {
    // Los datos serán accesibles de esta forma:
    $p = json_decode($app->request->getBody());
    //echo json_encode($p->nombre);
    $usuario = new Pregunta();
    $usuario->id = $p->id;
    $usuario->apellido = $p->apellido;
    $usuario->nombre = $sp->nombre;
    $usuario->email = $p->email;
    $estado = $usuario->save();

    if ($estado)
        echo json_encode(array('estado' => true, 'mensaje' => 'Datos insertados correctamente. ', 'id' => $usuario->id));
    else
        echo json_encode(array('estado' => false, 'mensaje' => "Error al insertar datos en la tabla.", 'id' => ''));
});

$app->get('/resultados', function() {
    echo "resultados generales ";
});

$app->get('/resultados?id_area=:id_area', function($id_area) {
    echo "resultados geerales por area ";
});
$app->get('/resultados?id_usuario=:id_usuario&id_area=:id_area', function($id_usuario, $id_area) {
//    echo $id_usuario;
//    echo "<br>";
//    echo $id_area;
//    echo "algo";
    echo "resultados general de un usuario por area";
});
$app->get('/resultados?id_usuario=:id_usuario', function($id_usuario) {
    echo "resultados generales de un usuario ";
});





$app->run();
