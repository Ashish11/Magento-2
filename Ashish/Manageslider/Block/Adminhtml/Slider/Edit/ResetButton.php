<?php
/*
 * Created By: Ashish Ranade On : Jun 15, 2017 3:47:10 PM
 * Project: magento2-develop
 * File: BackButton.php
 */
namespace Ashish\Manageslider\Block\Adminhtml\Slider\Edit;

/**
 * Class BackButton
 */
class ResetButton
        extends \Magento\Backend\Block\Widget\Form\Generic
        implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{

    /**
     * Get Button Data
     * @return array
     */
    public function getButtonData()
    {
        return [
            'id' => 'reset',
            'class' => 'reset primary',
            'label' => __('Reset'),
            'on_click' => 'history.go(0);',
            'sort_order' => 30
        ];
    }

}