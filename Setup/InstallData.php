<?php

// https://developer.adobe.com/commerce/frontend-core/ui-components/howto/add-category-attribute/

namespace GroomerShop\CategoryCustomHeadline\Setup;

use Magento\Framework\Setup\{
    ModuleContextInterface,
    ModuleDataSetupInterface,
    InstallDataInterface
};

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

class InstallData implements InstallDataInterface
{
    /**
     * @var \Magento\Eav\Setup\EavSetup
     */
    protected $eavSetup;

    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    protected $moduleDataSetupInterface;

    public function __construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetupInterface
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetupInterface = $moduleDataSetupInterface;

        $this->eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetupInterface]);
    }

    public function install(
        \Magento\Framework\Setup\ModuleDataSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        if (!$this->eavSetup->getAttributeId(\Magento\Catalog\Model\Category::ENTITY, 'custom_heading_one')) {
            $this->eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'custom_heading_one',
                [
                    'type' => 'varchar',
                    'label' => 'Custom H1 tag',
                    'input' => 'text',
                    'visible' => true,
                    'required' => false,
                    'sort_order' => 140,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'Search Engine Optimization'
                ]
            );
        }
    }
}