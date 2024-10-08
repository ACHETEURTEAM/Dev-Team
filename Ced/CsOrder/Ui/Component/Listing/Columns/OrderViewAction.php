<?php


namespace Ced\CsOrder\Ui\Component\Listing\Columns;

class OrderViewAction
{
    const ORDER_VIEW_ROUTE_PATH = 'csorder/vendororder/view';

    /**
     * @param \Ced\CsMarketplace\Ui\Component\Listing\Columns\OrderViewAction $subject
     * @param $result
     * @return string
     */
    public function afterGetOrderViewRoutePath(
        \Ced\CsMarketplace\Ui\Component\Listing\Columns\OrderViewAction $subject,
        $result
    ) {
        return self::ORDER_VIEW_ROUTE_PATH;
    }

    /**
     * @param \Ced\CsMarketplace\Ui\Component\Listing\Columns\OrderViewAction $subject
     * @param $result
     * @param $item
     * @return array
     */
    public function afterGetOrderViewRouteParams(
        \Ced\CsMarketplace\Ui\Component\Listing\Columns\OrderViewAction $subject,
        $result,
        $item
    ) {
        $vorderId = false;
        if (isset($item['id'])) {
            $vorderId = $item['id'];
        }
        if (!$vorderId) {
            return $result;
        } else {
            return array_merge($result, ['vorder_id' => $vorderId]);
        }
    }
}
