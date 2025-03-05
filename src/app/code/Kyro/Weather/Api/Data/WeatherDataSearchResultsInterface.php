<?php

declare(strict_types=1);

namespace Kyro\Weather\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface WeatherDataSearchResultsInterface extends SearchResultsInterface
{
    public function getItems(): array;
    public function setItems(array $items): self;
}
