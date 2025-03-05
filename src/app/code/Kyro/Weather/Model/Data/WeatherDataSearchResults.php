<?php

declare(strict_types=1);

namespace Kyro\Weather\Model\Data;

use Kyro\Weather\Api\Data\WeatherDataSearchResultsInterface;
use Kyro\Weather\Api\Data\WeatherDataInterface;
use Magento\Framework\Api\SearchResults;

class WeatherDataSearchResults extends SearchResults implements WeatherDataSearchResultsInterface
{
    /**
     * Get list of weather data items.
     *
     * @return WeatherDataInterface[]
     */
    public function getItems(): array
    {
        return parent::getItems();
    }

    /**
     * Set list of weather data items.
     *
     * @param WeatherDataInterface[] $items
     * @return self
     */
    public function setItems(array $items): self
    {
        return parent::setItems($items);
    }
}
