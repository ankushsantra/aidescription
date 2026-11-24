<?php
/**
 * Copyright
 *
 * @category Ankush
 * @package  Ankush_Aidescription
 */

namespace Ankush\Aidescription\Model;

/**
 * Agent Agent Class
 */
class Agent extends
    \Magento\Framework\Model\AbstractModel implements
    \Magento\Framework\DataObject\IdentityInterface
{
    /**
     *
     */
    const CACHE_TAG = 'ankush_aidescription';
    /**
     * @var string
     */
    protected $_cacheTag = 'ankush_aidescription';
    /**
     * @var string
     */
    protected $_eventPrefix = 'ankush_aidescription';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Ankush\Aidescription\Model\ResourceModel\Agent');
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }
}
