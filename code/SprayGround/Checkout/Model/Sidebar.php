<?php
namespace SprayGround\Checkout\Model;

use Magento\Framework\Exception\LocalizedException;

/**
 * FAB-99: used to replace configurable product option in the cart
 * does not override \Magento\Checkout\Model\Sidebar
 * currently handles only one Super Attribute
 */

class Sidebar extends \Magento\Checkout\Model\Sidebar
{
    protected function prepareNewItem($data)
    {
      $item = $this->cart->getQuote()->getItemById($data['item_id']);
      $product = $item->getProduct();

      if (!$product) {
          throw new LocalizedException(__('We can\'t find the product.'));
      }

      if (!$data['item_option_id'] || !$data['item_super_attribute_id']) {
          throw new LocalizedException(__('Configurable product data missing.'));
      }

      $requestData = [
        'qty' => $item->getQty(),
        'product' => $product->getId(),
        'super_attribute' => [
          $data['item_super_attribute_id'] => $data['item_option_id']
        ]
      ];
      $buyRequest = $item->getBuyRequest();
      if ($buyRequest && $buyRequest['options']) {
        $requestData['options'] = $buyRequest['options'];
      }

      $newItemData = [
        'product' => $product,
        'request_data' => $requestData
      ];

      return $newItemData;
    }

    public function replaceQuoteItem($requestData)
    {
        $itemId = $requestData['item_id'];
        $newItemData = $this->prepareNewItem($requestData);

        if ($newItemData) {
          $this->cart->removeItem($itemId);
          $this->cart->addProduct($newItemData['product'], $newItemData['request_data']);
          $this->cart->save();
        }

        return $this;
    }
}
