<?php

declare(strict_types=1);

namespace Kyro\WeatherFrontend\Block;

use Kyro\Weather\Api\Data\WeatherDataInterface;
use Kyro\Weather\Api\WeatherServiceInterface;
use Kyro\Weather\Helper\Config;
use Magento\Framework\View\Element\Template;

/**
 * @todo::
 */
class Weather extends Template
{
    protected WeatherServiceInterface $weatherService;
    protected Config $config;

    public function __construct(
        Template\Context $context,
        WeatherServiceInterface $weatherService,
        Config $config,
        array $data = []
    ) {
        $this->weatherService = $weatherService;
        $this->config = $config;
        parent::__construct($context, $data);
    }

    public function getWeatherData(): ?WeatherDataInterface
    {
        return $this->weatherService->getFreshByIp($this->weatherService->getPublicIp());
    }

    public function isEnabled(): bool
    {
        return $this->config->isWeatherEnabled();
    }
}
