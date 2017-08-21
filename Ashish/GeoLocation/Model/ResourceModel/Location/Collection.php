<?php
/*
 * Created By: Ashish Ranade On : Aug 17, 2017 11:36:49 AM
 * Project: magento2-develop
 * File: Collection.php
 */
namespace Ashish\GeoLocation\Model\ResourceModel\Location;

/**
 * Description of Collection
 */
class Collection
        extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * primary key
     * @var string
     */
    protected $_idFieldName = 'location_id';

    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init('Ashish\GeoLocation\Model\GeoLocation',
                'Ashish\GeoLocation\Model\ResourceModel\Location'
        );
    }

}