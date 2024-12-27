<?php

// https://developer.adobe.com/commerce/frontend-core/ui-components/howto/add-category-attribute/

namespace GroomerShop\CategoryH1\Setup;

use Magento\Framework\Setup\{
    ModuleContextInterface,
    ModuleDataSetupInterface,
    InstallDataInterface
};

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'custom_h1', [
            'type' => 'varchar',
            'label' => 'Custom H1 tag',
            'input' => 'text',
            'global' => 'store',
            'group' => 'Search Engine Optimization',
            'required' => false
        ]);
    }
}