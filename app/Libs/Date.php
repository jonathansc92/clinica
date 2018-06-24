<?php

namespace App\Libs;

use Carbon\Carbon;

class Date {

    public static function formatUSA($pDate, $time = 'S') {

        if ($time == 'S') {
            return Carbon::parse($pDate)->format('Y-m-d h:i:s');
        } else {
            return Carbon::parse($pDate)->format('Y-m-d');
        }
    }

    public static function isDataGreater($pData, $pData2) {

//        dd(strtotime($pData2).' '.strtotime($pData));
        if (strtotime($pData) > strtotime($pData2)) {
            return true;
        }
        return false;
    }

    public static function dateTimeNow() {
        return Carbon::now()->toDateTimeString();
    }

    public static function dateTimeBR($pDate) {
        return Carbon::parse($pDate)->format('d/m/Y h:i');
    }

    public static function convertBRToUSA($pDate, $time = 'S') {
        if ($time == 'S') {
            return Carbon::createFromFormat('d/m/Y', $pDate)->format('Y-m-d h:i');
        } else {
            return Carbon::createFromFormat('d/m/Y', $pDate)->format('Y-m-d');
        }
    }

}
