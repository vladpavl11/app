<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Sprayground\Checkout\Controller\Sidebar;

use Sprayground\Checkout\Model\Sidebar;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Response\Http;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Json\Helper\Data;
use Psr\Log\LoggerInterface;

/**
  * Replaces configurable product variant
  * currently handles only one Super Attribute
  */
class UpdateItemOption extends Action
{
    /**
     * @var Sidebar
     */
    protected $sidebar;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Data
     */
    protected $jsonHelper;

    /**
     * @param Context $context
     * @param Sidebar $sidebar
     * @param LoggerInterface $logger
     * @param Data $jsonHelper
     * @codeCoverageIgnore
     */
    public function __construct(
        Context $context,
        Sidebar $sidebar,
        LoggerInterface $logger,
        Data $jsonHelper
    ) {
        $this->sidebar = $sidebar;
        $this->logger = $logger;
        $this->jsonHelper = $jsonHelper;
        parent::__construct($context);
    }

    /**
     * @return $this
     */
    public function execute()
    {
        $itemId = (int)$this->getRequest()->getParam('item_id');
        $requestData = ([
          'item_id' => $itemId,
          'item_super_attribute_id' => (int)$this->getRequest()->getParam('super_attribute_id'),
          'item_option_id' => (int)$this->getRequest()->getParam('item_option')
        ]);

        try {
            $this->sidebar->checkQuoteItem($itemId);
            $this->sidebar->replaceQuoteItem($requestData);
            return $this->jsonResponse();
        } catch (LocalizedException $e) {
            return $this->jsonResponse($e->getMessage());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            return $this->jsonResponse($e->getMessage());
        }
    }

    /**
     * Compile JSON response
     *
     * @param string $error
     * @return Http
     */
    protected function jsonResponse($error = '')
    {
        return $this->getResponse()->representJson(
            $this->jsonHelper->jsonEncode($this->sidebar->getResponseData($error))
        );
    }
}
