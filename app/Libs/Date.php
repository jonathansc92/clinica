<?php

namespace App\Libs;

use Carbon\Carbon;

class Date {

   
    public static function formatUSA($pDate){
      return Carbon::parse($pDate)->format('Y-m-d');
    }
    
    public static function dateTimeNow(){
       return Carbon::now()->toDateTimeString();
    }
    
    public static function dateTimeBR($pDate){
       return Carbon::parse($pDate)->format('d/m/Y h:i');
    }
    
    public static function convertBRToUSA($pDate){
        return Carbon::createFromFormat('d/m/Y', $pDate)->format('Y-m-d');
    }

}
