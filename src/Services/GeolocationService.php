<?php

namespace GeoffTech\LaravelGeolocation\Services;

use Stevebauman\Location\Facades\Location;

class GeolocationService
{
    public static function get()
    {
        $position = Location::get();

        if ($position === false && app()->isLocal()) {
            // return defaults canberra
            return [-35.353, 149.013];
        }

        if ($position === false) {
            return [0, 0];
        }

        return [
            floatval($position->latitude),
            floatval($position->longitude),
        ];

    }
}
