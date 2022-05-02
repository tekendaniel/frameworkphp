<?php

class ProveedorModel{


    protected $connection;

    protected $response;

    public function __construct()
    {
        $this->connection = new DataBase;


    }


    public function MostrarProveedores($idUsuario){
        try{
            $this->connection->query("CALL mostrarProveedores(:ID)");
            $this->connection->bind(":ID", $idUsuario);
            $result = $this->connection->dataAll();

            return $result;

        }catch(Exception $e){

            return $e->getMessage();
        }
       
    }

    public function BuscarProveedor(int $idUsuario, string $nombreProveedor){

        $this->connection->query("CALL buscarProveedor(:NP, :ID)");
        $this->connection->bind(":NP", $nombreProveedor);
        $this->connection->bind(":ID", $idUsuario);
        

        $result = $this->connection->dataOne();

        return $result;

    }

    public function BuscarProveedorPorId(int $idProveedor){

        $this->connection->query("CALL buscarProveedorporId(:ID)");
        $this->connection->bind(":ID", $idProveedor);
        

        $result = $this->connection->dataOne();

        return $result;

    }


    public function ExistProveedor(string $nombreProveedor, int $idUsuario){

        $this->connection->query("CALL buscarProveedor(:NP, :ID)");
        $this->connection->bind(":NP", $nombreProveedor);
        $this->connection->bind(":ID", $idUsuario);
        

        $this->connection->execute();

        return $this->connection->rowCount();

    }

    /* MUESTRA LOS SERVICIOS DE CADA PROVEEDOR */
    public function MostrarSuscripcionesDeProveedores($idProveedor){
        try{
            $this->connection->query("CALL mostrarSuscripcion(:IP)");
            $this->connection->bind(":IP",$idProveedor );
            $this->response = $this->connection->dataAll();
    
            
        }catch(Exception $e){
            $this->response = $e->getMessage();
        }

        return $this->response;

    }

    public function InsertProveedor(int $idUsuario, string $nombre, string $categoria, string $descripcion, string $telefono, array $suscripciones ){
        try{

            if($this->ExistProveedor($nombre, $idUsuario) == 1)
            {
                 $this->response = "Ya hay un proveedor con el nombre " . $nombre;
            }else{

                $this->connection->query("CALL crearProveedor(:N, :T, :D, :C, :IU)");
                $this->connection->bind(":N", $nombre);
                $this->connection->bind(":T", $telefono);
                $this->connection->bind(":D", $descripcion);
                $this->connection->bind(":C", $categoria);
                $this->connection->bind(":IU", $idUsuario);

                $this->connection->execute();

                $idProveedor = $this->BuscarProveedor($idUsuario, $nombre);

                if($idProveedor){
      
                    foreach($suscripciones as $sus){

                        $this->connection->query("CALL agregarSuscripcion(:N, :D, :P, :IP)");
                        $this->connection->bind(":N", $sus->nombresuscripcion);
                        $this->connection->bind(":D", $sus->descripcion);
                        $this->connection->bind(":P", floatval($sus->precio) );
                        $this->connection->bind(":IP", intval($idProveedor->IdProveedor) );
    
                        $this->connection->execute();
    
    
                        $this->response =  $this->MostrarProveedores($idUsuario);
                    }
                }

            }

        }catch(Exception $e){

            $this->response = "Ha ocurrido un error al registrar proveedor";
        }
        
            return $this->response;
    }


    public function EliminarProveedorModel($idProveedor){
        try{
            $this->connection->query("CALL eliminarProveedor(:IP)");
            $this->connection->bind(":IP",$idProveedor );
            
            $this->connection->execute();

            return true;
    
            
        }catch(Exception $e){
            $this->response = $e->getMessage();
        }
    }
}