<?php


class ContratosModel{


    protected $connection;

    protected $response;

    public function __construct()
    {
        $this->connection = new DataBase;


    }

    public function listarContratos($idUsuario){
        try{

            $this->connection->query("CALL listarContratos(:ID)");
            $this->connection->bind(":ID", $idUsuario);
            $resp = $this->connection->dataAll();
    
           $this->response = $resp;

        }catch(Exception $e){

            $this->response = $e->getMessage();
        }
        return $this->response;
    }

    public function contratarSuscripcion($inicio, $ciclo, $duracion, $idServicio, $idProveedor, $idUsuario, $tiempoRecordatorio){
        try{
            
            $this->connection->query("INSERT INTO suscripcion_contratada(Inicio, Ciclo, Duracion, idServicio, idUsuario, idProveedor, TiempoRecordatorio) VALUES(:ii, :cc, :dd, :iser, :idus, :idp, :tpm)");

            $this->connection->bind(":ii", $inicio);
            $this->connection->bind(":cc", $ciclo);
            $this->connection->bind(":dd", $duracion);
            $this->connection->bind(":iser", $idServicio);
            $this->connection->bind(":idus", $idUsuario);
            $this->connection->bind(":idp", $idProveedor);
            $this->connection->bind(":tpm", $tiempoRecordatorio);

            $this->connection->execute();

        }catch(Exception $e){

            $this->response = $e->getMessage();

        }
    }


    public function isExistSuscripcion($idServicio, $idProveedor){
        try{

            $this->connection->query("SELECT * FROM suscripcion_contratada WHERE idServicio = :ISS AND IdProveedor = :IP");

            $this->connection->bind(":ISS", $idServicio);
            $this->connection->bind(":IP", $idProveedor);

            $this->connection->execute();

            if($this->connection->rowCount()>0){

                return true;

            }


        }catch(Exception $e){

            $this->response = $e->getMessage();
        }
    }

}


