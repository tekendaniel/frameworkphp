<?php

class Session{

    protected static $val;

    protected static $valReturn;


    public static function setSession($index, $value){


        if(isset($value)){

            switch ($value){

                case is_object($value):
                    self::$val = json_encode($value);
                    break;
                
                case is_array($value):
                    self::$val = json_encode($value);
                    break;
                
                default:
                    self::$val = htmlentities($value);

            }

            $_SESSION[$index] = self::$val;
        }
    
    }

    public static function IsExist($index){

        if(isset($index)){

            if(isset($_SESSION[$index])){

                return true;
            }

        }
    }
    
    public static function getSession($index){


        if(isset($index)){

            if(isset($_SESSION[$index])){

                $ss = $_SESSION[$index];

                self::$valReturn = json_decode($ss, true);

                return self::$valReturn;
            }

        }

    }

    public static function clearSesion($index){


        if(isset($index)){

            if(isset($_SESSION[$index])){

                unset($_SESSION[$index]);
            }

        }
    }

        
    
}