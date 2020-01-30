<?php

namespace App\Services;

class Helper{
    public static function isValidUrl($url){
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            return false;
        }
        return true;
    }
}
