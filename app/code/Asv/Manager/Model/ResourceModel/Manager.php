<?php


namespace Asv\Manager\Model\ResourceModel;

class Manager extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('customer_manager', 'manager_id');
    }
}
