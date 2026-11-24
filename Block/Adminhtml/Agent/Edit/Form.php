<?php
/**
 * Copyright
 *
 * @category Ankush
 * @package  Ankush_Aidescription
 */

namespace Ankush\Aidescription\Block\Adminhtml\Agent\Edit;

/**
 * Agent Form Class
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * Form constructor.
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config       $wysiwygConfig
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return Form
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            [
            'data' => [
                'id' => 'edit_form',
                'enctype' => 'multipart/form-data',
                'action' => $this->getData('action'),
                'method' => 'post'
            ]
            ]
        );
        $form->setHtmlIdPrefix('ankush_aidescription_');
        if ($model) {
            $fieldset = $form->addFieldset(
                'base_fieldset', [
                'legend' => __('Agent Details'),
                'class' => 'fieldset-wide'
                ]
            );
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset', [
                'legend' => __('Agent Details'),
                'class' => 'fieldset-wide'
                ]
            );
        }

        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
            ]
        );

        $fieldset->addField(
            'agent_title',
            'text',
            [
                'name' => 'agent_title',
                'label' => __('Agent Title'),
                'title' => __('Agent Title'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'agent_details',
            'textarea',
            [
                'name' => 'agent_details',
                'label' => __('Agent Details'),
                'title' => __('Agent Details'),
                'class' => 'required-entry',
                'required' => true,
                'style' => 'height:15em;'
            ]
        );

        $form->setValues($model ? $model->getData() : '');
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
