<?php

namespace App\Constants;

define('CONFIRMADO', 'Confirmado');
define('CANCELADO', 'Cancelado');

class Status {

    public static function statusLst(){
        return array(1=>CONFIRMADO, 2=>CANCELADO);
    }

    public static function getStatus($p) {

        switch ($p) {
            case 1:
                return CONFIRMADO;
                break;
            case 2:
                return CANCELADO;
                break;      
        }
    }
    
   public static function getStatusWithStyle($p){
       switch ($p) {
            case 1:
                return '<span class="label label-success">'. CONFIRMADO .'</span>';
                break;
            case 2:
                return '<span class="label label-danger">'. CANCELADO . '</span>';
                break;      
        }
       
   }

}

