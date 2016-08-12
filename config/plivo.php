<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Plivo API Credentials
    |--------------------------------------------------------------------------
    |
    | Set your API credentials from https://manage.plivo.com/dashboard/
    |
    */

    'auth_id' => env('PLIVO_AUTH_ID', ''),

    'auth_token' => env('PLIVO_AUTH_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | From number
    |--------------------------------------------------------------------------
    |
    | Set your default number
    |
    */

    'from_number' => env('PLIVO_FROM_NUMBER', ''),

];
