<?php
namespace NguyenThanhTu\Test\Model;

use Magento\Framework\Model\AbstractModel;

class Manufacturer extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('NguyenThanhTu\Test\Model\ResourceModel\Manufacturer');
    }
    public function getConnect(){
        return $this->getResourceCollection()->getConnection();
    }

    public function getTable(){
        return $this->getConnect()->getTableName('manufacturer');
    }

    public function updatebyId($id,$product_id,$name,$address,$contact_phone,$contact_name){
        $data = [
            [
                'product_id' => $product_id,
                'name' => $name,
                'address' => $address,
                'contact_phone' => $contact_phone,
                'contact_name' => $contact_name
            ]
        ];
        foreach ($data as $item) {
            return $this->getConnect()->update($this->getTable(),$item,['id = ?' => (int)$id]);
        }
    }

    public function updatebyProductId($product_id,$name,$address,$contact_phone,$contact_name){
        $data = [
            [
                'name' => $name,
                'address' => $address,
                'contact_phone' => $contact_phone,
                'contact_name' => $contact_name
            ]
        ];
        foreach ($data as $item) {
            return $this->getConnect()->update($this->getTable(),$item,['product_id = ?' => (int)$product_id]);
        }
    }

    public function deletebyId($id){
        return $this->getConnect()->delete($this->getTable(),['id = ?' => (int)$id]);
    }

    public function selectbyProductId($product_id){
        if(!$product_id){
            return $this->getConnect()->fetchAll("SELECT * FROM manufacturer");
        }
        return $this->getConnect()->fetchAll("SELECT * FROM manufacturer where product_id = $product_id");
    }
}
