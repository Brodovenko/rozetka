<?php

namespace app\modules\discounts\services;

use app\modules\discounts\interfaces\DiscountSpecification;
use app\modules\products\interfaces\Product;

class PromoDiscountSpecification implements DiscountSpecification
{
    private $request;

    /**
     * @param Product $product
     * @return bool
     */
    public function isSatisfiedBy(Product $product): bool
    {
//        return $this->request->contains('PROMO');
        return true;
    }
}