<?php
/*
 * Created By: Ashish Ranade On : Aug 16, 2017 3:42:56 PM
 * Project: magento2-develop
 * File: InstallData.php
 */
namespace Ashish\GeoLocation\Setup;

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
     * Install script
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     */
    public function install(\Magento\Framework\Setup\ModuleDataSetupInterface $setup,
            \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('born_geolocation')) {
            $table = $installer->getConnection()->newTable(
                            $installer->getTable('born_geolocation')
                    )
                    ->addColumn(
                            'location_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null,
                            [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                            ], 'Location ID'
                    )
                    ->addColumn(
                            'visitors_ip',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255,
                            ['nullable => false'], 'Visitors IP'
                    )
                    ->addColumn(
                            'visitors_country',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255,
                            ['nullable => false'], 'Visitors Country'
                    )
                    ->addColumn(
                            'created_at',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                            null, [], 'Created At'
                    )
                    ->addColumn(
                            'updated_at',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                            null, [], 'Updated At'
                    )
                    ->setComment('Ashish Geo Location');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                    $installer->getTable('born_geolocation'),
                    $setup->getIdxName(
                            $installer->getTable('born_geolocation'),
                            ['visitors_ip', 'visitors_country'],
                            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ), ['visitors_ip', 'visitors_country'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }

}