<?php
/*
 * Created By: Ashish Ranade On : Jun 15, 2017 3:19:45 PM
 * Project: magento2-develop
 * File: DeleteButton.php
 */
namespace Ashish\Manageslider\Block\Adminhtml\Slider\Edit;

/**
 * Class DeleteButton
 */
class DeleteButton
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
            'id' => 'delete',
            'class' => 'delete primary',
            'label' => __('Delete'),
            'on_click' => "sliderDelete('" . $this->getDeleteUrl() . "')",
            'sort_order' => 20
        ];
    }

    /**
     * Return delete string
     * @param array $args
     * @return string
     */
    public function getDeleteUrl(array $args = [])
    {
        $params = array_merge($this->getDefaultUrlParams(), $args);
        return $this->getUrl('manageslider/*/delete', $params);
    }

    /**
     * 
     * @return array
     */
    protected function getDefaultUrlParams()
    {
        return ['_current' => true, '_query' => ['isAjax' => null]];
    }

}