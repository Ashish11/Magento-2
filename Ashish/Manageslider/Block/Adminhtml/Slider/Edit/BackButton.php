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
class BackButton
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
            'id' => 'back',
            'class' => 'back primary',
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'sort_order' => 10
        ];
    }

    /**
     * Get back URL
     * @return string
     */
    private function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }

}