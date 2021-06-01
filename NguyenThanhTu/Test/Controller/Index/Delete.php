<?php

namespace NguyenThanhTu\Test\Controller\Index;

class Delete extends \Magento\Framework\App\Action\Action
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
        $del = true;
        $rowData = $this->_objectManager->create('NguyenThanhTu\Test\Model\Manufacturer');
        $dataAll = $rowData->getCollection()->getData();
        foreach ($dataAll as $key) {
            if($del == true){
                $del = false;
                $rowData->deletebyId($key["id"]);
                echo "Delete complete";
            }
        }
    }

}
