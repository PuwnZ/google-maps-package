# Google Maps Package

## Overview

The Google Maps Lib project provides a Google Map Lib integration for you Laravel 6+ and PHP 7.3+ project. At this time, just geocode is enable in this lib, because my needs is only on this part, but you can open [issues](/issues) to push your needs.

## Installation

To install this lib you can just use composer :

```
composer require puwnz/google-maps-package
```

## Integration

### Package registration

#### Add Google Maps environment variable

Edit your .env file (at the root folder of your laravel project) and add your google maps api key, log file, and http
version to communicate with google.

```
GOOGLE_MAPS_API_KEY=MyApiKey
GOOGLEMAPS_LOG_FILE=./storage/log/geocode.log # optional
GOOGLE_MAPS_HTTP_VERSION=2.0 # optional
```

#### Configure your laravel providers to use this wrapper

Edit config/app.php and add in providers section:

```php
 'providers' => [
        // the other Provider
        /*
         * Package Service Providers...
         */
        \Puwnz\GoogleMapsPackage\GoogleMapsServiceProvider::class,
    ],
```

### How to use this wrapper

You can inject it directly in your Controller like this:

```php
<?php

namespace App\Http\Controllers;

use Puwnz\GoogleMapsLib\Constants\SupportedLanguage;
use Puwnz\GoogleMapsLib\Geocode\QueryBuilder\AddressQueryBuilder;
use Puwnz\GoogleMapsLib\Geocode\Type\GeocodeComponentQueryType;
use Puwnz\GoogleMapsPackage\GoogleMaps;
use Symfony\Component\Validator\Validation;

class IndexController extends Controller
{
    public function index(GoogleMaps $googleMaps)
    {
        $components = [
            GeocodeComponentQueryType::COUNTRY => 'FR'
        ];
        $addressBuilder = new AddressQueryBuilder(Validation::createValidator());
        $addressBuilder->setAddress('10 rue de la Paix, Paris')
            ->setComponents($components)
            ->setLanguage(SupportedLanguage::FRENCH)
            ->setBounds([
                'northeast' => [
                    'lat' => 0.0,
                    'lng' => 1.0
                ],
                'southwest' => [
                    'lat' => -0.0,
                    'lng' => -1.0
                ]
            ]);
        $response = $googleMaps->geocodeClient->getGeocodeByBuilder($addressBuilder);
    }
}

```