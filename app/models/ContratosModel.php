<?php


class ContratosModel
{


    protected $connection;

    protected $response;

    public function __construct()
    {
        $this->connection = new DataBase;
    }

    public function listarContratos($idUsuario)
    {
        try {

            $this->connection->query("CALL listarContratos(:ID)");
            $this->connection->bind(":ID", $idUsuario);
            $resp = $this->connection->dataAll();

            $this->response = $resp;
        } catch (Exception $e) {

            $this->response = $e->getMessage();
        }
        return $this->response;
    }

    public function contratarSuscripcion($inicio, $ciclo, $duracion, $idServicio, $idProveedor, $idUsuario, $tiempoRecordatorio)
    {
        try {

            $this->connection->query("INSERT INTO suscripcion_contratada(Inicio, Ciclo, Duracion, idServicio, idUsuario, idProveedor, TiempoRecordatorio) VALUES(:ii, :cc, :dd, :iser, :idus, :idp, :tpm)");

            $this->connection->bind(":ii", $inicio);
            $this->connection->bind(":cc", $ciclo);
            $this->connection->bind(":dd", $duracion);
            $this->connection->bind(":iser", $idServicio);
            $this->connection->bind(":idus", $idUsuario);
            $this->connection->bind(":idp", $idProveedor);
            $this->connection->bind(":tpm", $tiempoRecordatorio);

            $this->connection->execute();
        } catch (Exception $e) {

            $this->response = $e->getMessage();
        }
    }


    public function isExistSuscripcion($idServicio, $idProveedor)
    {
        try {

            $this->connection->query("SELECT * FROM suscripcion_contratada WHERE idServicio = :ISS AND IdProveedor = :IP");

            $this->connection->bind(":ISS", $idServicio);
            $this->connection->bind(":IP", $idProveedor);

            $this->connection->execute();

            if ($this->connection->rowCount() > 0) {

                return true;
            }
        } catch (Exception $e) {

            $this->response = $e->getMessage();
        }
    }

    public function EditarRecordatorio($inicio, $ciclo, $duracion, $idServicio, $idProveedor, $tiempoRecordatorio, $IdSusContratada)
    {
       try{
           $this->connection->query("UPDATE suscripcion_contratada SET Inicio = :INN, Ciclo = :CC, Duracion = :DD, TiempoRecordatorio = :TR, idServicio = :ISR, idProveedor = :IPR WHERE IdSusContratada = :ISC");
           $this->connection->bind(":INN", $inicio);
           $this->connection->bind(":CC", $ciclo);
           $this->connection->bind(":DD", $duracion);
           $this->connection->bind(":TR", $tiempoRecordatorio);
           $this->connection->bind(":ISR", $idServicio);
           $this->connection->bind(":IPR", $idProveedor);
           $this->connection->bind(":ISC", $IdSusContratada);
           $this->connection->execute();

           $this->response = true;
       }
       catch(Exception $e){
           $this->response = $e->getMessage();
       }

       return $this->response;
    }

    public function obtenerRecordatorio($idRecordatorio)
    {
        try {
            $this->connection->query("SELECT * FROM suscripcion_contratada WHERE IdSusContratada = :IDR");
            $this->connection->bind(":IDR", $idRecordatorio);
            $result = $this->connection->dataOne();

            if (is_object($result)) {
                $this->response = $result;
            }
        } catch (Exception $e) {
            $this->response = $e->getMessage();
        }

        return $this->response;
    }

    public function deleteRecordatorio($idRecordatorio)
    {
        try{
            $this->connection->query("DELETE FROM suscripcion_contratada WHERE IdSusContratada = :IDR");
            $this->connection->bind(":IDR", $idRecordatorio);
            $this->connection->execute();
            $this->response = array('deleted' => true);
        }catch(Exception $e){
            $this->response = $e->getMessage();
        }

        return $this->response;
    }
}
