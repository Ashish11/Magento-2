<?php
/*
 * Created By: Ashish Ranade On : Jun 7, 2017 7:11:33 PM
 * Project: magento2-develop
 * File: Collection.php
 */
namespace Ashish\Manageslider\Model\ResourceModel\Slider\Grid;

/**
 * Class Collection
 */
class Collection
        extends \Ashish\Manageslider\Model\ResourceModel\Slider\Collection
        implements \Magento\Framework\Api\Search\SearchResultInterface
{
    /**
     * aggregation
     * @var string
     */
    protected $_aggregations;

    /**
     * 
     * @param $eventObject
     * @param $eventPrefix
     * @param $mainTable
     * @param $resourceModel
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Psr\Log\LoggerInterface $logger
     * @param $connection
     * @param $model
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource
     */
    public function __construct($eventObject, $eventPrefix, $mainTable,
            $resourceModel,
            \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
            \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
            \Magento\Framework\Event\ManagerInterface $eventManager,
            \Psr\Log\LoggerInterface $logger, $connection = null,
            $model = 'Magento\Framework\View\Element\UiComponent\DataProvider\Document',
            \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null)
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy,
                $eventManager, $connection, $resource);
        $this->_eventPrefix = $eventPrefix;
        $this->_eventObject = $eventObject;
        $this->_init($model, $resourceModel);
        $this->setMainTable($mainTable);
    }

    /**
     * aggregation
     * @return string
     */
    public function getAggregations()
    {
        return $this->_aggregations;
    }

    /**
     * setAggregations
     * @param $aggregations
     */
    public function setAggregations($aggregations)
    {
        $this->_aggregations = $aggregations;
    }

    /**
     * 
     * @param $limit
     * @param $offset
     * @return type
     */
    public function getAllIds($limit = null, $offset = null)
    {
        return $this->getConnection()
                        ->fetchCol($this->_getAllIdsSelect($limit, $offset
                                ), $this->_bindParams);
    }

    /**
     * get search criteria
     * @return type
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * setSearchCriteria
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return $this
     */
    public function setSearchCriteria(
    \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null
    )
    {
        return $this;
    }

    /**
     * get count
     * @return array
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * set count
     * @param $totalCount
     * @return $this
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * set items
     * @param array $items
     * @return $this
     */
    public function setItems(array $items = null)
    {
        return $this;
    }

}