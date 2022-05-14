<?php

class DataBase{
    private $host = DB_HOST;
    private $usuario = DB_USUARIO;
    private $password = DB_PASSWORD;
    private $nombre_base = DB_NOMBRE;

    private $dbh;
    private $stmt;
    private $error;
 

    public function __construct()
    {

        try{
            $dsn = 'mysql:host=' . $this->host . '; dbname=' . $this->nombre_base;
            $opciones = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            $this->dbh = new PDO($dsn, $this->usuario, $this->password, $opciones);
            $this->dbh->exec('set names utf8');

        }catch(Exception $e){
            $this->error = $e->getMessage();
        }


    }


    public function query($sql){

        $this->stmt = $this->dbh->prepare($sql);

    }

    public function bind($param, $value, $tipo =null)
    {
       if(is_null($tipo)){
           switch (true){
                case is_int($value):
                    $tipo = PDO::PARAM_INT;
                break;

                case is_bool($value):
                    $tipo = PDO::PARAM_BOOL;
                break;

                case is_null($value):
                    $tipo = PDO::PARAM_NULL;
                break;

                default:
                    $tipo = PDO::PARAM_STR;
                break;

           }

           $this->stmt->bindValue($param, $value, $tipo);
       }
    }

    public function execute(){

        $this->stmt->execute();
    }

    public function dataOne(){
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function dataAll(){
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }

    
}