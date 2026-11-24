<?php
/**
 * Copyright
 *
 * @category Ankush
 * @package  Ankush_Aidescription
 */

namespace Ankush\Aidescription\Controller\Adminhtml\Agent;

/**
 * Agent NewAction Class
 */
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Ankush\Aidescription\Model\AgentFactory;

class NewAction extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var AgentFactory
     */
    protected $_agentFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * NewAction constructor.
     *
     * @param Context                     $context
     * @param PageFactory                 $rawFactory
     * @param AgentFactory              $_agentFactory
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        PageFactory $rawFactory,
        AgentFactory $_agentFactory,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->pageFactory = $rawFactory;
        $this->_agentFactory = $_agentFactory;
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }


    /**
     * @return Page
     */
    public function execute(): Page
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Magento_Backend::marketing_communications');
        $title = __('Add Agent');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ankush_Aidescription::agents');
    }
}
