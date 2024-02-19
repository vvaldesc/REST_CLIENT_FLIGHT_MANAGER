<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/libraries/util_functions.php';

class PasajesView {
    
    public function botonReserva() {
        return '<button name="reservaHotel_ID" value="" type="submit" class="btn btn-primary btn-lg">Reservar</button>';
    }
    
    public function botonEditar($value) {
        return '<button name="editarPasaje" value="'.$value.'" type="submit" class="btn btn-secondary btn-lg">Editar</button>';
    }

    public function botonBorrar($value) {
        return '<button name="borrarPasaje" value="'.$value.'" type="submit" class="btn btn-danger btn-lg">Borrar</button>';
    }
    
    public function botonConfirmarCambios() {
        return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalConfirmarCambios">Confirmar</button>';
    }
    
    public function botonConfirmarCambiosModal() {
        return '<button name="confirmarCambiosPasaje" value="" type="submit" class="btn btn-primary btn-lg">Confirmar</button>';
    }
    
    public function botonCancelar() {
        return '<button name="cancelarCambiosPasaje" value="" type="submit" class="btn btn-danger btn-lg">Cancelar</button>';
    }
    
    public function formularioCancelarCambios() {
        return '<form action ="index.php?controller=Pasajes&action=mostrarGestionarPasajes" method="POST">' . $this->botonCancelar() . '</form>';
    }
    
    public function formularioGestionarPasaje($innerForm,$pasajes, $identificador, $action) {
        return '<form action ="index.php?controller=Pasajes&action='.$action.'" method="POST">' . $innerForm . ''
                . '<input type="hidden" name="pasajes" value=' . base64_encode(serialize($pasajes)) . '>' //Todos los pasajes
                . '<input type="hidden" name="identificador" value=' . $identificador . '>' //identificador a editar
                . '</form>';
    }
    
    public function modalConfirmarCambios() {
        return '<div class="modal fade" id="modalConfirmarCambios" tabindex="-1" role="dialog" aria-labelledby="modalConfirmarCambios" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          ...
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          '.$this->botonConfirmarCambiosModal().'
                        </div>
                      </div>
                    </div>
                  </div>';
    }

    public function modalBorrarPasaje() {
        return '<div class="modal fade" id="modalBorrarPasaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          ...
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>';        
    }
    
    public function entornoFormTablaEditable($innerForm) {
        return '<form action ="index.php?controller=Pasajes&action=editarPasaje" method="POST">' . $innerForm . '</form>';
    }
    
    public function entornoInput($type, $name, $value) {
        return '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" />';
    }
    
    public function optionsPasajeros($pasajeros) {
        $html = '';
            foreach ($pasajeros as $pasajero) {
                $html .= entornoOption($pasajero["pasajerocod"].' - '.$pasajero["nombre"],$pasajero["pasajerocod"]);
            }
        return $html;
    }
    
    //--------FUNCIONES TABLA-------//
    public function tablaPasajes($pasajes) {
        //pasajes puede ser una array de pasajes o el registro de un pasaje
        return entornoTabla($this->contenidoTablaPasajes($pasajes), "table");
    }
    
    public function contenidoTablaPasajes($pasajes) {
        if (!is_array($pasajes) || !is_object($pasajes[0]))
            throw new Exception("Error mostrando los pasajes, inténtelo de nuevo más tarde");
        return $this->listarPasajes($pasajes);
    }
    
    public function listarPasajes($pasajes) {
        $htmlBody = '';
        foreach ($pasajes as $pasaje) {
            $htmlBody .= entornoTr($this->imprimirFilaPasaje($pasaje->toArray()));
        }
        return entornoThead($this->cabecera()).entornoTbody($htmlBody);
    }
    
    public function listarPasaje($pasaje) {
        $htmlBody = entornoTr($this->imprimirFilaPasaje($pasaje));
        return entornoThead($this->cabecera()).entornoTbody($htmlBody);
    }
    
    public function imprimirFilaPasaje($registro) {
        $html = '';
        foreach ($registro as $key => $value) {
            $html .= entornoTd($value);
        }
        return $html;
    }
    
    public function cabecera() {
        return '<tr>'
        . '<th>Idpasaje</th>'
        . '<th>Pasajerocod</th>'
        . '<th>Identificador</th>'
        . '<th>Numasiento</th>'
        . '<th>Clase</th>'
        . '<th>PVP</th>'
        . '</tr>';
    }
    
    //-------------------------------------//
    
    //--------FUNCIONES TABLA GESTIONABLE-------//
    
    public function tablaGestionarPasajes($pasajes) {
        //pasajes puede ser una array de pasajes o el registro de un pasaje
        return !isset($_POST["editarPasaje"])
                ? entornoTabla($this->contenidoTablaGestionarPasajes($pasajes), "table")
                //Si la tabla es editable, la tabla estará dentro de un formulario y concatenada al modal confirmar cambios
                : $this->entornoFormTablaEditable(
                        entornoTabla($this->contenidoTablaGestionarPasajes($pasajes), "table"). 
                        $this->modalConfirmarCambios()
                        );
    }
    
