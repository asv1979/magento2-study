<?php
namespace Asv\Manager\Api;

use Asv\Manager\Api\Data\ManagerInterface;
use Asv\Manager\Api\Data\ManagerSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface ManagerRepositoryInterface
{

    /**
     * Save Manager
     * @param ManagerInterface $manager
     * @return ManagerInterface
     * @throws LocalizedException
     */
    public function save(
        ManagerInterface $manager
    );

    /**
     * Retrieve Manager
     * @param string $managerId
     * @return ManagerInterface
     * @throws LocalizedException
     */
    public function get($managerId);

    /**
     * Retrieve Manager matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return ManagerSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Manager
     * @param ManagerInterface $manager
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        ManagerInterface $manager
    );

    /**
     * Delete Manager by ID
     * @param string $managerId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($managerId);
}
