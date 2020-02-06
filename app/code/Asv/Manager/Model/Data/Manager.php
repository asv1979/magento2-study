<?php
namespace Asv\Manager\Model\Data;

use Asv\Manager\Api\Data\ManagerInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

class Manager extends AbstractExtensibleObject implements ManagerInterface
{

    /**
     * Get manager_id
     * @return string|null
     */
    public function getManagerId()
    {
        return $this->_get(self::MANAGER_ID);
    }

    /**
     * Set manager_id
     * @param string $managerId
     * @return ManagerInterface
     */
    public function setManagerId($managerId)
    {
        return $this->setData(self::MANAGER_ID, $managerId);
    }

    /**
     * Get id
     * @return string|null
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * Set id
     * @param string $id
     * @return ManagerInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get login
     * @return string|null
     */
    public function getLogin()
    {
        return $this->_get(self::LOGIN);
    }

    /**
     * Set login
     * @param string $login
     * @return ManagerInterface
     */
    public function setLogin($login)
    {
        return $this->setData(self::LOGIN, $login);
    }

    /**
     * Get department
     * @return string|null
     */
    public function getDepartment()
    {
        return $this->_get(self::DEPARTMENT);
    }

    /**
     * Set department
     * @param string $department
     * @return ManagerInterface
     */
    public function setDepartment($department)
    {
        return $this->setData(self::DEPARTMENT, $department);
    }
}