    public function contenidoTablaGestionarPasajes($pasajes) {
        if (!is_array($pasajes) || !is_object($pasajes[0]))
            throw new Exception("Error mostrando los pasajes, inténtelo de nuevo más tarde");
        return $this->listarGestionarPasajes($pasajes);
    }    
    
    public function listarGestionarPasajes($pasajes) {
        $htmlBody = '';
        foreach ($pasajes as $pasaje) {
            //Se comprueba si el registro a imprimir tiene que estar disponible para editar
            //imprimirGestionarFilaPasaje necesita la información de todos los 
            //pasajes para pasarlos por post a la interfaz editable del registro,
            //Esto ahorrará una consulta innecesaria al servidor
            if (isset($_POST["editarPasaje"])) {
                $htmlTr = $_POST["editarPasaje"] == $pasaje->getIdPasaje()
                        ? $this->imprimirEditarFilaPasaje($pasaje->toArray())
                        : $this->imprimirFilaPasaje($pasaje->toArray()).entornoTd("").entornoTd("");
            } else {
                $htmlTr = $this->imprimirGestionarFilaPasaje($pasaje->toArray(),$pasajes);
            }
            $htmlBody .= entornoTr($htmlTr);
        }
        return entornoThead($this->cabeceraGestionable()).entornoTbody($htmlBody);
    }
    
    public function listarGestionarPasaje($pasaje) {
        $htmlBody = entornoTr($this->imprimirGestionarFilaPasaje($pasaje,$pasajes));
        return entornoThead($this->cabecera()).entornoTbody($htmlBody);
    }    
    
    public function imprimirEditarFilaPasaje($registro) {
        $html='';
        foreach ($registro as $key => $value) {
            $html .= $key!="idpasaje"
                    ? entornoTd($this->entornoInput('text',$key,$value))
                    : entornoTd($value);
        }
        $html .= entornoTd($this->botonConfirmarCambios());
        $html .= entornoTd($this->formularioCancelarCambios());
        return $html;
    }
    
    public function imprimirGestionarFilaPasaje($registro, $pasajes) {
        $html = '';
        foreach ($registro as $key => $value) {
            $html .= entornoTd($value);
        }
        $id = $registro["idpasaje"];//Guardo el identificador
        $html .= entornoTd($this->formularioGestionarPasaje($this->botonEditar($id),$pasajes, $id, "mostrarGestionarPasajes"));
        $html .= entornoTd($this->botonBorrar($id));
        return $html;
    }
    
    public function cabeceraGestionable() {
        return '<tr>'
        . '<th>Id</th>'
        . '<th>Código del pasajero</th>'
        . '<th>Id del vuelo</th>'
        . '<th>Asiento</th>'
        . '<th>Clase</th>'
        . '<th>Precio</th>'
        . '<th>Editar</th>'
        . '<th>Borrar</th>'
        . '</tr>';
    }
    
    public function cabeceraEditando() {
        return '<tr>'
        . '<th>Id</th>'
        . '<th>Código del pasajero</th>'
        . '<th>Id del vuelo</th>'
        . '<th>Asiento</th>'
        . '<th>Clase</th>'
        . '<th>Precio</th>'
        . '<th>Confirmar</th>'
        . '<th>Cancelar</th>'
        . '</tr>';
    }
    
    //-------------------------------------//

    public function mostrarFormulario($vuelos,$pasajeros) {
        $optionsVuelos = (new vuelosController())->optionsVuelos($vuelos);
        $optionsPasajeros = $this->optionsPasajeros($pasajeros);        
        return '
  <div class="container mt-5">
    <h2>Formulario para Insertar Pasaje</h2>
    <form>
      <div class="mb-3">
        <label for="selectVuelo" class="form-label">Seleccionar Identificador de Vuelo</label>
        <select class="form-select" id="selectVuelo" required>
          '.$optionsVuelos.'
        </select>
      </div>
      <div class="mb-3">
        <label for="selectPasajero" class="form-label">Seleccionar Pasajero</label>
        <select class="form-select" id="selectPasajero" required>
          '.$optionsPasajeros.'
        </select>
      </div>
      <div class="mb-3">
        <label for="inputAsiento" class="form-label">Número de Asiento</label>
        <input type="text" class="form-control" id="inputAsiento" required>
      </div>
      <div class="mb-3">
        <label for="selectClase" class="form-label">Seleccionar Clase</label>
        <select class="form-select" id="selectClase" required>
          <option value="">Seleccionar...</option>
          <option value="Turista">Turista</option>
          <option value="Primera">Primera</option>
          <option value="Business">Business</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="inputPrecio" class="form-label">Precio</label>
        <input type="number" class="form-control" id="inputPrecio" required>
      </div>
      <button type="submit" class="btn btn-primary">Insertar Pasaje</button>
    </form>
  </div>
';
        
    }
}
