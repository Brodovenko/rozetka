<?php

namespace app\modules\discounts\services;

use app\modules\discounts\interfaces\DiscountSpecification;
use app\modules\products\interfaces\Product;

class DbDiscountSpecification implements DiscountSpecification
{
    private $db;

    /**
     * @param Product $product
     * @return bool
     */
    public function isSatisfiedBy(Product $product): bool
    {
//        return in_array($product->getId(), $this->db->getDisocountedIds());
        return true;
    }
}