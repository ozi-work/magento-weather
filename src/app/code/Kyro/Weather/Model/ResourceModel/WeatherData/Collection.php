<?php

declare(strict_types=1);

namespace Kyro\Weather\Model\ResourceModel\WeatherData;

use Kyro\Weather\Model\WeatherData;
use Kyro\Weather\Model\ResourceModel\WeatherData as WeatherDataResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(WeatherData::class, WeatherDataResource::class);
    }
}
