<?php

declare(strict_types=1);

namespace Kyro\Weather\Api\Data;

/**
 * @todo::add providers and exclude condition to other tables
 */
interface WeatherDataInterface
{
    public const FIELD_ID = 'id';
    public const FIELD_IP = 'ip';
    public const FIELD_LOCATION_NAME = 'location_name';
    public const FIELD_COUNTRY = 'country';
    public const FIELD_TEMPERATURE = 'temperature';
    public const FIELD_CONDITION_TEXT = 'condition_text';
    public const FIELD_CONDITION_ICON = 'condition_icon';
    public const FIELD_UPDATED_AT = 'updated_at';

    public function getId();
    public function setId(mixed $id);

    public function getIp(): string;
    public function setIp(string $ip): self;

    public function getLocationName(): string;
    public function setLocationName(string $locationName): self;

    public function getCountry(): ?string;
    public function setCountry(?string $country): self;

    public function getTemperature(): float;
    public function setTemperature(float $temperature): self;

    public function getConditionText(): string;
    public function setConditionText(string $conditionText): self;

    public function getConditionIcon(): ?string;
    public function setConditionIcon(?string $conditionIcon): self;

    public function getUpdatedAt(): ?string;
}
