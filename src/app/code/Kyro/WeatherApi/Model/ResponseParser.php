<?php

declare(strict_types=1);

namespace Kyro\WeatherApi\Model;

use Kyro\Weather\Api\Data\WeatherDataInterfaceFactory;
use Kyro\Weather\Api\Data\WeatherDataInterface;
use Kyro\WeatherApi\Constants\ProviderConst;
use Psr\Http\Message\ResponseInterface;

class ResponseParser
{
    protected WeatherDataInterfaceFactory $weatherDataFactory;

    public function __construct(
        WeatherDataInterfaceFactory $weatherDataFactory
    ) {
        $this->weatherDataFactory = $weatherDataFactory;
    }

    /**
     * @todo::choose if save/show temperature in c or f
     */
    public function parseProviderResponse(
        string $providerCode,
        string $ip,
        ResponseInterface $response
    ): WeatherDataInterface {
        $decoded = json_decode($response->getBody()->getContents(), true);
        $model = $this->weatherDataFactory->create()->setIp($ip);

        switch ($providerCode) {
            case ProviderConst::CODE_WEATHERAPI:
                $model->setLocationName($decoded['location']['name'])
                    ->setCountry($decoded['location']['country'])
                    ->setTemperature($decoded['current']['temp_c'])
                    ->setConditionText($decoded['current']['condition']['text'])
                    ->setConditionIcon($decoded['current']['condition']['icon']);
                break;
            case ProviderConst::CODE_WEATHERSTACK:
                $model->setLocationName($decoded['location']['name'])
                    ->setCountry($decoded['location']['country'])
                    ->setTemperature($decoded['current']['temperature'])
                    ->setConditionText($decoded['current']['weather_descriptions']['0'])
                    ->setConditionIcon($decoded['current']['weather_icons']['0']);
                break;
        }

        return $model;
    }
}
