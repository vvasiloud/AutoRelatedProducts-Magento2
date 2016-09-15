<?php 
/**
 * A Magento 2 module named Vvasiloud/AutoRelatedProducts
 * Copyright (C) 2016  
 * 
 * This file is part of Vvasiloud/AutoRelatedProducts.
 * 
 * Vvasiloud/AutoRelatedProducts is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Vvasiloud\AutoRelatedProducts\Plugin\Magento\Catalog\Block\Product\ProductList;
 
 
class Related {

	protected $_categoryFactory;
	protected $_registry;
	protected $_dataHelper;
	
	public function __construct(
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\Registry $registry,
		\Vvasiloud\AutoRelatedProducts\Helper\Data $dataHelper
    ) {
		$this->_categoryFactory = $categoryFactory;
		$this->_registry = $registry;
		$this->_dataHelper = $dataHelper;
    }
	
	public function afterGetItems(
		\Magento\Catalog\Block\Product\ProductList\Related $subject,
		$result
	){
        $collection = $this->getRelatedProductsCollection($result);

        return $collection;
		
	}
	
	private function getRelatedProductsCollection($loadedCollection)
	{

		$isEnabled = $this->_dataHelper->isEnabled();
		if(count( $loadedCollection ) == 0 && $isEnabled){ // if there are no related products set manually generate automatically
			$product = $this->_registry->registry('current_product');//get current product
			
			$productCategories = $product->getCategoryIds();
			
			if($productCategories){
				$categoryId = end($productCategories); 	//Get last category id to avoid root category
				
				$productCount = $this->_dataHelper->getProductCount();
				$category = $this->_categoryFactory->create()->load($categoryId);

				$collection = $category->getProductCollection()->addAttributeToSelect('*')->addStoreFilter();
				$collection->addAttributeToFilter('visibility', \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH);
				$collection->addAttributeToFilter('status',\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);

				if ($productCount) {
					$collection->setPageSize($productCount);
				}
				
				return $collection;
			}
		};
		
		return $loadedCollection;
		
	}
}
