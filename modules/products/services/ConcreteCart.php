<?php

namespace app\modules\products\services;

use app\modules\products\interfaces\Cart;
use app\modules\products\interfaces\Product;

class ConcreteCart implements Cart
{
    /**
     * @var Product[]
     */
    private $products;

    /**
     * ConcreteCart constructor.
     * @param Product ...$products
     */
    public function __construct(Product ...$products)
    {
        $this->products = $products;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}