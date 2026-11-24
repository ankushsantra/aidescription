<?php
/**
 * Copyright
 *
 * @category Ankush
 * @package  Ankush_Aidescription
 */

namespace Ankush\Aidescription\Controller\Adminhtml\Agent;

/**
 * Agent Delete Class
 */
use Ankush\Aidescription\Model\AgentFactory;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var AgentFactory
     */
    protected $_agentFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        AgentFactory $_agentFactory
    ) {
        $this->_agentFactory = $_agentFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $rowId = (int)$this->getRequest()->getParam('id');
        try {
            $deleteData = $this->_agentFactory->create()->load($rowId);
            $deleteData->delete();
            $this->messageManager->addSuccess(
                __(
                    'Data has been successfully deleted.'
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
        return $this->_authorization->isAllowed('Ankush_Aidescription::agents');
    }
}
