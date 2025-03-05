<?php

declare(strict_types=1);

namespace Kyro\WeatherApi\Model;

use Exception;
use Kyro\Weather\Api\Data\WeatherDataInterface;
use Kyro\WeatherApi\Api\WeatherApiServiceInterface;
use Kyro\WeatherApi\Constants\ProviderConst;
use Kyro\WeatherApi\Exception\WeatherException;
use Kyro\WeatherApi\Traits\ExceptionTrait;
use Monolog\Logger;

class WeatherApiService implements WeatherApiServiceInterface
{
    use ExceptionTrait;

    protected Client $client;
    protected ResponseValidator $responseValidator;
    protected ResponseParser $responseParser;
    protected Logger $logger;
    protected array $providers;

    public function __construct(
        Client $client,
        ResponseValidator $responseValidator,
        ResponseParser $responseParser,
        Logger $logger,
        array $providers = [] //injected in xml
    ) {
        $this->client = $client;
        $this->responseValidator = $responseValidator;
        $this->responseParser = $responseParser;
        $this->logger = $logger;
        $this->providers = $providers;
    }

    /**
     * @inheritDoc
     * @throws WeatherException|Exception
     */
    public function getWeatherData(string $ip): WeatherDataInterface
    {
        foreach ($this->providers as $providerCode) {
            try {
                $response = match ($providerCode) {
                    ProviderConst::CODE_WEATHERAPI   => $this->client->getWeatherapiResponse($ip),
                    ProviderConst::CODE_WEATHERSTACK => $this->client->getWeatherstackResponse($ip),
                    default => $this->throwWeatherException(sprintf('Unknown provider code: %s', $providerCode))
                };
                $this->responseValidator->validate($response);

                return $this->responseParser->parseProviderResponse($providerCode, $ip, $response);
            } catch (Exception $e) {
                $this->logger->error('getWeatherData: ' . $e->getMessage());

                throw $e;
            }
        }

        $this->throwWeatherException('Cannot get valid response from any provider');
    }
}
