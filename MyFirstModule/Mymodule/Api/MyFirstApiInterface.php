<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : MyFirstModule\Mymodule\Api - MyFirstApiInterface.php
 * User : ashish
 * Created at : 13/09/20 - 1:07 PM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Api;


interface MyFirstApiInterface
{
    /**
     * Sample Function for API Demo
     *
     * @return mixed
     */
    public function customGetFunction();

    /**
     * Return product information
     *
     * @param int $productId
     * @return \MyFirstModule\Mymodule\Api\Data\FirstApiDataInterface
     */
    public function functionPostParam($productId);
}
