<?php

require_once(RUTA_APP . '/helpers/Resolve.php');
require_once(RUTA_APP . '/helpers/Alerts.php');
require_once(RUTA_APP . '/helpers/Session.php');

session_start();
class Calendario extends ControllerBase{

    public function index(){
        $this->view("pages/calendario");
    }

}