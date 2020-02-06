<?php
namespace Asv\Manager\Model;

use Asv\Manager\Api\Data\ManagerInterface;
use Asv\Manager\Api\Data\ManagerInterfaceFactory;
use Asv\Manager\Model\ResourceModel\Manager\Collection;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;

class Manager extends AbstractModel
{
    protected $dataObjectHelper;

    protected $_eventPrefix = 'asv_manager_manager';
    protected $managerDataFactory;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param ManagerInterfaceFactory $managerDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\Manager $resource
     * @param Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ManagerInterfaceFactory $managerDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\Manager $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        $this->managerDataFactory = $managerDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve manager model with manager data
     * @return ManagerInterface
     */
    public function getDataModel()
    {
        $managerData = $this->getData();

        $managerDataObject = $this->managerDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $managerDataObject,
            $managerData,
            ManagerInterface::class
        );

        return $managerDataObject;
    }
}
