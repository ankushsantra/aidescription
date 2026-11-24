<?php
/**
 * Copyright
 *
 * @category Ankush
 * @package  Ankush_Aidescription
 */

namespace Ankush\Aidescription\Model;

/**
 * Agent AgentFactory Class
 */
class AgentFactory
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
        $this->_objectManager = $objectManager;
    }

    /**
     * Create new country model
     *
     * @param  array $arguments
     * @return \Magento\Directory\Model\Country
     */
    public function create(array $arguments = [])
    {
        return $this->_objectManager->create(
            'Ankush\Aidescription\Model\Agent',
            $arguments,
            false
        );
    }
}
