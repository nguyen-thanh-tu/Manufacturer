<?php

namespace NguyenThanhTu\Test\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use NguyenThanhTu\Test\Model\ManufacturerFactory;

class InlineEdit extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'NguyenThanhTu_Test::save';

    protected $bannerFactory;
    protected $jsonFactory;

    public function __construct(
        Context $context,
        ManufacturerFactory $bannerFactory,
        JsonFactory $jsonFactory
    )
    {
        parent::__construct($context);
        $this->bannerFactory = $bannerFactory;
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        // Init result Json
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        // Get POST data
        $postItems = $this->getRequest()->getParam('items', []);

        // Check request
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        // Save data to database
        foreach (array_keys($postItems) as $bannerId) {
            try {
                $banner = $this->bannerFactory->create();
                $banner->load($bannerId);
                $banner->setData($postItems[(string)$bannerId]);
                $banner->save();
            } catch (\Exception $e) {
                $messages[] = __('Something went wrong while saving the Manufacturer.');
                $error = true;
            }
        }

        // Return result Json
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
