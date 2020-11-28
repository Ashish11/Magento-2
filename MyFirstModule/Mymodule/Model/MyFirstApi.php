<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : MyFirstModule\Mymodule\Model - MyFirstApi.php
 * User : ashish
 * Created at : 13/09/20 - 1:11 PM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Model;

use Magento\Catalog\Model\Product;

class MyFirstApi implements \MyFirstModule\Mymodule\Api\MyFirstApiInterface
{
    /**
     * Product Object
     * @var objet product
     */
    protected $product;

    /**
     * MyFirstApi constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @inheritDoc
     */
    public function customGetFunction()
    {
        $data = array(
            'Test' => 'Data',
            'Test 2' => 'Data 2',
            'Test 3' => 'Data 3',
            'Test 4' => 'Data 4',
            'Test 5' => 'Data 5',
        );
        return $data;
    }

    /**
     * @inheridoc
     */
    public function functionPostParam($productId)
    {
        return $this->product->load($productId);
    }
}
