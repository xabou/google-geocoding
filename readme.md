# Laravel Geocoder
This package provides a wrapper around Google Geocoding API for your Laravel application. 

## Installation

#### 1. Require via composer
Add the `xabou/google-geocoding` Composer dependency to your project.
```
composer require xabou/google-geocoding
```

#### 2. Register Service Provider
Open `config/app.php` and append `providers` array with:

```
Xabou\Geocoding\GeocodingServiceProvider::class
```
## Usage

#### Api Key
In order to start using Google Geocoding API you must obtain first an 
[API key](https://developers.google.com/maps/documentation/geocoding/start#api_key).  
After getting your key just add it to your .env file

```
GOOGLE_GEOCODING_API_KEY=PutYourKeyHere
```

#### Singleton
Geocoder is register as singleton in Laravel's Service Container making it easy to call it  
anywhere within your application. Simply 'make' Geocoder with app helper method.

```
app('Geocoder')
```

#### Fluent API
Geocoder provides a fluent API for every available parameter in geocoding request.
```
app('Geocoder')->address('stadiou 14')
               ->language('el')
               ->region('gr')
               ->geocode()
```

You can also pass an array of parameters
```
app('Geocoder')->parameters([
                  'address'  => 'stadiou 14'
                  'language' => 'el'
                  'region'   => 'gr'
                ])
               ->geocode()
```

**Note:** *Key* will be set from config file. Any value passed with parameters method will be overwritten.  
More about available parameters you can find at 
[Google Geocoding Documentation](https://developers.google.com/maps/documentation/geocoding/intro#geocoding).  

## Configuration

If you need to change some of the default configuration, you can publish the configuration file and make  
any changes you need:
```
php artisan vendor:publish --tag=geocoding-config
```

A config file with name `geocoding.php` will be created.

```php
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

    'api_key' => env('GOOGLE_GEOCODING_API_KEY'),

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
```
##License

This package is released under the MIT License.
