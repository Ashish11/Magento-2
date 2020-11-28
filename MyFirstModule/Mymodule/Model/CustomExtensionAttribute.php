<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : MyFirstModule\Mymodule\Model - CustomExtensionAttribute.php
 * User : ashish
 * Created at : 27/10/20 - 8:05 AM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Model;


use MyFirstModule\Mymodule\Api\Data\CustomExtensionAttributeInterface;

class CustomExtensionAttribute extends \Magento\Framework\Api\AbstractExtensibleObject
    implements \MyFirstModule\Mymodule\Api\Data\CustomExtensionAttributeInterface
{
    /**
     * Table primary key
     */
    const TABLE_ID = 'table_id';

    /**
     * Name column
     */
    const NAME = 'name';

    /**
     * Content column
     */
    const CONTENT = 'content';

    /**
     * @inheritDoc
     */
    public function getTableId()
    {
        return $this->_get(self::TABLE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setTableId($tableId)
    {
        return $this->setData(self::TABLE_ID, $tableId);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->_get(self::CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @inheritDoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritDoc
     */
    public function setExtensionAttributes(\MyFirstModule\Mymodule\Api\Data\CustomExtensionAttributeExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
