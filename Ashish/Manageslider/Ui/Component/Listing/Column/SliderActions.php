<?php
/*
 * Created By: Ashish Ranade On : Jun 7, 2017 7:27:43 PM
 * Project: magento2-develop
 * File: SliderActions.php
 */
namespace Ashish\Manageslider\Ui\Component\Listing\Column;

/**
 * Class SliderAction
 */
class SliderActions
        extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * Edit path
     * @var string
     */
    const URL_PATH_EDIT = 'manageslider/slider/edit';

    /**
     * Delete path
     * @var string
     */
    const URL_PATH_DELETE = 'manageslider/slider/delete';

    /**
     * URL builder object
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * Constructor
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
    \Magento\Framework\UrlInterface $urlBuilder,
            \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
            \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
            array $components = [], array $data = []
    )
    {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Data source
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['slider_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->_urlBuilder->getUrl(
                                    static::URL_PATH_EDIT,
                                    [
                                'slider_id' => $item['slider_id']
                                    ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->_urlBuilder->getUrl(
                                    static::URL_PATH_DELETE,
                                    [
                                'slider_id' => $item['slider_id']
                                    ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete "${ $.$data.name }"'),
                                'message' => __('Are you sure you wan\'t to delete the Slider "${ $.$data.name }" ?')
                            ]
                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }

}