<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : Ashish\AdminSso\Plugin - Auth.php
 * User : ashish
 * Created at : 15/09/20 - 8:17 PM
 * Project : magento
 */

namespace Ashish\AdminSso\Plugin;

use Ashish\AdminSso\Helper\Data;

class Auth
{
    /**
     * @var Data
     */
    private $helper;

    /**
     * Auth constructor.
     *
     * @param Data $helper
     */
    public function __construct(Data $helper)
    {
        $this->helper = $helper;
    }

    /**
     * After logout plugin
     *
     * @param \Magento\Backend\Model\Auth $subject
     * @param $result
     * @return mixed
     */
    public function afterLogout(\Magento\Backend\Model\Auth $subject, $result)
    {
        $this->helper->clearSsoCookie();
        return $result;
    }

}
