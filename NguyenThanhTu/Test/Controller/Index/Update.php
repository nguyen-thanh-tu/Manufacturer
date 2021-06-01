<?php

namespace NguyenThanhTu\Test\Controller\Index;

class Update extends \Magento\Framework\App\Action\Action
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
        $data = $this->_objectManager->create('NguyenThanhTu\Test\Model\ResourceModel\Manufacturer\Collection');
        $dataAll = $data->getData();
        $i = 1;
        $rowData = $this->_objectManager->create('NguyenThanhTu\Test\Model\Manufacturer');
        foreach ($dataAll as $key) {
            $key['address'] = 'Ha Noi, Viet Nam';
            $rowData->updatebyId($key["id"],$key["product_id"],$key["name"],$key["address"],$key["contact_phone"],$key["contact_name"]);
            echo('Item '.($i++). ' has been successfully changed.');
        }
    }

}

