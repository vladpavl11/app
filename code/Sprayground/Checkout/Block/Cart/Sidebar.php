<?php
namespace Sprayground\Checkout\Block\Cart;

/**
 * Cart sidebar block
 */
class Sidebar extends \Magento\Checkout\Block\Cart\Sidebar
{
    /**
     * Returns minicart config
     *
     * @return array
     */
    public function getConfig()
    {
        return [
            'shoppingCartUrl' => $this->getShoppingCartUrl(),
            'checkoutUrl' => $this->getCheckoutUrl(),
            'updateItemQtyUrl' => $this->getUpdateItemQtyUrl(),
            'updateItemOptionUrl' => $this->getUpdateItemOptionUrl(),
            'removeItemUrl' => $this->getRemoveItemUrl(),
            'imageTemplate' => $this->getImageHtmlTemplate(),
            'baseUrl' => $this->getBaseUrl(),
            'minicartMaxItemsVisible' => $this->getMiniCartMaxItemsCount()
        ];
    }

    /**
     * Get update cart item url
     *
     * @return string
     * @codeCoverageIgnore
     */
    public function getUpdateItemOptionUrl()
    {
        return $this->getUrl('checkout/sidebar/updateItemOption', ['_secure' => $this->getRequest()->isSecure()]);
    }
}
