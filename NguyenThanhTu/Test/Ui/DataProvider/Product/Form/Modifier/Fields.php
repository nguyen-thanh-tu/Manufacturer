<?php

namespace NguyenThanhTu\Test\Ui\DataProvider\Product\Form\Modifier;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Element\DataType\Text;
use NguyenThanhTu\Test\Model\Manufacturer;

class Fields extends AbstractModifier
{
    private $locator;
    private $manufacturer;
    public function __construct(
        Manufacturer $manufacturer,
        LocatorInterface $locator
    ) {
        $this->manufacturer = $manufacturer;
        $this->locator = $locator;
    }

    public function modifyData(array $data)
    {
        return $data;
    }

    public function modifyMeta(array $meta)
    {
        $meta = array_replace_recursive(
            $meta,
            [
                'magenest' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Manufacturer'),
                                'collapsible' => true,
                                'componentType' => Fieldset::NAME,
                                'dataScope' => 'data.manufacturer',
                                'sortOrder' => 10
                            ],
                        ],
                    ],
                    'children' => $this->getFields()
                ],
            ]
        );

        return $meta;
    }

    protected function getFields()
    {
        $product   = $this->locator->getProduct();
        $productId = $product->getId();
        $data = $this->manufacturer->selectbyProductId($productId);
        if(!$data){
            $data[0]["name"] = "";
            $data[0]["address"] = "";
            $data[0]["contact_phone"] = "";
            $data[0]["contact_name"] = "";
        }
        return [
            'name' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'label'         => __("Manufacturer's name"),
                            'componentType' => Field::NAME,
                            'formElement'   => Input::NAME,
                            'dataScope'     => 'name',
                            'dataType'      => Text::NAME,
                            'value'         => $data[0]["name"],
                            'validation'        => [
                                'required-entry'           => true
                            ],
                            'sortOrder'     => 1
                        ],
                    ],
                ],
            ],
            'address' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'label'         => __("Manufacturer's address"),
                            'componentType' => Field::NAME,
                            'formElement'   => Input::NAME,
                            'dataScope'     => 'address',
                            'dataType'      => Text::NAME,
                            'value'         => $data[0]["address"],
                            'validation'        => [
                                'required-entry'           => true
                            ],
                            'sortOrder'     => 2
                        ],
                    ],
                ],
            ],
            'contact_phone' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'label'         => __('Contact Phone'),
                            'componentType' => Field::NAME,
                            'formElement'   => Input::NAME,
                            'dataScope'     => 'contact_phone',
                            'dataType'      => Text::NAME,
                            'value'         => $data[0]["contact_phone"],
                            'validation'        => [
                                'validate-number'          => true,
                                'validate-zero-or-greater' => true,
                                'required-entry'           => true
                            ],
                            'sortOrder'     => 3
                        ],
                    ],
                ],
            ],
            'contact_name' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'label'         => __('Contact Name'),
                            'componentType' => Field::NAME,
                            'formElement'   => Input::NAME,
                            'dataScope'     => 'contact_name',
                            'dataType'      => Text::NAME,
                            'value'         => $data[0]["contact_name"],
                            'validation'    => [
                                'required-entry'            => true
                            ],
                            'sortOrder'     => 4
                        ],
                    ],
                ],
            ]
        ];
    }
}

