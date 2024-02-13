
<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/libraries/util_functions.php';

class VuelosView {

    public function botonReserva() {
        return '<button name="reservaHotel_ID" value="" type="submit" class="btn btn-primary btn-lg">Reservar</button>';
    }

    /**
     * DESC: Entorno formulario se encuentar en este controlador porque va a ser único
     * dependiendo en qué caso
     * Podría hacerlo dinámico y que imprima tantos posts como necesite pero de momento
     * solo imprime un post
     * este hidden
     * 
     * @param streing $innerForm
     * @return type
     */
    public function entornoFormHoteles($innerForm, $hoteles, $miUsuario) {
        return '<form action ="' . $_SERVER['PHP_SELF'] . '?controller=Habitaciones&action=mostrarHabitacionesLibres" method="POST">' . $innerForm . ''
                . '<input type="hidden" name="hoteles" value=' . base64_encode(serialize($hoteles)) . '>' //Me va servir para mostrar la información del hotel
                . '<input type="hidden" name="miUsuario" value="' . ($miUsuario ? base64_encode(serialize($miUsuario)) : '') . '">' // He de pasar el usuario
                . '</form>';
    }

    public function imprimirFilaVuelo($registro) {
        $html = '';
        foreach ($registro as $key => $value) {
            $html .= entornoTd($value);
        }
        return $html;
    }
    
    public function cabecera($param) {
        //entornoThead($p);
    }

    public function imprimirFilasVuelos($vuelos) {
        $html = '';
        $html .= $this->cabecera();
        
        $html = '<tbody>';
        foreach ($vuelos as $vuelo) {
            $html .= entornoTr($this->imprimirFilaVuelo($vuelo));
        }
        $html = '</tbody>';
        return $html;
    }

    public function tablaVuelos($vuelos) {
        return entornoTabla($this->imprimirFilasVuelos($vuelos), "table");
    }
}
