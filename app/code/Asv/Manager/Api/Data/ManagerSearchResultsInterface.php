<?php
namespace Asv\Manager\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ManagerSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get Manager list.
     * @return ManagerInterface[]
     */
    public function getItems();

    /**
     * Set id list.
     * @param ManagerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
