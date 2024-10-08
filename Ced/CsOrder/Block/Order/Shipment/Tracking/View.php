<?php


namespace Ced\CsOrder\Block\Order\Shipment\Tracking;

class View extends \Magento\Shipping\Block\Adminhtml\Order\Tracking\View
{
    /**
     * Retrieve save url
     * @return string
     */
    public function getSubmitUrl()
    {
        return $this->getUrl('csorder/*/addTrack/', ['shipment_id' => $this->getShipment()->getId()]);
    }

    /**
     * Retrieve remove url
     * @param  \Magento\Sales\Model\Order\Shipment\Track $track
     * @return string
     */
    public function getRemoveUrl($track)
    {
        return $this->getUrl(
            'csorder/*/removeTrack/',
            ['shipment_id' => $this->getShipment()->getId(), 'track_id' => $track->getId()]
        );
    }
}
