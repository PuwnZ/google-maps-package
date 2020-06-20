<?php

namespace Puwnz\GoogleMapsPackage;
use Puwnz\GoogleMapsLib\Geocode\GeocodeFactory;

class GoogleMaps
{
    private $apiKey;
    private $logFile;
    private $httpVersion;
    public $geocodeClient;

    public function __construct()
    {
        $this->apiKey = env('GOOGLE_MAPS_API_KEY');
        $this->logFile = env('GOOGLE_MAPS_LOG_FILE');
        $this->httpVersion = env('GOOGLE_MAPS_HTTP_VERSION', 2.0);

        $this->geocodeClient = GeocodeFactory::create($this->apiKey, $this->logFile, $this->httpVersion);
    }
}
