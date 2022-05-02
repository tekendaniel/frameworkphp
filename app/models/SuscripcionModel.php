<?php


class SuscripcionModel{


    protected $connection;

    protected $response;

    public function __construct()
    {
        $this->connection = new DataBase;


    }


    public function registrarSuscripcion(string $inicio, string $ciclo, string $duracion, int $idServicio, int $idUsuario, int $idProveedor, string $tipoMoneda ){

        try{

            $this->connection->query("CALL contratarSuscripcion(:IN, :CI, :DR, :ISS, :IDUS, :IPPP,  :TM )");
            $this->connection->bind(":IN", $inicio);
            $this->connection->bind(":CI", $ciclo);
            $this->connection->bind(":DR", $duracion);
            $this->connection->bind(":ISS", $idServicio);
            $this->connection->bind(":IDUS", $idUsuario);
            $this->connection->bind(":IPPP", $idProveedor);
            $this->connection->bind(":TM", $tipoMoneda);
    
            $this->connection->execute();

        }catch(Exception $e){

            $this->response = $e->getMessage();
        }
       
        return $this->response;
    }


    public function registrarRecordatorio(int $tiempoRecordatorio, int $idsuscripcionContratada){
        try{
            $this->connection->query("CALL agregarRecordatorio(:TP, :ISC)");
            $this->connection->bind(":TP", $tiempoRecordatorio);
            $this->connection->bind(":ISC", $idsuscripcionContratada);


            $this->connection->execute();

        }catch(Exception $e){

            $this->response = $e->getMessage();
        }

        return $this->response;
    }

}