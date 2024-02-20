<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/services/classes/Pasaje.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/services/classes/Pasajero.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/services/classes/Vuelo.php';



/**
 * reemplaza cada instancia del array asociativo que referencie a vuelos
 * con una instancia de la clases vuelos.
 * Tanto como si te trata de un array de vuelos como de un array de vuelo
 * 
 * @param type array $res
 * @return \Vuelo
 */
function parseAssocToVuelo($res) {
    if(!$res || $res === "SIN DATOS"){ throw new Exception("Lo sentimos... no existen vuelos para mostrar.");}
        $array = array();
        foreach ($res as $vuelo) {
            if (!is_array($vuelo)) throw new Exception("Lo sentimos... hubo un error mostrando los datos.");
            array_push($array,new Vuelo($vuelo));
        }
        return $array;
}

/**
 * reemplaza cada instancia del array asociativo que referencie a pasajes
 * con una instancia de la clases pasajes.
 * Tanto como si te trata de un array de pasajes como de un array de pasajes
 * 
 * @param type array $res
 * @return \Pasaje
 */
function parseAssocToPasaje($res) {
    if(!$res || $res === "SIN DATOS") throw new Exception(pantallaMensajeError("Lo sentimos... no existen pasajes para mostrar"));
        $array = array();
        foreach ($res as $pasaje) {
            array_push($array,new Pasaje($pasaje));
        }
        return $array;
}

/**
 * reemplaza cada instancia del array asociativo que referencie a pasajes
 * con una instancia de la clases pasajes.
 * Tanto como si te trata de un array de pasajes como de un array de pasajes
 * 
 * @param type array $res
 * @return \Pasajero
 */
function parseAssocToPasajero($res) {
    if(!$res || $res === "SIN DATOS") throw new Exception(pantallaMensajeError("Lo sentimos... no existen pasajeros para mostrar"));
        $array = array();
        foreach ($res as $pasajero) {
            array_push($array,new Pasajero($pasajero));
        }
        return $array;
}

