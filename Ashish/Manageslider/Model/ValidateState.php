<?php
/*
 * Created By: Ashish Ranade On : Jun 6, 2017 1:51:06 PM
 * Project: magento2-develop
 * File: ValidationState.php
 */
namespace Ashish\Manageslider\Model;

/**
 * Class ValidateState
 */
class ValidateState
        extends \Magento\Framework\App\Arguments\ValidationState
{
    /**
     * 
     * @return boolean
     */
    public function isValidationRequired()
    {
        return false;
    }

}