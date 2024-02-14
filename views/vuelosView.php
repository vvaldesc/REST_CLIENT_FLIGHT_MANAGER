
<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/libraries/util_functions.php';

class VuelosView {

    public function botonReserva() {
        return '<button name="reservaVuelo" value="" type="submit" class="btn btn-primary btn-lg">Reservar</button>';
    }
    
    public function formularioReserva($vuelo) {
        return '<form action ="' . $_SERVER['PHP_SELF'] . '?controller=Pasajes&action=mostrarInterfazReserva" method="POST">' . $this->botonReserva() . ''
                . '<input type="hidden" name="vuelo" value=' . base64_encode(serialize($vuelo)) . '>' //Instancia vuelo a reservar
                . '</form>';
    }

    public function imprimirFilaVuelo($registro) {
        $html = '';
        foreach ($registro as $key => $value) {
            $html .= entornoTd($value);
        }
        $html .= entornoTd($this->formularioReserva($registro));
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
        . '<th>Reserva</th>'
        . '</tr>';
    }

    public function contenidoTablaVuelos($vuelos) {
        $htmlBody = '';
        foreach ($vuelos as $vuelo) {
            $htmlBody .= entornoTr($this->imprimirFilaVuelo($vuelo));
        }
        return entornoThead($this->cabecera()).entornoTbody($htmlBody);
    }

    public function tablaVuelos($vuelos) {
        return entornoTabla($this->contenidoTablaVuelos($vuelos), "table");
    }
}
