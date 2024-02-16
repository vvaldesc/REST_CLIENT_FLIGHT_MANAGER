<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/views/pasajesView.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/services/pasajeService.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/libraries/util_functions.php';

class PasajesController {

    // Obtiene una instancia del modelo y de la vista de tareas
    private $view;
    private $service;

    public function __construct() {
        $this->view = new PasajesView();
        $this->service = new PasajeService();
    }
    
    public function getPasajesVuelo($identificadorVuelo) {
        return $this->service->request_pasaje_vuelo($identificadorVuelo);
    }
    
    public function getInfoVuelos() {
        return (new vuelosController)->getVuelos();
    }
    
    public function getAllPasajeros() {
        return (new PasajerosController)->getPasajeros();
    }
    
    public function formularioPasaje() {
        //Para este formulario voy a necesitar toda la información de vuelos desde la base de datos.
        //Podría guardar la información de la tabla mostrada en una variable superglobal pero
        //es muy posible que la información de los vuelos cambie en el tiempo
        $vuelos = $this->getInfoVuelos();
        $pasajeros = $this->getAllPasajeros();
        
        return $this->view->mostrarFormulario($vuelos,$pasajeros);
    }
    
    public function interfazPasajes() {
        mostrar(menuSuperior().$this->formularioPasaje());
    }

    public function optionsPasajeros($pasajeros) {
        return $this->view->optionsPasajeros($pasajeros);
    }
    
    public function tablaPasajes($pasajes) {
        return $this->view->tablaPasajes($pasajes);
    }
    
}