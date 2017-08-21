<?php
/*
 * Created By: Ashish Ranade On : Aug 17, 2017 11:31:23 AM
 * Project: magento2-develop
 * File: GeoLocation.php
 */
namespace Ashish\GeoLocation\Model;

/**
 * Description of GeoLocation
 */
class GeoLocation
        extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Model construct that should be used for object initialization
     * 
     * return void
     */
    protected function _construct()
    {
        $this->_init('Ashish\GeoLocation\Model\ResourceModel\Location');
    }

}