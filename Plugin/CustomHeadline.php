<?php

namespace Groomershop\CategoryCustomHeadline\Plugin;

use Magento\Framework\Registry;
use Magento\Framework\App\Request\Http;

class CustomHeadline
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

    public function afterGetHeadline(\MageSuite\ThemeHelpers\Block\Category\View\Headline $subject, $headline)
    {
        /** @var \Magento\Catalog\Model\Category $category */
        $category = $this->coreRegistry->registry('current_category');

        if (empty($category)) {
            return $headline;
        } else {
            $customHeadline = $category->getCustomHeadingOne();
            if ($customHeadline !== null && !empty(trim($customHeadline))) {
                return $customHeadline;
            } else {
                return $headline;
            }
        }
    }
}
