<?php

namespace Asv\Manager\Model;

use Asv\Manager\Api\Data\ManagerInterfaceFactory;
use Asv\Manager\Api\Data\ManagerSearchResultsInterfaceFactory;
use Asv\Manager\Api\ManagerRepositoryInterface;
use Asv\Manager\Model\ResourceModel\Manager as ResourceManager;
use Asv\Manager\Model\ResourceModel\Manager\CollectionFactory as ManagerCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class ManagerRepository implements ManagerRepositoryInterface
{
    protected $dataObjectHelper;

    private $storeManager;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;
    protected $resource;

    protected $managerCollectionFactory;

    protected $managerFactory;

    protected $dataManagerFactory;

    /**
     * @param ResourceManager $resource
     * @param ManagerFactory $managerFactory
     * @param ManagerInterfaceFactory $dataManagerFactory
     * @param ManagerCollectionFactory $managerCollectionFactory
     * @param ManagerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceManager $resource,
        ManagerFactory $managerFactory,
        ManagerInterfaceFactory $dataManagerFactory,
        ManagerCollectionFactory $managerCollectionFactory,
        ManagerSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->managerFactory = $managerFactory;
        $this->managerCollectionFactory = $managerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataManagerFactory = $dataManagerFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Asv\Manager\Api\Data\ManagerInterface $manager
    ) {
        /* if (empty($manager->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $manager->setStoreId($storeId);
        } */

        $managerData = $this->extensibleDataObjectConverter->toNestedArray(
            $manager,
            [],
            \Asv\Manager\Api\Data\ManagerInterface::class
        );

        $managerModel = $this->managerFactory->create()->setData($managerData);

        try {
            $this->resource->save($managerModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the manager: %1',
                $exception->getMessage()
            ));
        }
        return $managerModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($managerId)
    {
        $manager = $this->managerFactory->create();
        $this->resource->load($manager, $managerId);
        if (!$manager->getId()) {
            throw new NoSuchEntityException(__('Manager with id "%1" does not exist.', $managerId));
        }
        return $manager->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->managerCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Asv\Manager\Api\Data\ManagerInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Asv\Manager\Api\Data\ManagerInterface $manager
    ) {
        try {
            $managerModel = $this->managerFactory->create();
            $this->resource->load($managerModel, $manager->getManagerId());
            $this->resource->delete($managerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Manager: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($managerId)
    {
        return $this->delete($this->get($managerId));
    }
}
