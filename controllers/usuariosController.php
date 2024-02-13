<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/views/usuariosView.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/services/usuarioService.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/libraries/utilidades.php';

class UsuariosController {

    // Obtiene una instancia del modelo y de la vista de tareas
    private $service;
    private $view;

    public function __construct() {
        $this->service = new Usuario();
        $this->view = new UsuariosView();
    }

    // Muestra el formulario para añadir una nueva tarea
    public function mostrarFormulario() {
        // Muestra la vista del formulario
        mostrar($this->view->mostrarLoginPrincipal());
    }
    
    public function mostrarCookie($nombre) {
        return isset($_COOKIE[$nombre]) ? ($_COOKIE[$nombre]) : '';
    }
    
    public function crearCookie() {
        setcookie('ultConexionFecha', entornoH3('Última conexión del usuario: '.date('d/m/Y H:i:s')), time() + 600, "/");
    }
    
    public function cerrarSesion() {
        cerrarSesion();
    }

    public function mostrarFormularioLoginErroneo() {
        // Muestra la vista del formulario
        mostrar($this->view->mostrarLoginPrincipal(mensajeError("Inicio de sesión no válido")));
    }

    public function mostrarHomePage() {
        // Muestra la vista del formulario
        mostrar($this->view->homePage());
    }

    public function comprobarRegistroAntigo() {
        // Muestra la vista del formulario
        try {
            $hashPass = null;
            if (isset($_POST["miUsuario"])) {
                $miUsuario = unserialize(base64_decode($_POST["miUsuario"]));
                $hashPass = $miUsuario->contraseña;
                $usr = $miUsuario->nombre;
            } else if (isset($_POST["password"]) && isset($_POST["usr"]) && $_POST["password"] != '' && $_POST["usr"] != '') {
                $password = $_POST["password"];
                $usr = $_POST["usr"];
            } else {
                if ($_POST["password"] != '' && $_POST["usr"] != '')
                    throw new Exception("No has introducido las credenciales correctamente");
                if ($_POST["miUsuario"])
                    throw new Exception("No hay información de usuario");
            }
            //Sentencia SQL
            if (!$hashPass)
                $hashPass = hash('sha256', $password);
            $tabla = $this->model->extraerUsuario($usr);
            if (!$tabla) {
                throw new Exception("El usuario no existe o no se realizó correctamente");
            } else if (count($tabla) === 1 && $hashPass === $tabla[0]->contraseña) {
                $this->model = $tabla[0];
                return $this->model;
            } else if (count($tabla) === 0) {
                throw new Exception("El usuario no existe o no se realizó correctamente");
            }
        } catch (Exception $exc) {
            $trazo = debug_backtrace();
            // Verifica si la función fue llamada desde hotelesController.php
            foreach ($trazo as $llamada) {
                if (isset($llamada['file']) && in_array(str_replace("\\", "/", $llamada['file']), arrControladorRestringido())) {
                    // La pila de llamadas incluye hotelesController.php
                    header('Location: ' . $_SERVER['PHP_SELF']);
                    exit();
                }
            }
            return new Usuario(); //Si la página es pública paso un ususario vacío
        }
    }

    public function comprobarRegistro() {
        // Si se envió un usuario serializado
        if (isset($_POST["miUsuario"])) {
            return unserialize(base64_decode($_POST['miUsuario']));
        }
        // Si se enviaron credenciales de usuario y contraseña
        else if (isset($_POST["usr"]) && isset($_POST["password"])) {
            $miUsuario = $this->model->existeUsuario($_POST["usr"], $_POST["password"]);
            // Si el usuario existe, devolverlo
            if ($miUsuario) {
                return $miUsuario;
            }
            // Si no existe, cerrar sesión
            else {
                cerrarSesion(true);
            }
        }
    }
    
    public function mostrarDatos() {
        mostrar(request_curl());
    }
}
