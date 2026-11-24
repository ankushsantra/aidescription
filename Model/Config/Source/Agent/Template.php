<?php

namespace Ankush\Aidescription\Model\Config\Source\Agent;

use Magento\Framework\Option\ArrayInterface;
use Ankush\Aidescription\Model\ResourceModel\Agent\CollectionFactory;

class Template implements ArrayInterface
{
    private CollectionFactory $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray(): array
    {
        $options = [
            ['value' => '', 'label' => __('-- Please Select --')]
        ];

        $collection = $this->collectionFactory->create();

        foreach ($collection as $agent) {
            $options[] = [
                'value' => $agent->getId(),
                'label' => $agent->getAgentTitle()
            ];
        }

        return $options;
    }
}
