<?php

namespace Groomershop\CategoryH1\Plugin;

use Magento\Framework\Registry;
use Magento\Framework\App\Request\Http;

class CategoryCustomH1
{
    /**
     * @var Registry
     */
    private $coreRegistry;

    public function __construct(
        Registry $coreRegistry,
        Http $request
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->request = $request;
    }

    public function afterGetPageHeading(\Magento\Theme\Block\Html\Title $subject, $title)
    {
        if ($this->request->getFullActionName() == 'catalog_category_view') {

            $catalogHelperData = $subject->helper('Magento\Catalog\Helper\Data');
            $categoryObject = $catalogHelperData->getCategory();
            
            if ($categoryObject) {
              $categoryCustomH1 = trim($categoryObject->getCustomH1());
            }

            if (isset($categoryCustomH1) && !empty($categoryCustomH1)) {
                $title = $categoryCustomH1;
            }
        }
        
        return $title;
    }
}