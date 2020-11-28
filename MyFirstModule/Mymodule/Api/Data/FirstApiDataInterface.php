<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : MyFirstModule\Mymodule\Api\Data - FirstApiDataInterface.php
 * User : ashish
 * Created at : 27/09/20 - 4:28 PM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Api\Data;


interface FirstApiDataInterface
{
    /**
     * const product name
     */
    const NAME = 'name';

    /**
     * product sku
     */
    const SKU = 'sku';

    const DESCRIPTION = 'description';

    /**
     * Get product Name
     *
     * @return string
     */
    public function getName();

    /**
     * Set product Name
     *
     * @param $name
     * @return string
     */
    public function setName($name);

    /**
     * Get product Sku
     *
     * @return string
     */
    public function getSku();

    /**
     * Set product Name
     *
     * @param $sku
     * @return string
     */
    public function setSku($sku);

    /**
     * Get Product Description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set Product Description
     *
     * @param $description
     * @return string
     */
    public function setDescription($description);
}
