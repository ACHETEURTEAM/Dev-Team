<?php


namespace Ced\CsMarketplace\Ui\Component\Listing\Columns;

/**
 * Class Websites
 * @package Ced\CsMarketplace\Ui\Component\Listing\Columns
 */
class Websites implements \Magento\Framework\Option\ArrayInterface
{

	protected $_storeManager;

	public $_options = [];

	/**
	 * @param \Magento\Framework\Registry $coreRegistry
	 */
	 function __construct(
		\Magento\Store\Model\StoreManagerInterface $storeManager
	) {
		 $this->_storeManager = $storeManager;
	}

	public function getAllOptions()
    {
        $allWebsites = [];
    	if(!$this->_options){
            $websiteCollection = $this->_storeManager->getWebsites();
            
            foreach($websiteCollection as $website){
                    $allWebsites[] = [
                        'value' => $website->getWebsiteId(),
                        'label' => $website->getName()
                    ];
            }
    	}

        $this->_options = $allWebsites;
    	return $this->_options;
    }
 
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getAllOptions();
    }

    public function getOptionText($optionId){
        $options = $this->getOptionArray();
        return isset($options[$optionId]) ? $options[$optionId] : null;
    }

    
    public function getOptionArray(){
        $options = [];
        foreach ($this->getAllOptions() as $option) {
            $options[$option['value']] = (string)$option['label'];
        }
        return $options;
    }

    public function getOptions()
    {
        $res = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }

  
    public function getAllOption()
    {
        $options = $this->getOptionArray();
        array_unshift($options, ['value' => '', 'label' => '']);
        return $options;
    }
}
