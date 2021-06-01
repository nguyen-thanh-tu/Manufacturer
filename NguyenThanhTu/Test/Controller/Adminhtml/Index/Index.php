<?php

namespace NguyenThanhTu\Test\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'NguyenThanhTu_Test::manufacturer_manager';

    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        // Load layout and set active menu
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('NguyenThanhTu_Test::manufacturer_manager');
        $resultPage->getConfig()->getTitle()->prepend(__('Manufacturer manager'));

        return $resultPage;
    }

}