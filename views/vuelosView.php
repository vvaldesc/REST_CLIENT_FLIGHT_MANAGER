
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

    public function imprimirFilaVuelo($registro) {
        $html = '';
        $registro;
        foreach ($registro as $key => $value) {
            $html .= entornoTd($value);
        }
        //$html .= entornoTd($this->formularioDetalleVuelo($registro));
        return $html;
    }
    
    public function cabecera() {
        return '<tr>'
        . '<th>Identificador</th>'
        . '<th>Origen</th>'
        . '<th>Destino</th>'
        . '<th>Clase</th>'
        . '<th>Fecha</th>'
        . '<th>Descuento</th>'
        . '</tr>';
    }

    
    public function contenidoTablaVuelo($vuelo) {
        $htmlBody = entornoTr($this->imprimirFilaVuelo($vuelo));
        return entornoThead($this->cabecera()).entornoTbody($htmlBody);
    }
    
    
    public function contenidoTablaVuelos($vuelos) {
        $htmlBody = '';
        foreach ($vuelos as $vuelo) {
            $htmlBody .= entornoTr($this->imprimirFilaVuelo($vuelo->toArray()));
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
