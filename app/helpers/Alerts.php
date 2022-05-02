<?php 

class Alert{

    protected static $mensaje;
    protected static $type;
    protected static $time;
    protected static $icon;


     public static function show($type, $mensaje)
    {
        self::$type = $type;
        self::$mensaje = $mensaje;

        self::setType();
        return self::CreateMessage();

    }

    public static function CreateMessage(){

        return '<div class="'. 'alert alert-'. self::$type . ' d-flex align-items-center p-2 alert-dismissible"'. 'role="alert">'.
        self::$icon .'<div>'. self::$mensaje. '</div> 
        <button type="button" class="btn-close btn-sm" style="padding: 13px 8px;" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';


    }

    public static function setType(){

        switch(self::$type){
            case null:
                self::$type ="success";
                self::$icon ='  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                '; 
                break;
            case 'error':
                self::$type = "danger";
                self::$icon ='<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>'; 
                break;
            case 'warning':
                self::$type = "warning";
                self::$icon ='<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>'; 
                break;
            case "info":
                self::$type="info";
                self::$icon = '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>';
                break;
            }
         
    }
}


?>