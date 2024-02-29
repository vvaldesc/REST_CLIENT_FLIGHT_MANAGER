<?php

function mensajeError($message) {
    return '<div class="alert alert-danger text-center" role="alert"><p>' . $message . '</p></div>';
}

function pantallaMensajeError($message,$inner = '') {
    return menuSuperior().'<div class="alert alert-danger text-center" role="alert"><p>' . $message . '</p></div>'.$inner;
}

