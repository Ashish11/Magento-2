<?php
/*
 * Created By: Ashish Ranade On : May 30, 2017 12:01:21 PM
 * Project: magento2-develop
 * File: InstallData.php
 */
namespace Ashish\Manageslider\Setup;

/**
 * Class Install Data
 */
class InstallData
        implements \Magento\Framework\Setup\InstallDataInterface
{
    /**
     * setup factory
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $_eavSetupFactory;

    /**
     * Constructor
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->_eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Install slider table
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     */
    public function install(\Magento\Framework\Setup\ModuleDataSetupInterface $setup,
            \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('ashish_slider')) {
            $table = $installer->getConnection()->newTable(
                            $installer->getTable('ashish_slider')
                    )
                    ->addColumn(
                            'slider_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null,
                            [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                            ], 'Slider ID'
                    )
                    ->addColumn(
                            'name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                            255, ['nullable => false'], 'Slider Name'
                    )
                    ->addColumn(
                            'banner_text',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255,
                            ['nullable => false'], 'Overlay Text'
                    )
                    ->addColumn(
                            'url_key',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [],
                            'Slider URL Key'
                    )
                    ->addColumn(
                            'status',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 1,
                            [], 'Slider Status'
                    )
                    ->addColumn(
                            'slider_image',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [],
                            'Slider Image'
                    )
                    ->addColumn(
                            'created_at',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                            null, [], 'Created At'
                    )
                    ->addColumn(
                            'updated_at',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                            null, [], 'pdated At'
                    )
                    ->setComment('Slider Table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                    $installer->getTable('ashish_slider'),
                    $setup->getIdxName(
                            $installer->getTable('ashish_slider'),
                            ['name', 'url_key', 'status', 'slider_image'],
                            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ), ['name', 'url_key', 'status', 'slider_image'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }

}