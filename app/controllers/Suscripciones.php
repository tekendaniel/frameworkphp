<?php


require_once(RUTA_APP . '/helpers/Resolve.php');
require_once(RUTA_APP . '/helpers/Alerts.php');
require_once(RUTA_APP . '/helpers/Session.php');

session_start();


class Suscripciones extends ControllerBase
{


    public function index()
    {
        /* SERIVICIOS CONTRATADOS */
        $idUsuario = Session::getSession("usuarioLogin")['Id'];

        $resp = [];

        $contrato = $this->model("ContratosModel");

        $resp = $contrato->listarContratos($idUsuario);
        
        $this->view("pages/listaSuscripcionesView", array( 'contratos' => $resp));
    }


    public function registrar()
    {
        $this->view("pages/contratarSuscripcionView");
    }


    public function contratar()
    {

        $idUsuario = Session::getSession("usuarioLogin")['Id'];

        $pModel = $this->model("SuscripcionModel");
    }
}
