<?php

//include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/views/pasajesView.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/services/aeropuertoService.php';

class AeropuertosController {

    // Obtiene una instancia del modelo y de la vista de tareas
    //private $view;
    private $service;

    public function __construct() {
        //$this->view = new PasajesView();
        $this->service = new AeropuertoService();
    }
    
    public function getAllAeropuertos() {
        return parseAssocToAeropuerto($this->service->request_curl());
    }
    
}