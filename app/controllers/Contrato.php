<?php

require_once(RUTA_APP . '/helpers/Resolve.php');
require_once(RUTA_APP . '/helpers/Alerts.php');
require_once(RUTA_APP . '/helpers/Session.php');

session_start();

class Contrato extends ControllerBase{

    public function crearContrato(){

        $idUsuario = Session::getSession("usuarioLogin")['Id'];

        $contrato = $this->model("ContratosModel");

        if(empty($_POST['idServicio']) || empty($_POST['idProveedor']))
        {
        
            Resolve::Response(array(
                'message' => Alert::show("info", "Debes completar los campos obligatorios")
            ));
        }else{ 

            if($contrato->isExistSuscripcion($_POST['idServicio'],$_POST['idProveedor'] )){
                Resolve::Response(array(
                    'message' => Alert::show("warning", "Ya se ha registrado un contrato con este servicio")
                ));
            }else{
                $contrato->contratarSuscripcion(
                    $_POST['inicio'],
                    $_POST['ciclo'],
                    $_POST['duracion'],
                    $_POST['idServicio'],
                    $_POST['idProveedor'],
                    $idUsuario,
                    $_POST['tiempoRecordatorio']
                );
    
                Resolve::Response(array(
                    'content' => true
                ));
            }

          
        }

        
    }

    public function editarRecordatorio(){

        $contrato = $this->model("ContratosModel");

        if(empty($_POST['idServicio']) || empty($_POST['IdProveedor']))
        {
            Resolve::Response(array(
                'message' => Alert::show("info", "Debes completar los campos obligatorios")
            ));
        }else{ 

              $state =  $contrato->EditarRecordatorio(
                    $_POST['inicio'],
                    $_POST['ciclo'],
                    $_POST['duracion'],
                    $_POST['idServicio'],
                    $_POST['IdProveedor'],
                    $_POST['TiempoRecordatorio'],
                    $_POST['IdSusContratada']
                );
              
            if($state){
                Resolve::Response(array(
                    'content' => true
                ));
            }
            
        }
    }





}
