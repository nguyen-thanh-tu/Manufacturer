<?php

namespace NguyenThanhTu\Test\Model\ResourceModel\Manufacturer;

/* use required classes */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    public function _construct()
    {
        $this->_init('NguyenThanhTu\Test\Model\Manufacturer', 'NguyenThanhTu\Test\Model\ResourceModel\Manufacturer');
    }
}
