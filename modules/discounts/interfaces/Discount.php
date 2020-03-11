<?php
namespace app\modules\discounts\interfaces;

use app\modules\products\interfaces\Product;

interface Discount
{
    /**
     * @return int
     */
    public function getPercent(): int;

    /**
     * @return int
     */
    public function getType(): int;

    /**
     * @param Product $product
     * @return bool
     */
    public function shouldApplyToProduct(Product $product): bool;
}