<?php

/**
 * File : MyFirstModule\Mymodule\Model\ResourceModel - Mymodule.php
 * User : ashish
 * Created at : 21/07/20 - 10:02 PM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Model\ResourceModel;


class Mymodule extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('custom_module_table', 'table_id');
    }

}
