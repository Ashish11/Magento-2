<?php

/**
 * File : MyFirstModule\Mymodule\Model\ResourceModel\Collection - Collection.php
 * User : ashish
 * Created at : 21/07/20 - 10:04 PM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Model\ResourceModel\Collection;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * construct
     */
    public function _construct()
    {
        $this->_init('MyFirstModule\Mymodule\Model\Mymodule',
            'MyFirstModule\Mymodule\Model\Mymodule\Mymodule'
        );
    }

}
