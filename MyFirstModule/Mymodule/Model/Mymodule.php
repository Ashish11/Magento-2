<?php
/**
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : MyFirstModule\Mymodule\Model - Mymodule.php
 * User : ashish
 * Created at : 21/07/20 - 9:59 PM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Model;


class Mymodule extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('MyFirstModule\Mymodule\Model\ResourceModel\Mymodule');
    }

}
