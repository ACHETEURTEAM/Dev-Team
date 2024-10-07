<?php


namespace Ced\CsMarketplace\Ui\Adminhtml\Product\Column\Renderer;

use Magento\Ui\Component\Listing\Columns\Column;


/**
 * Class Reason
 * @package Ced\CsMarketplace\Ui\Adminhtml\Product\Column\Renderer
 */
class Reason extends Column
{

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        foreach ($dataSource['data']['items'] as $key => $item)
        {
            $html = "N/A";
            if($item['id'] && $item['check_status'] == 0){
                $html = $item['reason'];
            }
            $dataSource['data']['items'][$key]['reason'] = $html;
        }
        return $dataSource;
    }
}
