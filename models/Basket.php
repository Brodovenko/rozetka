<?php

namespace app\models;


use app\modules\discounts\services\DiscountManager;
use app\modules\products\interfaces\Cart;

class Basket
{
    /**
     * @var Cart
     */
    private $products;
    /**
     * @var DiscountManager
     */
    private $discountManager;

    /**
     * Basket constructor.
     * @param Cart $cart
     * @param DiscountManager $discountManager
     */
    public function __construct(Cart $cart, DiscountManager $discountManager)
    {
        $this->products = $cart;
        $this->discountManager = $discountManager;
    }

    /**
     * @return float|int
     */
    public function getPriceWithDiscount()
    {
        $result = 0;
        foreach ($this->products->getProducts() as $product) {
            $result += $this->discountManager->getDiscountedPrice($product);
        }

        return $result;
    }

    /**
     * @return int
     */
    public function getPriceWithoutDiscount()
    {
        $result = 0;
        foreach ($this->products->getProducts() as $product) {
            $result += $product->getPrice();
        }

        return $result;
    }
}