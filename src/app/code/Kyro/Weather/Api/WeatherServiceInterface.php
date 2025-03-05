<?php

declare(strict_types=1);

namespace Kyro\Weather\Api;

use Kyro\Weather\Api\Data\WeatherDataInterface;
use Kyro\Weather\Constants\WeatherConst;

interface WeatherServiceInterface
{
    /**
     * Get fresh weather data by IP. If outdated or missing, fetch new data.
     *
     * @param string $ip
     * @param int $expiryHours
     * @return WeatherDataInterface|null
     */
    public function getFreshByIp(
        string $ip,
        int $expiryHours = WeatherConst::DEFAULT_DATA_EXPIRY_HOURS
    ): ?WeatherDataInterface;

    public function getPublicIp(): string;
}
