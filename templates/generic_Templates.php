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

function mensajeError($message) {
    return '<div class="alert alert-danger text-center" role="alert"><p>' . $message . '</p></div>';
}

function mostrar($param) {
    echo $param;
}

function menuSuperior() {
    return '<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item m-2">
          <a class="nav-link btn btn-primary btn-block" href="'.$_SERVER["DOCUMENT_ROOT"].'">Lista de vuelos</a>
        </li>
        <li class="nav-item m-2">
          <a class="nav-link btn btn-primary btn-block" href="'.$_SERVER["DOCUMENT_ROOT"].'?controller=pasajes&action=interfazPasajes'.'">Insertar pasaje</a>
        </li>
      </ul>
    </div>
  </div>
</nav>';
}