<?php 


require_once(RUTA_APP . '/helpers/Resolve.php');
require_once(RUTA_APP . '/helpers/Alerts.php');
require_once(RUTA_APP . '/helpers/Session.php');

session_start();


class Proveedores extends ControllerBase {



    public function index(){

        $pModel = $this->model("ProveedorModel");

        $idUsuario = Session::getSession("usuarioLogin")['Id'];

        $result = $pModel->MostrarProveedores($idUsuario);

        if(is_array($result)){
           /* Resolve::Response(array( 
                "content" => $result,
            ));*/

            $this->view("pages/proveedores", $result);
        }
    }


    public function create(){
        $this->view("pages/registrar_proveedores");
    }


    public function edit($idProveedor){
        $pModel = $this->model("ProveedorModel");
        $idUsuario = Session::getSession("usuarioLogin")['Id'];
        

        $provv = $pModel->BuscarProveedorPorId($idProveedor);

        $services = $pModel->MostrarSuscripcionesDeProveedores($idProveedor);

        $respuesta = [];

        if(is_object($provv)){

            $respuesta = array(
                "proveedor" => $provv,
                "servicios" => $services
            );

            
        }

        $this->view("pages/editar_proveedor", $respuesta);
    }


    public function createProveedor(){

       $idUsuario = Session::getSession("usuarioLogin")['Id'];

       $pModel = $this->model("ProveedorModel");

       if(empty($_POST['nombreproveedor']) ||  empty($_POST['categoria'])){
            
        Resolve::Response(array(
            "message" => Alert::show("info", "Debe completar todos los campos obligatorios"),

        ));
       
       }else{
            #Depues de crear un proveedor devuelve un array de proveedores
            $resul = $pModel->InsertProveedor($idUsuario, $_POST['nombreproveedor'], $_POST['categoria'],$_POST['descripcion'], $_POST['telefono'], json_decode($_POST['suscripciones']) );

            
            if(is_array($resul)){
                #como es un array la clase resolve debe crear las claves del array "content" y "message"
                Resolve::Response(array(
                    "content" => $resul
                ));
            
            }else{

                Resolve::Response(array(
                    "message" => Alert::show("error", $resul)
                ));
            }

       }    
    

    }


    /* Listar proveedores por usuarios (json api) */

    public function listarProveedoresJson(){

        $pModel = $this->model("ProveedorModel");

        $idUsuario = Session::getSession("usuarioLogin")['Id'];

        $result = $pModel->MostrarProveedores($idUsuario);

        if(is_array($result)){
           Resolve::Response(array( 
                "content" => $result,
            ));

        }
    }

    /*Listar servicios de acuerdo al proveedor seleccionado (json api) */

    public function listarServiciosJson($idProveedor){
        $pModel = $this->model("ProveedorModel");

        $result = $pModel->MostrarSuscripcionesDeProveedores($idProveedor);

        if(is_array($result)){
           Resolve::Response(array( 
                "content" => $result,
            ));

        }
    }

    /* devuelve las suscripciones de cada proveedor */
    public function mostrarSuscripciones($idProveedor){
        $pModel = $this->model("ProveedorModel");

        $resul = $pModel->MostrarSuscripcionesDeProveedores($idProveedor);

        if(is_array($resul)){
            Resolve::Response(array( 
                "content" => $resul,
            ));
        }

    }


    /* Eliminar un proveedor */

    public function eliminarProveedor($idProveedor){
        $pModel = $this->model("ProveedorModel");

        if($pModel->EliminarProveedorModel($idProveedor)){

            Resolve::Response(array(
                "message" => Alert::show("success", "Se ha eliminado el proveedor correctamente!")
            ));
        }

    }


}
