<?php
namespace Asv\Manager\Block\Adminhtml\Manager;


use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;

class Add extends Template
{

    /**
     * Constructor
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return 'asv_manager/manager/create';
    }
}
