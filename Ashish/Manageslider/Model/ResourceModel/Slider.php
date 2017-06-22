<?php
/*
 * Created By: Ashish Ranade On : Jun 7, 2017 6:53:29 PM
 * Project: magento2-develop
 * File: Slider.php
 */
namespace Ashish\Manageslider\Model\ResourceModel;

/**
 * Class Slider
 */
class Slider
        extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Date time object
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * Constructor
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
    \Magento\Framework\Stdlib\DateTime\DateTime $date,
            \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        $this->_date = $date;
        parent::__construct($context);
    }

    /**
     * Override Constructor
     */
    protected function _construct()
    {
        $this->_init('ashish_slider', 'slider_id');
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