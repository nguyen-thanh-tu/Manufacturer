<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace NguyenThanhTu\Test\Model\Product;

class ProductProvider implements \Magento\Framework\Data\OptionSourceInterface
{
    private $_productCollectionFactory;

    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    )
    {
        $this->_productCollectionFactory = $productCollectionFactory;
    }
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $data = $collection->getData();

        $array[0] = [
            "value" => "0",
            "label" => "-- Chose product --"
        ];
        foreach($data as $value){
            $array[] = [
                "value" => $value["entity_id"],
                "label" => $value["sku"]
            ];
        }
        return $array;
    }
}

