<?php

return [

    /*
   |--------------------------------------------------------------------------
   | Application Key
   |--------------------------------------------------------------------------
   |
   | Your application's API key. Make sure to get a Key before starting using
   | Google Geocoding API.
   |
   */

    'api_key' => '',

    /*
    |--------------------------------------------------------------------------
    | Google Maps Geocoding API URL
    |--------------------------------------------------------------------------
    |
    | Here you san set the URL for the Google Maps Geocoding API. By default,
    | HTTPS protocol has been selected.
    |
    */

    'request_url' => 'https://maps.googleapis.com/maps/api/geocode/',

    /*
    |--------------------------------------------------------------------------
    | Response Output Format
    |--------------------------------------------------------------------------
    |
    | Here you can configure the preferred output format of a Geocoding
    | Request.
    |
    | Supported: "json", "xml"
    |
    */

    'output_format' => 'json',
];