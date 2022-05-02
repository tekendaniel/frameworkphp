<?php

class  UsuarioModel {

    protected $Connection; 

    protected $response;

    public function __construct()
    {
        $this->Connection = new DataBase;
    }

    public function ValidateUser(string $usuario, string $password){


        try{

            $this->Connection->query("SELECT * FROM usuario WHERE email=:E");
            $this->Connection->bind(":E", $usuario);
            $result = $this->Connection->dataOne();
    
            if($result){
    
                if(password_verify($password, $result->Password)){
    
                     $this->response = $result;
    
                }else{
    
                    $this->response =  "Error en la contraseña";
                }
    
            }else{
    
                $this->response = "Usuario no registrado";
            }
    
            
        }
        catch(Exception $e){

            $this->response = $e->getMessage();
        }

        return $this->response;
       

    }



    public function UserExist(string $email, string $dni){

        try{

            $this->Connection->query("SELECT * from usuario Where email= :E or dni = :DD");
            $this->Connection->bind(":E", $email);
            $this->Connection->bind(":DD", $dni);

            $this->Connection->execute();

            $result = $this->Connection->rowCount();

            if($result > 0){

                return true;
             }
        }
        catch(Exception $e){

            return null;
        }

        
    }


    public function insertUsuario(string $nombres, string $apellidos, string $dni, string $email, string $password){

        try{
            if(!$this->UserExist($nombres, $apellidos)){
                //$this->Connection->query("INSERT INTO usuario(Nombre, Apellidos, DNI, Email, Password, IsAdmin) values(:N, :A, :D, :E, :P)");
                $this->Connection->query("CALL crearUsuario(:N, :A, :D, :E, :P)");
                $this->Connection->bind(":N", $nombres);
                $this->Connection->bind(":A", $apellidos);
                $this->Connection->bind(":D", $dni);
                $this->Connection->bind(":E", $email);
                $this->Connection->bind(":P", password_hash($password, PASSWORD_DEFAULT));
                
                $this->Connection->execute();
                return $this->ValidateUser($email, $password);
            }else{
                $this->response = "El usuario ya está registrado";
            }

        }
        catch(Exception $e){

             $this->response = $e->getMessage();
        }
        return $this->response;
    }


}