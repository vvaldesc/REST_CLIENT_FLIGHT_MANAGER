<?php

class PasajeService {

    public function __construct() {
        
    }

    function request_curl() {
        $urlmiservicio = "http://localhost/_servWeb/UT7_3_Actividad3_RESTFul_Servidor/PasajeServices.php/";
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

    //GET con un dep 
    function request_uno($id) {
        $urlmiservicio = "http://localhost/_servWeb/UT7_3_Actividad3_RESTFul_Servidor/PasajeServices.php/?idpasaje=" . $id;
        $conexion = curl_init();
        //Url de la petición 
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        //Tipo de petición 
        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
        //Tipo de contenido 
        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        //para recibir una respuesta 
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);
        if ($res) {
            echo "<br>Salida request_curl<br>";
            print_r($res);
        }
        curl_close($conexion);
    }

    function request_pasaje_vuelo($id) {
        $urlmiservicio = "http://localhost/_servWeb/UT7_3_Actividad3_RESTFul_Servidor/PasajeServices.php/?identificador=" . $id;
        $conexion = curl_init();
        //Url de la petición 
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        //Tipo de petición 
        curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);
        //Tipo de contenido 
        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        //para recibir una respuesta 
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);
        if ($res) {
            return json_decode($res, true);
        }
        curl_close($conexion);
    }

    //POST Van datos, se pone el Content-Length del envío 
    function request_post($dep, $nom, $loc) {
        $envio = json_encode(array("dept_no" => $dep, "dnombre" => $nom, "loc" => $loc));
        $urlmiservicio = "http://localhost/_servWeb/UT7_3_Actividad3_RESTFul_Servidor/PasajeServices.php/";
        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        //Cabecera, tipo de datos y longitud de envío
        curl_setopt($conexion, CURLOPT_HTTPHEADER,
                array('Content-type: application/json', 'Content-Length: ' . mb_strlen($envio)));
        //Tipo de petición 
        curl_setopt($conexion, CURLOPT_POST, TRUE);
        //Campos que van en el envío 
        curl_setopt($conexion, CURLOPT_POSTFIELDS, $envio);
        //para recibir una respuesta 
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);
        if ($res) {
            echo "<br>Salida request_post<br>";
            print_r($res);
        }
        curl_close($conexion);
    }

//PUT para modificar 
    function request_put($dep, $nom, $loc) {
        $envio = json_encode(array("dept_no" => $dep, "dnombre" => $nom, "loc" => $loc));
        $urlmiservicio = "http://localhost/_servWeb/UT7_3_Actividad3_RESTFul_Servidor/PasajeServices.php/";
        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        //Cabecera, tipo de datos y longitud de envío 
        curl_setopt($conexion, CURLOPT_HTTPHEADER,
                array('Content-type: application/json', 'Content-Length: ' . mb_strlen($envio)));
        //Tipo de petición 
        curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, 'PUT');
        //Campos que van en el envío 
        curl_setopt($conexion, CURLOPT_POSTFIELDS, $envio);
        //para recibir una respuesta 
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);
        if ($res) {
            echo "<br>Salida request_put<br>";
            print_r($res);
        }
        curl_close($conexion);
    }

//DELETE para borrar 
    function request_delete($id) {
        $urlmiservicio = "http://localhost/_servWeb/UT7_3_Actividad3_RESTFul_Servidor/PasajeServices.php/?id=" . $id;
        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        //Cabecera, tipo de datos y longitud de envío 
        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        //Tipo de petición
        curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, 'DELETE');
        //Campos que van en el envío 
        //curl_setopt($conexion, CURLOPT_POSTFIELDS, $envio); 
        //para recibir una respuesta 
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($conexion);
        if ($res) {
            echo "<br>Salida request_delete<br>";
            print_r($res);
        }
        curl_close($conexion);
    }
}
