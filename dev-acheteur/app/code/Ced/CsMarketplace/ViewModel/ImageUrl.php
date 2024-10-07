<?php


namespace Ced\CsMarketplace\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Helper\Image;

/**
 * Class ImageUrl
 * @package Ced\CsMarketplace\ViewModel
 */
class ImageUrl implements ArgumentInterface
{

    /**
     * @var Image
     */
    protected $image;

    /**
     *
     * @param Image $image
     */
    public function __construct(
        Image $image
    ) {
        $this->image = $image;
    }

    /**
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param string $imageId
     * @param string $file
     * @param array $attributes
     * @return void
     */
    public function getImageUrl($product, $imageId, $file, $attributes = [])
    {
        return $this->image
            ->init($product, $imageId)
            ->setImageFile($file)
            ->getUrl();
    }
}