<?php
namespace Sprayground\Checkout\Helper;

use Magento\Sales\Model\Order\Address;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Country factory
     *
     * @var \Magento\Directory\Model\CountryFactory
     */
    private $_countryFactory;

    protected $objectManager;

    protected $storeManager;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Directory\Model\CountryFactory $countryFactory
    )
    {
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->storeManager = $storeManager;
        $this->_countryFactory = $countryFactory;

        parent::__construct($context);
    }

    public function getAddressSummary($address, $joinWith = "\n")
    {
        if (empty($address)) {
          return '';
        }

        $summary = [];

        $summary[] = $address->getName();
        foreach ($address->getStreet() as $street) {
          $summary[] = $street;
        }
        $summary[] = $address->getCity() . ', ' . $address->getPostcode();
        $summary[] = $address->getRegion();
        $summary[] = $this->_countryFactory->create()
                ->loadByCode($address->getCountryId())->getName();
        if (!empty($address->getTelephone())) {
          $summary[] = 'T: ' . $address->getTelephone();
        }

        return implode($joinWith, $summary);
    }

    public function getItemSubscriptionDescription($optionList, $item)
    {
      $description = '';
      foreach ($optionList as $option) {
        if ($option['label'] == 'Subscription') {
          $description = $option['value'];
        }
      }
      return $description;
    }
}
