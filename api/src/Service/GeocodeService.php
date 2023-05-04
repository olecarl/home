<?php

declare(strict_types=1);

namespace App\Service;


use Geocoder\Provider\Provider;

class GeocodeService
{
    private Provider $googleMapsGeocoder;

    public function __construct(Provider $googleMapsGeocoder)
    {
        $this->googleMapsGeocoder = $googleMapsGeocoder;
    }
}
