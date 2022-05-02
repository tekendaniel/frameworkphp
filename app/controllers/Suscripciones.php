<?php 


require_once(RUTA_APP . '/helpers/Resolve.php');
require_once(RUTA_APP . '/helpers/Alerts.php');
require_once(RUTA_APP . '/helpers/Session.php');

session_start();


class Suscripciones extends ControllerBase {


    public function index(){
        $this->view("pages/contratar_suscripcion");
    }


    public function contratar(){

        $idUsuario = Session::getSession("usuarioLogin")['Id'];

        $pModel = $this->model("SuscripcionModel");

    }

}