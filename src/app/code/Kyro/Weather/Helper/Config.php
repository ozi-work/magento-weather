<?php

declare(strict_types=1);

namespace Kyro\Weather\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Config extends AbstractHelper
{
    const XML_PATH_GENERAL_ENABLED = 'kyro_weather/general/enabled';

    public function isWeatherEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_GENERAL_ENABLED);
    }
}
