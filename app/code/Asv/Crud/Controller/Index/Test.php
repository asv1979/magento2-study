<?php


namespace Asv\Crud\Controller\Index;


class Test extends \Magento\Framework\App\Action\Action
{
    private $pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
       var_dump(123);
       exit;
        return $this->pageFactory->create();
    }
}