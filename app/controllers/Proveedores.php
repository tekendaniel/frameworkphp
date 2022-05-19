<?php 


require_once(RUTA_APP . '/helpers/Resolve.php');
require_once(RUTA_APP . '/helpers/Alerts.php');
require_once(RUTA_APP . '/helpers/Session.php');

session_start();


class Proveedores extends ControllerBase {

    protected $response = array();

    public function index(){

        $pModel = $this->model("ProveedorModel");

        $idUsuario = Session::getSession("usuarioLogin")['Id'];

        $result = $pModel->MostrarProveedores($idUsuario);

        if(is_array($result)){

            foreach($result as $r){
                $services = $pModel->MostrarServiciosDeProveedores($r->IdProveedor);

                $provv = (array) $r;

                $provv['servicios'] = $services;


                array_push($this->response, $provv);

            }


            $this->view("pages/proveedoresView", $this->response);
        }
    }


    public function create(){
        $this->view("pages/registrarProveedoresView"); 
    }


    public function edit($idProveedor){
        $pModel = $this->model("ProveedorModel");
        $idUsuario = Session::getSession("usuarioLogin")['Id'];
        

        $provv = $pModel->BuscarProveedorPorId($idProveedor);

        $services = $pModel->MostrarServiciosDeProveedores($idProveedor);

        $respuesta = [];

        if(is_object($provv)){

            $respuesta = array(
                "proveedor" => $provv,
                "servicios" => $services
            );

            
        }

        $this->view("pages/editarProveedorView", $respuesta);
    }


    public function obtenerproveedor($idProveedor){
        $pModel = $this->model("ProveedorModel");
        $provv = $pModel->BuscarProveedorPorId($idProveedor);
        $services = $pModel->MostrarServiciosDeProveedores($idProveedor);
        $respuesta = [];

        if(is_object($provv)){

            $respuesta = array(
                "proveedor" => $provv,
                "servicios" => $services
            );
        }
        Resolve::Response(array(
            "content" => $respuesta,
        ));

    }


    public function createProveedor(){

       $idUsuario = Session::getSession("usuarioLogin")['Id'];

       $pModel = $this->model("ProveedorModel");


       if(empty($_POST['nombreproveedor']) ||  empty($_POST['categoria']) || json_decode($_POST['serviciosList']) == []){
            
        Resolve::Response(array(
            "message" => Alert::show("info", "Debe completar todos los campos obligatorios"),

        ));
       
       }else{
            #Depues de crear un proveedor devuelve un array de proveedores
            $resul = $pModel->InsertProveedor($idUsuario, $_POST['nombreproveedor'], $_POST['categoria'],$_POST['descripcion'], $_POST['telefono'], json_decode($_POST['serviciosList']) );

            
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

    public function editarproveedor(){
        if(empty($_POST['nombreproveedor']) ||  empty($_POST['categoria']) || json_decode($_POST['serviciosList']) == []){
            
            Resolve::Response(array(
                "message" => Alert::show("info", "Debe completar todos los campos obligatorios"),
    
            ));
           
           }else{

            $pModel = $this->model("ProveedorModel");

           // print_r($_POST);

            

            $resul = $pModel->EditarProveedorModel( $_POST['IdProveedor'], $_POST['nombreproveedor'], $_POST['telefono'], $_POST['descripcion'], $_POST['categoria'], json_decode($_POST['serviciosList']), json_decode($_POST['servicesDeleted']));

            if($resul){

                Resolve::Response(array(
                    "content" => "Se actualizó el proveedor exitosamente"
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

        $result = $pModel->MostrarServiciosDeProveedores($idProveedor);

        if(is_array($result)){
           Resolve::Response(array( 
                "content" => $result,
            ));

        }
    }

    /* devuelve las suscripciones de cada proveedor */
    public function mostrarSuscripciones($idProveedor){
        $pModel = $this->model("ProveedorModel");

        $resul = $pModel->MostrarServiciosDeProveedores(trim($idProveedor,""));

        if(is_array($resul)){
            Resolve::Response(array( 
                "content" => $resul,
            ));
        }

    }


    /* Eliminar un proveedor */

    public function eliminarProveedor($idProveedor){
        $pModel = $this->model("ProveedorModel");

        if($pModel->EliminarProveedorModel(trim($idProveedor,""))){

            Resolve::Response(array(
                "message" => Alert::show("success", "Se ha eliminado el proveedor correctamente!")
            ));
        }else{

            Resolve::Response(array(
                "message" => "No se pudo eliminar"
            ));
        }

    }


}
