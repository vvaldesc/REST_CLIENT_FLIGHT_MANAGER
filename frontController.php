
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/templates/generic_templates.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/templates/exception_templates.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/libraries/util_functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/services/classes/objectParser.php';


include_once $_SERVER['DOCUMENT_ROOT'].'/UT7_3_Actividad3_RESTFul_Cliente/controllers/pasajesController.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT7_3_Actividad3_RESTFul_Cliente/controllers/pasajerosController.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT7_3_Actividad3_RESTFul_Cliente/controllers/vuelosController.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT7_3_Actividad3_RESTFul_Cliente/controllers/pasajesController.php';

// Define la acción por defecto 
define('ACCION_DEFECTO', 'mostrarVuelos');
// Define el controlador por defecto 
define('CONTROLADOR_DEFECTO', 'vuelos');

// Comprueba la acción a realizar, que llegará en la petición. 
// Si no hay acción a realizar lanzará la acción por defecto, que es listar
// Y se carga la acción, llama a la función cargarAccion 
function lanzarAccion($controllerObj) {
    if (isset($_GET["action"]) && method_exists($controllerObj,
                    $_GET["action"])) {
        cargarAccion($controllerObj, $_GET["action"]);
    } else {
        cargarAccion($controllerObj, ACCION_DEFECTO);
        //O añadir una página indicando el error de la acción 
        //die("Se ha cargado una acción errónea");
    }
}

// Lo que hace es ejecutar una función que va a existir en el controlador 
// y que se llama como la acción. Recibe un objeto controlador. 
function cargarAccion($controllerObj, $action) {
    $accion = $action;
    $controllerObj->$accion();
}

// Carga el controlador especificado y devuelve una instancia del mismo 
function cargarControlador($nombreControlador) {
    $controlador = $nombreControlador . 'Controller';
    if (class_exists($controlador)) {
        return new $controlador();
    } else {
        // Si el controlador no existe, se lanza una excepción 
        //O añadir una página indicando el error del controlador 
        die("controlador no válido");
    }
}

// Carga el controlador y la acción correspondientes 
if (isset($_GET["controller"])) {
    $controllerObj = cargarControlador($_GET["controller"]);
    lanzarAccion($controllerObj);
} else {
    $controllerObj = cargarControlador(CONTROLADOR_DEFECTO);
    lanzarAccion($controllerObj);
} 
