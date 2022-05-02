<?php


class Resolve{

    protected static $response;
    
    function __construct()
    {
        
    }

    public static function Response($objectData){

        if(is_array($objectData)){

            self::$response =  json_encode($objectData);
        }

        if(is_string($objectData)){
            self::$response = json_encode(array("content" => htmlentities($objectData)));
        }

        if(is_object($objectData)){
            self::$response = json_encode(array("content" => $objectData));
        }

        echo self::$response;
    }
}