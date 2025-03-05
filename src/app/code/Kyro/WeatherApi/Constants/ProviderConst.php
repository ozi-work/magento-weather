<?php

declare(strict_types=1);

namespace Kyro\WeatherApi\Constants;

class ProviderConst
{
    const CODE_WEATHERAPI = 'weatherapi';
    const CODE_WEATHERSTACK = 'weatherstack';

    const PROVIDERS = [
        self::CODE_WEATHERAPI,
        self::CODE_WEATHERSTACK
    ];
}
