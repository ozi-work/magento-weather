<?php

declare(strict_types=1);

namespace Kyro\WeatherApi\Traits;

use Kyro\WeatherApi\Exception\ValidatorException;
use Kyro\WeatherApi\Exception\WeatherException;

Trait ExceptionTrait
{
    /**
     * @throws WeatherException
     */
    public function throwWeatherException(string $message): void
    {
        throw new WeatherException($message);
    }

    /**
     * @throws ValidatorException
     */
    public function throwValidatorException(string $message): void
    {
        throw new ValidatorException($message);
    }
}
