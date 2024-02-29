<?php



function entornoTd($param) {
    return '<td>' . $param . '</td>';
}

function entornoTh($param) {
    return '<th>' . $param . '</th>';
}

function entornoTr($param) {
    return '<tr>' . $param . '</tr>';
}

function entornoH3($param) {
    return '<h3>' . $param . '</h3>';
}

function entornoOption($param, $value = null) {
    if (!$value) $value = $param;
    return '<option value='.$value.'>' . $param . '</option>';
}

function entornoOptionSelect($param, $value = null) {
    if (!$value) $value = $param;
    return '<option selected value='.$value.'>' . $param . '</option>';
}

function entornoTbody($param) {
    return '<tbody>' . $param . '</tbody>';
}

function entornoThead($param) {
    return '<thead>' . $param . '</thead>';
}

function entornoImg($src) {
    return '<img src='. $src .'>';
}

function entornoTabla($param, $class = null) {
    return '<table class=' . $class . '>' . $param . '</table>';
}

function mostrar($param) {
    echo $param;
}

function pantallaMensajeExito($message,$inner = '') {
    return menuSuperior().'<div class="alert alert-success text-center" role="alert"><p>' . $message . '</p></div>'.$inner;
}

function menuSuperior() {
    return '<nav class="navbar navbar-expand-lg navbar-light w-100">
                <div class="container w-50 m-auto">
                  <div class="navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                      <li class="nav-item m-2">
                        <a class="nav-link btn btn-primary btn-block text-white" href="index.php?controller=vuelos&action=mostrarVuelos">Lista de vuelos</a>
                      </li>
                      <li class="nav-item m-2">
                        <a class="nav-link btn btn-primary btn-block text-white" href="index.php?controller=pasajes&action=mostrarInsertarPasajes'.'">Insertar pasaje</a>
                      </li>
                      <li class="nav-item m-2">
                        <a class="nav-link btn btn-primary btn-block text-white" href="index.php?controller=vuelos&action=mostrarFormularioVuelo'.'">Información de un vuelo</a>
                      </li>
                      <li class="nav-item m-2">
                        <a class="nav-link btn btn-primary btn-block text-white" href="index.php?controller=pasajes&action=mostrarGestionarPasajes'.'">Gestionar pasajes</a>
                      </li>
                    </ul>
                  </div>
                </div>
            </nav>';
}