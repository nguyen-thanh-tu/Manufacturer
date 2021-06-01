<?php

namespace NguyenThanhTu\Test\Controller\Index;

class Show extends \Magento\Framework\App\Action\Action
{
    protected $session;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $session
    )
    {
        $this->session = $session;
        parent::__construct($context);
    }
    public function execute()
    {
        $rowData = $this->_objectManager->create('NguyenThanhTu\Test\Model\ResourceModel\Manufacturer\Collection');
        var_dump($rowData->getData());
    }

}
