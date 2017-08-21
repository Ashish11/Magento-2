<?php
/*
 * Created By: Ashish Ranade On : Aug 17, 2017 11:33:08 AM
 * Project: magento2-develop
 * File: Location.php
 */
namespace Ashish\GeoLocation\Model\ResourceModel;

/**
 * Description of Location
 */
class Location
        extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Date time object
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * Constructor
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     */
    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context,
            \Magento\Framework\Stdlib\DateTime\DateTime $date)
    {
        $this->_date = $date;
        parent::__construct($context);
    }

    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('born_geolocation', 'location_id');
    }

    /**
     * set date time
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return datetime
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $object->setUpdatedAt($this->_date->date());
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->_date->date());
        }
        return parent::_beforeSave($object);
    }

}