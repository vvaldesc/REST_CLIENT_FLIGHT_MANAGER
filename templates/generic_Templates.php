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

