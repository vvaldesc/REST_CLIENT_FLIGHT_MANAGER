<?php

class Pasaje {
    private $idpasaje;
    private $pasajerocod;
    private $identificador;
    private $numasiento;
    private $clase;
    private $pvp;

    public function __construct($assoc) {
        // Verifica si el array asociativo contiene las claves necesarias
        if (isset($assoc['pasajerocod'])){
            // Asigna los valores del array asociativo a las propiedades de la clase
            $this->idpasaje = $assoc['idpasaje'] ?? null;
            $this->pasajerocod = $assoc['pasajerocod'] ?? null;
            $this->identificador = $assoc['identificador'] ?? null;
            $this->numasiento = $assoc['numasiento'] ?? null;
            $this->clase = $assoc['clase'] ?? null;
            $this->pvp = $assoc['pvp'] ?? null;
        } else {
            throw new Exception("Faltan datos en el array asociativo");
        }
    }
    
    public function toArray() {
        return get_object_vars($this);
    }
    
    // Getter para $idpasaje
    public function getIdPasaje() {
        return $this->idpasaje;
    }

    // Setter para $idpasaje
    public function setIdPasaje($idpasaje) {
        $this->idpasaje = $idpasaje;
    }

    // Getter para $pasajerocod
    public function getPasajeroCod() {
        return $this->pasajerocod;
    }

    // Setter para $pasajerocod
    public function setPasajeroCod($pasajerocod) {
        $this->pasajerocod = $pasajerocod;
    }

    // Getter para $identificador
    public function getIdentificador() {
        return $this->identificador;
    }

    // Setter para $identificador
    public function setIdentificador($identificador) {
        $this->identificador = $identificador;
    }

    // Getter para $numasiento
    public function getNumAsiento() {
        return $this->numasiento;
    }

    // Setter para $numasiento
    public function setNumAsiento($numasiento) {
        $this->numasiento = $numasiento;
    }

    // Getter para $clase
    public function getClase() {
        return $this->clase;
    }

    // Setter para $clase
    public function setClase($clase) {
        $this->clase = $clase;
    }

    // Getter para $pvp
    public function getPVP() {
        return $this->pvp;
    }

    // Setter para $pvp
    public function setPVP($pvp) {
        $this->pvp = $pvp;
    }    
}
