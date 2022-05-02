<?php

    /*
    
    Mapear la url ingresada en el navegador
    1-controlador
    2-método
    3-parametro

    */

    class Core{
        protected $controllerCurrent = "Login";
        protected $methodCurrent = "index";
        protected $parameters = [];


        public function __construct()
        {

            $url= $this->getUrl();

            if($this->controllerCurrent ==""){
                return " ";
            }

        
            //Buscar en controladores si el controlador existe
           if(isset($url[0])){
            if(file_exists('../app/controllers/'.ucwords($url[0]). '.php')){
                
                $this->controllerCurrent = ucwords($url[0]);
                unset($url[0]);
           }

           } 
            
           //REQUERIMIENTOS
           require_once '../app/controllers/' . $this->controllerCurrent . '.php';
           $this->controllerCurrent = new $this->controllerCurrent;



           //Buscar si existe el metodo dentro del controlador actual
           if(isset($url[1])){
                if(method_exists($this->controllerCurrent, $url[1])){
                    $this->methodCurrent = $url[1];
                    
                    unset($url[1]);
               
                }
           }

           //Obtener los parametros

           $this->parameters = $url ? array_values($url) : [];
           
           //Llamar callback con parametros array
           call_user_func_array([$this->controllerCurrent, $this->methodCurrent], $this->parameters);


           
        }


        public function getUrl(){ 
           
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode("/", $url);

                return $url;
            }

        }


        
    }



