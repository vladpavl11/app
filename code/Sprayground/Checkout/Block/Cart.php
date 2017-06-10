<?php
namespace Sprayground\Checkout\Block;

/**
 * Shopping cart block
 */
class Cart extends \Magento\Checkout\Block\Cart
{
  /**
   * @var \Sprayground\Checkout\Model\Samples
   */
  protected $samplesModel;

  /**
   * @param \Magento\Framework\View\Element\Template\Context $context
   * @param \Magento\Customer\Model\Session $customerSession
   * @param \Magento\Checkout\Model\Session $checkoutSession
   * @param \Magento\Catalog\Model\ResourceModel\Url $catalogUrlBuilder
   * @param \Magento\Checkout\Helper\Cart $cartHelper
   * @param \Magento\Framework\App\Http\Context $httpContext
   * @param array $data
   */
  public function __construct(
      \Magento\Framework\View\Element\Template\Context $context,
      \Magento\Customer\Model\Session $customerSession,
      \Magento\Checkout\Model\Session $checkoutSession,
      \Magento\Catalog\Model\ResourceModel\Url $catalogUrlBuilder,
      \Magento\Checkout\Helper\Cart $cartHelper,
      \Magento\Framework\App\Http\Context $httpContext,
      array $data = []
  ) {
      parent::__construct(
        $context,
        $customerSession,
        $checkoutSession,
        $catalogUrlBuilder,
        $cartHelper,
        $httpContext,
        $data
      );
  }

  protected function _prepareLayout()
  {
      $canonical = preg_replace('/\?.*$/', '', $this->getUrl('*/*/*', ['_current' => true, '_use_rewrite' => true, '_nosid' => true]));
      $canonical = preg_replace('/\/index\/?$/', '/', $canonical);
      $this->pageConfig->addRemotePageAsset(
          $canonical,
          'canonical',
          ['attributes' => ['rel' => 'canonical']]
      );
      return parent::_prepareLayout();
  }

 

 

  
}
