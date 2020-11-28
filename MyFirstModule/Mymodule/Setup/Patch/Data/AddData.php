<?php

/**
 * File : MyFirstModule\Mymodule\Setup\Patch\Data - AddData.php
 * User : ashish
 * Created at : 21/07/20 - 10:08 PM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\PatchInterface;
use MyFirstModule\Mymodule\Model\MymoduleFactory;
use MyFirstModule\Mymodule\Model\ResourceModel\Mymodule;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddData implements \Magento\Framework\Setup\Patch\DataPatchInterface
{
    private $moduleDataSetup;
    private $mymoduleFactory;
    private $mymoduleResource;

    public function __construct(MymoduleFactory $mymoduleFactory, Mymodule $myresource, ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->mymoduleFactory = $mymoduleFactory;
        $this->mymoduleResource = $myresource;
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        //Install data row into contact_details table
        $this->moduleDataSetup->startSetup();
        $myModule = $this->mymoduleFactory->create();
        $myModule->setName('Ashish')->setContent('Magento 2 Data Patch');
        $this->mymoduleResource->save($myModule);
        $this->moduleDataSetup->endSetup();
    }
}
