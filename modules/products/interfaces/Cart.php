<?php

namespace app\modules\products\interfaces;

interface Cart
{
    public function getProducts(): array;
}