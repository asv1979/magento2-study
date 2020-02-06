<?php

namespace Asv\Manager\Controller\Adminhtml\Manager;

use Asv\Manager\Model\ResourceModel\ManagerFactory;
use Exception;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Psr\Log\LoggerInterface;

class Create extends Action
{
    private $manager;

    private $logger;

    public function __construct(
        Context $context,
        ManagerFactory $manager,
        LoggerInterface $logger
    ) {
        $this->manager = $manager;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $post = (array)$this->getRequest()->getPost();

        var_dump($post);
        exit;

        if (!empty($post['login'])) {
            $login = $post['login'];
            $department = $post['department'];

            $newManager = $this->manager->create();
            $newManager->setLogin($login);
            $newManager->setDepartment($department);
            try {
                $newManager->save();
                $this->messageManager->addSuccessMessage('Manager done !');
            } catch (Exception $e) {
                $this->logger->critical($e->getMessage(), ['exception' => $e]);
                $this->messageManager->addComplexErrorMessage('error - create the new manager');
            }

            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/asv_manager/manager/add');

            return $resultRedirect;
        }
        // 2. GET request : Render the booking page
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}

