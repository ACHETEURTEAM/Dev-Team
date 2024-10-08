<?php


namespace Ced\CsMarketplace\Model\System\Config\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\CollectionFactory;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;

/**
 * Class StepstoRegisterBlock
 * @package Ced\CsMarketplace\Model\System\Config\Source
 */
class StepstoRegisterBlock extends \Ced\CsMarketplace\Model\System\Config\Source\AbstractBlock
{

    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\CollectionFactory
     */
    protected $blockCollectionFactory;

    /**
     * StepstoRegisterBlock constructor.
     * @param CollectionFactory $attrOptionCollectionFactory
     * @param OptionFactory $attrOptionFactory
     * @param \Magento\Cms\Model\ResourceModel\Block\CollectionFactory $blockCollectionFactory
     */
    public function __construct(
        CollectionFactory $attrOptionCollectionFactory,
        OptionFactory $attrOptionFactory,
        \Magento\Cms\Model\ResourceModel\Block\CollectionFactory $blockCollectionFactory
    ) {
        $this->blockCollectionFactory = $blockCollectionFactory;
        parent::__construct($attrOptionCollectionFactory, $attrOptionFactory);
    }

    /**
     * Retrieve Option values array
     *
     * @param bool $defaultValues
     * @return array
     */
    public function toOptionArray($defaultValues = false)
    {
        $options = [];
        $blockCollection = $this->blockCollectionFactory->create();
        if (!empty($blockCollection)) {
            foreach ($blockCollection as $block) {
                $options[$block->getIdentifier()] = $block->getTitle();

            }
        }
        return $options;
    }
}
