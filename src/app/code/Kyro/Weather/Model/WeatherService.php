<?php

declare(strict_types=1);

namespace Kyro\Weather\Model;

use Kyro\Weather\Api\Data\WeatherDataInterface;
use Kyro\Weather\Api\Data\WeatherDataSearchResultsInterface;
use Kyro\Weather\Api\WeatherDataRepositoryInterface;
use Kyro\Weather\Api\WeatherServiceInterface;
use Kyro\Weather\Constants\WeatherConst;
use Kyro\Weather\Helper\Config;
use Kyro\WeatherApi\Api\WeatherApiServiceInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Psr\Log\LoggerInterface;

class WeatherService implements WeatherServiceInterface
{
    protected WeatherDataRepositoryInterface $weatherRepository;
    protected SearchCriteriaBuilder $searchCriteriaBuilder;
    protected LoggerInterface $logger;
    protected WeatherApiServiceInterface $weatherApiService;
    protected Config $config;

    public function __construct(
        WeatherDataRepositoryInterface $weatherRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        WeatherApiServiceInterface $weatherApiService,
        Config $config,
        LoggerInterface $logger
    ) {
        $this->weatherRepository = $weatherRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->weatherApiService = $weatherApiService;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function getFreshByIp(
        string $ip,
        int $expiryHours = WeatherConst::DEFAULT_DATA_EXPIRY_HOURS
    ): ?WeatherDataInterface {
        if (!$this->config->isWeatherEnabled()) {
            return null;
        }

        try {
            $weatherList = $this->getDataFromDb($ip, $expiryHours);
            if ($weatherList->getTotalCount() > 0) {
                return current($weatherList->getItems());
            }

            $weatherData = $this->weatherApiService->getWeatherData($ip);
            $this->weatherRepository->saveOnDuplicateUpdate($weatherData);

            return $weatherData;
        } catch (\Exception $e) {
            $this->logger->info(
                sprintf("Weather data for IP: %s cannot be loaded: %s", $ip, $e->getMessage())
            );
        }

        return null;
    }

    /**
     * @todo::update
     */
    public function getPublicIp(): string
    {
        $ip = file_get_contents('https://api64.ipify.org?format=json');
        $ipData = json_decode($ip, true);

        return (string)$ipData['ip'];
    }


    protected function getDataFromDb(string $ip, int $expiryHours): WeatherDataSearchResultsInterface
    {
        $twoHoursAgo = (new \DateTime())
            ->modify("-{$expiryHours} hours")
            ->format('Y-m-d H:i:s');

        $this->searchCriteriaBuilder->addFilter(WeatherDataInterface::FIELD_IP, $ip);
        $this->searchCriteriaBuilder->addFilter(WeatherDataInterface::FIELD_UPDATED_AT, $twoHoursAgo, 'gteq');

        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->weatherRepository->getList($searchCriteria);
    }
}
