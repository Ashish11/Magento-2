<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

use Magento\Framework\Component\ComponentRegistrar;

/**
 * Here we use Module Name for registering the module.
 */
ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'SRTechnologies_TransactionalSMS',
    __DIR__
);
