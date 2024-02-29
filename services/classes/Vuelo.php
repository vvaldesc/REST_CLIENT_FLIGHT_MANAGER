<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/UT7_3_Actividad3_RESTFul_Cliente/services/classes/objectParser.php';

class Vuelo {
    private $identificador;
    private $aeropuertoorigen;
    private $aeropuertodestino;
    private $tipovuelo;
    private $fechavuelo;
    private $descuento;

    public function __construct($assoc) {
        // Verifica si el array asociativo contiene las claves necesarias
        if (isset($assoc['identificador'])) {
            
            // Asigna los valores del array asociativo a las propiedades de la clase
            $this->identificador = $assoc['identificador'] ?? null;
            $this->aeropuertoorigen = $assoc['aeropuertoorigen'] ?? null;
            $this->aeropuertodestino = $assoc['aeropuertodestino'] ?? null;
            $this->tipovuelo = $assoc['tipovuelo'] ?? null;
            $this->fechavuelo = $assoc['fechavuelo'] ?? null;
            $this->descuento = $assoc['descuento'] ?? null;
        } else {
            throw new Exception("Faltan datos en el array asociativo");
        }
    }
    
    public function toArray() {
        return get_object_vars($this);
    }
    
        // Getter para $identificador
    public function getIdentificador() {
        return $this->identificador;
    }

    // Setter para $identificador
    public function setIdentificador($identificador) {
        $this->identificador = $identificador;
    }

    // Getter para $aeropuertoorigen
    public function getAeropuertoOrigen() {
        return $this->aeropuertoorigen;
    }

    // Setter para $aeropuertoorigen
    public function setAeropuertoOrigen($aeropuertoorigen) {
        $this->aeropuertoorigen = $aeropuertoorigen;
    }

    // Getter para $aeropuertodestino
    public function getAeropuertoDestino() {
        return $this->aeropuertodestino;
    }

    // Setter para $aeropuertodestino
    public function setAeropuertoDestino($aeropuertodestino) {
        $this->aeropuertodestino = $aeropuertodestino;
    }

    // Getter para $tipovuelo
    public function getTipoVuelo() {
        return $this->tipovuelo;
    }

    // Setter para $tipovuelo
    public function setTipoVuelo($tipovuelo) {
        $this->tipovuelo = $tipovuelo;
    }

    // Getter para $fechavuelo
    public function getFechaVuelo() {
        return $this->fechavuelo;
    }

    // Setter para $fechavuelo
    public function setFechaVuelo($fechavuelo) {
        $this->fechavuelo = $fechavuelo;
    }

    // Getter para $descuento
    public function getDescuento() {
        return $this->descuento;
    }

    // Setter para $descuento
    public function setDescuento($descuento) {
        $this->descuento = $descuento;
    }
}