<?php

require_once 'config/configs.php';
require_once 'lib/Template.php';

function carregar_classes ($pClassName) {
    include("lib/" . $pClassName . ".php");
}

spl_autoload_register("carregar_classes");

$label = new Label(APP_IDIOMA);
$usuario = new Usuario();