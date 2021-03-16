<?php

$mvcDatos = new GetDatos();

if (isset($_POST["usr"]) && isset($_POST["pass"])) {
    $result = $mvcDatos->consultaGen("SELECT * from usuarios where usuario = '{$_POST['usr']}' and pass = '{$_POST['pass']}'");
    if (count($result) > 0) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION["id_usr"]  = $result[0]["id_usr"];
        $_SESSION["usuario"] = $result[0]["usuario"];

        $info = array('success' => true, 'msg' => " Error: Usuario Correcto", 'link' => controlador::$rutaAPP . "index.php?action=home");
        
    } else {
        $info = array('success' => false, 'msg' => "$obj Error: Los datos introducidos son incorrectos, Inténtelo de nuevo.");
    }
} else {
    $info = array('success' => false, 'msg' => "$obj Error: El usuario no existe :)");
}

echo json_encode($info);
