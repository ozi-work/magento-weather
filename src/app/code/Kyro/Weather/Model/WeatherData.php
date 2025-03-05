<?php

declare(strict_types=1);

namespace Kyro\Weather\Model;

use Kyro\Weather\Api\Data\WeatherDataInterface;
use Magento\Framework\Model\AbstractModel;
use Kyro\Weather\Model\ResourceModel\WeatherData as WeatherDataResource;

class WeatherData extends AbstractModel implements WeatherDataInterface
{
    protected function _construct()
    {
        $this->_init(WeatherDataResource::class);
    }

    public function getIp(): string
    {
        return $this->getData(WeatherDataInterface::FIELD_IP);
    }

    public function setIp(string $ip): WeatherDataInterface
    {
        return $this->setData(WeatherDataInterface::FIELD_IP, $ip);
    }

    public function getLocationName(): string
    {
        return $this->getData(WeatherDataInterface::FIELD_LOCATION_NAME);
    }

    public function setLocationName(string $locationName): WeatherDataInterface
    {
        return $this->setData(WeatherDataInterface::FIELD_LOCATION_NAME, $locationName);
    }

    public function getCountry(): ?string
    {
        return $this->getData(WeatherDataInterface::FIELD_COUNTRY);
    }

    public function setCountry(?string $country): WeatherDataInterface
    {
        return $this->setData(WeatherDataInterface::FIELD_COUNTRY, $country);
    }

    public function getTemperature(): float
    {
        return (float)$this->getData(WeatherDataInterface::FIELD_TEMPERATURE);
    }

    public function setTemperature(float $temperature): WeatherDataInterface
    {
        return $this->setData(WeatherDataInterface::FIELD_TEMPERATURE, $temperature);
    }

    public function getConditionText(): string
    {
        return $this->getData(WeatherDataInterface::FIELD_CONDITION_TEXT);
    }

    public function setConditionText(string $conditionText): WeatherDataInterface
    {
        return $this->setData(WeatherDataInterface::FIELD_CONDITION_TEXT, $conditionText);
    }

    public function getConditionIcon(): ?string
    {
        return $this->getData(WeatherDataInterface::FIELD_CONDITION_ICON);
    }

    public function setConditionIcon(?string $conditionIcon): WeatherDataInterface
    {
        return $this->setData(WeatherDataInterface::FIELD_CONDITION_ICON, $conditionIcon);
    }

    public function getUpdatedAt(): ?string
    {
        return $this->getData(WeatherDataInterface::FIELD_UPDATED_AT);
    }
}
