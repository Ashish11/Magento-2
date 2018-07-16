<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Ashish\CustomerRule\Observer;

/**
 * Description of CustomerConditionObserver
 *
 * @author Admin
 */
class CustomerConditionObserver
        implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * Observer
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $additional = $observer->getAdditional();
        $conditions = (array) $additional->getConditions();

        $conditions = array_merge_recursive($conditions,
                [
            $this->getCustomerFirstOrderCondition()
        ]);

        $additional->setConditions($conditions);
        return $this;
    }

    /**
     * Add condition
     * @return array
     */
    private function getCustomerFirstOrderCondition()
    {
        return [
            'label' => __('Customer first order'),
            'value' => \Ashish\CustomerRule\Model\Rule\Condition\Customer::class
        ];
    }

}
