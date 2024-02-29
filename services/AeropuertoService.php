<?php

class AeropuertoService {
    public function __construct() {
        
    }

    function request_curl() {
        $urlmiservicio = "http://localhost/_servWeb/UT7_3_Actividad3_RESTFul_Servidor/AeropuertoServices.php/";
        $conexion = curl_init();
        //Url de la petición 
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        //Tipo de petición 
        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
        //Tipo de contenido de la respuesta 
        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        //para recibir una respuesta 
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);
        if ($res) {
            return json_decode($res, true);
        }
        curl_close($conexion);
    }
}
