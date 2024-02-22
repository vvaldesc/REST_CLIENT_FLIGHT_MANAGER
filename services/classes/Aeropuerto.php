<?php

class Aeropuerto {
    private $ciudad;
    private $codaeropuerto;
    private $nombre;
    private $pais;
    private $tasa;

    public function __construct($assoc) {
        // Verifica si el array asociativo contiene las claves necesarias
        if (isset($assoc['codaeropuerto'])){
            // Asigna los valores del array asociativo a las propiedades de la clase
            $this->codaeropuerto = $assoc['codaeropuerto'] ?? null;
            $this->nombre = $assoc['nombre'] ?? null;
            $this->ciudad = $assoc['ciudad'] ?? null;
            $this->pais = $assoc['pais'] ?? null;
            $this->tasa = $assoc['tasa'] ?? null;
        } else {
            throw new Exception("Faltan datos en el array asociativo");
        }
    }
    
    public function toArray() {
        return get_object_vars($this);
    }
    
    // Métodos getter
    public function getCodAeropuerto() {
        return $this->codaeropuerto;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function getPais() {
        return $this->pais;
    }

    public function getTasa() {
        return $this->tasa;
    }

    // Métodos setter
    public function setCodAeropuerto($codaeropuerto) {
        $this->codaeropuerto = $codaeropuerto;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setCiudad($identificador) {
        $this->ciudad = $ciudad;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public function setTasa($tasa) {
        $this->tasa = $tasa;
    }   
}
