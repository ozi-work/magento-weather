<?php

declare(strict_types=1);

namespace Kyro\WeatherApi\Model;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Kyro\WeatherApi\Helper\Config;
use Psr\Http\Message\ResponseInterface;

/**
 * @todo::add test mode with mockups
 */
class Client
{
    protected GuzzleClient $client;
    protected Config $config;

    public function __construct(
        GuzzleClient $client,
        Config $config
    ) {
        $this->client = $client;
        $this->config = $config;
    }

    public function getWeatherapiResponse(string $ip): ResponseInterface
    {
        return $this->request(
            'GET',
            $this->config->getWeatherapiApiUrl(),
            [
                'query' => [
                    'key' => $this->config->getWeatherapiApiKey(),
                    'q' => $ip
                ]
            ]
        );
    }

    public function getWeatherstackResponse(string $ip): ResponseInterface
    {
        return $this->request(
            'GET',
            $this->config->getWeatherstackApiUrl(),
            [
                'query' => [
                    'access_key' => $this->config->getWeatherstackApiKey(),
                    'query' => $ip
                ]
            ]
        );
    }

    /**
     * @todo::add logs before/after request if needed
     * @throws GuzzleException
     */
    protected function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        return $this->client->request($method, $uri, $options);
    }
}
