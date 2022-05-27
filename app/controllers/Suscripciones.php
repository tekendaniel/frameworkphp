<?php


require_once(RUTA_APP . '/helpers/Resolve.php');
require_once(RUTA_APP . '/helpers/Alerts.php');
require_once(RUTA_APP . '/helpers/Session.php');

session_start();


class Suscripciones extends ControllerBase
{


    public function index()
    {
        $this->view("pages/listaSuscripcionesView");
    }


    public function listarrecordatorios(){
        $idUsuario = Session::getSession("usuarioLogin")['Id'];
        $contrato = $this->model("ContratosModel");
        $resp = $contrato->listarContratos($idUsuario);

        Resolve::Response(array(
            'content' => $resp
        ));
    }


    public function registrar()
    {
        $this->view("pages/registrarRecordatorioView");
    }

    public function editar($idRecordatorio=null){
       
        if(!$idRecordatorio){
            header("Location: http://localhost/sistemaweb/suscripciones");
        }
            
        $this->view("pages/editarRecordatorioView");
        
    }

    public function obtenerRecordatorio($idRecordatorio){
        $recordatorio= $this->model("ContratosModel");
        $resp = $recordatorio->obtenerRecordatorio($idRecordatorio);

        Resolve::Response(array(
            "content" => $resp
        ));
    }

    public function eliminarrecordatorio($idRecordatorio){
        $recordatorio = $this->model("ContratosModel");
        $resp = $recordatorio->deleteRecordatorio($idRecordatorio);
        if(isset($resp['deleted'])){
            Resolve::Response(array(
                "content" => true
            ));
        }else{
            Resolve::Response(array(
                "message" => $resp
            ));
        }
    }


    public function contratar()
    {

        $idUsuario = Session::getSession("usuarioLogin")['Id'];

        $pModel = $this->model("SuscripcionModel");
    }
}
