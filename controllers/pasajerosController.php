<?php

//include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/views/pasajerosView.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/services/pasajeroService.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/libraries/util_functions.php';

class PasajerosController {

    // Obtiene una instancia del modelo y de la vista de tareas
    //private $view;
    private $service;

    public function __construct() {
        //$this->view = new PasajeroView();
        $this->service = new PasajeroService();
    }
    

    public function getPasajeros() {
        //solo devuelve el codigo de pasajero y el nombre, ya que son los datos que necesito traer al cliente
        return $this->service->request_curl();
    }
}