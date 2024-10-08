<?php


namespace Ced\CsMarketplace\Plugin;

use Ced\CsMarketplace\Helper\Mail;
use Ced\CsMarketplace\Model\Vendor;
use Ced\CsMarketplace\Model\VproductsFactory;
use Magento\Customer\Model\Customer;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class CustomerDelete
 * @package Ced\CsMarketplace\Plugin
 */
class CustomerDelete
{

    /**
     * @var Vendor
     */
    public $vendorModel;

    /**
     * @var VproductsFactory
     */
    public $vProductsFactory;

    /**
     * @var Mail
     */
    public $mail;

    /**
     * CustomerDelete constructor.
     * @param Vendor $vendorModel
     * @param VproductsFactory $vProductsFactory
     * @param Mail $mail
     */
    public function __construct(
        Vendor $vendorModel,
        VproductsFactory $vProductsFactory,
        Mail $mail
    ) {
        $this->vendorModel = $vendorModel;
        $this->vProductsFactory = $vProductsFactory;
        $this->mail = $mail;
    }

    /**
     * @param Customer $subject
     * @param $result
     * @return mixed
     */
    public function afterAfterDeleteCommit(Customer $subject, $result)
    {
        $customerId = $result->getId();
        try {
            $vendor = $this->vendorModel->loadByCustomerId($customerId);
            if ($vendor && $vendor->getId()) {
                $this->vProductsFactory->create()->deleteVendorProducts($vendor->getId());
                $this->mail->sendAccountEmail(Vendor::VENDOR_DELETED_STATUS,$vendor,'',0);
                $vendor->delete();
            }
        } catch (LocalizedException $e) {
        }
        return $result;
    }
}
