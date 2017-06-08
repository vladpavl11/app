<?php
namespace SprayGround\Checkout\CustomerData;

/**
 * Default item
 */
class DefaultItem extends \Magento\Checkout\CustomerData\DefaultItem
{
    /**
     * add empty keys to product data to prevent knockout from throwing errors
     */
    protected function doGetItemData()
    {
      $data = parent::doGetItemData();
      $data['super_attribute_options'] = [];
      $data['product_data'] = ['is_sample' => (int)$this->getProduct()->getData('is_sample')];
      return $data;
    }
}
