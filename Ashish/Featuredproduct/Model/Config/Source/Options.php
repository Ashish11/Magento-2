<?php
/*
 * Created By: Ashish Ranade On : May 30, 2017 12:12:17 PM
 * Project: magento2-develop
 * File: Options.php
 */
namespace Ashish\Featuredproduct\Model\Config\Source;

/**
 * Class Options
 */
class Options
        extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     *
     * @var \Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory
     */
    protected $optionFactory;

    /**
     * Constructor
     * @param \Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory $optionFactory
     */
    public function __construct(\Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory $optionFactory)
    {
        $this->optionFactory = $optionFactory;
    }

    /**
     * Get options
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [['label' => 'Select Options', 'value' => ''],
            ['label' => 'Yes', 'value' => '1'],
            ['label' => 'No', 'value' => '2']
        ];

        return $this->_options;
    }

    /**
     * Get option text
     * @param type $value
     * @return boolean
     */
    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }

        return false;
    }

    /**
     * Get flat columns
     * @return array
     */
    public function getFlatColumns()
    {
        $attributeCode = $this->getAttribute()->getAttributeCode();
        return [
            $attributeCode => [
                'unsigned' => false,
                'default' => null,
                'extra' => null,
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                'nullable' => true,
                'comment' => 'Featured Product  ' . $attributeCode . ' ',
            ],
        ];
    }

}