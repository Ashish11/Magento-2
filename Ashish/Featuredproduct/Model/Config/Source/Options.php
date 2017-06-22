<?php

/*
 * Created By: Ashish Ranade On : May 30, 2017 12:12:17 PM
 * Project: magento2-develop
 * File: Options.php
 */
namespace Ashish\Featuredproduct\Model\Config\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;
use Magento\Framework\DB\Ddl\Table;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Options 
    extends AbstractSource
{

    protected $optionFactory;

    public function __construct(OptionFactory $optionFactory)
    {
        $this->optionFactory = $optionFactory;
    }
    
    public function getAllOptions() 
    {        
        $this->_options = [['label' => 'Select Options', 'value' => ''],
        ['label' => 'Yes', 'value' => '1'],
        ['label' => 'No', 'value' => '2']
        ];
        
        return $this->_options;
    }

    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        
        return false;
    }

    public function getFlatColumns()
    {
        $attributeCode = $this->getAttribute()->getAttributeCode();
        return [
            $attributeCode => [
                'unsigned' => false,
                'default' => null,
                'extra' => null,
                'type' => Table::TYPE_INTEGER,
                'nullable' => true,
                'comment' => 'Featured Product  ' . $attributeCode . ' ',
            ],
        ];
    }

}