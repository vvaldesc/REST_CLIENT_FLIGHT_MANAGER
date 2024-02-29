<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/views/vuelosView.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/services/VueloService.php';



class vuelosController {

    // Obtiene una instancia del modelo y de la vista de tareas
    private $view;
    private $service;

    public function __construct() {
        $this->view = new VuelosView();
        $this->service = new VueloService();
    }
    
    public function mostrarFormularioPasaje() {
        mostrar($this->view->mostrarFormulario());
    }

    public function comprobarReserva($idhabitacion, $idHotel, $fAlta, $fBaja) {
        return $this->model->getDisponibilidadReserva($idhabitacion, $idHotel, $fAlta, $fBaja);
    }

    public function getReservasUsuario($id) {
        return $this->model->getReservasUsuario($id);
    }
    
    public function mostrarVuelos() {
        mostrar(menuSuperior().$this->view->tablaVuelos($this->getVuelos()));
    }
    
    public function getVuelos() {
        return parseAssocToVuelo($this->service->request_curl());
    }
    
    public function getUnVuelo($id) {
        return parseAssocToVuelo(array($this->service->request_uno($id)));
    }
    
    public function mostrarFormularioVuelo() {
        mostrar(menuSuperior().$this->view->formularioVuelo($this->getVuelos()));
    }
    
    public function optionsVuelos($vuelos) {
        return $this->view->optionsVuelos($vuelos);
    }
    
    public function optionsVuelosSelected($vuelos,$selected) {
        return $this->view->optionsVuelosSelected($vuelos,$selected);
    }
   
    
    public function infoVuelo($identificador) {
        return $this->view->tablaVuelo($this->getUnVuelo($identificador));
    }
    
    /**
     * Maneja la acción a realizar del formulario Selección vuelo
     */
    public function manejarAccion() {
        try {
            if (!isset($_POST["identificadorVuelo"]) || $_POST["identificadorVuelo"]=="")
                throw new Exception("No seleccionaste identificador de vuelo");
            if (isset($_POST["1"])) {
                mostrar(menuSuperior().$this->infoVuelo($_POST["identificadorVuelo"]));
            } else if (isset($_POST["2"])) {
                $pasajes = (new PasajesController)->getPasajesVuelo($_POST["identificadorVuelo"]);
                if (!is_array($pasajes) || $pasajes==="SIN DATOS")
                    throw new Exception("No existen pasajes en el vuelo seleccionado");
                mostrar(menuSuperior().(new PasajesController)->tablaPasajes($pasajes));
            } else {
                throw new Exception(mensajeError("No existe la funcionalidad seleccinada"));
            }
            
        } catch (Exception $exc) {
            mostrar(pantallaMensajeError($exc->getMessage()));
        }
    }
    
}