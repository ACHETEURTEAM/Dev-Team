<?php


namespace Ced\CsVendorProductAttribute\Controller\Attribute;

/**
 * Class NewAction
 * @package Ced\CsVendorProductAttribute\Controller\Attribute
 */
class NewAction extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * NewAction constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\Registry $registry
    )
    {
        parent::__construct($context);
        $this->registry = $registry;
        if (!$this->registry->registry('vendorPanel'))
            $this->registry->register('vendorPanel', 1);
        $this->resultForwardFactory = $resultForwardFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        return $this->resultForwardFactory->create()->forward('edit');
    }
}
