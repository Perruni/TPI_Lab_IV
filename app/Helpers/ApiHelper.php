<?php

namespace App\Helpers;

class ApiHelper
{
    public static function getApiKey()
    {       
        return env('API_KEY');
    }   
}