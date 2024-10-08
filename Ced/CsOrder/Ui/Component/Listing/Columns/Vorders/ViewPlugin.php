<?php


namespace Ced\CsOrder\Ui\Component\Listing\Columns\Vorders;

class ViewPlugin
{
    const ORDER_VIEW_ROUTE_PATH = 'csorder/vorders/view';

    /**
     * @param \Ced\CsMarketplace\Ui\Component\Listing\Columns\Vorders\View $subject
     * @param $result
     * @return string
     */
    public function afterGetOrderViewRoutePath(
        \Ced\CsMarketplace\Ui\Component\Listing\Columns\Vorders\View $subject,
        $result
    ) {
        return self::ORDER_VIEW_ROUTE_PATH;
    }

    /**
     * @param \Ced\CsMarketplace\Ui\Component\Listing\Columns\Vorders\View $subject
     * @param $result
     * @param $item
     * @return array
     */
    public function afterGetOrderViewRouteParams(
        \Ced\CsMarketplace\Ui\Component\Listing\Columns\Vorders\View $subject,
        $result,
        $item
    ) {
        return [
            'order_id' => $item['real_order_id'],
            'vorder_id' => $item['id']
        ];
    }
}
