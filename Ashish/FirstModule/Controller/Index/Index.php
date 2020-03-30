<?php

namespace Ashish\FirstModule\Controller\Index;
use Magento\Framework\Controller\ResultFactory;
/**
 * Description of Index
 *
 * @author Ashish
 */
class Index
        extends \Magento\Framework\App\Action\Action
{

    /**
     * Execute
     */
    public function execute()
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $result;
    }

}
