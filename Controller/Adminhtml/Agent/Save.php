<?php
/**
 * Copyright
 *
 * @category Ankush
 * @package  Ankush_Aidescription
 */

namespace Ankush\Aidescription\Controller\Adminhtml\Agent;

/**
 * Agent Save Class
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Ankush\Aidescription\Model\AgentFactory
     */
    protected $_agentFactory;

    /**
     * Save constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Ankush\Aidescription\Model\agentFactory $_agentFactory
    ) {
        $this->_agentFactory = $_agentFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $agentId = isset($data['id']) ? $data['id'] : '';
        if (!$data) {
            $this->_redirect('ankush/agent/index');
        }
        try {
            $rowData = $this->_agentFactory->create()->load($agentId);
            if (!$rowData->getId() && $agentId) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('ankush/agent/index');
            }
            $rowData->setData($data);
            $rowData->save();
            $this->messageManager->addSuccess(
                __(
                    'Row data has been successfully saved.'
                )
            );
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('ankush/agent/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('MageDigest_CustomerReview::home');
    }
}
