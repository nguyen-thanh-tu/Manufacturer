<?php

namespace NguyenThanhTu\Test\Observer;

use Magento\Framework\Event\Observer as EventObserver;

class ProductSave implements \Magento\Framework\Event\ObserverInterface
{
    protected $request;
    protected $model;
    /**
     * HandleSaveProduct constructor.
     * @param \Magento\Framework\App\RequestInterface $request
     */
    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \NguyenThanhTu\Test\Model\Manufacturer $model
    )
    {
        $this->model = $model;
        $this->request = $request;
    }
    public function execute(EventObserver $observer)
    {
        $params = $this->request->getParams();
        $customFieldData = $params['manufacturer'];
        //logic to process custom fields data
        // ...
        $observer->getData("product");

        $product_id = $observer->getData("product")->getData("entity_id");
        $name = $params['manufacturer']["name"];
        $address = $params['manufacturer']["address"];
        $contact_phone = $params['manufacturer']["contact_phone"];
        $contact_name = $params['manufacturer']["contact_name"];

        $update = $this->model->updatebyProductId($product_id,$name,$address,$contact_phone,$contact_name);

        if(!$update){
            $data[] =
                array(
                    'product_id' => $product_id,
                    'name' => $name,
                    'address' => $address,
                    'contact_phone' => $contact_phone,
                    'contact_name' => $contact_name
                );
            foreach ($data as $key) {
                $this->model->setData($key);
                $this->model->save();
            }
        }
        return $this;
    }

}
