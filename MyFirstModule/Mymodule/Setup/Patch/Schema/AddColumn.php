<?php
/**
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : MyFirstModule\Mymodule\Setup\Patch\Schema - AddColumn.php
 * User : ashish
 * Created at : 21/07/20 - 9:24 PM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Setup\Patch\Schema;


use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Framework\Db\Ddl\Table;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddColumn implements \Magento\Framework\Setup\Patch\SchemaPatchInterface
{
    private $_moduleSetup;

    public function __construct(ModuleDataSetupInterface $moduleSetup)
    {
        $this->_moduleSetup = $moduleSetup;
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
        $this->_moduleSetup->startSetup();

        $this->_moduleSetup->getConnection()->addColumn(
            $this->_moduleSetup->getTable('custom_module_table'),
            'content',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment'  => 'Content',
            ]
        );
    }
}
