<?php

require 'cors.php';
require 'Slim/Slim.php';

foreach (glob("controller/*.php") as $filename) {
    require_once $filename;
}

// El framework Slim tiene definido un namespace llamado Slim
// Por eso aparece \Slim\ antes del nombre de la clase.
\Slim\Slim::registerAutoloader();

// Creamos la aplicación.
$app = new \Slim\Slim();

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
#$app->contentType("application/json; charset=utf-8");

$app->get('/', function() {
    echo "Pagina de gestión API REST de mi aplicación.";
});

//GET: Obtener, Solicitar
//POST: Enviar, Registrar
//PUT: Actualizar
//DELETE: Eliminar un registro
//
// Accedemos por get a /usuarios/ pasando un id de usuario. 
// Por ejemplo /usuarios/veiga
// Ruta /usuarios/id
// Los parámetros en la url se definen con :parametro
// El valor del parámetro :idusuario se pasará a la función de callback como argumento
//
//Usuarios
$app->post("/usuarios/sesion", "iniciar_sesion");
$app->get("/usuarios", "get_usuarios");
$app->post("/usuarios", "post_usuarios");
$app->get("/usuarios/:id/retos", "get_retos_usuario");
$app->delete("/usuarios/:email", "delete_usuario");
$app->put("/usuarios/:email", "put_usuario");

//Preguntas
$app->get('/preguntas', "get_preguntas");

$app->get('/preguntas/:id', function($id) {
    //Modificar
    //No es prioritario que se busquen las preguntas por id
    echo Pregunta::find($id);
});
$app->post('/preguntas', 'post_preguntas');
$app->put('/preguntas/:id', 'put_preguntas');
$app->delete('/preguntas/:id', 'delete_pregunta'); //Modificar
$app->get('/preguntas/:id/opciones', 'get_opciones_pregunta');
$app->get('/no-respondida', 'get_pregunta_no_respondida');

//Areas
$app->get('/areas', "get_areas");
$app->get('/areas/:id/preguntas', "get_preguntas_area");
$app->post('/areas', "post_areas");

//Encabezados
$app->get('/encabezados', 'get_encabezados');
$app->post('/encabezados', 'post_encabezados');

//Retos
$app->post('/retos', 'post_retos');
$app->get("/retos/:id/participantes", "get_participantes_reto");

//Respondidas
$app->post('/respondidas', 'post_respondida');

$app->get('/encabezados/:id', function($id) {
    echo 'encabezados por id ';
});

$app->put('/encabezados/:id', function($id) {
    
});

$app->delete('/encabezados/:id', function($id) {
    
});

//aqui empiezan las opciones 
$app->get('/opciones', function() {
    echo 'todas las opciones';
});


$app->get('/opciones/:id', function($id) {
    echo 'opciones por id ';
});

$app->put('/opciones/:id', function($id) {
    
});

$app->delete('/opciones/:id', function($id) {
    
});

$app->post('/opciones', function() {
    
});

$app->get('/resultados/:id', "get_resultados_participante");

$app->get('/resultados?id_usuario=:id_usuario', function($id_usuario) {
    echo "resultados generales de un usuario ";
});

$app->run();

//Usuarios fnc
function iniciar_sesion() {
    $request = \Slim\Slim::getInstance()->request();
    $recibido = json_decode($request->getBody());
    $email = $recibido->email;
    $contrasenia = !isset($recibido->contrasenia) ? "" : $recibido->contrasenia;
    echo json_encode(UsuarioController::iniciar_sesion($email, $contrasenia));
}

function post_usuarios() {
    $request = \Slim\Slim::getInstance()->request();
    $recibido = json_decode($request->getBody());
    echo json_encode(UsuarioController::post_usuarios($recibido));
}

function get_retos_usuario($email) {
    echo json_encode(UsuarioController::get_retos_usuario($email));
}

function get_usuarios() {
    $request = \Slim\Slim::getInstance()->request();
    $limit = null !== $request->get("limit") ? $request->get("limit") : 10;
    $filtro = null !== $request->get("filtro") ? $request->get("filtro") : "";
    $orden = null !== $request->get("orden") ? "datos_concatenados" : "rand()";
    echo json_encode(UsuarioController::get_usuarios($limit, $filtro, $orden));
}

function delete_usuario($email) {
    echo json_encode(UsuarioController::delete_usuario($email));
}

function put_usuario($email) {
    $request = \Slim\Slim::getInstance()->request();
    $recibido = json_decode($request->getBody());
    echo json_encode(UsuarioController::put_usuario($email, $recibido));
}

//Area fnc
function get_areas() {
    echo json_encode(AreaController::get_areas());
}

function get_preguntas() {
    $request = \Slim\Slim::getInstance()->request();
    $limit = null !== $request->get("limit") ? $request->get("limit") : 10;
    $filtro = null !== $request->get("filtro") ? $request->get("filtro") : "";
    echo json_encode(PreguntaController::get_preguntas($limit, $filtro));
}

function post_preguntas() {
    $request = \Slim\Slim::getInstance()->request();
    // Los datos serán accesibles de esta forma:
    $recibido = json_decode($request->getBody());
    echo json_encode(PreguntaController::post_preguntas($recibido));
}

function put_preguntas($id) {
    echo json_encode(PreguntaController::put_preguntas($id));
}

function delete_pregunta($id) {
    echo json_encode(PreguntaController::delete_pregunta($id));
}

function get_opciones_pregunta($id) {
    echo json_encode(PreguntaController::get_opciones_pregunta($id));
}

function get_preguntas_area($id) {
    echo json_encode(AreaController::get_preguntas_area($id));
}

function post_areas() {
    $request = \Slim\Slim::getInstance()->request();
    $recibido = json_decode($request->getBody());
    echo json_encode(AreaController::post_areas($recibido));
}

function post_retos() {
    $request = \Slim\Slim::getInstance()->request();
    $recibido = json_decode($request->getBody());
    echo json_encode(RetoController::post_retos($recibido));
}

function get_pregunta_no_respondida() {
    $request = \Slim\Slim::getInstance()->request();
    $email = null !== $request->get("email") ? $request->get("email") : null;
    $codreto = null !== $request->get("codreto") ? $request->get("codreto") : null;
    $codarea = null !== $request->get("codarea") ? $request->get("codarea") : null;
    if (isset($email) && isset($codreto) && isset($codarea)) {
        echo html_entity_decode(json_encode(PreguntaController::get_pregunta_no_respondida(
                                $email, $codreto, $codarea
        )));
    } else {
        $respuesta = new stdClass();
        $respuesta->result = false;
        $respuesta->mensaje = "Error. Revise los datos enviados.";
        echo json_encode($respuesta);
    }
}

function post_encabezados() {
    $request = \Slim\Slim::getInstance()->request();
    $recibido = json_decode($request->getBody());
    echo json_encode(EncabezadoController::post_encabezados($recibido));
}

function get_encabezados() {
    echo json_encode(EncabezadoController::get_encabezados());
}

function post_respondida() {
    $request = \Slim\Slim::getInstance()->request();
    $recibido = json_decode($request->getBody());
    echo json_encode(RetoController::post_respondida($recibido));
}

//Retos fnc
function get_participantes_reto($id) {
    echo json_encode(RetoController::get_participantes_reto($id));
}

//Participante fnc
function get_resultados_participante($id) {
    echo json_encode(ParticipanteController::get_resultados_participante($id));
}
