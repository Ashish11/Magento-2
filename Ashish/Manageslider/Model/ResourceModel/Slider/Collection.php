<?php
/*
 * Created By: Ashish Ranade On : Jun 7, 2017 7:02:55 PM
 * Project: magento2-develop
 * File: Collection.php
 */
namespace Ashish\Manageslider\Model\ResourceModel\Slider;

/**
 * Class Collection
 */
class Collection
        extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * primary key
     * @var string
     */
    protected $_idFieldName = 'slider_id';

    /**
     * set event name
     * @var string
     */
    protected $_eventPrefix = 'ashish_manageslider_collection';

    /**
     * event object
     * @var string
     */
    protected $_eventObject = 'manageslider_collection';

    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init('Ashish\Manageslider\Model\Slider',
                'Ashish\Manageslider\Model\ResourceModel\Slider'
        );
    }

    /**
     * get SQL count
     * @return string
     */
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(\Zend_Db_Select::GROUP);
        return $countSelect;
    }

    /**
     * option array
     * @param $valueField
     * @param $labelField
     * @param $additional
     * @return array
     */
    protected function _toOptionArray($valueField = 'slider_id',
            $labelField = 'name', $additional = [])
    {
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }

}