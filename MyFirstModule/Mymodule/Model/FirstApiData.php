<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : MyFirstModule\Mymodule\Model - FirstApiData.php
 * User : ashish
 * Created at : 27/09/20 - 4:33 PM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Model;


class FirstApiData
    extends \Magento\Framework\Model\AbstractModel
    implements \MyFirstModule\Mymodule\Api\Data\FirstApiDataInterface
{

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setName(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getSku()
    {
        return $this->_getData(self::SKU);
    }

    /**
     * @inheritDoc
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * @inheridoc
     */
    public function getDescription()
    {
        $this->_getData(self::DESCRIPTION);
    }

    /**
     * @inheridoc
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }
}
