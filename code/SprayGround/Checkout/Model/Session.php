<?php
namespace Sprayground\Checkout\Model;

class Session extends \Magento\Checkout\Model\Session
{
    /*
      FAB-476 - cart not clearing after checkout
      https://github.com/magento/magento2/pull/5807/files
    */
    public function clearQuote()
    {
        $this->_eventManager->dispatch('checkout_quote_destroy', ['quote' => $this->getQuote()]);
        $this->_quote = null;
        $this->setQuoteId(null);
        $this->setLastSuccessQuoteId(null);
        $this->setLoadInactive(false);
        $this->replaceQuote($this->getQuote()->save());
        return $this;
    }
}
