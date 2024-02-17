<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/services/classes/objectParser.php';

class Pasajero {

    private $pasajeroCod;
    private $nombre;
    private $tlf;
    private $direccion;
    private $pais;

    public function __construct($assoc) {
        // Verifica si el array asociativo contiene las claves necesarias
        if (isset($assoc['pasajeroCod']) &&
                isset($assoc['nombre']) &&
                isset($assoc['tlf']) &&
                isset($assoc['direccion']) &&
                isset($assoc['pais'])) {

            // Asigna los valores del array asociativo a las propiedades de la clase
            $this->identificador = $assoc['pasajeroCod'];
            $this->pasajeroCod = $assoc['nombre'];
            $this->aeropuertoorigen = $assoc['tlf'];
            $this->aeropuertodestino = $assoc['direccion'];
            $this->tipovuelo = $assoc['pais'];
        } else {
            throw new Exception("Faltan datos en el array asociativo");
        }
    }

    public function toArray() {
        return get_object_vars($this);
    }

// Getter para $pasajeroCod
    public function getPasajeroCod() {
        return $this->pasajeroCod;
    }

// Setter para $pasajeroCod
    public function setPasajeroCod($pasajeroCod) {
        $this->pasajeroCod = $pasajeroCod;
    }

// Getter para $nombre
    public function getNombre() {
        return $this->nombre;
    }

// Setter para $nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

// Getter para $tlf
    public function getTlf() {
        return $this->tlf;
    }

// Setter para $tlf
    public function setTlf($tlf) {
        $this->tlf = $tlf;
    }

// Getter para $direccion
    public function getDireccion() {
        return $this->direccion;
    }

// Setter para $direccion
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

// Getter para $pais
    public function getPais() {
        return $this->pais;
    }

// Setter para $pais
    public function setPais($pais) {
        $this->pais = $pais;
    }
}

?>
