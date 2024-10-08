<?php


namespace Ced\CsMarketplace\Logger;


use Magento\Framework\Filesystem\DriverInterface;

/**
 * Class Handler
 * @package Ced\CsMarketplace\Logger
 */
class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * @var
     */
    protected $loggerType = \Ced\CsMarketplace\Logger\Logger::INFO;

    /**
     * Handler constructor.
     * @param DriverInterface $filesystem
     * @param \Magento\Framework\Stdlib\DateTime\Timezone $timezone
     * @param \Magento\Customer\Model\Session $session
     * @param null $filePath
     */
    public function __construct(
        DriverInterface $filesystem,
        \Magento\Framework\Stdlib\DateTime\Timezone $timezone,
        \Magento\Customer\Model\Session $session,
        $filePath = null
    ) {

        $date = $timezone->date();
        $vendor_id = $session->getVendorId();
        $this->fileName =
            '/var/log/Ced/CsMarketplace/' . ((!empty($vendor_id)) ? $vendor_id . DIRECTORY_SEPARATOR : '') .
            $date->format('y-m-d') . '.log';
        parent::__construct($filesystem, $filePath);
    }
}