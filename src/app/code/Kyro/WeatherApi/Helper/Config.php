<?php

declare(strict_types=1);

namespace Kyro\WeatherApi\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Config extends AbstractHelper
{
    const XML_PATH_WEATHERAPI_API_KEY = 'kyro_weather/weatherapi/api_key';
    const XML_PATH_WEATHERAPI_API_URL = 'kyro_weather/weatherapi/api_url';
    const XML_PATH_WEATHERSTACK_API_KEY = 'kyro_weather/weatherstack/api_key';
    const XML_PATH_WEATHERSTACK_API_URL = 'kyro_weather/weatherstack/api_url';

    public function getWeatherapiApiKey(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_WEATHERAPI_API_KEY);
    }

    public function getWeatherapiApiUrl(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_WEATHERAPI_API_URL);
    }

    public function getWeatherstackApiKey(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_WEATHERSTACK_API_KEY);
    }

    public function getWeatherstackApiUrl(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_WEATHERSTACK_API_URL);
    }
}
