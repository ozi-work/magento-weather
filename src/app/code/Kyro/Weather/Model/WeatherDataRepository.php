<?php

declare(strict_types=1);

namespace Kyro\Weather\Model;

use Exception;
use Kyro\Weather\Api\WeatherDataRepositoryInterface;
use Kyro\Weather\Api\Data\WeatherDataInterface;
use Kyro\Weather\Api\Data\WeatherDataSearchResultsInterface;
use Kyro\Weather\Api\Data\WeatherDataSearchResultsInterfaceFactory;
use Kyro\Weather\Model\ResourceModel\WeatherData as WeatherDataResource;
use Kyro\Weather\Model\ResourceModel\WeatherData\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class WeatherDataRepository implements WeatherDataRepositoryInterface
{
    private WeatherDataResource $resource;
    private WeatherDataFactory $weatherDataFactory;
    private CollectionFactory $collectionFactory;
    private CollectionProcessorInterface $collectionProcessor;
    private WeatherDataSearchResultsInterfaceFactory $searchResultsFactory;

    public function __construct(
        WeatherDataResource $resource,
        WeatherDataFactory $weatherDataFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        WeatherDataSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->weatherDataFactory = $weatherDataFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getByIp(string $ip): WeatherDataInterface
    {
        $weatherData = $this->weatherDataFactory->create();
        $this->resource->load($weatherData, $ip, WeatherDataInterface::FIELD_IP);
        if (!$weatherData->getId()) {
            throw new NoSuchEntityException(__('Weather data with Ip "%1" not found.', $ip));
        }

        return $weatherData;
    }

    public function save(WeatherDataInterface $weatherData): WeatherDataInterface
    {
        $this->resource->save($weatherData);

        return $weatherData;
    }

    public function saveOnDuplicateUpdate(WeatherDataInterface $weatherData): WeatherDataInterface
    {
        try {
            return $this->save($weatherData);
        } catch (AlreadyExistsException $e) {
            $this->deleteByIp($weatherData->getIp());

            return $this->save($weatherData);
        }
    }

    /**
     * @throws Exception
     */
    public function delete(WeatherDataInterface $weatherData): bool
    {
        $this->resource->delete($weatherData);

        return true;
    }

    /**
     * @throws NoSuchEntityException|Exception
     */
    public function deleteByIp(string $ip): bool
    {
        $weatherData = $this->getByIp($ip);

        return $this->delete($weatherData);
    }

    public function getList(SearchCriteriaInterface $searchCriteria): WeatherDataSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
