<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : MyFirstModule\Mymodule\Plugin - CustomDataLoad.php
 * User : ashish
 * Created at : 26/10/20 - 10:49 PM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Plugin;


class CustomDataLoad
{
    /**
     * @var \Magento\Catalog\Api\Data\ProductExtensionFactory
     */
    private $extensionFactory;

    /**
     * CustomDataLoad constructor.
     * @param \Magento\Catalog\Api\Data\ProductExtensionFactory $extensionFactory
     */
    public function __construct(
        \Magento\Catalog\Api\Data\ProductExtensionFactory $extensionFactory
    )
    {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * After get extension attribute
     *
     * @param \Magento\Catalog\Api\Data\ProductInterface $entity
     * @param \Magento\Catalog\Api\Data\ProductExtensionInterface|null $extension
     * @return \Magento\Catalog\Api\Data\ProductExtension|\Magento\Catalog\Api\Data\ProductExtensionInterface|null
     */
    public function afterGetExtensionAttributes(
        \Magento\Catalog\Api\Data\ProductInterface $entity,
        \Magento\Catalog\Api\Data\ProductExtensionInterface $extension = null
    )
    {
        if ($extension === null) {
            $extension = $this->extensionFactory->create();
        }

        return $extension;
    }

    /**
     * After get product list
     *
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $subject
     * @param \Magento\Framework\Api\SearchResultsInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function afterGetList(
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Framework\Api\SearchResultsInterface $searchCriteria
    )
    {
        $products = [];
        foreach ($searchCriteria->getItems() as $entity) {
            /** get current extension attribute from database **/
            $customData = "My custom Data 1";
            $extensionAttributes = $entity->getExtensionAttributes();
            $extensionAttributes->setCustomDataStaticValue($customData);
            $entity->setExtensionAttributes($extensionAttributes);

            $products[] = $entity;
        }
        $searchCriteria->setItems($products);
        return $searchCriteria;
    }
}
