<?php

declare(strict_types=1);

namespace Kyro\Weather\Api;

use Kyro\Weather\Api\Data\WeatherDataInterface;
use Kyro\Weather\Api\Data\WeatherDataSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface WeatherDataRepositoryInterface
{
    public function getByIp(string $ip): WeatherDataInterface;

    public function save(WeatherDataInterface $weatherData): WeatherDataInterface;

    public function saveOnDuplicateUpdate(WeatherDataInterface $weatherData): WeatherDataInterface;

    public function delete(WeatherDataInterface $weatherData): bool;

    public function deleteByIp(string $ip): bool;

    public function getList(SearchCriteriaInterface $searchCriteria): WeatherDataSearchResultsInterface;
}
