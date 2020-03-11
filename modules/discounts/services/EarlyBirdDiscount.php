<?php

namespace app\modules\discounts\services;

use app\modules\discounts\interfaces\Discount;
use app\modules\discounts\interfaces\DiscountSpecification;
use app\modules\products\interfaces\Product;

class EarlyBirdDiscount implements Discount
{
    /**
     * @var DiscountSpecification
     */
    private $specification;

    /**
     * EarlyBirdDiscount constructor.
     * @param DiscountSpecification $discountSpecification
     */
    public function __construct(DiscountSpecification $discountSpecification)
    {
        $this->specification = $discountSpecification;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function shouldApplyToProduct(Product $product): bool
    {
        return $this->specification->isSatisfiedBy($product);
    }

    /**
     * @return int
     */
    public function getPercent(): int
    {
        return 5;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return 2;
    }
}
