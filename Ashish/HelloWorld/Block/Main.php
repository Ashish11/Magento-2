<?php

namespace Ashish\HelloWorld\Block;

use Magento\Framework\View\Element\Template;

class Main 
    extends Template
{

    protected function _prepareLayout()
    {
        $this->setMessage('Hello Again World');
    }

}
