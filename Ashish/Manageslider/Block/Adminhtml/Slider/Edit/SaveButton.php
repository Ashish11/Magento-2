<?php
/* 
 * Created By: Ashish Ranade On : Jun 9, 2017 12:33:53 PM
 * Project: magento2-develop
 * File: SaveButton.php
 */
namespace Ashish\Manageslider\Block\Adminhtml\Slider\Edit;

/**
 * Class SaveButton
 */
class SaveButton
    extends \Magento\Backend\Block\Widget\Form\Generic 
    implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    /**
     * Get button data
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Slider'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 40,
        ];
    }    
}
