<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/UT7_3_Actividad3_RESTFul_Cliente/libraries/util_functions.php';

class PasajesView {
    
    public function botonReserva() {
        return '<button name="reservaHotel_ID" value="" type="submit" class="btn btn-primary btn-lg">Reservar</button>';
    }
    
    public function mostrarFormulario() {
        return '
  <div class="container mt-5">
    <h2>Formulario para Insertar Pasaje</h2>
    <form>
      <div class="mb-3">
        <label for="selectPasajero" class="form-label">Seleccionar Pasajero</label>
        <select class="form-select" id="selectPasajero" required>
          <option value="">Seleccionar...</option>
          <option value="1">Pasajero 1</option>
          <option value="2">Pasajero 2</option>
          <option value="3">Pasajero 3</option>
          <!-- Agrega más opciones según sea necesario -->
        </select>
      </div>
      <div class="mb-3">
        <label for="selectVuelo" class="form-label">Seleccionar Identificador de Vuelo</label>
        <select class="form-select" id="selectVuelo" required>
          <option value="">Seleccionar...</option>
          <option value="Vuelo1">Vuelo 1</option>
          <option value="Vuelo2">Vuelo 2</option>
          <option value="Vuelo3">Vuelo 3</option>
          <!-- Agrega más opciones según sea necesario -->
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
    public function entornoFormPasajes($innerForm, $hoteles, $miUsuario) {
        return '<form action ="'.$_SERVER['PHP_SELF'].'?controller=Habitaciones&action=mostrarHabitacionesLibres" method="POST">' . $innerForm . ''
                . '<input type="hidden" name="hoteles" value='.base64_encode(serialize($hoteles)).'>' //Me va servir para mostrar la información del hotel
                . '<input type="hidden" name="miUsuario" value="' . ($miUsuario ? base64_encode(serialize($miUsuario)) : '') . '">' // He de pasar el usuario
                . '</form>';
    }
}
