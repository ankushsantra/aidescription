<?php
/**
 * Copyright © 2026 Ankush.
 */
namespace Ankush\Aidescription\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\UrlInterface;
use Magento\Framework\Stdlib\ArrayManager;

class Button extends AbstractModifier
{
    protected $urlBuilder;

    protected $arrayManager;

    public function __construct(
        UrlInterface $urlBuilder,
        ArrayManager $arrayManager
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->arrayManager = $arrayManager;
    }

    public function modifyData(array $data) {
        return $data;
    }

    public function modifyMeta(array $meta) {
        $meta = $this->customizeCategoriesField($meta);
        return $meta;
    }

    /**
     * Customize Categories field
     *
     * @param array $meta
     * @return array
     * @throws LocalizedException
     * @since 101.0.0
     */
    protected function customizeCategoriesField(array $meta)
    {
        $fieldCode = 'ai_description';
        $elementPath = $this->arrayManager->findPath($fieldCode, $meta, null, 'children');
        $containerPath = $this->arrayManager->findPath(static::CONTAINER_PREFIX . $fieldCode, $meta, null, 'children');

        $value = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => false,
                        'required' => false,
                        'dataScope' => '',
                        'breakLine' => false,
                        'formElement' => 'container',
                        'componentType' => 'container',
                        'component' => 'Magento_Ui/js/form/components/group',
                        'disabled' => '',
                    ],
                ],
            ],
        ];
        
        $value['children']['create_ai_description_button'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'title' => __('Run AI'),
                        'formElement' => 'container',
                        'additionalClasses' => 'admin__field-small',
                        'componentType' => 'container',
                        'disabled' => '',
                        'component' => 'Magento_Ui/js/form/components/button',
                        'template' => 'ui/form/components/button/container',
                        'actions' => [],
                        'additionalForGroup' => true,
                        'provider' => false,
                        'source' => 'product_details',
                        'displayArea' => 'insideGroup',
                        'sortOrder' => 20,
                        'dataScope'  => $fieldCode,
                    ],
                ],
            ]
        ];
        $meta = $this->arrayManager->merge($containerPath, $meta, $value);
        return $meta;
    }

}
