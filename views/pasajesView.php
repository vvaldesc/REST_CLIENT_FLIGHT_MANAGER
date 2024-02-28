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
        return '        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Launch demo modal
                            </button>';
    }
    
    public function inputHiddenPasaje() {
        if (isset($_POST["editarPasaje"])) return '<input type="hidden" name="idpasaje" value='.$_POST["editarPasaje"].'>';
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
        return '<!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            ...
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>';
    }
    
    public function imprimirBotonModalConfirmar() {
        return '<!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmarModal">
                  Confirmar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="confirmarModal" tabindex="-1" aria-labelledby="confirmarModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="confirmarModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        ¿Estás seguro de que quieres modificar este pasaje?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
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
        return '<form action="index.php?controller=Pasajes&action=editarPasaje" method="POST">' . $innerForm . $this->inputHiddenPasaje() . '</form>';
    }
    
    public function entornoInput($type, $name, $value) {
        return '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" />';
    }
    
    public function optionsPasajeros($pasajeros) {
        $html = '';
            foreach ($pasajeros as $pasajero) {
                $html .= entornoOption($pasajero->getPasajeroCod().' - '.$pasajero->getNombre(),$pasajero->getPasajeroCod());
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
            $htmlBody .= entornoTr($this->imprimirFilaPasajePasajero($pasaje));
        }
        return entornoThead($this->cabecera()).entornoTbody($htmlBody);
    }
    
    public function listarPasaje($pasaje) {
        $htmlBody = entornoTr($this->imprimirFilaPasajePasajero($pasaje));
        return entornoThead($this->cabecera()).entornoTbody($htmlBody);
    }
    
    public function pasajeroPasaje($pasajeros, $pasajeroCodPasaje) {
        foreach ($pasajeros as $pasajero) {
            if($pasajero->getPasajeroCod() == $pasajeroCodPasaje) return $pasajero;
        }
    }
    
    public function imprimirFilaPasajePasajero($pasaje) {
        
        $pasajeros = (new PasajerosController)->getPasajeros();
        $pasajero = $this->pasajeroPasaje($pasajeros, $pasaje->getPasajeroCod());
        
        
        $html = '';
        $html .= entornoTd($pasaje->getIdPasaje());
        $html .= entornoTd($pasajero->getPasajeroCod());
        $html .= entornoTd($pasajero->getNombre());
        $html .= entornoTd($pasajero->getPais());
        $html .= entornoTd($pasaje->getNumAsiento());
        $html .= entornoTd($pasaje->getClase());
        $html .= entornoTd($pasaje->getPVP());
        
        return $html;
    }
    
    public function imprimirFilaPasaje($pasaje) {
        
        $pasajeros = (new PasajerosController)->getPasajeros();
        $pasajero = $this->pasajeroPasaje($pasajeros, $pasaje->getPasajeroCod());
        
        $html = '';
        $html .= entornoTd($pasaje->getIdPasaje());
        $html .= entornoTd($pasajero->getPasajeroCod());
        $html .= entornoTd($pasajero->getNombre());
        $html .= entornoTd($pasajero->getPais());
        $html .= entornoTd($pasaje->getNumAsiento());
        $html .= entornoTd($pasaje->getClase());
        $html .= entornoTd($pasaje->getPVP());
        
        return $html;
    }
    
    public function cabecera() {
        return '<tr>'
        . '<th>Id de pasaje</th>'
        . '<th>Codigo de pasajero</th>'
        . '<th>Nombre de pasajero</th>'
        . '<th>Pais del pasajero</th>'
        . '<th>Numero de asiento</th>'
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
                        ? $this->imprimirEditarFilaPasaje($pasaje)
                        : $this->imprimirFilaPasaje($pasaje).entornoTd("").entornoTd("");
            } else {
                $htmlTr = $this->imprimirGestionarFilaPasaje($pasaje,$pasajes);
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
        foreach ($registro->toArray() as $key => $value) {
            $html .= $key!="idpasaje"
                    ? entornoTd($this->entornoInput('text',$key,$value))
                    : entornoTd($value);
        }
        $html .= entornoTd($this->imprimirBotonModalConfirmar());
        $html .= entornoTd($this->formularioCancelarCambios());
        return $html;
    }
    
    public function imprimirGestionarFilaPasaje($registro, $pasajes) {
        $html = '';
        foreach ($registro->toArray() as $value) {
            $html .= entornoTd($value);
        }
        $id = $registro->getIdPasaje();//Guardo el identificador
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

    public function mostrarFormularioInsertar($vuelos,$pasajeros) {
        $optionsVuelos = (new vuelosController())->optionsVuelos($vuelos);
        $optionsPasajeros = $this->optionsPasajeros($pasajeros);        
        return '<div class="container mt-5">
                  <h2>Formulario para Insertar Pasaje</h2>
                  <form action="index.php?controller=pasajes&action=insertarPasaje" method="POST">
                    <div class="mb-3">
                      <label for="selectVuelo" class="form-label">Seleccionar Identificador de Vuelo</label>
                      <select name="vuelo" class="form-select" id="selectVuelo" required>
                        '.$optionsVuelos.'
                      </select>
                    </div>
                    <div class="mb-3">
                      <labelfor="selectPasajero" class="form-label">Seleccionar Pasajero</label>
                      <select name="pasajerocod" class="form-select" id="selectPasajero" required>
                        '.$optionsPasajeros.'
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="inputAsiento" class="form-label">Número de Asiento</label>
                      <input name="numasiento" type="text" class="form-control" id="inputAsiento" required>
                    </div>
                    <div class="mb-3">
                      <label for="radioTurista" class="form-label">Turista</label>
                      <input type="radio" id="radioTurista" name="clase" value="Turista" required>

                      <label for="radioPrimera" class="form-label">Primera</label>
                      <input type="radio" id="radioPrimera" name="clase" value="Primera" required>

                      <label for="radioBusiness" class="form-label">Business</label>
                      <input type="radio" id="radioBusiness" name="clase" value="Business" required>
                    </div>
                    <div class="mb-3">
                      <label for="inputPrecio" class="form-label">Precio</label>
                      <input name="pvp" type="number" class="form-control" id="inputPrecio" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Insertar Pasaje</button>
                  </form>
                </div>
';
        
    }
}
