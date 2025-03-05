<?php

declare(strict_types=1);

namespace Kyro\Weather\Model\ResourceModel;

use Kyro\Weather\Api\Data\WeatherDataInterface;
use Kyro\Weather\Constants\WeatherConst;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class WeatherData extends AbstractDb
{
    protected function _construct()
    {
        $this->_init(WeatherConst::WEATHER_DATA_TABLE, WeatherDataInterface::FIELD_ID);
    }
}
