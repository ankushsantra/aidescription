<?php
/**
 * Copyright
 *
 * @category Ankush
 * @package  Ankush_Aidescription
 */

namespace Ankush\Aidescription\Controller\Adminhtml\Agent;

/**
 * Agent MassDelete Class
 */
use Ankush\Aidescription\Model\AgentFactory;

class MassDelete extends \Magento\Backend\App\Action
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
        $data = $this->getRequest()->getPostValue();
        $collectionData = $this->_agentFactory->create()->getCollection();
        foreach ($collectionData as $value) {
            $allZipIds[] = $value['id'];
        }

        if (array_key_exists("selected", $data)) {
            $selectedIds = $data['selected'];
        }
        if (array_key_exists("excluded", $data)) {
            if ($data['excluded'] == 'false') {
                $selectedIds = $allZipIds;
            } else {
                $selectedIds = array_diff($allZipIds, $data['excluded']);
            }
        }
        try {
            foreach ($selectedIds as $selectedId) {
                $deleteData = $this->_agentFactory->create()->load($selectedId);
                $deleteData->delete();
            }
            $this->messageManager->addSuccess(
                __(
                    'Row data has been successfully deleted.'
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
