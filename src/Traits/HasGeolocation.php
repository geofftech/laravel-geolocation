<?php

namespace GeoffTech\LaravelGeolocation\Traits;

use GeoffTech\LaravelGeolocation\Services\GeolocationService;
use Illuminate\Database\Eloquent\Builder;

trait HasGeolocation
{

  public function scopeWithinRadius(Builder $query, int $km, float $latitude, float $longitude): void
  {

    $degrees = $km * 0.0117;

    $query
      ->whereBetween('latitude', [$latitude - $degrees, $latitude + $degrees])
      ->whereBetween('longitude', [$longitude - $degrees, $longitude + $degrees]);

  }

  public function scopeWithinRadiusOfMe(Builder $query, int $km): void
  {

    [$latitude, $longitude] = GeolocationService::get();

    $this->scopeWithinRadius($query, $km, $latitude, $longitude);

  }

  public static function getLatLngAttributes(): array
  {
    return [
      'lat' => 'latitude',
      'lng' => 'longitude',
    ];
  }

}

