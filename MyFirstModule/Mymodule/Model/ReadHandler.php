<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : MyFirstModule\Mymodule\Model - ReadHandler.php
 * User : ashish
 * Created at : 27/10/20 - 8:48 AM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Model;

use Magento\Framework\EntityManager\Operation\ExtensionInterface;

class ReadHandler implements ExtensionInterface
{
    /**
     * @var \MyFirstModule\Mymodule\Api\Data\CustomExtensionAttributeInterfaceFactory
     */
    private $customExtensionFactory;
    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var ResourceModel\CustomExtensionData
     */
    private $customExtensionData;

    /**
     * ReadHandler constructor.
     * @param \MyFirstModule\Mymodule\Api\Data\CustomExtensionAttributeInterfaceFactory $customExtensionFactory
     * @param \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
     * @param ResourceModel\CustomExtensionData $customExtensionData
     */
    public function __construct(
        \MyFirstModule\Mymodule\Api\Data\CustomExtensionAttributeInterfaceFactory $customExtensionFactory,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \MyFirstModule\Mymodule\Model\ResourceModel\CustomExtensionData $customExtensionData
    )
    {
        $this->customExtensionFactory = $customExtensionFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->customExtensionData = $customExtensionData;
    }

    /**
     * Execute Method
     *
     * @param object $entity
     * @param array $arguments
     * @return bool|object
     */
    public function execute($entity, $arguments = [])
    {
        $customExtensionData = [];
        foreach ($this->customExtensionData->getCustomTableData() as $data) {
            $customExtensionFactory = $this->customExtensionFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $customExtensionFactory,
                $data,
                \MyFirstModule\Mymodule\Api\Data\CustomExtensionAttributeInterface::class
            );
            $customExtensionData[] = $customExtensionFactory;
        }

        $extensionAttributes = $entity->getExtensionAttributes();
        $extensionAttributes->setCustomDataFromPool(!empty($customExtensionData) ? $customExtensionData : null);
        $entity->setExtensionAttributes($extensionAttributes);

        return $entity;
    }
}
