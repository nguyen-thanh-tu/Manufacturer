<?php

namespace NguyenThanhTu\Test\Controller\Index;

class Insert extends \Magento\Framework\App\Action\Action
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
        $data[] =
            array(
                'product_id' => '1',
                'name' => 'Samsung',
                'address' => '151 Thai Ha, Ha Noi',
                'contact_phone' => '01639519365',
                'contact_name' => 'Trinh Van Hoa'
            );
        $data[]=
            array(
                'product_id' => '2',
                'name' => 'Apple',
                'address' => 'Dac So, Ha Noi',
                'contact_phone' => '0325225668',
                'contact_name' => 'nguyen thanh tu'
            );

        $rowData = $this->_objectManager->create('NguyenThanhTu\Test\Model\Manufacturer');
        $i = 1;
        foreach ($data as $key) {
            $rowData->setData($key);
            $rowData->save();
            echo('Item '.($i++). ' has been successfully saved.</br>');
        }
    }

}
