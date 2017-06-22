<?php
/*
 * Created By: Ashish Ranade On : May 30, 2017 12:01:21 PM
 * Project: magento2-develop
 * File: InstallData.php
 */
namespace Ashish\Featuredproduct\Setup;

/**
 * Class Install Data
 */
class InstallData
        implements \Magento\Framework\Setup\InstallDataInterface
{
    /**
     *
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Constructor
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Install script
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     */
    public function install(\Magento\Framework\Setup\ModuleDataSetupInterface $setup,
            \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY, 'is_featured',
                [
            'type' => 'int',
            'backend' => '',
            'frontend' => '',
            'label' => 'Is Featured Product',
            'input' => 'select',
            'class' => '',
            'source' => \Ashish\Featuredproduct\Model\Config\Source\Options::class,
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => true,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
            'apply_to' => ''
                ]
        );
    }

}