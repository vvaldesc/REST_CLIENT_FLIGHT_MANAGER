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
        if (isset($assoc['idpasaje']) &&
            isset($assoc['pasajerocod']) &&
            isset($assoc['identificador']) &&
            isset($assoc['numasiento']) &&
            isset($assoc['clase']) &&
            isset($assoc['pvp'])) {
            
            // Asigna los valores del array asociativo a las propiedades de la clase
            $this->idpasaje = $assoc['idpasaje'];
            $this->pasajerocod = $assoc['pasajerocod'];
            $this->identificador = $assoc['identificador'];
            $this->numasiento = $assoc['numasiento'];
            $this->clase = $assoc['clase'];
            $this->pvp = $assoc['pvp'];
        } else {
            throw new Exception("Faltan datos en el array asociativo");
        }
    }
    
    public function toArray() {
        return get_object_vars($this);
    }
}
