<?php

namespace Sprayground\Nav\Observer;

use  Magento\Framework\Event\ObserverInterface;

class TopMenu implements ObserverInterface
{
    public function __construct()
    {
        //Observer initialization code...
        //You can use dependency injection to get any class this observer may need.
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $menu=$observer->getMenu();
        $transportObject=$observer->getData('transportObject');
        $html=$transportObject->getHtml();
        //Observer execution code...
    }
}

