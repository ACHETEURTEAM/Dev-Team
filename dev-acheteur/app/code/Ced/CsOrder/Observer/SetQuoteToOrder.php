<?php


namespace Ced\CsOrder\Observer;

use Magento\Framework\Event\ObserverInterface;

class SetQuoteToOrder implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    protected $_serializer;

    /**
     * SetQuoteToOrder constructor.
     * @param \Magento\Framework\Serialize\SerializerInterface $serializer
     */
    public function __construct(\Magento\Framework\Serialize\SerializerInterface $serializer)
    {
        $this->_serializer = $serializer;
    }

    /**
     * Set vendor name and url to product incart
     * @param $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getEvent()->getQuote();
        $quote_items = $quote->getItemsCollection();
        foreach ($quote_items as $quoteItem) {
            if (!empty($quoteItem->getOptionByCode('additional_options'))) {
                $additionalOptions = $quoteItem->getOptionByCode('additional_options');
                $orderItem = $observer->getEvent()->getOrderItem();
                $options = $orderItem->getProductOptions();
                $options['additional_options'] = $this->_serializer->unserialize($additionalOptions->getValue());
                $orderItem->setProductOptions($options);
            }
        }
    }
}
