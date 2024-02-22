
<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/libraries/util_functions.php';

class VuelosView {

    public function botonDetalles() {
        return '<button name="detallesVuelo" value="" type="submit" class="btn btn-secondary btn-lg">Detalles</button>';
    }
    
    public function formularioDetalleVuelo($vuelo) {
        return '<form action ="index.php?controller=Pasajes&action=mostrarInterfazReserva" method="POST">' . $this->botonReserva() . ''
                . '<input type="hidden" name="vuelo" value=' . base64_encode(serialize($vuelo)) . '>' //Instancia vuelo a reservar
                . '</form>';
    }
    
    public function contadorPasajerosVuelo($id) {
        $contador = 0;
        $pasajes = (new PasajesController)->getAllPasajes();
        foreach ($pasajes as $pasaje) {
            if ($pasaje->getIdentificador() == $id) $contador++;
        }
        return $contador;
    }
    
    public function getAllAeropuertos() {
        return(new AeropuertosController)->getAllAeropuertos();
    }
    
    public function getAeropuertoOrigen($id, $aeropuertos) {
        foreach ($aeropuertos as $aeropuerto) {
            if($aeropuerto->getCodAeropuerto() == $id) return $aeropuerto;
        }
    }
    
    public function getAeropuertoDestino($id, $aeropuertos) {
        foreach ($aeropuertos as $aeropuerto) {
            if($aeropuerto->getCodAeropuerto() == $id) return $aeropuerto;
        }
    }
    public function imprimirFilaVuelo($registro) {
        //Necesitaré toda la información de aeropuertos
        //Por temas de optimización los cargaré aqui aunque no
        //creo que sea el mejor sitio en cuanto al orden
        $allAeropuertos = $this->getAllAeropuertos();
        $aeropuertoOrigen = $this->getAeropuertoOrigen($registro->getAeropuertoOrigen(),$allAeropuertos);
        $aeropuertoDestino = $this->getAeropuertoDestino($registro->getAeropuertoDestino(),$allAeropuertos);
        
        $html = '';
        $html .= entornoTd($registro->getIdentificador());
        $html .= entornoTd($registro->getAeropuertoOrigen());
        $html .= entornoTd($aeropuertoOrigen->getNombre());
        $html .= entornoTd($aeropuertoOrigen->getPais());
        $html .= entornoTd($registro->getAeropuertoDestino());
        $html .= entornoTd($aeropuertoDestino->getNombre());
        $html .= entornoTd($aeropuertoDestino->getPais());
        $html .= entornoTd($registro->getTipoVuelo());
        $html .= entornoTd($this->contadorPasajerosVuelo($registro->getIdentificador()));
        return $html;
    }
    
    public function cabecera() {
        return '<tr>'
        . '<th>Identificador</th>'
        . '<th>Aeropuerto de origen</th>'
        . '<th>Nombre aeropuerto de origen</th>'
        . '<th>País de origen</th>'
        . '<th>Aeropuerto de destino</th>'
        . '<th>Nombre de aeropuerto destino</th>'
        . '<th>Pais de destino</th>'
        . '<th>Tipo de vuelo</th>'
        . '<th>Numero de pasajeros</th>'
        . '</tr>';
    }

    
    public function contenidoTablaVuelo($vuelos) {
        $htmlBody = entornoTr($this->imprimirFilaVuelo($vuelos[0]));
        return entornoThead($this->cabecera()).entornoTbody($htmlBody);
    }
    
    
    public function contenidoTablaVuelos($vuelos) {
        $htmlBody = '';
        foreach ($vuelos as $vuelo) {
            $htmlBody .= entornoTr($this->imprimirFilaVuelo($vuelo));
        }
        return entornoThead($this->cabecera()).entornoTbody($htmlBody);
    }
    
    public function tablaVuelo($vuelo) {
        return entornoTabla($this->contenidoTablaVuelo($vuelo), "table");
    }

    public function tablaVuelos($vuelos) {
        return entornoTabla($this->contenidoTablaVuelos($vuelos), "table");
    }
    
    public function optionsVuelos($vuelos) {
        $html = '';
            foreach ($vuelos as $vuelo) {
                $html .= entornoOption($vuelo->getIdentificador().' - '.$vuelo->getAeropuertoOrigen().' - '.$vuelo->getAeropuertoDestino(),$vuelo->getIdentificador());
            }
        return $html;
    }
    
    public function formularioVuelo($vuelos) {
        $optionsVuelos = $this->optionsVuelos($vuelos);
        
        return '  <div class="container mt-5">
                    <h2>Selección de vuelo</h2>
                    <form action="index.php?controller=vuelos&action=manejarAccion" method="POST">
                      <div class="mb-3">
                        <label for="selectVuelo" class="form-label">Seleccionar Identificador de Vuelo</label>
                        <select name="identificadorVuelo" class="form-select" id="selectVuelo" required>
                          '.$optionsVuelos.'
                        </select>
                      </div>
                      <button name="1" type="submit" class="btn btn-primary">Ver información</button>
                      <button name="2" type="submit" class="btn btn-primary">Lista de pasajes</button>
                    </form>
                  </div>';
    }
}
