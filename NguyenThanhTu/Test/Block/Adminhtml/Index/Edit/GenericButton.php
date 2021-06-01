<?php

namespace NguyenThanhTu\Test\Block\Adminhtml\Index\Edit;

use Magento\Backend\Block\Widget\Context;
use NguyenThanhTu\Test\Model\ManufacturerFactory;

class GenericButton
{

    protected $context;
    protected $manufacturerFactory;

    public function __construct(
        Context $context,
        ManufacturerFactory $manufacturerFactory
    )
    {
        $this->context = $context;
        $this->manufacturerFactory = $manufacturerFactory;
    }

    /**
     * Return Banner ID
     */
    public function getId()
    {
        $id = $this->context->getRequest()->getParam('id');
        $banner = $this->manufacturerFactory->create()->load($id);
        if ($banner->getId())
            return $id;
        return null;
    }

    /**
     * Generate url by route and parameters
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
