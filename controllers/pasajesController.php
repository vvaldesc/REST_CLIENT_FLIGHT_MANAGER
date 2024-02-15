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

    
    

    public function reservaHabitacion($idUsuario, $idhabitacion, $idHotel, $fAlta, $fBaja) {
        return $this->comprobarFechas($fAlta, $fBaja)
                ? $this->model->reservaHabitacion($idUsuario, $idhabitacion, $idHotel, $fAlta, $fBaja)
                : null;
    }

    public function comprobarFechas($fAlta, $fBaja) {
        // Obtener la fecha actual
        $fechaActual = date('Y-m-d');
        if ($fAlta < $fechaActual) {
            throw new Exception("La fecha de entrada no puede ser antes que hoy");
        }
        // Comprobar si la fecha de salida es posterior a la fecha de entrada
        if ($fBaja < $fAlta) {
            throw new Exception("Las fechas están al revés");
        }
        return true;
    }

    public function comprobarReserva($idhabitacion, $idHotel, $fAlta, $fBaja) {
        return $this->model->getDisponibilidadReserva($idhabitacion, $idHotel, $fAlta, $fBaja);
    }

    public function getReservasUsuario($id) {
        return $this->model->getReservasUsuario($id);
    }
}