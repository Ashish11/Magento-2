<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : Ashish\AdminSso\Controller\Integration - ${FILE_NAME}
 * User : ashish
 * Created at : 15/09/20 - 11:56 AM
 * Project : magento
 */

namespace Ashish\AdminSso\Controller\Integration;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\State;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\Action\Action;
use Ashish\AdminSso\Helper\Data;
use Magento\Framework\ObjectManager\ConfigLoaderInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\User\Model\User;
use Magento\Backend\Model\Auth\Session;

class Adminsso extends Action
{
    /**
     * @var Data
     */
    private $helper;

    /**
     * @var State app state
     */
    private $state;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var ConfigLoaderInterface
     */
    private $configLoader;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Session
     */
    private $adminSession;

    /**
     * Area code
     */
    const AREA_CODE = 'adminhtml';

    /**
     * Admin sso constructor.
     *
     * @param Context $context
     * @param Data $helper
     * @param State $state
     * @param Http $request
     * @param ConfigLoaderInterface $configLoader
     * @param ObjectManagerInterface $objectManager
     * @param User $user
     * @param Session $adminSession
     */
    public function __construct(Context $context,
                                Data $helper,
                                State $state,
                                Http $request,
                                ConfigLoaderInterface $configLoader,
                                ObjectManagerInterface $objectManager,
                                User $user, Session $adminSession)
    {
        parent::__construct($context);
        $this->helper = $helper;
        $this->state = $state;
        $this->request = $request;
        $this->configLoader = $configLoader;
        $this->objectManager = $objectManager;
        $this->user = $user;
        $this->adminSession = $adminSession;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        $encryptedString = $this->getRequest()->getParam('encryptedString');
        $data = $this->helper->decrypt($encryptedString);
        if ($data) {
            $adminUser = json_decode($data)->username;
            $this->adminSession->destroy();
            $this->adminSession->setName('admin');
            $this->state->emulateAreaCode(self::AREA_CODE, function () {
            });
            try {
                $this->request->setPathInfo('/admin/dashboard/');
                $this->objectManager->configure($this->configLoader->load(self::AREA_CODE));
                $this->loginAdminUser($adminUser);
                $this->helper->setCookies($this->adminSession);
                $url = $this->helper->getAdminUrl();

                $this->_redirect($url);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        } else {
            $this->_redirect("/");
        }

    }

    /**
     * login admin user
     *
     * @param $userName
     */
    private function loginAdminUser($userName)
    {
        $user = $this->user->loadByUsername($userName);
        $this->adminSession->setUser($user);
        $this->adminSession->processLogin();
    }
}
