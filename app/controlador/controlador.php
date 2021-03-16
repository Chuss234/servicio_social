<?php

require_once __dir__ . "/../modelo/getDatos.php";

class controlador
{
    public static $rutaAPP = "/serviciosocial/";

    public function iniciarSesion()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION["id_usr"])) {
            return true;
        }
        return false;
    }

    public function cerrarSesion()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        $this->index();
    }


    public function main()
    {
        include_once __dir__ . "/../vista/main.php";
    }
    public function index()
    {
        include_once __dir__ . "/../vista/login/login.php";
    }
    public function home()
    {
        include_once __dir__ . "/../vista/home.php";
    }
    public function user()
    {
        include_once __dir__ . "/../vista/ajustes/user.php";
    }
    public function login()
    {
        include_once __dir__ . "/../vista/login.php";

    }
    public function validar()
    {
        include_once __dir__ . "/../vista/php/login.php";
    }

    public function get()
    {
        include_once __dir__ . "/../vista/php/get.php";
    }


}
