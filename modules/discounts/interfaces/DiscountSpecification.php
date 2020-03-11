<?php

namespace app\modules\discounts\interfaces;

use app\modules\products\interfaces\Product;

interface DiscountSpecification
{
    /**
     * @param Product $product
     * @return bool
     */
    public function isSatisfiedBy(Product $product): bool;
}