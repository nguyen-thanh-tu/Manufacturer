<?php

namespace NguyenThanhTu\Test\Controller\Adminhtml\Index;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'NguyenThanhTu_Test::delete';

    public function execute()
    {
        // Get ID of record by param
        $id = $this->getRequest()->getParam('id');

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                // Init model and delete
                $model = $this->_objectManager->create('NguyenThanhTu\Test\Model\Manufacturer');
                $model->load($id);
                $id = $model->getId();
                $model->delete();

                // Display success message
                $this->messageManager->addSuccess(__('The image has been deleted.'));

                // Redirect to list page
                return $resultRedirect->setPath('manufacturer/index/index');
            } catch (\Exception $e) {
                // Display error message
                $this->messageManager->addError($e->getMessage());
                // Go back to edit form
                return $resultRedirect->setPath('manufacturer/index/edit', ['id' => $id]);
            }
        }

        // Display error message
        $this->messageManager->addError(__('We can\'t find a image to delete.'));

        // Redirect to list page
        return $resultRedirect->setPath('parttime/index/index');
    }
}
