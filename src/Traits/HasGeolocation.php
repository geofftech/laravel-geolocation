<?php

namespace GeoffTech\LaravelGeolocation\Traits;

use GeoffTech\LaravelGeolocation\Services\GeolocationService;
use Illuminate\Database\Eloquent\Builder;

trait HasGeolocation
{

  public function scopeWhereWithinRadius(Builder $query, int $km, float $latitude, float $longitude): void
  {

    $degrees = $km * 0.0117;

    $query
      ->whereBetween('latitude', [$latitude - $degrees, $latitude + $degrees])
      ->whereBetween('longitude', [$longitude - $degrees, $longitude + $degrees]);

  }

  public function scopeWhereWithinRadiusOfMe(Builder $query, int $km): void
  {

    [$latitude, $longitude] = GeolocationService::get();

    $this->scopeWhereWithinRadius($query, $km, $latitude, $longitude);

  }

  public static function getLatLngAttributes(): array
  {
    return [
      'lat' => 'latitude',
      'lng' => 'longitude',
    ];
  }

}

