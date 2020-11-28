<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : MyFirstModule\Mymodule\Api\Data - CustomExtensionAttributeInterface.php
 * User : ashish
 * Created at : 27/10/20 - 7:57 AM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface CustomExtensionAttributeInterface extends ExtensibleDataInterface
{
    /**
     * Get Table ID
     * @return mixed
     */
    public function getTableId();

    /**
     * Set Table Id
     * @param $tableId
     * @return mixed
     */
    public function setTableId($tableId);

    /**
     * Get Name
     * @return mixed
     */
    public function getName();

    /**
     * Set Name
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * Get Content
     * @return mixed
     */
    public function getContent();

    /**
     * Set Content
     * @param $content
     * @return mixed
     */
    public function setContent($content);

    /**
     * Retrieve existing extension attributes object.
     * @return \MyFirstModule\Mymodule\Api\Data\CustomExtensionAttributeExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \MyFirstModule\Mymodule\Api\Data\CustomExtensionAttributeExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MyFirstModule\Mymodule\Api\Data\CustomExtensionAttributeExtensionInterface $extensionAttributes
    );
}
