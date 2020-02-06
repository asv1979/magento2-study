<?php
namespace Asv\Manager\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface ManagerInterface extends ExtensibleDataInterface
{

    const ID = 'id';
    const LOGIN = 'login';
    const MANAGER_ID = 'manager_id';
    const DEPARTMENT = 'department';

    /**
     * Get manager_id
     * @return string|null
     */
    public function getManagerId();

    /**
     * Set manager_id
     * @param string $managerId
     * @return ManagerInterface
     */
    public function setManagerId($managerId);

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return ManagerInterface
     */
    public function setId($id);

    /**
     * Get login
     * @return string|null
     */
    public function getLogin();

    /**
     * Set login
     * @param string $login
     * @return ManagerInterface
     */
    public function setLogin($login);

    /**
     * Get department
     * @return string|null
     */
    public function getDepartment();

    /**
     * Set department
     * @param string $department
     * @return ManagerInterface
     */
    public function setDepartment($department);
}
