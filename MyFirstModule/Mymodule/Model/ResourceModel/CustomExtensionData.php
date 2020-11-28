<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : MyFirstModule\Mymodule\Model\ResourceModel - CustomExtensionData.php
 * User : ashish
 * Created at : 27/10/20 - 8:21 AM
 * Project : magento
 */

namespace MyFirstModule\Mymodule\Model\ResourceModel;

use Magento\Framework\App\ResourceConnection;

class CustomExtensionData
{
    /**
     * Database table name
     */
    const TABLE_NAME = 'custom_module_table';

    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * CustomExtensionData constructor.
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(ResourceConnection $resourceConnection)
    {
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * Get Custom Table data content
     * @return array
     */
    public function getCustomTableData()
    {
        $connection = $this->resourceConnection->getConnection();
        $select = $connection->select();
        $select->from(self::TABLE_NAME, ['table_id', 'name', 'content']);
        $result = $connection->fetchAll($select);

        return $result;
    }

}
