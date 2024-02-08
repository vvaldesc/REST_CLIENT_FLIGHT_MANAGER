
<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/controllers/usuariosController.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/controllers/reservasController.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/controllers/hotelesController.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/controllers/habitacionesController.php';
/*

include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/views/usuariosView.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/views/reservasView.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/views/hotelesView.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/views/habitacionesView.php';*/

/*
include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/models/UsuariosModel.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/models/ReservasModel.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/models/HotelesModel.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/UT6_2_Ejercicio_Reserva_Hoteles_MVC/models/HabitacionesModel.php';
*/
// Define la acción por defecto 
define('ACCION_DEFECTO', 'mostrarFormulario');
// Define el controlador por defecto 
define('CONTROLADOR_DEFECTO', 'Usuarios');

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
