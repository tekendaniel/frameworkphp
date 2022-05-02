<?php

    //Cargamos libreiras

    require_once 'config/config.php';



    spl_autoload_register(function($nombreClase){
        require_once 'lib/' . $nombreClase . '.php';
    });


?>