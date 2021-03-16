<?php

include_once __dir__ . "/app/controlador/controlador.php";
$mvc = new controlador();

if ($mvc->iniciarSesion()) {
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {

            case 'home':
                $mvc->home();
                break;

            case 'salir':
                $mvc->cerrarSesion();
                $mvc->login();
                break;

            case 'get':
                $mvc->get();
                break;

            case 'cerrar':
                $mvc->cerrarSesion();
                break;

            default:
                $mvc->home();
                break;
        }
    }
} else {
    switch ($_GET["action"]) {

        case 'validar':
            $mvc->validar();
            break;

        default:
            $mvc->login();
            break;
    }
}
