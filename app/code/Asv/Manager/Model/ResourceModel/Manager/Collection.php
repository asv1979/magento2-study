<?php
namespace Asv\Manager\Model\ResourceModel\Manager;

use Asv\Manager\Model\ResourceModel\Manager;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Asv\Manager\Model\Manager::class,
            Manager::class
        );
    }
}
