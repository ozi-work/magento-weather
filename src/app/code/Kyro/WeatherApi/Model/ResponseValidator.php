<?php

declare(strict_types=1);

namespace Kyro\WeatherApi\Model;

use Kyro\WeatherApi\Exception\ValidatorException;
use Kyro\WeatherApi\Traits\ExceptionTrait;
use Psr\Http\Message\ResponseInterface;

class ResponseValidator
{
    use ExceptionTrait;

    /**
     * @throws ValidatorException
     */
    public function validate(ResponseInterface $response): void
    {
        if ($response->getStatusCode() !== 200) {
            $this->throwValidatorException(sprintf('wrong status code: %i', $response->getStatusCode()));
        }

        $content = $response->getBody()->getContents();
        $decoded = json_decode($content, true);

        //validate weatherapi and weatherstack
        if (!isset($decoded['location']) || !isset($decoded['current'])) {
            $this->throwValidatorException('Unknown response structure');
        }

        $response->getBody()->rewind();
    }
}
