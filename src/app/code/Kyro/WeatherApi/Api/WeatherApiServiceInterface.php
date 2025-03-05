<?php

declare(strict_types=1);

namespace Kyro\WeatherApi\Api;

use Kyro\Weather\Api\Data\WeatherDataInterface;
use Kyro\WeatherApi\Exception\WeatherException;

interface WeatherApiServiceInterface
{
    /**
     * @param string $ip
     * @return WeatherDataInterface
     * @throws WeatherException
     */
    public function getWeatherData(string $ip): WeatherDataInterface;
}
