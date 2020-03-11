<?php

namespace app\modules\products\interfaces;

interface Product
{
    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @return int
     */
    public function getId(): int;
}