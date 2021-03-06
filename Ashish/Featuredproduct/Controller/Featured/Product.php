<?php
/*
 * Created By: Ashish Ranade On : May 30, 2017 11:30:23 AM
 * Project: magento2-develop
 * File: Featuredproduct.php
 */
namespace Ashish\Featuredproduct\Controller\Featured;

/**
 * Class Product
 */
class Product
        extends \Magento\Framework\App\Action\Action
{
    /**
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     *
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $_productloader;

    /**
     * Constructor
     * @param Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \Magento\Catalog\Model\ProductFactory $productloader
     * @return array
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $pageFactory,
            \Magento\Catalog\Model\ProductFactory $productloader)
    {
        $this->_pageFactory = $pageFactory;
        $this->_productloader = $productloader;
        return parent::__construct($context);
    }

    /**
     * Front action
     * @return string
     */
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $model = $objectManager->create('\Ashish\Featuredproduct\Model\Featuredproduct');
        $data = $model->getFeaturedProducts();
        $featuredProductArray = array();

        $count = 0;
        foreach ($data as $product) {
            $prod = $this->_productloader->create()->load($product->getEntityId());

            $objectMan = \Magento\Framework\App\ObjectManager::getInstance();

            $listBlock = $objectMan->get('\Magento\Catalog\Block\Product\ListProduct');
            $addToCartUrl = $listBlock->getAddToCartUrl($product);

            $store = $objectManager->get('Magento\Store\Model\StoreManagerInterface')
                    ->getStore();
            $imageUrl = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
                    . 'catalog/product'
                    . $prod->getImage();

            $wishlistJson = $objectManager->get('Magento\Wishlist\Helper\Data')
                    ->getAddParams($product);
            $wishListArray = json_decode($wishlistJson);

            $wishlistUrl = $wishListArray->action
                    . 'uenc/'
                    . $wishListArray->data->uenc
                    . '/product/'
                    . $wishListArray->data->product .
                    '/';

            $tmp = array('image' => $imageUrl,
                'name' => $prod->getName(),
                'price' => $prod->getPrice(),
                'special_price' => $prod->getSpecialPrice(),
                'view' => $prod->getProductUrl(),
                'carturl' => $addToCartUrl,
                'wishlisturl' => $wishlistUrl);

            array_push($featuredProductArray, $tmp);
            $count++;
        }

        $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        $resultJson->setData($featuredProductArray);
        return $resultJson;
    }

}