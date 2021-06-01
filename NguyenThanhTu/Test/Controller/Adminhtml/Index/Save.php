<?php

namespace NguyenThanhTu\Test\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use NguyenThanhTu\Test\Model\Manufacturer;
use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'NguyenThanhTu_Test::save';

    protected $dataProcessor;
    protected $dataPersistor;

    /**
     * @param Action\Context $context
     * @param PostDataProcessor $dataProcessor
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        PostDataProcessor $dataProcessor,
        DataPersistorInterface $dataPersistor
    )
    {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            if (empty($data['id'])) {
                $data['id'] = null;
            }

            // Init model and load by ID if exists
            $model = $this->_objectManager->create('NguyenThanhTu\Test\Model\Manufacturer');
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }

            // Validate data
            if (!$this->dataProcessor->validateRequireEntry($data)) {
                // Redirect to Edit page if has error
                return $resultRedirect->setPath('manufacturer/index/edit', ['id' => $model->getId(), '_current' => true]);
            }

            // Update model
            $model->setData($data);

            // Save data to database
            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the manufacturer.'));
                $this->dataPersistor->clear('manufacturer');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('manufacturer/index/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('manufacturer/index/index');
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving manufacturer.'));
            }

            $this->dataPersistor->set('manufacturer', $data);
            return $resultRedirect->setPath('manufacturer/index/edit', ['id' => $this->getRequest()->getParam('id')]);
        }

        // Redirect to List page
        return $resultRedirect->setPath('manufacturer/index/index');
    }
}
