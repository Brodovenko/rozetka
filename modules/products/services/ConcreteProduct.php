<?php

namespace app\modules\products\services;

use app\modules\products\interfaces\Product;

class ConcreteProduct implements Product
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $price;

    /**
     * ConcreteProduct constructor.
     * @param int $id
     * @param float $price
     */
    public function __construct(int $id, float $price)
    {
        $this->id = $id;
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}