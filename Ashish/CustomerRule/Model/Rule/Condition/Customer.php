<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Ashish\CustomerRule\Model\Rule\Condition;

/**
 * Description of Customer
 *
 * @author Admin
 */
class Customer
        extends \Magento\Rule\Model\Condition\AbstractCondition
{

    /**
     * Yes No Value
     * @var \Magento\Config\Model\Config\Source\Yesno 
     */
    protected $sourceYesno;

    /**
     * Order factory
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory 
     */
    protected $orderFactory;

    /**
     * Constructor
     * @param \Magento\Rule\Model\Condition\Context $context
     * @param \Magento\Config\Model\Config\Source\Yesno $sourceYesno
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderFactory
     * @param array $data
     */
    public function __construct(\Magento\Rule\Model\Condition\Context $context,
            \Magento\Config\Model\Config\Source\Yesno $sourceYesno,
            \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderFactory,
            array $data = array())
    {
        parent::__construct($context, $data);
        $this->sourceYesno = $sourceYesno;
        $this->orderFactory = $orderFactory;
    }

    /**
     * Load Attribute options
     * @return $this
     */
    public function loadAttributeOptions()
    {
        $this->setAttributeOption([
            'customer_first_order' => __("Customer's First Order")
        ]);
        return $this;
    }

    /**
     * Get input type
     * @return string
     */
    public function getInputType()
    {
        return 'select';
    }

    /**
     * Get value
     * @return string
     */
    public function getValueElementType()
    {
        return 'select';
    }

    /**
     * Get option value
     * @return type
     */
    public function getValueSelectOptions()
    {
        if (!$this->hasData('value_select_options')) {
            $this->setData(
                    'value_select_options', $this->sourceYesno->toOptionArray()
            );
        }
        return $this->getData('value_select_options');
    }

    /**
     * Validate
     * @param \Magento\Framework\Model\AbstractModel $model
     * @return type
     */
    public function validate(\Magento\Framework\Model\AbstractModel $model)
    {
        $customerId = $model->getCustomerId();
        $order = $this->orderFactory->create()
                ->addAttributeToSelect('customer_id')
                ->addFieldToFilter('customer_id', ['eq' => $customerId])
                ->getFirstItem();

        $firstOrder = 1;
        if ($order->getId()) {
            $firstOrder = 0;
        }
        $model->setData('customer_first_order', $firstOrder);
        return parent::validate($model);
    }

}
