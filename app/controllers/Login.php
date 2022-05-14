<?php


require_once(RUTA_APP . '/helpers/Resolve.php');
require_once(RUTA_APP . '/helpers/Alerts.php');
require_once(RUTA_APP . '/helpers/Session.php');
//require_once(RUTA_APP . '/models/UsuarioModel.php');

session_start();

class Login extends ControllerBase{


    public function __construct()
    {
    }


    public function index(){

        if(isset($_SESSION['usuarioLogin'])){
            $this->view('pages/home');

        }else{
            $this->view('pages/login');
        }
        
    }

    public function registrarse(){

        if(isset($_SESSION['usuarioLogin'])){

            $this->view('pages/home');

        }else{
            $this->view('pages/registrar_usuario');
        }

    }


    public function createUser(){
        if(empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['dni']) || empty($_POST['email']) || empty($_POST['contraseña_confirm'])){

            Resolve::Response(array(

                "message" => Alert::show("info", "Debe completar todos los campos")

            ));
        
        }else{

            $ModelUsuario = $this->model('UsuarioModel');

            $IsExist = $ModelUsuario->UserExist($_POST['email'], $_POST['dni']);

            if($IsExist){
                Resolve::Response(array(
                    "message" => Alert::show("warning", "El usuario ya está registrado")
                ));

            }else{

               $result =  $ModelUsuario->insertUsuario($_POST['nombres'], $_POST['apellidos'], $_POST['dni'], $_POST['email'], $_POST['contraseña_confirm']);
            
                if(is_object($result)){

                    Session::setSession('usuarioLogin', $result);

                    Resolve::Response($result);

                }else{

                    Resolve::Response(array(
                    
                        "message" => Alert::show("error", $result)
                    
                    ));

                }
            
            }

        }
    }

    public function logearse(){
        
        if(empty($_POST['email']) || empty($_POST['password'])){

            Resolve::Response(array(

                "message" => Alert::show("info", "Debe completar todos los campos")

            ));
        
        }else{

            $ModelUsuario = $this->model('UsuarioModel');

            $findUser = $ModelUsuario->ValidateUser($_POST['email'], $_POST['password']);

            if(is_object($findUser)){

                Session::setSession('usuarioLogin', $findUser);

                Resolve::Response($findUser);


            }else{

                Resolve::Response(array(
                    
                    "message" => Alert::show("error", $findUser)
                
                ));
            }
        }
    }


    public function SignOff(){

        if(Session::IsExist("usuarioLogin")){

            Session::clearSesion("usuarioLogin");

            header("Location:" . RUTA_URL );
        }
    }
}
