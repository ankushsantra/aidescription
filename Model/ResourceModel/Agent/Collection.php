<?php
/**
 * Copyright
 *
 * @category Ankush
 * @package  Ankush_Aidescription
 */

namespace Ankush\Aidescription\Model\ResourceModel\Agent;

/**
 * Agent Collection Class
 */
class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    /**
     * @var string
     */
    protected $_eventPrefix = 'ankush_aidescription_agent_collection';
    /**
     * @var string
     */
    protected $_eventObject = 'agent_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Ankush\Aidescription\Model\Agent',
            'Ankush\Aidescription\Model\ResourceModel\Agent'
        );

    }
}
