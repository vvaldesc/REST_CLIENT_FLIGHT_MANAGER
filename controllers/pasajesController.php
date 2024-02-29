<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/views/pasajesView.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/services/pasajeService.php';

class PasajesController {

    // Obtiene una instancia del modelo y de la vista de tareas
    private $view;
    private $service;

    public function __construct() {
        $this->view = new PasajesView();
        $this->service = new PasajeService();
    }

    public function getPasajesVuelo($identificadorVuelo) {
        return parseAssocToPasaje($this->service->request_pasaje_vuelo($identificadorVuelo));
    }

    public function getInfoVuelos() {
        return (new vuelosController)->getVuelos();
    }

    public function getAllPasajeros() {
        return (new PasajerosController)->getPasajeros();
    }

    public function getAllPasajes() {
        return parseAssocToPasaje($this->service->request_curl());
    }
    
    public function mostrarPantallaEdicion() {
        mostrar($this->formularioPasaje());
    }

    public function formularioPasaje() {
        //Para este formulario voy a necesitar toda la información de vuelos desde la base de datos.
        //Podría guardar la información de la tabla mostrada en una variable superglobal pero
        //es muy posible que la información de los vuelos cambie en el tiempo
        $vuelos = $this->getInfoVuelos();
        $pasajeros = $this->getAllPasajeros();
        $pasajes = null; $pasaje = null;
        if(isset($_POST['pasajes'])) $pasajes = isset($_POST['pasajes'])
            ? unserialize(base64_decode($_POST['pasajes']))
            : $this->getAllPasajeros();
        if($pasajes) $pasaje = $pasajes[intval($_POST['pasajes'])];
        
        return !isset($_POST['editarPasaje'])
            ?  $this->view->mostrarFormularioInsertar($vuelos, $pasajeros)
            :  $this->view->mostrarFormularioEditar($vuelos, $pasajeros, $pasaje);
    }

    public function mostrarInsertarPasajes() {
        try {
            mostrar(menuSuperior() . $this->formularioPasaje());
        } catch (Exception $exc) {
            mostrar(pantallaMensajeError($exc->getMessage()));
        }
    }

    public function insertarPasaje() {
        try {
            if ($this->service->request_post($_POST["pasajerocod"], $_POST["vuelo"], $_POST["numasiento"], $_POST["clase"], $_POST["pvp"])) {
                header("Location:index.php?controller=Pasajes&action=mostrarInsertarPasajes");
                quit();
            } else {
                throw new Exception("Lo sentimos... Hubo un error creando tu pasaje, inténtalo de nuevo más tarde");
            }
        } catch (Exception $exc) {
            mostrar(pantallaMensajeError($exc->getMessage()));
        }
    }

    public function editarPasaje() {
        try {
            if (!isset($_POST["cancelarCambiosPasaje"])) {
                $this->service->request_put($_POST["idpasaje"], $_POST["pasajerocod"], $_POST["identificador"], $_POST["numasiento"], $_POST["clase"], $_POST["pvp"]);
                header("Location:index.php?controller=Pasajes&action=mostrarGestionarPasajes&exitoEditar=true&idEditado=" . $_POST["idpasaje"]);
                quit();
            } else {
                header("Location:index.php?controller=Pasajes&action=mostrarGestionarPasajes&exitoEditar=false");
                quit();
            }
        } catch (Exception $exc) {
            mostrar(pantallaMensajeError($exc->getMessage()));
        }
    }

    public function tablaGestionable() {
        $allPasajes = isset($_POST["editarPasaje"]) ? unserialize(base64_decode($_POST["pasajes"])) : $this->getAllPasajes();
        return $this->view->tablaGestionarPasajes($allPasajes);
    }

    public function eliminarRegistro() {
        try {
            if (isset($_POST["borrarPasaje"])) {
                $id = $this->eliminarRegistroServicio();
                header("Location:index.php?controller=Pasajes&action=mostrarGestionarPasajes&exitoBorrar=true&idBorrado=" . $id);
                quit();
            } else {
                header("Location:index.php?controller=Pasajes&action=mostrarGestionarPasajes&exitoBorrar=false");
                quit();
            }
        } catch (Exception $exc) {
            mostrar(pantallaMensajeError($exc->getMessage()));
        }
    }

    public function eliminarRegistroServicio() {
        return $this->service->request_delete($_POST["borrarPasaje"]);
    }

    public function mostrarGestionarPasajes() {
            $contenidoPrincipalHtml= $this->tablaGestionable();

        try {
            if (isset($_GET['exitoBorrar'])) {
                if ($_GET['exitoBorrar'] === 'true' && isset($_GET['idBorrado'])) {
                    mostrar(pantallaMensajeError('Se ha borrado el pasaje ' . $_GET['idBorrado'], $contenidoPrincipalHtml));
                } else {
                    throw new Exception('Lo sentimos, hubo un error borrando el pasaje');
                }
            }
            else if (isset($_GET['exitoEditar'])) {
                if ($_GET['exitoEditar'] === 'true' && isset($_GET['idEditado'])) {
                    mostrar(pantallaMensajeExito('Se ha editado el pasaje ' . $_GET['idEditado'], $contenidoPrincipalHtml));
                } else {
                    throw new Exception('Edición cancelada');
                }
            }
            else {mostrar(menuSuperior() . $contenidoPrincipalHtml);}
        } catch (Exception $exc) {
            mostrar(pantallaMensajeError($exc->getMessage(), $contenidoPrincipalHtml));
        }
    }

    public function optionsPasajeros($pasajeros) {
        return $this->view->optionsPasajeros($pasajeros);
    }
    
        public function optionsPasajerosSelected($pasajeros,$selected) {
        return $this->view->optionsPasajerosSelected($pasajeros,$selected);
    }

    public function tablaPasajes($pasajes) {
        return $this->view->tablaPasajes($pasajes);
    }
}
