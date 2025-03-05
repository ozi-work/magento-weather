<?php

declare(strict_types=1);

namespace Kyro\Weather\Model\Logger;

use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

class HandlerBase extends Base
{
    public const BASE_LOG_FOLDER = 'var/log/kyro';

    protected $loggerType = Logger::DEBUG;

    public function __construct(
        DriverInterface       $filesystem,
        string                $loggerType = Logger::DEBUG,
        ?string               $filePath = null,
        ?string               $fileName = null
    ) {
        $this->loggerType = $loggerType;

        if ($filePath) {
            $filePath = BP . DIRECTORY_SEPARATOR . $filePath . DIRECTORY_SEPARATOR;
        }

        parent::__construct($filesystem, $filePath, $fileName);
    }
}
