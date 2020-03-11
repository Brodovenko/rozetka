<?php

namespace app\modules\discounts\services;

use app\modules\discounts\interfaces\Discount;
use app\modules\products\interfaces\Cart;
use app\modules\products\interfaces\Product;

class DiscountManager
{
    /**
     * @var DiscountAggregator
     */
    private $discountAggregator;

    /**
     * @var array
     */
    private $appliedDiscounts = [];

    /**
     * @var array
     */
    private $discountedPrices = [];

    /**
     * DiscountManager constructor.
     * @param DiscountAggregator $aggregator
     */
    public function __construct(DiscountAggregator $aggregator)
    {
        $this->discountAggregator = $aggregator;
    }

    /**
     * @param Product $product
     * @return array
     */
    public function getAppliedDiscounts(Product $product): array
    {
        return $this->appliedDiscounts[$product->getId()];
    }

    /**
     * @param Product $product
     * @return float
     */
    public function getDiscountedPrice(Product $product): float
    {
        return $this->discountedPrices[$product->getId()];
    }

    /**
     * @param Cart $cart
     * @param Discount ...$discounts
     */
    public function applyDiscounts(Cart $cart, Discount ...$discounts): void
    {
        foreach ($cart->getProducts() as $product) {

            $applicableToProduct = [];
            foreach ($discounts as $discount) {
                if ($discount->shouldApplyToProduct($product)) {
                    $applicableToProduct[] = $discount;
                }
            }

            $this->discountAggregator->aggregate($applicableToProduct);
            $this->appliedDiscounts[$product->getId()] = $this->discountAggregator->getAppliedDiscounts();
            $this->discountedPrices[$product->getId()] =
                $product->getPrice() - ($product->getPrice() * $this->discountAggregator->getResultPercent() / 100);
        }
    }
}